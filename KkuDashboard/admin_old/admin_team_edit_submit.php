<?php

include('auth.php'); 

require('config.php');

$sql = 'UPDATE
			team
		SET
			dateHired = "'.mysql_real_escape_string($_POST['dateHired']).'",
			fullName = "'.utf8_decode(mysql_real_escape_string($_POST['fullName'])).'",
			tele = "'.mysql_real_escape_string($_POST['tele']).'",
			email = "'.mysql_real_escape_string($_POST['email']).'",
			website = "'.mysql_real_escape_string($_POST['website']).'",
			position = "'.utf8_decode(mysql_real_escape_string($_POST['position'])).'",
			position_de = "'.utf8_decode(mysql_real_escape_string($_POST['position_de'])).'",
			about = "'.utf8_decode(mysql_real_escape_string($_POST['about'])).'",
			about_de = "'.utf8_decode(mysql_real_escape_string($_POST['about_de'])).'",
			published = "'.mysql_real_escape_string($_POST['published']).'",
			published_de = "'.mysql_real_escape_string($_POST['published_de']).'",
			imageUrl = "'.mysql_real_escape_string($_POST['imageUrl']).'",
			imagePublished = "'.mysql_real_escape_string($_POST['imagePublished']).'",
			importance = "'.mysql_real_escape_string($_POST['importance']).'"
		WHERE
			ID = "'.$_POST['id'].'"';
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich editiert</p>
		<a href="admin.php">zur&uuml;ck zum Adminbereich</a>';
echo '<p>'.mysql_real_escape_string($_POST['fullName']).'</p>';
		

?>
