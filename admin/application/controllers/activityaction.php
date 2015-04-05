<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class activityAction extends MY_Controller
{
    function __construcr()
    {
        parent::__construct();
    }

    /*
    *读取活动规则列表--分页*/
    public function index($page = 1)
    {
        $this->L('activitymodel');
        $activityNum = $this->activitymodel->getActivityNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $activityNum,
            'url' => base_url() . 'index.php/activityaction/index/', //路径
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
        $activityHtml = $pageClass->data($pageArr);
        $activityList = $this->activitymodel->getActivity($page, $perPage);

        $data['activityHtml'] = $activityHtml;
        $data['activityList'] = $activityList;

        $this->load->view('activity/activitylist', $data);
    }

    /*
    *添加活动规则*/
    public function addActivity()
    {
        $this->L('activitymodel');
        $act = $this->input->post('act');
        $act = empty($act) ? '' : $act;

        //判断是否执行添加方法
        if ($act == 'addActivity') {
            //判断是否有添加
            $acti_title = $this->input->get_post('acti_title');
            $sort = $this->input->get_post('sort');
            $is_show = $this->input->get_post('is_show');
            $inData = array(
                'acti_title' => $acti_title,
                'sort' => $sort,
                'is_show' => $is_show,
                'add_time' => time(),
                'last_time' => time(),
            );

            $acti_id = $this->activitymodel->addActivity($inData);
            if (!empty($acti_id)) {
                msg('添加成功！', base_url('index.php/activityaction/editActivity/' . $acti_id), 2, 2000);
            } else {
                msg('添加失败！', base_url('index.php/activityaction/addActivity/'), 2, 2000);
            }
        }
        $this->load->view('activity/addactivity');
    }

    /*
     *修改活动规则*/
    public function editActivity($acti_id = '')
    {
        $this->L('activitymodel');
        $act = $this->input->get_post('act');
        $acti_id = empty($acti_id) ? '' : $acti_id;

        //判断是否要修改
        if ($act == 'editActivity') {
            $acti_id = $this->input->get_post('acti_id');
            $acti_title = $this->input->get_post('acti_title');
            $sort = $this->input->get_post('sort');
            $is_show = $this->input->get_post('is_show');
            $inData = array(
                'acti_id' => $acti_id,
                'acti_title' => $acti_title,
                'sort' => $sort,
                'is_show' => $is_show,
                'last_time' => time(),
            );

            $advbool = $this->activitymodel->editActivity($inData);

            if ($advbool) {
                msg('修改成功！', base_url('index.php/activityaction/editActivity/' . $acti_id), 2, 2000);
            } else {
                msg('修改失败！', base_url('index.php/activityaction/editActivity/' . $acti_id), 2, 2000);
            }
        }

        //判断接受ID是否有值
        if (!empty($acti_id)) {
            $activity = $this->activitymodel->getActiId($acti_id);
        }

        $data = array(
            'activity' => empty($activity) ? array() : $activity,
            'act' => !empty($acti_id) ? 'edit' : 'add',
        );
        $this->load->view('activity/addactivity', $data);

    }

    /*
     *删除活动规则*/
    public function deleteAdvertiser()
    {
        $this->L('activitymodel');
        $acti_id = $this->input->get_post('id');
        //判断接受ID是否有值
        if (!empty($acti_id)) {
            $boolActiv = $this->activitymodel->deleteActivity($acti_id);
            if ($boolActiv) {
                msg('删除成功！', base_url('index.php/activityaction/index/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('index.php/activityaction/index/'), 2, 2000);
            }
        }
    }

    /*红包操作*/

    /*
     *读取红包列表*/
    public function indexRedbagrule($page = 1)
    {
        $this->L('activitymodel');
        $redbagruleNum = $this->activitymodel->getRedbagruleNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $redbagruleNum,
            'url' => base_url() . 'index.php/activityaction/indexRedbagrule/', //路径
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
        $redbagruleHtml = $pageClass->data($pageArr);
        $redbagruleList = $this->activitymodel->getRedbagruleList($page, $perPage);

        $data['redbagruleHtml'] = $redbagruleHtml;
        $data['redbagruleList'] = $redbagruleList;

        $this->load->view('activity/redbagrulelist', $data);
    }

    /*
     *添加红包列表*/
    public function addRedbagrule()
    {
        $this->L('activitymodel');
        $act = $this->input->post('act');
        $act = empty($act) ? '' : $act;

        //读取广告规则信息
        $activityshow = $this->activitymodel->getActivityShow(1);

        //判断是否执行添加方法
        if ($act == 'addRedbagrule') {
            //判断是否有添加
            $rbr_title = $this->input->get_post('rbr_title');
            $rbr_money = $this->input->get_post('rbr_money');
            $rbr_meet_money = $this->input->get_post('rbr_meet_money');
            $sort = $this->input->get_post('sort');
            $is_show = $this->input->get_post('is_show');
            $rbr_start_time = strtotime($this->input->get_post('rbr_start_time'));
            $rbr_end_time = strtotime($this->input->get_post('rbr_end_time'));

            $inData = array(
                'rbr_title' => $rbr_title,
                'rbr_money' => $rbr_money,
                'rbr_meet_money' => $rbr_meet_money,
                'sort' => $sort,
                'is_show' => $is_show,
                'rbr_start_time' => $rbr_start_time,
                'rbr_end_time' => $rbr_end_time,
                'add_time' => time(),
                'last_update' => time(),
            );

            //读取下拉框的值（id、title）
            $acti = $this->input->post('acti');
            if (!empty($acti)) { //判断下拉宽值不为空
                $acti = explode(',', $acti); //根据逗号截取
                if (!empty($acti) && count($acti) > 1) {
                    $inData['acti_id'] = $acti[0]; //活动ID
                    $inData['acti_title'] = $acti[1]; //活动名称
                }
            }

            $rbr_id = $this->activitymodel->addRedbagrule($inData);
            if (!empty($rbr_id)) {
                msg('添加成功！', base_url('index.php/activityaction/editRedbagrule/' . $rbr_id), 2, 2000);
            } else {
                msg('添加失败！', base_url('index.php/activityaction/addRedbagrule/'), 2, 2000);
            }
        }
        $data = array(
            'activityshow' => $activityshow,
        );

        $this->load->view('activity/addredbagrule', $data);
    }

    /*
     * 修改红包列表*/
    public function editRedbagrule($rbr_id = '')
    {
        $this->L('activitymodel');
        $act = $this->input->get_post('act');
        $rbr_id = empty($rbr_id) ? '' : $rbr_id;

        //读取广告规则信息
        $activityshow = $this->activitymodel->getActivityShow(1);

        //判断是否要修改
        if ($act == 'editRedbagrule') {
            $rbr_id = $this->input->post('rbr_id');
            $rbr_title = $this->input->get_post('rbr_title');
            $rbr_money = $this->input->get_post('rbr_money');
            $rbr_meet_money = $this->input->get_post('rbr_meet_money');
            $sort = $this->input->get_post('sort');
            $is_show = $this->input->get_post('is_show');
            $rbr_start_time = strtotime($this->input->get_post('rbr_start_time'));
            $rbr_end_time = strtotime($this->input->get_post('rbr_end_time'));
            $inData = array(
                'rbr_id' => $rbr_id,
                'rbr_title' => $rbr_title,
                'rbr_money' => $rbr_money,
                'rbr_meet_money' => $rbr_meet_money,
                'sort' => $sort,
                'is_show' => $is_show,
                'rbr_start_time' => $rbr_start_time,
                'rbr_end_time' => $rbr_end_time,
                'last_update' => time(),
            );

            //读取下拉框的值（id、title）
            $acti = $this->input->post('acti');
            if (!empty($acti)) { //判断下拉宽值不为空
                $acti = explode(',', $acti); //根据逗号截取
                if (!empty($acti) && count($acti) > 1) {
                    $inData['acti_id'] = $acti[0]; //活动ID
                    $inData['acti_title'] = $acti[1]; //活动名称
                }
            }

            $advbool = $this->activitymodel->editRedbagrule($inData);

            if ($advbool) {
                msg('修改成功！', base_url('index.php/activityaction/editRedbagrule/' . $rbr_id), 2, 2000);
            } else {
                msg('修改失败！', base_url('index.php/activityaction/editRedbagrule/' . $rbr_id), 2, 2000);
            }
        }

        //判断接受ID是否有值
        if (!empty($rbr_id)) {
            $redbagrule = $this->activitymodel->getRedbagruleId($rbr_id);
        }

        $data = array(
            'redbagrule' => empty($redbagrule) ? array() : $redbagrule,
            'act' => !empty($rbr_id) ? 'edit' : 'add',
            'activityshow' => $activityshow,
        );


        $this->load->view('activity/addredbagrule', $data);
    }

    /*
     * 删除活动规则*/
    public function deleteRedbagrule()
    {
        $this->L('activitymodel');
        $rbr_id = $this->input->get_post('id');
        //判断接受ID是否有值
        if (!empty($rbr_id)) {
            $boolActiv = $this->activitymodel->deleteRedbagrule($rbr_id);
            if ($boolActiv) {
                msg('删除成功！', base_url('index.php/activityaction/indexRedbagrule/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('index.php/activityaction/indexRedbagrule/'), 2, 2000);
            }
        }
    }

    /*
     * 读取用户列表
     **/
    public function indexRedbaggift($type, $rbr_id = '', $page = 1)
    {
        $this->L('usermodel');
        $userNum = $this->usermodel->getUserNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $userNum,
            'url' => base_url() . 'index.php/activityaction/indexRedbaggift/' . $type . '/' . $rbr_id . '/', //路径
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
        $userHtml = $pageClass->data($pageArr);
        $userList = $this->usermodel->gettUserList($page, $perPage);

        $data['userHtml'] = $userHtml;
        $data['userList'] = $userList;
        $data['rbr_id'] = $rbr_id;
        $data['type'] = $type;
        $this->load->view('activity/redbaggift', $data);
    }

    /*
     *赠送红包、优惠码记录
     * $rbr_id 红包主键ID
     * $userid 用户ID
     * */
    public function addRedbaggift()
    {
        $id = $this->input->get_post('id'); //主键ID
        $userid = $this->input->get_post('user_id'); //用户主键ID
        $type = $this->input->get_post('type'); //redbag--红包、dcode--优惠码

        //根据用户ID读取用户信息
        $this->L('ucentermodel');
        if (!empty($userid)) { //判断接受ID是否有值
            $usermodel = $this->ucentermodel->getUserId($userid);
        }

        if (!empty($type) && $type == 'redbag') { // 红包派送

            //读取红包信息
            $this->L('activitymodel');

            // 判断红包是否派送过
            $redlist = $this->activitymodel->getRedaggiftList($userid, $id);          //根据用户ID跟红包id查询记录
            if (!empty($redlist)) {
                echo '5'; //不可以重复赠送
                exit;
            }

            if (!empty($id)) { //判断接受ID是否有值
                $redbagrule = $this->activitymodel->getRedbagruleId($id);
            }

            //判断红包规则和用户信息是否存在
            if (empty($redbagrule) || empty($usermodel)) {
                echo '2';
                exit;
            }

            // 判断次活动是否过期
            //判断活动起始时间小于当前时间则活动未开始
            if (time() < $redbagrule->rbr_start_time) {
                echo '3';
                exit;
            }
            //判断活动结束时间小于当前时间则活动过期
            if (time() > $redbagrule->rbr_end_time) {
                echo '4';
                exit;
            }

            //判断用户信息与红包信息 不为空进行添加

            $inData = array(
                'rbr_id' => $redbagrule->rbr_id, //红包主键ID
                'user_id' => $usermodel->user_id, //用户ID
                'user_name' => $usermodel->user_name, //用户名
                'is_show' => 1, //0-不显示、1显示、2-用户删除
                'istatus' => 0, //使用状态(0-未使用、1-已使用、2已过期)
                'add_time' => time(), //添加时间
                'last_time' => time(), //修改时间
            );
            //添加操作
            $redaggift = $this->activitymodel->addRedaggift($inData);
            if (!empty($redaggift) && $redaggift > 0) //判断是否成功
            {
                echo '1';
                exit;
            } else {
                echo '2';
                exit;
            }
        } else if (!empty($type) && $type == 'dcode') //优惠码派送
        {
            //读取优惠码信息
            $this->L('activitymodel');

            // 优惠码赠送

            // 判断优惠码是否派送过
            $dclist = $this->activitymodel->getDiscountCodeList($userid, $id);          //根据用户ID跟优惠码id查询记录
            if (!empty($dclist)) {
                echo '5'; //不可以重复赠送
                exit;
            }

            if (!empty($id)) { //判断接受ID是否有值
                $dcRule = $this->activitymodel->getDiscountCodeRuleId($id);
            }

            //判断优惠码规则和用户信息是否存在
            if (empty($dcRule) || empty($usermodel)) {
                echo '2';
                exit;
            }

            //判断活动起始时间小于当前时间则活动未开始
            if (time() < $dcRule->dc_start_time) {
                echo '3';
                exit;
            }

            //判断活动结束时间小于当前时间则活动过期
            if (time() > $dcRule->dc_end_time) {
                echo '4';
                exit;
            }
            $inData = array(
                'dc_id' => $dcRule->dc_id,
                'user_id' => $usermodel->user_id,
                'user_name' => $usermodel->user_name,
                'is_show' => 1,
                'istatus' => 0,
                'adc_details_content' => '',
                'add_time' => time(),
                'last_time' => time(),
            );

            //获取毫秒时间戳-当作优惠码编号与密码
            $time = explode(" ", microtime());
            $time = $time [1] . ($time [0] * 1000);
            $time2 = explode(".", $time);
            $time = $time2 [0];
            $inData['dc_coding'] = $time;
            //$inData['dc_coding'] = substr($time, 6, 11); //截取后七位时间戳 做为优惠码编号
            $inData['dc_pws'] = substr($time, 0, 6); //截取见面六位时间戳   做为优惠码密码


            //判断 优惠码有效周期时间是否有值
            if (!empty($dcRule->dc_valid_cycle)) {
                $inData['adc_start_time'] = time();
                $inData['adc_end_time'] = date(strtotime('+' . $dcRule->dc_valid_cycle . 'day')); //结束时间等于 当前时间 + 有效期时间 = 结束时间
            } else {
                $inData['adc_start_time'] = $dcRule->dc_start_time;
                $inData['adc_end_time'] = $dcRule->dc_end_time;
            }

            //添加操作
            $adc_id = $this->activitymodel->addActivityDiscountCodes($inData);
            if (!empty($adc_id) && $adc_id > 0) //判断是否成功
            {
                echo '1';
                exit;
            } else {
                echo '2';
                exit;
            }
        }
    }

    /*
     * 读取红包赠送记录
     * */
    public function indexRedbaggiftList($page = 1)
    {
        $this->L('activitymodel');
        $redbaggiftNum = $this->activitymodel->getRedaggiftNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $redbaggiftNum,
            'url' => base_url() . 'index.php/activityaction/indexRedbaggiftList/', //路径
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
        $redbaggiftHtml = $pageClass->data($pageArr);
        $redbaggirftList = $this->activitymodel->RedaggiftList($page, $perPage);

        //循环读取红包信息
        foreach ($redbaggirftList as $key => $value) {
            //根据红包读取
            $redbagrule = $this->activitymodel->getRedbagruleId($value->rbr_id);
            //判断红包规则是否存在
            if (!empty($redbagrule)) {
                //累加赋值
                $redbaggirftList[$key]->acti_title = $redbagrule->acti_title;
                $redbaggirftList[$key]->rbr_money = $redbagrule->rbr_money;
                $redbaggirftList[$key]->rbr_meet_money = $redbagrule->rbr_meet_money;
            }
        }
        $data = array(
            'redbaggiftHtml' => $redbaggiftHtml,
            'redbaggirftList' => $redbaggirftList,
        );
        $this->load->view('activity/redbaggiftlist', $data);
    }

    /*
   *删除赠送红包记录*/
    public function deleteRedaggift()
    {
        $this->L('activitymodel');
        $acti_redp_id = $this->input->get_post('id');
        //判断接受ID是否有值
        if (!empty($acti_redp_id)) {
            $boolRedbaggift = $this->activitymodel->deleteRedaggift($acti_redp_id);
            if ($boolRedbaggift) {
                msg('删除成功！', base_url('index.php/activityaction/indexRedbaggiftList/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('index.php/activityaction/indexRedbaggiftList/'), 2, 2000);
            }
        }
    }

    /*
     * 优惠码活动规则
     * */

    /*
    *读取优惠码列表
     * */
    public function indexDiscountCodeRuleList($page = 1)
    {
        $this->L('activitymodel');
        $discountcoderuleNum = $this->activitymodel->getDiscountCodeRuleNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $discountcoderuleNum,
            'url' => base_url() . 'index.php/activityaction/indexDiscountCodeRule/', //路径
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
        $discountcoderuleHtml = $pageClass->data($pageArr);
        $discountcoderuleList = $this->activitymodel->getDiscountCodeRuleList($page, $perPage);

        $data['discountcoderuleHtml'] = $discountcoderuleHtml;
        $data['discountcoderuleList'] = $discountcoderuleList;

        $this->load->view('activity/discountcoderulelist', $data);
    }

    /*
     *添加优惠码规则
     * */
    public function addDiscountCodeRule()
    {
        $this->L('activitymodel');
        $act = $this->input->post('act');
        $act = empty($act) ? '' : $act;

        //读取活动规则信息
        $activityshow = $this->activitymodel->getActivityShow(1);

        //判断是否执行添加方法
        if ($act == 'addDiscountCodeRule') {
            //判断是否有添加
            $dc_title = $this->input->get_post('dc_title');
            $dc_money = $this->input->get_post('dc_money');
            $dc_meet_money = $this->input->get_post('dc_meet_money');
            $sort = $this->input->get_post('sort');
            $is_show = $this->input->get_post('is_show');
            $dc_start_time = strtotime($this->input->get_post('dc_start_time'));
            $dc_end_time = strtotime($this->input->get_post('dc_end_time'));
            $dc_valid_cycle = $this->input->get_post('dc_valid_cycle');
            $inData = array(
                'dc_title' => $dc_title,
                'dc_money' => $dc_money,
                'dc_meet_money' => $dc_meet_money,
                'sort' => $sort,
                'is_show' => $is_show,
                'dc_start_time' => $dc_start_time,
                'dc_end_time' => $dc_end_time,
                'dc_valid_cycle' => $dc_valid_cycle,
                'add_time' => time(),
                'last_update' => time(),
            );


            //读取下拉框的值（id、title）
            $acti = $this->input->post('acti');
            if (!empty($acti)) { //判断下拉宽值不为空
                $acti = explode(',', $acti); //根据逗号截取
                if (!empty($acti) && count($acti) > 1) {
                    $inData['acti_id'] = $acti[0]; //活动ID
                    $inData['acti_title'] = $acti[1]; //活动名称
                }
            }

            $dc_id = $this->activitymodel->addDiscountCodeRule($inData);
            if (!empty($dc_id)) {
                msg('添加成功！', base_url('index.php/activityaction/editDiscountCodeRule/' . $dc_id), 2, 2000);
            } else {
                msg('添加失败！', base_url('index.php/activityaction/addDiscountCodeRule/'), 2, 2000);
            }
        }

        $data = array(
            'activityshow' => $activityshow,
        );

        $this->load->view('activity/adddiscountcoderule', $data);
    }

    /*
     * 修改优惠码规则列表
     * */
    public function editDiscountCodeRule($dc_id = '')
    {
        $this->L('activitymodel');
        $act = $this->input->get_post('act');
        $dc_id = empty($dc_id) ? '' : $dc_id;

        //读取活动规则信息
        $activityshow = $this->activitymodel->getActivityShow(1);

        //判断是否要修改
        if ($act == 'editDiscountCodeRule') {
            $dc_id = $this->input->post('dc_id');
            $dc_title = $this->input->get_post('dc_title');
            $dc_money = $this->input->get_post('dc_money');
            $dc_meet_money = $this->input->get_post('dc_meet_money');
            $sort = $this->input->get_post('sort');
            $is_show = $this->input->get_post('is_show');
            $dc_start_time = strtotime($this->input->get_post('dc_start_time'));
            $dc_end_time = strtotime($this->input->get_post('dc_end_time'));
            $dc_valid_cycle = $this->input->get_post('dc_valid_cycle');
            $inData = array(
                'dc_id' => $dc_id,
                'dc_title' => $dc_title,
                'dc_money' => $dc_money,
                'dc_meet_money' => $dc_meet_money,
                'sort' => $sort,
                'is_show' => $is_show,
                'dc_start_time' => $dc_start_time,
                'dc_end_time' => $dc_end_time,
                'dc_valid_cycle' => $dc_valid_cycle,
                'add_time' => time(),
                'last_update' => time(),
            );

            //读取下拉框的值（id、title）
            $acti = $this->input->post('acti');
            if (!empty($acti)) { //判断下拉宽值不为空
                $acti = explode(',', $acti); //根据逗号截取
                if (!empty($acti) && count($acti) > 1) {
                    $inData['acti_id'] = $acti[0]; //活动ID
                    $inData['acti_title'] = $acti[1]; //活动名称
                }
            }

            $dcrbool = $this->activitymodel->editDiscountCodeRule($inData);

            if ($dcrbool) {
                msg('修改成功！', base_url('index.php/activityaction/editDiscountCodeRule/' . $dc_id), 2, 2000);
            } else {
                msg('修改失败！', base_url('index.php/activityaction/editDiscountCodeRule/' . $dc_id), 2, 2000);
            }
        }

        //判断接受ID是否有值
        if (!empty($dc_id)) {
            $discountcoderule = $this->activitymodel->getDiscountCodeRuleId($dc_id);
        }

        $data = array(
            'discountcoderule' => empty($discountcoderule) ? array() : $discountcoderule,
            'act' => !empty($dc_id) ? 'edit' : 'add',
            'activityshow' => $activityshow,
        );

        $this->load->view('activity/adddiscountcoderule', $data);
    }

    /*
     * 删除优惠码规则*/
    public function deleteDiscountCodeRule()
    {
        $this->L('activitymodel');
        $rbr_id = $this->input->get_post('id');
        //判断接受ID是否有值
        if (!empty($rbr_id)) {
            $boolActiv = $this->activitymodel->deleteDiscountCodeRule($rbr_id);
            if ($boolActiv) {
                msg('删除成功！', base_url('index.php/activityaction/indexDiscountCodeRuleList/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('index.php/activityaction/indexDiscountCodeRuleList/'), 2, 2000);
            }
        }
    }

    /*
    * 读取优惠码赠送记录
    * */
    public function indexAdcList($page = 1)
    {
        $this->L('activitymodel');
        $adcNum = $this->activitymodel->getActivityDiscountCodesNum();
        //分页
        $perPage = 20;
        $pageArr = array(
            'page' => $page,
            'total' => $adcNum,
            'url' => base_url() . 'index.php/activityaction/indexAdcList/', //路径
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
        $adcHtml = $pageClass->data($pageArr);
        $adcList = $this->activitymodel->ActivityDiscountCodesList($page, $perPage);

        //循环读取优惠码信息
        foreach ($adcList as $key => $value) {
            //根据优惠码读取优惠码规则
            $dcr = $this->activitymodel->getDiscountCodeRuleId($value->dc_id);
            //判断优惠码规则是否存在
            if (!empty($dcr)) {
                //累加赋值
                $adcList[$key]->dc_title = $dcr->dc_title;
                $adcList[$key]->acti_title = $dcr->acti_title;
                $adcList[$key]->dc_money = $dcr->dc_money;
                $adcList[$key]->dc_meet_money = $dcr->dc_meet_money;
            }
        }
        $data = array(
            'adcHtml' => $adcHtml,
            'adcList' => $adcList,
        );
        $this->load->view('activity/activitydiscountcodeslist', $data);
    }

    /*
    *删除赠送优惠码记录*/
    public function deleteActivityDiscountCodes()
    {
        $this->L('activitymodel');
        $adc_id = $this->input->get_post('id');
        //判断接受ID是否有值
        if (!empty($adc_id)) {
            $booladct = $this->activitymodel->deleteActivityDiscountCodes($adc_id);
            if ($booladct) {
                msg('删除成功！', base_url('index.php/activityaction/indexAdcList/'), 2, 2000);
            } else {
                msg('删除失败！', base_url('index.php/activityaction/indexAdcList/'), 2, 2000);
            }
        }
    }
}