<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

if($_SESSION['username']!='admin')	header('location:'.SITE_URL);

$database = new Database();											

if(isset($_POST['id'])) {
	$datebase->query('SELECT * FROM users WHERE id = ?');
	$datebase->bind(1, intval($_POST['id']));
	$row = $datebase->single();
	echo '<p id="user">'.$row['username'].'</p>';
	echo '<p id="email">'.$row['email'].'</p>';
}else {
	$datebase->query('UPDATE users SET username = :username , email = :email WHERE id=:id');
	$datebase->bind(':username', $_POST['user']);
	$datebase->bind(':email', $_POST['email']);
	$datebase->bind(':id', $_POST['user_id']);
	$datebase->execute();	
}