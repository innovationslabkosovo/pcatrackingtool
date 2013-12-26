$(document).ready(function() {


	$('#Pca_status').on('change',function(){
		var today = new Date();
		var today_to_display = new Date();
		today =today.getFullYear()+"-"+("0" + (today.getMonth() + 1)).slice(-2)+"-"+today.getDate();
		//today_to_display = today_to_display.getDate()+"-"+("0" + (today_to_display.getMonth() + 1)).slice(-2)+"-"+today_to_display.getFullYear();
		var end_date_value = $('#Pca_end_date').datepicker( "option","dateFormat", 'yy-mm-dd').val();
		
		if (today>end_date_value){
			console.log('today bigger');
		}
		var status_value = $(this).val();
		
		if(status_value == "implemented"){
			if (today<end_date_value) $('#Pca_end_date').datepicker("setDate", today);
			
			$("#Pca_end_date").datepicker("option","minDate", null);
			$("#Pca_end_date").datepicker("option","maxDate", null);
			$("#Pca_end_date").datepicker("option","maxDate", today_to_display);
			
			
		}else if(status_value == "canceled"){
			if (today<end_date_value) $('#Pca_end_date').datepicker("setDate", today);
			
			$("#Pca_end_date").datepicker("option","minDate", null);
			$("#Pca_end_date").datepicker("option","maxDate", null);
			$("#Pca_end_date").datepicker("option","maxDate", today_to_display);
			

		}else if (status_value != "") {
			if (today>end_date_value) $('#Pca_end_date').datepicker("setDate", today);
			
			$("#Pca_end_date").datepicker("option","minDate", null);
			$("#Pca_end_date").datepicker("option","maxDate", null);
			$("#Pca_end_date").datepicker("option","minDate", today_to_display);
			
		}
		$('#Pca_end_date').datepicker( "option","dateFormat", 'dd-mm-yy');
	});

	if ($("#Pca_status").val() == "canceled"){
		$('#pca-form').find('input, textarea, button, select').attr('disabled','disabled');
		$('#pca-form').find('#submit, #Pca_status').attr('disabled',false);
		$('#Pca_status option[value="implemented"]').attr('disabled','disabled');
		$('#Pca_status option[value=""]').attr('disabled','disabled');
	}
	
    $("#Pca_start_date").datepicker({  
    	dateFormat: 'dd-mm-yy',    
        onSelect: function(selected) {
          $("#Pca_end_date").datepicker("option","minDate", selected)
        }
    });
    $("#Pca_end_date").datepicker({   
  		dateFormat: 'dd-mm-yy',   
        onSelect: function(selected) {
           $("#Pca_start_date").datepicker("option","maxDate", selected)
        }
    });  

    // update total unicef budget
    $('.update_unicef_budget').blur(function(){
    	if ($(this).val() < 0 || $(this).val() == "") 
    	{
    		$(this).val(0);
    		return 0;
    	}
    	var total_unicef_budget = 0;
    	$('.update_unicef_budget').each(function(){
    		total_unicef_budget = total_unicef_budget + parseInt($(this).val());
    	})
    	$('#Pca_unicef_cash_budget').val(total_unicef_budget);

    	$('.update_total_budget').trigger('blur');
    });
    
    $('.update_total_budget').blur(function(){
    	if ($(this).val() < 0 || $(this).val() == "") 
    	{    		
    		$(this).val(0);
    		return 0;
    	}
    	var total_budget = 0;
    	$('.update_total_budget').each(function(){
    		total_budget = total_budget + parseInt($(this).val());
    	})
    	$('#Pca_total_cash').val(total_budget);

    });

  //   $('.donor_dialog_button').click(function(){
  //   	var id = $(this).attr('id');
		// var number = id.slice(-1);
		// dialog_id = "#donorDialog_id"+number;
	
  //   	jQuery.ajax({'type':'POST',
  //   		'onclick': '$('+dialog_id+').dialog(\"open\"); return false;',
		// 	'beforeSend': beforeSendAjax(), 
		// 	'url':'/pcatracking/donor/create',
		// 	'data':{'number':number},
		// 	'cache':false,
		// 	//'update':dialog_id,
		// 	'success':function(data){
		// 			afterSendAjax();
		// 			$(dialog_id).html(data);
		// 	}
		// });
		      
    	
  //   	return false;
  //   });

    $('.add_another_donor').click(function(){
		
		//get attributes
		var id = $(this).attr('id');
		var old_donor_number = $('.grant_number:last').html();

		if ($('#donor_id'+old_donor_number).val() == "" || $('#grant_id'+old_donor_number).val() == "" || $('#funds_id'+old_donor_number).val() == 0)
		{
    		alert("Please fill empty fields for Donor "+old_donor_number);
    		return false;
		}
		
		//clone Donor
     	var cloned_donor = $(".clone_donor:last").clone(); // clone target beneficiary div
    	
    	// cloned IR number
    	var donor_number = parseInt(old_donor_number) + 1;
		
    	// iterate main IR div id
    	cloned_donor.attr('id',cloned_donor.attr('id').replace('id'+old_donor_number,'id'+donor_number));   
    	
    	// update IR display number
    	cloned_donor.find('span.grant_number').html(donor_number);    
		
		// iterate and update cloned IR's div IDs
		cloned_donor.find('.change_donor').each(function(){    		

			child_first_id = $(this).attr('id');
			$(this).attr('id',child_first_id.replace('id'+old_donor_number,'id'+donor_number));    
    		
    	});

		
		cloned_donor.find('.donor  option:first').attr('selected','selected');
    	cloned_donor.find('.grant').children().remove(); 
    	cloned_donor.find('.funds').val(0);
    		 
    		
    		
    	
    
		// // appened cloned IR DIV
		 cloned_donor.appendTo("#pca_grant_f");		

		 // bind ajax call on create new donor
		 cloned_donor.find("#showDonorDialog_id"+donor_number).bind( "click", function() {
		  jQuery.ajax({
			'data': 'number='+donor_number,
			'onclick': '$(\"#donorDialog_id'+donor_number+'\").dialog(\"open\"); return false;',
			'url': '/pcatracking/Donor/create',
			'cache': false,
			'success': function (html) {
			    jQuery("#donorDialog_id"+donor_number).html(html);
			    //$('#donor_id'+donor_number).trigger('click');
			}
			});
		  return false;
		});

		 // bind ajax call on create new grant
		 cloned_donor.find("#showGrantDialog_id"+donor_number).bind( "click", function() {
		  jQuery.ajax({
			'data': 'number='+donor_number,
			'onclick': '$(\"#grantDialog_id'+donor_number+'\").dialog(\"open\"); return false;',
			'url': '/pcatracking/grant/create',
			'cache': false,
			'success': function (html) {
			    jQuery("#grantDialog_id"+donor_number).html(html);
			    //$('#donor_id'+donor_number).trigger('click');
			}
			});
		  return false;
		});
		//$(".sector:last").trigger("change");
    });




    jQuery('body').on('change','.donor',function(){
		var id = $(this).attr('id');
		var number = id.slice(-1);
		
		jQuery.ajax({'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$(this).val(),'current_model':'grant','pk':'grant_id','name':'name','fk_name':'donor_id'},
			'cache':false,
			'success':function(html){
				afterSendAjax();
				jQuery("#grant_id"+number).children().remove();  
				$("#grant_id"+number).append(html);				
				//$('#target_'+children_part_id).trigger('change'); 
			}});
		return false;
	});

    // sector dropdown click
    jQuery('body').on('change','.sector',function(){
    	var id = $(this).attr('id');
		var number = id.slice(-1);	
		console.log(number);
		jQuery.ajax({
			'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$(this).val(),'current_model':'rrp5output,intermediateResult,goal','pk':'rrp5output_id,ir_id,goal_id','name':'name','fk_name':'sector_id'},
			'cache':false,
			'success':function(data){
				afterSendAjax();
			//	console.log(data);
				data = data.split('nextitem;');
				$('select.rrp5_s'+number).children().remove();  
				$('select.rrp5_s'+number).append(data[0]);
				$('select.ir_s'+number).children().remove();  
				$('select.ir_s'+number).append(data[1]);
				$('select.goal_s'+number).children().remove();  
				$('select.goal_s'+number).append(data[2]);
			}});

		return false;

    });

    //add another (new) cloned sector div 
    $('#add_another_sector').click(function(){
    	
    	
    	if ($('.sector:last').val() == "")
		{
    		alert("Please select the first Sector");
    		return false;
		}


		var sector_number = $('.sector_number:last').val();
    	var pca_structure = $('.pca_single_structure:last');
    	var new_sector_number = parseInt(sector_number) + 1;
    	var id_display = "s"+new_sector_number;
    	var cloned_sector = pca_structure.clone();

    	cloned_sector.attr("id","pca_structure_"+id_display);
    	
    	cloned_sector.find('span#sector_number').html(new_sector_number);
    	cloned_sector.find('.change_sector').each(function(){    
    		//console.log($(this).attr('id'));
    		child_first_id = $(this).attr('id');
    		$(this).attr('id',child_first_id.replace('s'+sector_number,id_display));    

    		child_class = $(this).attr('class');
    		$(this).attr('class',child_class.replace('s'+sector_number,id_display));    

    		if ($(this).prop("tagName") == "SELECT" ){	
    			$(this).val("");
    		}	
    	});
    	cloned_sector.find('.ir_s'+sector_number).removeClass( 'ir_s'+ sector_number).addClass('ir_s'+ new_sector_number.toString());
    	cloned_sector.find('.rrp5_s'+sector_number).removeClass( 'rrp5_s'+ sector_number).addClass('rrp5_s'+ new_sector_number.toString());
    	cloned_sector.find('.goal_s'+sector_number).removeClass( 'goal_s'+ sector_number).addClass('goal_s'+ new_sector_number.toString());
    	cloned_sector.find('.target_s'+sector_number).removeClass( 'target_s'+ sector_number).addClass('target_s'+ new_sector_number.toString());
       
       	cloned_sector.find('.sector_number').val(new_sector_number);
    	cloned_sector.find('.pca_tb').html("");
    	

    	$("#pca_overall_structure .pca_structure_fs").append(cloned_sector);
    	console.log(cloned_sector);
    });

    // goal dropdown click
	jQuery('body').on('change','.goal',function(){
		var id = $(this).attr('id');
		var id_array = id.split('_');
		children_part_id = id_array[1]+"_"+id_array[2];
		//console.log(children_part_id);

		jQuery.ajax({'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$(this).val(),'current_model':'target','pk':'target_id','name':'name','fk_name':'goal_id'},
			'cache':false,
			'success':function(html){
				afterSendAjax();
				jQuery("#target_"+children_part_id).children().remove();  
				$("#target_"+children_part_id).append(html);
				$('#pca_tb_'+children_part_id).html("");
				//$('#target_'+children_part_id).trigger('change'); 
			}});
		return false;
	});

	 // target select2-dropdown click
	jQuery('body').on('change','.target',function(){
		var parent = $(this);
		var id = $(this).attr('id');
		var id_array = id.split('_');		
		children_part_id = id_array[1]+"_"+id_array[2];
		var number = $('#indicator_number_'+children_part_id).html();
		var checkDuplicate = 0;

		// check for duplicate targets
		// $(".target").each(function(){
		// 	if (parent.attr('id') == $(this).attr('id')) return true; // ignore same field
		// 	if ($(this).val() == parent.val() )
		// 	{
		// 		// duplicate exists; do not displat target beneficiaries;
		// 		alert('Target already added!');
		// 		checkDuplicate = 1;
		// 		$("#goal_"+children_part_id).trigger("change");
		// 		return;
		// 	}
		// });

	 //	if (checkDuplicate) return;
		jQuery.ajax({'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/gettargetbeneficiaries',
			'data':{'target_id':$(this).val(),'target_number':number},
			'cache':false,
			'success':function(html){afterSendAjax();jQuery("#pca_tb_"+children_part_id).html(html)}});
		return false;
	});

	 // intermediate result dropdown click
	jQuery('body').on('change','.ir',function(){
		var id = $(this).attr('id');
		var id_array = id.split('_');		
		children_part_id = id_array[1]+"_"+id_array[2];
		console.log(children_part_id);
		jQuery.ajax({
			'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$(this).val(),'current_model':'wbs','pk':'wbs_id','name':'name','fk_name':'ir_id'},
			'cache':false,
			'success':function(html){afterSendAjax();
				jQuery("#wbs_"+children_part_id).html(html);

				 }});
		return false;
	});

	 // add another (new) cloned goal and target div 
	 $('.add_another_indicator').click(function(){

	 	var id = $(this).attr('id');
		var sector_number = id.slice(-1);	
		var old_target_number = $('span.target_number_s'+sector_number+':last').html();

	 	if ($('.target_s'+sector_number+':last').val() == "")
		{
    		alert("Please select Indicator "+old_target_number+" for Sector "+sector_number);
    		return false;
		}
		
	 	
    	var cloned_indicator = $(".goal_target_s"+sector_number+":last").clone(); // clone target beneficiary div
    	
    	var target_number = parseInt(old_target_number) + 1; // set target number
    	cloned_indicator.find('span.target_number_s'+sector_number).html(target_number);
    	console.log(sector_number);
    	var tb = cloned_indicator.find('.pca_tb');
    	
		
		tb.attr("id","pca_tb_s"+sector_number+"_id"+target_number);

		cloned_indicator.find('.change_sector').each(function(){    		

			child_first_id = $(this).attr('id');
			//console.log(child_first_id);
    		$(this).attr('id',child_first_id.replace('id'+old_target_number,'id'+target_number));    
    		
    	});

    	cloned_indicator.find('select').each(function(){    		
    		$(this).val("");
    		
    	});
    
			
		tb.html("");
		
		cloned_indicator.appendTo("#goal_target_s"+sector_number+"_fs");		
		//$(".sector:last").trigger("change");
    });

	// add another (new) cloned IR and WBS div 
	$('.add_another_ir').click(function(){
		
		//get attributes
		var id = $(this).attr('id');
		var sector_number = id.slice(-1);
		var old_ir_number = $('span.ir_number_s'+sector_number+':last').html();

		if ($('.ir_s'+sector_number+':last').val() == "")
		{
    		alert("Please select Intermediate Result "+old_ir_number+" for Sector "+sector_number);
    		return false;
		}
		
		//clone IR
    	var cloned_ir = $(".ir_wbs_s"+sector_number+":last").clone(); // clone target beneficiary div
    	
    	// cloned IR number
    	var ir_number = parseInt(old_ir_number) + 1;
		
    	// iterate main IR div id
    	cloned_ir.attr('id',cloned_ir.attr('id').replace('id'+old_ir_number,'id'+ir_number));   
    	
    	// update IR display number
    	cloned_ir.find('span.ir_number_s'+sector_number).html(ir_number);    
		
		// iterate and update cloned IR's div IDs
		cloned_ir.find('.change_ir').each(function(){    		

			child_first_id = $(this).attr('id');
			$(this).attr('id',child_first_id.replace('id'+old_ir_number,'id'+ir_number));    
    		
    	});

    	cloned_ir.find('select').each(function(index){    	
    		console.log(index);
    			if($(this).attr('class') == "wbs")	
 				{
 					alert($(this).attr('class'));
    				$(this).select2();
 				}
 
    			$(this).val("");
    		
    	});
    
		// appened cloned IR DIV
		cloned_ir.appendTo("#ir_wbs_s"+sector_number+"_fs");		
		//$(".sector:last").trigger("change");
    });
	 
	// $("#noTarget").change(function(){

	// 	if ($(this).attr("checked") == "checked"){
	// 		$(".target").attr("disabled",true);
	// 		$("input[name='Pca[pcaTargetProgresses][total][]']").attr("disabled",true);
	// 		$("input[name='Pca[pcaTargetProgresses][unit_id][]']").attr("disabled",true);
	// 		$("input[name='Pca[pcaTargetProgresses][target_id][]']").attr("disabled",true);
				
	// 	}	
	// 	else{
	// 		$(".target").attr("disabled",false);			
	// 		$("input[name='Pca[pcaTargetProgresses][total][]']").attr("disabled",false);
	// 		$("input[name='Pca[pcaTargetProgresses][unit_id][]']").attr("disabled",false);
	// 		$("input[name='Pca[pcaTargetProgresses][target_id][]']").attr("disabled",false);
	// 	}


	// });


	// jQuery('body').on('change','.sector',function(){
	// 	var id = $(this).attr('id');
	// 	var number = id.slice(-1);	
	// 	jQuery.ajax({
	// 		'type':'POST',
	// 		'beforeSend': beforeSendAjax(), 
	// 		'url':'/pcatracking/pca/returnparent',
	// 		'data':{'fk_val':$('#sector_id'+number).val(),'current_model':'goal','pk':'goal_id','name':'name','fk_name':'sector_id'},
	// 		'cache':false,
	// 		'success':function(html){afterSendAjax();jQuery("#goal_id"+number).html(html);$('#pca_tb'+number).html("");$('#goal'+number).trigger('change'); }});
	// 	return false;
	// });

	

	// jQuery('body').on('change','.wbsSector',function(){
	// 	var id = $(this).attr('id');
	// 	var number = id.slice(-1);	
			
	// 	jQuery.ajax({
	// 		'type':'POST',
	// 		'beforeSend': beforeSendAjax(), 
	// 		'url':'/pcatracking/pca/returnparent',
	// 		'data':{'fk_val':$('#wbs_sector_id'+number).val(),'current_model':'intermediateResult','pk':'ir_id','name':'name','fk_name':'sector_id'},
	// 		'cache':false,
	// 		'success':function(html){afterSendAjax();jQuery("#ir_id"+number).html(html);}});
	// 	return false;
	// });

	



	jQuery('body').on('change','.governorate',function(){
		var id = $(this).attr('id');
		var number = id.slice(-1);	
		jQuery.ajax({
			'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$('#pca_governorate_id'+number).val(),'current_model':'region','pk':'region_id','name':'name','fk_name':'governorate_id'},
			'cache':false,
			'success':function(html){afterSendAjax();jQuery("#region_id"+number).html(html);}});
		return false;
	});

	jQuery('body').on('change','.region',function(){
		var id = $(this).attr('id');
		var number = id.slice(-1);	
		jQuery.ajax({
			'type':'POST',
			'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/pca/returnparent',
			'data':{'fk_val':$('#pca_region_id'+number).val(),'current_model':'location','pk':'location_id','name':'name','fk_name':'region_id'},
			'cache':false,
			'success':function(html){afterSendAjax();jQuery("#location_id"+number).html(html);}});
		
		return false;
	});

	$('.addPcaLoc').click(function(){
		//console.log('test');
		var location_number = parseInt($('.pcaLocationDiv').length) + 1;
		
    	var cloned_item = $('.pcaLocationDiv:last').clone().attr("id",$('.pcaLocationDiv:last').attr("id").substring(0, $('.pcaLocationDiv:last').attr("id").length - 1)+String(location_number)).val(""); // clone target beneficiary div
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

		//tb.html("");
		cloned_item.find('.select2-container').remove();
		cloned_item.appendTo(".location_row");		
		$('.multiLoc:last').select2();
		$('.multiLoc:last').attr('name','Pca[GwPcaLocRel][gateway_id][l'+location_number+'][]');
		//$(".sector:last").trigger("change");
    });

	$('.remove_sector').click(function(){
		
		var sector_id = $(this).attr("id");
		var sector_number = sector_id.slice(-1);
		var sector_name = $('#sector_id_s'+sector_number+" :selected").text();
		
		
		var btns = {};
		btns['Yes'] = function() {
			
		  // Here you have to reference the real dialog
		  	$('#dialog').dialog("close");
		  	if ($('.pca_single_structure').length < 2)
		  		alert("Cannot remove sector. PCA should contain at least one sector");
		  	else
				$('#pca_structure_s'+sector_number).remove();

			return false;  
		  // continue the process
		};
		btns['No'] = function() {
			
		  $('#dialog').dialog("close");		

		  return false;
		};

		// Never created a div on the fly but it's working well and I just added an ID
		$('<div id="dialog"><p>Do you want to delete sector - '+sector_name+'</p></div>').dialog({
		autoOpen : true,
		title : 'Delete File',
		modal : true,
		buttons : btns
		});



		

	})

	


	// jQuery('body').on('change','.region',function(){
	// 	var id = $(this).attr('id');		 
	// 	var region_id = $(this).val();
	// 	$('.select2-choices').remove('.select2-search-field');
	// 	var number = $(".multiLoc:last").attr('id').slice(-1);

	// 	var selected_choices = $('.select2-choices').html();
	// 	//selected_choices.remove($('.select2-search-field'));
	// 	jQuery.ajax({
	// 		'type':'POST',
	// 		'beforeSend': beforeSendAjax(), 
	// 		'url':'/pcatracking/pca/returnLocationDiv',
	// 		'data':{'region_id':region_id,'model_id':$("#model_id").val(),'loc_number':number},
	// 		'cache':false,
	// 		'success':function(data){
				
	// 			afterSendAjax();	
				
				
	// 			var loc_data = $("#location"+number).select2("data");
	// 			newnumber = parseInt(number)+1;
	// 			console.log(loc_data);
			
	// 			$(".select2-container").remove();
	// 			$("#location"+number).css('display','none');
	// 			$("#locationSelectDiv").append(data);
	// 			$("#location"+newnumber).select2();

	// 			$("#location"+newnumber).select2("data", loc_data);
	// 			//$('#locationSelectDiv .select2-container .select2-choices').append(selected_choices);
	// 			//$('.select2-drop').html(selected_class).show();
	// 		}});



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

	$('.deleteFile').click(function(){
		var filename = $(this).attr('class').split(' ')[1];
		var file_id = $(this).attr("id");
		var btns = {};
		btns['Yes'] = function() {
			
		  // Here you have to reference the real dialog
		  	$('#dialog').dialog("close");

			$("#fileDiv"+file_id).remove();

			return false;  
		  // continue the process
		};
		btns['No'] = function() {
			
		  $('#dialog').dialog("close");		

		  return false;
		};

		// Never created a div on the fly but it's working well and I just added an ID
		$('<div id="dialog"><p>Do you want to delete file - '+filename+'</p></div>').dialog({
		autoOpen : true,
		title : 'Delete File',
		modal : true,
		buttons : btns
		});



		

	})
	




});

jQuery(function($) {

    $('form').bind('submit', function() {
        $(this).find(':input').removeAttr('disabled');
    });

});