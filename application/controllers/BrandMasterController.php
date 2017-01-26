<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: BrandMasterController controller class
 * 
 */
 class BrandMasterController extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('BrandMasterTable');
    }

    public function saveBrandMaster() {
        $this->brandMasterDesc = strtolower($this->security->xss_clean($this->input->post('brandMasterDesc')));
        $status = $this->insertBrand();
        $this->message = array('id' => $status, 'value'=> $this->brandMasterDesc, 'message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Brand Description Already Exists or Filed to save data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    public function updateBrandMaster() {
    	$this->brandMasterDesc = strtolower($this->security->xss_clean($this->input->post('brandMasterDesc')));
    	$status = $this->BrandMasterTable->updateBrand();
    	$this->message = array('id' => $status, 'value'=> $this->brandMasterDesc, 'message' => " Updated successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Brand Description Already Exists or Filed to save data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    private function insertBrand() {
    	return $this->BrandMasterTable->insertBrand();
    }

    public function getBrandList() {
        echo $this->BrandMasterTable->getBrand();
        exit();
    }
    public function getAllBrandList() {
        echo $this->BrandMasterTable->getAllBrandList();
        exit();
    }
}
?>