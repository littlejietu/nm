<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends T_Model {

	protected $mTable = 'user';

	public function insert($data)
	{
		$sql = $this->db->insert_string($this->mTable, $data);
		$this->db->query($sql);
		$id =  $this->db->insert_id();
		return $id;
	}



	public function get_list_db(CI_DB $db, $pid=1, $pagesize=10, $fields='*') {
		$fields_count = 'COUNT(1) AS count';
		$result = $db->select($fields_count, FALSE)
		->get()
		->row_array();
		$sql = $db->last_query();
		if ($result['count'] > 0){
			$sql =  str_replace($fields_count, $fields, $sql);
			$sql .= ' LIMIT '.(($pid-1)*$pagesize).','.$pagesize;
			$result['rows'] = $this->db->query($sql)->result_array();
		}else{
			$result['rows'] = array();
		}
		return $result;
	}

	public function get_user_by_username($username, $fields='*')
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where('username', $username)
		->get()
		->row_array();
		return $db_temp;
	}

	public function get_user_by_mobile($mobile, $fields='*')
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where('mobile', $mobile)
		->get()
		->row_array();
		return $db_temp;
	}

	public function get_user_by_email($email, $fields='*')
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where('email', $email)
		->get()
		->row_array();
		return $db_temp;
	}

	/**
	*根据条件查询
	*/
	public function get_info_by_where($where, $fields='*'){
		$result = $this->db->select($fields)
		->from($this->mTable)
		->where($where,NULL,FALSE)
		->get()
		->row_array();
		return $result;
	}

	public function login_update($id, $last_datetime, $last_ip)
	{
		$this->db->set('lastlogintime', $last_datetime, FALSE);
		//$this->db->set('last_ip', $last_ip, FALSE);
		//$this->db->set('login_num', 'login_num+1', FALSE);
		//$this->db->set('security_code', $this->security_code);
		$this->db->where('id', $id);
		return $this->db->update($this->mTable);
	}

	/**
	*更新email
	*/
	public function email_update($id, $email, $email_true){
		if(empty($id)) return 0;

		$email_true=($email_true==1)?1:0;
		if($email){
			$this->db->set('email', $email);
		}
		//$this->db->set('email_true', $email_true, FALSE);
		$this->db->where('id', $id);
		return $this->db->update($this->mTable);
	}

	/**
	*通过用户表id更新
	*/
	public function update_by_id($id, $data){
		$where = array('id'=> $id);
		$sql = $this->db->update_string($this->mTable, $data, $where);
		return $this->db->query($sql);
	}

	public function get_user_by_id($id, $fields='*')
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where('id', $id)
		->get()
		->row_array();

		return $db_temp;
	}

	public function get_user_by_ids($id, $fields = "*")
	{
		$db_temp = $this->db->select($fields)
		->from($this->mTable)
		->where_in('id', $id)
		->get()
		->result_array();
		return $db_temp;
	}

	public function user_mobile_check($val)
	{
		$db_temp = $this->db->select('count(1) as num ',false)
		->from($this->mTable)
		->where('mobile', $val)
		->get()
		->row_array();
		return $db_temp['num'];
	}

	public function user_email_check($val)
	{
		$db_temp = $this->db->select('count(1) as num ',false)
		->from($this->mTable)
		->where('email', $val)
		->get()
		->row_array();
		return $db_temp['num'];
	}

	public function user_username_check($val)
	{
		$db_temp = $this->db->select('count(1) as num ',false)
		->from($this->mTable)
		->where('username', $val)
		->get()
		->row_array();
		return $db_temp['num'];
	}

	 /**
     * 增加访问量
     * @param $id
     * 
     */
    public function add_hit_num($id, $flag=0)
    {
        $this->db->set('hit_num', 'hit_num+1', FALSE);
        if ($flag)
        {
            $this->db->set('hit_yestoday_num', 'hit_today_num', FALSE);
            $this->db->set('hit_today_num', '0', FALSE);
            $this->db->set('hit_flag', $flag, FALSE);
        }else
        {
            $this->db->set('hit_today_num', 'hit_today_num+1', FALSE);
        }
        $this->db->where('id', $id);
        return $this->db->update($this->mTable); 
    }
        

}
