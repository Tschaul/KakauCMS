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
			presenter,
			abstract,
			abstract_de,
			title,
			title_de,
			pdfUrl,
			pdfPublished,
			webUrl,
			webPublished,
			pptUrl,
			pptPublished,
			imageUrl,
			imagePublished,
			published,
			published_de,
			presenter,
			derivation,
			location
        FROM
            events
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

    echo '<form action="admin_events_edit_submit.php" method="post" name="savepost" id="savepost">
    		<input type="hidden" name="submit" value="1">
    		<input type="hidden" name="id" value="'.$_GET['id'].'">';

    echo '<h2>orga</h2>';

    echo '<div id="orga"><p><span class="date">date: <input type="text" name="date" value="'.htmlentities($result[$i]['date']).'"></span> format: YYYY-MM-DD hh:mm:ss</p><p>';
    echo '<span><input type=checkbox name="published" value="1" '; 
    if($result[$i]['published']){ echo 'checked';}
    echo '>published</span>';
    echo '<span><input type=checkbox name="published_de" value="1" '; 
    if($result[$i]['published_de']){ echo 'checked';}
    echo '>published_de</span></p>';

    echo '<p>imageUrl: <span class="date"><input style="width:400px;" type="text" id="imageUrl" name="imageUrl" value="'.htmlentities($result[$i]['imageUrl']).'"> <small><a href="javascript:toggleMediaChooser();">choose</a></small> <small><a href="javascript:toggleMediaUploader();">upload</a></small></span>';
    echo '<span><input type=checkbox name="imagePublished" value="1" '; 
    if($result[$i]['imagePublished']){ echo 'checked';}
    echo '>imagePublished</span></p>';

	echo '<p>pdfUrl: <span class="date"><input style="width:400px;" type="text" id="pdfUrl" name="pdfUrl" value="'.htmlentities($result[$i]['pdfUrl'])."\"> <small><a href=\"javascript:toggleMediaSearcher('pdf');\">search</a></small></span>";
    echo '<span><input type=checkbox name="pdfPublished" value="1" '; 
    if($result[$i]['pdfPublished']){ echo 'checked';}
    echo '>pdfPublished</span></p>';

	echo '<p>webUrl: <span class="date"><input style="width:400px;" type="text" id="webUrl" name="webUrl" value="'.htmlentities($result[$i]['webUrl'])."\"> <small><a href=\"javascript:toggleMediaSearcher('web');\">search</a></small></span>";
    echo '<span><input type=checkbox name="webPublished" value="1" '; 
    if($result[$i]['webPublished']){ echo 'checked';}
    echo '>webPublished</span></p>';

	echo '<p>pptUrl: <span class="date"><input style="width:400px;" type="text" id="pptUrl" name="pptUrl" value="'.htmlentities($result[$i]['pptUrl'])."\"> <small><a href=\"javascript:toggleMediaSearcher('ppt');\">search</a></small></span>";
    echo '<span><input type=checkbox name="pptPublished" value="1" '; 
    if($result[$i]['pptPublished']){ echo 'checked';}
    echo '>pptPublished</span></p></div>';

	echo '<p>presenter: <span class="date"><input style="width:400px;" type="text" id="presenter" name="presenter" value="'.htmlentities($result[$i]['presenter']).'"></p>';

	echo '<p>derivation: <span class="date"><input style="width:400px;" type="text" id="derivation" name="derivation" value="'.htmlentities($result[$i]['derivation']).'"></p>';

	echo '<p>location: <span class="date"><input style="width:400px;" type="text" id="location" name="location" value="'.htmlentities($result[$i]['location']).'"></p>';

    echo '<p>title: <span class="title"><input style="width:400px;" type="text" name="title" value="'.htmlentities($result[$i]['title']).'"></span></p>';
    //echo '<p><textarea name="content" style="width:600px; height:200px;">'.stripslashes(htmlentities($result[$i]['abstract'])).'</textarea></p>';

    echo '<p><input type="submit" value="save post"></p>';
    echo "</form>";

    echo '<h2>delete <small><a href="javascript:toggleDelete();">toggle</a></small></h2>';
    echo '<div id="delete"><form action="admin_events_delete.php" method="post" name="delpost" id="delpost">
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
