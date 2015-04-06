<?php include_once('publish/head.php') ?>
<body style="background:#ececec;">
<!--header start-->
<?php include_once('publish/header.php') ?>
<!--header end-->
<div id="slideBox" class="banner">
    <div class="hd">
        <ul>
            <?php
            if (!empty($bannerertiser)) {
                foreach ($bannerertiser as $k => $v) {
                    ?>
                    <li></li>
                <?php
                }
            }
            ?>
        </ul>
    </div>
    <a class="prev" href="javascript:void(0)"></a>
    <a class="next" href="javascript:void(0)"></a>

    <div class="bd">
        <ul>
            <?php
            if (!empty($bannerertiser)) {
                foreach ($bannerertiser as $k => $v) {
                    ?>
                    <li><a href="<?php echo $v->adv_url ?>"><img src="<?php echo $v->adv_imgs ?>"/></a>
                    </li>
                <?php
                }
            }
            ?>
        </ul>
    </div>
</div>
<script type="text/javascript">
    jQuery("#slideBox").slide({mainCell: ".bd ul", effect: "leftLoop", autoPlay: true, interTime: 3000});
</script>
<div class="container prgB82">
<!--新品发布 start-->
<div class="shopNew">
    <div class="shopNew_top">
        <div class="shopNew_top_title fl">新品发布</div>
        <div class="shopNew_top_type fl">
            <a href="<?php echo base_url() ?>goodsaction/index/3">T恤</a>

            <div class="shopNew_top_line"></div>
            <a href="<?php echo base_url() ?>goodsaction/index/4">卡通食品</a>

            <div class="shopNew_top_line"></div>
            <a href="<?php echo base_url() ?>goodsaction/index/5">绒衫</a>

            <div class="shopNew_top_line"></div>
            <a href="<?php echo base_url() ?>goodsaction/index/6">移动电源</a>

            <div class="shopNew_top_line"></div>
            <a href="<?php echo base_url() ?>goodsaction/index/12">箱包</a>

            <div class="shopNew_top_line"></div>
            <a href="<?php echo base_url() ?>goodsaction/index/8">生活百货</a>

            <div class="shopNew_top_line"></div>
            <a href="#">艺术商品</a>
        </div>
        <a href="#" class="shopNew_top_more fr">更多&nbsp;&nbsp;&gt;</a>
    </div>
    <div class="shopNew_main clearfix">
        <?php
        if (!empty($newertiserone)) {
            foreach ($newertiserone as $k => $v) {
                ?>
                <a href="<?php echo $v->adv_url ?>"><img src="<?php echo $v->adv_imgs ?>"width="<?php echo $v->adv_spaces_width ?>"height="<?php echo $v->adv_spaces_height ?>"/></a>
            <?php
            }
        }
        ?>
        <?php
        if (!empty($newertisertwo)) {
            foreach ($newertisertwo as $k => $v) 
            {
                ?>
                <a href="<?php echo $v->adv_url ?>"><img src="<?php echo $v->adv_imgs ?>"width="<?php echo $v->adv_spaces_width ?>"height="<?php echo $v->adv_spaces_height ?>"/></a>
            <?php
            }
        }
        ?>
    </div>
</div>
<!--新品发布 end-->

<!--热卖推荐 start-->
<div class="shopHot">
    <div class="shopNew_top">
        <div class="shopNew_top_title fl">热卖推荐</div>
        <a href="#" class="shopNew_top_more fr">更多&nbsp;&nbsp;&gt;</a>
    </div>
    <div class="shopHot_main clearfix">
        <?php
        if (!empty($rmdGoods)) {
            foreach ($rmdGoods as $key => $value) {
                ?>
                <div class="shopHot_path">
                    <a href="<?php echo base_url('goodsaction/goodsDetail/' . $value->goods_id) ?>">
                        <div class="shopHot_img"><img src="<?php echo $value->goods_thumb ?>"/></div>
                        <div class="shopHot_title"><?php echo $value->goods_short_name ?></div>
                        <div class="shopHot_con"><span class="red15">￥</span><span
                                class="red19"><?php echo $value->shop_price_money ?></span>销售量：<span><?php echo $value->goods_sell_num ?></span>
                        </div>
                    </a>
                </div>
            <?php
            }
        } ?>
    </div>
</div>
<!--热卖推荐 end-->

<!--楼层T-恤 start-->
<div class="shopFloor">
    <div class="shopFloor_left fl">
        <div class="shopFloor_num"></div>
        <div class="shopFloor_left_main">
            <h1>推荐品牌</h1>
            <div class="shopFloor_brand">
                <div class="hd">
                    <a class="next"></a>
                    <ul></ul>
                    <a class="prev"></a>
                    <span class="pageState"></span>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <li>
                            <?php foreach ($brandAuthorizeList as $k => $v){ ?>
                            <a href="<?php echo base_url().'goodsaction/index/3/1/'.$v->brand_id.'/0/0-0-0-0/0-0-0-0'?>"><img src="<?php echo $v->brand_img ?>"/></a>
                            <?php if (($k + 1) == 4){ ?>
                        </li>
                        <li>
                            <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(".shopFloor_brand").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "left", vis: 1});
            </script>
        </div>
    </div>
    <?php
    if (!empty($ertiserfloor1)) {
        foreach ($ertiserfloor1 as $k => $v) {
            ?>
            <div class="shopFloor_banner fl"><a href="<?php echo $v->adv_url ?>"><img
                        src="<?php echo $v->adv_imgs ?>"/></a></div>
        <?php
        }
    }
    ?>
    <div class="shopFloor_right fl">
        <?php
        if (!empty($tshirtList)) {
            foreach ($tshirtList as $key => $value) {
                ?>
                <a href="<?php echo base_url('goodsaction/goodsDetail/' . $value->goods_id) ?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name ?></h1>

                        <h2><span class="red15">￥</span><span
                                class="red19"><?php echo $value->shop_price_money ?></span></h2>
                        <img src="<?php echo $value->goods_thumb ?>"/>
                    </div>
                </a>
            <?php
            }
        } ?>
    </div>
</div>
<!--楼层 end-->

<!--楼层POLO start-->
<div class="shopFloor">
    <div class="shopFloor_left fl">
        <div class="shopFloor_num shopFloor_num1"></div>
        <div class="shopFloor_left_main">
            <h1>推荐品牌</h1>

            <div class="shopFloor_brand">
                <div class="hd">
                    <a class="next"></a>
                    <ul></ul>
                    <a class="prev"></a>
                    <span class="pageState"></span>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <li>
                            <?php foreach ($brandAuthorizeList as $k => $v){ ?>
                            <a href="<?php echo base_url().'goodsaction/index/4/1/'.$v->brand_id.'/0/0-0-0-0/0-0-0-0'?>"><img src="<?php echo $v->brand_img ?>"/></a>
                            <?php if (($k + 1) == 4){ ?>
                        </li>
                        <li>
                            <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(".shopFloor_brand").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "left", vis: 1});
            </script>
        </div>
    </div>
    <?php
    if (!empty($ertiserfloor2)) {
        foreach ($ertiserfloor2 as $k => $v) {
            ?>
            <div class="shopFloor_banner fl"><a href="<?php echo $v->adv_url ?>"><img
                        src="<?php echo $v->adv_imgs ?>"/></a></div>
        <?php
        }
    }
    ?>
    <div class="shopFloor_right fl">
        <?php
        if (!empty($polpList)) {
            foreach ($polpList as $key => $value) {
                ?>
                <a href="<?php echo base_url('goodsaction/goodsDetail/' . $value->goods_id) ?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name ?></h1>

                        <h2><span class="red15">￥</span><span
                                class="red19"><?php echo $value->shop_price_money ?></span></h2>
                        <img src="<?php echo $value->goods_thumb ?>"/>
                    </div>
                </a>
            <?php
            }
        } ?>
    </div>
</div>
<!--楼层 end-->

<!--楼层冒衫 start-->
<div class="shopFloor">
    <div class="shopFloor_left fl">
        <div class="shopFloor_num shopFloor_num2"></div>
        <div class="shopFloor_left_main">
            <h1>推荐品牌</h1>

            <div class="shopFloor_brand">
                <div class="hd">
                    <a class="next"></a>
                    <ul></ul>
                    <a class="prev"></a>
                    <span class="pageState"></span>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <li>
                            <?php foreach ($brandAuthorizeList as $k => $v){ ?>
                            <a href="<?php echo base_url().'goodsaction/index/5/1/'.$v->brand_id.'/0/0-0-0-0/0-0-0-0'?>"><img src="<?php echo $v->brand_img ?>"/></a>
                            <?php if (($k + 1) == 4){ ?>
                        </li>
                        <li>
                            <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(".shopFloor_brand").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "left", vis: 1});
            </script>
        </div>
    </div>
    <?php
    if (!empty($ertiserfloor3)) {
        foreach ($ertiserfloor3 as $k => $v) {
            ?>
            <div class="shopFloor_banner fl"><a href="<?php echo $v->adv_url ?>"><img src="<?php echo $v->adv_imgs ?>"/></a></div>
        <?php
        }
    }
    ?>
    <div class="shopFloor_right fl">
        <?php
        if (!empty($fleeceList)) {
            foreach ($fleeceList as $key => $value) {
                ?>
                <a href="<?php echo base_url('goodsaction/goodsDetail/' . $value->goods_id) ?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name ?></h1>

                        <h2><span class="red15">￥</span><span
                                class="red19"><?php echo $value->shop_price_money ?></span></h2>
                        <img src="<?php echo $value->goods_thumb ?>"/>
                    </div>
                </a>
            <?php
            }
        } ?>
    </div>
</div>
<!--楼层 end-->

<!--楼层移动电源 start-->
<div class="shopFloor">
    <div class="shopFloor_left fl">
        <div class="shopFloor_num shopFloor_num3"></div>
        <div class="shopFloor_left_main">
            <h1>推荐品牌</h1>
            <div class="shopFloor_brand">
                <div class="hd">
                    <a class="next"></a>
                    <ul></ul>
                    <a class="prev"></a>
                    <span class="pageState"></span>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <li>
                            <?php foreach ($brandAuthorizeList as $k => $v){ ?>
                            <a href="<?php echo base_url().'goodsaction/index/6/1/'.$v->brand_id.'/0/0-0-0-0/0-0-0-0'?>"><img src="<?php echo $v->brand_img ?>"/></a>
                            <?php if (($k + 1) == 4){ ?>
                        </li>
                        <li>
                            <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(".shopFloor_brand").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "left", vis: 1});
            </script>
        </div>
    </div>
    <?php
    if (!empty($ertiserfloor4)) {
        foreach ($ertiserfloor4 as $k => $v) {
            ?>
            <div class="shopFloor_banner fl"><a href="<?php echo $v->adv_url ?>"><img src="<?php echo $v->adv_imgs ?>"/></a></div>
        <?php
        }
    }
    ?>
    <div class="shopFloor_right fl">
        <?php
        if (!empty($mobileList)) {
            foreach ($mobileList as $key => $value) {
                ?>
                <a href="<?php echo base_url('goodsaction/goodsDetail/' . $value->goods_id) ?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name ?></h1>

                        <h2><span class="red15">￥</span><span
                                class="red19"><?php echo $value->shop_price_money ?></span></h2>
                        <img src="<?php echo $value->goods_thumb ?>"/>
                    </div>
                </a>
            <?php
            }
        } ?>
    </div>
</div>
<!--楼层 end-->

<!--楼层布袋 start-->
<div class="shopFloor">
    <div class="shopFloor_left fl">
        <div class="shopFloor_num shopFloor_num4"></div>
        <div class="shopFloor_left_main">
            <h1>推荐品牌</h1>
            <div class="shopFloor_brand">
                <div class="hd">
                    <a class="next"></a>
                    <ul></ul>
                    <a class="prev"></a>
                    <span class="pageState"></span>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <li>
                            <?php foreach ($brandAuthorizeList as $k => $v){ ?>
                            <a href="<?php echo base_url().'goodsaction/index/12/1/'.$v->brand_id.'/0/0-0-0-0/0-0-0-0'?>"><img src="<?php echo $v->brand_img ?>"/></a>
                            <?php if (($k + 1) == 4){ ?>
                        </li>
                        <li>
                            <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(".shopFloor_brand").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "left", vis: 1});
            </script>
        </div>
    </div>
    <?php
    if (!empty($ertiserfloor5)) {
        foreach ($ertiserfloor5 as $k => $v) {
            ?>
            <div class="shopFloor_banner fl"><a href="<?php echo $v->adv_url ?>"><img src="<?php echo $v->adv_imgs ?>"/></a></div>
        <?php
        }
    }
    ?>
    <div class="shopFloor_right fl">
        <?php
        if (!empty($bagList)) {
            foreach ($bagList as $key => $value) {
                ?>
                <a href="<?php echo base_url('goodsaction/goodsDetail/' . $value->goods_id) ?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name ?></h1>

                        <h2><span class="red15">￥</span><span
                                class="red19"><?php echo $value->shop_price_money ?></span></h2>
                        <img src="<?php echo $value->goods_thumb ?>"/>
                    </div>
                </a>
            <?php
            }
        } ?>
    </div>
</div>
<!--楼层 end-->

<!--楼层生活百货 start-->
<div class="shopFloor">
    <div class="shopFloor_left fl">
        <div class="shopFloor_num shopFloor_num5"></div>
        <div class="shopFloor_left_main">
            <h1>推荐品牌</h1>

            <div class="shopFloor_brand">
                <div class="hd">
                    <a class="next"></a>
                    <ul></ul>
                    <a class="prev"></a>
                    <span class="pageState"></span>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <li>
                            <?php foreach ($brandAuthorizeList as $k => $v){ ?>
                            <a href="<?php echo base_url().'goodsaction/index/8/1/'.$v->brand_id.'/0/0-0-0-0/0-0-0-0'?>"><img src="<?php echo $v->brand_img ?>"/></a>
                            <?php if (($k + 1) == 4){ ?>
                        </li>
                        <li>
                            <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(".shopFloor_brand").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "left", vis: 1});
            </script>
        </div>
    </div>
    <?php
    if (!empty($ertiserfloor6)) {
        foreach ($ertiserfloor6 as $k => $v) {
            ?>
            <div class="shopFloor_banner fl"><a href="<?php echo $v->adv_url ?>"><img src="<?php echo $v->adv_imgs ?>"/></a></div>
        <?php
        }
    }
    ?>
    <div class="shopFloor_right fl">
        <?php
        if (!empty($livingList)) {

            foreach ($livingList as $key => $value) {
                ?>
                <a href="<?php echo base_url('goodsaction/goodsDetail/' . $value->goods_id) ?>">
                    <div class="shopFloor_move">
                        <h1><?php echo $value->goods_short_name ?></h1>
                        <h2><span class="red15">￥</span><span
                                class="red19"><?php echo $value->shop_price_money ?></span></h2>
                        <img src="<?php echo $value->goods_thumb ?>"/>
                    </div>
                </a>
            <?php
            }
        } ?>
    </div>
</div>
<!--楼层 end-->

<!--艺术品 start-->
<div class="shopFloor">
    <div class="shopFloor_left fl">
        <div class="shopFloor_num shopFloor_num6"></div>
        <div class="shopFloor_left_main">
            <h1>推荐品牌</h1>
            <div class="shopFloor_brand">
                <div class="hd">
                    <a class="next"></a>
                    <ul></ul>
                    <a class="prev"></a>
                    <span class="pageState"></span>
                </div>
                <div class="bd">
                    <ul class="picList">
                        <li>
                            <?php foreach ($brandAuthorizeList as $k => $v){ ?>
                            <a href="<?php echo base_url().'goodsaction/index/1/1/'.$v->brand_id.'/0/0-0-0-0/0-0-0-0'?>"><img src="<?php echo $v->brand_img ?>"/></a>
                            <?php if (($k + 1) == 4){ ?>
                        </li>
                        <li>
                            <?php
                            }
                            ?>
                            <?php
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>

            <script type="text/javascript">
                jQuery(".shopFloor_brand").slide({titCell: ".hd ul", mainCell: ".bd ul", autoPage: true, effect: "left", vis: 1});
            </script>
        </div>
    </div>

    <div class="shopFloor_banner fl"><a href="#"><img src="<?php echo base_url() ?>resources/img/f7-banner.jpg"/></a>
    </div>

    <div class="shopFloor_right fl">
        <a href="#">
            <div class="shopFloor_move">
                <h1>野菊花 油画</h1>

                <h2><span class="red15">￥</span><span class="red19">9999</span></h2>
                <img src="<?php echo base_url() ?>resources/img/f7-1.jpg"/>
            </div>
        </a>

        <a href="#">
            <div class="shopFloor_move">
                <h1>女童与提篮 彩墨</h1>

                <h2><span class="red15">￥</span><span class="red19">9999</span></h2>
                <img src="<?php echo base_url() ?>resources/img/f7-2.jpg"/>
            </div>
        </a>

        <a href="#">
            <div class="shopFloor_move">
                <h1>盆花 彩墨</h1>

                <h2><span class="red15">￥</span><span class="red19">9999</span></h2>
                <img src="<?php echo base_url() ?>resources/img/f7-3.jpg"/>
            </div>
        </a>

        <a href="#">
            <div class="shopFloor_move">
                <h1>三人扇舞 彩墨</h1>

                <h2><span class="red15">￥</span><span class="red19">9999</span></h2>
                <img src="<?php echo base_url() ?>resources/img/f7-4.jpg"/>
            </div>
        </a>

        <a href="#">
            <div class="shopFloor_move">
                <h1>双人扇舞 油画</h1>

                <h2><span class="red15">￥</span><span class="red19">9999</span></h2>
                <img src="<?php echo base_url() ?>resources/img/f7-5.jpg"/>
            </div>
        </a>

        <a href="#">
            <div class="shopFloor_move">
                <h1>玩牌女子 彩墨</h1>

                <h2><span class="red15">￥</span><span class="red19">9999</span></h2>
                <img src="<?php echo base_url() ?>resources/img/f7-6.jpg"/>
            </div>
        </a>


    </div>
</div>
<!--楼层 end-->
</div>

<!--footer start-->
<?php include_once('publish/footer.php') ?>
<!--footer end-->


</body>
</html>