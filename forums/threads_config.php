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
<?php include '../includes/forum_links.php'; ?>
<br class="clear" />
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;

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
  foreach ($_POST['checked'] as $thread) {
    if(!is_numeric($thread)) {
      $authorized = false;
      break;
    }
    
    list($sub_cat_id) = mysql_fetch_row(mysql_query("SELECT sub_cat_id FROM {$prefix}threads WHERE id=$thread"));
    if(!in_array($sub_cat_id, $_SESSION['forums'])) {
      $authorized = false;
      break;
    }
  }
}

if(isset($_SESSION['admin']) || $authorized)
{
  $ids = implode(', ', $_POST['checked']);
  $error = false;
  foreach($_POST['checked'] as $thread)
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
    if(
    mysql_query("DELETE FROM {$prefix}threads WHERE id IN ($ids)") &&
    mysql_query("DELETE FROM {$prefix}posts WHERE thread_id IN ($ids)"))
    {
      echo '<p>Thread(s) successfully deleted. <a href="index.php">Back to forum</a>.</p>';
    }
    break;
    case 'sticky':
      if(mysql_query("UPDATE {$prefix}threads SET stickied = 1 WHERE id IN ($ids)"))
      {
        echo '<p>Thread(s) successfully made sticky. <a href="index.php">Back to forum</a>.</p>';
      }
    break;
    case 'move':
      if (isset($_POST['to']) && is_numeric($_POST['to'])) {
        $result = mysql_query("SELECT COUNT(id) FROM {$prefix}sub_categories WHERE id={$_POST['to']}");
        list($count) = mysql_fetch_row($result);
        if ($count == 1) { 
          if ($result = mysql_query("UPDATE {$prefix}threads SET sub_cat_id = {$_POST['to']} WHERE id IN ($ids)")) {
            echo '<p>Thread(s) successfully moved. <a href="index.php">Back to forum</a>.</p>';
          }      
        }
      } else {
        echo '<form action="threads_config.php" method="post">'
            . '<input type="hidden" name="action" value="move" />';
        foreach ($_POST['checked'] as &$val) {
          echo '<input type="hidden" name="checked[]" value="' . $val . '" />';
        }
        echo 'To: <select name="to">';
        $result = mysql_query('SELECT id, name FROM ' . $prefix . 'sub_categories');
        while (list($id, $name) = mysql_fetch_row($result)) { 
            echo '<option value="' . $id . '">' . htmlspecialchars($name) . '</option>';
        }
        echo '</select> <input type="submit" value="Submit" /></form>';
      }
    break;
    case 'unsticky':
      if(mysql_query("UPDATE {$prefix}threads SET stickied = 0 WHERE id IN ($ids)"))
      {
        echo '<p>Thread(s) successfully made unsticky. <a href="index.php">Back to forum</a>.</p>';
      }
    break;
    case 'lock':
      if(mysql_query("UPDATE {$prefix}threads SET locked = 1 WHERE id IN ($ids)"))
      {
        echo '<p>Thread(s) successfully locked. <a href="index.php">Back to forum</a>.</p>';
      }
    break;
    case 'unlock':
      if(mysql_query("UPDATE {$prefix}threads SET locked = 0 WHERE id IN ($ids)"))
      {
        echo '<p>Thread(s) successfully unlocked. <a href="index.php">Back to forum</a>.</p>';
      }
    break;
    case 'hide':
      if(mysql_query("UPDATE {$prefix}threads SET hidden = 1 WHERE id IN ($ids)"))
      {
        echo '<p>Thread(s) successfully made hidden. <a href="index.php">Back to forum</a>.</p>';
      }
    break;
    case 'show':
      if(mysql_query("UPDATE {$prefix}threads SET hidden = 0 WHERE id IN ($ids)"))
      {
        echo '<p>Thread(s) successfully shown. <a href="index.php">Back to forum</a>.</p>';
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
  echo '<p>One or more of those threads isn\'t part of a forum moderated by you. <a href="index.php">Back to forum index</a>.</p>';
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