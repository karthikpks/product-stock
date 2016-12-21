<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: CapacityMasterController controller class
 * 
 */
 class CapacityMasterController extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('CapacityMasterTable');
    }

    public function saveCapacityMaster() {
    	$this->capacityMasterDesc = strtolower($this->security->xss_clean($this->input->post('capacityMasterDesc')));
    	$status = $this->insertCapacity();
    	$this->message = array('id' => $status, 'value'=> $this->capacityMasterDesc, 'message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Capacity Description Already Exists or Filed to save data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    private function insertCapacity() {
    	return $this->CapacityMasterTable->insertCapacity();
    }

    public function getCapacityList() {
    	echo $this->CapacityMasterTable->getCapacity();
    	exit();
    }
}
?>