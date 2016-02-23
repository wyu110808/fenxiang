<?php
namespace Home\Controller;
use Think\Controller;

class ViewProductController extends Controller {

	public function view2(){

		$str=I('get.str');
        $pos=strpos($str,'-');
        $id=substr($str,0,$pos);
        $gid=substr($str,$pos+1);

	 	//echo 'id:'.$id.'<br/>';
	 	//echo 'gid:'.$gid;

		$json_arr=array();

		$view=D('Fenxiang')->view_num2($id);
		//var_dump($view);

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
			
			//echo $view_a;
			
			$view_b=$view['view_b']+1;
			$data['view_a']=$view_a;
			$data['view_b']=$view_b;

			$result2=D('Fenxiang')->where(array('id'=>$id))->save($data);

			//var_dump($result2);


		
		$json_arr['view']=$view['view_a'];
		//$json_arr['test']=$view_a;

		$json=json_encode($json_arr);

		echo $json;

	 }

}





