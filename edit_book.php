<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

if($_SESSION['username']!='admin')	header('location:'.SITE_URL);

$database = new Database();											

if(isset($_POST['id'])) {
	$datebase->query('SELECT * FROM book WHERE id = ?');
	$datebase->bind(1, intval($_POST['id']));
	$row = $datebase->single();
	echo '<p id="title">'.$row['title'].'</p>';
	echo '<p id="author">'.$row['author'].'</p>';
	echo '<p id="year">'.$row['year'].'</p>';
}else {
	$datebase->query('UPDATE book SET title = :title , author = :author, year=:year WHERE id=:id');
	$datebase->bind(':title', $_POST['title']);
	$datebase->bind(':author', $_POST['author']);
	$datebase->bind(':year', $_POST['year']);
	$datebase->bind(':id', $_POST['book_id']);
	$datebase->execute();	
}