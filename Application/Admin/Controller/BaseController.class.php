<?php
namespace Admin\Controller;

use Think\Controller;

class  BaseController extends Controller {

	public function cookie_val($str,$key){

        //$str='LoginId=wyu110808&userId=277584&Uid=277584&cookie_activeemail=0&PA=1&ValCode=f3adae3b16f74e68b3cbc73ddfe08db3&LTime=1452481022';
        //$key='ValCode';
        $length=strlen($key);
        $pos=stripos($str,$key);
        $substr=substr($str,$pos);
        
        $str_arr = @explode('&', $substr);
        $final_str = $str_arr[0];
        $cookie_val = substr($final_str,$length+1);
        
        return $cookie_val;
    }


    public function create_cookie_values($value=''){
        if($value==null){
            return '';
        }
        $LoginId=$this->cookie_val($value,'LoginId');
        $userId=$this->cookie_val($value,'userId');
        $ValCode=$this->cookie_val($value,'ValCode');

       return $LoginId.'___'.$userId.'___'.$ValCode;
    }



}