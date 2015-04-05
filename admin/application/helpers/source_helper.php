<?php
/*公用函数库*/

/*根据分类ID 取子分类集合*/
function getChildClass($classId){
    $CI                 =& get_instance();
    $CI->L('libmodel/sourcehelmodel');
    $classInfo          = getClassInfo($classId);
    $childClass         = $CI->sourcehelmodel->getChildClassModel($classInfo->cat_real_id);
    $childStr           = $classId;
    foreach($childClass as $key => $value){
        $childStr           .= ','.$value->cat_id;
    }
    return $childStr;
}

/*根据分类ID 取得分类详情*/
function getClassInfo($classId){
    $CI                 =& get_instance();
    $CI->L('libmodel/sourcehelmodel');
    $classInfo          = $CI->sourcehelmodel->getClassInfoModel($classId);

    return !empty($classInfo)?$classInfo[0]:$classInfo;
}

/*根据品牌ID 取得品牌详情*/
function getBrandInfo($classId){
    $CI                 =& get_instance();
    $CI->L('libmodel/sourcehelmodel');
    $brandInfo          = $CI->sourcehelmodel->getBrandInfoModel($classId);

    return !empty($brandInfo)?$brandInfo[0]:$brandInfo;
}

/*根据渠道ID 取得渠道详情*/
function getChannelInfo($classId){
    $CI                 =& get_instance();
    $CI->L('libmodel/sourcehelmodel');
    $channelInfo        = $CI->sourcehelmodel->getChannelInfoModel($classId);

    return !empty($channelInfo)?$channelInfo[0]:$channelInfo;
}

/*组合分类的真实ID*/
function getRealId($partId){

    $CI                 =& get_instance();
    $CI->L('categorymodel');

    /*组合当前分类的真实ID*/
    if($partId == '0'){//添加一级分类
        $categoryList       = $CI->categorymodel->bigistRealId();
        if(empty($categoryList)){
            $classRealId        = '00001';
        }else{
            $classRealId        = sprintf('%05.0f',($categoryList->cat_real_id+1));
        }
    }else{
        $categoryList       = $CI->categorymodel->bigistRealId($partId);//获得该分类下最后一个子分类

        $realIdArr          = explode(',',$categoryList->cat_real_id);
        $realIdNum          = count($realIdArr);
        $classRealId        = '';
        foreach($realIdArr as $k => $v){
            $classRealId        .= sprintf('%05.0f',($v)).',';
            if($classRealId == ($partId.',')){
                if($k == ($realIdNum-1)){//如果是最后一个值
                    $classRealId        .= '00001';
                }else{
                    $classRealId        .= sprintf('%05.0f',($realIdArr[($k+1)]+1));
                }
                break;
            }
        }
    }

    if(empty($partId) && $partId!='0'){
        $classRealId        = false;
    }
    return $classRealId;
}

?>