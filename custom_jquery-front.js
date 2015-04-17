jQuery(document).ready(function(){ //newly added
	//CT Screening Form
	//show hide PERSONAL HISTORY details 
	jQuery("#chkd input").on("click", function(){
		if (jQuery('#chkd input[type="checkbox"]').prop('checked')) {
			jQuery("#dbox").hide();
		}
		else {
			jQuery("#dbox").show();
		}
	});
	//show hide PERSONAL HISTORY details end
	
	//Show/side Last Menstrual Period
	jQuery(".Pregnant input").on("click", function(){
		var vals = jQuery(this) .val();
		if (vals =='Yes') {
			jQuery("#menstrual").show();
		}
		else {
			jQuery("#menstrual").hide();
		}
	});

	//Show/side Last Menstrual Period end
	//Show/side what type of exam
	jQuery(".section3 .one input").on("click", function(){
		var vals = jQuery(this) .val();
		//alert(vals);
		if (vals =='Yes') {
			jQuery("#exam").show();
			jQuery(".section4").show();
		}
		else {
			jQuery("#exam").hide();
			jQuery(".section4").hide();
		}
	});

	//Show/side what type of exam end

	//Show/side Are you taking Glucaphage? 
	jQuery(".section5 .one input").on("click", function(){
		var vals = jQuery(this) .val();
		//alert(vals);
		if (vals =='Yes') {
			jQuery("#bun").show();
		}
		else {
			jQuery("#bun").hide();
		}
	});

	//Show/side Are you taking Glucaphage? end

	//Show/side HAVE YOU EVER HAD A PREVIOUS ALLERGIC REACTION OF X-RAY CONTRAST 
	jQuery(".xray input").on("click", function(){
		var vals = jQuery(this) .val();
		//alert(vals);
		if (vals =='Yes') {
			jQuery(".section6").show();
		}
		else {
			jQuery(".section6").hide();
		}
	});

	//Show/side Are you taking Glucaphage? end


	//CT Screening Form end

	//CT Demographic Form
	
	//Show/side Other (describe) 
	jQuery(".Injuryis input").on("click", function(){
		var vals = jQuery(this) .val();
		//alert(vals);
		if (vals =='Others') {
			jQuery(".otherdescribe").show();
		}
		else {
			jQuery(".otherdescribe").hide();
		}
	});		

	//CT Demographic Form end

	//mri-screening Form
	
	//Show/side Other (describe) 
	jQuery(".section3 .injury input").on("click", function(){
		var vals = jQuery(this) .val();
		//alert(vals);
		if (vals =='Yes') {
			jQuery(".section3 .two").show();
		}
		else {
			jQuery(".section3 .two").hide();
		}
	});		
	
	jQuery(".mrisection4 .procedure input").on("click", function(){
		var vals = jQuery(this) .val();
		//alert(vals);
		if (vals =='Yes') {
			jQuery(".mrisection4 .two").show();
		}
		else {
			jQuery(".mrisection4 .two").hide();
		}
	});
	jQuery('.disabled').attr('disabled', 'disabled');

	jQuery(".mrisection5 .cardiac input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".cardiactxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".cardiactxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .heart input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".hearttxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".hearttxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .defibrillator input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".defibrillatortxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".defibrillatortxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .aneurysm input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".aneurysmtxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".aneurysmtxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .intravascular input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".intravascular input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".intravascular input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .eyesurgery input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".eyesurgerytxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".eyesurgerytxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .injurytoeye input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".injurytoeyetxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".injurytoeyetxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .orthopedic input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".orthopedictxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".orthopedictxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .neurostimulator input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".neurostimulatortxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".neurostimulatortxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .tumors input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".tumorstxt input[type=text]").attr('disabled',false);
			jQuery( ".wheretxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".tumorstxt input[type=text]").attr('disabled', 'disabled');
			jQuery( ".wheretxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .chemo input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".chemotxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".chemotxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .lumbar input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".lumbartxt input[type=text]").attr('disabled',false);
			jQuery( ".levelstxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".lumbartxt input[type=text]").attr('disabled', 'disabled');
			jQuery( ".levelstxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .earsurgery input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".earsurgerytxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".earsurgerytxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .vascular input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".vasculartxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".vasculartxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .metal input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".metaltxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".metaltxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .electrical input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".electricaltxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".electricaltxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .implanted input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".implantedtxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".implantedtxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .menstrual input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".menstrualtxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".menstrualtxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .tattoo input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".tattootxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".tattootxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .dentures input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".denturestxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".denturestxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .gunshot input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".gunshottxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".gunshottxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection5 .pins input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".pinstxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".pinstxt input[type=text]").attr('disabled', 'disabled');
		}
	});
	jQuery(".mrisection6 .reaction input[type='radio']").on("click", function(){
		var vals = jQuery(this) .val();
		
		if (vals =='Yes') {
			jQuery( ".reactionxt input[type=text]").attr('disabled',false);
		}
		else {
			jQuery( ".reactionxt input[type=text]").attr('disabled', 'disabled');
		}
	});

	//mri-screening Form end
});