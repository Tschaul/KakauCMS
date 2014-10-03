<?php

include('../auth.php'); 

require('../config.php');

	$sql = 'DELETE FROM
			news
		WHERE
			ID = "'.$_POST['id'].'"';

echo $_POST['id'];
			
mysql_select_db($db, $link);
mysql_query($sql,$link);

echo '<p>Eintrag erfolgreich gelöscht</p>
		<a href="admin.php">zur&uuml;ck zum Adminbereich</a>';
//echo <p>'.stripslashes(mysql_real_escape_string($_POST['Inhalt'])).'</p>';
		

?>
