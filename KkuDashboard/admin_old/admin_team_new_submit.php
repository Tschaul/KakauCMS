<?php

include('auth.php'); 

require('config.php');

$sql = 'INSERT INTO
			team(about,about_de,position,position_de,tele,email, website,fullName,imageUrl,imagePublished,published,published_de,importance,dateHired) 
		VALUES
			("'.mysql_real_escape_string($_POST['about']).'",
			"'.mysql_real_escape_string($_POST['about_de']).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['position'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['position_de'])).'",
			"'.mysql_real_escape_string($_POST['tele']).'",
			"'.mysql_real_escape_string($_POST['email']).'",
			"'.mysql_real_escape_string($_POST['website']).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['fullName'])).'",
			"'.mysql_real_escape_string($_POST['imageUrl']).'",
			"'.mysql_real_escape_string($_POST['imagePublished']).'",
			"'.mysql_real_escape_string($_POST['published']).'",
			"'.mysql_real_escape_string($_POST['published_de']).'",
			"'.mysql_real_escape_string($_POST['importance']).'",
			NOW());';
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich hizugefügt</p>
		<a href="admin.php">zurück zum Adminbereich</a>
		<p></p>';
		

?>
