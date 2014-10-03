<?php

//require('../config.php');

require_once('../KkuCommon/itemHelper.php');
require_once('../KkuCommon/structureHelper.php');
require_once('../KkuCommon/usersHelper.php');

//echo $_POST['username'].'<br>';

if ($_POST['username'] != '') {

	$key=loginUser($_POST['username'],$_POST['passwort']);

	setcookie("key", $key);
	setcookie("name", $_POST['username']);

    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']);	

    // Weiterleitung zur geschŸtzten Startseite
    if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
    	if (php_sapi_name() == 'cgi') {
        	header('Status: 303 See Other');
        }
        else {
        	header('HTTP/1.1 303 See Other');
        }
    }

    header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/admin.php');
    exit;
		
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
 <head>
  <title>Geschützter Bereich</title>
 </head>
 <body>
  <form action="login.php" method="post">
   Username: <input type="text" name="username" /><br />
   Passwort: <input type="password" name="passwort" /><br />
   <input type="submit" value="Anmelden" />
  </form>
 </body>
</html>
