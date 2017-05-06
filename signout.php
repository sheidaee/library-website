<?php

	if(!function_exists('lib_title'))
		file_exists('config.php') ? include('config.php') 
				: @exit('Error: Connection file does not exists.');

	if(empty($_SESSION['username']))
		header('location:'.SITE_URL);
	
	$_SESSION = array();
	header('location:'.SITE_URL);
?>