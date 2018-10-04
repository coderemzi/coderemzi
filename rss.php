<?php
include('db.php');

if($SettingsSql = $mysqli->query("SELECT * FROM settings WHERE id='1'")){

    $settings = mysqli_fetch_array($SettingsSql);

    $SettingsSql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}

$SiteName = $settings['name'];
$SiteDisc = $settings['descrp'];
$SiteUrl = $settings['siteurl'];

header("Content-type: text/xml");


echo'<?xml version="1.0" encoding="utf-8"?>
<rss version="2.0">
<channel>
<title>'.$SiteName. ' - Latest Facts</title>
<link>http://'.$SiteUrl.'</link>
<description>'.$SiteDisc.'</description>
<language>en-us</language>';

if($Sql = $mysqli->query("SELECT * FROM facts WHERE active='1' ORDER BY id DESC LIMIT 10")){

while($Row = mysqli_fetch_array($Sql)){
$title=$Row['headline'];

$titlenew = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $title);
$date=$Row['date'];
$id = $Row['id'];
$imageName = $Row['image'];

$headlineStr = strlen ($title);
	if ($headlineStr > 50) {
$headlineLg = substr($title,0,50);
	}else{
$headlineLg = $title;}

$postLink = preg_replace("![^a-z0-9]+!i", "-", $headlineLg);
$postLink = strtolower($postLink);

$long = $Row['fact'];
	$strd = strlen ($long);
	if ($strd > 485) {
	$dlong = substr($long,0,485).'...';
	}else{
	$dlong = $long;}
	
$desLong = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $dlong);	

$link= 'http://'.$SiteUrl.'/picture-'.$id.'-'.$postLink.'.html';

$imgurl = 'http://'.$SiteUrl.'/uploads/'.$imageName;


echo '<item>
    <title>'.$titlenew.'</title>
    <link>'.$link.'</link>
	<guid>'.$link.'</guid>
    <description><![CDATA[ <a href="'.$link.'" rel="self"><img align="left" vspace="4" hspace="6" src="'.$imgurl.'" title="'.$titlenew.'" alt="'.$titlenew.'" width="200" /></a>]]> '.$desLong.'</description>
    <pubDate>'.$date.'</pubDate>
  </item>';
}

    $Sql->close();
	
}else{
    
	 printf("Error: %s\n", $mysqli->error);
}
echo "</channel></rss>";
?>