<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ActivityModel extends MY_Model
{

    /**
     * 活动规则
     **/
    /**
     * 根据获得活动规则详细信息
     * */
    public function getActiId($acti_id = 0)
    {
        $sqlInfo = array(
            'fields' => array(
                'acti_id',
                'acti_title',
                'sort',
                'is_show',
                'add_time',
                'last_time',
            ),
            'table' => 'activity',
            'where' => array(),
        );
        if ($acti_id != 0) {
            $sqlInfo['where'] = array(
                'acti_id="' . $acti_id . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list[0];
    }

    /**
     * 取活动规则信息条数--分页
     * */
    public function getActivityNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(acti_id) as num',
            ),
            'table' => 'activity',
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

    /**
     * 取活动信息--分页
     **/
    public function getActivity($page, $perPage)
    {
        $sqlInfo = array(
            'fields' => array(
                'acti_id',
                'acti_title',
                'sort',
                'is_show',
                'add_time',
                'last_time',
            ),
            'table' => 'activity',
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

    /**
     * 添加活动
     **/
    public function addActivity($activity)
    {
        $sqlInfo = array(
            'fields' => $activity,
            'table' => 'activity',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /**
     * 删除活动
     **/
    public function deleteActivity($acti_id)
    {
        $sqlInfo = array(
            'table' => 'activity',
            'where' => array(
                'acti_id = "' . $acti_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /**
     * 修改活动信息
     **/
    public function editActivity($activity)
    {
        $sqlInfo = array(
            'fields' => $activity,
            'table' => 'activity',
            'where' => array(
                'acti_id  = "' . $activity['acti_id'] . '"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /**
     * 根据状态读取活动规则信息
     **/
    public function getActivityShow($isshow = -1)
    {
        $sqlInfo = array(
            'fields' => array(
                'acti_id',
                'acti_title',
                'sort',
                'is_show',
                'add_time',
                'last_time',
            ),
            'table' => 'activity',
            'where' => array(),
        );
        if ($isshow > -1) {
            $sqlInfo['where'] = array(
                'is_show="' . $isshow . '"',
            );
        }
        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list;
    }

    /**
     * 红包model
     **/

    /**
     * 根据红包规则ID获得详细信息
     * */
    public function getRedbagruleId($rbr_id = 0)
    {
        $sqlInfo = array(
            'fields' => array(
                'rbr_id',
                'rbr_title',
                'acti_id',
                'acti_title',
                'rbr_money',
                'rbr_meet_money',
                'sort',
                'is_show',
                'rbr_start_time',
                'rbr_end_time',
                'add_time',
                'last_update',
            ),
            'table' => 'redbagrule',
            'where' => array(),
        );
        if ($rbr_id != 0) {
            $sqlInfo['where'] = array(
                'rbr_id="' . $rbr_id . '"',
            );
        }

        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list[0];
    }

    /**
     * 取红包规则信息条数--分页
     **/
    public function getRedbagruleNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(rbr_id) as num',
            ),
            'table' => 'redbagrule',
            'where' => array(),
            'order' => array(),
            'limit' => '',
        );
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /**
     * 取红包规则信息--分页
     **/
    public function getRedbagruleList($page, $perPage)
    {
        $sqlInfo = array(
            'fields' => array(
                'rbr_id',
                'rbr_title',
                'acti_id',
                'acti_title',
                'rbr_money',
                'rbr_meet_money',
                'sort',
                'is_show',
                'rbr_start_time',
                'rbr_end_time',
                'add_time',
                'last_update',
            ),
            'table' => 'redbagrule',
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

    /**
     * 添加红包规则
     **/
    public function addRedbagrule($redbagrule)
    {
        $sqlInfo = array(
            'fields' => $redbagrule,
            'table' => 'redbagrule',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /**
     * 修改红包规则
     **/
    public function editRedbagrule($redbagrule)
    {
        $sqlInfo = array(
            'fields' => $redbagrule,
            'table' => 'redbagrule',
            'where' => array(
                'rbr_id  = "' . $redbagrule['rbr_id'] . '"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /**
     * 根据红包规则ID删除
     **/
    public function deleteRedbagrule($rbr_id)
    {
        $sqlInfo = array(
            'table' => 'redbagrule',
            'where' => array(
                'rbr_id = "' . $rbr_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /**
     * 红包派发操作
     **/

    /**
     *添加红包
     **/
    public function addRedaggift($activityredpackets)
    {
        $sqlInfo = array(
            'fields' => $activityredpackets,
            'table' => 'activity_redpackets',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /**
     *根据用户ID跟红包id查询记录
     **/
    public function  getRedaggiftList($userid, $rbr_id)
    {
        $sqlInfo = array(
            'table' => 'activity_redpackets',
            'where' => array(
                'user_id = "' . $userid . '"',
                'rbr_id = "' . $rbr_id . '"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /**
     * 读取红包赠送信息--分页
     **/
    public function RedaggiftList($page, $perPage)
    {
        $sqlInfo = array(
            'fields' => array(
                'acti_redp_id',
                'rbr_id',
                'user_id',
                'user_name',
                'is_show',
                'istatus',
                'acti_details_content',
                'add_time',
                'last_time',
            ),
            'table' => 'activity_redpackets',
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

    /**
     * 读取红包赠送数量--分页
     **/
    public function getRedaggiftNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(acti_redp_id) as num',
            ),
            'table' => 'activity_redpackets',
            'where' => array(),
            'order' => array(),
            'limit' => '',
        );
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /**
     * 删除赠送红包
     * */
    public function deleteRedaggift($acti_redp_id)
    {
        $sqlInfo = array(
            'table' => 'activity_redpackets',
            'where' => array(
                'acti_redp_id = "' . $acti_redp_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /**
     * 优惠码规则
     **/

    /**
     * 根据 优惠码规则ID获得详细信息
     **/
    public function getDiscountCodeRuleId($dc_id = 0)
    {
        $sqlInfo = array(
            'table' => 'discount_code_rule',
            'where' => array(),
        );
        if ($dc_id != 0) {
            $sqlInfo['where'] = array(
                'dc_id="' . $dc_id . '"',
            );
        }

        $list = $this->CoreSelect($sqlInfo);
        return empty($list) ? array() : $list[0];
    }

    /**
     * 取优惠码规则息条数--分页
     **/
    public function getDiscountCodeRuleNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(dc_id) as num',
            ),
            'table' => 'discount_code_rule',
            'where' => array(),
            'order' => array(),
            'limit' => '',
        );
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /**
     * 取优惠码规则信息--分页
     **/
    public function getDiscountCodeRuleList($page, $perPage)
    {
        $sqlInfo = array(
            'fields' => array(
                'dc_id',
                'dc_title',
                'acti_id',
                'acti_title',
                'dc_money',
                'dc_meet_money',
                'sort',
                'is_show',
                'dc_start_time',
                'dc_end_time',
                'dc_valid_cycle',
                'add_time',
                'last_update',
            ),
            'table' => 'discount_code_rule',
            'order' => array(
                'is_show desc'
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /**
     * 添加优惠码规则
     **/
    public function addDiscountCodeRule($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table' => 'discount_code_rule',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /**
     * 修改优惠码规则
     **/
    public function editDiscountCodeRule($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table' => 'discount_code_rule',
            'where' => array(
                'dc_id  = "' . $model['dc_id'] . '"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /**
     * 根据优惠码规则ID删除
     **/
    public function deleteDiscountCodeRule($dc_id)
    {
        $sqlInfo = array(
            'table' => 'discount_code_rule',
            'where' => array(
                'dc_id = "' . $dc_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /**
     *添加优惠码
     **/
    public function addActivityDiscountCodes($model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table' => 'activity_discount_codes',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /**
     * 读取优惠码赠送信息--分页
     **/
    public function ActivityDiscountCodesList($page, $perPage)
    {
        $sqlInfo = array(
            'fields' => array(
                'adc_id',
                'dc_id',
                'dc_coding',
                'dc_pws',
                'user_id',
                'user_name',
                'is_show',
                'istatus',
                'adc_details_content',
                'adc_start_time',
                'adc_end_time',
                'add_time',
                'last_time',
            ),
            'table' => 'activity_discount_codes',
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

    /**
     * 读取优惠码赠送数量--分页
     **/
    public function getActivityDiscountCodesNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(adc_id) as num',
            ),
            'table' => 'activity_discount_codes',
            'where' => array(),
            'limit' => '',
        );
        foreach ($sqlInfo as $key => $value) {
            $this->$key = $value;
        }

        $list = $this->CoreSelect();
        return $list[0]->num;
    }

    /**
     *根据用户ID跟红包id查询记录
     **/
    public function getDiscountCodeList($userid, $dc_id)
    {
        $sqlInfo = array(
            'table' => 'activity_discount_codes',
            'where' => array(
                'user_id = "' . $userid . '"',
                'dc_id = "' . $dc_id . '"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /**
     * 删除赠送优惠码
     * */
    public function deleteActivityDiscountCodes($adc_id)
    {
        $sqlInfo = array(
            'table' => 'activity_discount_codes',
            'where' => array(
                'adc_id = "' . $adc_id . '"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

}