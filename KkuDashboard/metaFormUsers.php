<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>

<?php


if($_GET['action']=='new'){

	$id=createEmptyStructureItem('users',$_GET['belongsToID'],$_GET['belongsToStructure']);
	
    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']);

	if ($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1') {
		if (php_sapi_name() == 'cgi') {
			header('Status: 303 See Other');
		}
		else {
			header('HTTP/1.1 303 See Other');
		}
	}

	//header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/admin.php?p=metaFormUsers&action=edit&id='.$id.'');
	
	echo'
	
		<script type="text/javascript">
		<!--
		window.location.href = "admin.php?p=metaFormUsers&action=edit&id='.$id.'";
		//-->
		</script>
	
	';
	
	exit;
	
}else{

	$id=$_GET['id'];

}

$users=getStructureProperty('users');

$item=findItem($users,'_ID',$_GET['id']);


echo '<div style="padding: 10px 0; margin: 10px 0; float:left;">';
echo '<h3 style="display: inline;">structures . users . '.$_GET['id'].' </div>';

echo '<div style="float:right; padding-top:16px;" id="loading"><img src="ajax-loader.gif"> loading...</div>';


echo '<div style="clear:both;"></div>';

//standard inputs

echo '<form action="metaQuery.php" method="post" name="savepost" class="editpost">
		<input type="hidden" name="structurename" value="users">
		<input type="hidden" name="action" value="'.$_GET['action'].'">';
if($action=='edit'){
	echo '<input type="hidden" name="id" value="'.$_GET['id'].'">';
}


echo '<div style="border: 1px solid #d7d7d7; padding: 15px; margin-bottom: 20px; background: #fff;">';

echo '<h3>main</h3>';

//echo '<p><span style="min-width:160px; display:inline-block;">name: </span><input style="width:500px;" type="text" name="name" value="'.$item['name'].'"></span></p>';

displayInputStandard($item,'name');
displayInputStandard($item,'md5hash');
displayInputStandard($item,'authKey');
displayInputStandard($item,'authActive');
displayInputStandard($item,'authDatetime');
displayInputStandard($item,'type');
displayInputStandard($item,'editedTables');

echo '<p><input type="submit" value="save post"></p>';
	
echo '</form>';

echo '</div>';


//delete with confirm

echo '<div id="delete"><form action="metaQuery.php" method="post" name="savepost" class="deletepost">
	<input type="hidden" name="structurename" value="users">
	<input type="hidden" name="action" value="delete">
	<input type="hidden" name="id" value="'.$_GET['id'].'">';
echo '<p><input type="submit" value="Delete item!"></p>';
echo "</form></div>";
		
?>

<?php require('adminJavascript.php'); ?>



