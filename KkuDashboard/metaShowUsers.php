<?php

require_once('auth.php');


echo '<div style="padding: 10px 0; margin: 10px 0;">';
echo '<h3 style="display: inline;">structures . users</h3> | <a href="?p=metaFormUsers&action=new">add new entry</a></div>';


$users=getStructureProperty('users');

if(count($users)==1 && $users[0]['_ID']==''){


	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
	
	echo 'no items yet';
	
	echo '</div>';


}else{

	for($i=0; $i<count($users); $i++){
	
		echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
		
		echo '    <h2>';
		echo $users[$i]['name'];	
		echo "</h2>\n";
	
		echo '<p><div style="min-width:120px; float:left;">type:</div> '.$users[$i]['type'].'</p>';
		if($users[$i]['editedTables']!='') echo '<p><div style="min-width:120px; float:left;">editedTables:</div> '.$users[$i]['editedTables'].'</p>';
		echo '<p><div style="min-width:120px; float:left;">md5hash:</div> '.$users[$i]['md5hash'].'</p>';
		echo '<p><div style="min-width:120px; float:left;">authKey:</div> '.$users[$i]['authKey'].'</p>';
		echo '<p><div style="min-width:120px; float:left;">authActive:</div> '.$users[$i]['authActive'].'</p>';
		echo '<p><div style="min-width:120px; float:left;">authDatetime:</div> '.$users[$i]['authDatetime'].'</p>';
	
		echo '<p><a href="?p=metaFormUsers&action=edit&id='.$users[$i]['_ID'].'">edit</a></p>';
	
	
		echo '</div>';
	
	}
}

?>
