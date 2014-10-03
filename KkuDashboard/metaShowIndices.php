<?php

require_once('auth.php');


echo '<div style="padding: 10px 0; margin: 10px 0;">';
echo '<h3 style="display: inline;">structures . indices</h3> | <a href="?p=metaFormIndices&action=new">add new entry</a></div>';


$indices=getStructureProperty('indices');

if(count($indices)==1 && $indices[0]['_ID']==''){


	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
	
	echo 'no items yet';
	
	echo '</div>';


}else{

	for($i=0; $i<count($indices); $i++){
		
		echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
		
		echo '    <h2>';
		echo $indices[$i]['indexname'];	
		echo "</h2>\n";
		
		if($indices[$i]['tablename']!='') echo '<p><div style="min-width:120px; float:left;">tablename:</div> '.$indices[$i]['tablename'].'</p>';
		if($indices[$i]['indextype']!='') echo '<p><div style="min-width:120px; float:left;">indextype:</div> '.$indices[$i]['indextype'].'</p>';
		if($indices[$i]['filterFunction']!='') echo '<p><div style="min-width:120px; float:left;">filterFunction:</div> '.$indices[$i]['filterFunction'].'</p>';
		if($indices[$i]['sortFunction']!='') echo '<p><div style="min-width:120px; float:left;">sortFunction:</div> '.$indices[$i]['sortFunction'].'</p>';
		if($indices[$i]['manipulateFunction']!='') echo '<p><div style="min-width:120px; float:left;">manipulateFunction:</div> '.$indices[$i]['manipulateFunction'].'</p>';
		if($indices[$i]['touched']!='') echo '<p><div style="min-width:120px; float:left;">touched:</div> '.$indices[$i]['touched'].'</p>';
		if($indices[$i]['touchType']!='') echo '<p><div style="min-width:120px; float:left;">touchType:</div> '.$indices[$i]['touchType'].'</p>';
		if($indices[$i]['touchID']!='') echo '<p><div style="min-width:120px; float:left;">touchID:</div> '.$indices[$i]['touchID'].'</p>';
		
		echo '<p><a href="?p=metaFormIndices&action=edit&id='.$indices[$i]['_ID'].'">edit</a></p>';
		
		
		echo '</div>';
		
	}

}
?>
