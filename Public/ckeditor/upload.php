<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传文件</title>
</head>
<body>
<?php
error_reporting(E_ALL & ~ E_NOTICE);
date_default_timezone_set('PRC');	
define("THINK_PATH",'THINK_PATH');
define("TEMP_PATH",'TEMP_PATH');
$tp_config=include("../../ThinkPHP/Conf/convention.php");
define("DB_IP",$tp_config['DB_HOST'].":".$tp_config['DB_PORT']);
define("DB_ROOT",$tp_config['DB_USER']);
define("DB_PASSWORD",$tp_config['DB_PWD']);
define("DB_QZ",$tp_config['DB_PREFIX']);
define("DB_NAME",$tp_config['DB_NAME']);
include("php/checksql.php");
include("php/db.php");
include("php/func.php");

$config=array();
$config['type']=array("img","flash","txt"); 
$config['ext']["txt"]=array("txt","rar"); //上传允许type值
$config['ext']['img']=array("jpg","bmp","gif","png","jpeg"); //img允许后缀
$config['ext']['flash']=array("flv","swf"); //flash允许后缀
$config['flash_size']=2000; //上传flash大小上限 单位：KB
$config['img_size']=5000; //上传img大小上限 单位：KB
$config['message']="上传成功"; //上传成功后显示的消息，若为空则不显示
$config['name']=mktime(); //上传后的文件命名规则 这里以unix时间戳来命名
$qz="../../";
$config['flash_dir']="file/images/"; //上传flash文件地址 采用绝对地址 方便upload.php文件放在站内的任何位置 后面不加"/"
$config['img_dir']="file/images/"; //上传img文件地址 采用绝对地址 采用绝对地址 方便upload.php文件放在站内的任何位置 后面不加"/"

//文件上传
$file=$_FILES['upload'];
$userone=$_SESSION["user"];
//var_dump($userone);
if(is_uploaded_file($file['tmp_name'])) {
		$pinfo=pathinfo($file['name']);
		//$filetype=$pinfo["extension"];
		$infos= getimagesize($file['tmp_name']);//获取文件相关信息,可以获取图片宽高等，var_dump($infos)输出数组看看
		$arr=explode("/",end($infos));
		$fileext=strtolower($arr[1]);//获取真实的文件后缀
		$filepath=$config['img_dir'].$config['name'].".".$fileext;
		$filepath_full=$qz.$filepath;
		
		if($_GET["type"]=="txt"||$_GET["type"]=="img"||$_GET["type"]=="flash"){
			$exts=$config['ext'][trim($_GET["type"])];
		}else{
			$exts=$config['ext']["img"];
		}
		if(in_array($fileext,$exts)){
		   move_uploaded_file($file['tmp_name'],$filepath_full);
		}else{
			exit();
		}
		$fn=$_GET['CKEditorFuncNum'];
		//InsertImage($pinfo["basename"],"file/images/".$config['name'].".".$filetype,$_SESSION["JXAdminName"],$color1);


		if($infos&&count($infos)>1){
			$oldwidth=$infos[0];
			$oldheight=$infos[1];
			$bilv=($oldwidth/$oldheight);
			$bilv=round($bilv, 6);
		}
	$mydb=new db();
	$data["title"]=$pinfo["basename"];
	$data["addtime"]=date("Y-m-d H:i:s");
	$data["objid"]=0;
	$data["objtable"]="";
	$data["bilv"]=$bilv;
	$data["size"]=$file['size'];
	$data["src"]=$filepath;
	$data["status"]=1;
	$data["ext"]=$fileext;
	//src_small
	$data["oldname"]=$pinfo["basename"];
	$mydb->add(DB_QZ."images",$data);
	mkhtml($fn,$filepath,$config['message']);
}else{
	echo "请上传图片";
}

//输出js调用
function mkhtml($fn,$fileurl,$message) {
   $url="".CurUrl("/Public/")."/";
   $str="<script type=\"text/javascript\">window.parent.CKEDITOR.tools.callFunction('".$fn."','".$url.$fileurl."','');</script>";
   exit($str);
}

//uploadfile();
function uploadfile() {
	  global $config;
	  //判断是否是非法调用
	  if(empty($_GET['CKEditorFuncNum']))
	  mkhtml(1,"","错误的功能调用请求");
	  $fn=$_GET['CKEditorFuncNum'];
	  if(!in_array($_GET['type'],$config['type']))
	  mkhtml(1,"","错误的文件调用请求");
	  $type=$_GET['type'];
	  $file=$_FILES['upload'];
	  if(is_uploaded_file($file['tmp_name'])) {
	  //判断上传文件是否允许
	  $filearr=pathinfo($file['name']);
	  //$filetype=$filearr["extension"];
	  $infos= getimagesize($file['tmp_name']);//获取文件相关信息,可以获取图片宽高等，var_dump($infos)输出数组看看
	  $arr=explode("/",end($infos));
	  $fileext=strtolower($arr[1]);//获取真实的文件后缀
	  if(!in_array($fileext,$config[$type]))
	  mkhtml($fn,"","错误的文件类型！");
	  //判断文件大小是否符合要求
	  if($file['size']>$config[$type."_size"]*1024)
	  mkhtml($fn,"","上传的文件不能超过".$config[$type."_size"]."KB！");
	  //$filearr=explode(".",$_FILES['upload']['name']);
	  //$filetype=$filearr[count($filearr)-1];
	  $file_abso=$config[$type."_dir"]."/".$config['name'].".".$fileext;
	  $file_host=$_SERVER['DOCUMENT_ROOT'].$file_abso;
	  $file_host=$config['img_dir'].$file_abso;
	  if(move_uploaded_file($file['tmp_name'],$file_host)) {
	  mkhtml($fn,"".$config['name'].".".$filetype,$config['message']);
	  } else {
	  mkhtml($fn,"","文件上传失败，请检查上传目录设置和目录读写权限");
	  }
	  }
}

?>
</body>
</html>
