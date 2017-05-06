<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

global $page;
$page = 'تماس با ما';
include('header.php');

if (isset($_POST['form_contact']) && $_POST['form_contact'] == "submitted") 
	{
	
		if(empty($_POST['title']))
			$errors[] = 'خطا: لطفا موضوع پیام خود را وارد کنید!';
		
		if(empty($_POST['name']))
			$errors[] = 'خطا: لطفا نام  خود را وارد کنید!';
		
		if(empty($_POST['text']))	
			$errors[] = 'خطا: لطفا متن پیام خود را وارد کنید!';	

		if(!preg_match("/^[\.A-z0-9_\-\+]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $_POST['email']))
			$errors[] = 'خطا: پست الکترونیکی وارد شده معتبر نیست!';

		if(empty($errors)) {	
			$database = new Database();														
						
			$database->query('INSERT INTO contact VALUES (NULL,?, ?, ?, ?)');
			$database->bind(1, $_POST['title']);
			$database->bind(2, $_POST['name']);
			$database->bind(3, $_POST['email']);
			$database->bind(4, $_POST['text']);			
			$database->execute();
			if($database->lastInsertId() != 0)
				echo'<script>
						alert("پیام شما با موفقیت ارسال شد");
						window.location.replace("'.SITE_URL.'");
				</script>';
			else				
				echo'<script>
						alert("متاسفانه مشکلی در ارسال پیام بوجود آمده است");
						window.location.replace("'.SITE_URL.'/contact.php");
				</script>';		
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
			<form  name="contact" id="form" action="contact.php" method="POST" >
				<table cellspacing="1" cellpadding="1" width="100%">
					<tbody>
						<tr>
							<td width="25%" class="data">موضوع:</td>
							<td>
								<input type="text" name="title" maxlength="20" size="40" class="inputbox">								
							</td>
						</tr>																		
						<tr>
							<td class="data">نام و نام خانوادگی شما:</td>
							<td>
								<input type="text" name="name" maxlength="20" size="40" class="inputbox">								
							</td>
						</tr>																		
						<tr>
							<td class="data">پست الکترونیکی:</td>
							<td>
								<input type="text" name="email" maxlength="30" size="40"  dir="ltr" class="inputbox">								
							</td>
						</tr>							
						<tr>
							<td class="data">متن پیام:</td>
							<td>
								<textarea name="text" rows="6" style="width:80%;"></textarea> 
							</td>
						</tr>							
						<tr>
							<td colspan="2">			
								<hr size="2" color="#660000">	
								<input type="hidden" name="form_contact" value="submitted" >
								<input type="submit" name="submit" value="ارسال" class="btn">
							</td>
						</tr>	
					</tbody>
				</table>
			</form>
    </div>  
</div>
<?php include('footer.php') ?>