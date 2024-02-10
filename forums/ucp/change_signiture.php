<?php
session_start();
include "../../includes/connect.php";
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
       	include "../../includes/config.php";
       	echo $title;
       ?></title>
<style type="text/css">/*\*/@import url(../../www.runescape.com/layout-<?php echo $ln; ?>/css/global-13.css);/**/</style>

<style type="text/css">/*\*/@import url(../../www.runescape.com/forum/forum2-10.css);/**/</style>
</head>
<body id="navcommunity">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="../../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="../../index.php" id="logo_select"></a>
<?php include '../../includes/toptext_ucp.php' ?>
<div id="lang">
<img alt="English" src="../../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" />
</div>

</div>
<div id="headOrangeBottom"></div>
<div id="menubox">
<?php include '../../includes/ucp_links.php'; ?>

</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../../index.php">Home</a> &gt;
<a href="../index.php">Forums Home</a> > <a href="change_signiture.php">Change Signiture</a>
</div>
</div>
</div>
<div id="content">
<div id="article">

<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">
<div id="contrast_panel">
<?php 
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	mysql_query("UPDATE {$prefix}users SET signiture='". realEscape($_POST['sig']) ."' WHERE id=". $_SESSION['user_id']) or die(mysql_error());
	echo 'Signiture successfully changed. <a href="../index.php">Click here</a> to return to the forums home.';
}
else
{
	$result = mysql_query("SELECT signiture FROM {$prefix}users WHERE id=". $_SESSION['user_id']) or die(mysql_error());
	list($sig) = mysql_fetch_row($result);
?>
<div id="commandtitle">
<div class="bk"></div><div class="cont">
Change Signiture
</div>
</div>
<div id="menu">
<ul class="flat">
<li><a href="../index.php">Return to forums home</a></li>
</ul>
</div>
<div id="command">
<form method="post">
<table>
<tr>
<td class="commandtwo" colspan="2">
<textarea name="sig" rows="5" cols="60"><?php echo $sig; ?></textarea><br>

</td>
</tr>
<tr>
<td class="commandtwo" colspan="2">
<input type="submit" class="buttonmedium" value="Change"> &nbsp; &nbsp;
</td>
</tr>
</table>
</form>
</div>
</div>
</div>
<?php
}
?>
</div>
</div>
</div>
<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../../index.php">Home</a> &gt;
<a href="../index.php">Forums Home</a> > <a href="change_signiture.php">Change Signiture</a>
</div>
</div>
<div id="footer">
<div class="contain">
<div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.
</div>
<a class="jagexlink" href="#" target="_blank">

<img src="../../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png?4" alt="Jagex" />
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
