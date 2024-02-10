<?php 
session_start();
   // MikeRSWeb Source code \\   |
  // Do not remove the Footer\\  |
    // Install before use \\     |
     // THIS IS COPYRIGHT \\     |
// MATERIAL DO !!NOT!! CHANGE \\ |
  include 'includes/connect.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><link rel="icon" type="image/x-icon" href="favicon.ico" /> 
<meta http-equiv="Content-Language" content="en-gb, English">
<link rel="icon" type="image/x-icon" href="favicon.ico" />
<meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming">
<meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">
<title>
<?php

  include 'includes/config.php';
 echo $title; ?>
 </title>
<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/global-5.css);/**/</style>

<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/home-2.css);/**/</style>
<script type="text/javascript">
 function h(o){o.getElementsByTagName('span')[0].className='shimHover';}
 function u(o){o.getElementsByTagName('span')[0].className='shim';}
</script>
<!-- Made by mikelmao -->
</head>
<body id="navhome">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div><img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="#" id="logo_select"></a>
<?php include 'includes/toptext.php' ?>
<div id="lang">
<a href="#"><img alt="English" src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>
</div>
<div id="headOrangeBottom"></div>
<div id="menubox">
<?php
include "includes/links.php";
?>
<br class="clear" />
</div>

</div>
<div id="content">
<?php 
if(check_intall_dir() == 1)
{
	echo "<font color='red' size='30px'>The install directorie exists, please delete it to remove this message.</font>";
}
?>
<div id="left">
<?php
if(!isset($_SESSION['user']))
{
?>
<a href="register.php" class="createbutton" onmouseover="h(this)" onmouseout="u(this)">
<img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/home/create.jpg" alt="Create a Free Account" />
<span class="shim"></span>
<?php
}
?>
</a>
<?php
 include 'includes/vars.php';
?>
<!--
**
**
**
**
**
**      edit vars.php to change this
**
**By Mikelmao and Halcyon
**
**
**
**
-->
<div id="features">
<div class="narrowHeader"><!--<img src="http://www.runescape.com/layout-<?//php echo $ln; ?>/img/main/titles/websitefeatures.png" alt="" />--><?php echo $main_title; ?></div>
<div class="section">
<div class="feature">
<img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/home/feature_kbsearch_icon.jpg" alt="" />
<?php
 include 'includes/vars.php';
?>
<div class="featureTitle"><?php echo $feature_title_1; ?></div>
<div class="featureDesc" style="padding: 2px 2px 0">
<?php echo $feature_content_1; ?>
</div>
</div>
<div class="feature">
<a href="#"><img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/home/feature_upgrade_icon.jpg" alt="" /></a>
<div class="featureTitle"><?php echo $feature_title_2; ?></div>
<div class="featureDesc">
<?php echo $feature_content_2; ?>
</div>
</div>
<div class="feature">

<a href="#" target="_blank">
<img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/home/feature_shop_icon.jpg" alt="" />
</a>
<div class="featureTitle"><?php echo $feature_title_3; ?></div>
<div class="featureDesc">
<?php echo $feature_content_3; ?>
</div>
</div>
<div class="feature">
<a href="#"><img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/home/feature_poll_icon.jpg" alt="" /></a>
<div class="featureTitle">Server Status</div>
<div class="featureDesc">
<?php
if(list($ip, $port) = mysql_fetch_row(mysql_query("SELECT ip, port FROM ".$prefix."config")))
$fp = @fsockopen($ip, $port, $errno, $errstr, 1);
if ($fp) {
    echo "<b style='color: green'>Server Online</b>";
} else {
    echo "<b style='color: red'>Server Offline</b>";
}

?>
</div>
</div>
</div>
</div>  
<div id="articles">
<!--<div class="narrowHeader"><img src="http://www.runescape.com/layout-<?php //echo $ln; ?>/img/main/titles/runescapearticles.png" alt="" />In Construction</div>-->
<div class="section">
<!--<div class="articlesBody">
<div class="articlesTitle"><img alt="Article of the Week" src="www.runescape.com/layout-<?php //echo $ln; ?>/img/main/home/aow_title.png" /></div>
<div class="aowBody"><div class="aowHeight">
<div class="aowImage"><a href="#"><img src="www.runescape.com/layout-<?php //echo $ln; ?>/img/main/icons/skills.jpg" alt=""></a></div>
<p class="aowTitle">Connect</p>
<p>You can connect threw the populair web client <a href='http://client.silabsoft.org/'>Silabsoft</a>. Its quick, Free, and easy!</p>
</div></div>
<div class="articlesTitle"><img alt="Recently Added Articles" src="www.runescape.com/layout-<?php //echo $ln; ?>/img/main/home/raa_title.png" /></div>
<div class="raaBody first">
<a href="#">
<img src="www.runescape.com/layout-<?php //echo $ln; ?>/img/main/icons/combat.jpg" alt="" /></a>
<p class="aowTitle">The IP</p>
<p>To view the ip of the server, Go to the <a href='info.php'>Server Info</a> page</p>
</div>
<div class="raaBody">
<a href="#">
<img src="www.runescape.com/layout-<?php //echo $ln; ?>/img/main/icons/randomevenets.jpg" alt="" /></a>
<p class="aowTitle">The maker of Runescape Community Software</p>
<p>To contact the Maker. Add Discord: </p>
</div>
<div class="raaBody">
<a href="#">
<img src="www.runescape.com/layout-<?php //echo $ln; ?>/img/main/icons/quests.jpg" alt="" /></a>
<p class="aowTitle">Joshua</p>
<p>Joshua is now part of the team since V4 (2009)</p>
</div>
</div>
<div class="articlesFooter"></div>-->
</div>
</div>
</div>
<div id="right">
<div id="latestcontent">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
<!--<img src="http://www.runescape.com/layout-<?//php echo $ln; ?>/img/main/titles/featurednews.png" alt="" />-->Featured News
</div>
</div>
</div>
</div>
<div class="section">
<div class='sectionBody'>
<div class='sectionHeight'>
<?php
if($news1 = mysql_query("SELECT * FROM ".$prefix."news WHERE important='1' ORDER BY id DESC LIMIT 1"))
if(mysql_num_rows($news1) > 0)
{
  while($n = mysql_fetch_array($news1))
  {
  $title1 = preg_replace('/[a-z]/ie', 'strtoupper($0);', stripslashes($n['title']), 1);
    $totalcomments = $n['comments'];
    
    print "<div class='newsTitle'><h3>" . $title1 . "</h3>";
    print "<span>" . date('d-m-Y H:i', strtotime($n['date'])) . "</span></div>";
    print "<a href='news.php?id=". $n['id'] ."'>
<div class='newsImage'>
<img src='www.runescape.com/Large/". $n['image'] .".jpg' alt=''/>
</div>
</a>";
$check_comments1 = mysql_query('SELECT COUNT(id) FROM '. $prefix .'comments WHERE news_id='. $n['id']) ;
$g = mysql_fetch_array($check_comments1);
    print "<div class='newsDesc'>
<p>". nl2br(stripslashes(bbcodes($n['small']))) ."</p><a href='news.php?id=". $n['id'] ."'>Read more...</a></p><br /><center>Comments (<b>". $g[0] ."</b>)</center>
</div>

";
  }
}

		?>
</div>
</div>
<br class='clear' />
</div></div>







<?php
if($news2 = mysql_query("SELECT * FROM ".$prefix."news WHERE important='0' ORDER BY id DESC LIMIT 0,3"))
if(mysql_num_rows($news2) > 0)
{
echo '<div id="recentnews"><div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
Recent News
</div>
</div>
</div>
</div><div class="section">';
  while($n = mysql_fetch_array($news2))
  {
  $check_comments2 = mysql_query('SELECT COUNT(id) FROM '. $prefix .'comments WHERE news_id='. $n['id']) ;
    $title2 = preg_replace('/[a-z]/ie', 'strtoupper($0);', stripslashes($n['title']), 1);
    $g = mysql_fetch_array($check_comments2);
    print "<div class='sectionBody first'>
<div class='recentNews'>
<div class='newsTitle'><h3>" . $title2 . "</h3>";
    print "<span>" . date('d-m-Y H:i', strtotime($n['date'])) . "</span></div>";
    print "<a href='news.php?id=". $n['id'] ."'>
<div class='newsIcon'>
<img src='www.runescape.com/news/". $n['image'] .".jpg' alt=''/>
</div>
</a>";
    print "
<p>". nl2br(stripslashes(bbcodes($n['small']))) ."</p><a href='news.php?id=". $n['id'] ."'>Read more...</a> - Comments (<b>". $g[0] ."</b>)

</div>

</div>";

  }
echo '</div></div>';
}
?>





<?php
if($news3 = mysql_query("SELECT * FROM ".$prefix."news WHERE important='0' ORDER BY id DESC LIMIT 3,3"))
if(mysql_num_rows($news3) > 0)
{
echo '<div id="morenews">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
More News
</div>
</div>
</div>
</div>
<div class="section">';
  while($n = mysql_fetch_array($news3))
  {
  $title3 = preg_replace('/[a-z]/ie', 'strtoupper($0);', stripslashes($n['title']), 1);
    print "<div class='sectionBody'>
<div class='more'>
<div class='moreTitle'>" . $title3 . "</div>";
    print "<div class='moreMore'><a href='news.php?id=". $n['id'] ."'>Read more...</a></div>";
        print "<div class='moreDate'>" . date('d-m-Y H:i', strtotime($n['date'])) . "</div></div></div>

";
        

  }
echo '<br class="clear" />

</div>
</div>';
}
?>



</div>
<div id="footer"><div class="contain"><div class="footerdesc">
This website and its contents are copyright &copy; 1999 - 2011 Jagex Ltd. <br />This website is powered by <a href="http://RunescapeCommunitySoftware.info">Runescape Community Software</a>.
</div><a class="jagexlink" href="http://www.jagex.com" target="_blank"><img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png" alt="Jagex" /></a></div></div>
</div>


<script type="text/javascript">
var gaJsHost=(("https:"==document.location.protocol)?"https://ssl.":"http://www.");
document.write(unescape("%3Cscript src='"+gaJsHost+"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker=_gat._getTracker("UA-2058817-2");
pageTracker._setDomainName("runescape.com");
pageTracker._initData();
pageTracker._trackPageview();
}catch(x){}
</script>

</body>
</html>
