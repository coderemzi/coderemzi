<?php include("header.php");?>

<script type="text/javascript" src="js/jquery.form.js"></script>

<script>
$(document).ready(function()
{
    $('#FromLogin').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        
        $(this).ajaxSubmit({
        target: '#output-login',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    //$('#FromLogin').resetForm();  // reset form
    $('#submitButton').removeAttr('disabled'); //enable submit button
    $('#loadding').html('');
}
</script>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>

<div class="posts">
<div class="post-box">
<h1>Login to Your Account</h1>

<div id="output-login">&nbsp;</div>

<div class="theForm">
<form action="submit_login.php" id="FromLogin" method="post">

<label>Username</label>
    <input type="text" name="username" id="username" />
    
<label>Password</label>
    <input type="password" name="password" id="password" />    
<div class="div-btn">
<button type="submit" class="form-buttons" id="submitButton">Login</button>
</div>
</form>
</div>
</div><!--post-box-->

</div><!--posts-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>