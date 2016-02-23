<?php
namespace Admin\Controller;
use Think\Controller;

class DoStatusController extends Controller {


	//操作完成后的js弹窗提示接口
	public function index(){

		if(session('do')!=null){
			if(session('do')=='add'){
				if(session('do_res')=='success'){
					$json_arr['do_text']='发布成功';
					$json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
				}
				if(session('do_res')=='failed'){
					$json_arr['do_text']='发布失败,请稍候再试';
					$json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
				}
				if(session('do_res')==null){
					$json_arr['do_text']='n';
					$json_arr['do_url']='n';
				}
			}
			if(session('do')=='update'){
				if(session('do_res')=='success'){
					$json_arr['do_text']='更新成功';
					$json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
				}
				if(session('do_res')=='failed'){
					$json_arr['do_text']='更新失败,请稍候再试';
					$json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
				}
				if(session('do_res')==null){
					$json_arr['do_text']='n';
					$json_arr['do_url']='n';	
				}	
			}
		}else{
			$json_arr['do_text']='n';
			$json_arr['do_url']='n';
		}

		session('do_res',null);

		$json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
		echo $json;
		

	}


}