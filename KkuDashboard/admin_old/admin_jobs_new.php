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

echo '<form action="admin_jobs_new_submit.php" method="post" name="savepost" id="savepost">
		<input type="hidden" name="submit" value="1">';
echo '<span><input type=checkbox name="published" value="1" >published</span>';

echo '<p>dateExpires<span class="date"><input type="text" id="dateExpires" name="dateExpires" value="'.date("Y-m-d H:i:s").'"> format: YYYY-MM-DD hh:mm:ss</span>';
echo '<span></p>';

echo '<p><span style="min-width:200px; display:inline-table;">description:</span>
	<input style="width:400px;" type="text" name="description" value=""></p>';
echo '<p><span style="min-width:200px; display:inline-table;">description_de:</span>
	<input style="width:400px;" type="text" name="description_de" value=""></p>';
echo '<p><span style="min-width:200px; display:inline-table;">url:</span>
	<input style="width:400px;" type="text" name="url" value=""></p>';

echo '<p><input type="submit" value="save post"></p>';
echo "</form>";

//require('adminMediachooserUploader.php');
		
?>

<div id="loading">
<p>L&auml;dt gerade...</p>
</div>
<div id="targetDiv"></div>

<?php require('adminJavascript.php'); ?>
