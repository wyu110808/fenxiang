<?php 
namespace Home\Model;
use Think\Model;
class MorenyeModel extends Model{

	public function read1($gid,$en_zid){
		
		$res=$this->where(array('gid'=>$gid,'en_zid'=>$en_zid))->find();
		return $res;

	}




}