<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: EmployeeMasterController controller class
 * 
 */
 class EmployeeMasterController extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('EmployeeMasterTable');
    }

    public function saveEmployeeMasterDetails() {
    	$status = $this->EmployeeMasterTable->saveEmployeeMasterTableDetails();
    	$this->message = array('message' => " Save successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('message' => "User Already exists!, Filed to save data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }
 }

?>