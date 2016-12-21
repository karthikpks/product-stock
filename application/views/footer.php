<div class="footer-main">
  Copyright &copy tripperme, 2014
</div>
</aside>
<!-- /.right-side -->
</div>
<!-- ./wrapper -->
<!-- jQuery 2.0.2 -->
<script src="<?php echo base_url().'assets/'?>js/jquery.min.js" type="text/javascript">
</script>
<!-- jQuery UI 1.10.3 -->
<script src="<?php echo base_url().'assets/'?>js/jquery-ui-1.10.3.min.js" type="text/javascript">
</script>
<!-- Bootstrap -->
<script src="<?php echo base_url().'assets/'?>js/bootstrap.min.js" type="text/javascript">
</script>
<!-- daterangepicker -->
<script src="<?php echo base_url().'assets/'?>js/plugins/daterangepicker/daterangepicker.js" type="text/javascript">
</script>
<script src="<?php echo base_url().'assets/'?>js/plugins/chart.js" type="text/javascript">
</script>
<!-- datepicker
<script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>-->
<!-- Bootstrap WYSIHTML5
<script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>-->
<!-- iCheck -->
<script src="<?php echo base_url().'assets/'?>js/plugins/iCheck/icheck.min.js" type="text/javascript">
</script>
<!-- calendar -->
<script src="<?php echo base_url().'assets/'?>js/plugins/fullcalendar/fullcalendar.js" type="text/javascript">
</script>
<!-- ProductStock App -->
<script src="<?php echo base_url().'assets/'?>js/main/app.js" type="text/javascript">
</script>
<!-- ProductStock customer js -->
<script src="<?php echo base_url().'assets/'?>js/main/customer.js" type="text/javascript">
</script>
<!-- ProductStock company js -->
<script src="<?php echo base_url().'assets/'?>js/main/company.js" type="text/javascript">
</script>
<!-- ProductStock empoyee js -->
<script src="<?php echo base_url().'assets/'?>js/main/employee.js" type="text/javascript">
</script>
<!-- ProductStock category js -->
<script src="<?php echo base_url().'assets/'?>js/main/category.js" type="text/javascript">
</script>
<!-- ProductStock capacity js -->
<script src="<?php echo base_url().'assets/'?>js/main/capacity.js" type="text/javascript">
</script>
<!-- ProductStock brand js -->
<script src="<?php echo base_url().'assets/'?>js/main/brand.js" type="text/javascript">
</script>
<!-- ProductStock brand js -->
<script src="<?php echo base_url().'assets/'?>js/main/model.js" type="text/javascript">
</script>
<!-- ProductStock price js -->
<script src="<?php echo base_url().'assets/'?>js/main/price.js" type="text/javascript">
</script>
<!-- ProductStock product js -->
<script src="<?php echo base_url().'assets/'?>js/main/product.js" type="text/javascript">
</script>
<!-- JQuery Templete-->
<script type="text/javascript" 
        src="http://ajax.microsoft.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js">
</script>        
<script type="text/javascript">
  $('input').on('ifChecked', function(event) {
    // var element = $(this).parent().find('input:checkbox:first');
    // element.parent().parent().parent().addClass('highlight');
    $(this).parents('li').addClass("task-done");
    console.log('ok');
  }
               );
  $('input').on('ifUnchecked', function(event) {
    // var element = $(this).parent().find('input:checkbox:first');
    // element.parent().parent().parent().removeClass('highlight');
    $(this).parents('li').removeClass("task-done");
    console.log('not');
  }
               );
</script>
<script>
  $('#noti-box').slimScroll({
    height: '400px',
    size: '5px',
    BorderRadius: '5px'
  }
                           );
  $('input[type="checkbox"].flat-grey, input[type="radio"].flat-grey').iCheck({
    checkboxClass: 'icheckbox_flat-grey',
    radioClass: 'iradio_flat-grey'
  }
                                                                             );
</script>
<script id="customer_list_templete" type="text/x-jquery-tmpl">
            <tr>
              <td>${crm_id}</td>
              <td>${crm_name}</td>
              <td>${crm_mobile_number}</td>
              <td>${crm_email_id}</td>
              <td>${crm_created_date}</td>
              <td>
                <div class="hidden-phone">
                    <button class="btn btn-default btn-xs companyMasterEditBtn" data-toggle="modal" data-customer-id="${crm_id}"><i class="fa fa-building-o"></i></button>
                    <button class="btn btn-default btn-xs customerMasterEditBtn" data-toggle="modal" data-customer-id="${crm_id}" ><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-default btn-xs" data-customer-id="${crm_id}" ><i class="fa fa-times"></i></button>
  </div>
  </td>
  </tr>
</script>
<script id="company_list_templete" type="text/x-jquery-tmpl">
            <tr>
              <td>${cm_id}</td>
              <td>${cm_name}</td>
              <td>${cm_mobile}</td>
              <td>${cm_contact_person}</td>
              <td>${cm_created_date}</td>
              <td>
                <div class="hidden-phone">
                    <button class="btn btn-default btn-xs companyMasterEditBtn" data-toggle="modal" data-company-id="${cm_id}" ><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-default btn-xs" data-company-id="${cm_id}" ><i class="fa fa-times"></i></button>
  </div>
  </td>
  </tr>
</script>
<!--<script type="text/javascript">
$(function() {
"use strict";
//BAR CHART
var data = {
labels: ["January", "February", "March", "April", "May", "June", "July"],
datasets: [
{
label: "My First dataset",
fillColor: "rgba(220,220,220,0.2)",
strokeColor: "rgba(220,220,220,1)",
pointColor: "rgba(220,220,220,1)",
pointStrokeColor: "#fff",
pointHighlightFill: "#fff",
pointHighlightStroke: "rgba(220,220,220,1)",
data: [65, 59, 80, 81, 56, 55, 40]
},
{
label: "My Second dataset",
fillColor: "rgba(151,187,205,0.2)",
strokeColor: "rgba(151,187,205,1)",
pointColor: "rgba(151,187,205,1)",
pointStrokeColor: "#fff",
pointHighlightFill: "#fff",
pointHighlightStroke: "rgba(151,187,205,1)",
data: [28, 48, 40, 19, 86, 27, 90]
}
]
};
new Chart(document.getElementById("linechart").getContext("2d")).Line(data,{
responsive : true,
maintainAspectRatio: false,
});
});
// Chart.defaults.global.responsive = true;
</script>-->
</body>
</html>
