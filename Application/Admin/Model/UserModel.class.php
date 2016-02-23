<?php 
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{

	protected $_validate=array(
		array('name','','昵称已经存在！',0,'unique',1),
		
		);

	public function read($name){
		
		$res=$this->where(array('name'=>$name))->select();
		
		return $res;
	}

	public function read1($uid,$name){
		$res=$this->where(array('uid'=>$uid,'name'=>$name))->find();

		return $res;
	}


	public function read2($uid){
		$res=$this->where(array('uid'=>$uid))->find();
		return $res;
	}


}