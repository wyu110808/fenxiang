<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="http://static.17zwd.com/static/sites/headFooter/css/florid17_headFooter.css?" />
	<link rel="stylesheet" type="text/css" href="/static/linkage/css/preview-to-mobile.css"/>
	<title><?php echo ($title); ?> - 编辑微商品</title>
</head>
<body>
	<div class="mask ie6fixedBR" style="display:none;"></div>
	<div class="common-header-container">
		<?php echo file_get_contents('http://fenxiang.vip.17zwd.com/top.do')?>
	</div>
	<div class="preview-title">
		<div class="preview-wrap">
			<div class="product-btn">
				<a class="need-help-lnk" href="javascript:;">帮助？</a>
				<a class="templete-edit-lnk" href="http://fenxiang.vip.17zwd.com/diytemplate.do">编辑模版</a>
				<a class="preview-shop-lnk" href="http://fenxiang.vip.17zwd.com/diylist.do">我的微商品</a>
			</div>
			编辑微商品
		</div>
	</div>
	<div class="preview-main">
		<div class="preview-form-container">
			<div class="preview-tip">
				<div class="preview-label">发布模版：设置一键上传发布模版，上传更便捷！</div>
				<div class="help-wrap-01">
					<div class="help-tip-wrap">
						<div class="help-tip-01"></div>
						<a class="help-next" href="javascript:;">下一步</a>
					</div>
					<a class="reclick-to" href="http://fenxiang.vip.17zwd.com/diytemplate.do">点击进入&gt;&gt;</a>
				</div>
			</div>
			<form method="post" action="http://fenxiang.vip.17zwd.com/diyshare_update.do" id="form-one" name="fenxiang">
				<input type="hidden" name="gid" value="<?php echo ($gid); ?>"/>
				<input type="hidden" name="zid" value="<?php echo ($zid); ?>"/>
				<input type="hidden" name="en_zid" value="<?php echo ($en_zid); ?>"/>
				<input type="hidden" name="origin_price" id="" value="<?php echo ($origin_price); ?>"/>

				<div class="help-wrap-02">
					<div class="help-tip-wrap">
						<div class="help-tip-02"></div>
						<a class="help-next" href="javascript:;">下一步</a>
					</div>
					<div class="preview-form-wrap">
						<div class="preview-form-title">宝贝基本信息</div>
						<div class="preview-form-body">
							<div class="preview-table-2">
								<div class="preview-row">
									<div class="preview-cell-label">主图：</div>
									<div class="preview-cell">
										<input type="hidden" id="mainPic" name="main_img" />
										<div class="preview-imgs-little">
											<div class="preview-imgs-wrap">
												<?php if(is_array($tb_img_arr)): $ko = 0; $__LIST__ = $tb_img_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($ko % 2 );++$ko;?><div class="preview-img-wrap <?php if(in_array($vo,$diff_arr)){ echo 'disabled';} ?>" originUrl="<?php echo ($vo); ?>">
													
														<i class="iconfont">&#xe631;</i>
													
														<a class="preview-img-link" href="javascript:;">
															<img src="<?php echo ($vo); ?>_60x60.jpg" />
														</a>
														<div class="preview-img-original-container" style="display:none;">
															<div class="preview-img-original-wrap">
																<div class="preview-img-top-arrow"></div>
																<div class="preview-img-original">
																	<img src="<?php echo ($vo); ?>_220x220.jpg"/>
																</div>
															</div>
														</div>
													</div><?php endforeach; endif; else: echo "" ;endif; ?>				
											</div>
										</div>
									</div>
									<div class="preview-cell-tip" id="O_MainPic-tip"></div>
								</div>
								<div class="preview-row">
									<div class="preview-cell-label">标题：</div>
									<div class="preview-cell">
										<input class="linkage-input-large" id="O_Tilte" type="text" placeholder="请输入标题" autocomplete="off" value="<?php echo ($title); ?>" name="title"/>
									</div>
									<div class="preview-cell-tip" id="O_Tilte-tip"></div>
								</div>
								<div class="preview-row">
									<div class="preview-cell-label">价格：</div>
									<div class="preview-cell">
										<input type="text" id="O_Price" placeholder="请输入价格" autocomplete="off" value="<?php echo ($price); ?>" name="price"/>
										<span class="label-middle">
											元&nbsp;拿货价：
											<span class="font-attention" id="price_took"><?php echo ($origin_price); ?></span>
											元 利润：
											<span class="font-attention" id="price_profits"><?php echo ($money); ?></span>
											元
										</span>
									</div>
									<div class="preview-cell-tip" id="O_Price-tip"></div>
								</div>
								<div class="preview-row">
									<div class="preview-cell-label">手机：</div>
									<div class="preview-cell">
										<input type="text" id="O_Mobile" maxlength="11" placeholder="请输入手机" autocomplete="off" value="<?php echo ($info['phone']); ?>" name="phone"/>
									</div>
									<div class="preview-cell-tip" id="O_Mobile-tip"></div>
								</div>
								<div class="preview-row">
									<div class="preview-cell-label">QQ：</div>
									<div class="preview-cell">
										<input type="text" id="O_QQ" placeholder="请输入QQ" autocomplete="off" value="<?php echo ($info['qq']); ?>" name="qq"/>
									</div>
									<div class="preview-cell-tip" id="O_QQ-tip"></div>
								</div>
								<div class="preview-row">
									<div class="preview-cell-label">旺旺：</div>
									<div class="preview-cell">
										<input type="text" id="O_WW" placeholder="请输入旺旺" autocomplete="off" value="<?php echo ($info['wangwang']); ?>" name="wangwang"/>
									</div>
									<div class="preview-cell-tip" id="O_WW-tip"></div>
								</div>
								<div class="preview-row">
									<div class="preview-cell-label">微信：</div>
									<div class="preview-cell">
										<input type="text" id="O_WX" placeholder="请输入微信" autocomplete="off" value="<?php echo ($info['weichat']); ?>" name="weichat"/>
									</div>
									<div class="preview-cell-tip" id="O_WX-tip"></div>
								</div>
								<div class="preview-row">
									<div class="preview-cell-label">公告：</div>
									<div class="preview-cell">
										<div class="preview-editor">
											<script type="text/javascript" id="editor" name="content"></script>
										</div>
									</div>
									<a name="detail"></a>
								</div>

								<div class="preview-row">
									<div class="preview-cell-label">详情：</div>
									<div class="preview-cell">
										<div class="preview-editDetail">
											<div class="preview-checkbox-wrap">
												<input type="checkbox" id="showDetail" />
												<label for="showDetail">是否编辑详情页</label>
												<span id="J_selectAll" style="display:none;"></span>
											</div>
											<input type="hidden" id="detailPic" name="xiangqing_img" value="" />
											<ul class="preview-checkbox-list" style="display:none;"></ul>
										</div>
									</div>
								</div>
							
							</div>
						</div>
						<div class="preview-form-footer">
							<div class="preview-form-footer-mask"></div>
							<a class="preview-form-back" href="http://fenxiang.vip.17zwd.com/diylist.do">返回我的列表</a>
							<div class="help-wrap-05">
								<div class="help-tip-wrap">
									<div class="help-tip-05"></div>
									<a class="help-finish" href="javascript:;">完成</a>
								</div>
								<a class="preview-form-publish" href="javascript:;" frequenturl="http://fenxiang.vip.17zwd.com/checkrate.do" codeurl="http://fenxiang.vip.17zwd.com/verify.do" verifyurl="http://fenxiang.vip.17zwd.com/checkverify.do"><?php if($first_view == 'y'): ?>发布<?php endif; if($first_view == 'n'): ?>保存<?php endif; ?></a>
							</div>
							<div class="help-wrap-03">
								<div class="help-tip-wrap">
									<div class="help-tip-03"></div>
									<a class="help-next" href="javascript:;">下一步</a>
								</div>
								<a class="preview-form-browser" href="javascript:;">预览手机版详情</a>


							</div>								
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="help-wrap-04">
			<div class="help-tip-wrap">
				<div class="help-tip-04"></div>
				<a class="help-next" href="javascript:;">下一步</a>
			</div>
			<div class="preview-mobile-wrap">
				<div class="preview-mobile-title">
					<div class="preview-mobile-title-toolbar">
						<div class="preview-mobile-title-tb-time" id="toolbar-time"></div>
					</div>
					<div class="preview-mobile-title-label">商品</div>
				</div>
				<div class="preview-mobile-contorl">
					<div class="preview-mobile-preview">
						<div class="preview-mobile-body">
							
							<div class="swiper-container">
								<div class="swiper-wrapper">
									<?php if(empty($sel_tb_img_arr)): if(is_array($tb_img_arr)): $i = 0; $__LIST__ = $tb_img_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">									
										<div class="swiper-mywrap">
											<img src="<?php echo ($vo); ?>_290x290.jpg"/>
										</div>										
									</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
									<?php if(!empty($sel_tb_img_arr)): if(is_array($sel_tb_img_arr)): $i = 0; $__LIST__ = $sel_tb_img_arr;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="swiper-slide">									
										<div class="swiper-mywrap">
											<img src="<?php echo ($vo); ?>_290x290.jpg"/>
										</div>										
									</div><?php endforeach; endif; else: echo "" ;endif; endif; ?>
								</div>
							</div>
							
							<div class="preview-mobile-bintro">
								<p class="preview-mobile-bwname" id="J_Title"></p>
								<p class="preview-mobile-bwprice">
									<span class="price-symbol">￥</span>
									<span class="price-money" id="J_Price"></span>
								</p>
							</div>
							<div class="preview-mobile-bavatar">
								<div class="avatar-img">
									<?php if(!empty($user_info)): ?><img src="<?php echo ($user_info['user_img']); ?>" alt="<?php echo ($user_info['name']); ?>" title="<?php echo ($user_info['name']); ?>" /><?php endif; ?>
									<?php if(empty($user_info)): ?><img src="/static/linkage/img/avatar.png" alt="头像" title="头像" /><?php endif; ?>
								</div>
								<span class="nick"><?php echo ($user_info['name']); ?></span>
							</div>
							<div class="preview-mobile-bcontact">
								<p class="preview-mobile-bcontact-tilte">店主信息</p>
								<ul class="preview-mobile-bcontact-list">
									<li> 
										<i class="phone_icon"></i>
										<span id="J_Mobile"></span>
									</li>
									<li> 
										<i class="wang_icon"></i>
										<span id="J_WW"></span>
									</li>
									<li>
										<i class="wx_icon"></i>
										<span id="J_WX"></span>
									</li>
									<li>
										<i class="qq_icon"></i>
										<span id="J_QQ"></span>
									</li>
								</ul>
							</div>
							<div class="preview-mobile-bnotice" style="none;">
								<div class="preview-mobile-bnotice-container" id="J_Notice"></div>
							</div>
							<div class="preview-mobile-bimage" id="J_Detail"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="display:none;">
		<div id="identifyingBox" class="identifying-dialog">
			<div class="identifying-dialog-title">验证码</div>
			<div class="identifying-dialog-content">
				<div class="identifying-dialog-txt">
					<div class="identifying-code-wrap">
						<div class="identifying-code-icon"></div>
						<div class="identifying-code-tip"></div>
						<input class="identifying-code-input" autocomplete="off" maxlength="4" type="text" />
					</div>
					<span class="identifying-code-img">
						<img src="//image.17zwd.com/img/grey-92-42.jpg" />
					</span>
					<span class="identifying-code-refresh"></span>
				</div>
				<div class="identifying-dialog-btn">
					<a class="identifying-dialog-btn-cancel" href="javascript:;">取消</a>
					<a class="identifying-dialog-btn-redirect" href="javascript:;">确定</a>
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
		var sel_json = <?php echo ($sel_json); ?>;
		var pic = <?php echo ($json); ?>;
	
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
                'dialog': 'arale/dialog/1.2.4/dialog',
                'swiper': '/static/linkage/js/Common/Swiper/js/swiper.jquery',
                'lazyload': '/static/linkage/js/jquery.lazyload'
            }
        });
        seajs.use('/static/linkage/js/preview-to-mobile');
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