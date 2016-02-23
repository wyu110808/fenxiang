<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="http://static.17zwd.com/static/sites/headFooter/css/florid17_headFooter.css?" />
	<link rel="stylesheet" type="text/css" href="/static/linkage/css/batch-update.css"/>
</head>
<body>
	<div class="mask ie6fixedBR" style="display:none;"></div>
	<div class="mask0 ie6fixedBR" style="display:none;">
		<div class="loading-animation">
			<img src="/static/linkage/img/loading.gif"/>
		</div>
	</div>
	<div class="common-header-container">
		<?php echo file_get_contents('http://fenxiang.vip.17zwd.com/top.do')?></div>
	<div class="product-title">
		<div class="product-wrap">
			<div class="product-btn">
				<a class="need-help-lnk" href="javascript:;">帮助？</a>
				<a class="templete-edit-lnk" href="http://fenxiang.vip.17zwd.com/diytemplate.do">编辑模版</a>
				<a class="product-shop-lnk" href="http://fenxiang.vip.17zwd.com/diylist.do">我的微商品</a>
			</div>
			商品列表
		</div>
	</div>
	<div class="product-main">
		<div class="product-list-title">
			<a class="btn-update" href="javascript:;">批量更新</a>
			商品列表
		</div>
		<div class="product-list-body">
			<div class="product-tip" id="update-tip" style="display:none;">
				<a class="tip-close" href="javascript:;"> <i class="iconfont">&#xe638;</i>
				</a>
				<span class="tip-notice"> <i class="iconfont">&#xe62a;</i>
					<span class="tip-wrap"></span>
				</span>
			</div>
			<form action="http://fenxiang.vip.17zwd.com/batch_update.do" id="form-one" method="post">
				<div class="share-opeartions-container">
					<div class="help-wrap">
						<div class="help-label"></div>
						<div class="help-btn-wrap">
							<a class="help-btn-01" href="javascript:;">下一步</a>
						</div>
					</div>
					<div class="share-checks-wrap">
						<span class="share-checkall-wrap">
							<span>
								<input type="checkbox" id="checkall" />
								<label for="checkall">全选</label>
							</span>
						</span>
					</div>
					<div class="share-opeartions-wrap">
						<span class="share-count">
							共
							<span class="share-highlight"><?php echo ($count); ?></span>
							个宝贝 <?php echo ($page_num); ?>/<?php echo ($page_all_num); ?>
						</span>
						<span class="share-option-wrap">
							<span>
								<input type="checkbox" id="title" name="select_field[]" value="title"/>
								<label for="title">标题</label>
							</span>
							<span>
								<input type="checkbox" id="price" name="select_field[]" value="price"/>
								<label for="price">价格</label>
							</span>
							<span>
								<input type="checkbox" id="mainpic" name="select_field[]" value="api_main_img"/>
								<label for="mainpic">主图</label>
							</span>
							<span>
								<input type="checkbox" id="detail" name="select_field[]" value="api_xiangqing_img"/>
								<label for="detail">详情</label>
							</span>
							<span>
								<input type="checkbox" id="contact" name="select_field[]" value="qq"/>
								<label for="contact">联系方式</label>
							</span>
							<span>
								<input type="checkbox" id="notice" name="select_field[]" value="content"/>
								<label for="notice">公告</label>
							</span>
						</span>
						<span class="share-pageoptions-wrap">
							<?php echo ($num_str); ?>
							<div class="share-pageoptions" style="display:none;">
								<div class="share-pageoption-single">
									<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=12" <?php if($limit==12){echo 'class="link-curr"';}?>>每页12个宝贝</a>
								</div>
								<div class="share-pageoption-single">
									<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=24" <?php if($limit==24){echo 'class="link-curr"';}?>>每页24个宝贝</a>
								</div>
								<div class="share-pageoption-single">
									<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=36" <?php if($limit==36){echo 'class="link-curr"';}?>>每页36个宝贝</a>
								</div>
								<div class="share-pageoption-single">
									<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=48" <?php if($limit==48){echo 'class="link-curr"';}?>>每页48个宝贝</a>
								</div>
								<div class="share-pageoption-single">
									<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=all" <?php if($limit==0){echo 'class="link-curr"';}?>>显示全部</a>
								</div>
								<div class="fix-border-bottom"></div>
							</div>
						</span>
					</div>
				</div>
				<div class="share-items-wrap">
					<div class="help-wrap">
						<div class="help-label"></div>
						<div class="help-btn-wrap">
							<a class="help-btn-02" href="javascript:;">下一步</a>
						</div>
					</div>
					<div class="share-item-imitate-fixflow">
						<div class="share-item-imitate-wrap">
							<div class="share-item-imitate-row-header">
								<div class="share-item-imitate-cell0"></div>
								<div class="share-item-imitate-cell1">图片</div>
								<div class="share-item-imitate-cell2">宝贝信息</div>
							</div>
							<div class="share-item-imitate-row-header">
								<div class="share-item-imitate-cell0"></div>
								<div class="share-item-imitate-cell1">图片</div>
								<div class="share-item-imitate-cell2">宝贝信息</div>
							</div>
							<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="share-item-imitate-row">
								<div class="share-item-imitate-cell0">
									<input type="checkbox" name="select_goods[]" value="<?php echo ($vo['gid']); ?>"/>
								</div>
								<div class="share-item-imitate-cell1">
									<div class="item-img-container">
										<div class="item-img-wrap">
											<a href="###"  title="<?php echo ($vo['title']); ?>">
												<img src="<?php echo ($vo['main_img']); ?>_60x60.jpg"/>
											</a>
										</div>
									</div>
								</div>
								<div class="share-item-imitate-cell2">
									<p class="share-item-title">
										<a href="<?php echo ($vo['url']); ?>" target="_blank" title="<?php echo ($vo['title']); ?>">
											<?php echo ($vo['title']); ?>
										</a>
									</p>
									<p class="share-item-price">
										<span class="share-item-highlight">¥ <?php echo ($vo['price']); ?></span>
										<span class="share-item-default">拿货价：¥<?php echo ($vo['origin_price']); ?></span>
										<span class="share-item-updatetime">更新时间：<?php echo (date('Y/m/d H:i:s',$vo['modified_time'])); ?></span>
									</p>
								</div>
							</div><?php endforeach; endif; else: echo "" ;endif; ?>
							
						</div>
					</div>
				</div>
			</form>
			<div class="share-menu-container">
				<div class="help-wrap">
					<div class="help-label"></div>
					<div class="help-btn-wrap">
						<a class="help-btn-finish" href="javascript:;">完成</a>
					</div>
				</div>
				<div class="share-paging-wrap">
					<div class="badoo-new">
						<?php echo ($page); ?>
						<?php if(!empty($page)): ?><span class="page-label">到第</span>
						<input class="page-input" autocomplete="off" type="text" maxlength="4" name="page"/>
						<span class="page-label">页</span>
						<a class="page-sure" href="javascript:;" skipUrl="http://fenxiang.vip.17zwd.com/batch.do?page=">确定</a><?php endif; ?>
					</div>
				</div>
				<div class="share-menu-show-wrap">
					<span class="share-count">
						共
						<span class="share-highlight"><?php echo ($count); ?></span>
						个宝贝
					</span>
					<span class="share-pageoptions-wrap">
						<?php echo ($num_str); ?>
						<div class="share-pageoptions" style="display:none;">
							<div class="share-pageoption-single">
								<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=12" <?php if($limit==12){echo 'class="link-curr"';}?>>每页12个宝贝</a>
							</div>
							<div class="share-pageoption-single">
								<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=24" <?php if($limit==24){echo 'class="link-curr"';}?>>每页24个宝贝</a>
							</div>
							<div class="share-pageoption-single">
								<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=36" <?php if($limit==36){echo 'class="link-curr"';}?>>每页36个宝贝</a>
							</div>
							<div class="share-pageoption-single">
								<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=48" <?php if($limit==48){echo 'class="link-curr"';}?>>每页48个宝贝</a>
							</div>
							<div class="share-pageoption-single">
								<a href="http://fenxiang.vip.17zwd.com/batch.do?limit=all" <?php if($limit==0){echo 'class="link-curr"';}?>>显示全部</a>
							</div>
							<div class="fix-border-bottom"></div>
						</div>
					</span>
				</div>
			</div>
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
		<?php echo file_get_contents("http://fenxiang.vip.17zwd.com/footer.do");?></div>
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
		seajs.use('/static/linkage/js/batch-update');
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