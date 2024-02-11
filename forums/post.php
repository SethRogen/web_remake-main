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
<style type="text/css">/*\*/@import url(../www.runescape.com/layout-<?php echo $ln; ?>/css/global-13.css);/**/</style>

<style type="text/css">/*\*/@import url(../www.runescape.com/forum/forum2-10.css);/**/</style>
</head>
<body id="navcommunity">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="#" id="logo_select"></a>

<?php include '../includes/toptext_forum_and_acp.php' ?>

<div id="lang">
<a href="#"><img alt="English" src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>

</div>
<div id="headOrangeBottom"></div>
<div id="menubox">
<?php
	include "../includes/forum_links.php";
?>
<br class="clear" />

</div>
<?php
if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}threads WHERE id={$_GET['id']}")) : false)
 {
?>
<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../">Home</a> &gt;
<a href="index.php">Forums Home</a> >
<?php
$forum_get_thread_title = mysql_query('SELECT name, sub_cat_id FROM '.$prefix.'threads WHERE id='. $_GET['id']);
  if(mysql_num_rows($forum_get_thread_title) > 0)
  {
    $p = mysql_fetch_assoc($forum_get_thread_title);
 
 
$forum_get_cat_title = mysql_query('SELECT id, name FROM '.$prefix.'sub_categories WHERE id=' . $p['sub_cat_id']);
  if(mysql_num_rows($forum_get_cat_title) > 0)
  {
    $zz = mysql_fetch_assoc($forum_get_cat_title);
    echo '<a href="threads.php?id='. htmlspecialchars($zz['id']) .'">'. htmlspecialchars($zz['name']) .'</a> > '.
    htmlspecialchars($p['name']);
 }
 }
?>
</div>
</div>
<?php
 }
?>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
<?php
 echo $title;
?> Forums
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">
<div id="picker">

</div>
<div id="contrast_panel">
<?php
 if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}threads WHERE id={$_GET['id']}")) : false)
 {
  list($fid) = mysql_fetch_row(mysql_query("SELECT sub_cat_id FROM {$prefix}threads WHERE id = {$_GET['id']}"));
  list($check_hidden) = mysql_fetch_row(mysql_query('SELECT hidden FROM '.$prefix.'threads WHERE id='. $_GET['id']));
  if((int)$check_hidden == 1 && (!isset($_SESSION['admin']) && (!isset($_SESSION['mod']) || !in_array($fid, $_SESSION['forums']))))
  {
    echo '<br /><br /><center><b>This thread has been hidden by an administrator.</b></center><br /><br />';
  }
  else
  {
?>
<div id="infopane">
<?php

 $forum_get_thread_title = mysql_query('SELECT name, sub_cat_id FROM '.$prefix.'threads WHERE id='. $_GET['id']);
  if(mysql_num_rows($forum_get_thread_title) > 0)
  {
    if((int)$check_hidden == 1)
    {
      $gg = mysql_fetch_assoc($forum_get_thread_title);
      echo '<div class="title thrd">*Hidden*'. capitalize($gg['name']) .'</div>';
    }
    else
    {
      $gg = mysql_fetch_assoc($forum_get_thread_title);
      echo '<div class="title thrd">'. capitalize($gg['name']) .'</div>';
    }
}
?>
<div class="about">
<ul class="flat">
</ul>
</div>
</div>
<div id="nocontrols" class="phold"></div>
<div class="actions" id="top">
<table><tr>
<td class="commands center">
<ul class="flat">
<?php
  $n = mysql_fetch_assoc(mysql_query('SELECT locked FROM '.$prefix.'threads WHERE id=' . $_GET['id']));
 if(isset($_SESSION['user']) && $n['locked'] == 0)
 {
    echo '<li><img src="../www.runescape.com/forum/cmdicons/new_thread.gif" alt=""> <a href="add_post.php?id='. htmlspecialchars($_GET['id']) .'">Reply</a></li>';
 }
?>
<li><img src="../www.runescape.com/forum/cmdicons/backtoforum.gif" alt=""> <a href="index.php">To Forums Home</a></li>
</ul>
</td>
</tr>
<tr>
<td class="nav center">
<form method="post" style="display:inline">
<ul class="flat">
<?php 
$results_per_page = 10;
list($threads) = mysql_fetch_row(mysql_query('SELECT COUNT(id) FROM '.$prefix.'posts WHERE thread_id='.$_GET['id']));
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;
$pages = (int)ceil($threads / $results_per_page);
$page = $page > $pages ? $pages : $page;
$start = $page * $results_per_page - $results_per_page;
$limit = $results_per_page;
?>
<li><a href="post.php?id=<?php echo $_GET['id'] ?>&page=1">&lt;&lt; first</a></li>

<li><a href="post.php?id=<?php echo $_GET['id'] ?>&page=<?php echo (htmlspecialchars($page) === 1) ? htmlspecialchars($page) : htmlspecialchars($page-1); ?>">&lt; prev</a></li>
<li>Page <input type="text" class="textinput" id="page" name="page" size="2" value="<?php echo htmlspecialchars($page); ?>" maxlength="3" /> of <?php echo $pages; ?></li>
<li><a href="post.php?id=<?php echo $_GET['id'] ?>&page=<?php echo (htmlspecialchars($page) === $pages) ? htmlspecialchars($page) : htmlspecialchars($page)+1;?>">next &gt;</a></li>
<li><a href="post.php?id=<?php echo $_GET['id'] ?>&page=<?php echo $pages; ?>">last &gt;&gt;</a></li>
</ul>
</form>
</td>
</tr>

</table>
</div>
<div id="contentmsg" class="">
<a class="msgplace" name="0"></a>
<form action="post_config.php" method="post">
<?php

  $forum_posts = mysql_query('SELECT * FROM '.$prefix.'posts WHERE thread_id=' . $_GET['id'] . ' ORDER BY date ASC LIMIT '.$start.','.$limit);
  if(mysql_num_rows($forum_posts) > 0)
  {
    while($n = mysql_fetch_assoc($forum_posts))
    {
      list($authorrights, $usertitle, $checkbanned) = mysql_fetch_row(mysql_query("SELECT rights, usertitle, banned FROM {$prefix}users WHERE uname='{$n['author']}'"));
      if($authorrights == 2 && !$checkbanned)
      {
        echo '<table class="message jmod" CELLSPACING="0">';
      }
      elseif($authorrights == 1 && !$checkbanned)
      {
        echo '<table class="message mod" CELLSPACING="0"><tr>';
      }
      else
      {
        echo '<table class="message" CELLSPACING="0"><tr>';
      }
?>

<td class="leftpanel">

<?php
  list($user_id, $sig) = mysql_fetch_row(mysql_query("SELECT id, signiture FROM {$prefix}users WHERE uname='". $n['author'] ."'"));
 $name = preg_replace('/[a-z]/ie', 'strtoupper("$0");', stripslashes($n['author']), 1);
 if($checkbanned)
 {
    echo '<div class="msgcreator uname"><s style="color:#ff0000;">&nbsp;<a style="text-decoration: none;" href="profile.php?id='. $user_id .'">'. htmlspecialchars($name) .'</a></s></div>
          <div class="modtype">Banned</div>';
 }
 else
 {
   if($authorrights == 2)
   {
   echo '<div class="msgcreator uname"><img src="../www.runescape.com/forum/crown_gold.gif" alt="">&nbsp;<a style="color: white; text-decoration: none;" href="profile.php?id='. $user_id .'">'. htmlspecialchars($name) .'</a></div>';
    if(empty($usertitle))
    {
      echo '<div class="modtype">Forum Administrator</div>';
    }
    else
    {
      echo '<div class="modtype">'. $usertitle .'</div>';
    }
   }
   elseif($authorrights == 1)
   {
   echo '<div class="msgcreator uname"><img src="../www.runescape.com/forum/crown_green.gif" alt="">&nbsp;<a style="color: white; text-decoration: none;" href="profile.php?id='. $user_id .'">'. htmlspecialchars($name) .'</a></div>';
    if(empty($usertitle))
    {
      echo '<center><div style="color: white;font-size: 10px;">Forum Moderator</div></center>';
    }
    else
    {
      echo '<div class="modtype">'. $usertitle .'</div>';
    }
   }
   else
   {
    echo '<div class="msgcreator uname"><a style="color: white; text-decoration: none;" href="profile.php?id='. $user_id .'">'. htmlspecialchars($name) .'</a></div>';
      if(empty($usertitle))
      {
        echo '<div class="modtype">User</div>';
      }
      else
      {
        echo '<div class="modtype">'. $usertitle .'</div>';
      }
   }
 }
 
 $result = mysql_query("SELECT COUNT(id) FROM {$prefix}posts WHERE author = '{$n['author']}'");
 list($posts) = mysql_fetch_row($result);
?>


<div class="modtype"></div>

<div class="msgcommands">
<?php
echo 'Posts: <b>' . $posts . '</b><br/>';
echo '<a href="ucp/send_pm.php?user='. $n['author'] .'">Send PM</a><br/>';
if(isset($_SESSION['admin']) || (isset($_SESSION['mod']) && in_array($fid, $_SESSION['forums'])))
echo '<span syle="text-alighn"><input type="checkbox" name="post[]" value="'. $n['id'] .'" /></span>';
?>
</div>

</td>
<td class="rightpanel">
<div class="msgtime">
<?php
if($_SESSION['user'] == $n['author'] || isset($_SESSION['admin']) || (isset($_SESSION['mod']) && in_array($fid, $_SESSION['forums'])))
{
 echo '<a href="edit_post.php?id='. $n['id'] .'">Edit</a> - ';
}
 echo date('d-m-Y H:i', strtotime($n['date']));
?>
</div>
<div class="msgcontents">
<?php
if(!empty($sig))
{
	echo nl2br(smileys(bbcodes($n['post']))) ."<br>______________________________________<br /><br />". nl2br(smileys(bbcodes($sig)));
}
else
{
	echo nl2br(smileys(bbcodes($n['post'])));
}
?>
</div>
</td>
</tr></table>
<?php
}
}
if(isset($_SESSION['admin']) || isset($_SESSION['mod']))
{
echo '<tr><td width="50%" style="padding-top:7px" colspan="2">';
    echo '<select name="action" style="display:inline">
    <option value="delete">Delete</option>
    </select> <input type="submit" value="Go" style="display:inline"/>';
    echo '</td></tr></form>';
    }
?>
<a class="msgplace" name="1"></a>
</div>
<div class="actions" id="bottom">
<table><tr>
<td class="commands center">

<ul class="flat">
<?php
  $n = mysql_fetch_assoc(mysql_query('SELECT locked FROM '.$prefix.'threads WHERE id='. $_GET['id']));
 if(isset($_SESSION['user']) && $n['locked'] == 0)
 {
    echo '<li><img src="../www.runescape.com/forum/cmdicons/new_thread.gif" alt=""> <a href="add_post.php?id='. htmlspecialchars($_GET['id']) .'">Reply</a></li>';
 }
?>
<li><img src="../www.runescape.com/forum/cmdicons/backtoforum.gif" alt=""> <a href="index.php">To Forums Home</a></li>
</ul>
</td>
</tr>
<tr>
<td class="nav center">
<form method="post" style="display:inline">
<ul class="flat">
<li><a href="post.php?id=<?php echo $_GET['id'] ?>&page=1">&lt;&lt; first</a></li>

<li><a href="post.php?id=<?php echo $_GET['id'] ?>&page=<?php echo (htmlspecialchars($page) === 1) ? htmlspecialchars($page) : htmlspecialchars($page)-1; ?>">&lt; prev</a></li>
<li>Page <input type="text" class="textinput" id="start" name="page" size="2" value="<?php echo htmlspecialchars($page); ?>" maxlength="3" /> of <?php echo $pages; ?></li>
<li><a href="post.php?id=<?php echo $_GET['id'] ?>&page=<?php echo (htmlspecialchars($page) === $pages) ? htmlspecialchars($page) : htmlspecialchars($page)+1;?>">next &gt;</a></li>
<li><a href="post.php?id=<?php echo $_GET['id'] ?>&page=<?php echo $pages; ?>">last &gt;&gt;</a></li>
</ul>
</form>
</td>
</tr></table>
</div>
<?php
 }
 }
 else
 {
 echo '<br><br>';
 echo '<b><center>The thread you were looking for is invalid. <a href="index.php">Please choose a new one</a>.</center></b>';
 echo '<br><br>';
 }
?>
</div>
</div>

</div>

</div>
</div>
<?php
if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}threads WHERE id={$_GET['id']}")) : false)
 {
?>
<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../">Home</a> &gt;
<a href="index.php">Forums Home</a> >
<?php
$forum_get_thread_title = mysql_query('SELECT name, sub_cat_id FROM '.$prefix.'threads WHERE id=' . $_GET['id']);
  if(mysql_num_rows($forum_get_thread_title) > 0)
  {
    $p = mysql_fetch_assoc($forum_get_thread_title);
 
 
  $forum_get_cat_title = mysql_query('SELECT id, name FROM '.$prefix.'sub_categories WHERE id='. $p['sub_cat_id']);
  if(mysql_num_rows($forum_get_cat_title) > 0)
  {
    $zz = mysql_fetch_assoc($forum_get_cat_title);
    echo '<a href="threads.php?id='. htmlspecialchars($zz['id']) .'">'. htmlspecialchars($zz['name']) .'</a> > '.
    htmlspecialchars($p['name']);
 }
 }
?>
</div>
</div>
<?php
 }
?>
<div id="footer">
<div class="contain">
<div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.
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