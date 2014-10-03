<?php

include('auth.php');

require('config.php');

$sql = 'UPDATE
			projects
		SET
			title = "'.utf8_decode(mysql_real_escape_string($_POST['title'])).'",
			title_de = "'.utf8_decode(mysql_real_escape_string($_POST['title_de'])).'",
			content = "'.utf8_decode(mysql_real_escape_string($_POST['content'])).'",
			content_de = "'.utf8_decode(mysql_real_escape_string($_POST['content_de'])).'",
			date = "'.mysql_real_escape_string($_POST['date']).'",
			published = "'.mysql_real_escape_string($_POST['published']).'",
			published_de = "'.mysql_real_escape_string($_POST['published_de']).'",
			imageUrl = "'.mysql_real_escape_string($_POST['imageUrl']).'",
			imagePublished = "'.mysql_real_escape_string($_POST['imagePublished']).'"
		WHERE
			ID = "'.$_POST['id'].'"';
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich editiert</p>
		<a href="admin.php">zur&uuml;ck zum Adminbereich</a>';
//echo <p>'.stripslashes(mysql_real_escape_string($_POST['Inhalt'])).'</p>';
		

?>
