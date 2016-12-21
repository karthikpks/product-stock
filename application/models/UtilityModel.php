<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS
 * Description: Utility model class
 */
class UtilityModel extends CI_Model{

    function __construct(){
        parent::__construct();        
    }

    public function getAllUserRoleList($user_role) {
        $this->load->model('TmUserRoleTable');
        return $this->TmUserRoleTable->getUserRoleList($user_role);
    }
}
?>