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
<div id="headImage"><a href="../index.php" id="logo_select"></a>
<?php include '../includes/toptext_forum_and_acp.php' ?>

<div id="lang">
<a href="#"><img alt="English" src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>
</div>
<div id="headOrangeBottom"></div>
<div id="menubox">

<?php
	include "../includes/links.php";
?>
<br class="clear" />
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;
Edit Name
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
Edit Name
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">

<div class="inner_brown_background">
<div class="brown_box">
<div class="subsectionHeader">
Edit Name
</div>
<div style="text-align:center;" class="inner_brown_box">

<div style="text-align: center">
<?php
if(isset($_SESSION['admin']))
{
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (isset($_POST['id']) && is_numeric($_POST['id'])) {
      if(strlen($_POST['name']) <= 30)
      {
        if($_POST['type'] == 'forum')
        {
          mysql_query("UPDATE {$prefix}sub_categories SET name='". realEscape($_POST['name']) ."' WHERE id=". $_POST['id']);
          echo '<p>Name successfully changed. <a href="index.php">Click Here</a> to return to the forum index.';
        }
        else
        {
          mysql_query("UPDATE {$prefix}categories SET name='". realEscape($_POST['name']) ."' WHERE id=". $_POST['id']);
          echo '<p>Name successfully changed. <a href="index.php">Click Here</a> to return to the forum index.';
        }
      }
      else
      {
        echo '<p>You can only use a maximum of 30 characters.</p>';
      }
    } else {
      echo '<div id="commandtitle"><div class="bk"></div><div class="cont"><center>Something went wrong. <a href="index.php">Back</a>.</center></div></div>';
    }
  }
  else
  {
    if(isset($_GET['id']) && is_numeric($_GET['id'])) {
      if($_GET['type'] == 'forum')
      {
        list($check_name) = mysql_fetch_row(mysql_query("SELECT name FROM {$prefix}sub_categories WHERE id={$_GET['id']}"));
      }
      else if($_GET['type'] == 'cat')
      {
        list($check_name) = mysql_fetch_row(mysql_query("SELECT name FROM {$prefix}categories WHERE id={$_GET['id']}"));
      } 
        echo '
        <form method="post">
        Name: <input type="text" name="name" value="'. $check_name .'" maxlength="30"><br />
        <input type="hidden" name="id" value="'. $_GET['id'] .'">
        <input type="hidden" name="type" value="'. $_GET['type'] .'">
        <input type="submit" value="Submit">
        ';
    } else {
      echo '<div id="commandtitle"><div class="bk"></div><div class="cont"><center>Something went wrong. <a href="index.php">Back</a>.</center></div></div>';
    }
  }
} else {
  echo 'You have to be logged in as an administrator to do this.';
}
?> 
</div>
</div> </div> </div> </div> </div>

</div>
</div>
<div id="footer"><div class="contain"><div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And <a href="http://mikersweb.info">MikeRSWeb</a>.<br />
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
