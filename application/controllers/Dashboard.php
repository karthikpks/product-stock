<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Karthik PKS - Full Stack Developer
 * Description: Dashboard controller class
 * This is only viewable to those members that are logged in
 */
 class Dashboard extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->check_isvalidated();
    }

    public function index(){
        $data['msg'] = $this->session->userdata('user_role') == 1 ? 
                        '<strong>Well done!</strong> You have successfully logged in as Super Admin Account.' : 
                        ($this->session->userdata('user_role') == 2 ? 
                            '<strong>Well done!</strong> You have successfully logged in as Admin  Account.' : 
                            ($this->session->userdata('user_role') == 3 ? 
                                '<strong>Well done!</strong> You have successfully logged in as Product Owner Account.' : 
                                ($this->session->userdata('user_role') == 4 ? 
                                    '<strong>Well done!</strong> You have successfully logged in as Administration Staff Account.' 
                                    : '<strong>Well done!</strong> You have successfully logged in as  Marketing Staff' )  )  ) ;

        $this->load->view('header', $data);
        $this->load->view('index' , $data);
        $this->load->view('footer');
    }

    public function createCustomer() {
        echo "done";
    }
    
    private function check_isvalidated(){
        if(! $this->session->userdata('validated')){
            redirect('welcome');
        }
    }
    
    public function do_logout(){
        $this->session->sess_destroy();
        redirect('welcome');
    }
 }
?>
