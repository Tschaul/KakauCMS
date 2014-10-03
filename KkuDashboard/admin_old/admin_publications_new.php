<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

//tinyMCE.init({
//mode : "textareas",
//theme : "advanced"
//});
 
//function toggleEditor(id) {
//	if (!tinyMCE.get(id))
//		tinyMCE.execCommand('mceAddControl', false, id);
//	else
//		tinyMCE.execCommand('mceRemoveControl', false, id);
//}

function insertHTML(html) {
    tinyMCE.execInstanceCommand("mce_editor_0","mceInsertContent",false,html);
}

</script>


<!--

<a href="javascript:toggleEditor('Inhalt');">Add/Remove editor</a>
<a href="javascript:tinyMCE.execCommand('mceInsertContent', false, '<img src=http://www.famberg.de/bilder/test.gif>');">Add something</a>

-->

<?php

	echo '<p><a id="Article" href="javascript:getFormArticle();">Article</a> ';
	echo '<a id="Book" href="javascript:getFormBook();">Book</a> ';
	echo '<a id="InCollection" href="javascript:getFormInCollection();">InCollection</a> ';
	echo '<a id="PhdThesis" href="javascript:getFormPhdThesis();">PhdThesis</a> ';
	echo '<a id="InProceedings" href="javascript:getFormInProceedings();">InProceedings</a> ';
	echo '<a id="MasterThesis" href="javascript:getFormMasterThesis();">MasterThesis</a> ';
	echo '<a id="TechReport" href="javascript:getFormTechReport();">TechReport</a> ';
	echo '<a id="Misc" href="javascript:getFormMisc();">Misc</a>';
	echo ' - <a id="clear" href="javascript:clearForm();">clear</a></p>';
	
    	echo '<form action="adminQuery.php" method="post" name="savepost" id="savepost">
    		<input type="hidden" name="tablename" value="publications">
    		<input type="hidden" name="action" value="new">
    		<input type="hidden" name="submit" value="1">
			<input id="type" type="hidden" name="type" value="">';

	echo '<p>';
	echo '<p style="padding:0px; width:400px; text-align:right;" id="refname">refname: <input id="inputRefname" type="text" name="refname" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="author">author: <input id="inputAuthor" type="text" name="author" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="title">title: <input id="inputTitle" type="text" name="title" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="journal">journal: <input id="inputJournal" type="text" name="journal" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="year">year: <input id="inputYear" type="text" name="year" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="volume">volume: <input id="inputVolume" type="text" name="volume" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="pages">pages: <input id="inputPages" type="text" name="pages" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="ALTauthor">author: <input id="inputALTauthor" type="text" name="ALTauthor" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="ALTeditor">editor: <input id="inputALTeditor" type="text" name="ALTeditor" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="publisher">published: <input id="inputPublisher" type="text" name="publisher" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="series">series: <input id="inputSeries" type="text" name="series" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="address">address: <input id="inputAddress" type="text" name="address" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="booktitle">booktitle: <input id="inputBooktitle" type="text" name="booktitle" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="editor">editor: <input id="inputEditor" type="text" name="editor" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="school">school: <input id="inputSchool" type="text" name="school" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="organization">organization: <input id="inputOrganization" type="text" name="organization" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="institution">institution: <input id="inputInstitution" type="text" name="institution" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="howpublished">howpublished: <input id="inputHowpublished" type="text" name="howpublished" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="abstract">abstract: <input id="inputAbstract" type="text" name="abstract" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="pdf">pdf: <input id="inputPdf" type="text" name="pdf" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="condmat">condmat: <input id="inputCondmat" type="text" name="condmat" value=""></p>'."\n";
	echo '<p style="padding:0px; width:400px; text-align:right;" id="number">number: <input id="inputNumber" type="text" name="number" value=""></p>'."\n";
	echo '</p>';

    	echo '<p><input type="submit"></p>';
    	echo "</form>";
    

		
?>

<div id="loading">
<p>L&auml;dt gerade...</p>
</div>
<div id="targetDiv"></div>

<script>
$('form').bind('form-pre-serialize', function(e) {
    tinyMCE.triggerSave();
});

function clearForm() {

$("#inputRefname").attr("value","");
$("#inputAuthor").attr("value","");
$("#inputTitle").attr("value","");
$("#inputJournal").attr("value","");
$("#inputYear").attr("value","");
$("#inputVolume").attr("value","");
$("#inputPages").attr("value","");
$("#inputALTauthor").attr("value","");
$("#inputALTeditor").attr("value","");
$("#inputPublisher").attr("value","");
$("#inputSeries").attr("value","");
$("#inputAddress").attr("value","");
$("#inputBooktitle").attr("value","");
$("#inputOrganization").attr("value","");
$("#inputInstitution").attr("value","");
$("#inputHowpublished").attr("value","");
$("#inputAbstract").attr("value","");
$("#inputPdf").attr("value","");
$("#inputCondmat").attr("value","");
$("#inputNumber").attr("value","");

}



function getFormArticle() {
	
	$("#type").attr("value","Article");

	$("#Article").css("font-weight","bold");
	$("#Book").css("font-weight","normal");
	$("#InCollection").css("font-weight","normal");
	$("#PhdThesis").css("font-weight","normal");
	$("#InProceedings").css("font-weight","normal");
	$("#MasterThesis").css("font-weight","normal");
	$("#TechReport").css("font-weight","normal");
	$("#Misc").css("font-weight","normal");

	$("#author").show();
	$("#title").show();
	$("#journal").show();
	$("#year").show();
	$("#volume").show();
	$("#pages").show();
	$("#ALTauthor").hide();
	$("#ALTeditor").hide();
	$("#publisher").hide();
	$("#series").hide();
	$("#address").hide();
	$("#booktitle").hide();
	$("#editor").hide();
	$("#school").hide();
	$("#organization").hide();
	$("#institution").hide();
	$("#howpublished").hide();
	$("#abstract").show();
	$("#pdf").show();
	$("#condmat").show();
	$("#number").hide();

}

function getFormBook() {
	
	$("#type").attr("value","Book");

	$("#Article").css("font-weight","normal");
	$("#Book").css("font-weight","bold");
	$("#InCollection").css("font-weight","normal");
	$("#PhdThesis").css("font-weight","normal");
	$("#InProceedings").css("font-weight","normal");
	$("#MasterThesis").css("font-weight","normal");
	$("#TechReport").css("font-weight","normal");
	$("#Misc").css("font-weight","normal");

	$("#author").hide();
	$("#title").show();
	$("#journal").hide();
	$("#year").show();
	$("#volume").show();
	$("#pages").hide();
	$("#ALTauthor").show();
	$("#ALTeditor").show();
	$("#publisher").show();
	$("#series").show();
	$("#address").show();
	$("#booktitle").hide();
	$("#editor").hide();
	$("#school").hide();
	$("#organization").hide();
	$("#institution").hide();
	$("#howpublished").hide();
	$("#abstract").show();
	$("#pdf").show();
	$("#condmat").show();
	$("#number").hide();

}

function getFormInCollection() {
	
	$("#type").attr("value","InCollection");

	$("#Article").css("font-weight","normal");
	$("#Book").css("font-weight","normal");
	$("#InCollection").css("font-weight","bold");
	$("#PhdThesis").css("font-weight","normal");
	$("#InProceedings").css("font-weight","normal");
	$("#MasterThesis").css("font-weight","normal");
	$("#TechReport").css("font-weight","normal");
	$("#Misc").css("font-weight","normal");

	$("#author").show();
	$("#title").show();
	$("#journal").hide();
	$("#year").show();
	$("#volume").show();
	$("#pages").show();
	$("#ALTauthor").hide();
	$("#ALTeditor").hide();
	$("#publisher").show();
	$("#series").show();
	$("#address").show();
	$("#booktitle").show();
	$("#editor").show();
	$("#school").hide();
	$("#organization").hide();
	$("#institution").hide();
	$("#howpublished").hide();
	$("#abstract").show();
	$("#pdf").show();
	$("#condmat").show();
	$("#number").hide();

}

function getFormPhdThesis() {
	
	$("#type").attr("value","PhdThesis");

	$("#Article").css("font-weight","normal");
	$("#Book").css("font-weight","normal");
	$("#InCollection").css("font-weight","normal");
	$("#PhdThesis").css("font-weight","bold");
	$("#InProceedings").css("font-weight","normal");
	$("#MasterThesis").css("font-weight","normal");
	$("#TechReport").css("font-weight","normal");
	$("#Misc").css("font-weight","normal");

	$("#author").show();
	$("#title").show();
	$("#journal").hide();
	$("#year").show();
	$("#volume").hide();
	$("#pages").hide();
	$("#ALTauthor").hide();
	$("#ALTeditor").hide();
	$("#publisher").hide();
	$("#series").hide();
	$("#address").show();
	$("#booktitle").hide();
	$("#editor").hide();
	$("#school").show();
	$("#organization").hide();
	$("#institution").hide();
	$("#howpublished").hide();
	$("#abstract").show();
	$("#pdf").show();
	$("#condmat").show();
	$("#number").hide();

}

function getFormInProceedings() {
	
	$("#type").attr("value","InProceedings");

	$("#Article").css("font-weight","normal");
	$("#Book").css("font-weight","normal");
	$("#InCollection").css("font-weight","normal");
	$("#PhdThesis").css("font-weight","normal");
	$("#InProceedings").css("font-weight","bold");
	$("#MasterThesis").css("font-weight","normal");
	$("#TechReport").css("font-weight","normal");
	$("#Misc").css("font-weight","normal");

	$("#author").show();
	$("#title").show();
	$("#journal").hide();
	$("#year").show();
	$("#volume").show();
	$("#pages").show();
	$("#ALTauthor").hide();
	$("#ALTeditor").hide();
	$("#publisher").show();
	$("#series").show();
	$("#address").show();
	$("#booktitle").show();
	$("#editor").show();
	$("#school").hide();
	$("#organization").show();
	$("#institution").hide();
	$("#howpublished").hide();
	$("#abstract").show();
	$("#pdf").show();
	$("#condmat").show();
	$("#number").hide();

}

function getFormMasterThesis() {
	
	$("#type").attr("value","MasterThesis");

	$("#Article").css("font-weight","normal");
	$("#Book").css("font-weight","normal");
	$("#InCollection").css("font-weight","normal");
	$("#PhdThesis").css("font-weight","normal");
	$("#InProceedings").css("font-weight","normal");
	$("#MasterThesis").css("font-weight","bold");
	$("#TechReport").css("font-weight","normal");
	$("#Misc").css("font-weight","normal");

	$("#author").show();
	$("#title").show();
	$("#journal").hide();
	$("#year").show();
	$("#volume").hide();
	$("#pages").hide();
	$("#ALTauthor").hide();
	$("#ALTeditor").hide();
	$("#publisher").hide();
	$("#series").hide();
	$("#address").show();
	$("#booktitle").hide();
	$("#editor").hide();
	$("#school").show();
	$("#organization").hide();
	$("#institution").hide();
	$("#howpublished").hide();
	$("#abstract").show();
	$("#pdf").show();
	$("#condmat").show();
	$("#number").hide();

}


function getFormTechReport() {
	
	$("#type").attr("value","TechReport");

	$("#Article").css("font-weight","normal");
	$("#Book").css("font-weight","normal");
	$("#InCollection").css("font-weight","normal");
	$("#PhdThesis").css("font-weight","normal");
	$("#InProceedings").css("font-weight","normal");
	$("#MasterThesis").css("font-weight","normal");
	$("#TechReport").css("font-weight","bold");
	$("#Misc").css("font-weight","normal");

	$("#author").show();
	$("#title").show();
	$("#journal").hide();
	$("#year").show();
	$("#volume").hide();
	$("#pages").hide();
	$("#ALTauthor").hide();
	$("#ALTeditor").hide();
	$("#publisher").hide();
	$("#series").hide();
	$("#address").show();
	$("#booktitle").hide();
	$("#editor").hide();
	$("#school").hide();
	$("#organization").hide();
	$("#institution").show();
	$("#howpublished").hide();
	$("#abstract").show();
	$("#pdf").show();
	$("#condmat").show();
	$("#number").show();

}



function getFormMisc() {
	
	$("#type").attr("value","Misc");

	$("#Article").css("font-weight","normal");
	$("#Book").css("font-weight","normal");
	$("#InCollection").css("font-weight","normal");
	$("#PhdThesis").css("font-weight","normal");
	$("#InProceedings").css("font-weight","normal");
	$("#MasterThesis").css("font-weight","normal");
	$("#TechReport").css("font-weight","normal");
	$("#Misc").css("font-weight","bold");

	$("#author").show();
	$("#title").show();
	$("#journal").hide();
	$("#year").show();
	$("#volume").hide();
	$("#pages").hide();
	$("#ALTauthor").hide();
	$("#ALTeditor").hide();
	$("#publisher").hide();
	$("#series").hide();
	$("#address").hide();
	$("#booktitle").hide();
	$("#editor").hide();
	$("#school").hide();
	$("#organization").hide();
	$("#institution").hide();
	$("#howpublished").show();
	$("#abstract").show();
	$("#pdf").show();
	$("#condmat").show();
	$("#number").hide();

}


// prepare the form when the DOM is ready 
$(document).ready(function() { 
    var options = { 
        target:        '#targetDiv',   // target element to update 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override form form's 'method' attribute 
        //dateType:  null        // 'xml', 'script', or 'json' (see form.js for docs) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful subit 
    }; 
 
    // bind form using 'ajaxForm' 
    $('#savepost').ajaxForm(options);
    
    $("#loading p").hide();
}); 
 
// pre-submit callback 
function showRequest(formData, jqForm) {
	
	//tinyMCE.triggerSave(); 
	//tinyMCE.execCommand('mceRemoveControl', false, 'Inhalt');
	
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 var extra = [ { name: 'ajax', value: '1' }];
 $.merge( formData, extra)
   /*  alert('About to submit: \n\n' + $.param(formData));*/
 
    // here we could return false to prevent the form from being submitted 
    return true;  
} 
 
// post-submit callback 
function showResponse(responseText, statusText)  { 
   	/* alert('status: ' + statusText + '\n\nresponseText: \n' + 
        responseText + '\n\nThe output div should have already been updated with the responseText.'); */
	//tinyMCE.execCommand('mceAddControl', false, 'Inhalt');
} 

 $("#loading p").ajaxStart(function(){
   $(this).show();
 }).ajaxStop(function(){
   $(this).hide();
	document.location.href = "http://www.mss.cbi.uni-erlangen.de/php/admin/admin.php?tablename=publications";
 });
</script>



