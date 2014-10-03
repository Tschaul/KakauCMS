<?php

function setFieldToWhereEquals($items,$field,$to,$where,$equals){

	for($i=0; $i<count($items); $i++){

		if($items[$i][$where]==$equals) $items[$i][$field]=$to;

	}

	return $items;

}

function getFieldWhereEquals($items,$field,$where,$equals){

	for($i=0; $i<count($items); $i++){

		if($items[$i][$where]==$equals) return $items[$i][$field];

	}

}

function findItem($items,$key,$value){

	for($i=0; $i<count($items); $i++){

		if($items[$i][$key]==$value) return $items[$i];

	}

}

function findItems($items,$key,$value){

	$o = 0;

	for($i=0; $i<count($items); $i++){

		//echo $items[$i]['_belongsToID'];
	
		if($items[$i][$key]==$value){

			$returnData[$o]=$items[$i];
			$o++;

			//echo 'check';

		}

	}

	//print_r($returnData);

	return $returnData;

}



function listHasEntry($list,$entryname){

	if(strstr($list,$entryname.';')!=false) return true;
	else return false;

}

function listToArray($list){

	$a=split('[;]',$list);

	$j = 0; 
		for($i = 0; $i < count($a); $i++){ 

			if($a[$i] != ""){ 
				
				$b[$j++] = $a[$i]; 

			} 
		} 

	return $b; 

}

function removeEmptyFields($items){

	

	for($i=0; $i<count($items); $i++){

		foreach($items[$i] as $key => $value) { 
			if($value == "") { 
				unset($items[$i][$key]); 

				//echo $key.' : '.$value.'<br>';
			
	  		}	 
		}

	}

	return $items;

}

function makeSortFunctionAsc($field) { 

	$code = "return strnatcmp(\$a['$field'], \$b['$field']);"; 

	return create_function('$a,$b', $code); 
	
} 

function makeSortFunctionDesc($field) { 

	$code = "return -1*strnatcmp(\$a['$field'], \$b['$field']);"; 

	return create_function('$a,$b', $code); 
	
}

function sortItemsAsc($items,$fieldname){
	
	//define("SORTFIELD",$fieldname);

	if(count($items)>0){

		usort($items,makeSortFunctionAsc($fieldname));

		return $items;

	}else{

		return null;

	}

}

function sortItemsDesc($items,$fieldname){
	
	//define("SORTFIELD",$fieldname);

	if(count($items)>0){

		usort($items,makeSortFunctionDesc($fieldname));

		return $items;

	}else{

		return null;

	}

}



function convert_datetime($str) {

	list($date, $time) = explode(' ', $str);
	list($year, $month, $day) = explode('-', $date);
	list($hour, $minute, $second) = explode(':', $time);

	$timestamp = mktime($hour, $minute, $second, $month, $day, $year);

	return $timestamp;
}

?>
