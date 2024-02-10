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

</head>
<body id="navlogin">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="" id="logo_select"></a>
<?php include '../includes/toptext_forum_and_acp.php' ?>

<div id="lang">
<a href="#"><img alt="English" src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>
</div>
<div id="headOrangeBottom"></div>
<div id="menubox">
<?php include '../includes/forum_links.php'; ?>
<br class="clear" />
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="">Home</a> &gt;

Thread Config
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
Thread Config
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">
<div class="inner_brown_background">
<div class="brown_box">
<div class="subsectionHeader">
Thread Config
</div>
<div style="text-align:center;" class="inner_brown_box">

<div style="text-align: center">
<?php
if (isset($_SESSION['mod'])) {
  $authorized = true;
  foreach ($_POST['post'] as $post) {
    if(!is_numeric($thread)) {
      $authorized = false;
      break;
    }
    
    list($sub_cat_id) = mysql_fetch_row(mysql_query("SELECT sub_cat_id FROM {$prefix}threads WHERE id IN(SELECT {$prefix}posts WHERE id=$post"));
    if(!in_array($sub_cat_id, $_SESSION['forums'])) {
      $authorized = false;
      break;
    }
  }
}

if(isset($_SESSION['admin']) || $authorized)
{
  $ids = implode(', ', $_POST['post']);
  $error = false;
  foreach($_POST['post'] as $thread)
  {
    if(!is_numeric($thread))
    {
      $error = true;
      break;
    }
  }
  if(!$error)
  {
	switch($_POST['action'])
	{
    case 'delete':
    if(mysql_query("DELETE FROM {$prefix}posts WHERE id IN ($ids)"))
    {
      echo '<p>Post(s) successfully deleted. <a href="index.php">Back to forum</a>.</p>';
    }
    break;
    default:
    echo '<p>You have not selected an action. <a href="index.php">Click Here</a> to go to the forum index</p>';
  }
  }
  else
  {
    echo '<p>You have chosen invalid IDs. Please choose new ones <a href="index.php">here</a>.';
  }
} elseif ($_SESSION['mod']) {
  echo '<p>One or more of those posts isn\'t part of a forum moderated by you. <a href="index.php">Back to forum index</a>.</p>';
}
else
{
  echo '<p>You need to be logged in as an administrator or moderator to do this.</p><p><a href="login.php">Click Here</a> to log in.';
}
?>
</div>
</div> </div> </div> </div> </div>

</div>
</div>
<div id="footer"><div class="contain"><div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.
</div><a class="jagexlink" href="#" target="_blank"><img src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png?1" alt="Jagex" /></a></div></div>
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