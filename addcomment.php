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

</head>
<body id="navlogin">
<a name="top"></a>
<meta http-equiv="refresh" content="3;url=index.php" />


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

Add comment
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
Add comment
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">
<div class="inner_brown_background">
<div class="brown_box">
<div class="subsectionHeader">
Add comment
</div>
<div style="text-align:center;" class="inner_brown_box">

<div style="text-align: center">
<?php
if($_POST['title'] == "" || $_POST['comment'] == "")
{
  echo "<p>You have left 1 or more boxes empty!</p><p><a href='index.php'>Click Here</a> to return to the homepage.";
}
else
{
  if(is_numeric($_POST['news_id']) && $_POST['news_id'] > 0) {
    mysql_query("INSERT INTO ". $prefix ."comments (news_id, comment_date, comment_title, comment, comment_name) VALUES ('{$_POST['news_id']}', NOW(), '". realEscape($_POST['title']) ."', '". realEscape($_POST['comment']) ."', '". $_SESSION['user'] ."')");
    echo "<p>You have succesfuly added a comment. Please go to <a href='index.php'>home</a><br> to continue viewing news!</p>";
  } else {
    echo '<p>Something went wrong. <a href="index.php">Back to index</a>.</p>';
  }
}
?> 
</div>
</div> </div> </div> </div> </div>

</div>
</div>
<div id="footer"><div class="contain"><div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.
</div><a class="jagexlink" href="#" target="_blank"><img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png?1" alt="Jagex" /></a></div></div>
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
