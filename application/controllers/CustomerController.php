<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: CustomerController controller class
 * This is only viewable to those members that are logged in
 */
 class CustomerController extends CI_Controller{
    private $firstName;
    private $lastName;
    private $mobileNumber;
    private $emailId;
    private $password;
    private $addressOne;
    private $addressTwo;
    private $addressThree;
    private $state;
    private $country;
    private $pinCode;
    private $message;

    function __construct(){
        parent::__construct();
        $this->check_isvalidated();
        $this->load->model('CustomerMasterTable');
    }

    public function index(){
        return $this->createCustomer();
    }

    public function saveCustomerDetail() {
        $status = $this->CustomerMasterTable->insertCustomerDetail();
        $this->message = array('message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('message' => "Filed to save data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    public function updateCustomerDetail() {
        $status = $this->CustomerMasterTable->updateCustomerDetail();
        $this->message = array('message' => " Update successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('message' => "Filed to update data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }
    
    public function getAllCustomerList() {
        $offset = $this->security->xss_clean($this->input->post('offset'));
        echo $data = $this->CustomerMasterTable->getAllCustomerList(10, $offset);
        exit();
    }

    public function getCustomerDetailById() {
        echo $data = $this->CustomerMasterTable->getCustomerDetailById();
        exit();
    }
    
    private function check_isvalidated() {
        if(! $this->session->userdata('validated')){
            redirect('welcome');
        }
    }
 }
?>