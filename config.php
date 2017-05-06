<?php
if (!isset($_SESSION)) 
{
	session_start();
	if(!isset($_SESSION['username']))
		$_SESSION['username'] = "";
}	
require 'JDate.php';
require 'functions.php';

// تنظیمات سایت
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'library');
define('SITE_URL','http://localhost/library');
define('SITE_NAME','وب سایت کتاب خانه');
define('IMG_URL',SITE_URL .'/img-books/');
//مسیر مستقیم تصاویر 
define('PATH_IMG', str_replace('//','/',dirname(__FILE__).'/') .'img-books/' );
//مسیر مستقیم تصاویر بندانگشتی 
define('PATH_THUMBS', str_replace('//','/',dirname(__FILE__).'/') .'img-books/thumbs/');
//مسیر مستقیم کتاب ها
define('PATH_BOOK', str_replace('//','/',dirname(__FILE__).'/') .'books/' );
define('FINAL_IMG_WIDTH', 170);
define('FINAL_IMG_HEIGHT', 230);
define('THUMBS_URL', SITE_URL .'/img-books/thumbs/');

global $database;
$datebase = new Database();

// error_reporting(0);
?>