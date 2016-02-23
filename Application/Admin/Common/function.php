<?php
//得到当前网址
function get_url($str){
	//$str = $_SERVER['PHP_SELF'].'?';
	//$str = 'http://fenxiang.vip.17zwd.com/diylist.do?';
	if($_GET){
		foreach ($_GET as $k=>$v){  //$_GET['page']
			if($k!='page'){
				$str .= $k.'='.$v.'&';
			}
		}
	}
	return $str;
}


//列表页专用分页函数
/**
 *@pargam $current 		当前页
 *@pargam $count	int 记录总数
 *@pargam $limit		每页显示多少条
 *@pargam $size			中间显示多少条
 *@pargam $class		样式
*/

function page($current,$count,$limit,$size,$class='badoo-new'){
	$str='';
	if($count>$limit){
		$pages = ceil($count/$limit);//算出总页数
		$url_str = 'http://fenxiang.vip.17zwd.com/diylist.do?';
		$url = get_url($url_str);//获取当前页面的URL地址（包含参数）
		
		$str.='<div class="'.$class.'">';
		//开始
		if($current==1){
			$str.='<span class="disabled" style="display:none">首&nbsp;&nbsp;页</span>';
			$str.='<span class="disabled" style="display:none">上一页</span>';
		}else{
			$str.='<a href="'.$url.'page=1" style="display:inline">首&nbsp;&nbsp;页</a>';
			$str.='<a href="'.$url.'page='.($current-1).'" style="display:inline">上一页</a>';
		}
		//中间
		//判断得出star与end
	    
		 if($current<=floor($size/2)){ //情况1
			$star=1;
			$end=$pages >$size ? $size : $pages; //看看他两谁小，取谁的
		 }else if($current>=$pages - floor($size/2)){ // 情况2
				 
			$star=$pages-$size+1<=0?1:$pages-$size+1; //避免出现负数
			
			$end=$pages;
		 }else{ //情况3
		 
			$d=floor($size/2);
			$star=$current-$d;
			$end=$current+$d;
		 }
	
		for($i=$star;$i<=$end;$i++){
			if($i==$current){
				$str.='<span class="current" style="display:inline">'.$i.'</span>';	
			}else{
				$str.='<a href="'.$url.'page='.$i.'" style="display:inline">'.$i.'</a>';
			}
		}

		//$str.='<span style="display:inline"><input type="text" name="page"/></span>';
		//最后
		if($pages==$current){
			$str .='<span class="disabled" style="display:none">下一页</span>';
			$str.='<span class="disabled" style="display:none">尾&nbsp;&nbsp;页</span>';
		}else{
			$str.='<a href="'.$url.'page='.($current+1).'" style="display:inline">下一页</a>';
			$str.='<a href="'.$url.'page='.$pages.'" style="display:inline">尾&nbsp;&nbsp;页</a>';
		}
		$str.='</div>';
	}
	
	return $str;
}


//批量更新页专用分页函数
/**
 *@pargam $current 		当前页
 *@pargam $count	int 记录总数
 *@pargam $limit		每页显示多少条
 *@pargam $size			中间显示多少条
 *@pargam $class		样式
*/
function page_batch($current,$count,$limit,$size){
	$str='';
	if($count>$limit){
		$pages = ceil($count/$limit);//算出总页数
		$url_str = 'http://fenxiang.vip.17zwd.com/batch.do?';
		$url = get_url($url_str);//获取当前页面的URL地址（包含参数）
		
		//$str.='<div class="'.$class.'">';
		//开始
		if($current==1){
			$str.='<a class="jp-disabled" style="display:none">首&nbsp;&nbsp;页</a>';
			$str.='<a class="jp-disabled" style="display:none">上一页</a>';
		}else{
			$str.='<a href="'.$url.'page=1" >首&nbsp;&nbsp;页</a>';
			$str.='<a href="'.$url.'page='.($current-1).'" >上一页</a>';
		}
		//中间
		//判断得出star与end
	    
		 if($current<=floor($size/2)){ //情况1
			$star=1;
			$end=$pages >$size ? $size : $pages; //看看他两谁小，取谁的
		 }else if($current>=$pages - floor($size/2)){ // 情况2
				 
			$star=$pages-$size+1<=0?1:$pages-$size+1; //避免出现负数
			
			$end=$pages;
		 }else{ //情况3
		 
			$d=floor($size/2);
			$star=$current-$d;
			$end=$current+$d;
		 }
	
		for($i=$star;$i<=$end;$i++){
			if($i==$current){
				$str.='<span class="page-current" >'.$i.'</span>';	
			}else{
				$str.='<a href="'.$url.'page='.$i.'" >'.$i.'</a>';
			}
		}

		//$str.='<span style="display:inline"><input type="text" name="page"/></span>';
		//最后
		if($pages==$current){
			$str .='<a class="jp-disabled" style="display:none">下一页</a>';
			$str.='<a class="jp-disabled" style="display:none">尾&nbsp;&nbsp;页</a>';
		}else{
			$str.='<a href="'.$url.'page='.($current+1).'" >下一页</a>';
			$str.='<a href="'.$url.'page='.$pages.'" >尾&nbsp;&nbsp;页</a>';
		}
		//$str.='</div>';
	}
	
	return $str;
}


//过滤敏感词
function filter($content){

	$denyword=array('操你妈','垃圾','17做网店','一起做网店','曰','fuck','shit','草你妈','sb','SB','傻逼','煞笔','习近平','毛泽东','共产党','去死','狗逼','你妈逼','你麻痹','狗带','妈的','他妈的','灵车','爆炸','小姐','约炮','祖宗','二逼','坟前','亲妈','爹','娘','鸡巴','AV','色情','奸','淫');
	$content=str_replace($denyword,'***',$content);
	return $content;
}




