<?php
namespace Admin\Controller;
use Think\Controller;

/*
**批量更新
*/
class BatchController extends CommonController {

	public $vip_url='http://fenxiang.vip.17zwd.com';


	public function index(){

		

		$uid=$this->cookieUid;

		$limit=I('get.limit',12);
		if($limit=='all'){
			$limit=0;
		}

		if($limit>=48){
			$limit=48;
		}else if($limit>=36){
			$limit=36;
		}else if($limit>=24){
			$limit=24;
		}else if($limit>0){
			$limit=12;
		}


		


		//分页 
		$page=I('get.page',1);
		$page_num=$page;
		
		//$limit=6;
		$start=($page-1)*$limit;

		$list_arr=D('Fenxiang')->batch_list($uid,$start,$limit);
		//var_dump($list_arr);die;

		$list=$list_arr[1];
		$count=$list_arr[0];
		$page=page_batch($page,$count,$limit,3);
		if($limit=='all'){
			$page='';
		}

		$page_all_num=ceil($count/$limit);

		switch ($limit) {
			case '12':
				$num_str='每页12个宝贝';
				break;
			case '24':
				$num_str='每页24个宝贝';
				break;
			case '36':
				$num_str='每页36个宝贝';
				break;
			case '48':
				$num_str='每页48个宝贝';
				break;
			
			default:
				$num_str='显示全部';
				break;
		}

		//////////////////////////////////////////////////////////
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

		//////////////////////////////////////////////////

		$this->assign('num_str',$num_str);
		$this->assign('limit',$limit);
		$this->assign('page_all_num',$page_all_num);
		$this->assign('page_num',$page_num);
		$this->assign('list',$list);
		$this->assign('count',$count);
		$this->assign('page',$page);
		$this->display();
	}

	public function batch_update(){


		/*$arr=I('post.select_goods');
		var_dump($arr);
		$arr2=I('post.select_field');
		var_dump($arr2);
		die;*/
		
		$json_arr=array();


		$success_num=0;
		$failed_num=0;
		
		$now_time=time();

		

		if(session('updated_time')!=null){

			$session_time=session('updated_time');

			$permit_time=$now_time-$session_time;

			if($permit_time>60){
				$json_arr['permited']='1';
			}else{
				$json_arr['permited']='0';

				$get_json=json_encode($json_arr);
				echo $get_json;
				exit;
			}

		}




		$uid=$this->cookieUid;

		$template=D('Template')->user($uid);

		//$all_list=D('Fenxiang')->all_update($uid);

		$select_goods=I('post.select_goods');

		$field_arr=I('post.select_field');

		//$select_goods=array('1','2');

		//var_dump($select_goods);//die;
		//var_dump($field_arr);

		foreach($select_goods as $v){
			//echo $uid.'<br/>';
			//echo $v;
			//die;

			$list_arr=D('Fenxiang')->select_update($uid,$v);
			//var_dump($list_arr);
			//$list=D('Fenxiang')->all_update($uid);
			$id=$list_arr['id'];
			$zid=$list_arr['zid'];
			$gid=$list_arr['gid'];

			//echo $id.'<br/>';
			//echo $zid.'<br/>';
			//echo $gid.'<br/>';

			//var_dump($list_arr);

			//die;


			$main_img_exist=in_array('api_main_img',$field_arr);
			$title_exist=in_array('title',$field_arr);
			$price_exist=in_array('price',$field_arr);

			////////////////////主图更新//////////////////////////////////////////////



			if($main_img_exist||$title_exist||$price_exist){



				$url='http://api2.17zwd.com/rest/goods/get_item/?from=web&zdid='.$zid.'&goods_id='.$gid;

				$data=file_get_contents($url);

				if($data){
		            $data=json_decode($data,true);
		        }

		    

		        $tb_img=$data['goods_item_get_response']['item']['tb_imgs'];

		        //var_dump($tb_img);
		        
		        $data_db['api_main_img']=$tb_img;

	    	

			/////////////////////价格，标题更新///////////////////////////

	    	

		        $title2=$data['goods_item_get_response']['item']['title'];
	            $price2=$data['goods_item_get_response']['item']['price2'];//拿货价

	            $title=$template['title_before'].$title2.$template['title_after'];

	            $profit=$template['profit'];
	            $add_price=$template['add_price'];

	            $price=(float)$price2*$profit*0.01+$add_price;
	            $price=round($price,2);

	            //var_dump($price);die;

	            $data_db['title']=$title;
	            $data_db['price']=$price;

	            //var_dump($data_db);die;
	        }
        	
			/////////////详情图更新////////////////////////////////////////////////////
			
			if(in_array('api_xiangqing_img', $field_arr)){
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
	    	}
	        
	        /////////////////////////////////////////////////////////////////////////////////

	        $data_db['modified_time']=time();

	        

			$data_db['qq']=$template['qq'];

			$data_db['phone']=$template['phone'];
			
			
			$data_db['wangwang']=$template['wangwang'];
			
			
			$data_db['weichat']=$template['weichat'];
			
			
			$data_db['content']=$template['content'];
			
			if(in_array('qq',$field_arr)){
				array_push($field_arr,'phone','wangwang','weichat');
			}

			
			//var_dump($field_arr);

			//echo $data['detail_img'];die;
			//var_dump($v['id']);
			//$res=D('Fenxiang')->where('id='.$v['id'])->data($data_db)->save();


			$res=D('Fenxiang')->where('id='.$id)->field($field)->save($data_db);
			//var_dump($res);die;

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

				$failed_id=$id.','.$failed_id;
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