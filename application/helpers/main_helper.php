<?php
/*公用函数库*/


function _get_userlogo_url($userlogo){

    return $userlogo? '/'.$userlogo : _get_cfg_path('images').'imghead.jpg';

}
?>