/*
 * Author: Karthik Pks
 * Date: 4 Jan 2014
 * Description:
 *      company master functionality
 **/

$(function() {
    "use strict";
    
    var url = "http://localhost:8888/product-stock/";

    var initialOffsetcompany = 10;
    var companyListPrevious = 0;
    var companyListNext = initialOffsetcompany;
    var companyListNextBtnPress = false;
    var companyListPreviousBtnPress = false;
    
    //page initial call
    getCompanyMasterList(0);

    // company Master 
    $("#companyListNext").click(function(){
        getCompanyMasterList(companyListNext);
        companyListNextBtnPress = true;
        companyListPreviousBtnPress = false;
    });

    $("#companyListPrevious").click(function(){
        getCompanyMasterList(companyListPrevious);
        companyListNextBtnPress = false;
        companyListPreviousBtnPress = true;
    });

    $("#companyListSearch").keyup(function(){
        $(this).css("color", "#f1f2f7");
        getCompanyMasterList(0);
    });
    
    $("#create-company-master").click(function(){
        $("#companyForm")[0].reset();
    });

    $(document).on('click', '.companyMasterEditBtn', function(){ 
         getCompanyMasterListById($(this).data('company-id'));
    });

    $("#saveBtnInCompanyMaster").click(function() {
        var companyMasterUrl = url;
        var companyMasterSaveType = $("#saveBtnInCompanyMaster").data("companymaster");
        console.log(companyMasterSaveType);
        var companyName = $("#companyName").val();
        var companyAddressOne = $("#companyAddressOne").val();
        var companyAddressTwo = $('companyAddressTwo').val();
        var companyAddressThree = $("#companyAddressThree").val();
        var companyTinNo = $("#companyTinNo").val();
        var companyServiceTaxNo = $("#companyServiceTaxNo").val();
        var companyMobileNo = $("#companyMobileNo").val();
        var companyMobileNoTwo = $("#companyMobileNoTwo").val();
        var companyLandlineNo = $("#companyLandlineNo").val();
        var companyContactPersion = $("#companyContactPersion").val(); 
        var companyEmailId = $("#companyEmailId").val(); 
        var companyWebsite = $("#companyWebsite").val(); 

        if(companyMasterSaveType == "edit") {
            companyMasterUrl = companyMasterUrl + "CompanyController/updateCompanyDetail";
        } else {
            companyMasterUrl = companyMasterUrl + "CompanyController/saveCompanyDetail";
        }

        $.ajax({
            type: 'POST',
            url: companyMasterUrl,
            data: $("#companyForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#saveBtnInCompanyMaster").hide();
              $("#closeBtnInCompanyMaster").hide();
              $('#company-master-ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              $('#company-master-ajax-panel').html(obj.message).show().delay(5000).fadeOut();;
              $("#saveBtnInCompanyMaster").show();
              $("#closeBtnInCompanyMaster").show();
            },
            error:function(){
              // failed request; give feedback to user
              $('#company-master-ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnInCompanyMaster").show();
              $("#closeBtnInCompanyMaster").show();
            }
          });

    });

    function getCompanyMasterListById(cmId) {
        $.ajax({
          type: 'POST',
          url: './companyController/getCompanyDetailById',
          data: {cmId: cmId},
          beforeSend:function(){
            $('#company-master-ajax-panel').html('<p> Loading.. </p>');
          },
          success:function(data){
            // successful request; do something with the data
            var obj = jQuery.parseJSON(data);
            if(!jQuery.isEmptyObject(obj)){
                console.log(obj);
                $('#company-master-ajax-panel').empty();
                $("#saveBtnInCompanyMaster").data('companymaster', 'edit');
                $("#companyId").val(obj.cm_id);
                $("#companyName").val(obj.cm_name);
                $("#companyAddressOne").val(obj.cm_address_1);
                $("#companyAddressTwo").val(obj.cm_address_2);
                $("#companyAddressThree").val(obj.cm_address_3);
                $("#companyTinNo").val(obj.cm_tin_no);
                $("#companyServiceTaxNo").val(obj.cm_service_tex_no);
                $("#companyMobileNo").val(obj.cm_mobile);
                $("#companyMobileNoTwo").val(obj.cm_mobile_no_2);
                $("#companyLandlineNo").val(obj.cm_landline);
                $("#companyContactPersion").val(obj.cm_contact_person);
                $("#companyEmailId").val(obj.cm_mail_id);
                $("#companyWebsite").val(obj.cm_website);
                $("#company-master").modal('show');
            } else {
                $('#company-master-ajax-panel').html('<p> <strong>Oops!</strong> Try that again in a few moments. </p>');
            }  
          },
          error:function(){
            $('#company-master-ajax-panel').html('<p> <strong>Oops!</strong> Try that again in a few moments. </p>');
          }
        });
    }

    function getCompanyMasterList(offset) {
        $.ajax({
          type: 'POST',
          url: './CompanyController/getAllCompanyList',
          data: {offset: offset, searchKey: $("#companyListSearch").val()},
          beforeSend:function(){
            // this is where we append a loading image
            $('#company_list_panel').html('<tr> <td colspan="6">Loading...</td> </tr>');
          },
          success:function(data){
            // successful request; do something with the data
            var obj = jQuery.parseJSON(data);
            if(!jQuery.isEmptyObject(obj)){
              $('#company_list_panel').empty();
              $("#company_list_templete").tmpl(obj).appendTo("#company_list_panel");
              if(companyListNextBtnPress) {
                  companyListPrevious = companyListNext;
                  companyListNext=companyListNext + initialOffsetcompany;
                  $("#companyListNext").show();
                  $("#companyListPrevious").hide();
                }
                if(companyListPreviousBtnPress) {
                  companyListPrevious = 0;
                  companyListNext = initialOffsetcompany;
                  $("#companyListNext").show();
                  $("#companyListPrevious").hide();
                }
            } else {
                if(companyListNextBtnPress) {
                  companyListNext = companyListNext - initialOffsetcompany;
                  companyListPrevious= companyListNext;
                  $("#companyListNext").hide();
                  $("#companyListPrevious").show();
                }
                if(companyListPreviousBtnPress) {
                  companyListPrevious = 0;
                  companyListNext = initialOffsetcompany;
                  $("#companyListNext").show();
                  $("#companyListPrevious").hide();
                }
                $('#company_list_panel').html('<tr> <td colspan="6">No Records found...</td> </tr>');
            }  
          },
          error:function(){
            // failed request; give feedback to user
            $('#company_list_panel').html('<tr> <td colspan="6" class="error"><strong>Oops!</strong> Try that again in a few moments.</td> </tr>');
          }
        });
    }

    /*$("#saveBtnIncompanyMaster").click(function (event) {
        $.ajax({
            type: 'POST',
            url: './companyController/',
            data: $("#companyForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#saveBtnIncompanyMaster").hide();
              $("#closeBtnIncompanyMaster").hide();
              $('#ajax-panel').html('<img src="http://localhost:8888/product-stock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              $('#ajax-panel').html(data);
              $("#saveBtnIncompanyMaster").show();
              $("#closeBtnIncompanyMaster").show();
            },
            error:function(){
              // failed request; give feedback to user
              $('#ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#saveBtnIncompanyMaster").show();
              $("#closeBtnIncompanyMaster").show();
            }
          });
    }); */

    // End company Master 
});

