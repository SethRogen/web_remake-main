<?php
session_start();
include "../includes/connect.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><link rel="icon" type="image/x-icon" href="favicon.ico" /> 
<meta http-equiv="Content-Language" content="" />
<meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming">
<meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">
<title><?php
       	include "../includes/config.php";
       	echo $title;
       ?></title>
<style type="text/css">/*\*/@import url(../www.runescape.com/layout-<?php echo $ln; ?>/css/global-10.css);/**/</style>

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
<style type="text/css">/*\*/@import url(../www.runescape.com/layout-<?php echo $ln; ?>/css/news1.css);/**/</style>
</head>

<body id="nav">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="index.php" id="logo_select"></a>
<?php include '../includes/toptext_forum_and_acp.php' ?>

<div id="lang">
<a href="#"><img alt="English" src="../www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>
</div>

<div id="headOrangeBottom"></div>
<div id="menubox">
<?php
 include "../includes/acp_links.php";
?>
<br class="clear" />
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;

User Configuration
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
User Configuration
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
<div class="topnav">
&nbsp;<img class="imiddle" border="0" width="60" height="15" hspace="0" vspace="0" alt="" title="" src="http://../www.runescape.com/layout-<?php echo $ln; ?>/img/news/blank.gif">&nbsp;
</div>
<div class="newsBorder">

<table border="0" class="width100" cellspacing=0 id="newsList">
<tr class="row_a">
<td width="30%"><b>Name</b></td><td width="30%"><b>Mail</b></td><td align="right" width="40%"><b>Action</b></td>
</tr>
<?php
if (isset($_SESSION['admin']) || isset($_SESSION['mod'])) {
  $user= mysql_query("SELECT * FROM ".$prefix."users") ;
  if(mysql_num_rows($user) > 0)
  {
    while($n = mysql_fetch_array($user))
    {
      $name = preg_replace('/[a-z]/ie', 'strtoupper($0);', stripslashes($n['uname']), 1);
      echo '<tr class="pad">
      <td valign="middle" style="color: #663300;font-weight: bold;">
       '. $name .'
      </td>
      <td valign="middle" style="color: #663300;font-weight: bold;">'. htmlspecialchars($n['mail']) .'</td>';
      echo '<td align="right" valign="middle">';
      if($n['ipbanned'] == 0)
      {
        if(((isset($_SESSION['mod']) && $n['rights'] != 2) || isset($_SESSION['admin'])) && $n['uname'] != $_SESSION['user']) {
          if($n['banned'] == 0)
          {
            echo '<a href="userconf.php?action=ban&id='. $n['id'] .'">Ban</a>';
          }
          else
          {
            echo '<a href="userconf.php?action=unban&id='. $n['id'] .'">Unban</a>';
          }
        } else {
          echo '<s><b>Ban</b></s>';
        }        
      }
      if (isset($_SESSION['admin'])) {
        echo '|| <a href="userconf.php?action=delete&id='. $n['id'] .'">Delete</a> ||';
        
        if($n['ipbanned'] == 0)
        {
          echo '<a href="userconf.php?action=ipban&id='. $n['id'] .'">IP Ban</a>';
        }
        else
        {
          echo '<a href="userconf.php?action=unipban&id='. $n['id'] .'">Un-IP Ban</a>';
        }
        
        echo ' || ';
        
        if ($n['ipbanned'] == 0) {
          if($n['rights'] == 0)
          {
            echo '<a href="userconf.php?action=promote&id='. $n['id'] .'">Promote</a>';
          }
          else
          {
            echo '<a href="userconf.php?action=demote&id='. $n['id'] .'">Demote</a>';
          }
        }
        echo ' || <a href="userconf.php?action=usertitles&id='. $n['id'] .'">User Title</a>';
      }
      echo '</td></tr>';
    }
  }
  else
  {
  echo '<tr class="pad">
  <td valign="middle">
  <img src="" alt="">
  </td>
  <td valign="middle">Nousers</td>
  
  <td align="right" valign="middle"></td>
  </tr>';
  }
} else {
  echo '<p>You have to be logged in as an administrator to do this.</p>';
}
?>
</table>

</div>
<div class="bottomnav">
&nbsp;<img width="60" height="15" alt="" title="" src="http://../www.runescape.com/layout-<?php echo $ln; ?>/img/news/blank.gif">&nbsp;
</div>
<hr>
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
