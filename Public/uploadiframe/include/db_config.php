<?php 
  error_reporting(E_ALL & ~ E_NOTICE);	//屏蔽没有必要的错误提示，如变量未定义
  date_default_timezone_set('PRC');//设成北京时间
  define("DB_QZ",'bd_');//表前缀
  define("DB_IP",'localhost'); //数据库ip
  define("DB_NAME", 'test'); //数据库名
  define("DB_ROOT",'root');      //数据库登录名
  define("DB_PASSWORD",'123456');  //数据库登录密码
  define("DB_CONNECT_ERROR",'连接数据库出错!');
  define("DB_DATABASE_ERROR",'选择数据库不存在!');
?>