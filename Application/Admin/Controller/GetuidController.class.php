<?php
namespace Admin\Controller;
use Think\Controller;
class  GetuidController extends BaseController {

	protected $cookieUid;

	protected $cookie_error;

	protected $jump_url;

	public function _initialize(){

        header('Content-type:text/html;charset=utf-8');

        //拿session的值
        $session_val=session('Cookie_ulogin');
       //var_dump($session_val);
        $cookie_val=$this->create_cookie_values($_COOKIE['Cookie_ulogin']);
        //var_dump($cookie_val);die;
        $this->cookie_error='0';

        if($cookie_val==''){
            //echo '1';
            //$this->Jump();
            $this->cookie_error='1';
            $this->jump_url=$this->url();
        }


        if($session_val!=$cookie_val){
            //echo '2';
            $this->cookie_error='1';
            $this->jump_url=$this->url();
            session('Cookie_ulogin',$cookie_val);
            session('Cookie_all',$_COOKIE['Cookie_ulogin']);//头像需要整段cookie,里面拿到key=AV后的值
        }

        //echo $this->cookie_error;

        $user=session('Cookie_ulogin');
        //var_dump($user);die;
        
        $user_arr = explode('___', $user);
        $origin_uid = $user_arr[1];
        //$origin_uid = substr($user,4);
        $this->cookieUid=$origin_uid;
        
    }

    public function url(){

        //$Loginurl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
        $Loginurl = $_SERVER['HTTP_REFERER'];
         
        $Loginurl = urlencode($Loginurl);
        $LoginUrl = 'http://vip.17zwd.com/accounts/login.htm?redirectUrl='.$Loginurl;
        //header('location:'.$LoginUrl); 
        return $LoginUrl;
        
    }

    



}