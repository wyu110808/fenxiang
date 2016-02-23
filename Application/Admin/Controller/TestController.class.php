<?php
namespace Admin\Controller;
use Think\Controller;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class TestController extends Controller{
	public function index(){

		/*$post=array();
        $post['url']=I('post.url');
        $post['canshu']=I('post.canshu');
        $result=$this->curl_file_post_contents('fenxiang.vip.17zwd.com/test_post.do',$timeout,$post);
        $this->assign('result',$result);*/
        //echo '111111';
        $this->display();
	}


    public function check_post(){
        $url=I('post.url');
        $canshu=I('post.canshu');
        echo $url.'<br/>';
        echo $canshu;
    }

    public function curl_file_post_contents($durl, $timeout = 5, $data){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $durl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_USERAGENT, _USERAGENT_);
        curl_setopt($ch, CURLOPT_REFERER, _REFERER_);

        curl_setopt($ch, CURLOPT_POST, 1); //设置为POST传输
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //添加post数据
        $r = curl_exec($ch);
        var_dump($ch);
        if ($r === false) {  //判断错误
            echo curl_error($ch);
        }
        $info = curl_getinfo($ch);  //能够在cURL执行后获取这一请求的有关信息
        curl_close($ch);
        return $r;
    }

	public function rizhi(){
       
        //E('test');
        
        $log = new Logger('test');
        $log->pushHandler(new StreamHandler('./logs/your.log', Logger::WARNING));
         
       
        $log->addWarning('just test');
        $log->addError('just error');
        
    }
   


}