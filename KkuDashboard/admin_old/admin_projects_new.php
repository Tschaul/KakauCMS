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

    echo '<form action="admin_projects_new_submit.php" method="post" name="savepost" id="savepost">
    		<input type="hidden" name="submit" value="1">';

    echo '<h2>orga <small><a href="javascript:toggleOrga();">toggle</a></small></h2>';

    echo '<div id="orga"><span><input type=checkbox name="published" value="1" '; 
    echo '>published</span>';
    echo '<span><input type=checkbox name="published_de" value="1" '; 
    echo '>published_de</span></p>';

    echo '<p><span class="date"><input style="width:600px;" type="text" id="imageUrl" name="imageUrl" value=""><small><a href="javascript:toggleMediaChooser();">choose</a></small></span>';
    echo '<span></p><p><input type=checkbox name="imagePublished" value="1" ';
    echo '>imagePublished</span></p></div>';


    echo '<h2>english <small><a href="javascript:toggleEnglish();">toggle</a></small></h2>';

    echo '<div id="english"><span class="title"><input style="width:600px;" type="text" name="title" value=""></span><p>';
    echo '<textarea name="content" style="width:600px; height:400px;"></textarea></p></div>';

    echo '<h2>deutsch <small><a href="javascript:toggleDeutsch();">toggle</a></small></h2>';

    echo '<div id="deutsch"><span class="title"><input style="width:600px;" type="text" name="title_de" value=""></span><p>';
    echo '<textarea name="content_de" style="width:600px; height:400px;"></textarea></p></div>';

    echo '<p><input type="submit"></p>';
    echo "</form>";


require('adminMediachooserUploader.php');
		
?>

<div id="loading">
<p>L&auml;dt gerade...</p>
</div>
<div id="targetDiv"></div>

<?php require('adminJavascript.php'); ?>
