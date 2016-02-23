<?php
namespace Home\Controller;
use Think\Controller;
class AdvController extends Controller {

	public function index(){

		$json_arr=array();

		$json_arr['url']='/static/Home/images/17.jpg';
		$json_arr['href']='http://m.17zwd.com/app/';

		$json=json_encode($json_arr);

		echo $json;
	}

}