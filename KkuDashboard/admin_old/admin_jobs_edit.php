<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

//tinyMCE.init({
//mode : "textareas",
//theme : "advanced"
//});
 
//function toggleEditor(id) {
//	if (!tinyMCE.get(id))
//		tinyMCE.execCommand('mceAddControl', false, id);
//	else
//		tinyMCE.execCommand('mceRemoveControl', false, id);
//}

function insertHTML(html) {
    tinyMCE.execInstanceCommand("mce_editor_0","mceInsertContent",false,html);
}

</script>
 
<!--

<a href="javascript:toggleEditor('Inhalt');">Add/Remove editor</a>
<a href="javascript:tinyMCE.execCommand('mceInsertContent', false, '<img src=http://www.famberg.de/bilder/test.gif>');">Add something</a>

-->

<?php
	
$sql = 'SELECT
			dateExpires,
			dateEntered,
			published,
			url,
			description,
			description_de
		FROM
			jobs
        WHERE
        	ID='.$_GET['id'].'
		ORDER BY
			dateEntered DESC';
		        
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    die();
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}

for($i = 0; $i < 1; $i++) {

    echo '<form action="admin_jobs_edit_submit.php" method="post" name="savepost" id="savepost">
    		<input type="hidden" name="submit" value="1">
    		<input type="hidden" name="id" value="'.$_GET['id'].'">';

    echo '<p><span class="date">dateExpires: <input type="text" name="dateExpires" value="'.$result[$i]['dateExpires'].'"></span>';
    echo '<span><input type=checkbox name="published" value="1" '; 
    if($result[$i]['published']){ echo 'checked';}
    echo '>published</span>';

    echo '<p><span style="min-width:200px; display:inline-table;">description:</span>
		<input style="width:400px;" type="text" name="description" value="'.htmlentities($result[$i]['description']).'"></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">description_de:</span>
		<input style="width:400px;" type="text" name="description_de" value="'.htmlentities($result[$i]['description_de']).'"></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">url:</span>
		<input style="width:400px;" type="text" name="url" value="'.$result[$i]['url'].'"></p>';

    echo '<p><input type="submit" value="save post"></p>';
    echo "</form>";

    echo '<h2>delete <small><a href="javascript:toggleDelete();">toggle</a></small></h2>';
    echo '<div id="delete"><form action="admin_jobs_delete.php" method="post" name="delpost" id="delpost">
    		<input type="hidden" name="id" value="'.$_GET['id'].'">';
    echo '<p><input type="submit" value="delete"></p>';
    echo "</form></div>";
}

require('adminMediachooserUploader.php');
		
?>

<div id="loading">
<p>L&auml;dt gerade...</p>
</div>
<div id="targetDiv"></div>

<?php require('adminJavascript.php'); ?>
