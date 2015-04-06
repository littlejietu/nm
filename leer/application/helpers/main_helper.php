<?php
/*公用函数库*/

/*发送邮件函数*/
function sendEmail($sendTo,$title,$content){
    $CI                     =& get_instance();
    $myConfig               = $CI->config->config;

    //发送邮件
    $config['protocol']     = 'smtp';
    $config['smtp_host']    = 'smtp.163.com'; //163服务器，之前用了qq服务器死活发不出去，不知道什么原因，可以自己探索  
    $config['smtp_user']    = $myConfig['myconfig']['email']['user_name']; //你的邮箱账号  
    $config['smtp_pass']    = $myConfig['myconfig']['email']['user_password']; //你的邮箱密码  
    $config['smtp_port']    = 25; //端口  
    $config['wordwrap']     = TRUE;
    $config['mailtype']     = 'html';
    $config['charset']      = 'utf-8';
    $config['priority']     = 1;
    $config['validate']     = TRUE;

    $CI->load->library('email');

    $CI->email->initialize($config);
    $CI->email->from($myConfig['myconfig']['email']['user_name'], $myConfig['myconfig']['email']['email_name']);//发件人  
    $CI->email->to($sendTo); //收件人  
    $CI->email->subject($title); //主题  
    $CI->email->message($content); //正文  

    if($CI->email->send()){
        return true;
    }else{
        return false;
    }

}



/**
 * 取得所要求信息的全部字段
 * @parm:
 *      $cid            分类ID
 *      $num            数量（array(startNum,endNum)支持分页读取--瀑布流）
 *      $id             需要排除的信息ID
 *      $rmd            是否必须推荐
 *      $pic            是否必须有图片
 *      $son            是否取子分类信息
 *      $order          排序方式
 *      $show           是否必须显示
 *      $selectField    要取的字段
 * @return:$list = array();
 * @autor:yc
 * @creattime:2015-01-25
 */
function getList($cid=0,$num=0,$id=0,$rmd=0,$pic=0,$son=0,$order=0,$show=1,$selectField="*"){
    if(is_numeric($cid)){
        $CI         =& get_instance();
        $list       = array();
        $where      = '';
        $where      .= ($show==0)?' 1=1':' `is_show`=1';//是否有显示字段
        $where      .= ($son==0)?(($cid==0)?'':' and art_class_id in('.$cid.')'):" and art_class_id in (".getChildClass($cid).")";//是否取子分类信息
        $where      .= ($id==0)?'':" and art_id!='".$id."'";//需要过滤的信息ID
        $where      .= ($rmd==0)?'':' and is_rmd>0';//是否推荐
        $where      .= ($pic==0)?'':" and art_img<>''";//是否有图片
        $where      .= ($order=='0')?' order by sort desc,add_time desc':'  order by '.$order.' desc,add_time desc';//是否按要求排序
        $where      .= (is_array($num))?('limit '.$num[0].' , '.$num[1]):(($num==0)?'':' limit 0,'.$num);//需要取多少条

        $sql        = "select ".$selectField." from `dis_article` where ".$where;
        $rel        = $CI->db->query($sql);
        $list       = $rel->result();
        return $list;
    }
}

/**
 * 提示并跳转
 * @param mixed
 *      $txt    提示信息
 *      $link   跳转地址
 *      $type   类型
 *              1----提示并点击跳转
 *              2----提示并在N秒后自动跳转
 *              3----仅提示信息，有按钮
 *              4----仅提示信息，无按钮，N秒后消失
 *      $tipsTime 自动跳转时间
 * @return null
 * @autor yc
 * @creattime 2014-06-18
 */
function msg($txt='', $link='', $type=2 , $tipsTime) {
    echo '<html><head><meta charset="utf-8">';
    echo '<link href="'.base_url().'resources/css/base.css" rel="stylesheet">';
    echo '<link href="'.base_url().'resources/css/common.css" rel="stylesheet">';
    echo '<script language="javascript" src="'.base_url().'resources/js/jquery-1.9.1.min.js"></script>';
    echo '<script language="javascript" src="'.base_url().'resources/js/common.js"></script>';
    echo '</head><body>';
    echo "<script language=\"JavaScript\">";
    switch($type){
        case 1://提示并点击跳转
            $paras = "{title:'提示信息',content:'".$txt."',buttons:{'确定'：'urlTips(".$link.")','取消':'closePop()'},url:'".$link."'}";
            echo "tipsPop(".$paras.");";
            break;
        case 2://提示并在N秒后自动跳转
            $paras = "{title:'提示信息',content:'".$txt."',time:'".$tipsTime."',url:'".$link."'}";
            echo "tipsPop(".$paras.");";
            break;
        case 3://仅提示信息，有按钮
            $paras = "{title:'提示信息',content:'".$txt."',buttons:{'确定'：'closePop()'}}";
            echo "tipsPop(".$paras.");";
            break;
        case 4://仅提示信息，无按钮，N秒后消失
            $paras = "{title:'提示信息',content:'".$txt."',time:'".$tipsTime."'}";
            echo "tipsPop(".$paras.");";
            break;

    }
    echo "</script>";
    echo '</body></html>';exit;
}

/*文件上传*/
function upload($str,$picName){
    $CI                         =& get_instance();
    $config['upload_path']      = './uploads/';
    $config['allowed_types']    = empty($str)?'gif|jpg|png':$str;
    $config['max_size']         = '2048';
    $config['max_width']        = '1024';
    $config['max_height']       = '768';

    $CI->load->library('upload');
    $fileUpload = new CI_Upload($config);

    if ( ! $fileUpload->do_upload($picName,time())){
        $data = array(
            'error' => $fileUpload->display_errors()
        );
        return $data;
    }else{
        $data = array(
            'upload_data' => $fileUpload->data()
        );
        return $data;
    }
}

/*OSS文件上传*/
function uploadOss($str,$pic){
    /*加载OSS ADK*/
    require_once BASEPATH.'../resources/oss/sdk.class.php';
    $oss_sdk_service = new ALIOSS();
    $oss_sdk_service->set_debug_mode(FALSE);

    $allowedTypes               = empty($str)?'gif|jpg|png':$str;
    $maxSize                    = '10240000';

    //图片过大
    if($pic['size'] > $maxSize){
        $data = array(
            'error' => '图片超过10M',
        );
        return $data;
    }

    //图片格式不允许
    $picNameArr                 = explode('.',$pic['name']);
    if(strpos($allowedTypes,end($picNameArr)) === False){
        $data = array(
            'error' => '图片格式不允许',
        );
        return $data;
    }

    /*重新生成md5文件名*/
    $file_name_arr = explode('.',$pic['name']);
    $last_name      = '.'.end($file_name_arr);
    $fileName = time().'_'.md5($pic['name']).$last_name;

    //上传到OSS
    $bucket = 'leer';
    $object = 'uploads/'.$fileName;
    $file_path = $pic['tmp_name'];
    $response = $oss_sdk_service->upload_file_by_file($bucket,$object,$file_path);


    $str = $response->header;
    $data = array(
        'upload_data' => $str['x-oss-request-url'],
    );
    return $data;

}

function uploadImg(){
    if (!empty($_FILES["preimg"]["name"])) { //提取文件域内容名称，并判断
        $path="uploads/"; //上传路径
    if(!file_exists($path))
    {
    //检查是否有该文件夹，如果没有就创建，并给予最高权限
        mkdir("$path", 0700);
    }//END IF
    //允许上传的文件格式
    $tp = array("image/gif","image/pjpeg","image/jpeg");
    //检查上传文件是否在允许上传的类型
    if(!in_array($_FILES["preimg"]["type"],$tp))
    {
        echo "<script>alert('格式不对');history.go(-1);</script>";
        exit;
    }//END IF
    $filetype = $_FILES['preimg']['type'];
    if($filetype == 'image/jpeg'){
        $type = '.jpg';
    }
    if ($filetype == 'image/jpg') {
        $type = '.jpg';
    }
    if ($filetype == 'image/pjpeg') {
        $type = '.jpg';
    }
    if($filetype == 'image/gif'){
        $type = '.gif';
    }
    if($_FILES["preimg"]["name"])
    {
        $today=date('YmdHis'); //获取时间并赋值给变量
        $file2 = $path.$today.$type; //图片的完整路径
        $img = $today.$type; //图片名称
        $flag=1;
    }//END IF
    if($flag) {
        $result=move_uploaded_file($_FILES["preimg"]["tmp_name"],$file2);
     return     $file2;
    }
    //特别注意这里传递给move_uploaded_file的第一个参数为上传到服务器上的临时文件
    }//END IF
    //这里再将$img的值写入到数据库中对应的字段
}
?>