<?php include("header.php");?>

<section id="left">

<?php if (!empty($Ad3)){?> 
<div class="mobile-ads">
<?php echo $Ad3;?> 
</div><!--mobile-ads-->
<?php }?>

<?php
error_reporting(E_ALL ^ E_NOTICE);
// How many adjacent pages should be shown on each side?
	$adjacents = 5;
	
	$query = $mysqli->query("SELECT COUNT(*) as num FROM facts LEFT JOIN users ON users.uid=facts.user_id WHERE facts.user_id=users.uid and facts.active=1 ORDER BY facts.id DESC");
	
	$total_pages = mysqli_fetch_array($query);
	$total_pages = $total_pages['num'];
	
	$limit = 10; 								//how many items to show per page
	$page = $_GET['page'];
	 
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
 	/* Get data. */
	$result = $mysqli->query("SELECt * FROM facts LEFT JOIN users ON users.uid=facts.user_id WHERE facts.user_id=users.uid and facts.active=1 ORDER BY facts.id DESC LIMIT $start, $limit");
	 
	//$result = $mysqli->query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"index-$prev.html\">« previous</a>";
		else
			$pagination.= "<span class=\"disabled\">« previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"index-$counter.html\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"index-$counter.html\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"index-$lpm1.html\">$lpm1</a>";
				$pagination.= "<a href=\"index-$lastpage.html\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"index-1.html\">1</a>";
				$pagination.= "<a href=\"index-2.html\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"index-$counter.html\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"index-$lpm1.html\">$lpm1</a>";
				$pagination.= "<a href=\"index-$lastpage.html\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"index-1.html\">1</a>";
				$pagination.= "<a href=\"index-2.html\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"index-$counter.html\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"index-$next.html\">next »</a>";
		else
			$pagination.= "<span class=\"disabled\">next »</span>";
		$pagination.= "</div>\n";		
	}
	
	$q= $mysqli->query("SELECt * FROM facts LEFT JOIN users ON users.uid=facts.user_id WHERE facts.user_id=users.uid and facts.active=1 ORDER BY facts.id DESC LIMIT $start,$limit");

	$numr = mysqli_num_rows($q);
	if ($numr==0)
	{
	echo '<div class="posts"><div class="post-box"><div class="msg">There are no posts at the moment. Check back again soon!!</div></div></div>';
	}
	while($row=mysqli_fetch_assoc($q)){
		
		$postName = stripslashes($row['headline']);
		
		$headlineStr = strlen ($postName);
		if ($headlineStr > 50) {
		$headlineLg = substr($postName,0,50);
		}else{
		$headlineLg = $postName;}
		
		$postLink = preg_replace("![^a-z0-9]+!i", "-", $headlineLg);
		$postLink = urlencode($postLink);
		$postLink = strtolower($postLink);
		
		$long = nl2br(stripslashes($row['fact']));
		$strd = strlen ($long);
		if ($strd > 485) {
		$dlong = substr($long,0,485).'...';
		}else{
		$dlong = $long;}
		
		$Source = $row['source'];
		
		$userName = $row['username'];
		$userLink = urlencode($userName);
		$userLink = strtolower($userLink);
		
		$avatar = $row['avatar'];
		
		if(!empty($avatar)){
			$profileImg = 'http://'.$settings['siteurl'].'/avatars/'.$avatar;					
		}else{
			$profileImg = 'http://'.$settings['siteurl'].'/templates/'.$settings['template'].'/images/avatar.png';			
		}
?>

<div class="posts">
<div class="post-box">
<a href="fact-<?php echo $row['id'];?>-<?php echo $postLink;?>.html">
<h1><?php echo $row['headline'];?></h1>
</a>
<a href="fact-<?php echo $row['id'];?>-<?php echo $postLink;?>.html">
<img class="post-img" src="timthumb.php?src=http://<?php echo $settings['siteurl'];?>/uploads/<?php echo $row['image'];?>&amp;h=198&amp;w=300&amp;q=100" alt="<?php echo $row['headline'];?>" />
</a>

<p><?php echo $dlong;?>.</p>

<div class="bottom-bar"><a href="fact-<?php echo $row['id'];?>-<?php echo $postLink;?>.html">Read More</a> | <a href="fact-<?php echo $row['id'];?>-<?php echo $postLink;?>.html#comments">Comments</a> <?php if(!empty($Source)){?>| <a href="<?php echo $Source;?>" target="_blank">Source</a><?php }?>

<div class="fb-like" data-href="http://<?php echo $settings['siteurl'];?>/fact-<?php echo $row['id'];?>-<?php echo $postLink;?>.html" data-width="100px" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div>

</div><!--bottom-bar-->
</div><!--post-box-->

<div class="share-box">
<div class="user-box">
<a href="profile-<?php echo $row['uid'];?>-<?php echo $row['username'];?>.html">

<img class="avatar" src="timthumb.php?src=<?php echo $profileImg;?>&amp;h=42&amp;w=42&amp;q=100" alt="<?php echo $row['username'];?>"/>

<h3><?php echo $row['username'];?></h3>
</a>
<p><abbr class="timeago" title="<?php echo $row['date'];?>"></abbr></p>

</div><!--user-box-->

<div class="social-icons">
<a class="fb-button" href="javascript:void(0);" onclick="popup('http://www.facebook.com/share.php?u=http://<?php echo $settings['siteurl'];?>/fact-<?php echo $row['id'];?>-<?php echo $postLink;?>.html&amp;title=<?php echo urlencode(ucfirst($longTitle));?>')"></a>
<a class="twitter-button" href="javascript:void(0);" onclick="popup('http://twitter.com/home?status=<?php echo urlencode(ucfirst($longTitle));?>+http://<?php echo $settings['siteurl'];?>/fact-<?php echo $row['id'];?>-<?php echo $postLink;?>.html')"></a>
<a class="gplus-button" href="javascript:void(0);" onclick="popup('https://plus.google.com/share?url=http://<?php echo $settings['siteurl'];?>/fact-<?php echo $row['id'];?>-<?php echo $postLink;?>.html')"></a>
</div><!--social-icons-->

</div><!--share-box-->

</div><!--posts-->

<?php } ?>
		
<?php echo $pagination;?>

</section>


<section id="right">

<?php include("side_bar.php");?>

</section>

<?php include("footer.php");?>