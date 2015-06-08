<?php
/*
    __  __ _                    _ _            _       _           _       
   |  \/  (_) ___ _ __ ___  ___(_) |_ ___     / \   __| |_ __ ___ (_)_ __  
   | |\/| | |/ __| '__/ _ \/ __| | __/ _ \   / _ \ / _` | '_ ` _ \| | '_ \ 
   | |  | | | (__| | | (_) \__ \ | ||  __/  / ___ \ (_| | | | | | | | | | |
   |_|  |_|_|\___|_|  \___/|___/_|\__\___| /_/   \_\__,_|_| |_| |_|_|_| |_|
*/

$showdebug=1;
$debugout="";
$showdecrypt=1;

$p_b="";
$p_p="";
$p_u="";
$p_send="";
$outtie="";
$rndhexlength=30;
$rndhexval = "";

$key="";
$key_size="";
$iv_size="";
$iv="";
$ciphertext="";
$ciphertext_base64="";
$iv_dec="";
$ciphertext_dec="";
$ciphertext_dec="";

// Placeholder for the "secure.php" include...
$p_login_output="";if(isset($_POST)){
	if(isset($_POST["p_b"]) && trim($_POST["p_b"])!=""){
		$p_b=trim($_POST["p_b"]);
	}
	if(isset($_POST["p_u"]) && trim($_POST["p_u"])!=""){
		$p_u=trim($_POST["p_u"]);
	}
	if(isset($_POST["p_p"]) && trim($_POST["p_p"])!=""){
		$p_p=trim($_POST["p_p"]);
	}
	if(isset($_POST["p_send"]) && $_POST["p_send"]=="Generate code"){
		// The form was posted.
		$outtie="<hr />\n";
		$login_php_output="<"."?"."php\nrequire(\"inc/secure.php\");\n"."$"."p_u=trim("."$"."_REQUEST[\"p_u\"]);\n"."$"."p_p=trim("."$"."_REQUEST[\"p_p\"]);\n// "."$"."out="."$"."p_u.\"|\"."."$"."p_p.\"|\"."."$"."rawpass;exit;\n	if("."$"."p_u == \"\" || strlen("."$"."p_u)==0){\n		// Blank! (Nogo!)\n		"."$"."out=\"Sorry: Username cannot be blank.\";\n	} elseif("."$"."p_p == \"\" || strlen("."$"."p_p)==0){\n		// Blank! (Nogo!)\n		"."$"."out=\"Sorry: Password cannot be blank.\";\n	} elseif("."$"."p_u!='".$p_u."' && "."$"."p_p!="."$"."rawpass){\n		"."$"."out=\"Sorry: Incorrect login.\";\n	} else {\n		setcookie(\"li\", 'yyyyy', time()+3600, \"/\"); // 1 hour\n		// header(\"location:menu.php\");\n		"."$"."out=\"OK\";\n	}\necho "."$"."out;\n"."?".">";
		$logout_php_output="<"."?"."php\nsetcookie('li', null, -1, '/');\nheader(\"location:index.php\");\n"."?".">";
		$p_login_output="<html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head runat=\"server\">\n    <title>".$p_b.": Admin Login</title>\n    <link rel=\"stylesheet\" href=\"css/styles.css\" />\n    <style type=\"text/css\">\n    #out {color:#cc0000;font-size:13pt;font-weight:bold}\n    </style>\n</head>\n<body>\n    <form method=\"post\" action=\"\" name=\"login\">\n    <div>\n        <div id=\"wrapper\">\n        <h1><img src=\"[#YOUR BRAND IMAGE GOES HERE]\" border=\"0\" />&nbsp;".$p_b.": Admin Login</h1>\n        <div id=\"mainmenu\">\n        	<div id=\"out\"></div>\n            <p><b>Username:</b> <input type=\"text\" name=\"p_u\" id=\"p_u\" value=\"\" autofocus /></p>\n            <p><b>Password:</b> <input type=\"password\" name=\"p_p\" id=\"p_p\" value=\"\" /></p>\n            <p><input type=\"submit\" name=\"p_send\" id=\"p_send\" value=\"Login\" /></p>\n        </div>\n    </div>\n    </div>\n    </form>\n    <footer id=\"footer\">\n    <span class=\"copyright\">&copy; 2015 Intrafinity.</span>\n    </footer>\n<script src=\"https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>\n<script type=\"text/javascript\">\n	// Ajax submit the form...\n$(document).ready(function(){\n	$(\"#p_send\").click(function(){\n		var u=$(\"#p_u\").val();\n		var p=$(\"#p_p\").val();\n			if(u=='')\n			{\n				$('#out').text(\"Please enter a username.\");\n			}\n			else if(p=='')\n			{\n				$('#out').text(\"Please enter a password.\");\n			}\n			else\n			{\n				var dataString = 'p_u='+u+'&p_p='+p;\n				$.ajax({\n				type: \"POST\",\n				url: \"login.php\",\n				data: dataString,\n				cache: false,\n					success: function(result){\n						if(result=='OK'){\n							var url = \"menu.php\";\n							$(location).attr('href',url);\n						} else {\n							$('#out').text(result);\n						}\n					}\n				});\n			}\n		return false;\n	});\n});\n</script>\n</body>\n</html>";
		$menu_php_output="<"."?"."php\n// Note: This check is the one you want to place within *any* page that you want to be protected by the admin login.\nif(isset("."$"."_COOKIE) && isset("."$"."_COOKIE[\"li\"]) && "."$"."_COOKIE[\"li\"]='yyyyy'){\n?><html xmlns=\"http://www.w3.org/1999/xhtml\">\n<head>\n    <title>".$p_b."</title>\n    <link rel=\"stylesheet\" href=\"css/styles.css\" />\n</head>\n<body>\n    <form id=\"form1\">\n    <div>\n        <div id=\"wrapper\">\n        <h1><img src=\"[# YOUR BRAND IMAGE GOES HERE]\" border=\"0\" />&nbsp;".$p_b.": Admin Login</h1>\n        <div id=\"mainmenu\">\n            <div id=\"menuleft\">\n            <h2>Left Side</h2>\n            <ul>\n                <li><a href=\"item1.php\">Menu Item 1</a></li>\n            </ul>\n            </div>\n            <div id=\"menuright\">\n            <h2>Right Side</h2>\n            <ul>\n                <li><a href=\"item2.php\" target=\"_blank\">Menu Item 2</a></li>\n            </ul>\n            </div><a href=\"logout.php\">&#187;&nbsp;Log Out</a>\n        </div>\n    </div>\n    </div>\n    </form>\n    <footer id=\"footer\">\n    <span class=\"copyright\">&copy; 2015 Intrafinity.</span>\n    </footer>\n</body>\n</html>"."<"."?php\n} else {\n	header(\"location:index.php\");\n}\n?".">";
		$css_output="html {margin: 0 auto;} html, body, div, span, applet, object, iframe { margin:0;padding:0;border:0;outline:0;font-weight:inherit;font-style:inherit;font-size:100%;font-family:inherit;vertical-align:baseline;} :focus {outline:0;} ol, ul { } .small {font:10px verdana, arial, helvetica;color:#663300;margin-top:0in;margin-bottom:.0in;line-height:12px} body {position:absolute;top:0px;left:0px;background:#fff;display:block;width:100%;margin:0 auto;font-family: 'Source Sans Pro', sans-serif;font-size: 10pt;font-weight: 300 !important;letter-spacing: -0.025em;line-height: 1.5em;} a {color:#0000cc;text-decoration:none;} a:visited {color:#999999;text-decoration:none;} a:hover {color:#0000cc;text-decoration:underline;} .hideit {display:none;} .main {} .caption {font-family:verdana;font-size:11px;color:#777;} .ind {text-indent:1.8em;} #clearit {clear:both;} #wrapper {position:absolute;width:800px;margin-left:120px} #statsform {margin:8px;text-align:center;} #mainmenu {background-color:#97e699;width:620px;height:300px;padding:9px;-webkit-box-shadow: 10px 10px 5px -2px rgba(184,180,184,1);-moz-box-shadow: 10px 10px 5px -2px rgba(184,180,184,1);box-shadow: 10px 10px 5px -2px rgba(184,180,184,1);} #menuleft {float:left; width:220px;padding:9px;margin-right:12px;} #menuright {float:left; width:250px;padding:9px} .formlabel {width:140px;font-family:verdana;font-size:11px;font-weight:bold} .txtinput {width:300px;font-family:verdana;font-size:11px;} .statstxtinput {width:150px;font-family:verdana;font-size:11px;} .statstxtnuminput {width:80px;font-family:verdana;font-size:11px;} #footer {background-color: #eee;color:#888;width: 100%;bottom: 0;position: fixed;cursor: default;height: 30px;line-height: 2.5em;text-align: right;}";
		$index_pwd_check_output="<"."?"."php\n// Check to see if we have a login cookie\nif(isset("."$"."_COOKIE) && isset("."$"."_COOKIE[\"li\"]) && "."$"."_COOKIE[\"li\"]='yyyyy'){\n	header(\"location:menu.php\");\n} else {\n"."?".">\n".$p_login_output."\n<?php\n}\n"."?".">";
		$rndhexval = getRandomHex($rndhexlength);
			if($showdebug==1){
				$outtie.="<p class=\"debugout\">Random hex value: ".$rndhexval."</p>\n";
			}
		$key = pack('H*', $rndhexval);
		$key_size =  strlen($key);
			if($showdebug==1){
				$outtie.="<p class=\"debugout\">Key size: " . $key_size . "</p>\n";
			}
		$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
		$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
		// Perform the encryption...
		// creates a cipher text compatible with AES (Rijndael block size = 128)
		// to keep the text confidential 
		// only suitable for encoded input that never ends with value 00h
		// (because of default zero padding)
		$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $p_p, MCRYPT_MODE_CBC, $iv);
		// prepend the IV for it to be available for decryption
		$ciphertext = $iv . $ciphertext;
		// encode the resulting cipher text so it can be represented by a string
		$ciphertext_base64 = base64_encode($ciphertext);
			if($showdebug==1){
				$outtie.="<p class=\"debugout\">Encrypted password: ".$ciphertext_base64."</p>\n";
			}
		
		if($showdecrypt==1){
			// --- DECRYPTION TEST ---
			// Decode from base64...
			$ciphertext_dec = base64_decode($ciphertext_base64);
			// retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
			$iv_dec = substr($ciphertext_dec, 0, $iv_size);
			// retrieves the cipher text (everything except the $iv_size in the front)
			$ciphertext_dec = substr($ciphertext_dec, $iv_size);
			// may remove 00h valued characters from end of plain text
			$plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);
				if($showdebug==1){
					$outtie.="<p class=\"debugout\">Decrypted password: ".$plaintext_dec."</p>\n";
				}
		}
		
		// Generate the secure.php file...
		$secure_inc_php_output="<";
		$secure_inc_php_output.="?"."php\n// shhh...\n// http://php.net/manual/en/function.mcrypt-encrypt.php\n$";
		$secure_inc_php_output.="supersecret = pack('H*', \"".$rndhexval."\");\n$";
		$secure_inc_php_output.="key_size =  strlen($";
		$secure_inc_php_output.="supersecret);\n$";
		$secure_inc_php_output.="iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);\n$";
		$secure_inc_php_output.="iv = mcrypt_create_iv($";
		$secure_inc_php_output.="iv_size, MCRYPT_RAND);\n$";
		$secure_inc_php_output.="passwd_b64=\"".$ciphertext_base64."\";\n$";
		$secure_inc_php_output.="decoded = base64_decode($";
		$secure_inc_php_output.="passwd_b64);\n$";
		$secure_inc_php_output.="iv_dec = substr($";
		$secure_inc_php_output.="decoded, 0, $";
		$secure_inc_php_output.="iv_size);\n$";
		$secure_inc_php_output.="decoded = substr($";
		$secure_inc_php_output.="decoded, $";
		$secure_inc_php_output.="iv_size);\n$";
		$secure_inc_php_output.="rawpass = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $";
		$secure_inc_php_output.="supersecret, $";
		$secure_inc_php_output.="decoded, MCRYPT_MODE_CBC, $";
		$secure_inc_php_output.="iv_dec);\n"."?".">";
		
		$outtie.="<p>Expected file structure:<br />\n\n_admin/css/styles.css -- a basic stylesheet<br />\n_admin/inc/secure.php -- the encrypted password-checking include.<br />\n_admin/index.php -- the main index page.<br />\n_admin/login.php -- the login processing page<br />\n_admin/logout.php -- the logout processing page<br />\n_admin/menu.php -- the main admin menu, which is only visible once the user has successfully logged in.</p>\n";
		$outtie.="<p><strong>_admin/inc/secure.php:</strong></p>\n<p><textarea rows=20 cols=60>".$secure_inc_php_output."</textarea></p>";
		$outtie.="<p><strong>_admin/index.php:</strong></p>\n<p><textarea rows=20 cols=60>".$index_pwd_check_output."</textarea></p>\n";
		$outtie.="<p><strong>_admin/login.php:</strong></p>\n<p><textarea rows=20 cols=60>".$login_php_output."</textarea></p>\n";
		$outtie.="<p><strong>_admin/logout.php:</strong></p>\n<p><textarea rows=20 cols=60>".$logout_php_output."</textarea></p>\n";
		$outtie.="<p><strong>_admin/menu.php:</strong></p>\n<p><textarea rows=20 cols=60>".$menu_php_output."</textarea></p>\n";
		$outtie.="<p><strong>_admin/css/styles.css:</strong></p>\n<p><textarea rows=20 cols=60>".$css_output."</textarea></p>\n";
		}
}

function getRandomHex($num_bytes=4) {
	return bin2hex(openssl_random_pseudo_bytes($num_bytes));
}

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head profile="http://gmpg.org/xfn/11">
   <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
   <meta http-equiv="Content-Language" content="en-us" />
   <meta name="medium" content="blog" />
   <meta name="viewport" content="width=1000" />
   <style type="text/css">
   <!--
   html {margin: 0 auto;}
   html, body, div, span, applet, object, iframe {
   margin:0;padding:0;border:0;outline:0;font-weight:inherit;font-style:inherit;font-size:100%;font-family:inherit;vertical-align:baseline;}
   :focus {outline:0;}
   ol, ul {list-style:none;}
   .small {font:10px verdana, arial, helvetica;color:#663300;margin-top:0in;margin-bottom:.0in;line-height:12px}
   body {position:absolute;top:0px;left:0px;background:#fff;display:block;width:100%;font:10px verdana, arial, helvetica;margin:0 auto;}
   a {color:#cc0000;text-decoration:none;}
   a:visited {color:#999999;text-decoration:none;}
   a:hover {color:#cc0000;text-decoration:underline;}
   .hideit {display:none;}
   .main {font-family:verdana;font-size:11px;}
   .caption {font-family:verdana;font-size:11px;color:#777;}
   .ind {text-indent:1.8em;}
   #clearit {clear:both;}
   #wrapper { margin-left:80px; }
   hr {height:1px; border:none; color:#999; background-color:#999;}
   #moreinfo { background-color:#abf8fe;border:1px solid grey;padding:6px; width:550px; -moz-border-radius:10px; -webkit-border-radius:10px; border-radius:10px; }
   .hidden { display: none; }
   .unhidden { display: block; }
   .debugout {background-color:#ffb0b0;padding:6px;
   -->
   </style>
<title>Admin Password Encryption</title>
</head>
<body>
<h2>Admin Password Encryption</h2><p><a href="#" id="clickme">[What?]</a></p>
<div id="moreinfo" class="hidden">
<p>This is a utility which will create a password-protected subdirectory for the purposes of site administration for a small brand microsite.</p>
<p>The form asks for three things:<ul><li>The brand</li><li>The username</li><li>The password</li></ul></p>
<p>Once you provide those items, it generates a series of items which can be copied and pasted into specific files to create your custom admin area.</p>
<p>The best part is: It never saves the raw password anywhere. Only the encrypted and encoded password value is saved.</p>
</div>
<form name="form1" action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
<p><strong>Brand:</strong><input type="text" name="p_b" value="<?php echo $p_b ?>" /></p>
<p><strong>Username:</strong><input type="text" name="p_u" value="<?php echo $p_u ?>" /></p>
<p><strong>Password:</strong><input type="text" name="p_p" value="<?php echo $p_p ?>" /></p>
<p><input type="submit" name="p_send" value="Generate code" /></p>
</form>
<?php
echo $outtie;
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
$('#clickme').click(function() {
   $('#moreinfo').fadeIn('slow', function() {
      // Animation complete
   });
});
</script>
</body>
</html>
