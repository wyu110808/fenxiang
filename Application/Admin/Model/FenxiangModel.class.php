<?php 
namespace Admin\Model;
use Think\Model;
class FenxiangModel extends Model{

	protected $_validate=array(
			array('title','require','请填入标题'),
			array('price','require','请填入价格'),
			
			array('phone','require','请填入手机号'),
			array('phone','11','手机号长度不正确',0,'length'),
		);


	public function read($uid,$zid,$gid){
		$res=$this->where(array('uid'=>$uid,'zid'=>$zid,'gid'=>$gid))->find();
		return $res;

	}

	public function read2($uid,$id){
		$res=$this->where(array('uid'=>$uid,'id'=>$id))->find();
		return $res;
	}

	public function read3($id){
		$res=$this->where(array('id'=>$id))->find();
		return $res;
	}

	

	//批量更新列表
	public function batch_list($uid,$size,$limit){

		$count=$this->where(array('uid'=>$uid))->count();
		$res= $this->where(array('uid'=>$uid))->order('modified_time asc,status desc')->limit($size.','.$limit)->select();
		$arr=array($count,$res);
		return $arr;
	}
	

	//执行删除
	public function del($uid,$id){
		$res=$this->where(array('uid'=>$uid,'id'=>$id))->delete();
		return $res;
	}

	//查询用户的更新频率
	public function user2($uid,$time){
		$where1['uid']=$uid;
		$where['modified_time']=array('gt',$time);
		$res=$this->where($where1)->where($where)->select();
		return $res;
	}

	//查询点击量
	public function view_num($uid,$zid,$gid){
		$res=$this->field('id,view_a,view_b')->where(array('uid'=>$uid,'zid'=>$zid,'gid'=>$gid))->find();
		return $res;
	}

	//查询用户所有待更新的数据
	public function all_update($uid){
		$res=$this->where(array('uid'=>$uid))->select();
		return $res;
	}

	//查询用户所有待更新的数据,新增传入站点id
	public function all_update2($uid,$zid){
		$res=$this->where(array('uid'=>$uid,'zid'=>$zid))->select();
		return $res;
	}

	
	//列表页搜索
	public function search($uid,$keyword,$status,$date_ord,$price_ord,$size,$limit){

		$where['uid']=$uid;
		if(!empty($keyword)){
			$where['title']=array('like','%'.$keyword.'%');
		}
		if($status!=2){
			$where['status']=$status;
		}
		

		if(!empty($date_ord)){
			$ord_str=$date_ord;
			
		}
		if(!empty($price_ord)){
			$ord_str=$price_ord;
		}
		
		if($ord_str==null){
			$ord_str='status desc,modified_time desc';
		}

		$count=$this->where($where)->count();
		$res=$this->where($where)->order($ord_str)->limit($size.','.$limit)->select();
		$arr=array($count,$res);
		return $arr;

	}

	//根据uid和gid来获得数据,批量更新
	public function select_update($uid,$gid){
		$res=$this->where(array('uid'=>$uid,'gid'=>$gid))->find();
		return $res;
	}
}