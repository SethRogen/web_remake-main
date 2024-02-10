<?php
session_start();
include "../includes/connect.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><link rel="icon" type="image/x-icon" href="favicon.ico" /> 
<meta http-equiv="Content-Language" content="
en, 
English
" />
<meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming">
<meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">
<title><?php
       	include "../includes/config.php";
       	echo $title;
       ?></title>
<style type="text/css">/*\*/@import url(../www.runescape.com/layout-<?php echo $ln; ?>/css/global-10.css);/**/</style>

<style type="text/css">/*\*/@import url(../www.runescape.com/layout-<?php echo $ln; ?>/css/loginapplet-2.css);/**/</style>
</head>
<body id="navlogin">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="index.php" id="logo_select"></a>
<?php include '../includes/toptext_forum_and_acp.php' ?>

<div id="lang">
<a href="#"><img alt="English" src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>
</div>
<div id="headOrangeBottom"></div>
<div id="menubox">
<?php
include "../includes/acp_links.php";
?>
<br class="clear" />
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;

Add News
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
Add News

</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">

<div id="inner_brown_background_login" class="inner_brown_background">
<div id="brown_box_login" class="brown_box">
<div class="subsectionHeader" style="width:100%;">
Add News
</div>
<div id="inner_brown_box_login" class="inner_brown_box">

<div class="hideme_wrapper">
<?php
 if(isset($_SESSION['admin'])){
  
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if( $_POST['name'] == "")
    {
    echo "You have left 1 or more boxes empty!";
    }
    else
    {
    mysql_query("INSERT INTO ". $prefix ."links (name, link) VALUES ('". realEscape($_POST['name']) ."', '". realEscape($_POST['link']) ."')");
    }
    echo "You have successfully added a link. Please go to <a href='addlink.php'>Add link page</a><br> to Add another link!";
  }
  
  else
  {
  
?>
<br /><br />
<form action="addlink.php" method="post">
<div class="section_form">
<span style="float: left">Link Name:</span>
<input style="" class="input" size="20" type="text" name="name" maxlength="30">

<br class="clear">
</div>
<div class="section_form">
<span style="float: left">Link (To make it direct to another site, Add http://):</span>    
<input style="" class="input" size="20" type="text" name="link" maxlength="30">
<br class="clear">
</div>
<div class="section_form">
<input type="submit" class="button-bg" value="Add">
</div>
<?php
 }
  }
  else
  {
  echo "You are not logged in";
  }
?>
</div><br />

</form>
</div>
<div class="browser_window">
</div>
</div> </div> </div> </div> </div>
</div>
</div>
<div id="footer"><div class="contain"><div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.
</div><a class="jagexlink" href="../index.php" target="_blank"><img src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png" alt="Jagex" /></a></div></div>
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