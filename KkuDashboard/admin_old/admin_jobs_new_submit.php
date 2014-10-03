<?php

include('auth.php'); 

require('config.php');

$sql = 'INSERT INTO
			jobs(description,description_de,url,published,dateExpires,dateEntered) 
		VALUES
			("'.utf8_decode(mysql_real_escape_string($_POST['description'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['description_de'])).'",
			"'.mysql_real_escape_string($_POST['url']).'",
			"'.mysql_real_escape_string($_POST['published']).'",
			"'.mysql_real_escape_string($_POST['dateExpires']).'",
			NOW());';
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich hizugefügt</p>
		<a href="admin.php">zurück zum Adminbereich</a>
		<p></p>';
		

?>
