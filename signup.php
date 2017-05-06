<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

global $page;
$page = 'ثبت نام در سایت';
include('header.php');

if (isset($_POST['form_signup']) && $_POST['form_signup'] == "submitted") 
	{
		// libDump('ok');
		if(empty($_POST['user_login']))
			$errors[] = 'خطا: نام  کاربری خود را وارد کنید!';

		if(empty($_POST['user_pass']))	
			$errors[] = 'خطا: رمز عبور خود را وارد کنید!';

		if(empty($_POST['confrim_pass']))	
			$errors[] = 'خطا: رمز عبور خود را دوباره وارد کنید!';

		if($_POST['user_pass'] != $_POST['confrim_pass'])
			$errors[] = 'خطا: رمز عبور وارد شده یکسان نیستند!';

		if(!preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['user_email']))
			$errors[] = 'خطا: پست الکترونیکی وارد شده معتبر نیست!';

		if(empty($errors)) {	
			$database = new Database();											

			$datebase->query('SELECT * FROM users WHERE username = ?');
			$datebase->bind(1, $_POST['user_login']);
			$row = $datebase->single();
			if(!empty($row))
				$errors[] = 'خطا: این نام کاربری قبلا در سایت ثبت شده است.';				
			
			if(empty($errors)) {
				$database->query('INSERT INTO users VALUES (NULL,?, ?, ?)');
				$database->bind(1, $_POST['user_login']);
				$database->bind(2, md5($_POST['user_pass']));
				$database->bind(3, $_POST['user_email']);			
				$database->execute();
				if($database->lastInsertId() != 0)
					echo'<script>
							alert("شما با موفقیت در سایت ثبت نام شدید");
							window.location.replace("'.SITE_URL.'");
					</script>';
				else					
					echo'<script>
							alert("متاسفانه مشکلی در ثبت نام بوجود آمده است");
							window.location.replace("'.SITE_URL.'/signup.php");
					</script>';
			}
		}
	}
?>

<div class="container rtl">  	  
    <div class="book">      
			<?php if(isset($errors)):?>
				<ul class="unstyled color-red">
					<?php	foreach ($errors as $message):?>
						<li><?php echo $message; ?></li>
					<?php endforeach;?>
				</ul>
			<?php endif; ?>
			<form  name="add_user" id="form" action="signup.php" method="POST" >
				<table cellspacing="1" cellpadding="1" width="100%" class="add_new_adv">
					<tbody>
						<tr>
							<td width="20%" class="data">نام کاربری:</td>
							<td>
								<input type="text" name="user_login" maxlength="20" size="40"  dir="ltr" class="inputbox">								
							</td>
						</tr>																		
						<tr>
							<td class="data">رمز عبور:</td>
							<td>
								<input type="password" name="user_pass" id="user_pass" maxlength="15" size="40"  dir="ltr" class="inputbox">								
							</td>
						</tr>
						<tr>
							<td class="data">تکرار رمز عبور:</td>
							<td>
								<input type="password" name="confrim_pass" maxlength="15" size="40"  dir="ltr" class="inputbox">								
							</td>
						</tr>							
						<tr>
							<td class="data">پست الکترونیکی:</td>
							<td>
								<input type="text" name="user_email" maxlength="30" size="40"  dir="ltr" class="inputbox">								
							</td>
						</tr>							
						<tr>
							<td colspan="2">			
								<hr size="2" color="#660000">	
								<input type="hidden" name="form_signup" value="submitted" >
								<input type="submit" name="submit" value="ثبت نام" class="btn">
							</td>
						</tr>	
						</tbody>
					</table>
			</form>
    </div>  
</div>
<?php include('footer.php') ?>