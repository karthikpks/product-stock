$(function() {
    "use strict";
    
    var url = "http://localhost:8888/product-stock/";
    var initialOffset = 10;
    var modelListPrevious = 0;
    var modelListNext = initialOffset;
    var modelListNextBtnPress = false;
    var modelListPreviousBtnPress = false;
    var modelMasterUrl;

    showModel();
    showModelByPage(0);

    $("#saveBtnInModelMaster").click(function() {

      var ModelMasterSaveType = $(this).data("model-save-type");
      console.log(ModelMasterSaveType);
      if(ModelMasterSaveType == "edit") {
          modelMasterUrl = url + "ModelMasterController/updateModelMaster";
      } else {
          modelMasterUrl = url + "ModelMasterController/saveModelMaster";
      }

    	$.ajax({
            type: 'POST',
            url: modelMasterUrl,
            data: $("#modelMasterForm").serialize(),
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInModelMaster").hide();
              $('#model-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
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

    $("#modelListNext").click(function(){
        showModelByPage(modelListNext);
        modelListNextBtnPress = true;
        modelListPreviousBtnPress = false;
    });

    $("#modelListPrevious").click(function(){
        showModelByPage(modelListPrevious);
        modelListNextBtnPress = false;
        modelListPreviousBtnPress = true;
    });

    $("#modelListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        showModelByPage(0);
    });
  
    $(document).on('click', '.modelMasterEditBtn', function(){ 
        var modelData = [$(this).data('model-id'), $(this).data('model-desc'), $(this).data('pc-id'), $(this).data('brand-id'), $(this).data('capacity-id')];
        getModelById(modelData);
    });

    function getModelById(modelData) {
      console.log(modelData);
      $("#saveBtnInModelMaster").data("model-save-type", "edit");
      $("#modelMasterId").val(modelData[0])
      $("#modelMasterDesc").val(modelData[1]);
      $("#modelMasterProductCategory").val(modelData[2]).prop('selected', true);
      $("#modelMasterBrand").val(modelData[3]).prop('selected', true);
      $("#modelMasterCapacity").val(modelData[4]).prop('selected', true);
      $("#model-master").modal('show');
    }

    function showModelByPage(offset) {
      $.ajax({
            type: 'GET',
            url: url + "modelMasterController/getAllmodelList",
            data: {offset: offset, searchKey: $("#modelListSearch").val()},
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get model list call..');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!jQuery.isEmptyObject(obj)){
                $('#model_list_panel').empty();
                $("#model_list_templete").tmpl(obj).appendTo("#model_list_panel");
                if(modelListNextBtnPress) {
                  modelListPrevious = modelListNext;
                  modelListNext=modelListNext + initialOffset;
                  $("#modelListNext").show();
                  $("#modelListPrevious").hide();
                }
                if(modelListPreviousBtnPress) {
                  modelListPrevious = 0;
                  modelListNext = initialOffset;
                  $("#modelListNext").show();
                  $("#modelListPrevious").hide();
                }
                console.log('Get model list call completed..');
              }else {
                if(modelListNextBtnPress) {
                  modelListNext = modelListNext - initialOffset;
                  modelListPrevious= modelListNext;
                  $("#modelListNext").hide();
                  $("#modelListPrevious").show();
                }
                if(modelListPreviousBtnPress) {
                  modelListPrevious = 0;
                  modelListNext = initialOffset;
                  $("#modelListNext").show();
                  $("#modelListPrevious").hide();
                }
                $('#model_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            } 
            },
            error:function(){
              // failed request; give feedback to user
              console.log('Get model list call has completed with error..');
            }
          });
    }
});