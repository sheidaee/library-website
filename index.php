<?php
include('header.php');
$datebase->query('SELECT * FROM book WHERE active=1');
$rows = $datebase->resultset();
$counter = 0;
?>
<div class="container rtl">  	
  <div class="row">
    <div class="span12" id="index-books">      
      <ul class="thumbnails estante" id="list-books">
      	<?php foreach ($rows as $row):$counter++;?>
	      	<li class="span2 animated fadeInLeft">
	           	<a href="<?php echo SITE_URL .'/view.php?id='. $row['id'] ?>" class="thumbnail"> 
	         			<img src="<?php echo IMG_URL .'/thumbs/'. $row['image'] ?>" alt="<?php echo $row['title'] ?>">
	         		</a> 
	         	</li>
         <?php endforeach;?>
       </ul>
	<?php 	if($counter == 0):?>
		<p style="text-align:center;padding:20px;">موردی جهت نمایش یافت نشد</p>
	<?php endif;?>      
    </div><!-- end index-books -->
  </div><!-- end row -->
</div>
<?php include('footer.php') ?>