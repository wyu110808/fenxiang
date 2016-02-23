<?php 
namespace Admin\Model;
use Think\Model;
class TemplateModel extends Model{

	protected $_validate=array(
			//array('title','require','请填入标题'),
			array('price','require','请填入价格'),
			array('profit','require','请填入利率'),
			array('add_price','require','请填入修正价'),
			array('phone','require','请填入手机号'),
			array('phone','11','手机号长度不正确',0,'length'),
		);

	public function user($uid){

		$res=$this->where(array('uid'=>$uid))->find();
		return $res;

	}

	
}