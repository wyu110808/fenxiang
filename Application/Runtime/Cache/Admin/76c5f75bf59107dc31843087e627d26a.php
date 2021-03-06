<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="http://static.17zwd.com/static/sites/headFooter/css/florid17_headFooter.css?" />
	<link rel="stylesheet" type="text/css" href="/static/linkage/css/auto-sale-price.css"/>
	<title>模板编辑页</title>
</head>
<body>
	<div class="mask ie6fixedBR" style="display:none;"></div>
	<div class="common-header-container">
		<?php echo file_get_contents('http://fenxiang.vip.17zwd.com/top.do')?>
	</div>
	<div class="linkage-title">
		<div class="linkage-wrap">
			<div class="linkage-btn">
				<a class="need-help-lnk" href="javascript:;">帮助？</a>				
				<a class="linkage-shop-lnk" href="http://fenxiang.vip.17zwd.com/diylist.do">我的微商品</a>
			</div>
			模板编辑页
		</div>
	</div>
	<div class="linkage-main">
		<div class="linkage-form-container">
			<form method="post" action="http://fenxiang.vip.17zwd.com/diytemplate_edit.do" id="form-one" name="fenxiang">
				<div class="linkage-form-wrap">
					<div class="linkage-form-title">模板详情</div>
					<div class="linkage-form-body">
						<div class="linkage-table-2">
							<input type="hidden" name="uid" value="<?php echo ($uid); ?>"/>
							<div class="help-wrap-01">
									<div class="help-tip-wrap">
										<div class="help-tip-01"></div>
										<a class="help-next" href="javascript:;">下一步</a>
									</div>
									<div class="linkage-row">
										<div class="linkage-cell-label">销售价格：</div>
										<div class="linkage-cell">
											默认销售价格&nbsp;=&nbsp;拿货价&nbsp;X&nbsp;
											<input type="text" autocomplete="off" class="linkage-input-short" id="J_price-percent" name="profit" value="<?php echo ($info['profit']); ?>"/>
											%&nbsp;+&nbsp;
											<input type="text" autocomplete="off" class="linkage-input-short" id="J_price-integer" name="add_price" value="<?php echo ($info['add_price']); ?>"/>
											元(修正价)
										</div>
										<div class="linkage-cell-tip" id="J_price-tip"></div>
									</div>
							</div>
							<div class="help-wrap-02">
								<div class="help-tip-wrap">
									<div class="help-tip-02"></div>
									<a class="help-next" href="javascript:;">下一步</a>
								</div>		
								<div class="linkage-row">
									<div class="linkage-cell-label">标题前缀：</div>
									<div class="linkage-cell">
										<input class="linkage-input-large" type="text" autocomplete="off" placeholder="请输入前缀" id="J_title-prefix" name="title_before"  value="<?php echo ($info['title_before']); ?>"/>
									</div>
									<div class="linkage-cell-tip" id="J_title-prefix-tip"></div>
								</div>						
								<div class="linkage-row">
									<div class="linkage-cell-label">标题后缀：</div>
									<div class="linkage-cell">
										<input class="linkage-input-large" type="text" autocomplete="off" placeholder="请输入后缀" id="J_title-suffix" name="title_after" value="<?php echo ($info['title_after']); ?>"/>
									</div>
									<div class="linkage-cell-tip" id="J_title-suffix-tip"></div>
								</div>
							</div>
							<div class="help-wrap-03">
								<div class="help-tip-wrap">
									<div class="help-tip-03"></div>
									<a class="help-next" href="javascript:;">下一步</a>
								</div>
								<div class="linkage-row">
									<div class="linkage-cell-label">商品公告：</div>
									<div class="linkage-cell">
										<div class="linkage-editor">
											<script type="text/javascript" id="editor" name="content"></script>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="linkage-form-title">联系方式</div>
					<div class="linkage-form-body">
						<div class="help-wrap-04">
							<div class="help-tip-wrap">
								<div class="help-tip-04"></div>
								<a class="help-next" href="javascript:;">下一步</a>
							</div>


							<div class="linkage-table-4">
								<div class="linkage-row">
								<div class="linkage-cell-label">昵称：</div>
									<div class="linkage-cell">
										<input type="text" placeholder="请输入昵称" autocomplete="off" maxlength="15" id="J_Nickname" class="linkage-input-large" name="username" value="<?php echo ($userdata['name']); ?>"/>
									</div>
									<div class="linkage-cell-tip" id="J_Nickname-tip"></div>
								</div>
								<div class="linkage-row">
									<div class="linkage-cell-label">手机：</div>
									<div class="linkage-cell">
										<input type="text" placeholder="请输入手机" autocomplete="off" maxlength="11" id="J_Mobile" class="linkage-input-large" name="phone" value="<?php echo ($info['phone']); ?>"/>
									</div>
									<div class="linkage-cell-tip" id="J_Mobile-tip"></div>
								</div>
								<div class="linkage-row">
									<div class="linkage-cell-label">旺旺：</div>
									<div class="linkage-cell">
										<input type="text" placeholder="请输入旺旺" autocomplete="off" id="J_WW" class="linkage-input-large" name="wangwang" value="<?php echo ($info['wangwang']); ?>"/>
									</div>
									<div class="linkage-cell-tip" id="J_WW-tip"></div>
								</div>
								<div class="linkage-row">
									<div class="linkage-cell-label">微信：</div>
									<div class="linkage-cell">
										<input type="text" placeholder="请输入微信" autocomplete="off" id="J_WX" class="linkage-input-large" name="weichat" value="<?php echo ($info['weichat']); ?>"/>
									</div>
									<div class="linkage-cell-tip" id="J_WX-tip"></div>
								</div>
								<div class="linkage-row">
									<div class="linkage-cell-label">QQ：</div>
									<div class="linkage-cell">
										<input type="text" placeholder="请输入QQ" autocomplete="off" id="J_QQ" class="linkage-input-large" name="qq" value="<?php echo ($info['qq']); ?>"/>
									</div>
									<div class="linkage-cell-tip" id="J_QQ-tip"></div>
								</div>
							</div>
						</div>	
					</div>
					<div class="linkage-form-footer help-wrap-05">
						<div class="help-tip-wrap">
							<div class="help-tip-05"></div>
							<a class="help-finish" href="javascript:;">完成</a>
						</div>						
						<a class="linkage-form-back" href="javascript:;">返回</a>
						<a class="linkage-form-save" href="javascript:;"><?php if($first_view == 'n'): ?>保存<?php endif; if($first_view == 'y'): ?>设置<?php endif; ?></a>
					</div>
				</div>
			</form>
		</div>
		<div class="linkage-illustrates">
			<h2>自动设置销售价格说明：</h2>
			<p class="linkage-illustrate-paragraph">例如：拿货价格为30元,修正价为10元 ,<br/>修正价是指对最终价格的自定义改动 ,</p>		
			<ul class="linkage-illustrate-list">
				<li>计划按拿货价利润率为150% ,</li>
				<li>价格公式会这样计算：30 X 150% + 10 = 55元</li>				
			</ul>
			<br/>
			<h2>标题前后缀说明：</h2>
			<p class="linkage-illustrate-paragraph">前后缀请在此页面先设置好</p>
			<ul class="linkage-illustrate-list">
				<li>1.标题前缀会自动加载到编辑页的标题的前面</li>
				<li>2.标题后缀会自动加载到编辑页的标题的后面</li>
			</ul>
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
		var defaultNotice = '<?php echo ($info['content']); ?>';
	</script>
	<script type="text/javascript" charset="utf-8" src="/static/linkage/js/Common/ueditor/ueditor.config.js"></script>
	<script type="text/javascript" charset="utf-8" src="/static/linkage/js/Common/ueditor/ueditor.all.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="/static/linkage/js/Common/ueditor/lang/zh-cn/zh-cn.js"></script>
	
	<script src="http://static2.17zwd.com/sea-modules/seajs/seajs/2.0.0/sea.js"></script>
	<script>
		seajs.config({
			alias: {
				'$': 'jquery/jquery/1.10.1/jquery',
				'dialog': 'arale/dialog/1.2.4/dialog'
			}
		});
		seajs.use('/static/linkage/js/auto-sale-price');
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