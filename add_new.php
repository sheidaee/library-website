<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

//در صورت لاگین نکردن کاربر اجازه ثبت کتاب داده نمی شود
if(empty($_SESSION['username'])) header('location:'.SITE_URL);

global $page;
$page = 'افزودن کتاب';
include('header.php');

if ( (isset($_POST['form_new'])) && ($_POST['form_new'] == "submitted"))
{	
	if(empty($_POST['title']))
		$errors[] = 'خطا: لطفا عنوان کتاب را وارد کنید';

	if(empty($_POST['author']))
		$errors[] = 'خطا: لطفا نویسنده کتاب را وارد کنید';

	if(empty($_POST['date']))
		$errors[] = 'خطا: لطفا تاریخ انتشار کتاب را وارد کنید';

	if(empty($_FILES['book']))
		$errors[] = 'خطا: لطفا فایل کتاب را وارد کنید';

	if(empty($_FILES['pic']))
		$errors[] = 'خطا: لطفا تصویر کتاب را وارد کنید';

	if(empty($errors))
	{
		
		if($_FILES['book']['type'] != 'application/pdf')
				$errors[] = 'خطا: پسوند کتاب انتخاب شده مجاز نیست';
		if($_FILES['pic']['type'] != 'image/jpeg' && $_FILES['pic']['type'] != 'image/gif')
				$errors[] = 'خطا: پسوند تصویر انتخاب شده مجاز نیست';
		
		if(empty($errors))
		{
			//upload image
			$ext_img = strstr($_FILES['pic']['name'], '.');
			$filename_img = strtolower(time().'book'.$ext_img);
			$target_img = PATH_IMG . $filename_img;  
			$source_img = $_FILES['pic']['tmp_name'];     

			move_uploaded_file($source_img, $target_img);  
			createThumbnail($filename_img);

			//upload book
			$ext_book = strstr($_FILES['book']['name'], '.');
			$filename_book = strtolower(time().'book'.$ext_book);
			$target_book = PATH_BOOK . $filename_book;  
			$source_book = $_FILES['book']['tmp_name'];     

			move_uploaded_file($source_book, $target_book);  
			
			$database = new Database();		
			$database->query('INSERT INTO book VALUES(NULL, ?, ?, ?, ?, ?, ?,0)');
			$database->bind(1, $_POST['title']);		
			$database->bind(2, $_POST['author']);
			$database->bind(3, $_POST['date']);
			$database->bind(4, round($_FILES['book']['size']/1024, 2));
			$database->bind(5, $filename_img);
			$database->bind(6, $filename_book);
			$database->execute();
			if($database->lastInsertId() != 0)
					echo'<script>
							alert("عمل ثبت با موفقیت انجام شد و در انتظار تایید قرار گرفت.");
							window.location.replace("'.SITE_URL.'");
					</script>';
				else					
					echo'<script>
							alert("متاسفانه مشکلی در ثبت بوجود آمده است");
							window.location.replace("'.SITE_URL.'/add_new.php");
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
		<form  name="add_adv" id="form" action="add_new.php" method="POST" enctype="multipart/form-data">
			<table cellspacing="1" cellpadding="1" width="100%">
				<tbody>			
					<tr>
						<td class="data">عنوان:</td>
						<td>
							<input type="text" name="title" maxlength="40" size="49" class="form-poshytip inputbox">
							<span class="color-red">*</span>
						</td>
					</tr>
					<tr>
						<td class="data">نویسنده:</td>
						<td>
							<input type="text" name="author" maxlength="40" size="49" class="form-poshytip inputbox">
							<span class="color-red">*</span>
						</td>
					</tr>
					<tr>
						<td class="data">تاریخ انتشار:</td>
						<td>
							<input type="text" name="date" maxlength="40" size="49" class="form-poshytip inputbox">
							<span class="color-red">*</span>
						</td>
					</tr>			
					<tr>
						<td class="data">فایل کتاب:</td>
						<td >
							<input type="file" name="book" size="40" class="inputbox">
						</td>
					</tr>					
					<tr>
						<td class="data">تصوير جلد کتاب:</td>
						<td >
							<input type="file" name="pic" size="40" class="inputbox">
						</td>
					</tr>					
					<tr>
						<td colspan="2">
							<span class="colored-title">تنها فايلهاي با پسوند JPG ,GIF,PDF قابل قبول مي باشند.</span>
						</td>
					</tr>	
					<tr>
						<td colspan="2">			
							<hr size="2" color="#660000">		
							<input type="hidden" name="form_new" value="submitted" >
							<input type="submit" name="submit" value="ارسال" class="btn">
						</td>
					</tr>
					</tbody>	
				</table>
		</form>
  </div>  
</div>
<?php include('footer.php') ?>		