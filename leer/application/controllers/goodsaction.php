<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class goodsAction extends MY_Controller
{
    private $ProComArray = array(); //定义一个数组 存储浏览产品记录
    private $GoodsProComArray = array(); //定义一个数组 存储对比

    function __construct()
    {
        parent::__construct();

        $strRecentHistory = empty($_COOKIE['GoodsRecentHistory']) ? '' : $_COOKIE['GoodsRecentHistory']; //读取cookie数据

        $GoodsProCom = empty($_COOKIE['GoodsProCom']) ? '' : $_COOKIE['GoodsProCom']; //读取cookie数据
        if (!empty($strRecentHistory)) //判断是否有值
        {
            $this->ProComArray = explode('|', $strRecentHistory); //截取cookie 转换为数组
        }
        if (!empty($GoodsProCom)) //判断是否有值
        {
            $this->GoodsProComArray = explode('|', $GoodsProCom); //截取cookie 转换为数组
        }
    }


    public function index($classId = '3', $page = '1', $brandId = '', $brandautid = '', $goodsSkuArr = '', $orderArr = '', $search = '')
    {
        $this->L('goodsmodel');
        $CI = & get_instance();
        if (empty($search)) {
            $search = $this->input->get_post('search'); //搜索关键词
        } else {
            $search = urldecode($search);
        }

        $goodsIdArr = array(); //商品ID数组
        $brandIdArr = array(); //品牌ID数组
        $brandAuthorizeIdArr = array(); //授权品牌ID数组

        /*分析url 如果URL异常 跳转到404*/
        $nowUrl = explode('/', $_SERVER['PHP_SELF']);
        if ((count($nowUrl) != 5 && count($nowUrl) != 6 && count($nowUrl) != 10 && count($nowUrl) != 11)) {
            show_404();
        }

        /*取热门类别*/
        $hotCategory = $this->goodsmodel->getHotCategory();

        /*取商品列表*/
        $classIdStr = getChildClass($classId); //取所有分类的组合
        $where = ' WHERE g.goods_id = gs.goods_id AND is_delete = 0';
        $where .= ' AND g.cat_id in (' . $classIdStr . ')';
        /*组合商品品牌*/
        if ($brandId) {
            $where .= " AND g.brand_id = '" . $brandId . "'";
        }
        /*组合商品品牌*/
        if ($brandautid) {
            $where .= " AND g.brand_authorize_id = '" . $brandautid . "'";
        }
        //组合搜索关键字
        if ($search) {
            $where .= " AND g.goods_name like '%" . $search . "%'";
        }
        /*组合商品属性*/
        $goodsSkuArr = explode('-', $goodsSkuArr);
        foreach ($goodsSkuArr as $key => $value) {
            if (!$value) {
                unset($goodsSkuArr[$key]);
            }
        }
        if (!empty($goodsSkuArr)) {
            foreach ($goodsSkuArr as $value) {
                $where .= " AND (gs.sku_value_id like '%," . $value . ",%' OR gs.sku_value_id like '" . $value . ",%' OR gs.sku_value_id like '%," . $value . "')";
            }
        }

        /*组合排序*/
        if (!empty($orderArr)) {
            $orderArr = explode('-', $orderArr);
            $where .= ($orderArr[2]) ? ' AND shop_price >= "' . $orderArr[2] . '" ' : '';
            $where .= ($orderArr[3]) ? ' AND shop_price <= "' . $orderArr[3] . '" ' : '';
            $where .= ' GROUP BY g.goods_id';
            $where .= ($orderArr[0] or $orderArr[1]) ? ' ORDER BY ' : '';
            if ($orderArr[0] == 1) {
                $where .= ($orderArr[1] == 1) ? ' is_hot DESC, shop_price ASC' : (($orderArr[1] == 2) ? ' is_hot DESC, shop_price DESC' : ' is_hot DESC');
            } elseif ($orderArr[0] == 2) {
                $where .= ($orderArr[1] == 1) ? ' is_hot ASC, shop_price ASC' : (($orderArr[1] == 2) ? ' is_hot ASC, shop_price DESC' : ' is_hot ASC');
            } else {
                $where .= ($orderArr[1] == 1) ? ' shop_price ASC' : (($orderArr[1] == 2) ? ' shop_price DESC' : '');
            }
        } else {
            $where .= ' GROUP BY g.goods_id';
        }


        /*取商品总数*/
        $goodsNumSql = "SELECT count(g.goods_id) AS totalNum FROM dis_goods AS g,dis_goods_sku AS gs " . $where;
        $rel = $CI->db->query($goodsNumSql);
        $goodsNum = $rel->result();
        $goodsNum = empty($goodsNum[0]->totalNum) ? 0 : $goodsNum[0]->totalNum;
        //分页
        $page = ($page < 1) ? 1 : $page;
        $perPage = 16;
        //$classId = '3', $page = '1', $brandId = '', $brandautid = '', $goodsSkuArr = '', $orderArr = '', $search = ''
        $pageArr = array(
            'page' => $page,
            'total' => $goodsNum,
            'url' => '//goodsaction/index/' . $classId . '/',
            'perPage' => $perPage,
            'maxSize' => 5,
            'isFirst' => 0,
            'isprev' => 1,
            'prevClass' => 'page_btn',
            'nextClass' => 'page_btn',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );
        $this->load->library('page');
        $pageClass = new page();
        $pageHtml = $pageClass->data($pageArr);
        //取当前页信息
        $goodsSql = "SELECT g.* FROM dis_goods AS g,dis_goods_sku AS gs " . $where . " LIMIT " . (($page - 1) * $perPage) . ',' . $perPage;

        $rel = $CI->db->query($goodsSql);
        $goodsList = $rel->result();

        foreach ($goodsList as $key => $value) {
            $goodsList[$key]->shop_price_money = number_format($value->shop_price, 2); //转换金钱格式
            $goodsList[$key]->goods_short_name = mb_substr($value->goods_name, 0, 15, 'utf-8'); //截取商品名称
            if ($search) {
                $goodsList[$key]->goods_short_name = str_replace($search, '<font color="#f00">' . $search . '</font>', $goodsList[$key]->goods_short_name); //替换商品名称中的关键字
            }
            $goodsIdArr[] = $value->goods_id;
            $brandIdArr[] = $value->brand_id;
        }

        /*取作为搜索条件的品牌列表*/
        $brandList = $this->goodsmodel->getBrandList($brandIdArr, 1);

        /*取作为搜索条件的授权品牌列表*/
        $brandAuthorizeList = $this->goodsmodel->getBrandList($brandAuthorizeIdArr, 2);


        /*取作为搜索条件的商品sku*/
        $searchSku = array(); //最终的文字输出
        $goodsSearchSkuArr = array(); //属性数组
        $searchSkuId = array(); //所有的属性ID数组
        $searchSkuValue = array(); //所有的属性VALUE数组
        if (!empty($goodsIdArr[0])) {
            $goodsSkuList = $this->goodsmodel->getGoodsSkuListFromGoodsIdArr($goodsIdArr);
        } else {
            $goodsSkuList = array();
        }
        /*分析商品SKU属性和值*/
        foreach ($goodsSkuList as $key => $value) {
            $tempSkuKeyIdArr = explode(',', $value->sku_key_id);
            $tempSkuKeyValueArr = explode(',', $value->sku_value_id);
            foreach ($tempSkuKeyIdArr as $skuKey => $skuValue) {
                $searchSkuId[] = $skuValue;
                $searchSkuValue[] = $tempSkuKeyValueArr[$skuKey];
            }
        }
        $goodsSearchSkuId = array_unique($searchSkuId); //skuKey去重复
        foreach ($goodsSearchSkuId as $value) {
            foreach ($searchSkuValue as $k => $val) {
                if ($searchSkuId[$k] == $value) {
                    $goodsSearchSkuArr[$value][] = $val;
                }
            }
            $goodsSearchSkuArr[$value] = array_unique($goodsSearchSkuArr[$value]); //skuValue去重复
        }
        //将属性和属性值的ID转换成文字
        foreach ($goodsSearchSkuArr as $key => $value) {
            $searchSkuValue = array();
            $searchSkuKey = $this->goodsmodel->getSearchSkuKey($key);
            foreach ($value as $v) {
                $searchSkuValue[$v] = $this->goodsmodel->getSearchSkuValue($v);
            }
            if (!empty($searchSkuKey) && !empty($searchSkuValue)) {
                $searchSku[$searchSkuKey] = $searchSkuValue;
            }
        }

        /*预售款*/

        /*取商品列表*/
        $classIdStrSale = getChildClass(49); //取所有分类的组合
        $yushoukuan = $this->goodsmodel->getList(array('cat_id in("'.$classIdStrSale.'")','is_rmd =1'), 4);

        $data = array(
            'yushoukuan' => $yushoukuan,
            'hotCategory' => $hotCategory,
            'goodsList' => $goodsList,
            'pageHtml' => $pageHtml,
            'goodsSkuList' => $goodsSkuList,
            'brandList' => $brandList,
            'brandAuthorizeList' => $brandAuthorizeList,
            'searchSku' => $searchSku,
            'page' => $page,
            'search' => $search,
            'ProComArray' => $this->ProComArray, //产品浏览记录
            'GoodsProComArray' =>$this->GoodsProComArray, //产品浏览记录
        );
        $this->load->view('goods/list', $data);
    }

    /*商品详细页*/
    public function goodsDetail($goodsId = '', $page = 1)
    {
        $this->L('goodsmodel');
        $this->load->library('iparea/IpArea', '', 'IpArea');

        //商品ID为空 跳转至404页面
        if (empty($goodsId)) {
            show_404();
        }

        /*取品牌列表*/
        $brandList = $this->goodsmodel->getBrandList();

        /*取热门类别*/
        $hotCategory = $this->goodsmodel->getHotCategory();

        /*获取用户所在地*/
        $userAddress = array();
        $userIp = $this->get_real_ip();
        $ipArea = new IpArea();
        $userIpAddress = $ipArea->get($userIp);
        $userAddresstemp = explode('省', $userIpAddress);
        if (count($userAddresstemp) > 1) {
            $userAddress['province'] = $userAddresstemp[0];
            $userAddresstemp1 = explode('市', $userAddresstemp[1]);
            if (count($userAddresstemp1) > 1) {
                $userAddress['city'] = $userAddresstemp1[0];
            }
        }
        //取用户所在省份ID
        $userAddress['province'] = empty($userAddress['province']) ? '浙江' : $userAddress['province'];
        $userAddress['city'] = empty($userAddress['city']) ? '杭州' : $userAddress['city'];

        /*取商品详情*/
        $goodsInfo = $this->goodsmodel->getGoodsInfo($goodsId);
        //转换金钱格式
        $goodsInfo->shop_price_money = number_format($goodsInfo->shop_price, 2);

        /*取商品属性*/
        $goodsSkuList = $this->goodsmodel->getGoodsSkuListFromGoodsIdArr(array($goodsId));

        /*分析商品SKU属性和值*/
        $searchSku = array(); //最终的文字输出
        $goodsSearchSkuArr = array(); //属性数组
        $searchSkuId = array(); //所有的属性ID数组
        $searchSkuValue = array(); //所有的属性VALUE数组
        $searchSkuColor = array(); //所有的属性colotr数组
        $searchSkuSize = array(); //所有的属性size数组
        $skuNumber = 0; //所有的属性库存
        foreach ($goodsSkuList as $key => $value) {
            $skuNumber += $value->sku_number;
            $searchSkuColor[$value->sku_color_id] = $this->goodsmodel->getSearchSkuValue($value->sku_color_id);
            $searchSkuSize[$value->sku_size_id] = $this->goodsmodel->getSearchSkuValue($value->sku_size_id);
            $tempSkuKeyIdArr = explode(',', $value->sku_key_id);
            $tempSkuKeyValueArr = explode(',', $value->sku_value_id);
            foreach ($tempSkuKeyIdArr as $skuKey => $skuValue) {
                $searchSkuId[] = $skuValue;
                $searchSkuValue[] = $tempSkuKeyValueArr[$skuKey];
            }
        }

        if (!empty($searchSkuColor)) { //商品颜色属性
            $searchSku['color'] = array_unique($searchSkuColor);
        }
        if (!empty($searchSkuSize)) { //商品尺码属性
            $searchSku['size'] = array_unique($searchSkuSize);
        }

        $goodsSearchSkuId = array_unique($searchSkuId); //skuKey去重复
        foreach ($goodsSearchSkuId as $value) {
            foreach ($searchSkuValue as $k => $val) {
                if ($searchSkuId[$k] == $value) {
                    $goodsSearchSkuArr[$value][] = $val;
                }
            }
            $goodsSearchSkuArr[$value] = array_unique($goodsSearchSkuArr[$value]); //skuValue去重复
        }
        //将属性和属性值的ID转换成文字
        foreach ($goodsSearchSkuArr as $key => $value) {
            $searchSkuValue = array();
            $searchSkuKey = $this->goodsmodel->getSkuKey($key);
            foreach ($value as $v) {
                $searchSkuValue[$v] = $this->goodsmodel->getSearchSkuValue($v);
            }
            if (!empty($searchSkuKey) && !empty($searchSkuValue)) {
                $searchSku[$searchSkuKey] = $searchSkuValue;
            }
        }

        /*取轮播图*/
        $imageList = array();
        if (!empty($goodsInfo->goods_id)) {
            if (!empty($goodsInfo->goods_thumb)) {
                $imageList[] = $goodsInfo->goods_thumb;
            }
            //根据产品ID读取产品图片信息
            $goodsphoto = $this->goodsmodel->getGoodPhoto($goodsInfo->goods_id);
            foreach ($goodsphoto as $value) {
                if (!empty($value->photo_image)) {
                    $imageList[] = $value->photo_image;
                }
            }
        }

        /*默认快递数额*/
        $expressCost = '10.00';

        /*商品属性数组*/
        foreach ($goodsSkuList as $key => $value) {
            $tempskuValueArr = array();
            if ($value->sku_color_id) {
                $tempskuValueArr[] = $value->sku_color_id;
            }
            if ($value->sku_size_id) {
                $tempskuValueArr[] = $value->sku_size_id;
            }
            if ($value->sku_value_id) {
                $tempskuValueArr[] = $value->sku_value_id;
            }
            $skuValueArr[$key] = implode(',', $tempskuValueArr);
        }

        /*取商品评论*/
        $reviewNum = $this->goodsmodel->getGoodsReviewNum($goodsId);
        //分页
        $page = ($page < 1) ? 1 : $page;
        $perPage = 5;
        $pageArr = array(
            'page' => $page,
            'total' => $reviewNum,
            'url' => '//goodsaction/goodsDetail/' . $goodsId . '/',
            'perPage' => $perPage,
            'maxSize' => 5,
            'isFirst' => 0,
            'isprev' => 1,
            'prevClass' => 'page_btn',
            'nextClass' => 'page_btn',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );
        $this->load->library('page');
        $pageClass = new page();
        $pageHtml = $pageClass->data($pageArr);
        //取当前页信息
        $goodsReviewList = $this->goodsmodel->getGoodsReviewList($goodsId, $page, $perPage);

        /*计算商品平均评分*/
        $allGoodsReviewList = $this->goodsmodel->getGoodsReviewListAll($goodsId);
        $total = 0;
        foreach ($allGoodsReviewList as $value) {
            $total += $value->review_score;
        }
        $aveNum = ($reviewNum == 0) ? '5.0' : number_format($total / $reviewNum, 1);


        /*读取产品同分类下其它热门产品*/
        if (!empty($goodsInfo) && !empty($goodsInfo->cat_id)) {
            $rmdList = $this->goodsmodel->getList(array('cat_id=' . $goodsInfo->cat_id, 'is_rmd=1', 'is_delete=0', 'is_on_sale=1', 'goods_id!=' . $goodsInfo->goods_id), 10);
        } else {
            $rmdList = array();
        }

        /*根据产品分类ID获取产品品牌信息*/
        if (!empty($goodsInfo->cat_id)) //判断分类ID不能为空
        {
            $brandidInfoList = $this->goodsmodel->getgoodsbrandid($goodsInfo->cat_id);
            $arrlist = array(); //循环把对象转为数组
            foreach ($brandidInfoList as $v) {
                $arrlist[] = $v->brand_id;
            }
            $brandIds = implode(',', array_unique($arrlist)); //去除数据重复信息，转化为字符串
            $brandInfoList = array();
            if (!empty($brandIds)) {
                $brandInfoList = $this->goodsmodel->getbrandinfo($brandIds);
            }
        }

        //组装产品信息
        $GoodsRecentHistory = array(
            'goods_id' => $goodsInfo->goods_id,
            'cat_id' => $goodsInfo->cat_id,
            'goods_name' => $goodsInfo->goods_name,
            'shop_price' => $goodsInfo->shop_price,
            'goods_thumb' => $goodsInfo->goods_thumb,
        );
        //将数组转为字符串
        $GoodsRecentHistory = implode(',', $GoodsRecentHistory);

        //判断是否有最新浏览记录如果没有保存
        if (empty($_COOKIE['GoodsRecentHistory'])) {
            /*把最近浏览产品信息存到cookie*/
            setcookie('GoodsRecentHistory', $GoodsRecentHistory, time() + 24 * 3600 * 30, '/');
        } else {
            $strRecentHistory = empty($_COOKIE['GoodsRecentHistory']) ? '' : $_COOKIE['GoodsRecentHistory'];
            //判断该产品是否存在数组中
            $booltrue = strstr($strRecentHistory, $GoodsRecentHistory);
            if ($booltrue) {
            } //判断cookie是否存在该产品
            else //如果不存在 进行插入
            {
                //判断cookie 存入产品的数量超过10个 不进行插入
                $arrval = explode('|', $strRecentHistory); //根据|截取字符串
                if (count($arrval) == 15) {
                    unset($arrval[14]); //移除第一个数组
                    $strRecentHistory = implode('|', $arrval);
                }
                //组合数组
                $strRecentHistory = $GoodsRecentHistory. '|' .$strRecentHistory;
                /*把流量产品信息存到cookie*/
                setcookie('GoodsRecentHistory', $strRecentHistory, time() + 24 * 3600 * 30, '/');
            }
        }

        /*获取当前页URL*/
        $goodsDetailUrl = substr($_SERVER['PHP_SELF'], 0, 34);
        $data = array(
            'userIpAddress' => $userIpAddress, //用户所在地
            'userAddress' => $userAddress, //用户所在省市数组
            'goodsInfo' => $goodsInfo, //商品详细信息
            'goodsSkuList' => $goodsSkuList, //商品SKU信息
            'skuValueArr' => empty($skuValueArr) ? array() : $skuValueArr, //商品SKU字符串
            'hotCategory' => $hotCategory, //热门分类
            'brandList' => $brandList, //品牌列表
            'searchSku' => $searchSku, //商品sku信息输出
            'imageList' => $imageList, //商品sku图
            'expressCost' => $expressCost, //商品默认运费
            'goodsId' => $goodsId, //商品ID
            'skuNumber' => $skuNumber, //商品ID
            'rmdList' => $rmdList,
            'goodsReviewList' => $goodsReviewList,
            'pageHtml' => $pageHtml,
            'reviewNum' => $reviewNum,
            'aveNum' => $aveNum,
            'brandInfoList' => $brandInfoList, //品牌信息
            'goodsDetailUrl' => $goodsDetailUrl, //当前页Url
            'goodsid' => $goodsId, //当前页Url
            'ProComArray' => $this->ProComArray, //产品浏览记录
            'GoodsProComArray' => $this->GoodsProComArray, //产品浏览记录
        );

        $this->load->view('goods/detail', $data);
    }

    /*改变商品属性的时候重新获取属性*/
    public function changeGoodsSku()
    {
        $this->L('goodsmodel');

        $goodsId = $this->input->get_post('goodsId'); //商品ID
        $skuId = $this->input->get_post('skuId'); //已选商品属性数组
        $skuType = $this->input->get_post('skuType'); //商品属性ID

        //商品ID为空 跳转至404页面
        if (empty($goodsId) or empty($skuId) or empty($skuType)) {
            show_404();
        }
        $skuId = explode(',', $skuId); //拆分已选商品属性数组
        $skuId = array_filter($skuId);

        /*取该商品所有的sku*/
        $goodsSkuList = $this->goodsmodel->getGoodsSkuListFromGoodsIdArr(array($goodsId));

        /*查询空SKU*/
        $emptySkuArr = array(); //空SKU
        foreach ($goodsSkuList as $key => $value) {
            switch ($skuType) {
                case 'size': //选择的是尺寸属性
                    if ($value->sku_size_id != $skuId) {
                        $emptySkuArr[] = $value;
                        unset($goodsSkuList[$key]); //删除可疑属性
                    }
                    break;
                case 'color': //选择的是颜色属性
                    if ($value->sku_color_id != $skuId) {
                        $emptySkuArr[] = $value;
                        unset($goodsSkuList[$key]); //删除可疑属性
                    }
                    break;
                case 'self': //选择的是自定义属性
                    $tempSelfSkuArr = explode(',', $value->sku_value_id);
                    if (!in_array($skuId, $tempSelfSkuArr)) {
                        $emptySkuArr[] = $value;
                        unset($goodsSkuList[$key]); //删除可疑属性
                    }
                    break;
            }
        }

        /*分析出所有可疑属性数组*/
        $tempSkuArr = array(); //所有可疑属性数组
        foreach ($emptySkuArr as $value) {
            if ($value->sku_color_id) {
                $tempSkuArr[] = $value->sku_color_id;
            }
            if ($value->sku_size_id) {
                $tempSkuArr[] = $value->sku_size_id;
            }
            if ($value->sku_value_id) {
                $tempSkuArr[] = $value->sku_value_id;
            }
        }
        $tempSku = implode(',', $tempSkuArr);
        $tempSkuArr = explode(',', $tempSku);
        $tempSkuArr = array_unique($tempSkuArr);

        /*筛选可疑属性数组中不符合的值*/
        $tempSkuArrOther = array(); //其他实际存在的sku值
        foreach ($goodsSkuList as $value) {
            if ($value->sku_color_id) {
                $tempSkuArrOther[] = $value->sku_color_id;
            }
            if ($value->sku_size_id) {
                $tempSkuArrOther[] = $value->sku_size_id;
            }
            if ($value->sku_value_id) {
                $tempSkuArrOther[] = $value->sku_value_id;
            }
        }
        $tempSkuOther = implode(',', $tempSkuArrOther);
        $tempSkuArrOther = explode(',', $tempSkuOther);
        $tempSkuArrOther = array_unique($tempSkuArrOther);
        foreach ($tempSkuArr as $key => $value) {
            if (in_array($value, $tempSkuArrOther)) {
                unset($tempSkuArr[$key]);
            }
        }

        print_r($tempSkuArr);
        exit;
    }

    /*读取验证码*/
    public function verificationCode($goodsid)
    {
        $data = array(
            'url' => base_url() . '/goodsaction/goodsDetail/' . $goodsid,
        );
        $this->load->view('goods/codeceshi', $data);
    }

    /*ajax获取快递费用*/
    public function getExpressCost()
    {
        $expressId = $this->input->get_post('expressId');
        $expressId = empty($expressId) ? 1 : $expressId; //默认快递
        $num = $this->input->get_post('num');
        $weight = $this->input->get_post('weight');
        $weight = empty($weight) ? 0 : $weight;
        $weight = $weight * $num;
        $endProvinceId = $this->input->get_post('endProvince');

        $expressCost = $this->countExpressCost($expressId, $weight, $endProvinceId);
        echo number_format($expressCost, 2) . '&nbsp';
        exit;
    }

    /*添加购物车*/
    public function addCart()
    {
        $this->L('ordermodel');
        $this->L('goodsmodel');

        $goodsId = $this->input->get_post('goods_id'); //商品id
        $goodsNum = $this->input->get_post('goods_num'); //商品数量
        $skuColorId = $this->input->get_post('goods_sku_color'); //商品颜色id
        $skuColorId = empty($skuColorId) ? 0 : $skuColorId;
        $skuSizeId = $this->input->get_post('goods_sku_size'); //商品尺寸id
        $skuSizeId = empty($skuSizeId) ? 0 : $skuSizeId;
        $skuValueId = $this->input->get_post('goods_sku'); //商品自定义value
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID

        //未登录
        if (empty($userId)) {
            echo 'user_not_login';
            exit;
        }

        //商品ID为空
        if (empty($goodsId)) {
            echo false;
            exit;
        }

        /*取商品详情*/
        $goodsInfo = $this->goodsmodel->getGoodsInfo($goodsId);
        if (empty($goodsInfo)) {
            //商品下架提示
            echo false;
            exit;
        }

        /*取商品SKU详情*/
        $goodsSkuInfo = $this->goodsmodel->getGoodsSkuInfo($goodsId, $skuColorId, $skuSizeId, $skuValueId);
        if (empty($goodsSkuInfo)) {
            //商品sku无库存提示
            echo false;
            exit;
        }

        $skuKeyId = $goodsSkuInfo->sku_key_id; //商品自定义id

        /*把商品属性转换成文字*/
        if ($skuColorId) {
            $skuColorId = $this->goodsmodel->getSearchSkuValue($skuColorId);
        }
        if ($skuSizeId) {
            $skuSizeId = $this->goodsmodel->getSearchSkuValue($skuSizeId);
        }
        $skuKeyIdArr = explode(',', $skuKeyId);
        $skuValueIdArr = explode(',', $skuValueId);
        foreach ($skuKeyIdArr as $key => $value) {
            $skuKey[] = $this->goodsmodel->getSearchSkuKey($value);
            $skuValue[] = $this->goodsmodel->getSearchSkuValue($skuValueIdArr[$key]);
        }
        $goodsSkuKey = implode(',', $skuKey);
        $goodsSkuValue = implode(',', $skuValue);

        $sqlCartInfo = array(
            'user_id' => empty($_SESSION['user_id']) ? '' : $_SESSION['user_id'], //用户ID,
            'goods_id' => $goodsId,
            'goods_sn' => $goodsInfo->goods_sn,
            'goods_name' => $goodsInfo->goods_name,
            'goods_thumb' => $goodsInfo->goods_thumb,
            'goods_num' => $goodsNum,
            'goods_sku_id' => $goodsSkuInfo->goods_sku_id,
            'goods_price' => (float)$goodsInfo->shop_price + (float)$goodsSkuInfo->sku_price,
            'goods_color' => $skuColorId,
            'goods_size' => $skuSizeId,
            'goods_weight' => $goodsSkuInfo->sku_weight,
            'goods_sku_key' => $goodsSkuKey,
            'goods_sku_value' => $goodsSkuValue,
            'add_time' => time(),
            'last_update' => time(),
        );

        /*查询如果购物车里存在同样的商品 则更新数量*/
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        $cartGood = $this->ordermodel->getCartLikeThis($goodsId, $goodsSkuInfo->goods_sku_id, $userId);
        if (empty($cartGood)) {
            $this->ordermodel->insertCart($sqlCartInfo);

        } else {
            $this->ordermodel->updateCart($cartGood->cart_id, ($cartGood->goods_num + $sqlCartInfo['goods_num']));
        }

        /*根据用户ID取购物车数量*/
        $cartNum = $this->ordermodel->getCartNum($userId);
        echo $cartNum;
        exit;
    }

    /*立即购买*/
    public function buyNow()
    {
        $this->L('ordermodel');
        $this->L('goodsmodel');

        $goodsId = $this->input->get_post('goods_id'); //商品id
        $goodsNum = $this->input->get_post('goods_num'); //商品数量
        $skuColorId = $this->input->get_post('goods_sku_color'); //商品颜色id
        $skuColorId = empty($skuColorId) ? 0 : $skuColorId;
        $skuSizeId = $this->input->get_post('goods_sku_size'); //商品尺寸id
        $skuSizeId = empty($skuSizeId) ? 0 : $skuSizeId;
        $skuValueId = $this->input->get_post('goods_sku'); //商品自定义value
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID

        //未登录
        if (empty($userId)) {
            echo 'user_not_login';
            exit;
        }

        //商品ID为空
        if (empty($goodsId)) {
            echo false;
            exit;
        }

        /*取商品详情*/
        $goodsInfo = $this->goodsmodel->getGoodsInfo($goodsId);
        if (empty($goodsInfo)) {
            //商品下架提示
            echo false;
            exit;

        }

        /*取商品SKU详情*/
        $goodsSkuInfo = $this->goodsmodel->getGoodsSkuInfo($goodsId, $skuColorId, $skuSizeId, $skuValueId);
        if (empty($goodsSkuInfo)) {
            //商品sku无库存提示
            echo false;
            exit;
        }

        $skuKeyId = $goodsSkuInfo->sku_key_id; //商品自定义id

        /*把商品属性转换成文字*/
        if ($skuColorId) {
            $skuColorId = $this->goodsmodel->getSearchSkuValue($skuColorId);
        }
        if ($skuSizeId) {
            $skuSizeId = $this->goodsmodel->getSearchSkuValue($skuSizeId);
        }
        $skuKeyIdArr = explode(',', $skuKeyId);
        $skuValueIdArr = explode(',', $skuValueId);
        foreach ($skuKeyIdArr as $key => $value) {
            $skuKey[] = $this->goodsmodel->getSearchSkuKey($value);
            $skuValue[] = $this->goodsmodel->getSearchSkuValue($skuValueIdArr[$key]);
        }
        $goodsSkuKey = implode(',', $skuKey);
        $goodsSkuValue = implode(',', $skuValue);

        $sqlCartInfo = array(
            'user_id' => $userId,
            'goods_id' => $goodsId,
            'goods_sn' => $goodsInfo->goods_sn,
            'goods_name' => $goodsInfo->goods_name,
            'goods_thumb' => $goodsInfo->goods_thumb,
            'goods_num' => $goodsNum,
            'goods_sku_id' => $goodsSkuInfo->goods_sku_id,
            'goods_price' => (float)$goodsInfo->shop_price + (float)$goodsSkuInfo->sku_price,
            'goods_color' => $skuColorId,
            'goods_size' => $skuSizeId,
            'goods_weight' => $goodsSkuInfo->sku_weight,
            'goods_sku_key' => $goodsSkuKey,
            'goods_sku_value' => $goodsSkuValue,
            'add_time' => time(),
            'last_update' => time(),
        );

        /*查询如果购物车里存在同样的商品 则更新数量*/
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID
        $cartGood = $this->ordermodel->getCartLikeThis($goodsId, $goodsSkuInfo->goods_sku_id, $userId);
        if (empty($cartGood)) {
            $cartId = $this->ordermodel->insertCart($sqlCartInfo);

        } else {
            $cartId = $this->ordermodel->updateCart($cartGood->cart_id, ($cartGood->goods_num + $sqlCartInfo['goods_num']));
        }

        echo $cartId;
        exit;
    }

    /*添加对比*/
    public function  proComIndex()
    {
        $this->L('goodsmodel');
        $goodsId = $this->input->get_post('hidid');

        /*goodsId去空值*/
        $goodsArr   = explode(',',$goodsId);
        $goodsArr   = array_filter($goodsArr);
        $goodsId    = implode(',',$goodsArr);
        $goodsId = !empty($goodsId)?$goodsId:'0';

        /*根据ID读取产品信息*/
        $goodsInfo = $this->goodsmodel->getGoodsInfoIn($goodsId);
        if (!empty($goodsInfo)) {
            //循环产品读取产品信息
            foreach ($goodsInfo as $goodskey => $v) {
                /*取商品属性*/
                $goodsSkuList = $this->goodsmodel->getGoodsSkuListFromGoodsIdArr(array($v->goods_id));

                /*分析商品SKU属性和值*/
                $searchSku = array(); //最终的文字输出
                $goodsSearchSkuArr = array(); //属性数组
                $searchSkuId = array(); //所有的属性ID数组
                $searchSkuValue = array(); //所有的属性VALUE数组
                $searchSkuColor = array(); //所有的属性colotr数组
                $searchSkuSize = array(); //所有的属性size数组
                $skuNumber = 0; //所有的属性库存
                foreach ($goodsSkuList as $key => $value) {
                    $skuNumber += $value->sku_number;
                    $searchSkuColor[$value->sku_color_id] = $this->goodsmodel->getSearchSkuValue($value->sku_color_id); // 根据colorid读取value值
                    $searchSkuSize[$value->sku_size_id] = $this->goodsmodel->getSearchSkuValue($value->sku_size_id); // 根据sizeid读取value值
                    $tempSkuKeyIdArr = explode(',', $value->sku_key_id);
                    $tempSkuKeyValueArr = explode(',', $value->sku_value_id);
                    foreach ($tempSkuKeyIdArr as $skuKey => $skuValue) {
                        $searchSkuId[] = $skuValue;
                        $searchSkuValue[] = $tempSkuKeyValueArr[$skuKey];
                    }
                }

                if (!empty($searchSkuColor)) { //商品颜色属性
                    $searchSku['color'] = array_unique($searchSkuColor);
                }
                if (!empty($searchSkuSize)) { //商品尺码属性
                    $searchSku['size'] = array_unique($searchSkuSize);
                }

                $goodsSearchSkuId = array_unique($searchSkuId); //skuKey去重复
                foreach ($goodsSearchSkuId as $value) {
                    foreach ($searchSkuValue as $k => $val) {
                        if ($searchSkuId[$k] == $value) {
                            $goodsSearchSkuArr[$value][] = $val;
                        }
                    }
                    $goodsSearchSkuArr[$value] = array_unique($goodsSearchSkuArr[$value]); //skuValue去重复
                }

                //将属性和属性值的ID转换成文字
                foreach ($goodsSearchSkuArr as $key => $value) {
                    $searchSkuValue = array();
                    $searchSkuKey = $this->goodsmodel->getSkuKey($key);
                    foreach ($value as $v) {
                        $searchSkuValue[$v] = $this->goodsmodel->getSearchSkuValue($v);
                    }
                    if (!empty($searchSkuKey) && !empty($searchSkuValue)) {
                        $searchSku[$searchSkuKey] = $searchSkuValue;
                    }
                }
                /*商品属性数组*/
                foreach ($goodsSkuList as $key => $value) {
                    $tempskuValueArr = array();
                    if ($value->sku_color_id) {
                        $tempskuValueArr[] = $value->sku_color_id;
                    }
                    if ($value->sku_size_id) {
                        $tempskuValueArr[] = $value->sku_size_id;
                    }
                    if ($value->sku_value_id) {
                        $tempskuValueArr[] = $value->sku_value_id;
                    }
                    $skuValueArr[$key] = implode(',', $tempskuValueArr);
                }

                /*取商品评论*/
                $reviewNum = $this->goodsmodel->getGoodsReviewNum($goodsId);
                /*计算商品平均评分*/
                $allGoodsReviewList = $this->goodsmodel->getGoodsReviewListAll($goodsId);
                $total = 0;
                foreach ($allGoodsReviewList as $value) {
                    $total += $value->review_score;
                }
                $aveNum = ($reviewNum == 0) ? '5.0' : number_format($total / $reviewNum, 1);
                $goodsInfo[$goodskey]->searchSkuId = $searchSkuId; //所有的属性ID数组
                $goodsInfo[$goodskey]->searchSkuValue = $searchSkuValue; //所有的属性VALUE数组
                $goodsInfo[$goodskey]->searchSkuSize = $searchSkuSize; //所有的属性colotr数组
                $goodsInfo[$goodskey]->searchSkuColor = $searchSkuColor; //所有的属性size数组
                $goodsInfo[$goodskey]->aveNum = $aveNum; //所有的属性size数组
                $goodsInfo[$goodskey]->searchSku = $searchSku; //所有的属性size数组
            }
            //根据产品分类读取产品属性
            $catInfo = $this->goodsmodel->getCatInfo($goodsInfo[0]->cat_id);
            $catInfoArray = explode(',',$catInfo->goods_sku_key_id); //把属性转为数组进行查询
            $skuValue = array(); //定义空数组 接受 属性名
            foreach($catInfoArray as $catk => $catv) // 循环读取属性名称
            {
                $skuKeyInfo = $this->goodsmodel->getSkuKey($catv);  //查询属性名称
                $skuValue[$catk] = $skuKeyInfo;
            }
        }

        /*取推荐商品*/
        $hotGoods           = getHotGoods();

        $data = array(
            'ProComArray' => $this->ProComArray, //产品浏览记录
            'GoodsProComArray' => $this->GoodsProComArray, //产品对比
            'goodsInfo' =>empty($goodsInfo)?array():$goodsInfo, //产品信息
            'catInfoArray' =>empty($catInfoArray)?array():$catInfoArray, //属性ID
            'skuValue' =>empty($skuValue)?array():$skuValue, //属性名称
            'hotGoods'          => $hotGoods,
        );

//        print_r($goodsInfo);
//        exit;
        $this->load->view('goods/proCom', $data);
    }

    /*添加属性对比*/
    public  function  ajaxProCom()
    {
        $this->L('goodsmodel');
        $goodsId= $this->input->get_post('id');
        //判断是否有ID
        if(empty($goodsId))
        {
            echo '4';//产品ID为空
            exit;
        }
        /*根据ID读取产品信息*/
        $goodsInfo = $this->goodsmodel->getGoodsInfoIn($goodsId);
        if(empty($goodsInfo))
        {
            echo '3';//产品不存在
            exit;
        }
        //组装产品信息
        $GoodsProCom = array(
            'goods_id' => $goodsInfo[0]->goods_id,
            'cat_id' => $goodsInfo[0]->cat_id,
            'goods_name' => $goodsInfo[0]->goods_name,
            'shop_price' => $goodsInfo[0]->shop_price,
            'goods_thumb' => $goodsInfo[0]->goods_thumb,
        );
        //将数组转为字符串
        $GoodsProCom = implode(',', $GoodsProCom);

        //判断是否有最新浏览记录如果没有保存
        if (empty($_COOKIE['GoodsProCom'])) {

            /*把流量产品信息存到cookie*/
            setcookie('GoodsProCom', $GoodsProCom, time() + 24 * 3600 * 7, '/');
        } else {
            $strGoodsProCom = empty($_COOKIE['GoodsProCom']) ? '' : $_COOKIE['GoodsProCom'];
            //判断该产品是否存在数组中
            $booltrue = strstr($strGoodsProCom, $GoodsProCom);
            if ($booltrue) {
                echo '2';//已添加对比
                exit;
            } //判断cookie是否存在该产品
            else //如果不存在 进行插入
            {
                //判断cookie 存入产品的数量超过10个 不进行插入
                $arrval = explode('|', $strGoodsProCom); //根据|截取字符串
                if (count($arrval) == 4) {
                    echo 'err';//失败
                    exit;
                       }
                //组合数组
                $strGoodsProCom = $GoodsProCom.'|'.$strGoodsProCom;
                /*把流量产品信息存到cookie*/
                setcookie('GoodsProCom', $strGoodsProCom, time() + 24 * 3600 * 30, '/');
            }
        }
        echo $GoodsProCom;
        exit;
    }

    /*属性对比删除指定产品*/
    public  function ajaxProComDel(){
        $this->L('goodsmodel');
        $goodsId= $this->input->get_post('id');
        //判断是否有ID
        if(empty($goodsId))
        {
            echo '4';//产品ID为空
            exit;
        }

        if($goodsId=='del')//全部清空
        {
            setcookie('GoodsProCom', '', time() + 24 * 3600 * 7, '/');
            echo '1';//成功
            exit;
        }
        //判断是否有最新浏览记录如果没有保存
        if (empty($_COOKIE['GoodsProCom'])) {
            echo '1';//产品不存在
            exit;
        } else {
            $strGoodsProCom = empty($_COOKIE['GoodsProCom']) ? '' : $_COOKIE['GoodsProCom']; //读取缓存
            $arrval = explode('|', $strGoodsProCom); //根据|截取字符串
            foreach($arrval as $k=>$v)
            {
                $vArr           = explode(',',$v);
                if($goodsId == $vArr[0]){
                    unset($arrval[$k]);
                }
            }

            $strGoodsProCom = implode('|', $arrval);
            /*把流量产品信息存到cookie*/
            setcookie('GoodsProCom', $strGoodsProCom, time() + 24 * 3600 * 7, '/');
            echo '1';//成功
            exit;
        }
    }

    public  function  addGoodsSale($goodsid='')
    {
        $this->L('goodsmodel');
        $userId = empty($_SESSION['user_id']) ? '' : $_SESSION['user_id']; //用户ID

        if(empty($userId))
        {
            msg('请登录！', base_url('/goodsaction/goodsDetail/'.$goodsid), 2, 2000);
        }
        if(!empty($goodsid)){//判断产品ID
           //根据产品ID查询产品信息
            /*取商品详情*/
            $goodsInfo = $this->goodsmodel->getGoodsInfo($goodsid);
            if( !empty($goodsInfo))
            {
                $inData = array(
                    'goods_id'=>$goodsInfo->goods_id,
                    'goods_name'=>$goodsInfo->goods_name,
                    'goods_sn'=>$goodsInfo->goods_sn,
                    'user_id'=>$userId,
                    'user_name'=>$_SESSION['user_name'],
                    'add_time'=>time(),
            );
                $gsid = $this->goodsmodel->addGoodsSale($inData);
                if($gsid){
                    msg('预约成功！', base_url('/goodsaction/goodsDetail/'.$goodsid), 2, 2000);

                }else
                {
                    msg('预约失败！', base_url('/goodsaction/goodsDetail/'.$goodsid), 2, 2000);
                }
            }
            msg('预约失败！', base_url('/goodsaction/goodsDetail/'.$goodsid), 2, 2000);
        }
        msg('预约失败！', base_url('index.php'), 2, 2000);
    }


    /**
     * 计算快递费用
     * parm $expressId:快递ID
     *      $weight：重量
     *      $endProvinceName：到达城市
     */
    private function countExpressCost($expressId, $weight, $endProvinceName)
    {
        $this->L('ordermodel');
        $defaultCost = 10; //默认运费
        $startProvinceId = 33; //默认杭州发货;
        if (!empty($expressId) && !empty($endProvinceName)) {
            $endProvinceId = $this->ordermodel->getEndProvinceFromProvinceName($endProvinceName);

            /*根据快递、出发省份、结束省份、重量计算所需运费*/
            $expressCost = $this->ordermodel->getExpressCost($expressId, $startProvinceId, $endProvinceId);
            if (empty($expressCost)) { //如果没有该信息，返回默认运费
                return $defaultCost;
            } else {
                if ($weight <= $expressCost->first_height) { //如果没有超重，返回基本运费
                    return $expressCost->first_height_cost;
                } else { //超重 计算费用
                    $realCost = @$expressCost->first_height_cost + ceil(($weight - $expressCost->first_height) / $expressCost->last_height) * $expressCost->last_height_cost;
                    return $realCost;
                }
            }
        }

    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */