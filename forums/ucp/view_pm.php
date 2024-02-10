<?php
session_start();
include "../../includes/connect.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
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

<div class="title_left">Viewing Message Exchange</div>
<div class="title_right"><a href="pm.php">Back to Message Centre</a></div>
</span></div>
<?php 
if(isset($_SESSION['user']))
{
?>
<div class="center">
<?php 
if(is_numeric($_GET['id']))
{
$get_message = mysql_query("SELECT * FROM {$prefix}pms WHERE id=". realEscape($_GET['id']));
	if(mysql_num_rows($get_message) > 0)
	{
		$message = mysql_fetch_assoc($get_message);
		if($message['reciever_id'] == $_SESSION['user_id'] || $message['author_id'] == $_SESSION['user_id'])
		{
		if($message['reciever_id'] == $_SESSION['user_id'])
		{
			mysql_query("UPDATE {$prefix}pms SET `read`=1 WHERE id=". $_GET['id']);
		}
		$get_user = mysql_query("SELECT uname, rights FROM {$prefix}users WHERE id=". $message['author_id']);
		$user = mysql_fetch_assoc($get_user);
		if($user['rights'] == 0)
		{
			$frame = "RuneScape";
		}
		elseif($user['rights'] == 1)
		{
			$frame = "FunOrb";
		}
		elseif($user['rights'] == 2)
		{
			$frame = "jmod";
		}
?>
<div class="dialogue_subject">
<?php echo $message['subject']; ?>
</div>
<div class="ticket <?php echo $frame; ?>">
<div class="ticket_leftbox">
<div class="ticket_topbar <?php echo $frame; ?>_box"><?php echo htmlentities(capitalize($user['uname'])); ?></div>
<div class="ticket_contentbox">
<?php 
if($message['reciever_id'] == $_SESSION['user_id'])
{
?>
<center><a href='send_pm.php?reply_id=<?php echo $message['id']; ?>'>Reply</a></center>
<?php 
}
?>
</div>
</div>
<div class="ticket_rightbox <?php echo $frame; ?>">
<div class="ticket_topbar <?php echo $frame; ?>_box"><?php echo htmlentities($message['date']); ?></div>

<div class="ticket_contentbox"><?php echo nl2br(pm_smileys(bbcodes($message['message'])));?></div>
</div>
<?php 
	}
	else
	{
		echo "This is not your private message.";	
	}
}
?>
<br/>
<br/>

</div>
<div>&nbsp;</div>
</div>
<?php 
}
else
{
	echo "Invalid ID";
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
</body>
</html>
