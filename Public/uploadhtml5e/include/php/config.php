<?php 
error_reporting(E_ALL & ~ E_NOTICE);	//屏蔽没有必要的错误提示，如变量未定义
date_default_timezone_set('PRC');//设成北京时间
define("DB_QZ",'bd_');//表前缀
define("DB_IP",'localhost'); //数据库ip
define("DB_NAME", 'biaodan20151207'); //数据库名
define("DB_ROOT",'root');      //数据库登录名
define("DB_PASSWORD",'123456');  //数据库登录密码
define("DB_CONNECT_ERROR",'连接数据库出错!');
define("DB_DATABASE_ERROR",'选择数据库不存在!');


header('Content-Type:text/html;charset=utf-8;');
$g_is_insert=0;
$g_is_small=1;//是否生成小图
$g_is_mid=0;//是否生成中图
$g_is_yuanming=1;//1为原标题
$g_is_jiequ=0;
$g_dir1="file/p/";//小图文件夹
$g_dir2="file/p/";//中图文件夹
$g_dir3="file/p/";//大图文件夹
$g_dir4="file/img/";//图文件夹
$g_dir_mp4="file/data/";//mpw4视频文件夹
$g_dir_swf="file/data/";//flash视频文件夹
$g_dir_mov="file/data/"; //mov视频文件夹
$g_dir_other="file/data/"; //文件夹
$g_cengci="../../../../"; //
$g_w1=200; //小图宽
$g_w2=400; //中图宽
$g_h1=200; //小图高
$g_h2=400; //中图高
$g_fenge="#";

?>