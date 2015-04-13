<?php
/*公用函数库*/

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
    echo '<html><head><meta charset="utf-8"><body>';
    echo '<link href="'.base_url().'resources/backstage/css/right.css" rel="stylesheet">';
    echo '<script language="javascript" src="'.base_url().'resources/backstage/js/jquery-1.8.0.min.js"></script>';
    echo '<script language="javascript" src="'.base_url().'resources/backstage/js/main.js"></script>';
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
    echo '</body></head></html>';exit;
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
    $theBasePath    = str_replace('system/','',BASEPATH);
    require_once $theBasePath.'resources/oss/sdk.class.php';

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
    if(strpos($allowedTypes,end($picNameArr)) === 'false'){
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
?>