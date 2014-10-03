<?php

require_once('indexReadHelper.php');

function touchTableGlobal($tablename){

	$indices=getStructureProperty('indices');

	for($i=0; $i<count($indices); $i++){
	
		if($indices[$i]['tablename']==$tablename) {
			
			$indices[$i]['touched']=1;
			$indices[$i]['touchType']='global';
			
		}

	}

	setStructureProperty('indices',$indices);


}

function touchTable($item,$type){

	$indices=getStructureProperty('indices');

	for($i=0; $i<count($indices); $i++){
	
		if($indices[$i]['tablename']==$item['_tablename']) {
			
			$indices[$i]['touched']=1;
			$indices[$i]['touchType']=$type;
			$indices[$i]['touchID']=$item['_ID'];
			
		}

	}

	setStructureProperty('indices',$indices);
	
	//print_r($indices);
	
	//echo '<br><br>';
	
	$belongsToItem=getItemFromDB($item['_belongsToTable'],$item['_belongsToID']);
	
	if($belongsToItem['_ID']!=''){
	
		touchTable($belongsToItem,'editedItem');
		
	}

}

function untouchTables(){

	$indices=getStructureProperty('indices');

	for($i=0; $i<count($indices); $i++){
	
		$indices[$i]['touched']=0;
		$indices[$i]['touchType']='';
		$indices[$i]['touchID']='';

	}

	//print_r($indices);

	setStructureProperty('indices',$indices);

}

function giveItemToAppend($items){

	return appendBelongingItemsToIndex($subitems);

} //vorsicht hickhack!!!!!

function appendBelongingItemsToIndex($items){

	$tables=getStructureProperty('tables');
	
	$tablename=$items[0]['_tablename'];

	for($t2=0; $t2<count($tables); $t2++){

		$belongingtablename=$tables[$t2]['name'];

		if(tablehasbelongingtable($tablename,$belongingtablename)){

			//echo $belongingtablename;

			for($i=0; $i<count($items); $i++){

				$subitems=getBelongingItemsFromDB($belongingtablename,$items[$i]['_ID'],$tablename);

				$subitems=giveItemToAppend($items);

				$items[$i][$belongingtablename]=$subitems;

				//print_r($subitems);

			}

		}

	}

	return $items;

}

function appendBelongingItemsToItem($item){

	$tables=getStructureProperty('tables');

	for($t2=0; $t2<count($tables); $t2++){

		$belongingtablename=$tables[$t2]['name'];

		if(tablehasbelongingtable($item['_tablename'],$belongingtablename)){

			//echo $belongingtablename;

			$subitems=getBelongingItemsFromDB($belongingtablename,$item['_ID'],$item['_tablename']);

			$subitems=appendBelongingItemsToIndex($subitems,$belongingTable);

			$item[$belongingtablename]=$subitems;

			//print_r($subitems);
			
			echo memory_get_peak_usage();

		}

	}

	return $item;

}

function buildIndices(){

	$indices=getStructureProperty('indices');	
	
	//print_r($indices);

	for($i=0; $i<count($indices); $i++){
	
		$manipulateFunction=create_function('$item',stripslashes($indices[$i]['manipulateFunction']));
		
		$filterFunction=create_function('$item',stripslashes($indices[$i]['filterFunction']));

		if($indices[$i]['touched']==1 && $indices[$i]['touchType']!=''){

			if($indices[$i]['indextype']=='table'){
			
				if($indices[$i]['touchType']=='editedItem'){
				
					$index=getIndex($indices[$i]['indexname']);
				
					$newitem=getItemFromDB($indices[$i]['tablename'],$indices[$i]['touchID']);
					
					if($filterFunction($newitem)){
				
						$newitem=appendBelongingItemsToItem($newitem);
						
						$newitem=$manipulateFunction($newitem);
						
						$found=false;
					
						for($o=0; $o<count($index); $o++){
						
							if($index[$o]['_ID']==$indices[$i]['touchID']){
							
								//echo $index[$o]['_ID'];
								
								$position=$o;
								
								$found=true;
								
								$index[$o]=$newitem;
							
							}
						
						}
						
						if(!$found){								
						
							$oldcount=count($index);
						
							$index[$oldcount]=$newitem;
						
						}
						
					}else{
					
						for($o=0; $o<count($index); $o++){
						
							if($index[$o]['_ID']==$indices[$i]['touchID']) array_slice($index,$o,1);
						
						}					
					
					}
				
				}
				
				if($indices[$i]['touchType']=='newItem'){
				
					echo $indices[$i]['indexname'];
				
					$index=getIndex($indices[$i]['indexname']);
				
					$newitem=getItemFromDB($indices[$i]['tablename'],$indices[$i]['touchID']);
					
					if($filterFunction($newitem)){
				
						$newitem=appendBelongingItemsToItem($newitem);
						
						$newitem=$manipulateFunction($newitem);
					
						$oldcount=count($index);
					
						$index[$oldcount]=$newitem;	
						
						//print_r($index);
						
					}	
				
				}
				
				if($indices[$i]['touchType']=='deletedItem'){
				
					$index=getIndex($indices[$i]['indexname']);
				
					for($o=0; $o<count($index); $o++){
	
						if($index[$o]['_ID']==$indices[$i]['touchID']) array_splice($index,$o,1);

					}				
				
				}
				
				if($indices[$i]['touchType']=='global'){
				
					//echo $indices[$i]['tablename'];
				
					$index=getItemsFromDB($indices[$i]['tablename']);
					
					for($o=0; $o<count($index); $o++){
						
						if(!$filterFunction($index[$o])) array_splice($index,$o,1);
					
					}
					
					for($o=0; $o<count($index); $o++){
					
						$index[$o]=$manipulateFunction($index[$o]);
					
					}
				
					$index=appendBelongingItemsToIndex($index);
				
				}

			}
			
			$haveToSort=false;
			
			if($indices[$i]['touchType']=='global' || $indices[$i]['touchType']=='newItem'){
			
				$haveToSort=true;
			
			}else if($indices[$i]['touchType']=='deletedItem'){
			
				$haveToSort=false;
			
			}else if($indices[$i]['touchType']=='editedItem'){
			
				/*if( $sortFuntion($index[$position-1],$index[$position])<0 || $sortFuntion($index[$position],$index[$position+1])<0 ){
				
					$haveToSort=true;
				
				}else{
				
					$haveToSort=false;
				
				}*/
				
				$haveToSort=true;
			
			}
			
			if($haveToSort){			
			
				if(count($index)>0){

					usort($index,@create_function('$item1,$item2',stripslashes($indices[$i]['sortFunction'])));

				}
			
			}
			
			//print_r($index);

			$myFile = dirname(__FILE__).'/../KkuDatabase/indices/'.$indices[$i]['indexname'].'.json';

			$fh = fopen($myFile, 'w');

			fwrite($fh,json_encode($index));

			fclose($fh);

		}

	}

	untouchTables();
	
	//echo 'check';

	//buildactivityindex();
	
}


function buildactivityindex(){

	$activityCount=0;

	$items=getItemsFromDB('publications');

	for($i=0; $i<count($items); $i++){

		//echo time()-convert_datetime($items[$i]['dateEntered']);

		if((time()-convert_datetime($items[$i]['dateEntered']))<60*24*60*60){

			//echo $items[$i]['title'].'<br>';

			$activities[$activityCount]['date']=$items[$i]['dateEntered'];
			$activities[$activityCount]['table']='publications';
			$activities[$activityCount]['content']='publication added: <b>'.$items[$i]['title'].'</b> by '.$items[$i]['author'];
		
			$activityCount++;

		}

	}

	$items=getItemsFromDB('team');

	for($i=0; $i<count($items); $i++){

		//echo time()-convert_datetime($items[$i]['dateEntered']);

		if((time()-convert_datetime($items[$i]['dateHired']))<60*24*60*60){

			//echo $items[$i]['title'].'<br>';

			$activities[$activityCount]['date']=$items[$i]['dateHired'];
			$activities[$activityCount]['table']='team';
			$activities[$activityCount]['content']='team member added: '.$items[$i]['fullName'].'';
		
			$activityCount++;

		}

	}

	$items=getItemsFromDB('lectures');

	for($i=0; $i<count($items); $i++){

		//echo time()-convert_datetime($items[$i]['dateEntered']);

		if((time()-convert_datetime($items[$i]['dateEntered']))<60*24*60*60){

			//echo $items[$i]['title'].'<br>';

			$activities[$activityCount]['date']=$items[$i]['dateEntered'];
			$activities[$activityCount]['table']='lectures';
			$activities[$activityCount]['content']='lecture added: '.$items[$i]['title'].'';
		
			$activityCount++;

		}

	}
	
	$activities=sortItemsDesc($activities,'date');

	$myFile = dirname(__FILE__).'/../KkuDatabase/indices/activities.json';

	$fh = fopen($myFile, 'w');

	fwrite($fh,json_encode($activities));

	fclose($fh);

}


?>