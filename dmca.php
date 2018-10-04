<?php include("header.php");?>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>

<div class="posts">
<div class="post-box">
<h1>DMCA Policy</h1>

<?php
if($PageSql = $mysqli->query("SELECT * FROM  pages WHERE id='4'")){

    $PageRow = mysqli_fetch_array($PageSql);
	
?>

<div class="post-page"><p><?php echo $PageRow['page'];?></p></div><!--post-->

<?php	

    $PageSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}
?>



</div><!--posts-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>