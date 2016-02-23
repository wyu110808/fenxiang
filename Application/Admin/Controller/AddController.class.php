<?php
namespace Admin\Controller;
use Think\Controller;
class AddController extends CommonController {

    //public $cookieUid;

    public $runtime1;

    public $vip_url='http://fenxiang.vip.17zwd.com';

    
    /*
    **输出编辑页的数据
    */
    public function index(){
        //var_dump($_SESSION['Cookie_ulogin']) ;die;

        //echo '<script type="text/javascript">console.log("登录17主站接口时间:'.$this->runtime1.'");</script>';

        $en_id=I('get.id',0);
        //echo $en_id;
        if($en_id){
            //对id进行解密：
            $id=base64_decode(urldecode($en_id));
            //var_dump($id);
        }else{
            $id=0;
        }


        $uid= $this->cookieUid;
        //$uid='118';
        //echo $uid;

    	$gid=I('get.goods_id',0);
    	
    	$zid=I('get.zdid',0);

        if(!$uid){
            //$uid='u23232';
            //exit('no uid');
            exit('系统君繁忙，暂时无法处理您的请求，请稍后重试。');
        }
        if(!$gid){
            //$gid='4931659;
            //exit('no gid');
            exit('系统君繁忙，暂时无法处理您的请求，请稍后重试。');

        }
        if(!$zid){
            //$zid='gz';
            //exit('no zid');
            exit('系统君繁忙，暂时无法处理您的请求，请稍后重试。');
        }


        switch ($zid) {
            case '42':
                # code...               
                
                
                $en_zid='gz';
                break;
            case '43':
                # code...
                
                
                $en_zid='hz';
                break;
            case '48':
                # code...
                
               
                $en_zid='cs';
                break;
            case '54':
                # code...
                
                
                $en_zid='jy';
                break;
            case '53':
                # code...
                
                
                $en_zid='sz';
                break;
            case '46':
                # code...
                
                
                $en_zid='zz';
                break;
            case '47':
                # code...
                
                
                $en_zid='zhengzhou';
                break;
            case '52':
                # code...
                
                
                $en_zid='xintang';
                break;
            case '45':
                # code...
                
                
                $en_zid='bj';
                break;
            case '50':
                # code...
                
                
                $en_zid='dg';
                break;
            
            default:
                $zid='0';
                $en_zid='empty';
                break;
        }

        if(!$zid){
            //$zid='gz';
            //exit('no zid');
            exit('系统君繁忙，暂时无法处理您的请求，请稍后重试。');
        }

  

        /////////////////////////////////////////////////////////////////
        //第1个监控点开始计时
        $time_start1 = microtime();
        ///////////////////////////////////////////////////////////////


        //根据uid,id查询fenxiang表，不需要接口1:
        $info2=D('Fenxiang')->read2($uid,$id);
       //var_dump($info2);
       

        if($info2==null){
            $info3=D('Fenxiang')->read($uid,$zid,$gid);
            if($info3){
                $info2=$info3;
            }
        }
         ////////////////////////////////////////////////////////////////////
        //第1个监控点结束计时
        $time_end1 = microtime();
        $runtime1 = $time_end1 - $time_start1;
        //echo '<script type="text/javascript">console.log("uid,id查询数据库时间:'.$runtime3.'");</script>';
        ///////////////////////////////////////////////////////////////////







        /////////////////////////////多次编辑////////////////////////////////////
        if($info2){
            $title=$info2['title'];

            
            $price=$info2['price'];

            $price2=$info2['origin_price'];
            //echo $price;

            $sel_tb_img=$info2['main_img'];

            

            if(preg_match('/^https:/', $sel_tb_img)){
                $sel_tb_img=str_replace('https:','',$sel_tb_img);
            }
            if(preg_match('/^http:/', $sel_tb_img)){
                $sel_tb_img=str_replace('http:','',$sel_tb_img);
            }

            $tb_img=$info2['api_main_img'];

            if($sel_tb_img==null){



                //访问接口1：///////////////////////////////////////////////////////////////////
                $url='http://api2.17zwd.com/rest/goods/get_item/?from=web&zdid='.$zid.'&goods_id='.$gid;
                //echo $url;             
                $dataa = file_get_contents($url);

                if($dataa){
                    $dataa = json_decode($dataa,true);
                }else{
                    exit;
                }

                /////////////api报错///////////////////////
                if($dataa['status_code']=='201'){
                    //exit('该商品不存在');
                    E('该商品不存在');
                    exit;
                }
                /////////////////////////////////////////////
                
                $sel_tb_img=$dataa['goods_item_get_response']['item']['tb_imgs'];//主图轮播

            }

            if($tb_img==null){



                //访问接口1：///////////////////////////////////////////////////////////////////
                $url='http://api2.17zwd.com/rest/goods/get_item/?from=web&zdid='.$zid.'&goods_id='.$gid;
                //echo $url;             
                $dataa = file_get_contents($url);

                if($dataa){
                    $dataa = json_decode($dataa,true);
                }else{
                    exit;
                }

                /////////////api报错///////////////////////
                if($dataa['status_code']=='201'){
                    //exit('该商品不存在');
                    E('该商品不存在');
                    exit;
                }
                /////////////////////////////////////////////
                
                $tb_img=$dataa['goods_item_get_response']['item']['tb_imgs'];//主图轮播

            }

            $sel_tb_img_arr=explode(',',$sel_tb_img);
            $tb_img_arr=explode(',',$tb_img);
            //var_dump($sel_tb_img_arr);        
            //var_dump($tb_img_arr);
            $diff_arr=array_diff($tb_img_arr,$sel_tb_img_arr);

            //var_dump($diff_arr);die;

            /////////////////////////////////////////////////////////////////////////////////////

            $json=$info2['api_xiangqing_img'];

            //$api_json=$info2['api_xiangqing_img'];

            if($json==null){


                $url2='http://api2.17zwd.com/rest/goods/get_item_imgs/?from=web&zdid='.$zid.'&goods_id='.$gid;
                $data2a=file_get_contents($url2);
                if($data2a){
                    $data2a=json_decode($data2a,true);
                }


                /////////////api报错///////////
                if($data2a['status_code']=='201'){
                    E('该商品不存在');
                    exit;
                }
                //////////////////////////////////////


                $img=$data2a['goods_item_get_response']['imgs'];
                $json='';
                foreach($img as $v){
                    
                    $json=$json.'{"img":"'.$v.'"},';
                }

                $json=substr($json,0,-1);
               // echo $json;
                $json='['.$json.']';

            }

            $sel_json=$info2['xiangqing_img'];
            if($sel_json==null){
                $sel_json='[]';
            }
            //var_dump($sel_json);
            //var_dump($json);die;

            $info2['content'] = htmlspecialchars_decode(html_entity_decode($info2['content']));


            //自动填写
            $info=D('Template')->user($uid);

            if($info2['qq']==null){
                $info2['qq']=$info['qq'];
            }
            if($info2['wangwang']==null){
                $info2['wangwang']=$info['wangwang'];
            }
            if($info2['weichat']==null){
                $info2['weichat']=$info['weichat'];
            }
            if($info2['content']==null){
                $info2['content']=htmlspecialchars_decode(html_entity_decode($info['content']));
            }
            /////////////////////////////////

            $this->assign('sel_json',$sel_json);
            $this->assign('json',$json);
            //$this->assign('api_json',$api_json);
            
            $this->assign('sel_tb_img_arr',$sel_tb_img_arr);
            $this->assign('tb_img_arr',$tb_img_arr);
            $this->assign('diff_arr',$diff_arr);

            $this->assign('title',$title);

            $this->assign('price',$price);
            $this->assign('origin_price',$price2);
            $this->assign('info',$info2);

            $first_view='n';//访问次数
            $this->assign('first_view',$first_view);


        }
        //////////////////////第一次编辑/////////////////////////////////////////////////////////////////////
        else{


            //接口2：//////////////////////////////////////////////////////////////////////////////////////////
            //$url2='https://hws.m.taobao.com/cache/mtop.wdetail.getItemDescx/4.9/?data={"item_num_id":"'.$tb_num_iid.'"}&qq-pf-to=pcqq.c2c';
            $url2='http://api2.17zwd.com/rest/goods/get_item_imgs/?from=web&zdid='.$zid.'&goods_id='.$gid;

            //echo $url2;

            /////////////////////////////////////////////////////////////////
            //第二个监控点开始计时
            $time_start2 = microtime();
            ///////////////////////////////////////////////////////////////
            
            $data2=file_get_contents($url2);
            //var_dump($data2);

             ////////////////////////////////////////////////////////////////////
            //第二个监控点结束计时
            $time_end2 = microtime();
            $runtime2 = $time_end2 - $time_start2;
            //echo '<script type="text/javascript">console.log("查询接口get_item_img时间:'.$runtime2.'");</script>';
            ///////////////////////////////////////////////////////////////////

            if($data2){
                $data2=json_decode($data2,true);
            }else{
                exit();
            }

            /////////////api报错///////////////////////
            if($data2['status_code']=='201'){
                //exit('该商品不存在');
                E('该商品不存在');
                exit;
            }
            /////////////////////////////////////////////

            $img=$data2['goods_item_get_response']['imgs'];
            $json='';
            foreach($img as $v){
                
                $json=$json.'{"img":"'.$v.'"},';
            }

            $json=substr($json,0,-1);
           // echo $json;
            $json2='['.$json.']';

            //$this->json_img=$json2;
            session('json_img',$json2);
            //var_dump($json2);

            $this->assign('json',$json2);

            $sel_json=$json2;
            $this->assign('sel_json',$sel_json);

            $diff_arr='';
            $this->assign('diff_arr',$diff_arr);
            //fenxiang表没对应的uid和id,查询template表：
            $info=D('Template')->user($uid);
            //var_dump($info);die;


            $first_view='y';//访问次数
            $this->assign('first_view',$first_view);

            //////////////////////有模板记录////////////////////////////////
            if($info){ 

                //访问接口1：///////////////////////////////////////////////////////////////////
                $url='http://api2.17zwd.com/rest/goods/get_item/?from=web&zdid='.$zid.'&goods_id='.$gid;
                //echo $url;

                /////////////////////////////////////////////////////////////////
                //第3个监控点开始计时
                $time_start3 = microtime();
                ///////////////////////////////////////////////////////////////


                $data = file_get_contents($url);

                 ////////////////////////////////////////////////////////////////////
                //第3个监控点结束计时
                $time_end3 = microtime();
                $runtime3 = $time_end3 - $time_start3;
                //echo '<script type="text/javascript">console.log("查询接口get_item时间:'.$runtime4.'");</script>';
                ///////////////////////////////////////////////////////////////////




                if($data){
                    $data = json_decode($data,true);
                }else{
                    exit;
                }

                /////////////api报错///////////////////////
                if($data['status_code']=='201'){
                    //exit('该商品不存在');
                    E('该商品不存在');
                    exit;
                }
                /////////////////////////////////////////////

                $title2=$data['goods_item_get_response']['item']['title'];
                $price2=$data['goods_item_get_response']['item']['price2'];//拿货价
                //$tb_num_iid=$data['goods_item_get_response']['item']['tb_num_iid'];


                //$tb_img=$data['goods_item_get_response']['item']['tb_img'];
                $tb_img=$data['goods_item_get_response']['item']['tb_imgs'];//主图轮播
                $tb_img_arr=explode(',',$tb_img);              
                session('api_main_img',$tb_img);
                //echo session('api_main_img');
                //var_dump($tb_img_arr);die;
                
                ///////////////////////////////////////////////////////////////////




                $title=$info['title_before'].$title2.$info['title_after'];

                $profit=$info['profit'];
                $add_price=$info['add_price'];

                $price=(float)$price2*$profit*0.01+$add_price;
                $price=round($price,2);

                // $info['content'] = htmlspecialchars_decode(($info['content']));
                 $info['content'] = htmlspecialchars_decode(html_entity_decode($info['content']));
                // echo $info['content'];
                // var_dump($info);
                
                
                $sel_tb_img_arr=null;
                $this->assign('sel_tb_img_arr',$sel_tb_img_arr);

                
                $this->assign('tb_img_arr',$tb_img_arr);
               
                $this->assign('title',$title);

                $this->assign('price',$price);
                $this->assign('origin_price',$price2);
                $this->assign('info',$info);
            }
            //////////////////无模板记录//////////////////////////////
            else{


                //访问接口1:///////////////////////////////////////////////////////////////////
                $url='http://api2.17zwd.com/rest/goods/get_item/?from=web&zdid='.$zid.'&goods_id='.$gid;
                //echo $url;

                /////////////////////////////////////////////////////////////////
                //第4个监控点开始计时
                $time_start4 = microtime();
                ///////////////////////////////////////////////////////////////


                $data = file_get_contents($url);

                 ////////////////////////////////////////////////////////////////////
                //第4个监控点结束计时
                $time_end4 = microtime();
                $runtime4 = $time_end4 - $time_start4;
                //echo '<script type="text/javascript">console.log("查询接口get_item时间:'.$runtime5.'");</script>';
                ///////////////////////////////////////////////////////////////////


                if($data){
                    $data = json_decode($data,true);
                }else{
                    exit;
                }

                /////////////api报错///////////////////////
                if($data['status_code']=='201'){
                    //exit('该商品不存在');
                    E('该商品不存在');
                    exit;
                }
                /////////////////////////////////////////////

                $title2=$data['goods_item_get_response']['item']['title'];
                $price2=$data['goods_item_get_response']['item']['price2'];//拿货价
                //$tb_num_iid=$data['goods_item_get_response']['item']['tb_num_iid'];
                //$tb_img=$data['goods_item_get_response']['item']['tb_img'];

                $tb_img=$data['goods_item_get_response']['item']['tb_imgs'];//主图轮播
                $tb_img_arr=explode(',',$tb_img);
                session('api_main_img',$tb_img);
                //$this->api_main_img=$tb_img;
                
                $price=$price2;
                


                $this->assign('price',$price);
                $this->assign('origin_price',$price2);
                

                $sel_tb_img_arr=null;
                $this->assign('sel_tb_img_arr',$sel_tb_img_arr);
                $this->assign('tb_img_arr',$tb_img_arr);
                
                $this->assign('title',$title2);



            }

        }
        
        $money=$price-$price2;
        
    	$this->assign('gid',$gid);
    	$this->assign('uid',$uid);
    	$this->assign('zid',$zid);
        $this->assign('en_zid',$en_zid);
        
        $this->assign('money',$money);
       
        //用户头像昵称
        $user_info=D('User')->read2($uid);
        $this->assign('user_info',$user_info);
        

        $this->display('Add/index');
    }


    /*
    **编辑页表单提交处理
    */
    public function update(){
        
    	//header('Content-type:text/html;charset=utf-8');
    	//$read=D('Fenxiang')->read();
    	//var_dump($read);die;
        $uid=$this->cookieUid;
        
    	$zid=I('post.zid');
        $gid=I('post.gid');


        //$u_uid='u'.$uid;
        $template=D('Template')->user($uid);
        
        $update=D('Fenxiang')->read($uid,$zid,$gid);
        //var_dump($update);die;



        /////////////////////////////////修改旧商品////////////////////////////////////////////
        if(!empty($update)){
            $data=D('Fenxiang')->create();

            
            
            //echo $this->main_img;
            $data['modified_time']=time();

            //var_dump($data);die;


            $form=D('Fenxiang');

            $id=$update['id'];
            $data['id']=$id;
            //echo $id;
            //die;
            ////////////////////////////////////////////


            $data['main_img']=I('post.main_img');

           
            $data['xiangqing_img']=$_POST['xiangqing_img'];
            

            /////////////////////////////////////////////
            //var_dump($data);die;

            if(!$form->create()){
                //exit($data->getError());
                echo '<script type="text/javascript">alert("'.$data->getError().'");window.history.go(-1);</script>';
                exit;
            }

            
            //敏感词替换
            $data['title']=filter(I('post.title'));
            $data['content']=filter(I('post.content'));



            $result=$form->where(array('id'=>$id))->save($data);
            //var_dump($result);die;

            
            if($result){
                $info3=D('Fenxiang')->read3($id);
                //var_dump($info3);die;
                $en_zid=$info3['en_zid'];
                $str=$id.'-'.$info3['gid'];
                
                
                $url=$this->vip_url.'/generate?zdid='.$en_zid.'&goods_id='.$str;
                //echo $url;die;
                $agent = 'Mozilla/5.0(XiaoBaWang6.3;WOW64;rv:39.0)Gecko/20100101Iphone/39.0';
                $check_logins_value= 'Cookie_ulogin='.$_COOKIE['Cookie_ulogin'];
                //echo $check_logins_value;die;
                $cha = curl_init();
                curl_setopt($cha, CURLOPT_URL, $url);
                curl_setopt($cha,CURLOPT_USERAGENT,$agent);
                curl_setopt($cha, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($cha, CURLOPT_COOKIE, $check_logins_value);
                $result2 = curl_exec($cha);
                //var_dump($result2);die;
                curl_close($cha);

                //echo $result2;die;
                //$updateone_url=$this->vip_url.'/updateone.do?status=update&title='.$data['title'];
                //$a=file_get_contents($updateone_url);
                session('do','update');
                session('do_title',$data['title']);

                ////////////////////////////////////////////////////////////////////////////
                //弹出层提示                
                $json_arr['do_text']='更新成功';
                $json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
                //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
                $my_json=json_encode($json_arr);
                echo $my_json;
                /////////////////////////////////////////////////////////////////////////////
            //echo '<script type="text/javascript">alert("保存成功,页面跳转中");location="'.$this->vip_url.'/diylist.do";</script>';
            }else{

                //日志记录
                logError("分享编辑页的id为".$id."的数据更新失败,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
                //弹出层提示
                $json_arr['do_text']='更新失败,请稍候再试';
                $json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
                //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
                $my_json=json_encode($json_arr);
                echo $my_json;
                
            //echo '<script type="text/javascript">alert("保存失败,页面跳转中");location="'.$this->vip_url.'/diylist.do";</script>';
            }
        }

        //////////////////////////////////////////////添加新商品////////////////////////////////////////

        else{

            $form=D('Fenxiang');

            if(!$form->create()){
                //exit($data->getError());
                echo '<script type="text/javascript">alert("'.$data->getError().'");window.history.go(-1);</script>';
            }else{
                $data=D('Fenxiang')->create();
                $data['uid']=$uid;

                /////////////////////////////////////////////////////////////////////

                $data['main_img']=I('post.main_img');

                $data['api_main_img']=session('api_main_img');
                session('api_main_img',null);
                //echo $this->api_main_img;die;
                //$data['api_main_img']=$this->api_main_img;

                $data['xiangqing_img']=$_POST['xiangqing_img'];


                $data['api_xiangqing_img']=session('json_img');
                session('json_img',null);

                ///////////////////////////////////////////////////////////////////////////

                //敏感词替换
                $data['title']=filter(I('post.title'));
                $data['content']=filter(I('post.content'));

                $data['add_time']=time();
                $data['modified_time']=$data['add_time'];

                $data['view_a']=1;
                $data['view_b']=1;

                //var_dump($data);die;
                
                
                $res=$form->data($data)->add();
        
       
        
        
                if($res){

                    $info3=D('Fenxiang')->read3($res);
                    //var_dump($info3);die;
                    $en_zid=$info3['en_zid'];
                    $str=$res.'-'.$info3['gid'];

                    /*$context['http']=array(
                    'header'=>'Cookie:'.$_COOKIE['Cookie_ulogin'],
                    );
                    $result=file_get_contents($this->vip_url.'/generate?zdid='.$zid.'&goods_id='.$gid,false,stream_context_create($context));*/
                    $url=$this->vip_url.'/generate?zdid='.$en_zid.'&goods_id='.$str;

                    $agent = 'Mozilla/5.0(XiaoBaWang6.3;WOW64;rv:39.0)Gecko/20100101Iphone/39.0';
                    $check_logins_value= 'Cookie_ulogin='.$_COOKIE['Cookie_ulogin'];
                    $cha = curl_init();
                    curl_setopt($cha, CURLOPT_URL, $url);
                    curl_setopt($cha,CURLOPT_USERAGENT,$agent);
                    curl_setopt($cha, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($cha, CURLOPT_COOKIE, $check_logins_value);
                    $result = curl_exec($cha);
                    curl_close($cha);

                    session('do','add');
                    session('do_title',$data['title']);

                    //////////////////////////////////////////////////////////////////////
                    //弹出层提示
                    $json_arr['do_text']='发布成功';
                    $json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
                    //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
                    $my_json=json_encode($json_arr);
                    echo $my_json;
                    ///////////////////////////////////////////////////////////////////////
                    //echo '<script type="text/javascript">alert("发布成功,页面跳转中");location="'.$this->vip_url.'/diylist.do";</script>';
                }else{

                    //日志记录
                    logError("分享编辑页的uid为".$uid."zid为".$zid."gid为".$gid."的商品添加失败,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
                    ////////////////////////////////////////////////////////////////////////
                    //弹出层提示
                    $json_arr['do_text']='发布失败,请稍候再试';
                    $json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
                    //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
                    $my_json=json_encode($json_arr);
                    echo $my_json;
                    //////////////////////////////////////////////////////////////////////
                    //echo '<script type="text/javascript">alert("发布失败,页面跳转中");location="'.$this->vip_url.'/diylist.do";</script>';
                }

            }    
    	
        }
     
    }

    


    
}