<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class sourceAction extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index($action)
    {
        switch ($action) {
            case 'supplier':
                $this->supplier();
                break;
            case 'channel':
                $this->channel();
                break;
            case 'express':
                $this->express();
                break;
            case 'goods':
                $this->goods();
                break;
        }
    }

    /**
     * 品牌管理
     */
    public function brand($type = 1)
    {
        $this->L('SourceModel');
        $act = $this->input->post('act');
        $data = array();
        $this->load->library('excelfactory/Excelfactory');
        $excelFactory = new Excelfactory();
        if ($act == 'upload') {
            //xls文件上传
            $upload = $excelFactory->__construct('upload', 'xls|xlsx');
            if ($upload['upload_data']) {
                /*文件上传成功,读取上传成功的excel*/
                $dataXls = $excelFactory->__construct('read', $upload['upload_data']['full_path']);

                /*整合数组*/
                $valueArr = array();
                foreach ($dataXls as $key => $value) {
                    if ($key > 1 && !empty($value[1])) {
                        $valueArr['brand_name'][] = $value[1];
                    }
                }
                $exXlsArr = array(
                    'tabName' => 'brand',
                    'values' => $valueArr,
                );

                /*存入数据库*/
                $insertList = $excelFactory->__construct('ex', $exXlsArr);
                $data = array(
                    'insertList' => $insertList,
                );
            } else {
                $data = array(
                    'error' => $upload['error'],
                );
            }
        } elseif ($act == 'add') {
            $brandName = $this->input->post('brand_name');
            $is_rmd = $this->input->get_post('is_rmd'); //是否推荐
            if (!empty($brandName)) {
                $valueArr['brand_name'] = $brandName;
                $valueArr['is_rmd'] = $is_rmd;
                $valueArr['brand_type'] = $type;
                /*图片上传*/
                if (!empty($_FILES['brand_img']['name'])) {
                    $brandUpload = @uploadOss('', $_FILES['brand_img']);
                    if (!empty($brandUpload['upload_data'])) {
                        $valueArr['brand_img'] = $brandUpload['upload_data'];
                    }
                }
                $boolbrand = $this->SourceModel->addBrand($valueArr);
                if ($boolbrand > 0) {
                    msg('添加成功！', base_url('sourceaction/brand/' . $type), 2, 2000);
                } else {
                    msg('添加失败！', base_url('sourceaction/brand/' . $type), 2, 2000);
                }
            } else {
                $data = array(
                    'error' => '品牌名为空！',
                );
            }
        }

        $data['brandList'] = $this->SourceModel->getBrandList($type);
        $data['type'] = $type;
        $data['is_rmd'] = 0;
        $this->load->view('source/brand', $data);
    }

    /*修改品牌*/
    public function editBrand($brandId = '', $type = '')
    {
        $this->L('SourceModel');
        $act = $this->input->get_post('act'); //操作类型
        $brandName = $this->input->get_post('brand_name'); //品牌Name
        $is_rmd = $this->input->get_post('is_rmd'); //是否推荐
        $brandId = empty($brandId) ? $this->input->get_post('brand_id') : $brandId; //品牌ID
        $type = empty($type) ? $this->input->get_post('type') : $type; //类型1-品牌管理 、2-授权品牌
        if (empty($brandId)) {
            show_404();
        }
        if ($act == 'editBrand') {
            if (!empty($brandName)) {
                $inData = array( //组装修改字符串
                    'brand_id' => $brandId,
                    'brand_name' => $brandName,
                    'is_rmd' => $is_rmd,
                );
                /*图片上传*/
                if (!empty($_FILES['brand_img']['name'])) {
                    $brandUpload = @uploadOss('', $_FILES['brand_img']);
                    if (!empty($brandUpload['upload_data'])) {
                        $inData['brand_img'] = $brandUpload['upload_data'];
                    }
                }

                /*存入数据库*/
                $boolbrand = $this->SourceModel->updateBrand($inData);
                if ($boolbrand > 0) {
                    msg('修改成功！', base_url('sourceaction/brand/' . $type), 2, 2000);
                } else {
                    msg('修改失败！', base_url('sourceaction/brand/' . $type), 2, 2000);
                }
            } else {
                msg('品牌名不能为空！', base_url('sourceaction/brand/' . $type), 2, 2000);
            }
        }

        $brandList = $this->SourceModel->getBrandList($type);
        $data['brandList'] = $brandList;
        foreach ($brandList as $v) {
            if ($v->brand_id == $brandId) {
                $data['brandId'] = $v->brand_id;
                $data['type'] = $v->brand_type;
                $data['brandName'] = $v->brand_name;
                $data['is_rmd'] = $v->is_rmd;
            }
        }
        $this->load->view('source/brand', $data);
    }

    /*删除品牌*/
    public function delBrand()
    {
        $this->L('sourcemodel');
        $brandId = $this->input->get_post('id');
        $this->sourcemodel->delBrand($brandId);
    }

    /**
     * 供应商管理
     */
    public function supplier()
    {
        $this->L('SourceModel');
        $data['supplierList'] = $this->SourceModel->getSupplierList();
        $this->load->view('source/supplier', $data);
    }

    /**
     * 渠道管理
     */
    public function channel()
    {
        $this->L('SourceModel');
        $data['channelList'] = $this->SourceModel->getChannelList();
        $this->load->view('source/channel', $data);
    }

    /**
     * 快递管理
     */
    public function express()
    {
        $this->L('SourceModel');
        $act = $this->input->get_post('act');

        $data = array(
            'expressList' => $this->SourceModel->getExpressList(), //运费列表
            'provinceList' => $this->SourceModel->getProvinceList(), //省份信息
        );
        switch ($act) {
            case 'addExpress':
                $expressName = $this->input->post('expressName');
                if (!empty($expressName)) {
                    $insertId = $this->SourceModel->insertExpress($expressName);
                    $expressInfo = array(
                        'id' => $insertId,
                        'name' => $expressName,
                    );
                } else {
                    $expressInfo = array(
                        'id' => '快递名不能为空！',
                        'name' => 'undefined',
                    );
                }
                print_r(json_encode($expressInfo));
                exit;
                break;
            case 'getdate': //ajax获得快递的邮费信息
                $id = $this->input->get_post('id');
                $costList = $this->SourceModel->getExpressCostList($id);
                if (!empty($costList)) {
                    //替换省份ID未省份名
                    foreach ($costList as $key => $value) {
                        $costList[$key]->start_province_id = $value->start_province_id;
                        $costList[$key]->end_province_id = $value->end_province_id;
                    }
                    $costList['allProvince'] = $data['provinceList']; //所有省份信息
                    echo json_encode($costList);
                } else {
                    echo json_encode('doNotHaveAnything');
                }
                return;
                break;
        }

        $this->load->view('source/express', $data);
    }

    /*ajax获得运费数据*/
    public function ajaxGetCostList()
    {
        $this->L('SourceModel');
        $act = $this->input->get_post('act');
        $id = $this->input->get_post('id');
        switch ($act) {
            case 'getdate':
                $costList = $this->SourceModel->getExpressCostList($id);
                echo json_encode($costList);
                return;
            default:
                echo json_decode('');
        }
    }

    /*ajax删除快递公司*/
    public function delExpress()
    {
        $this->L('SourceModel');
        $id = $this->input->get_post('id');
        if ($id) {
            $this->SourceModel->delExpress($id);
        }
    }

    /*ajax删除运费信息*/
    public function delExpressCost()
    {
        $this->L('SourceModel');
        $costId = $this->input->get_post('costId');
        if ($costId) {
            $this->SourceModel->delExpressCost($costId);
        }
    }

    /*ajax添加运费信息*/
    public function addExpressCost()
    {
        $this->L('SourceModel');
        $expressId = $this->input->get_post('expressId');
        $startProvinceId = 1;
        $endProvinceId = 1;
        $channelId = $this->session->userdata['admin_id'];
        $newCostId = $this->SourceModel->addExpressCost($expressId, $startProvinceId, $endProvinceId, $channelId);
        echo json_encode($newCostId);
    }

    /*ajax更新运费信息*/
    public function changeExpress()
    {
        $this->L('SourceModel');
        $costId = $this->input->get_post('id');
        $act = $this->input->get_post('act');
        $value = $this->input->get_post('value');
        $this->SourceModel->changeExpress($costId, $value, $act);
    }

    /**
     * 商品管理
     */
    public function goods($page = '1', $classId = '1')
    {
        set_time_limit(0);
        $startTime = time(); //脚本开始执行时间
        $act               = $this->input->get_post('act');
        $search            = $this->input->get_post('search'); //产品名称
        $search = ($search=='商品名称')?'':$search;
        $catid             = $this->input->get_post('catid'); //分类ID
        $classId           = !empty($catid)?$catid:$classId; //判断post接受方式不为空时去post值
        $goodssn           = $this->input->get_post('goodssn'); //货号
        $goodssn = ($goodssn=='货号')?'':$goodssn;
        $isonsale         = $this->input->get_post('isonsale'); //是否在售：1-正常、0停售
        $isdelete          = $this->input->get_post('isdelete');//是否删除：1-删除、0、正常
        $isrmd             = $this->input->get_post('isrmd'); //是否推荐：0-正常、1推荐
        $brandid           = $this->input->get_post('brandid');//品牌ID
        $brandauthorizeid = $this->input->get_post('brandauthorizeid');//授权品牌ID

        $isSearch = '';
        if (!empty($search)) {
            $isSearch = 1;
        }
        $data = array();
        $this->L('SourceModel');
        $this->load->library('excelfactory/Excelfactory', '', 'newExcel');

        if ($act == 'upload') { //批量添加商品
            //是更新库存还是添加商品
            $insertType = $this->input->post('inserttype');
            $insertType = ($insertType == '1') ? 'insert' : 'inventroy';

            //xls文件上传
            $upload = $this->newExcel->__construct('upload', 'xls|xlsx');
            if ($upload['upload_data']) {
                /*文件上传成功,读取上传成功的excel*/
                $dataXls = $this->newExcel->__construct('read', $upload['upload_data']['full_path']);

                /*整合数组*/
                $valueArr = array();
                $catArr = array();
                $skuArr = array();

                /*获取所有sku_value 为了优化更新库存，重组sku属性（array('skuValue'=>'skuValueId')）*/
                $skuValueList = $this->SourceModel->getSkuValueList();
                $newSkuValueList = array();
                foreach ($skuValueList as $skuValue) {
                    $newSkuValueList[$skuValue->goods_sku_value] = $skuValue->goods_sku_value_id;
                }

                if ($insertType == 'inventroy') { //更新库存，只整理库存信息
                    $newGoodsList[] = array(); //新商品数组
                    foreach ($dataXls as $key => $value) { //把excel放进数组中
                        if ($key > 1) {
                            $valueArr['goods_sn'][] = $value[1];

                            //查询商品是否存在
                            $goodsInfo = $this->SourceModel->getGoodsInfoFromGoodsSn($value[1]);
                            if (empty($goodsInfo)) { //商品不存在 存在数组中，等库存更新结束自动插入新商品
                                $newGoodsList[] = $value;
                            } else {
                                @$skuArr['sku_size'][] = $newSkuValueList[$value[11]];
                                @$skuArr['sku_color'][] = $newSkuValueList[$value[12]];
                                $skuArr['sku_repertory'][] = $value[13];
                                $skuArr['sku_price'][] = $value[14];
                            }
                        }
                    }
                } else { //添加商品，整理全部信息
                    foreach ($dataXls as $key => $value) { //把excel放进数组中
                        if ($key > 1) {
                            $valueArr['goods_sn'][] = $value[1];
                            $valueArr['goods_name'][] = $value[2];
                            $valueArr['brand_id'][] = $this->getBrandId($value[3]);
                            $valueArr['pro_date'][] = $value[4];
                            $valueArr['pro_spring'][] = is_numeric($value[5]) ? $value[5] : ($value[5] == '春季' or $value[5] == '春') ? 1 : (($value[5] == '夏季' or $value[5] == '夏') ? 2 : (($value[5] == '秋季' or $value[5] == '秋') ? 3 : (($value[5] == '冬季' or $value[5] == '冬') ? 4 : 0)));
                            $valueArr['pro_sex'][] = ($value[6] == '男') ? 1 : 0;
                            $valueArr['discount'][] = empty($value[15]) ? 10 : $value[15];

                            /*分类*/
                            $catArr['pro_step_one_class'][] = $value[7];
                            $catArr['pro_step_two_class'][] = $value[8];
                            $catArr['pro_step_three_class'][] = $value[9];
                            $catArr['pro_step_four_class'][] = $value[10];

                            /*sku*/
                            $skuArr['sku_size'][] = $this->getSkuId($value[11], 'size');
                            $skuArr['sku_color'][] = $this->getSkuId($value[12], 'color');
                            $skuArr['sku_repertory'][] = $value[13];
                            $skuArr['sku_price'][] = $value[14];
                            $skuArr['goods_sell_num'][] = $value[15]; //产品销售量
                        }
                    }
                    //获取商品的分类ID
                    $valueArr['cat_id'] = $this->exClass($catArr);
                }

                $centenTime = time();
                echo '整理数据时间：' . ($centenTime - $startTime) . '秒<br>';

                /*存入数据库*/
                $goodsArr = array(
                    'tabName' => 'goods',
                    'values' => $valueArr,
                    'skuTabName' => 'goods_sku',
                    'skuInventoryName' => 'goods_sku_inventory',
                    'skuArr' => $skuArr,
                );
                $insertList = $this->newExcel->__construct('exGoods', $goodsArr, $insertType);

                /*更新库存的时候如果有新商品 则插入新商品*/
                if (!empty($newGoodsList[1])) {
                    $valueArr['goods_sn'] = array();
                    foreach ($newGoodsList as $key => $value) { //把excel放进数组中
                        if ($key > 1) {
                            $valueArr['goods_sn'][] = $value[1];
                            $valueArr['goods_name'][] = $value[2];
                            $valueArr['brand_id'][] = $this->getBrandId($value[3]);
                            $valueArr['pro_date'][] = $value[4];
                            $valueArr['pro_spring'][] = is_numeric($value[5]) ? $value[5] : ($value[5] == '春季' or $value[5] == '春') ? 1 : (($value[5] == '夏季' or $value[5] == '夏') ? 2 : (($value[5] == '秋季' or $value[5] == '秋') ? 3 : (($value[5] == '冬季' or $value[5] == '冬') ? 4 : 0)));
                            $valueArr['pro_sex'][] = ($value[6] == '男') ? 1 : 0;
                            $valueArr['discount'][] = empty($value[15]) ? 10 : $value[15];

                            /*分类*/
                            $catArr['pro_step_one_class'][] = $value[7];
                            $catArr['pro_step_two_class'][] = $value[8];
                            $catArr['pro_step_three_class'][] = $value[9];
                            $catArr['pro_step_four_class'][] = $value[10];

                            /*sku*/
                            $skuArr['sku_size'][] = $this->getSkuId($value[11], 'size');
                            $skuArr['sku_color'][] = $this->getSkuId($value[12], 'color');
                            $skuArr['sku_repertory'][] = $value[13];
                            $skuArr['sku_price'][] = $value[14];
                        }
                    }
                    //获取商品的分类ID
                    $valueArr['cat_id'] = $this->exClass($catArr);

                    /*存入数据库*/
                    $goodsArrNew = array(
                        'tabName' => 'goods',
                        'values' => $valueArr,
                        'skuTabName' => 'goods_sku',
                        'skuInventoryName' => 'goods_sku_inventory',
                        'skuArr' => $skuArr,
                    );

                    $insertListNew = $this->newExcel->__construct('exGoods', $goodsArrNew, 'insert');
                }

                $data = array(
                    'insertList' => $insertList,
                    'insertListnew' => empty($insertListNew) ? array() : $insertListNew,
                );
                echo '存数据库时间：' . (time() - $centenTime) . '秒';
            } else {
                $data = array(
                    'error' => $upload['error'],
                );
            }
            msg('导入成功！', base_url('sourceaction/index/goods'), 2, 2000);
            exit;
        } elseif ($act == 'add') { //直接添加商品
            //商品数组
            $goodsSqlInfo = array(
                'goods_name' => $this->input->get_post("goods_name"),
                'goods_sn' => $this->input->get_post("goods_sn"),
                'brand_id' => $this->input->get_post("brand_id"),
                'brand_authorize_id' => $this->input->get_post("brand_authorize_id"),
                'cat_id' => $this->input->get_post("cat_id"),
                'market_price' => $this->input->get_post("market_price"),
                'in_price' => $this->input->get_post("in_price"),
                'shop_price' => $this->input->get_post("shop_price"),
                'goods_sell_num' => $this->input->get_post("goods_sell_num"), //产品销售量
                'goods_intro' => $this->input->get_post("goods_intro"),
                'goods_detail' => htmlspecialchars($this->input->get_post("goods_detail")),
                'goods_micro_channel' => htmlspecialchars($this->input->get_post("goods_micro_channel")), //微信商品详细内容
                'goods_parm' => htmlspecialchars($this->input->get_post("goods_parm")),
                'channel_id' => $this->session->userdata('admin_id'),
                'goods_year' => $this->input->get_post("goods_year"),
                'goods_spring' => $this->input->get_post("goods_spring"),
                'goods_sex' => $this->input->get_post("goods_sex"),
                'is_new' => $this->input->get_post("is_new"),
                'is_hot' => $this->input->get_post("is_hot"),
                'is_rmd' => $this->input->get_post("is_rmd"),
                'last_update' => time(),
            );

            if (!empty($goodsSqlInfo['goods_name']) && !empty($goodsSqlInfo['goods_sn'])) {
                /*保存商品缩略图*/
                if (!empty($_FILES['goods_img']['name'])) {
                    $goodsUpload = @uploadOss('', $_FILES['goods_img']);
                    if (!empty($goodsUpload['upload_data'])) {
                        $goodsSqlInfo['goods_thumb'] = $goodsUpload['upload_data'];
                    }
                }

                //产品二维码图片上传
                if (!empty($_FILES['goods_two_dimensional_code_img']['name'])) {
                    $goodsTwoCodeImgUpload = @uploadOss('', $_FILES['goods_two_dimensional_code_img']);
                    if (!empty($goodsTwoCodeImgUpload['upload_data'])) {
                        $goodsSqlInfo['goods_two_dimensional_code_img'] = $goodsTwoCodeImgUpload['upload_data'];
                    }
                }

                /*商品存数据库*/
                //查询商品是否已经存在，是 更新 否 插入
                $id = $this->input->get_post("id");
                $goodsInfo = $this->SourceModel->getGoodsInfo($id);
                $type = empty($goodsInfo) ? 0 : 1; //0表示商品不存在 需要插入，1表示商品已存在 需要更新
                if (!$type) {
                    $goodsSqlInfo['add_time'] = time();
                }
                $goodsId = $this->SourceModel->insertGoods($goodsSqlInfo, $type, $id);
                //属性数组
                $skuNameArr = $this->input->get_post("skuname");
                //循环存入数据库
                foreach ($skuNameArr as $key => $value) {
                    //取出color\size\weight属性
                    $skuSizeId = $value[1]; //size属性
                    $skuColorId = $value[2]; //color属性
                    $skuWeight = $value['weight']; //weight属性
                    $skuNumber = $value['inventory']; //库存数量
                    unset($value[1]);
                    unset($value[2]);
                    unset($value['weight']);
                    unset($value['inventory']);
                    $value = array_filter($value);
                    if (!empty($skuSizeId) && !empty($skuColorId) && !empty($skuNumber)) { //size属性 color属性 库存数量都不为空的情况下才插入商品属性信息
                        //组合自定义属性
                        $skuKeyId = '';
                        foreach ($value as $k => $v) {
                            $skuKeyId .= $k . ',';
                        }
                        $skuKeyId = substr($skuKeyId, 0, -1);
                        $skuValueId = implode(',', $value);

                        $skuSqlInfo = array(
                            'goods_id' => $goodsId,
                            'sku_number' => $skuNumber,
                            'sku_weight' => $skuWeight,
                            'sku_size_id' => $skuSizeId,
                            'sku_color_id' => $skuColorId,
                            'sku_key_id' => $skuKeyId,
                            'sku_value_id' => $skuValueId,
                            'last_update' => time(),
                        );

                        //保存属性缩略图
                        $goodsThumb = '';
                        if (!empty($_FILES['goods_thumb_' . $key]['name'])) {
                            $goodsUpload = uploadOss('', $_FILES['goods_thumb_' . $key]);
                            if (!empty($goodsUpload['upload_data'])) {
                                $skuSqlInfo['goods_thumb'] = $goodsUpload['upload_data'];
                            }
                        }

                        /*属性存数据库*/
                        //查询属性是否已经存在，是 更新 否 插入
                        $goodsSkuInfo = $this->SourceModel->getSkuFromSkuId($key);
                        $type = (empty($goodsSkuInfo) or $key < 1000) ? 0 : 1; //0表示属性不存在 需要插入，1表示属性已存在 需要更新
                        if (!$type) {
                            $skuSqlInfo['add_time'] = time();
                        }

                        $this->SourceModel->insertSku($skuSqlInfo, $type, $key);
                    }
                }
                redirect('/sourceaction/index/goods');
            }
            exit;
        }

        /*取商品列表*/
        $classIdStr = getChildClass($classId); //根据分类ID获取子分类信息 组成数组

        $goodsNum = $this->SourceModel->getGoodsNum($classIdStr, $search,$goodssn,$isonsale,$isdelete,$isrmd,$brandid,$brandauthorizeid);
        //分页
        $perPage = 15;
        $pageArr = array(
            'page' => $page,
            'total' => $goodsNum,
            'url' => base_url() . 'sourceaction/goods/',
            'perPage' => $perPage,
            'maxSize' => 5,
            'isFirst' => 1,
            'isprev' => 1,
            'prevClass' => 'syy',
            'nextClass' => 'xyy',
            'firstClass' => 'sy',
            'endClass' => 'my',
        );
        $this->load->library('page');
        $pageClass = new page();
        $pageHtml = $pageClass->data($pageArr);
        //取当前页信息
        $userLevel = $this->session->userdata('user_level'); //当前用户权限

        /*2qi ----------------取渠道ID 按渠道分类商品*/
        $channelId = '';
        $goodsList = $this->SourceModel->getGoodsListFromPage($classIdStr, $page, $perPage, $userLevel, $channelId, $search,$goodssn,$isonsale,$isdelete,$isrmd,$brandid,$brandauthorizeid);

        //将商品信息中的ID 转换成对应的名称
        foreach ($goodsList as $key => $value) {
            //根据分类ID 取分类名
            $classInfo = getClassInfo($value->cat_id);
            $goodsList[$key]->cat_name = $classInfo->cat_name;

            //根据品牌ID 取品牌名
            $classInfo = getBrandInfo($value->brand_id);
            $goodsList[$key]->brand_name = $classInfo->brand_name;

            //根据渠道ID 取渠道名
            $classInfo = getChannelInfo($value->channel_id);
            $goodsList[$key]->channel_name = !empty($classInfo) ? $classInfo->channel_name : '';


            //转换销售状态
            $goodsList[$key]->is_on_sale = $goodsList[$key]->is_on_sale ? '是' : '否';

            //转换删除状态
            $goodsList[$key]->is_delete = $goodsList[$key]->is_delete ? '是' : '否';

            //取商品SKU
            $goodsList[$key]->goodsSku = $this->SourceModel->getSkuListFromGoodsId($value->goods_id);

            //查询商品是否过期
            $myConfig = $this->config->config;
            $goodsOutOfDate = $myConfig['myconfig']['goods_out_of_date']; //商品过期时间
            $goodsList[$key]->isOutOfDate = ((time() - $value->last_update) > $goodsOutOfDate) ? 1 : 0;
        }


        /*取分类列表*/
        $cateList = $this->SourceModel->getcateList();
        unset($cateList[0]);

        //品牌
        $brandList = $this->SourceModel->getBrandList(1);

        //授权品牌
        $brandAuthorizeList = $this->SourceModel->getBrandList(2);

        //取当前会员的快递
        $expressList = $this->SourceModel->getExpressFromUserId($this->session->userdata('admin_id'));
        $data['expressList'] = $expressList; //当前会员的快递
        $data['goodsList'] = $goodsList; //产品列表
        $data['pageHtml'] = $pageHtml; //分页
        $data['cateList'] = $cateList; //分类列表
        $data['brandList'] = $brandList; //品牌
        $data['brandAuthorizeList'] = $brandAuthorizeList; //授权品牌
        $data['search'] = $search; //产品名称
        $data['classId'] = $classId; //分类ID
        $data['goodssn'] = $goodssn; //货号
        $data['isonsale'] = $isonsale; //是否在售
        $data['isdelete'] = $isdelete; //是否在售
        $data['isrmd'] = $isrmd; //是否推荐
        $data['brandid'] = $brandid; //品牌ID
        $data['brandauthorizeid'] = $brandauthorizeid; //授权品牌ID

        //取用户级别
        $data['user'] = array(
            'userLevel' => $this->session->userdata['user_level'],
        );
        $data['isSearch'] = $isSearch;
        $this->load->view('source/goods', $data);
    }

    /*ajax获取商品详情*/
    public function showGoodsDetail()
    {
        $this->L('SourceModel');

        $goodsId = $this->input->get_post('goodsId');
        $goodsInfo = $this->SourceModel->getGoodsInfo($goodsId);
        //取该条商品的SKU
        $goodsInfo->goodsSku = $this->SourceModel->getSkuListFromGoodsId($goodsInfo->goods_id);
        foreach ($goodsInfo->goodsSku as $key => $value) {
            //取商品的color属性
            if ($goodsInfo->goodsSku[$key]->sku_color_id) {
                $temp = $this->SourceModel->getGoodsSkuInfoValue($goodsInfo->goodsSku[$key]->sku_color_id);
                $goodsInfo->goodsSku[$key]->color_value = (empty($temp)) ? '' : $temp->goods_sku_value;
            }
            //取取商品的size属性
            if ($goodsInfo->goodsSku[$key]->sku_size_id) {
                $temp = $this->SourceModel->getGoodsSkuInfoValue($goodsInfo->goodsSku[$key]->sku_size_id);
                $goodsInfo->goodsSku[$key]->size_value = (empty($temp)) ? '' : $temp->goods_sku_value;
            }
            //取商品的自定义属性
            if ($goodsInfo->goodsSku[$key]->sku_key_id) {
                $skuKeyIdArr = explode(',', $goodsInfo->goodsSku[$key]->sku_key_id);
                $skuValueIdArr = explode(',', $goodsInfo->goodsSku[$key]->sku_value_id);
                foreach ($skuKeyIdArr as $k => $v) {
                    $skuKey = $this->SourceModel->getGoodsSkuInfoKey($v);
                    $skuValue = $this->SourceModel->getGoodsSkuInfoValue($skuValueIdArr[$k]);
                    $goodsInfo->goodsSku[$key]->customSku[] = array(
                        $skuKey->sku_key => $skuValue->goods_sku_value
                    );
                }
            }
        }

        echo json_encode($goodsInfo);
    }

    /*清理过期商品*/
    public function deleteGoodsOutOfDate()
    {
        $this->L('SourceModel');

        /*查询所有过期商品的ID*/
        $myConfig = $this->config->config;
        $goodsOutOfDate = $myConfig['myconfig']['goods_out_of_date']; //商品过期时间
        $outDate = time() - $goodsOutOfDate;
        $outDateGoodsList = $this->SourceModel->getGoodsListOutOfDate($outDate);
        //无过期商品
        if (empty($outDateGoodsList)) {
            msg('过期商品已清理完毕！', base_url('sourceaction/index/goods'), 2, 2000);
        }

        foreach ($outDateGoodsList as $value) {
            //删除过期商品
            $this->SourceModel->delGoodsOutOfDate($value->goods_id);
            //删除过期商品的图片
            if (file_exists('./uploads/' . $value->goods_thumb)) {
                unlink('./uploads/' . $value->goods_thumb);
            }

            /*查询商品的属性*/
            $outDateGoodsSkuList = $this->SourceModel->getGoodsSkuListOutOfDate($value->goods_id);
            if (!empty($outDateGoodsSkuList)) {
                foreach ($outDateGoodsSkuList as $skuValue) {
                    //删除过期商品的属性
                    $this->SourceModel->delGoodsSkuOutOfDate($skuValue->goods_sku_id);
                    //删除过期商品的属性图片
                    if (file_exists('./uploads/' . $skuValue->goods_thumb)) {
                        unlink('./uploads/' . $skuValue->goods_thumb);
                    }
                }
            }
        }
        msg('过期商品已清理完毕！', base_url('sourceaction/index/goods'), 2, 2000);
    }

    /*添加、编辑商品页面*/
    public function addGoods($id = '')
    {
        $this->L('SourceModel');
        //如果商品ID不为空，取商品信息
        $goodsInfo = '';
        if ($id) {
            $goodsInfo = $this->SourceModel->getGoodsInfo($id);
            //取该条商品的SKU
            $goodsInfo->goodsSku = $this->SourceModel->getSkuListFromGoodsId($goodsInfo->goods_id);
            $goodsSkuStr = ''; //编辑产品信息  属性操作 给前台返回  goods_sku_id、sku_value_id、sku_color_id、sku_size_id
            foreach ($goodsInfo->goodsSku as $key => $value) {
                $goodsSkuStr .= $value->goods_sku_id . ',' . $value->sku_value_id . ',' . $value->sku_color_id . ',' . $value->sku_size_id . '|';
            }
            $goodsSkuStr = substr($goodsSkuStr, 0, -1); //去除字符串 最后一个|符号
        }

        /*取分类列表*/
        $cateList = $this->SourceModel->getcateList();
        unset($cateList[0]);

        /*组合分类的显示*/
        foreach ($cateList as $k => $v) {
            $realIdArr = explode(',', $v->cat_real_id);
            $realIdArrLength = count($realIdArr);
            $tempStr = '';
            for ($i = 1; $i < $realIdArrLength; $i++) {
                $tempStr .= '|--';
            }
            $cateList[$k]->cat_name = $tempStr . $v->cat_name;
        }
        //品牌
        $brandList = $this->SourceModel->getBrandList(1);

        //授权品牌
        $brandAuthorizeList = $this->SourceModel->getBrandList(2);

        if (empty($id)) { //判断是添加还是修改
            $goodsskukeyid = $cateList[1]->goods_sku_key_id; //读取下拉框第一个goods_sku_key_id值
        } else { //如果是修改进行下面操作
            foreach ($cateList as $item) { //对比产品分类  取出产品分类下goods_sku_key_id
                if ($item->cat_id == $goodsInfo->cat_id) {
                    $goodsskukeyid = $item->goods_sku_key_id; //读取下拉框goods_sku_key_id值
                }
            }
        }

        /*取商品所有SKU*/
        $goodsSkuList = $this->SourceModel->getGoodsSkuIdList($goodsskukeyid); //根据分类属性ID获取SKU

        foreach ($goodsSkuList as $key => $value) {
            //根据sku_key取sku_value列表
            $goodsSkuList[$key]->value = $this->SourceModel->getGoodsSkuValue($value->goods_sku_key_id);
        }

        $data = array(
            'goodsInfo' => $goodsInfo,
            'cateList' => $cateList,  //分类
            'brandList' => $brandList, //品牌
            'brandAuthorizeList' => $brandAuthorizeList, //授权品牌
            'goodsSkuList' => $goodsSkuList,
            'goodsSkuStr' => !empty($goodsSkuStr) ? $goodsSkuStr : '',
        );

        $this->load->view('source/addgoods', $data);
    }

    /**
     *选择分类 ajax 加载分类属性
     */
    public function ajaxCategoryAttribute()
    {
        $this->L('SourceModel');
        $catId = $this->input->get_post('catId');
        $catId = empty($catId) ? '' : $catId;

        //判断是否有值
        if (empty($catId)) {
            echo '1'; //所选分类无属性
            exit;
        }

        $this->L('categorymodel');
        //根据属性ID查询属性ID
        $catInfo = $this->categorymodel->getCatInfo($catId);
        if (empty($catInfo)) {
            echo '2'; //所选分类无属性
            exit;
        }
        /*取商品所有SKU*/
        $goodsSkuList = $this->SourceModel->getGoodsSkuIdList($catInfo->goods_sku_key_id); //根据分类属性ID获取SKU
        foreach ($goodsSkuList as $key => $value) {
            //根据sku_key取sku_value列表
            $goodsSkuList[$key]->value = $this->SourceModel->getGoodsSkuValue($value->goods_sku_key_id);
        }
        echo json_encode($goodsSkuList);
        exit;
    }

    /**
     * 商品相册管理
     *
     * 未完成。。（2015-01-09停止开发此功能，原因：用不上）
     */
    public function goodsPhoto($goodsId, $goodsSkuId = '')
    {
        if (empty($goodsId)) { //商品ID为空
            msg('参数错误！', base_url('sourceaction/index/goods'), 2, 2000);
        }
        $this->L('SourceModel');

        /*查询商品是否存在*/
        $goodsInfo = $this->SourceModel->getGoodsInfo($goodsId);
        if (empty($goodsInfo)) { //商品不存在
            msg('参数错误！', base_url('sourceaction/index/goods'), 2, 2000);
        }

        /*取商品属性*/
        if (!empty($goodsSkuId)) {
            $goodsSkuList = $this->SourceModel->getSkuFromSkuId($goodsSkuId);
            if (empty($goodsSkuList)) { //商品属性不存在
                msg('参数错误！', base_url('sourceaction/index/goods'), 2, 2000);
            }
        }

        /*查询所有相册*/
        if (empty($goodsSkuId)) { //根据商品查询相册
            $goodsPhoto = $this->SourceModel->getGoodsPhoto($goodsId);
            $photoType = 'goods';
        } else { //根据商品SKU查询相册
            $goodsPhoto = $this->SourceModel->getGoodsPhoto('', $goodsSkuId);
            $photoType = 'goodsSku';
        }

        $data = array(
            'goodsPhoto' => $goodsPhoto,
            'photoType' => $photoType,
        );
        $this->load->view('photo/goodsphoto', $data);
    }

    /**
     * 商品属性管理
     */
    public function goodsSku()
    {
        $this->L('SourceModel');
        /*取全部商品SKU*/
        $goodsSkuList = $this->SourceModel->getGoodsSkuList();

        /*取SKU对应的VALUE*/
        foreach ($goodsSkuList as $key => $value) {
            $goodsSkuList[$key]->sku_value = $this->SourceModel->getGoodsSkuValue($value->goods_sku_key_id);
        }
        $data = array(
            'goodsSkuList' => $goodsSkuList,
            'userLevel' => $this->session->userdata['user_level'],
        );
        $this->load->view('source/goodssku', $data);
    }

    /**
     * 添加商品属性
     */
    public function addGoodsSku($id = '')
    {
        /*读取产品分类*/

        $this->L('categorymodel');
//        $categoryList = $this->categorymodel->getList(2); //1-信息分类、2-产品分类
//        $categoryList = $this->outClassName($categoryList);
        $this->L('SourceModel');

        /*添加编辑属性*/
        $act = $this->input->post('act');
        if ($act == 'add') {
            $skuName = $this->input->post('sku_name');
            $id = $this->input->post('key_id');
            $isShow = $this->input->post('is_show');
            $isSearch = $this->input->post('is_search');
            $sqlInfo = array(
                'sku_key' => $skuName,
                'is_show' => $isShow,
                'is_search' => $isSearch,
                'sku_state' => 1,
                'add_time' => time(),
                'last_update' => time(),
            );

            //查询属性是否存在 存在则更新  不存在则插入
            $goodsSkuId = empty($id) ? $this->SourceModel->getSkuKey($skuName) : $id;
            $type = empty($goodsSkuId) ? 0 : $goodsSkuId; //0表示没有该属性

            $insertId = $this->SourceModel->addGoodsSku($sqlInfo, $type);
            if ($insertId) {
                redirect('/sourceaction/goodsSku/');
            }
        }

        /*取属性信息*/
        $goodsSkuInfo = '';
        if (!empty($id)) {
            $goodsSkuInfo = $this->SourceModel->getGoodsSkuInfo($id);
        }

        $data = array(
            'goodsSkuInfo' => $goodsSkuInfo,
//            'categoryList' => $categoryList,
        );
        $this->load->view('source/addgoodssku', $data);
    }

    /**
     * 添加商品属性值
     */
    public function addGoodsSkuValue($keyId = '', $id = '')
    {
        $this->L('SourceModel');

        /*添加编辑属性值*/
        $act = $this->input->post('act');;
        if ($act == 'add') {
            $skuKeyId = $this->input->post('goods_sku_key_id');
            $id = $this->input->post('value_id');
            $goodsSkuValue = $this->input->post('goods_sku_value');
            $isShow = $this->input->post('is_show');
            $sqlInfo = array(
                'goods_sku_key_id' => $skuKeyId,
                'goods_sku_value' => $goodsSkuValue,
                'is_show' => $isShow,
                'add_time' => time(),
                'last_update' => time(),
            );

            //查询属性值是否存在 存在则更新  不存在则插入
            $goodsSkuValueId = empty($id) ? $this->SourceModel->getSkuValue($goodsSkuValue) : $id;
            $type = empty($goodsSkuValueId) ? 0 : $goodsSkuValueId; //0表示没有该属性值

            $insertId = $this->SourceModel->addGoodsSkuValue($sqlInfo, $type);
            if ($insertId) {
                redirect('/sourceaction/goodsSku/');
            }
        }

        /*取全部商品SKU*/
        $goodsSkuList = $this->SourceModel->getGoodsSkuList();

        /*取当前属性信息*/
        $goodsSkuInfo = $this->SourceModel->getGoodsSkuInfo($keyId);

        /*取属性值信息*/
        $goodsSkuValueInfo = '';
        if (!empty($id)) {
            $goodsSkuValueInfo = $this->SourceModel->getGoodsSkuInfoValue($id);
        }

        $data = array(
            'goodsSkuList' => $goodsSkuList,
            'goodsSkuInfo' => $goodsSkuInfo,
            'goodsSkuValueInfo' => $goodsSkuValueInfo,
        );
        $this->load->view('source/addgoodsskuvalue', $data);
    }

    /*添加产品详细图片*/
    public function addGoodsPhoto($goodsid = '', $goodsname = '')
    {
        $this->L('SourceModel');
        //字符转换
        $goodsname = urldecode($goodsname);
        $goodsid = empty($goodsid) ? $this->input->get_post('goods_id') : $goodsid;
        $goodsname = empty($goodsname) ? $this->input->get_post('goods_name') : $goodsname;
        $act = $this->input->get_post('act');
        $err = ''; //定义错误信息

        if (!empty($act) && $act = 'addGoodsPhoto') {

            $inData = array(
                'goods_id' => $goodsid,
                'sort' => $this->input->get_post('sort'),
                'add_time' => time(),
                'last_update' => time(),
            );

            /*保存商品缩略图*/
            if (!empty($_FILES['photo_image']['name'])) {
                $advUpload = @uploadOss('', $_FILES['photo_image']);
                if (!empty($advUpload['upload_data'])) {
                    $inData['photo_image'] = $advUpload['upload_data'];
                }

                //图片不为空进行添加
                $insertId = $this->SourceModel->addgoodsphoto($inData);
                if ($insertId) {
                    msg('添加成功！', base_url('sourceaction/addGoodsPhoto/' . $goodsid . '/' . $goodsname), 2, 2000);
                } else {
                    msg('添加失败！', base_url('sourceaction/addGoodsPhoto/' . $goodsid . '/' . $goodsname), 2, 2000);
                }
            } else {
                $err = '上传图片不能为空!';
            }
        }
        $data = array(
            'goodsname' => $goodsname,
            'goodsid' => $goodsid,
            'err' => $err,
        );

        $this->load->view('source/addgoodsphoto', $data);
    }

    /*修改产品详细图片*/
    public function editGoodsPhoto($goodsid = '', $goodsname = '', $photoid = '')
    {
        $this->L('SourceModel');
        //字符转换
        $goodsname = urldecode($goodsname);
        $goodsid = empty($goodsid) ? $this->input->get_post('goods_id') : $goodsid;
        $goodsname = empty($goodsname) ? $this->input->get_post('goods_name') : $goodsname;
        $photoid = empty($photoid) ? $this->input->get_post('photo_id') : $photoid;
        $act = $this->input->get_post('act');
        $err = ''; //定义错误信息

        if (!empty($act) && $act = 'editGoodsPhoto') {
            $inData = array(
                'photo_id' => $photoid,
                'goods_id' => $goodsid,
                'sort' => $this->input->get_post('sort'),
                'last_update' => time(),
            );

            /*保存商品缩略图*/
            if (!empty($_FILES['photo_image']['name'])) {
                $advUpload = @uploadOss('', $_FILES['photo_image']);
                if (!empty($advUpload['upload_data'])) {
                    $inData['photo_image'] = $advUpload['upload_data'];
                }
            } else {
                $err = '上传图片不能为空!';
            }

            //图片不为空进行添加
            $insertId = $this->SourceModel->editgoodsphoto($inData);
            if ($insertId) {
                msg('修改成功！', base_url('sourceaction/addGoodsPhoto/' . $goodsid . '/' . $goodsname), 2, 2000);
            } else {
                msg('修改失败！', base_url('sourceaction/addGoodsPhoto/' . $goodsid . '/' . $goodsname), 2, 2000);
            }
        }

        //根据ID获取详细信息
        $goodsphoto = $this->SourceModel->getgoodphoto('', $photoid);

        $data = array(
            'goodsname' => $goodsname,
            'goodsid' => $goodsid,
            'err' => $err,
            'act' => 'edit',
            'goodsphoto' => $goodsphoto
        );
        $this->load->view('source/addgoodsphoto', $data);
    }

    /*读取产品图片信息*/
    public function  indexgoodsphoto($goodsid = '', $goodsname = '')
    {
        $this->L('SourceModel');
        $goodsphoto = $this->SourceModel->getgoodphoto($goodsid);
        $data = array(
            'goodsphoto' => $goodsphoto,
            'goodsid' => $goodsid,
            'goodsname' => $goodsname,
        );

        $this->load->view('source/goodsphotolist', $data);
    }

    /**
     * 删除商品
     */
    public function delGoodsPhoto()
    {
        $this->L('SourceModel');
        $id = $this->input->post('id');
        $boolgoodsp = $this->SourceModel->delGoodsPhoto('', $id);
        echo $boolgoodsp;
        exit;
    }


    /**
     * 删除商品
     */
    public function delGoods()
    {
        $this->L('SourceModel');
        $id = $this->input->post('id');
        $this->SourceModel->delGoods($id);
    }

    /**
     * 删除商品属性
     */
    public function delGoodsSku()
    {
        $this->L('SourceModel');
        $id = $this->input->post('id');
        $type = $this->input->post('type');
        if ($type == 'sku') { //删除商品属性
            $this->SourceModel->delGoodsSku($id);
        } elseif ($type == 'skuValue') { //删除商品属性值
            $this->SourceModel->delGoodsSkuValue($id);
        }
    }

    /**
     * 根据分类名查询有没有此分类 有的话返回分类ID 没有则创建分类
     */
    private function exClass($arr)
    {
        $id = array();
        $this->L('SourceModel');
        $this->L('categorymodel');
        /*根据分类名称取得分类ID*/
        foreach ($arr as $key => $value) {
            foreach ($value as $k => $v) {
                if (!empty($v)) {
                    $oneClassId = $this->SourceModel->getClassIdFromClassName($v);
                    if ($oneClassId) {
                        $id[$k] = $oneClassId[0]->cat_id;
                    } else { //分类不存在，创建分类
                        switch ($key) {
                            case 'pro_step_two_class':
                                $parentIdArr = $arr['pro_step_one_class']; //上级分类数组
                                break;
                            case 'pro_step_three_class':
                                $parentIdArr = $arr['pro_step_two_class'];
                                break;
                            case 'pro_step_four_class':
                                $parentIdArr = $arr['pro_step_three_class'];
                                break;
                            default:
                        }
                        /*存入数据库*/
                        if (empty($parentIdArr)) {
                            $pId = '00001';
                        } else {
                            $pId = $this->SourceModel->getClassIdFromClassName($parentIdArr[$k]); //获得上级分类的real_id
                            $pId = $pId[0]->cat_real_id; //获得上级分类的real_id
                        }
                        $classRealId = getRealId($pId);
                        if (!empty($classRealId)) {
                            $inData = array(
                                'cat_real_id' => $classRealId,
                                'cat_name' => $v,
                                'cat_type' => 1,
                                'sort' => 0,
                                'add_time' => time(),
                                'last_update' => time(),
                            );
                            $id[$k] = $this->categorymodel->insertCategory($inData);
                        }
                    }
                }
            }

        }
        return $id;
    }

    /**
     * 根据SKU的值获取SKU(key和value) ID 如果不存在则添加
     * @parm:   $sku--属性值
     *          $type--方式, 1:size,2:color,3:其他自定义
     */
    private function getSkuId($sku, $type = 'size')
    {
        $this->L('SourceModel');
        /*判断是否存在skuKey*/
        $skuKeyId = $this->SourceModel->getSkuKey($type);
        if (empty($skuKeyId)) {
            $skuKeyId = $this->SourceModel->insertSkuKey($type);
        }

        /*判断是否存在sku*/
        $skuValueId = $this->SourceModel->getSkuValue($sku, $skuKeyId);
        if (empty($skuValueId)) {
            $skuValueId = $this->SourceModel->insertSkuValue($sku, $skuKeyId);
        }

        $arr = array(
            'skuKeyId' => $skuKeyId,
            'skuValueId' => $skuValueId,
        );
        return $arr;
    }

    /**
     * 根据品牌名得到品牌ID 如果不存在则添加
     */
    private function getBrandId($brandName)
    {
        $this->L('SourceModel');
        $brandArr = $this->SourceModel->getBrandIdFromBrandName($brandName);
        if (empty($brandArr)) {
            $brandId = $this->SourceModel->insertBrand($brandName);
        } else {
            $brandId = $brandArr->brand_id;
        }
        return $brandId;
    }


    /*
  *读取活动规则列表--分页*/
    public function goodsSaleListIndex($page = 1)
    {
        $this->L('SourceModel');
        $goodsSaleNum = $this->SourceModel->getGoodsSaleNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $goodsSaleNum,
            'url' => base_url() . 'sourceaction/goodsSaleListIndex/', //路径
            'perPage' => $perPage, //每页显示多少条数据
            'maxSize' => 5, //分页显示多长
            'isFirst' => 1, //是否显示首页尾页
            'isprev' => 1, //是否显示上一页下一页
            'prevClass' => 'syy', //上一页class
            'nextClass' => 'xyy', //下一页的class
            'firstClass' => 'sy', //首页的class
            'endClass' => 'my', //尾页的class
        );
        $this->load->library('page');
        $pageClass = new page();
        $goodsSaleHtml = $pageClass->data($pageArr);
        $goodsSaleList = $this->SourceModel->getGoodsSaleList($page, $perPage);

        $data['goodsSaleHtml'] = $goodsSaleHtml;
        $data['goodsSaleList'] = $goodsSaleList;

        $this->load->view('source/goodssalelist', $data);
    }

    /*
   *删除活动规则*/
    public function deleteGoodsSale()
    {
        $this->L('SourceModel');
        $gsid = $this->input->get_post('id');
        //判断接受ID是否有值
        if (!empty($gsid)) {
          $this->SourceModel->delGoodsSaleId($gsid);
            echo '1';
            exit;
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */