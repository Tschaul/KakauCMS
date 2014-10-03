<?php

include('../auth.php'); 

require('../config.php');

$sql = 'INSERT INTO
			news(title,title_de,content,content_de,published,published_de,imageUrl,imagePublished,date) 
		VALUES
			("'.utf8_decode(mysql_real_escape_string($_POST['title'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['title_de'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['content'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['content_de'])).'",
			"'.mysql_real_escape_string($_POST['published']).'",
			"'.mysql_real_escape_string($_POST['published_de']).'",
			"'.mysql_real_escape_string($_POST['imageUrl']).'",
			"'.mysql_real_escape_string($_POST['imagePublished']).'",
			NOW());';
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich hizugefügt</p>
		<a href="admin.php">zurück zum Adminbereich</a>
		<p>'.stripslashes(mysql_real_escape_string($_POST['Inhalt'])).'</p>';
		

?>
