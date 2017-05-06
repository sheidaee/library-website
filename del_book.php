<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

if($_SESSION['username']!='admin')	header('location:'.SITE_URL);

$database = new Database();											

if(isset($_POST['id'])) {
	$datebase->query('SELECT * FROM book WHERE id = ?');
	$datebase->bind(1, intval($_POST['id']));
	$row = $datebase->single();


	@unlink(PATH_IMG . $row['image']);
	@unlink(PATH_THUMBS . $row['image']);
	@unlink(PATH_BOOK . $row['book']);
	
	$datebase->query('DELETE FROM book WHERE id = ?');
	
	$datebase->bind(1, intval($_POST['id']));
	$datebase->execute();
}