<ul>

<?php		   	 
  
$sql = 'SELECT
	    dateEntered,
	    dateExpires,
	    description,
	    description_de,
		url,
	    published,
	    ID
	FROM
	    jobs
	ORDER BY
	    dateEntered DESC';
	    
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    echo 'die!';
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}


echo '<li>';
echo '<p><a href="?p=jobs&action=new">new</a></p>';
echo "</li>\n";

for($i = 0; $i < count($result); $i++) {
	

    	echo '<li>'."\n";
	//list($year, $month, $day, $hour, $minutes, $seconds) = split('[- ]',$result[$i]['date']);
	echo '    <p>';
	echo htmlentities($result[$i]['description']);
	echo "</p>\n";
	echo '<a href="?p=jobs&action=edit&id='.$result[$i]['ID'].'">edit</a>';
   	echo "</li>\n";
	
}

echo '<li>';
echo '<p><a href="?p=jobs&action=new">new</a></p>';
echo "</li>\n";

?>

</ul>
