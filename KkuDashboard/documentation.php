<style type="text/css">

body {

background: #eee;

}

</style>

<header>

<title>Documentation for the CMS running the MSS-website</title>

</header>

<body>

<h1>Documentation for the CMS running the MSS-website</h1>

<h2>Table of contents</h2>

<ul>

<li><p><a href="#1">How it works</a></p>

<ul>

	<li><p><a href="#1.1">Components</a></p></li>

	<li><p><a href="#1.2">How it works</a></p></li>

	<li><p><a href="#1.3">Step by step tutorials</a></p></li>

</ul>

</li>

<li><p><a href="#2">How it is used</a></p>

<ul>

	<li><p><a href="#2.1">Step by step tutorial for general use</a></p></li>

	<li><p><a href="#2.2">Step by step tutorial for lecturer</a></p></li>

</ul>

</li>

<li><p><a href="#3">Reference for the tables</a></p></li>

</ul>

<a name="1"><h2>How it works</h2></a>

<a name="1.1"><h3>Components</h3></a>

<ul><li><b>PHP-server:</b> PHP is a scriptlanguage, that generates html-code that is then sent to the user.</li>

<li><b>MySQL-Database:</b> The Database holds the dynamic content of the website. There are "tables" for every section of the site, e.g. news. These tables hold the seperate (for example news-)entries for the specific section.</li></ul>

<a name="1.2"><h3>How it works</h3></a>

<h4>In general</h4>

<p><img src="documentationimages/doc_overview.png" style="border: 2px dotted;"></p>

<p>The PHP-script generates simple html code until it comes to a spot where information is needed from the database. Then it prepares a message to the database, something like "give me every news entry sorted by date". The script sends the message to the database and gets back an associative array, that can then be used to generate html code containing the information from the database.</p>

<h4>The MSS-website</h4>

<h5>Basics</h5>

<p>The index.php file constructs the page according to the variable it is sent via GET. The GET are part of the url. They are a key-value-pairs. The first one is seperated to the rest of the url by a "?":</p>
<p><i> ...xyz.php?key1=value1</i></p>
<p>Two or more key-value-pairs can be transmitted by sperating them with "&":</p>
<p><i>...xyz.php?key1=value1&key2=value2&key3=value3</i> - The order does not matter</p>
<p>These values can then be used in the PHP-script to generate the html-code accordingly. In the index.php the following keynames are used:</p>
<p>p1 : the name of the section belonging to the first menulevel.
<br>p2 : the name of the section belonging to the second menulevel, if there is one.
<br>p3 : the name of the section belonging to the third menulevel, if there is one.
<br>lang : if the value is equal to "de" the german dictionary array is loaded, and the script outputs the site in german.</p>

<h5>Content lookup</h5>

<p>p1,p2,p3 follow a folder metaphor. If all of them are defined the index.php looks up the file <i>php/p1/p2/p3.php</i> and includes it. If p3 is not defined it looks up <i>php/p1/p2.php</i>. If none of them is defined it looks up <i>php/home.php</i>.</p>

<h5>The dictionary</h5>

<p>To make the site bilingual there is a dictionary which is loaded by the file <i>php/menuTranslation.php</i>. Every expression that should be shown differently in the english version and in the german, is saved here with it's particular translations.<p>

<h5>Breadcrumb</h5>

<p>The breadcrumb is a visualisation of "where you are" on the website. It follows the folder metaphor described earlier. if <i>p1</i> and <i>p2</i> are defined, it shows something like</p>

<p><i>'translation of p1' -> 'translation of p2'</i></p>

<p>where <i>'translation of p1'</i> is the entry for <i>p1</i> in the dictionary.</p>

<h5>Menu</h5>

<p>When the menu is generated in the script it first loads the file <i>php/mainpage/menusetup.php</i> where the structure of the menu is saved. The menu is a two level menu, so there are two arrays defined in the menusetup-file: the $menulist contains the names of the menu items of the firstlevel. the $sublist contains the (comma seperated) list of names from the menu items of the second level belonging to first level item with the same index.</p>
<p>example: 
<br><i>$menulist[1]=fubar; $sublist[1]='';</i> means the second menu item in the frist level is called "fubar" and has no belonging second level items.
<br><i>$menulist[1]=fubar; $sublist[1]='tic,tac,toe';</i> means the second menu item in the first leve is called fubar, and has 3 belongig second level items, called "tic", "tac" and "toe".</p>

<a name="1.3"><h3>Step by step tutorials</h3></a>

<h4>Adding sections not containing database information</h4>

<p>To add a section you have to do 3 things:
<br>- modify the menu setup file, to list the section in the menu.
<br>- add the english and german expressions in the dictionary.
<br>- create the file that contains content in html/php format.</p>

<p>As an example we want to add the 3 sections "tic", "tac" and "teo" to a new submenu that is called "fubar".</a>

<ol><li>

	<p>Open the file <i>php/mainpage/menusetup.php</i><p>
	<p><img src="documentationimages/doc_howto2_selecttable.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Now click on <i>add new entry</i></p>
	<p><img src="documentationimages/doc_howto3_tableview.png" style="border: 2px dotted;"></p>

</li><li>


<a name="2"><h2>How it is used</h2></a>

<p>There is a webpage for you to modify the content of the website. For every table inside the database there is a subpage where you can add, edit and delete entries.</p>

<a name="2.1"><h3>Step by step tutorial for general use</h3></a>

<p>For the following short tutorial of how to add, edit and delete entries first go to this site:<p>
<p><a href="http://www.mss.cbi.uni-erlangen.de/php/admin/admin.php">http://www.mss.cbi.uni-erlangen.de/php/admin/admin.php</a></p>

<h4>1. Adding an entry</h4>

<p>As an example we want to add a new member to the team section on the website. The members are represented by entries in the <i>team</i> table.</p>

<ol><li>

	<p>Select the table you want to modify by clicking the according link above the horizontal line<p>
	<p><img src="documentationimages/doc_howto2_selecttable.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Now click on <i>add new entry</i></p>
	<p><img src="documentationimages/doc_howto3_tableview.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Fill in information. If you don't know what is meant by the fields look it up. At the bottom of this Doumentation there is a description for every field in every table.</p>
	<p><img src="documentationimages/doc_howto4_generateentry.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Click on <i>save post</i> to save the entry. You are automatically redirected to the tableoverview page.</p>


</li></ol>

<h4>2. Upload a file</h4>

<p>Now we want to upload a file to the team-entry we just created</p>

<ol><li>

	<p>To upload an image for the new entry, find it in the overview and click on <i>edit</i></p>
	<p><img src="documentationimages/doc_howto5.png" style="border: 2px dotted;"></p>


</li><li>

	<p>Click on <i>Browse...</i> to choose a file from your computer</p>
	<p><img src="documentationimages/doc_howto6.png" style="border: 2px dotted;"></p>


</li><li>

	<p>Click on <i>Upload</i> to to upload the file</p>
	<p><img src="documentationimages/doc_howto7.png" style="border: 2px dotted;"></p>


</li></ol>

<h4>3. Deleting the entry</h4>

<p>To Finish this short tutorial we now delete the new entry</p>

<ol><li>

	<p>Select the table you want to modify by clicking the according link above the horizontal line<p>
	<p><img src="documentationimages/doc_howto2_selecttable.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Find the entry you want to delete and beneath that click <b>edit</b></p>
	<p><img src="documentationimages/doc_howto5.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Click on <b>Delte this entry</b> at the bottom of the page</p>
	<p><img src="documentationimages/doc_howto8.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Click on <b>Confirm delete</b> to delete the entry</p>
	<p><img src="documentationimages/doc_howto9.png" style="border: 2px dotted;"></p>

</li></ol>

<a name="2.2"><h3>Step by step tutorial for lecturer</h3></a>

<p>The following tutorial will show you how to create a new lecture, add a section and upload files. First go to this site:<p>
<p><a href="http://www.mss.cbi.uni-erlangen.de/php/admin/admin.php">http://www.mss.cbi.uni-erlangen.de/php/admin/admin.php</a></p>

<h4>1. Adding a new lecture</h4>

<ol><li>

	<p>Select the <i>lectures</i> table by clicking the according link above the horizontal line<p>
	<p><img src="documentationimages/doc_lec1.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Now click on <i>add new entry</i></p>
	<p><img src="documentationimages/doc_lec2.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Fill in information. If you don't know what is meant by the fields look it up. At the bottom of this Doumentation there is a description for every field in every table.</p>
	<p><img src="documentationimages/doc_lec3.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Click on <i>save post</i> to save the entry. You are automatically redirected to the tableoverview page.</p>

</li></ol>

<h4>2. Adding a Lesson/Secion</h4>

<ol><li>

	<p>From tableoverview of lectures find the one you want to modify and click on <i>edit</i><p>
	<p><img src="documentationimages/doc_lec4.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Beneath the main section there is a lecturesfeed section. </p>
	<p><img src="documentationimages/doc_lec5.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Fill in information. If you don't know what is meant by the fields look it up. At the bottom of this Doumentation there is a description for every field in every table.</p>
	<p><img src="documentationimages/doc_lec6.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Click on <i>save post</i> to save the entry. You are automatically redirected to the tableoverview page.</p>

</li></ol>

<h4>3. Uploading a File</h4>

<ol><li>

	<p>From tableoverview of lectures find the one you want to modify and click on <i>edit</i><p>
	<p><img src="documentationimages/doc_lec7.png" style="border: 2px dotted;"></p>

</li><li>

	<p>Beneath the main section there is a files section. Click <i>Browse...</i> to select a file from your Filesystem. Then click upload to <i>Upload</i> the file.</p>
	<p><img src="documentationimages/doc_lec8.png" style="border: 2px dotted;"></p>

</li></ol>

<a name="3"><h2>Reference for the tables</h2></a>

<h3>news</h3>

<p>The news table holds the news-entries for the news section on the website. it contains of the following values:</p>

<ul><li>published: If not checked the entry is not shown on the website</li>

<li>published_de: If checked and the section it viewed in german, title_de and content_de is shown instead of title and content.</li>

<li>_imageUrl: holds the url of the image that is shown on the website besides the news entry.</li>

<li>imagePublished: If checked the image specified by the image Url is shown on the website.</li>

<li>title: The title of the news entry shown on the website.</li>

<li>content: The news entry itsself.</li>

<li>title_de</li> The title of the news entry in german.</li>

<li>content_de</li> The news entry ittsself in german.</li></ul>

<h3>team</h3>

<p>the team table holds the information about the team members. Every member is represented by an entry.</p>

<ul><li>published: If not checked the entry is not shown on the website</li>

<li>published_de: If checked and the section it viewed in german, position_de is shown instead of postition.</li>

<li>_imageUrl: holds the url of the image that is shown on the website besides the news entry.</li>

<li>imagePublished: If checked the image specified by the image Url is shown on the website.</li>

<li>fullName: The full name of the team member, e.g. Dr. Max Mustermann.</li>

<li>tele: The telephone number under which the member is reachable during worktime. (not shown on the website if empty)</li>

<li>email: email adress. (not shown on the website if empty)</li>

<li>website: a private website. (not shown on the website if empty)</li>

<li>importance: on the website the members are displayed sorted by importance</li>

<li>postition: The postition of the member inside the team.</li>

<li>postition_de: The postition of the member inside the team in german</li></ul>

<h4>jobs</h4>

<p>The job table holds joboffers as entries</p>

<ul><li>published: If not checked the entry is not shown on the website</li>

<li>dateExpires: the date the joboffer expires</li>

<li>description: Short jobdescription.</li>

<li>description_de: Short job description in german.</li>

<li>url: The url to the full Job description. If you put http://www.mss.cbi.uni-erlangen.de/?p1=announcements&p2=jobiframe&jif=<b>XYZ</b> in, where XYZ is a location of a html file inside the "anzeigen" directory on the webspace' home directory, it will be shown in an iframe inside the website.</li></ul>

<h3>publications</h3>

<p>the publications table holds publications as entries. If you create a new entry you first select the type of the publication by clicking one of the links, that say "Article", "Book" etc.. Then all the fields that don't exist for this type are hidden.</p>

<ul><li>refname: an identification name.</li>

<li>author: </li>

<li>title: </li>

<li>journal: The journal in which it was published</li>

<li>year:</li>

<li>volume:</li>

<li>pages:</li>

<li>author:</li>

<li>editor:</li>

<li>published: date published</li>

<li>series:</li>

<li>address:</li>

<li>booktitle:</li>

<li>editor:</li>

<li>school:</li>

<li>organization:</li>

<li>institution:</li>

<li>howpublished:</li>

<li>abstract:</li>

<li>pdf: location of the pdf file inside the pdf directory on the webspace.</li>

<li>condmat: url of the publication on condmat.</li>

<li>number: </li><ul>




</body>
