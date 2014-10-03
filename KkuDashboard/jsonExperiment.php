<?php		   	 

//echo 'check';

//$time_a = microtime(); 

require_once('auth.php');
require_once('../KkuCommon/itemHelper.php');
require_once('../KkuCommon/structureHelper.php');
require_once('../KkuCommon/indicesHelper.php');
require_once('../KkuCommon/tablesHelper.php');
require_once('../KkuCommon/usersHelper.php');
require_once('../KkuCommon/queryHelper.php');
require_once('../KkuCommon/imagesHelper.php');

include('image.php');

//echo 'check';

ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ERROR | E_WARNING | E_PARSE);


function cutUrlsFrom($tablename,$fieldname,$from){

	$items = getItemsFromDB($tablename);

	for($i=0; $i<count($items); $i++){

		$items[$i][$fieldname] = stristr($items[$i][$fieldname],$from);

	}

	setItemsInDB($tablename,$items);

}


function createnewfieldlist($fieldlistarray){

	for($i=0; $i<count($fieldlistarray); $i++){

		$newfieldlist[$i]['fieldName']=$fieldlistarray[$i];

		if($fieldlistarray[$i]=='published' || $fieldlistarray[$i]=='published_de') $newfieldlist[$i]['fieldType']='bool';

		if($fieldlistarray[$i]=='date' || $fieldlistarray[$i]=='dateExpires' || $fieldlistarray[$i]=='dateEntered') $newfieldlist[$i]['fieldType']='date';

		if($fieldlistarray[$i]=='pdfUrl' || $fieldlistarray[$i]=='webUrl' || $fieldlistarray[$i]=='pptUrl') $newfieldlist[$i]['fieldType']='date';

		if($fieldlistarray[$i]=='content' || $fieldlistarray[$i]=='content_de' || $fieldlistarray[$i]=='about' || $fieldlistarray[$i]=='about_de' || $fieldlistarray[$i]=='about' || $fieldlistarray[$i]=='abstract') $newfieldlist[$i]['fieldType']='textarea';

		if($newfieldlist[$i]['fieldType']=='') $newfieldlist[$i]['fieldType']='standard';

		if($fieldlistarray[$i]=='summerwinter') $newfieldlist[$i]['fieldDescription']='SS for summer- or WS for winterterm';

		if($fieldlistarray[$i]=='year') $newfieldlist[$i]['fieldDescription']='e.g. 2009 if SS or 2009/10 if WS';

		if($fieldlistarray[$i]=='importance') $newfieldlist[$i]['fieldDescription']='defines the display order on the website';


	}

	return $newfieldlist;

}

function getHighestID($items){

	$highestID=0;

	for($i=0; $i<count($items); $i++){

		//$items[$i]['_ID']=intval($items['_ID']);

		//echo $items[$i]['_ID'];

		if($items[$i]['_ID']>$highestID){
			
			$highestID=$items[$i]['_ID'];

			//echo $highestID.'<br>';

		}

	}

	return $highestID;


}

function setHighestID($tablename){

	$items=getItemsFromDB($tablename);

	$items[0]['_maxID']=getHighestID($items);

	setItemsInDB($tablename,$items);

}

function jsonReadable($json, $html=FALSE) { 
    $tabcount = 0; 
    $result = ''; 
    $inquote = false; 
    $ignorenext = false; 
    
    if ($html) { 
        $tab = "&nbsp;&nbsp;&nbsp;"; 
        $newline = "<br/>"; 
    } else { 
        $tab = "\t"; 
        $newline = "\n"; 
    } 
    
    for($i = 0; $i < strlen($json); $i++) { 
        $char = $json[$i]; 
        
        if ($ignorenext) { 
            $result .= $char; 
            $ignorenext = false; 
        } else { 
            switch($char) { 
                case '{': 
                    $tabcount++; 
                    $result .= $char . $newline . str_repeat($tab, $tabcount); 
                    break; 
                case '}': 
                    $tabcount--; 
                    $result = trim($result) . $newline . str_repeat($tab, $tabcount) . $char; 
                    break; 
                case ',': 
                    $result .= $char . $newline . str_repeat($tab, $tabcount); 
                    break; 
                case '"': 
                    $inquote = !$inquote; 
                    $result .= $char; 
                    break; 
                case '\\': 
                    if ($inquote) $ignorenext = true; 
                    $result .= $char; 
                    break; 
                default: 
                    $result .= $char; 
            } 
        } 
    } 
    
    return $result; 
}

untouchTables();

$tables=getStructureProperty('tables');

foreach($tables as $table) touchTableGlobal($table['name']);

buildIndices();

echo memory_get_peak_usage();

?>

