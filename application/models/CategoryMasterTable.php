<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: CategoryMasterTable model class
 */
class CategoryMasterTable extends CI_Model{
		
	private $categoryColumn;
	private $subCategoryColumn;
	private $subTwoCategoryColumn;
	private $table_name;
	private $cm_id ;
	private $data;

	function __construct() {
		$this->categoryColumn = array();
		$this->subCategoryColumn = array();
		$this->subTwoCategoryColumn = array();
		$this->table_name = array();
		$this->data = array();
		$this->cm_id = $this->session->userdata('cm_id');
		$this->table_name[0] = "tm_product_category";
		$this->table_name[1] = "tm_product_sub_category";
		$this->table_name[2] = "tm_product_sub_two_category";

		$this->categoryColumn[0] = "pc_id";
		$this->categoryColumn[1] = "pc_desc";
		$this->categoryColumn[2] = "pc_created_date";
		$this->categoryColumn[3] = "pc_modified_date";
		$this->categoryColumn[4] = "pc_status";
		$this->categoryColumn[5] = "pc_cm_id";

		$this->subCategoryColumn[0] = "psc_id";
		$this->subCategoryColumn[1] = "psc_pc_id";
		$this->subCategoryColumn[2] = "psc_desc";
		$this->subCategoryColumn[3] = "psc_created_date";
		$this->subCategoryColumn[4] = "psc_modified_date";
		$this->subCategoryColumn[5] = "psc_status";
		$this->subCategoryColumn[6] = "psc_cm_id";

		$this->subTwoCategoryColumn[0] = "psc_two_id";
		$this->subTwoCategoryColumn[1] = "psc_two_pc_id";
		$this->subTwoCategoryColumn[2] = "psc_two_psc_id";
		$this->subTwoCategoryColumn[3] = "psc_two_desc";
		$this->subTwoCategoryColumn[4] = "psc_two_created_date";
		$this->subTwoCategoryColumn[5] = "psc_two_modified_date";
		$this->subTwoCategoryColumn[6] = "psc_two_status";
		$this->subTwoCategoryColumn[7] = "psc_two_cm_id";
	}

	public function insertCategory() {
		$this->categoryDesc = strtolower($this->security->xss_clean($this->input->post('categoryMasterDesc')));
		if($this->checkCategoryExits($this->categoryDesc) && !empty($this->categoryDesc)) {
			$insertData = array(
					$this->categoryColumn[1] => $this->categoryDesc,
					$this->categoryColumn[2] => date('Y-m-d'),
					$this->categoryColumn[4] => 1,
					$this->categoryColumn[5] => $this->cm_id
				);
			$this->db->insert($this->table_name[0], $insertData);
			if($this->db->insert_id()) {
				return $this->db->insert_id();
			}
		}
		return false;
	}

	public function updateCategory() {
		$this->categoryMasterId = strtolower($this->security->xss_clean($this->input->post('categoryMasterId')));
		$this->categoryDesc = strtolower($this->security->xss_clean($this->input->post('categoryMasterDesc')));
		if($this->checkCategoryExits($this->categoryDesc) && !empty($this->categoryDesc)) {
			$insertData = array(
					$this->categoryColumn[1] => $this->categoryDesc,
					$this->categoryColumn[3] => date('Y-m-d')
				);
			$this->db->where($this->categoryColumn[0], $this->categoryMasterId);
			if($this->db->update($this->table_name[0], $insertData)) {
				return $this->categoryMasterId;
			}
		}
		return false;
	}

	public function insertSubCategory() {
		$this->subMainCategory = intval($this->security->xss_clean($this->input->post('subMainCategory')));
		$this->subCategory = strtolower($this->security->xss_clean($this->input->post('subCategory')));
		if($this->checkSubCategoryExits($this->subCategory) && $this->subMainCategory  && !empty($this->subCategory)) {
			$insertData = array(
				$this->subCategoryColumn[1] => $this->subMainCategory,
				$this->subCategoryColumn[2] => $this->subCategory,
				$this->subCategoryColumn[3] => date('Y-m-d'),
				$this->subCategoryColumn[5] => 1,
				$this->subCategoryColumn[6] => $this->cm_id 
			);
			$this->db->insert($this->table_name[1], $insertData);
			if($this->db->insert_id()) {
				return $this->db->insert_id();
			}
		}
		return false;
	}

	public function updateSubCategory() {
		$this->categorySubMasterId = intval($this->security->xss_clean($this->input->post('categorySubMasterId')));
		$this->subMainCategory = intval($this->security->xss_clean($this->input->post('subMainCategory')));
		$this->subCategory = strtolower($this->security->xss_clean($this->input->post('subCategory')));
		if($this->checkSubCategoryExits($this->subCategory) && $this->subMainCategory  && !empty($this->subCategory)) {
			$insertData = array(
				$this->subCategoryColumn[1] => $this->subMainCategory,
				$this->subCategoryColumn[2] => $this->subCategory,
				$this->subCategoryColumn[4] => date('Y-m-d'),
				$this->subCategoryColumn[5] => 1,
				$this->subCategoryColumn[6] => $this->cm_id 
			);
			$this->db->where($this->subCategoryColumn[0], $this->categorySubMasterId);
			if($this->db->update($this->table_name[1], $insertData)) {
				return $this->categorySubMasterId;
			}
		}
		return false;
	}

	public function insertSubTwoCategory() {
		$this->subTwoMainCategory = intval($this->security->xss_clean($this->input->post('subTwoMainCategory')));
		$this->subTwoCategory = intval($this->security->xss_clean($this->input->post('subTwoCategory')));

		$this->subThreeCategory = strtolower($this->security->xss_clean($this->input->post('subThreeCategory')));

		if($this->checkSubTwoCategoryExits($this->subThreeCategory) && $this->subTwoMainCategory  && $this->subTwoCategory && !empty($this->subThreeCategory)) {
			$insertData = array(
				$this->subTwoCategoryColumn[1] => $this->subTwoMainCategory,
				$this->subTwoCategoryColumn[2] => $this->subTwoCategory,
				$this->subTwoCategoryColumn[3] => $this->subThreeCategory,
				$this->subTwoCategoryColumn[4] => date('Y-m-d'),
				$this->subTwoCategoryColumn[6] => 1,
				$this->subTwoCategoryColumn[7] = $this->cm_id 
			);
			$this->db->insert($this->table_name[2], $insertData);
			if($this->db->insert_id()) {
				return $this->db->insert_id();
			}
		}
		return false;
	}

	public function updateSubTwoCategory() {
		$this->categorySubTwoMasterId = intval($this->security->xss_clean($this->input->post('categorySubTwoMasterId')));
		$this->subTwoMainCategory = intval($this->security->xss_clean($this->input->post('subTwoMainCategory')));
		$this->subTwoCategory = intval($this->security->xss_clean($this->input->post('subTwoCategory')));

		$this->subThreeCategory = strtolower($this->security->xss_clean($this->input->post('subThreeCategory')));

		if($this->checkSubTwoCategoryExits($this->subThreeCategory) && $this->subTwoMainCategory  && $this->subTwoCategory && !empty($this->subThreeCategory)) {
			$insertData = array(
				$this->subTwoCategoryColumn[1] => $this->subTwoMainCategory,
				$this->subTwoCategoryColumn[2] => $this->subTwoCategory,
				$this->subTwoCategoryColumn[3] => $this->subThreeCategory,
				$this->subTwoCategoryColumn[5] => date('Y-m-d'),
				$this->subTwoCategoryColumn[6] => 1
			);
			$this->db->where($this->subTwoCategoryColumn[0], $this->categorySubTwoMasterId);
			if($this->db->update($this->table_name[2], $insertData)) {
				return $this->categorySubTwoMasterId;
			}
		}
		return false;
	}

	public function getCategory() {
		$conditon = array($this->categoryColumn[4]  => 1, $this->categoryColumn[5] => $this->cm_id );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name[0]);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->categoryColumn[0] => $row->pc_id,
	                $this->categoryColumn[1] => $row->pc_desc,
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	public function getCategoryByPageList() {
		$this->searchKey = $this->security->xss_clean($this->input->get('searchKey'));
		$offset = $this->security->xss_clean($this->input->get('offset'));
    	if(!empty($this->searchKey)) {
    		$this->db->or_like(array('pc_desc' => $this->searchKey));
    	}

		$conditon = array($this->categoryColumn[4]  => 1, $this->categoryColumn[5] => $this->cm_id );
		$this->db->where($conditon);
		$this->db->limit(0, $offset);
		$query=$this->db->get($this->table_name[0]);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->categoryColumn[0] => $row->pc_id,
	                $this->categoryColumn[1] => $row->pc_desc,
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	public function getSubCategoryByPageList() {
		$this->searchKey = $this->security->xss_clean($this->input->get('searchKey'));
		$offset = $this->security->xss_clean($this->input->get('offset'));
    	if(!empty($this->searchKey)) {
    		$this->db->or_like(array('psc_desc' => $this->searchKey));
    	}

		$conditon = array($this->subCategoryColumn[5]  => 1, $this->subCategoryColumn[6] => $this->cm_id );
		$this->db->where($conditon);
		$this->db->limit(0, $offset);
		$query=$this->db->get($this->table_name[1]);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->subCategoryColumn[0] => $row->psc_id,
	                $this->subCategoryColumn[1] => $row->psc_pc_id,
	                $this->subCategoryColumn[2] => $row->psc_desc,
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	public function getSubTwoCategoryByPageList() {
		$this->searchKey = $this->security->xss_clean($this->input->get('searchKey'));
		$offset = $this->security->xss_clean($this->input->get('offset'));
    	if(!empty($this->searchKey)) {
    		$this->db->or_like(array('psc_two_desc' => $this->searchKey));
    	}

		$conditon = array($this->subTwoCategoryColumn[6]  => 1, $this->subTwoCategoryColumn[7] => $this->cm_id );
		$this->db->where($conditon);
		$this->db->limit(0, $offset);
		$query=$this->db->get($this->table_name[2]);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->subTwoCategoryColumn[0] => $row->psc_two_id,
	                $this->subTwoCategoryColumn[1] => $row->psc_two_pc_id,
	                $this->subTwoCategoryColumn[2] => $row->psc_two_psc_id,
	                $this->subTwoCategoryColumn[3] => $row->psc_two_desc
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	public function getSubCategory() {
		$this->category = intval($this->security->xss_clean($this->input->get('category')));
		$conditon = array($this->subCategoryColumn[1]  => $this->category , $this->subCategoryColumn[5] => 1 );
		$this->db->where($conditon);
		$this->db->join($this->table_name[0], "tm_product_sub_category.psc_pc_id = tm_product_category.pc_id");
		$query=$this->db->get($this->table_name[1]);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->subCategoryColumn[0] => $row->psc_id,
	                $this->subCategoryColumn[2] => $row->psc_desc,
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	private function checkCategoryExits($categoryDesc) {
		$this->db->where($this->categoryColumn[1], $categoryDesc);
		$query_num = $this->db->get($this->table_name[0])->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}

	private function checkSubCategoryExits($subCategoryDesc) {
		$this->db->where($this->subCategoryColumn[2], $subCategoryDesc);
		$query_num = $this->db->get($this->table_name[1])->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}

	private function checkSubTwoCategoryExits($subTwoCategoryDesc) {
		$this->db->where($this->subTwoCategoryColumn[3], $subTwoCategoryDesc);
		$query_num = $this->db->get($this->table_name[2])->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}
}