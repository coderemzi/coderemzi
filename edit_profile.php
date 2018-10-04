<?php include("header.php");?>

<script type="text/javascript" src="js/jquery.form.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/jquery.ui.datepicker.min.js"></script>
<link href="templates/<?php echo $settings['template'];?>/css/jquery.ui.all.css" rel="stylesheet" type="text/css">
<script>
$(function() {
$( "#birthday" ).datepicker({
changeMonth: true,
changeYear: true,
dateFormat: 'yy-mm-dd'
});
});
</script>



<section id="left">
<div class="left-title"><h1>Edit Your Profile</h1></div>

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }
 
if(!isset($_SESSION['username'])){?>
<div class="log-reg">Please <a href="login.html">login</a> or <a href="register.html">register</a> to use this section.</div>
<?php }else{

if($Profile = $mysqli->query("SELECT * FROM users WHERE uid='$Uid'")){

    $ProfileRow = mysqli_fetch_array($Profile);
	
	$Gender = $ProfileRow['gender'];
	
	$Profile->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}	
	
?>
<script type="text/javascript">
$(document).ready(function()
{
$('#photoimg').live('change', function()
{
$("#preview").html('');
$("#output-msg").html('<div class"loader"><img src="templates/<?php echo $settings['template'];?>/images/ajaxloader.gif" alt="Please Wait"/> <br/><span>Uploading...</span></div>');


$("#imageform").ajaxForm(
{
    dataType:'json',
    success:function(json){
       $('#preview').html(json.img);
       $('#output-msg').html(json.msg);
    }
}).submit();

});
});
</script>

<div class="posts">
<div class="post-box">

<div id="uploading"></div>
<div id="output-msg"></div>
<div class="theForm">

<form action="avatar.php" method="post" name="imageform" id="imageform" enctype="multipart/form-data">
   <label>Image <span class="small">(gif, jpg, png)</span></label>
   <input type="file" name="photoimg" id="photoimg" /><!-- end image label and input -->
</form><!-- end form -->

<div id="preview"></div>

</div>

</div><!--post-box-->

</div><!--posts-->

<div class="posts">
<div class="post-box">

<script>
$(document).ready(function()
{
    $('#FromProfile').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        //$("#div-loadding").html('<div class="loader"><img src="templates/<?php echo $settings['template'];?>/images/ajax-loader.gif" alt="Please Wait"/> <br/><span>Submiting...</span></div>');
        $(this).ajaxSubmit({
        target: '#output',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    //$('#FromProfile').resetForm();  // reset form
    $('#submitButton').removeAttr('disabled'); //enable submit button
    //$('#div-loadding').html('');
}
</script>

<div id="output"></div>

<div class="theForm">
<form action="submit_profile.php" id="FromProfile" method="post" >

	<label>Gender
    <span class="small">Select Your Gender</span>
    </label>
    <select name="sex" id="sex">
   	<?php if(!empty($Gender)){?>
    <option value="<?php echo $Gender;?>"><?php echo $Gender;?></option>
    <?php }?>
    <option disabled value="">Chose</option>
	<option value="Male">Male</option>
    <option value="Female">Female</option>
    </select>    

    <label>Nickname
    <span class="small">Cannot be changed</span>
    </label>
    <input type="text" disabled="disabled" name="uName" id="uName" value="<?php echo $ProfileRow['username'];?>" />
    
    <label>Birthday
    <span class="small">Click to select</span>
    </label>
    <input type="text" name="birthday" id="birthday" value="<?php echo $ProfileRow['birthday'];?>" />
    
     <label>Email
    <span class="small">Enter a valid email address</span>
    </label>
    <input type="text" name="uEmail" id="uEmail" value="<?php echo $ProfileRow['email'];?>"/>
    
     <label>Country
    <span class="small">Let us know your country</span>
    </label>
    <input type="text" name="country" id="country" value="<?php echo $ProfileRow['country'];?>"/>
    
    <label>About
    <span class="small">Tell us little bit about your self</span>
    </label>
    <textarea name="about" cols="40" rows="5"><?php echo $ProfileRow['about'];?></textarea>
   
<div class="div-btn">   
    <button type="submit" class="form-buttons" id="submitButton">Submit</button>
</div>    
</form>
</div> <!--the form-->

</div><!--post-box-->
</div><!--posts-->

<div class="posts">
<div class="post-box">

<script>
$(document).ready(function()
{
    $('#FromPassword').on('submit', function(e)
    {
        e.preventDefault();
        $('#submitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        //$("#load").html('<div class="loader"><img src="templates/<?php echo $settings['template'];?>/images/ajax-loader.gif" alt="Please Wait"/> <br/><span>Submiting...</span></div>');
        $(this).ajaxSubmit({
        target: '#outputmsg',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    //$('#FromPassword').resetForm();  // reset form
    $('#submitButton').removeAttr('disabled'); //enable submit button
    //$('#load').html('');
}
</script>
<div id="outputmsg"></div>
<div class="theForm">
<form action="submit_password.php" id="FromPassword" method="post" >

    <label>Old Password
    <span class="small">Please provide your old password</span>
    </label>
    <input type="password" name="nPassword" id="nPassword" />
    
     <label>New Password
    <span class="small">Please provide the new password</span>
    </label>
    <input type="password" name="uPassword" id="uPassword" />
    
     <label>Conform Password
    <span class="small">Retype the above password</span>
    </label>
    <input type="password" name="cPassword" id="cPassword" />
<div class="div-btn">   
    <button type="submit" class="form-buttons" id="submitButton">Submit</button>
</div>    

</form>
</div> <!--the form-->


</div><!--post-box-->

</div><!--posts-->


<?php }?>
</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>