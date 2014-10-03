<?php

require_once('auth.php');




$user=getStructureProperty('user');


echo '<h3>Users</h3>';

for($i=0; $i<count($user); $i++){

	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
	
	echo '    <h2>';
	echo $user[$i]['user'];	
	echo "</h2>\n";
	echo "    <p>\n";

	echo '<ul><li><div style="min-width:120px; float:left;">type:</div> '.$user[$i]['type'].'</li>';
	if($user[$i]['editedTables']!='') echo '<li><div style="min-width:120px; float:left;">editedTables:</div> '.$user[$i]['editedTables'].'</li>';
	echo '<li><div style="min-width:120px; float:left;">password:</div> '.$user[$i]['password'].'</li>';
	echo '<li><div style="min-width:120px; float:left;">authKey:</div> '.$user[$i]['authKey'].'</li>';
	echo '<li><div style="min-width:120px; float:left;">authActive:</div> '.$user[$i]['authActive'].'</li>';
	echo '<li><div style="min-width:120px; float:left;">authDatetime:</div> '.$user[$i]['authDatetime'].'</li></ul>';
	echo "</p>\n";	


	echo '</div>';

}

?>
