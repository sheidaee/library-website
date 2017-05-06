<?php
mb_internal_encoding('UTF-8');
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');
										
if(isset($_POST['key'])) {
	$database = new Database();
	if($_POST['key']==" ")
		$database->query('SELECT * FROM book WHERE active=1');				
	else
		$database->query('SELECT * FROM book WHERE  active=1 AND (title LIKE :key OR author LIKE :key)');			

	$key = $_POST['key'];
	$database->bind(":key", '%'.$key.'%');	
	$rows = $database->resultset();
	
  	foreach ($rows as $row) {
      	echo'<li class="span2 animated fadeInLeft">';
           echo	'<a href="' . SITE_URL . '/view.php?id=' . $row['id'] .'" class="thumbnail"> ';
         	echo	'<img src=" '.IMG_URL .'/thumbs/'. $row['image'].' " alt="'.$row['title'] .'"></a></li>';
	}       
}