<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class advspacsAction extends MY_Controller
{
    function __construcr()
    {
        parent::__construct();
    }

    //读取广告位列表页
    public function indexAdvSpaces($page = 1)
    {
        $this->L('advspacesmodel');
        $advspacesNum = $this->advspacesmodel->getAdvSpacesNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page'      => $page,
            'total  '   => $advspacesNum,
            'url'       => base_url() . 'advspacsaction/indexAdvSpaces/', //路径
            'perPage'   => $perPage, //每页显示多少条数据
            'maxSize'   => 5, //分页显示多长
            'isFirst'   => 1, //是否显示首页尾页
            'isprev'    => 1, //是否显示上一页下一页
            'prevClass' => 'syy', //上一页class
            'nextClass' => 'xyy', //下一页的class
            'firstClass'=> 'sy', //首页的class
            'endClass'  => 'my', //尾页的class
        );
        $this->load->library('page');
        $pageClass = new page();
        $advspacesHtml = $pageClass->data($pageArr);
        $advspacesList = $this->advspacesmodel->getAdvSpaces($page, $perPage);

        $data['advspacesHtml'] = $advspacesHtml;
        $data['advspacesList'] = $advspacesList;

        $this->load->view('advspacs/advspacslist', $data);
    }

    //添加广告位
    public function addAdvSpaces()
    {
        $this->L('advspacesmodel');
        $act = $this->input->post('act');
        $act = empty($act) ? '' : $act;
        //判断是否执行添加方法
        if ($act == 'addAdvSpaces') {
            //判断是否有添加
            $adv_spaces_title = $this->input->post('adv_spaces_title');
            $adv_spaces_money = $this->input->post('adv_spaces_money');
            $adv_spaces_height = $this->input->post('adv_spaces_height');
            $adv_spaces_width = $this->input->post('adv_spaces_width');
            $is_show = $this->input->post('is_show');
            $inData = array(
                'adv_spaces_title' => $adv_spaces_title,
                'adv_spaces_money' => $adv_spaces_money,
                'adv_spaces_height'=> $adv_spaces_height,
                'adv_spaces_width' => $adv_spaces_width,
                'is_show'          => $is_show,
            );
            $advSpacesId = $this->advspacesmodel->addAdvSpaces($inData);
            if (!empty($advSpacesId)) {
                msg('添加成功！', base_url('advspacsaction/editAdvSpaces/' . $advSpacesId), 2, 2000);
            } else {
                msg('添加失败！', base_url('advspacsaction/addAdvSpaces/'), 2, 2000);
            }
        }

        $this->load->view('advspacs/addadvspacs');
    }

    //修改广告位
    public function  editAdvSpaces($advSpacesId = '')
    {
        $this->L('advspacesmodel');
        $act = $this->input->post('act');
        $advSpacesId = empty($advSpacesId) ? '' : $advSpacesId;

        //判断是否要修改
        if ($act == 'editAdvSpaces') {

            $adv_spaces_id = $this->input->post('adv_spaces_id');
            $adv_spaces_title = $this->input->post('adv_spaces_title');
            $adv_spaces_money = $this->input->post('adv_spaces_money');
            $adv_spaces_height = $this->input->post('adv_spaces_height');
            $adv_spaces_width = $this->input->post('adv_spaces_width');
            $is_show = $this->input->post('is_show');
            $inData = array(
                'adv_spaces_id'    => $adv_spaces_id,
                'adv_spaces_title' => $adv_spaces_title,
                'adv_spaces_money' => $adv_spaces_money,
                'adv_spaces_height'=> $adv_spaces_height,
                'adv_spaces_width' => $adv_spaces_width,
                'is_show'          => $is_show,
            );
            $advbool = $this->advspacesmodel->editAdvSpaces($inData);
            if ($advbool) {
                msg('修改成功！', base_url('advspacsaction/editAdvSpaces/' . $adv_spaces_id), 2, 2000);
            } else {
                msg('修改失败！', base_url('advspacsaction/addAdvSpaces/' . $adv_spaces_id), 2, 2000);
            }
        }

        //判断接受ID是否有值
        if (!empty($advSpacesId)) {
            $advSpaces = $this->advspacesmodel->getSpacesId($advSpacesId);
        }

        $data = array(
            'advSpaces' => $advSpaces,
            'act' => !empty($advSpacesId) ? 'edit' : 'add',
        );
        $this->load->view('advspacs/addadvspacs', $data);

    }

    //删除广告位
    public function deleteAdvSpaces()
    {
        $this->L('advspacesmodel');
        $advSpacesId = $this->input->get_post('id');
        //接受广告位ID
        $advSpacesId = empty($advSpacesId) ? '' : $advSpacesId;
        //判断接受ID是否有值
        if (!empty($advSpacesId)) {
            $advSpaces = $this->advspacesmodel->deleteAdvSpaces($advSpacesId);
            if ($advSpaces) {
                msg('删除成功！', base_url('advspacsaction/index/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('advspacsaction/index/'), 2, 2000);
            }
        }
    }

    /*广告方法操作*/

    //读取广告列表页
    public function indexAdvertiser($page = 1)
    {
        $this->L('advspacesmodel');
        $advertiserNum = $this->advspacesmodel->getAdvertiserNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $advertiserNum,
            'url' => base_url() . 'advspacsaction/indexAdvertiser/', //路径
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
        $advertiserHtml = $pageClass->data($pageArr);
        $advertiserList = $this->advspacesmodel->getAdvertiser($page, $perPage);

        $data['advertiserHtml'] = $advertiserHtml;
        $data['advertiserList'] = $advertiserList;


        $this->load->view('advspacs/advertiserlist', $data);
    }

    //添加广告
    public function addAdvertiser()
    {
        $this->L('advspacesmodel');
        $act = $this->input->post('act');
        $act = empty($act) ? '' : $act;

        //读取广告位信息
        $advspaceslist = $this->GetAdvertising();

        //判断是否执行添加方法
        if ($act == 'addAdvertiser') {
            //判断是否有添加
            $adv_title = $this->input->post('adv_title');
            $adv_money = $this->input->post('adv_money');
            $adv_url = $this->input->post('adv_url');
            $adv_content = $this->input->post('adv_content');
            $adv_remark = $this->input->post('adv_remark');
            $adv_user_name = $this->input->post('adv_user_name');
            $adv_user_real_name = $this->input->post('adv_user_real_name');
            $adv_start_time = strtotime($this->input->post('adv_start_time')); //获取当前时间并转为时间戳
            $adv_end_time = strtotime($this->input->post('adv_end_time')); //获取当前时间并转为时间戳
            $sort = $this->input->post('sort');
            $is_show = $this->input->post('is_show');

            $inData = array(
                'adv_title'          => $adv_title,
                'adv_money'          => $adv_money,
                'adv_url'            => $adv_url,
                'adv_content'        => $adv_content,
                'adv_remark'         => $adv_remark,
                'adv_user_name'      => $adv_user_name,
                'adv_user_real_name' => $adv_user_real_name,
                'adv_start_time'     => $adv_start_time,
                'adv_end_time'       => $adv_end_time,
                'sort'               => $sort,
                'is_show'            => $is_show,
            );

            //读取下拉框的值（id、title）
            $adv_spaces = $this->input->post('adv_spaces');
            if (!empty($adv_spaces)) { //判断下拉宽值不为空
                $adv_spaces = explode(',', $adv_spaces); //根据逗号截取
                if (!empty($adv_spaces) && count($adv_spaces) > 1) {
                    $inData['adv_spaces_id'] = $adv_spaces[0]; //广告ID
                    $inData['adv_spaces_name'] = $adv_spaces[1]; //广告名称
                }
            }
            /*保存商品缩略图*/
            if (!empty($_FILES['adv_imgs']['name'])) {
                $advUpload = @uploadOss('', $_FILES['adv_imgs']);
                if (!empty($advUpload['upload_data'])) {
                    $inData['adv_imgs'] = $advUpload['upload_data'];
                }
            }

            $adv_id = $this->advspacesmodel->addAdvertiser($inData);
            if (!empty($adv_id)) {
                msg('添加成功！', base_url('advspacsaction/editAdvertiser/' . $adv_id), 2, 2000);
            } else {
                msg('添加失败！', base_url('advspacsaction/addAdvertiser/'), 2, 2000);
            }
        }

        //组装数组传回页面
        $data['advspaceslist'] = $advspaceslist;

        $this->load->view('advspacs/addadvertiser', $data);
    }

    //修改广告
    public function  editAdvertiser($adv_id = '')
    {
        $this->L('advspacesmodel');
        $act = $this->input->post('act');
        $adv_id = empty($adv_id) ? '' : $adv_id;

        //读取广告位信息
        $advspaceslist = $this->GetAdvertising();

        //判断是否要修改
        if ($act == 'editAdvertiser') {
            $adv_id = $this->input->post('adv_id');
            $adv_spaces_id = $this->input->post('adv_spaces_id');
            $adv_spaces_name = $this->input->post('adv_spaces_name');
            $adv_title = $this->input->post('adv_title');
            $adv_money = $this->input->post('adv_money');
            $adv_url = $this->input->post('adv_url');
            $adv_content = $this->input->post('adv_content');
            $adv_remark = $this->input->post('adv_remark');
            $adv_user_name = $this->input->post('adv_user_name');
            $adv_user_real_name = $this->input->post('adv_user_real_name');
            $adv_start_time = strtotime($this->input->post('adv_start_time'));
            $adv_end_time =strtotime($this->input->post('adv_end_time'));
            $sort = $this->input->post('sort');
            $is_show = $this->input->post('is_show');
            $inData = array(
                'adv_id'             => $adv_id,
                'adv_spaces_id'      => $adv_spaces_id,
                'adv_spaces_name'    => $adv_spaces_name,
                'adv_title'          => $adv_title,
                'adv_money'          => $adv_money,
                'adv_url'            => $adv_url,
                'adv_content'        => $adv_content,
                'adv_remark'         => $adv_remark,
                'adv_user_name'      => $adv_user_name,
                'adv_user_real_name' => $adv_user_real_name,
                'adv_start_time'     => $adv_start_time,
                'adv_end_time'       => $adv_end_time,
                'sort'               => $sort,
                'is_show'            => $is_show,
            );


            //读取下拉框的值（id、title）
            $adv_spaces = $this->input->post('adv_spaces');
            if (!empty($adv_spaces)) { //判断下拉宽值不为空
                $adv_spaces = explode(',', $adv_spaces); //根据逗号截取
                if (!empty($adv_spaces) && count($adv_spaces) > 1) {
                    $inData['adv_spaces_id'] = $adv_spaces[0]; //广告ID
                    $inData['adv_spaces_name'] = $adv_spaces[1]; //广告名称
                }
            }

            /*保存商品缩略图*/
            if (!empty($_FILES['adv_imgs']['name'])) {
                $advUpload = @uploadOss('', $_FILES['adv_imgs']);
                if (!empty($advUpload['upload_data'])) {
                    $inData['adv_imgs'] = $advUpload['upload_data'];
                }
            }

            $advbool = $this->advspacesmodel->editAdvertiser($inData);
            if ($advbool) {
                msg('修改成功！', base_url('advspacsaction/editAdvertiser/' . $adv_id), 2, 2000);
            } else {
                msg('修改失败！', base_url('advspacsaction/editAdvertiser/' . $adv_id), 2, 2000);
            }
        }

        //判断接受ID是否有值
        if (!empty($adv_id)) {
            $advAdvertiser = $this->advspacesmodel->getAdvId($adv_id);
        }

        $data = array(
            'advspaceslist' => $advspaceslist,
            'advAdvertiser' => empty($advAdvertiser) ? array() : $advAdvertiser,
            'act' => !empty($adv_id) ? 'edit' : 'add',
        );
        $this->load->view('advspacs/addadvertiser', $data);

    }

    //删除广告
    public function deleteAdvertiser()
    {
        $this->L('advspacesmodel');
        $advSpacesId = $this->input->get_post('id');
        //接受广告位ID
        $advSpacesId = empty($advSpacesId) ? '' : $advSpacesId;
        //判断接受ID是否有值
        if (!empty($advSpacesId)) {
            $advSpaces = $this->advspacesmodel->deleteAdvertiser($advSpacesId);
            if ($advSpaces) {
                msg('删除成功！', base_url('advspacsaction/index/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('advspacsaction/index/'), 2, 2000);
            }
        }
    }

    //读取广告信息
    private function GetAdvertising()
    {
        $this->L('advspacesmodel');
        return $advertiserList = $this->advspacesmodel->getSpacesShow(1);

    }


}