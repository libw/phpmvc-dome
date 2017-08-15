<?php
class sql{
    /*
     * 1. 先创建链接
     * 2. 写sql语句 并执行
     * */
    public $conn = ''; //mysql链接对象
    public $table = ""; //表名

    //链接到数据库
    function connect(){
        $this->conn = new mysqli(HOST,USERNAME,PASSWORD,DBNAME,PORT);
        $this->conn->set_charset(MYSQLCHARSET);
        if($this->conn->connect_error){
            echo "数据库链接失败";
            exit();
        }
    }

    /*
     * select * from user where  order by  limit
     * */
    function selectAll ($info='*',$term=""){
        $sql = "select ".$info." from ".$this->table." ".$term;
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    function selectOne ($info='*',$term=""){
        $sql = "select ".$info." from ".$this->table." ".$term;
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    /*
     * insert into user ()values(),(),()
     * insert into user values(),(),()
     * array('name'=>'',age=>123)
     *
     * array(array('name'=>'',age=>123),array('name'=>'',age=>123))
     * */
    function insert($data=array(),$attr=""){
        $str="";
        foreach($data as $key=>$val){
            $str.="(";
            foreach ($val as $v){
                $str.="'".$v."',";
            }
            $str.="),";
        }
        $str = substr($str,0,-1);
        if(empty($attr)){
            $sql = "insert into ".$this->table." values".$str;
        }else{
            $sql = "insert into ".$this->table." (".$attr.") values".$str;
        }
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }


    function delete($term=''){
        $sql = "delete from ".$this->table." where ".$term;
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }

    function update($data=array(),$term=''){
        $str="";
        foreach ($data as $key=>$val){
            $str.=$key."='".$val."',";
        }
        $str = substr($str,0,-1);
        $sql = "update ".$this->table." set ".$str." where ".$term;
        $this->conn->query($sql);
        return $this->conn->affected_rows;
    }
}