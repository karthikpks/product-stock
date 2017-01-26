$(function() {
    "use strict";
    
    var url = "http://localhost:8888/product-stock/";
    var categoryMasterUrl;
    var categorySubMasterUrl;
    var categorySubTwoMasterUrl;

    var initialOffset = 10;
    
    var categoryListPrevious = 0;
    var categoryListNext = initialOffset;
    var categoryListNextBtnPress = false;
    var categoryListPreviousBtnPress = false;

    var categorySubListPrevious = 0;
    var categorySubListNext = initialOffset;
    var categorySubListNextBtnPress = false;
    var categorySubListPreviousBtnPress = false;

    var categorySubTwoListPrevious = 0;
    var categorySubTwoListNext = initialOffset;
    var categorySubTwoListNextBtnPress = false;
    var categorySubTwoListPreviousBtnPress = false;

    var categorySubTwoData;
    //get list of category 
    showCategory();
    showCategoryByPage(0);
    showSubCategoryByPage(0);
    showSubTwoCategoryByPage(0);
    
    // Category Master 
    $("#categoryListNext").click(function(){
        showCategoryByPage(categoryListNext);
        categoryListNextBtnPress = true;
        categoryListPreviousBtnPress = false;
    });

    $("#categoryListPrevious").click(function(){
        showCategoryByPage(categoryListPrevious);
        categoryListNextBtnPress = false;
        categoryListPreviousBtnPress = true;
    });

    $("#categoryListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        showCategoryByPage(0);
    });

    $(document).on('click', '.categoryMasterEditBtn', function(){
         var categoryData = [$(this).data('categoryId'), $(this).data('categoryDesc')];
         getCategoryById(categoryData);
    });

    function getCategoryById(categoryData) {
      $("#productSubTwoCategoryModel").hide();
      $("#productSubCategoryModel").hide();
      $("#categoryMasterId").val(categoryData[0]);
      $("#categoryMasterDesc").val(categoryData[1]);
      $("#saveBtnInCategoryMaster").data('categorysavetype', 'edit');
      $("#category-master").modal('show');
    }

    $("#closeBtnInCategoryMaster").click(function() {
        if(!$('#productCategoryModel').is(':visible'))
        {  
           $("#productCategoryModel").show('slow');     
        }
        if(!$('#productSubTwoCategoryModel').is(':visible'))
        {  
           $("#productSubTwoCategoryModel").show('slow');     
        }
        if(!$('#productSubCategoryModel').is(':visible'))
        {  
           $("#productSubCategoryModel").show('slow');     
        }
    })

    $("#saveBtnInCategoryMaster").click(function() {
      var CategoryMasterSaveType = $("#saveBtnInCategoryMaster").data("categorysavetype");

      if(CategoryMasterSaveType == "edit") {
            categoryMasterUrl = url + "CategoryMasterController/updateCategoryMaster";
        } else {
            categoryMasterUrl = url + "CategoryMasterController/saveCategoryMaster";
        }

    	$.ajax({
            type: 'POST',
            url: categoryMasterUrl,
            data: $("#categoryMasterForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#saveBtnInCategoryMaster").hide();
              $('#category-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
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

    function showCategoryByPage(offset) {
      $.ajax({
            type: 'GET',
            url: url + "CategoryMasterController/getCategoryByPageList",
            data: {offset: offset, searchKey: $("#categoryListSearch").val()},
            beforeSend:function(){
              // this is where we append a loading image
              $('#category_list_panel').html('<tr> <td colspan="6">Loading...</td> </tr>');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!jQuery.isEmptyObject(obj)) {
                 $('#category_list_panel').empty();
                 $("#category_list_templete").tmpl(obj).appendTo("#category_list_panel");

                if(categoryListNextBtnPress) {
                  categoryListPrevious = categoryListNext;
                  categoryListNext=categoryListNext + initialOffset;
                  $("#categoryListNext").show();
                  $("#categoryListPrevious").hide();
                }
                if(categoryListPreviousBtnPress) {
                  categoryListPrevious = 0;
                  categoryListNext = initialOffset;
                  $("#categoryListNext").show();
                  $("#categoryListPrevious").hide();
                }
              } else {
                if(categoryListNextBtnPress) {
                  categoryListNext = categoryListNext - initialOffset;
                  categoryListPrevious= categoryListNext;
                  $("#categoryListNext").hide();
                  $("#categoryListPrevious").show();
                }
                if(categoryListPreviousBtnPress) {
                  categoryListPrevious = 0;
                  categoryListNext = initialOffset;
                  $("#categoryListNext").show();
                  $("#categoryListPrevious").hide();
                }
                $('#category_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            }
            },
            error:function(){
              // failed request; give feedback to user
              $('#category_list_panel').html('<tr> <td colspan="6" class="error"><strong>Oops!</strong> Try that again in a few moments.</td> </tr>');
            }
          });
    }

    //sub category list
    $("#saveBtnInSubCategoryMaster").click(function() {

      var CategorySubMasterSaveType = $(this).data("category-sub-save-type");

      if(CategorySubMasterSaveType == "edit") {
            categorySubMasterUrl = url + "CategoryMasterController/updateSubCategoryMaster";
        } else {
            categorySubMasterUrl = url + "CategoryMasterController/saveSubCategoryMaster";
        }

    	$.ajax({
            type: 'POST',
            url: categorySubMasterUrl,
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

    $("#categorySubListNext").click(function(){
        showSubCategoryByPage(categorySubListNext);
        categorySubListNextBtnPress = true;
        categorySubListPreviousBtnPress = false;
    });

    $("#categorySubListPrevious").click(function(){
        showSubCategoryByPage(categorySubListPrevious);
        categorySubListNextBtnPress = false;
        categorySubListPreviousBtnPress = true;
    });

    $("#categorySubListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        showSubCategoryByPage(0);
    });

    $(document).on('click', '.categorySubMasterEditBtn', function(){
         var categorySubData = [$(this).data('category-sub-id'), $(this).data('category-id'), $(this).data('category-sub-desc') ];
         getCategorySubById(categorySubData);
    });

    function getCategorySubById(categorySubData) {
      $("#productSubTwoCategoryModel").hide();
      $("#productCategoryModel").hide();
      $("#categorySubMasterId").val(categorySubData[0]);
      $('#subMainCategory').val(categorySubData[1]).prop('selected', true);
      $("#subCategory").val(categorySubData[2]);
      $("#saveBtnInSubCategoryMaster").data('category-sub-save-type', 'edit');
      $("#category-master").modal('show');
    }

    function showSubCategoryByPage(offset) {
      $.ajax({
            type: 'GET',
            url: url + "CategoryMasterController/getSubCategoryByPageList",
            data: {offset: offset, searchKey: $("#categorySubListSearch").val()},
            beforeSend:function(){
              // this is where we append a loading image
              $('#category_sub_list_panel').html('<tr> <td colspan="6">Loading...</td> </tr>');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!jQuery.isEmptyObject(obj)) {
                 $('#category_sub_list_panel').empty();
                 $("#category_sub_list_templete").tmpl(obj).appendTo("#category_sub_list_panel");

                if(categorySubListNextBtnPress) {
                  categorySubListPrevious = categorySubListNext;
                  categorySubListNext=categorySubListNext + initialOffset;
                  $("#categorySubListNext").show();
                  $("#categorySubListPrevious").hide();
                }
                if(categorySubListPreviousBtnPress) {
                  categorySubListPrevious = 0;
                  categorySubListNext = initialOffset;
                  $("#categorySubListNext").show();
                  $("#categorySubListPrevious").hide();
                }
              } else {
                if(categorySubListNextBtnPress) {
                  categorySubListNext = categorySubListNext - initialOffset;
                  categorySubListPrevious= categorySubListNext;
                  $("#categorySubListNext").hide();
                  $("#categorySubListPrevious").show();
                }
                if(categorySubListPreviousBtnPress) {
                  categorySubListPrevious = 0;
                  categorySubListNext = initialOffset;
                  $("#categorySubListNext").show();
                  $("#categorySubListPrevious").hide();
                }
                $('#category_sub_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            }
            },
            error:function(){
              // failed request; give feedback to user
              $('#category_sub_list_panel').html('<tr> <td colspan="6" class="error"><strong>Oops!</strong> Try that again in a few moments.</td> </tr>');
            }
          });
    }

    // sub two category

    $("#categorySubTwoListNext").click(function(){
        showSubTwoCategoryByPage(categorySubTwoListNext);
        categorySubTwoListNextBtnPress = true;
        categorySubTwoListPreviousBtnPress = false;
    });

    $("#categorySubTwoListPrevious").click(function(){
        showSubTwoCategoryByPage(categorySubTwoListPrevious);
        categorySubTwoListNextBtnPress = false;
        categorySubTwoListPreviousBtnPress = true;
    });

    $("#categorySubTwoListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        showSubTwoCategoryByPage(0);
    });

    $(document).on('click', '.categorySubTwoMasterEditBtn', function(){
        categorySubTwoData = [$(this).data('category-sub-two-id'), $(this).data('category-id'), $(this).data('category-sub-id'), $(this).data('category-sub-two-desc') ];
        getCategorySubTwoById();
    });

    function getCategorySubTwoById() {
      $("#productSubCategoryModel").hide();
      $("#productCategoryModel").hide();
      $("#categorySubTwoMasterId").val(categorySubTwoData[0]);
      $('#subTwoMainCategory').val(categorySubTwoData[1]).prop('selected', true);
      $("#subTwoCategory").val(categorySubTwoData[2]).prop('selected', true);
      showSubCategory(categorySubTwoData[2]);
      $("#subThreeCategory").val(categorySubTwoData[3]).prop('selected', true);
      $("#saveBtnInSubTwoCategoryMaster").data('category-sub-two-save-type', 'edit');
      $("#category-master").modal('show');
    }

    function showSubTwoCategoryByPage(offset) {
      $.ajax({
            type: 'GET',
            url: url + "CategoryMasterController/getSubTwoCategoryByPageList",
            data: {offset: offset, searchKey: $("#categorySubTwoListSearch").val()},
            beforeSend:function(){
              // this is where we append a loading image
              $('#category_sub_two_list_panel').html('<tr> <td colspan="6">Loading...</td> </tr>');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!jQuery.isEmptyObject(obj)) {
                 $('#category_sub_two_list_panel').empty();
                 $("#category_sub_two_list_templete").tmpl(obj).appendTo("#category_sub_two_list_panel");

                if(categorySubTwoListNextBtnPress) {
                  categorySubTwoListPrevious = categorySubTwoListNext;
                  categorySubTwoListNext=categorySubTwoListNext + initialOffset;
                  $("#categorySubTwoListNext").show();
                  $("#categorySubTwoListPrevious").hide();
                }
                if(categorySubTwoListPreviousBtnPress) {
                  categorySubTwoListPrevious = 0;
                  categorySubTwoListNext = initialOffset;
                  $("#categorySubTwoListNext").show();
                  $("#categorySubTwoListPrevious").hide();
                }
              } else {
                if(categorySubTwoListNextBtnPress) {
                  categorySubTwoListNext = categoryListNext - initialOffset;
                  categorySubTwoListPrevious= categorySubTwoListNext;
                  $("#categorySubTwoListNext").hide();
                  $("#categorySubListPrevious").show();
                }
                if(categorySubTwoListPreviousBtnPress) {
                  categorySubTwoListPrevious = 0;
                  categorySubTwoListNext = initialOffset;
                  $("#categorySubTwoListNext").show();
                  $("#categorySubTwoListPrevious").hide();
                }
                $('#category_sub_two_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            }
            },
            error:function(){
              // failed request; give feedback to user
              $('#category_sub_two_list_panel').html('<tr> <td colspan="6" class="error"><strong>Oops!</strong> Try that again in a few moments.</td> </tr>');
            }
          });
    }


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
              console.log(obj);

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

      var CategorySubTwoMasterSaveType = $(this).data("category-sub-two-save-type");

        if(CategorySubTwoMasterSaveType == "edit") {
            CategorySubTwoMasterSaveType = url + "CategoryMasterController/updateSubTwoCategoryMaster";
        } else {
            CategorySubTwoMasterSaveType = url + "CategoryMasterController/saveSubTwoCategoryMaster";
        }

    	$.ajax({
            type: 'POST',
            url: CategorySubTwoMasterSaveType,
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