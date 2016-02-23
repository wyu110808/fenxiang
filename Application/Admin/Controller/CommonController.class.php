<?php
namespace Admin\Controller;
use Think\Controller;
class CommonController extends BaseController{

	protected $cookieUid;

	public function _initialize(){

        //logError('hello');

        header('Content-type:text/html;charset=utf-8');

        //拿session的值
        $session_val=session('Cookie_ulogin');
       //var_dump($session_val);
        $cookie_val=$this->create_cookie_values($_COOKIE['Cookie_ulogin']);
        //var_dump($cookie_val);die;


        if($cookie_val==''){
            //echo '1';
            $this->Jump();
        }


        if($session_val!=$cookie_val){
            //echo '2';
            $output=$this->get_web();
            //echo $output;
            if($output == 'True'){
                //echo '3';
                session('Cookie_ulogin',$cookie_val);
                session('Cookie_all',$_COOKIE['Cookie_ulogin']);//头像需要整段cookie,里面拿到key=AV后的值
            }
            if($output == 'False'){
                //echo '4';
                logError("没有通过api验证,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
                $this->Jump();      
            }

        }
        //die;

        $user=session('Cookie_ulogin');
        //var_dump($user);
        
        $user_arr = explode('___', $user);
        $origin_uid = $user_arr[1];
        //$origin_uid = substr($user,4);
        if($origin_uid==null){
            logError("uid获取不到cookie,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
            $this->Jump();
        }
        //echo $origin_uid;die;
        $this->cookieUid=$origin_uid;
        
        
        


    }

    public function Jump(){

        $Loginurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $Loginurl = urlencode($Loginurl);
        $LoginUrl = 'http://vip.17zwd.com/accounts/login.htm?redirectUrl='.$Loginurl;
        header('location:'.$LoginUrl); 
        
    }


    //检测cookie的有效性
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