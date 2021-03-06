<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: CategoryMasterController controller class
 * 
 */
 class CategoryMasterController extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('CategoryMasterTable');
    }

    public function saveCategoryMaster() {
        $this->categoryDesc = strtolower($this->security->xss_clean($this->input->post('categoryMasterDesc')));
        $status = $this->CategoryMasterTable->insertCategory();
        $this->message = array('id' => $status, 'value'=> $this->categoryDesc, 'message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Category Description Already Exists or Filed to save data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    public function updateCategoryMaster() {
    	$this->categoryDesc = strtolower($this->security->xss_clean($this->input->post('categoryMasterDesc')));
    	$status = $this->CategoryMasterTable->updateCategory();
    	$this->message = array('id' => $status, 'value'=> $this->categoryDesc, 'message' => " Updated successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => "Category Description Already Exists or Filed to update data..!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    
    public function getCategoryList() {
        echo $this->CategoryMasterTable->getCategory();
        exit();
    }

    public function getCategoryByPageList() {
        echo $this->CategoryMasterTable->getCategoryByPageList();
        exit();
    }

    public function getSubCategoryByPageList() {
        echo $this->CategoryMasterTable->getSubCategoryByPageList();
        exit();
    }

    public function getSubTwoCategoryByPageList() {
    	echo $this->CategoryMasterTable->getSubTwoCategoryByPageList();
    	exit();
    }

    public function saveSubCategoryMaster() {
        $this->subCategory = strtolower($this->security->xss_clean($this->input->post('subCategory')));
        $status = $this->insertSubCategory();
        $this->message = array('id' => $status, 'value'=> $this->subCategory, 'message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => " Please select category or sub category description already exists!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    public function updateSubCategoryMaster() {
    	$this->subCategory = strtolower($this->security->xss_clean($this->input->post('subCategory')));
    	$status = $this->CategoryMasterTable->updateSubCategory();
    	$this->message = array('id' => $status, 'value'=> $this->subCategory, 'message' => " Updated Successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => " Please select category or sub category description already exists!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    private function insertSubCategory() { 
    	return $this->CategoryMasterTable->insertSubCategory();
    }

    public function getSubCategoryList() {
    	echo $this->CategoryMasterTable->getSubCategory();
    	exit();
    }


    public function saveSubTwoCategoryMaster() {
        $this->subThreeCategory = strtolower($this->security->xss_clean($this->input->post('subThreeCategory')));
        $status = $this->insertSubTwoCategory();
        $this->message = array('id' => $status, 'value'=> $this->subThreeCategory, 'message' => " Saved successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => " Please select all category or sub category two description already exists!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    public function updateSubTwoCategoryMaster() {
    	$this->subThreeCategory = strtolower($this->security->xss_clean($this->input->post('subThreeCategory')));
    	$status = $this->CategoryMasterTable->updateSubTwoCategory();
    	$this->message = array('id' => $status, 'value'=> $this->subThreeCategory, 'message' => " Updated successfully..!", 'status' => true);
        if(!$status) {
            $this->message = array('id' => 0, 'value' => '', 'message' => " Please select all category or sub category two description already exists!", 'status' => false);
        }
        echo json_encode($this->message);
        exit();
    }

    private function insertSubTwoCategory() { 
    	return $this->CategoryMasterTable->insertSubTwoCategory();
    }
 }
 ?>