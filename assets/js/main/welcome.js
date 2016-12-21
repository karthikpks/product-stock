/*
 * Author: Karthik Pks
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

$(function() {
    "use strict";
    var url = "http://localhost:8888/productstock/";

    $("#createBtnInWelcome").click(function (event) {
        $.ajax({
            type: 'POST',
            url: url + 'welcome/createCustomerForm/',
            data: $("#registerForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#createBtnInWelcome").hide();
              $('#ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(obj.status) {
                $('#ajax-panel').html(obj.message);
                $("#createBtnInWelcome").show();
              } else {
                $('#ajax-panel').html(obj.message);
                $("#createBtnInWelcome").show();
              }
              
            },
            error:function(){
              // failed request; give feedback to user
              $('#ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#createBtnInWelcome").show();
            }
          });
    });

    $("#loginBtnInWelcome").click(function (event) {
        $.ajax({
            type: 'POST',
            url: url + 'welcome/process/',
            data: $("#loginForm").serialize(),
            beforeSend:function(){
              // this is where we append a loading image
              $("#loginBtnInWelcome").hide();
              $('#ajax-panel').html('<img src="http://localhost:8888/productstock/assets/img/ajax-loader.gif" width="50" alt="Loading..." />');
            },
            success:function(data){
              // successful request; do something with the data
              var obj = jQuery.parseJSON(data);
              if(!obj.status) {
                $('#ajax-panel').html(obj.message);
                $("#loginBtnInWelcome").show();
              } else {
                // $('#ajax-panel').empty();
                // $("#loginBtnInWelcome").show();
                window.location.replace(url + "dashboard");
              }
            },
            error:function(){
              // failed request; give feedback to user
              $('#ajax-panel').html('<div> <p class="error"><strong>Oops!</strong> Try that again in a few moments.</p></div>');
              $("#createBtnInWelcome").show();
            }
          });
    }); 

});

