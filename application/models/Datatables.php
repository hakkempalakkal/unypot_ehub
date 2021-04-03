<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datatables extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function getQuery($table, $column_order, $column_search, $order, $custom_search, $condition)
	{	
		if(!empty($condition)) {
			$this->db->where($condition);			
		}

		foreach($custom_search as $row) 
		{
			if($this->input->post($row))
			{
				$this->db->where($row, $this->input->post($row));
			}
		}

		$this->db->from($table);
		$i = 0;
	
		foreach ($column_search as $item) 
		{
			if($_POST['search']['value']) 
			{				
				if($i===0) 
				{
					$this->db->group_start(); 
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($column_search) - 1 == $i)
				{
					$this->db->group_end(); 
				}
			}
			$i++;
		}
		
		if(isset($_POST['order'])) 
		{
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function getDatatables($table, $column_order, $column_search, $order, $custom_search, $condition)
	{
		$this->getQuery($table, $column_order, $column_search, $order, $custom_search, $condition);
		if($_POST['length'] != -1)
		{
			$this->db->limit($_POST['length'], $_POST['start']);
		}
		$query = $this->db->get();
		$data=$query->result();
		
		return $data;
	}

	public function getDatatables2($table, $column_order, $column_search, $order, $custom_search, $condition)
	{
		$this->getQuery($table, $column_order, $column_search, $order, $custom_search, $condition);
		$query = $this->db->get();
		$data=$query->result();
	 
		return $data;
	}

	public function countFiltered($table, $column_order, $column_search, $order, $custom_search, $condition)
	{
		$this->getQuery($table, $column_order, $column_search, $order, $custom_search, $condition);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function countAll($table)
	{
		$this->db->from($table);
		return $this->db->count_all_results();
	}
}
