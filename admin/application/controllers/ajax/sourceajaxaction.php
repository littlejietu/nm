<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class sourceAjaxAction extends MY_Controller {

    public function index($action)
    {
        switch($action){
            case 'brand':
                $this->brand();
                break;
            case 'supplier':
                $this->supplier();
                break;
            case 'channel':
                $this->channel();
                break;
            case 'express':
                $this->express();
                break;
            default:
                $this->brand();
        }
    }

    /**
     * 品牌管理
     */
    public function brand(){
        $act        = $this->input->post('act');
        $data       = array();
        $this->load->library('excelfactory/Excelfactory');
        $excelFactory = new Excelfactory();

        if($act=='upload'){
            //xls文件上传
            $upload = $excelFactory->__construct('upload','xls|xlsx');
            if($upload['upload_data']){
                /*文件上传成功,读取上传成功的excel*/
                $dataXls    = $excelFactory->__construct('read',$upload['upload_data']['full_path']);

                /*整合数组*/
                $valueArr   = array();
                foreach($dataXls as $key => $value){
                    if($key>1){
                        $valueArr['brand_name'][] = $value[1];
                    }
                }
                $exXlsArr   = array(
                    'tabName'   => 'brand',
                    'values'    => $valueArr,
                );

                /*存入数据库*/
                $insertList      = $excelFactory->__construct('ex',$exXlsArr);
                $data       = array(
                    'insertList' => $insertList,
                );
            }else{
                $data = array(
                    'error' => $upload['error'],
                );
            }
        }elseif($act=='add'){
            $brandName        = $this->input->post('brand_name');
            if(!empty($brandName)){
                $valueArr['brand_name'][0] = $brandName;
                $exXlsArr   = array(
                    'tabName'   => 'brand',
                    'values'    => $valueArr,
                );

                /*存入数据库*/
                $insertList = $excelFactory->__construct('ex',$exXlsArr);
                $data       = array(
                    'insertList' => $insertList,
                );
            }else{
                $data       = array(
                    'error' => '品牌名为空！',
                );
            }
        }

        $this->L('SourceModel');
        $sourceModel = new SourceModel();
        $data['brandList'] = $sourceModel->getBrandList();
        $this->load->view('source/brand',$data);
    }

    /**
     * 供应商管理
     */
    public function supplier(){
        $this->L('SourceModel');
        $sourceModel = new SourceModel();
        $data['supplierList'] = $sourceModel->getSupplierList();
        $this->load->view('source/supplier',$data);
    }

    /**
     * 渠道管理
     */
    public function channel(){
        $this->L('SourceModel');
        $sourceModel = new SourceModel();
        $data['channelList'] = $sourceModel->getChannelList();
        $this->load->view('source/channel',$data);
    }

    /**
     * 快递管理
     */
    public function express(){

        $this->L('SourceModel');
        $sourceModel = new SourceModel();
        $act        = $this->input->get_post('act');

        switch($act){
            case 'addExpress':
                $expressName        = $this->input->post('expressName');
                if(!empty($expressName)){
                    $insertId = $sourceModel->insertExpress($expressName);
                    $data['message'] = (is_numeric($insertId))? '增加成功！':$insertId;
                }else{
                    $data['message'] = '快递名为空！';
                }
                break;
            case 'getdate':
                $id        = $this->input->get_post('id');
                $costList   = $sourceModel->getExpressCostList($id);
                echo json_encode($costList);exit;
                return;
                break;
        }
        $data['expressList'] = $sourceModel->getExpressList();
        $this->load->view('source/express',$data);
    }

    /*ajax获得运费数据*/
    public function ajaxGetCostList(){
        $this->L('SourceModel');
        $sourceModel    = new SourceModel();
        $act            = $this->input->get_post('act');
        $id             = $this->input->get_post('id');
        switch($act){
            case 'getdate':
                $costList   = $sourceModel->getExpressCostList($id);
                echo json_encode($costList);
                return;
            default:
                echo json_decode('');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */