<?php session_start();?>
<?php
header('Content-Type:text/html;charset=utf-8;');
include("../../../../include/db_config.php");
include("../../../../include/db.php");
include("../../../../include/config_upload.php");
include("func.php");
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
		$tmpid = $_POST["tmpid"];
		$title = $_POST["title"];
		$product_id = $_POST["id"];
		
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
			$mydb=new db();
			$img_data["name"]=$title;
			$images_id=$mydb->add(DB_QZ."images",$img_data);//录入一条记录
			
			$newname = date("YmdHis", $time)."_id".$images_id;//NewRand(4)
			if($g_is_yuanming==2){
				$newname=trim($_REQUEST["title"]);
				$newname = str_ireplace(" ","",$newname);//去掉空格
			}
			
			if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
			        $g_dir1.=date("Ymd",$time)."/";
					$g_dir2.=date("Ymd",$time)."/";
					$g_dir3.=date("Ymd",$time)."/";
					
					if($g_dir1==$g_dir2&&$g_dir2==$g_dir3){
					$small_src=$g_dir1.$newname.".".$ext;//小图
					$mid_src=$g_dir2.$newname.".".$ext.".".$ext;//中图
					$big_src=$g_dir3.$newname.".".$ext.".".$ext.".".$ext;//大图/原图
					}else{
						$small_src=$g_dir1.$newname.".".$ext;
						$mid_src=$g_dir2.$newname.".".$ext;
						$big_src=$g_dir3.$newname.".".$ext;
					}

					CheckDirAndCreate($g_cengci,$g_dir1); 
					CheckDirAndCreate($g_cengci,$g_dir2); 
					CheckDirAndCreate($g_cengci,$g_dir3); 
					
					if($GLOBALS["g_is_small"]!=1){
					 $small_src=$big_src;
					}
					if($GLOBALS["g_is_mid"]!=1){
					 $mid_src=$big_src;
					}
					$small_fullpath=$g_cengci.$small_src;
					$mid_fullpath=$g_cengci.$mid_src;
					$big_fullpath=$g_cengci.$big_src;
					if($g_is_yuanming==1){
					   $small_fullpath=iconv("UTF-8","GB2312",$small_fullpath);
					   $mid_fullpath=iconv("UTF-8","GB2312",$mid_fullpath);
					   $big_fullpath=iconv("UTF-8","GB2312",$big_fullpath);
					}
					//rename($filename, $big_fullpath);//保存
					copy($filename,$big_fullpath);
					 @unlink($filename);

					if($GLOBALS["g_is_small"]==1){
						   NewSmall($big_fullpath,$small_fullpath,$GLOBALS['g_w1'],$GLOBALS['g_h1']);
					}
					if($GLOBALS["g_is_mid"]==1){
						   NewSmall($big_fullpath,$mid_fullpath,$GLOBALS['g_w2'],$GLOBALS['g_h2']);
					}
					$img_data["name"]=$title;
					$img_data["image"]=$small_src;
					$img_data["small_src"]=$small_src;
					$img_data["mid_src"]=$mid_src;
					$img_data["big_src"]=$big_src;
					$img_data["state"]=0;
					$img_data["addtime"]=date("Y-m-d H:i:s");
					$img_data["about"]=$title;
					$mydb->update(DB_QZ."images",$img_data," id='$images_id'");//更新当前的记录
					$status="success";
			}else{
			       if($ext=="doc" || $ext=="docx" || $ext=="xsl" || $ext=="xslx"|| $ext=="rar" || $ext=="zip"|| $ext=="mp4"){
				        $g_dir_other.=date("Ymd",$time)."/";
						CheckDirAndCreate($g_cengci,$g_dir_other); 
						$big_path=$g_dir_other.$newname.".".$ext;
						$big_fullpath=$g_cengci.$big_path;
						$small_src=$big_path;
						if($g_is_yuanming==1){
						//rename($filename, iconv("UTF-8","GB2312",$big_fullpath));//保存
						     copy($filename,iconv("UTF-8","GB2312",$big_fullpath));
					        @unlink($filename);
						}else{
							copy($filename,$big_fullpath);
					         @unlink($filename);
						}
                        $img_data["name"]=$title;
						$img_data["image"]=$small_src;
						$img_data["small_src"]=$small_src;
						$img_data["mid_src"]=$mid_src;
						$img_data["big_src"]=$big_src;
						$img_data["state"]=0;
						$img_data["addtime"]=date("Y-m-d H:i:s");
						$img_data["about"]=$title;
						$mydb->update(DB_QZ."images",$img_data," id='$images_id'");//更新当前的记录
						$status="success";
					}else{
					  echo ("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}");
					  exit();
					}
			}
			//$big_path 大图路径
			//$mid_src 中图路径
			//$small_src 小图路径
			echo ("{\"status\":\"".$status."\",\"filepath\":\"".$big_path."\",\"small_src\":\"".$small_src."\",\"mid_src\":\"".$mid_src."\",\"big_src\":\"".$big_src."\",\"title\":\"".$title."\",\"ext\":\"".$ext."\",\"cengci\":\"{$g_cengci}\",\"date\":\"{$date}\",\"tmpid\":\"{$tmpid}\",\"images_id\":\"{$images_id}\"}");
		}else{
		    echo ("{\"status\":\"dengdai\",\"beg\":\"".$beg."\",\"end\":\"".$end."\"}");
		}
		exit(0);
}
if($act=="del"){
  $path=$_POST["path"];
  if(substr($path,0,strlen($g_dir_other))==$g_dir_other){
   // @unlink($g_cengci.$path);
  }
}

function SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,$x,$y,$newimagepath){
		$newim = imagecreatetruecolor($maxwidth, $maxheight);
		if(function_exists("imagecopyresampled")){
			$newim = imagecreatetruecolor($maxwidth, $maxheight);
			$red = imagecolorallocate($newim, 255, 255, 255);
			imagefill($newim, 0, 0, $red);
			imagecopyresampled($newim, $thisim, $x, $y, 0, 0, $_width,
			$_height, imagesx($thisim), imagesy($thisim));
		}else{
			$newim = imagecreate($maxwidth, $maxheight);
			imagecopyresized($newim, $thisim, $x, $y, 0, 0, $_width,
			$_height, imagesx($thisim), imagesy($thisim));
		}
		ImageJpeg($newim,$newimagepath,85);
}


//http://blog.chinaunix.net/uid-15223977-id-2774358.html
?>

