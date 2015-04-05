<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ExcelFacModel extends MY_Model {

    /*品牌存数据库*/
    public function insert($arr){
        if(is_array($arr)){
            $successList            = array();
            $isSetValues            = array();
            foreach($arr['values']['brand_name'] as $value){
                $sqlInfo = array(
                    'fields'    => array(
                        'brand_name'        => $value,
                        'add_time'          => time(),
                        'last_update'       => time(),

                    ),
                    'table'     => $arr['tabName'],
                );

                /*查询有没有重复信息*/
                $selectArr      = array(
                    'fields'    => array(
                        'brand_id',
                    ),
                    'table'     => $arr['tabName'],
                    'where'     => array(
                        'brand_name = "' . $sqlInfo['fields']['brand_name'] . '"',
                    ),
                );
                $selectList     = $this->CoreSelect($selectArr);

                /*存入数据库*/
                if(empty($selectList[0])){
                    $successList[] = $this->CoreInsert($sqlInfo);
                }else{
                    $isSetValues[] = $selectList[0]->brand_id;
                }
            }
            $insertList = array(
                'successList'   => $successList,
                'isSetValues'   => $isSetValues,
            );
            return $insertList;
        }else{
            return false;
        }
    }

    /*商品存数据库*/
    public function insertGoods($arr,$userId,$type='insert'){
        if(is_array($arr)){
            $successList            = array();
            $isSetValues            = array();
            foreach($arr['values']['goods_sn'] as $key => $value){
                switch($type){
                    case 'insert':
                        $goodsId                = $this->insertGoodsOrUpdate($arr,$key,$value,$userId);//存商品并获得商品ID
                        break;
                    default:
                        $goodsId                = $this->getGoodsId($value,$arr);//获得商品ID
                        break;
                }

                if(!empty($goodsId)){
                    switch($type){
                        case 'insert':
                            $this->insertGoodsSkuOrUpdate($goodsId,$arr,$key,$type);//存商品SKU
                            break;
                        default:
                            $this->updateInventroy($goodsId,$arr,$key);//更新商品库存
                            break;
                    }

                }
            }

            $insertGoodsList = array(
                'successList'   => $successList,
                'isSetValues'   => $isSetValues,
            );
            return $insertGoodsList;
        }else{
            return false;
        }
    }

    /*通过goods_sn 取得 goods_id*/
    private function getGoodsId($goods_sn,$arr){
        $selectArr      = array(
            'fields'    => array(
                'goods_id',
            ),
            'table'     => $arr['tabName'],
            'where'     => array(
                'goods_sn = "' . $goods_sn . '"',
            ),
        );
        $selectList                 = $this->CoreSelect($selectArr);
        return (empty($selectList[0]))?'':$selectList[0]->goods_id;
    }

    /*存商品或者更新商品*/
    private function insertGoodsOrUpdate($arr,$key,$value,$userId){
        /*存商品表*/
        $sqlInfo = array(
            'fields'    => array(
                'cat_id'            => $arr['values']['cat_id'][$key],
                'goods_sn'          => $value,
                'goods_name'        => $arr['values']['goods_name'][$key],
                'shop_price'        => 0,
                'discount'          => $arr['values']['discount'][$key],
                'is_on_sale'        => 1,
                'is_delete'         => 0,
                'brand_id'          => $arr['values']['brand_id'][$key],
                'channel_id'        => $userId,
                'goods_year'        => $arr['values']['pro_date'][$key],
                'goods_spring'      => $arr['values']['pro_spring'][$key],
                'goods_sex'         => $arr['values']['pro_sex'][$key],
                'add_time'          => time(),
                'last_update'       => time(),

            ),
            'table'     => $arr['tabName'],
        );

        /*查询有没有重复信息*/
        $selectArr      = array(
            'fields'    => array(
                'goods_id',
            ),
            'table'     => $arr['tabName'],
            'where'     => array(
                'goods_sn = "' . $value . '"',
            ),
        );
        $selectList                 = $this->CoreSelect($selectArr);

        /*存入数据库*/
        if(empty($selectList[0]->goods_id)){
            $goodsId                    = $this->CoreInsert($sqlInfo);
        }else{
            unset($sqlInfo['fields']['add_time']);
            $goodsId                    = $selectList[0]->goods_id;
            $sqlInfo['where']           = array('goods_sn = "' . $sqlInfo['fields']['goods_sn'] . '"');
            $this->CoreUpdate($sqlInfo);
        }
        return $goodsId;
    }

    /*存商品sku或者更新商品sku*/
    private function insertGoodsSkuOrUpdate($goodsId,$arr,$key,$type=''){
        //商品SKU_SQL
        $sqlSkuInfo = array(
            'fields'    => array(
                'goods_id'              => $goodsId,
                'sku_color_id'          => $arr['skuArr']['sku_color'][$key]['skuValueId'],
                'sku_size_id'           => $arr['skuArr']['sku_size'][$key]['skuValueId'],
                'sku_price'             => $arr['skuArr']['sku_price'][$key],
                'sku_number'            => $arr['skuArr']['sku_repertory'][$key],
                'add_time'              => time(),
                'last_update'           => time(),
            ),
            'table'     => $arr['skuTabName'],
        );

        /*查询有没有重复SKU*/
        $selectSkuArr      = array(
            'fields'    => array(
                'goods_sku_id',
            ),
            'table'     => $arr['skuTabName'],
            'where'     => array(
                'goods_id       = "' . $goodsId . '"',
                'sku_color_id   = "' . $arr['skuArr']['sku_color'][$key]['skuValueId'] . '"',
                'sku_size_id    = "' . $arr['skuArr']['sku_size'][$key]['skuValueId'] . '"'
            ),
        );
        $selectSkuList                 = $this->CoreSelect($selectSkuArr);

        /*存入数据库*/
        if(empty($selectSkuList[0])){
            /*插入新的SKU*/
            $skuInsertId                = $this->CoreInsert($sqlSkuInfo);
            $selectSkuList[]            = $skuInsertId;
            //SKU库存_SQL
            $sqlInventoryInfo   = array(
                'fields'    => array(
                    'goods_sku_id'          => $skuInsertId,
                    'inventory'             => $arr['skuArr']['sku_repertory'][$key],
                ),
                'table'     => $arr['skuInventoryName'],
            );
            $this->CoreInsert($sqlInventoryInfo);
        }else{
            /*更新sku*/
            $this->updateSku($sqlSkuInfo,$arr,$goodsId,$key);
            $isSetValues[]              = array(
                'goods_id'                  => $goodsId,
                'sku'                       => $selectSkuList[0]->goods_sku_id,
            );
        }

    }

    /*更新库存*/
    private function updateInventroy($goodsId,$arr,$key){

        //SKU库存_SQL
        $sqlInventoryInfo   = array(
            'fields'    => array(
                'sku_number'            => $arr['skuArr']['sku_repertory'][$key],
            ),
            'table'     => $arr['skuTabName'],
            'where'     => array(
                'goods_id       = "' . $goodsId . '"',
                'sku_color_id   = "' . $arr['skuArr']['sku_color'][$key] . '"',
                'sku_size_id    = "' . $arr['skuArr']['sku_size'][$key] . '"'
            ),
        );
        $this->CoreUpdate($sqlInventoryInfo);
    }

    /*更新sku*/
    private function updateSku($sqlSkuInfo,$arr,$goodsId,$key){
        unset($sqlSkuInfo['fields']['add_time']);
        $sqlSkuInfo['where']        = array(
            'goods_id       = "' . $goodsId . '"',
            'sku_color_id   = "' . $arr['skuArr']['sku_color'][$key]['skuValueId'] . '"',
            'sku_size_id    = "' . $arr['skuArr']['sku_size'][$key]['skuValueId'] . '"',
        );
        $this->CoreUpdate($sqlSkuInfo);
    }
}

/* End of file excelfacmodel.php */
/* Location: ./application/model/lib/excelfacmodel.php */