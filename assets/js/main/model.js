$(function() {
    "use strict";
    
    var url = "http://localhost:8888/productstock/";
    
    showModel();

    $("#saveBtnInModelMaster").click(function() {
    	$.ajax({
            type: 'POST',
            url: url + "ModelMasterController/saveModelMaster",
            data: $("#modelMasterForm").serialize(),
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInModelMaster").hide();
              $('#model-master-ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              console.log(obj);
              $('#model-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInModelMaster").show();
              if(obj.status) {
              	$("#modelMasterForm")[0].reset();
                $('#priceMasterModelDes').append($('<option>', {
                    value: obj.id,
                    text: obj.value
                 }));

                $('#productMasterModel').append($('<option>', {
                    value: obj.id,
                    text: obj.value
                 }));
              }
            },
            error:function() {
              // failed request; give feedback to user
              $('#model-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInModelMaster").show();
            }
          });
    });

    function showModel() {
    	$.ajax({
            type: 'GET',
            url: url + "ModelMasterController/getModelList",
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get Model list call..');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $('#priceMasterModelDes')
              .find('option')
              .remove()
              .end()
              .append('<option value="0">Select model</option>')
              $.each(obj, function (i, item) {
                $('#priceMasterModelDes').append($('<option>', {
                    value: item.md_id,
                    text: item.md_desc
                 }));
                $('#productMasterModel').append($('<option>', {
                    value: item.md_id,
                    text: item.md_desc
                 }));
              });
              console.log('Get Model list call completed..');
            },
            error:function(){
              // failed request; give feedback to user
				      console.log('Get Model list call has completed with error..');
            }
        });
    }
});