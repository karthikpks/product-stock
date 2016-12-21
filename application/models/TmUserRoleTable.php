<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: TmUserRoleTable model class
 */
class TmUserRoleTable extends CI_Model{

	private $table_name;
	private $column = array();
    function __construct(){
        parent::__construct();
        $this->table_name = "tm_user_role"; 
        $this->column[0] = "ur_id";       
    }

    public function getUserRoleList($user_role) {
    	$this->db->where($this->column[0]." >= ", $user_role);
        return json_encode($this->db->get($this->table_name)->result());
    }
}
?>