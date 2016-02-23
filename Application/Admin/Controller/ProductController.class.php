<?php 
namespace Admin\Controller;
use Think\Controller;

/*
**生成静态html
*/
class ProductController extends CommonController {
  
	public function index(){

        $origin_uid=$this->cookieUid;

        $u_uid='u'.$origin_uid;
       // var_dump($u_uid) ;die;
		//$u_uid=I('get.uid',u277584);
        //var_dump($u_uid) ;
    	//$gid=I('get.goods_id','4931659');
    	
    	//$zid=I('get.zdid','42');


        $str=I('get.goods_id');

        //echo $str;

        $this->assign('str',$str);
        $pos=strpos($str,'-');
       




        $id=substr($str,0,$pos);

        $en_zid=I('get.zdid',0);
        $gid=substr($str,$pos+1);

        

    	// $u_uid=I('get.uid',0);
        //echo $u_uid;die;
        
       //echo $uid;die;
    	
    	 

        
         

        if(!$u_uid){
            //exit('no u_uid');
            exit('系统君繁忙，暂时无法处理您的请求，请稍后重试。');
        }
        if(!$gid){
           //exit('no gid');
            exit('系统君繁忙，暂时无法处理您的请求，请稍后重试。');
        }
        if(!$en_zid){
            //exit('no zid');
            exit('系统君繁忙，暂时无法处理您的请求，请稍后重试。');
        }



       

		$info=M('Fenxiang')->where(array('id'=>$id))->find();

        $info['content'] = htmlspecialchars_decode(html_entity_decode($info['content']));
		$tb_img=$info['main_img'];
        $tb_img=explode(',',$tb_img);
        //var_dump($tb_img);
        //echo $json2;
        $json2=$info['xiangqing_img'];

        if(empty($json2)){
            $json2='[]';
        }

        //var_dump($json2);die;
		$this->assign('json',$json2);
		$this->assign('tb_img',$tb_img);
		$this->assign('info',$info);

        $user_info=D('User')->read2($origin_uid);

        $this->assign('user_info',$user_info);

        //var_dump($info);die;
        //die;

        //var_dump($info);
        // echo $str;
        // echo $u_uid;
        // echo $en_zid;die;
		$result=$this->buildHtml($str.'.html','./'.$u_uid.'/'.$en_zid.'/','');

        //var_dump($result);
        $this->display();
        //return $result;

	}


	


}