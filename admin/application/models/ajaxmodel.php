<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AjaxModel extends MY_Model {
    /**
     * 系统AJAX
    */
    /*修改左侧排序*/
    public function changeLeftSequence($sysId,$sysValue){
        $sqlInfo = array(
            'fields'    => array(
                'sequence'   => $sysValue,
            ),
            'table'     => 'system',
            'where'     => array(
                'sys_id  = "' . $sysId . '"',
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }

        $this->CoreUpdate();
    }

    /*删除左侧栏目*/
    public function delLeft($sysId){
        /*查询当前栏目的子栏目*/
        $sqlInfo = array(
            'fields'    => array(
                'sys_id',
            ),
            'table'     => 'system',
            'where'     => array(
                'sys_partid  = "' . $sysId . '"',
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreSelect();

        //如果有子栏目 递归
        if($this->isNotEmpty($list)){
            foreach($list as $v){
                $this->delLeft($v->sys_id);
            }
        }

        /*删除当前栏目*/
        $sqlInfo = array(
            'table' => 'system',
            'where' => array(
                'sys_id = "'. $sysId .'"',
            ),
        );
        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $this->CoreDelete();
    }

    /**
     *
     * 分类ajax
     *
    */
    /*删除分类*/
    public function deleteClass($id){
        $realId             = $this->getRealId($id);
        /*获得分类下所有的子分类*/
        $sqlInfo = array(
            'table'     => 'category',
            'where'     => array(
                'cat_real_id  like "' . $realId . '%"',
            ),
        );
        $this->CoreDelete($sqlInfo);
    }

    /*获得分类的真实ID*/
    public function getRealId($id){
        $sqlInfo = array(
            'fields'    => array(
                'cat_real_id',
            ),
            'table'     => 'category',
            'where'     => array(
                'cat_id  = "' . $id . '"',
            ),
        );
        $list = $this->CoreSelect($sqlInfo);
        return $list[0]->cat_real_id;
    }

    /*获得子分类的真实ID和sort*/
    public function getChildRealId($parRealId){
        $sqlInfo = array(
            'fields'    => array(
                'cat_id',
                'cat_real_id',
                'sort',
            ),
            'table'     => 'category',
            'where'     => array(
                'cat_real_id  like "' . $parRealId . '%"',
            ),
        );

        foreach($sqlInfo as $key => $value){
            $this->$key = $value;
        }
        $list = $this->CoreSelect();
        return $list;
    }

    /*子分类全部更新到数据库*/
    public function updateSort($object){
        $sqlInfo = array(
            'fields'    => array(
                'cat_real_id'   => $object->cat_real_id,
                'sort'          => $object->sort,
            ),
            'table'             => 'category',
            'where'             => array(
                'cat_id  = "' . $object->cat_id . '"',
            ),
        );

        $this->CoreUpdate($sqlInfo);
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */