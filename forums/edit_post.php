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
<div id="headImage"><a href="../www.runescape.com/layout-<?php echo $ln; ?>/c=MSvZjwrJOS4/title.ws" id="logo_select"></a>
<?php include '../includes/toptext.php' ?>
<div id="lang">
<a href="../www.runescape.com/layout-<?php echo $ln; ?>/c=MSvZjwrJOS4/title.ws"><img alt="English" src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>
</div>
<div id="headOrangeBottom"></div>
<div id="menubox">
<?php include '../includes/forum_links.php'; ?>

</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;
<a href="index.php">Forums Home</a> >
<?php
if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}posts WHERE id={$_GET['id']}")) : false)
{
  $forum_get_cat_title = mysql_query('SELECT name FROM '.$prefix.'threads WHERE id='. $_GET['id']);
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
<?php echo htmlspecialchars($title); ?> Forums
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">
<div id="contrast_panel">
<?php
list($char_limit) = mysql_fetch_row(mysql_query("SELECT max_chars FROM {$prefix}forum_settings"));
if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}posts WHERE id={$_GET['id']}")) : false)
{
  $p = mysql_fetch_assoc(mysql_query('SELECT * FROM '.$prefix.'posts WHERE id='. $_GET['id']));
  $n = mysql_fetch_assoc(mysql_query('SELECT locked FROM '.$prefix.'threads WHERE id='. $p['thread_id']));
  list($fid) = mysql_fetch_row(mysql_query("SELECT sub_cat_id FROM {$prefix}threads WHERE id = (SELECT thread_id FROM {$prefix}posts WHERE id={$_GET['id']})"));
  if($_SESSION['user'] == $p['author'] || isset($_SESSION['admin']) || (isset($_SESSION['mod']) && in_array($fid, $_SESSION['forums'])))
  {
    if($n['locked'] == 0)
    {
      if($_SERVER['REQUEST_METHOD'] == 'POST')
      {
      if (strlen($_POST['contents']) <= $char_limit) {
      
        if(empty($_POST['contents']))
        {
            echo '<div id="commandtitle"><div class="bk"></div><div class="cont">';
            echo '<center>You have left one or more fields blank.</center>';
            echo '</div></div>';
        }
        else
        {
            mysql_query('UPDATE '. $prefix .'posts SET post="'. realEscape($_POST['contents']) .'" WHERE id='. $_GET['id']);
            echo '<div id="commandtitle"><div class="bk"></div><div class="cont">';
            echo '<center>You have successfully edited your post. <a href="post.php?id='. $_POST['thread_id'] .'">Click Here</a> to return to the thread.</center>';
            echo '</div></div>';
        }
        }
        else
        {
          echo '<div id="commandtitle"><div class="bk"></div><div class="cont">';
          echo '<center>Your post contains too many characters.</center>';
          echo '</div></div>';
        }
      }
      else
      {
?>
<div id="commandtitle">
<div class="bk"></div><div class="cont">
Reply to a thread
</div>
</div>
<div id="menu">
<ul class="flat">
<li><a href="post.php?id=<?php echo $p['thread_id']; ?>">Return to post</a></li>
</ul>
</div>
<div id="command">
<form method="post" action="edit_post.php?id=<?php echo $_GET['id']; ?>">
<table>
<input type="hidden" name="thread_id" value="<?php echo $p['thread_id']; ?>">
<tr>
<td class="commandtwo" colspan="2">
<textarea id="charlimit_text_a" name="contents" rows="20" cols="60"><?php echo $p['post']; ?></textarea><br>
You have <span id="charlimit_count_a"><?php echo $char_limit; ?></span> characters <span id="charlimit_info_a" style="display: none">remaining</span> for your message.

</td>
</tr>
<tr>
<td class="commandtwo" colspan="2">
<input type="submit" name="add" class="buttonmedium" value="Edit Post"> &nbsp; &nbsp;
</td>
</tr>
</table>
</form>
</div>
<div id="smileylegend">

<span class="title">Smileys: </span><br><span id="smilytxt" style="display:hidden;">Click to add a smiley to your message (will overwrite selected text).</span><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley(':)')"><IMG class=sm0 alt=":)" title=":)" src="../www.runescape.com/forum/smileys/smile.gif"> :)</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley(';)')"><IMG class=sm1 alt=";)" title=";)" src="../www.runescape.com/forum/smileys/wink.gif"> ;)</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley(':P')"><IMG class=sm2 alt=":P" title=":P" src="../www.runescape.com/forum/smileys/tongue.gif"> :P</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley(':(')"><IMG class=sm3 alt=":(" title=":(" src="../www.runescape.com/forum/smileys/sad.gif"> :(</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley(':|')"><IMG class=sm4 alt=":|" title=":|" src="../www.runescape.com/forum/smileys/nosmile.gif"> :|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley('O_o')"><IMG class=sm5 alt="O_o" title="O_o" src="../www.runescape.com/forum/smileys/o.O.gif"> O_o</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley(':D')"><IMG class=sm6 alt=":D" title=":D" src="../www.runescape.com/forum/smileys/bigsmile.gif"> :D</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley('^^')"><IMG class=sm7 alt="^^" title="^^" src="../www.runescape.com/forum/smileys/^^.gif"> ^^</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley(':O')"><IMG class=sm8 alt=":O" title=":O" src="../www.runescape.com/forum/smileys/shocked.gif"> :O</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span onclick="addsmiley(':@')"><IMG class=sm9 alt=":@" title=":@" src="../www.runescape.com/forum/smileys/angry.gif"> :@</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<script language="JavaScript">
document.getElementById("smilytxt").style.display='';
function addsmiley(code) {
  var msgtext=document.getElementById("charlimit_text_a");
  msgtext.focus();
  if (document.selection && document.selection.createRange && !msgtext.setSelection) { document.selection.createRange().text=code; } //ie
  else{
      // not ie
    var pretext = msgtext.value.substring(0,msgtext.selectionStart);
    var pos = msgtext.selectionStart;
     var posttext = msgtext.value.substring(msgtext.selectionEnd, msgtext.value.length);
    msgtext.value = pretext + code + posttext;
    msgtext.selectionEnd=pos+code.length;
  }
}

</script>
<script type="text/javascript">
 
var alerted=false;
function do_watch(msg, element, count, max, submit) {
 try {
  var stri=element.value.replace(/\r/g, "");
  if(submit) if(stri.length>max) submit.disabled=true;
  if(stri.length>max) {
   if(msg==true && alerted==false) {
    alert('You have gone over your character limit for this message');
    alerted=true;
   }
   element.value=stri=stri.substring(0,max);
  }
  count.childNodes[0].nodeValue=max-stri.length;
 }
 catch(e) {}
}
function install_watch(msg, element, count, max, form, submit, reset) {
 try {
  element.onkeyup=function() {
   do_watch(msg, element, count, max, submit);
  };
  element.onkeydown=function() {
   do_watch(msg, element, count, max, submit);
  };
  element.onkeypress=function() {
   do_watch(msg, element, count, max, submit);
  };
  element.onmousemove=function() {
   do_watch(msg, element, count, max, submit);
  };
  element.onchange=function() {
   do_watch(false, element, count, max, submit);
  };
  if(form) {
   form.onsubmit=function() {
    do_watch(msg, element, count, max, submit);
   }; 
  }
  if(reset && form) {
   reset.onclick=function() {
    form.reset();
    do_watch(msg, element, count, max, submit);
   }
  }
  do_watch(false, element, count, max, submit);
 }
 catch(e) {}
}
var charlimiter_run=false;
function install_charlimiters() {
 if(charlimiter_run) return;
 charlimiter_run=true;
 try {
  var textboxes=document.getElementsByTagName("textarea");
  for(var i=0; i<textboxes.length; i++) install(textboxes[i]);
  var inputs=document.getElementsByTagName("input");
  for(var i=0; i<inputs.length; i++) install(inputs[i]);
 }
 catch(e) {}
}
function install(element) {
 var textbox_id_len = new String("charlimit_text").length;
 var text_id=element.id.toString();
 if(text_id.match(/^charlimit_text/i) && text_id.length>=textbox_id_len) {
  var identifier=text_id.substr(textbox_id_len);
  var info=document.getElementById("charlimit_info" + identifier);
  var count=document.getElementById("charlimit_count" + identifier);
  var form=document.getElementById("charlimit_form" + identifier);
  var submit=document.getElementById("charlimit_submit" + identifier);
  var reset=document.getElementById("charlimit_reset" + identifier);
  if(info && count) {
   var msg=false;
   if(identifier.match(/^_msg/i)) msg=true;
   var max_val=parseInt(count.childNodes[0].nodeValue);
   install_watch(msg, element, count, max_val, form, submit, reset);
   info.style.display='inline';
  }
 }
}
if(window.addEventListener) window.addEventListener('load', install_charlimiters, true);
else if(window.attachEvent) window.attachEvent('onload', install_charlimiters);
else window.onload=install_charlimiters;

</script>

</div>
</div>
<?php
 }
 }
 else
 {
 echo '<br><br>';
 echo '<b><center>This thread has been locked. <a href="index.php">Return to the forums home</a>.</center></b>';
 echo '<br><br>';
 }
 }
 else
 {
 echo "<center><b>This is not your post. <a href='post.php?id={$p['thread_id']}'>Click Here</a> to return to the post.";
 }
 }
 else
 {
 echo '<br><br>';
 echo '<b><center>Invalid ID. <a href="index.php">Return to the forums home</a>.</center></b>';
 echo '<br><br>';
 }
?>
</div>
</div>
</div>
<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;
<a href="index.php">Forums Home</a> >
<?php
if(isset($_GET['id']) && is_numeric($_GET['id']) ? mysql_num_rows(mysql_query("SELECT id FROM {$prefix}posts WHERE id={$_GET['id']}")) : false)
 {
$forum_get_cat_title = mysql_query('SELECT name FROM '.$prefix.'threads WHERE id='. $_GET['id']);
  if(mysql_num_rows($forum_get_cat_title) > 0)
  {
    $p = mysql_fetch_assoc($forum_get_cat_title);
    echo $p['name'];
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
