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
	include "../includes/forum_links.php";
?>
<br class="clear" />
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;

Forum Config
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
Forum Config
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">

<div class="inner_brown_background">
<div class="brown_box">
<div class="subsectionHeader">
Forum Config
</div>
<div style="text-align:center;" class="inner_brown_box">

<div style="text-align: center">
<?php
if(isset($_SESSION['admin']))
{
  switch($_POST['action'])
  {
    case 'mainsettings':
      if ($_POST['double_posting'] == 1 || $_POST['double_posting'] == 0) {
        mysql_query("UPDATE {$prefix}forum_settings SET double_posting={$_POST['double_posting']}, max_chars=". realEscape($_POST['max_chars']));
        echo '<p>Settings successfully changes. <a href="index.php">Back to the forum index</a>.</p>';
      } else {
        echo '<p>Invalid value for double posting. <a href="admincp.php">Back to admin CP</a>.</p>';
      }
    break;
    case 'moveforum':
        if (isset($_POST['forum'])) {
          if (isset($_POST['to']) && is_numeric($_POST['to'])) {
            $result = mysql_query("SELECT COUNT(id) FROM {$prefix}categories WHERE id={$_POST['to']}");
            list($count) = mysql_fetch_row($result);
            $authorized = false;
            foreach ($_POST['forum'] as $forum) {
              if (!is_numeric($forum)) {
                $authorized = true;
                break;
              }
              if(isset($_SESSION['admin']))
              {
                $authorized = true;
                break;
              }
            }
            if ($authorized) {
              $ids = implode(', ', $_POST['forum']);
              if ($count == 1) {
                if ($result = mysql_query("UPDATE {$prefix}sub_categories SET cat_id = {$_POST['to']} WHERE id IN ($ids)")) {
                  echo '<p>Forum(s) successfully moved. <a href="index.php">Back to forum</a>.</p>';
                }      
              } else {
                echo '<p>One or more forums were not numeric.</p>';
              }
            }
          } else {
            echo '<form action="forums_config.php" method="post">'
                . '<input type="hidden" name="action" value="moveforum" />';
            foreach ($_POST['forum'] as &$val) {
              echo '<input type="hidden" name="forum[]" value="' . $val . '" />';
            }
            echo 'To: <select name="to">';
            $result = mysql_query('SELECT id, name FROM ' . $prefix . 'categories');
            while (list($id, $name) = mysql_fetch_row($result)) { 
                echo '<option value="' . $id . '">' . htmlspecialchars($name) . '</option>';
            }
            echo '</select> <input type="submit" value="Submit" /></form>';
          }
        }
        else
        {
          echo '<p>Please select one or more forums to move.</p>';
        }
    break;
    case 'addforum':
    if($_POST['type'] == 1)
    {
      mysql_query("INSERT INTO {$prefix}categories (name) VALUES ('". realEscape($_POST['name']) ."')");
      echo '<p>Category successfully added. <a href="index.php">Click Here</a> to view your category.</p>';
    }
    else
    {
      mysql_query("INSERT INTO {$prefix}sub_categories (cat_id, name, info, image, forum_locked) VALUES (". realEscape($_POST['category']) .", '". realEscape($_POST['name'])."', '". realEscape($_POST['info'])."', '". realEscape($_POST['image']) ."', ". (int)($_POST['lock_forum'] != NULL)  .")");
      echo '<p>Forum successfully added. <a href="index.php">Click Here</a> to view your forum.</p>';
    }
    break;
    case 'deleteforum':
    if($_POST['cat'] !== NULL)
    {
    $ids1 = implode(', ', $_POST['cat']);
    $error = false;
    foreach($_POST['cat'] as $cat)
    {
      if(!is_numeric($cat))
      {
        $error = true;
        break;
      }
    }
    }
    if($_POST['forum'] !== NULL)
    {
    $ids2 = implode(', ', $_POST['forum']);
    $error = false;
    foreach($_POST['forum'] as $forum)
    {
      if(!is_numeric($forum))
      {
        $error = true;
        break;
      }
    }
    }
      if(
      mysql_query("DELETE FROM {$prefix}posts WHERE thread_id IN (SELECT id FROM {$prefix}threads WHERE sub_cat_id IN (SELECT id FROM {$prefix}sub_categories WHERE cat_id IN ($ids1)))") &&
      mysql_query("DELETE FROM {$prefix}threads WHERE sub_cat_id IN (SELECT id FROM {$prefix}sub_categories WHERE cat_id IN ($ids1))") &&
      mysql_query("DELETE FROM {$prefix}sub_categories WHERE cat_id IN ($ids1)") &&
      mysql_query("DELETE FROM {$prefix}categories WHERE id IN ($ids1)"))
      {
        echo '<p>Categorie(s) successfully deleted. <a href="index.php">Back to forum</a>.</p>';
      }
      if(
      mysql_query("DELETE FROM {$prefix}posts WHERE thread_id IN (SELECT id FROM {$prefix}threads WHERE sub_cat_id IN ($ids2))") &&
      mysql_query("DELETE FROM {$prefix}threads WHERE sub_cat_id IN ($ids2)") &&
      mysql_query("DELETE FROM {$prefix}sub_categories WHERE id IN ($ids2)"))
      {
        echo '<p>Forum(s) successfully deleted. <a href="index.php">Back to forum</a>.</p>';
      }
    break;
    default:
      echo '<p>You havnt chosen a valid action. Please choose one <a href="admincp.php">Here</a>.</p>';
  }
}
else
{
  echo '<p>You need to be logged in as an administrator to do this.</p>';
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
