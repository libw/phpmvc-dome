<?php
class loginModel extends model {
    function __construct()
    {
        parent::__construct();
        //设置表名
        $this->sql->table="user";
    }

    function getUser(){
        return $this->sql->selectAll();
    }
}