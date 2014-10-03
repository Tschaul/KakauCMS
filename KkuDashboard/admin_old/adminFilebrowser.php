<?php

//define the path as relative
$path = "../../talks/".$_GET["path"].'/';

//echo $_GET['path'];

//using the opendir function
$dir_handle = opendir($path);

echo "Browsing for ".$_GET["type"]." | Directory Listing of $path<hr/>";

//running the while loop
while ($file = readdir($dir_handle)) {
		
	if(substr($file,0,1)!='.'){

		if(filetype($path . $file)=='dir'){

			echo "<p>[DIR] <a href=\"javascript:browseToPath('".$_GET["type"]."','".$_GET['path']."/".$file."');\">".$file."</a></p>";
	
		}else{

			echo "<p><a href=\"javascript:chooseFile('".$_GET["type"]."','http://www.mss.cbi.uni-erlangen.de/talks/".$_GET["path"]."/".$file."');\">".$file."</a></p>";
		}
	}
}

//closing the directory
closedir($dir_handle);

?>
