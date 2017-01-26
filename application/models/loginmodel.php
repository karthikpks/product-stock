<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: Login model class
 */
class LoginModel extends CI_Model{

    private $table_name;
    private $parameter;

    function __construct(){
        parent::__construct();
        $this->load->model('CustomerMasterTable');
        $this->load->model('UtilityModel');
        $this->table_name = "tm_login";
        $this->parameter = array();
        $this->parameter[0] = "ln_id";
        $this->parameter[1] = "ln_user_name";
        $this->parameter[2] = "ln_user_password";
        $this->parameter[3] = "ln_crm_id";
        $this->parameter[4] = "ln_user_role";
        $this->parameter[5] = "ln_user_display_name";
        $this->parameter[6] = "ln_created_date";
        $this->parameter[7] = "ln_modified_date";
        $this->parameter[8] = "ln_user_online";
        $this->parameter[9] = "ln_cm_id";
        $this->parameter[10] = "ln_status";
    }
    
    public function validate(){

        // grab user input
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        // Prep the query
        $this->db->where($this->parameter[1], $username);
        $this->db->where($this->parameter[2], md5($password));
        $this->db->where($this->parameter[10], 1);
        
        // Run the query
        $query = $this->db->get($this->table_name);
        // Let's check if there are any results
        if($query->num_rows() == 1)
        {
            // If there is a user, then create session data
            $row = $query->row();
            $data = array(
                    'login_id' => $row->ln_id,
                    'user_role' => $row->ln_user_role,
                    'username' => $row->ln_user_name,
                    'user_display_name' => $row->ln_user_display_name,
                    'user_status' => $row->ln_status,
                    'crm_id' => $row->ln_status,
                    'cm_id' => $row->ln_cm_id,
                    'users_role_list' => $this->UtilityModel->getAllUserRoleList($row->ln_user_role),
                    'validated' => true
                    );
            $this->session->set_userdata($data);
            return true;
        }
        // If the previous process did not validate
        // then return false.
        return false;
    }

    public function insertLoginData($crm_id, $cmId) {
        $this->mobileNumber = $this->security->xss_clean($this->input->post('mobileNumber'));
        $this->password = $this->security->xss_clean($this->input->post('password'));
        $user_desc = "Product Owner";
        $user_role = "3";

        if(empty($this->mobileNumber) && empty($this->password)) {
            $this->mobileNumber = $this->security->xss_clean($this->input->post('employeeMasterMobileNo'));
            $this->password = $this->security->xss_clean($this->input->post('employeeMasterPassword'));
            $user_role = $this->security->xss_clean($this->input->post('employeeMasterUserRole'));
            $user_desc = "Product Owner";
        }

        if(!$this->checkUserExist($this->mobileNumber)) {
            $insertData = array(
                    $this->parameter[1] => $this->mobileNumber,
                    $this->parameter[2] => md5($this->password),
                    $this->parameter[3] => $crm_id,
                    $this->parameter[4] => $user_role,
                    $this->parameter[5] => $user_desc,
                    $this->parameter[6] => date('Y-m-d'),
                    $this->parameter[8] => 1,
                    $this->parameter[9] => $cmId,
                    $this->parameter[10] => 1
            );
        
        $this->db->insert($this->table_name, $insertData);
        if($this->db->insert_id()) {
            if($this->CustomerMasterTable->updateLoinIdInCustomer($crm_id, $user_role, $this->db->insert_id())) {
                return $this->db->insert_id(); 
            } 
            return false;
        }
            return false;
        }
        return false;
    }

    public function updateCompanyIdInLogin($cmId) {
        $this->data = array( $this->parameter[9] => $cmId);
        $this->db->where($this->parameter[0], $this->session->userdata('login_id'));
        if($this->db->update($this->table_name, $this->data)) {
            return $this->CustomerMasterTable->updateCompanyIdInCustomer($cmId);
        } else {
            return false;
        }
    }

    public function checkUserExist($mobileNumber) {
        $this->db->where($this->parameter[1], $mobileNumber);
        $query = $this->db->get($this->table_name);
        if($query->num_rows() == 1) {
            return true;
        } 
        return false;
    }
}
?>