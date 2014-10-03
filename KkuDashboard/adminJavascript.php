<script>

$('form').bind('form-pre-serialize', function(e) {
    tinyMCE.triggerSave();
});


function queryDeleteFile(tablename,id){

	var answer = confirm("Delete file?")
	if (answer){

		$.ajax({
			type: "POST",
			url: "adminQuery.php",
			data: "action=deleteFile&tablename="+tablename+"&id="+id,
			success: function(msg){
	   			//alert( "Data Saved: " + msg );
				window.location.reload()
	   		}
		});

	}

}

function queryMetaChangeFieldValue(tablename,id,field,oldvalue){

	var answer = prompt("Type in new value", ""+oldvalue)
	if (answer){
	
		$.ajax({
			type: "POST",
			url: "metaQuery.php",
			data: "action=editSingleField&tablename="+tablename+"&id="+id+"&fieldname="+field+"&value="+answer,
			success: function(msg){
	   			//alert( "Data Saved: " + msg );
				window.location.reload()
	   		}
		});

	}



}

function queryChangeFieldValue(tablename,id,field,oldvalue){

	var answer = prompt("Type in new value", oldvalue)
	if (answer){
	
		$.ajax({
			type: "POST",
			url: "adminQuery.php",
			data: "action=editSingleField&tablename="+tablename+"&id="+id+"&fieldname="+field+"&value="+answer,
			success: function(msg){
	   			//alert( "Data Saved: " + msg );
				window.location.reload()
	   		}
		});

	}



}

function queryDeleteImage(tablename,id){

	var answer = confirm("Delete image?")
	if (answer){
	
		$.ajax({
			type: "POST",
			url: "adminQuery.php",
			data: "action=deleteImage&tablename="+tablename+"&id="+id,
			success: function(msg){
	   			//alert( "Data Saved: " + msg );
				window.location.reload()
	   		}
		});

	}

}

function queryDeleteItem(tablename,id){

	var answer = confirm("Delete Entry?")
	if (answer){

		$.ajax({
			type: "POST",
			url: "adminQuery.php",
			data: "action=delete&tablename="+tablename+"&id="+id,
			success: function(msg){
	   			//alert( "Data Saved: " + msg );
				window.location.reload()
	   		}
		});

	}

}

function queryDeleteStructureItem(structurename,id){

	var answer = confirm("Delete Entry?")
	if (answer){

		$.ajax({
			type: "POST",
			url: "metaQuery.php",
			data: "action=delete&structurename="+structurename+"&id="+id,
			success: function(msg){
	   			//alert( "Data Saved: " + msg );
				window.location.reload()
	   		}
		});

	}

}

function toggleSlideId(id){
	$("#"+id).slideToggle("fast");
}

function toggleId(id){
	$("#"+id).toggle("fast");
}


function showId(id){
	$("#"+id).show("fast");
}

function hideId(id){
	$("#"+id).hide("fast");
}


// prepare the form when the DOM is ready 
$(document).ready(function() { 
    var optionsStay = { 
        target:        '#targetDiv',   // target element to update 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponseStay  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override form form's 'method' attribute 
        //dateType:  null        // 'xml', 'script', or 'json' (see form.js for docs) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful subit 
    }; 

    var optionsToParent = { 
        target:        '#targetDiv',   // target element to update 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponseToParent  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override form form's 'method' attribute 
        //dateType:  null        // 'xml', 'script', or 'json' (see form.js for docs) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful subit 
    };
	
	var optionsNew = { 
        target:        '#targetDiv',   // target element to update 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponseNew  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override form form's 'method' attribute 
        //dateType:  null        // 'xml', 'script', or 'json' (see form.js for docs) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful subit 
    };
	
	var optionsDelete = { 
        target:        '#targetDiv',   // target element to update 
        beforeSubmit:  showRequestDelete,  // pre-submit callback 
        success:       showResponseToParent  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override form form's 'method' attribute 
        //dateType:  null        // 'xml', 'script', or 'json' (see form.js for docs) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful subit 
    };


	$('.quickadder').ajaxForm(optionsStay);
	$('.editpost').ajaxForm(optionsStay);
	$('.newpost').ajaxForm(optionsNew);
	$('.deletepost').ajaxForm(optionsDelete);
	$('.uploader').ajaxForm(optionsStay);

    $("#loading").hide();
    //$("#delete").hide();

}); 

function showRequestDelete(formData, jqForm, options){

	var answer = confirm("Delete item?")
	if (answer){
	
		return showRequest(formData, jqForm)

	}else{
	
		return false;
	
	
	}


}
 
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
function showResponseStay(responseText, statusText)  { 
   	<?php if($_GET['noreload']==1) echo '//';  ?> window.location.reload()
} 

function showResponseToParent(responseText, statusText)  { 

	var newget="<?php 
	
	
		if($_GET['p']=='metaFormTables'){
		
			echo "?p=metaShowTables";
		
		}else if($_GET['p']=='metaFormIndices'){
		
			echo "?p=metaShowIndices";
		
		}else if($_GET['p']=='metaFormUsers'){
		
			echo "?p=metaShowUsers";
		
		}else if($_GET['belongsToID']!='' && $_GET['belongsToTablename']!='' ){

			echo "?action=edit&tablename=".$_GET['belongsToTablename']."&id=".$_GET['belongsToID'];
	
		}else{

			echo "?tablename=".$_GET['tablename']; 

		}

	?>";

   	document.location.href = newget;

	//window.location.reload()

} 

function showResponseNew(responseText, statusText)  { 

	var newget="<?php 

		if($_GET['p']=='metaFormTables'){
		
			echo "?p=metaShowTables";
		
		}else if($_GET['p']=='metaFormIndices'){
		
			echo "?p=metaShowIndices";
		
		}else if($_GET['p']=='metaFormUsers'){
		
			echo "?p=metaShowUsers";
		
		}else if($_GET['belongsToID']!='' && $_GET['belongsToTablename']!='' ){

			echo "?action=edit&tablename=".$_GET['belongsToTablename']."&id=".$_GET['belongsToID'];
	
		}else{

			echo "?tablename=".$_GET['tablename']; 

		}

	?>";

   	document.location.href = newget;

	//window.location.reload()

} 

 $("#loading").ajaxStart(function(){
   $(this).show();
 }).ajaxStop(function(){
   $(this).hide();
 });

</script>
