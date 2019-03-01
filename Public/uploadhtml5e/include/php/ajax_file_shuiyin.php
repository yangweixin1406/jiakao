<?php session_start();?>
<?php
$g_dir_shuiyin="file/shuiyin/"; //上传的文件夹
$g_cengci="../../../../"; //上传的文件夹层次
$g_fenge="#";
$g_extstr="jpg,jpeg,gif,png,bmp";//允许上传的上传的
$maxday=10;//设置存放天数
?>
<?php include("func.php");?>

<?php 
header('Content-Type:text/html;charset=utf-8;');
$act=$_REQUEST["act"];
if(IsMyWeb()==0){
	echo "非法提交"; //不是通过本网站提交
	exit();
}
if($act=="up"){
		//php
		//TODO:
		//1. 合并同一个文件、
		//2. 判断是否文件结束
		//3. 多用户并发情况下，不能互相干扰
		$data =  $_POST["data"];
		$data=str_ireplace("[jh]","+",$data);
		if(substr($data, 0, 37) == "data:application/octet-stream;base64,"){
			$data = substr($data, 37);
		}
		$tx="data:;base64,";
		if(substr($data, 0, strlen($tx)) == $tx){
			$data = substr($data, strlen($tx));
		}
		$data = base64_decode($data);
		$size = $_POST["size"];
		$end = $_POST["end"];
		$beg = $_POST["beg"];
		$ext = $_POST["ext"];
		$title = $_POST["title"];
		$tmpid = $_POST["tmpid"];
		$exts=explode(",",$g_extstr);
		
	   if(!in_array($ext,$exts)){
		  echo ("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}");
		  exit();
		}
//		if($beg == 0){
//			$filename = tempnam("tmp", "FOO");//tempnam函数生成一个FOO开头的唯一的文件名
//			$_SESSION["filename"] = $filename;
//		}else{
//			$filename = $_SESSION["filename"];
//		}
        CheckDirAndCreate("","tmp/");
        $filename = "tmp/".$tmpid.".tmp";
		if (!$handle = fopen($filename, 'a')) {//不能打开文件
			 echo "Cannot open file ($filename)";
			 exit;
		}
		if (fwrite($handle, $data) === FALSE) { //不能写入文件
			echo "Cannot write to file ($filename)";
			exit;
		}
		fclose($handle);
		if($size == $end){
		    
			//unset($_SESSION["filename"]);
			//chmod($filename, 0755);
			$time=time();
			$date=date("Y-m-d H:i:s",$time);
			$newname = "Date".date("YmdHis", $time)."SJ".NewRand(4);
			$g_is_yuanming=0;
			if($g_is_yuanming==1){
				$newname=trim($_REQUEST["title"]);
				$newname = str_ireplace(" ","",$newname);//去掉空格
			}
			
			
		   if (in_array($ext,$exts)){

		        $g_dir_shuiyin.=date("Ymd")."/";
			    CheckDirAndCreate($g_cengci,$g_dir_shuiyin);
				$g_dir_new=$g_dir_shuiyin;

				$big_path=$g_dir_new.$newname.".".$ext;
				$big_fullpath=$g_cengci.$big_path;
				$small_src=$big_path;
				$mid_src=$big_path;
				$big_src=$big_path;
				if($g_is_yuanming==1){
				// rename($filename, iconv("UTF-8","GB2312",$big_fullpath));//保存
				 			copy($filename,iconv("UTF-8","GB2312",$big_fullpath));
					         @unlink($filename);
				}else{
				// rename($filename,$big_fullpath);//保存 
				 			copy($filename,$big_fullpath);
					         @unlink($filename);
				}
				$status="success";
			}else{
			  echo ("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}");
			  exit();
			}

			//$big_path 大图路径
			//$mid_src 中图路径
			//$small_src 小图路径
			echo ("{\"status\":\"".$status."\",\"filepath\":\"".$big_path."\",\"small_src\":\"".$small_src."\",\"mid_src\":\"".$mid_src."\",\"big_src\":\"".$big_src."\",\"title\":\"".$title."\",\"ext\":\"".$ext."\",\"cengci\":\"{$g_cengci}\",\"date\":\"{$date}\"}");
		}else{
		    echo ("{\"status\":\"dengdai\",\"tmpid\":\"".$tmpid."\",\"beg\":\"".$beg."\",\"end\":\"".$end."\",\"ext\":\"".$ext."\"}");
		}
		exit(0);
}
if($act=="del"){
  $path=$_POST["path"];
  if(substr($path,0,strlen($g_dir_shuiyin))==$g_dir_shuiyin){
    @unlink($g_cengci.$path);
  }
}
	
//$g_cengci.$g_dir_shuiyin
function delgouqi($dir,$mday){//删除过期文件
	$filesnames = scandir($dir);
	$curtime=strtotime(date("Y-m-d"));
	foreach ($filesnames as $name) {
		if(is_dir($dir.$name)&&$name!="."&&name!=".."){
			if(is_numeric($name)&&strlen($name)==8){
			 $dt=substr($name,0,4)."-".substr($name,4,2)."-".substr($name,6,2);
			 $thistime=strtotime($dt);
			 $chazhi=($curtime-$thistime);
			 if($chazhi>60*60*24*$mday){
			   DeleteDir($dir.$name."/");
			 }
			}
		}
	}
}

//http://blog.chinaunix.net/uid-15223977-id-2774358.html
?>

