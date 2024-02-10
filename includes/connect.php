<?php
include 'config.php';
$con = @mysql_connect($host, $dbuser, $dbpass);  
//$con = mysql_connect(':/tmp/mysql', $dbuser, $dbpass);
if (!$con)
{
  header("Location: install/install.php");
}
mysql_select_db($db ,$con);

include 'functions.php';

if (isset($_SESSION['user'])) {
  if($result = mysql_query("SELECT uname, forums, rights FROM {$prefix}users WHERE uname='{$_SESSION['user']}'"));
  $n = mysql_fetch_assoc($result);
  if($n['banned'] == 1)
  {
    header("Location: logout.php");
  }
  else
  {
    if($n['rights'] == 2)
    {
      $_SESSION['admin'] = $n['uname'];
      $_SESSION['user'] = $n['uname'];
    }
    elseif($n['rights'] == 1)
    {
      $_SESSION['mod'] = $n['uname'];
      $_SESSION['user'] = $n['uname'];
      $_SESSION['forums'] = explode(',', $n['forums']);
    }
    elseif($n['rights'] == 0)
    {
      $_SESSION['user'] = $n['uname'];
    }
   }
}