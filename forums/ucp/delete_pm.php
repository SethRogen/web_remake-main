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

<div class="title_left">Viewing Message Exchange</div>
<div class="title_right"><a href="pm.php">Back to Message Centre</a></div>
</span></div>
<?php 
if(isset($_SESSION['user']))
{
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$id = $_GET['id'];
	$user_id = $_SESSION['user_id'];
	$check_pm_for_delete = mysql_query("SELECT * FROM {$prefix}pms WHERE id={$id}") or die(mysql_error());
	if(mysql_num_rows($check_pm_for_delete) > 0)
	{
		$pm_info = mysql_fetch_assoc($check_pm_for_delete);
		if($pm_info['author_id'] == $user_id)
		{
			if($pm_info['reciever_delete'] == 1)
			{
				mysql_query("DELETE FROM {$prefix}pms WHERE id={$id}");
			}
			else 
			{
				mysql_query("UPDATE {$prefix}pms SET author_delete=1 WHERE id={$id}");
			}
			echo "PM Successfully deleted";
		}
		elseif($pm_info['reciever_id'] == $user_id)
		{
			if($pm_info['author_delete'] == 1)
			{
				mysql_query("DELETE FROM {$prefix}pms WHERE id={$id}");
			}
			else 
			{
				mysql_query("UPDATE {$prefix}pms SET reciever_delete=1 WHERE id={$id}");
			}
			echo "PM Successfully deleted";
		}
	}
	else
	{
		echo "Invalid PM ID.";
	}
}
else
{
?>
<div class="top-spacer20 centered">
Are you sure you want to delete this message?
</div>
<br/>

<form action="delete_pm.php?id=<?php echo $_GET['id']; ?>" method="post">
<ul class="buttonList center">
<li><input type="submit" class="button" style="border: none" name="yes" value="Yes"/></li>
<li><input type="button" onclick="location.href='pm.php';" class="button" style="border: none" name="no" value="No"/></li>
</ul>
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
