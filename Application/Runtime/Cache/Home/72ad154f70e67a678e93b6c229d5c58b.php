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
    <meta http-equiv="pragma" content="no-cache">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="expires" content="0">
    <meta name="author" content="银狐">
    <meta name="robots" content="all">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="stylesheet" href="/static/Home/css/product.css">
    <script src="/static/Home/js/fontSize.js"></script>
    <script>
        var pic = <?php echo ($json); ?>;
    </script>
</head>
<body>
<div id="wrap">
    <!-- 商品图片-->
    <section class="pro_img"><img src="<?php echo ($tb_img); ?>" alt=""></section>
    <!-- 商品标题-->
    <section class="sec text">
        <h3 class="pro_title"><?php echo ($info['title']); ?></h3>
        <strong class="pro_price">￥<?php echo ($info['price']); ?></strong>
    </section>
    <!-- 店铺信息-->
    <!-- <section class="sec text">
        <h2 class="shop_title"></h2>
        <p class="shop_address"><i class="address_icon"></i>广州-柏美-1FA102-B</p>
    </section> -->
    <!-- 店主信息 -->
    <section class="sec shop_owner_information">
        <h2 class="shop_owner_title">店主信息</h2>
        <div class="infoBox">
            <span class="info"><i class="phone_icon"></i><?php echo ($info['phone']); ?></span>
            <span class="info"><i class="wang_icon"></i><?php echo ($info['wangwang']); ?></span>
            <span class="info"><i class="qq_icon"></i><?php echo ($info['qq']); ?></span>
            <span class="info"><i class="wx_icon"></i><?php echo ($info['weichat']); ?></span>
        </div>
    </section>
    <!-- 店招公告-->
    <section class="sec shop_announcement"><h2 class="shop_announcement">店招公告</h2><?php echo ($info['content']); ?></section>
    
    <!--继续拖动，查看详情-->
    <section id="more" class="more">
        <p class="more_text">继续拖动，查看详情</p>
    </section>
    <!-- 详情 -->
    <section id="details" class="details">
        <div class="details_hide"></div>
    </section>
    <!-- 已下架 -->
    <?php if($info['status'] == 0): ?><div class="off">
        宝贝已下架
    </div><?php endif; ?>
</div>
<script src="/static/Home/js/jquery.js"></script>
<script src="/static/Home/js/touch.min.js"></script>
<script src="/static/Home/js/product.js"></script>
</body>
</html>