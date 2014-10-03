
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

tinyMCE.init({

theme : "advanced",
mode : "specific_textareas",
editor_selector : "mceEditor"
});

/*

tinyMCE.init({
	...
	
});
 
*/
 
function toggleEditor(id) {
	if (!tinyMCE.get(id))
		tinyMCE.execCommand('mceAddControl', false, id);
	else
		tinyMCE.execCommand('mceRemoveControl', false, id);
}

function insertHTML(html) {
    tinyMCE.execInstanceCommand("mceInsertContent",false,html);
}


</script>

<?php

$belongsToTablename=$_GET['belongsToTablename'];
$belongsToID=$_GET['belongsToID'];
$subtype=$_GET['subtype'];

$tablename=$_GET['tablename'];

if($_GET['action']=='new'){

	$id=createEmptyItem($tablename,$belongsToTablename,$belongsToID,$subtype);
	
	buildIndices();
	
	echo'
	
	
		<script type="text/javascript">
		<!--
		window.location.href = "admin.php?action=edit&tablename='.$tablename.'&id='.$id.'";
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

$tableID=getFieldWhereEquals($tables,'_ID','name',$_GET['tablename']);

$table=findItem($tables,'name',$_GET['tablename']);

$belongingTables=getStructureProperty('belongingTables');

$belongingTables=findItems($belongingTables,'_belongsToID',$tableID);

$item = getItemFromDB($tablename,$id);

//print_r($item);

// ID/belonging part / header

echo '<div style="padding: 10px 0; margin: 10px 0; float:left;">';
echo '<h3 style="display: inline;">tables . '.$tablename;

if($item['_subtype']!='') echo ' _ '.$item['_subtype'];

echo ' . '.$id.' <small>';


if($item['_subtype']!='') $subtablefields=getFieldWhereEquals($subtables,'fields','name',$item['_subtype']);

if($item['_belongsToID']!='' && $item['_belongsToTable']!='' ){
	
	displayLinkToParentEntry($item);

}

echo '</small></div><div style="float:right; padding-top:16px;" id="loading"><img src="ajax-loader.gif"> loading...</div>';


echo '<div style="clear:both;"></div>';

// image part

if($table['canHaveImage']){

	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

	echo '<h3>image</h3>';

	displayInputImage($item); 

	echo '</div>';

}


// file part

if($table['canHaveFile']){

	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

	echo '<h3>file</h3>';

	displayInputFile($item); 

	echo '</div>';

}

// main part

displayFormHeader($item);

displayInputBelongingEdit($item); 

echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

echo '<h3>main</h3>';

for($i=0; $i<count($fields); $i++){

	//echo $fields[$i]['_belongsToID'];

	if($fields[$i]['_belongsToID']==$tableID){
	
		//echo $subtablefields;
	
		if($item['_subtype']=='' || listHasEntry($subtablefields,$fields[$i]['name'])){

			if($fields[$i]['fieldShow']!='0'){

				if($fields[$i]['type']=='bool'){

					displayInputCheckbox($item,$fields[$i]['name']);

				}else if($fields[$i]['type']=='date'){
		
					displayInputDate($item,$fields[$i]['name']);

				}else if($fields[$i]['type']=='user'){
		
					displayInputUser($item,$fields[$i]['name']);

				}else if($fields[$i]['type']=='textarea'){
		
					displayInputTextarea($item,$fields[$i]['name']);

				}else if($fields[$i]['fieldDescription']!=''){
		
					displayInputStandardWithDescription($item,$fields[$i]['fieldName'],$fields[$i]['fieldDescription']);

				}else {

					displayInputStandard($item,$fields[$i]['name']);

				}

			}

		}

	}


}


displayFormFooter($tablename);

echo '</div>';


// belonging tables



for($i=0; $i<count($belongingTables); $i++){

	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

	displayInputBelonging($item,$belongingTables[$i]['name']);

	echo '</div>';

}



// delete part

displayDeleteFormWithConfirm($item);

		
?>

<?php require('adminJavascript.php'); ?>



