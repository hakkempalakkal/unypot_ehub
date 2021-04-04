<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataaccess extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getDataForDropdownlist($data)
	{
		$table = $data['table'];
		$field_value = $data['field_id'];
		$field_text = $data['field_text'];
		$field = $field_value.' as field_id, '.$field_text. ' as field_text';
		$this->db->select($field);
		$this->db->from($table);
		$this->db->order_by($field_text, 'asc');
		$query = $this->db->get();
		$result = $query->result();

		$data = array('' => '');
		foreach ($result as $row) {
			$data[$row->field_id] = $row->field_text;
		}
		return $data;
	}

	public function select($table, $condition=null, $order=null) {
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($condition)) {			
			$this->db->where($condition);
		}
		if(!empty($order)) {			
			$this->db->order_by(key($order), $order[key($order)]);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function selectsinglerow($table, $condition=null) {
		$this->db->select('*');
		$this->db->from($table);
		if(!empty($condition)) {			
			$this->db->where($condition);
		}
	
		$query = $this->db->get();
		return $query->row();
	}


	public function getallrequestbyid($id) {
		$sql="SELECT userrequests.UserRequestID,`RequetedDate`,`Request_status`,services.servicename,services.Short_description FROM `userrequests`
		inner join services on services.service_id=userrequests.ServiceID
		where UserID=".$id;    
		$query = $this->db->query($sql);
		return $query->result();
	
	}

	public function getallnewrequests($status="") {
		$sql="SELECT userrequests.UserRequestID,`RequetedDate`,`Request_status`,services.servicename,services.Short_description 
		,app_users.Fullname,app_users.adhaarno,app_users.Phonenumber,app_users.EmailID
		FROM `userrequests`
		inner join services on services.service_id=userrequests.ServiceID
		inner join app_users on app_users.App_UserID=userrequests.UserID
		where Request_status='".$status."'";   
		$query = $this->db->query($sql);
		return $query->result();
	
	}

	public function getSigngleRequest($reqid=0) {
		$sql="SELECT userrequests.UserRequestID,`RequetedDate`,`Request_status`,services.servicename,services.Short_description 
		,app_users.Fullname,app_users.adhaarno,app_users.Phonenumber,app_users.EmailID
		FROM `userrequests`
		inner join services on services.service_id=userrequests.ServiceID
		inner join app_users on app_users.App_UserID=userrequests.UserID
		where userrequests.UserRequestID=".$reqid;   
		$query = $this->db->query($sql);
		return $query->row();
	
	}

	public function getallanswerbyrequest($id) {
		$sql="SELECT dataform.`field_id`,dataform.`field_name`,dataform.`field_data`,dynamicfield.field_type FROM `dataform`inner join userrequests on userrequests.UserRequestID=dataform.form_id inner join dynamicfield ON dynamicfield.row_id=dataform.field_id where dynamicfield.field_type not in('Title','Label','Label Bold') and userrequests.UserRequestID=".$id;    
		$query = $this->db->query($sql);
		return $query->result();
	
	}

	

	public function get($table, $condition) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_max($table, $field, $condition) {
		$this->db->select_max($field);
		$this->db->from($table);
		$this->db->where($condition);
		$query = $this->db->get();
		return $query->row();
	}

	public function get_count($table, $condition=null) {
		$this->db->select('*');
		$this->db->from($table);
		if($condition != null) {
			$this->db->where($condition);			
		}
		$query = $this->db->get();
		return $query->num_rows();;
	}

	public function insert($table, $data) {	    
	 $this->db->insert($table, $data);
	 return $this->db->insert_id();
	}

	public function update($table, $data, $condition) {
		$this->db->where($condition);
		return $this->db->update($table, $data);
	}

	public function delete($table, $condition) {
		$this->db->where($condition);
		return $this->db->delete($table);
	}

	public function truncate($table) {
		$this->db->truncate($table);
	}

}
