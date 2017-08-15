<?php
class loginController extends controller{
    private $codeObj = '';

    function __construct()
    {
        parent::__construct();
        include_once LIBS_PATH.'code.class.php';
        $this->codeObj = new code();
        $this->codeObj->fontfile = LIBS_PATH."fonts".DS."msyh.ttf";
    }

    //登录
    function login(){
        $this->display('login');
    }

    //检查登录
    function checklogin(){
        //获取post信息
       $user =  $_POST['username'];
       $password = md5($_POST['password']);
       $code = strtolower($_POST['code']);

       //判断验证码
       if($this->session->get('code')!=$code){
            $msg = "验证码错误";
            $url = "index.php?m=admin&c=login&a=login";
            $this->redirect($url,$msg);
            exit();
       }
       //从数据库获取数据
       $users =  (new loginModel())->getUser();

       //判断用户名，密码 成功 设置 session is_login = true
       if($users[0]['username']==$user){
           if($users[0]['password']==$password){
               $url = WEB_PATH.'index.php?m=admin&c=index&a=init';
               $msg = "登录成功";
               $this->session->set(array(
                   "is_login"=>true,
                   "username"=>$user
               ));
               $this->redirect($url,$msg);
               exit();
           }else{
               $msg = "密码不正确";
           }
       }else{
           $msg = "用户名不存在";
       }
       $url = "index.php?m=admin&c=login&a=login";
       $this->redirect($url,$msg);
    }

    function loginOut(){
        $this->session->destroy();
        $msg = "退出成功";
        $url = "index.php?m=admin&c=login&a=login";
        $this->redirect($url,$msg);
    }
    //生成验证码图片
    function createCode(){
        $this->codeObj->outputImg();
        $this->session->set('code',$this->codeObj->fontcode);
    }
}