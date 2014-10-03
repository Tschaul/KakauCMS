<ul>

<li><a href="?p=news&action=new">new</a></li>

<?php		   	 
  
$sql = 'SELECT
	    ID,
	    date,
	    author,
	    content,
	    content_de,
	    title,
	    title_de,
	    imageUrl,
	    imagePublished,
	    published,
	    published_de
	FROM
	    news
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

for($i = 0; $i < count($result); $i++) {

    	echo '<li>'."\n";
	list($year, $month, $day, $hour, $minutes, $seconds) = split('[- ]',$result[$i]['date']);
	echo '    <p>'.$year.' '.$month.' '.$day."</p>\n";
    	echo '    <h2>';

	if($lang=='de' && ($result[$i]['published_de']==1)){
		echo $result[$i]['title_de'];	
	} else{
   		echo $result[$i]['title'];
	}
	echo "</h2>\n";
	echo "    <p>\n";

	if($result[$i]['imagePublished']==1){
		echo '<img class="bildlinks" src="';
		echo $result[$i]['imageUrl'];
		echo '"/>';
	}
	if($lang=='de' && ($result[$i]['published_de']==1)){
		echo stripslashes($result[$i]['content_de']);	
	} else{
   		echo stripslashes($result[$i]['content']);
	}
   	echo "    </p>\n";
	echo '<a href="?p=news&action=edit&id='.$result[$i]['ID'].'">edit</a>';
   	echo "</li>\n";

}

?>


<li><a href="?p=news&action=new">new</a></li>

</ul>
