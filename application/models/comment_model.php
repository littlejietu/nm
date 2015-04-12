<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends XT_Model {

	protected $mTable = 'comment';


	/*
	public function insert($data)
	{
		$sql = $this->db->insert_string($this->mTable, $data);
		$this->db->query($sql);
		return $this->db->insert_id();
	}
	*/

    public function insert($data)
	{
		$sql = $this->db->insert_string($this->mTable, $data);
		$sql = 'INSERT IGNORE '.ltrim($sql,'INSERT');

		$update = array();
		foreach($data as $key=>$val)
		{
			$update[] = $key.'='.$this->db->escape($val);
		}
		$sql .= ' ON duplicate KEY UPDATE '.join(',', $update);

		return $this->db->query($sql);
	}
	
	
	public function get_info_by_id($id, $fields='*')
	{
		$result = $this->db->select($fields)
					->from($this->mTable)
					->where('id', $id)
					->get()
					->row_array();
		return $result;
	}
	
	public function get_list($where=array(), $fields='*', $pid=1, $pagesize=10)
	{
		$result = $this->db->select('COUNT(*) AS count', FALSE)
					->from($this->mTable)
					->where($where)
					->get()
					->row_array();
		$num = $result['count'];
		if ($num > 0){
			if (!$pid>0) $pid=1;
			$result['rows'] = $this->db->select($fields)
							->from($this->mTable)
							->where($where)
							->order_by('id DESC')
							->limit($pagesize, ($pid-1)*$pagesize)
							->get()
							->result_array();
		}else{
			$result['rows'] = array();
		}
		return $result;
	}
	
	public function get_count($where)
	{
		$result = $this->db->select('COUNT(1) AS count', FALSE)
					->from($this->mTable)
					->where($where)
					->get()
					->row_array();
		return (int)$result['count'];
	}

}