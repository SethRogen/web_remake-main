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
<b>Location: </b> <a href='../index.php'>Home</a> &gt; Forum Home
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
<div id="infopane">

<span class="title"><?php echo htmlspecialchars($title); ?> Forums</span>
<div class="about">
<ul class="flat">

<li><br>
<span class="count">

</span>
</li>
</ul>
</div>
</div>
<form action="forums_config.php" method="post">
<div id="nocontrols" class="phold"></div>
<?php
 $forum_cat = mysql_query("SELECT * FROM ".$prefix."categories");
if(mysql_num_rows($forum_cat) > 0)
{
  while($n = mysql_fetch_array($forum_cat))
  {
?>
<div id="contentfrm">
<div class="brown_box_forum brown_box_stack">

<table id="forum_group0" class="forum_group">
<?php
 if(isset($_SESSION['admin']))
 {
 echo '
 <tr>
 <td class="header_groupname" width="2%"><input type="checkbox" name="cat[]" value="'. $n['id'] .'" /></td>
<td class="header_groupname" colspan="2">
<div id="showhide_controls0" class="showhide_controls">&nbsp;</div>
<div class="groupname" width="4%">'. htmlspecialchars($n['name']) .' - <a href="cat_name.php?type=cat&id='. $n['id'] .'">Edit</a></div>
</td>
<td id="header_threads0" class="header_threads title num">Threads</td>
<td id="header_posts0" class="header_posts title num">Posts</td>
<td id="header_lastpost0" class="header_lastpost title">Last Post</td>

</tr>
 ';
 }
 else
 {
 echo '
 <tr>
<td class="header_groupname" colspan="2">
<div id="showhide_controls0" class="showhide_controls">&nbsp;</div>
<div class="groupname">'. htmlspecialchars($n['name']) .'</div>

</td>
<td id="header_threads0" class="header_threads title num">Threads</td>
<td id="header_posts0" class="header_posts title num">Posts</td>
<td id="header_lastpost0" class="header_lastpost title">Last Post</td>

</tr>
 ';
 }
?>
<!--<tr class="spacer">
<td colspan="5" style="background:#1D1506 none repeat scroll 0%;"></td></tr>-->
<?php
$forum_sub_cat = mysql_query("SELECT * FROM ".$prefix."sub_categories WHERE cat_id={$n['id']}");
if(mysql_num_rows($forum_sub_cat) > 0)
{
  while($p = mysql_fetch_array($forum_sub_cat))
  {
?>
<tr class="item">
<?php
 if(isset($_SESSION['admin']))
 {
?>
<td class="icon lefttd" width="4%"><input type="checkbox" name="forum[]" value="<?php echo $p['id']; ?>" /></td>
<?php
 }
?>
<td class="icon lefttd">
<img src="../www.runescape.com/forum/icons/<?php echo $p['image']; ?>.gif" alt="">
</td>
<td class="frmname">

<span class="bigtitle"><a href="threads.php?id=<?php echo $p['id']; ?>"><?php echo $p['name']; ?></a>
<?php 
if(isset($_SESSION['admin']))
{
  echo ' - <a href="cat_name.php?type=forum&id='. $p['id'] .'" style="color:white">Edit</a>';
} elseif(isset($_SESSION['mod']) && in_array($p['id'], $_SESSION['forums'])) {
  echo ' <img src="../www.runescape.com/forum/crown_green.gif" alt="You are a moderator of this forum" title="You are a moderator of this forum" />';
}
?></span> <br />
<span class="desc"><?php echo htmlspecialchars($p['info']); ?></span>
</td>
<?php
 $check_threads = mysql_query('SELECT COUNT(id) FROM '. $prefix .'threads WHERE sub_cat_id = ' . $p['id']) ;
    $v = mysql_fetch_array($check_threads);
      echo '<td class="num">'. htmlspecialchars($v[0]) .'</td>';
  $check_posts = mysql_query('SELECT COUNT(id) FROM '. $prefix .'posts WHERE thread_id IN(SELECT id FROM '. $prefix .'threads WHERE sub_cat_id='. $p['id'] .')');
    $g = mysql_fetch_array($check_posts);
      echo '<td class="num">'. htmlspecialchars($g[0]) .'</td>';
  $check_last_post = mysql_query('SELECT t.name as name, p.date as date, p.author as author, t.id as id FROM '.$prefix.'posts p
    INNER JOIN '.$prefix.'threads t ON t.id = p.thread_id
    WHERE sub_cat_id = '.$p['id'].' ORDER BY p.date DESC');
    if(mysql_num_rows($check_last_post) > 0)
    {
      $o = mysql_fetch_assoc($check_last_post);
      $name1 = capitalize($o['author']);
      $name2 = capitalize($o['name']);
      list($user_id) = mysql_fetch_row(mysql_query("SELECT id FROM {$prefix}users WHERE uname='". $o['author'] ."'"));
    echo '<td class="righttd update2"><a href="post.php?id='.$o['id'].'">'. $name2 .'</a><br />By <a style="text-decoration: none;" href="profile.php?id='. $user_id .'">'. $name1 .'</a></td></tr>';
    }
    else
    {
    echo '<td class="righttd update2"><i>No posts</i></td>
</tr>';
    }
 }
}
?>
</tr>
</table>
</div>
<div id="nocontrols" class="phold"></div>
</div>
<?php
}
}
 if(isset($_SESSION['admin']))
  {
      echo '<tr><td width="50%" style="padding-top:7px" colspan="2">';
    echo '<select name="action" style="display:inline">
    <option value="deleteforum">Delete</option>
    <option value="moveforum">Move</option>
    </select> <input type="submit" value="Go" style="display:inline"/>';
    echo '</td></tr>';
  }
?>
</form>
<br /><br />
<div id="contentfrm">
<div class="brown_box_forum brown_box_stack">
<table id="forum_group0" class="forum_group">
<?php 
list($total_posts) = mysql_fetch_row(mysql_query("SELECT COUNT(id) FROM {$prefix}posts"));
list($total_threads) = mysql_fetch_row(mysql_query("SELECT COUNT(id) FROM {$prefix}threads"));
list($total_users) = mysql_fetch_row(mysql_query("SELECT COUNT(id) FROM {$prefix}users"));
list($newest_user, $user_id) = mysql_fetch_row(mysql_query("SELECT uname, id FROM {$prefix}users ORDER BY id DESC LIMIT 1"));
?>
<tr>
<td class="header_groupname" colspan="2">
<div id="showhide_controls0" class="showhide_controls">&nbsp;</div>
<div class="groupname">Forums Statistics</div></td>
</tr>
<tr>
<td style="padding-left: 5px;">
Total Posts: <b><?php echo $total_posts; ?></b><br />
Total Threads: <b><?php echo $total_threads; ?></b><br />
Total Users: <b><?php echo $total_users; ?></b><br />
Welcome to our newest user: <b><?php echo '<a style="color: white; text-decoration: none;" href="profile.php?id='. $user_id .'">'. $newest_user .'</a>'; ?></b>
</td>
</tr>
</table>
</div>
</div>
<tr>
<td>
</tr>
</div>
</div>

</div>
</div>
</div>
<div class="navigation">
<div class="location">
<b>Location: </b> <a href='../index.php'>Home</a> &gt; Forum Home
</div>
</div>
<div id="footer">
<div class="contain">
<div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info">MikeRSWeb</a>.
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
