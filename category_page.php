<?php include("header.php");?>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>

<div class="posts">
<div class="post-box">
<h1>Categories</h1>

<div id="page-menu">
<ul>
<?php
if($CaPage = $mysqli->query("SELECT id, cname FROM categories")){

    while($CatPageRow = mysqli_fetch_array($CaPage)){
		
		$CatPageName = $CatPageRow['cname'];
		$CatPageUrl = preg_replace("![^a-z0-9]+!i", "-", $CatPageName);
		$CatPageUrl = urlencode($CatPageUrl);
		$CatPageUrl = strtolower($CatPageUrl);
		
		$CatDisplayName = str_replace('&','&amp;',$CatPageName);
		
?>
   <li><a href="category-<?php echo $CatPageRow['id'];?>-<?php echo $CatPageUrl;?>-1.html"><span><?php echo $CatDisplayName;?></span></a></li>
<?php

}

	$CaPage->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}
?> 
</ul>

</div><!--page-menu-->
</div><!--post-box-->
</div><!--posts-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>