<div id="player_no">There are currently :: people playing!</div>
<?php
if(isset($_SESSION['user']))
{
  $session_name = preg_replace_callback('/[a-z]/i', function($matches) {
      return strtoupper($matches[0]);
  }, stripslashes($_SESSION['user']), 1);

  if(isset($_SESSION['admin']))
  {
    echo '<div id="sessionText">You are logged in as <span id="accountName"><img src="../www.runescape.com/forum/crown_gold.gif" alt="Administrator" title="Administrator"> '. $session_name .'</span></div>';
  }
  else if(isset($_SESSION['mod']))
  {
    echo '<div id="sessionText">You are logged in as <span id="accountName" style="color:green"><img src="../www.runescape.com/forum/crown_green.gif" alt="Moderator" title="Moderator"> '. $session_name .'</span></div>';
  }
  else
  {
    echo '<div id="sessionText">You are logged in as <span id="accountName">'. $session_name .'</span></div>';
  }
}
?>
