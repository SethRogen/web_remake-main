<?php
include 'includes/config.php';

// Connect to the database
$con = @mysql_connect($host, $dbuser, $dbpass);  
if (!$con) {
  header("Location: install/install.php");
}
mysql_select_db($db ,$con);

// Include functions
include 'functions.php';

// Check if user is logged in
if (isset($_SESSION['user'])) {
  // Fetch user data
  $result = mysql_query("SELECT uname, forums, rights, banned FROM {$prefix}users WHERE uname='{$_SESSION['user']}'");
  if ($result) {
    $n = mysql_fetch_assoc($result);
    // Check if user is banned
    if ($n['banned'] == 1) {
      header("Location: logout.php");
    } else {
      // Assign session variables based on user rights
      $_SESSION['user'] = $n['uname'];
      if ($n['rights'] == 2) {
        $_SESSION['admin'] = $_SESSION['user'];
      } elseif ($n['rights'] == 1) {
        $_SESSION['mod'] = $_SESSION['user'];
        $_SESSION['forums'] = explode(',', $n['forums']);
      }
    }
  }
}