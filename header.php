<?php
if(!function_exists('lib_title'))
	file_exists('config.php') ? include('config.php') 
				: @exit('Error: Connection file does not exists.');
?>
<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="utf-8">
<title><?php echo lib_title(); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/animate.css" rel="stylesheet">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/library.css">
<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<![endif]-->
</head>

<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> 
	<form class="navbar-search" id="navbar-search">
          <input type="text" class="search-library rtl" id="search-library" placeholder="جستجوی کتاب...">
     </form>
     <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> 
	     	<span class="icon-bar"></span> 
	     	<span class="icon-bar"></span> 
	     	<span class="icon-bar"></span> 
     </a>   
      <div class="nav-collapse collapse pull-right rtl">       
	      <ul class="nav">
	      	<?php if($_SESSION['username'] !='admin'): ?>
	      		<li class="dropdown"><a href="contact.php" class="muted bold">تماس با ما</a></li>
	      	<?php endif;
	      	if(empty($_SESSION['username'])): ?>
	          <li><a href="signup.php" class="muted bold">ثبت نام در سایت</a></li>
	      	<li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-user icon-white"></i> ورود به سایت <b class="caret"></b> </a>
	           	<ul class="dropdown-menu">
	              		<li><form  method="post" action="login.php">
	              			<input type="text" name="username" placeholder="نام کاربری">
	              			<input type="password" name="password" placeholder="رمز عبور">
	              		</li>	              	
	              		<li class="divider"></li>
	              		<li>
						<input type="hidden" name="form_login" value="submitted">
	              			<input type="submit" class="btn" value="ورود"></form>
	              		</li>
	            	</ul>
	          </li>	          
	          <?php
	          endif;
          		if(!empty($_SESSION['username'])): ?>
          			<li><a href="signout.php" class="muted bold">خروج از سایت</a></li>
	          		<li><a href="add_new.php" class="muted bold">افزودن کتاب</a></li>
				<?php if($_SESSION['username'] == 'admin'): ?>	          		
	          		<li class="dropdown"> <a data-toggle="dropdown" class="dropdown-toggle" href="#"> <i class="icon-user icon-white"></i> مدیریت سایت <b class="caret"></b> </a>
		            <ul class="dropdown-menu">
		              <li><a href="users.php">مدیریت کاربران</a></li>
		              <li><a href="books.php">مدیریت کتاب ها</a></li>
		              <li><a href="admin_contact.php">صندوق پیام ها</a></li>		              
		            </ul>
		          </li>
		          <?php endif;
	          endif;?>								
	          <li><a href="<?php echo SITE_URL; ?>" class="muted bold">صفحه اصلی</a></li>
	       </ul> 
        
      </div>
      <!--/.nav-collapse --> 
      
    </div>
    <!-- /container --> 
    
  </div>
  <!-- /navbar-inner --> 
  
</div>