<?php
class session{

    function __construct()
    {
        session_start();
    }

    function get($key){
        return empty($_SESSION[$key])?false:$_SESSION[$key];
    }

    function set($key='',$val=''){
       if(is_array($key)){
           foreach ($key as $k=>$v){
              $_SESSION[$k] = $v;
           }
       }else{
            $_SESSION[$key] = $val;
       }
    }

    function del($key){
        unset($_SESSION[$key]);
    }

    function clear(){
        foreach ($_SESSION as $key=>$val){
            unset($_SESSION[$key]);
        }
    }

    function destroy(){
        session_destroy();
    }
}