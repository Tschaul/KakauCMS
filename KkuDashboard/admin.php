<?php 

ini_set('display_errors', 1); 
ini_set('log_errors', 1); 
ini_set('error_log', dirname(__FILE__) . '/error_log.txt'); 
//error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('auth.php');
require_once('../KkuCommon/itemHelper.php');
require_once('../KkuCommon/structureHelper.php');
require_once('../KkuCommon/indicesHelper.php');
require_once('../KkuCommon/tablesHelper.php');
require_once('../KkuCommon/usersHelper.php');
require_once('../KkuCommon/queryHelper.php');
require_once('../KkuCommon/imagesHelper.php');
require_once('FormFunctions.php');
//require_once('../meta/AdminDisplayFunctions.php');

//echo $authType;

header( "Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
header( "Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT" );
header( "Cache-Control: no-cache, must-revalidate" );
header( "Pragma: no-cache" );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 
  	
 </head>
 <body>
 
<style type="text/css">

*{

font-family: Helvetica;

color: #444;

}

a{

color: #888;

}

.seamlesslink{

color: #444;
text-decoration: none;

}

td{

padding-right: 15px;

}

</style>

<div style="
 
width: 800px;
margin-left: auto;
margin-right: auto;
padding: 10px;

background: #eee;
border: 1px solid #d7d7d7;
 
">

<title>Dashboard</title>

<?php
//<h1 style="display:inline;">Dashboard</h1>
?>

<img src="KakauDashboard.png" style="float:left;">


<small style="float:right;">


<?php if($_COOKIE['name']!=''){ echo 'logged in as '.$_COOKIE['name'].' - <a href="logout.php">logout</a>'; } ?>

</small>

<div id="navbar" style="clear:both;">

<?php 

/*

if(userIsAdmin($_COOKIE['name']) || (  userIsEditor($_COOKIE['name'])  &&  userEditedTablesContains($_COOKIE['name'],$_GET['news']))){
	
	echo '<a href="admin.php?tablename=news">news</a> ';

}

*/


$tables=getStructureProperty('tables');


$tables=sortItemsAsc($tables,'topmenuPosition');

echo '<div style="float:left; margin-bottom:10px;">';



for($i=0; $i<count($tables); $i++){

	if(!$tables[$i]['hideInTopmenu']){

		if(userIsAdmin($_COOKIE['name']) || (  userIsEditor($_COOKIE['name'])  &&  userEditedTablesContains($_COOKIE['name'],$tables[$i]['name']))){
	
			if($tables[$i]['topmenuPosition']>$tables[$i-1]['topmenuPosition'] && $i>0 ) echo ' | ';
	
			echo '<a href="admin.php?tablename='.$tables[$i]['name'].'">'.$tables[$i]['name'].'</a> ';

		}

	}

}

echo '</div>';

if(userIsAdmin($_COOKIE['name'])){


	echo '<div style="float:right; margin-bottom:10px;"><a href="admin.php?p=metaShowTables">tables</a> <a href="admin.php?p=metaShowUsers">users</a> <a href="admin.php?p=metaShowIndices">indices</a></div>';


}


?>

</div>

<hr style="clear:both;">
  
<?php

	if(isset($_GET['p'])){
	
		if($_GET['p']=='diagnosis') require('adminDiagnosis.php');

		if($_GET['p']=='tableOverview') require('adminTableOverview.php');

		if($_GET['p']=='metaShowUsers') require('metaShowUsers.php');

		if($_GET['p']=='metaFormUsers') require('metaFormUsers.php');

		if($_GET['p']=='metaShowTables') require('metaShowTables.php');

		if($_GET['p']=='metaFormTables') require('metaFormTables.php');

		if($_GET['p']=='metaShowIndices') require('metaShowIndices.php');

		if($_GET['p']=='metaFormIndices') require('metaFormIndices.php');

	}else{
		
		if($_GET['tablename']!=''){

			if($_GET['action']=='show' || $_GET['action']==''){

				if($_GET['itemfieldname']!=''){

					require('adminShow_'.$_GET['tablename'].'_'.$_GET['itemfieldname'].'.php');

				}else {			
			
					require('adminShow.php');

				}

			}else if($_GET['itemfieldname']!=''){

				require('adminFormForItemInsideEntry.php');

			}else{

				require('adminForm.php');

			}

		}else {

		echo "<h3>Welcome to the dashboard of the MSS-website!</h3><br><br><br>";

		//phpinfo();

		}
	
  	}
  
	
  
  ?>
  <hr>

	<div id="loading" style="display:none">
	<p>L&auml;dt gerade...</p>
	</div>
	<div id="targetDiv"></div>

 </body>
</html>
