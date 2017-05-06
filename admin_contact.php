<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

if($_SESSION['username']!='admin')	header('location:'.SITE_URL);

$datebase->query('SELECT * FROM contact ORDER BY id ASC');
$rows = $datebase->resultset();

global $page;
$page = 'صندوق پیام ها';
include('header.php');
$counter = 0;
?>

<div class="container rtl">  	  
    <div class="contact">          		    				
    		<table cellpadding="2" cellspacing="0" width="100%" class="users-table">
    			<tr align="center">
    				<td>ردیف</td>
    				<td>موضوع</td>
    				<td>متن پیام</td>
    				<td>نام فرستنده</td>
    				<td>ایمیل</td>    				
    				<td>عملیات</td>    				
    			</tr>
		<?php foreach ($rows as $row):$counter++;?>
				<tr align="center">
					<td><?php echo $counter ?></td>
					<td><?php echo $row['title'] ?></td>
					<td><?php echo $row['text'] ?></td>
					<td><?php echo $row['name'] ?></td>
					<td><?php echo $row['email'] ?></td>
					<td>						
						 <a href="del_contact.php?id=<?php echo $row['id'] ?>" onClick="cf=confirm('آيا نسبت به حذف پیام انتخابي مطمئن هستيد؟');if (cf)return true;return false;" title="حذف">حذف</a>
					</td>
				</tr>
			<?php endforeach;
				if($counter == 0):?>
				<tr><td colspan="6">
					<p style="text-align:center;padding:20px;">موردی جهت نمایش یافت نشد</p></td></tr>
		<?php endif;?>
		</table>
    </div>  
</div>
<?php include('footer.php') ?>