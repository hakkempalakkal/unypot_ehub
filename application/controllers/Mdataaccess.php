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

    public function doSubmit($userid=0) {
        $field_list = $this->input->post('field_list'); 
        $dataList = json_decode($field_list);
    //     $ServiceID=0;
    //     foreach($dataList->data as $rows) {
           
    //         $ServiceID= $rows->service_id;
    //         break;
    //     }
    //     // $form_id = date("YmdHis");
    //     $reqdate = date("Y-m-d H:i:s");
    //     $insertrequest = array(
    //         'UserID' => $userid, 
    //         'ServiceID' => $ServiceID, 
    //         'RequetedDate' => $row->field_name, 
    //         'Request_status' =>'Requested'          
    //     );
    //    $requestid= $this->dataaccess->insert("userrequests", $insertrequest); 
       
        
        $form_id= $userid;
       
        foreach($dataList->data as $row) {
            $insertLine = array(
                'form_id' => $form_id, 
                'field_id' => $row->row_id, 
                'field_name' => $row->field_name, 
                'field_data' => $row->field_data,          
            );
            $this->dataaccess->insert("dataform", $insertLine); 
        }

        $response['msg'] = "";
        $response['formid'] =  $form_id;
        $ret = array(
            'Status' => 200,
            'Data' => $response
        );
        exitJsonFormat($ret);     
    }
}	