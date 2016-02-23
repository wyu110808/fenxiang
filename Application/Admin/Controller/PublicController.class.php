<?php 
namespace Admin\Controller;
use Think\Controller;
class PublicController extends Controller {

	public function top(){

		if(!file_exists('./public/top.html')){
			//echo '1';die;
			$top=file_get_contents('http://common.17zwd.com/common3/very_top.aspx');        
	            $this->assign('top',$top);
	            $this->buildHtml('top.html','./public/','');
				$this->display();
		        
		}else{
        
			$last_time=filemtime('./public/top.html');
			//echo $last_time;die;
			if($last_time+3600>time()){
				$top=file_get_contents('./public/top.html');
				//echo $top;
				//die;
				$this->assign('top',$top);
				$this->display();
				
			}else{

		        $top=file_get_contents('http://common.17zwd.com/common3/very_top.aspx');
		        //echo $top;die;
		        if($top!=''){

		            $this->assign('top',$top);
		            $this->buildHtml('top.html','./public/','');
					$this->display();
		        }else{

		            $top=file_get_contents('./public/top.html');
		            $this->assign('top',$top);
		        }

	       }
   		}
    }


    public function footer(){

    	if(!file_exists('./public/footer.html')){
			$footer=file_get_contents('http://common.17zwd.com/common3/footer.aspx');        
	            $this->assign('footer',$footer);
	            $this->buildHtml('footer.html','./public/','');
				$this->display();
		        
		}else{
        
			$last_time=filemtime('./public/footer.html');
			if($last_time+3600>time()){
				$footer=file_get_contents('./public/footer.html');
				//echo $footer;
				//die;
				$this->assign('footer',$footer);
				$this->display();
				
			}else{

		        $footer=file_get_contents('http://common.17zwd.com/common3/footer.aspx');
		        if($footer!=''){

		            $this->assign('footer',$footer);
		            $this->buildHtml('footer.html','./public/','');
					$this->display();
		        }else{

		            $footer=file_get_contents('./public/footer.html');
		            $this->assign('footer',$footer);
		        }

	       }
   		}
    }


}