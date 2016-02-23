<?php 
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

    public function _initialize(){
        header('Content-type:text/html;charset=utf-8');
    }

	public function index(){

        $en_zid=I('get.zdid',0);
        $gid=I('get.goods_id',0);
        $this->assign('zdid',$en_zid);
        $this->assign('goods_id',$gid);
        if(!$en_zid){
            redirect('http://www.17zwd.com/');
            exit();
        }
         if(!$gid){
            redirect('http://www.17zwd.com/');
            exit();
        }


        switch ($en_zid) {
            case 'gz':
                # code...
                $zid='42';
                $name='广州';
                break;
            case 'hz':
                # code...
                $zid='43';
                $name='杭州';
                break;
            case 'cs':
                # code...
                $zid='48';
                $name='潮汕';
                break;
            case 'jy':
                # code...
                $zid='54';
                $name='揭阳';
                break;
            case 'sz':
                # code...
                $zid='53';
                $name='深圳';
                break;
            case 'zz':
                # code...
                $zid='46';
                $name='株洲';
                break;
            case 'zhengzhou':
                # code...
                $zid='47';
                $name='郑州';
                break;
            case 'xintang':
                # code...
                $zid='52';
                $name='新塘';
                break;
            case 'bj':
                # code...
                $zid='45';
                $name='北京';
                break;
            case 'dg':
                # code...
                $zid='50';
                $name='东莞';
                break;
            
            default:
                $zid='0';
                break;
        }

        //$zid=I('get.zdid',42);
        //$gid=I('get.goods_id',4931659);
        // http://api2.17zwd.com/rest/site/get_list/?from=web
        if(!$zid){exit();}
        $url='http://api2.17zwd.com/rest/goods/get_item/?from=web&zdid='.$zid.'&goods_id='.$gid;
        $data = file_get_contents($url);
        if($data){
            $data = json_decode($data,true);
        }else{
            echo 'error!';
        }
        


        // var_dump($data);
        $shop_id=$data['goods_item_get_response']['item']['shop_id'];
        //echo $shop_id; 13595
        $title=$data['goods_item_get_response']['item']['title'];
        $price2=$data['goods_item_get_response']['item']['price2'];
        //$tb_num_iid=$data['goods_item_get_response']['item']['tb_num_iid'];
        //$tb_img=$data['goods_item_get_response']['item']['tb_img'];
        $tb_img=$data['goods_item_get_response']['item']['tb_imgs'];//主图轮播
        $tb_img=explode(',',$tb_img);
        //var_dump($tb_img);
        //echo $price2;  tb_num_iid
        $status=$data['goods_item_get_response']['item']['status'];
        
        //$url2='https://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.9/?data={"item_num_id":"'.$tb_num_iid.'"}&qq-pf-to=pcqq.c2c';
        $url2='http://api2.17zwd.com/rest/goods/get_item_imgs/?from=web&zdid='.$zid.'&goods_id='.$gid;



        
        $data2=file_get_contents($url2);



        if($data2){
            $data2=json_decode($data2,true);
        }

        //var_dump($data2);die;
        //$img=$data2['data']['images'];

        $img=$data2['goods_item_get_response']['imgs'];

        //$content=$data2['data']['pages'][0];

        //var_dump($content);

        //var_dump($img);die;


        
          //echo '{"img": '.$rr.'}';
            //exit();

        $json='';
        foreach($img as $v){
            
            $json.='{"img":"'.$v.'"},';
        }

        


        
        
        $json=substr($json,0,-1);
       // echo $json;
        $json2='['.$json.']';






        $url3='http://api2.17zwd.com/rest/shop/get_shop/?from=web&zdid='.$zid.'&shop_id='.$shop_id;
        $data3=file_get_contents($url3);
        if($data3){
        	$data3=json_decode($data3,true);
    	}
        //var_dump($data3);die;
        $item=$data3['shop_item_get_response']['item'];
        //var_dump($item);


        $address=$name.'-'.$item['market'].'-'.$item['floor'].'-'.$item['dangkou'];
        //echo $address;
        //echo $status;die;

        $view=D('Morenye')->read1($gid,$en_zid);
        //var_dump($view);die;

        $view_a=$view['view_a'];

        //echo $view_a;die;

        $this->assign('view_a',$view_a);

        //echo $json2;
        $this->assign('title',$title);
        $this->assign('price',$price2);
        $this->assign('tb_img',$tb_img);
        $this->assign('status',$status);
        $this->assign('address',$address);
        $this->assign('item',$item);
        //$this->assign('content',$content);
        $this->assign('img',$img);
        $this->assign('json',$json2);
        $this->display('Index/index');


	}

} 