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
