<?php
session_start();
?>
<ul id="menus">
<li class="top"><a href="../index.php" id="home" class="tl"><span class="ts">Home</span></a></li>
<li class="top"><a href="index.php" id="Forum home" class="tl"><span class="ts">Forum Home</span></a></li>
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
if(isset($_SESSION['user']))
{
?>
<li class="top"><a class="tl" href="#"><span class="ts">User CP</span><!--[if gt IE 6]><!--></a><!--<![endif]-->
<!--[if lte IE 6]><table><tr><td><![endif]-->
<ul>
<li><a href="ucp/pm.php" class="fly"><span>PM CP</span></a></li>
<li><a href="ucp/change_signiture.php" class="fly"><span>Change Signiture</span></a></li>
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
<li class="top"><a href="../logout.php" id="logout" class="tl"><span class="ts">Logout</span></a></li>
<?php
 }
 else
 {
?>
<li class="top"><a href="../login.php" id="login" class="tl"><span class="ts">Log In</span></a></li>
<?php
 }
?>
</ul>