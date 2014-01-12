<?php
include_once( 'ez_sql/ez_sql_core.php' );
include_once( 'ez_sql/ez_sql_mysql.php' );

/**
 * A PHP download handler.
 * Features:
 * - One-time download URL creation.
 * - Allow resuming downloads.
 * - Limit download speed.
 *
 * @author Tim Wachsener
 * @version 2.0
 * @uses ezSQL
 */
class Secure_File_Download
{
	private $db = null;

	/**
	 * Constructor. Connects to the database.
	 *
	 * @param string $db_user Login username.
	 * @param string $db_password The password of $db_user.
	 * @param string $db_name Name of the database to connect to.
	 * @param string $db_host Server the database is hosted on.
	 *
	 * @return void
	 */
	function __construct( $_db_user, $_db_password, $_db_name, $_db_host )
	{
		$this->db = new ezSQL_mysql( $_db_user, $_db_password, $_db_name, $_db_host );
	}

	/**
	 * Create a download key and store it in the database.
	 *
	 * @param string $_dl_file Path to file.
	 * @param int $_dl_expires Time in seconds until the download key expires.
	 *
	 * @return string||bool The download key or false.
	 */
	public function create_key( $_dl_file, $_dl_expires = 604800 )
	{
		$dl_key = md5( $_dl_file . microtime() );
		$dl_file = $this->db->escape( $_dl_file );
		$dl_expires = time() + $_dl_expires;

		$query_result = $this->db->query( "INSERT INTO download_keys ( dl_key, dl_file, dl_expires ) VALUES ( '$dl_key', '$dl_file', FROM_UNIXTIME( '$dl_expires' ) )" );

		return is_int( $query_result ) ? $dl_key : false;
	}

	/**
	 * Serve the file to the users browser if a valid key is given.
	 *
	 * @param string $_dl_key Download key.
	 * @param bool $_dl_allow_resume Allow resuming of paused downloads.
	 * @param int $_dl_speed Maximum download speed in kB per second.
	 *
	 * @return void
	 */
	public function download( $_dl_key, $_dl_allow_resume = true, $_dl_speed = 0 )
	{
		if( connection_status() != 0 ) return false;

		$dl_file = $this->get_file( $_dl_key );
		if( $dl_file === false ) return( 'Error: download is expired.' );
		if( !is_file( $dl_file ) ) return( 'Error: file does not exist.' );
		$dl_file_size = filesize( $dl_file );
		$dl_file_offset = 0;
		$dl_resumed = isset( $_SERVER['HTTP_RANGE'] ) ? true : false;

		header( 'Cache-Control: public' );
		header( 'Content-Transfer-Encoding: binary' );
		header( 'Content-Type: application/octet-stream' );
		header( 'Content-Disposition: attachment; filename="' . basename( $dl_file ) . '"' );
		header( 'Accept-Ranges: bytes' );

		if( $dl_resumed && $_dl_allow_resume ):
			preg_match( '/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $preg_match );
			
			$dl_file_offset = intval( $preg_match[1] );
			$dl_file_end = intval( $preg_match[2] );
			
			header( 'HTTP/1.1 206 Partial Content' );
			header( 'Content-Length: ' . $dl_file_end-$dl_file_offset+1 );
			header( 'Content-Range: bytes ' . $dl_file_offset . '-' . $dl_file_end . '/' . $dl_file_size );
		elseif( $dl_resumed && !$_dl_allow_resume ):
			return( 'Error: resuming downloads is not allowed.' );
		else:
			header( 'Content-Range: bytes 0-' . $dl_file_size-1 . '/' . $dl_file_size );
			header( 'Content-Length: ' . $dl_file_size );
		endif;

		ignore_user_abort( true );

		$dl_file_handle = fopen( $dl_file, 'rb' );
		fseek( $dl_file_handle, $dl_file_offset );
		while( !feof( $dl_file_handle ) && ( connection_aborted() == 0 ) ):
			set_time_limit( 0 );
			if( $_dl_speed > 0 ):
				echo fread( $dl_file_handle, 1024*$_dl_speed );
				sleep( 1 );
			else:
				echo fread( $dl_file_handle, 1024*8 );
			endif;
			ob_end_flush(); 
			ob_flush(); 
			flush(); 
			ob_start();
		endwhile;

		if( feof( $dl_file_handle ) ) $this->delete_key( $_dl_key );

		fclose( $dl_file_handle );

		die;
	}

	/**
	 * Get the path or URL for a key if it is not expired.
	 *
	 * @param string $_dl_key Download key.
	 *
	 * @return string||bool The path or false.
	 */
	private function get_file( $_dl_key )
	{
		$dl_key = $this->db->escape( $_dl_key );

		$dl_file = $this->db->get_var( "SELECT dl_file FROM download_keys WHERE dl_key = '$dl_key' AND dl_expires > " . $this->db->sysdate() );

		return is_string( $dl_file ) ? $dl_file : false;
	}

	/**
	 * Delete a key from the database.
	 *
	 * @param string $_dl_key Download key.
	 *
	 * @return bool
	 */
	private function delete_key( $_dl_key )
	{
		$dl_key = $this->db->escape( $_dl_key );

		$query_result = $this->db->query( "DELETE FROM download_keys WHERE dl_key = '$dl_key'" );

		return is_int( $query_result ) ? true : false;
	}
}
?>