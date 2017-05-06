<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');

if($_SESSION['username']!='admin')	header('location:'.SITE_URL);

$datebase->query('SELECT * FROM book ORDER BY id ASC');
$rows = $datebase->resultset();

if(isset($_GET['id']) && isset($_GET['type'])) {
	intval($_GET['type']) == 0 ? $type = 1 : $type = 0;
	$datebase->query('UPDATE book SET active =? WHERE id=?');
	$datebase->bind(1, $type);	
	$datebase->bind(2, $_GET['id']);	
	$datebase->execute();	
	header("location:books.php");
}
global $page;
$page = 'مدیریت کتاب ها';
include('header.php');
$counter = 0;
?>

<div class="container rtl">  	  
    <div class="users">          		    		
		<form  name="edit_book" id="edit_book" class="hide" action="edit_book.php" method="POST">		
				<label class="inline">ویرایش:</label>
				<input type="text" name="title" maxlength="40" class="inputbox">
				<input type="text" name="author" maxlength="30" style="width: 150px;" class="inputbox">
				<input type="text" name="year" maxlength="30" style="width: 140px;" class="inputbox">
				<input type="hidden" name="id" id="book_id">
				<input type="submit" class="hide" />
		</form>
    		<table cellpadding="2" cellspacing="0" width="100%" class="users-table">
    			<tr align="center">
    				<td>ردیف</td>
    				<td>عنوان</td>
    				<td>نویسنده</td>
    				<td>تاریخ انتشار</td>
    				<td>وضعیت</td>
    				<td>عملیات</td>
    			</tr>
		<?php foreach ($rows as $row):$counter++;?>
				<tr align="center">
					<td><?php echo $counter ?></td>
					<td><?php echo $row['title'] ?></td>
					<td><?php echo $row['author'] ?></td>
					<td><?php echo $row['year'] ?></td>
					<td>
						<a href="<?php echo 'books.php?id='.$row['id'].'&type='.$row['active']; ?>">
							<?php echo ($row['active'] == 0) ?  'در انتظار تایید' : 'تایید شده'; ?>
						</a>
					</td>
					<td>
						<a href="javascript:;" title="ویرایش کتاب" id="<?php echo $row['id'] ?>">ویرایش</a>
						 | 
						 <a href="javascript:;" title="حذف کتاب" id="<?php echo $row['id'] ?>">حدف</a>
					</td>
				</tr>
		<?php endforeach;
			if($counter == 0):?>
			<tr><td colspan="6"><p style="text-align:center;padding:20px;">موردی جهت نمایش یافت نشد</p></td></tr>
		<?php endif;?>
		</table>
    </div>  
</div>
<?php include('footer.php') ?>