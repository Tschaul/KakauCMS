<?php

include('auth.php');

require('config.php');

$sql = 'UPDATE
			events
		SET
			title = "'.utf8_decode(mysql_real_escape_string($_POST['title'])).'",
			title_de = "'.utf8_decode(mysql_real_escape_string($_POST['title_de'])).'",
			abstract = "'.utf8_decode(mysql_real_escape_string($_POST['content'])).'",
			abstract_de = "'.utf8_decode(mysql_real_escape_string($_POST['content_de'])).'",
			pdfUrl = "'.utf8_decode(mysql_real_escape_string($_POST['pdfUrl'])).'",
			pdfPublished = "'.utf8_decode(mysql_real_escape_string($_POST['pdfPublished'])).'",
			webUrl = "'.utf8_decode(mysql_real_escape_string($_POST['webUrl'])).'",
			webPublished = "'.utf8_decode(mysql_real_escape_string($_POST['webPublished'])).'",
			pptUrl = "'.utf8_decode(mysql_real_escape_string($_POST['pptUrl'])).'",
			pptPublished = "'.utf8_decode(mysql_real_escape_string($_POST['pptPublished'])).'",
			date = "'.mysql_real_escape_string($_POST['date']).'",
			published = "'.mysql_real_escape_string($_POST['published']).'",
			published_de = "'.mysql_real_escape_string($_POST['published_de']).'",
			imageUrl = "'.mysql_real_escape_string($_POST['imageUrl']).'",
			imagePublished = "'.mysql_real_escape_string($_POST['imagePublished']).'",
			presenter = "'.utf8_decode(mysql_real_escape_string($_POST['presenter'])).'",
			derivation = "'.utf8_decode(mysql_real_escape_string($_POST['derivation'])).'",
			location = "'.utf8_decode(mysql_real_escape_string($_POST['location'])).'",
			date = "'.mysql_real_escape_string($_POST['date']).'"
		WHERE
			ID = "'.$_POST['id'].'"';
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich editiert</p>
		<a href="admin.php">zur&uuml;ck zum Adminbereich</a>';
//echo <p>'.stripslashes(mysql_real_escape_string($_POST['Inhalt'])).'</p>';
		

?>
