<?php
namespace Admin\Controller;
use Think\Controller;
class VerifyController extends Controller {

	public function verify(){
        $w =  90;
        $h =  40;
        //session('nima99','gaolianji');
        $verify=new \Think\Verify();
        $verify->useCurve=false;
        $verify->useNoise=false;
        $verify->useLine=true;
        $verify->fontSize=15;
        $verify->fontttf='4.ttf';
        $verify->length=4;
        $verify->imageW=$w;
        $verify->imageH=$h;
        $verify->entry();

    }

    


}