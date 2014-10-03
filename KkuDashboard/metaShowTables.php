<?php

require_once('auth.php');


echo '<div style="padding: 10px 0; margin: 10px 0;">';
echo '<h3 style="display: inline;">structures . tables </h3> | <a href="?p=metaFormTables&action=new">add new entry</a></div>';

$tables=getStructureProperty('tables');

//print_r($tables);

$fields=getStructureProperty('fields');

$belongingTables=getStructureProperty('belongingTables');

$subtables=getStructureProperty('subtables');

if(count($tables)==1 && $tables[0]['_ID']==''){


	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
	
	echo 'no items yet';
	
	echo '</div>';


}else{

	for($i=0; $i<count($tables); $i++){
	
	
	
		echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
	
		echo '    <h3>';
		echo $tables[$i]['name'];	
		echo "</h3>\n";
	
		if($tables[$i]['canHaveFile']!='') echo '<p><div style="min-width:120px; float:left;">canHaveFile:</div> '.$tables[$i]['canHaveFile'].'</p>';
		if($tables[$i]['canHaveImage']!='') echo '<p><div style="min-width:120px; float:left;">canHaveImage:</div> '.$tables[$i]['canHaveImage'].'</p>';
		if($tables[$i]['canBelong']!='') echo '<p><div style="min-width:120px; float:left;">canBelong:</div> '.$tables[$i]['canBelong'].'</p>';
		if($tables[$i]['overviewTitleField']!='') echo '<p><div style="min-width:120px; float:left;">overviewTitleField:</div> '.$tables[$i]['overviewTitleField'].'</p>';
		if($tables[$i]['overviewFields']!='') echo '<p><div style="min-width:120px; float:left;">overviewFields:</div> '.$tables[$i]['overviewFields'].'</p>';
		if($tables[$i]['belDisp_showEdit']!='') echo '<p><div style="min-width:120px; float:left;">belDisp_showEdit:</div> '.$tables[$i]['belDisp_showEdit'].'</p>';
		if($tables[$i]['belDisp_showDelete']!='') echo '<p><div style="min-width:120px; float:left;">belDisp_showDelete:</div> '.$tables[$i]['belDisp_showDelete'].'</p>';
		if($tables[$i]['belDisp_showQuickAdder']!='') echo '<p><div style="min-width:120px; float:left;">belDisp_showQuickAdder:</div> '.$tables[$i]['belDisp_showQuickAdder'].'</p>';
		if($tables[$i]['hideInTopmenu']!='') echo '<p><div style="min-width:120px; float:left;">hideInTopmenu:</div> '.$tables[$i]['hideInTopmenu'].'</p>';
		if($tables[$i]['insertFunction']!='') echo '<p><div style="min-width:120px; float:left;">insertFunction:</div> '.$tables[$i]['insertFunction'].'</p>';
	
		echo '<p><b>fields:</b> ';
	
		for($o=0; $o<count($fields); $o++){
	
			if($fields[$o]['_belongsToID']==$tables[$i]['_ID']) echo $fields[$o]['name'].' ';
	
		}
	
		echo '</p><p>';
	
		echo '<b>belongingTables:</b> ';
	
		for($o=0; $o<count($belongingTables); $o++){
	
			if($belongingTables[$o]['_belongsToID']==$tables[$i]['_ID']) echo $belongingTables[$o]['name'].' ';
	
		}
	
		echo '</p><p>';
	
		echo '<b>subtables:</b> ';
	
		for($o=0; $o<count($subtables); $o++){
	
			if($subtables[$o]['_belongsToID']==$tables[$i]['_ID']) echo $subtables[$o]['name'].' ';
	
		}
	
		echo '</p>';	
	
	
		echo '<p><a href="?p=metaFormTables&action=edit&id='.$tables[$i]['_ID'];
		echo '">edit</a></p>';
	
		echo '</div>';
	
		
	
	}

}
?>
