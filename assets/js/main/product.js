$(function() {
    "use strict";
    
    var url = "http://localhost:8888/productstock/";
    var imageData="";
    $("#productImage").change(function(){
      previewFile();
    });

    $("#saveBtnInProductMaster").click(function() {

      var productMasterProductCategory = $('#productMasterProductCategory').val();
      var productMasterBrand = $("#productMasterBrand").val();
      var productMasterCapacity = $("#productMasterCapacity").val();
      var productMasterModel = $("#productMasterModel").val();
      var productMasterTitle = $("#productMasterTitle").val();
      var productMasterDesc = $("#productMasterDesc").val();

      $.ajax({
            type: 'POST',
            url: url + "ProductMasterController/saveProductMaster",
            data: {
                    "productMasterProductCategory":productMasterProductCategory, 
                    "productMasterBrand":productMasterBrand,
                    "productMasterCapacity":productMasterCapacity,
                    "productMasterModel":productMasterModel,
                    "productMasterTitle":productMasterTitle,
                    "productMasterDesc":productMasterDesc,
                    "imageData":imageData
                  },
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInProductMaster").hide();
              $('#product-master-ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
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