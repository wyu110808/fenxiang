<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo ($info['title']); ?></title>
    <meta name="renderer" content="webkit">
    <meta name="viewport"
          content="width=device-width,user-scalable=no,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0">
    <!-- 是否启动webapp功能，会删除默认的苹果工具栏和菜单栏 -->
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <!-- 忽略页面中的数字识别为电话号码 -->
    <meta name="format-detection" content="telephone=no,email=no"/>
    <!-- uc强制竖屏 -->
    <meta name="screen-orientation" content="portrait">
    <!-- QQ强制竖屏 -->
    <meta name="x5-orientation" content="portrait">
   
    <meta name="author" content="银狐">
    <meta name="robots" content="all">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="/static/Home/css/swiper.min.css">
    <link rel="stylesheet" href="/static/Home/css/product.css?t=20160125">
    <script src="/static/Home/js/fontSize.js?t=20160114"></script>
    <script>
        var pic = <?php echo ($json); ?>;
        var str = '<?php echo ($str); ?>';
    </script>
</head>
<body>
<div id="wrap">
    <!-- 商品图片-->
    <section class="pro_img">
        <!-- Swiper -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
            <?php if(is_array($tb_img)): $i = 0; $__LIST__ = $tb_img;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">
                    <img src="<?php echo ($vo); ?>_320x320.jpg" alt="">
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
            <!-- 分页 -->
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <!-- 商品标题-->
    <section class="sec text">
        <h3 class="pro_title"><?php echo ($info['title']); ?></h3>
        <strong class="pro_price">￥<?php echo ($info['price']); ?></strong>
    </section>
     <!-- 用户头像、昵称-->
    <?php if(!empty($user_info)): ?><section class="sec avatar clearfix">
        <div class="avatar-img fl"><img src="<?php echo ($user_info['user_img']); ?>" alt=""></div>
        <span class="nick fl"><?php echo ($user_info['name']); ?></span>
    </section><?php endif; ?>
    <!-- 店主信息 -->
    <section class="sec shop_owner_information">
        <h2 class="shop_owner_title">店主信息</h2>
        <div class="infoBox">
            <?php if(!empty($info['phone'])): ?><span class="info"><i class="phone_icon"></i><a href="tel:<?php echo ($info['phone']); ?>"><?php echo ($info['phone']); ?></a></span><?php endif; ?>
            <?php if(!empty($info['wangwang'])): ?><span class="info"><i class="wang_icon"></i><em><?php echo ($info['wangwang']); ?></em></span><?php endif; ?>
            <?php if(!empty($info['qq'])): ?><span class="info"><i class="qq_icon"></i><em><?php echo ($info['qq']); ?></em></span><?php endif; ?>
            <?php if(!empty($info['weichat'])): ?><span class="info"><i class="wx_icon"></i><em><?php echo ($info['weichat']); ?></em></span><?php endif; ?>
        </div>
    </section>
    <!-- 店招公告-->
    <?php if(!empty($info['content'])): ?><section class="sec shop_announcement"><h2 class="shop_announcement">店招公告</h2><?php echo ($info['content']); ?></section><?php endif; ?>
    
    
    <!-- 宝贝详情 -->
    <?php if($info['status'] == 1): ?><h3 class="title">宝贝详情</h3>
    <div id="details" class="details">
        <!--浏览数-->
        <p class="browse">
            阅读<span class="browse_num"></span>
        </p>
        <!--广告-->
        <div class="ad">
            <h3 class="ad-title">推广</h3>
            <a href="javascript:">
                <img src="" alt="">
            </a>
        </div>
    </div>
    <?php else: ?>
    <!-- 已下架 -->
    <div class="off">
        宝贝已下架
    </div><?php endif; ?>
</div>
<script src="/static/Home/js/jquery.js"></script>
<script src="/static/Home/js/swiper.min.js"></script>
<script src="/static/Home/js/jquery.lazyload.js?v=1.9.1"></script>
<script src="/static/Home/js/product_s.js?v=1.0.6"></script>
<span style="display: none">
    <script>
        var _hmt = _hmt || [];
        (function () {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?cdb4a077a2e6221083922d763bdbfa18";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
</span>
</body>
</html>