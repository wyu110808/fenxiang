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

	function remainTxt(text) {
		$('.confirm-dialog-txt').text(text);
		confirmDialog.show();
	}

	function promptText(text) {
		$('.prompt-dialog-txt').text(text);
		confirmDialog.hide();
		promptDialog.show();
	}

	$('.share-pageoptions-wrap').hover(function() {
		$(this).find('.share-pageoptions').show();
	}, function() {
		$(this).find('.share-pageoptions').hide();
	});

	$('#checkall').change(function() {
		$('.share-items-wrap').find('input:checkbox').prop('checked', $(this).prop('checked'));
	});

	$('.share-items-wrap input:checkbox').change(function() {
		$('#checkall').prop('checked', $('.share-items-wrap input:checkbox').size() == $('.share-items-wrap input:checkbox:checked').size());
	});

	$('.btn-update').click(function() {
		if ($('.share-items-wrap input:checkbox:checked').size() == 0) {
			promptText('请至少选择一个宝贝！');
			return false;
		}
		if ($('.share-option-wrap input:checkbox:checked').size() == 0) {
			promptText('请至少选择一个修改项！');
			return false;
		}
		$('.mask0').show();
		$.post($('#form-one').attr('action'), $('#form-one').serialize(), function(data) {
			if (typeof(data.permited) != 'undefined') {
				if (data.permited == '0') {
					$('.tip-wrap').html('请不要频繁使用批量更新！');
				} else if (data.permited == '1') {
					if (data.success_num != '0') {
						$('.tip-wrap').html('批量更新成功，已更新<span class="tipText-site"><span id="updateCount">' + data.success_num + '</span>件</span>商品。');
					} else {
						$('.tip-wrap').html('批量更新成功，暂时没有商品更新。');
					}
				} else {
					$('.tip-wrap').html('批量更新失败，请稍候再试！');
				}
			}
		}, 'json').fail(function() {
			$('.tip-wrap').html('批量更新失败，请稍候再试！');
		}).always(function() {
			clearTimeout(cTime);
			cTime = setTimeout(function() {
				$("#update-tip").hide("slow");
			}, 10000);
			$('.mask0').hide();
			$("#update-tip").show("normal");
		});
	});

	$('.page-input').keyup(function() {
		var arg = parseInt($(this).val().replace(/\D/g, ''));
		$(this).val(arg > 0 ? arg : 1);
		if (event.keyCode == 13 && $.trim($(this).val()).length != 0) {
			window.location.href = $('.page-sure').attr('skipUrl') + $('.page-input').val();
			return false;
		}
	}).on('paste', function() {
		var arg = parseInt($(this).val().replace(/\D/g, ''));
		$(this).val(arg > 0 ? arg : 1);
	});

	$('.page-sure').click(function() {
		if ($.trim($('.page-input').val()).length == 0) {
			promptText('请填写页码！');
			return false;
		}
		window.location.href = $(this).attr('skipUrl') + $('.page-input').val();
	});

	var redirectFlag = false;
	var redirectPath = null;

	$(document).on('click', '.prompt-dialog-btn-redirect,.promptBox-dialog-close', function() {
		if (redirectFlag) {
			window.location.href = redirectPath;
		} else {
			promptDialog.hide();
		}
		return false;
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

	$('.need-help-lnk').click(function() {
		var isIE = !!window.ActiveXObject;
		var isIE6 = isIE && !window.XMLHttpRequest;
		var isIE8 = isIE && !!document.documentMode;
		var isIE7 = isIE && !isIE6 && !isIE8;
		if (!isIE || (!isIE6 && !isIE7 && !isIE8)) {
			$('.mask').show();
			$('.share-opeartions-container').addClass('help_command_01');
		} else {
			promptText('想获得更好的浏览体验，请使用谷歌，火狐或360极速浏览器！');
		}
	});

	$('.help-btn-01').click(function() {
		$('.share-opeartions-container').removeClass('help_command_01');
		$('.share-items-wrap').addClass('help_command_02');
	});

	$('.help-btn-02').click(function() {
		$('.share-items-wrap').removeClass('help_command_02');
		$('.share-menu-container').addClass('help_command_03');
	});

	$('.help-btn-finish').click(function() {
		$('.share-menu-container').removeClass('help_command_03');
		$('.mask').hide();
	});

});