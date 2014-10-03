<ul>

<li><a href="?tablename=publications&action=new">new</a></li>

<?php		   	 
  
$sql = 'SELECT
			dateEntered,
			refname,
			type,
			author,
			title,
			journal,
			year,
			volume,
			pages,
			ALTauthor,
			ALTeditor,
			publisher,
			series,
			address,
			booktitle,
			editor,
			school,
			organization,
			institution,
			howpublished,
			number,
			abstract,
			pdf,
			ID,
			condmat
		FROM
			publications
		ORDER BY
			year DESC';
	    
mysql_select_db($db, $link);
$resulttemp = mysql_query($sql,$link);

if (!$resulttemp) {
    echo 'die!';
}

for ($i = 0; $i < mysql_num_rows($resulttemp); $i++) {
$result[$i]=mysql_fetch_array($resulttemp);
}

for($i = 0; $i < count($result); $i++) {
	
	if($result[$i]['type']=='Article') {  

    	echo '<li><div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">'."\n";
		echo '<h2>Article</h2>'."\n".'<p><ul style="list-style-type:none;">';
		if($result[$i]['refname']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">refname:</div><div style="margin-left:100px;"> '.$result[$i]['refname'].'</div></li>'."\n";}
		if($result[$i]['author']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">author:</div><div style="margin-left:100px;"> '.$result[$i]['author'].'</div></li>'."\n";}
    	if($result[$i]['title']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">title:</div><div style="margin-left:100px;"> '.$result[$i]['title'].'</div></li>'."\n";}
    	if($result[$i]['journal']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">journal:</div><div style="margin-left:100px;"> '.$result[$i]['journal'].'</div></li>'."\n";}
    	if($result[$i]['year']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">year:</div><div style="margin-left:100px;"> '.$result[$i]['year'].'</div></li>'."\n";}
    	if($result[$i]['volume']!=''){ echo '<li><div style="min-width:100px; float:left;">volume:</div><div style="margin-left:100px;"> '.$result[$i]['volume'].'</div></li>'."\n";}
    	if($result[$i]['pages']!=''){ echo '<li><div style="min-width:100px; float:left;">pages:</div><div style="margin-left:100px;"> '.$result[$i]['pages'].'</div></li>'."\n";}
		echo "</ul>\n";
    	if($result[$i]['abstract']!=''){ echo '<h4 style="margin-left:30px;">abstract:</h4> <div style="margin-left:30px; text-align:justify;">'.$result[$i]['abstract'].'</div>'."\n";}
    	//echo '<p><a href="javascript:openWindow(\'php/bibtex.php?id='.$result[$i]['ID'].'\');">bibtex</a></p>';
		if($result[$i]['pdf']!=''){ echo '<p>pdf: '.$result[$i]['pdf'].'</p>'; }
		if($result[$i]['condmat']!=''){ echo '<p>condmat: '.$result[$i]['condmat'].'</p>'; }
		echo "    </p>\n";
		echo '<a href="?tablename=publications&action=edit&id='.$result[$i]['ID'].'">edit</a>';
		echo '</div></li>';

	}



	if($result[$i]['type']=='Book') {  

    	echo '<li><div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">'."\n";
		echo '<h2>Book</h2>'."\n".'<p>';
		if($result[$i]['imageUrl']!=''){ 
		if($result[$i]['coverUrl']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<a href="'.$result[$i]['coverUrl'].'">'; }
		echo '<img style="width:115px; float:left; margin-bottom:30px;" src='.$result[$i]['imageUrl'].'>';
		if($result[$i]['coverUrl']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '</a>'; }
		}
		echo '<ul style="list-style-type:none;">';
		if($result[$i]['refname']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">refname:</div><div style="margin-left:100px;"> '.$result[$i]['refname'].'</div></li>'."\n";}
		if($result[$i]['ALTauthor']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">ALTauthor:</div><div style="margin-left:100px;"> '.$result[$i]['ALTauthor'].'</div></li>'."\n";}
    	if($result[$i]['ALTeditor']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">ALTeditor:</div><div style="margin-left:100px;"> '.$result[$i]['ALTeditor'].'</div></li>'."\n";}
    	if($result[$i]['title']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">title:</div><div style="margin-left:100px;"> '.$result[$i]['title'].'</div></li>'."\n";}
    	if($result[$i]['publisher']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">publisher:</div><div style="margin-left:100px;"> '.$result[$i]['publisher'].'</div></li>'."\n";}
    	if($result[$i]['year']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">year:</div><div style="margin-left:100px;"> '.$result[$i]['year'].'</div></li>'."\n";}
    	if($result[$i]['volume']!=''){ echo '<li><div style="min-width:100px; float:left;">volume:</div><div style="margin-left:100px;"> '.$result[$i]['volume'].'</div></li>'."\n";}
    	if($result[$i]['series']!=''){ echo '<li><div style="min-width:100px; float:left;">'.$ln['series'].':</div><div style="margin-left:100px;"> '.$result[$i]['series'].'</div></li>'."\n";}
    	if($result[$i]['address']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">address:</div><div style="margin-left:100px;"> '.$result[$i]['address'].'</div></li>'."\n";}
		echo "</ul>\n";
    	if($result[$i]['abstract']!=''){ echo '<h4 style="margin-left:30px;">abstract:</h4> <div style="margin-left:30px; text-align:justify;">'.$result[$i]['abstract'].'</div>'."\n";}
    	//echo '<p><a href="javascript:openWindow(\'php/bibtex.php?id='.$result[$i]['ID'].'\');">bibtex</a></p>';
		if($result[$i]['pdf']!=''){ echo '<p>pdf: '.$result[$i]['pdf'].'</p>'; }
		if($result[$i]['condmat']!=''){ echo '<p>condmat: '.$result[$i]['condmat'].'</p>'; }
		echo "    </p>\n";
		echo '<a href="?tablename=publications&action=edit&id='.$result[$i]['ID'].'">edit</a>';
		echo '</div></li>';

	}


	if($result[$i]['type']=='InCollection') {  

    	echo '<li><div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">'."\n";
		echo '<h2>InCollection</h2>'."\n".'<p><ul style="list-style-type:none;">';
		if($result[$i]['refname']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">refname:</div><div style="margin-left:100px;"> '.$result[$i]['refname'].'</div></li>'."\n";}
		if($result[$i]['author']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">author:</div><div style="margin-left:100px;"> '.$result[$i]['author'].'</div></li>'."\n";}
    	if($result[$i]['title']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">title:</div><div style="margin-left:100px;"> '.$result[$i]['title'].'</div></li>'."\n";}
    	if($result[$i]['booktitle']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">address:</div><div style="margin-left:100px;"> '.$result[$i]['booktitle'].'</div></li>'."\n";}
    	if($result[$i]['pages']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">pages:</div><div style="margin-left:100px;"> '.$result[$i]['pages'].'</div></li>'."\n";}
    	if($result[$i]['publisher']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">publisher:</div><div style="margin-left:100px;"> '.$result[$i]['publisher'].'</div></li>'."\n";}
    	if($result[$i]['year']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">year:</div><div style="margin-left:100px;"> '.$result[$i]['year'].'</div></li>'."\n";}
    	if($result[$i]['editor']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">editor:</div><div style="margin-left:100px;"> '.$result[$i]['editor'].'</div></li>'."\n";}
    	if($result[$i]['volume']!=''){ echo '<li><div style="min-width:100px; float:left;">volume:</div><div style="margin-left:100px;"> '.$result[$i]['volume'].'</div></li>'."\n";}
    	if($result[$i]['series']!=''){ echo '<li><div style="min-width:100px; float:left;">'.$ln['series'].':</div><div style="margin-left:100px;"> '.$result[$i]['series'].'</div></li>'."\n";}
    	if($result[$i]['address']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">address:</div><div style="margin-left:100px;"> '.$result[$i]['address'].'</div></li>'."\n";}
		echo "</ul>\n";
    	if($result[$i]['abstract']!=''){ echo '<h4 style="margin-left:30px;">abstract:</h4> <div style="margin-left:30px; text-align:justify;">'.$result[$i]['abstract'].'</div>'."\n";}
    	//echo '<p><a href="javascript:openWindow(\'php/bibtex.php?id='.$result[$i]['ID'].'\');">bibtex</a></p>';
		if($result[$i]['pdf']!=''){ echo '<p>pdf: '.$result[$i]['pdf'].'</p>'; }
		if($result[$i]['condmat']!=''){ echo '<p>condmat: '.$result[$i]['condmat'].'</p>'; }
		echo "    </p>\n";
		echo '<a href="?tablename=publications&action=edit&id='.$result[$i]['ID'].'">edit</a>';
		echo '</div></li>';
	   	

	}


	if($result[$i]['type']=='PhdThesis') {  

    	echo '<li><div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">'."\n";
		echo '<h2>PhdThesis</h2>'."\n".'<p><ul style="list-style-type:none;">';
		if($result[$i]['refname']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">refname:</div><div style="margin-left:100px;"> '.$result[$i]['refname'].'</div></li>'."\n";}
		if($result[$i]['author']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">author:</div><div style="margin-left:100px;"> '.$result[$i]['author'].'</div></li>'."\n";}
    	if($result[$i]['title']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">title:</div><div style="margin-left:100px;"> '.$result[$i]['title'].'</div></li>'."\n";}
    	if($result[$i]['school']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">school:</div><div style="margin-left:100px;"> '.$result[$i]['school'].'</div></li>'."\n";}
    	if($result[$i]['year']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">year:</div><div style="margin-left:100px;"> '.$result[$i]['year'].'</div></li>'."\n";}
    	if($result[$i]['address']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">address:</div><div style="margin-left:100px;"> '.$result[$i]['address'].'</p>'."\n";}
		echo "</ul>\n";
    	if($result[$i]['abstract']!=''){ echo '<h4 style="margin-left:30px;">abstract:</h4> <div style="margin-left:30px; text-align:justify;">'.$result[$i]['abstract'].'</div>'."\n";}
    	//echo '<p><a href="javascript:openWindow(\'php/bibtex.php?id='.$result[$i]['ID'].'\');">bibtex</a></p>';
		if($result[$i]['pdf']!=''){ echo '<p>pdf: '.$result[$i]['pdf'].'</p>'; }
		if($result[$i]['condmat']!=''){ echo '<p>condmat: '.$result[$i]['condmat'].'</p>'; }
		echo "    </p>\n";
		echo '<a href="?tablename=publications&action=edit&id='.$result[$i]['ID'].'">edit</a>';
		echo '</div></li>';

	}


	if($result[$i]['type']=='InProceedings') {  

    	echo '<li><div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">'."\n";
		echo '<h2>InProceedings</h2>'."\n".'<p><ul style="list-style-type:none;">';
		if($result[$i]['refname']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">refname:</div><div style="margin-left:100px;"> '.$result[$i]['refname'].'</div></li>'."\n";}
		if($result[$i]['author']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">author:</div><div style="margin-left:100px;"> '.$result[$i]['author'].'</div></li>'."\n";}
    	if($result[$i]['title']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">title:</div><div style="margin-left:100px;"> '.$result[$i]['title'].'</div></li>'."\n";}
    	if($result[$i]['booktitle']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">booktitle:</div><div style="margin-left:100px;"> '.$result[$i]['booktitle'].'</div></li>'."\n";}
    	if($result[$i]['year']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">year:</div><div style="margin-left:100px;"> '.$result[$i]['year'].'</div></li>'."\n";}
    	if($result[$i]['pages']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">pages:</div><div style="margin-left:100px;"> '.$result[$i]['pages'].'</div></li>'."\n";}
    	if($result[$i]['editor']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">editor:</div><div style="margin-left:100px;"> '.$result[$i]['editor'].'</div></li>'."\n";}
    	if($result[$i]['volume']!=''){ echo '<li><div style="min-width:100px; float:left;">volume:</div><div style="margin-left:100px;"> '.$result[$i]['volume'].'</div></li>'."\n";}
    	if($result[$i]['series']!=''){ echo '<li><div style="min-width:100px; float:left;">'.$ln['series'].':</div><div style="margin-left:100px;"> '.$result[$i]['series'].'</div></li>'."\n";}
    	if($result[$i]['address']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">address:</div><div style="margin-left:100px;"> '.$result[$i]['address'].'</div></li>'."\n";}
    	if($result[$i]['organization']!=''){ echo '<li><div style="min-width:100px; float:left;">'.$ln['organization'].':</div><div style="margin-left:100px;"> '.$result[$i]['organization'].'</div></li>'."\n";}
    	if($result[$i]['publisher']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">publisher:</div><div style="margin-left:100px;"> '.$result[$i]['publisher'].'</p>'."\n";}
		echo "</ul>\n";
    	if($result[$i]['abstract']!=''){ echo '<h4 style="margin-left:30px;">abstract:</h4> <div style="margin-left:30px; text-align:justify;">'.$result[$i]['abstract'].'</div>'."\n";}
    	//echo '<p><a href="javascript:openWindow(\'php/bibtex.php?id='.$result[$i]['ID'].'\');">bibtex</a></p>';
		if($result[$i]['pdf']!=''){ echo '<p>pdf: '.$result[$i]['pdf'].'</p>'; }
		if($result[$i]['condmat']!=''){ echo '<p>condmat: '.$result[$i]['condmat'].'</p>'; }
		echo "    </p>\n";
		echo '<a href="?tablename=publications&action=edit&id='.$result[$i]['ID'].'">edit</a>';
		echo '</div></li>';

	}


	if($result[$i]['type']=='MasterThesis') {  

    	echo '<li><div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">'."\n";
		echo '<h2>MasterThesis</h2>'."\n".'<p><ul style="list-style-type:none;">';
		if($result[$i]['refname']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">refname:</div><div style="margin-left:100px;"> '.$result[$i]['refname'].'</div></li>'."\n";}
		if($result[$i]['author']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">author:</div><div style="margin-left:100px;"> '.$result[$i]['author'].'</div></li>'."\n";}
    	if($result[$i]['title']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">title:</div><div style="margin-left:100px;"> '.$result[$i]['title'].'</div></li>'."\n";}
    	if($result[$i]['school']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">school:</div><div style="margin-left:100px;"> '.$result[$i]['school'].'</div></li>'."\n";}
    	if($result[$i]['year']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">year:</div><div style="margin-left:100px;"> '.$result[$i]['year'].'</div></li>'."\n";}
    	if($result[$i]['address']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">address:</div><div style="margin-left:100px;"> '.$result[$i]['address'].'</p>'."\n";}
		echo "</ul>\n";
    	if($result[$i]['abstract']!=''){ echo '<h4 style="margin-left:30px;">abstract:</h4> <div style="margin-left:30px; text-align:justify;">'.$result[$i]['abstract'].'</div>'."\n";}
    	//echo '<p><a href="javascript:openWindow(\'php/bibtex.php?id='.$result[$i]['ID'].'\');">bibtex</a></p>';
		if($result[$i]['pdf']!=''){ echo '<p>pdf: '.$result[$i]['pdf'].'</p>'; }
		if($result[$i]['condmat']!=''){ echo '<p>condmat: '.$result[$i]['condmat'].'</p>'; }
		echo "    </p>\n";
		echo '<a href="?tablename=publications&action=edit&id='.$result[$i]['ID'].'">edit</a>';
		echo '</div></li>';

	}



	if($result[$i]['type']=='TechReport') {  

    	echo '<li><div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">'."\n";
		echo '<h2>TechReport</h2>'."\n".'<p><ul style="list-style-type:none;">';
		if($result[$i]['refname']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">refname:</div><div style="margin-left:100px;"> '.$result[$i]['refname'].'</div></li>'."\n";}
		if($result[$i]['author']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">author:</div><div style="margin-left:100px;"> '.$result[$i]['author'].'</div></li>'."\n";}
    	if($result[$i]['title']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">title:</div><div style="margin-left:100px;"> '.$result[$i]['title'].'</div></li>'."\n";}
    	if($result[$i]['institution']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">institution:</div><div style="margin-left:100px;"> '.$result[$i]['institution'].'</div></li>'."\n";}
    	if($result[$i]['year']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">year:</div><div style="margin-left:100px;"> '.$result[$i]['year'].'</div></li>'."\n";}
    	if($result[$i]['number']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">number:</div><div style="margin-left:100px;"> '.$result[$i]['number'].'</div></li>'."\n";}
    	if($result[$i]['address']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">address:</div><div style="margin-left:100px;"> '.$result[$i]['address'].''."\n";}
		echo "</ul>\n";
    	if($result[$i]['abstract']!=''){ echo '<h4 style="margin-left:30px;">abstract:</h4> <div style="margin-left:30px; text-align:justify;">'.$result[$i]['abstract'].'</div>'."\n";}
    	//echo '<p><a href="javascript:openWindow(\'php/bibtex.php?id='.$result[$i]['ID'].'\');">bibtex</a></p>';
		if($result[$i]['pdf']!=''){ echo '<p>pdf: '.$result[$i]['pdf'].'</p>'; }
		if($result[$i]['condmat']!=''){ echo '<p>condmat: '.$result[$i]['condmat'].'</p>'; }
		echo "    </p>\n";
		echo '<a href="?tablename=publications&action=edit&id='.$result[$i]['ID'].'">edit</a>';
		echo '</div></li>';

	}




	if($result[$i]['type']=='Misc') {  

    	echo '<li><div style="border: 1px dashed; padding: 15px; margin-bottom: 20px;">'."\n";
		echo '<h2>Misc</h2>'."\n".'<p><ul style="list-style-type:none;">';
		if($result[$i]['refname']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">refname:</div><div style="margin-left:100px;"> '.$result[$i]['refname'].'</div></li>'."\n";}
		if($result[$i]['author']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">author:</div><div style="margin-left:100px;"> '.$result[$i]['author'].'</div></li>'."\n";}
    	if($result[$i]['title']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">title:</div><div style="margin-left:100px;"> '.$result[$i]['title'].'</div></li>'."\n";}
    	if($result[$i]['howpublished']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">howpublished:</div><div style="margin-left:100px;"> '.$result[$i]['howpublished'].'</div></li>'."\n";}
    	if($result[$i]['year']==''){ echo '<li><font color="red">missing value!</font></li>'; } else{ echo '<li><div style="min-width:100px; float:left;">year:</div><div style="margin-left:100px;"> '.$result[$i]['year'].'</p>'."\n";}
		echo "</ul>\n";
    	if($result[$i]['abstract']!=''){ echo '<h4 style="margin-left:30px;">abstract:</h4> <div style="margin-left:30px; text-align:justify;">'.$result[$i]['abstract'].'</div>'."\n";}
    	//echo '<p><a href="javascript:openWindow(\'php/bibtex.php?id='.$result[$i]['ID'].'\');">bibtex</a></p>';
		if($result[$i]['pdf']!=''){ echo '<p>pdf: '.$result[$i]['pdf'].'</p>'; }
		if($result[$i]['condmat']!=''){ echo '<p>condmat: '.$result[$i]['condmat'].'</p>'; }
		echo "    </p>\n";
		echo '<a href="?tablename=publications&action=edit&id='.$result[$i]['ID'].'">edit</a>';
		echo '</div></li>';

	}



}

?>

<li><a href="?tablename=publications&action=new">new</a></li>

</ul>
