<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: BrandMasterTable model class
 */
class BrandMasterTable extends CI_Model{
		
	private $brandColumn;
	private $table_name;
	private $cm_id ;
	private $data;

	function __construct() {
		$this->brandColumn = array();
		$this->data = array();
		$this->cm_id = $this->session->userdata('cm_id');
		$this->table_name = "tm_brand_master";

		$this->brandColumn[0] = "bm_id";
		$this->brandColumn[1] = "bm_desc";
		$this->brandColumn[2] = "bm_cm_id";
		$this->brandColumn[3] = "bm_created_date";
		$this->brandColumn[4] = "bm_modified_date";
		$this->brandColumn[5] = "bm_status";

	}

	public function insertbrand() {
		$this->brandMasterDesc = strtolower($this->security->xss_clean($this->input->post('brandMasterDesc')));

		if($this->checkbrandExits($this->brandMasterDesc) && !empty($this->brandMasterDesc)) {
			$insertData = array(
					$this->brandColumn[1] => $this->brandMasterDesc,
					$this->brandColumn[2] => $this->cm_id,
					$this->brandColumn[3] => date('Y-m-d'),
					$this->brandColumn[5] => 1,
				);
			$this->db->insert($this->table_name, $insertData);
			if($this->db->insert_id()) {
				return $this->db->insert_id();
			}
		}
		return false;
	}

	public function getBrand() {
		$conditon = array($this->brandColumn[5]  => 1, $this->brandColumn[2] => $this->cm_id );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->brandColumn[0] => $row->bm_id,
	                $this->brandColumn[1] => $row->bm_desc
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	private function checkbrandExits($brandMasterDesc) {
		$this->db->where($this->brandColumn[1], $brandMasterDesc);
		$query_num = $this->db->get($this->table_name)->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}
}
?>