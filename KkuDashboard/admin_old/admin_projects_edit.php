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
            ID,
			date,
			author,
			content,
			content_de,
			title,
			title_de,
			imageUrl,
			imagePublished,
			published,
			published_de
        FROM
            projects
        WHERE
        	ID='.$_GET['id'].'
        ORDER BY
            date DESC';
            
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    die();
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}

for($i = 0; $i < 1; $i++) {

    echo '<form action="admin_projects_edit_submit.php" method="post" name="savepost" id="savepost">
    		<input type="hidden" name="submit" value="1">
    		<input type="hidden" name="id" value="'.$_GET['id'].'">';

    echo '<h2>orga</h2>';

    echo '<div id="orga"><p><span class="date"><input type="text" name="date" value="'.htmlentities($result[$i]['date']).'"></span>';
    echo '<span><input type=checkbox name="published" value="1" '; 
    if($result[$i]['published']){ echo 'checked';}
    echo '>published</span>';
    echo '<span><input type=checkbox name="published_de" value="1" '; 
    if($result[$i]['published_de']){ echo 'checked';}
    echo '>published_de</span></p>';

    echo '<p><span class="date"><input style="width:600px;" type="text" id="imageUrl" name="imageUrl" value="'.htmlentities($result[$i]['imageUrl']).'"><small><a href="javascript:toggleMediaChooser();">choose</a></small></span>';
    echo '<span></p><p><input type=checkbox name="imagePublished" value="1" '; 
    if($result[$i]['imagePublished']){ echo 'checked';}
    echo '>imagePublished</span></p></div>';


    echo '<h2>english</h2>';

    echo '<div id="english"><span class="title"><input style="width:600px;" type="text" name="title" value="'.htmlentities($result[$i]['title']).'"></span>';
    echo '<p><textarea name="content" style="width:600px; height:400px;">'.stripslashes(htmlentities($result[$i]['content'])).'</textarea></p></div>';

    echo '<h2>deutsch</h2>';

    echo '<div id="deutsch"><span class="title"><input style="width:600px;" type="text" name="title_de" value="'.htmlentities($result[$i]['title_de']).'"></span><p>';
    echo '<textarea name="content_de" style="width:600px; height:400px;">'.stripslashes(htmlentities($result[$i]['content_de'])).'</textarea></p></div>';

    echo '<p><input type="submit" value="save post"></p>';
    echo "</form>";

    echo '<h2>delete <small><a href="javascript:toggleDelete();">toggle</a></small></h2>';
    echo '<div id="delete"><form action="admin_projects_delete.php" method="post" name="delpost" id="delpost">
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
