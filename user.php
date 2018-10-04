<?php include("header.php");?>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>


<div class="posts">
<div class="post-box">
<h1><?php echo ucfirst($_SESSION['username']);?></h1>

<div id="page-menu">
<ul>
<?php if(isset($_SESSION['username'])){?>
   <li><a href="profile-<?php echo $Uid;?>-<?php echo $UsName;?>.html"><span>Profile</span></a></li>
   <li><a href="edit_profile.html"><span>Edit Profile</span></a></li>
   <li><a href="my_fatcs-<?php echo $Uid;?>-<?php echo $UsName;?>-1.html"><span>My Facts</span></a></li>
<?php

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