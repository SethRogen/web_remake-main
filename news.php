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
       
        echo $title;
       ?></title>
<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/global-10.css);/**/</style>

<script type="text/javascript">
function getPages(loc) {
  if (loc=="top") {
    var item=document.myformtop;
    var toupdate=document.myformbottom;
  }
  else {
    var item=document.myformbottom;
    var toupdate=document.myformtop;
  }
  var pagetoget=parseInt(item.page.value);
  var numpages=parseInt(item.numpages.value);
  if (pagetoget<=numpages) item.submit();
  else {
    try {
     item.page.value=item.currentpage.value;
     toupdate.page.value=item.currentpage.value;
    }catch(err){}
 }
}
</script>
<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/news1.css);/**/</style>
</head>

<body id="nav">
<a name="top"></a>


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
<?php
 if(is_numeric($_GET['id']))
    {
$news = mysql_query("SELECT * FROM ".$prefix."news WHERE id='". $_GET['id'] ."'");
if(mysql_num_rows($news) > 0)
{
  while($n = mysql_fetch_array($news))
  {
?>
<div class="navigation">
<div class="location">
<b>Location: </b> <a href="index.php">Home</a> &gt;

<a href="#">News List</a> > <?php echo htmlspecialchars($n['title']); ?>
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
News
</div>
</div>
</div>
</div>

<div class="section">
<div class="article">
<div class="topshadow">
<div class="bottombordershad">
<div class="leftshadow">
<div class="rightshadow">
<div class="leftcorner">
<div class="rightcorner">
<div class="bottomleftshad">
<div class="bottomrightshad">
<div class="pagepad">
<div class="centre" id="newsitemMenu">

<br><hr>
</div>
<div id="newsTitle">
<!--<img class=imiddle border="0" width="30" height="15" hspace="0" vspace="0" alt="" title="" src="http://www.runescape.com/layout-<?php echo $ln; ?>/img/news/blank.gif">-->
&nbsp;
<b><?php echo date('d-m-Y H:i', strtotime($n['date'])) ." - ". $n['title']; if(isset($_SESSION['admin'])) { echo " || <a href='acp/deletenews.php?id=". $n['id'] ."'>Delete</a> || <a href='acp/editnews.php?id=". $n['id'] ."'>Edit</a>"; }?></b>
&nbsp;
<a href="#">

</a>
</div>
<div class="newsJustify">
<?php
echo nl2br(bbcodes($n['news']));
?>
</div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
 }
}
else
{
  echo "<p>There is no news.</p>";
}
}
else
{
echo "Not a valid id";
}
?>
<br /><br />
<div class="section">
<div class="article">
<div class="topshadow">
<div class="bottombordershad">
<div class="leftshadow">
<div class="rightshadow">
<div class="leftcorner">
<div class="rightcorner">
<div class="bottomleftshad">
<div class="bottomrightshad">
<div class="pagepad">
<div class="centre" id="newsitemMenu">

<br><hr>
</div>
<?php
 if(is_numeric($_GET['id']))
    {
$news = mysql_query("SELECT * FROM ".$prefix."comments WHERE news_id='". $_GET['id'] ."' ORDER BY id DESC");
if(mysql_num_rows($news) > 0)
{
  while($n = mysql_fetch_array($news))
  {
?>
<div id="newsTitle">
<!--<img class=imiddle border="0" width="30" height="15" hspace="0" vspace="0" alt="" title="" src="http://www.runescape.com/layout-<?php echo $ln; ?>/img/news/blank.gif">-->
&nbsp;
<?php
 $comment_name = preg_replace('/[a-z]/ie', 'strtoupper($0);', $n['comment_name'], 1);
?>
<b><?php echo $comment_name . " - ". date('d/m/Y H:i', strtotime($n['comment_date'])) ." - ". htmlspecialchars($n['comment_title']); if(isset($_SESSION['admin'])) { echo " || <a href='acp/deletecomment.php?id=". $n['id'] ."&news_id=". $_GET['id'] ."'>Delete</a>"; } ?></b>
&nbsp;
<a href="#">

</a>
</div>
<div class="newsJustify">
<?php
echo nl2br(bbcodes($n['comment']));
?>
</div>
<div class="clear"></div>
<?php
 }
}
else
{
echo "<center>Currently no comments</center>";
}
}
else
{
echo "Not a valid id";
}
?>
<br><br>
<?php 
if(isset($_SESSION['admin']) || isset($_SESSION['user']))
{
?>
<form id="login_form" action="addcomment.php" method="post">
<div class="section_form">
</div>
<div class="section_form">
<span style="float: left">Title:</span><br>
<input style="float: center" class="input" size="20" type="text" name="title" maxlength="20">
<br class="clear">
</div>
<input type="hidden" name="news_id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
<div class="section_form">
<span style="float: left">Comment:</span><br>
<textarea rows='25' cols='40' name='comment'></textarea>
<br class="clear">
</div>
<div class="section_form">
<input type="submit" class="button-bg" value="Add Comment">
</div>
<div class="section_form">
</div>
</form>
<?php
 }
 else
 {
  echo "<b>You need to be logged in to post a comment</b>";
 }
?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="footer"><div class="contain"><div class="footerdesc">
This website and its contents are copyright &copy; 1999 - 2011 Jagex Ltd. <br />This website is powered by <a href="http://RunescapeCommunitySoftware.info">Runescape Community Software</a>.
</div><a class="jagexlink" href="http://www.jagex.com" target="_blank"><img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png" alt="Jagex" /></a></div></div>
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
