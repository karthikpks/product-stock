$(function() {
    "use strict";
    
    var url = "http://localhost:8888/product-stock/";
    var initialOffset = 10;
    var brandListPrevious = 0;
    var brandListNext = initialOffset;
    var brandListNextBtnPress = false;
    var brandListPreviousBtnPress = false;
    var brandMasterUrl;

    showBrand();
    showBrandByPage(0);

    $("#saveBtnInBrandMaster").click(function() {
      
      var BrandMasterSaveType = $(this).data("brand-save-type");
      if(BrandMasterSaveType == "edit") {
          brandMasterUrl = url + "BrandMasterController/updateBrandMaster";
      } else {
          brandMasterUrl = url + "BrandMasterController/saveBrandMaster";
      }

    	$.ajax({
            type: 'POST',
            url: brandMasterUrl,
            data: $("#brandMasterForm").serialize(),
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInBrandMaster").hide();
              $('#brand-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              console.log(obj);
              $('#brand-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInBrandMaster").show();
              if(obj.status) {
              	$("#brandMasterForm")[0].reset();
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

    $("#brandListNext").click(function(){
        showBrandByPage(brandListNext);
        brandListNextBtnPress = true;
        brandListPreviousBtnPress = false;
    });

    $("#brandListPrevious").click(function(){
        showBrandByPage(brandListPrevious);
        brandListNextBtnPress = false;
        brandListPreviousBtnPress = true;
    });

    $("#brandListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        showBrandByPage(0);
    });
  
    $(document).on('click', '.brandMasterEditBtn', function(){ 
        var brandData = [$(this).data('brand-id'), $(this).data('brand-desc')];
        getBrandById(brandData);
    });

    function getBrandById(brandData) {
      $("#saveBtnInBrandMaster").data("brand-save-type", "edit");
      $("#brandMasterId").val(brandData[0])
      $("#brandMasterDesc").val(brandData[1]);
      $("#brand-master").modal('show');
    }

    function showBrandByPage(offset) {
      $.ajax({
            type: 'GET',
            url: url + "BrandMasterController/getAllBrandList",
            data: {offset: offset, searchKey: $("#brandListSearch").val()},
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get Brand list call..');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!jQuery.isEmptyObject(obj)){
                $('#brand_list_panel').empty();
                $("#brand_list_templete").tmpl(obj).appendTo("#brand_list_panel");
                if(brandListNextBtnPress) {
                  brandListPrevious = brandListNext;
                  brandListNext=brandListNext + initialOffset;
                  $("#brandListNext").show();
                  $("#brandListPrevious").hide();
                }
                if(brandListPreviousBtnPress) {
                  brandListPrevious = 0;
                  brandListNext = initialOffset;
                  $("#brandListNext").show();
                  $("#brandListPrevious").hide();
                }
                console.log('Get brand list call completed..');
              }else {
                if(brandListNextBtnPress) {
                  brandListNext = brandListNext - initialOffset;
                  brandListPrevious= brandListNext;
                  $("#brandListNext").hide();
                  $("#brandListPrevious").show();
                }
                if(brandListPreviousBtnPress) {
                  brandListPrevious = 0;
                  brandListNext = initialOffset;
                  $("#brandListNext").show();
                  $("#brandListPrevious").hide();
                }
                $('#brand_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            } 
            },
            error:function(){
              // failed request; give feedback to user
              console.log('Get Brand list call has completed with error..');
            }
          });
    }

});