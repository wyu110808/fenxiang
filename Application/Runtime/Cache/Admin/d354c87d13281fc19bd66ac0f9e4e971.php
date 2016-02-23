<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="http://static.17zwd.com/static/sites/headFooter/css/florid17_headFooter.css?" />
	<link rel="stylesheet" type="text/css" href="/static/linkage/css/product-list.css"/>
	<title>我的微商品</title>
</head>
<body>
	<div class="mask ie6fixedBR" style="display:none;"></div>
	<div class="mask0 ie6fixedBR" style="display:none;">
		<div class="loading-animation">
			<img src="/static/linkage/img/loading.gif"/>
		</div>
	</div>
	<div class="common-header-container">
		<?php echo file_get_contents('http://fenxiang.vip.17zwd.com/top.do')?>
	</div>
	<div class="product-title">
		<div class="product-wrap">
			<div class="product-btn">
				<a class="need-help-lnk" href="javascript:;">帮助？</a>
				<a class="templete-edit-lnk" href="http://fenxiang.vip.17zwd.com/diytemplate.do">编辑模版</a>				
			</div>
			我的微商品
		</div>
	</div>
	<div class="product-main">
		<div class="product-list-title">
			<a class="btn-manage" href="http://fenxiang.vip.17zwd.com/batch.do">批量管理</a>
			<a class="btn-update" href="javascript:;" updatepath="http://fenxiang.vip.17zwd.com/all_update.do">宝贝更新</a> 
		我的微商品</div>
		<div class="product-list-body">
			<div class="product-tip" id="update-tip" style="display:none;">
				<a class="tip-close" href="javascript:;"> <i class="iconfont">&#xe638;</i></a>
				<span class="tip-notice"> <i class="iconfont">&#xe62a;</i>
					<span class="tip-wrap"></span>
				</span>
			</div>
			<div class="product-nav-wrap">
				<form action="http://fenxiang.vip.17zwd.com/diylist.do" method="post" id="form-one">
					<div class="product-nav-options">
						<span class="product-nav-label">排序：</span>
						<a class="link-default <?php if($color=='normal'){echo 'link-current';} ?>" href="http://fenxiang.vip.17zwd.com/diylist.do<?php echo ($status_str); echo ($keyword_str); ?>">默认<?php if($begin == 'y'): ?>排序<?php endif; ?></a>
						<span class="link-position <?php if($color=='date'){echo 'link-current';} ?>">
							<?php echo ($sel_date_ord); ?>
							<?php if($sel_date_ord == '按时间从高到低'): ?><i class="iconfont">&#xe615;</i><?php endif; ?>
							<?php if($sel_date_ord == '按时间从低到高'): ?><i class="iconfont">&#xe614;</i><?php endif; ?>
							<div class="dropdown-wrap" style="display:none;">
								<div class="dropdown-list">
									<div class="dropdown-single">
										<a href="http://fenxiang.vip.17zwd.com/diylist.do<?php echo ($status_str); ?>&date_ord=desc<?php echo ($keyword_str); ?>" title="按时间从高到低">按时间从高到低</a>
									</div>
									<div class="dropdown-single">
										<a href="http://fenxiang.vip.17zwd.com/diylist.do<?php echo ($status_str); ?>&date_ord=asc<?php echo ($keyword_str); ?>" title="按时间从低到高">按时间从低到高</a>
									</div>
								</div>
							</div>
						</span>
						<span class="link-position <?php if($color=='price'){echo 'link-current';} ?>">
							<?php echo ($sel_price_ord); ?>
							<?php if($sel_price_ord == '按价格从高到低'): ?><i class="iconfont">&#xe615;</i><?php endif; ?>
							<?php if($sel_price_ord == '按价格从低到高'): ?><i class="iconfont">&#xe614;</i><?php endif; ?>
							<div class="dropdown-wrap" style="display:none;">
								<div class="dropdown-list">
									<div class="dropdown-single">
										<a href="http://fenxiang.vip.17zwd.com/diylist.do<?php echo ($status_str); ?>&price_ord=desc<?php echo ($keyword_str); ?>" title="按价格从高到低">按价格从高到低</a>
									</div>
									<div class="dropdown-single">
										<a href="http://fenxiang.vip.17zwd.com/diylist.do<?php echo ($status_str); ?>&price_ord=asc<?php echo ($keyword_str); ?>" title="按价格从低到高">按价格从低到高</a>
									</div>
								</div>
							</div>
						</span>
						<span class="link-single">
							状态：							
							<input id="single_01" name="status" type="radio" value="2" <?php if($status==2){echo 'checked="checked"';}?>/>
							<label for="single_01">全部</label>
							<input id="single_02" name="status" type="radio" value="1" <?php if($status==1){echo 'checked="checked"';}?>/>
							<label for="single_02">上架</label>
							<input id="single_03" name="status" type="radio" value="0" <?php if($status==0){echo 'checked="checked"';}?>/>
							<label for="single_03">下架</label>
						</span>
					</div>
					<div class="product-nav-input-wrap">
						<input class="product-nav-input" type="text" placeholder="请输入关键字" autocomplete="off" name="keyword_val" value="<?php echo ($keyword); ?>"/>
						<button class="iconfont" type="submit">&#xe637;</button>
					</div>
					<div class="product-clear-sort-wrap">
						<a href="http://fenxiang.vip.17zwd.com/diylist.do?status=2">清除筛选</a>
					</div>
				</form>
			</div>
			<ul class="product-list">
				<li>
					<div class="product-list-table">
						<div class="product-list-row-title">
							<div class="product-list-cell0">图片</div>
							<div class="product-list-cell1">标题价格</div>
							<div class="product-list-cell2">二维码</div>
							<div class="product-list-cell3">更新时间</div>
							<div class="product-list-cell4">操作</div>
						</div>
					</div>
				</li>
				<li>
					<form action="http://fenxiang.vip.17zwd.com/del.do" method="post" id="form-two" saleUrl="http://fenxiang.vip.17zwd.com/shangjia.do">
					<div class="product-list-table">
						<?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($k % 2 );++$k;?><div class="product-list-row">
							<div class="product-list-cell0">
								<?php if($k == 1): ?><div class="help-wrap-01">
									<div class="help-tip-wrap">
										<div class="help-tip-01"></div>
										<a class="help-next" href="javascript:;">下一步</a>
									</div>
								</div><?php endif; ?>
								<div class="product-good-hover-container">
									<a class="product-good-image" href="javascript:;"jsonpath="http://fenxiang.vip.17zwd.com/jiekou?zid=<?php echo ($vo['zid']); ?>&gid=<?php echo ($vo['gid']); ?>">
										<img src="<?php echo ($vo['main_img']); ?>_60x60.jpg"/>
									</a>
									<div class="product-good-hover-wrap" style="display:none;">
										<div class="product-good-left-arrow"></div>
										<div class="product-good-right-container">
											<div class="loading-wrap">
												<img src="/static/linkage/img/Ajax_loading.gif"/>
											</div>
										</div>
									</div>
								</div>

							</div>
							<div class="product-list-cell1">
								<p class="product-good-paragraph">
									<a class="product-good-link" href="<?php echo ($vo['url']); ?>" title="<?php echo ($vo['title']); ?>" target="_blank"><?php echo ($vo['title']); ?></a>
								</p>
								<p class="product-good-price-correlation">
									<span class="product-good-price-special">￥<?php echo ($vo['price']); ?></span>
									<span class="product-good-price-default">
										<span class="product-good-price-label">拿货价：</span>
										<span class="product-good-price-value">￥<?php echo ($vo['origin_price']); ?></span>
									</span>
								</p>
							</div>
							<div class="product-list-cell2">
								<?php if($k == 1): ?><div class="help-wrap-02">
									<div class="help-tip-wrap">
										<div class="help-tip-02"></div>
										<a class="help-next" href="javascript:;">下一步</a>
									</div>
								</div><?php endif; ?>
								<div class="qrcode-wrap">
									<a class="qrcode-shortcut" href="javascript:;">
										<img class="qrcode-shortcut-img" src="/static/linkage/img/QrCode_Simple.png"/>
									</a>
									<div class="qrcode-detail-wrap">
										<div class="qrcode-detail">
											<div class="qrcode-detail-image">
												<img src="http://fenxiang.vip.17zwd.com/qrcode.do?id=<?php echo ($vo['en_id']); ?>" width="150"/>
											</div>
											<div class="qrcode-detail-label">扫一扫分享微信</div>
										</div>
									</div>
								</div>
							</div>
							<div class="product-list-cell3">
								<p class="product-publish-time"><?php echo (date('Y/m/d H:i:s',$vo['modified_time'])); ?></p>
								<?php if($vo['status'] == 0): ?><p class="product-no-sale-goods">(宝贝已下架)</p><?php endif; ?>
								<?php if($vo['status'] == 1): ?><p class="product-is-sale-goods">(宝贝上架中)</p><?php endif; ?>
							</div>
							<div class="product-list-cell4">
								<?php if($k == 1): ?><div class="help-wrap-03">
									<div class="help-tip-wrap">
										<div class="help-tip-03"></div>
										<a class="help-finish" href="javascript:;">完成</a>
									</div>
								</div><?php endif; ?>
								<a class="copy-short-link" href="javascript:;" short-link="<?php echo ($vo['url']); ?>">
									复制链接
									<div class="copy-short-link-tips" style="display:none;"></div>
								</a>
								<a class="edit-goods" href="http://fenxiang.vip.17zwd.com/diyshare.do?zdid=<?php echo ($vo['zid']); ?>&goods_id=<?php echo ($vo['gid']); ?>&id=<?php echo ($vo['en_id']); ?>">编辑</a>
								<a class="sale-goods" href="javascript:;"><?php if($vo['status'] == 0): ?>上架<?php endif; if($vo['status'] == 1): ?>下架<?php endif; ?></a>
								<a class="delete-goods" href="javascript:;">删除</a>
								<input class="good-id" type="hidden" name="id" value="<?php echo ($vo['en_id']); ?>" disabled="disabled" />
							</div>
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
						<div class="fix-last"></div>
					</div>
				</li>
			</ul>
		
		</div>
		<div class="product-list-page">
				<?php echo ($page); ?>			
		</div>
	</div>
	<div style="display:none;">
		<div id="confirmBox" class="confirm-dialog">
			<div class="confirm-dialog-title">提示</div>
			<div class="confirm-dialog-content">
				<div class="confirm-dialog-txt"></div>
				<div class="confirm-dialog-btn">
					<a class="confirm-dialog-btn-cancel" href="javascript:;">取消</a>
					<a class="confirm-dialog-btn-redirect" href="javascript:;">确定</a>
				</div>
			</div>
		</div>
	</div>
	<div style="display:none;">
		<div id="promptBox" class="prompt-dialog">
			<div class="prompt-dialog-title">提示</div>
			<div class="prompt-dialog-content">
				<div class="prompt-dialog-txt"></div>
				<div class="prompt-dialog-btn">
					<a class="prompt-dialog-btn-redirect" href="javascript:;">确定</a>
				</div>
			</div>
		</div>
	</div>
	<div class="common-footer-container">
		<?php echo file_get_contents("http://fenxiang.vip.17zwd.com/footer.do"); ?>
	</div>
	<script type="text/javascript">
		var do_res = '<?php echo ($do_res); ?>';
	</script>
	<script src="/static/linkage/js/Common/jquery-1.11.3.min.js"></script>
	<script src="/static/linkage/js/Common/ZeroClipboard/ZeroClipboard.min.js"></script>
	<script src="http://static2.17zwd.com/sea-modules/seajs/seajs/2.0.0/sea.js"></script>
	<script>
        seajs.config({
			alias: {
				'$': 'jquery/jquery/1.10.1/jquery',
				'dialog': 'arale/dialog/1.2.4/dialog'
			}
		});
		seajs.use('/static/linkage/js/product-list');
	</script>
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