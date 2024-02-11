<?php

?>
<ul id="menus">
<?php
 if(mysql_query("SELECT uname FROM {$prefix}users"))
 {
?>
<li class="top"><a href="../index.php" id="home" class="tl"><span class="ts">Home</span></a></li>
<?php
  if($settings_check_1 = mysql_query("SELECT clink FROM ". $prefix ."settings LIMIT 1"))
  {
  while($gsdfljh = mysql_fetch_array($settings_check_1)){
  if($gsdfljh['clink'] == '0')
  {
  echo '<li class="top"><a href="../webclient/" class="tl"><span class="ts">Play Now</span></a></li>';
  }
  else
  {
  echo '<li class="top"><a href="'. htmlspecialchars($gsdfljh['clink']) .'" class="tl"><span class="ts">Play Now</span></a></li>';
  }
 }
 }
?>
<li class="top"><a class="tl" href="#"><span class="ts">Main</span><!--[if gt IE 6]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
<ul>
<li><a href="../info.php" class="fly"><span>Server Info</span></a></li>
<li><a href="../staff.php" class="fly"><span>Staff List</span></a></li>
</ul>
<!--[if lte IE 6]></td></tr></table></a><![endif]-->
</li>
<?php
 if($settings_check_2 = mysql_query("SELECT flink FROM ". $prefix ."settings LIMIT 1"))
 {
 $flink = mysql_fetch_array($settings_check_2);
 if($flink[0] == "")
 {
    echo '<li class="top"><a href="../forums/" id="home" class="tl">Forums</a></li>';
 }
 else
 {
    echo '<li class="top"><a href="'. $flink[0] .'" id="home" class="tl">Forums</a></li>';
 }
 }
?>
<li class="top"><a class="tl" href="#"><span class="ts">Others</span><!--[if gt IE 6]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
<ul>
<?php
 $links_db = mysql_query("SELECT * FROM ".$prefix."links ORDER BY id DESC LIMIT 6");
if(mysql_num_rows($links_db) > 0)
{
  while($links = mysql_fetch_array($links_db))
  {
  echo '<li><a href="'. htmlspecialchars($links["link"]) .'" class="fly"><span>'. htmlspecialchars($links["name"]) .'</span></a></li>';
  }
}
else
{
echo '<li><a href="http://mikersweb.info/" class="fly"><span>MikeRSWeb Main</span></a></li>';
}
?>

</ul>
<!--[if lte IE 6]></td></tr></table></a><![endif]-->
</li>
<?php
 if(isset($_SESSION['admin']))
 {
?><li class="top"><a class="tl" href="#"><span class="ts">Admin CP</span><!--[if gt IE 6]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
<ul>
<li><a href="changenews.php" class="fly"><span>Add News</span></a></li>
<li><a href="addstaff.php" class="fly"><span>Add Staff</span></a></li>
<li><a href="theme.php" class="fly"><span>Change Theme</span></a></li>
<li><a href="addlink.php" class="fly"><span>Add Link</span></a></li>
<li><a href="deletelink.php" class="fly"><span>Delete Link</span></a></li>
<li><a href="editinfo.php" class="fly"><span>Edit Info</span></a></li>
<li><a href="changeurl.php" class="fly"><span>Client Settings</span></a></li>
<li><a href="users.php" class="fly"><span>Users</span></a></li>
<li><a href="check_version.php" class="fly"><span>Check Version</span></a></li>
</ul>
<!--[if lte IE 6]></td></tr></table></a><![endif]-->
</li>
<?php
}
?>
<?php
 if(isset($_SESSION['admin']) || isset($_SESSION['user']))
 {
?>
<li class="top"><a href="../logout.php" id="logout" class="tl"><span class="ts">Logout</span></a></li>
<?php
 }
 else
 {
?>
<li class="top"><a href="../login.php" id="login" class="tl"><span class="ts">Log In</span></a></li>
<?php
 }
 }
 else
 {
  echo '<li class="top"><a href="../install/install.php" id="login" class="tl"><span class="ts">Install</span></a></li>';
 }
?>
</ul>