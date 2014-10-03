<?php

require_once('../KkuCommon/itemHelper.php');
require_once('../KkuCommon/structureHelper.php');
require_once('../KkuCommon/usersHelper.php');

if(!authUser($_COOKIE['name'],$_COOKIE['key'])){

	//$hostname = $_SERVER['HTTP_HOST'];
	//$path = dirname($_SERVER['PHP_SELF']);
	
	//header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/login.php');
	
	
	echo'
	
	
		<script type="text/javascript">
		<!--
		window.location.href = "login.php";
		//-->
		</script>
	
	
	
	
	';
	
	exit;

}

/*

$result=getStructureProperty('users');

for($i = 0; $i < count($result); $i++) {

	
    
	if($result[$i]['name']==$_COOKIE['name']){

		$active=$result[$i]['authActive'];
		$key=$result[$i]['authKey'];
		$datetime=$result[$i]['authDatetime'];

		$authType=$result[$i]['type'];

		//echo $_COOKIE['user'].'  ';

	}

}

//Expire in hours
$expirehour = 2;

//Split Time & Date
$splitdatetime = explode(" ", $datetime);
$date = $splitdatetime[0];
$time = $splitdatetime[1];

//Split Date
$splitdate = explode("-", $date);
$year = $splitdate[0];
$month = $splitdate[1];
$day = $splitdate[2];

//Split Time
$splittime = explode(":", $time);
$hour = $splittime[0];
$min = $splittime[1];
$sec = $splittime[2];

//When does the time expire ?
$expiretime = date("Y-m-d H:i:s", mktime($hour+$expirehour,$min,$sec,$month,$day,$year));

$timenow = date("Y-m-d H:i:s");

$hostname = $_SERVER['HTTP_HOST'];
$path = dirname($_SERVER['PHP_SELF']);

//echo $timenow-$expiretime.'  '.$active.'  '.$_COOKIE['key'].'?'.$key;

if ( !($timenow < $expiretime) || $active!=1 || hash('md5',$_COOKIE['key'])!=$key) {
header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/login.php');
exit;
}


for($i=0; $i<count($result); $i++){

	if($result[$i]['name']==$_COOKIE['name']) $result[$i]['authDatetime']=date("Y-m-d H:i:s");

}

setStructureProperty('users',$result);

*/

?>
