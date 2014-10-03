<?php



function getStructureProperty($propertyname){

	//print_r($GLOBALS['structures'][$propertyname]);

	if(!isset($GLOBALS['structures'][$propertyname])){

		$filename=dirname(__FILE__).'/../KkuDatabase/structure/'.$propertyname.'.json';
	
		if(file_exists($filename)){
	
			$property = file_get_contents($filename);
	
			$property = json_decode($property,true);
	
		}else {
	
			//$property[0]['_maxID']=0;
	
		}
	
	 	//echo $propertyname;
	 	
	 	$GLOBALS['structures'][$propertyname]=$property;
	 	
	}else{
	
		$property=$GLOBALS['structures'][$propertyname];
		
		//echo 'check';
	
	}

	return $property;

}

function setStructureProperty($propertyname,$property){

	$myFile = dirname(__FILE__).'/../KkuDatabase/structure/'.$propertyname.'.json';

	$fh = fopen($myFile, 'w');

	fwrite($fh,json_encode($property));

	fclose($fh);
	
	global $STRCUTURES;
	
	$GLOBALS['structures'][$propertyname]=$property;
    
}

function getStructureFields($structurename){

	if($structurename=='tables'){

		$fields[0]='name';
		$fields[1]='canHaveFile';
		$fields[2]='canHaveImage';
		$fields[3]='canBelong';
		$fields[4]='overviewTitleField';
		$fields[5]='overviewFields';
		$fields[6]='belDisp_showEdit';
		$fields[7]='belDisp_showDelete';
		$fields[8]='belDisp_showQuickAdder';
		$fields[9]='hideInTopmenu';
		$fields[10]='topmenuPosition';
		$fields[11]='insertFunction';

	}else if($structurename=='user'){

		$fields[0]='name';
		$fields[1]='md5hash';
		$fields[2]='authKey';
		$fields[3]='authActive';
		$fields[4]='authDatetime';
		$fields[5]='type';
		$fields[6]='editedTables';

	}else if($structurename=='indices'){

		$fields[0]='tablename';
		$fields[1]='indexname';
		$fields[2]='indextype';
		$fields[3]='touched';
		$fields[4]='touchType';
		$fields[5]='touchID';
		$fields[6]='manipulateFunction';
		$fields[7]='sortFunction';
		$fields[8]='filterFunction';

	}else if($structurename=='manipulations'){

		$fields[0]='type';
		$fields[1]='orderDirection';
		$fields[2]='orderField';

	}else if($structurename=='fields'){

		$fields[0]='name';
		$fields[1]='type';
		$fields[2]='default';

	}else if($structurename=='subtables'){

		$fields[0]='name';
		$fields[1]='fields';

	}else if($structurename=='belongingTables'){

		$fields[0]='name';
		//$fields[2]='insertTarget';

	}

	return $fields;


}

function getStructureDefaultValues($structurename){

	if($structurename=='tables'){

		$defaults['name']='';
		$defaults['canHaveFile']=0;
		$defaults['canHaveImage']=0;
		$defaults['canBelong']=0;
		$defaults['overviewTitleField']='';
		$defaults['overviewFields']='';
		$defaults['belDisp_showEdit']=1;
		$defaults['belDisp_showDelete']=1;
		$defaults['belDisp_showQuickAdder']=0;
		$defaults['hideInTopmenu']=0;
		$defaults['topmenuPosition']=5;
		$defaults['insertFunction']='';

	}else if($structurename=='user'){

		$defaults['name']='';
		$defaults['md5hash']='';
		$defaults['authKey']='';
		$defaults['authActive']='';
		$defaults['authDatetime']='';
		$defaults['type']='';
		$defaults['editedTables']='';

	}else if($structurename=='indices'){

		$defaults['tablename']='';
		$defaults['indexname']='';
		$defaults['indextype']='table';
		$defaults['touched']='';
		$defaults['touchType']='';
		$defaults['touchID']='';
		$defaults['manipulateFunction']='return $item;';
		$defaults['sortFunction']='return strnatcmp($item1[\'_ID\'], $item2[\'_ID\']);';
		$defaults['filterFunction']='return true;';

	}else if($structurename=='fields'){

		$defaults['name']='';
		$defaults['type']='standard';
		$defaults['default']='';

	}else if($structurename=='subtables'){

		$defaults['name']='';
		$defaults['fields']='';

	}else if($structurename=='belongingTables'){

		$defaults['name']='';
		//$fields[2]='insertTarget';

	}

	return $defaults;


}

function deleteStructureEntry($structurename,$id){

	$structure = getStructureProperty($structurename);

	$maxID=$structure[0]['_maxID'];

	for($i=0; $i<count($structure); $i++){
	
		if($structure[$i]['_ID']==$id) array_splice($structure,$i,1);

	}
    
	$structure[0]['_maxID']=$maxID;

    setStructureProperty($structurename,$structure);

}

function newStructureEntry($structurename,$newitem){
	
    $structure = getStructureProperty($structurename);

	$oldcount=count($structure);

    $structure[$oldcount]=$newitem;

	$structure[$oldcount]['_ID']=$structure[0]['_maxID']+1;

	$structure[0]['_maxID']++;

	//print_r($structure);
    
    setStructureProperty($structurename,$structure);

}

function editStructureEntry($structurename,$newitem,$id){

	$structure = getStructureProperty($structurename);

	for($i=0; $i<count($structure); $i++){
	
		if($structure[$i]['_ID']==$id) $structure[$i]=array_merge($structure[$i],$newitem);

	}

	//print_r($structure);
  
    setStructureProperty($structurename,$structure);

}

function createEmptyStructureItem($structurename,$belongsToID,$belongsToStrcuture){

	$item['_belongsToID']=$belongsToID;
	
	$item['_belongsToStructure']=$belongsToStructure;
	
	$item['_structurename']=$structurename;
	
	$defaults=getStructureDefaultValues($structurename);
	
	foreach($defaults as $key => $value){
	
		$item[$key]=$value;
	
	}

	newStructureEntry($structurename,$item);
	
	$property=getStructureProperty($structurename);
	
	return $property[0]['_maxID'];

}


?>
