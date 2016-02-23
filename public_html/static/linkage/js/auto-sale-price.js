define(function(require, exports, module) {
	var $ = require('$');
	var Dialog = require('dialog');

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
		promptDialog.show();
	}

	var redirectPath = '';
	var redirectFlag = false;

	function syncForm(url, form) {
		$.post(url, form.serialize(), function(data) {
			if (data.do_nickname == 'new') {
				redirectFlag = true;
				redirectPath = data.do_url;
			}
			promptText(data.do_text);
		}, 'json').fail(function() {
			promptText('网络请求失败，请稍候再试！');
		});
	}

	$(document).on('click', '.prompt-dialog-btn-redirect,.promptBox-dialog-close', function() {
		if (redirectFlag) {
			window.location.href = redirectPath;
		} else {
			promptDialog.hide();
		}
		return false;
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


	$('.linkage-form-save').click(function() {
		if (!verifyPrice0($('#J_price-percent'), $('#J_price-tip'))) {
			$('#J_price-percent').focus();
			return false;
		}
		if (!verifyPrice1($('#J_price-integer'), $('#J_price-tip'))) {
			$('#J_price-integer').focus();
			return false;
		}
		if (!verifyNickName($('#J_Nickname'), $('#J_Nickname-tip'))) {
			$('#J_Nickname').focus();
			return false;
		}
		if (!verifyMobile($('#J_Mobile'), $('#J_Mobile-tip'))) {
			$('#J_Mobile').focus();
			return false;
		}
		if (!verifyWW($('#J_WW'), $('#J_WW-tip'))) {
			$('#J_WW').focus();
			return false;
		}
		if (!verifyQQ($('#J_QQ'), $('#J_QQ-tip'))) {
			$('#J_QQ').focus();
			return false;
		}
		if (!verifyWX($('#J_WX'), $('#J_WX-tip'))) {
			$('#J_WX').focus();
			return false;
		}
		syncForm($('#form-one').attr('action'), $('#form-one'));
	});

	$('.linkage-form-back').click(function() {
		history.back();
	});

	$('#J_Nickname').blur(function() {
		verifyNickName($(this), $('#J_Nickname-tip'));
	});

	$('#J_price-percent').blur(function() {
		verifyPrice0($('#J_price-percent'), $('#J_price-tip'));
	});

	$('#J_price-integer').blur(function() {
		verifyPrice1($('#J_price-integer'), $('#J_price-tip'));
	});

	$('#J_Mobile').blur(function() {
		verifyMobile($(this), $('#J_Mobile-tip'));
	});

	$('#J_WW').blur(function() {
		verifyWW($(this), $('#J_WW-tip'));
	});

	$('#J_QQ').blur(function() {
		verifyQQ($(this), $('#J_QQ-tip'));
	});

	$('#J_WX').blur(function() {
		verifyWX($(this), $('#J_WX-tip'));
	});

	function verifyZero(input, tip) {
		if ($.trim(input.val()).length == 0) {
			return false;
		}
		tip.text('');
		return true;
	}

	function verifyPrice0(input, tip) {
		if (!verifyZero(input, tip)) {
			tip.text('第一项为必填项！');
		} else if (parseInt(input.val()) < 100) {
			tip.text('百分比小于100');
		} else if (!/^\d+(\.\d+)?$/.test(input.val())) {
			tip.text('第一项必须为整数！');
		} else {
			return true;
		}
		return false;
	}

	function verifyPrice1(input, tip) {
		if (!verifyZero(input, tip)) {
			tip.text('第二项为必填项！');
		} else if (!/^\d+(\.\d+)?$/.test(input.val())) {
			tip.text('第二项必须为数字！');
		} else {
			return true;
		}
	}

	function verifyNickName(input, tip) {
		if ($.trim(input.val()).length < 5) {
			tip.text('昵称至少4位');
		} else if ($.trim(input.val()).length > 15) {
			tip.text('昵称最大15位');
		} else {
			tip.text('');
			return true;
		}
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


});