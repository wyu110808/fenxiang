<?php
namespace Admin\Controller;
use Think\Controller;
class CheckController extends GetuidController {

	//检查用户数据操作的频率
	public function checkrate(){

		$json_arr=array();

		$cookie_error=$this->cookie_error;

		//echo $cookie_error;

		if($cookie_error=='1'){
        	$json_arr['cookie_error']='1';
        	$json_arr['url']=$this->jump_url;
        	$json=json_encode($json_arr);
        }else{

	        $uid=$this->cookieUid;
	        //echo $uid;
	        $time=time()-20;

	        //查询用户的更新频率
	        $check=D('Fenxiang')->user2($uid,$time);
	            
	        $num=sizeof($check);
	        //var_dump($num);die;
	        
	        
	        if($num>0){
	           $res='300';
	           $json_arr['rate']='300';
	           $json=json_encode($json_arr);
	        }else{
	            $res='200';
	            $json_arr['rate']='200';
	            //$json_arr['session']=session('Cookie_ulogin');
	            $json=json_encode($json_arr);
	        }

    	}

        echo $json;
        
         
    }

    // 检测输入的验证码是否正确，$code为用户输入的验证码字符串
    public function checkverify(){

        $json_arr=array();

        $cookie_error=$this->cookie_error;

		//echo $cookie_error;

		if($cookie_error=='1'){
			
        	$json_arr['cookie_error']='1';
        	$json_arr['url']=$this->jump_url;
        	$json=json_encode($json_arr);
        }else{

	        $code=I('get.verify_code');
	        $code=strtoupper($code);       
	        $verify_code=session('verify_code');
	        
	        if($code==$verify_code){
	            
	            $json_arr['verify_result']='1';
	            $json=json_encode($json_arr);
	        }else{
	            
	            $json_arr['verify_result']='0';
	            $json=json_encode($json_arr);
	        }
   		}
        echo $json;
        
    }


    //获取uid传值得到模板信息
    public function checktemplate(){

    	$json_arr=array();

    	$uid=I('get.uid');

    	$json_arr=D('Template')->user($uid);

    	$json=json_encode($json_arr);

    	echo $json;
    }

}