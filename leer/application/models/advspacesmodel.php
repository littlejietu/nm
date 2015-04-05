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
            'where' => array(),
        );
        if ($adv_spaces_id != 0) {
            $sqlInfo['where'] = array(
                'adv_spaces_id="' . $adv_spaces_id . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list;
    }

    /*根据广告位ID获得广告详细信息*/
    public function getSpacesIdList($adv_spaces_id = 0,$limit='')
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
            'where' => array(
                'adv_spaces_id="' . $adv_spaces_id . '"',
                'adv_start_time< ' . time() . '',
                'adv_end_time >' . time() . '',),
            'limit'     => ''.$limit.'',
        );


        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list;
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
        return empty($list) ? array() : $list;
    }
}