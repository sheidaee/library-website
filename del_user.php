<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

if($_SESSION['username']!='admin')	header('location:'.SITE_URL);

$database = new Database();											

if(isset($_POST['id'])) {
	$datebase->query('DELETE FROM users WHERE id = ?');
	$datebase->bind(1, intval($_POST['id']));
	$datebase->execute();
}