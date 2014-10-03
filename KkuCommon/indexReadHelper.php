<?php

function getIndex($indexname){

	$index = file_get_contents(dirname(__FILE__).'/../KkuDatabase/indices/'.$indexname.'.json');

	$index = json_decode($index,true);

	return $index;

}

?>
