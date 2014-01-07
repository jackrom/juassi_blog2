<?php

/*
	From WordPress
*/
if (!function_exists('juassi_autop')) {
	function juassi_autop($pee, $br = 1) {
		$pee = $pee . "\n"; // just to make things a little easier, pad the end
		$pee = preg_replace('|<br />\s*<br />|', "\n\n", $pee);
		// Space things out a little
		$allblocks = '(?:table|thead|tfoot|caption|colgroup|tbody|tr|td|th|div|dl|dd|dt|ul|ol|li|pre|select|form|map|area|blockquote|address|math|style|input|p|h[1-6]|hr)';
		$pee = preg_replace('!(<' . $allblocks . '[^>]*>)!', "\n$1", $pee);
		$pee = preg_replace('!(</' . $allblocks . '>)!', "$1\n\n", $pee);
		$pee = str_replace(array("\r\n", "\r"), "\n", $pee); // cross-platform newlines
		$pee = preg_replace("/\n\n+/", "\n\n", $pee); // take care of duplicates
		$pee = preg_replace('/\n?(.+?)(?:\n\s*\n|\z)/s', "<p>$1</p>\n", $pee); // make paragraphs, including one at the end
		$pee = preg_replace('|<p>\s*?</p>|', '', $pee); // under certain strange conditions it could create a P of entirely whitespace
		$pee = preg_replace('!<p>([^<]+)\s*?(</(?:div|address|form)[^>]*>)!', "<p>$1</p>$2", $pee);
		$pee = preg_replace( '|<p>|', "$1<p>", $pee );
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee); // don't pee all over a tag
		$pee = preg_replace("|<p>(<li.+?)</p>|", "$1", $pee); // problem with nested lists
		$pee = preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $pee);
		$pee = str_replace('</blockquote></p>', '</p></blockquote>', $pee);
		$pee = preg_replace('!<p>\s*(</?' . $allblocks . '[^>]*>)!', "$1", $pee);
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*</p>!', "$1", $pee);
		if ($br) {
			$pee = preg_replace('/<(script|style).*?<\/\\1>/se', 'str_replace("\n", "<WPPreserveNewline />", "\\0")', $pee);
			$pee = preg_replace('|(?<!<br />)\s*\n|', "<br />\n", $pee); // optionally make line breaks
			$pee = str_replace('<WPPreserveNewline />', "\n", $pee);
		}
		$pee = preg_replace('!(</?' . $allblocks . '[^>]*>)\s*<br />!', "$1", $pee);
		$pee = preg_replace('!<br />(\s*</?(?:p|li|div|dl|dd|dt|th|pre|td|ul|ol)[^>]*>)!', '$1', $pee);
		/*
		if (strpos($pee, '<pre') !== false)
			$pee = preg_replace('!(<pre.*?>)(.*?)</pre>!ise', " stripslashes('$1') .  stripslashes(clean_pre('$2'))  . '</pre>' ", $pee);
		*/
		$pee = preg_replace( "|\n</p>$|", '</p>', $pee );

		return $pee;
	}
}

if (!function_exists('juassi_login')) {
	function juassi_login($user_name, $password, $already_md5 = FALSE) {
		global $juassi_db, $juassi_tb, $juassi_session;

		if (empty($password)) return false;

		$user_name = strtolower($user_name);

		if (!$already_md5) $password = md5($password);

		$query = "SELECT * FROM $juassi_tb->users WHERE active = 1 AND user_name = :username LIMIT 1";

		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(':username', $user_name);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}

		$user = $stmt->fetchAll(PDO::FETCH_ASSOC);

		if (!empty($user)) {
			if ($user[0]['password'] === $password) {
				$juassi_session->regenerate_id();
				trigger_error('Login Successful "' . juassi_htmlentities($user_name) . '"', E_USER_NOTICE);

				//setup session here
				$user_array = array(
					'user_id' => $user[0]['user_id'],
				);

				$_SESSION['juassi_user_data'] = $user_array;

				return true;
			}
			else {
				trigger_error('Login Failed (Incorrect Password) "' . juassi_htmlentities($user_name) . '"', E_USER_WARNING);
				return false;
			}
		}
		else {
			trigger_error('Login Failed (Unknown User) "' . juassi_htmlentities($user_name) . '"', E_USER_WARNING);
			return false;
		}

	}
}

if (!function_exists('juassi_logout')) {
	function juassi_logout() {

		trigger_error('Logout Successful "' . juassi_htmlentities(juassi_get_user_data('user_name')) . '"', E_USER_NOTICE);

		session_destroy();

		return true;
	}
}

?>