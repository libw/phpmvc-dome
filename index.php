<?php
    //路径分隔符 window  d:\baidu\  linux  //appliction/
    define('DS',DIRECTORY_SEPARATOR);

    //根路径 D:\wamp\www\phpmvc4-23\
    define("ROOT",__DIR__.DS);

    //WEB路径 http://localhost/phpmvc4-23/
    define("WEB_PATH",'http://'.$_SERVER['SERVER_NAME'].substr($_SERVER['SCRIPT_NAME'],0,strrpos($_SERVER['SCRIPT_NAME'],'/')+1));

    //公共库目录
    define("LIBS_PATH",ROOT.'libs'.DS);
    define("CONFIG_PATH",ROOT.'config'.DS);
    define("APP_PATH",ROOT.'app'.DS);
    define("CONTROLLER_PATH",APP_PATH.'controller'.DS);
    define("MODEL_PATH",APP_PATH.'model'.DS);
    define("VIEW_PATH",APP_PATH.'view'.DS);

    //WEB目录
    define("STATIC_PATH",WEB_PATH.'static/');
    define("CSS_PATH",STATIC_PATH.'css/');
    define("IMG_PATH",STATIC_PATH.'images/');
    define("JS_PATH",STATIC_PATH.'js/');

    //上传目录
    define("UPLOAD_PATH",ROOT.'uploads'.DS);

    include_once CONFIG_PATH.'config.php';
    include_once LIBS_PATH.'route.class.php';
    include_once LIBS_PATH.'view.class.php';
    include_once LIBS_PATH.'controller.class.php';
    include_once LIBS_PATH.'sql.class.php';
    include_once LIBS_PATH.'model.class.php';
    include_once LIBS_PATH.'upload.class.php';
    new route();
