define(function(require, exports, module) {
	var $ = require('$');
	var Dialog = require('dialog');
	require('swiper');
	require('lazyload')($, window, document);

	var identifyingDialog = new Dialog({
		classPrefix: 'identifyingBox-dialog',
		align: {
			selfXY: ['50%', '50%']
		},
		width: '380px',
		content: '#identifyingBox'
	});

	var promptDialog = new Dialog({
		classPrefix: 'promptBox-dialog',
		align: {
			selfXY: ['50%', '50%']
		},
		width: '380px',
		content: '#promptBox'
	});

	function promptText(text) {
		$('.prompt-dialog-txt').text(text);
		identifyingDialog.hide();
		promptDialog.show();
	}

	$('.identifying-dialog-btn-cancel').click(function() {
		identifyingDialog.hide();
	});

	var ue = UE.getEditor('editor', {
		toolbars: [
			[
				'undo',
				'redo',
				'bold',
				'italic',
				'underline',
				'strikethrough',
				'forecolor'
			]
		],
		autoFloatEnabled: false,
		elementPathEnabled: false,
		initialContent: defaultNotice,
		initialFrameHeight: 200,
		initialFrameWidth: 520,
		maximumWords: 1000,
		pasteplain: true,
		wordCount: true,
		zIndex: 0
	});

	function FixIe7Bug() {
		var divs = $("div .edui-default");
		$.each(divs, function(index, item) {
			if ($(item).css("position") == "relative") {
				$(item).css("position", "static");
			}
		});
	}

	ue.ready(function() {
		if (UE.browser.ie && UE.browser.version <= 7) {
			FixIe7Bug();
		}
	})

	$('#O_Price').keypress(function(event) {
		return event.keyCode >= 48 && event.keyCode <= 57 || event.keyCode == 46;
	});

	$('.preview-form-browser').click(function() {
		if (validForm()) {
			$('#J_Title').text($('#O_Tilte').val());
			$('#J_Price').text($('#O_Price').val());
			$('#J_Mobile').text($('#O_Mobile').val());
			pickLoad($('#O_WW'), $('#J_WW'));
			pickLoad($('#O_WX'), $('#J_WX'));
			pickLoad($('#O_QQ'), $('#J_QQ'));
			pickLoadNotice(UE.getEditor('editor').getContent(), $('#J_Notice'));
			initArary.length = 0;
			$('.preview-img-wrap').each(function() {
				if (!$(this).hasClass('disabled')) {
					initArary.push($(this).attr('originUrl'));
				}
			});
			pickLoadImg(initArary);
			var imgs = '';
			$('.preview-checkbox-link.active').each(function(i, value) {
				imgs += '<img data-original="' + $(this).attr('href') + '_290x10000.jpg" />';
			});
			$('#J_Detail').html(imgs);
		}
	});
	var initArary = new Array();

	var urlHTML = '';
	if (pic.length == sel_json.length) {
		for (var i = 0; i < pic.length; i++) {
			urlHTML += ('<li class="preview-checkbox-single"><input type="checkbox" class="selectSingle" checked="checked" />&nbsp;<a class="preview-checkbox-link active" href="' + pic[i].img + '" title="' + pic[i].img + '" target="_blank">' + pic[i].img + '</a></li>');
		}
		$('#J_selectAll').empty().html('<input type="checkbox" id="selectAll" checked="checked" /><label for="selectAll" class="active">全选</label>');
	} else {
		var flag_pic = false;
		for (var i = 0; i < pic.length; i++) {
			for (var j = 0; j < sel_json.length; j++) {
				if (pic[i].img == sel_json[j].img) {
					flag_pic = true;
					break;
				} else {
					flag_pic = false;
				}
			}
			urlHTML += ('<li class="preview-checkbox-single"><input type="checkbox" class="selectSingle" ' + (flag_pic ? 'checked="checked"' : '') + ' />&nbsp;<a class="preview-checkbox-link' + (flag_pic ? ' active' : '') + '" href="' + pic[i].img + '" title="' + pic[i].img + '" target="_blank">' + pic[i].img + '</a></li>');
		}
		$('#J_selectAll').empty().html('<input type="checkbox" id="selectAll" /><label for="selectAll">全选</label>');
	}
	$('.preview-checkbox-list').empty().append(urlHTML);


	function pickLoadImg(array) {
		mySwiper.removeAllSlides();
		for (var i = 0; i < array.length; i++) {
			mySwiper.appendSlide('<div class="swiper-slide"><div class="swiper-mywrap"><img src="' + array[i] + '_290x290.jpg" /></div></div>');
		}
	}

	var isIE = !!window.ActiveXObject;
	var isIE6 = isIE && !window.XMLHttpRequest;
	var isIE8 = isIE && !!document.documentMode;
	var isIE7 = isIE && !isIE6 && !isIE8;
	if (!isIE || (!isIE6 && !isIE7 && !isIE8)) {
		var mySwiper = new Swiper('.swiper-container', {
			grabCursor: true,
			loop: false,
			pagination: '.swiper-pagination'
		});
	}

	$('.preview-img-wrap').hover(function() {
		$(this).find('.preview-img-original-container').show();
	}, function() {
		$(this).find('.preview-img-original-container').hide();
	}).click(function() {
		if ($(this).hasClass('disabled')) {
			$(this).removeClass('disabled');
		} else {
			$(this).addClass('disabled');
		}
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

	$('.preview-form-publish').click(function() {
		var _this = $(this);
		if (validForm()) {
			var mval = '';
			$('.preview-img-wrap').each(function() {
				if (!$(this).hasClass('disabled')) {
					mval += ($(this).attr('originUrl') + ',');
				}
			});
			mval = mval.substring(0, mval.length - 1);
			$('#mainPic').val(mval);
			var aval = '[';
			$('.preview-checkbox-link').each(function() {
				if ($(this).hasClass('active')) {
					aval += ('{"img":"' + $(this).attr('href') + '"},');
				}
			});
			$('#detailPic').val((aval.length == 1 ? aval : aval.substring(0, aval.length - 1)) + ']');
			$.getJSON(_this.attr('frequenturl'), function(data) {
				if (data.cookie_error == "1") {
					window.location.href = data.url;
				} else {
					if (data.rate == '200') {
						syncForm($('#form-one').attr('action'), $('#form-one'));
					} else if (data.rate == '300') {
						$('.identifying-code-img').find('img').attr('src', $('.preview-form-publish').attr('codeurl') + '?' + Math.random());
						identifyingDialog.show();
					}
				}
			}).fail(function() {

			});
		}
	});

	$(document).on('click', '.prompt-dialog-btn-redirect,.promptBox-dialog-close', function() {
		if (redirectFlag) {
			window.location.href = redirectPath;
		} else {
			promptDialog.hide();
		}
		return false;
	});

	$('.identifying-code-img,.identifying-code-refresh').click(function() {
		$('.identifying-dialog-txt').find('img').attr('src', $('.preview-form-publish').attr('codeurl') + '?' + Math.random());
	});

	$('.identifying-dialog-btn-redirect').click(function() {
		if ($.trim($('.identifying-code-input').val()).length == 0) {
			$('.identifying-code-tip').text('请输入验证码');
			return false;
		}
		if ($.trim($('.identifying-code-input').val()).length > 4) {
			$('.identifying-code-tip').text('验证码超出4位');
			return false;
		}
		$.getJSON($('.preview-form-publish').attr('verifyurl'), {
			verify_code: $('.identifying-code-input').val()
		}, function(data) {
			if (data.cookie_error == "1") {
				window.location.href = data.url;
			} else {
				if (data.verify_result == '1') {
					$('.identifying-code-tip').text('');
					syncForm($('#form-one').attr('action'), $('#form-one'));
				} else if (data.verify_result == '0') {
					identifyingDialog.show();
					$('.identifying-code-input').val('').siblings('.identifying-code-tip').text('验证码错误，请重新输入');
					$('.identifying-code-img').click();
				}
			}
		});
	});

	function validForm() {
		if (!verifyMainPIC($('.preview-img-wrap'), $('.preview-img-wrap.disabled'), $('#O_MainPic-tip'))) {
			$('.preview-img-link').focus();
			return false;
		}
		if (!verifyTitle($('#O_Tilte'), $('#O_Tilte-tip'))) {
			$('#O_Tilte').focus();
			return false;
		}
		if (!verifyPrice($('#O_Price'), $('#O_Price-tip'))) {
			$('#O_Price').focus();
			return false;
		}
		if (!verifyMobile($('#O_Mobile'), $('#O_Mobile-tip'))) {
			$('#O_Mobile').focus();
			return false;
		}
		if (!verifyQQ($('#O_QQ'), $('#O_QQ-tip'))) {
			$('#O_QQ').focus();
			return false;
		}
		if (!verifyWW($('#O_WW'), $('#O_WW-tip'))) {
			$('#O_WW').focus();
			return false;
		}
		if (!verifyWX($('#O_WX'), $('#O_WX-tip'))) {
			$('#O_WX').focus();
			return false;
		}
		return true;
	}

	time();
	var t = null;
	t = setTimeout(time, 60000);

	function time() {
		clearTimeout(t);
		dt = new Date();
		document.getElementById("toolbar-time").innerHTML = dt.getHours() + ':' + (dt.getMinutes() < 10 ? '0' + dt.getMinutes() : dt.getMinutes());
		t = setTimeout(time, 60000);
	};

	$('#O_Tilte').blur(function() {
		verifyTitle($(this), $('#O_Tilte-tip'));
	});

	$('#O_Price').blur(function() {
		verifyPrice($(this), $('#O_Price-tip'));
	});

	$('#O_Mobile').blur(function() {
		verifyMobile($(this), $('#O_Mobile-tip'));
	});

	$('#O_WW').blur(function() {
		verifyWW($(this), $('#O_WW-tip'));
	});


	$('#O_QQ').blur(function() {
		verifyQQ($(this), $('#O_QQ-tip'));
	});


	$('#O_WX').blur(function() {
		verifyWX($(this), $('#O_WX-tip'));
	});

	function verifyZero(input, tip) {
		if ($.trim(input.val()).length == 0) {
			return false;
		}
		tip.text('');
		return true;
	}

	function verifyTitle(input, tip) {
		if (!verifyZero(input, tip)) {
			tip.text('标题不能为空！');
		} else {
			return true;
		}
		return false;
	}

	function verifyPrice(input, tip) {
		if (!verifyZero(input, tip)) {
			tip.text('价格不能为空！');
		} else if (!/^(?!0+(?:\.0+)?$)(?:[1-9]\d*|0)(?:\.\d{1,2})?$/.test(input.val())) {
			tip.text('只能正整数最多两位小数');
		} else if (parseFloat(input.val()) < parseFloat($('#price_took').text())) {
			tip.text('价格小于拿货价');
		} else {
			calc();
			return true;
		}
		$('#price_profits').text('0');
		return false;
	}

	function verifyMobile(input, tip) {
		if (!verifyZero(input, tip)) {
			tip.text('手机不能为空！');
		} else if (!/^[1][0-9]{10}$/.test(input.val())) {
			tip.text('手机格式不正确！');
		} else {
			return true;
		}
		return false;
	}

	function verifyWW(input, tip) {
		if (!/^[\u4e00-\u9fa5_a-zA-Z0-9_]*$/.test(input.val())) {
			tip.text('旺旺只能包含中文,字母数字,下划线');
			return false;
		} else {
			tip.text('');
			return true;
		}
	}

	function verifyQQ(input, tip) {
		if ($.trim(input.val()).length == 0) {
			tip.text('');
			return true;
		} else {
			if (!/^[1-9][0-9]{4,11}$/.test(input.val())) {
				tip.text('QQ号码格式不正确');
				return false;
			} else {
				tip.text('');
				return true;
			}
		}
	}

	function verifyWX(input, tip) {
		if ($.trim(input.val()).length == 0) {
			tip.text('');
			return true;
		} else if (!/^[A-Za-z][A-Za-z0-9_\-]{4,}$/.test(input.val())) {
			tip.text('首位为字母且至少5位');
			return false;
		} else {
			tip.text('');
			return true;
		}
	}

	function verifyMainPIC(input0, input1, tip) {
		if (input0.size() != input1.size()) {
			tip.text('');
			return true;
		} else {
			tip.text('请至少选择一个主图！');
			return false;
		}
	}

	$('#J_Title').text($('#O_Tilte').val());
	$('#J_Price').text($('#O_Price').val());
	$('#J_Mobile').text($('#O_Mobile').val());
	pickLoad($('#O_WW'), $('#J_WW'));
	pickLoad($('#O_WX'), $('#J_WX'));
	pickLoad($('#O_QQ'), $('#J_QQ'));
	pickLoadNotice(defaultNotice, $('#J_Notice'));
	var imgs = '';
	$.each(sel_json, function(i, value) {
		imgs += '<img data-original="' + value.img + '_290x10000.jpg" />';
	});
	$('#J_Detail').html(imgs);

	calc();

	function calc() {
		$('#price_profits').text(parseFloat(parseFloat($('#O_Price').val()) - parseFloat($('#price_took').text())).toFixed(2));
	}

	function pickLoadNotice(html, view) {
		if ($.trim(html).length != 0) {
			view.html(html).closest('.preview-mobile-bnotice').show();
		} else {
			view.closest('.preview-mobile-bnotice').hide();
		}
	}

	function pickLoad(input, view) {
		if ($.trim(input.val()).length != 0) {
			view.text(input.val()).attr('title', input.val()).closest('li').show();
		} else {
			view.closest('li').hide();
		}
	}

	if ($('.need-help-lnk').hasClass('really-need')) {
		$('.mask').show();
		$('.help-wrap-01').addClass('help_command');
	}

	$('.need-help-lnk').click(function() {
		$('.mask').show();
		$('.help-wrap-01').addClass('help_command');
	});

	$('.help-wrap-01 .help-next').click(function() {
		$('.help-wrap-01').removeClass('help_command');
		$('.help-wrap-02').addClass('help_command');
	});

	$('.help-wrap-02 .help-next').click(function() {
		$('.help-wrap-02').removeClass('help_command');
		$('.help-wrap-03').addClass('help_command');
	});

	$('.help-wrap-03 .help-next').click(function() {
		$('.help-wrap-03').removeClass('help_command');
		$('.help-wrap-04').addClass('help_command');
	});

	$('.help-wrap-04 .help-next').click(function() {
		$('.help-wrap-04').removeClass('help_command');
		$('.help-wrap-05').addClass('help_command');
	});

	$('.help-wrap-05 .help-finish').click(function() {
		$('.help-wrap-05').removeClass('help_command');
		$('.mask').hide();
	});

	$('.preview-mobile-contorl').scroll(function() {
		$("#J_Detail img").lazyload();
	});

	$('#showDetail').click(function() {
		if ($(this).prop('checked')) {
			$(this).siblings('label').addClass('active');
			$('.preview-checkbox-list,#J_selectAll').show();
			document.location.hash = "detail";
			document.location.hash = "";
		} else {
			$(this).siblings('label').removeClass('active');
			$('.preview-checkbox-list,#J_selectAll').hide();
		}
	});


	$('#selectAll').click(function() {
		if ($(this).prop('checked')) {
			$(this).siblings('label').addClass('active');
			$('.selectSingle').prop('checked', true).siblings('.preview-checkbox-link').addClass('active');
		} else {
			$(this).siblings('label').removeClass('active');
			$('.selectSingle').prop('checked', false).siblings('.preview-checkbox-link').removeClass('active');
		}
	});


	$('.selectSingle').click(function() {
		if ($(this).prop('checked')) {
			$(this).siblings('.preview-checkbox-link').addClass('active');
		} else {
			$(this).siblings('.preview-checkbox-link').removeClass('active');
		}
		$('#selectAll').prop('checked', $('.preview-checkbox-link').size() == $('.preview-checkbox-link.active').size());
	});

});