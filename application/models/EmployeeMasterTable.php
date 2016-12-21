<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: EmployeeMasterTable model class
 */
class EmployeeMasterTable extends CI_Model {

    function __construct(){
        parent::__construct();  
        $this->load->model('CustomerMasterTable');  
    }

    public function saveEmployeeMasterTableDetails() {
    	return $this->CustomerMasterTable->insertEmployeeMasterRegisration();
    }
}
?>