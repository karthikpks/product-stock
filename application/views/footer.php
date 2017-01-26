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
<script id="employee_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${crm_id}</td>
    <td>${crm_name}</td>
    <td>${crm_mobile_number}</td>
    <td>${crm_email_id}</td>
    <td>${crm_created_date}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs employeeMasterEditBtn" data-toggle="modal" data-employee-id="${crm_id}" ><i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-employee-id="${crm_id}" ><i class="fa fa-times"></i></button>
     </div>
    </td>
   </tr>
</script>
<script id="category_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${pc_id}</td>
    <td>${pc_desc}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs categoryMasterEditBtn" data-toggle="modal" data-category-id="${pc_id}" data-category-desc="${pc_desc}" ><i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-category-id="${pc_id}" ><i class="fa fa-times"></i></button>
     </div>
    </td>
   </tr>
</script>
<script id="category_sub_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${psc_id}</td>
    <td>${psc_desc}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs categorySubMasterEditBtn" data-toggle="modal" data-category-sub-id="${psc_id}" data-category-id="${psc_pc_id}" data-category-sub-desc="${psc_desc}" ><i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-category-sub-id="${psc_id}" ><i class="fa fa-times"></i></button>
     </div>
    </td>
   </tr>
</script>
<script id="category_sub_two_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${psc_two_id}</td>
    <td>${psc_two_desc}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs categorySubTwoMasterEditBtn" data-toggle="modal" data-category-sub-two-id="${psc_two_id}" data-category-sub-id="${psc_two_psc_id}" data-category-id="${psc_two_pc_id}" data-category-sub-two-desc="${psc_two_desc}" ><i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-category-sub-two-id="${psc_two_id}" ><i class="fa fa-times"></i></button>
     </div>
    </td>
   </tr>
</script>
<script id="capacity_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${cp_id}</td>
    <td>${cp_desc}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs capacityMasterEditBtn" data-toggle="modal" data-capacity-id="${cp_id}" data-capacity-desc="${cp_desc}" data-capacity-remark="${cp_remark}" ><i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-capacity-id="${cp_id}" ><i class="fa fa-times"></i></button>
     </div>
    </td>
   </tr>
</script>
<script id="brand_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${bm_id}</td>
    <td>${bm_desc}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs brandMasterEditBtn" data-toggle="modal" data-brand-id="${bm_id}" data-brand-desc="${bm_desc}" ><i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-brand-id="${bm_id}" ><i class="fa fa-times"></i></button>
     </div>
    </td>
   </tr>
</script>
<script id="model_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${md_id}</td>
    <td>${md_desc}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs modelMasterEditBtn" data-toggle="modal" 
          data-model-id="${md_id}" data-pc-id="${md_pc_id}" data-brand-id="${md_bd_id}"
          data-capacity-id="${md_cp_id}" data-model-desc="${md_desc}" >
          <i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-model-id="${md_id}" ><i class="fa fa-times"></i></button>
     </div>
    </td>
   </tr>
</script>
<script id="price_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${prm_id}</td>
    <td>${prm_desc}</td>
    <td>${prm_price}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs priceMasterEditBtn" data-toggle="modal" 
          data-price-id="${prm_id}" data-model-id="${prm_md_id}" data-price-desc="${prm_desc}"
          data-price="${prm_price}" data-price-from="${prm_from}" data-price-to="${prm_to}"  >
          <i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-price-id="${prm_id}"><i class="fa fa-times"></i></button>
     </div>
    </td>
   </tr>
</script>
<script id="product_list_templete" type="text/x-jquery-tmpl">
    <tr>
    <td>${pm_id}</td>
    <td>${pm_title}</td>
    <td>
      <div class="hidden-phone">
          <button class="btn btn-default btn-xs productMasterEditBtn" data-toggle="modal" 
          data-product-id="${pm_id}" data-pc-id="${pm_pc_id}" data-brand-id="${pm_bm_id}"
          data-cp-id="${pm_cp_id}" data-md-id="${pm_md_id}" data-product-title="${pm_title}"
          data-product-desc="${pm_desc}" data-product-image-id="${img_id}" 
          data-product-image-src="${img_src}" >
          <i class="fa fa-pencil"></i></button>
          <button class="btn btn-default btn-xs" data-price-id="${prm_id}"><i class="fa fa-times"></i></button>
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
