<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: CustomerMasterTable model class
 */
class CustomerMasterTable extends CI_Model{

	private $table_name;
	private $crmId;
	private $firstName;
	private $lastName;
	private $mobileNumber;
	private $emailId;
	private $password;
	private $customerColumn;
	private $searchKey;
	private $message;
	private $data;
    function __construct(){
        parent::__construct();
        $this->customerColumn = array();
        $this->message = array();
        $this->data = array();
        $this->load->model('loginmodel');
        $this->searchKey="";
        $this->table_name = "tm_customer_master";
        $this->customerColumn[0] = "crm_id";
        $this->customerColumn[1] = "crm_name";
        $this->customerColumn[2] = "crm_last_name";
        $this->customerColumn[3] = "crm_gender";        
        $this->customerColumn[4] = "crm_dob";        
        $this->customerColumn[5] = "crm_address_1";        
        $this->customerColumn[6] = "crm_address_2";        
        $this->customerColumn[7] = "crm_address_3";        
        $this->customerColumn[8] = "crm_pincode";        
        $this->customerColumn[9] = "crm_state_id";        
        $this->customerColumn[10] = "crm_country_id";        
        $this->customerColumn[11] = "crm_mobile_number";        
        $this->customerColumn[12] = "crm_email_id";        
        $this->customerColumn[13] = "crm_created_date";        
        $this->customerColumn[14] = "crm_modified_date";        
        $this->customerColumn[15] = "crm_status";        
        $this->customerColumn[16] = "crm_cm_id";        
    }

    public function insertRegistrationData() {

        $this->firstName = $this->security->xss_clean($this->input->post('firstName'));
        $this->lastName = $this->security->xss_clean($this->input->post('lastName'));
        $this->mobileNumber = $this->security->xss_clean($this->input->post('mobileNumber'));
        $this->emailId = $this->security->xss_clean($this->input->post('emailId'));
        $this->password = $this->security->xss_clean($this->input->post('password'));
        
        if(!$this->checkUserExist($this->mobileNumber, $this->emailId) && !$this->loginmodel->checkUserExist()) {
        	$insertData = array(
			        $this->customerColumn[1] => $this->firstName,
			        $this->customerColumn[2] => $this->lastName,
			        $this->customerColumn[11] => $this->mobileNumber,
			        $this->customerColumn[12] => $this->emailId,
			        $this->customerColumn[13] => date("Y-m-d"),
			        $this->customerColumn[14] => date("Y-m-d"),
			        $this->customerColumn[15] => 1  
			);
		
			$this->db->insert($this->table_name, $insertData);
			if($this->loginmodel->insertLoginData($this->db->insert_id())) {
                return true;
			}
			return false;
        }
    }

    public function getAllCustomerList($limit, $offset) {
    	$this->searchKey = $this->security->xss_clean($this->input->post('searchKey'));
    	$this->db->select('crm_id, crm_name, crm_mobile_number, crm_email_id, crm_created_date');
    	if(!empty($this->searchKey)) {
    		$this->db->or_like(array('crm_name' => $this->searchKey, 'crm_mobile_number' => $this->searchKey, 'crm_email_id' => $this->searchKey, 'crm_created_date' => date('Y-m-d',strtotime($this->searchKey))));
    	}
    	$this->db->where($this->customerColumn[15], 1);
    	$this->db->limit($limit, $offset);
    	$query = $this->db->get($this->table_name);
        // Let's check if there are any results
        if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
           		$this->data[] = array(
	                    $this->customerColumn[0] => $row->crm_id,
	                    $this->customerColumn[1] => $row->crm_name,
	                    $this->customerColumn[11] => $row->crm_mobile_number,
	                    $this->customerColumn[12] => $row->crm_email_id,
	                    $this->customerColumn[13] => date('d-m-Y', strtotime($row->crm_created_date))
	                );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
    }

    public function getCustomerDetailById() {
    	$this->crmId = $this->security->xss_clean($this->input->post('crmId'));
    	$this->db->where($this->customerColumn[0], $this->crmId);
    	// Run the query
        $query = $this->db->get($this->table_name);
        // Let's check if there are any results
        if($query->num_rows() == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $this->data = array(
			        $this->customerColumn[0] => $row->crm_id,
			        $this->customerColumn[1] => $row->crm_name,
			        $this->customerColumn[2] => $row->crm_last_name,
			        $this->customerColumn[3] => $row->crm_gender,        
			        $this->customerColumn[4] => $row->crm_dob,        
			        $this->customerColumn[5] => $row->crm_address_1,        
			        $this->customerColumn[6] => $row->crm_address_2,        
			        $this->customerColumn[7] => $row->crm_address_3,        
			        $this->customerColumn[8] => $row->crm_pincode,        
			        $this->customerColumn[9] => $row->crm_state_id,        
			        $this->customerColumn[10] => $row->crm_country_id,        
			        $this->customerColumn[11] => $row->crm_mobile_number,        
			        $this->customerColumn[12] => $row->crm_email_id
				);
            echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }

    }

    public function updateCustomerDetail() {
        $this->data = array(
            $this->customerColumn[0] => 
                $this->security->xss_clean($this->input->post('customerId')),
            $this->customerColumn[1] => 
                $this->security->xss_clean($this->input->post('customerFirstName')),
            $this->customerColumn[2] => 
                $this->security->xss_clean($this->input->post('customerLastName')),
            $this->customerColumn[3] => 
                $this->security->xss_clean($this->input->post('customerGender')),        
            $this->customerColumn[4] => 
                $this->security->xss_clean($this->input->post('customerDob')),        
            $this->customerColumn[5] => 
                $this->security->xss_clean($this->input->post('addressOneInCustomerMaster')),        
            $this->customerColumn[6] => 
                $this->security->xss_clean($this->input->post('addressTwoInCustomerMaster')),        
            $this->customerColumn[7] => 
                $this->security->xss_clean($this->input->post('addressThreeInCustomerMaster')),        
            $this->customerColumn[8] => 
                $this->security->xss_clean($this->input->post('pinCodeInCustomerMaster')),        
            $this->customerColumn[11] => 
                $this->security->xss_clean($this->input->post('mobileNumberInCustomerMaster')),        
            $this->customerColumn[12] => 
                $this->security->xss_clean($this->input->post('emailIdInCustomerMaster')),        
            $this->customerColumn[14] => date("Y-m-d")
        );

        $this->db->where($this->customerColumn[0], $this->security->xss_clean($this->input->post('customerId')));
        if($this->db->update($this->table_name, $this->data)) {
            return true;
        } else {
            return false;
        } 
    }

    public function insertEmployeeMasterRegisration() {

        $this->employeeMasterName = $this->security->xss_clean($this->input->post('employeeMasterName'));
        $this->employeeMasterLastName = $this->security->xss_clean($this->input->post('employeeMasterLastName'));
        $this->employeeMasterDOB = $this->security->xss_clean($this->input->post('employeeMasterDOB'));
        $this->employeeMasterGender = $this->security->xss_clean($this->input->post('employeeMasterGender'));
        $this->employeeMasterAddressOne = $this->security->xss_clean($this->input->post('employeeMasterAddressOne'));
        $this->employeeMasterAddressTwo = $this->security->xss_clean($this->input->post('employeeMasterAddressTwo'));
        $this->employeeMasterAddressThree = $this->security->xss_clean($this->input->post('employeeMasterAddressThree'));
        $this->employeeMasterPinCode = $this->security->xss_clean($this->input->post('employeeMasterPinCode'));
        $this->employeeMasterMobileNo = $this->security->xss_clean($this->input->post('employeeMasterMobileNo'));
        $this->employeeMasterEmailId = $this->security->xss_clean($this->input->post('employeeMasterEmailId'));
        $this->employeeMasterPassword = $this->security->xss_clean($this->input->post('employeeMasterPassword'));

        if(!$this->checkUserExist($this->mobileNumber, $this->emailId) && !$this->loginmodel->checkUserExist()) {
           $insertEmployeeMasterData = array(
                    $this->customerColumn[1] => $this->employeeMasterName,
                    $this->customerColumn[2] => $this->employeeMasterLastName,
                    $this->customerColumn[3] => $this->employeeMasterGender,
                    $this->customerColumn[4] => date('Y-m-d', strtotime($this->employeeMasterDOB)),
                    $this->customerColumn[5] => $this->employeeMasterAddressOne,
                    $this->customerColumn[6] => $this->employeeMasterAddressTwo,
                    $this->customerColumn[7] => $this->employeeMasterAddressThree,
                    $this->customerColumn[8] => $this->employeeMasterPinCode,
                    $this->customerColumn[11] => $this->employeeMasterMobileNo,
                    $this->customerColumn[12] => $this->employeeMasterEmailId,
                    $this->customerColumn[13] => date("Y-m-d"),
                    $this->customerColumn[15] => 1
                    );

            $this->db->insert($this->table_name, $insertEmployeeMasterData);
            if($this->loginmodel->insertLoginData($this->db->insert_id())) {
                return true;
            }
            return false;
        }
    }

    public function updateCompanyIdInCustomer($cmId) {
        $this->data = array( $this->customerColumn[16] => $cmId);
        $this->db->where($this->customerColumn[0], $this->session->userdata('crm_id'));
        if($this->db->update($this->table_name, $this->data)) {
            return true;
        } else {
            return false;
        }
    }

    private function checkUserExist($mobileNumber, $emailId) {
    	$this->db->where($this->customerColumn[10], $mobileNumber);
    	$this->db->where($this->customerColumn[11], $emailId);
    	$query = $this->db->get($this->table_name);
    	if($query->num_rows() == 1) {
    		return true;
    	} 
    	return false;
    }
}
?>