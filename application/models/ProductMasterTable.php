<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: ProductMasterTable product class
 */
class ProductMasterTable extends CI_Model {
		
	private $productColumn;
	private $imageColumn;
	private $table_name;
	private $cm_id ;
	private $data;

	function __construct() {
		$this->productColumn = array();
		$this->data = array();
		$this->cm_id = $this->session->userdata('cm_id');
		$this->table_name = array("tm_product_master", "tm_product_images");

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

		$this->imageColumn[0] = "img_id";
		$this->imageColumn[1] = "img_product_id";
		$this->imageColumn[2] = "img_src";
		$this->imageColumn[3] = "img_status";
	}

	public function insertProduct($imagePath) {
		$this->productMasterProductCategory = intval($this->security->xss_clean($this->input->post('productMasterProductCategory')));
		$this->productMasterBrand = intval($this->security->xss_clean($this->input->post('productMasterBrand')));
		$this->productMasterCapacity = intval($this->security->xss_clean($this->input->post('productMasterCapacity')));
		$this->productMasterModel = intval($this->security->xss_clean($this->input->post('productMasterModel')));
		$this->productMasterTitle = strtolower(trim($this->security->xss_clean($this->input->post('productMasterTitle'))));
		$this->productMasterDesc = strtolower(trim($this->security->xss_clean($this->input->post('productMasterDesc'))));

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
					$this->productColumn[5] => $this->productMasterTitle,
					$this->productColumn[6] => $this->productMasterDesc,
					$this->productColumn[8] => date('Y-m-d'),
					$this->productColumn[10] => 1,
					$this->productColumn[11] => $this->cm_id
				);
			$this->db->insert($this->table_name[0], $insertData);
			if($this->db->insert_id()) {
				$productId = $this->db->insert_id();
				$insertImage = array(
						"img_product_id" => $productId,
						"img_src" => $imagePath,
						"img_status" => 1
					);
				$this->db->insert($this->table_name[1], $insertImage);
				if($this->db->insert_id()) {
					return $productId;
				}
				return false;
			}
		}
		return false;
	}

	public function updateProduct($imagePath) {
			$this->productMasterId = intval($this->security->xss_clean($this->input->post('productMasterId')));

			$this->productMasterProductCategory = intval($this->security->xss_clean($this->input->post('productMasterProductCategory')));
			$this->productMasterBrand = intval($this->security->xss_clean($this->input->post('productMasterBrand')));
			$this->productMasterCapacity = intval($this->security->xss_clean($this->input->post('productMasterCapacity')));
			$this->productMasterModel = intval($this->security->xss_clean($this->input->post('productMasterModel')));
			$this->productMasterTitle = strtolower(trim($this->security->xss_clean($this->input->post('productMasterTitle'))));
			$this->productMasterDesc = strtolower(trim($this->security->xss_clean($this->input->post('productMasterDesc'))));

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
						$this->productColumn[5] => $this->productMasterTitle,
						$this->productColumn[6] => $this->productMasterDesc,
						$this->productColumn[8] => date('Y-m-d'),
						$this->productColumn[10] => 1,
						$this->productColumn[11] => $this->cm_id
					);
				$this->db->where($productColumn[0], $productMasterId);
				if($this->db->update($this->table_name[0], $insertData)) {
					$insertImage = array(
							"img_product_id" => $productMasterId,
							"img_src" => $imagePath,
							"img_status" => 1
						);
					$this->db->insert($this->table_name[1], $insertImage);
					if($this->db->insert_id()) {
						return $productMasterId;
					}
					return false;
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
		$query=$this->db->get($this->table_name[0]);
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

	public function getAllProductList() {
		$this->searchKey = $this->security->xss_clean($this->input->get('searchKey'));
		$this->offset = $this->security->xss_clean($this->input->get('offset'));
		if(!empty($this->searchKey)) {
            $this->db->or_like(array($this->productColumn[5] => $this->searchKey));
        }
        $this->db->limit(0, $this->offset);
		$conditon = array($this->productColumn[10]  => 1, $this->productColumn[11] => $this->cm_id,  
			$this->imageColumn[3]  => 1);
		$this->db->where($conditon);
		$this->db->join($this->table_name[1], "tm_product_master.pm_id = tm_product_images.img_product_id");
		$query=$this->db->get($this->table_name[0]);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->productColumn[0] => $row->pm_id,
	                $this->productColumn[1] => $row->pm_pc_id,
	                $this->productColumn[2] => $row->pm_bm_id,
	                $this->productColumn[3] => $row->pm_cp_id,
	                $this->productColumn[4] => $row->pm_md_id,
	                $this->productColumn[5] => $row->pm_title,
	                $this->productColumn[6] => $row->pm_desc,
	                $this->imageColumn[0] => $row->img_id,
	                $this->imageColumn[2] => $row->img_src
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
		$this->db->where($this->productColumn[5], $productMasterTitle);
		$query_num = $this->db->get($this->table_name[0])->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}
}
?>