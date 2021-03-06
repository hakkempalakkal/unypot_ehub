<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdataaccess extends CI_Controller 
{
    function __construct() {
        parent::__construct();
    }

    public function getFields() {
        $field_list = $this->dataaccess->select('dynamicfield', '1=1', array('field_seq' => 'asc'));

        if(!empty($field_list)) {
            $response = array(
                'field_list' => $field_list,
            );
        } else {
            $response = array(          
                'field_list' => array(),
            );
        }

        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }
    public function getFieldsbyid($id=0) {
        $field_list = $this->dataaccess->select('dynamicfield', "field_type!='filechooser' and service_id=".$id, array('field_seq' => 'asc'));

        if(!empty($field_list)) {
            $response = array(
                'field_list' => $field_list,
            );
        } else {
            $response = array(          
                'field_list' => array(),
            );
        }

        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }

    

    public function getFieldsuploaderbyid($id=0) {
        $field_list = $this->dataaccess->select('dynamicfield', "field_type='filechooser' and service_id=".$id, array('field_seq' => 'asc'));

        if(!empty($field_list)) {
            $response = array(
                'field_list' => $field_list,
            );
        } else {
            $response = array(          
                'field_list' => array(),
            );
        }

        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }

    public function getservice() {
        $field_list = $this->dataaccess->select('services', '1=1', array());

        if(!empty($field_list)) {
            $response = array(
                'service_list' => $field_list,
            );
        } else {
            $response = array(          
                'service_list' => array(),
            );
        }

        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }

    public function getservicebyid($id=0) {
        $field_list = $this->dataaccess->select('services', 'service_id='.$id, array());

        if(!empty($field_list)) {
            $response = array(
                'service_list' => $field_list,
            );
        } else {
            $response = array(          
                'service_list' => array(),
            );
        }

        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }

    public function logins($username="",$password="") {
        $field_list = $this->dataaccess->selectsinglerow('app_users', "Phonenumber='".$username."' and  Password='".$password."'");

        if(!empty($field_list)) {
            $response["msg"]="success";
            $response["logindetails"]= $field_list;
        } else {
            $response["msg"]="failed";
            $response["logindetails"]=array();
        }
       
        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }

    public function getrequestesbyid($userid=0) {
        $field_list = $this->dataaccess->getallrequestbyid($userid);

        if(!empty($field_list)) {
           $response["Requestes"]= $field_list;
        } else {
           
            $response["Requestes"]=array();
        }
       
        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }

    public function getinputsbyid($reqid=0) {
        $field_list = $this->dataaccess->getallanswerbyrequest($reqid);

        if(!empty($field_list)) {
           $response["Userinputs"]= $field_list;
        } else {
           
            $response["Userinputs"]=array();
        }
       
        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }

    

    public function doSubmit($userid=0,$id=0) {
        $field_list = $this->input->post('field_list'); 
        
       
        $dataList = json_decode($field_list);
      
        // $form_id = date("YmdHis");
        $reqdate = date("Y-m-d H:i:s");
        $insertrequest = array(
            'UserID' => $userid, 
            'ServiceID' => $id, 
            'RequetedDate' =>$reqdate, 
            'Request_status' =>'Requested'          
        );
       $requestid= $this->dataaccess->insert("userrequests", $insertrequest); 
       
        
        $form_id=  $requestid;
       
        $field_data="";
        foreach($dataList->data as $row) {
            if (isset( $row->field_data)) {
                $field_data=$row->field_data;
            }
            else{
                $field_data="";
            }
            $insertLine = array(
                'form_id' => $form_id, 
                'field_id' => $row->row_id, 
                'field_name' => $row->field_name, 
                'field_data' => $field_data,          
            );
            $this->dataaccess->insert("dataform", $insertLine); 
        }

        $response['msg'] ="";
        $response['id'] =(string)$requestid;
        $response['sid'] =(string) $id;
       
        $ret = array(
            'Status' => 200,
            'Data' => $response,
            'Id'=> $requestid
        );
        exitJsonFormat($ret);     
    }
    public function doSubmitimg() {
        $Reqid = $this->input->post('Reqid'); 
        $Name = $this->input->post('Name'); 
        $Image = $this->input->post('Image'); 
        $field_id= $this->input->post('field_id');
        // $form_id=  $requestid;
        $insertLine = array(
            'form_id' => $Reqid, 
            'field_id' => $field_id, 
            'field_name' => $Name, 
            'field_data' => $Image,          
        );
        $this->dataaccess->insert("dataform", $insertLine); 
       

        $response['msg'] = "";
        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }
    
    public function registeruser() {
        $fullnale = $this->input->post('fullname'); 
        $adhaar = $this->input->post('adhaar'); 
        $mobile = $this->input->post('mobile'); 
        $email= $this->input->post('email');
        $password= $this->input->post('password');
        // $form_id=  $requestid;

        $insertLine = array(
            'Fullname' => $fullnale, 
            'adhaarno' => $adhaar, 
            'Phonenumber' => $mobile, 
            'EmailID' => $email,     
            'Password' => $password,      
        );
        $this->dataaccess->insert("app_users", $insertLine); 
       

        $response['msg'] = "";
        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }
    
}	