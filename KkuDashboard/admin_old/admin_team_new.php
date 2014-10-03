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
	
require('config.php');

echo '<form action="admin_team_new_submit.php" method="post" name="savepost" id="savepost">
		<input type="hidden" name="submit" value="1">';

echo '<h2>orga</h2>';

//echo '<div id="orga"><p><span class="date"><input type="text" name="dateHired" value=""></span>';
echo '<span><input type=checkbox name="published" value="1" >published</span>';
echo '<span><input type=checkbox name="published_de" value="1" >published_de</span></p>';

echo '<p>imageUrl<span class="date"><input style="width:600px;" type="text" id="imageUrl" name="imageUrl" value=""><small><a href="javascript:toggleMediaChooser();">choose</a></small> <small><a href="javascript:toggleMediaUploader();">upload</a></small></span>';
echo '<span></p><p><input type=checkbox name="imagePublished" value="1" >imagePublished</span></p>';

    echo '<p><span style="min-width:200px; display:inline-table;">fullName:</span>
		<input style="width:400px;" type="text" name="fullName" value=""></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">tele:</span>
		<input style="width:400px;" type="text" name="tele" value=""></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">email:</span>
		<input style="width:400px;" type="text" name="email" value=""></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">website:</span>
		<input style="width:400px;" type="text" name="website" value=""></p>';
    echo '<p><span style="min-width:200px; display:inline-table;">importance:</span>
		<input style="width:40px;" type="text" name="importance" value=""></p>';

echo '<h2>english</h2>';

echo '<div id="english"><span class="title"><p>position:</p><input style="width:600px;" type="text" name="position" value=""></span>';
//echo '<p>about:</p><textarea name="about" style="width:600px; height:400px;"></textarea></p>';
	echo '</div>';

echo '<h2>deutsch</h2>';

echo '<div id="deutsch"><span class="title"><p>position:</p><input style="width:600px;" type="text" name="position_de" value=""></span><p>';
//echo '<p>about:</p><textarea name="about_de" style="width:600px; height:400px;"></textarea></p>';
	echo '</div>';

echo '<p><input type="submit" value="save post"></p>';
echo "</form>";

require('adminMediachooserUploader.php');
		
?>

<div id="loading">
<p>L&auml;dt gerade...</p>
</div>
<div id="targetDiv"></div>

<?php require('adminJavascript.php'); ?>
