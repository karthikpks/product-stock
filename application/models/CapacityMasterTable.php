<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: CapacityMasterTable model class
 */
class CapacityMasterTable extends CI_Model{
		
	private $capacityColumn;
	private $table_name;
	private $cm_id ;
	private $data;

	function __construct() {
		$this->capacityColumn = array();
		$this->data = array();
		$this->cm_id = $this->session->userdata('cm_id');
		$this->table_name = "tm_capacity_master";

		$this->capacityColumn[0] = "cp_id";
		$this->capacityColumn[1] = "cp_desc";
		$this->capacityColumn[2] = "cp_remark";
		$this->capacityColumn[3] = "cp_created_date";
		$this->capacityColumn[4] = "cp_modified_date";
		$this->capacityColumn[5] = "cp_status";
		$this->capacityColumn[6] = "cp_cm_id";

	}

	public function insertCapacity() {
		$this->capacityMasterDesc = strtolower($this->security->xss_clean($this->input->post('capacityMasterDesc')));

		$this->capacityMasterRemark = strtolower(trim($this->security->xss_clean($this->input->post('capacityMasterRemark'))));

		if($this->checkCapacityExits($this->capacityMasterDesc) && !empty($this->capacityMasterRemark)) {
			$insertData = array(
					$this->capacityColumn[1] => $this->capacityMasterDesc,
					$this->capacityColumn[2] => $this->capacityMasterRemark,
					$this->capacityColumn[3] => date('Y-m-d'),
					$this->capacityColumn[5] => 1,
					$this->capacityColumn[6] => $this->cm_id
				);
			$this->db->insert($this->table_name, $insertData);
			if($this->db->insert_id()) {
				return $this->db->insert_id();
			}
		}
		return false;
	}
	public function updateCapacity() {
		$this->capacityMasterId = strtolower($this->security->xss_clean($this->input->post('capacityMasterId')));
		$this->capacityMasterDesc = strtolower($this->security->xss_clean($this->input->post('capacityMasterDesc')));

		$this->capacityMasterRemark = strtolower(trim($this->security->xss_clean($this->input->post('capacityMasterRemark'))));

		if($this->checkCapacityExits($this->capacityMasterDesc, $this->capacityMasterRemark) && !empty($this->capacityMasterRemark)) {
			$insertData = array(
					$this->capacityColumn[1] => $this->capacityMasterDesc,
					$this->capacityColumn[2] => $this->capacityMasterRemark,
					$this->capacityColumn[4] => date('Y-m-d'),
					$this->capacityColumn[5] => 1,
					$this->capacityColumn[6] => $this->cm_id
				);
			$this->db->where($this->capacityColumn[0], $this->capacityMasterId);
			if($this->db->update($this->table_name, $insertData)) {
				return $this->capacityMasterId;
			}
		}
		return false;
	}

	public function getCapacity() {
		$conditon = array($this->capacityColumn[5]  => 1, $this->capacityColumn[6] => $this->cm_id );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->capacityColumn[0] => $row->cp_id,
	                $this->capacityColumn[1] => $row->cp_desc,
	                $this->capacityColumn[2] => $row->cp_remark,
	                $this->capacityColumn[3] => $row->cp_created_date
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	public function getAllCapacityList() {

		$this->searchKey = $this->security->xss_clean($this->input->get('searchKey'));
		$this->offset = $this->security->xss_clean($this->input->get('offset'));
		if(!empty($this->searchKey)) {
            $this->db->or_like(array($this->capacityColumn[1] => $this->searchKey));
        }
        $this->db->limit(0, $this->offset);
		$conditon = array($this->capacityColumn[5]  => 1, $this->capacityColumn[6] => $this->cm_id );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->capacityColumn[0] => $row->cp_id,
	                $this->capacityColumn[1] => $row->cp_desc,
	                $this->capacityColumn[2] => $row->cp_remark,
	                $this->capacityColumn[3] => $row->cp_created_date
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	private function checkCapacityExits($capacityDec, $capacityMasterRemark) {
		$this->db->where($this->capacityColumn[1], $capacityDec);
		$this->db->where($this->capacityColumn[2], $capacityMasterRemark);
		$query_num = $this->db->get($this->table_name)->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}
}
?>