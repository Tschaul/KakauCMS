<form enctype="multipart/form-data" action="admin_media_upload.php" method="POST" name="upload">
Please choose a file: <input name="uploaded" type="file" /><br />
<input type="hidden" name="type" value="image">
alternativer Text:<input type="text" name="altText">
<input type="submit" value="Upload">
</form>

<ul>

<?php

$sql = 'SELECT
			ID,
			dateAdded,
			url,
			altText,
			type
		FROM
			media
		ORDER BY
			dateAdded DESC';
	    
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    echo 'die!';
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}

for($i = 0; $i < count($result); $i++) {

    echo '<li style="margin-bottom:50px;">'."\n";
	echo '<div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">';
	echo '<img src="'.$result[$i]['url'].'">';
	echo '<p>url: '.$result[$i]['url'];
	echo '</p><small>';
    displayDeleteForm('media',$result[$i]['ID']);
	echo '</div>';
   	echo "</small></li>\n";


}

?>

<form enctype="multipart/form-data" action="admin_media_upload.php" method="POST" name="upload">
Please choose a file: <input name="uploaded" type="file" /><br />
<input type="hidden" name="type" value="image">
alternativer Text:<input type="text" name="altText">
<input type="submit" value="Upload">
</form>

</ul>


