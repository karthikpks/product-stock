<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: Welcome Controller class
 */

class Welcome extends CI_Controller {

    private $data;
    private $message;
    function __construct() 
    {
        parent::__construct();
        $this->data = array();
        $this->message = array();
        $this->data['msg'] = NULL;
        $this->data['username'] = NULL;
        $this->data['password'] = NULL;
    }

    public function index($msg = NULL)
    {
        $this->data['msg'] = $msg;
        $this->load->view('welcome_message', $this->data);
    }

    public function process()
    {
        $username = $this->security->xss_clean($this->input->post('username'));
        $password = $this->security->xss_clean($this->input->post('password'));
        
        $errorMessage['mobileNumber'] = empty($username) ? "Username is required" : 
                                (preg_match('/^\d{10}$/',$username) ? true : "Username is invalid !");
        $errorMessage['password'] = empty($password) ? "Password is required" : 
                                    (strlen($password) > 10 ? "Password should be enter below 10 character" : true);
        if(is_string($errorMessage['mobileNumber'])) { 
            $this->message = array('message' => $errorMessage['mobileNumber'], 'status' => false);
        } else if(is_string($errorMessage['password'])) { 
            $this->message = array('message' => $errorMessage['password'], 'status' => false);
        } else {
            $this->load->model('loginmodel');
            $result = $this->loginmodel->validate();
            if(!$result && !$this->session->userdata('user_status'))
            {
                // If user did not validate, then show them login page again
                $msg = '<font color=red>Something went wrong, Please contact Administration for further process.</font><br />';
                $this->message = array('message' => $msg, 'status' => false);
            } else if(!$result) {
                $msg = '<font color=red>Invalid Username or Password.</font><br />';
                $this->message = array('message' => $msg, 'status' => false);
            }else {
                $this->message = array('message' => 'Successfully login', 'status' => true);
            }
        }
        echo json_encode($this->message);
    }

    public function createCustomerForm() {
        $this->load->model('CustomerMasterTable');
        $companyName = $this->security->xss_clean($this->input->post('companyName'));
        $firstName = $this->security->xss_clean($this->input->post('firstName'));
        $lastName = $this->security->xss_clean($this->input->post('lastName'));
        $mobileNumber = $this->security->xss_clean($this->input->post('mobileNumber'));
        $emailId = $this->security->xss_clean($this->input->post('emailId'));
        $password = $this->security->xss_clean($this->input->post('password'));

        $errorMessage['companyName'] = empty($companyName) ? "Company Name is required" : 
                                    (strlen($companyName) > 100 ? "Company Name should be enter below 100 character" : true);

        $errorMessage['firstName'] = empty($firstName) ? "First Name is required" : 
                                    (strlen($firstName) > 100 ? "First Name should be enter below 100 character" : true); 

        $errorMessage['lastName'] = empty($lastName) ? "Last Name is required" : 
                                    (strlen($lastName) > 100 ? "Last Name should be enter below 100 character" : true);

        $errorMessage['mobileNumber'] = empty($mobileNumber) ? "Mobile Number is required" : 
                                    (preg_match('/^\d{10}$/',$mobileNumber) ? true : "Mobile number invalid !");

        $errorMessage['emailId'] = empty($emailId) ? "Email Id is required" : 
                                    (strlen($emailId) > 100 ? "Last Name should be enter below 100" : (!filter_var($emailId, FILTER_VALIDATE_EMAIL) ? "Invalid Email Formate" : true));
        $errorMessage['password'] = empty($password) ? "Password is required" : 
                                    (strlen($password) > 10 ? "Password should be enter below 10 character" : true);

        if(is_bool($errorMessage['companyName']) 
            && is_bool($errorMessage['firstName'])
                && is_bool($errorMessage['lastName'])
                    && is_bool($errorMessage['mobileNumber']) 
                        && is_bool($errorMessage['emailId']) 
                            && is_bool($errorMessage['password'])) {

            if($this->CustomerMasterTable->insertRegistrationData()) {
                $this->message = array('message' => 'Successfully created accounts', 'status' => true);
            } else {
                $this->message = array('message' => 'User Already exits..', 'status' => false);
            }   
        
        } else if(is_string($errorMessage['companyName'])) { 
            $this->message = array('message' => $errorMessage['companyName'], 'status' => false);
        } else if(is_string($errorMessage['firstName'])) { 
            $this->message = array('message' => $errorMessage['firstName'], 'status' => false);
        } else if(is_string($errorMessage['lastName'])) { 
            $this->message = array('message' => $errorMessage['lastName'], 'status' => false);
        } else if(is_string($errorMessage['mobileNumber'])) { 
            $this->message = array('message' => $errorMessage['mobileNumber'], 'status' => false);
        } else if(is_string($errorMessage['emailId'])) { 
            $this->message = array('message' => $errorMessage['emailId'], 'status' => false);
        } else if(is_string($errorMessage['password'])) { 
            $this->message = array('message' => $errorMessage['password'], 'status' => false);
        } 

         echo json_encode($this->message);
    }
}
