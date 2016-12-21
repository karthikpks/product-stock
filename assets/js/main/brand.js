$(function() {
    "use strict";
    
    var url = "http://localhost:8888/productstock/";

    showBrand();

    $("#saveBtnInBrandMaster").click(function() {
    	$.ajax({
            type: 'POST',
            url: url + "BrandMasterController/saveBrandMaster",
            data: $("#brandMasterForm").serialize(),
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInBrandMaster").hide();
              $('#brand-master-ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              console.log(obj);
              $('#brand-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInBrandMaster").show();
              if(obj.status) {
              	$("#brandMaterForm")[0].reset();
                $('#modelMasterBrand').append($('<option>', {
                    value: item.id,
                    text: item.value
                }));
                $('#productMasterBrand').append($('<option>', {
                    value: item.id,
                    text: item.value
                }));
              }
            },
            error:function() {
              // failed request; give feedback to user
              $('#brand-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInBrandMaster").show();
            }
          });
    });

    function showBrand() {
      $.ajax({
            type: 'GET',
            url: url + "BrandMasterController/getBrandList",
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get Brand list call..');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $.each(obj, function (i, item) {
                $('#modelMasterBrand').append($('<option>', {
                  value: item.bm_id,
                  text: item.bm_desc
                }));
                $('#productMasterBrand').append($('<option>', {
                  value: item.bm_id,
                  text: item.bm_desc
                }));
            });
              console.log('Get Brand list call completed..');
            },
            error:function(){
              // failed request; give feedback to user
            console.log('Get Brand list call has completed with error..');
            }
          });
    }
});