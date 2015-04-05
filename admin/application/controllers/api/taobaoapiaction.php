<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class taobaoapiAction extends MY_Controller {
    function __construct(){
        parent::__construct();
    }

	public function index(){
        require_once('./resources/backstage/tb_sdk/TopSdk.php');
        $myConfig               = $this->config->config;

//            $url = $_POST['url'];
//            $pattern = "/http:\/\/[\w]+.[\w]+.com\/item.htm\?.*?id=([\d]+).*?/";
//            preg_match($pattern, $url, $id);

        $secretKey = $myConfig['myconfig']['tb_api']['secretkey'];
        $appKey    = $myConfig['myconfig']['tb_api']['appkey'];
        if(!isset($this->session->userdata('is_back'))){
            $url                = 'https://oauth.taobao.com/authorize?response_type=token&client_id='.$appKey.'&redirect_uri='.base_url().'index.php/taobaosessionkeybackaction.php';
            header($url);
        }

        $c                  = new TopClient;
        $c->appkey          = $appKey;
        $c->secretKey       = $secretKey;
        $sessionKey         = $this->session->userdata('session_key');
        echo $secretKey;
        $c->format          = 'json';
        $req                = new TradeGetRequest;
        $req->setFields("seller_nick,buyer_nick,title,type,created,tid,seller_rate,buyer_rate,
status,payment,adjust_fee,post_fee,total_fee,pay_time,end_time,
modified,consign_time,buyer_obtain_point_fee,real_point_fee,
received_payment,commission_fee,pic_path,num_iid,num,price,cod_fee,
cod_status,shipping_type,receiver_name,receiver_state,receiver_city,
receiver_district,receiver_address,receiver_zip,receiver_mobile,
receiver_phone,orders.tid,orders.title,orders.pic_path,orders.price,
orders.num,orders.sku_id,orders.refund_status,orders.status,orders.oid,
orders.total_fee,orders.payment,orders.discount_fee,orders.adjust_fee,
orders.sku_properties_name,orders.item_meal_name,orders.buyer_rate,
orders.seller_rate,orders.outer_iid,orders.outer_sku_id,
orders.refund_id,orders.seller_type");
        $req->setTid('924478402794761');
        $resp = $c->execute($req);
        echo json_encode($resp,$sessionKey);
    }

}

/* End of file taobaoapiAction.php */
/* Location: ./application/controllers/api/tb/taobaoapiAction.php */