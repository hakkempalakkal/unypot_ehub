<?php

class Layout 
{
    protected $_ci;
    
    function __construct()
    {        
        $this->_ci = &get_instance();
    }
    
    function display($template, $data = null)
    {        
        $role_id = $this->_ci->session->userdata['SessionLogin']['SesRoleId'];
        $current_controller = $this->_ci->uri->segment(1);

        $order = array('ordr' => 'asc');
        $rs_role = $this->_ci->dataaccess->select("vw_sysmenuassign", "role_id=".$role_id, $order);
        $menu = "";
        if(!empty($rs_role)) {
            foreach($rs_role as $row) {
                $active = ($row->controller == $current_controller) ? "active" : "";
                $menu .= '<li class="'.$active.'"><a href="'.site_url($row->controller).'"><i class="fa fa-file"></i> <span>'.$row->menu.'</span></a></li>';
            }
        }

        $data['menu'] = $menu;
        $data['_content'] = $this->_ci->load->view($template, $data, true);       
        $data['_header'] = $this->_ci->load->view("template/header_incld", $data, true); 
        $data['_menu'] = $this->_ci->load->view("template/menu_incld", $data, true); 
        $data['_footer'] = $this->_ci->load->view("template/footer_incld", $data, true); 
        $this->_ci->load->view("template/table_tmplt.php", $data);
    }
}
