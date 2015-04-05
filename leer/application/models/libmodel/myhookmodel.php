<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 小鸟
 * Date: 15-1-21
 * Time: 上午9:58
 */
class MyHookModel extends MY_Model {

    /*查询用户购物车数量*/
    public function getUserCartNum($userId){
        $selectArr      = array(
            'fields'    => array(
                'count(cart_id) as cartNum',
            ),
            'table'     => 'cart',
            'where'     => array(
                'user_id = "' . $userId . '"',
            ),
        );
        $selectList                 = $this->CoreSelect($selectArr);
        return (empty($selectList[0]))?'0':$selectList[0]->cartNum;
    }

}

/* End of file excelfacmodel.php */
/* Location: ./application/model/lib/excelfacmodel.php */