$(document).ready(function() {

	 $("#PcaReport_start_period").datepicker({
       // minDate: 0,
      //  maxDate: "+60D",
        dateFormat: 'dd-mm-yy',  
        numberOfMonths: 2,
        onSelect: function(selected) {
          $("#PcaReport_end_period").datepicker("option","minDate", selected)
        }
    });
    $("#PcaReport_end_period").datepicker({ 
      //  minDate: 0,
       // maxDate:"+60D",
       dateFormat: 'dd-mm-yy',  
        numberOfMonths: 2,
        onSelect: function(selected) {
           $("#PcaReport_start_period").datepicker("option","maxDate", selected)
        }
    });  

	$('#PcaReport_pca_id').click(function(){
		var pca_id = $(this).val();
		//console.log(pca_id);
		jQuery.ajax({
			'type':'POST',
			//'beforeSend': beforeSendAjax(), 
			'url':'/pcatracking/index.php/pcaReport/returnBeneficiaries',
			'data':{'pca_id':pca_id},
			'cache':false,
			'dataType':'json',
			'success':function(data){//console.log(data[1]);
				//$('#targetBen .targetBenLegend').empty();
				var targets ="";
				for(var i=0; i<data.length; i++){
					//console.log(data[i]['total']);
					targets += "<h4>Pca Taget "+(i+1)+"</h4>";
					targets += "<p><strong>Target: </strong>"+data[i]['target_name']+"</p>";
					targets += "<input type='hidden' name='PcaReport[TargetProgressPcaReportRel][target_id][]' value='"+data[i]['target_id']+"'>"
					targets += "<p><strong>Beneficiary </strong>: "+data[i]['unit_name']+"</p>";
					targets += "<input type='hidden' name='PcaReport[TargetProgressPcaReportRel][unit_id][]' value='"+data[i]['unit_id']+"'>"
					targets += "<strong>Total Number </strong>: <input type='number'  name='PcaReport[TargetProgressPcaReportRel][total][]' min='0' id='pca_report_total'> --- Current Shortfall: "+data[i]['shortfall'];
					targets += "<input type='hidden' name='' value='"+data[i]['shortfall']+"'>"
					targets += "<hr>";
				}
				$('#targetBen #pcaTargets').html(targets);
										
			}});

		return false;

	});

});

