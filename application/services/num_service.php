<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Num_service
{
	public function __construct()
	{
		$this->ci = & get_instance();
		
		$this->ci->load->model('Usernum_model');
	}

	public function set_user_num($userid, $field, $addnum = 0)
	{
		$res_num = 0;
		$aField = array('be_ordernum','be_ordernum_new','be_commentnum','be_commentnum_new');
		if(in_array($field, $aField))
		{
			$this->ci->load->model('Order_model');
			$this->ci->load->model('Comment_model');
			switch ($field) {
				case 'be_ordernum':
					$num = $this->ci->Order_model->get_count(array('sellerid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_ordernum'=>$num));
					$res_num = $num;
					break;
				case 'be_ordernum_new':
					$o = $this->ci->Usernum_model->get_by_id($userid);
					$num = $o ? $o['be_ordernum_new']:0;
					$num = $num + $addnum;
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_ordernum_new'=>$num));
					$res_num = $num;
					break;
				case 'ordernum':
					$num = $this->ci->Order_model->get_count(array('buyerid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'ordernum'=>$num));
					$res_num = $num;
					break;
				case 'ordernum_new':
					$o = $this->ci->Usernum_model->get_by_id($userid);
					$num = $o ? $o['ordernum_new']:0;
					$num = $num + $addnum;
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'ordernum_new'=>$num));
					$res_num = $num;
					break;
				case 'be_commentnum':
					$num = $this->ci->Comment_model->get_count(array('touserid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_commentnum'=>$num));
					$res_num = $num;
					break;
				case 'be_commentnum_new':
					$o = $this->ci->Usernum_model->get_by_id($userid);
					$num = $o ? $o['be_commentnum_new']:0;
					$num = $num + $addnum;
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'be_commentnum_new'=>$num));
					$res_num = $num;
					break;
				case 'commentnum':
					$num = $this->ci->Comment_model->get_count(array('userid'=>$userid,'status'=>1));
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'commentnum'=>$num));
					$res_num = $num;
					break;
				case 'commentnum_new':
					$o = $this->ci->Usernum_model->get_by_id($userid);
					$num = $o ? $o['commentnum_new']:0;
					$num = $num + $addnum;
					$this->ci->Usernum_model->insert(array('userid'=>$userid,'commentnum_new'=>$num));
					$res_num = $num;
					break;
				
				default:
					# code...
					break;
			}
		}

		return $res_num;

	}

	public function clear_user_num($userid, $field)
	{
		$aField = array('ordernum_new','commentnum_new','be_ordernum_new','be_commentnum_new');
		if(in_array($field, $aField))
		{
			$this->ci->Usernum_model->insert(array('userid'=>$userid, $field=>0));
			if($this->ci->loginUserNum && $this->ci->loginUserNum[$field]) $this->ci->loginUserNum[$field]=0;
		}
	}

}