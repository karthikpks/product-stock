$(function() {
    "use strict";
    
    var url = "http://localhost:8888/product-stock/";
    
    showCapacity();

    $("#saveBtnInCapacityMaster").click(function() {
    	$.ajax({
            type: 'POST',
            url: url + "CapacityMasterController/saveCapacityMaster",
            data: $("#capacityMasterForm").serialize(),
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInCapacityMaster").hide();
              $('#capacity-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              console.log(obj);
              $('#capacity-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInCapacityMaster").show();
              if(obj.status) {
              	$("#capacityMaterForm")[0].reset();
              	$('#modelMasterCapacity').append($('<option>', {
        				    value: obj.id,
        				    text: obj.value
        				}));
              }
            },
            error:function() {
              // failed request; give feedback to user
              $('#capacity-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInCapacityMaster").show();
            }
          });
    });

    function showCapacity() {
    	$.ajax({
            type: 'GET',
            url: url + "CapacityMasterController/getCapacityList",
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get Capacity list call..');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $.each(obj, function (i, item) {
                $('#modelMasterCapacity').append($('<option>', {
                    value: item.cp_id,
                    text: item.cp_desc
                }));

    				    $('#productMasterCapacity').append($('<option>', {
                    value: item.cp_id,
                    text: item.cp_desc
                }));
        			});
              console.log('Get Capacity list call completed..');
            },
            error:function(){
              // failed request; give feedback to user
  			      console.log('Get Category list call has completed with error..');
            }
          });
    }
});