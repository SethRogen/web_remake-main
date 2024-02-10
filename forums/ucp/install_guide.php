<?php
	session_start();
	include "includes/connect.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><link rel="icon" type="image/x-icon" href="favicon.ico" /> 
<meta http-equiv="Content-Language" content="
en, 
English
" />
<meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming">
<meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">
<title><?php
       	include "includes/config.php";
       	echo $title;
       ?></title>
<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/global-10.css);/**/</style>

</head>
<body id="navlogin">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="index.php" id="logo_select"></a>
<?php include 'includes/toptext.php' ?>

<div id="lang">
<a href="#"><img alt="English" src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/en.gif" /></a>
</div>
</div>
<div id="headOrangeBottom"></div>
<div id="menubox">

<?php
	include "includes/links.php";
?>
<br class="clear" />
</div>

<div class="navigation">
<div class="location">
<b>Location: </b> <a href="index.php">Home</a> &gt;

MikeRSWen installation guide
</div>
</div>
</div>
<div id="content">
<div id="article">
<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
MikeRSWen installation guide
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background">

<div class="inner_brown_background">
<div class="brown_box">
<div class="subsectionHeader">
MikeRSWen installation guide
</div>
<div style="text-align:center;" class="inner_brown_box">

<div style="text-align: center">
Hello, and welcome to the MikeRSWeb Installation guide.<br />
Here you will learn how to install MikeRSWeb.<br />
_________________________________________________________</br />
INDEX:<br />
Chapter 1: Getting the GUID<br />
Chapter 2: Uploading to your site<br />
Chapter 3: Installing<br />
Chapter 4: Upgrade version - Not available yet<br />
_________________________________________________________<br />
<b>Chapter 1: Getting the GUID</b><br />
MikeRSWeb has been scripted with a GUID System.<br />
You will need to use a valid MikeRSWeb GUID To use MikeRSWeb.<br />
To get a GUID go to <a href="register.php">The register page</a>.
Register with a Valid e-mail.<br />
One registerd an e-mail will be sent to you with your activation link.<br />
Click on the Activation link and a new page will open.<br />
If everything is done correctly You should recieve the following message:<br />
<i>Your account has been activated. GUID Code has been sent to your e-mail.</i>
Now go back to your e-mail and another e-mail has been sent with your GUID Code.<br />
Your GUID Will contain Numbers and Letters and will be 16 characters long (Not including -'s)<br />
****-****-****-****<br />
__________________________________________________________<br />
<b>Chapter 2: Uploading to your site</b><br />
At this point your account has been activated and is ready to be used<br />
Now you will need to <a href="login.php">login</a> to download MikeRSWeb<br />
Once downloaded Extract the rar archive file to your desktop.<br />
As example we will be using <a href="http://filezilla-project.org/download.php">Filezilla Client</a><br />
Open up Filezilla Client and connect to your FTP<br />
<img src="install_screens/con_to_host.png" /><br />
* FTP Host: Usually your domain<br />
* FTP Username: Probably the same as your cPanel username<br />
* FTP Password: Probably the same as your cPanel password<br />
Now click on Quick Connect and if there are no errors,<br />
You will now be connected to your FTP.<br />
* If there is a www, htdocs, or public_html dubble click on it.<br />
Now with the panel on the left side of your Filezilla Client, Go to the Desktop > MikeRSWeb V(Version Number).<br />
Select All the folders and file's and right click on one file, then press Upload.<br />
Now wait untill MikeRSWeb has been uploaded.<br />
Once uploaded dubble click on the includes folder.<br />
Now right click on config.php and select: File Permissions...<br />
A small window will popup.<br />
<img src="install_screens/ftp_file_per_window.png"><br />
Change the Numric value to 777, This is called CHMODDING.<br />
<img src="install_screens/ftp_chmod_777.png"><br />
Now click on OK, And you have done everything you needed with your FTP Client.<br />
___________________________________________________________<br />
<b>Chapter 3: Installing MikeRSWeb</b><br />
At this point you have uploaded MikeRSWeb to your host<br />
go to http://your-domain.domain/install/install.php<br />
* Replace your-domain.domain with your actuall domain.<br />
Now the main install page will be infront of you.<br />
<img src="install_screens/install_main.png"><br />
Now fill in your GUID Code sent to your e-mail.<br />
* If you do not have a GUID Code, read chapter 1.<br />
If you have correctly filed in your GUID Code, you will see<br />
<img src="install_screens/install_step1.png"><br />
Now click on continue and you will be redirected to the following page<br />
<img src="install_screens/install_step2.png"><br />
Click continue and this page will show up:<br />
<img src="install_screens/install_step3.png"><br />
* MySQL Host: Usually localhost<br />
* MySQL Username: Usually the same as your cPanel username<br />
* MySQL Password: Usually the same as your cPanel password<br />
* MySQL Database: A Database you created<br />
* Database Prefix: Leave blank or mrswv51_<br />
Now click on continue and if you filles it in with the correct information<br />
The following page should show up:<br />
<img src="install_screens/install_step3_check1.png"><br />
Click on continue and you should then see this page:<br />
<img src="install_screens/install_step4.png"><br />
Click continue and you will see:<br />
<img src="install_screens/install_step5.png"><br />
* Website title: Will be shows on top of every page.<br />
* Forum type: To use MikeRSWeb's forums or your own<br />
* Forum link: Only if Forum type is set to 'Other Forums'<br />
* Client type: Use MikeRSWeb's Webclinet or use another client<br />
* Client link: Only if Client type is set to Custom Client<br />
* Website Theme: What your website would look like<br />
* Server IP: Your Runescape server ip<br />
* Server Port: Your runescape server port<br />
If everything is filled in click on continue and you will see the following page:<br />
<img src="install_screens/install_step5_check1.png"><br />
Click on continue and this page will show up:<br />
<img src="install_screens/install_step6.png"><br />
* Administrator Username: The username you can login to on the site<br />
* Administrator Password: The password of the Administrator username<br />
* Date of birth: Your Date of birth<br />
* Administrator E-Mail: Your E-Mail address<br />
now click on continue and this page will show up:<br />
<img src="install_screens/install_step6_check1.png"><br />
Now you have successfully installed MikeRSWeb<br />
___________________________________________________________<br />
<b>Chapter 4: Upgrade version - Not available yet</b><br />
The upgrade system is not available yet.<br /><br />
End of tutorial<br />
</div>
</div> </div> </div> </div> </div>

</div>
</div>
<div id="footer"><div class="contain"><div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.
</div><a class="jagexlink" href="#" target="_blank"><img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png?1" alt="Jagex" /></a></div></div>
</div>


<script type="text/javascript">
var gaJsHost=(("https:"==document.location.protocol)?"https://ssl.":"http://www.");
document.write(unescape("%3Cscript src='"+gaJsHost+"google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker=_gat._getTracker("UA-2058817-2");
pageTracker._setDomainName("runescape.com");
pageTracker._initData();
pageTracker._trackPageview();
}catch(x){}
</script>

</body>
</html>
