<?php
namespace Admin\Controller;
use Think\Controller;

class ListController extends CommonController {

	//public $cookieUid;

	public $runtime1;//监测点

	public $runtime5;//监测点

	public $runtime6;//监测点

	public $vip_url='http://fenxiang.vip.17zwd.com';//URL变量

	
	/*
	**列表页的数据输出
	*/
	public function index(){

		//编辑页编辑完成后跳至此页获取session，判断后弹出js消息提示
		////////////////////////////////////////////////////////////////////
		if(session('do')!=null){
			if(session('do')=='update'){
				//$do='update';
				$do_title=session('do_title');
				$do_res='更新成功,本次更新的商品是"<span class="tipText-site">'.$do_title.'</span>",更新完成需要20分钟。';
				$this->assign('do_res',$do_res);
			}
			if(session('do')=='add'){
				//$do='add';
				$do_title=session('do_title');
				$do_res='发布成功,本次发布的商品是"<span class="tipText-site">'.$do_title.'</span>"。';
				$this->assign('do_res',$do_res);
			}
		}else{
			//$do='n';
			//$do_title='n';
			$do_res='n';
			$this->assign('do_res',$do_res);
		}
		session('do',null);
		session('do_title',null);

		//////////////////////////////////////////////////////////////////////////

		$uid=$this->cookieUid;
		//echo '儿子的：'.$uid;die;
		/////////////////////////////////////////////////////////////////
    	//第二个监控点开始计时
    	$time_start2 = microtime();
    	///////////////////////////////////////////////////////////////

    	
		//var_dump($status);

		$date_ord=I('get.date_ord');
		if($date_ord=='desc'){
			$date_ord='modified_time desc';
			$sel_date_ord='按时间从高到低';
		}
		else if($date_ord=='asc'){
			$date_ord='modified_time asc';
			$sel_date_ord='按时间从低到高';
		}


		$price_ord=I('get.price_ord');
		if($price_ord=='desc'){
			$price_ord='price desc';
			$sel_price_ord='按价格从高到低';
		}
		else if($price_ord=='asc'){
			$price_ord='price asc';
			$sel_price_ord='按价格从低到高';
		}


		$keyword=I('post.keyword_val',null);
    	
   	
    	if($keyword==null){
    		$keyword=I('get.keyword');
    		//var_dump($keyword);
    	}
    	//die;
    	$this->assign('keyword',$keyword);
    	

		$status=I('post.status');
		if($status==null){
			$status=I('get.status');
		}
		
		

		if($status==null){
			$status=session('status');
			//var_dump($status);die;
			if($status==null){
				$status=2;
			}
			$status_str='?status='.$status;
			$this->assign('status',$status);
		}else{
			
			$status_str='?status='.$status;
			session('status',$status);
			$this->assign('status',$status);
		}


		
		$begin='y';

		if($keyword!=null){
			$begin='n';
			$keyword_str='&keyword='.$keyword;
		}

		$this->assign('keyword_str',$keyword_str);
		$this->assign('status_str',$status_str);

		$color='normal';
		if($date_ord!=null){
			$begin='n';
			$color='date';
		}else{
			$sel_date_ord='时间';
		}

		if($price_ord!=null){
			$begin='n';
			$color='price';
		}else{
			$sel_price_ord='价格';
		}

		$this->assign('begin',$begin);
		$this->assign('color',$color);
		$this->assign('sel_date_ord',$sel_date_ord);
		$this->assign('sel_price_ord',$sel_price_ord);

    	//分页 
		if(isset($_GET['page'])){

			$page=$_GET['page']+0;
		}
		else{$page=1;}
		$limit=6;
		$start=($page-1)*$limit;

		if($keyword!=null){
			$start='';
			$limit='';			
    	}
		

		$list_test=D('Fenxiang')->search($uid,$keyword,$status,$date_ord,$price_ord,$start,$limit);
		
		//echo $status;
		//var_dump($list_test);die;
		$count=$list_test[0];

		$page=page($page,$count,$limit,5);
		$list=$list_test[1];

		if($keyword!=null){			
			$page='';
    	}


		//$list_arr=D('Fenxiang')->user($uid);
		//$list=$list_arr[1];
		//var_dump($list_arr);die;
		 ////////////////////////////////////////////////////////////////////
        //第二个监控点结束计时
		$time_end2 = microtime();
		$runtime2 = $time_end2 - $time_start2;
		//echo '<script type="text/javascript">console.log("查询数据库时间:'.$runtime2.'");</script>';
        ///////////////////////////////////////////////////////////////////

        
        foreach($list as $k=>$v){
        	$main_img=$v['main_img'];
        	$main_arr=explode(',',$main_img);
        	$main_one=$main_arr[0];
        	$list[$k]['main_img']=$main_one;
    	}

    	//var_dump($list);die;

		foreach($list as $k=>$v){
			$zid=$v['zid'];
			$gid=$v['gid'];
			
			
	        
	        $id=$v['id'];
	        //对id进行加密：
	        $en_id=urlencode(base64_encode($id));
	        //var_dump($en_id);

	        

	        $list[$k]['en_id']=$en_id;



	        $list2=D('Fenxiang')->read2($uid,$id);

	       

			$url2 = 'http://fenxiang.17vdian.com/';
			$url2 .= 'u';
			$url2 .= $list2['uid'];
			$url2 .= '/';
			$url2 .= $list2['en_zid'];
			$url2 .= '/';
			$url2 .= $list2['id'];
			$url2 .= '-';
			$url2 .= $list2['gid'];
			$url2 .= '.html';

			//echo $url2;
			$list[$k]['url']=$url2;
		}
		


		//var_dump($list);
		//'/'.$uid.'/'.$zid.'/'.$id.'-'.$gid
		//uid/zid/id-gid
		
		$this->assign('list',$list);
		$this->assign('page',$page);
		$this->display();

	}

	/*
	**输出二维码，并生成静态二维码
	**id:数据id
	*/
	public function qrcode($id,$level=3,$size=10){

		
        $id=base64_decode(urldecode($id));
        
		
		$uid=$this->cookieUid;
		//$url=__URL__;
		$list=D('Fenxiang')->read2($uid,$id);
		$url = 'http://fenxiang.17vdian.com/';
		$url .= 'u';
		$url .= $list['uid'];
		$url .= '/';
		$url .= $list['en_zid'];
		$url .= '/';
		$url .= $list['id'];
		$url .= '-';
		$url .= $list['gid'];
		$url .= '.html';

		//老的二维码生成
		/*Vendor('phpqrcode.phpqrcode');
		$errorCorrectionLevel=intval($level);
		$matrixPointSize=intval($size);
		$object=new \QRcode();
		$object->png($url,false,$errorCorrectionLevel,$matrixPointSize,2);*/


		// localhost/u232/gz/1-23423.
		// var_dump($list);
		//echo $url;
		// exit();
		$qrcode_url='qrcode/u'.$list['uid'].'/'.$list['en_zid'].'_'.$list['gid'].'.png';
		$exist=file_exists($qrcode_url);

		echo $exist;
		if($exist){
			$img_url='http://fenxiang.vip.17zwd.com/'.$qrcode_url;

			header('Location:'.$img_url);

		}else{
		
		Vendor('phpqrcode.phpqrcode');
		$errorCorrectionLevel=intval($level);
		$matrixPointSize=intval($size);
		$object=new \QRcode();
		mkdir('qrcode/u'.$list['uid']);
		$filename='qrcode/u'.$list['uid'].'/'.$list['en_zid'].'_'.$list['gid'].'.png';
		//echo $filename;die;
		$object->png($url,$filename,$errorCorrectionLevel,$matrixPointSize,2,true);//保存二维码
		$object->png($url,false,$errorCorrectionLevel,$matrixPointSize,2,false);//显示二维码
		}

		//return $url;
	}


	/*
	**上下架操作
	*/
	public function shangjia(){

		$uid=$this->cookieUid;

		$url_return=$_SERVER['HTTP_REFERER'];

		session('now',time());
		$time=session('now')-session('modified_time');
		if($time<30){
			//echo '<script type="text/javascript">alert("反复上架太累人，请稍后30s再来~~");location="'.$this->vip_url.'/diylist.do";</script>';
			
			$json_arr['do_text']='反复上架太累人，请稍后30s再来~~';
            $json_arr['do_url']=$url_return;
            //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
            $my_json=json_encode($json_arr);
            echo $my_json;

			exit();
			//$this->error('请稍后30s再来~~');
		}

		$en_id=I('post.id',0);
        //echo $en_id;
        if($en_id){
            //对id进行解密：
            $id=base64_decode(urldecode($en_id));
            //var_dump($id);
        }else{
            $id=0;
        }


		$data=D('Fenxiang');
		$shang=D('Fenxiang')->read2($uid,$id);
		$status=$shang['status'];
		if($status=='1'){
			$shang['status']='0';

			$res=$data->where(array('id'=>$id))->save($shang);
			if($res){
			
				session('modified_time',time());


				//生成静态Html:
				$zid=$shang['en_zid'];
				$gid=$shang['id'].'-'.$shang['gid'];

				



				$url=$this->vip_url.'/generate?zdid='.$zid.'&goods_id='.$gid;
                //echo $url;die;
                $agent = 'Mozilla/5.0(XiaoBaWang6.3;WOW64;rv:39.0)Gecko/20100101Iphone/39.0';
                $check_logins_value= 'Cookie_ulogin='.$_COOKIE['Cookie_ulogin'];
                //echo $check_logins_value;die;


                /////////////////////////////////////////////////////////////////
		    	//第三个监控点开始计时
		    	//$time_start3 = microtime();
		    	///////////////////////////////////////////////////////////////


                $cha = curl_init();
                curl_setopt($cha, CURLOPT_URL, $url);
                curl_setopt($cha,CURLOPT_USERAGENT,$agent);
                curl_setopt($cha, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($cha, CURLOPT_COOKIE, $check_logins_value);
                $result2 = curl_exec($cha);
                //var_dump($result2);die;
                curl_close($cha);


                ////////////////////////////////////////////////////////////////////
		        //第三个监控点结束计时
				//$time_end3 = microtime();
				//$runtime3 = $time_end3 - $time_start3;
				//echo '<script type="text/javascript">console.log("获得静态html时间:'.$runtime3.'");</script>';
		        ///////////////////////////////////////////////////////////////////




				//echo '<script type="text/javascript">alert("成功改为下架");location="'.$this->vip_url.'/diylist.do";</script>';
				//echo '<!--<ul>asdfdads</ul>-->';
                $json_arr['do_text']='成功改为下架';
            	$json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
            	//$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
            	$my_json=json_encode($json_arr);
            	echo $my_json;


				exit();
			}else{
				//echo '<script type="text/javascript">alert("报错了，改不了下架");location="'.$this->vip_url.'/diylist.do";</script>';
				//$error_report=error_reporting(-1);
				logError("列表页的id为".$id."的数据下架失败,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
				$json_arr['do_text']='报错了，改不了下架，请稍候重试';
            	$json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
            	//$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
            	$my_json=json_encode($json_arr);
            	echo $my_json;
				exit();
			}
		}
		if($status=='0'){
			$shang['status']='1';
			$res=$data->where(array('id'=>$id))->save($shang);
			if($res){
				session('modified_time',time());

				//生成静态Html:
				$zid=$shang['en_zid'];
				$gid=$shang['id'].'-'.$shang['gid'];
				$url=$this->vip_url.'/generate?zdid='.$zid.'&goods_id='.$gid;
                //echo $url;die;
                $agent = 'Mozilla/5.0(XiaoBaWang6.3;WOW64;rv:39.0)Gecko/20100101Iphone/39.0';
                $check_logins_value= 'Cookie_ulogin='.$_COOKIE['Cookie_ulogin'];
                //echo $check_logins_value;die;


                /////////////////////////////////////////////////////////////////
		    	//第四个监控点开始计时
		    	//$time_start4 = microtime();
		    	///////////////////////////////////////////////////////////////


                $cha = curl_init();
                curl_setopt($cha, CURLOPT_URL, $url);
                curl_setopt($cha,CURLOPT_USERAGENT,$agent);
                curl_setopt($cha, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($cha, CURLOPT_COOKIE, $check_logins_value);
                $result2 = curl_exec($cha);
                //var_dump($result2);die;
                curl_close($cha);

                ////////////////////////////////////////////////////////////////////
		        //第四个监控点结束计时
				//$time_end4 = microtime();
				//$runtime4 = $time_end4 - $time_start4;
				//echo '<script type="text/javascript">console.log("获得静态html时间:'.$runtime4.'");</script>';
		        ///////////////////////////////////////////////////////////////////

				//echo '<script type="text/javascript">alert("成功改为上架");location="'.$this->vip_url.'/diylist.do";</script>';
				$json_arr['do_text']='成功改为上架';
            	$json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
            	$my_json=json_encode($json_arr);
            	echo $my_json;
				exit();
				
			}else{
				//echo '<script type="text/javascript">alert("报错了,改不了上架");location="'.$this->vip_url.'/diylist.do";</script>';
				logError("列表页的id为".$id."的数据上架失败,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
				$json_arr['do_text']='报错了，改不了上架，请稍候重试';
            	$json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
            	//$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
            	$my_json=json_encode($json_arr);
            	echo $my_json;
				

				exit();
				//$this->error('无法改为上架');
			}
		}
		//var_dump($shang);die;

	}

	/*
	**删除操作
	*/
	public function shanchu(){

		$uid=$this->cookieUid;
		//echo $uid;
		$u_uid='u'.$uid;
		$en_id=I('post.id',0);
        //echo $en_id;die;
        if($en_id){
            //对id进行解密：
            $id=base64_decode(urldecode($en_id));
            //var_dump($id);
        }else{
            $id=0;
        }
        //$id=48;
        $del_info=D('Fenxiang')->read2($uid,$id);
        $en_zid=$del_info['en_zid'];
        $gid=$del_info['gid'];
		$url=$u_uid.'/'.$en_zid.'/'.$id.'-'.$gid.'.html';
		//echo $url;die;
		$del=D('Fenxiang')->del($uid,$id);
		if($del){

			@unlink($url);
			//echo '<script type="text/javascript">alert("删除成功");location="'.$this->vip_url.'/diylist.do";</script>';
			 //弹出层提示
            $json_arr['do_text']='删除成功';
            $json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
            //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
            $my_json=json_encode($json_arr);
            echo $my_json;
			//header('Location:'.$_SERVER['HTTP_REFERER'].'');
			//$this->success('删除成功');
			exit();

		}else{
			//echo '<script type="text/javascript">alert("删除失败");location="'.$this->vip_url.'/diylist.do";</script>';

			logError("列表页的id为".$id."的数据删除失败,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
			//弹出层提示
            $json_arr['do_text']='删除失败';
            $json_arr['do_url']='http://fenxiang.vip.17zwd.com/diylist.do';
            //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
            $my_json=json_encode($json_arr);
            echo $my_json;
			//header('Location:'.$_SERVER['HTTP_REFERER'].'');
			//$this->error('删除失败');
			exit();
		}
	
	}

	//左侧ajax图接口
	public function jiekou(){

		$zid=I('get.zid');

		$gid=I('get.gid');

		//接口1：
		$url='http://api2.17zwd.com/rest/goods/get_item/?from=web&zdid='.$zid.'&goods_id='.$gid;
        //echo $url;

	////////////////////////////////////////////////////////////////////
		//第五个监控点开始计时
		$time_start5 = microtime();
	//////////////////////////////////////////////////////////////////


        $data = file_get_contents($url);



    ////////////////////////////////////////////////////////////////////
		//第五个监控点结束计时
		$time_end5 = microtime();
		$this->runtime5 = $time_end5 - $time_start5;
		//echo '<script type="text/javascript">console.log("获得接口get_item时间:'.$runtime5.'");</script>';
	///////////////////////////////////////////////////////////////////


        if($data){
            $data = json_decode($data,true);
            //var_dump($data);die;
        }else{
            exit;
        }

        $shop_id=$data['goods_item_get_response']['item']['shop_id'];
        $title2=$data['goods_item_get_response']['item']['title'];
        $price2=$data['goods_item_get_response']['item']['price2'];//拿货价
        //$tb_num_iid=$data['goods_item_get_response']['item']['tb_num_iid'];
        $tb_img=$data['goods_item_get_response']['item']['tb_img'];
        $status=$data['goods_item_get_response']['item']['status'];
        $status_code=$data['status_code'];
        //echo $status;
        if($status_code=='200'){
	        //接口3：
	        $url3='http://api2.17zwd.com/rest/shop/get_shop/?from=web&zdid='.$zid.'&shop_id='.$shop_id;

	    ////////////////////////////////////////////////////////////////////
		//第六个监控点开始计时
		$time_start6 = microtime();
		//////////////////////////////////////////////////////////////////


	        $data3=file_get_contents($url3);

	    ////////////////////////////////////////////////////////////////////
		//第六个监控点结束计时
		$time_end6 = microtime();
		$this->runtime6 = $time_end6 - $time_start6;
		//echo '<script type="text/javascript">console.log("获得接口get_shop时间:'.$runtime6.'");</script>';
		///////////////////////////////////////////////////////////////////    


	        if($data3){
	        	$data3=json_decode($data3,true);
	    	}
	        //var_dump($data3);die;
	        $item=$data3['shop_item_get_response']['item'];
	        //$status2=$data3['status_code'];//备用

	        $site_id=$item['site_id'];
	        switch ($site_id) {
	            case '42':
	                # code...
	               
	                $name='广州';
	                break;
	            case '43':
	                # code...
	                
	                $name='杭州';
	                break;
	            case '48':
	                # code...
	                
	                $name='潮汕';
	                break;
	            case '54':
	                # code...
	                
	                $name='揭阳';
	                break;
	            case '53':
	                # code...
	                
	                $name='深圳';
	                break;
	            case '46':
	                # code...
	                
	                $name='株洲';
	                break;
	            case '47':
	                # code...
	               
	                $name='郑州';
	                break;
	            case '52':
	                # code...
	                
	                $name='新塘';
	                break;
	            case '45':
	                # code...
	                
	                $name='北京';
	                break;
	            case '50':
	                # code...
	                
	                $name='东莞';
	                break;
	            
	            default:
	                $name='';
	                break;
	        }






	        //var_dump($item);die;
	        $qq=$item['qq'];
	        $phone=$item['phone'];
	        $wangwang=$item['tb_nick'];
	        $discount=$item['discount'];

	        $address=$name.'-'.$item['market'].'-'.$item['floor'].'-'.$item['dangkou'];



	        //制作出json数组：
	        $json_array=array();
	        $json_array['gid']=$gid;
	        $json_array['tb_img']=$tb_img;
	        $json_array['title']=$title2;
	        $json_array['price']=$price2;
	        $json_array['qq']=$qq;
	        $json_array['phone']=$phone;
	        $json_array['wangwang']=$wangwang;
	        $json_array['discount']=$discount;
	        $json_array['address']=$address;
	        $json_array['status']=$status;
	        $json_array['status_code']=$status_code;
	        //var_dump($json_array);

	        $json=json_encode($json_array);
	        //var_dump($json);
	        echo $json;

    	}
    	else{
    		$json_array=array();
    		$json_array['status_code']=$status_code;
    		$json=json_encode($json_array);
	        //var_dump($json);
	        echo $json;
    	}



	}

	/*
	**一键全部更新
	*/
	public function all_update(){

		$json_arr=array();
		$success_num=0;
		$failed_num=0;
		
		$now_time=time();

		

		if(session('updated_time')!=null){

			$session_time=session('updated_time');

			$permit_time=$now_time-$session_time;

			if($permit_time>3600){
				$json_arr['permited']='1';
			}else{
				$json_arr['permited']='0';

				$get_json=json_encode($json_arr);
				echo $get_json;
				exit;
			}

		}

		$uid=$this->cookieUid;
		//$uid=277584;

		$template=D('Template')->user($uid);
		//var_dump($template);die;

		$all_list=D('Fenxiang')->all_update($uid);
		//var_dump($uid);
		//var_dump($all_list);die;

		///////////////////////////////////////////////////////////////////////////////

		

        foreach($all_list as $k=>$v){
			//var_dump($v);die;
			//empty($value);
        	//$v=D('Fenxiang')->create();
        	$id=$v['id'];

			$zid=$v['zid'];

			$gid=$v['gid'];

			////////////////////主图更新//////////////////////////////////////////////

			$url='http://api2.17zwd.com/rest/goods/get_item/?from=web&zdid='.$zid.'&goods_id='.$gid;

			$data=file_get_contents($url);

			if($data){
	            $data=json_decode($data,true);
	        }

	        $tb_img=$data['goods_item_get_response']['item']['tb_imgs'];

	        //var_dump($tb_img);
	        
	        $data_db['api_main_img']=$tb_img;



			////////////////////////////////////////////////////////////////


			/////////////详情图更新////////////////////////////////////////////////////
			
			$url2='http://api2.17zwd.com/rest/goods/get_item_imgs/?from=web&zdid='.$zid.'&goods_id='.$gid;

			$data2=file_get_contents($url2);

			if($data2){
	            $data2=json_decode($data2,true);
	        }

	        $img=$data2['goods_item_get_response']['imgs'];

	        //var_dump($img);
	        $json='';
	        foreach($img as $vv){
	            
	            $json=$json.'{"img":"'.$vv.'"},';
	        }

	        $json=substr($json,0,-1);
	       // echo $json;
	        $json2='['.$json.']';
	        //$json2="sdfsd";

	        
	        if(!empty($img)){
	        	$data_db['api_xiangqing_img']=$json2;
	        }
	        
	        /////////////////////////////////////////////////////////////////////////////////
			
	        $data_db['modified_time']=time();

			$data_db['qq']=$template['qq'];
			
			
			$data_db['wangwang']=$template['wangwang'];
			
			
			$data_db['weichat']=$template['weichat'];
			
			
			$data_db['content']=$template['content'];
			
			

			//var_dump($data_db);


			//echo $data_db['detail_img'];die;
			//var_dump($v['id']);
			//$res=D('Fenxiang')->where('id='.$v['id'])->data($data_db)->save();
			$res=D('Fenxiang')->where('id='.$id)->save($data_db);
			//var_dump($res);
			if($res){

				$success_num++;



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


			}
			else{

				$failed_id=$failed_id.','.$id;
				//$json_arr['failed_name']=$v[];
				$failed_num++;

			}
			

		}

		$updated_time=time();
		session('updated_time',$updated_time);
		$json_arr['permited']='1';
		
		$json_arr['success_num']=$success_num;
		$json_arr['failed_num']=$failed_num;
		$json_arr['failed_id']=$failed_id;
			
		$get_json=json_encode($json_arr);
		echo $get_json;

	}

	

}