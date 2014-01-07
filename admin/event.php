<?php
	include('include/admin-header.php');
	juassi_set_admin_title('Event Details');
	juassi_set_in_admin(true);
	//$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Viewer', 'event-viewer.php');
	$juassi_ln->add_lower_link($juassi_ln->event_viewer, 'Event Details', 'event.php');
	include('include/html-header.php');
?>
<?php
		//move this elsewhere
		if (isset($_GET['event_id']) && !empty($_GET['event_id'])) {
			$event_id = (int) $_GET['event_id'];
		}
		else {
			$event_id = 0;
		}
		$query = "SELECT * FROM $juassi_tb->events WHERE event_id = ? LIMIT 1";
		$stmt = $juassi_db->prepare($query);
		$stmt->bindParam(1, $event_id);
		try {
			$stmt->execute();
		}
		catch (Exception $e) {
			juassi_die($e->getMessage());
		}
		$events = $stmt->fetchAll(PDO::FETCH_ASSOC);
		?>
<div class="contain">
        <h1>Event Details</h1>
        <div class="tablecontain">
            <pre>
            <?php
            if (!empty($events)) {
            $event = print_r($events[0], TRUE);
            echo juassi_htmlentities($event);
            }
            else {
                    echo 'Event ID not found.';
            }
            ?>
            </pre>
        </div>
</div>
<?php
        include('include/sidebar.php');
	include('include/html-footer.php');
?>