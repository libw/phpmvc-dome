<?php
class controller{
    protected $viewObj = '';
    protected $session = '';
    function __construct()
    {
        include_once LIBS_PATH.'session.class.php';
        $this->session = new session();
        $this->viewObj = new view();
    }

    function assign($k,$v){
        $this->viewObj->assign($k,$v);
    }
    function display($tplname=''){
        $this->viewObj->display($tplname);
    }

    /*
     * 重定向 redirect
     *
     * */
    function redirect($url,$msg,$wait=1){
        if($wait==0){
           header("Location:${url}");
        }else{
            include_once VIEW_PATH.'admin'.DS.'tips.html';
        }
    }

    /*
     * 检测是否登录
     * */
    function checkLogin(){
        if(empty($this->session->get('is_login'))){
            $msg = "请登录";
            $url = "index.php?m=admin&c=login&a=login";
            $this->redirect($url,$msg);
            exit();
        }
    }
}