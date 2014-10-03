<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>

<?php

if($_GET['action']=='new'){

	$id=createEmptyStructureItem('tables',$_GET['belongsToID'],$_GET['belongsToStructure']);
	
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

	//header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/admin.php?p=metaFormTables&action=edit&id='.$id.'');
	
	echo'
	
		<script type="text/javascript">
		<!--
		window.location.href = "admin.php?p=metaFormTables&action=edit&id='.$id.'";
		//-->
		</script>
	
	';
	
	exit;
	
}else{

	$id=$_GET['id'];

}

$fields=getStructureProperty('fields');

$tables=getStructureProperty('tables');

$subtables=getStructureProperty('subtables');

$belongingTables=getStructureProperty('belongingTables');

$tableID=getFieldWhereEquals($tables,'_ID','name',$_GET['tablename']);

if(isset($_GET['id'])) $item=findItem($tables,'_ID',$_GET['id']);


echo '<div style="padding: 10px 0; margin: 10px 0; float:left;">';
echo '<h3 style="display: inline;">structures . tables . '.$_GET['id'].' </div>';

echo '<div style="float:right; padding-top:16px;" id="loading"><img src="ajax-loader.gif"> loading...</div>';


echo '<div style="clear:both;"></div>';

//standard inputs

echo '<form action="metaQuery.php" method="post" name="savepost" class="editpost">
		<input type="hidden" name="structurename" value="tables">
		<input type="hidden" name="action" value="'.$_GET['action'].'">';
if($_GET['action']=='edit'){
	echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
}


echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

echo '<h3>main</h3>';

//echo '<p><span style="min-width:160px; display:inline-block;">name: </span><input style="width:500px;" type="text" name="name" value="'.$item['name'].'"></span></p>';

displayInputStandard($item,'name');

displayInputCheckbox($item,'canBelong');
displayInputCheckbox($item,'canHaveFile');
displayInputCheckbox($item,'canHaveImage');

displayInputStandard($item,'overviewTitleField');
displayInputStandard($item,'overviewFields');

displayInputCheckbox($item,'belDisp_showEdit');
displayInputCheckbox($item,'belDisp_showDelete');
displayInputCheckbox($item,'belDisp_showQuickAdder');

displayInputCheckbox($item,'hideInTopmenu');
displayInputNumber($item,'topmenuPosition');

displayInputTextareaNoTinyMCE($item,'insertFunction');


echo '<p><input type="submit" value="save post"></p>';
	
echo '</form></form>';

echo '</div>';

if($_GET['action']!='new'){

	//fields

	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

	echo '<h3 style="display:inline;">fields</h3>';

	echo '<table>';

	echo '<tr>';
	
	echo '<td width=50></td>';
	echo '<td width=150><b>name</b></td>';
	echo '<td width=150><b>type</b></td>';
	echo '<td width=150><b>default</b></td>';
	echo '<td width=150><b>description</b></td>';
	echo '<td width=150></td>';

	echo '</tr>';

	for($i=0; $i<count($fields); $i++){

		if($fields[$i]['_belongsToID']==$item['_ID']){

			//echo '<li>';

			echo '<tr><td></td>';
	
			echo '<td> '.$fields[$i]['name'].'</td>';
			echo '<td> '.$fields[$i]['type'].'</td>';
			echo '<td> '.$fields[$i]['default'].'</td>';
			echo '<td> '.$fields[$i]['description'].'</td>';
			echo '<td> <a href="javascript:queryDeleteStructureItem(\'fields\','.$fields[$i]['_ID'].');">delete</a></td>';

			echo '</tr>';

			//echo '</li>';

		}
	
	}

	echo '</table><br>';

	echo '<div id="fieldadder">';

	echo "";

	echo '<form action="metaQuery.php" method="post" enctype="multipart/form-data" class="quickadder">
	Add another field: 
	name: <input type="text" name="name"> 
	type: <input type="text" name="type"> 
	default: <input type="text" name="default"> 
	description: <input type="text" name="description">
	<input type="hidden" name="belongsToID" value="'.$_GET['id'].'">
	<input type="hidden" name="belongsToStructure" value="tables">
	<input type="hidden" name="structurename" value="fields">
	<input type="hidden" name="action" value="new">	
	<input type="submit" value="Add">
	</form>';

	echo '</div>';

	echo '</div>';


	//belongingTables

	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

	echo '<h3 style="display:inline;">belongingTables</h3>';

	echo '<ul>';

	for($i=0; $i<count($belongingTables); $i++){

		if($belongingTables[$i]['_belongsToID']==$item['_ID']){

			echo '<li>';

			echo '<p>';
	
			echo 'name: '.$belongingTables[$i]['name'].' ';

			echo ' | <a href="javascript:queryDeleteStructureItem(\'belongingTables\','.$belongingTables[$i]['_ID'].');">delete</a></p>';

			echo '</li>';

		}
	
	}

	echo '</ul>';

	echo '<div id="fieldadder">';

	echo "";

	echo '<form action="metaQuery.php" method="post" enctype="multipart/form-data" class="quickadder">
	Add another belongingTable: 
	name: <input type="text" name="name">
	<input type="hidden" name="belongsToID" value="'.$_GET['id'].'">
	<input type="hidden" name="belongsToStructure" value="tables">
	<input type="hidden" name="structurename" value="belongingTables">
	<input type="hidden" name="action" value="new">
	<input type="submit" value="Add">
	</form>';

	echo '</div>';

	echo '</div>';




	//subtables

	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

	echo '<h3 style="display:inline;">subtables</h3>';

	echo '<ul>';

	for($i=0; $i<count($subtables); $i++){

		if($subtables[$i]['_belongsToID']==$item['_ID']){

			echo '<li>';

			echo '<p>';
	
			echo 'name: '.$subtables[$i]['name'].' | ';
			echo 'fields: '.$subtables[$i]['fields'].' | ';

			echo ' | <a href="javascript:queryDeleteStructureItem(\'subtables\','.$belongingTables[$i]['_ID'].');">delete</a></p>';

			echo '</li>';

		}
	
	}

	echo '</ul>';

	echo '<div id="fieldadder">';

	echo "";

	echo '<form action="metaQuery.php" method="post" enctype="multipart/form-data" class="quickadder">
	Add another belongingTable: 
	name: <input type="text" name="name">
	fields: <input type="text" name="fields">
	<input type="hidden" name="belongsToID" value="'.$_GET['id'].'">
	<input type="hidden" name="belongsToStructure" value="tables">
	<input type="hidden" name="structurename" value="subtables">
	<input type="hidden" name="action" value="new">	
	<input type="submit" value="Add">
	</form>';

	echo '</div>';

	echo '</div>';



	//delete with confirm

	echo '<div id="delete"><form action="metaQuery.php" method="post" name="savepost" class="deletepost">
		<input type="hidden" name="structurename" value="tables">
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="id" value="'.$_GET['id'].'">';
	echo '<p><input type="submit" value="Delete item!"></p>';
	echo "</form></div>";

}
		
?>

<?php require('adminJavascript.php'); ?>



