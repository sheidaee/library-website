<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

if($_SESSION['username']!='admin')	header('location:'.SITE_URL);

$datebase->query('SELECT * FROM users ORDER BY id ASC');
$rows = $datebase->resultset();

global $page;
$page = 'مدیریت کاربران';
include('header.php');
$counter = 0;
?>

<div class="container rtl">  	  
    <div class="users">          		    		
		<form  name="edit_user" id="edit_user" class="hide" action="edit_user.php" method="POST">		
				<label class="inline">ویرایش کاربر:</label>
				<input type="text" name="user_login" maxlength="20" size="40"  dir="ltr" class="inputbox">
				<input type="text" name="user_email" maxlength="30" size="40"  dir="ltr" class="inputbox">
				<input type="hidden" name="id" id="user_id">
				<input type="submit" class="hide" />
		</form>
    		<table cellpadding="2" cellspacing="0" width="100%" class="users-table">
    			<tr align="center">
    				<td>ردیف</td>
    				<td>نام کاربری</td>
    				<td>آدرس ایمیل</td>
    				<td>عملیات</td>
    			</tr>
		<?php foreach ($rows as $row):$counter++;?>
				<tr align="center">
					<td><?php echo $counter ?></td>
					<td><?php echo $row['username'] ?></td>
					<td><?php echo $row['email'] ?></td>
					<td>
						<a href="javascript:;" title="ویرایش کاربر" id="<?php echo $row['id'] ?>">ویرایش</a>
						 | 
						 <a href="javascript:;" title="حذف کاربر" id="<?php echo $row['id'] ?>">حذف</a>
					</td>
				</tr>
		<?php endforeach;?>
		</table>
    </div>  
</div>
<?php include('footer.php') ?>