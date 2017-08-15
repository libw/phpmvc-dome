<?php
class model{
    public $sql ='';
    function __construct()
    {
        $this->sql = new sql();
        $this->sql->connect();
    }
}