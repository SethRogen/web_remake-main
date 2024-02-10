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
<script type="text/javascript">

function hide() { this.style.display = 'none'; alert(123); }
</script>
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
	include "../includes/acp_links.php";
?>
<br class="clear" />
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="../index.php">Home</a> &gt;

User Config
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
User Config
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">

<div class="inner_brown_background">
<div class="brown_box">
<div class="subsectionHeader">
User Config
</div>
<div style="text-align:center;" class="inner_brown_box">

<div style="text-align: center">
<?php
if(isset($_SESSION['admin']) || (isset($_SESSION['mod']) && ($_GET['action'] == 'ban' || $_GET['action'] == 'unban')))
{
  if($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    if (is_numeric($_GET['id']) && (is_numeric($_POST['id']) || !isset($_POST['id'])))
    {
      switch ($_POST['action'])
      {
        case 'usertitles':
         mysql_query("UPDATE ". $prefix ."users SET usertitle='". realEscape($_POST['usertitle']) ."' WHERE id=". $_POST['id']);
         echo "<p>User Title Successfully changed. <a href='users.php'>Click here</a> to continue</p>"; 
        break;
        case 'promote':
          if (isset($_POST['promote']) && (($_POST['promote'] == 1 && is_array($_POST['forums'])) || $_POST['promote'] == 2)) {
            if ($_POST['promote'] == 1) {
              $error = 0;
              foreach ($_POST['forums'] as $forum) {
                if (!is_numeric($forum)) {
                  $error = 1;
                  break;
                }
              }
              
              if (!$error) {
                $forums = implode(',', $_POST['forums']);
                $sql = "UPDATE {$prefix}users SET rights=1, forums='{$forums}' WHERE id={$_GET['id']}";
              } else {
                echo '<p>One or more forum IDs were invalid. <a href="userconf.php?id=' . $_GET['id'] . '&action=promote">Back</a>.';
              }
            } else {
              $sql = "UPDATE {$prefix}users SET rights=2 WHERE id={$_GET['id']}";
            }
            if (mysql_query($sql)) {
              echo '<p>User successfully promoted. <a href="../forums/index.php">Back to forums home</a></p>';
            } else {
              echo mysql_error();
            }
          }
        break;
        default:
          echo '<p>No action selected.</p>';
      } 
    }
    else
    {
      echo '<p>Invalid ID.</p>';
    }
  }
  else
  {
    if(is_numeric($_GET['id']))
        {
          $news1 = mysql_query("SELECT * FROM ".$prefix."users WHERE id=". $_GET['id']);
          if(mysql_num_rows($news1) > 0)
          {
            while($n = mysql_fetch_array($news1))
            {
              switch($_GET['action'])
              {
                case 'usertitles':
                  echo '<p><form action="userconf.php?id='. $_GET['id'] .'" method="post">User Title: <input type="text" name="usertitle" value="'. $n['usertitle'] .'"><input type="hidden" name="id" value="'. $_GET['id'] .'"><input type="hidden" name="action" value="usertitles"><br /><input type="submit" value="Submit"></p>';
                break;
                case 'ban':
                  list($rights, $uname) = mysql_fetch_row(mysql_query("SELECT rights, uname FROM {$prefix}users WHERE id={$_GET['id']}"));
                  if ((isset($_SESSION['admin']) || (isset($_SESSION['mod']) && $rights != 2)) && $uname != $_SESSION['user']) {
                    mysql_query("UPDATE ". $prefix ."users SET banned=1 WHERE id=". $_GET['id']);
                    echo "<p>User Successfully banned. <a href='users.php'>Click here</a> to continue</p>"; 
                  }
                  else
                  {
                    echo '<p>You cannot ban this user because it\'s either yourself or one with more rights.</p>';
                  }
                break;
                case 'unban':
                  mysql_query("UPDATE ". $prefix ."users SET banned=0 WHERE id=". $_GET['id']);
                  echo "<p>User Successfully unbanned. <a href='users.php'>Click here</a> to continue</p>"; 
                break;
                case 'promote':
                    echo '<p><form action="userconf.php?id=' . $_GET['id'] . '" method="post">
                    
                    Promote to: <select name="promote" id="promote" onchange="changePromote();">
                                <option value="1">Moderator</option>
                                <option value="2">Administrator</option>
                                </select> <br />
                    <input type="hidden" name="action" value="promote" />
                    <div id="forums" style="margin-top: 3px;">Moderate the following forums <span id="ifmoderator">(only if moderator)</span>: <select style="vertical-align: text-top; width: 200px;overflow-y:auto" name="forums[]" multiple>';
    
                    $result = mysql_query("SELECT id, name FROM {$prefix}sub_categories");
                    while (list($id, $name) = mysql_fetch_row($result)) {
                      echo '<option value="' . $id . '">' . $name . '</option>';
                    }
                    echo '</select></div>' . "<script>
                          var forums = document.getElementById('forums');
                          var ifmoderator = document.getElementById('ifmoderator');
                          
                          ifmoderator.style.display = 'none';
                          
                          function changePromote()
                          {
                            var promote = document.getElementById('promote');
                            
                            if (promote.value == 1) {
                              forums.style.display = 'block';
                            } else {
                              forums.style.display = 'none';
                            }
                          }
                          </script>" . '
                          <input type="submit" value="Submit">
                          </form></p>';
                break;
                case 'demote':
                  mysql_query("UPDATE ". $prefix ."users SET rights=0 WHERE id=". $_GET['id']);
                  echo "<p>User Successfully demoted to user. <a href='users.php'>Click here</a> to continue</p>"; 
                break;
                case 'delete':
                   mysql_query("DELETE FROM ". $prefix ."users WHERE id=". $_GET['id']);
                  echo "<p>User Successfully deleted. <a href='users.php'>Click here</a> to continue</p>"; 
                break;
                case 'ipban':
                   mysql_query("INSERT INTO ". $prefix ."ipban (ip) VALUES ('". $n['ip'] ."')");
                   mysql_query("UPDATE ". $prefix ."users SET banned=1 WHERE id=". $_GET['id']);
                   mysql_query("UPDATE ". $prefix ."users SET ipbanned=1 WHERE id=". $_GET['id']);
                  echo "<p>User Successfully IP Banned. <a href='users.php'>Click here</a> to continue</p>"; 
                break;
                case 'unipban':
                  mysql_query("DELETE FROM ". $prefix ."ipban WHERE ip='". $n['ip'] ."'");
                  mysql_query("UPDATE ". $prefix ."users SET banned=0 WHERE id=". $_GET['id']);
                  mysql_query("UPDATE ". $prefix ."users SET ipbanned=0 WHERE id=". $_GET['id']);
                  echo "<p>User Successfully UN-IP-Banned. <a href='users.php'>Click here</a> to continue</p>"; 
                break;
                default:
                  echo "<p>You did not select an action, you will be redireted to the <a href='users.php'>Users Page</a>.</p>";
                }  
            }
          }
          else
          {
            echo "Invalid ID";
          }
        }
        else
        {
          echo "Invalid ID";
        }
  }
}
else
{
echo "You need to be logged in as administrator to do this";
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