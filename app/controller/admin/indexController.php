<?php
class indexController extends controller{
    protected $indexModel = "";
    function __construct()
    {
        parent::__construct();
        $this->indexModel = new indexModel();
    }

    //主页
    function init(){
        $this->checkLogin();
        $this->display();
    }

    //访问基本信息
    function info(){
        $this->checkLogin();
        $info = $this->indexModel->getInfo();
        $this->assign("info",$info);
        $this->display('info'); //info.html
    }
    function setInfo(){
        $msg = $this->indexModel->setIf($_POST);
        $url = "index.php?m=admin&c=index&a=info";
        $this->redirect($url,$msg);
    }
    function upLogo(){
        $f = $_FILES['file'];
        $u = new upload();
        $u->absolutePath = UPLOAD_PATH;
        $u->uploadfile($f);
        echo $u->uploadPath;
    }

    //修改密码
    function changepwd(){
        $this->checkLogin();
        $this->display('pass');
    }

    //轮播图
    function wheel(){
        $this->checkLogin();
        $this->display('adv');
    }

    //栏目
    function showcate(){
        $this->checkLogin();
        $this->display('column');
    }

    //内容列表
    function listshow(){
        $this->checkLogin();
        $this->display('list');
    }

    //添加内容
    function addshow(){
        $this->checkLogin();
        $this->display('add');
    }

    //友情链接
    function linkshow(){
        $this->checkLogin();
        $this->display('link');
    }

    function addlink(){
        $this->checkLogin();
        $this->display('addlink');
    }

    //留言管理
    function book(){
        $this->checkLogin();
        $this->display('book');
    }
}