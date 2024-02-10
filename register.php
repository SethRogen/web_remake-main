<?php 
session_start();
   // MikeRSWeb Source code \\   |
  // Do not remove the Footer\\  |
    // Install before use \\     |
     // THIS IS COPYRIGHT \\     |
// MATERIAL DO !!NOT!! CHANGE \\ |
  include 'includes/connect.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"><link rel="icon" type="image/x-icon" href="favicon.ico" /> 
<meta http-equiv="Content-Language" content="
en, 
English
">
<meta name="keywords" content="Runescape, Jagex, free, games, online, multiplayer, magic, spells, java, MMORPG, MPORPG, gaming">
<meta name="description" content="RuneScape is a massive 3d multiplayer adventure, with monsters to kill, quests to complete, and treasure to win. You control your own character who will improve and become more powerful the more you play.">
<title>
<?php

  include 'includes/config.php';
 echo $title; ?>
 </title>
<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/global-14.css);/**/</style>

<style type="text/css">/*\*/@import url(www.runescape.com/layout-<?php echo $ln; ?>/css/create3-7.css);/**/</style>
<!--[if lte IE 7]><style type="text/css">
 .brown_box select {margin-top: 1px;}
 
</style><![endif]-->
<noscript>
<style type="text/css">
  #jmesgBg, #jmesg {
   display: none;
  }
  #formBoxes {
   padding-bottom: 1em;
  }
  .formDesc {
   display: block;
  }
  .formDesc p {
   display: inline;
  }
  .formSection {
   padding: 1em 0 5px;
  }
  #pass_desc, #data_desc {
   padding-top: 1em;
   border-top: 2px solid black;
  }
  #alts {
   display: block;
   margin-bottom: 1em;
   padding: 0;
  }
  #alts span {
   cursor: default;
   text-decoration: none;
  }
  #errorUsername, #errorPassword {
   margin-bottom: 1em;
  }
 </style>
</noscript>
</head>
<body id="navplay">
<a name="top"></a>


<div id="scroll">
<div id="head">
<div id="headOrangeTop"></div>
<img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/head_image.jpg" alt="RuneScape" />
<div id="headImage"><a href="#" id="logo_select"></a>

<div id="lang">
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
Create a Free Account
</div>
</div>
</div>
<div id="content">
<div id="article">

<div class="sectionHeader">
<div class="left">
<div class="right">
<div class="plaque">
Create a Free Account
</div>
</div>
</div>
</div>
<div class="section">
<div class="brown_background sectionContentContainer">
<div class="inner_brown_background">
<div class="brown_box">

<br class="clear"/>

<div class="width756">
<?php
if(isset($_GET['v']))
{
echo "This site is using version: ". $version;
}
else
{
if(!isset($_SESSION['user']))
{
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if($_POST['username'] == "" || $_POST['password1'] == "" || $_POST['password2'] == "" || $_POST['mail'] == "" || $_POST['day'] == "" || $_POST['month'] == "" || $_POST['year'] == "" || $_POST['country'] == "-1")
  {
    echo "<center>You have left 1 or more boxes empty!</center>";
  }
  else
  {
    $rrr = mysql_query('SELECT * FROM '. $prefix .'users WHERE uname=\'' . realEscape($_POST['username']) . '\'') ;
    if(mysql_num_rows($rrr) > 0)
    {
    echo "<center>This username already exists</center>";
    }
    else
    {
      if($_POST['password1'] == $_POST['password2'])
      {
        if(preg_match('/[a-z0-9]{3,13}/i', $_POST['username'], $matches) && strlen($matches[0]) === strlen($_POST['username']))
        {
          if(preg_match('/[a-z0-9]{3,13}/i', $_POST['password1'], $matches) && strlen($matches[0]) === strlen($_POST['password1']))
          {
            if(is_numeric($_POST['day']) && is_numeric($_POST['month']) && is_numeric($_POST['year'])) {
              mysql_query("INSERT INTO ". $prefix ."users (uname, pass, banned, ip, dob, country, mail, rights, ipbanned, hide_mail) VALUES ('". realEscape($_POST['username']) ."', '". encrypt($_POST['password1']) ."', '0', '". $_SERVER['REMOTE_ADDR'] ."', '". realEscape($_POST['day']) ."/". realEscape($_POST['month']) ."/". realEscape($_POST['year']) ."', '". realEscape($_POST['country']) ."', '". realEscape($_POST['mail']) ."', '0', '0', '". (int)($_POST['hide_mail'] != NULL) ."')");
              echo "<center>Your account has been successfully created<br>You cant login on the <a href='login.php'>Login Page</a>.<br />
              Username: ". htmlspecialchars($_POST['username']) ."<br>
              Mail: ". htmlspecialchars($_POST['mail']) ."</center>";
            } else {
              echo '<p>All fields from your birthdate must be numeric.</p>';
            }
          }
          else
          {
            echo '<center>Invalid password. Your password can only contain Numbers and Letters, and be 3-12 characters in length.</center>';
          }
        }
        else
        {
          echo '<center>Invalid username. Your username can only contain Numbers and Letters, and be 3-12 characters in length.</center>';
        }
      }
      else
      {
        echo "<center>Passwords do not match</center>";
      }
    }
  }
}
else
{
?>
<form id="createForm" action="register.php" method="post">

<div class="inner_brown_box brown_box_stack" id="cIntro">
<center>Creating an account is simple and free, you will be able to post a comment on any news!</center>
</div>
<div id="formBoxes" class="inner_brown_box brown_box_stack brown_box_padded">

<div class="formSuperGroup single_line">
<div class="formSection" id="usr">
<input style="display:none;" type="hidden" id="origusername" name="origusername" value="">
<label for="username">Your Username:</label>
<input id="username" name="username" autocomplete="off" maxlength="12" value="">
<br class="clear" />
</div>
<br class="clear" />
</div>
<div class="formSuperGroup double_line">
<div id="pass" class="formGroup">
<div class="formSection">
<label for="password1">Your Password:</label>
<input id="password1" name="password1" type="password" autocomplete="off" value="" maxlength="20">
</div>
<div class="formSection">
<label for="password2">Re-enter Password:</label>
<input id="password2" name="password2" type="password" autocomplete="off" value="" maxlength="20">
</div>
<div class="formSection">
<label for="mail">Your E-Mail:</label>
<input id="password1" name="mail" type="text" autocomplete="off" value="" maxlength="60">
</div>
<div class="formSection">
<label for="hide_mail">Hide your e-mail?:</label>
<input id="hide_mail" type="checkbox" name="hide_mail" />
</div>
<br class="clear" />
</div>

<br class="clear" />
</div>
<div class="formSuperGroup double_line">
<div id="data" class="formGroup">
<div class="formSection">
<label for="day">Your Date of Birth:</label>

<div>
<select id="day" name="day">
<option value="-1" selected="selected" disabled="disabled">Day</option>
<option value="1">1</option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>

<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>

<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>

<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>
<select id="month" name="month">
<option value="-1" selected="selected" disabled="disabled">Month</option>
<option value="0">January</option>

<option value="1">February</option>
<option value="2">March</option>
<option value="3">April</option>
<option value="4">May</option>
<option value="5">June</option>
<option value="6">July</option>
<option value="7">August</option>
<option value="8">September</option>
<option value="9">October</option>

<option value="10">November</option>
<option value="11">December</option>
</select>
<input id="year" name="year" maxlength="4" value="Year">
</div>
</div>
<div class="formSection country" >
<label for="country">Your Country of Residence:</label>
<select id="country" name="country" onfocus="display(this.parentNode.parentNode);">
<option value="-1" selected="selected">Select one</option>
<option value="Afghanistan">Afghanistan</option>
<option value="Albania">Albania</option>

<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antarctica">Antarctica</option>
<option value="Antigua and Barbuda">Antigua and Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>

<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>

<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Bouvet Island">Bouvet Island</option>

<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
<option value="Brunei Darussalam">Brunei Darussalam</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>

<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
<option value="Colombia">Colombia</option>

<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Congo, The Democratic Republic of the">Congo, The Democratic Republic of the</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote D'Ivoire">Cote D'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Cyprus">Cyprus</option>

<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>

<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>

<option value="France, Metropolitan">France, Metropolitan</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Territories">French Southern Territories</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>

<option value="Gibraltar">Gibraltar</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guinea-Bissau">Guinea-Bissau</option>

<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Heard Island and McDonald Islands">Heard Island and McDonald Islands</option>
<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>

<option value="Indonesia">Indonesia</option>
<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>

<option value="Kazakstan">Kazakstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
<option value="Korea, Republic of">Korea, Republic of</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
<option value="Latvia">Latvia</option>

<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia, the Former Yugoslav Republic of">Macedonia, the Former Yugoslav Republic of</option>

<option value="Madagascar">Madagascar</option>
<option value="Malawi">Malawi</option>
<option value="Malaysia">Malaysia</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>

<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
<option value="Moldova, Republic of">Moldova, Republic of</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montenegro">Montenegro</option>
<option value="Montserrat">Montserrat</option>

<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Namibia">Namibia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherlands">Netherlands</option>
<option value="Netherlands Antilles">Netherlands Antilles</option>
<option value="New Caledonia">New Caledonia</option>

<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Northern Mariana Islands">Northern Mariana Islands</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>

<option value="Pakistan">Pakistan</option>
<option value="Palau">Palau</option>
<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Philippines">Philippines</option>
<option value="Pitcairn">Pitcairn</option>

<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russian Federation">Russian Federation</option>
<option value="Rwanda">Rwanda</option>
<option value="Saint Helena">Saint Helena</option>

<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
<option value="Saint Lucia">Saint Lucia</option>
<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
<option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
<option value="Samoa">Samoa</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome and Principe">Sao Tome and Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>

<option value="Serbia">Serbia</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>

<option value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>

<option value="Syrian Arab Republic">Syrian Arab Republic</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad and Tobago">Trinidad and Tobago</option>

<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Emirates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>

<option value="United States">United States</option>
<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
<option value="Uruguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands, British">Virgin Islands, British</option>
<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>

<option value="Wallis and Futuna">Wallis and Futuna</option>
<option value="Western Sahara">Western Sahara</option>
<option value="Yemen">Yemen</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>
</select>
</div>
<center><input type="submit" value="Continue"></center>
</div>
</div>

<br class="clear" />
</div>
</form>
<?php
}
}
else
{
echo "You already have an account";
}
}
?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div id="footer">
<div class="contain">

<div class="footerdesc">
This website and its contents are copyright © Jagex Ltd And  <?php echo htmlspecialchars($title); ?>. <br />This website is powerd by <a href="http://mikersweb.info".>MikeRSWeb</a>.
</div>
<a class="jagexlink" href="http://www.jagex.com" target="_blank">
<img src="www.runescape.com/layout-<?php echo $ln; ?>/img/main/layout/jagex.png?4" alt="Jagex" />
</a>
</div>
</div>

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
