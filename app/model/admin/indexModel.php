<?php
class indexModel extends model{
    function __construct()
    {
        parent::__construct();
        $this->sql->table="site";
    }

    //index.php?m=admin&c=index&a=info
    function getInfo(){
        return $this->sql->selectOne();
    }
    function setIf($data){
        if($this->sql->update($data,'sid=1')>0){
            $msg = "修改成功";
        }else{
            $msg = "修改失败";
        }
        return $msg;
    }

}