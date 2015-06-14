<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>艺人管理-个人中心-牛模网</title>
<?php include_once(VIEWPATH."public/header_title.php");?>
<link href="<?php echo _get_cfg_path('css')?>base.css" type="text/css" rel="stylesheet" />
<link href="<?php echo _get_cfg_path('css')?>common.css" type="text/css" rel="stylesheet" />
<!--[if IE 6]>
<script src="<?php echo _get_cfg_path('js')?>DD_belatedPNG.js" type="text/javascript" ></script>
<script>DD_belatedPNG.fix('a,img');</script>
<![endif]-->
</head>
<body>
<?php include_once(VIEWPATH."public/header.php");?>
<div class="mainbody" id="mainbody">
    <div class="container mrgB30">
        <div class="member clearfix">
            <?php include_once(VIEWPATH."m/public/left_menu.php");?>
            <div class="fr uc_content">
            	<?php include_once(VIEWPATH."m/public/notice.php");?>
                <div class="clearfix uitopg">
                    <div class="transa">
                        <div class="aut_bti clearfix">
                          <h3 class="fl">艺人管理</h3>
              <a class="fr addto TX-win-open" href="javascript:;"><i></i>添加艺人</a>
                        </div>
                        <div class="works malbums mworks inst_arti">
                          <!--<div class="aut_bti mw_upload">摄影师</div>-->
                            <ul class="clearfix">
                                <?php foreach ($list['rows'] as $key => $a): ?>
                                <li>
                                    <a href="javascript:;">
                                        <img src="<?=base_url($a['showimg'])?>">
                                        <div class="mwk_hover">
                                          <p>
                                                <span class="mh_1 XT-modify" _val="<?=_get_key_val($a['id'])?>"></span>
                                                <span class="mh_2 XT-del" _val="<?=_get_key_val($a['id'])?>"></span>
                                            </p>
                                        </div>
                                    </a>
                                </li>
                              <?php endforeach;?>
                            </ul>
                            
                        </div>

                        <table cellpadding="0" cellspacing="0" bordercolor="#eee" border="0" width="100%">
                        <tr>
                                <td colspan="2" height="32" align="right">
                                    <div class="page">
                                      <?=$list['pages']?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <div class="help_bottom"></div>
    </div> 
</div>
<!--mainbody-->
<?php include_once(VIEWPATH."public/footer.php");?>
<div class="popover-mask"></div>
<div class="popover complaint addcust" style="display: none;">
    <div class="compl_top"><span class="fl">添加艺人</span><a href="javascript:;" onclick="closeWin(this)" title="关闭" class="close fr">×</a></div>
    <div class="poptab">
      <p><input class="but" name="" type="button" value="添加模特" onclick="window.location.href='##'"></p>
        <p><input class="but" name="" type="button" value="   添加摄影师" onclick="window.location.href='inst_profile.php'"></p>
        <p><input class="but" name="" type="button" value="   添加化妆师" onclick="window.location.href='inst_profile.php'"></p>
    </div>
</div>
</body>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>common.js"></script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>jquery.SuperSlide.2.1.1.js"></script>
<script>jQuery(".txtScroll-top").slide({titCell:".hd ul",mainCell:".bd ul",autoPage:true,effect:"topLoop",autoPlay:true});</script>
<script type="text/javascript" src="<?php echo _get_cfg_path('js')?>pages/m/model.js"></script>
</html>