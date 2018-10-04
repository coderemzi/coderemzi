<?php include("header.php");?>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>

<div class="posts">
<div class="post-box">
<h1>Contact Us</h1>

<div id="output-login"></div>
<div id="loadding"></div>

<script type="text/javascript" src="js/jquery.form.js"></script>

<script>
$(document).ready(function()
{
    $('#ContactUs').on('submit', function(e)
    {
        e.preventDefault();
        $('#SubmitButton').attr('disabled', ''); // disable upload button
        //show uploading message
        
        $(this).ajaxSubmit({
        target: '#output-login',
        success:  afterSuccess //call function after success
        });
    });
});
 
function afterSuccess()
{
    $('#SubmitButton').removeAttr('disabled'); //enable submit button
    $('#loadding').html('');
}
</script>

<div class="theForm">

<form action="send_contact.php" id="ContactUs" method="post">

<label>Name</label><input name="name" type="text">

<label>Email</label><input name="email" type="text">

<label>Subject</label><input name="subject" type="text">

<label>Message</label><textarea name="message"></textarea>

<div class="div-btn">
<button type="submit" class="form-buttons" id="SubmitButton">Send</button>
</div>

</form>

</div>


</div><!--posts-->

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>