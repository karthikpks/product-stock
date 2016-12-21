<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: ProductMasterTable product class
 */
class ProductMasterTable extends CI_Model {
		
	private $productColumn;
	private $table_name;
	private $cm_id ;
	private $data;

	function __construct() {
		$this->productColumn = array();
		$this->data = array();
		$this->cm_id = $this->session->userdata('cm_id');
		$this->table_name = "tm_product_master";

		$this->productColumn[0] = "pm_id";
		$this->productColumn[1] = "pm_pc_id";
		$this->productColumn[2] = "pm_bm_id";
		$this->productColumn[3] = "pm_cp_id";
		$this->productColumn[4] = "pm_md_id";
		$this->productColumn[5] = "pm_title";
		$this->productColumn[6] = "pm_desc";
		$this->productColumn[7] = "pm_image";
		$this->productColumn[8] = "pm_creaded_date";
		$this->productColumn[9] = "pm_modified_date";
		$this->productColumn[10] = "pm_status";
		$this->productColumn[11] = "pm_cm_id";
	}

	public function insertProduct() {
		$this->productMasterProductCategory = intval($this->security->xss_clean($this->input->post('productMasterProductCategory')));
		$this->productMasterBrand = intval($this->security->xss_clean($this->input->post('productMasterBrand')));
		$this->productMasterCapacity = intval($this->security->xss_clean($this->input->post('productMasterCapacity')));
		$this->productMasterModel = intval($this->security->xss_clean($this->input->post('productMasterModel')));
		$this->productMasterTitle = strtolower(trim($this->security->xss_clean($this->input->post('productMasterTitle'))));
		$this->productMasterDesc = strtolower(trim($this->security->xss_clean($this->input->post('productMasterDesc'))));
		$this->imageData = strtolower(trim($this->security->xss_clean($this->input->post('imageData'))));

		if($this->checkproductExits($this->productMasterDesc, $this->productMasterTitle) 
				&& intval($this->productMasterProductCategory) 
				&& intval($this->productMasterBrand) 
				&& intval($this->productMasterModel) 
				&& intval($this->productMasterCapacity)) {
				
				$insertData = array(
					$this->productColumn[1] => $this->productMasterProductCategory,
					$this->productColumn[2] => $this->productMasterBrand,
					$this->productColumn[3] => $this->productMasterCapacity,
					$this->productColumn[4] => $this->productMasterModel,
					$this->productColumn[5] => $this->productMasterDesc,
					$this->productColumn[6] => $this->productMasterTitle,
					$this->productColumn[7] => $this->imageData,
					$this->productColumn[8] => date('Y-m-d'),
					$this->productColumn[10] => 1,
					$this->productColumn[11] => $this->cm_id
				);
			$this->db->insert($this->table_name, $insertData);
			if($this->db->insert_id()) {
				return $this->db->insert_id();
			}
		}
		return false;
	}

	public function getProduct() {

		$this->productMasterProductCategory = intval($this->security->xss_clean($this->input->get('productMasterProductCategory')));
		$this->productMasterBrand = intval($this->security->xss_clean($this->input->get('productMasterBrand')));
		$this->productMasterCapacity = intval($this->security->xss_clean($this->input->get('productMasterCapacity')));

		$conditon = array(
					$this->productColumn[8]  => 1, 
					/*$this->productColumn[1]  => $this->productMasterProductCategory, 
					$this->productColumn[2]  => $this->productMasterBrand, 
					$this->productColumn[3]  => $this->productMasterCapacity, */
					$this->productColumn[4] => $this->cm_id
				 );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->productColumn[0] => $row->md_id,
	                $this->productColumn[5] => $row->md_desc
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	private function checkproductExits($productMasterDesc, $productMasterTitle) {
		$this->db->where($this->productColumn[6], $productMasterDesc);
		$this->db->where($this->productColumn[5], $productMasterDesc);
		$query_num = $this->db->get($this->table_name)->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}
}
?>