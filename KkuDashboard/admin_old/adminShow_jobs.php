<ul>

<?php

echo '<li>';
echo '<p><a href="?tablename=jobs&action=new">new</a></p>';
echo "</li>\n";	 
  
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

for($i = 0; $i < count($result); $i++) {
	

    	echo '<li>'."\n";
	echo '<div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">';
	//list($year, $month, $day, $hour, $minutes, $seconds) = split('[- ]',$result[$i]['date']);
	echo '    <p>';
	echo $result[$i]['description'];
	echo "</p>\n";
	echo '<a href="?tablename=jobs&action=edit&id='.$result[$i]['ID'].'">edit</a>';
	echo '</div>';
   	echo "</li>\n";
	
}

echo '<li>';
echo '<p><a href="?tablename=jobs&action=new">new</a></p>';
echo "</li>\n";

?>

</ul>
