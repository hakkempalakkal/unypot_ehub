<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
    function __construct() 
    {
        parent::__construct();
    }
    
    public function index()
    {
        $i = rand(1, 9);
        $j = rand(1, 9);
        $data = array(
                'question' => $i." + ".$j,
                'answer' => $i + $j
            );
        $this->load->view('page/login_vw', $data);
    }

    public function doLogin()
    {
        $txtusername = $this->input->post("txtusername");
        $txtpassword = md5($this->input->post("txtpassword"));
        $txtquestion = $this->input->post("txtprovequestion");
        $txtanswer = $this->input->post("txtproveanswer");

        if($txtquestion == $txtanswer) {
            $condition = "user_name = '".$txtusername."' and pswrd = '".$txtpassword."'";
            $rs = $this->dataaccess->get("usertable", $condition);
            if(!empty($rs)){            
                $datalogin = array(
                    'SesIsLogin' => TRUE,
                    'SesUserId' => $rs->row_id,
                    'SesUserName' => $rs->user_name,
                    'SesFullName' => $rs->full_name,
                    'SesRoleId' => $rs->role_id,
                );   
                $this->session->set_userdata("SessionLogin", $datalogin); 
                redirect(site_url("Requestes"));
            }
            else {
                redirect(site_url()."?msg=Invalid user is or password");
            }
        }
        else {
            redirect(site_url()."?msg=Prove us you are not a robot!");            
        }
    }

    public function logout(){        
        $this->session->sess_destroy();
        redirect(site_url());
    }
}	