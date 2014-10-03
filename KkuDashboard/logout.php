<?php

	require_once('../KkuCommon/itemHelper.php');
	require_once('../KkuCommon/structureHelper.php');
	require_once('../KkuCommon/usersHelper.php');    
    
    if($_GET['username']!=''){
    
    	logoutUser($_GET['username']);
    
    
    }

    $hostname = $_SERVER['HTTP_HOST'];
    $path = dirname($_SERVER['PHP_SELF']);

    header('Location: http://'.$hostname.($path == '/' ? '' : $path).'/login.php');
    
?>