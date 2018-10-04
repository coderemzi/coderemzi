<?php include("header.php");?>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>

<script type="text/javascript" src="js/jquery.form.js"></script>
<script>
$(document).ready(function()
{
    $('#FileUploader').on('submit', function(e)
    {
        e.preventDefault();
        $('#uploadButton').attr('disabled', ''); // disable upload button
        //show uploading message
        $("#output-login").html('<div class="redirecting">Submitting.. Please wait..</div>');
		
        $(this).ajaxSubmit({
        target: '#output-login',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{	
	 
    $('#uploadButton').removeAttr('disabled'); //enable submit button
   
}
</script>

<div class="posts">
<div class="post-box">
<h1>Submit a New Fact</h1>

<?php 
if(!isset($_SESSION['username'])){?>
<div class="log-reg">Please <a href="login.html">login</a> or <a href="register.html">register</a> to submit your post.</div>
<?php }else{ ?>

<div id="output-login"></div>

<div class="theForm">
  <form action="submit_post.php" id="FileUploader" enctype="multipart/form-data" method="post" >
  
    <label for="catagory-select">Catagory</label>
    <select name="catagory-select" id="catagory-select">
      <option value="">Select a Category</option>
      <?php
if($CatSelect = $mysqli->query("SELECT id, cname FROM categories")){

    while($CatsRow = mysqli_fetch_array($CatSelect)){
				
?>
      <option value="<?php echo $CatsRow['id'];?>"><?php echo $CatsRow['cname'];?></option>
      <?php

}

	$CatSelect->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}
?>
    </select>
    
    <label>Headline</label>
    <input type="text" name="Headline" id="Headline" />
    
    <label>Add an Image to your Fact</label>
    <input type="file" name="mFile" id="mFile" />
    
    <label>YouTube URL (optional)</label>
    <input type="text" name="yTube" id="yTube" />
    
    <label>Your Fact</label>
    <textarea name="fact" id="fact" rows="10" cols="50"></textarea> 
    
    <label>Source URL (optional)</label>
    <input type="text" name="source" id="source" />
    
    <div class="div-btn">
      <button type="submit" class="form-buttons" id="uploadButton">Submit</button>
    </div>
  </form>
</div><!-- theForm -->

<?php }?>

</div>
</div><!--posts-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>