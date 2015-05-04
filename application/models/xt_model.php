<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * 扩展CI的CI_Model类
 *
 * @package		CodeIgniter
 * @subpackage	models
 * @category	MY_Model
 * @author		South
 */
class XT_Model extends CI_Model {
	
	protected $mTable;
	protected $mPkId = 'id';
	
	public function __construct(){
		$this->db = _get_db('default');
		
	}
	
	public function table($table='')
	{
		if (! $table)
		{
			$table = $this->mTable;
		}
		return $this->db->protect_identifiers($table, TRUE);
	}
	
	public function set_table($table)
	{
		$this->mTable = $table;
		return $this;
	}
	
	public function execute($sql)
	{
		return $this->db->query($sql);
	}

	public function get_by_id($id, $fields='*', $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$result = $this->db->select($fields)
					->from($tb)
					->where('id', $id)
					->get()
					->row_array();
		return $result;
	}

	/**
	*根据条件查询
	*/
	public function get_by_where($where, $fields='*', $tb = ''){
		$tb = empty($tb) ? $this->mTable : $tb;
		$result = $this->db->select($fields)
		->from($tb)
		->where($where,NULL,FALSE)
		->get()
		->row_array();
		return $result;
	}

	public function insert($data, $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$sql = $this->db->insert_string($tb, $data);
		$sql = 'INSERT IGNORE '.ltrim($sql,'INSERT');

		$update = array();
		foreach($data as $key=>$val)
		{
			$update[] = $key.'='.$this->db->escape($val);
		}
		$sql .= ' ON duplicate KEY UPDATE '.join(',', $update);

		return $this->db->query($sql);
	}
	
	public function insert_string($data, $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$sql = $this->db->insert_string($tb, $data);
		$this->db->query($sql);
		$id =  $this->db->insert_id();
		return $id;
	}

	public function insert_ignore($data, $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$sql = $this->db->insert_string($tb, $data);
		$sql = 'INSERT IGNORE '.ltrim($sql,'INSERT');
		$this->db->query($sql);
		
		return $this->db->insert_id();
	}

	//拼写错了。带删
	public function insert_igonre($data, $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$sql = $this->db->insert_string($tb, $data);
		$sql = 'INSERT IGNORE '.ltrim($sql,'INSERT');
		$this->db->query($sql);
		
		return $this->db->insert_id();
	}

	public function get_count($where, $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$result = $this->db->select('COUNT(1) AS count', FALSE)
					->from($tb)
					->where($where)
					->get()
					->row_array();
		return (int)$result['count'];
	}
	
	public function count($arrWhere, $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$this->db->select('COUNT(1) AS count', FALSE)
					->from($tb);
		foreach($arrWhere as $key=>$val)
		{	
			if (is_array($val))
			{
				$this->db->where_in($key, $val);
			}
			else
			{
				$this->db->where($key, $val);
			}
		}
		$result = $this->db->get()->row_array();
		return $result['count'];
	}
	
	public function delete_by_id($id)
	{
		if (!is_array($id))
		{
			$id = array($id);
		}
		return $this->db->where_in($this->mPkId, $id)->limit(count($id))->delete($this->mTable);
	}
	
	public function delete_by_where($where)
	{
		return $this->db->where($where)->delete($this->mTable);
	}
	
	public function update_by_id($id, $data, $tb='')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$where = array($this->mPkId=> $id);
		$sql = $this->db->update_string($tb, $data, $where);
		return $this->db->query($sql);
	}
	
	public function update_by_where($where, $data, $tb='')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		if (!$where)return false;
		if(!is_array($where))
			$this->db->where($where);
		else
		{
			foreach($where as $key=>$val)
			{	
				if (is_array($val))
				{
					$this->db->where_in($key, $val);
				}
				else
				{
					$this->db->where($key, $val);
				}
			}
		}
		return $this->db->update($tb, $data);
	}
	
	/**
	 * a=a+1 操作
	 * @return unknown_type
	 */
	public function operate_by_id($id, $map)
	{
		$where = array($this->mPkId=> $id);
		$this->db->where($where);
		foreach($map as $key=>$val)
		{
			$this->db->set($key, $val, FALSE);
		}
		$this->db->update($this->mTable);
	}

	public function get_list($where=array(), $fields='*', $order_by='')
	{
		return $this->fetch_rows($where, $fields, $order_by);
	}
	
	public function fetch_row($where, $fields='*', $order_by='', $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$this->db->select($fields)
						->from($tb)
						->where($where);
		if ($order_by)
		{
			$this->db->order_by($order_by);
		}
		return $this->db->limit(1)->get()->row_array();
	}
	
	public function fetch_field($where, $field='', $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$arr =	$this->db->select($field)
						->from($tb)
						->where($where)
						->get()
						->row_array();
		return $arr[$field];
	} 
	
	public function fetch_rows($where=array(), $fields='*', $order_by='', $limit=0, $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$this->db->select($fields)->from($tb);
		if(!is_array($where))
			$this->db->where($where);
		else
		{
			foreach($where as $key=>$val)
			{	
				if (is_array($val))
				{
					$this->db->where_in($key, $val);
				}
				else
				{
					$this->db->where($key, $val);
				}
			}
		}

		if ($order_by)
		{
			$this->db->order_by($order_by);
		}
		if ($limit)
		{
			if (is_array($limit))
			{
				$this->db->limit($limit[0], $limit[1]);
			}
			else
			{
				$this->db->limit($limit);
			}
		}
		return $this->db->get()->result_array();
	}

	/*public function fetch_page_more($page=1, $pagesize=10, $tb = '', $where=array(), $fields='*', $order_by='')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$order_by = $order_by ? $order_by : $this->mPkId.' DESC';
		$fields_count = 'COUNT(1) AS count';
		$this->db->select($fields_count, FALSE)
					->from($tb);
	    foreach($where as $key=>$val)
		{	
		    if ($key{0} == '@' && is_array($val))
		    {// array('@where'=>array('a'=>1,'b'=>1))
		        $key = substr($key, 1);
		        foreach($val as $k=>$v)
		        {
		            $this->db->$key($k, $v);
		        }
		        continue;
		    }
			if (is_array($val))
			{
				$this->db->where_in($key, $val);
			}
			else
			{
				$this->db->where($key, $val);
			}
		}
		$result = $this->db->get()->row_array();
		
		$num = $result['count'];
		$result['rows'] = array();
		if ($num > 0)
		{
		    $sql = $this->db->last_query();
			$sql =  str_replace($fields_count, $fields, $sql);
			$sql .= ' ORDER BY '.$order_by;
			$sql .= ' LIMIT '.(($page-1)*$pagesize).','.$pagesize;
			$result['rows'] = $this->db->query($sql)->result_array();
		}
		return $result;
	}*/
	
	public function fetch_page($page=1, $pagesize=10, $where=array(), $fields='*', $order_by='', $tb = '')
	{
		$tb = empty($tb) ? $this->mTable : $tb;
		$order_by = $order_by ? $order_by : $this->mPkId.' DESC';
		$fields_count = 'COUNT(1) AS count';
		$this->db->select($fields_count, FALSE)
					->from($tb);
	    foreach($where as $key=>$val)
		{	
		    if ($key{0} == '@' && is_array($val))
		    {// array('@where'=>array('a'=>1,'b'=>1))
		        $key = substr($key, 1);
		        foreach($val as $k=>$v)
		        {
		            $this->db->$key($k, $v);
		        }
		        continue;
		    }
			if (is_array($val))
			{
				$this->db->where_in($key, $val);
			}
			else
			{
				$this->db->where($key, $val);
			}
		}
		$result = $this->db->get()->row_array();
		
		$num = $result['count'];
		$result['rows'] = array();
		if ($num > 0)
		{
		    $sql = $this->db->last_query();
			$sql =  str_replace($fields_count, $fields, $sql);
			$sql .= ' ORDER BY '.$order_by;
			$sql .= ' LIMIT '.(($page-1)*$pagesize).','.$pagesize;
			$result['rows'] = $this->db->query($sql)->result_array();
		}
		return $result;
	}
	
}
// END XT_Model Class
