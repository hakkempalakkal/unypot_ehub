<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requestes extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        $this->condb  = $this->load->database('default', TRUE);
    }

    public function index() {
        $data["datas"] = $this->dataaccess->getallnewrequests();
        $this->layout->display('page/Requesteslist',$data);
    }

    public function View($id=0) {
        
        $data["req"] = $this->dataaccess->getSigngleRequest($id);
        $data["datas"] = $this->dataaccess->getallanswerbyrequest($id);
        $this->layout->display('page/Requestview',$data);
    }

    

    public function update($id=0) {
		$data["datas"] = $this->dataaccess->glerow("services","service_id=".$id);
        $this->layout->display('page/Serviceupdate',$data);
    }
    public function post() {
		
        $service_name = $this->input->post("service_name");
        $short_description = $this->input->post("short_description");
        $Requiremnts = $this->input->post("Requiremnts");
        $Documents_required = $this->input->post("Documents_required");

      
        $insertrequest = array(
            'servicename' => $service_name, 
            'Short_description' => $short_description, 
            'Requiremnts' =>$Requiremnts, 
            'Documents_required' =>$Documents_required          
        );
       $requestid= $this->dataaccess->insert("services", $insertrequest); 
       redirect(site_url("ServiceList"));
    }
    public function updatepost() {
		
        $service_name = $this->input->post("service_name");
        $short_description = $this->input->post("short_description");
        $Requiremnts = $this->input->post("Requiremnts");
        $Documents_required = $this->input->post("Documents_required");
        $id = $this->input->post("id");
      
        $insertrequest = array(
            'servicename' => $service_name, 
            'Short_description' => $short_description, 
            'Requiremnts' =>$Requiremnts, 
            'Documents_required' =>$Documents_required          
        );
       $requestid= $this->dataaccess->update("services", $insertrequest,"service_id=".$id); 
       redirect(site_url("ServiceList"));
    }
    

}	