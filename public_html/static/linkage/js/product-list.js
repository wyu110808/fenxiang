define(function(require, exports, module) {
	var $ = require('$');
	var Dialog = require('dialog');

	var confirmDialog = new Dialog({
		classPrefix: 'confirmBox-dialog',
		align: {
			selfXY: ['50%', '50%']
		},
		width: '380px',
		content: '#confirmBox'
	});

	var promptDialog = new Dialog({
		classPrefix: 'promptBox-dialog',
		align: {
			selfXY: ['50%', '50%']
		},
		width: '380px',
		content: '#promptBox'
	});

	$('.confirm-dialog-btn-cancel').click(function() {
		confirmDialog.hide();
		$('.good-id').attr('disabled', 'disabled');
	});

	function remainTxt(text) {
		$('.confirm-dialog-txt').text(text);
		confirmDialog.show();
	}

	function promptText(text) {
		$('.prompt-dialog-txt').text(text);
		confirmDialog.hide();
		promptDialog.show();
	}

	$('.delete-goods').click(function() {
		remainTxt('删除后不可恢复, 您确定吗？');
		$(this).siblings('.good-id').removeAttr('disabled');
	});

	var redirectPath = '';
	var redirectFlag = false;

	function syncForm(url, form) {
		$.post(url, form.serialize(), function(data) {
			redirectFlag = true;
			redirectPath = data.do_url;
			promptText(data.do_text);
		}, 'json').fail(function() {
			promptText('网络请求失败，请稍候再试！');
		});
	}

	$('.sale-goods').click(function() {
		$(this).siblings('.good-id').removeAttr('disabled');
		syncForm($('#form-two').attr('saleUrl'), $('#form-two'));
	});

	$(document).on('click', '.prompt-dialog-btn-redirect,.promptBox-dialog-close', function() {
		if (redirectFlag) {
			window.location.href = redirectPath;
		} else {
			promptDialog.hide();
		}
		return false;
	});

	$('.confirm-dialog-btn-redirect').click(function() {
		syncForm($('#form-two').attr('action'), $('#form-two'));
		confirmDialog.hide();
	});

	var t = null;

	var clip = new ZeroClipboard($(".copy-short-link"), {
		moviePath: "/static/linkage/js/Common/ZeroClipboard/ZeroClipboard.swf"
	});
	clip.on('mousedown', function(client) {
		clip.setText($(this).attr('short-link'));
	});
	clip.on('complete', function(client, args) {
		$('.copy-short-link-tips').hide();
		$(this).find('.copy-short-link-tips').fadeIn('normal');
		clearTimeout(t);
		t = setTimeout(time, 2000);
	});

	$('.qrcode-wrap').hover(function() {
		$(this).find('.qrcode-detail-wrap').show();
	}, function() {
		$(this).find('.qrcode-detail-wrap').hide();
	});

	function time() {
		$('.copy-short-link-tips').fadeOut('normal');
	};

	$('.product-good-hover-container').hover(function() {
		var _this = $(this);
		if ($(this).find('.product-good-right-container').children().size() <= 1 || $(this).find('.product-good-image-large').children().size() <= 1) {
			_this.find('.loading-wrap').show();
			$.post(_this.find('.product-good-image').attr('jsonpath'), function(data) {
				var html = '';
				if (data.status_code == '200') {
					if (data.status == '0') {
						html += ('<div class="product-good-image-large"><a href="javascript:;"><img src="' + _this.find('.product-good-image>img').attr('src') + '"/><div class="no-sale">此宝贝已下架</div></a></div>');
					} else if (data.status == '1') {
						//<li><span class="iconfont" style="color:#88c244;">&#xe60f;</span><span class="pgood-contact"></span></li>;
						html += ('<div class="product-good-image-large"><a href="http://gz.17zwd.com/item.htm?gid=' + data.gid + '" target="_blank"><img src="' + data.tb_img + '_240x240.jpg"/></a></div><p class="product-good-title"><a href="http://gz.17zwd.com/item.htm?gid=' + data.gid + '" title="' + data.title + '" target="_blank">' + data.title + '</a></p><p class="product-good-price"><span>￥</span><span>' + data.price + '</span></p><div class="product-good-intro"><div class="product-good-area">' + data.address + '</div><div class="product-good-favourable">' + data.discount + '</div></div><div class="product-good-contacts"><ul class="product-good-contact-list"><li><span class="iconfont" style="color:#00a2ff;">&#xe60b;</span><span class="pgood-contact" title="' + data.wangwang + '">' + data.wangwang + '</span></li><li><span class="iconfont" style="color:#f95338;">&#xe62e;</span><span class="pgood-contact" title="' + data.phone + '">' + data.phone + '</span></li><li><span class="iconfont" style="color:#ff9c55;">&#xe60c;</span><span class="pgood-contact" title="' + data.qq + '">' + data.qq + '</span></li></ul></div><div class="product-good-redirects" style="display:none;"><a class="product-good-redirect" href="#">传淘宝</a><a class="product-good-redirect" href="#">传阿里</a><a class="product-good-redirect" href="#">传拍拍</a></div>');
					}
				} else if (data.status_code == '201') {
					html += ('<div class="product-good-image-large"><img src="/static/linkage/img/System-Busy.jpg" /></div>');
				}
				_this.find('.product-good-right-container').empty().append(html);
			}, 'json').always(function() {
				_this.find('.loading-wrap').hide();
			});
		}
		$(this).find('.product-good-hover-wrap').show();
	}, function() {
		$('.product-good-hover-wrap').hide();
	});

	$('.need-help-lnk').click(function() {
		$('.mask').show();
		$('.help-wrap-01:eq(0)').addClass('help_command');
	});

	if ($('.need-help-lnk').hasClass('really-need')) {
		$('.mask').show();
		$('.help-wrap-01:eq(0)').addClass('help_command');
	}


	$('.help-wrap-01 .help-next').click(function() {
		$('.help-wrap-01:eq(0)').removeClass('help_command');
		$('.help-wrap-02:eq(0)').addClass('help_command');
	});

	$('.help-wrap-02 .help-next').click(function() {
		$('.help-wrap-02:eq(0)').removeClass('help_command');
		$('.help-wrap-03:eq(0)').addClass('help_command');
	});

	$('.help-wrap-03 .help-finish').click(function() {
		$('.help-wrap-03:eq(0)').removeClass('help_command');
		$('.mask').hide();
	});

	$('.link-position').hover(function() {
		$(this).find('.dropdown-wrap').show();
	}, function() {
		$(this).find('.dropdown-wrap').hide();
	});

	$('.product-nav-input-wrap').hover(function() {
		$(this).addClass('input-hover');
	}, function() {
		$(this).removeClass('input-hover');
	});

	$('.link-single input:radio').change(function() {
		$('#form-one').submit();
	});

	$('.btn-update').click(function() {
		var _this = $(this);
		$('.mask0').show();
		$.getJSON($(this).attr('updatepath'), function(data) {
			if (typeof(data.permited) != 'undefined') {
				if (data.permited == '0') {
					$('.tip-wrap').html('请不要频繁使用宝贝更新！');
				} else if (data.permited == '1') {
					if (data.success_num != '0') {
						$('.tip-wrap').html('宝贝更新成功，已更新<span class="tipText-site"><span id="updateCount">' + data.success_num + '</span>件</span>商品。');
					} else {
						$('.tip-wrap').html('宝贝更新成功，暂时没有商品更新。');
					}
				} else {
					$('.tip-wrap').html('宝贝更新失败，请稍候再试！');
				}
			}
		}).fail(function() {
			$('.tip-wrap').html('宝贝更新失败，请稍候再试！');
		}).always(function() {
			clearTimeout(cTime);
			cTime = setTimeout(function() {
				$("#update-tip").hide("slow");
			}, 10000);
			$('.mask0').hide();
			$("#update-tip").show("normal");
		});
	});

	var cTime = setTimeout(function() {
		$("#update-tip").hide("slow");
	}, 10000);

	$("#update-tip").hover(function() {
		clearTimeout(cTime);
	}, function() {
		cTime = setTimeout(function() {
			$("#update-tip").hide("slow");
		}, 10000);
	});

	$(".tip-close").click(function() {
		$("#update-tip").hide("slow");
	});

	if (do_res != null && do_res != 'n') {
		$("#update-tip").show("normal");
		$('.tip-wrap').html(do_res);
	}

});