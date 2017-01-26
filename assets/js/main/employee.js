$(function() {
    "use strict";

     var url = "http://localhost:8888/product-stock/";

    var initialOffset = 10;
    var employeeListPrevious = 0;
    var employeeListNext = initialOffset;
    var employeeListNextBtnPress = false;
    var employeeListPreviousBtnPress = false;
    
    //page initial call
    getEmployeeMasterList(0);

    // Customer Master 
    $("#employeeListNext").click(function(){
        getEmployeeMasterList(employeeListNext);
        employeeListNextBtnPress = true;
        employeeListPreviousBtnPress = false;
    });

    $("#employeerListPrevious").click(function(){
        getEmployeeMasterList(employeeListPrevious);
        employeeListNextBtnPress = false;
        cemployeeListPreviousBtnPress = true;
    });

    $("#employeeListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        getEmployeeMasterList(0);
    });

    $(document).on('click', '.employeeMasterEditBtn', function(){
         getEmployeeMasterListById($(this).data('employeeId'));
    });

    $("#saveBtnInEmployeeMaster").click(function() {
      var employeeMasterUrl;
      var EmployeeMasterSaveType = $("#saveBtnInEmployeeMaster").data("employeemaster");
      if(EmployeeMasterSaveType == "edit") {
            employeeMasterUrl = url + "EmployeeMasterController/updateEmployeeMasterDetails";
        } else {
            employeeMasterUrl = url + "EmployeeMasterController/saveEmployeeMasterDetails";
        }

    	$.ajax({
            type: 'POST',
            url: employeeMasterUrl,
            data: $("#employeeMasterForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#saveBtnInEmployeeMaster").hide();
              $("#closeBtnInEmployeeMaster").hide();
              $('#employee-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $('#employee-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();
              $("#saveBtnInEmployeeMaster").show();
              $("#closeBtnInEmployeeMaster").show();
              if(EmployeeMasterSaveType != "edit") {
                $("#employeeMasterForm")[0].reset();
              }
            },
            error:function(){
              // failed request; give feedback to user
              $('#employee-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInEmployeeMaster").show();
              $("#closeBtnInEmployeeMaster").show();
            }
          });
    });

    function getEmployeeMasterList(offset) {
        $.ajax({
          type: 'POST',
          url: './EmployeeMasterController/getAllEmployeeList',
          data: {offset: offset, searchKey: $("#employeeListSearch").val()},
          beforeSend:function(){
            // this is where we append a loading image
            $('#employee_list_panel').html('<tr> <td colspan="6">Loading...</td> </tr>');
          },
          success:function(data){
            // successful request; do something with the data
            var obj = jQuery.parseJSON(data);
            if(!jQuery.isEmptyObject(obj)){
              $('#employee_list_panel').empty();
              $("#employee_list_templete").tmpl(obj).appendTo("#employee_list_panel");
              if(employeeListNextBtnPress) {
                  employeeListPrevious = employeeListNext;
                  employeeListNext=employeeListNext + initialOffset;
                  $("#employeeListNext").show();
                  $("#employeeListPrevious").hide();
                }
                if(employeeListPreviousBtnPress) {
                  employeeListPrevious = 0;
                  employeeListNext = initialOffset;
                  $("#employeeListNext").show();
                  $("#employeeListPrevious").hide();
                }
            } else {
                if(employeeListNextBtnPress) {
                  employeeListNext = employeeListNext - initialOffset;
                  employeeListPrevious= employeeListNext;
                  $("#employeeListNext").hide();
                  $("#employeeListPrevious").show();
                }
                if(employeeListPreviousBtnPress) {
                  employeeListPrevious = 0;
                  employeeListNext = initialOffset;
                  $("#employeeListNext").show();
                  $("#employeeListPrevious").hide();
                }
                $('#employee_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            }  
          },
          error:function(){
            // failed request; give feedback to user
            $('#employee_list_panel').html('<tr> <td colspan="6" class="error"><strong>Oops!</strong> Try that again in a few moments.</td> </tr>');
          }
        });
    }

    function getEmployeeMasterListById(crmId) {
        $.ajax({
          type: 'POST',
          url: './customerController/getCustomerDetailById',
          data: {crmId: crmId},
          beforeSend:function(){
            $('#employee-master-ajax-panel').html('<p> Loading.. </p>');
          },
          success:function(data){
            // successful request; do something with the data
            var obj = jQuery.parseJSON(data);
            if(!jQuery.isEmptyObject(obj)){
                console.log(obj);
                $('#employee-master-ajax-panel').empty();
                $("#saveBtnInEmployeeMaster").data('employeemaster', 'edit');
                $("#employeeId").val(obj.crm_id);
                $("#employeeMasterName").val(obj.crm_name);
                $("#employeeMasterLastName").val(obj.crm_last_name);
                $('select[name^="employeeMasterGender"]').val(obj.crm_gender);
                $("#employeeMasterDOB").val(obj.crm_dob);
                $("#employeeMasterAddressOne").val(obj.crm_address_1);
                $("#employeeMasterAddressTwo").val(obj.crm_address_2);
                $("#employeeMasterAddressThree").val(obj.crm_address_3);
                $("#employeeMasterPinCode").val(obj.crm_pincode);
                $("#employeeMasterMobileNo").val(obj.crm_mobile_number);
                $("#employeeMasterEmailId").val(obj.crm_email_id);
                $("#employeeMasterUserRole").val(obj.crm_user_type).prop("select", true);
                $("#employee-master").modal('show');
            } else {
                $('#employee-master-ajax-panel').html('<p> <strong>Oops!</strong> Try that again in a few moments. </p>');
            }  
          },
          error:function(){
            $('#employee-master-ajax-panel').html('<p> <strong>Oops!</strong> Try that again in a few moments. </p>');
          }
        });
    }

});
