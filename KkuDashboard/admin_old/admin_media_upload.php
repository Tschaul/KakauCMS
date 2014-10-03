<form enctype="multipart/form-data" action="admin_media_upload.php" method="POST">
Please choose a file: <input name="uploaded" type="file" /><br />
<input type="hidden" name="type" value="image">
alternativer Text:<input type="text" name="altText">
<input type="submit" value="Upload">
</form>

<?php 

include('auth.php'); 

$target = "upload/".date("YmdHis").'_'; 
$target = $target . basename( $_FILES['uploaded']['name']) ; 
$ok=1;

if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) {
	
	chmod($target,0755);
	
	$url = 'http://www.mss.cbi.uni-erlangen.de/php/admin/'.$target;
	
	$sql = 'INSERT INTO
				media(type,url,altText,dateAdded) 
			VALUES
				("'.$_POST['type'].'",
				"'.$url.'",
				"'.$_POST['altText'].'",
				NOW());';
			
	mysql_select_db($db, $link);
	mysql_query($sql,$link);

	echo $sql;

	echo $db;
	echo $link;
	
	echo "The file ". basename( $_FILES['uploaded']['name']). " has been uploaded";
	echo '<br><img src="'.$url.'">';
	
	header('Location: http://www.mss.cbi.uni-erlangen.de/php/admin/admin.php?tablename=media');
	
} else {
	echo "Sorry, there was a problem uploading your file.";
	
}

?>
