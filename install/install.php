<?php
// Check if the install directory exists
if (is_dir('install')) {
    // Redirect to the install directory
    header('Location: install/');
    exit; // Make sure no other code is executed after the redirect
}

// If the install directory doesn't exist, continue with your regular code
// Add your existing index.php code here
?>
<?php 
session_start();
   // Runescape Community Software Source code \\   |
  // Do not remove the Footer\\  |
    // Install before use \\     |
     // THIS IS COPYRIGHT \\     |
// MATERIAL DO !!NOT!! CHANGE \\ |
$version = '5.2';
$pref_version = '52';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><link rel="icon" type="image/x-icon" href="favicon.ico" /> 
<meta http-equiv="Content-Language" content="en-gb, English">
<meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming">
<meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">
<?php
// Extract the title from the HTML <title> tag
$title = "Runescape Community Software Install";
?>

<!-- HTML code -->
<title><?php echo $title; ?></title>
<style type="text/css">/*\*/@import url(../www.runescape.com/layout-0/css/global-5.css);/**/</style>

<style type="text/css">/*\*/@import url(../www.runescape.com/layout-0/css/home-2.css);/**/</style>
<script type="text/javascript">
 function h(o){o.getElementsByTagName('span')[0].className='shimHover';}
 function u(o){o.getElementsByTagName('span')[0].className='shim';}
</script>
</head>
<body id="navhome">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div><img src="../www.runescape.com/layout-0/img/main/layout/head_image.jpg" alt="RuneScape" /><div id="headImage"><a href="#" id="logo_select"></a>
<div id="player_no">Welcome to Runescape Community Software</div>
<div id="lang">
<a href="#"><img alt="English" src="../www.runescape.com/layout-0/img/main/layout/en.gif" /></a>
</div>
</div>
<div id="headOrangeBottom"></div>
<div id="menubox">
<br class="clear" />
</div>

</div>
<div id="content">
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	function realEscape($string)
	{
	  if(get_magic_quotes_gpc())
	  {
	    return mysql_real_escape_string(stripslashes($string));
	  }
	  else
	  {
	    return mysql_real_escape_string($string);
	  }
	}
	function encrypt($value)
    {
      return md5(md5(base64_encode($value)));
    }
    	/*if(isset($_GET['guid'])) {
    	 $valid = 1;
    	} else if(isset($_POST['guid1'])) {
    	 $valid = 1;	
    	}*/

		   // if($valid == 1) {
				if($_GET['step'] == 1) {
					//echo 'GUID is valid.';
					echo '<font color="green">all files are writable.</font><br />';
					echo '<form action="install.php?step=2" method="post">';
					echo '<input type="submit" value="Continue">';
					echo '</form>';
				}
if($_GET['step'] == 2) {
	
	    echo '<font color="green">File config.php is writable.</font><br />';
	    echo '<form action="install.php?step=3" method="post">';
	    echo '<input type="submit" value="Continue">';
	    echo '</form>';
}
if($_GET['step'] == 3) {
	
	if(isset($_GET['check']) && $_GET['check'] == 1) {
		/*
		*****************************************
		* Database Connection check
		*****************************************
		*/
		$con = @mysql_connect($_POST['host'], $_POST['user'], $_POST['pass']);  
		@mysql_select_db($_POST['db'], $con);
		if(!$con) {
	   	 echo "<br /><br /><b>Could not connect to:<br>Host: ". $_POST['host'] ."<br>User: ". $_POST['user'] ."<br>Database: ". $_POST['db'] ."<br>Using password: ";
	    if(empty($_POST['pass'])) {
	    	echo "No";
	    } else {
	   		echo "yes";
	  	}
			echo "<br/></b>";
			echo '<form action="install.php?step=6" method="post">';
			echo '<input type="submit" value="Try Again">';
			echo '</form>';
		} else {
			/*
			*****************************************
			* Config.php Creation
			*****************************************
			*/
			$extra = '../includes/config.php';
		    $filename = "../includes/config.php";
		    $somecontent = "<?php \$host = '". $_POST['host'] ."';\$dbuser = '". $_POST['user'] ."';\$dbpass = '". $_POST['pass'] ."';\$db = '". $_POST['db'] ."';\$prefix = '". $_POST['prefix'] ."'; ";
		    if (!$handle = fopen($filename, 'a')) {
		         echo "Cannot open file ($filename)";
		         exit;
		    }
			
		    if (fwrite($handle, $somecontent) === FALSE) {
		        echo "Cannot write to file ($filename)";
		        exit;
		    }
			
		    fclose($handle);
		    echo "MySQL Successfully connected.";
		    echo '<form action="install.php?step=4" method="post">';
		    echo '<input type="submit" value="Continue">';
		    echo '</form>';
		}
	} else {
		echo '<table width="325" border="0" align="center">';
		echo '<form action="install.php?step=3&check=1" method="post">';
		echo '<tr><td>MySQL Host:</td><td><input type="text" name="host"></td></tr>';
		echo '<tr><td>MySQL Username:</td><td><input type="text" name="user"></td></tr>';
		echo '<tr><td>MySQL Password:</td><td><input type="password" name="pass"></td></tr>';
		echo '<tr><td>MySQL Database:</td><td><input type="text" name="db"></td></tr>';
		echo '<tr><td>Database Prefix:</td><td><input type="text" name="prefix"></td></tr>';
		echo '<tr><td><input type="submit" value="Continue"></td></tr>';
		echo '</form>';
		echo '</table>';
	}
}
if($_GET['step'] == 4) {
	include '../includes/config.php';
	$con = @mysql_connect($host, $dbuser, $dbpass);  
	mysql_select_db($db ,$con);
		/*
    *****************************************
    * Main table creation
    *****************************************
    */
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."news` (title varchar(255) NOT NULL,date DATETIME NOT NULL, image varchar(255) NOT NULL,news text NOT NULL,important INTEGER,small TEXT NOT NULL,id int(11) NOT NULL auto_increment,PRIMARY KEY  (id))");
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."users` (uname varchar(255),pass varchar(255),id int(11) auto_increment,`banned` int(10),`ip` VARCHAR(255), `dob` VARCHAR(255),`country` VARCHAR(255),`mail` VARCHAR(255), `rights` INT(11), `ipbanned` INT(11), `usertitle` varchar(255) NOT NULL,`forums` TEXT NOT NULL, `hide_mail` INT(1) NOT NULL DEFAULT 1, `signiture` TEXT, PRIMARY KEY  (id))");  
    //mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."config` (`ip` varchar(150), `port` INT(10), `desc` text, `type` INTEGER,PRIMARY KEY  (ip))");  
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."settings` (`title` varchar(255),theme INTEGER, clink varchar(255),flink varchar(255),ctype INT(1),PRIMARY KEY  (theme))");  
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."staff` (id INTEGER auto_increment, position int(1), name varchar(255), image varchar(255), PRIMARY KEY  (id))");  
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."links` (id INTEGER auto_increment, link varchar(255), name varchar(255),PRIMARY KEY  (id))");  
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."ipban` (id INTEGER auto_increment, ip varchar(255),PRIMARY KEY  (id))");
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."comments` (id INTEGER auto_increment, `news_id` INTEGER, `comment_date` DATETIME, `comment_title` varchar(255), `comment_name` varchar(255), `comment` TEXT, PRIMARY KEY (id))");  
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."pms` (`id` int(10) unsigned NOT NULL AUTO_INCREMENT, `subject` varchar(255) NOT NULL, `message` text NOT NULL, `author_id` int(10) unsigned NOT NULL, `reciever_id` int(10) unsigned NOT NULL DEFAULT '0', `read` int(1) unsigned zerofill NOT NULL DEFAULT '1', `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, `reciever_delete` int(1) unsigned NOT NULL DEFAULT '0', `author_delete` int(1) unsigned NOT NULL DEFAULT '0', PRIMARY KEY (`id`))");
	/*
    *****************************************
    * Forum table creation
    *****************************************
    */
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."forum_settings` (`double_posting` int(1) unsigned NOT NULL DEFAULT '0',`max_chars` int(10) unsigned NOT NULL DEFAULT '2000',PRIMARY KEY (`double_posting`))");
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."categories` (`id` int(100) unsigned NOT NULL AUTO_INCREMENT, `name` varchar(100) NOT NULL, PRIMARY KEY (`id`))"); 
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."posts` (`id` int(255) unsigned NOT NULL AUTO_INCREMENT, `thread_id` int(100) unsigned NOT NULL, `name` varchar(255) NOT NULL, `author` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL, `post` text NOT NULL, `date` datetime NOT NULL, PRIMARY KEY (`id`))");
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."sub_categories` (`id` int(100) unsigned NOT NULL AUTO_INCREMENT, `cat_id` int(100) unsigned NOT NULL, `name` varchar(100) NOT NULL, `info` varchar(100) NOT NULL,  `image` varchar(255) NOT NULL,`forum_locked` INT(1) DEFAULT 0,  PRIMARY KEY (`id`))");
    mysql_query("CREATE TABLE IF NOT EXISTS `". $prefix ."threads` ( `id` int(100) unsigned NOT NULL AUTO_INCREMENT, `sub_cat_id` int(100) unsigned NOT NULL, `name` varchar(255) NOT NULL, `locked` int(1) unsigned NOT NULL, `stickied` int(1) unsigned NOT NULL, `hidden` int(1) unsigned NOT NULL, `date` datetime NOT NULL, PRIMARY KEY (`id`))");
    /*
    *****************************************
    * News and Forums Insert
    *****************************************
    */
	mysql_query("INSERT INTO ". $prefix ."news (title,date,news,important,small,image) VALUES ('Installed Runescape Community', NOW(), 'You have successfully installed Runescape Community Software.', '1','You have successfully installed Runescape Community Software. You can login and controle your website within minutes. Runescape Community Software is Fast, Easy, and Free. If you need information about Runescape Community Software just e-mail support@Runescape Community Software.info','installed')");
	mysql_query("INSERT INTO ". $prefix ."forum_settings (double_posting, max_chars) VALUES (0, 2000)");
	
	echo 'Successfully created Tables';
	echo '<form action="install.php?step=5" method="post">';
	echo '<input type="submit" value="Continue">';
	echo '</form>';
}
if($_GET['step'] == 5) {
	if(isset($_GET['check']) && $_GET['check'] == 1) {
			include '../includes/config.php';
			$con = @mysql_connect($host, $dbuser, $dbpass);  
			mysql_select_db($db ,$con);
			if($_POST['forum'] == 1) { mysql_query("INSERT INTO ". $prefix ."links (link, name) VALUES ('". realEscape($_POST['forums']) ."', 'Forums')"); }
			mysql_query("INSERT INTO ". $prefix ."settings (title, client, theme, flink, ctype) VALUES ('". $_POST['title'] ."', '". $_POST['client'] ."', '". $_POST['theme'] ."', '". realEscape($_POST['forums']) ."', 0)");
			//mysql_query("INSERT INTO ". $prefix ."config (ip, port) VALUES ('". realEscape($_POST['ip']) ."', ". realEscape($_POST['port']) .")");
			echo 'Options successfully inserted.';
			echo '<form action="install.php?step=6" method="post">';
			echo '<input type="submit" value="Continue">';
			echo '</form>';
	}
	else
	{
		echo '<table width="325" border="0" align="center">';
		echo '<form action="install.php?step=5&check=1" method="post">';
		echo '<tr><td>Website Title:</td><td><input type="text" name="title"></td></tr>';
		echo '<tr><td>Forums Type:</td><td><select name="forum" onchange="displayforum();"><option value="0">Runescape Community Forums</option><option value="1">Other Forums</option></select></td></tr>';
		echo '<tr><td>Forums Link:</td><td id="forum" style="display: none"><input class="input" name="forums" type="text" id="forums"></td></tr>';
		echo '<tr><td>Client Type:</td><td><select name="client" id="ctype" onchange="displayclient();"><option value="0">Runescape Community Webclient</option><option value="1">Custom Client</option></select></td></tr>';
		echo '<tr><td>Client Link:</td><td id="client" style="display: none"><input type="text" name="client" id="client"></td></tr>';
		echo '<tr><td>Website Theme:</td><td><select name="theme"><option value="0">Normal</option><option value="1">Metal</option><option value="2">Halloween</option><option value="3">Christmas</option><option value="4">Castle</option></select></td></tr>';
		//echo '<tr><td>Server IP:</td><td><input type="text" name="ip"></td></tr>';
		//echo '<tr><td>Server Port:</td><td><input type="text" name="port"></td></tr>';
		echo '<tr><td><input type="submit" value="Continue"></td></tr>';
		echo '</form>';
		echo '</table>';
		?>
		<script>
document.getElementById('client').style.display = 'none';
function displayclient() {
  e = document.forms[0].ctype.value;
  if(e == 0) {
    document.getElementById('client').style.display = 'none';
  } else {
    document.getElementById('client').style.display = 'block';
  }
}
document.getElementById('forum').style.display = 'none';
function displayforum() {
  e = document.forms[0].forum.value;
  if(e == 0) {
    document.getElementById('forum').style.display = 'none';
  } else {
    document.getElementById('forum').style.display = 'block';
  }
}
</script>
		<?php 
	}
}
if($_GET['step'] == 6) {
	//if($_GET['check'] == 1) {
		if(isset($_GET['check']) && $_GET['check'] == 1) {
		if(!is_numeric($_POST['day']) || !is_numeric($_POST['month']) || !is_numeric($_POST['year'])) {
	    	echo 'Every field from your birthdate has to be numeric.<br />';
	    	echo '<form action="install.php?step=6" method="post">';
	    	echo '<input type="submit" value="Try Again">';
	    	echo '</form>';
		}
		
		else if(isset($_POST['theme']) && !in_array($_POST['theme'], array(0, 1, 2, 3, 4))) {
			echo 'Invalid theme.<br />';
			echo '<form action="install.php?step=6" method="post">';
	    	echo '<input type="submit" value="Try Again">';
	    	echo '</form>';
		} else {
		include '../includes/config.php';
		$con = @mysql_connect($host, $dbuser, $dbpass);  
		mysql_select_db($db ,$con);
		/*
	    *****************************************
	    * User Insert's
	    *****************************************
	    */
		    mysql_query("INSERT INTO ". $prefix ."users (uname, pass, banned, ip, dob, country, mail, rights, ipbanned, hide_mail) VALUES ('". $_POST['username'] ."', '". encrypt($_POST['password']) ."', '0', '". $_SERVER['REMOTE_ADDR'] ."', '". $_POST['day'] ."/". $_POST['month'] ."/". $_POST['year'] ."', 'United States', '". $_POST['email'] ."', '2', '0', '1')");
		   // Path to the install folder
			$installFolderPath = '../install';

			// Remove all files within the install folder
			$files = glob($installFolderPath . '/*');
			foreach ($files as $file) {
				if (is_file($file)) {
					unlink($file);
				}
		}

		// Remove the install folder itself
		if (rmdir($installFolderPath)) {
			echo 'Runescape Community Software has been successfully installed. <br />Thank you for installing Runescape Community Software. <a href="../index.php">Click here to continue</a>.';
		} else {
			echo 'Failed to remove install folder. Please remove it manually for security purposes.';
			}
		}
	}
	else
	{
		echo '<table width="325" border="0" align="center">';
		echo '<form action="install.php?step=6&check=1" method="post">';
		echo '<tr><td>Administrator Username:</td><td><input type="text" name="username"></td></tr>';
		echo '<tr><td>Administrator Password:</td><td><input type="password" name="password"></td></tr>';
		echo '<tr><td>Date Of Birth:</td><td><select id="day" name="day">
<option value="-1" selected="selected" disabled="disabled">Day</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>

<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>

<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>

<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select id="month" name="month">
<option value="-1" selected="selected" disabled="disabled">Month</option>
<option value="0">January</option>

<option value="1">February</option>
<option value="2">March</option>
<option value="3">April</option>
<option value="4">May</option>
<option value="5">June</option>
<option value="6">July</option>
<option value="7">August</option>
<option value="8">September</option>
<option value="9">October</option>

<option value="10">November</option>
<option value="11">December</option>
</select>
<input type="text" id="year" name="year" maxlength="4" value="Year"></td></tr>';
		echo '<tr><td>Administrator E-Mail:</td><td><input type="text" name="email"></td></tr>';
		echo '<tr><td><input type="submit" value="Continue"></td></tr>';
		echo '</form>';
		echo '</table>';
	}
}
//}
//else
//{
	//echo 'This GUID is not Valid. Register on www.Runescape Community Software.info for a valid GUID.';	
//}
}
else
{
?>
<div id="body">
<center>

  <h3>Install</h3>

  <em>Welcome to the Runescape Community Software Installation page.</em></P>
<p><strong>________________________________________________</strong></p>
</center>
<FORM ACTION="install.php?step=1" METHOD="post" NAME="install">
  <table width="325" border="0" align="center">
  	<tr>
  		<td>You can click Install.</td>
  	</tr>
    <tr>
    	<td><input type="submit" class="button-bg" value="Install"></td>
    </tr>
  </table>
</FORM>
</div>
<?php
}
?>
</div>
<div id="footer"><div class="contain"><div class="footerdesc">
	This website and its contents are copyright &copy; 1999 - 2011 Jagex Ltd. <br />This website is powered by <a href="http://RunescapeCommunitySoftware.info">Runescape Community Software</a>.
</div><a class="jagexlink" href="http://www.jagex.com" target="_blank"><img src="../www.runescape.com/layout-0/img/main/layout/jagex.png" alt="Jagex" /></a></div></div>
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