$(document).ready(function() {

//when export excel button is clicked call function getIDs
$("#export_excel_button").click(function(){
       getIDs();
});

    //function to get IDs of current items in the cgridview
    function getIDs(){

        var partner_ids = new Array();
    
        //get IDs from the hidden field of 'all_keys' that is returned by cgridview implementation
        $('.all_keys').children().each(function(){
  
            //var get_id_link = $(this).attr('href');
            //the ID is the last character in the link
            //partner_ids.push(get_id_link.substring(get_id_link.lastIndexOf("/")+1));
            partner_ids.push($(this).html());         
        
        });
    
        //set the value of hidden field with IDs so that it can be part of the parameters for the controller action
        $("#hidden_excel").val(partner_ids);
        $("#form-excel").submit();
   
    }

});

