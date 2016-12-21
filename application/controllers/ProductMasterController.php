<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: ProductMasterController controller class
 * 
 */
 class ProductMasterController extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('ProductMasterTable');
    }

    public function saveProductMaster() {
    	$this->productMasterTitle = strtolower($this->security->xss_clean($this->input->post('productMasterTitle')));
    	$status = $this->insertProduct();
    	$this->message = array('id' => $status, 'value'=> $this->productMasterTitle, 'message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Select All Options or Title and Description Already Exists..", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    private function insertProduct() {
    	return $this->ProductMasterTable->insertProduct();
    }

    public function getProductList() {
        echo $this->ProductMasterTable->getProductList();
        exit();
    }
}
?>