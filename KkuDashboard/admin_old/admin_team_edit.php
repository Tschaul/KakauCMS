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
			dateHired,
			about,
			about_de,
			position,
			position_de,
			tele,
			email,
			website,
			fullName,
			imageUrl,
			imagePublished,
			published,
			published_de,
			importance
		FROM
			team
        WHERE
        	ID='.$_GET['id'].'
		ORDER BY
			importance DESC';
		        
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    die();
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}

for($i = 0; $i < 1; $i++) {

    echo '<form action="admin_team_edit_submit.php" method="post" name="savepost" id="savepost">
    		<input type="hidden" name="submit" value="1">
    		<input type="hidden" name="id" value="'.$_GET['id'].'">';

    echo '<h2>orga</h2>';

    echo '<div id="orga"><p>';
    echo '<span><input type=checkbox name="published" value="1" '; 
    if($result[$i]['published']){ echo 'checked';}
    echo '>published</span>';
    echo '<span><input type=checkbox name="published_de" value="1" '; 
    if($result[$i]['published_de']){ echo 'checked';}
    echo '>published_de</span></p>';

    echo '<p><span class="date">imageUrl: <input style="width:600px;" type="text" name="imageUrl" id="imageUrl" value="'.$result[$i]['imageUrl'].'"><small><a href="javascript:toggleMediaChooser();">choose</a></small> <small><a href="javascript:toggleMediaUploader();">upload</a></small></span>';
    echo '<span></p><p><input type=checkbox name="imagePublished" value="1" '; 
    if($result[$i]['imagePublished']){ echo 'checked';}
    echo '>imagePublished</span></p>';

    echo '<p><span style="min-width:200px; display:inline-table;">fullName:</span>
		<input style="width:400px;" type="text" name="fullName" value="'.htmlentities($result[$i]['fullName']).'"></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">tele:</span>
		<input style="width:400px;" type="text" name="tele" value="'.$result[$i]['tele'].'"></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">email:</span>
		<input style="width:400px;" type="text" name="email" value="'.$result[$i]['email'].'"></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">website:</span>
		<input style="width:400px;" type="text" name="website" value="'.$result[$i]['website'].'"></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">importance:</span>
		<input style="width:40px;" type="text" name="importance" value="'.$result[$i]['importance'].'"></p></div>';

    echo '<h2>english</h2>';

    echo '<div id="english"><span class="title"><p>position:</p><input style="width:600px;" type="text" name="position" value="'.htmlentities($result[$i]['position']).'"></span>';
    //echo '<p>about:</p><textarea name="about" style="width:600px; height:400px;">'.stripslashes($result[$i]['about']).'</textarea></p>';
	echo '</div>';

    echo '<h2>deutsch</h2>';

    echo '<div id="deutsch"><span class="title"><p>position:</p><input style="width:600px;" type="text" name="position_de" value="'.htmlentities($result[$i]['position_de']).'"></span><p>';
    //echo '<p>about:</p><textarea name="about_de" style="width:600px; height:400px;">'.stripslashes($result[$i]['about_de']).'</textarea></p>';
	echo '</div>';

    echo '<p><input type="submit" value="save post"></p>';
    echo "</form>";

    echo '<h2>delete <small><a href="javascript:toggleDelete();">toggle</a></small></h2>';
    echo '<div id="delete"><form action="admin_team_delete.php" method="post" name="delpost" id="delpost">
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
