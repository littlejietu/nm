<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AdvSpacesModel extends MY_Model
{
    /*根据获得广告位详细信息*/
    public function getSpacesId($adv_spaces_id = 0)
    {
        $sqlInfo = array(
            'fields' => array(
                'adv_spaces_id',
                'adv_spaces_title',
                'adv_spaces_money',
                'adv_spaces_height',
                'adv_spaces_width',
                'is_show',
                'add_time',
                'last_update',
            ),
            'table' => 'adv_spaces',
            'where'  => array(),
         );
        if ($adv_spaces_id != 0) {
            $sqlInfo['where'] = array(
                'adv_spaces_id="' . $adv_spaces_id . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list)?array():$list[0];
    }

    /*根据状态读取广告位信息*/
    public function getSpacesShow($isshow = -1)
    {
        $sqlInfo = array(
            'fields' => array(
                'adv_spaces_id',
                'adv_spaces_title',
                'adv_spaces_money',
                'adv_spaces_height',
                'adv_spaces_width',
            ),
            'table' => 'adv_spaces',
            'where'  => array(),
        );
        if ($isshow > -1) {
            $sqlInfo['where'] = array(
                'is_show="' . $isshow . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list)?array():$list;
    }

    /*取广告位条数*/
    public function getAdvSpacesNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(adv_spaces_id) as num',
            ),
            'table' => 'adv_spaces',
            'where' => array(
//                'is_show = 1',
            ),
            'order' => array(),
            'limit' => '',
        );
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /*取广告位信息*/
    public function getAdvSpaces($page, $perPage)
    {
        $sqlInfo = array(
            'fields' => array(
                'adv_spaces_id',
                'adv_spaces_title',
                'adv_spaces_money',
                'adv_spaces_height',
                'adv_spaces_width',
                'is_show',
                'add_time',
                'last_update',
            ),
            'table' => 'adv_spaces',
//            'where' => array(
//                'is_show = 1',
//            ),
            'order' => array(
                'last_update desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    //添加广告位
    public function addAdvSpaces($advspaces)
    {
        $sqlInfo = array(
            'fields' => $advspaces,
            'table' => 'adv_spaces',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    //删除广告位
    public function deleteAdvSpaces($adv_spaces_id)
    {
        $sqlInfo = array(
            'table' => 'adv_spaces',
            'where' => array(
                'adv_spaces_id = "' . $adv_spaces_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    //修改广告位信息
    public function editAdvSpaces($advspaces)
    {
        $sqlInfo = array(
            'fields' => $advspaces,
            'table'     => 'adv_spaces',
            'where'     => array(
                    'adv_spaces_id  = "' . $advspaces['adv_spaces_id'] . '"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*根据广告ID获得广告详细信息*/
    public function getAdvId($adv_id = 0)
    {
        $sqlInfo = array(
            'fields' => array(
                'adv_id',
                'adv_spaces_id',
                'adv_spaces_name',
                'adv_title',
                'adv_money',
                'adv_imgs',
                'adv_url',
                'adv_content',
                'adv_remark',
                'adv_user_id',
                'adv_user_name',
                'adv_user_real_name',
                'adv_start_time',
                'adv_end_time',
                'sort',
                'is_show',
                'click_number',
                'add_time',
                'last_update',
            ),
            'table' => 'advertiser',
            'where' => array(),
        );
        if ($adv_id != 0) {
            $sqlInfo['where'] = array(
                'adv_id="' . $adv_id . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list[0];
    }

    /*取广告信息条数*/
    public function getAdvertiserNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(adv_id) as num',
            ),
            'table' => 'advertiser',
            'where' => array( //                'is_show = 1',
            ),
            'order' => array(),
            'limit' => '',
        );
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /*取广告*/
    public function getAdvertiser($page, $perPage)
    {
        $sqlInfo = array(
            'fields' => array(
                'adv_id',
                'adv_spaces_id',
                'adv_spaces_name',
                'adv_title',
                'adv_money',
                'adv_imgs',
                'adv_url',
                'adv_content',
                'adv_remark',
                'adv_user_id',
                'adv_user_name',
                'adv_user_real_name',
                'adv_start_time',
                'adv_end_time',
                'sort',
                'is_show',
                'click_number',
                'add_time',
                'last_update',
            ),
            'table' => 'advertiser',
//            'where' => array(
//                'is_show = 1',
//            ),
            'order' => array(
                'is_show desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    //添加广告
    public function addAdvertiser($advertiser)
    {
        $sqlInfo = array(
            'fields' => $advertiser,
            'table' => 'advertiser',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    //删除广告
    public function deleteAdvertiser($adv_id)
    {
        $sqlInfo = array(
            'table' => 'advertiser',
            'where' => array(
                'adv_id = "' . $adv_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    //修改广告
    public function editAdvertiser($advertiser)
    {
        $sqlInfo = array(
            'fields'=> $advertiser,
            'table' => 'advertiser',
            'where' => array(
                'adv_id  = "' . $advertiser['adv_id'] . '"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

}