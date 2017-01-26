$(function() {
    "use strict";
    
    var url = "http://localhost:8888/product-stock/";
    var initialOffset = 10;
    var capacityListPrevious = 0;
    var capacityListNext = initialOffset;
    var capacityListNextBtnPress = false;
    var capacityListPreviousBtnPress = false;
    var capacityMasterUrl;

    showCapacity();
    showCapacityByPage(0);

    $("#saveBtnInCapacityMaster").click(function() {

      var CapacityMasterSaveType = $("#saveBtnInCapacityMaster").data("capacity-save-type");
      console.log(CapacityMasterSaveType);
      if(CapacityMasterSaveType == "edit") {
          capacityMasterUrl = url + "CapacityMasterController/updateCapacityMaster";
      } else {
          capacityMasterUrl = url + "CapacityMasterController/saveCapacityMaster";
      }

    	$.ajax({
            type: 'POST',
            url: capacityMasterUrl,
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
              	$("#capacityMasterForm")[0].reset();
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
              if(!jQuery.isEmptyObject(obj)){
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
              }
            },
            error:function(){
              // failed request; give feedback to user
              console.log('Get Category list call has completed with error..');
            }
          });
    }

    // Capacity Master 
    $("#capacityListNext").click(function(){
        showCapacityByPage(capacityListNext);
        capacityListNextBtnPress = true;
        capacityListPreviousBtnPress = false;
    });

    $("#capacityListPrevious").click(function(){
        showCapacityByPage(capacityListPrevious);
        capacityListNextBtnPress = false;
        capacityListPreviousBtnPress = true;
    });

    $("#capacityListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        showCapacityByPage(0);
    });
  
    $(document).on('click', '.capacityMasterEditBtn', function(){ 
        var capacityData = [$(this).data('capacity-id'), $(this).data('capacity-desc'), $(this).data('capacity-remark')];
        getCapacityById(capacityData);
    });

    function getCapacityById(capacityData) {
      $("#saveBtnInCapacityMaster").data("capacity-save-type", "edit");
      $("#capacityMasterId").val(capacityData[0])
      $("#capacityMasterDesc").val(capacityData[1]);
      $("#capacityMasterRemark").val(capacityData[2]);
      $("#capacity-master").modal('show');
    }

    function showCapacityByPage(offset) {
    	$.ajax({
            type: 'GET',
            url: url + "CapacityMasterController/getAllCapacityList",
            data: {offset: offset, searchKey: $("#capacityListSearch").val()},
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get Capacity list call..');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!jQuery.isEmptyObject(obj)){
                $('#capacity_list_panel').empty();
                $("#capacity_list_templete").tmpl(obj).appendTo("#capacity_list_panel");
                if(capacityListNextBtnPress) {
                  capacityListPrevious = capacityListNext;
                  capacityListNext=capacityListNext + initialOffset;
                  $("#capacityListNext").show();
                  $("#capacityListPrevious").hide();
                }
                if(capacityListPreviousBtnPress) {
                  capacityListPrevious = 0;
                  capacityListNext = initialOffset;
                  $("#capacityListNext").show();
                  $("#capacityListPrevious").hide();
                }
                console.log('Get Capacity list call completed..');
              }else {
                if(capacityListNextBtnPress) {
                  capacityListNext = capacityListNext - initialOffset;
                  capacityListPrevious= capacityListNext;
                  $("#capacityListNext").hide();
                  $("#capacityListPrevious").show();
                }
                if(capacityListPreviousBtnPress) {
                  capacityListPrevious = 0;
                  capacityListNext = initialOffset;
                  $("#capacityListNext").show();
                  $("#capacityListPrevious").hide();
                }
                $('#capacity_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            } 
            },
            error:function(){
              // failed request; give feedback to user
  			      console.log('Get Capacity list call has completed with error..');
            }
          });
    }
});