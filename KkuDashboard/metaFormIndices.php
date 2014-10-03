<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>

<?php


if($_GET['action']=='new'){

	$id=createEmptyStructureItem('indices',$_GET['belongsToID'],$_GET['belognsToStructure']);
	
    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']);

	if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
		if (php_sapi_name() == 'cgi') {
			header('Status: 303 See Other');
		}
		else {
			header('HTTP/1.1 303 See Other');
		}
	}

	//header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/admin.php?p=metaFormIndices&action=edit&id='.$id.'');
	
	echo'
	
	
		<script type="text/javascript">
		<!--
		window.location.href = "admin.php?p=metaFormIndices&action=edit&id='.$id.'";
		//-->
		</script>
	
	
	
	
	';
	
	exit;
	
}else{

	$id=$_GET['id'];

}

$indices=getStructureProperty('indices');

$item=findItem($indices,'_ID',$id);


echo '<div style="padding: 10px 0; margin: 10px 0; float:left;">';
echo '<h3 style="display: inline;">structures . indices . '.$_GET['id'].' </div>';

echo '<div style="float:right; padding-top:16px;" id="loading"><img src="ajax-loader.gif"> loading...</div>';


echo '<div style="clear:both;"></div>';

//standard inputs

echo '<form action="metaQuery.php" method="post" name="savepost" class="editpost">
		<input type="hidden" name="structurename" value="indices">
		<input type="hidden" name="action" value="'.$_GET['action'].'">';
	echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';



echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

echo '<h3>main</h3>';

//echo '<p><span style="min-width:160px; display:inline-block;">name: </span><input style="width:500px;" type="text" name="name" value="'.$item['name'].'"></span></p>';

displayInputStandard($item,'indexname');
displayInputStandard($item,'tablename');
displayInputStandard($item,'indextype');
displayInputTextareaNoTinyMCE($item,'filterFunction');
displayInputTextareaNoTinyMCE($item,'sortFunction');
displayInputTextareaNoTinyMCE($item,'manipulateFunction');

echo '<p><input type="submit" value="save post"></p>';
	
echo '</form>';

echo '</div>';

//manipulations

/*

$manipulations=getStructureProperty('manipulations');

echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

echo '<h3 style="display:inline;">manipulations</h3>';

echo '<table>';

echo '<tr>';
	
echo '<td width=50></td>';
echo '<td width=150><b>type</b></td>';
echo '<td width=150><b>orderDirection</b></td>';
echo '<td width=150><b>orderField</b></td>';
echo '<td width=150></td>';

echo '</tr>';

for($i=0; $i<count($manipulations); $i++){

	if($manipulations[$i]['_belongsToID']==$item['_ID']){

		//echo '<li>';

		echo '<tr><td></td>';
	
		echo '<td> '.$manipulations[$i]['type'].'</td>';
		echo '<td> '.$manipulations[$i]['orderDirection'].'</td>';
		echo '<td> '.$manipulations[$i]['orderField'].'</td>';
		echo '<td> <a href="javascript:queryDeleteStructureItem(\'manipulations\','.$manipulations[$i]['_ID'].');">delete</a></td>';

		echo '</tr>';

		//echo '</li>';

	}
	
}

echo '</table><br>';

echo '<div id="fieldadder">';

echo "";

echo '<form action="metaQuery.php" method="post" enctype="multipart/form-data" class="quickadder">
Add another field: 
type: <input type="text" name="type"> 
orderDirection: <input type="text" name="orderDirection"> 
orderField: <input type="text" name="orderField"> 
<input type="hidden" name="belongsToID" value="'.$_GET['id'].'">
<input type="hidden" name="belongsToStructure" value="indices">
<input type="hidden" name="structurename" value="manipulations">
<input type="hidden" name="action" value="new">	
<input type="submit" value="Add">
</form>';

echo '</div>';

echo '</div>';

*/

//delete with confirm

echo '<div id="delete"><form action="metaQuery.php" method="post" name="savepost" class="deletepost">
	<input type="hidden" name="structurename" value="indices">
	<input type="hidden" name="action" value="delete">
	<input type="hidden" name="id" value="'.$_GET['id'].'">';
echo '<p><input type="submit" value="Delete item!"></p>';
echo "</form></div>";
		
?>

<?php require('adminJavascript.php'); ?>



