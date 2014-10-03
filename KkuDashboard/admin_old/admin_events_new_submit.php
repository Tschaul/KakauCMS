<?php

include('auth.php'); 

require('config.php');

$sql = 'INSERT INTO
			events(title,title_de,abstract,abstract_de,pdfUrl,pdfPublished,webUrl,webPublished,pptUrl,pptPublished,presenter,derivation,location,published,published_de,imageUrl,imagePublished,date) 
		VALUES
			("'.utf8_decode(mysql_real_escape_string($_POST['title'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['title_de'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['abstract'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['abstract_de'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['pdfUrl'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['pdfPublished'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['webUrl'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['webPublished'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['pptUrl'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['pptPublished'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['presenter'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['derivation'])).'",
			"'.utf8_decode(mysql_real_escape_string($_POST['location'])).'",
			"'.mysql_real_escape_string($_POST['published']).'",
			"'.mysql_real_escape_string($_POST['published_de']).'",
			"'.mysql_real_escape_string($_POST['imageUrl']).'",
			"'.mysql_real_escape_string($_POST['imagePublished']).'",
			"'.mysql_real_escape_string($_POST['date']).'");';
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich hizugefügt</p>
		<a href="http://www.mss.cbi.uni-erlangen.de/php/admin/admin.php?p=events">zurück zum Adminbereich</a>
		<p>'.stripslashes(mysql_real_escape_string($_POST['Inhalt'])).'</p>';
		
?>
