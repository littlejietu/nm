<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class categoryAjaxAction extends MY_Controller {

    public function index($action)
    {
        switch($action){
            case 'changeSort':
                $this->changeSort();
                break;
            default:
                $this->changeSort();
        }
    }

    /*删除分类*/
    public function deleteClass(){
        $id                 = $this->input->post('id');
        if(!empty($id)){
            $this->L('ajaxmodel');
            $this->ajaxmodel->deleteClass($id);
            echo 'true';
        }
    }

    /*改变分类排序*/
    public function changeSort(){
        $id                 = $this->input->post('id');
        $sort               = $this->input->post('sort');
        $sort               = empty($sort)?0:$sort;

        if(!empty($id)){
            $this->L('ajaxmodel');
            $realId             = $this->ajaxmodel->getRealId($id);

            /*取上级分类的realId*/
            $parRealId          = explode(',',$realId);
            array_pop($parRealId);
            $parRealId          = implode(',',$parRealId);

            /*取同级所有分类的realId和sort*/
            $eqRealIdArr        = $this->ajaxmodel->getChildRealId($parRealId);
            //去掉自身分类
            foreach($eqRealIdArr as $k => $v){
                if($v->cat_real_id == $parRealId){
                    unset($eqRealIdArr[$k]);
                }
            }
            foreach($eqRealIdArr as $k => $v){
                //去掉所有下级分类
                $realIdNum          = count(explode(',',$realId));
                if(count(explode(',',$v->cat_real_id)) > $realIdNum){
                    unset($eqRealIdArr[$k]);
                }
            }

            /*二维数组排序*/
            $tempArr            = array();
            foreach($eqRealIdArr as $v){
                if($v->cat_id == $id){
                    $tempArr[]          = $sort;
                }else{
                    $tempArr[]          = $v->sort;
                }
            }
            array_multisort($tempArr, SORT_DESC, $eqRealIdArr);

            /*重组排序过的分类realId，并更新数据库*/
            foreach($eqRealIdArr as $k => $v){
                /*重组排序过后的分类realId*/
                $realIdArr          = explode(',',$v->cat_real_id);
                array_pop($realIdArr);
                array_push($realIdArr,sprintf('%05.0f',($k+1)));

                /*取本分类和所有子分类*/
                $selfClass[$k]          = $this->ajaxmodel->getChildRealId($v->cat_real_id);
                foreach($selfClass[$k] as $key => $value){
                    //给要修改排序的分类赋排序值
                    if($value->cat_real_id == $realId){
                        $selfClass[$k][$key]->sort = $sort;
                    }
                }
                $classNum           = count($realIdArr);
                //重新组合所有分类的realId
                foreach($selfClass[$k] as $key => $value){
                    $classRealIdNow     = $value->cat_real_id;
                    $classRealIdNowArr  = explode(',',$classRealIdNow);
                    for($i = 0;$i < $classNum;$i++){
                        $classRealIdNowArr[$i]  = $realIdArr[$i];
                    }
                    $selfClass[$k][$key]->cat_real_id     = implode(',',$classRealIdNowArr);
                }
            }

            //存数据库
            foreach($selfClass as $value){
                foreach($value as $va){
                    $this->ajaxmodel->updateSort($va);
                }
            }
            echo 'OK';
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */