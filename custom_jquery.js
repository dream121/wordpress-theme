jQuery(document).ready(function(){ //newly added
	 if (jQuery('[name="fields[field_5469b8c1cca12]"]').is(':checked'))
		{	
			//alert('ffff');
			   jQuery( ".mce-container-body *" ).attr("disabled","disabled");
		}
	    else {
        jQuery('#idOfTheDIV :input').removeAttr('disabled');
		 }   
	var path = window.location + "";
		var res=path.split("id=");
		if(res){
		var postid = res[1];
		}
		jQuery.ajax({
		type: "post",
		url: "<?php echo site_url(); ?>/wp-admin/admin-ajax.php",
		dataType:"text",
		async:false,
		data:{action:"get_layout",pid:postid},
		success: function(response) {
			//alert(response);
		var resa = response.replace(/ /g, ".");
		jQuery("ul.sections-list li.active").removeClass("active");
		jQuery("li."+resa).addClass("active");
			
		}
	});

});