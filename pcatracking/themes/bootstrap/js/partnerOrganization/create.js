$(document).ready(function() {

		jQuery('body').on('change','.governorate',function(){
		var id = $(this).attr('id');
		var number = id.slice(-1);	

		jQuery.ajax({
			'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$(this).val(),'current_model':'region','pk':'region_id','name':'name','fk_name':'governorate_id'},
			'cache':false,
			'success':function(html){afterSendAjax();jQuery("#po_region_id"+number).html(html);}});
		 $('#po_region_id'+number).trigger('click');
		return false;
	});

	jQuery('body').on('change','.region',function(){
		var id = $(this).attr('id');
		var number = id.slice(-1);	
		$("#pca_locality_id"+number).trigger("click");
		jQuery.ajax({
			'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$(this).val(),'current_model':'locality','pk':'locality_id','name':'name','fk_name':'region_id'},
			'cache':false,
			'success':function(html){afterSendAjax();jQuery("#po_locality_id"+number).html(html);}});
		
		return false;
	});


	jQuery('body').on('change','.locality',function(){
		var id = $(this).attr('id');
		var number = id.slice(-1);	
		jQuery.ajax({
			'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$(this).val(),'current_model':'location','pk':'location_id','name':'name','fk_name':'locality_id'},
			'cache':false,
			'success':function(html){afterSendAjax();console.log(html);jQuery("#po_location_id"+number).html(html);}});
		
		return false;
	});

	$('.add_another_loc').click(function(){
		//console.log('test');
		var location_number = parseInt($('.poLocationDiv').length) + 1;
		
    	var cloned_item = $('.poLocationDiv:last').clone().attr("id",$('.poLocationDiv:last').attr("id").substring(0, $('.poLocationDiv:last').attr("id").length - 1)+String(location_number)).val(""); // clone target beneficiary div
    	cloned_item.append('<hr>');
    	//cloned_item.children[1].val
    	 // set target number
    	
    	cloned_item.find('span#locationNumber').html(location_number);

    	//var tb = cloned_item.find('.pca_tb');
    	//id.substring(0, id.length - 1);
		//tb.attr("id",tb.attr("id").substring(0, tb.attr("id").length - 1)+String(target_number));

		cloned_item.children().each(function(){
			

			$(this).children().each(function(){

				if ($(this).prop("tagName") == "SELECT" ){	
					var id = $(this).attr("id");
					id = id.substring(0, id.length - 1);
					//alert(id);
					$(this).val("");
					$(this).attr("id",id+ location_number);
					
				}
				
			});
			
		});


		cloned_item.appendTo(".PO-locations");			
		
    });

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