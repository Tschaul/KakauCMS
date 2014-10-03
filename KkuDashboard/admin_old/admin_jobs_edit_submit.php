<?php

include('auth.php'); 

require('config.php');

$sql = 'UPDATE
			jobs
		SET
			
			published = "'.mysql_real_escape_string($_POST['published']).'",
			description = "'.utf8_decode(mysql_real_escape_string($_POST['description'])).'",
			description_de = "'.utf8_decode(mysql_real_escape_string($_POST['description_de'])).'",
			url = "'.mysql_real_escape_string($_POST['url']).'",
			duration = "'.mysql_real_escape_string($_POST['duration']).'"
		WHERE
			ID = "'.$_POST['id'].'"';
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich editiert</p>
		<a href="admin.php">zur&uuml;ck zum Adminbereich</a>';
echo '<p>'.mysql_real_escape_string($_POST['title']).'</p>';
		

?>
