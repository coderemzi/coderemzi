<?php include("header.php");?>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>


<div class="posts">
<div class="post-box">
<h1>Search</h1>

<div class="theForm">
<form name="search" id="search-page" method="get" action="search.php">
<input type="text" tabindex="1" class="input" id="term" name="term" placeholder="Search Facts" />
<div class="div-btn">
<button type="submit" tabindex="2" id="search-page-button" class="form-buttons">Search</button>
</div>
</form>
</div><!-- theForm -->
</div><!--post-box-->
</div><!--posts-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>