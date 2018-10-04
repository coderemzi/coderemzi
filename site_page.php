<?php include("header.php");?>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>


<div class="posts">
<div class="post-box">
<h1>Site Links</h1>

<div id="page-menu">
<ul>

   <li><a href="about_us.html"><span>About Us</span></a></li>
   <li><a href="privacy_policy.html"><span>Privacy Policy</span></a></li>
   <li><a href="tos.html"><span>Terms of Use</span></a></li>
   <li><a href="dmca.html"><span>DMCA Policy</span></a></li>
   <li><a href="contact_us.html"><span>Contact Us</span></a></li>
</ul>

</div><!--page-menu-->

<div class="box">
<a class="social-buttons" id="facebook-button" href="<?php echo $settings['fbpage'];?>" target="_blank"></a>
<a class="social-buttons" id="twitter-button" href="<?php echo $settings['twitter'];?>" target="_blank"></a>
<a class="social-buttons" id="google-plus-button" href="<?php echo $settings['google_plus'];?>" target="_blank"></a>
<a class="social-buttons" id="rss-button" href="rss.html"></a>
</div><!--box-->

</div><!--post-box-->
</div><!--posts-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>