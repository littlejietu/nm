<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UcenterModel extends MY_Model {
    /*删除会员信息*/
    public function delUser($userId){
        $sqlInfo = array(
            'table'     => 'user',
            'where'     => array(
                'user_id  = "' . $userId . '"',
            ),
        );
        $this->CoreDelete($sqlInfo);
    }

    /*编辑会员信息*/
    public function updateUser($sql,$userid){
        $sqlInfo = array(
            'fields' => $sql,
            'table'     => 'user',
            'where'     => array(
                'user_id  = "' . $userid . '"',
            ),
        );
        $this->CoreUpdate($sqlInfo);
    }

    /*添加会员*/
    public function insertUser($sql){
        $sqlInfo = array(
            'fields' => $sql,
            'table'     => 'user',
        );
        $this->CoreInsert($sqlInfo);
    }

    /*根据用户名取会员信息*/
    public function getUserInfoFromUserName($userName){
        $sqlInfo = array(
            'fields' => array(
                'user_id',
                'user_name',       //用户名
            ),
            'table'     => 'user',
            'where'     => array(
                'user_name  = "' . $userName . '"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?'':$list[0];
    }

    /*根据用户名取会员信息*/
    public function getUserInfoFromUserEmail($userEmail){
        $sqlInfo = array(
            'fields' => array(
                'user_id',
                'user_name',       //用户名
            ),
            'table'     => 'user',
            'where'     => array(
                'user_mail  = "' . $userEmail . '"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?'':$list[0];
    }

    /**
     * 根据会员ID获取会员信息
     */
    public function getUserId($userid){
        $sqlInfo = array(
            'table'     => 'user',
            'where'     => array(
                'user_id  = "' . $userid . '"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?'':$list[0];
    }

    /**
     * 获取会员列表
    */
    public function getUser(){
        $sqlInfo = array(
            'table'     => 'user',
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /**
     *更改用户锁定状态
     */
    public function updateLock($filter){
        $sqlInfo = array(
            'fields'    => array(
                'is_lock'   => $filter['is_lock'],
            ),
            'table'     => 'user',
            'where'     => array(
                'user_id  = "' . $filter['userId'] . '"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */