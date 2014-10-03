
<?php		   	 

$items=getItemsFromDB($_GET['tablename']);

$items=sortItemsDesc($items,'_ID');

$tables=getStructureProperty('tables');

$subtables=getStructureProperty('subtables');

$tablesitem=findItem($tables,'name',$_GET['tablename']);

echo '<div style="padding: 10px 0; margin: 10px 0;">';
echo '<h3 style="display: inline;">tables . '.$_GET['tablename'].'</h3> | <a href="?tablename='.$_GET['tablename'].'&action=new">add new entry</a>';

$pipeShown=0;

for($i=0; $i<count($subtables); $i++){

	if(getFieldWhereEquals($tables,'name','_ID',$subtables[$i]['_belongsToID'])==$_GET['tablename']){
	
		if(!$pipeShown) { echo ' | '; $pipeShown=1; }

		echo '<a href="?tablename='.$_GET['tablename'].'&subtype='.$subtables[$i]['name'].'&action=new">'.$subtables[$i]['name'].'</a> ';

	}

}

echo '</div>';


if(count($items)==1 && $items[0]['_ID']==''){


	echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
	
	echo 'no items yet';
	
	echo '</div>';


}else{

	for($i = 0; $i < count($items); $i++) {
	
	
		//if(userEditedTablesContains($_COOKIE['user'],$_GET['tablename'])) echo 'check';
	
		//if(userIsAdmin($_COOKIE['name'])) echo $_COOKIE['user'].';';
	
		if( userIsAdmin($_COOKIE['name']) || (  userIsEditor($_COOKIE['name'])  &&  userEditedTablesContains($_COOKIE['name'],$_GET['tablename']) && strstr($items[$i]['user'],$_COOKIE['user'].';')!=false ) ){
	
			echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';
	
	
		
			//displayItemFromTable($items[$i],$_GET['tablename']);
	
	
			echo '<h2>';
			
			if($items[$i]['_imageUrl']!='') echo '<img style="padding-right: 20px;" width="80" src="../KkuDatabase/images/'.getThumbUrl($items[$i]['_imageUrl']).'">';
	
			echo $items[$i]['_ID'].' - ';
	
			echo $items[$i][$tablesitem['overviewTitleField']];
	
			echo '</h2>';
	
			$fieldlist=listToArray($tablesitem['overviewFields']);
	
			//print_r($fieldlist);
	
			for($o=0; $o<count($fieldlist); $o++){
	
				if($items[$i][$fieldlist[$o]]!='') echo '<p><div style="min-width:120px; display:inline-block;">'.$fieldlist[$o].':</div> '.$items[$i][$fieldlist[$o]].'</p>';
	
			}
	
			echo '<p><a href="?tablename='.$_GET['tablename'].'&action=edit&id='.$items[$i]['_ID'];
			if($items[$i]['type']!='') echo '&subtype='.$items[$i]['_subtype'];
			echo '">edit</a></p>';
		   	echo "</li>\n";
			echo '</div>';
	
	
		}
	
	}

}
?>

