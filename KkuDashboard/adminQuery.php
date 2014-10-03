<?php

include('auth.php');

include('image.php');

require_once('../KkuCommon/itemHelper.php');
require_once('../KkuCommon/structureHelper.php');
require_once('../KkuCommon/indicesHelper.php');
require_once('../KkuCommon/usersHelper.php');
require_once('../KkuCommon/tablesHelper.php');
require_once('../KkuCommon/queryHelper.php');
require_once('../KkuCommon/imagesHelper.php');


// Do deletes

ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
error_reporting(E_ERROR | E_WARNING | E_PARSE);


if($_POST['action']=='delete'){
	
	/*
	
	$itemtemp=getItemFromDB($_POST['tablename'],$_POST['id']);
	
	if($itemtemp['_imageUrl']!=''){
	
		setSingleField($_POST['tablename'],$_POST['id'],"_imageUrl",'');
		
		unlink("../database/images/".$itemtemp['_imageUrl']);
	
	}
	
	if($itemtemp['_fileUrl']!=''){
	
		setSingleField($_POST['tablename'],$_POST['id'],"_fileUrl",'');
	
		unlink("../database/files/".$itemtemp['_fileUrl']);
		
	}

	*/

	deleteEntry($_POST['tablename'],$_POST['id']);

}

if($_POST['action']=='deleteImage'){

	//deleteFileFromDBAndFS($_POST['tablename'],$_POST['id'],$_POST['fieldname'],$_POST['fieldnamePublished'],$_POST['url']);
	
	$itemtemp=getItemFromDB($_POST['tablename'],$_POST['id']);
	
	setSingleField($_POST['tablename'],$_POST['id'],"_imageUrl",'');
	
	unlink("../KkuDatabase/images/".$itemtemp['_imageUrl']);
	unlink("../KkuDatabase/images/".getThumbUrl($itemtemp['_imageUrl']));
	unlink("../KkuDatabase/images/".getMidsizeUrl($itemtemp['_imageUrl']));
	
}

if($_POST['action']=='deleteFile'){

	//deleteFileFromFilesAndFS($_POST['id'],$_POST['url']);
	
	$itemtemp=getItemFromDB($_POST['tablename'],$_POST['id']);
	
	setSingleField($_POST['tablename'],$_POST['id'],"_fileUrl",'');
	
	unlink("../KkuDatabase/files/".$itemtemp['_fileUrl']);
	
}


// get item from POST

$item = getItemFromPost($_POST['tablename']);

//print_r($item);

if($_POST['id']=='') {

	$itemstemp = getItemsFromDB($_POST['tablename']);

	$maxID= $itemstemp[0]['_maxID']+1;

	$_POST['id']=$maxID;
}

// handle upload

if($_POST['uploadType']!=''){

	if($_POST['uploadType']=='file'){

		$target = "../KkuDatabase/files/".$_POST['tablename']."/".$_POST['id']."/";
		mkdir("../KkuDatabase/files/".$_POST['tablename']);
		mkdir($target);

		$url = $_POST['tablename']."/".$_POST['id']."/";

	}else if($_POST['uploadType']=='image'){
		
		$target = "../KkuDatabase/images/".$_POST['tablename']."/".$_POST['id']."/";
		mkdir("../KkuDatabase/images/".$_POST['tablename']);
		mkdir($target);

		$url = $_POST['tablename']."/".$_POST['id']."/";
	
	}else {
	
	}
		
	$target = $target.basename($_FILES['uploaded']['name']) ; 
	$url = $url.basename($_FILES['uploaded']['name']) ; 
	
	//echo $target;
	
	if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target)) {
	
		chmod($target,0755);
	
		if($_POST['uploadType']=='file'){
	
			$item['_fileUrl']=$url;
	
			//newEntry('files',$item);
	
		}else if($_POST['uploadType']=='image'){
	
			$item['_imageUrl']=$url;
	
			//newEntry('files',$item);
			 
			$img = new image;
			
			$img->createfromfile($target);
			
			if($img->width()>$img->height()){
			
				$left=($img->width()-$img->height())/2;
				
				$img->cut($left,0,$img->height(),$img->height());
			
			
			}else{
			
				$top=($img->height()-$img->width())/2;
				
				$img->cut(0,$top,$img->width(),$img->width());
			
			}			
			
			$img->resize(120,120,true);
			
			$thumbtarget=getThumbUrl($target);
			
			$img->save($thumbtarget,90);
			
			$img2 = new image;
			
			$img2->createfromfile($target);
			
			if($img2->width()>640 || $img2->height()>640 ){
			
				$img2->resize(640,640,true);
			}
			
			$midsizetarget=getMidsizeUrl($target);
	
			$img2->save($midsizetarget,90);
	
		}
	
	} else {

		echo "Sorry, there was a problem uploading your file.";
	
	}
	

}

//print_r($item);

// update database

if($_POST['action']=='updateImage'){

	setSingleField($_POST['tablename'],$_POST['id'],"_imageUrl",$url);

	echo $url;

}

if($_POST['action']=='updateFile'){

	setSingleField($_POST['tablename'],$_POST['id'],"_fileUrl",$url);

}


if($_POST['action']=='edit'){

	editEntry($_POST['tablename'],$item,$_POST['id']);
	
	//print_r($item);

}

if($_POST['action']=='new'){

	//print_r($item);
	
	//echo $url;

	newEntry($_POST['tablename'],$item);

}

if($_POST['action']=='editSingleField'){

	setSingleField($_POST['tablename'],$_POST['id'],$_POST['fieldname'],$_POST['value']);
	
	echo $_POST['tablename'].' - '.$_POST['id'].' - '.$_POST['fieldname'].' - '.$_POST['value'];


}

buildIndices();

?>


