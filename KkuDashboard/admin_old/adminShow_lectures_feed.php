<ul>

<?php


echo '<li><a href="?tablename='.$_GET['tablename'].'&id='.$_GET['id'].'&action=new&itemfieldname='.$_GET['itemfieldname'].'">new</a></li>';

$item = getFromDBById($_GET['tablename'],$_GET['id']);

$item = $item[$_GET['itemfieldname']];

//print_r($item);

//echo 'check';

for($i=0; $i<$item['count']; $i++){

	$thisitem=get_object_vars($item['item'.$i]);

	//print_r($thisitem);

	echo '<li>';	

	echo '<p>'.$thisitem['title'].' <small><a href="?tablename='.$_GET['tablename'].'&id='.$_GET['id'].'&slot='.$i.'&action=editInsideEntry&itemfieldname='.$_GET['itemfieldname'].'">edit</a></small></p>';

	echo '</li>';

}

echo '<li><a href="?tablename='.$_GET['tablename'].'&id='.$_GET['id'].'&action=newInsideEntry&itemfieldname='.$_GET['itemfieldname'].'">new</a></li>';

?>



</ul>
