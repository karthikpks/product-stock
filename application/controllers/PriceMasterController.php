<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: PriceMasterController controller class
 * 
 */
 class PriceMasterController extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('PriceMasterTable');
    }

    public function savePriceMaster() {
        $this->priceMasterDesc = strtolower($this->security->xss_clean($this->input->post('priceMasterDesc')));
        $status = $this->insertPrice();
        $this->message = array('id' => $status, 'value'=> $this->priceMasterDesc, 'message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Enter all field or Price value Already Exists..", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    public function updatePriceMaster() {
    	$this->priceMasterDesc = strtolower($this->security->xss_clean($this->input->post('priceMasterDesc')));
    	$status = $this->PriceMasterTable->updatePrice();;
    	$this->message = array('id' => $status, 'value'=> $this->priceMasterDesc, 'message' => " Updated successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Enter all field or Price value Already Exists..", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    private function insertPrice() {
    	return $this->PriceMasterTable->insertPrice();
    }

    public function getModelList() {
        echo $this->PriceMasterTable->getPrice();
        exit();
    }

    public function getAllPriceList() {
        echo $this->PriceMasterTable->getAllPriceList();
        exit();
    }
}
?>