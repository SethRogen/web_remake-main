<?php
function ___($_)
{
  return base64_decode($_);
}
function realEscape($string)
{
  if(get_magic_quotes_gpc())
  {
    return mysql_real_escape_string(stripslashes($string));
  }
  else
  {
    return mysql_real_escape_string($string);
  }
}
function capitalize($value)
{
    return preg_replace_callback('/[a-z]/i', function($matches) {
        return strtoupper($matches[0]);
    }, $value);
}
function encrypt($value)
{
return md5(md5(base64_encode($value)));
}
$w = 0;
function smileys($value)
{
  global $ln;
  $codes = array(
    ':)',
    ';)',
    ':P',
    ':(',
    ':|',
    'O_o',
    ':D',
    '^^',
    ':O',
    ':@');
  $img = array(
    '<IMG alt=":)" title=":)" src="../www.runescape.com/forum/smileys/smile.gif">',
    '<IMG alt=";)" title=";)" src="../www.runescape.com/forum/smileys/wink.gif">',
    '<IMG alt=":P" title=":P" src="../www.runescape.com/forum/smileys/tongue.gif">',
    '<IMG alt=":(" title=":(" src="../www.runescape.com/forum/smileys/sad.gif">',
    '<IMG alt=":|" title=":|" src="../www.runescape.com/forum/smileys/nosmile.gif">',
    '<IMG alt="O_o" title="O_o" src="../www.runescape.com/forum/smileys/o.O.gif">',
    '<IMG alt=":D" title=":D" src="../www.runescape.com/forum/smileys/bigsmile.gif">',
    '<IMG alt="^^" title="^^" src="../www.runescape.com/forum/smileys/^^.gif">',
    '<IMG alt=":O" title=":O" src="../www.runescape.com/forum/smileys/shocked.gif">',
    '<IMG alt=":@" title=":@" src="../www.runescape.com/forum/smileys/angry.gif">'
  );
  return str_ireplace($codes, $img, $value);
}
  function pm_smileys($value)
{
  global $ln;
  $codes = array(
    ':)',
    ';)',
    ':P',
    ':(',
    ':|',
    'O_o',
    ':D',
    '^^',
    ':O',
    ':@');
  $img = array(
    '<IMG alt=":)" title=":)" src="../../www.runescape.com/forum/smileys/smile.gif">',
    '<IMG alt=";)" title=";)" src="../../www.runescape.com/forum/smileys/wink.gif">',
    '<IMG alt=":P" title=":P" src="../../www.runescape.com/forum/smileys/tongue.gif">',
    '<IMG alt=":(" title=":(" src="../../www.runescape.com/forum/smileys/sad.gif">',
    '<IMG alt=":|" title=":|" src="../../www.runescape.com/forum/smileys/nosmile.gif">',
    '<IMG alt="O_o" title="O_o" src="../../www.runescape.com/forum/smileys/o.O.gif">',
    '<IMG alt=":D" title=":D" src="../../www.runescape.com/forum/smileys/bigsmile.gif">',
    '<IMG alt="^^" title="^^" src="../../www.runescape.com/forum/smileys/^^.gif">',
    '<IMG alt=":O" title=":O" src="../../www.runescape.com/forum/smileys/shocked.gif">',
    '<IMG alt=":@" title=":@" src="../../www.runescape.com/forum/smileys/angry.gif">'
  );
  
  return str_ireplace($codes, $img, $value);
}
function bbcodes($value)
{
$value1 = htmlspecialchars($value);
  $bbcodes = array(
	'/\[url=(.*)\](.*)\[\/url\]/isU',
	'/\[b\](.*)\[\/b\]/isU',
	'/\[img\](.*)\[\/img\]/isU',
	'/\[u\](.*)\[\/u\]/isU',
	'/\[i\](.*)\[\/i\]/isU',
	'/\[url\](.*)\[\/url\]/isU',
	'/\[s\](.*)\[\/s\]/isU',
	'/\[color=(#?[a-z0-9]+)\](.*)\[\/color\]/isU',
	'/\[center\](.*)\[\/center\]/isU',
	'/\[big\](.*)\[\/big\]/isU',
	'/\[small\](.*)\[\/small\]/isU',
	'/\[xfire\](.*)\[\/xfire\]/isU',
  );
  $html = array(
	'<a href="$1">$2</a>',
	'<b>$1</b>',
	'<img src="$1">',
	'<u>$1</u>',
	'<i>$1</i>',
	'<a href="$1">$1</a>',
	'<s>$1</s>',
	'<div style="color: $1">$2</div>',
	'<div style="text-align: center">$1</div>',
	'<div style="font-size: 3em">$1</div>',
  '<div style="font-size: 0.8em">$1</div>',
  '<a href="http://profile.xfire.com/$1"><img src="http://miniprofile.xfire.com/bg/sh/type/0/$1.png" width="440" height="111" /></a>',
);
$result = preg_replace($bbcodes, $html, $value1);
return $result;
}
if($w == 0)
{
	if($search_layour_number = mysql_query("SELECT theme FROM ". $prefix ."settings"))
	{
	while ($layout_number = mysql_fetch_array($search_layour_number))
	  {
	    $ln = $layout_number['theme'];
	  }
	}
	else
	{
	  $ln = 0;
	}
}
function check_cat()
{
  global $prefix;
  $dropdown = '<select name="category">';
  $result = mysql_query('SELECT id, name FROM '.$prefix.'categories');
  if(mysql_num_rows($result) < 1)
  {
    return false;
  }
  
  while($cat = mysql_fetch_array($result))
  {
    $dropdown .= '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
  }
  $dropdown .= '</select>';
  return $dropdown;
}
function check_intall_dir()
{
	$dir = './install/';
	if (file_exists($dir) && is_dir($dir))
	{
		return 1;
	}
	else
	{
		return 2;
	}
}
function check_forum()
{
  global $prefix;
  $dropdown = '<select name="category">';
  $result = mysql_query('SELECT id, name FROM '.$prefix.'forums');
  if(mysql_num_rows($result) < 1)
  {
    return false;
  }
  
  while($cat = mysql_fetch_array($result))
  {
    $dropdown .= '<option value="'.$cat['id'].'">'.$cat['name'].'</option>';
  }
  $dropdown .= '</select>';
  return $dropdown;
}
if(isset($_SESSION['admin']) || isset($_SESSION['user']))
{
  if($news1 = mysql_query("SELECT * FROM ".$prefix."users WHERE uname='". $_SESSION['user'] ."'"))
  {
  if(mysql_num_rows($news1) > 0)
  {
    while($n = mysql_fetch_array($news1))
    {
      if($n['banned'] == 1)
      {
        header("Location: logout.php");
      }
    }
  }
  }
}
if($checkipban = mysql_query("SELECT * FROM ". $prefix ."ipban WHERE ip='". $_SERVER['REMOTE_ADDR'] ."'"))
{
  if(mysql_num_rows($checkipban) > 0)
  {
    header("Location: ipbanned.php");
  }
}
list($get_title_for_website) = mysql_fetch_row(mysql_query("SELECT title FROM ". $prefix ."settings"));
$title = $get_title_for_website;
