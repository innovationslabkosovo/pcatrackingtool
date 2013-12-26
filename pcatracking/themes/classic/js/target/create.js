$(document).ready(function() {
    $('.addTarBen').click(function(){

    	var cloned_item = $(".targetProgress").clone().val("").toggleClass("targetProgress newTargetBen");

    	//cloned_item.children[1].val
		cloned_item.children().each(function(){
			
			$(this).children().each(function(){
				if ($(this).prop("tagName") == "SELECT"){
					var id_counter = $(this).attr("id").slice(-1);
					if (isNaN(id_counter)){
						$(this).attr("id",$(this).attr("id")+"1");
					}else{

					}
				}
				if($(this).attr('type') == "text" || $(this).prop("tagName") == "SELECT")
				$(this).val("");
			});
			
		});

		cloned_item.remove('#prog_target');
		cloned_item.appendTo(".targetProgressLegend");
    });
 });


//