<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: CustomerMasterTable model class
 */
class CompanyMasterTable extends CI_Model{

	private $table_name;
	private $cmId;
	private $companyName;
	private $companyAddressOne;
	private $companyAddressTwo;
	private $companyAddressThree;
	private $companyTinNo;
    private $companyServiceTaxNo;
    private $companyMobileNo;
    private $companyMobileNoTwo;
    private $companyLandlineNo;
	private $companyContactPersion;
    private $companyEmailId;
    private $companyWebsite;
	private $searchKey;
	private $message;
	private $data;

    function __construct(){
        parent::__construct();
        $this->companyColumn = array();
        $this->message = array();
        $this->data = array();
        $this->searchKey="";
        $this->table_name = "tm_company_master";
        $this->companyColumn[0] = "cm_id";
        $this->companyColumn[1] = "cm_ln_id";
        $this->companyColumn[2] = "cm_name";
        $this->companyColumn[3] = "cm_address_1";        
        $this->companyColumn[4] = "cm_address_2";        
        $this->companyColumn[5] = "cm_address_3";        
        $this->companyColumn[6] = "cm_tin_no";        
        $this->companyColumn[7] = "cm_service_tex_no";        
        $this->companyColumn[8] = "cm_mobile";        
        $this->companyColumn[9] = "cm_mobile_no_2";        
        $this->companyColumn[10] = "cm_landline";        
        $this->companyColumn[11] = "cm_contact_person";        
        $this->companyColumn[12] = "cm_mail_id";        
        $this->companyColumn[13] = "cm_website";        
        $this->companyColumn[14] = "cm_created_date";        
        $this->companyColumn[15] = "cm_modified_date";        
        $this->companyColumn[16] = "cm_status";        
    }

    public function insertCompanyDetail() {
    	//invoke login model 
        $this->load->model('loginmodel');

        $this->companyName = $this->security->xss_clean($this->input->post('companyName'));
        $this->companyAddressOne = $this->security->xss_clean($this->input->post('companyAddressOne'));
        $this->companyAddressTwo = $this->security->xss_clean($this->input->post('companyAddressTwo'));
        $this->companyAddressThree = $this->security->xss_clean($this->input->post('companyAddressThree'));
        $this->companyTinNo = $this->security->xss_clean($this->input->post('companyTinNo'));
        $this->companyServiceTaxNo = $this->security->xss_clean($this->input->post('companyServiceTaxNo'));
        $this->companyMobileNo = $this->security->xss_clean($this->input->post('companyMobileNo'));
        $this->companyMobileNoTwo = $this->security->xss_clean($this->input->post('companyMobileNoTwo'));
        $this->companyLandlineNo = $this->security->xss_clean($this->input->post('companyLandlineNo'));
        $this->companyContactPersion = $this->security->xss_clean($this->input->post('companyContactPersion'));
        $this->companyEmailId = $this->security->xss_clean($this->input->post('companyEmailId'));
        $this->companyWebsite = $this->security->xss_clean($this->input->post('companyWebsite'));
        
        //if(!$this->checkUserExist() && !$this->loginmodel->checkUserExist()) {
        	$insertData = array(
                    $this->companyColumn[1] => $this->session->userdata('login_id'),
			        $this->companyColumn[2] => $this->companyName,
			        $this->companyColumn[3] => $this->companyAddressOne,
			        $this->companyColumn[4] => $this->companyAddressTwo,
                    $this->companyColumn[5] => $this->companyAddressThree,
                    $this->companyColumn[6] => $this->companyTinNo,
                    $this->companyColumn[7] => $this->companyServiceTaxNo,
                    $this->companyColumn[8] => $this->companyMobileNo,
                    $this->companyColumn[9] => $this->companyMobileNoTwo,
                    $this->companyColumn[10] => $this->companyLandlineNo,
                    $this->companyColumn[11] => $this->companyContactPersion,
                    $this->companyColumn[12] => $this->companyEmailId,
			        $this->companyColumn[13] => $this->companyWebsite,
			        $this->companyColumn[14] => date("Y-m-d"),
			        $this->companyColumn[15] => date("Y-m-d"),
			        $this->companyColumn[16] => 1  
			);
		
			$this->db->insert($this->table_name, $insertData);
			if($this->loginmodel->updateCompanyIdInLogin($this->db->insert_id())) {
                return true;
			}
			return false;
        //}
    }

    public function getCompanyMasterList() {
        $limit = 10;
        $offset = $this->security->xss_clean($this->input->post('offset'));
    	$this->searchKey = $this->security->xss_clean($this->input->post('searchKey'));
    	$this->db->select('cm_id, cm_name, cm_mobile, cm_contact_person, cm_created_date');
    	if(!empty($this->searchKey)) {
    		$this->db->or_like(array('cm_name' => $this->searchKey, 'cm_mobile' => $this->searchKey, 'cm_contact_person' => $this->searchKey, 'cm_created_date' => date('Y-m-d',strtotime($this->searchKey))));
    	}
    	$this->db->where($this->companyColumn[16], 1);
    	$this->db->limit($limit, $offset);
    	$query = $this->db->get($this->table_name);
        // Let's check if there are any results
        if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
           		$this->data[] = array(
	                    $this->companyColumn[0] => $row->cm_id,
	                    $this->companyColumn[2] => $row->cm_name,
	                    $this->companyColumn[8] => $row->cm_mobile,
	                    $this->companyColumn[11] => $row->cm_contact_person,
	                    $this->companyColumn[14] => date('d-m-Y', strtotime($row->cm_created_date))
	                );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
    }

    public function getCompanyDetailById() {
    	$this->crmId = $this->security->xss_clean($this->input->post('cmId'));
    	$this->db->where($this->companyColumn[0], $this->crmId);
    	// Run the query
        $query = $this->db->get($this->table_name);
        // Let's check if there are any results
        if($query->num_rows() == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $this->data = array(
			        $this->companyColumn[0] => $row->cm_id,
			        $this->companyColumn[2] => $row->cm_name,
			        $this->companyColumn[3] => $row->cm_address_1,
			        $this->companyColumn[4] => $row->cm_address_2,        
			        $this->companyColumn[5] => $row->cm_address_3,        
			        $this->companyColumn[6] => $row->cm_tin_no,        
			        $this->companyColumn[7] => $row->cm_service_tex_no,        
			        $this->companyColumn[8] => $row->cm_mobile,        
			        $this->companyColumn[9] => $row->cm_mobile_no_2,        
			        $this->companyColumn[10] => $row->cm_landline,        
			        $this->companyColumn[11] => $row->cm_contact_person,        
			        $this->companyColumn[12] => $row->cm_mail_id,        
                    $this->companyColumn[13] => $row->cm_website
				);
            echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }

    }

    public function updateCompanyDetail() {
        $this->data = array(
            $this->companyColumn[2] => 
                $this->security->xss_clean($this->input->post('companyName')),
            $this->companyColumn[3] => 
                $this->security->xss_clean($this->input->post('companyAddressOne')),
            $this->companyColumn[4] => 
                $this->security->xss_clean($this->input->post('companyAddressTwo')),
            $this->companyColumn[5] => 
                $this->security->xss_clean($this->input->post('companyAddressThree')),        
            $this->companyColumn[6] => 
                $this->security->xss_clean($this->input->post('companyTinNo')),        
            $this->companyColumn[7] => 
                $this->security->xss_clean($this->input->post('companyServiceTaxNo')),        
            $this->companyColumn[8] => 
                $this->security->xss_clean($this->input->post('companyMobileNo')),        
            $this->companyColumn[9] => 
                $this->security->xss_clean($this->input->post('companyMobileNoTwo')),        
            $this->companyColumn[10] => 
                $this->security->xss_clean($this->input->post('companyLandlineNo')),        
            $this->companyColumn[11] => 
                $this->security->xss_clean($this->input->post('companyContactPersion')),        
            $this->companyColumn[11] => 
                $this->security->xss_clean($this->input->post('companyEmailId')),        
            $this->companyColumn[12] => 
                $this->security->xss_clean($this->input->post('companyWebsite')),        
            $this->companyColumn[15] => date("Y-m-d")
        );

        $this->db->where($this->companyColumn[0], $this->security->xss_clean($this->input->post('companyId')));
        if($this->db->update($this->table_name, $this->data)) {
            return true;
        } else {
            return false;
        } 
    }

    private function checkUserExist() {
    	$this->db->where($this->customerColumn[10], $this->mobileNumber);
    	$this->db->where($this->customerColumn[11], $this->emailId);
    	$query = $this->db->get($this->table_name);
    	if($query->num_rows() == 1) {
    		return true;
    	} 
    	return false;
    }
}
?>