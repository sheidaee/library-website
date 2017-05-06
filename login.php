<?php
mb_internal_encoding('UTF-8');
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');		
if(!empty($_SESSION['username']))
echo'<script>
					alert("شما قبلا وارد سایت شده اید");
					window.location.replace("'.SITE_URL.'");
			</script>';

if(isset($_POST['form_login']) && $_POST['form_login'] == "submitted")
{		
	$error = false;				
	if(empty($_POST['username']))
		$error = true;

	if(empty($_POST['password']))	
		$error = true;			

	if($error == false){					
		$datebase = new Database();			
		$datebase->query('SELECT * FROM users WHERE username = ? AND password = ? LIMIT 1');
		$datebase->bind(1, $_POST['username']);
		$datebase->bind(2, md5($_POST['password']));		
		$row = $datebase->resultset();
		if(!empty($row)){
			// libDump($row);
			$_SESSION['username'] = $row[0]['username'];
			echo'<script>
					alert("شما با موفقیت وارد سایت شدید");
					window.location.replace("'.SITE_URL.'");
			</script>';
		}else{
			echo'<script>
					alert("کاربری با مشخصات وارد شده یافت نشد");
					window.location.replace("'.SITE_URL.'");
			</script>';
		}
			
	}else{
		echo'<script>
					alert("لطفا تمامی فیلدها را پر نمایید");
					window.location.replace("'.SITE_URL.'");
			</script>';
	}
}		
?>