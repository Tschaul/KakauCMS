<ul>

<?php		   	 
  
$sql = 'SELECT
			ID,
			date,
			presenter,
			abstract,
			abstract_de,
			title,
			title_de,
			pdfUrl,
			pdfPublished,
			pptUrl,
			pptPublished,
			imageUrl,
			imagePublished,
			published,
			published_de
		FROM
			events
		ORDER BY
			date DESC';
	    
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    echo 'die!';
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}

echo '<li>';
echo '<p><a href="?tablename=events&action=new">new</a></p>';
echo "</li>\n";

for($i = 0; $i < count($result); $i++) {

    echo '<li>'."\n";
	echo '<div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">';
	list($year, $month, $day, $hour, $minutes, $seconds) = split('[- ]',$result[$i]['date']);
	echo '<p>'.$year.' '.$month.' '.$day.'</p><a href="?tablename=events&action=edit&id='.$result[$i]['ID'].'">edit</a> '."\n";
    echo '<h2 style="display:inline;">';

   	echo $result[$i]['presenter'];
	
	echo '</h2>'."\n";
	echo '</div>';
	//echo '<a href="?p=events&action=edit&id='.$result[$i]['ID'].'">edit</a>';
   	echo "</li>\n";

}

echo '<li>';
echo '<p><a href="?tablename=events&action=new">new</a></p>';
echo "</li>\n";

?>

</ul>
