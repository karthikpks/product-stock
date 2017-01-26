<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: ModelMasterTable model class
 */
class ModelMasterTable extends CI_Model{
		
	private $modelColumn;
	private $table_name;
	private $cm_id ;
	private $data;
	private $modelMasterDesc;
	private $modelMasterProductCategory;
	private $modelMasterBrand;
	private $modelMasterCapacity;

	function __construct() {
		$this->modelColumn = array();
		$this->data = array();
		$this->cm_id = $this->session->userdata('cm_id');
		$this->table_name = "tm_model_master";

		$this->modelColumn[0] = "md_id";
		$this->modelColumn[1] = "md_pc_id";
		$this->modelColumn[2] = "md_bd_id";
		$this->modelColumn[3] = "md_cp_id";
		$this->modelColumn[4] = "md_cm_id";
		$this->modelColumn[5] = "md_desc";
		$this->modelColumn[6] = "md_created_date";
		$this->modelColumn[7] = "md_modifed_date";
		$this->modelColumn[8] = "md_status";
	}

	public function insertModel() {
		$this->modelMasterDesc = strtolower($this->security->xss_clean($this->input->post('modelMasterDesc')));
		$this->modelMasterProductCategory = intval($this->security->xss_clean($this->input->post('modelMasterProductCategory')));
		$this->modelMasterBrand = intval($this->security->xss_clean($this->input->post('modelMasterBrand')));
		$this->modelMasterCapacity = intval($this->security->xss_clean($this->input->post('modelMasterCapacity')));

		if($this->checkModelExits($this->modelMasterDesc) 
				&& intval($this->modelMasterProductCategory) 
				&& intval($this->modelMasterBrand) 
				&& intval($this->modelMasterCapacity)) {
			$insertData = array(
					$this->modelColumn[1] => $this->modelMasterProductCategory,
					$this->modelColumn[2] => $this->modelMasterBrand,
					$this->modelColumn[3] => $this->modelMasterCapacity,
					$this->modelColumn[4] => $this->cm_id,
					$this->modelColumn[5] => $this->modelMasterDesc,
					$this->modelColumn[6] => date('Y-m-d'),
					$this->modelColumn[8] => 1,
				);
			$this->db->insert($this->table_name, $insertData);
			if($this->db->insert_id()) {
				return $this->db->insert_id();
			}
		}
		return false;
	}

	public function updateModel() {

		$this->modelMasterId = strtolower($this->security->xss_clean($this->input->post('modelMasterId')));
		$this->modelMasterDesc = strtolower($this->security->xss_clean($this->input->post('modelMasterDesc')));
		$this->modelMasterProductCategory = intval($this->security->xss_clean($this->input->post('modelMasterProductCategory')));
		$this->modelMasterBrand = intval($this->security->xss_clean($this->input->post('modelMasterBrand')));
		$this->modelMasterCapacity = intval($this->security->xss_clean($this->input->post('modelMasterCapacity')));

		if($this->checkModelExits($this->modelMasterDesc) 
				&& intval($this->modelMasterProductCategory) 
				&& intval($this->modelMasterBrand) 
				&& intval($this->modelMasterCapacity)) {
			$insertData = array(
					$this->modelColumn[1] => $this->modelMasterProductCategory,
					$this->modelColumn[2] => $this->modelMasterBrand,
					$this->modelColumn[3] => $this->modelMasterCapacity,
					$this->modelColumn[4] => $this->cm_id,
					$this->modelColumn[5] => $this->modelMasterDesc,
					$this->modelColumn[7] => date('Y-m-d'),
					$this->modelColumn[8] => 1,
				);
			$this->db->where($this->modelColumn[0], $this->modelMasterId);
			if($this->db->update($this->table_name, $insertData)) {
				return $this->modelMasterId;
			}
		}
		return false;
	}

	public function getModel() {

		$this->modelMasterProductCategory = intval($this->security->xss_clean($this->input->get('modelMasterProductCategory')));
		$this->modelMasterBrand = intval($this->security->xss_clean($this->input->get('modelMasterBrand')));
		$this->modelMasterCapacity = intval($this->security->xss_clean($this->input->get('modelMasterCapacity')));

		$conditon = array(
					$this->modelColumn[8]  => 1, 
					/*$this->modelColumn[1]  => $this->modelMasterProductCategory, 
					$this->modelColumn[2]  => $this->modelMasterBrand, 
					$this->modelColumn[3]  => $this->modelMasterCapacity, */
					$this->modelColumn[4] => $this->cm_id
				 );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->modelColumn[0] => $row->md_id,
	                $this->modelColumn[5] => $row->md_desc
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}
	public function getModelList() {
		$this->searchKey = $this->security->xss_clean($this->input->get('searchKey'));
		$this->offset = $this->security->xss_clean($this->input->get('offset'));
		if(!empty($this->searchKey)) {
            $this->db->or_like(array($this->modelColumn[5] => $this->searchKey));
        }
        $this->db->limit(0, $this->offset);
        /*
		$this->modelMasterProductCategory = intval($this->security->xss_clean($this->input->get('modelMasterProductCategory')));
		$this->modelMasterBrand = intval($this->security->xss_clean($this->input->get('modelMasterBrand')));
		$this->modelMasterCapacity = intval($this->security->xss_clean($this->input->get('modelMasterCapacity')));*/

		$conditon = array(
					$this->modelColumn[8]  => 1, 
					/*$this->modelColumn[1]  => $this->modelMasterProductCategory, 
					$this->modelColumn[2]  => $this->modelMasterBrand, 
					$this->modelColumn[3]  => $this->modelMasterCapacity, */
					$this->modelColumn[4] => $this->cm_id
				 );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->modelColumn[0] => $row->md_id,
	                $this->modelColumn[5] => $row->md_desc,
	                $this->modelColumn[1] => $row->md_pc_id,
	                $this->modelColumn[2] => $row->md_bd_id,
	                $this->modelColumn[3] => $row->md_cp_id,
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	private function checkModelExits($modelMasterDesc) {
		$conditon = array(
			$this->modelColumn[5] => $modelMasterDesc,
			$this->modelColumn[1] => $this->modelMasterProductCategory,
			$this->modelColumn[2] => $this->modelMasterBrand,
			$this->modelColumn[3] => $this->modelMasterCapacity
			);
		$this->db->where($conditon);
		$query_num = $this->db->get($this->table_name)->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}
}
?>