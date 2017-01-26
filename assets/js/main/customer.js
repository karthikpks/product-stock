/*
 * Author: Karthik Pks
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function() {
    "use strict";
    
    var url = "http://localhost:8888/product-stock/";

    var initialOffset = 10;
    var customerListPrevious = 0;
    var customerListNext = initialOffset;
    var customerListNextBtnPress = false;
    var customerListPreviousBtnPress = false;
    
    //page initial call
    getCustomerMasterList(0);

    // Customer Master 
    $("#customerListNext").click(function(){
        getCustomerMasterList(customerListNext);
        customerListNextBtnPress = true;
        customerListPreviousBtnPress = false;
    });

    $("#customerListPrevious").click(function(){
        getCustomerMasterList(customerListPrevious);
        customerListNextBtnPress = false;
        customerListPreviousBtnPress = true;
    });

    $("#customerListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        getCustomerMasterList(0);
    });
    
    $("#create-customer-master").click(function(){
        $("#customerForm")[0].reset();
    });

    $(document).on('click', '.customerMasterEditBtn', function(){ 
         getCustomerMasterListById($(this).data('customerId'));
    });

    $("#saveBtnInCustomerMaster").click(function() {
        var customerMasterUrl = url;
        var CustomerMasterSaveType = $("#saveBtnInCustomerMaster").data("customermaster");
        var customerFirstName = $("#customerFirstName").val();
        var customerLastName = $("#customerLastName").val();
        var customerGender = $('select[name^="customerGender"]').val();
        var customerDob = $("#customerDob").val();
        var addressOneInCustomerMaster = $("#addressOneInCustomerMaster").val();
        var addressTwoInCustomerMaster = $("#addressTwoInCustomerMaster").val();
        var addressThreeInCustomerMaster = $("#addressThreeInCustomerMaster").val();
        var pinCodeInCustomerMaster = $("#pinCodeInCustomerMaster").val();
        var mobileNumberInCustomerMaster = $("#mobileNumberInCustomerMaster").val();
        var emailIdInCustomerMaster = $("#emailIdInCustomerMaster").val(); 

        if(CustomerMasterSaveType == "edit") {
            customerMasterUrl = customerMasterUrl + "CustomerController/updateCustomerDetail";
        } else {
            customerMasterUrl = customerMasterUrl + "CustomerController/saveCustomerDetail";
        }

        $.ajax({
            type: 'POST',
            url: customerMasterUrl,
            data: $("#customerForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#saveBtnInCustomerMaster").hide();
              $("#closeBtnInCustomerMaster").hide();
              $('#customer-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $('#customer-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();;
              $("#saveBtnInCustomerMaster").show();
              $("#closeBtnInCustomerMaster").show();
            },
            error:function(){
              // failed request; give feedback to user
              $('#customer-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInCustomerMaster").show();
              $("#closeBtnInCustomerMaster").show();
            }
          });

    });

    function getCustomerMasterListById(crmId) {
        $.ajax({
          type: 'POST',
          url: './customerController/getCustomerDetailById',
          data: {crmId: crmId},
          beforeSend:function(){
            $('#customer-master-ajax-panel').html('<p> Loading.. </p>');
          },
          success:function(data){
            // successful request; do something with the data
            var obj = jQuery.parseJSON(data);
            if(!jQuery.isEmptyObject(obj)){
                console.log(obj);
                $('#customer-master-ajax-panel').empty();
                $("#saveBtnInCustomerMaster").data('customermaster', 'edit');
                $("#customerId").val(obj.crm_id);
                $("#customerFirstName").val(obj.crm_name);
                $("#customerLastName").val(obj.crm_last_name);
                $('select[name^="customerGender"]').val(obj.crm_gender);
                $("#customerDob").val(obj.crm_dob);
                $("#addressOneInCustomerMaster").val(obj.crm_address_1);
                $("#addressTwoInCustomerMaster").val(obj.crm_address_2);
                $("#addressThreeInCustomerMaster").val(obj.crm_address_3);
                $("#pinCodeInCustomerMaster").val(obj.crm_pincode);
                $("#mobileNumberInCustomerMaster").val(obj.crm_mobile_number);
                $("#emailIdInCustomerMaster").val(obj.crm_email_id);
                $("#customer-master").modal('show');
            } else {
                $('#customer-master-ajax-panel').html('<p> <strong>Oops!</strong> Try that again in a few moments. </p>');
            }  
          },
          error:function(){
            $('#customer-master-ajax-panel').html('<p> <strong>Oops!</strong> Try that again in a few moments. </p>');
          }
        });
    }

    function getCustomerMasterList(offset) {
        $.ajax({
          type: 'POST',
          url: './CustomerController/getAllCustomerList',
          data: {offset: offset, searchKey: $("#customerListSearch").val()},
          beforeSend:function(){
            // this is where we append a loading image
            $('#customer_list_panel').html('<tr> <td colspan="6">Loading...</td> </tr>');
          },
          success:function(data){
            // successful request; do something with the data
            var obj = jQuery.parseJSON(data);
            if(!jQuery.isEmptyObject(obj)){
              $('#customer_list_panel').empty();
              $("#customer_list_templete").tmpl(obj).appendTo("#customer_list_panel");
              if(customerListNextBtnPress) {
                  customerListPrevious = customerListNext;
                  customerListNext=customerListNext + initialOffset;
                  $("#customerListNext").show();
                  $("#customerListPrevious").hide();
                }
                if(customerListPreviousBtnPress) {
                  customerListPrevious = 0;
                  customerListNext = initialOffset;
                  $("#customerListNext").show();
                  $("#customerListPrevious").hide();
                }
            } else {
                if(customerListNextBtnPress) {
                  customerListNext = customerListNext - initialOffset;
                  customerListPrevious= customerListNext;
                  $("#customerListNext").hide();
                  $("#customerListPrevious").show();
                }
                if(customerListPreviousBtnPress) {
                  customerListPrevious = 0;
                  customerListNext = initialOffset;
                  $("#customerListNext").show();
                  $("#customerListPrevious").hide();
                }
                $('#customer_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            }  
          },
          error:function(){
            // failed request; give feedback to user
            $('#customer_list_panel').html('<tr> <td colspan="6" class="error"><strong>Oops!</strong> Try that again in a few moments.</td> </tr>');
          }
        });
    }

    /*$("#saveBtnInCustomerMaster").click(function (event) {
        $.ajax({
            type: 'POST',
            url: './customerController/',
            data: $("#customerForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#saveBtnInCustomerMaster").hide();
              $("#closeBtnInCustomerMaster").hide();
              $('#ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              $('#ajax-panel').html(data);
              $("#saveBtnInCustomerMaster").show();
              $("#closeBtnInCustomerMaster").show();
            },
            error:function(){
              // failed request; give feedback to user
              $('#ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInCustomerMaster").show();
              $("#closeBtnInCustomerMaster").show();
            }
          });
    }); */

    // End Customer Master 
});

