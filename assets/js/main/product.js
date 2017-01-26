$(function() {
    "use strict";
    
    var url = "http://localhost:8888/product-stock/";
    var imageData="";
    var initialOffset = 10;
    var productListPrevious = 0;
    var productListNext = initialOffset;
    var productListNextBtnPress = false;
    var productListPreviousBtnPress = false;
    var productMasterUrl;

    showProductByPage(0);

    $("#productImage").change(function(){
      previewFile();
    });

    $("form#productMasterForm").submit(function(e) {
      e.preventDefault();

      var ProductMasterSaveType = $("#saveBtnInProductMaster").data("product-save-type");
      if(ProductMasterSaveType == "edit") {
          productMasterUrl = url + "ProductMasterController/updateProductMaster";
      } else {
          productMasterUrl = url + "ProductMasterController/saveProductMaster";
      }

      var productMasterProductCategory = $('#productMasterProductCategory').val();
      var productMasterproduct = $("#productMasterproduct").val();
      var productMasterCapacity = $("#productMasterCapacity").val();
      var productMasterModel = $("#productMasterModel").val();
      var productMasterTitle = $("#productMasterTitle").val();
      var productMasterDesc = $("#productMasterDesc").val();
       var formData = new FormData($(this)[0]);

      $.ajax({
            type: 'POST',
            url: productMasterUrl,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInProductMaster").hide();
              $('#product-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              console.log(obj);
              $('#product-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInProductMaster").show();
            },
            error:function() {
              // failed request; give feedback to user
              $('#product-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInProductMaster").show();
            }
          });
    });

    $("#productListNext").click(function(){
        showProductByPage(productListNext);
        productListNextBtnPress = true;
        productListPreviousBtnPress = false;
    });

    $("#productListPrevious").click(function(){
        showProductByPage(productListPrevious);
        productListNextBtnPress = false;
        productListPreviousBtnPress = true;
    });

    $("#productListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        showProductByPage(0);
    });
  
    $(document).on('click', '.productMasterEditBtn', function(){ 
        var productData = [$(this).data('product-id'), $(this).data('pc-id'), 
                            $(this).data('brand-id'), $(this).data('cp-id'), $(this).data('md-id'),
                            $(this).data('product-title'), $(this).data('product-desc'), $(this).data('product-image-id'),$(this).data('product-image-src')];
        getProductById(productData);
    });

    function getProductById(productData) {
      $("#saveBtnInProductMaster").data("product-save-type", "edit");
      $("#productMasterId").val(productData[0]);
      $("#productMasterProductCategory").val(productData[1]).prop('selected', true);
      $("#productMasterBrand").val(productData[2]).prop('selected', true);
      $("#productMasterCapacity").val(productData[3]).prop('selected', true);
      $("#productMasterModel").val(productData[4]).prop('selected', true);
      $("#productMasterTitle").val(productData[5]);
      $("#productMasterDesc").val(productData[6]);
      $("#imageProduct").attr('src', productData[8]);
      $("#product-master").modal('show');
    }

    function showProductByPage(offset) {
      $.ajax({
            type: 'GET',
            url: url + "productMasterController/getAllProductList",
            data: {offset: offset, searchKey: $("#productListSearch").val()},
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get product list call..');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!jQuery.isEmptyObject(obj)){
                $('#product_list_panel').empty();
                $("#product_list_templete").tmpl(obj).appendTo("#product_list_panel");
                if(productListNextBtnPress) {
                  productListPrevious = productListNext;
                  productListNext=productListNext + initialOffset;
                  $("#productListNext").show();
                  $("#productListPrevious").hide();
                }
                if(productListPreviousBtnPress) {
                  productListPrevious = 0;
                  productListNext = initialOffset;
                  $("#productListNext").show();
                  $("#productListPrevious").hide();
                }
                console.log('Get product list call completed..');
              }else {
                if(productListNextBtnPress) {
                  productListNext = productListNext - initialOffset;
                  productListPrevious= productListNext;
                  $("#productListNext").hide();
                  $("#productListPrevious").show();
                }
                if(productListPreviousBtnPress) {
                  productListPrevious = 0;
                  productListNext = initialOffset;
                  $("#productListNext").show();
                  $("#productListPrevious").hide();
                }
                $('#product_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            } 
            },
            error:function(){
              // failed request; give feedback to user
              console.log('Get product list call has completed with error..');
            }
          });
    }

    function previewFile() {

      var preview = document.querySelector('#imageProduct');
      var file    = document.querySelector('input[type=file]').files[0];
      var reader  = new FileReader();

      reader.addEventListener("load", function () {
        imageData = reader.result;
        preview.src = reader.result;

      }, false);

      if (file) {
        console.log(file);
        reader.readAsDataURL(file);
      }
    }
});