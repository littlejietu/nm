<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class ArticleModel extends MY_Model
{
    /*取分类名*/
    public function getCatName($classId)
    {
        $sqlInfo = array(
            'fields' => array(
                'cat_name',
            ),
            'table' => 'category',
            'where' => array(
                'cat_id = "' . $classId . '"',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0]->cat_name;
    }

    /*赞信息*/
    public function addLike($id, $num)
    {
        $sqlInfo = array(
            'fields' => array(
                'art_likes' => $num,
            ),
            'table' => 'article',
            'where' => array('art_id = "' . $id . '"'),
        );
        $this->CoreUpdate($sqlInfo);
    }

    /*增加信息阅读数*/
    public function addRead($id, $num)
    {
        $sqlInfo = array(
            'fields' => array(
                'art_views' => $num,
            ),
            'table' => 'article',
            'where' => array('art_id = "' . $id . '"'),
        );
        $this->CoreUpdate($sqlInfo);
    }

    /*取信息详细信息*/
    public function getArticleInfo($artId)
    {
        $sqlInfo = array(
            'table' => 'article',
            'where' => array('art_id = "' . $artId . '"'),
        );
        $list = $this->CoreSelect($sqlInfo);

        $nextSqlInfo = array(
            'table' => 'article',
            'where' => array('art_id < "' . $artId . '"'),
            'limit' => '1',
        );
        $nextList = $this->CoreSelect($nextSqlInfo);

        $prevSqlInfo = array(
            'table' => 'article',
            'where' => array('art_id > "' . $artId . '"'),
            'limit' => '1',
        );
        $prevList = $this->CoreSelect($prevSqlInfo);

        $list['next'] = empty($nextList[0]) ? array() : $nextList[0];
        $list['prev'] = empty($prevList[0]) ? array() : $prevList[0];
        return $list;
    }

    /*按照分类 取信息总数*/
    public function getArtNum($artIds)
    {
        $sqlInfo = array(
            'fields' => array(
                'count(art_id) as artNum',
            ),
            'table' => 'article',
            'where' => array(
                'art_class_id in (' . $artIds . ')',
                'is_show = 1',
                'is_delete = 0',
            ),
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? '' : $list[0]->artNum;
    }

    /*取当前页信息*/
    public function getArtList($artIds, $page, $perPage)
    {
        $sqlInfo = array(
            'fields' => array(
                'art_id',
                'art_title',
                'art_intro',
                'art_img',
                'art_views',
                'art_likes',
                'add_time',
                'last_update',
            ),
            'table' => 'article',
            'where' => array(
                'art_class_id in (' . $artIds . ')',
                'is_show = 1',
                'is_delete = 0',
            ),
            'order' => array(
                'sort desc',
                'art_id desc',
            ),
            'limit' => ($page - 1) * $perPage . ',' . $perPage,
        );

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0]) ? array() : $list;
    }

    /**根据分类取最新资讯指定条数
     *$artclassid-分类ID、$limit-条数
     */
    public function getArtNewsTop($artclassid='', $limit='')
    {
        $sqlInfo = array(
            'fields' => array(
                'art_id',
                'art_title',
                'art_intro',
                'art_img',
                'art_url',
                'art_views',
                'art_likes',
            ),
            'table' => 'article',
            'where' => array('is_show = 1','is_rmd=1'),
            'order' => array(
                'add_time desc',
            ),
            'limit' => $limit,
        );

        if (!empty($artclassid)) {
            $sqlInfo['where'][] = 'art_class_id in(' . $artclassid . ')';
        }

        $list = $this->CoreSelect($sqlInfo);

        return empty($list[0]) ? array() : $list;
    }

    /*根据ID查询友情链接信息*/
    public  function getFriendlyLinks()
    {
        $sqlInfo = array(
            'table'  => 'friendly_links',
            'where'  => array(
                'is_show = 1 ',
            ),
            'order'  =>array(
                'sort asc'
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*根据ID查询门店管理信息*/
    public  function getShopManage()
    {
        $sqlInfo = array(
            'table'  => 'shop_manage',
            'order'  =>array(
                'sort asc'
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

    /*添加订阅邮件*/
    public  function  addSubscribeEmail($model){
        $sqlInfo = array(
            'fields' => $model,
            'table'  => 'subscribe_email',
        );
        $list = $this->CoreInsert($sqlInfo);
        return $list;
    }

    /*根据Email查询订阅邮件信息*/
    public  function getSubscribeEmailName($seemail)
    {
        $sqlInfo = array(
            'table'  => 'subscribe_email',
            'where'  => array(
                'se_email ="'.$seemail.'"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list;
    }

}

/* End of file goodsmodel.php */
/* Location: ./application/model/goodsmodel.php */