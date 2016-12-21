$(function() {
    "use strict";

     var url = "http://localhost:8888/product-stock/";

    $("#saveBtnInEmployeeMaster").click(function() {
    	$.ajax({
            type: 'POST',
            url: url + "EmployeeMasterController/saveEmployeeMasterDetails",
            data: $("#employeeMasterForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#saveBtnInEmployeeMaster").hide();
              $("#closeBtnInEmployeeMaster").hide();
              $('#employee-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $('#employee-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInEmployeeMaster").show();
              $("#closeBtnInEmployeeMaster").show();
              $("#employeeMasterForm").reset();
            },
            error:function(){
              // failed request; give feedback to user
              $('#employee-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInEmployeeMaster").show();
              $("#closeBtnInEmployeeMaster").show();
            }
          });
    });
});
