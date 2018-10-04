<?php include("header_fact.php");?>

<script>
$(window).resize(function(){
 $(".fb-comments").attr("data-width", $("#comments").width());
 FB.XFBML.parse($("#comments")[0]);
});
</script>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>

<?php

//Prv Link
if($Previous = $mysqli->query("SELECT * FROM facts WHERE active=1 and id>$id ORDER BY id ASC LIMIT 1")){
	$PrvRow = mysqli_fetch_array($Previous);
	$PrvCnt = $Previous->num_rows;
	
	$PrvName = $PrvRow['headline'];
	$PrvStr = strlen ($PrvName);
	if ($PrvStr > 50) {
	$PrvLg = substr($PrvName,0,50);
	}else{
	$PrvLg = $PrvName;}
		
	$Pid = $PrvRow['id'];
	$PrvLink = preg_replace("![^a-z0-9]+!i", "-", $PrvLg);
	$PrvLink = strtolower($PrvLink);

    $Previous->close();

}else{
	
     printf("Error: %s\n", $mysqli->error);
}

//Next Link

if($Next = $mysqli->query("SELECT * FROM facts WHERE active=1 and id<$id ORDER BY id DESC LIMIT 1")){
	$NextRow = mysqli_fetch_array($Next);
	$NextCnt = $Next->num_rows;
	
	$nxtName = $NextRow['headline'];
	$nxtStr = strlen ($nxtName);
	if ($nxtStr > 50) {
	$nxtLg = substr($nxtName,0,50);
	}else{
	$PrvLg = $nxtName;}
	
	$Nid = $NextRow['id'];
	$NextLink = preg_replace("![^a-z0-9]+!i", "-", $nxtName);
	$NextLink = strtolower($NextLink);
   
    $Next->close();

}else{
	
     printf("Error: %s\n", $mysqli->error);
}

//Get Category Info

if($PostCatSQL = $mysqli->query("SELECT * FROM categories WHERE id='$CatId'")){
	
	 $PostCatROW = mysqli_fetch_array($PostCatSQL);

		$PostCat = $PostCatROW['cname'];
		$PostCatURL  = preg_replace("![^a-z0-9]+!i", "-", $PostCat );
		$PostCatURL = urlencode($PostCatURL);
		$PostCatURLCut = strtolower($PostCatURL);
		
		$PostCatDisplayName = str_replace('&','&amp;',$PostCat );
			
	$PostCatSQL->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}
?>

<div id="post-nav">
<ul>
<?php if ($PrvCnt>0){?>
<li class="pn-left"><a href="fact-<?php echo $Pid;?>-<?php echo $PrvLink;?>.html">< Previous</a></li>
<?php }
if ($NextCnt>0){
?>
<li class="pn-right"><a href="fact-<?php echo $Nid;?>-<?php echo $NextLink;?>.html">Next ></a></li>
<?php }?>
</ul>
</div><!--post-nav-->

<div class="posts">
<div class="post-box">
<h1><?php echo $FactRow['headline'];?></h1>
<img class="post-img" src="timthumb.php?src=http://<?php echo $settings['siteurl'];?>/uploads/<?php echo $FactRow['image'];?>&amp;h=198&amp;w=300&amp;q=100" alt="<?php echo $FactRow['headline'];?>" class="img_thumb"/>

<p><?php echo $PostFact;?>.</p>

<?php if(!empty($Video)){ ?><div class="post-video"><?php echo $Video;?></div><?php }?>

<div class="bottom-bar"><a href="category-<?php echo $CatId;?>-<?php echo $PostCatURLCut;?>-1.html"><?php echo $PostCatDisplayName;?></a> <?php if(!empty($Source)){?><a href="<?php echo $Source;?>" target="_blank">|Source</a><?php }?>

<div class="fb-like" data-href="http://<?php echo $settings['siteurl'];?>/fact-<?php echo $FactRow['id'];?>-<?php echo $postLink;?>.html" data-width="100px" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

</div><!--bottom-bar-->
</div><!--post-box-->

<div class="share-box">
<div class="user-box">
<a href="profile-<?php echo $FactRow['uid'];?>-<?php echo $FactRow['username'];?>.html">
<img class="avatar" src="timthumb.php?src=<?php echo $profileImg;?>&amp;h=42&amp;w=42&amp;q=100" alt="<?php echo $FactRow['username'];?>"/>
<h3><?php echo $FactRow['username'];?></h3>
</a>
<p><abbr class="timeago" title="<?php echo $FactRow['date'];?>"></abbr></p>
</div><!--user-box-->

<div class="social-icons">
<a class="fb-button" href=""></a>
<a class="twitter-button" href=""></a>
<a class="gplus-button" href=""></a>
</div><!--social-icons-->

</div><!--share-box-->

</div><!--posts-->

<div class="left-title"><h1>Comments</h1></div>

<div id="comments">

<div class="fb-comments" data-href="http://<?php echo $settings['siteurl'];?>/fact-<?php echo $FactRow['id'];?>-<?php echo $postLink;?>.html" data-num-posts="6" data-width="630"></div>

</div><!--comments-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>