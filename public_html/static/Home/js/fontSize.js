/**
 * Created by Administrator on 2015/12/8/0008.
 */

// fontSize
var _html,view_width;
function fontSize(){
    _html = document.getElementsByTagName('html')[0];
    view_width = _html.getBoundingClientRect().width;
    view_width > 640 ? _html.style.fontSize = 640/16 + 'px' : _html.style.fontSize = view_width/16 + 'px';
}
fontSize();
window.onresize = fontSize;
