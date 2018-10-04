<div class="right-social">
<div class="right-title"><h1>Stay Connected</h1></div>
<div class="box">
<a class="social-buttons" id="facebook-button" href="<?php echo $settings['fbpage'];?>" target="_blank"></a>
<a class="social-buttons" id="twitter-button" href="<?php echo $settings['twitter'];?>" target="_blank"></a>
<a class="social-buttons" id="google-plus-button" href="<?php echo $settings['google_plus'];?>" target="_blank"></a>
<a class="social-buttons" id="rss-button" href="rss.html"></a>
</div><!--box-->
</div><!--right-box-->

<?php if(isset($_SESSION['username'])){?>
<div class="right-menu">
<div class="right-title"><h1><?php echo ucfirst($_SESSION['username']);?></h1></div>
<ul>
   <li><a href="profile-<?php echo $Uid;?>-<?php echo $UsName;?>.html"><span>Profile</span></a></li>
   <li><a href="edit_profile.html"><span>Edit Profile</span></a></li>
   <li><a href="my_fatcs-<?php echo $Uid;?>-<?php echo $UsName;?>-1.html"><span>My Facts</span></a></li>
</ul>
</div>
<?php }?>

<div class="right-menu">
<div class="right-title"><h1>Categories</h1></div>
<ul>
<?php
if($CatSql = $mysqli->query("SELECT id, cname FROM categories")){

    while($CatRow = mysqli_fetch_array($CatSql)){
		
		$CatName = $CatRow['cname'];
		$CatUrl = preg_replace("![^a-z0-9]+!i", "-", $CatName);
		$CatURl = urlencode($CatUrl);
		$CatUrl = strtolower($CatUrl);
		
		$CatDisplayName = str_replace('&','&amp;',$CatName);
		
?>
   <li><a href="category-<?php echo $CatRow['id'];?>-<?php echo $CatUrl;?>-1.html"><span><?php echo $CatDisplayName;?></span></a></li>
<?php

}

	$CatSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}
?> 
</ul>
</div>



<?php if (!empty($Ad1)){?> 
<div class="right-box">
<?php echo $Ad1;?> 
</div><!--right-box-->
<?php }?>

<?php if (!empty($fb)){?> 
<div class="right-box">
<div class="fb-like-box" data-href="<?php echo $fb;?>" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
</div><!--right-box-->
<?php }?>

<?php if (!empty($Ad2)){?> 
<div id="ads">
<?php echo $Ad2;?> 
</div><!--right-box-->
<?php }?>


