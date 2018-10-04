<?php include("header.php");?>

<script type="text/javascript" src="js/jquery.form.js"></script>

<script>
$(document).ready(function()
{
    $('#FromRegister').on('submit', function(e)
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
    //$('#FromRegister').resetForm();  // reset form
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

<div id="output-login"></div>

<div class="theForm">
<form action="submit_user.php" id="FromRegister" method="post" >

    <label>Username
    <span class="small">Please enter your username</span>
    </label>
    <input type="text" name="uName" id="uName" />
    
     <label>Email
    <span class="small">Enter a valid email address</span>
    </label>
    <input type="text" name="uEmail" id="uEmail" />
    
     <label>Password
    <span class="small">Please provide a password</span>
    </label>
    <input type="password" name="uPassword" id="uPassword" />
    
     <label>Conform Password
    <span class="small">Retype the above password</span>
    </label>
    <input type="password" name="cPassword" id="cPassword" />
<div class="div-btn">   
    <button type="submit" class="form-buttons" id="submitButton">Register</button>
</div>    
    <div class="spacer"></div>
</form>
</div>
</div><!--post-box-->

</div><!--posts-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>