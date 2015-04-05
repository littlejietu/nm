<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class GoodsReviewModel extends MY_Model
{
    /*按照分页获取评论列表*/
    public function getReviewListFromPage($page, $perPage, $goodsSn = '')
    {
        $sqlInfo = array(
            'fields'    => array(
                '*',
            ),
            'table'     => 'goods_review',
            'order'     => array('is_cream desc,last_update desc'),
            'limit'     => ($page-1)*$perPage.','.$perPage,
        );
        if($goodsSn){
            $sqlInfo['where']   = array('goods_sn = "'.$goodsSn.'"');
        }

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?array():$list;
    }

    /*获取评论总数*/
    public function getReviewNum($goodsSn = '')
    {
        $sqlInfo = array(
            'fields'    => array(
                'count(review_id) as total',
            ),
            'table'     => 'goods_review',
            'order'     => array('is_cream desc,last_update desc'),
        );
        if($goodsSn){
            $sqlInfo['wuere']   = array('goods_sn = "'.$goodsSn.'"');
        }

        $list = $this->CoreSelect($sqlInfo);
        return empty($list[0])?0:$list[0]->total;
    }

    /*删除评论*/
    public function delReview($reviewId){
        $sqlInfo = array(
            'table'     => 'goods_review',
            'where'     => array('review_id = "'.$reviewId.'"'),
        );

        $this->CoreDelete($sqlInfo);
    }

    /*评论加精*/
    public function setCream($reviewId,$creamNum){
        $sqlInfo = array(
            'fields'    => array(
                'is_cream'      => $creamNum,
                'last_update'   => time(),
            ),
            'table'     => 'goods_review',
            'where'     => array('review_id = "'.$reviewId.'"'),
        );

        $this->CoreUpdate($sqlInfo);
    }



}