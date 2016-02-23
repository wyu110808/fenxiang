<?php
namespace Admin\Controller;
use Think\Controller;

class TryController extends Controller {

	public function index(){


		error_reporting(-1);
		//logError('hello');
		header('Content-type:text/html;charset=utf-8');

        //拿session的值
        $session_val=session('Cookie_ulogin');
       //var_dump($session_val);
        $cookie_val=$_COOKIE['Cookie_ulogin'];
        //var_dump($cookie_val);die;


        if($cookie_val==null){
            //echo '1';
            logError("cookie的值为空,只能进行跳转");
            //$this->Jump();
        }


        if($session_val!=$cookie_val){
            //echo '2';
            $output=$this->get_web();
            //echo $output;
            if($output == 'True'){
                //echo '3';
                session('Cookie_ulogin',$cookie_val);
            }
            if($output == 'False'){
                //echo '4';
                logError("没有通过api验证,稍后会进行跳转,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
                //$this->Jump();      
            }

        }

        $user=session('Cookie_ulogin');
        //var_dump($user);die;
        
        $user = explode('&', $user);
        $user = $user[2];
        $origin_uid = substr($user,4);
        $this->cookieUid=$origin_uid;
        
        if($origin_uid==null){
            logError("uid获取不到cookie,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
        }

        // echo 'finish';
        // echo date('YmdH');

	}

	 public function get_web(){

        $check_logins_value= 'Cookie_ulogin='.$_COOKIE['Cookie_ulogin'];
        $agent = 'Mozilla/5.0(XiaoBaWang6.3;WOW64;rv:39.0)Gecko/20100101Iphone/39.0';
        $url   = 'http://vip.17zwd.com/Communal/IsAccountOnline';
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch,CURLOPT_USERAGENT,$agent);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_COOKIE, $check_logins_value);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }



}