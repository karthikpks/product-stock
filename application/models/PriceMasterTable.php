<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: PriceMasterTable price class
 */
class PriceMasterTable extends CI_Model{
		
	private $priceColumn;
	private $table_name;
	private $cm_id ;
	private $data;
	private $currentDate;

	function __construct() {
		$this->priceColumn = array();
		$this->data = array();
		$this->cm_id = $this->session->userdata('cm_id');
		$this->table_name = "tm_price_master";
		$this->currentDate = date('Y-m-d');
		$this->priceColumn[0] = "prm_id";
		$this->priceColumn[1] = "prm_md_id";
		$this->priceColumn[2] = "prm_desc";
		$this->priceColumn[3] = "prm_price";
		$this->priceColumn[4] = "prm_from";
		$this->priceColumn[5] = "prm_to";
		$this->priceColumn[6] = "prm_created_date";
		$this->priceColumn[7] = "prm_modified_date";
		$this->priceColumn[8] = "prm_status";
		$this->priceColumn[9] = "prm_cm_id";
	}

	public function insertPrice() {

		$this->priceMasterDesc = strtolower($this->security->xss_clean($this->input->post('priceMasterDesc')));

		$this->priceMasterFrom= strtolower($this->security->xss_clean($this->input->post('priceMasterFrom')));

		$this->priceMasterTo= strtolower($this->security->xss_clean($this->input->post('priceMasterTo')));

		$this->priceMasterModelDes = intval($this->security->xss_clean($this->input->post('priceMasterModelDes')));
		
		$this->priceMasterValue = intval($this->security->xss_clean($this->input->post('priceMasterValue')));
	
		if($this->checkPriceExits()) {
				$insertData = array(
					$this->priceColumn[1] => $this->priceMasterModelDes,
					$this->priceColumn[2] => $this->priceMasterDesc,
					$this->priceColumn[3] => $this->priceMasterValue,
					$this->priceColumn[4] => date('Y-m-d', strtotime($this->priceMasterFrom)),
					$this->priceColumn[5] => date('Y-m-d', strtotime($this->priceMasterTo)),
					$this->priceColumn[6] => date('Y-m-d'),
					$this->priceColumn[8] => 1,
					$this->priceColumn[9] => $this->cm_id
				);
			$this->db->insert($this->table_name, $insertData);
			if($this->db->insert_id()) {
				return $this->db->insert_id();
			}
		}
		return false;
	}

	public function updatePrice() {
			$this->priceMasterId = strtolower($this->security->xss_clean($this->input->post('priceMasterId')));

			$this->priceMasterDesc = strtolower($this->security->xss_clean($this->input->post('priceMasterDesc')));

			$this->priceMasterFrom= strtolower($this->security->xss_clean($this->input->post('priceMasterFrom')));

			$this->priceMasterTo= strtolower($this->security->xss_clean($this->input->post('priceMasterTo')));

			$this->priceMasterModelDes = intval($this->security->xss_clean($this->input->post('priceMasterModelDes')));
			
			$this->priceMasterValue = intval($this->security->xss_clean($this->input->post('priceMasterValue')));
		
			if($this->checkpriceExits()) {
					$insertData = array(
						$this->priceColumn[1] => $this->priceMasterModelDes,
						$this->priceColumn[2] => $this->priceMasterDesc,
						$this->priceColumn[3] => $this->priceMasterValue,
						$this->priceColumn[4] => date('Y-m-d', strtotime($this->priceMasterFrom)),
						$this->priceColumn[5] => date('Y-m-d', strtotime($this->priceMasterTo)),
						$this->priceColumn[6] => date('Y-m-d'),
						$this->priceColumn[8] => 1,
						$this->priceColumn[9] => $this->cm_id
					);
				$this->db->where($this->priceColumn[0], $this->priceMasterId);
				if($this->db->update($this->table_name, $insertData)) {
					return $this->priceMasterId;
				}
			}
			return false;
		}

	public function getPrice() {

		$this->priceMasterProductCategory = intval($this->security->xss_clean($this->input->get('priceMasterProductCategory')));
		$this->priceMasterBrand = intval($this->security->xss_clean($this->input->get('priceMasterBrand')));
		$this->priceMasterCapacity = intval($this->security->xss_clean($this->input->get('priceMasterCapacity')));

		$conditon = array(
					$this->priceColumn[8]  => 1, 
					/*$this->priceColumn[1]  => $this->priceMasterProductCategory, 
					$this->priceColumn[2]  => $this->priceMasterBrand, 
					$this->priceColumn[3]  => $this->priceMasterCapacity, */
					$this->priceColumn[4] => $this->cm_id
				 );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array(
	                $this->priceColumn[0] => $row->md_id,
	                $this->priceColumn[5] => $row->md_desc
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	public function getAllPriceList() {

		$this->searchKey = $this->security->xss_clean($this->input->get('searchKey'));
		$this->offset = $this->security->xss_clean($this->input->get('offset'));
		if(!empty($this->searchKey)) {
            $this->db->or_like(array($this->priceColumn[3] => $this->searchKey));
        }
        $this->db->limit(0, $this->offset);

		$conditon = array(
					$this->priceColumn[8]  => 1, 
					$this->priceColumn[9] => $this->cm_id
				 );
		$this->db->where($conditon);
		$query=$this->db->get($this->table_name);
		if($query->num_rows() >= 1)
        {
            // If there is a user, then create session data
           	foreach ($query->result() as $row) {
   				$this->data[] = array (
	                $this->priceColumn[0] => $row->prm_id,
	                $this->priceColumn[1] => $row->prm_md_id,
	               	$this->priceColumn[2] => $row->prm_desc,
	                $this->priceColumn[3] => $row->prm_price,
	                $this->priceColumn[4] => date('m/d/Y', strtotime($row->prm_from)),
	                $this->priceColumn[5] => date('m/d/Y', strtotime($row->prm_to)),
	                $this->priceColumn[6] => $row->prm_created_date,
	                $this->priceColumn[7] => $row->prm_modified_date,
	                $this->priceColumn[9] => $row->prm_cm_id
	            );
           	}
           	echo json_encode($this->data);
        } else {
        	echo json_encode($this->data);
        }
        exit();
	}

	private function checkPriceExits() {
		$this->db->where($this->priceColumn[2], $this->priceMasterDesc);
		$this->db->where($this->priceColumn[4], $this->priceMasterFrom);
		$this->db->where($this->priceColumn[5], $this->priceMasterTo);
		$this->db->where($this->priceColumn[1], $this->priceMasterModelDes);
		$this->db->where($this->priceColumn[3], $this->priceMasterValue);
		$query_num = $this->db->get($this->table_name)->num_rows();
		if(!$query_num) {
			return true;
		}
		return false;
	}
}
?>