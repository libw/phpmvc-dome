<?php
/*
 * class new route()
 * method disptach()
 * 根据请求找到指定的控制器 并调用指定控制器的方法
 * */
class route{
    protected $m = '';
    protected $c = '';
    protected $a = '';
    function __construct()
    {
        $this->dispatch();
    }

    function dispatch(){
        //模块名 index  admin
        $this->m =  empty($_REQUEST['m'])?'index':$_REQUEST['m'];

        // 方法名 init
        $this->a =  empty($_REQUEST['a'])?'init':$_REQUEST['a'];

        // 控制器名  indexController listController
        $this->c =  empty($_REQUEST['c'])?'index':$_REQUEST['c'];


        $ctrlName =$this->c."Controller";
       $file = CONTROLLER_PATH.$this->m.DS.$this->c."Controller.php";
        $modelfile = MODEL_PATH.$this->m.DS.$this->c."Model.php";


       if(file_exists($file)){
           //xxxModel.php
            if(file_exists($modelfile)){
                include_once $modelfile;
            }
            //xxxController.php
            include_once $file;
            if(class_exists($ctrlName)){
                $ctrl = new $ctrlName();
                $methods = $this->a;
                if(method_exists($ctrl,$methods)){
                    $ctrl->$methods();
                }else{
                    echo $methods.'方法不存在';
                }
            }else{
                echo $ctrlName.'类不存在';
            }
       }else{
           echo $file.'文件不存在';
       }
    }
}