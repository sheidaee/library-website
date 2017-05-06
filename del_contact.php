<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

if($_SESSION['username']!='admin')	header('location:'.SITE_URL);

$database = new Database();											

if(isset($_GET['id'])) {
	$datebase->query('DELETE FROM contact WHERE id = ?');
	$datebase->bind(1, intval($_GET['id']));
	$datebase->execute();

	echo'<script>				
				window.location.replace("'.SITE_URL.'/admin_contact.php");
	</script>';
}