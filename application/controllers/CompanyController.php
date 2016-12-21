<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: CompanyController controller class
 * 
 */
 class CompanyController extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->check_isvalidated();
        $this->load->model('CompanyMasterTable');
    }

    public function saveCompanyDetail() {
        $status = $this->CompanyMasterTable->insertCompanyDetail();
        $this->message = array('message' => " Update successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('message' => "Filed to update data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }
    

    public function updateCompanyDetail() {
        $status = $this->CompanyMasterTable->updateCompanyDetail();
        $this->message = array('message' => " Update successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('message' => "Filed to update data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }
    
    public function getAllCompanyList() {
        echo $data = $this->CompanyMasterTable->getCompanyMasterList();
        exit();
    }

    public function getCompanyDetailById() {
        echo $data = $this->CompanyMasterTable->getCompanyDetailById();
        exit();
    }
    
    private function check_isvalidated() {
        if(! $this->session->userdata('validated')){
            redirect('welcome');
        }
    }
 }
?>