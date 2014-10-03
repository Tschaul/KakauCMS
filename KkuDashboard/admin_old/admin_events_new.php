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

    echo '<form action="admin_events_new_submit.php" method="post" name="savepost" id="savepost">
    		<input type="hidden" name="submit" value="1">';

    echo '<h2>orga</h2>';

    echo '<div id="orga">';

    echo '<p>date<span class="date: "><input type="text" id="date" name="date" value="'.date("Y-m-d H:i:s").'"> format: YYYY-MM-DD hh:mm:ss</span>';
    echo '<span></p>';

	echo '<p><span><input type=checkbox name="published" value="1" '; 
    echo '>published</span>';
    echo '<span><input type=checkbox name="published_de" value="1" '; 
    echo '>published_de</span></p>';


    echo '<p>imageUrl: <span class="date"><input style="width:400px;" type="text" id="imageUrl" name="imageUrl" value=""> <small><a href="javascript:toggleMediaChooser();">choose</a></small> <small><a href="javascript:toggleMediaUploader();">upload</a></small></span>';
    echo '<span><input type=checkbox name="imagePublished" value="1" ';
    echo '>imagePublished</span></p>';

    echo '<p>pdfUrl: <span class="date"><input style="width:400px;" type="text" id="pdfUrl" name="pdfUrl" value=""></span>';
    echo '<span><input type=checkbox name="pdfPublished" value="1" ';
    echo '>pdfPublished</span></p>';

    echo '<p>webUrl: <span class="date"><input style="width:400px;" type="text" id="webUrl" name="webUrl" value=""></span>';
    echo '<span><input type=checkbox name="webPublished" value="1" ';
    echo '>webPublished</span></p>';

    echo '<p>pptUrl: <span class="date"><input style="width:400px;" type="text" id="pptUrl" name="pptUrl" value=""></span>';
    echo '<span><input type=checkbox name="pptPublished" value="1" ';
    echo '>pptPublished</span></p></div>';

	echo '<p>presenter: <span class="date"><input style="width:400px;" type="text" id="presenter" name="presenter" value=""></p>';

	echo '<p>derivation: <span class="date"><input style="width:400px;" type="text" id="derivation" name="derivation" value=""></p>';

	echo '<p>location: <span class="date"><input style="width:400px;" type="text" id="location" name="location" value=""></p>';

   	echo '<p>title: <span class="title"><input style="width:400px;" type="text" name="title" value=""></span></p>';
    //echo '<p><textarea name="content" style="width:600px; height:200px;">'.stripslashes(htmlentities($result[$i]['abstract'])).'</textarea></p>';

    echo '<p><input type="submit"></p>';
    echo "</form>";


require('adminMediachooserUploader.php');
		
?>

<div id="loading">
<p>L&auml;dt gerade...</p>
</div>
<div id="targetDiv"></div>

<?php require('adminJavascript.php'); ?>
