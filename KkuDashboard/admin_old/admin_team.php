<ul>

<?php		   	 
  
$sql = 'SELECT
	    dateHired,
	    about,
	    about_de,
	    position,
	    position_de,
	    tele,
	    email,
	    website,
	    fullName,
	    imageUrl,
	    imagePublished,
	    published,
	    published_de,
	    ID
	FROM
	    team
	ORDER BY
	    importance DESC';
	    
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    echo 'die!';
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}


echo '<li>';
echo '<p><a href="?p=team&action=new">new</a></p>';
echo "</li>\n";

for($i = 0; $i < count($result); $i++) {
	

    	echo '<li>'."\n";
	//list($year, $month, $day, $hour, $minutes, $seconds) = split('[- ]',$result[$i]['date']);
	echo '    <p>';
	if($lang=='de' && ($result[$i]['published_de']==1)){
		echo htmlentities($result[$i]['position_de']);	
	} else{
   		echo htmlentities($result[$i]['position']);
	}
	echo "</p>\n";
    	echo '    <h2>';
	echo htmlentities($result[$i]['fullName']);	
	echo "</h2>\n";
	echo "    <p>\n";

	if($result[$i]['imagePublished']==1){
		echo '<img class="bildlinks" src="';
		echo $result[$i]['imageUrl'];
		echo '"/>';
	}
	echo '<ul><li>tele: '.$result[$i]['tele'].'</li>';
	echo '<li>email: '.$result[$i]['email'].'</li>';
	echo '<li>website: <a href="http://'.$result[$i]['website'].'">'.$result[$i]['website'].'</a></li></ul>';
   	echo "    </p>\n";
	echo '<a href="?p=team&action=edit&id='.$result[$i]['ID'].'">edit</a>';
   	echo "</li>\n";
	
}

echo '<li>';
echo '<p><a href="?p=team&action=new">new</a></p>';
echo "</li>\n";

?>

</ul>
