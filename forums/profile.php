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
">
<meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming">
<meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">
<title><?php
       	include "../includes/config.php";
       	echo $title;
       ?></title>
<style type="text/css">/*\*/@import url(../www.runescape.com/layout-<?php echo $ln; ?>/css/global-14.css);/**/</style>

<style type="text/css">/*\*/@import url(../www.runescape.com/layout-<?php echo $ln; ?>/css/forum2-10.css);/**/</style>

</head>
<body id="navcommunity">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="../index.php" id="logo_select"></a>
<?php include '../includes/toptext_forum_and_acp.php' ?>

<div id="lang">
<a href="#"><img alt="English" src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>

</div>
<div id="headOrangeBottom"></div>
<div id="menubox">
<?php include '../includes/forum_links.php'; ?>
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href='../index.php'>Home</a> &gt; <a href="index.php">Forum Home</a> &gt;

<?php echo htmlspecialchars($title); ?> Forums
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
<?php echo htmlspecialchars($title); ?> Forums
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">

<script type="text/javascript" src="../www.runescape.com/layout-<?php echo $ln; ?>/css/forumroot-0.js"></script>
<div id="contrast_panel">
<div id="infotitle">
<center>Profile</center>
</div>
<div id="becontrol">
<?php
  if (is_numeric($_GET['id'])) {
	$user_select = mysql_query("SELECT * FROM {$prefix}users WHERE id=". realEscape($_GET['id']));
	$n = mysql_fetch_assoc($user_select);
	$checkbanned = $n['banned'];
	$authorrights = $n['rights'];
	$usertitle = $n['usertitle'];
?>
<table>
<tbody><tr id="userview_first_row">
<td class="list">
<?php

 echo '<center><b><span style="font-size: 17px">'. capitalize($n['uname']) .'</span></b></center>';
 if($checkbanned)
 {
    echo '<center><b><span style="font-size: 10px">Banned</span></b></center>';
 }
 else
 {
   if($authorrights == 2)
   {
    if(empty($usertitle))
    {
      echo '<center><b><span style="font-size: 10px"><img src="../www.runescape.com/forum/crown_gold.gif" alt="">Forum Administrator</span></b></center>';
    }
    else
    {
        echo '<center><b><span style="font-size: 10px"><img src="../www.runescape.com/forum/crown_gold.gif" alt="">'. $n['usertitle'] .'</span></b></center>';
    }
   }
   elseif($authorrights == 1)
   {
    if(empty($usertitle))
    {
      echo '<center><div style="color: white;font-size: 10px;"><img src="../www.runescape.com/forum/crown_green.gif" alt="">Forum Moderator</div></center>';
    }
    else
    {
        echo '<center><b><span style="font-size: 10px"><img src="../www.runescape.com/forum/crown_green.gif" alt="">'. $n['usertitle'] .'</span></b></center>';
    }
   }
   else
   {
      if(empty($usertitle))
      {
        echo '<center><b><span style="font-size: 10px">User</span></b></center>';
      }
      else
      {
        echo '<center><b><span style="font-size: 10px">'. $n['usertitle'] .'</span></b></center>';
      }
   }
   echo '<br />';
   echo '<center><a style="text-decoration: none; color: white;font-size: 15px;" href="ucp/send_pm.php?user='. $n['uname'] .'">Send PM</a></center>';
 }
 
?>
</td>
<td class="viewdetails">
<?php
echo '<b>Username: <i>'. $n['uname'] .'</i></b><br />';
echo '<b>Date Of Birth: <i>'. $n['dob'] .'</i></b><br />';
if($n['hide_mail'] == 0)
echo '<b>E-Mail: <i>'. $n['mail'] .'</i></b><br />';
if($authorrights == 1)
{
echo '<b>Power: <i>Moderator</i></b><br />';
}
else if($authorrights == 2)
{
echo '<b>Power: <i>Administrator</i></b><br />';
}
else
{
echo '<b>Power: <i>User</i></b><br />';
}
echo '<b>Country: <i>'. $n['country'] .'</i></b><br />';
} else {
  echo 'ID must be numeric.';
}
?>
<script>
document.getElementById('images').style.display = 'none';
function displayimages()
{
  e = document.forms[0].type.value;
  if(e == 1)
  {
    document.getElementById('images').style.display = 'none';
  }
  else
  {
    document.getElementById('images').style.display = 'block';
  }
}
</script>
</td>
</tr>
</tbody></table>
</div>
<div class="center go_back_link"><a href="index.php">Back to forums</a></div>
</div>
</div>

</div>
</div>
</div>
<div class="navigation">
<div class="location">
<b>Location: </b> <a href='../index.php'>Home</a> &gt; <a href="index.php">Forum Home</a> &gt;

<?php echo htmlspecialchars($title); ?> Forums
</div>
</div>
<div id="footer">
<div class="contain">
<div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.<br />
</div>
<a class="jagexlink" href="http://www.jagex.com" target="_blank">
<img src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png?4" alt="Jagex" />
</a>
</div>
</div>
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