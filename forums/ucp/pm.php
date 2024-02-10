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
</head>
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
<div class="title_left">Your Message Centre</div>
<div class="title_right">

</div>
</span></div>
<?php 
if(isset($_SESSION['user']))
{
?>
<div class="center">

<div class="inbox_title_bar">
Received Messages
</div>
<div class="inbox_body">
<table class="inbox_table">
<?php 
$check_if_exist_recieved = mysql_query("SELECT * FROM {$prefix}pms WHERE reciever_delete=0 AND reciever_id={$_SESSION['user_id']}");
if(mysql_num_rows($check_if_exist_recieved) > 0)
{
		while($get_pm1 = mysql_fetch_assoc($check_if_exist_recieved))
		{
			$get_user = mysql_query("SELECT uname FROM {$prefix}users WHERE id=". htmlentities($get_pm1['author_id']));
			$user_info = mysql_fetch_assoc($get_user);
?>
<tr>
<td style="width: 10%;" class="table_border_r ">
<?php echo htmlentities(capitalize($user_info['uname'])); ?>
</td>
<td style="width: 50%; text-align: left; padding-left: 10px;" class="table_border_r ">
<a href="view_pm.php?id=<?php echo $get_pm1['id']; ?>" style="color: #CCCCCC;" class="dialogue_link">
<?php
if($get_pm1['read'] == 0)
{
	echo '<b style="color:#ffffff;">'. htmlentities(capitalize($get_pm1['subject'])) .'</b>';
}
else
{
	echo htmlentities(capitalize($get_pm1['subject']));
}
 ?>
</a>
</td>

<td style="width: 20%;" class="table_border_r "><?php echo $get_pm1['date']; ?></td>
<td style="width: 12%;" class="">
<a href="view_pm.php?id=<?php echo $get_pm1['id']; ?>"><img src="../../www.runescape.com/forum/jagex/pm/dlg_view2.gif" alt="View" title="View" style="display: inline"/></a>
&nbsp;
<a href="delete_pm.php?id=<?php echo $get_pm1['id']; ?>"><img src="../../www.runescape.com/forum/jagex/pm/dlg_delete.gif" alt="Delete" title="Delete" style="display: inline"/></a>
</td>
</tr>
<?php
		}
}
else
{
	echo '<tr><td colspan="5" style="color: #888888; font-style: italic;">No messages in this section.</td></tr>';
}
?>
</table>

</div>
<img src="../../www.runescape.com/forum/jagex/pm/inbox_bottom.gif" class="inbox_bottom"/>
</div>
<div class="center">
<div class="inbox_title_bar">

Sent Messages
</div>
<div class="inbox_body">
<table class="inbox_table">
<?php 
$check_if_exist_sent = mysql_query("SELECT * FROM {$prefix}pms WHERE author_delete=0 AND author_id=". $_SESSION['user_id']);
if(mysql_num_rows($check_if_exist_sent) > 0)
{
		while($get_pm2 = mysql_fetch_assoc($check_if_exist_sent))
		{
			$get_user = mysql_query("SELECT uname FROM {$prefix}users WHERE id=". realEscape($get_pm2['reciever_id']));
			$user_info = mysql_fetch_assoc($get_user);
?>
<tr>
<td style="width: 10%;" class="table_border_r ">
<?php echo htmlentities(capitalize($user_info['uname'])); ?>
</td>
<td style="width: 50%; text-align: left; padding-left: 10px;" class="table_border_r ">
<a href="view_pm.php?id=<?php echo $get_pm2['id']; ?>" style="color: #CCCCCC;" class="dialogue_link">
<?php echo htmlentities(capitalize($get_pm2['subject'])); ?>
</a>
</td>

<td style="width: 20%;" class="table_border_r "><?php echo $get_pm2['date']; ?></td>
<td style="width: 12%;" class="">
<a href="view_pm.php?id=<?php echo $get_pm2['id']; ?>"><img src="../../www.runescape.com/forum/jagex/pm/dlg_view2.gif" alt="View" title="View" style="display: inline"/></a>
&nbsp;
<a href="delete_pm.php?id=<?php echo $get_pm2['id']; ?>"><img src="../../www.runescape.com/forum/jagex/pm/dlg_delete.gif" alt="Delete" title="Delete" style="display: inline"/></a>
</td>
</tr>
<?php
		}
}
else
{
	echo '<tr><td colspan="5" style="color: #888888; font-style: italic;">No messages in this section.</td></tr>';
}
?>
</table>
</div>
</div>
<?php 
}
else
{
	echo "You need to be logged in to view this page. <a href='../../login.php'>Login</a>";
}
?>
<div>&nbsp;</div>
</div></div>
<div id="footer">
<ul>
<li><a href="#" target="_blank">About Jagex</a></li>

</ul>
<div id="copyRight">&copy; Jagex 2009</div>
</div>
<div id="TnC">
By using our service you are agreeing to our <a href="http://www.runescape.com/c=D01DqsES2aw/terms/terms.ws" name="terms">Terms &amp; Conditions</a> and <a href="http://www.runescape.com/c=D01DqsES2aw/privacy/privacy.ws" name="privacy">Privacy Policy</a>.
</div>
<div class="clear"></div>
</div>

<br><br>
</body>
</html>
