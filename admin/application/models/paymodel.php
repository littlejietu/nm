<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PayModel extends MY_Model {
    /*获取支付列表*/
    public function getPayList(){
        $sqlInfo        = array(
            'table'         => 'pay',
        );
        $list           = $this->CoreSelect($sqlInfo);
        return empty($list[0])?array():$list;
    }
    /*修改支付信息*/
    public function editPay($sql){
        $sqlInfo        = array(
            'fields'        => $sql,
            'table'         => 'pay',
            'where'         => array(
                'pay_id = 1'
            )
        );
        $this->CoreUpdate($sqlInfo);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */