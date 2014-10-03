<?php

require_once('../KkuCommon/itemHelper.php');
require_once('../KkuCommon/structureHelper.php');
require_once('../KkuCommon/indicesHelper.php');
require_once('../KkuCommon/usersHelper.php');
require_once('../KkuCommon/tablesHelper.php');
require_once('../KkuCommon/queryHelper.php');

/*

types:

delete item from structure

add field,subtable,belongingTable,manipulation

edit table,index,user

*/

//Do deletes


if($_POST['action']=='delete'){
	
	deleteStructureEntry($_POST['structurename'],$_POST['id']);

}

//Add structure entry


if($_POST['action']=='new'){

	$fields=getStructureFields($_POST['structurename']);

	for($i=0; $i<count($fields); $i++){

		$item[$fields[$i]]=$_POST[$fields[$i]];

	}

	$item['_belongsToID']=$_POST['belongsToID'];
	$item['_belongsToStructure']=$_POST['belongsToStructure'];

	//print_r($item);
	
	newStructureEntry($_POST['structurename'],$item);

}


//Edit structure entry

if($_POST['action']=='edit'){

	$fields=getStructureFields($_POST['structurename']);

	for($i=0; $i<count($fields); $i++){

		$item[$fields[$i]]=$_POST[$fields[$i]];

		echo $fields[$i].' - '.$_POST[$fields[$i]]."\n";

	}

	editStructureEntry($_POST['structurename'],$item,$_POST['id']);
	
	if($_POST['structurename']=='indices') {
	
		echo 'check';
	
		touchTableGlobal($item['tablename']);
	
		buildIndices();

	}

}


if($_POST['action']=='editSingleField'){

	$property=getStructureProperty($_POST['structurename']);
	
	//for($i)

	setSingleField($_POST['structurename'],$_POST['id'],$_POST['fieldname'],$_POST['value']);


}


?>
