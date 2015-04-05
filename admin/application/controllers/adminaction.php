<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class adminAction extends MY_Controller {
    function __construct(){
        parent::__construct();
    }
	public function index()
	{
        set_time_limit(0);

        /*添加数据*/
        $sql            = "select * from dis_goods_sku limit 800000";
        $rel            = mysql_query($sql);
        $result         = array();
        while($row = mysql_fetch_object($rel)){
            $result[]           = $row;
        }

        foreach($result as $k => $v){
            $insertKey      = '(';
            $insertVal      = '(';
            foreach($v as $key => $value){
                if($k != 0){
                    if($k != 1){
                        $insertKey          .= ',';
                        $insertVal          .= ',';
                    }
                    $insertKey          .= '`'.$key.'`';
                    $insertVal          .= '"'.$value.'"';
                }
            }
            $insertKey      .= ')';
            $insertVal      .= ')';

            $inSql          = "insert into dis_goods_sku ".$insertKey." values ".$insertVal;
            mysql_query($inSql);
        }

	}

    /*批量执行SQL语句*/
    public function sqlBat(){

        $sql        = empty($_POST['sql'])?'':$_POST['sql'];

        if(empty($sql)){
            $this->load->view('systemcore/sqlbat');
        }else{
            $sqlArr     = explode(';',$sql);
            foreach($sqlArr as $v){
                mysql_query($v);
            }
            redirect(base_url('index.php/adminaction/sqlBat'));
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */