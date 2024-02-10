<?php
session_start();
?>
<ul id="menus">
<li class="top"><a href="../../index.php" id="home" class="tl"><span class="ts">Home</span></a></li>
<li class="top"><a href="../index.php" id="Forum home" class="tl"><span class="ts">Forum Home</span></a></li>
<li class="top"><a class="tl" href="#"><span class="ts">Others</span><!--[if gt IE 6]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
<ul>
<?php
  if($settings_check_1 = mysql_query("SELECT clink FROM ". $prefix ."settings LIMIT 1"))
  {
  while($gsdfljh = mysql_fetch_array($settings_check_1)){
  if($gsdfljh['clink'] == '0')
  {
  echo '<li class="top"><a href="../../webclient/" class="tl"><span class="ts">Play Now</span></a></li>';
  }
  else
  {
  echo '<li class="top"><a href="'. htmlspecialchars($gsdfljh['clink']) .'" class="tl"><span class="ts">Play Now</span></a></li>';
  }
 }
 }
?>

</ul>
<!--[if lte IE 6]></td></tr></table></a><![endif]-->
</li>
<?php
if(isset($_SESSION['user']))
{
?>
<li class="top"><a class="tl" href="#"><span class="ts">User CP</span><!--[if gt IE 6]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
<ul>
<li><a href="pm.php" class="fly"><span>PM CP</span></a></li>
<li><a href="change_signiture.php" class="fly"><span>Change Signiture</span></a></li>
</ul>
<!--[if lte IE 6]></td></tr></table></a><![endif]-->
</li>
<?php 
}
 if(isset($_SESSION['admin']))
 {
?>
<li class="top"><a href="admincp.php" id="forum admincp" class="tl"><span class="ts">Forum CP</span></a></li>
<?php
}
 if(isset($_SESSION['admin']) || isset($_SESSION['user']))
 {
?>
<li class="top"><a href="../../logout.php" id="logout" class="tl"><span class="ts">Logout</span></a></li>
<?php
 }
 else
 {
?>
<li class="top"><a href="../../login.php" id="login" class="tl"><span class="ts">Log In</span></a></li>
<?php
 }
?>
</ul>