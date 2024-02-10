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

<style type="text/css">/*\*/@import url(../www.runescape.com/layout-<?php echo $ln; ?>/css/forum2-10.css);/**/</style>

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
<b>Location: </b> <a href='../index.php'>Home</a> &gt; <a href="index.php">Forum Home</a> &gt;

<?php echo htmlspecialchars($title); ?> Forums
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
<div id="infotitle">
Forum Admin CP
</div>
<div id="becontrol">
<table>
<tbody><tr id="userview_first_row">
<td class="list">
<ul>
<li><a href="admincp.php?action=addforum">Add Forum</a></li>
<li><a href="admincp.php?action=mainsettings">Forum Settings</a></li>
</ul>
</td>
<td class="space"/>
<td class="viewdetails"><br><br>
<?php
if(isset($_SESSION['admin']))
{
echo '<form action="forums_config.php" method="post">';
	switch($_GET['action'])
	{
	  case 'mainsettings':
	  $check_settings = mysql_query("SELECT * FROM {$prefix}forum_settings");
	  $n = mysql_fetch_array($check_settings);
	   echo '
     Maximum amount of characters per post: <input type="text" name="max_chars" value="'. $n['max_chars'] .'"><br />
     Double Posting: 
     <select name="double_posting">
     <option value="1">Allowed</option>
     <option value="0">Not Allowed</option>
     </select><br />
     <input type="hidden" name="action" value="mainsettings">
     <input type="submit" value="Submit" />
     ';
	  break;
    case 'addforum':
      echo '
      Name: <input type="text" name="name" maxlength="100" style="width: 150px;"><br /><br />
      <input type="hidden" name="action" value="'. htmlentities($_GET['action']) .'">
      Type: <select name="type" style="width: 158px;" onchange="displayimages();">
            <option value="1">Category</option>
            <option value="2">Forum</option>
            </select><br><br />
            <div id="images">
                  Lock Forum?(Mods and Admin threads only): <input id="lock_forum" type="checkbox" name="lock_forum" /><br /><br />
            Information: <input type="text" name="info" maxlength="100" style="width: 300px;"><br /><br />
            Categorie to add forum on: '. check_cat() .'<br /><br />
            Image:<br />
            <div style="padding-left: 20px;">
            <input type="radio" name="image" value="ach_diary" CHECKED /><img src="../www.runescape.com/forum/icons/ach_diary.gif" />
            <input type="radio" name="image" value="area_and_achievement_diary" /><img src="../www.runescape.com/forum/icons/area_and_achievement_diary.gif" />
            <input type="radio" name="image" value="armour_2" /><img src="../www.runescape.com/forum/icons/armour_2.gif" />
            <input type="radio" name="image" value="billing" /><img src="../www.runescape.com/forum/icons/billing.gif" />
            <input type="radio" name="image" value="bug" /><img src="../www.runescape.com/forum/icons/bug.gif" />
            <input type="radio" name="image" value="Character" /><img src="../www.runescape.com/forum/icons/Character.gif" />
            <input type="radio" name="image" value="clan" /><img src="../www.runescape.com/forum/icons/clan.gif" />
            <input type="radio" name="image" value="clan_diplomacy"><img src="../www.runescape.com/forum/icons/clan_diplomacy.gif" />
            <input type="radio" name="image" value="clan_discussions" /><img src="../www.runescape.com/forum/icons/clan_discussions.gif" />
            <input type="radio" name="image" value="clan_homes" /><img src="../www.runescape.com/forum/icons/clan_homes.gif" />
            <input type="radio" name="image" value="clue_scrolls_2" /><img src="../www.runescape.com/forum/icons/clue_scrolls_2.gif" />
            <input type="radio" name="image" value="Combat" /><img src="../www.runescape.com/forum/icons/Combat.gif" />
            <input type="radio" name="image" value="construction_2" /><img src="../www.runescape.com/forum/icons/construction_2.gif" />
            <input type="radio" name="image" value="contact_us" /><img src="../www.runescape.com/forum/icons/contact_us.gif" />
            <input type="radio" name="image" value="crafting_2" /><img src="../www.runescape.com/forum/icons/crafting_2.gif" />
            <input type="radio" name="image" value="discontinued_items_2" /><img src="../www.runescape.com/forum/icons/discontinued_items_2.gif" />
            <input type="radio" name="image" value="diversions" /><img src="../www.runescape.com/forum/icons/diversions.gif" />
            <input type="radio" name="image" value="duelling_2" /><img src="../www.runescape.com/forum/icons/duelling_2.gif" />
            <input type="radio" name="image" value="dutch" /><img src="../www.runescape.com/forum/icons/dutch.gif" />
            <input type="radio" name="image" value="events_2" /><img src="../www.runescape.com/forum/icons/events_2.gif" />
            <input type="radio" name="image" value="farming_2" /><img src="../www.runescape.com/forum/icons/farming_2.gif" />
            <input type="radio" name="image" value="feedback1" /><img src="../www.runescape.com/forum/icons/feedback1.gif" />
            <input type="radio" name="image" value="fin" /><img src="../www.runescape.com/forum/icons/fin.gif" />
            <input type="radio" name="image" value="fletching_2" /><img src="../www.runescape.com/forum/icons/fletching_2.gif" />
            <input type="radio" name="image" value="food_2" /><img src="../www.runescape.com/forum/icons/food_2.gif" />
            <input type="radio" name="image" value="forum_feedback_2" /><img src="../www.runescape.com/forum/icons/forum_feedback_2.gif" />
            <input type="radio" name="image" value="forum_games_2" /><img src="../www.runescape.com/forum/icons/forum_games_2.gif" />
            <input type="radio" name="image" value="future_updates_2" /><img src="../www.runescape.com/forum/icons/future_updates_2.gif" />
            <input type="radio" name="image" value="general_2" /><img src="../www.runescape.com/forum/icons/general_2.gif" />
            <input type="radio" name="image" value="goalsandachievements_2" /><img src="../www.runescape.com/forum/icons/goalsandachievements_2.gif" />
            <input type="radio" name="image" value="Guides" /><img src="../www.runescape.com/forum/icons/Guides.gif" />
            <input type="radio" name="image" value="herblore_2" /><img src="../www.runescape.com/forum/icons/herblore_2.gif" />
            <input type="radio" name="image" value="item_discussion_2" /><img src="../www.runescape.com/forum/icons/item_discussion_2.gif" />
            <input type="radio" name="image" value="jc" /><img src="../www.runescape.com/forum/icons/jc.gif" />
            <input type="radio" name="image" value="Jl_icon" /><img src="../www.runescape.com/forum/icons/Jl_icon.gif" />
            <input type="radio" name="image" value="locations_2" /><img src="../www.runescape.com/forum/icons/locations_2.gif" />
            <input type="radio" name="image" value="minigames2" /><img src="../www.runescape.com/forum/icons/minigames2.gif" />
            <input type="radio" name="image" value="misc_2" /><img src="../www.runescape.com/forum/icons/misc_2.gif" />
            <input type="radio" name="image" value="monsters_2" /><img src="../www.runescape.com/forum/icons/monsters_2.gif" />
            <input type="radio" name="image" value="news_announcements_2" /><img src="../www.runescape.com/forum/icons/news_announcements_2.gif" />
            <input type="radio" name="image" value="off_topic_2" /><img src="../www.runescape.com/forum/icons/off_topic_2.gif" />
            <input type="radio" name="image" value="ores_bars_2" /><img src="../www.runescape.com/forum/icons/ores_bars_2.gif" />
            <input type="radio" name="image" value="player_help_1b" /><img src="../www.runescape.com/forum/icons/player_help_1b.gif" />
            <input type="radio" name="image" value="player_vs_monster" /><img src="../www.runescape.com/forum/icons/player_vs_monster.gif" />
            <input type="radio" name="image" value="Production" /><img src="../www.runescape.com/forum/icons/Production.gif" />
            <input type="radio" name="image" value="quest" /><img src="../www.runescape.com/forum/icons/quest.gif" />
            <input type="radio" name="image" value="rants_2" /><img src="../www.runescape.com/forum/icons/rants_2.gif" />
            <input type="radio" name="image" value="recent_updates_2" /><img src="../www.runescape.com/forum/icons/recent_updates_2.gif" />
            <input type="radio" name="image" value="recruitment_100_1" /><img src="../www.runescape.com/forum/icons/recruitment_100_1.gif" />
            <input type="radio" name="image" value="recruitment_100_2" /><img src="../www.runescape.com/forum/icons/recruitment_100_2.gif" />
            <input type="radio" name="image" value="Recruitment_looking" /><img src="../www.runescape.com/forum/icons/Recruitment_looking.gif" />
            <input type="radio" name="image" value="Resource" /><img src="../www.runescape.com/forum/icons/Resource.gif" />
            <input type="radio" name="image" value="roleplaying_2" /><img src="../www.runescape.com/forum/icons/roleplaying_2.gif" />
            <input type="radio" name="image" value="runes_2" /><img src="../www.runescape.com/forum/icons/runes_2.gif" />
            <input type="radio" name="image" value="Shop-icon"><img src="../www.runescape.com/forum/icons/Shop-icon.gif" />
            <input type="radio" name="image" value="skill" /><img src="../www.runescape.com/forum/icons/skill.gif" />
            <input type="radio" name="image" value="stories_2" /><img src="../www.runescape.com/forum/icons/stories_2.gif" />
            <input type="radio" name="image" value="summoning" /><img src="../www.runescape.com/forum/icons/summoning.gif" />
            <input type="radio" name="image" value="tech_support_2" /><img src="../www.runescape.com/forum/icons/tech_support_2.gif" />
            <input type="radio" name="image" value="treasure_trails_2" /><img src="../www.runescape.com/forum/icons/treasure_trails_2.gif" />
            <input type="radio" name="image" value="weapons_forum_2" /><img src="../www.runescape.com/forum/icons/weapons_forum_2.gif" />
            <input type="radio" name="image" value="web_feedback_2" /><img src="../www.runescape.com/forum/icons/web_feedback_2.gif" />
            </div>
            </div>
            <br />
            <input type="submit" value="Submit">';
    break;
    default:
      echo '<center><b>Please choose a valid action from the menu to the left.</b></center>';
  }
echo '</form>';
}
else
{
  echo '<center><b>You need to be logged in to access the Admin Control Panel.';
}
?>
<script>
document.getElementById('images').style.display = 'none';
function displayimages()
{
  e = document.forms[0].type.value;
  if(e == 1)
  {
    document.getElementById('images').style.display = 'none';
  }
  else
  {
    document.getElementById('images').style.display = 'block';
  }
}
</script>
</td>
</tr>
</tbody></table>
</div>
<div class="center go_back_link"><a href="index.php">Back to forums</a></div>
</div>
</div>

</div>
</div>
</div>
<div class="navigation">
<div class="location">
<b>Location: </b> <a href='../index.php'>Home</a> &gt; <a href="index.php">Forum Home</a> &gt;

<?php echo htmlspecialchars($title); ?> Forums
</div>
</div>
<div id="footer">
<div class="contain">
<div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.<br />
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