$(document).ready(function() {



	jQuery('body').on('change','.governorate',function(){
		var id = $(this).attr('id');
		var number = id.slice(-1);	
		jQuery.ajax({
			'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$('#governorate_id').val(),'current_model':'region','pk':'region_id','name':'name','fk_name':'governorate_id'},
			'cache':false,
			'success':function(html){afterSendAjax();jQuery("#region_id").html(html);}});
		return false;
	});

	// jQuery('body').on('change','.region',function(){
	// 	var id = $(this).attr('id');
	// 	var number = id.slice(-1);	
	// 	jQuery.ajax({
	// 		'type':'POST',
	// 		'beforeSend': beforeSendAjax(), 
	// 		'url':'/pcatracking/pca/returnparent',
	// 		'data':{'fk_val':$('#region_id').val(),'current_model':'location','pk':'location_id','name':'name','fk_name':'region_id'},
	// 		'cache':false,
	// 		'success':function(html){afterSendAjax();jQuery("#location_id").html(html);}});
		
	// 	return false;
	// });

	

	function beforeSendAjax () {
		$('body').css('opacity',0.80);
		$("#loaderDiv").show();
		$("#loaderDiv").css('opacity',1);
		// body...
	}

	function afterSendAjax () {
		$('body').css('opacity',1);
		$("#loaderDiv").hide();		
		// body...
	}

});