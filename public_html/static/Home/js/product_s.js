/**
 * Created by Administrator on 2015/12/8/0008.
 */

//焦点图
var swiper = new Swiper('.swiper-container', {
    autoplay: 3000,
    pagination: '.swiper-pagination',
    paginationClickable: true,
    loop : true
});

//轮播图只有一张图片的时候，关闭轮播
if($('.swiper-pagination>span').length == 1){
    swiper.lockSwipes();
}

// 查看宝贝详情
var onOff = true;
$('.title').on('touchend', function () {
    if (onOff) {
        $(this).css({
            'top': 0,
            'bottom': '',
            'border-bottom': '1px solid #e8e8e8',
            'text-align': 'left',
            'text-indent': '10px'
        }).text('< 返回');
        $('.pro_img,.sec').hide();
        $('.details').show().css('margin-top', '52px');

        $("img.lazy").lazyload({
            effect: "fadeIn"
        });
        ad();
    } else {
        $(this).css({
            'top': '',
            'bottom': '0',
            'border-bottom': 'none',
            'text-align': 'center',
            'text-indent': '0'
        }).text('宝贝详情');
        $('.pro_img,.sec').show();
        $('.details').hide().css('margin-top', '0');
    }
    onOff = !onOff;
});

// 输出详情
if(pic.length > 0){
    for (var i = 0; i < pic.length;i++) {
        // 第一张图不要lazyLoad
        if (i == 0) {
            $('.browse').before('<img src="' + pic[i].img + '">');
        } else {
            $('.browse').before('<img class="lazy" src="/static/Home/images/grey.gif" data-original="' + pic[i].img + '">');
        }
    }
}

//输出浏览量
$.ajax({
    url: 'http://fenxiang.17vdian.com/viewPro?str='+str,
    type: 'get',
    success: function (data){
        var json_result = JSON.parse(data);
        $('.browse_num').text(json_result.view);
    }
});

//广告图
function ad(){
    $.ajax({
        url: 'http://fenxiang.17vdian.com/Adv.do',
        type: 'post',
        success: function (data){
            var result = JSON.parse(data);
            $('.ad img').attr('src',result.url);
            $('.ad a').attr('href',result.href);
        }
    });
}