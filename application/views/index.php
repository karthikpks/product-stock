<!-- Main content -->
<?php 
$user_role_list = array();
$user_role = $this->session->userdata('user_role');
$user_role_list = json_decode($this->session->userdata('users_role_list'));
?>
<?php if(! is_null($msg)) { ?>
<div class="alert alert-success">
  <button data-dismiss="alert" class="close close-sm" type="button">
    <i class="fa fa-times">
    </i>
  </button>
  <?php echo $msg ?>
</div>
<?php } ?>
<section class="content">
  <div class="row" style="margin-bottom:5px;">
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#stock-list"> 
          <span class="sm-st-icon st-blue">
            <i class="fa fa-database">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>3200
          </span>
          Total Products
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#work-progress"> 
          <span class="sm-st-icon st-violet">
            <i class="fa fa-envelope-o">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>2200
          </span>
          Total Enquires
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#work-progress"> 
          <span class="sm-st-icon st-green">
            <i class="fa fa-tasks">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>100,320
          </span>
          Today's Tasks
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#work-progress"> 
          <span class="sm-st-icon st-red">
            <i class="fa fa-minus-square-o">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>4567
          </span>
          Pending Tasks
        </div>
      </div>
    </div>
    <?php if($user_role <= 5 ) { ?>
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#customer-list" > 
          <span class="sm-st-icon st-skin-black">
            <i class="fa fa-address-book">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>10
          </span>
          <a href="#customer-master" id="create-customer-master" data-toggle="modal"> Customer Master 
          </a> 
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="customer-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h4 class="modal-title">Customer Master
            </h4>
          </div>
          <div class="modal-body">
            <form role="form" id="customerForm" action="POST">
              <input type="hidden" class="form-control" name="customerId" id="customerId">
              <div class="form-group">
                <label for="customerFirstName">First Name
                </label>
                <input type="text" class="form-control" name="customerFirstName" id="customerFirstName" placeholder="Enter first name">
              </div>
              <div class="form-group">
                <label for="customerFirstName">Last Name
                </label>
                <input type="text" class="form-control" name="customerLastName" id="customerLastName" placeholder="Enter last name">
              </div>
              <div class="form-group">
                <label for="customerFirstName">DOB
                </label>
                <input type="date" class="form-control" name="customerDob" id="customerDob" placeholder="Enter DOB">
              </div>
              <div class="form-group">
                <label for="customerGender">Gender
                </label>
                <select class="form-control input-sm m-b-10" name="customerGender" id="customerGender">
                  <option value="0">Select Gender
                  </option>
                  <option value="1">Male
                  </option>
                  <option value="2">Female
                  </option>
                  <option value="3">Others
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label for="addressOneInCustomerMaster">Address - 1
                </label>
                <input type="text" class="form-control" name="addressOneInCustomerMaster" id="addressOneInCustomerMaster" placeholder="Enter address - 1">
              </div>
              <div class="form-group">
                <label for="addressOneInCustomerMaster">Address - 2
                </label>
                <input type="text" class="form-control" name="addressTwoInCustomerMaster" id="addressTwoInCustomerMaster" placeholder="Enter address - 2">
              </div>
              <div class="form-group">
                <label for="addressThreeInCustomerMaster">Address - 3
                </label>
                <input type="text" class="form-control" name="addressThreeInCustomerMaster" id="addressThreeInCustomerMaster" placeholder="Enter address - 3">
              </div>
              <div class="form-group">
                <label for="pinCodeInCustomerMaster">Pin Code
                </label>
                <input type="text" class="form-control" name="pinCodeInCustomerMaster" id="pinCodeInCustomerMaster" placeholder="Enter pincode">
              </div>
              <div class="form-group">
                <label for="mobileNumberInCustomerMaster">Mobile No.
                </label>
                <input type="text" class="form-control" name="mobileNumberInCustomerMaster" id="mobileNumberInCustomerMaster" placeholder="Enter mobile no.">
              </div>
              <div class="form-group">
                <label for="emailIdInCustomerMaster">Mail Id
                </label>
                <input type="email" class="form-control" name="emailIdInCustomerMaster" id="emailIdInCustomerMaster" placeholder="Enter email">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <span id="customer-master-ajax-panel">
            </span>
            <button data-dismiss="modal" class="btn btn-default" id="closeBtnInCustomerMaster" type="button">Close
            </button>
            <button class="btn btn-success" id="saveBtnInCustomerMaster" data-customermaster="save" type="submit">Save
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->
    <?php } ?>
    <?php if($user_role <= 4) { ?>
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#company-list" > 
          <span class="sm-st-icon st-skin-black">
            <i class="fa fa-building-o">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>10
          </span>
          <a href="#company-master" data-toggle="modal"> Company Master 
          </a> 
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="company-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h4 class="modal-title">Company Master
            </h4>
          </div>
          <div class="modal-body">
            <form role="form" id="companyForm" action="POST">
              <input type="hidden" class="form-control" name="companyId" id="companyId">
              <div class="form-group">
                <label for="companyName">Company name
                </label>
                <input type="text" class="form-control" name="companyName" 
                       id="companyName" placeholder="Enter company name">
              </div>
              <div class="form-group">
                <label for="companyAddressOne">Address - 1
                </label>
                <input type="text" class="form-control" name="companyAddressOne" id="companyAddressOne" placeholder="Enter address - 1">
              </div>
              <div class="form-group">
                <label for="companyAddressTwo">Address - 2
                </label>
                <input type="text" class="form-control" name="companyAddressTwo" id="companyAddressTwo" placeholder="Enter address - 2">
              </div>
              <div class="form-group">
                <label for="companyAddressThree">Address - 3
                </label>
                <input type="text" class="form-control" name="companyAddressThree" id="companyAddressThree" placeholder="Enter address - 3">
              </div>
              <div class="form-group">
                <label for="companyTinNo">Tin No.
                </label>
                <input type="text" class="form-control" name="companyTinNo" id="companyTinNo" placeholder="Enter tin no.">
              </div>
              <div class="form-group">
                <label for="companyServiceTaxNo">Service Tex No.
                </label>
                <input type="text" class="form-control" name="companyServiceTaxNo" id="companyServiceTaxNo" placeholder="Enter service tex no.">
              </div>
              <div class="form-group">
                <label for="companyMobileNo">Mobile No.
                </label>
                <input type="text" class="form-control" name="companyMobileNo" id="companyMobileNo" placeholder="Enter Mobile No">
              </div>
              <div class="form-group">
                <label for="companyMobileNoTwo">Mobile No. 2
                </label>
                <input type="text" class="form-control" name="companyMobileNoTwo" id="companyMobileNoTwo" placeholder="Enter Mobile No">
              </div>
              <div class="form-group">
                <label for="companyLandlineNo">Landline No.
                </label>
                <input type="text" class="form-control" name="companyLandlineNo" id="companyLandlineNo" placeholder="Enter landline no. 2">
              </div>
              <div class="form-group">
                <label for="companyContactPersion">Contact Person
                </label>
                <input type="text" class="form-control" name="companyContactPersion" id="companyContactPersion" placeholder="Enter contact person">
              </div>
              <div class="form-group">
                <label for="companyEmailId">Mail Id
                </label>
                <input type="email" class="form-control" name="companyEmailId" id="companyEmailId" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="companyWebsite">Website
                </label>
                <input type="text" class="form-control" name="companyWebsite" id="companyWebsite" placeholder="Enter website">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <span id="company-master-ajax-panel">
            </span>
            <button data-dismiss="modal" class="btn btn-default" id="closeBtnInCompanyMaster" type="button">Close
            </button>
            <button class="btn btn-success" id="saveBtnInCompanyMaster" data-companymaster="save" type="button">Save
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->
    <?php } ?>
    <?php if($user_role <= 4) { ?>
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#employee-list"> 
          <span class="sm-st-icon st-skin-black">
            <i class="fa fa-users">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>50
          </span>
          <a href="#employee-master" data-toggle="modal"> Employee Master 
          </a> 
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="employee-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h4 class="modal-title">Employee Master
            </h4>
          </div>
          <div class="modal-body">
            <form role="form" name="employeeMasterForm" id="employeeMasterForm" method="POST">
              <input type="hidden" class="form-control" name="employeeId" id="employeeId">
              <div class="form-group">
                <label for="employeeMasterName">First name
                </label>
                <input type="text" class="form-control" name="employeeMasterName" id="employeeMasterName" placeholder="Enter employee name">
              </div>
              <div class="form-group">
                <label for="employeeMasterLastName">Last name
                </label>
                <input type="text" class="form-control" name="employeeMasterLastName" id="employeeMasterLastName" placeholder="Enter employee name">
              </div>
              <div class="form-group">
                <label for="employeeMasterDOB">DOB
                </label>
                <input type="date" class="form-control" name="employeeMasterDOB" id="employeeMasterDOB" placeholder="Enter DOB">
              </div>
              <div class="form-group">
                <label for="employeeMasterGender">Gender
                </label>
                <select class="form-control input-sm m-b-10" name="employeeMasterGender" id="customerGender">
                  <option value="0">Select Gender
                  </option>
                  <option value="1">Male
                  </option>
                  <option value="2">Female
                  </option>
                  <option value="3">Others
                  </option>
                </select>
              </div>
              <div class="form-group">
                <label for="employeeMasterAddressOne">Address - 1
                </label>
                <input type="text" class="form-control" name="employeeMasterAddressOne" id="employeeMasterAddressOne" placeholder="Enter address - 1">
              </div>
              <div class="form-group">
                <label for="employeeMasterAddressTwo">Address - 2
                </label>
                <input type="text" class="form-control" name="employeeMasterAddressTwo" id="employeeMasterAddressTwo" placeholder="Enter address - 2">
              </div>
              <div class="form-group">
                <label for="employeeMasterAddressThree">Address - 3
                </label>
                <input type="text" class="form-control" name="employeeMasterAddressThree" id="employeeMasterAddressThree" placeholder="Enter address - 3">
              </div>
              <div class="form-group">
                <label for="employeeMasterPinCode">Pin Code
                </label>
                <input type="text" class="form-control" name="employeeMasterPinCode" id="pinCodeInCustomerMaster" placeholder="Enter pincode">
              </div>
              <div class="form-group">
                <label for="employeeMasterMobileNo">Mobile No.
                </label>
                <input type="text" class="form-control" name="employeeMasterMobileNo" id="employeeMasterMobileNo" placeholder="Enter mobile no.">
              </div>
              <div class="form-group">
                <label for="employeeMasterEmailId">Mail Id
                </label>
                <input type="email" class="form-control" name="employeeMasterEmailId" id="employeeMasterEmailId" placeholder="Enter email">
              </div>
              <div class="form-group">
                <label for="employeeMasterPassword">Password
                </label>
                <input type="password" class="form-control" name="employeeMasterPassword" id="employeeMasterPassword" placeholder="Enter password">
              </div>
              <div class="form-group">
                <label for="employeeMasterUserRole">User Role
                </label>
                <select class="form-control input-sm m-b-10" name="employeeMasterUserRole" id="employeeMasterUserRole">
                  <?php foreach($user_role_list as $row) { ?>
                  <option value="<?php echo $row->ur_id ;?>" >
                    <?php echo $row->ur_desc ;?>
                  </option>
                  <?php } ?>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <span id="employee-master-ajax-panel">
            </span>
            <button data-dismiss="modal" id="closeBtnInEmployeeMaster" class="btn btn-default" type="button">Close
            </button>
            <button class="btn btn-success" id="saveBtnInEmployeeMaster" data-employeemaster="save"type="button">Save
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->
    <?php } ?>
    <?php if($user_role <= 4) { ?>
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#category-list"> 
          <span class="sm-st-icon st-skin-black">
            <i class="fa fa-filter">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>50
          </span>
          <a href="#category-master" data-toggle="modal"> Category Master 
          </a> 
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="category-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h4 class="modal-title">Category Master
            </h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-4" id="productCategoryModel">
                <form role="form" name="categoryMasterForm" id="categoryMasterForm"> 
                  <div class="form-group" style="">
                    <label for="categoryMasterDesc">Product Category
                    </label>
                    <input type="hidden" name="categoryMasterId" id="categoryMasterId">
                    <input type="text" class="form-control" name="categoryMasterDesc" id="categoryMasterDesc" placeholder="Enter product category ">
                  </div>
                  <button class="btn btn-primary pull-right" data-category-save-type="save" id="saveBtnInCategoryMaster" type="button">Save
                  </button>
                </form>
              </div>
              <div class="col-md-4" id="productSubCategoryModel" style="border-left: thick solid #39435C;">
                <form role="form" name="subCategoryMasterForm" id="subCategoryMasterForm"> 
                  <div class="form-group">
                    <label for="subMainCategory"> Select Product Category
                    </label>
                    <input type="hidden" name="categorySubMasterId" id="categorySubMasterId">
                    <select class="form-control input-sm m-b-10" name="subMainCategory" id="subMainCategory">
                      <option value="0">Select category
                      </option>
                    </select>
                    <label for="subCategory">Sub-Category
                    </label>
                    <input type="text" class="form-control" name="subCategory" id="subCategory" placeholder="Enter sub-category ">
                  </div>
                  <button class="btn btn-primary pull-right" data-category-sub-save-type="save" id="saveBtnInSubCategoryMaster" type="button">Save
                  </button>
                </form>
              </div>
              <div class="col-md-4" id="productSubTwoCategoryModel" style="border-left: thick solid #39435C;">
                <form role="form" name="subTwoCategoryMasterForm" id="subTwoCategoryMasterForm">  
                  <div class="form-group">
                    <label for="subTwoMainCategory">Select Product Category
                    </label>
                    <select class="form-control input-sm m-b-10" name="subTwoMainCategory" id="subTwoMainCategory">
                      <option value="0">Select category
                      </option>
                    </select>
                    <label for="subTwoCategory"> Select Sub-Category
                    </label>
                    <select class="form-control input-sm m-b-10" name="subTwoCategory" id="subTwoCategory">
                      <option value="0">Select category
                      </option>
                    </select>
                    <label for="subThreeCategory">Sub-Category-2
                    </label>
                    <input type="hidden" name="categorySubTwoMasterId" id="categorySubTwoMasterId">
                    <input type="text" class="form-control" name="subThreeCategory" id="subThreeCategory" placeholder="Enter sub-category ">
                  </div>
                  <button class="btn btn-primary pull-right" data-category-sub-two-save-type="save" id="saveBtnInSubTwoCategoryMaster" type="button">Save
                  </button>
                </form>
              </div>
            </div> 
          </div>
          <div class="modal-footer">
            <span id="category-master-ajax-panel"> 
            </span>
            <button data-dismiss="modal" class="btn btn-default" id="closeBtnInCategoryMaster" type="button">Close
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- modal -->
    <?php } ?>
    <?php if($user_role <= 4) { ?>
    <div class="col-md-3">
      <div class="sm-st clearfix">
        <a href="#capacity-list"> 
          <span class="sm-st-icon st-skin-black">
            <i class="fa fa-heart">
            </i>
          </span> 
        </a>
        <div class="sm-st-info">
          <span>50
          </span>
          <a href="#capacity-master" data-toggle="modal"> Capacity Master 
          </a> 
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="capacity-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h4 class="modal-title">Capacity Master
            </h4>
          </div>
          <div class="modal-body">
            <form role="form" name="capacityMasterForm" id="capacityMasterForm"> 
              <div class="form-group">
                <label for="capacityMasterDesc">Capacity Description
                </label>
                <input type="hidden" name="capacityMasterId" id="capacityMasterId">
                <input type="text" class="form-control" name="capacityMasterDesc" id="capacityMasterDesc" placeholder="Enter capacity description">
              </div>
              <div class="form-group">
                <label for="capacityMasterRemark">Remark
                </label>
                </br>
              <textarea rows="4" cols="75" name="capacityMasterRemark" id="capacityMasterRemark">
              </textarea>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <span id="capacity-master-ajax-panel">
          </span>
          <button data-dismiss="modal" class="btn btn-default" id="closeBtnInCapacityMaster" type="button">Close
          </button>
          <button class="btn btn-success" data-capacity-save-type="save" id="saveBtnInCapacityMaster" type="button">Save
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
  <?php } ?>
  <?php if($user_role <= 4) { ?>
  <div class="col-md-3">
    <div class="sm-st clearfix">
      <a href="#capacity-list"> 
        <span class="sm-st-icon st-skin-black">
          <i class="fa fa-apple">
          </i>
        </span> 
      </a>
      <div class="sm-st-info">
        <span>50
        </span>
        <a href="#brand-master" data-toggle="modal"> Brand Master 
        </a> 
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="brand-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form role="form" name="brandMasterForm" id="brandMasterForm">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
            </button>
            <h4 class="modal-title">Brand Master
            </h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="brandMasterDesc">Brand Name
              </label>
              <input type="hidden" name="brandMasterId" id="brandMasterId">
              <input type="text" class="form-control" name="brandMasterDesc" id="brandMasterDesc" placeholder="Enter brand name">
            </div>
          </div>
          <div class="modal-footer">
            <span id="brand-master-ajax-panel">
            </span>
            <button data-dismiss="modal" class="btn btn-default" id="closeBtnInBrandMaster" type="button">Close
            </button>
            <button class="btn btn-success" data-brand-save-type="save" id="saveBtnInBrandMaster" type="button">Save
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- modal -->
  <?php } ?>
  <?php if($user_role <= 4) { ?>
  <div class="col-md-3">
    <div class="sm-st clearfix">
      <a href="#capacity-list"> 
        <span class="sm-st-icon st-skin-black">
          <i class="fa fa-exchange">
          </i>
        </span> 
      </a>
      <div class="sm-st-info">
        <span>50
        </span>
        <a href="#model-master" data-toggle="modal"> Madel Master 
        </a>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="model-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
          </button>
          <h4 class="modal-title">Model Master
          </h4>
        </div>
        <div class="modal-body">
          <form role="form" id="modelMasterForm" name="modelMasterForm"> 
            <div class="form-group">
              <label for="modelMasterProductCategory">Select Product Category
              </label>
              <select class="form-control input-sm m-b-10" name="modelMasterProductCategory" id="modelMasterProductCategory">
                <option value="0">Select category
                </option>
              </select>
              <label for="modelMasterBrand"> Select Brand
              </label>
              <select class="form-control input-sm m-b-10" name="modelMasterBrand" 
                      id="modelMasterBrand">
                <option value="0">Select Brand
                </option>
              </select>
              <label for="modelMasterCapcity"> Select Capacity
              </label>
              <select class="form-control input-sm m-b-10" name="modelMasterCapacity" 
                      id="modelMasterCapacity">
                <option value="0">Select capacity
                </option>
              </select>
              <label for="modelMasterDesc">Model Name
              </label>
              <input type="hidden" name="modelMasterId" id="modelMasterId">
              <input type="text" class="form-control" name="modelMasterDesc" id="modelMasterDesc" placeholder="Enter madel name ">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <span id="model-master-ajax-panel">
          </span>
          <button data-dismiss="modal" class="btn btn-default" id="closeBtnInModelMaster" type="button">Close
          </button>
          <button class="btn btn-success" data-model-save-type="save" id="saveBtnInModelMaster" type="button">Save
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
  <?php } ?>
  <?php if($user_role <= 4) { ?>
  <div class="col-md-3">
    <div class="sm-st clearfix">
      <a href="#price-list"> 
        <span class="sm-st-icon st-skin-black">
          <i class="fa fa-dollar">
          </i>
        </span> 
      </a>
      <div class="sm-st-info">
        <span>50
        </span>
        <a href="#price-master" data-toggle="modal"> Price Master 
        </a>  
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="price-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
          </button>
          <h4 class="modal-title">Price Master
          </h4>
        </div>
        <div class="modal-body">
          <form role="form" name="priceMasterForm" id="priceMasterForm" >
            <label for="priceMasterModelDes"> Select Model
            </label>
            <input type="hidden" name="priceMasterId" id="priceMasterId">
            <select class="form-control input-sm m-b-10" name="priceMasterModelDes" id="priceMasterModelDes">
              <option value="0">Select model
              </option>
            </select>
            <label for="priceMasterDesc">Price Descriptions
            </label>
            <input type="text" class="form-control" name="priceMasterDesc" id="priceMasterDesc" placeholder="Enter price discriptions ">
            <label for="priceMasterValue">Price
            </label>
            <input type="number" class="form-control" name="priceMasterValue" id="priceMasterValue" placeholder="Enter price">
            <label for="priceMasterFrom">Price From
            </label>
            <input type="date" class="form-control" name="priceMasterFrom" id="priceMasterFrom" placeholder="Enter price from">
            <label for="priceMasterTo">Price To
            </label>
            <input type="date" class="form-control" name="priceMasterTo" id="priceMasterTo" >
          </form>
        </div>
        <div class="modal-footer">
          <span id="price-master-ajax-panel">
          </span>
          <button data-dismiss="modal" class="btn btn-default" id="closeBtnInPriceMaster" type="button">Close
          </button>
          <button class="btn btn-success" id="saveBtnInPriceMaster" data-price-save-type="save" type="button">Save
          </button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
  <?php } ?>
  <?php if($user_role <= 4) { ?>
  <div class="col-md-3">
    <div class="sm-st clearfix">
      <a href="#product-list"> 
        <span class="sm-st-icon st-skin-black">
          <i class="fa fa-gift">
          </i>
        </span> 
      </a>
      <div class="sm-st-info">
        <span>50
        </span>
        <a href="#product-master" data-toggle="modal"> Product Master 
        </a> 
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="product-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
          </button>
          <h4 class="modal-title">Modal Tittle
          </h4>
        </div>
        <div class="modal-body">
          <form role="form" id="productMasterForm" enctype="multipart/form-data" name="modelMasterForm">
            <div class="form-group">
            <input type="hidden" name="productMasterId" id="productMasterId">
              <label for="productMasterProductCategory">Select Product Category
              </label>
              <select class="form-control input-sm m-b-10" name="productMasterProductCategory" id="productMasterProductCategory">
                <option value="0">Select category
                </option>
              </select>
              <label for="productMasterBrand"> Select Brand
              </label>
              <select class="form-control input-sm m-b-10" name="productMasterBrand" 
                      id="productMasterBrand">
                <option value="0">Select Brand
                </option>
              </select>
              <label for="productMasterCapacity"> Select Capacity
              </label>
              <select class="form-control input-sm m-b-10" name="productMasterCapacity" 
                      id="productMasterCapacity">
                <option value="0">Select capacity
                </option>
              </select>
              <label for="productMasterModel">Model Name
              </label>
              <select class="form-control input-sm m-b-10" name="productMasterModel" 
                      id="productMasterModel">
                <option value="0">Select model
                </option>
              </select>
              <label for="productMasterTitle">Title
              </label>
              <input type="text" class="form-control" name="productMasterTitle" id="productMasterTitle" placeholder="Enter Product Title">
              </br>
            <label for="productMasterDesc">Description
            </label>
            </br>
          <textarea rows="4" cols="75" name="productMasterDesc" id="productMasterDesc">
          </textarea>
          <br/>
          <input type="file" name="productImage" id="productImage">
          <br>
          <img id="imageProduct" width="150" height="150" src=""  alt="Image preview...">
        </div>
    </div>
    <div class="modal-footer">
      <span id="product-master-ajax-panel"></span>
      <button data-dismiss="modal" id="closeBtnInProductMaster" class="btn btn-default" type="button">Close
      </button>
      <button class="btn btn-success" id="saveBtnInProductMaster" data-product-save-type="save" type="submit">Save
      </button>
    </div>
  </div>
  </form>
  </div>
</div>
<!-- modal -->
<?php } ?>
<?php if($user_role <= 4) { ?>
<div class="col-md-3">
  <div class="sm-st clearfix">
    <a href="#version-list"> 
      <span class="sm-st-icon st-skin-black">
        <i class="fa fa-info">
        </i>
      </span> 
    </a>
    <div class="sm-st-info">
      <span>50
      </span>
      <a href="#version-master" data-toggle="modal"> Version Master 
      </a> 
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="version-master" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×
        </button>
        <h4 class="modal-title">Modal Tittle
        </h4>
      </div>
      <div class="modal-body">
        Body goes here...
      </div>
      <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-default" type="button">Close
        </button>
        <button class="btn btn-success" type="button">Save changes
        </button>
      </div>
    </div>
  </div>
</div>
<!-- modal -->
<?php } ?>
</div>
<!-- Main row -->
<div class="row" id="customer-list">
  <div class="col-md-12">
    <section class="panel">
      <header class="panel-heading">
        Customer List
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="customerListSearch" id="customerListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#customer-list" id="customerListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#customer-list" id="customerListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Name
              </th>
              <th>Mobile Number
              </th>
              <th>Email-Id
              </th>
              <th>Date
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="customer_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
<!-- Main row -->
<?php if($user_role <= 4) { ?>
<div class="row" id="company-list">
  <div class="col-md-12">
    <section class="panel">
      <header class="panel-heading">
        Company List
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="companyListSearch" id="companyListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#company-list" id="companyListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#company-list" id="companyListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Name
              </th>
              <th>Mobile Number
              </th>
              <th>Contact Person
              </th>
              <th>Date
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="company_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
<?php } ?>
<?php if($user_role <= 4) { ?>
<!-- Main row -->
<div class="row" id="employee-list">
  <div class="col-md-12">
    <section class="panel">
      <header class="panel-heading">
        Employee List
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="employeeListSearch" id="employeeListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#employee-list" id="employeeListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#employee-list" id="employeeListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Name
              </th>
              <th>Mobile Number
              </th>
              <th>Email Id
              </th>
              <th>Date
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="employee_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
<?php } ?>
<!-- Main row -->
<?php if($user_role <= 4) { ?>
<div class="row" id="category-list">
  <div class="col-md-4">
    <section class="panel">
      <header class="panel-heading">
        Category List 
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="categoryListSearch" id="categoryListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#category-list" id="categoryListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#category-list" id="categoryListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Category Name
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="category_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <div class="col-md-4">
    <section class="panel">
      <header class="panel-heading">
        Sub-Category List 
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="categorySubListSearch" id="categorySubListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#sub-category-list" id="categorySubListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#sub-category-list" id="categorySubListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Sub-Category Name
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="category_sub_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <div class="col-md-4">
    <section class="panel">
      <header class="panel-heading">
        Sub-Category-Two List 
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="categorySubTwoListSearch" id="categorySubTwoListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#category-sub-two-list" id="categorySubTwoListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#category-sub-two-list" id="categorySubTwoListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Category Name
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="category_sub_two_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
<?php } ?>
<?php if($user_role <= 4) { ?>
<!-- Main row -->
<div class="row" id="capacity-list">
  <div class="col-md-4">
    <section class="panel">
      <header class="panel-heading">
        Capacity List 
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="capacityListSearch" id="capacityListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#capacity-list" id="capacityListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#capacity-list" id="capacityListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Capacity Name
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="capacity_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <div class="col-md-4">
    <section class="panel">
      <header class="panel-heading">
        Brand List 
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="brandListSearch" id="brandListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#brand-list" id="brandListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#brand-list" id="brandListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Brand Name
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="brand_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <div class="col-md-4">
    <section class="panel">
      <header class="panel-heading">
        Model List 
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="modelListSearch" id="modelListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#model-list" id="modelListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#model-list" id="modelListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Model Name
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="model_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
<?php } ?>
<!-- Main row -->
<?php if($user_role <= 4) { ?>
<div class="row" id="price-list">
  <div class="col-md-6">
    <section class="panel">
      <header class="panel-heading">
        Price List 
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="priceListSearch" id="priceListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#price-list" id="priceListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#price-list" id="priceListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Price Desc
              </th>
              <th>Price
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="price_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <div class="col-md-6">
    <section class="panel">
      <header class="panel-heading">
        Product List 
        <div class="sidebar-form">
          <div class="input-group">
            <input type="text" name="productListSearch" id="productListSearch" class="form-control" placeholder="Search..."/>
            <span class="input-group-btn">
              <button type='submit' name='seach' id='search-btn' class="btn btn-flat">
                <i class="fa fa-search">
                </i>
              </button>
            </span>
          </div>
          <hr>
          <nav>
            <ul class="pager">
              <li class="previous">
                <a href="#product-list" id="productListPrevious">Previous
                </a>
              </li>
              <li class="next">
                <a href="#product-list" id="productListNext">Next
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <div class="panel-body table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#
              </th>
              <th>Product Name
              </th>
              <th>Actions
              </th>
            </tr>
          </thead>
          <tbody id="product_list_panel">
          </tbody>
        </table>
      </div>
    </section>
  </div>
</div>
</section>
<?php } ?>
<!-- /.content -->
