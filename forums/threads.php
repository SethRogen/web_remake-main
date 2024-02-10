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

<style type="text/css">/*\*/@import url(../www.runescape.com/forum/forum2-10.css);/**/</style>
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
<b>Location: </b> <a href="index.php">Home</a> &gt;
<a href="index.php">Forums Home</a> >
<?php
 if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}sub_categories WHERE id={$_GET['id']}")) : false)
 {
$forum_get_cat_title = mysql_query('SELECT name FROM '.$prefix.'sub_categories WHERE id='. $_GET['id']);
  if(mysql_num_rows($forum_get_cat_title) > 0)
  {
    $p = mysql_fetch_assoc($forum_get_cat_title);
    echo $p['name'];
 }
 }
?>
</div>
</div>
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
 if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}sub_categories WHERE id={$_GET['id']}")) : false)
 {
?>
<div id="infopane">
<?php
if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}sub_categories WHERE id={$_GET['id']}")) : false)
 {
$forum_get_cat_title = mysql_query('SELECT name, image FROM '.$prefix.'sub_categories WHERE id='. realEscape($_GET['id']));
  if(mysql_num_rows($forum_get_cat_title) > 0)
  {
    $p = mysql_fetch_assoc($forum_get_cat_title);
    echo '<span class="title"><img src="../www.runescape.com/forum/icons/'. htmlspecialchars($p['image']) .'.gif" alt=""> &nbsp; '. capitalize(htmlspecialchars($p['name'])) .' &nbsp; <img src="../www.runescape.com/forum/icons/'. htmlspecialchars($p['image']) .'.gif" alt=""></span>';
  }
 }
?>

<div class="about">
<ul class="flat">
<li><br>
<span class="count">

</span>
</li>
</ul>
</div>
</div>
<div id="nocontrols" class="phold"></div>


<div class="actions" id="top">
<table>
<tr>
<td class="commands center">
<ul class="flat">
<li><img src="../www.runescape.com/forum/cmdicons/backtoforum.gif" alt=""> <a href="index.php">To Forums Home</a></li>
<?php
 if(isset($_SESSION['user']))
 {
 echo '<li><img src="../www.runescape.com/forum/cmdicons/new_thread.gif" alt=""> <a href="add_thread.php?id='. $_GET['id'] .'">Create a New Thread</a></li>';
 }
?>
</ul>
</td>
</tr>
<tr>
<td class="nav center">
<form method="get" style="display: inline;" action="threads.php?id=<?php echo $_GET['id']; ?>">
<ul class="flat">
<?php 
$results_per_page = 20;
list($threads) = mysql_fetch_row(mysql_query('SELECT COUNT(id) FROM '.$prefix.'threads WHERE sub_cat_id='.realEscape($_GET['id'])));
$page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;
$pages = (int)ceil($threads / $results_per_page);
$page = $page > $pages ? $pages : $page;
$start = $page * $results_per_page - $results_per_page;
$limit = $results_per_page;
?>
<li><a href="threads.php?id=<?php echo $_GET['id']; ?>&page=1">&lt;&lt; first</a></li>

<li><a href="threads.php?id=<?php echo $_GET['id']; ?>&page=<?php echo ($page === 1) ? $page : $page-1; ?>">&lt; prev</a></li>
<li>Page <input type="text" class="textinput" id="page" name="page" size="2" value="<?php echo $page; ?>" maxlength="3" /> of <?php echo $pages; ?></li>
<li><a href="threads.php?id=<?php echo $_GET['id']; ?>&page=<?php echo ($page === $pages) ? $page : $page+1;?>">next &gt;</a></li>
<li><a href="threads.php?id=<?php echo $_GET['id']; ?>&page=<?php echo $pages; ?>">last &gt;&gt;</a></li>
</ul>
</form>
</td>
</tr></table>
</div>

<div id="content_forum" class="border">
<div class="bk"></div>
<div class="cont">
<table>
<?php
list($fid) = mysql_fetch_row(mysql_query("SELECT id FROM {$prefix}sub_categories WHERE id = {$_GET['id']}"));
if(isset($_SESSION['admin']) || ((isset($_SESSION['mod']) && in_array($fid, $_SESSION['forums']))))
{
echo '<tr>';
echo '<td class="title1" width="4%"></td>';
echo '<td class="title1" width="46%">Title</td>';
echo '<td id="header_posts" class="center title">Posts</td>';
echo '<td id="header_lastpost" class="title1">Last Post</td>';
echo '</tr>';
echo '<form action="threads_config.php" method="post">';
}
else
{
echo '<tr>';
echo '<td class="title1">Title</td>';
echo '<td id="header_posts" class="center title">Posts</td>';
echo '<td id="header_lastpost" class="title1">Last Post</td>';
echo '</tr>';
}

list($forum_thread_check) = mysql_fetch_row(mysql_query('SELECT COUNT(id) FROM '.$prefix.'threads WHERE sub_cat_id='. realEscape($_GET['id']) . ' ORDER BY stickied DESC'));
if($forum_thread_check > 0)
{
  $posts = mysql_query('SELECT p.author, r.id, r.stickied, r.locked, r.name, r.hidden FROM '. $prefix .'posts p
  INNER JOIN '. $prefix .'threads r ON r.id = p.thread_id
WHERE p.date = (SELECT MAX(date) FROM '. $prefix .'posts q
  WHERE p.thread_id = q.thread_id) AND sub_cat_id='. $_GET['id'] .' ORDER BY r.stickied DESC, p.date DESC') ;
  while($n = mysql_fetch_assoc($posts))
  {
    $forum_thread_author = mysql_query('SELECT author FROM '.$prefix.'posts WHERE thread_id='. realEscape($n['id']) .' ORDER BY date ASC LIMIT 1');
    if(mysql_num_rows($forum_thread_author) > 0)
    {
      $p = mysql_fetch_assoc($forum_thread_author);
      list($user_id) = mysql_fetch_row(mysql_query("SELECT id FROM {$prefix}users WHERE uname='". htmlentities($p['author']) ."'"));
$name1 = preg_replace('/[a-z]/ie', 'strtoupper($0);', stripslashes($p['author']), 1);

      echo '<tr class="thdnrml">';
      if(isset($_SESSION['admin']) || ((isset($_SESSION['mod']) && in_array($fid, $_SESSION['forums']))))
      {
        echo '<td class="threadtitle">';
        echo '<input type="checkbox" name="checked[]" value="'. $n['id'] .'" />';
        echo '</td>';
      }
      echo '<td class="threadtitle">';
      if($n['locked'] || $n['hidden'])
      {
        echo '<img alt="Thread is locked" title="Thread is locked" src="../www.runescape.com/forum/buttons/locked.gif">';
      }
      if($n['stickied'] == 1 && $n['hidden'] == 0)
      {
        echo '<img alt="Thread is stickied" title="Thread is stickied" src="../www.runescape.com/forum/buttons/sticky.gif">';
      }
      
      if($n['hidden'] == 1)
      {
        if(isset($_SESSION['admin']) || isset($_SESSION['mod']) && in_array($fid, $_SESSION['forums']))
        {
          echo '*Hidden*<a class="sticky2" href="post.php?id='. $n['id'] .'">'. capitalize($n['name']) .'</a><br>';
          echo '<span class="nt">created by <span class="username"><a style="color: white; text-decoration: none;" href="profile.php?id='. $user_id .'">'. $name1 .'</a></span></span>';
        }
        else
        {
        echo 'This thread is hidden';
        }
      }
      else
      {
        echo '<a class="sticky2" href="post.php?id='. $n['id'] .'">'. capitalize($n['name']) .'</a><br>';
        echo '<span class="nt">created by <span class="username"><a style="color: white; text-decoration: none;" href="profile.php?id='. $user_id .'">'. $name1 .'</a></span></span>';
      }

      echo '</td>';
      
    }
    $forum_thread_date = mysql_query('SELECT date, author FROM '.$prefix.'posts WHERE thread_id='. realEscape($n['id']) .' ORDER BY date DESC LIMIT 1');
    if(mysql_num_rows($forum_thread_date) > 0)
    {
    $k = mysql_fetch_assoc($forum_thread_date);
    $name2 = capitalize(stripslashes($k['author']));
    $check_posts = mysql_query('SELECT COUNT(id) FROM '. $prefix .'posts WHERE thread_id='. realEscape($n['id']));
    $g = mysql_fetch_array($check_posts);
    list($user_id) = mysql_fetch_row(mysql_query("SELECT id FROM {$prefix}users WHERE uname='". htmlentities($k['author']) ."'"));
      if($n['hidden'] == 0)
      {
    echo '
    <td class="num">
    '. htmlspecialchars($g[0]) .'
    </td>';
    }
    else
    {
      echo '<td class="num"> </td>';
    }
    if($n['hidden'] == 0)
      {
    echo '<td class="updated">
    '. date('d-m-Y H:i:s', strtotime(htmlspecialchars($k['date']))) .'
    <br>by <a style="text-decoration: none;" href="profile.php?id='. $user_id .'">'. htmlspecialchars($name2) .'</a>
    </td>';
    }
    else
    {
    echo '<td class="updated"> </td>';
    }
    echo '</tr>';
    }
  }
  if(isset($_SESSION['admin']) || (isset($_SESSION['mod']) && in_array($fid, $_SESSION['forums'])))
  {
    echo '<tr><td width="50%" style="padding-top:7px" colspan="2">';
    echo '<select name="action" style="display:inline">
    <option value="delete">Delete</option>
    <option value="sticky">Sticky</option>
    <option value="unsticky">Unsticky</option>
    <option value="lock">Lock</option>
    <option value="unlock">Unlock</option>
    <option value="hide">Hide</option>
    <option value="show">Show</option>
    <option value="move">Move</option>
    </select> <input type="submit" value="Go" style="display:inline"/>';
    echo '</td></tr></form>';
  }
}
else
{
echo '<tr class="thdnrml">';
if(isset($_SESSION['admin']))
echo '<td class="threadtitle"></td>';
echo  '<td class="threadtitle">
      <i>No Threads</i><br>
      </td><td class="num">
    
    </td>
    <td class="updated">
    <i>No Posts</i>
    </td>
    </tr>';
}
?>
</table>
</div>
</div>
<div class="actions" id="bottom">
<table><tr>

<td class="commands center">
<ul class="flat">
<li><img src="../www.runescape.com/forum/cmdicons/backtoforum.gif" alt=""> <a href="index.php">To Forums Home</a></li>
<?php
 if(isset($_SESSION['user']))
 {
 echo '<li><img src="../www.runescape.com/forum/cmdicons/new_thread.gif" alt=""> <a href="add_thread.php?id='. $_GET['id'] .'">Create a New Thread</a></li>';
 }
?>
</ul>
</td>
</tr>
<tr>
<td class="nav center">
<form method="get" style="display: inline;" action="threads.php?id=<?php echo $_GET['id']; ?>">
<ul class="flat">
<li><a href="threads.php?id=<?php echo $_GET['id']; ?>&page=1">&lt;&lt; first</a></li>

<li><a href="threads.php?id=<?php echo $_GET['id']; ?>&page=<?php echo ($page === 1) ? $page : $page-1; ?>">&lt; prev</a></li>
<li>Page <input type="text" class="textinput" id="start" name="page" size="2" value="<?php echo htmlspecialchars($page); ?>" maxlength="3" /> of <?php echo $pages; ?></li>
<li><a href="threads.php?id=<?php echo $_GET['id']; ?>&page=<?php echo ($page === $pages) ? $page : $page+1;?>">next &gt;</a></li>
<li><a href="threads.php?id=<?php echo $_GET['id']; ?>&page=<?php echo $pages; ?>">last &gt;&gt;</a></li>
</ul>
</form>
</td></tr></table>
</div>
<?php
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
<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;
<a href="index.php">Forums Home</a> >
<?php
if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}sub_categories WHERE id={$_GET['id']}")) : false)
 {
$forum_get_cat_title = mysql_query('SELECT name FROM '.$prefix.'sub_categories WHERE id='. realEscape($_GET['id']));
  if(mysql_num_rows($forum_get_cat_title) > 0)
  {
    $p = mysql_fetch_assoc($forum_get_cat_title);
    echo htmlspecialchars($p['name']);
 }
 }
?>
</div>
</div>
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