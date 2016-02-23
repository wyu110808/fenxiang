<?php 
namespace Home\Model;
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

	public function user_test($uid,$size,$limit){

		$count=$this->where(array('uid'=>$uid))->count();
		$res= $this->where(array('uid'=>$uid))->order('status desc,modified_time desc')->limit($size.','.$limit)->select();
		$arr=array($count,$res);
		return $arr;
	}
	
	public function user($uid){

		$count=$this->where(array('uid'=>$uid))->count();
		$Page = new \Think\Page($count,6);
		$show = $Page->show();
		$res= $this->where(array('uid'=>$uid))->order('status desc,modified_time desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$arr=array($show,$res,$count);
		return $arr;
	}

	public function del($uid,$id){
		$res=$this->where(array('uid'=>$uid,'id'=>$id))->delete();
		return $res;
	}

	public function user2($uid,$time){
		$where1['uid']=$uid;
		$where['modified_time']=array('gt',$time);
		$res=$this->where($where1)->where($where)->select();
		return $res;
	}

	public function view_num($uid,$zid,$gid){
		$res=$this->field('id,view_a,view_b')->where(array('uid'=>$uid,'zid'=>$zid,'gid'=>$gid))->find();
		return $res;
	}

	public function view_num2($id){
		$res=$this->field('id,view_a,view_b')->where(array('id'=>$id))->find();
		return $res;
	}
}