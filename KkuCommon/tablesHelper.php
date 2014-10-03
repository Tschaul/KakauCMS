<?php 

require_once('imagesHelper.php');

function getItemsFromDB($tablename){

	if(!isset($GLOBALS['tables'][$tablename])){

		$filename=dirname(__FILE__).'/../KkuDatabase/content/'.$tablename.'.json';

		if(file_exists($filename)){		

			$items = file_get_contents($filename);

			$items = json_decode($items,true);

		}else {

			//$items[0]['_maxID']=0;

		}

		//for($i=0; $i<count($theData); $i++){
	
			//$theData[$i]=get_object_vars($theData[$i]);

		//}
		
		$GLOBALS['tables'][$tablename]=$items;

	}else{
	
		$items=$GLOBALS['tables'][$tablename];
		
		//echo 'check';
	
	}

	return $items;

}

function setItemsInDB($tablename,$items){
    
	$myFile = dirname(__FILE__).'/../KkuDatabase/content/'.$tablename.'.json';
	$fh = fopen($myFile, 'w');

	fwrite($fh,"[");

	for($i = 0; $i < count($items); $i++) {

		fwrite($fh,json_encode($items[$i]));
		
		if($i!=count($items)-1) fwrite($fh,",\n");

	}

	fwrite($fh,"]");

	fclose($fh);
	
	$GLOBALS['tables'][$tablename]=$items;
    
}

function getItemFromDB($tablename,$id){

	$items = getItemsFromDB($tablename);

	for($i=0; $i<count($items); $i++){
	
		if($items[$i]['_ID']==$id) return $items[$i];

	}

	//echo 'item not found '.$tablename.'->'.$id.'<br>';

	return null;

}


function getBelongingItemsFromDB($tablename,$belongsToID,$belongsToTablename){

	$items = getItemsFromDB($tablename);

	//print_r($items);

	$items = findItems($items,'_belongsToID',$belongsToID);

	$items = findItems($items,'_belongsToTable',$belongsToTablename);

	return $items;

	

}

function setSingleField($tablename,$id,$fieldname,$value){

	$items = getItemsFromDB($tablename);

	for($i=0; $i<count($items); $i++){
	
		if($items[$i]['_ID']==$id) {
		
			$items[$i][$fieldname]=$value;

			$position=$i;
			
			//echo $items[$i]['_ID'].' : '.$items[$i][$fieldname].' -> '.$value;
			
		}

	}
        
    setItemsInDB($tablename,$items);

	touchTable($items[$position],'editedItem');
	
	//echo $items[$position]['_ID'];

}

function deleteEntry($tablename,$id){

	echo $tablename.$id;

	$items = getItemsFromDB($tablename);

	$_maxID=$items[0]['_maxID'];

	for($i=0; $i<count($items); $i++){
	
		if($items[$i]['_ID']==$id) {
    
   		 	if($items[$i]['_fileUrl']!='') unlink("../KkuDatabase/files/".$items[$i]['_fileUrl']);
    
    		if($items[$i]['_imageUrl']!='') {
    		
    			unlink("../KkuDatabase/images/".$items[$i]['_imageUrl']);			
				
    			unlink("../KkuDatabase/images/".getThumbUrl($items[$i]['_imageUrl']));
				
    			unlink("../KkuDatabase/images/".getMidsizeUrl($items[$i]['_imageUrl']));
			
			}
			
			$item=$items[$i];
		
			array_splice($items,$i,1);
			
			$position=$i;
		}

	}
	
	$tables=getStructureProperty('tables');
	
	$belongingTables=getStructureProperty('belongingTables');

	$tableID=getFieldWhereEquals($tables,'_ID','name',$tablename);
	
	$belongingTables=findItems($belongingTables,'_belongsToID',$tableID);
	
	for($i=0; $i<count($belongingTables); $i++){
	
		//echo $belongingTables[$i]['name'].$id.$tablename;
			
		$belongingItems=getBelongingItemsFromDB($belongingTables[$i]['name'],$id,$tablename);
	
		for($o=0; $o<count($belongingItems); $o++){
		
			deleteEntry($belongingItems[$o]['_tablename'],$belongingItems[$o]['_ID']);
		
		}
	
	}	
    
	$items[0]['_maxID']=$_maxID;

    setItemsInDB($tablename,$items);

	//print_r($items);

	touchTable($item,'deletedItem');

}

function editEntry($tablename,$newitem,$id){

	$items = getItemsFromDB($tablename);

	for($i=0; $i<count($items); $i++){
	
		if($items[$i]['_ID']==$id) {
			
			$items[$i]=array_merge($items[$i],$newitem);
			
			$position=$i;
			
		}

	}
        
    setItemsInDB($tablename,$items);

	touchTable($items[$position],'editedItem');

}

function newEntry($tablename,$newitem){
	
    $items = getItemsFromDB($tablename);

	$oldcount=count($items);

    $items[$oldcount]=$newitem;

	$items[$oldcount]['_ID']=$items[0]['_maxID']+1;

	$items[0]['_maxID']++;
    
    setItemsInDB($tablename,$items);

	touchTable($items[$oldcount],'newItem');

}

function createEmptyItem($tablename,$belongsToTablename,$belongsToID,$subtable){

	$item['_belongsToID']=$belongsToID;
	$item['_belongsToTable']=$belongsToTablename;
	$item['_subtype']=$subtable;
	$item['_tablename']=$tablename;
	$item['_dateCreated']=date("Y-m-d H:i:s");
	
	$tables=getStructureProperty('tables');
	
	$tableID=getFieldWhereEquals($tables,'_ID','name',$tablename);
	
	$fields=findItems(getStructureProperty('fields'),'_belongsToID',$tableID);
	
	for($i=0; $i<count($fields); $i++){
		
		if($fields[$i]['type']=='date') $item[$fields[$i]['name']]=date("Y-m-d H:i:s");
	
		if($fields[$i]['default']!='') $item[$fields[$i]['name']]=$fields[$i]['default'];
	
	}

	newEntry($tablename,$item);

	$items = getItemsFromDB($tablename);
	
	return $items[0]['_maxID'];
	
}

function checkItemExists($tablename,$id){

	$item=getItemFromDB($tablename,$id);

	//echo $item['_ID'];

	if($item!=null) return true;
	else return false;

}

function tableHasField($tablename,$fieldname){
	
	$fields=getStructureProperty('fields');

	$tables=getStructureProperty('tables');

	for($i=0;$i<count($fields);$i++){

		if($fields[$i]['name']==$fieldname && getFieldWhereEquals($tables,'name','_ID',$fields[$i]['_belongsToID'])==$tablename){

			return true;

		}

	}

	return false;

}

function listOrphanedFiles(){

	$fieldlist=getStructureProperty('fieldlist');

	foreach($fieldlist as $tablename => $value){

		if(!tableissubtable($tablename)){

			echo $tablename.':<br>';

			$items=getItemsFromDB($tablename);

			for($i=0; $i<count($items); $i++){

				if($items[$i]['_belongsToTable']!='' && $items[$i]['_belongsToID']!=''){

					if(!checkItemExists($items[$i]['_belongsToTable'],$items[$i]['_belongsToID'])){

						echo $tablename.'->'.$items[$i]['_ID'].' is an orphan! belonging to '.$items[$i]['_belongsToTable'].'->'.$items[$i]['_belongsToID'].'<br>';

					}

				}

			}

		}

	}

}

function tablehasbelongingtable($tablename,$belongingtablename){

	$belongingTables=getStructureProperty('belongingTables');

	$tables=getStructureProperty('tables');

	for($i=0;$i<count($belongingTables);$i++){

		if($belongingTables[$i]['name']==$belongingtablename && getFieldWhereEquals($tables,'name','_ID',$belongingTables[$i]['_belongsToID'])==$tablename){

			return true;

		}
	}



	return false;

}


function tableissubtable($tablename){

	if(strpos($tablename,'_')>0){

		return true;

	}else{

		return false;

	}

}

?>
