<?php
namespace Home\Controller;
use Think\Controller;

class ViewIndexController extends Controller {


	public function view(){

		$gid=I('get.goods_id');
		$en_zid=I('get.zdid');

		//echo $gid.'<br/>';
		//echo $en_zid;


		switch ($en_zid) {
            case 'gz':
                # code...
                $zid='42';
                
                break;
            case 'hz':
                # code...
                $zid='43';
                
                break;
            case 'cs':
                # code...
                $zid='48';
                
                break;
            case 'jy':
                # code...
                $zid='54';
                
                break;
            case 'sz':
                # code...
                $zid='53';
                
                break;
            case 'zz':
                # code...
                $zid='46';
                
                break;
            case 'zhengzhou':
                # code...
                $zid='47';
               
                break;
            case 'xintang':
                # code...
                $zid='52';
                
                break;
            case 'bj':
                # code...
                $zid='45';
                
                break;
            case 'dg':
                # code...
                $zid='50';
                
                break;
            
            default:
                $zid='0';
                break;
        }





		$json_arr=array();

		$view=D('Morenye')->read1($gid,$en_zid);
		//var_dump($view);
		if($view==null){
			$data['gid']=$gid;
			$data['zid']=$zid;
			$data['en_zid']=$en_zid;
			$data['view_a']=1;
			$data['view_b']=1;
			$result=D('Morenye')->data($data)->add();
		}
		if($view!=null){
			$id=$view['id'];
			$view_a=$view['view_a'];


		
			if($view_a<10){
				$view_a++;
			}else if($view_a<200){
				$view_a += rand(5,8);
			}else if($view_a<600){
				$view_a += rand(5,22);
			}else if($view_a<1600){
				$view_a += rand(1,50);
			}else {
				$view_a ++;
			}
			
			
			$view_b=$view['view_b']+1;
			$data['view_a']=$view_a;
			$data['view_b']=$view_b;
			$result2=D('Morenye')->where(array('id'=>$id))->save($data);

		}

		if($view['view_a']==null){
			$view['view_a']=1;
		}
		
		$json_arr['view']=$view['view_a'];

		$json=json_encode($json_arr);

		echo $json;
	}


	 











}