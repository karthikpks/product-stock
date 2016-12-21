$(function() {
    "use strict";
    
    var url = "http://localhost:8888/productstock/";
    
    //get list of category 
    showCategory();

    $("#saveBtnInCategoryMaster").click(function() {
    	$.ajax({
            type: 'POST',
            url: url + "CategoryMasterController/saveCategoryMaster",
            data: $("#categoryMasterForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#saveBtnInCategoryMaster").hide();
              $('#category-master-ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $('#category-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInCategoryMaster").show();
              if(obj.id) {
              	$("#categoryMasterForm")[0].reset();
              	$('#subMainCategory').append($('<option>', {
        				    value: obj.id,
        				    text: obj.value
        				}));
        				$('#subTwoMainCategory').append($('<option>', {
                    value: obj.id,
                    text: obj.value
                }));
                $('#modelMasterProductCategory').append($('<option>', {
                    value: obj.id,
                    text: obj.value
                }));
                $('#productMasterProductCategory').append($('<option>', {
        				    value: obj.id,
        				    text: obj.value
        				}));
              } 
            },
            error:function(){
              // failed request; give feedback to user
              $('#category-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInCategoryMaster").show();
            }
          });
    });

    function showCategory() {
    	$.ajax({
            type: 'GET',
            url: url + "CategoryMasterController/getCategoryList",
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get Category list call..');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $.each(obj, function (i, item) {
    				    $('#subMainCategory').append($('<option>', { 
    				        value: item.pc_id,
    				        text : item.pc_desc 
    				    }));
    				    $('#subTwoMainCategory').append($('<option>', {
                    value: item.pc_id,
                    text: item.pc_desc
                }));
                $('#modelMasterProductCategory').append($('<option>', {
                    value: item.pc_id,
                    text: item.pc_desc
                }));
                console.log("show category");
                $('#productMasterProductCategory').append($('<option>', {
      					    value: item.pc_id,
      					    text: item.pc_desc
      					}));
      				});
              console.log('Get Category list call completed..');
            },
            error:function(){
              // failed request; give feedback to user
				console.log('Get Category list call has completed with error..');
            }
          });
    }

    $("#saveBtnInSubCategoryMaster").click(function() {
    	$.ajax({
            type: 'POST',
            url: url + "CategoryMasterController/saveSubCategoryMaster",
            data: $("#subCategoryMasterForm").serialize(),
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInSubCategoryMaster").hide();
              $('#category-master-ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $('#category-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInSubCategoryMaster").show();
              if(obj.status) {
              	$("#subCategoryMasterForm")[0].reset();
              }
            },
            error:function() {
              // failed request; give feedback to user
              $('#category-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInSubCategoryMaster").show();
            }
          });
    });

  	$("#subTwoMainCategory").change(function(){
    	showSubCategory($(this).val());
    });

    function showSubCategory(subMainCategoryValue) {
    	$.ajax({
            type: 'GET',
            url: url + "CategoryMasterController/getSubCategoryList",
            data: {'category' : subMainCategoryValue},
            beforeSend:function(){
              // this is where we append a loading image
              console.log('Get Sub-Category list call..');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              //remove existing category
              $('#subTwoCategory')
    			    .find('option')
    			    .remove()
    			    .end()
    			    .append('<option value="0">Select category</option>')

              $.each(obj, function (i, item) {
      				    $('#subTwoCategory').append($('<option>', {
      					    value: item.psc_id,
      					    text: item.psc_desc
      					}));
      				});
              console.log('Get Sub-Category list call completed..');
            },
            error:function(){
              // failed request; give feedback to user
				console.log('Get Sub-Category list call has completed with error..');
            }
          });
    }

    $("#saveBtnInSubTwoCategoryMaster").click(function() {
    	$.ajax({
            type: 'POST',
            url: url + "CategoryMasterController/saveSubTwoCategoryMaster",
            data: $("#subTwoCategoryMasterForm").serialize(),
            beforeSend:function() {
              // this is where we append a loading image
              $("#saveBtnInSubTwoCategoryMaster").hide();
              $('#category-master-ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data) {
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              console.log(obj);
              $('#category-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInSubTwoCategoryMaster").show();
              if(obj.status) {
              	$("#subTwoCategoryMasterForm")[0].reset();
              }
            },
            error:function() {
              // failed request; give feedback to user
              $('#category-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInSubTwoCategoryMaster").show();
            }
          });
    });
});