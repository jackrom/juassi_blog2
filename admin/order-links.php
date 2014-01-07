<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Order Links');
	juassi_set_in_admin(true);

	$juassi_sortme = $_POST['sortme'];

	for ($i = 0; $i < count($juassi_sortme); $i++) {
		$query = "UPDATE $juassi_tb->links SET `link_order` = :order WHERE link_id = :link_id";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(':order', $i);
		$stmt->bindParam(':link_id', $juassi_sortme[$i]);

		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
	}
?>