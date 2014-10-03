<?php

$fieldlist=getStructureProperty('fieldlist');

$belongingTablesList=getStructureProperty('belongingTablesList');

foreach($fieldlist as $tablename => $value){

	echo '<h4>'.$tablename.'</h4>';

	echo '<ul>';

	foreach($fieldlist[$tablename] as $key => $fieldproperties){

		echo '<li>';

		echo '<b>'.$fieldproperties['fieldname'].'</b>';

		foreach($fieldproperties as $key => $value){

			if($key!='fieldname') echo ' '.$key.': '.$value.' |

		}

		echo '</li>';

	}

	echo '</ul>';

	echo '<br>';

	print_r($belongingTablesList[$tablename]);

}











?>
