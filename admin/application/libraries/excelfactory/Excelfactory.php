<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * excel上传、读取、存数据库封装
 * @parm
 *      $action:处理方式
 *      $str:传递过来的值
 * @autor:小鸟
 * @createtime:2014-07-07
 * @version:1.0
*/

class Excelfactory{


    private $fileType       = '';           //需要限制的上传文件的后缀
    private $upload         = '';           //上传成功后的excel路径
    private $values         = array();      //需要处理的表名、字段和值
    private $CI             = '';           //超级变量

    public function __construct($action='',$str='',$type='insert'){
        $this->CI = &get_instance();
        switch($action){
            case 'upload':
                $this->fileType     = $str;
                return $this->do_upload();
                break;
            case 'read':
                $this->upload       = $str;
                return $this->readExcel();
                break;
            case 'ex':
                $this->values       = $str;
                return $this->exExcel();
                break;
            case 'exGoods':
                $this->values       = $str;
                return $this->exGoods($type);
                break;
        };
        return false;
    }

    /* 导入品牌处理上传成功的excel*/
    public function exExcel(){
        $this->CI->load->model('libmodel/excelfacmodel');
        $status     = $this->CI->excelfacmodel->insert($this->values);
        return $status;
    }

    /* 导入商品处理上传成功的excel*/
    public function exGoods($type){
        $this->CI->load->model('libmodel/excelfacmodel');
        $status     = $this->CI->excelfacmodel->insertGoods($this->values,$this->CI->session->userdata['admin_id'],$type);
        return $status;
    }

    /*读取excel文件*/
    private  function readExcel(){
        $workbook = $this->upload;

        $this->CI->load->library('excelreader/Excelreader');
        $data = new Excelreader();

        $data->setOutputEncoding('utf-8');
        $data->read($workbook);
        return $data->sheets[0]['cells'];
    }

    /*文件上传*/
    private function do_upload()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = empty($this->fileType)?'gif|jpg|png|xls|xlsx':$this->fileType;
        $config['max_size'] = '2048';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        $this->CI->load->library('upload');
        $fileUpload = new CI_Upload($config);

        if ( ! $fileUpload->do_upload('userfile',time())){
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

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */