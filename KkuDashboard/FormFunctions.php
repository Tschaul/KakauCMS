<?php

function displayLinkToParentEntry($item){

	echo ' | belonging to <a href="?tablename='.$item['_belongsToTable'].'&action=edit&id='.$item['_belongsToID'].'">tables . '.$item['_belongsToTable'].' . '.$item['_belongsToID'].'</a>';

}



/* --------------------------------
	 Inputform header and footer 
------------------------------------*/

function displayFormHeader($item){

	echo '<form action="adminQuery.php" method="post" name="editpost" class="editpost">
    		<input type="hidden" name="tablename" value="'.$item['_tablename'].'">
    		<input type="hidden" name="action" value="edit">';
	echo '<input type="hidden" name="id" value="'.$item['_ID'].'">';
	
}

function displayFormFooter($tablename){

	echo '<p><input type="submit" value="save post"></p>';
	
	echo "</form>";

}

function displayDeleteFormWithConfirm($item){

	echo '<div id="delete"><form action="adminQuery.php" method="post" name="savepost" class="deletepost">
		<input type="hidden" name="tablename" value="'.$item['_tablename'].'">
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="id" value="'.$item['_ID'].'">';
	echo '<p><input type="submit" value="Delete item!"></p>';
	echo "</form></div>";

}

function displayDeleteForm($item){


	echo '<form action="adminQuery.php" method="post" name="savepost" id="deletepost">
    	<input type="hidden" name="tablename" value="'.$item['_tablename'].'">
		<input type="hidden" name="action" value="delete">
		<input type="hidden" name="id" value="'.$item['_ID'].'">';
	echo '<p><input type="submit" value="Delete"></p>';
	echo "</form>";

}

/* --------------------------------
	 hidden input fields 
------------------------------------*/

function displayInputBelongingEdit($item){

	echo '<input type="hidden" name="belongsToTable" value="'.$item['_belongsToTable'].'">';
	echo '<input type="hidden" name="belongsToID" value="'.$item['_belongsToID'].'">';

}

/* --------------------------------
	 Standard input fields 
------------------------------------*/


function displayInputUser($item,$fieldname){

	echo '<p><span style="min-width:160px; display:inline-block;">'.$fieldname.': </span><input type="text" name="'.$fieldname.'" value="';
	if($item[$fieldname]==''){

		if(!userIsAdmin($_COOKIE['user'])) echo $_COOKIE['user'].';';

	}else{		
		echo htmlentities($item[$fieldname]); 
	}
	echo '"><small> make sure there\'s an ";" at the end</small></p>';

}

function displayInputDate($item,$fieldname){

	echo '<p><span style="min-width:160px; display:inline-block;">'.$fieldname.': </span><input type="text" name="'.$fieldname.'" value="';	
	echo htmlentities($item[$fieldname]); 
	echo '"><small> format: YYYY-MM-DD hh:mm:ss</small></p>';

}

function displayInputStandard($item,$fieldname){
	
	echo '<p><span style="min-width:160px; display:inline-block;">'.$fieldname.': </span><input style="width:500px;" type="text" name="'.$fieldname.'" value="'.$item[$fieldname].'"></span></p>';

}

function displayInputStandardWithDescription($item,$fieldname,$desc){
	
	echo '<p><span style="min-width:160px; display:inline-block;">'.$fieldname.': </span><input style="width:250px;" type="text" name="'.$fieldname.'" value="'.$item[$fieldname].'"></span> <small>'.$desc.'</small></p>';

}

function displayInputCheckbox($item,$fieldname){

	echo '<p><span><input type=checkbox name="'.$fieldname.'" value="1" '; 
	if($item[$fieldname]){ echo 'checked';}
	echo '>'.$fieldname.'</span></p>';

}

function displayInputTextarea($item,$fieldname){
	
	echo '<p>'.$fieldname.': <a href="javascript:toggleSlideId(\'textarea'.$fieldname.'\')"><small>hide/show</small></a><br>';
	echo '<div id="textarea'.$fieldname.'"><textarea name="'.$fieldname.'" style="width:768px; height:400px;" class="mceEditor">'.stripslashes($item[$fieldname]).'</textarea></div></p>';

}

function displayInputTextareaNoTinyMCE($item,$fieldname){
	
	echo '<p>'.$fieldname.': <a href="javascript:toggleSlideId(\'textarea'.$fieldname.'\')"><small>hide/show</small></a><br>';
	echo '<div id="textarea'.$fieldname.'"><textarea name="'.$fieldname.'" style="width:768px; height:150px;">'.stripslashes($item[$fieldname]).'</textarea></div></p>';

}

function displayInputNumber($item,$fieldname){
	
	echo '<p><span style="min-width:160px; display:inline-block;">'.$fieldname.': </span><input style="width:100px;" type="text" name="'.$fieldname.'" value="'.htmlentities($item[$fieldname]).'"></span></p>';

}

/* --------------------------------
	 Special input fields 
------------------------------------*/

function displayInputImage($item){



	if($item['_imageUrl']!=""){ 
		
		echo '<p><span style="min-width:120px; display:inline-block;">image: </span>';
		echo '<img src="../KkuDatabase/images/'.htmlspecialchars($item['_imageUrl']).'" style="max-width:200px;">';
		echo ' <small><a href="javascript:queryDeleteImage(\''.$item['_tablename'].'\',\''.$item['_ID'].'\');">delete image</a></small>';

	}else{
	
		echo '<div id="imageuploader">';


		echo '<form action="adminQuery.php" method="post" enctype="multipart/form-data" class="uploader">
		Upload a file as image 
		<input type="file" name="uploaded">
		<input type="hidden" name="tablename" value="'.$item['_tablename'].'">
		<input type="hidden" name="id" value="'.$item['_ID'].'">
		<input type="hidden" name="uploadType" value="image">
		<input type="hidden" name="action" value="updateImage">
		<input type="submit" value="Upload">
		</form>';

		echo '</div>'; 

	}



}

function displayInputFile($item){



	if($item['_fileUrl']!=""){ 
		
		echo '<p><span style="min-width:120px; display:inline-block;">file: </span>';
		echo '<a href="../KkuDatabase/files/'.$item['_fileUrl'].'" style="max-width:200px;">link</a>';
		echo ' <small><a href="javascript:queryDeleteFile(\''.$item['_tablename'].'\',\''.$item['_ID'].'\');">delete file</a></small>';

	}else{
	
		echo '<div id="fileuploader">';


		echo '<form action="adminQuery.php" method="post" enctype="multipart/form-data" class="uploader">
		Upload a file as image 
		<input type="file" name="uploaded">
		<input type="hidden" name="tablename" value="'.$item['_tablename'].'">
		<input type="hidden" name="id" value="'.$item['_ID'].'">
		<input type="hidden" name="uploadType" value="file">
		<input type="hidden" name="action" value="updateFile">
		<input type="submit" value="Upload">
		</form>';

		echo '</div>'; 

	}



}

/* --------------------------------
	 Subitem Inputfields 
------------------------------------*/


function displayInputBelonging($item,$belongingTablename){


	$tables=getStructureProperty('tables');

	$tablesitem=findItem($tables,'name',$belongingTablename);
		
	$fieldlist=listToArray($tablesitem['overviewFields']);

	$tableID=getFieldWhereEquals($tables,'_ID','name',$belongingTablename);
	
	$fields=findItems(getStructureProperty('fields'),'_belongsToID',$tableID);

	echo '<h3 style="display:inline;">'.$belongingTablename.'</h3>';
	
	if(!$tablesitem['belDisp_showQuickAdder']) echo ' | <a href="?tablename='.$belongingTablename.'&action=new&belongsToTablename='.$item['_tablename'].'&belongsToID='.$item['_ID'].'">add new entry</a>';
	
	
	
	

	$items=getBelongingItemsFromDB($belongingTablename,$item['_ID'],$item['_tablename']);
	
	echo '<p></p>';	
	
	echo '<table>';


	echo '<tr>';
	
	if($tablesitem['canHaveImage']) echo '<td></td>';
	
	for($o=0; $o<count($fieldlist); $o++){

		echo '<td><b>'.$fieldlist[$o].'</b></td>';

	}	
	
	if($tablesitem['insertFunction']!='') echo '<td width="100"></td>';
	if($tablesitem['belDisp_showEdit']) echo '<td width="100"></td>';
	if($tablesitem['belDisp_showDelete']) echo '<td width="100"></td>';

	echo '</tr>';

	for($i=0; $i<count($items); $i++){

		//echo '<li>';

		echo '<tr>';
		
		if($tablesitem['canHaveImage']) {
		
			echo '<td>';
			
			if($items[$i]['_imageUrl']!='') echo '<img width="80" src="../KkuDatabase/images/'.getThumbUrl($items[$i]['_imageUrl']).'">';
		
		
			echo '</td>';
		
		}
		
		for($o=0; $o<count($fieldlist); $o++){
		
			if($items[$i][$fieldlist[$o]]!='') $display=$items[$i][$fieldlist[$o]];
			else $display='-';
	
			echo '<td><small><a class="seamlesslink" href="javascript:void(0);" onclick="queryChangeFieldValue(\''.$items[$i]['_tablename'].'\',\''.$items[$i]['_ID'].'\',\''.$fieldlist[$o].'\',\''.$items[$i][$fieldlist[$o]].'\')">'.$display.'</a></small></td>';
	
		}
		if($tablesitem['insertFunction']!=''){
		
			//echo 'check';
		
			$insertFunction=create_function('$item',stripslashes($tablesitem['insertFunction']));
			
			//echo htmlspecialchars($insertFunction($items[$i]));
		
			echo '<td align="right"><a onclick="tinyMCE.execCommand(\'mceInsertContent\',false,\''.$insertFunction($items[$i]).'\');" href="javascript:void(0);">insert</a></td>';		
		
		
		
		
		}
				
		if($tablesitem['belDisp_showEdit']) echo '<td align="right"><a href="?tablename='.$belongingTablename.'&action=edit&id='.$items[$i]['_ID'].'&belongsToTablename='.$item['_tablename'].'&belongsToID='.$item['_ID'].'">edit</a></td>';		
		
		if($tablesitem['belDisp_showDelete']) echo '<td align="right"><a href="javascript:queryDeleteItem(\''.$belongingTablename.'\',\''.$items[$i]['_ID'].'\');">delete</a></td>';
		
		//'<b>test</b>');

		echo '</tr>';		
	
	}

	echo '</table><br>';

	
	/* Old non table view

	echo '<ul>';

	$items=getBelongingItemsFromDB($belongingTablename,$item['_ID'],$item['_tablename']);

	for($i=0; $i<count($items); $i++){

		echo '<li style="margin-bottom:30px;">';
		
		echo '<p>';

		echo $items[$i]['_ID'].' - ';

		echo $items[$i][$tablesitem['overviewTitleField']];

		echo '';
		
		if($tablesitem['belDisp_showEdit']) echo ' | <a href="?tablename='.$belongingTablename.'&action=edit&id='.$items[$i]['_ID'].'&belongsToTablename='.$item['_tablename'].'&belongsToID='.$item['_ID'].'">edit</a>';
		
		if($tablesitem['belDisp_showDelete']) echo ' | <a href="javascript:queryDeleteItem(\'files\','.$items[$i]['_ID'].');">delete</a>';
		
		echo '</p><small>';

		for($o=0; $o<count($fieldlist); $o++){

			if($items[$i][$fieldlist[$o]]!='') echo '<p><div style="min-width:120px; display:inline-block;">'.$fieldlist[$o].':</div> '.$items[$i][$fieldlist[$o]].'</p>';

		}		

		echo '</small></li>';
		
	}

	echo '</ul>';
	
	*/
	
	if($tablesitem['belDisp_showQuickAdder']){

		echo '<div id="subscriberadder">';
		
		echo "";	
	
		echo '<form action="adminQuery.php" method="post" enctype="multipart/form-data" class="quickadder">Add another item of '.$belongingTablename.': ';
		
		

		for($o=0; $o<count($fields); $o++){

			echo $fields[$o]['name'].': <input type="text" name="'.$fields[$o]['name'].'">';

		}	
		
		if($tablesitem['canHaveFile']) {
		
			echo '<br> file: (25MB max) <input type="file" name="uploaded">';
		
			echo '<input type="hidden" name="uploadType" value="file" >';
			
		}
		
		if(!$tablesitem['canHaveFile'] && $tablesitem['canHaveImage']) {
		
			echo '<br> image: <input type="file" name="uploaded">';
		
			echo '<input type="hidden" name="uploadType" value="image" >';
			
		}
		
		echo '<input type="hidden" name="tablename" value="'.$belongingTablename.'">
		<input type="hidden" name="belongsToID" value="'.$item['_ID'].'">
		<input type="hidden" name="belongsToTable" value="'.$item['_tablename'].'">	
		<input type="hidden" name="action" value="new">	
		<input type="submit" value="Add">
		</form>';
	
		echo '</div>';
	
	}

}

?>
