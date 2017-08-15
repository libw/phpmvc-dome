<?php
class upload{
    public $relativePath = "./uploads/";
    public $absolutePath = "./upload/";
    public $type = Array('images/png','images/jpeg','images/gif');
    public $size = 2048000;
    public $uploadPath = "";
    public $msg = "";

    private  function message($num){
        switch ($num){
            case 0:
                $this->msg = "请选择上传文件";
                break;
            case 1:
                $this->msg = "文件类型不符";
                break;
            case 2:
                $this->msg = "文件大小超过限制";
                break;
            case 3:
                $this->msg = "上传成功";
                break;
        }
    }

    function isType($t){
        $flag = false;
        foreach($this->type as $v){
            if($t==$v){
                $flag = true;
            }
        }
        if($flag!=true){
            $this->message(1);
        }
        return $flag;
    }

    function isSize($s){
        if($this->size < $s){
            $this->message(2);
            return false;
        }
        return true;
    }

    function getExt($name){
        return substr($name,strrpos($name,'.'));
    }

    function getName($ext){
        $date = date_create();
        return date_timestamp_get($date).rand(1000,9999).$ext;
    }
    function uploadfile($f){
        if(empty($f['size'])){
            $this->message(0);
            return false;
        }

        if(!$this->isType($f['type'])){
            return false;
        }

        if(!$this->isSize($f['size'])){
            return false;
        }

        if(!file_exists($this->absolutePath)){
            mkdir($this->absolutePath);
        }
        $date = date('Y-m-d');
        $path = $this->absolutePath.$date.DIRECTORY_SEPARATOR;
        if(!file_exists($path)){
            mkdir($path);
        }

        $ext = $this->getExt($f['name']);
        $filename = $this->getName($ext);
        move_uploaded_file($f['tmp_name'],$path.$filename);
        $this->uploadPath = $this->relativePath.$date.'/'.$filename;
        $this->message(3);
    }

}
