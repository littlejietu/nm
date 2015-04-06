<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class categoryAction extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * $type:分类类型 1--信息分类 2--商品分类
     */
    public function index($type = 1)
    {
        $this->L('categorymodel');
        /*页面信息*/
        $categoryList = $this->categorymodel->getList($type);
        $categoryList = $this->outClassName($categoryList);

        $data = array(
            'categoryList' => $categoryList,
            'type' => $type,
        );
        $this->load->view('category/categorylist', $data);
    }

    /**
     * 添加分类*/
    public function addCat($type = '1', $partId = '')
    {
        $this->L('categorymodel');
        $act = $this->input->post('act');
        $act = empty($act) ? '' : $act;
        $partId = empty($partId) ? '' : $partId;
        if (empty($partId)) {
            $partId = '';
        } else {
            $partId = $this->categorymodel->getRealId($partId);
            $partId = $partId->cat_real_id;
        }

        //添加分类
        if ($act == 'addCat') {

            $className = $this->input->post('cat_name');
            $classNameEn = $this->input->post('cat_name_en');
            $type = $this->input->post('type');
            $partId = $this->input->post('part_id');
            $rmd = $this->input->post('rmd');
            $sort = $this->input->post('sort');
            $sort = empty($sort) ? 0 : $sort;
            //组合分类的真实ID
            $classRealId = getRealId($partId);

            /*存入数据库*/
            if ($classRealId) {
                $inData = array(
                    'cat_real_id' => $classRealId,
                    'cat_name' => $className,
                    'cat_name_en' => $classNameEn,
                    'cat_type' => ($type - 1),
                    'is_rmd' => $rmd,
                    'sort' => $sort,
                    'add_time' => time(),
                    'last_update' => time(),
                    'is_show' => 1,
                );
                $advbool =   $this->categorymodel->insertCategory($inData);
                if ($advbool) {
                    msg('添加成功！', base_url('categoryaction/index/'.$type), 2, 2000);
                } else {
                    msg('添加失败！', base_url('categoryaction/index/'.$type), 2, 2000);
                }
            }
        }

        /*页面信息*/
        $categoryList = $this->categorymodel->getList($type);
        $categoryList = $this->outClassName($categoryList);

        $data = array(
            'categoryList' => $categoryList,
            'partId' => $partId,
            'act' => $act,
            'type' => $type,
        );
        $this->load->view('category/categoryadd', $data);
    }

    /**
     * 编辑分类*/
    public function editCat($type = '', $catId = '')
    {
        $this->L('categorymodel');
        $act = $this->input->post('act');
        $catId = empty($catId) ? '' : $catId;
        if (!empty($catId)) {
            $catInfo = $this->categorymodel->getCatInfo($catId);
            $partId = explode(',', $catInfo->cat_real_id);
            array_pop($partId);
            $partId = implode(',', $partId);
        }
        /*更新数据*/
        if ($act == 'editCat') {
            $className = $this->input->post('cat_name');
            $classNameEn = $this->input->post('cat_name_en');
            $partId = $this->input->post('part_id');
            $type = $this->input->post('type');
            $rmd = $this->input->post('rmd');
            $isShow = $this->input->post('is_show');
            $sort = $this->input->post('sort');
            $catId = $this->input->post('cat_id');
            $sort = empty($sort) ? 0 : $sort;

            /*存入数据库*/
            $inData = array(
                'cat_name' => $className,
                'cat_name_en' => $classNameEn,
                'is_show' => $isShow,
                'cat_type' => ($type - 1),
                'is_rmd' => $rmd,
                'cat_real_id' => getRealId($partId),
                'sort' => $sort,
                'last_update' => time(),
            );
            $advbool =  $this->categorymodel->updateCategory($inData, $catId);
            $this->load->view('category/categoryadd', $type);
            if ($advbool) {
                msg('修改成功！', base_url('categoryaction/index/'.$type), 2, 2000);
            } else {
                msg('修改失败！', base_url('categoryaction/index/'.$type), 2, 2000);
            }
        }
        /*页面信息*/
        $categoryList = $this->categorymodel->getList($type);
        $categoryList = $this->outClassName($categoryList);

        $data = array(
            'categoryList' => $categoryList,
            'partId' => $partId,
            'catId' => $catId,
            'catInfo' => $catInfo,
            'act' => 'edit',
            'type' => $type,
        );
        $this->load->view('category/categoryadd', $data);
    }

    /**
     * 添加属性*/
    public function  editClassYproperty($catid = '', $type = '')
    {
        $this->L('SourceModel');
        $this->L('categorymodel');
        $act = $this->input->post('act');
        if (empty($type)) {
            $type = $this->input->get_post('type');
        }
        //读取属性信息
        $goodsskulist = $this->SourceModel->getGoodsSkuList();

        //判断是否需要修改
        if (!empty($act) && $act == 'edit' && !empty($catid)) {
            $checkSons = $this->input->post('checkSons');
            if (!empty($checkSons)) {
                $checkSons = implode(",", $checkSons);
            }
            /*存入数据库*/
            $inData = array(
                'goods_sku_key_id' => $checkSons,
                'last_update' => time(),
            );
            $this->categorymodel->updateCategory($inData, $catid);
        }
        //根据分类主键ID获取分类信息
        $catInfo = $this->categorymodel->getCatInfo($catid);

        $data = array(
            'act' => 'edit',
            'catid' => $catid,
            'catInfo' => $catInfo,
            'goodsskulist' => $goodsskulist,
            'type' => $type,
        );

        $this->load->view('category/addclassyproperty', $data);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */