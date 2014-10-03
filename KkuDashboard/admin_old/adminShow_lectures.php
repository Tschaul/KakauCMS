<ul>

<?php


echo '<li>';
echo '<p><a href="?tablename=lectures&action=new">new</a></p>';
echo "</li>\n"; 
  
$sql = 'SELECT
			about,
			about_de,
			title,
			lecturer,
			summerwinter,
			year,
			timeslotWeekday,
			timeslotTime,
			location,
			feed,
			published,
			published_de,
			ID
		FROM
			lectures
		ORDER BY
			year DESC,
			summerwinter DESC';
	    
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    echo 'die!';
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}

for($i = 0; $i < count($result); $i++) {
	
	echo '<li>';
	echo '<div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">';
   	echo '<p>'.$result[$i]['title'].' <small>by: '.$result[$i]['lecturer'].'</small></p>';

	echo '<p>'.$result[$i]['about'].'</p>';
	
	echo '<a href="?tablename=lectures&action=edit&id='.$result[$i]['ID'].'">edit</a>';
	echo '</div>';
	echo '</li>';
	
}

echo '<li>';
echo '<p><a href="?tablename=lectures&action=new">new</a></p>';
echo "</li>\n";

?>

</ul>
