<?php

function userIsAdmin($username){

	$users=getStructureProperty('users');

	//print_r($user);

	for($i=0; $i<count($users); $i++){
	
		if($users[$i]['user']==$username) $user=$users[$i];

	}

	//print_r($user);

	if($user['type']=='admin') return true;
	else return false;

}

function userIsEditor($username){

	$users=getStructureProperty('users');

	print_r($user);

	for($i=0; $i<count($users); $i++){
	
		if($users[$i]['user']==$username) $user=$users[$i];

	}

	if($user['type']=='editor') return true;
	else return false;

}

function userEditedTablesContains($username,$tablename){

	$users=getStructureProperty('users');

	//print_r($user);

	for($i=0; $i<count($users); $i++){
	
		if($users[$i]['user']==$username) $user=$users[$i];

	}

	//echo $user['editedTables'];

	return listHasEntry($user['editedTables'],$tablename);
}

function authUser($username,$userkey){

	$result=getStructureProperty('users');

	for($i = 0; $i < count($result); $i++) {
	
		
	    
		if($result[$i]['name']==$username){
	
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
	
	if ( !($timenow < $expiretime) || $active!=1 || hash('md5',$userkey)!=$key) {
	
		return false;
	
	}
	
	
	for($i=0; $i<count($result); $i++){
	
		if($result[$i]['name']==$username) $result[$i]['authDatetime']=date("Y-m-d H:i:s");
	
	}
	
	setStructureProperty('users',$result);

	return true;

}

function loginUser($username,$passwort){

	$result=getStructureProperty('users');

    if (getFieldWhereEquals($result,'md5hash','user',$username)==hash('md5',$passwort)){
	    
	    $length = 20;
	    
	    //generate random key

		//echo 'check';
	       
	    // start with a blank password
		$password = "";
		
		// define possible characters
		$possible = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
		    
		// set up a counter
		$i = 0; 
		    
		// add random characters to $password until $length is reached
		while ($i < $length) { 
			
			// pick a random character from the possible ones
			$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
			       
			// we don't want this character if it's already in the password
			if (!strstr($password, $char)) { 
				$password .= $char;
			 	$i++;
			}
			
		}
	    
	    //echo $password;
	    
	    //set cookie
	    
	    //save key to DB

		//echo $idfromdb[$username];

		$result=setFieldToWhereEquals($result,'authKey',hash('md5',$password),'name',$username);
		$result=setFieldToWhereEquals($result,'authDatetime',date("Y-m-d H:i:s"),'name',$username);
		$result=setFieldToWhereEquals($result,'authActive',1,'name',$username);

	    //$result[$idfromdb[$username]]['authKey']=$password;
		//$result[$idfromdb[$username]]['authDatetime']=date("Y-m-d H:i:s");
		//$result[$idfromdb[$username]]['authActive']=1;

		//print_r($result);

		setStructureProperty('users',$result);
		
		return $password;
		
	}

	return '';

}

function logoutUser($username){

	$users=getStructureProperty('users');	

	$users=setFieldToWhereEquals($users,'authKey','','name',$username);
	$users=setFieldToWhereEquals($users,'authActive',0,'name',$username);
	
	setStructureProperty('users',$users);
	
}

?>
