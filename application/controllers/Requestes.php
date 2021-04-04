<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requestes extends CI_Controller 
{
    function __construct() {
        parent::__construct();
        $this->condb  = $this->load->database('default', TRUE);
    }

    public function index() {
        $data["Tittle"]="New Request";
        $data["datas"] = $this->dataaccess->getallnewrequests("Requested");
        $this->layout->display('page/Requesteslist',$data);
    }

    public function View($id=0) {
        
        $data["req"] = $this->dataaccess->getSigngleRequest($id);
        $data["datas"] = $this->dataaccess->getallanswerbyrequest($id);
        $this->layout->display('page/Requestview',$data);
    }
    public function Changestatus($id=0,$Status) {
        
        $insertrequest = array(
            'Request_status' => $Status     
        );
       $requestid= $this->dataaccess->update("userrequests", $insertrequest,"UserRequestID=".$id); 
       redirect(site_url("Requestes"));
        
    }

    public function Pending() {
        $data["Tittle"]="Pending Request";
        $data["datas"] = $this->dataaccess->getallnewrequests("Pending");
        $this->layout->display('page/Requesteslist',$data);
    }

    public function Rejected() {
        $data["Tittle"]="Rejected Request";
        $data["datas"] = $this->dataaccess->getallnewrequests("Rejected");
        $this->layout->display('page/Requesteslist',$data);
    }

    public function completed() {
        $data["Tittle"]="Complted Request";
        $data["datas"] = $this->dataaccess->getallnewrequests("Accepted");
        $this->layout->display('page/Requesteslist',$data);
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