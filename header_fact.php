<?php session_start();
include('db.php');

if($squ = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($squ);
	
	$template = $settings['template'];
	
	$fb = $settings['fbpage'];
	
	$squ->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

//User Info

if(!isset($_SESSION['username'])){
	
	$Uid = 0;

}else{
	
$Uname = $_SESSION['username'];

if($UserSql = $mysqli->query("SELECT * FROM users WHERE username='$Uname'")){

    $UserRow = mysqli_fetch_array($UserSql);
	
	$UsName = strtolower($UserRow['username']);

	$Uid = $UserRow['uid'];
	
	$UserEmail = $UserRow['email'];
	
	$Uavatar = $UserRow['avatar'];

    $UserSql->close();
	
}else{
     
	 printf("Error: %s\n", $mysqli->error);
	 
}

}

//Ads

if($AdsSql = $mysqli->query("SELECT * FROM siteads WHERE id='1'")){

    $AdsRow = mysqli_fetch_array($AdsSql);
	
	$Ad1 = $AdsRow['ad1'];
	$Ad2 = $AdsRow['ad2'];
	$Ad3 = $AdsRow['ad3'];

    $AdsSql->close();

}else{
	
     printf("Error: %s\n", $mysqli->error);
}

// Post Data

$id = $_GET['id'];


if($Fact = $mysqli->query("SELECt * FROM facts LEFT JOIN users ON users.uid=facts.user_id WHERE facts.user_id=users.uid and facts.id='$id' LIMIT 1")){

    $FactRow = mysqli_fetch_array($Fact);
	
	$postName = stripslashes($FactRow['headline']);
		
		$headlineStr = strlen($postName);
		if ($headlineStr > 50) {
		$headlineLg = substr($postName,0,50);
		}else{
		$headlineLg = $postName;}
		
		$PostFact = stripslashes(nl2br($FactRow['fact']));
		
		$long = stripslashes($FactRow['fact']);
		$strd = strlen ($long);
		if ($strd > 255) {
		$dlong = substr($long,0,255).'...';
		}else{
		$dlong = $long;}
		
		$postLink = preg_replace("![^a-z0-9]+!i", "-", $headlineLg);
		$postLink = urlencode($postLink);
		$postLink = strtolower($postLink);
	
		$Source = $FactRow['source'];
		$Video = $FactRow['video'];
		
		$CatId = $FactRow['catagory_id'];
	
		$avatar = $FactRow['avatar'];
		
		if(!empty($avatar)){
			$profileImg = 'http://'.$settings['siteurl'].'/avatars/'.$avatar;					
		}else{
			$profileImg = 'http://'.$settings['siteurl'].'/templates/'.$settings['template'].'/images/avatar.png';			
		}


$Fact->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
	 
}

//Update Views

$PostViews = $mysqli->query("UPDATE facts SET views=views+1 WHERE id='$id'");

$UpdateSiteViews = $mysqli->query("UPDATE settings SET site_hits=site_hits+1 WHERE id=1");

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">

<title><?php echo $postName;?> | <?php echo $settings['name'];?></title>
<meta name="description" content="<?php echo strip_tags($dlong);?>" />
<meta name="keywords" content="<?php echo $settings['keywords'];?>" />
<meta name="viewport" content="width=device-width,initial-scale=1.0">

    <link rel="apple-touch-icon" href="images/touch-icon-iphone.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/touch-icon-ipad.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/touch-icon-iphone4.png">
	<link rel="apple-touch-icon" sizes="144x144" href="images/touch-icon-ipad2.png">

	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!--Facebook Meta Tags-->
<meta property="fb:app_id"          content="<?php echo $settings['fbapp']; ?>" /> 
<meta property="og:url"             content="http://<?php echo $settings['siteurl'];?>/fact-<?php echo $FactRow['id'];?>-<?php echo $postLink;?>.html" /> 
<meta property="og:title"           content="<?php echo $postName;?> | <?php echo $settings['name'];?>" />
<meta property="og:description" 	content="<?php echo $settings['descrp'];?>" />
<meta property="og:image"           content="http://<?php echo $settings['siteurl'];?>/uploads/<?php echo $FactRow['image'];?>" /> 
<!--End Facebook Meta Tags-->

<link href="favicon.ico" rel="shortcut icon" type="image/x-icon"/>

<link href="templates/<?php echo $settings['template'];?>/css/style.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

  <script src="js/jquery.min.js"></script>	
  <script src="js/jquery.fitvids.js"></script>
  <script src="js/jquery.timeago.js" type="text/javascript"></script>
  <script type="application/javascript" src="js/add2home.js" charset="utf-8"></script>
      <script>
        // Basic FitVids Test
        $("#container").fitVids();
        // Custom selector and No-Double-Wrapping Prevention Test
        $("#container").fitVids({ customSelector: "iframe[src^='http://socialcam.com']"});
		
		jQuery(document).ready(function() {
  		jQuery("abbr.timeago").timeago();
		});
							
		$(function() {
			var pull 		= $('#pull');
				menu 		= $('nav ul');
				menuHeight	= menu.height();

			$(pull).on('click', function(e) {
				e.preventDefault();
				menu.slideToggle();
			});

			$(window).resize(function(){
        		var w = $(window).width();
        		if(w > 320 && menu.is(':hidden')) {
        			menu.removeAttr('style');
        		}
    		});
		});
		
function popup(e){var t=700;var n=400;var r=(screen.width-t)/2;var i=(screen.height-n)/2;var s="width="+t+", height="+n;s+=", top="+i+", left="+r;s+=", directories=no";s+=", location=no";s+=", menubar=no";s+=", resizable=no";s+=", scrollbars=no";s+=", status=no";s+=", toolbar=no";newwin=window.open(e,"windowname5",s);if(window.focus){newwin.focus()}return false}
</script>

</head>

<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=196505667225847&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header id="main-header">
<div id="top-header">
<div class="top-center">

<div id="logo"><a href="index.html"><img src="images/logo.png" width="180" alt="<?php echo $settings['name'];?>"></a></div><!--logo-->

<div id="search-box">

<form name="search" id="search" method="get" action="search.php">
<input type="text" tabindex="1" class="input" id="term" name="term" placeholder="Search Facts" />

<input type="submit" tabindex="2" id="search-button" class="sButton" value="Search" />
</form>
</div>

</div><!--top-center-->
</div><!--top-header-->

	<nav class="clearfix">
		<ul class="clearfix">
			<li><a href="index.html">Home</a></li>
			<li><a href="top.html">Top</a></li>
            
<?php if($RandomPosts = $mysqli->query("SELECT * FROM facts WHERE active=1 and id >= Round(  Rand() * ( SELECT Max( id ) FROM facts)) LIMIT 1;")){

    while($RandomRow = mysqli_fetch_array($RandomPosts)){
		
		$randName = $RandomRow['headline'];
		$randStr = strlen ($randName);
		if ($randStr > 50) {
		$randLg = substr($randName,0,50);
		}else{
		$randLg = $randName;}
		
		$randLink = preg_replace("![^a-z0-9]+!i", "-", $randLg);
		$randLink = urlencode($randLink);
		$randLink = strtolower($randLink);		
		
?>            
			<li><a href="fact-<?php echo $RandomRow['id'];?>-<?php echo $randLink;?>.html">Random</a></li>
<?php } }else{
	
     	printf("Error: %s\n", $mysqli->error);

		} ?>            
            
			<li><a href="submit.html">Submit</a></li>
 <?php if(!isset($_SESSION['username'])){?>           
            <li class="user"><a href="register.html">Register</a></li>
			<li class="user"><a href="login.html">Login</a></li>
<?php }else{ ?>
			<li class="hidden"><a href="user.html">User</a></li>            
            <li class="user"><a href="logout.html">Logout</a></li>
<?php }?>    
            <li class="hidden"><a href="category_page.html">Categories</a></li>
            <li class="hidden"><a href="search_page.html">Search</a></li>
            <li class="hidden button"><a href="site_page.html">Site</a></li>
		</ul>
		<a href="#" id="pull">Menu</a>
	</nav>

</header><!--main-header-->

<div id="container">