<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

tinyMCE.init({
mode : "textareas",
theme : "advanced"
});

function toggleEditor(id) {
	if (!tinyMCE.get(id))
		tinyMCE.execCommand('mceAddControl', false, id);
	else
		tinyMCE.execCommand('mceRemoveControl', false, id);
}

function insertHTML(html) {
    tinyMCE.execInstanceCommand("mce_editor_0","mceInsertContent",false,html);
}

</script>
 
<!--

<a href="javascript:toggleEditor('Inhalt');">Add/Remove editor</a>
<a href="javascript:tinyMCE.execCommand('mceInsertContent', false, '<img src=http://www.famberg.de/bilder/test.gif>');">Add something</a>

-->

<?php

displayFormHeader('news','new',$_GET['id']);

echo '<h2>orga</h2>';

echo '<div id="orga">';

displayInputPublished($item);

displayInputPublished_de($item);

//displayInputDate($item,'date');

displayInputImageUrl($item);

echo '</div>';


echo '<h2>english</h2>';

echo '<div id="english">';

displayInputTitle($item);

displayInputContent($item);

echo '<h2>deutsch</h2>';

echo '<div id="deutsch">';

displayInputTitle_de($item);

displayInputContent_de($item);

echo '</div>';

displayFormFooter('news','new',$_GET['id']);


require('adminMediachooserUploader.php');
		
?>

<div id="loading">
<p>L&auml;dt gerade...</p>
</div>
<div id="targetDiv"></div>

<?php require('adminJavascript.php'); ?>
