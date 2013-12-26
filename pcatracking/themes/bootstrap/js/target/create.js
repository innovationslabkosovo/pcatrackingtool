$(document).ready(function() {

	var previous_unit;
    var units_to_delete = new Array();

    $('.add_another_unit').click(function(){

    	var id = $(this).attr('id');
		var old_unit_number = $('.hidden_unit_number:last').val();

		if ($('#unit_id'+old_unit_number).val() == "" || $('#total_id'+old_unit_number).val() == "")
		{
    		alert("Please fill empty fields for Unit "+old_unit_number);
    		return false;
		}
		
		//clone unit
     	var cloned_unit = $(".unit_to_clone:last").clone(); // clone target beneficiary div
    	// cloned IR number
    	var unit_number = parseInt(old_unit_number) + 1;
		// iterate main IR div id
    	cloned_unit.attr('id',cloned_unit.attr('id').replace('id'+old_unit_number,'id'+unit_number));   
    	// update IR display number
        cloned_unit.find('span.remove_number').html(unit_number);
        cloned_unit.find('span.unit_number').html(unit_number);
    	cloned_unit.find('.hidden_unit_number').val(unit_number);
        cloned_unit.find('.hiddencurrent').val("");
        cloned_unit.find('#prog_target').html(0);


		// iterate and update cloned IR's div IDs
		cloned_unit.find('.change_unit').each(function(){    		

			child_first_id = $(this).attr('id');
			$(this).attr('id',child_first_id.replace('id'+old_unit_number,'id'+unit_number));    
    		
    	});
		


		cloned_unit.find('.unit  option:first').attr('selected','selected');
    	//cloned_unit.find('.grant').children().remove(); 
    	cloned_unit.find('.total').val(0);
    		 
    	cloned_unit.appendTo(".targetProgressLegend");

    });



    $(".remove_unit").live('click',function(){
        var parent = $(this).parent();
        var unit_id = parent.find(".unit").val();
        var unit_text = parent.find(".unit option:selected").text();
        var unit_length = $(".unit").length;



        var isGood=confirm('Are you sure you want to delete the Unit?');
        if (isGood) {
            //console.log(parent.find('.unit_to_remove'));
            units_to_delete.push(unit_id);
            $('.unit_to_remove').val(units_to_delete);
            if(unit_length < 2)
            {
                parent.find('.unit').prop('disabled', false).val($('.goal option:first').val());
                parent.find('.total').prop('disabled', false).val(0);
                parent.find('.hiddencurrent').val("");
                parent.find('#prog_target').html(0);

            }else
                parent.remove();
        } else {

        }

        return false;

    });


	$('.unit').live('click',function(){
        console.log("aa");
		var selected_option = $(this);
		var selected_unit_id = $(this).attr('id');
		var selected_unit_value = $(this).val();
		var selected_unit_text = $('#'+selected_unit_id+' option:selected').text();

		$('.unit').each(function(){
			var current_unit_id = $(this).attr('id');
			var current_unit_value = $(this).val();

			if (selected_unit_id == current_unit_id){
				return true;
			}

			if(selected_unit_value == current_unit_value){
				alert('Unit "'+selected_unit_text+'" is already selected');
				selected_option.val($("#"+selected_unit_id+" option:first").val());
				return false;
			}

			//previous_unit =
		});
        return false;

	});




 });


//