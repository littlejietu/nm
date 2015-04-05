<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ArticleModel extends MY_Model {
    /*取当前页信息*/
    public function getArticleListFromPage($classIdStr,$page,$perPage){
        $sqlInfo = array(
            'table'     => 'article',
            'where'     => array(
                'art_class_id in ('.$classIdStr.')',
            ),
            'limit'     => ($page-1)*$perPage.','.$perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list)?array():$list;
    }

    /*取信息总数*/
    public function getArticleNum($classIdStr){
        $sqlInfo = array(
            'fields'    => array(
                'count(art_id) as num'
            ),
            'table'     => 'article',
            'where'     => array(
                'art_class_id in ('.$classIdStr.')',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list)?0:$list[0]->num;
    }

    /*取信息详细信息*/
    public function getArticleInfo($artId){
        $sqlInfo = array(
            'table'     => 'article',
            'where'     => array('art_id = "'.$artId.'"'),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list)?'':$list[0];
    }

    /*根据用户级别取信息列表*/
    public function getArticle($userLevel,$userId){
        $sqlInfo = array(
            'table'     => 'article',
            'where'     => array(),
            'groupby'   => '',
            'order'     => array(),
            'limit'     => '',
        );

        //根据用户权限取信息
        switch($userLevel){
            case 4:
                $sqlInfo['where'] = array(
                    '(is_p2p = 0 or FIND_IN_SET("'.$userId.'",to_user_id))',
                );
                break;
            case 3:
                $sqlInfo['where'] = array(
                    '(is_p2p = 0 or to_user_id = "'.$userId.'" FIND_IN_SET("'.$userId.'",to_user_id))',
                );
                break;
            default:
                $sqlInfo['where'] = array();
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*添加信息*/
    public function addArticle($addInfo){
        $sqlInfo = array(
            'fields'    => $addInfo,
            'table'     => 'article'
        );

        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*更新信息*/
    public function updateArticle($addInfo,$artId){
        $sqlInfo = array(
            'fields'    => $addInfo,
            'table'     => 'article',
            'where'     => array(
                'art_id = "'.$artId.'"',
            ),
        );

        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*删除信息*/
    public function delArticle($artId){
        $sqlInfo = array(
            'table'     => 'article',
            'where'     => array(
                'art_id = "'.$artId.'"',
            ),
        );

        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /*详细信息*/
    public function getDetail($id,$userLevel,$userId){
        $sqlInfo = array(
            'fields'    => array(
                '*',
            ),
            'table'     => 'article',
            'where'     => array(),

        );

        //根据用户权限取信息
        switch($userLevel){
            case 4:
                $sqlInfo['where'] = array(
                    '(is_p2p = 0 or FIND_IN_SET("'.$userId.'",to_user_id))',
                    'art_id = "'.$id.'"'
                );
                break;
            case 3:
                $sqlInfo['where'] = array(
                    '(is_p2p = 0 or to_user_id = "'.$userId.'" FIND_IN_SET("'.$userId.'",to_user_id))',
                    'art_id = "'.$id.'"'
                );
                break;
            default:
                $sqlInfo['where'] = array(
                    'art_id = "'.$id.'"'
                );
        }

        $list = $this->CoreSelect($sqlInfo);
        return $list[0];
    }

    /*更新文章为当前用户已读*/
    public function changeReadType($id,$isRead){
        $sqlInfo = array(
            'fields' => array(
                'is_read'           => $isRead,
                'last_update'       => time(),
            ),
            'table' => 'article',
            'where' => array(
                'art_id = "'.$id.'"',
            ),
        );

        $this->CoreUpdate($sqlInfo);
    }

    /*添加信息的时候 取信息的分类*/
    public function getClassList(){
        $sqlInfo = array(
            'fields'    => array(
                'cat_id',
                'cat_real_id',
                'cat_name',
                'cat_type',
            ),
            'table'     => 'category',
            'where'     => array('cat_type=0'),
            'order'     => array('cat_real_id asc'),
        );

        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*添加友情链接*/
    public  function  addFriendlyLinks($model){
    $sqlInfo = array(
        'fields' => $model,
        'table'  => 'friendly_links',
    );
    $list = $this->CoreInsert($sqlInfo);
    return $list;
    }

    /*修改友情链接*/
    public function  updateFriendlyLinks($flid,$model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table'  => 'friendly_links',
            'where'  => array(
             'fl_id ="'.$flid.'"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*根据ID查询友情链接信息*/
    public  function getFriendlyLinksId($flid)
    {
        $sqlInfo = array(
            'table'  => 'friendly_links',
            'where'  => array(
                'fl_id ="'.$flid.'"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据ID删除友情链接*/
    public function delFriendlyLinksId($flid)
    {
        $sqlInfo = array(
            'table'  => 'friendly_links',
            'where'  => array(
                'fl_id ="'.$flid.'"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;

    }

    /**
     * 取友情链接数量--分页
     * */
    public function getFriendlyLinksNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(fl_id) as num',
            ),
            'table' => 'friendly_links',
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
     * 取友情链接信息--分页
     **/
    public function getFriendlyLinks($page, $perPage)
    {
        $sqlInfo = array(
            'table' => 'friendly_links',
            'where' => array(),
            'order' => array(
                'is_show desc',
                'sort asc',
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }


    /*添加门店管理*/
    public  function  addShopManage($model){
        $sqlInfo = array(
            'fields' => $model,
            'table'  => 'shop_manage',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*修改友情链接*/
    public function  updateShopManage($smid,$model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table'  => 'shop_manage',
            'where'  => array(
                'sm_id ="'.$smid.'"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*根据ID查询门店管理信息*/
    public  function getShopManageId($smid)
    {
        $sqlInfo = array(
            'table'  => 'shop_manage',
            'where'  => array(
                'sm_id ="'.$smid.'"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据ID删除门店管理*/
    public function delShopManageId($smid)
    {
        $sqlInfo = array(
            'table'  => 'shop_manage',
            'where'  => array(
                'sm_id ="'.$smid.'"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;

    }

    /**
     * 取门店管理数量--分页
     * */
    public function getShopManageNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(sm_id) as num',
            ),
            'table' => 'shop_manage',
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
     * 取门店管理信息--分页
     **/
    public function getShopManage($page, $perPage)
    {
        $sqlInfo = array(
            'table' => 'shop_manage',
            'where' => array(),
            'order' => array(
                'is_show desc',
                'sort asc',
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }


    /*添加订阅邮件管理*/
    public  function  addSubscribeEmail($model){
        $sqlInfo = array(
            'fields' => $model,
            'table'  => 'subscribe_email',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*修改订阅邮件*/
    public function  updateSubscribeEmail($seid,$model)
    {
        $sqlInfo = array(
            'fields' => $model,
            'table'  => 'subscribe_email',
            'where'  => array(
                'se_id ="'.$seid.'"',
            ),
        );
        $list = $this->CoreUpdate($sqlInfo);
        return $list;
    }

    /*根据ID查询订阅邮件信息*/
    public  function getSubscribeEmailId($seid)
    {
        $sqlInfo = array(
            'table'  => 'subscribe_email',
            'where'  => array(
                'se_id ="'.$seid.'"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据ID删除订阅邮件*/
    public function delSubscribeEmailId($seid)
    {
        $sqlInfo = array(
            'table'  => 'subscribe_email',
            'where'  => array(
                'se_id ="'.$seid.'"',
            ),
        );
        $list = $this->CoreDelete($sqlInfo);
        return $list;
    }

    /**
     * 取订阅邮件数量--分页
     * */
    public function getSubscribeEmailNum()
    {
        $sqlInfo = array(
            'fields' => array(
                'count(se_id) as num',
            ),
            'table' => 'subscribe_email',
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
     * 取订阅邮件信息--分页
     **/
    public function getSubscribeEmail($page, $perPage)
    {
        $sqlInfo = array(
            'table' => 'subscribe_email',
            'where' => array(),
            'order' => array(
                'is_show desc',
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */