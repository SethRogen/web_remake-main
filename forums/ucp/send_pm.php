<?php
session_start();
include "../../includes/connect.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<style type="text/css">
.top-spacer { margin-top: 10px; }
.top-spacer20 { margin-top: 20px; }
.bottom-spacer { margin-bottom: 10px; }
.bottom-spacer20 { margin-bottom: 20px; }
.centered { text-align: center; }
div.centered, table.centered {
 margin-left: auto;
 margin-right: auto;
}
#supportform {
 padding-top: 5px;
 padding-bottom: 10px;
 padding-left: 10px;
}
#supportform div{
 margin-top: 5px;
}
ol {
 margin-top: 0px;
}
</style>

<title><?php echo $title;?></title>
<link href="../../www.runescape.com/forum/print-31.css" rel="stylesheet" type="text/css" media="print">
<link href="" rel="stylesheet" type="text/css" media="print">
<style type="text/css" media="screen">
@import url("../../www.runescape.com/forum/global-31.css");
@import url("../../www.runescape.com/forum/jagex/pm.css");
</style>
<body id="body">


<div id="container">
<?php 
if(isset($_SESSION['user']))
{
?>
<div id="header">
<ul id="headerNavLarge">
<li><span><?php echo capitalize($_SESSION['user']); ?> logged in</span></li>
</ul>
<ul id="headerNav">
<li><span><a href="send_pm.php">Send PM</a> | <a href="../../index.php">Home</a> | <a href="../../logout.php">Logout</a></span></li>

</ul>
<div id="innerHeader">
<span id="innerHeaderLogoRuneScape">
<a id="innerHeaderLogoLink" href="../../index.php"></a>
</span>
<span id="innerHeaderCnr"></span>
</div>
</div>
<?php 
}
?>
<div id="content">
<div id="contentLeft">
<div class="title"><span>

<div class="title_left">Send a message</div>
<div class="title_right"><a href="pm.php">Back to Message Centre</a></div>
</span></div>
<?php 
if(isset($_SESSION['user']))
{
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$check_if_user_exists = mysql_query("SELECT id FROM {$prefix}users WHERE uname='". realEscape($_POST['to']) ."'");
	if($_POST['to'] == $_SESSION['user'])
	{
		echo "<center>You cant send a message to yourself</center>";
	}
	else
	{
		if(mysql_num_rows($check_if_user_exists) > 0)
		{
			$user_information = mysql_fetch_assoc($check_if_user_exists);
			if(!empty($_POST['to']) || !empty($_POST['subject']) || !empty($_POST['message']))
			{
				mysql_query("INSERT INTO {$prefix}pms (subject, message, author_id, reciever_id, `read`, reciever_delete, author_delete) VALUES ('". realEscape($_POST['subject']) ."', '". realEscape($_POST['message']) ."', ". $_SESSION['user_id'] .", ". $user_information['id'] .", 0, 0, 0)");
				echo "<center>Message successfully sent.</center>";
			}
			else
			{
				echo "<center>You have left one or more fields empty</center>";
			}
		}
		else
		{
			echo "This user does not exist";
		}
	}
}
else 
{
	if(isset($_GET['reply_id']) && !isset($_GET['user']))
	{
		if(is_numeric($_GET['reply_id']))
		{
			$check_if_pm_exists = mysql_query("SELECT author_id, subject FROM {$prefix}pms WHERE id=". realEscape($_GET['reply_id']));
			if(mysql_num_rows($check_if_pm_exists) > 0)
			{
				$pm_info = mysql_fetch_assoc($check_if_pm_exists);
				list($author_username) = mysql_fetch_row(mysql_query("SELECT uname FROM {$prefix}users WHERE id=". $pm_info['author_id']));
				$pm_subject = "RE: ". $pm_info['subject'];
			}
		}
	}
?>
<form action="send_pm.php" method="post">
<center>
<?php 
if(isset($_GET['user']) && !isset($_GET['reply_id']))
{
?>
To: <input type="text" name="to" value="<?php echo htmlentities($_GET['user'])?>"><br /><br />
<?php
}
else 
{
?>
To: <input type="text" name="to" value="<?php echo htmlentities($author_username)?>"><br /><br />
<?php 
}
?>
Subject: <input type="text" style="width: 316px" name="subject" value="<?php echo htmlentities($pm_subject);?>"><br /><br />
Message: <br /><textarea name="message" style="background-color: white; color: black;"></textarea>
<input type="submit" class="button" style="border: none" name="yes" value="Send"/>
</center>

</form>
<?php
}
}
else
{
	echo "You need to be logged in to view this page. <a href='../../login.php'>Login</a>";
}
?>
</div>
<div id="footer">
<ul>
<li><a href="http://www.runescape.com/c=3OJdXQlKbOI/kbase/guid/jagex" target="_blank">About Jagex</a></li>
</ul>
<div id="copyRight">&copy; Jagex 2009</div>

</div>
<div id="TnC">
By using our service you are agreeing to our <a href="http://www.runescape.com/c=3OJdXQlKbOI/terms/terms.ws" name="terms">Terms &amp; Conditions</a> and <a href="http://www.runescape.com/c=3OJdXQlKbOI/privacy/privacy.ws" name="privacy">Privacy Policy</a>.
</div>
<div class="clear"></div>
</div>
<br><br>
</body>
</html>
