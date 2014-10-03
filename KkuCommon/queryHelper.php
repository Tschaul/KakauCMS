<?php

function getItemFromPost($tablename){

	//echo $tablename;
	
	$fields=getStructureProperty('fields');

	$tables=getStructureProperty('tables');

	$tableID=getFieldWhereEquals($tables,'_ID','name',$tablename);

	$table=findItem($tables,'name',$tablename);

	$fieldlistarray=findItems($fields,'_belongsToID',$tableID);

	$item['_ID']=$_POST['id'];
	$item['_tablename']=$tablename;
	if($_POST['subtype']!='') $item['_subtype']=$_POST['subtype'];
	if($_POST['belongsToID']!='') $item['_belongsToID']=$_POST['belongsToID'];
	if($_POST['belongsToTable']!='') $item['_belongsToTable']=$_POST['belongsToTable'];

	for($i=0;$i<count($fieldlistarray);$i++){

		if( !(isset($fieldlistarray[$i]['fieldShow']) && $fieldlistarray[$i]['fieldShow']==0) ){

			$item[$fieldlistarray[$i]['name']]=$_POST[$fieldlistarray[$i]['name']];

			//echo $fieldlistarray[$i].',';

		}

	}

	return $item;

}

?>
