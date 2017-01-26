$(function() {
    "use strict";
     
    var url = "http://localhost:8888/product-stock/";
    var initialOffset = 10;
    var priceListPrevious = 0;
    var priceListNext = initialOffset;
    var priceListNextBtnPress = false;
    var priceListPreviousBtnPress = false;
    var priceMasterUrl;

    //showprice();
    showPriceByPage(0);
    
    $("#saveBtnInPriceMaster").click(function() {

      var priceMasterSaveType = $(this).data("price-save-type");
      console.log(priceMasterSaveType);
      if(priceMasterSaveType == "edit") {
          priceMasterUrl = url + "PriceMasterController/updatePriceMaster";
      } else {
          priceMasterUrl = url + "PriceMasterController/savePriceMaster";
      }

    	$.ajax({
            type: 'POST',
            url: priceMasterUrl,
            data: $("#priceMasterForm").serialize(),
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInPriceMaster").hide();
              $('#price-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              console.log(obj);
              $('#price-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInPriceMaster").show();
              if(obj.status) {
              	$("#priceMasterForm")[0].reset();
                /*$('#priceMasterpriceDes').append($('<option>', {
                    value: obj.id,
                    text: obj.value
                 }));*/
              }
            },
            error:function() {
              // failed request; give feedback to user
              $('#price-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInPriceMaster").show();
            }
          });
    });

    function showPrice() {
    	$.ajax({
            type: 'GET',
            url: url + "PriceMasterController/getPriceList",
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get price list call..');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $('#priceMasterpriceDes')
              .find('option')
              .remove()
              .end()
              .append('<option value="0">Select price</option>')

              $.each(obj, function (i, item) {
              $('#priceMasterpriceDes').append($('<option>', {
                  value: item.md_id,
                  text: item.md_desc
               }));
              });
              console.log('Get price list call completed..');
            },
            error:function(){
              // failed request; give feedback to user
				      console.log('Get price list call has completed with error..');
            }
          });
    }

    $("#priceListNext").click(function(){
        showPriceByPage(priceListNext);
        priceListNextBtnPress = true;
        priceListPreviousBtnPress = false;
    });

    $("#priceListPrevious").click(function(){
        showPriceByPage(priceListPrevious);
        priceListNextBtnPress = false;
        priceListPreviousBtnPress = true;
    });

    $("#priceListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        showPriceByPage(0);
    });
  
    $(document).on('click', '.priceMasterEditBtn', function() { 
        var priceData = [$(this).data('price-id'), $(this).data('model-id'), $(this).data('price-desc'), $(this).data('price'), $(this).data('price-from'), $(this).data('price-to')];
        getPriceById(priceData);
    });

    function getPriceById(priceData) {
      $("#saveBtnInPriceMaster").data("price-save-type", "edit");
      $("#priceMasterId").val(priceData[0]).prop('selected', true);
      $("#priceMasterModelDes").val(priceData[1])
      $("#priceMasterDesc").val(priceData[2]);
      $("#priceMasterValue").val(priceData[3]);
      $("#priceMasterFrom").val(priceData[4]);
      $("#priceMasterTo").val(priceData[5]);
      $("#price-master").modal('show');
    }

    function showPriceByPage(offset) {
      $.ajax({
            type: 'GET',
            url: url + "PriceMasterController/getAllPriceList",
            data: {offset: offset, searchKey: $("#priceListSearch").val()},
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get price list call..');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!jQuery.isEmptyObject(obj)){
                $('#price_list_panel').empty();
                $("#price_list_templete").tmpl(obj).appendTo("#price_list_panel");
                if(priceListNextBtnPress) {
                  priceListPrevious = priceListNext;
                  priceListNext=priceListNext + initialOffset;
                  $("#priceListNext").show();
                  $("#priceListPrevious").hide();
                }
                if(priceListPreviousBtnPress) {
                  priceListPrevious = 0;
                  priceListNext = initialOffset;
                  $("#priceListNext").show();
                  $("#priceListPrevious").hide();
                }
                console.log('Get price list call completed..');
              }else {
                if(priceListNextBtnPress) {
                  priceListNext = priceListNext - initialOffset;
                  priceListPrevious= priceListNext;
                  $("#priceListNext").hide();
                  $("#priceListPrevious").show();
                }
                if(priceListPreviousBtnPress) {
                  priceListPrevious = 0;
                  priceListNext = initialOffset;
                  $("#priceListNext").show();
                  $("#priceListPrevious").hide();
                }
                $('#price_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            } 
            },
            error:function(){
              // failed request; give feedback to user
              console.log('Get price list call has completed with error..');
            }
          });
    }
});