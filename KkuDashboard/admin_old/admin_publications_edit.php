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

/*

$sql = 'SELECT
			dateEntered,
			type,
			author,
			title,
			journal,
			year,
			volume,
			pages,
			ALTauthor,
			ALTeditor,
			publisher,
			series,
			address,
			booktitle,
			editor,
			school,
			organization,
			institution,
			howpublished,
			number,
			abstract,
			pdf,
			ID,
			condmat,
			imageUrl
        FROM
            publications
        WHERE
        	ID='.$_GET['id'].'
        ORDER BY
            ID DESC';
            
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    die();
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$item=mysql_fetch_array($resulttemp);
}

*/

$item=getItemFromDB('publications',$_GET['id']);

echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

echo '<h3>Main</h3>';

echo '<form action="adminQuery.php" method="post" name="savepost" id="savepost">
		<input type="hidden" name="submit" value="1">
		<input type="hidden" name="action" value="edit">
		<input type="hidden" name="type" value="'.$item['type'].'">
		<input type="hidden" name="tablename" value="publications">
		<input type="hidden" name="id" value="'.$_GET['id'].'">';




if($item['type']=='Article') {  

	echo '<h2>Article</h2>'."\n";
	echo '<p>author: <input type="text" name="author" value="'.$item['author'].'"><br>'."\n";
	echo 'title: <input type="text" name="title" value="'.$item['title'].'"><br>'."\n";
	echo 'journal: <input type="text" name="journal" value="'.$item['journal'].'"><br>'."\n";
	echo 'year: <input type="text" name="year" value="'.$item['year'].'"><br>'."\n";
	echo 'volume: <input type="text" name="volume" value="'.$item['volume'].'"><br>'."\n";
	echo 'pages: <input type="text" name="pages" value="'.$item['pages'].'"><br>'."\n";
	//echo 'pdf: <input type="text" name="pdf" value="'.$item['pdf'].'"><br>'."\n";
	echo 'abstract: <textarea name="abstract" style="width:600px; height:150px;">'.$item['abstract'].'</textarea><br>'."\n";
	echo 'condmat: <input type="text" name="condmat" value="'.$item['condmat'].'"><br>'."\n";

}



if($item['type']=='Book') {  

	echo '<h2>Book</h2>'."\n";
	echo '<p>ALTauthor: <input type="text" name="ALTauthor" value="'.$item['ALTauthor'].'"><br>'."\n";
	echo 'ALTeditor: <input type="text" name="ALTeditor" value="'.$item['ALTeditor'].'"><br>'."\n";
	echo 'title: <input type="text" name="title" value="'.$item['title'].'"><br>'."\n";
	echo 'publisher: <input type="text" name="publisher" value="'.$item['publisher'].'"><br>'."\n";
	echo 'year: <input type="text" name="year" value="'.$item['year'].'"><br>'."\n";
	echo 'volume: <input type="text" name="volume" value="'.$item['volume'].'"><br>'."\n";
	echo 'series: <input type="text" name="series" value="'.$item['series'].'"><br>'."\n";
	echo 'address: <input type="text" name="address" value="'.$item['address'].'"><br>'."\n";
	//echo 'pdf: <input type="text" name="pdf" value="'.$item['pdf'].'"><br>'."\n";
	echo 'abstract: <textarea name="abstract" style="width:600px; height:150px;">'.$item['abstract'].'</textarea><br>'."\n";
	echo 'condmat: <input type="text" name="condmat" value="'.$item['condmat'].'"><br>'."\n";
	echo 'imageUrl: <input type="text" id="imageUrl" name="imageUrl" value="'.$item['imageUrl'].'"><small><a href="javascript:toggleMediaChooser();">choose</a></small><small><a href="javascript:toggleMediaUploader();">upload</a></small><br>'."\n";
	echo 'coverUrl: <input type="text" id="coverUrl" name="coverUrl" value="'.$item['coverUrl'].'"><br>'."\n";

}


if($item['type']=='InCollection') {  

	echo '<h2>InCollection</h2>'."\n";
	echo '<p>author: <input type="text" name="author" value="'.$item['author'].'"><br>'."\n";
	echo 'title: <input type="text" name="title" value="'.$item['title'].'"><br>'."\n";
	echo 'booktitle: <input type="text" name="booktitle" value="'.$item['booktitle'].'"><br>'."\n";
	echo 'pages: <input type="text" name="pages" value="'.$item['pages'].'"><br>'."\n";
	echo 'publisher: <input type="text" name="publisher" value="'.$item['publisher'].'"><br>'."\n";
	echo 'year: <input type="text" name="year" value="'.$item['year'].'"><br>'."\n";
	echo 'editor: <input type="text" name="editor" value="'.$item['editor'].'"><br>'."\n";
	echo 'volume: <input type="text" name="volume" value="'.$item['volume'].'"><br>'."\n";
	echo 'series: <input type="text" name="series" value="'.$item['series'].'"><br>'."\n";
	echo 'address: <input type="text" name="address" value="'.$item['address'].'"><br>'."\n";
	//echo 'pdf: <input type="text" name="pdf" value="'.$item['pdf'].'"><br>'."\n";
	echo 'abstract: <textarea name="abstract" style="width:600px; height:150px;">'.$item['abstract'].'</textarea><br>'."\n";
	echo 'condmat: <input type="text" name="condmat" value="'.$item['condmat'].'"><br>'."\n";

}


if($item['type']=='PhdThesis') {  

	echo '<h2>PhdThesis</h2>'."\n";
	echo '<p>author: <input type="text" name="author" value="'.$item['author'].'"><br>'."\n";
	echo 'title: <input type="text" name="title" value="'.$item['title'].'"><br>'."\n";
	echo 'school: <input type="text" name="school" value="'.$item['school'].'"><br>'."\n";
	echo 'year: <input type="text" name="year" value="'.$item['year'].'"><br>'."\n";
	echo 'address: <input type="text" name="address" value="'.$item['address'].'"><br>'."\n";
	//echo 'pdf: <input type="text" name="pdf" value="'.$item['pdf'].'"><br>'."\n";
	echo 'abstract: <textarea name="abstract" style="width:600px; height:150px;">'.$item['abstract'].'</textarea><br>'."\n";
	echo 'condmat: <input type="text" name="condmat" value="'.$item['condmat'].'"><br>'."\n";

}


if($item['type']=='InProceedings') {  

	echo '<h2>InProceedings</h2>'."\n";
	echo 'author: <input type="text" name="author" value="'.$item['author'].'"><br>'."\n";
	echo 'title: <input type="text" name="title" value="'.$item['title'].'"><br>'."\n";
	echo 'booktitle: <input type="text" name="booktitle" value="'.$item['booktitle'].'"><br>'."\n";
	echo 'year: <input type="text" name="year" value="'.$item['year'].'"><br>'."\n";
	echo 'pages: <input type="text" name="pages" value="'.$item['pages'].'"><br>'."\n";
	echo 'editor: <input type="text" name="editor" value="'.$item['editor'].'"><br>'."\n";
	echo 'volume: <input type="text" name="volume" value="'.$item['volume'].'"><br>'."\n";
	echo 'series: <input type="text" name="series" value="'.$item['series'].'"><br>'."\n";
	echo 'address: <input type="text" name="address" value="'.$item['address'].'"><br>'."\n";
	echo 'organization: <input type="text" name="organization" value="'.$item['organization'].'"><br>'."\n";
	echo 'publisher: <input type="text" name="publisher" value="'.$item['publisher'].'"><br>'."\n";
	//echo 'pdf: <input type="text" name="pdf" value="'.$item['pdf'].'"><br>'."\n";
	echo 'abstract: <textarea name="abstract" style="width:600px; height:150px;">'.$item['abstract'].'</textarea><br>'."\n";
	echo 'condmat: <input type="text" name="condmat" value="'.$item['condmat'].'"><br>'."\n";

}


if($item['type']=='MasterThesis') {  

	echo '<h2>MasterThesis</h2>'."\n";
	echo '<p>author: <input type="text" name="author" value="'.$item['author'].'"><br>'."\n";
	echo 'title: <input type="text" name="title" value="'.$item['title'].'"><br>'."\n";
	echo 'school: <input type="text" name="school" value="'.$item['school'].'"><br>'."\n";
	echo 'year: <input type="text" name="year" value="'.$item['year'].'"><br>'."\n";
	echo 'address: <input type="text" name="address" value="'.$item['address'].'"><br>'."\n";
	//echo 'pdf: <input type="text" name="pdf" value="'.$item['pdf'].'"><br>'."\n";
	echo 'abstract: <textarea name="abstract" style="width:600px; height:150px;">'.$item['abstract'].'</textarea><br>'."\n";
	echo 'condmat: <input type="text" name="condmat" value="'.$item['condmat'].'"><br>'."\n";

}



if($item['type']=='TechReport') {  

	echo '<h2>TechReport</h2>'."\n";
	echo '<p>athor: <input type="text" name="author" value="'.$item['author'].'"><br>'."\n";
	echo 'title: <input type="text" name="title" value="'.$item['title'].'"><br>'."\n";
	echo 'institution: <input type="text" name="institution" value="'.$item['institution'].'"><br>'."\n";
	echo 'year: <input type="text" name="year" value="'.$item['year'].'"><br>'."\n";
	echo 'number: <input type="text" name="number" value="'.$item['number'].'"><br>'."\n";
	echo 'address: <input type="text" name="address" value="'.$item['address'].'"><br>'."\n";
	//echo 'pdf: <input type="text" name="pdf" value="'.$item['pdf'].'"><br>'."\n";
	echo 'abstract: <textarea name="abstract" style="width:600px; height:150px;">'.$item['abstract'].'</textarea><br>'."\n";
	echo 'condmat: <input type="text" name="condmat" value="'.$item['condmat'].'"><br>'."\n";

}




if($item['type']=='Misc') {  

	echo '<h2>Misc</h2>'."\n";
	echo '<p>author: <input type="text" name="author" value="'.$item['author'].'"><br>'."\n";
	echo 'title: <input type="text" name="title" value="'.$item['title'].'"><br>'."\n";
	echo 'howpublished: <input type="text" name="howpublished" value="'.$item['howpublished'].'"><br>'."\n";
	echo 'year: <input type="text" name="year" value="'.$item['year'].'"><br>'."\n";
	//echo 'pdf: <input type="text" name="pdf" value="'.$item['pdf'].'"><br>'."\n";
	echo 'abstract: <textarea name="abstract" style="width:600px; height:150px;">'.$item['abstract'].'</textarea><br>'."\n";
	echo 'condmat: <input type="text" name="condmat" value="'.$item['condmat'].'"><br>'."\n";

}

echo '<p><input type="submit" value="save post"><br>';
echo "</form>";

echo '</div>';

echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

displayInputFiles($item,$_GET['tablename'],$_GET['id']); 

echo '</div>';


echo '<h2><small><a href="javascript:toggleDelete();">Delete</a></small></h2>';
echo '<div id="delete">';

echo '<form action="adminQuery.php" method="post" name="savepost" id="savepost">
	<input type="hidden" name="tablename" value="publications">
	<input type="hidden" name="action" value="delete">
	<input type="hidden" name="id" value="'.$_GET['id'].'">';
echo '<p><input type="submit" value="Confirm delete"></p>';
echo "</form>";

echo '</div>';



require('adminMediachooserUploader.php');
		
?>

<div id="loading">
<p>L&auml;dt gerade...</p>
</div>
<div id="targetDiv"></div>

<?php require('adminJavascript.php'); ?>
