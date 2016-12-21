<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: ModelMasterController controller class
 * 
 */
 class ModelMasterController extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('ModelMasterTable');
    }

    public function saveModelMaster() {
    	$this->modelMasterDesc = strtolower($this->security->xss_clean($this->input->post('modelMasterDesc')));
    	$status = $this->insertModel();
    	$this->message = array('id' => $status, 'value'=> $this->modelMasterDesc, 'message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Select All Options or Model Description Already Exists..", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    private function insertModel() {
    	return $this->ModelMasterTable->insertModel();
    }

    public function getModelList() {
        echo $this->ModelMasterTable->getModel();
        exit();
    }
}
?>