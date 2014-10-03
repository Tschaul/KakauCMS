<?php
/*

echo '<div id="mediachooser" style="

display: none;
width:800px; 
position: absolute; 
left: 50%; 
top: 280px; 
margin-left: -400px;
background: #bbb; 
padding: 15px;


">';

echo '<span style="float:right;"><a href="javascript:toggleMediaChooser();">X</a></span>';

$sql = 'SELECT
			ID,
			dateAdded,
			url,
			altText,
			type
		FROM
			media
		ORDER BY
			dateAdded DESC';
	    
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    echo 'die!';
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}

echo "Browsing for imageUrl <hr>";

for($i = 0; $i < count($result); $i++) {

    echo "\n";
    echo '<a href="javascript:chooseMedia(\''.$result[$i]['_fileUrl'].'\');">';
	echo '<img width="190" src="'.$result[$i]['_fileUrl'].'">';
	echo '</a>';


}

echo '</div>';

*/





		
?>
