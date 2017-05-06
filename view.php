<?php
file_exists('config.php') ? include('config.php') 
			: @exit('Error: Connection file does not exists.');
			
$datebase->query('SELECT * FROM book WHERE id = ?');
$datebase->bind(1, intval($_GET['id']));
$row = $datebase->single();
if(($row['size'] /1024) >1)
	$size = round($row['size'] / 1024, 2) . ' MB';
else
	$size = $row['size'] . ' KB';
global $page;
$page = $row['title'];
include('header.php');
?>

<div class="container rtl">  	  
    <div class="book">      
		<ul class="span4 book-text">
			<li><p>عنوان کتاب: <?php echo $row['title']?></p></li>
			<li><p>نویسنده: <?php echo $row['author']?></p></li>
			<li><p>تاریخ انتشار : <?php echo $row['year']?></p></li>
			<li><p>حجم فایل: <?php echo $size;?></p></li>	
		</ul>
		<div class="span2 book-pic">
			<img src="<?php echo IMG_URL .'/thumbs/'. $row['image'] ?>" alt="<?php echo $row['title'] ?>">
		</div>     
		<div class="span6">
			<a href="<?php echo SITE_URL .'/books/'. $row['book'] ?>" class="btn btn-info span2 dl-book">دریافت</a>
		</div> 
    </div>  
</div>
<?php include('footer.php') ?>