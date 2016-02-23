<?php
namespace Admin\Controller;
use Think\Controller;
class TemplateController extends CommonController {

    //public $cookieUid;

    

    /*
    **模板页的数据输出
    */
    public function index(){
       

        $url3=$_SERVER['HTTP_REFERER'];
        //echo $url3;
        session('url3',$url3);

        $uid=$this->cookieUid;
        

    	
    	$info=D('Template')->user($uid);
        ///////////////////////////////多次编辑///////////////////////
        if($info){
            $info['content'] = htmlspecialchars_decode(html_entity_decode($info['content']));
            $first_view='n';
            $this->assign('first_view',$first_view);
            $this->assign('info',$info);
           
        }
        /////////////////////////////////首次编辑//////////////////////
        else{
            //echo '<script type="text/javascript">alert("欢迎来到模板设置");</script>';
            $info['profit']='100';
            $info['add_price']='0';

            $first_view='y';
            $this->assign('first_view',$first_view);
            $this->assign('info',$info);
           
        }

        $userdata=D('User')->read2($uid);
        if($userdata){
            $this->assign('userdata',$userdata);
        }

    	
    	$this->assign('uid',$uid);

        
    	
        $this->display('Template/index');
    }


    /*
    **模板页表单提交处理
    */
    public function edit(){
        //echo '111111';die;
        $uid=$this->cookieUid;
        //$uid='111';

        $template=D('Template')->user($uid);
        ////////////////////////多次编辑//////////////////////////////////////////////////
        if($template){
            $data=D('Template');
            //var_dump($data);die;
            if(!$data->create()){
                //exit($this->error($data->getError()));
                echo '<script type="text/javascript">alert("'.$data->getError().'");window.history.go(-1);</script>';
            }else{
                $data=D('Template')->create();
                
                $data['modified_time']=time();


                //过滤
                $data['title_before']=filter(I('post.title_before'));
                $data['title_after']=filter(I('post.title_after'));
                $data['content']=filter(I('post.content'));
            }    
            

            //var_dump($data);die;


            
            $form=D('Template');

            $form1=D('User');
            //$user=D('User')->create();
            $user['uid']=$uid;
            $user['name']=filter(I('post.username'));


            $user_img=$this->cookie_val(session('Cookie_all'),'Av');
            if($user_img==null){
                $user_img=$this->cookie_val($_COOKIE['Cookie_ulogin'],'Av');
            }
            $user['user_img']=$user_img;

            
            $result1=D('User')->read1($uid,$user['name']);
            $result2=D('User')->read($user['name']);
           //var_dump($result);die;
            $num=count($result2);

            if($result1==null){

                $json_arr['do_nickname']='new';
                if($num>0){
                    //echo '<script type="text/javascript">alert("该昵称已被使用!");window.history.go(-1);</script>';
                    //exit;
                    $json_arr['do_nickname']='exist';
                    $json_arr['do_text']='该昵称已被使用';
                    $json_arr['do_url']='back';
                    $my_json=json_encode($json_arr);
                    echo $my_json;
                    exit;
                }else{

                    $result=$form1->where(array('uid'=>$uid))->save($user);
                    if($result==0){
                        $result=D('User')->data($user)->add();
                    }
                    //var_dump($result);die;
                }
            }

            

            $res=$form->where(array('uid'=>$uid))->save($data);
            //var_dump($res);die;
            if($res){
               

                $url=session('url3');
                //echo $url;die;
                

                //弹出层提示
                $json_arr['do_text']='保存成功';
                $json_arr['do_url']=$url;
                //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
                $my_json=json_encode($json_arr);
                echo $my_json;

            }else{
                //echo '<script type="text/javascript">alert("修改失败……");location="'.$url.'";</script>';
                //弹出层提示
                $json_arr['do_text']='保存失败,请稍候重试';
                $json_arr['do_url']=$url;
                //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
                $my_json=json_encode($json_arr);
                echo $my_json;
            }

            
        }

        ////////////////////////////////////首次编辑//////////////////////////////////////////
        else{

            $data=D('Template')->create();
            $data['uid']=$uid;

            //过滤
            $data['title_before']=filter(I('post.title_before'));
            $data['title_after']=filter(I('post.title_after'));
            $data['profit']=I('post.profit');
            $data['add_price']=I('post.add_price');
            $data['phone']=I('post.phone');
            $data['qq']=I('post.qq');
            $data['wangwang']=I('post.wangwang');
            $data['weichat']=I('post.weichat');

            //过滤
            $data['content']=filter(I('post.content'));


            $data['add_time']=time();
            $data['modified_time']=$data['add_time'];
            $new=D('Template');
            $res2=$new->data($data)->add();

            $form_user=D('User');
            $user=D('User')->create();

            $json_arr['do_nickname']='new';

            if(!$form_user->create()){    
                //echo '<script type="text/javascript">alert("'.$form_user->getError().'");window.history.go(-1);</script>';
                $json_arr['do_nickname']='exist';
                $json_arr['do_text']='该昵称已被使用';
                $json_arr['do_url']='back';
                $my_json=json_encode($json_arr);
                echo $my_json;
                exit;

            }else{
                $user_img=$this->cookie_val(session('Cookie_all'),'Av');
                if($user_img==null){
                    $user_img=$this->cookie_val($_COOKIE['Cookie_ulogin'],'Av');
                }
                $user['uid']=$uid;
                $user['name']=filter(I('post.username'));
                $user['user_img']=$user_img;
                $result=D('User')->data($user)->add();
            }


            if($res2&&$result){
                $url=session('url3');
                //echo '<script type="text/javascript">alert("设置成功");location="'.$url.'";</script>';

                //弹出层提示
                $json_arr['do_text']='设置成功';
                $json_arr['do_url']=$url;
                //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
                $my_json=json_encode($json_arr);
                echo $my_json;

            }else{
                //echo '<script type="text/javascript">alert("设置失败……");location="'.$url.'";</script>';

                //日志记录
                logError("模板页的uid为".$uid."的数据添加失败,当前cookie['Cookie_ulogin']的值是".$_COOKIE['Cookie_ulogin']);
                //弹出层提示
                $json_arr['do_text']='设置失败,请稍候重试';
                $json_arr['do_url']=$url;
                //$my_json=json_encode($json_arr,JSON_UNESCAPED_UNICODE);
                $my_json=json_encode($json_arr);
                echo $my_json;
            }

            

        }
    }

    
}