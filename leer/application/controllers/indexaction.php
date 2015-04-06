<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class indexAction extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->L('goodsmodel');
        $this->L('articlemodel');
        /*取两条精彩活动*/
//        $jingcaiList                = getList(23,2,0,1,1,1);

        /*取四条今日路线*/
//        $jinriList                  = getList(22,4,0,1,1,1);

        /*取四条茶余饭后*/
//        $chayuList                  = getList(25,4,0,1,1,1);

        /*取四条沿途记忆*/
//        $yantuList                  = getList(26,4,0,1,1,1);

        /*取1+6条热门专区*/
//        $remenList_1                = getList(24,1,0,1,1,1);
//        $remenList_6                = array();
//        if(!empty($remenList_1)){
//            $remenList_1                = $remenList_1[0];
//            $remenList_6                = getList(24,6,$remenList_1->art_id,1,1,1);
//        }

        /*取9条推荐商品*/
        $rmdGoods = getHotGoods(8, 3);
        foreach ($rmdGoods as $key => $value) {
            $rmdGoods[$key]->goods_short_name = mb_substr($value->goods_name, 0, 15, 'utf-8');
        }

        /*T恤-取六条推荐产品*/
        $classIdStr         = getChildClass(3); //取所有分类的组合
        $tshirtList = $this->goodsmodel->getList(array('cat_id in ('.$classIdStr.')', 'is_rmd=1', 'is_delete=0', 'is_on_sale=1'), 6);

        /*POLO-取六条推荐产品*/
        $classIdStr         = getChildClass(4); //取所有分类的组合
        $polpList = $this->goodsmodel->getList(array('cat_id in ('.$classIdStr.')', 'is_rmd=1', 'is_delete=0', 'is_on_sale=1'), 6);

        /*绒衫-取六条推荐产品*/
        $classIdStr         = getChildClass(5); //取所有分类的组合
        $fleeceList = $this->goodsmodel->getList(array('cat_id in ('.$classIdStr.')', 'is_rmd=1', 'is_delete=0', 'is_on_sale=1'), 6);

        /*移动-电源取六条推荐产品*/
        $classIdStr         = getChildClass(6); //取所有分类的组合
        $mobileList = $this->goodsmodel->getList(array('cat_id in ('.$classIdStr.')', 'is_rmd=1', 'is_delete=0', 'is_on_sale=1'), 6);

        /*箱包-取六条推荐产品*/
        $classIdStr         = getChildClass(10); //取所有分类的组合
        $bagList = $this->goodsmodel->getList(array('cat_id in ('.$classIdStr.')', 'is_rmd=1', 'is_delete=0', 'is_on_sale=1'), 6);

        /*生活百货-取六条推荐产品*/
        $classIdStr         = getChildClass(8); //取所有分类的组合
        $livingList = $this->goodsmodel->getList(array('cat_id in ('.$classIdStr.')', 'is_rmd=1', 'is_delete=0', 'is_on_sale=1'), 6);

        /*读取推荐品牌*/
        $this->L('goodsmodel');
        $brandAuthorizeList = $this->goodsmodel->getBrandList(array(), 1,1, 8);

        /*读取广告信息*/
        $this->L('advSpacesmodel');
        //首页-banner读取
        $bannerspaces = $this->advSpacesmodel->getSpacesId(1);
        if (!empty($bannerspaces)) {
            $bannerertiser = $this->advSpacesmodel->getSpacesIdList($bannerspaces[0]->adv_spaces_id);
            foreach ($bannerertiser as $k => $v) {
                $bannerertiser[$k]->adv_spaces_height = $bannerspaces[0]->adv_spaces_height;
                $bannerertiser[$k]->adv_spaces_width = $bannerspaces[0]->adv_spaces_width;
            }
        }


        //首页-新品发布-小图
        $newspacesone = $this->advSpacesmodel->getSpacesId(2);
        if (!empty($newspacesone)) {
            $newertiserone = $this->advSpacesmodel->getSpacesIdList($newspacesone[0]->adv_spaces_id, 3);
            foreach ($newertiserone as $k => $v) {
                $newertiserone[$k]->adv_spaces_height = $newspacesone[0]->adv_spaces_height;
                $newertiserone[$k]->adv_spaces_width = $newspacesone[0]->adv_spaces_width;
            }
        }

        //首页-新品发布-大图
        $newspacestwo = $this->advSpacesmodel->getSpacesId(3);
        if (!empty($newspacestwo)) {
            $newertisertwo = $this->advSpacesmodel->getSpacesIdList($newspacestwo[0]->adv_spaces_id, 2);
            foreach ($newertisertwo as $k => $v) {
                $newertisertwo[$k]->adv_spaces_height = $newspacestwo[0]->adv_spaces_height;
                $newertisertwo[$k]->adv_spaces_width = $newspacestwo[0]->adv_spaces_width;
            }
        }

        //首页-楼层广告1
        $spacesfloor1 = $this->advSpacesmodel->getSpacesId(4);
        if (!empty($spacesfloor1)) {
            $ertiserfloor1 = $this->advSpacesmodel->getSpacesIdList($spacesfloor1[0]->adv_spaces_id, 1);
            foreach ($ertiserfloor1 as $k => $v) {
                $ertiserfloor1[$k]->adv_spaces_height = $spacesfloor1[0]->adv_spaces_height;
                $ertiserfloor1[$k]->adv_spaces_width = $spacesfloor1[0]->adv_spaces_width;
            }
        }
        //首页-楼层广告2
        $spacesfloor2 = $this->advSpacesmodel->getSpacesId(5);
        if (!empty($spacesfloor2)) {
            $ertiserfloor2 = $this->advSpacesmodel->getSpacesIdList($spacesfloor2[0]->adv_spaces_id, 1);
            foreach ($ertiserfloor2 as $k => $v) {
                $ertiserfloor2[$k]->adv_spaces_height = $spacesfloor2[0]->adv_spaces_height;
                $ertiserfloor2[$k]->adv_spaces_width = $spacesfloor2[0]->adv_spaces_width;
            }
        }
        //首页-楼层广告3
        $spacesfloor3 = $this->advSpacesmodel->getSpacesId(6);
        if (!empty($spacesfloor3)) {
            $ertiserfloor3 = $this->advSpacesmodel->getSpacesIdList($spacesfloor3[0]->adv_spaces_id, 1);
            foreach ($ertiserfloor3 as $k => $v) {
                $ertiserfloor3[$k]->adv_spaces_height = $spacesfloor3[0]->adv_spaces_height;
                $ertiserfloor3[$k]->adv_spaces_width = $spacesfloor3[0]->adv_spaces_width;
            }
        }
        //首页-楼层广告4
        $spacesfloor4 = $this->advSpacesmodel->getSpacesId(7);
        if (!empty($spacesfloor1)) {
            $ertiserfloor4 = $this->advSpacesmodel->getSpacesIdList($spacesfloor4[0]->adv_spaces_id, 1);
            foreach ($ertiserfloor4 as $k => $v) {
                $ertiserfloor4[$k]->adv_spaces_height = $spacesfloor4[0]->adv_spaces_height;
                $ertiserfloor4[$k]->adv_spaces_width = $spacesfloor4[0]->adv_spaces_width;
            }
        }
        //首页-楼层广告5
        $spacesfloor5 = $this->advSpacesmodel->getSpacesId(8);
        if (!empty($spacesfloor5)) {
            $ertiserfloor5 = $this->advSpacesmodel->getSpacesIdList($spacesfloor5[0]->adv_spaces_id, 1);
            foreach ($ertiserfloor5 as $k => $v) {
                $ertiserfloor5[$k]->adv_spaces_height = $spacesfloor5[0]->adv_spaces_height;
                $ertiserfloor5[$k]->adv_spaces_width = $spacesfloor5[0]->adv_spaces_width;
            }
        }

        //首页-楼层广告6
        $spacesfloor6 = $this->advSpacesmodel->getSpacesId(9);
        if (!empty($spacesfloor6)) {
            $ertiserfloor6 = $this->advSpacesmodel->getSpacesIdList($spacesfloor6[0]->adv_spaces_id, 1);
            foreach ($ertiserfloor6 as $k => $v) {
                $ertiserfloor6[$k]->adv_spaces_height = $spacesfloor6[0]->adv_spaces_height;
                $ertiserfloor6[$k]->adv_spaces_width = $spacesfloor6[0]->adv_spaces_width;
            }
        }

        //读取友情链接
        $friendlyLinks = $this->articlemodel->getFriendlyLinks();

        //读取友情链接
        $shopManage = $this->articlemodel->getShopManage();

//        /*取5条最新商品*/
//        $newGoods           = getHotGoods(20,2);
//        foreach($newGoods as $key => $value){
//            $newGoods[$key]->goods_short_name = mb_substr($value->goods_name,0,15,'utf-8');
//        }

        $data = array(
//            'jingcaiList'   => $jingcaiList,
//            'jinriList'     => $jinriList,
//            'chayuList'     => $chayuList,
//            'yantuList'     => $yantuList,
//            'remenList_1'   => $remenList_1,
//            'remenList_6'   => $remenList_6,
//            'newGoods'      => $newGoods,
            'rmdGoods' => $rmdGoods,
            'tshirtList' => $tshirtList,
            'polpList' => $polpList,
            'fleeceList' => $fleeceList,
            'mobileList' => $mobileList,
            'bagList' => $bagList,
            'livingList' => $livingList,
            'bannerertiser' => empty($bannerertiser) ? array() : $bannerertiser,
            'newertiserone' => empty($newertiserone) ? array() : $newertiserone,
            'newertisertwo' => empty($newertisertwo) ? array() : $newertisertwo,
            'ertiserfloor1' => empty($ertiserfloor1) ? array() : $ertiserfloor1,
            'ertiserfloor2' => empty($ertiserfloor2) ? array() : $ertiserfloor2,
            'ertiserfloor3' => empty($ertiserfloor3) ? array() : $ertiserfloor3,
            'ertiserfloor4' => empty($ertiserfloor4) ? array() : $ertiserfloor4,
            'ertiserfloor5' => empty($ertiserfloor5) ? array() : $ertiserfloor5,
            'ertiserfloor6' => empty($ertiserfloor6) ? array() : $ertiserfloor6,
            'brandAuthorizeList' =>$brandAuthorizeList, //推荐品牌
            'friendlyLinks' =>empty($FriendlyLinks)?array():$FriendlyLinks, //友情链接
            'shopManage' =>empty($shopManage)?array():$shopManage, //门店管理
        );
        $this->load->view('index', $data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */