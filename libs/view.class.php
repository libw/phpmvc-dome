<?php
/*
 * view类
 * 1. 给视图挂载数据
 * 2. 加载对应的html文件(模板)
 *    header
 *    index || othername
 *    footer
 * */
class view{
    protected $m = '';  //获取模块
    protected $c ='';   //获取要访问控制文件名 控制器类名
    protected $a = '';  //访问控制器什么方法
    protected $val = array(); //保存数据

    /*
     * assign($k,$v) 给视图挂载数据
     * @parmas $k string 键
     * @parmas $v any    任何类型数据
     * @return undefined 没有返回值
     * assign('title','123123');
     * assign(array('name'=>'zhangsan','age'=>'42'))
     * */
    function assign($k,$v){
        if(is_array($k)){
            foreach ($k as $keys=>$vals){
                $this->val[$keys] = $vals;
            }
        }else{
            $this->val[$k] = $v;
        }
    }

    function display($tplname=''){
        //将关联数组中的数据 变成一个个变量
        extract($this->val);

        //模块名 index  admin
        $this->m =  empty($_REQUEST['m'])?'index':$_REQUEST['m'];

        // 方法名 init
        $this->a =  empty($_REQUEST['a'])?'init':$_REQUEST['a'];

        // 控制器名  indexController listController
        $this->c =  empty($_REQUEST['c'])?'index':$_REQUEST['c'];

        $defaultHeader = VIEW_PATH.$this->m.DS.'header'.VIEW_EXT;
        $defaultFooter = VIEW_PATH.$this->m.DS.'footer'.VIEW_EXT;

        $indexName = empty($tplname)?'index':$tplname;
        $defaultIndex = VIEW_PATH.$this->m.DS.$indexName.VIEW_EXT;
        //控制器的名字 就是文件夹名 login
        //方法的名字 就是模板名 addlist.html
        $cHeader = VIEW_PATH.$this->m.DS.$this->c.DS.'header'.VIEW_EXT;
        $cFooter = VIEW_PATH.$this->m.DS.$this->c.DS.'footer'.VIEW_EXT;

        $indexName = empty($tplname)?$this->a :$tplname;
        $cIndex = VIEW_PATH.$this->m.DS.$this->c.DS.$indexName.VIEW_EXT;

        if(file_exists($cHeader)){
            @include_once $cHeader;
        }else{
            @include_once $defaultHeader;
        }

        //index.php?m=index&c=login&a=reg
        if(file_exists($cIndex)){
            @include_once $cIndex;
        }else{
            @include_once $defaultIndex;
        }

        if(file_exists($cFooter)){
            @include_once $cFooter;
        }else{
            @include_once $defaultFooter;
        }
    }
}
