<?php session_start();?>
<?php
//include("../../../function/db_config.php");
 include("db_config.php");
 
 include("config.php");
 ?>
<?php include("db.php");?>
<?php 
//$mydb=new db();
?>
<?php include("func.php");?>

<?php 
$act=$_REQUEST["act"];
if(IsMyWeb()==0){
	echo "非法提交"; //不是通过本网站提交
	exit();
}
if($act=="save_base64"){
        $base64=trim($_REQUEST["base64"]);
  		$base64=str_ireplace("[jh]","+",$base64);
		$ext=trim($_REQUEST["ext"]);
		$is_upload=false;
		if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
		 $is_upload=true;
		}
		if($is_upload==false){
		   echo ("{status:\"error\",msg:\"后端不允许上传.".$ext."文件\"}");
		   exit();
		}
		$time=time();
		$g_dir4.="touxiang/".date("Ymd")."/";
		$newname =md5(date("YmdHis", $time)."sj".NewRand(4));
		$bigsrc=$g_dir4.$newname.".".$ext;
		$big_fullpath=$g_cengci.$bigsrc;
		if($base64!=""){
		   CreateDir($g_cengci.$g_dir4);
		  SaveBase64($big_fullpath,$base64);
		  echo("{status:\"success\",path:\"".$bigsrc."\"}");
		}
		exit();
}
if($act=="up"){
		//php
		//TODO:
		//1. 合并同一个文件、
		//2. 判断是否文件结束
		//3. 多用户并发情况下，不能互相干扰

		$size = $_REQUEST["size"];
		$end = $_REQUEST["end"];
		$beg = $_REQUEST["beg"];
		$title=trim($_REQUEST["title"]);
		$isyuanming= $_POST["isyuanming"];
		$title =urldecode($title);
		$file=$_FILES["file"];
		$tmpid=trim($_REQUEST["tmpid"]);
		$value=trim($_REQUEST["value"]);
		$value=str_ireplace("[jh]","+",$value);
		$index=trim($_REQUEST["index"]);
		$ext=trim($_REQUEST["ext"]);
	    $num=intval($_REQUEST["num"]);
		$total=intval($_REQUEST["total"]);
		$filename=trim($_REQUEST["filename"]);
		
		$isnewsmall=trim($_REQUEST["isnewsmall"]);
		if($title!=""){$tmpid=md5($title);}
		
		$tmpdir=$g_cengci."tmp/".$tmpid."/";
        $cengci=$g_cengci;
        CreateDir($tmpdir); 
		if($isnewsmall==0){
		   $g_is_small=0;
		   $g_is_mid=0;
		}
		
        $tmp_index_full =  $tmpdir.$index.".tmp";
		 $data=trim($_REQUEST["data"]);
		 if(trim($_POST["data"])!=""){
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
			if (!$handle = fopen($tmp_index_full, 'a')) {//不能打开文件
				 echo "Cannot open file ($tmp_index_full)";
				 exit;
			}
			if (fwrite($handle, $data) === FALSE) { //不能写入文件
				echo "Cannot write to file ($tmp_index_full)";
				exit;
			}
			fclose($handle);
		 }else{
		   if (!empty($_FILES)) {
						  $file=$_FILES["file"];
						   if(!is_file($tmp_index_full)){
						           move_uploaded_file($file["tmp_name"],$tmp_index_full);
						  }else{
						       if($index!=$total){
						         echo "{\"status\":\"dengdai\",\"index\":\"$index\",\"total\":\"$total\",\"msg\":\"已存在\"}";
								 exit;
							  }
						  }
		   }else{
						if (!$out = @fopen($tmp_index_full, "wb")) {
							die('{"error" : {"code": 102, "message": "Cannot open file"}}');
						}
		
						if (!$in = @fopen("php://input", "rb")) {
							die('{"error" : {"code": 101, "message": "Failed to open input stream."}}');
						}
						
						while ($buff = fread($in, 4096)) {
							fwrite($out, $buff);
						}
						@fclose($out);
						@fclose($in);
		   }
	   }
	   
	   if($index!=$total){
	    echo "{\"status\":\"dengdai\",\"index\":\"$index\",\"total\":\"$total\",\"msg\":\"$index分段上传成功\"}";
		exit();
	   }
	   $isbool=1;
	   for($i=1;$i<=$total;$i++){
		  $tmp_path = $tmpdir.$i.".tmp";
		  if (!file_exists($tmp_path)) {
			$isbool=0;
		  }
	   }
		
//		if($beg == 0){
//			$filename = tempnam("tmp", "FOO");//tempnam函数生成一个FOO开头的唯一的文件名
//			$_SESSION["filename"] = $filename;
//		}else{
//			$filename = $_SESSION["filename"];
//		}


		if($isbool==1){
			//unset($_SESSION["filename"]);
			//chmod($filename, 0755);
			$uploadfile=$tmpdir.$tmpid.".bao";				
			if(is_file($uploadfile)){
				 @unlink($uploadfile);
			}
			 $datastr="";
			 $fo = fopen($uploadfile,"a");
			 for($i=1;$i<=$total;$i++){
			    $tmp_path = $tmpdir.$i.".tmp";
			    $datastr =file_get_contents($tmp_path);
				//file_put_contents("test.txt", "This is another something.", FILE_APPEND)
				fwrite($fo,$datastr);
				//@unlink($tmp_path);
			 }
           
			fclose($fo);
			 for($i=1;$i<=$total;$i++){
			    $tmp_path = $tmpdir.$i.".tmp";
				@unlink($tmp_path);
			 }
			
			$time=time();
			$date=date("Y-m-d H:i:s",$time);
			
			if($isyuanming==""){
			  $isyuanming=$g_is_yuanming;
			}
			if($isyuanming==1){
				$newname=trim($title);
				$newname = str_ireplace(" ","",$newname);//去掉空格
				$newname = str_ireplace(".".$ext,"",$newname);//去掉空格
			}else{
			    if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
			      $newname ="image".date("YmdHis", $time)."sj".NewRand(4);
				}else{
				  $newname ="file".date("YmdHis", $time)."sj".NewRand(4);
				}
			}
			$g_dir1.=date("Ymd",$time)."/";
			$g_dir2.=date("Ymd",$time)."/";
			$g_dir3.=date("Ymd",$time)."/";
			$g_dir4.=date("Ymd",$time)."/";
			$g_dir_other.=date("Ymd",$time)."/";
			if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
					if($g_is_small==1){
						if($g_dir1==$g_dir2&&$g_dir2==$g_dir3){
							$small_src=$g_dir1.$newname.".".$ext;//小图
							$mid_src=$g_dir2.$newname.".".$ext.".".$ext;//中图
							$big_src=$g_dir3.$newname.".".$ext.".".$ext.".".$ext;//大图/原图
						}else{
							$small_src=$g_dir1.$newname.".".$ext;
							$mid_src=$g_dir2.$newname.".".$ext;
							$big_src=$g_dir3.$newname.".".$ext;
						}
	
						CreateDir($g_cengci.$g_dir1);
						CreateDir($g_cengci.$g_dir2);
						CreateDir($g_cengci.$g_dir3);
						
						if($GLOBALS["g_is_small"]!=1){
						 $small_src=$big_src;
						}
						if($GLOBALS["g_is_mid"]!=1){
						 $mid_src=$big_src;
						}
						
						$small_fullpath=$g_cengci.$small_src;
						$mid_fullpath=$g_cengci.$mid_src;
						$big_fullpath=$g_cengci.$big_src;
						if($isyuanming==1){
						   $small_fullpath=iconv("UTF-8","GB2312",$small_fullpath);
						   $mid_fullpath=iconv("UTF-8","GB2312",$mid_fullpath);
						   $big_fullpath=iconv("UTF-8","GB2312",$big_fullpath);
						}
						//rename($filename, $big_fullpath);//保存
						 copy($uploadfile,$big_fullpath);
						 @unlink($uploadfile);
						if($GLOBALS["g_is_small"]==1){
							   NewSmall($big_fullpath,$small_fullpath,$GLOBALS['g_w1'],$GLOBALS['g_h1']);
						}
						if($GLOBALS["g_is_mid"]==1){
							   NewSmall($big_fullpath,$mid_fullpath,$GLOBALS['g_w2'],$GLOBALS['g_h2']);
						}
					}
					if($g_is_small==0){
					     $big_src=$g_dir4.$newname.".".$ext;
						 CreateDir($g_cengci.$g_dir4);
						 $big_fullpath=$g_cengci.$big_src;
						  $small_src=$big_src;
						  $mid_src=$big_src;
						 if($isyuanming==1){
						   $big_fullpath=iconv("UTF-8","GB2312",$big_fullpath);
						 }
					   	 copy($uploadfile,$big_fullpath);
						 @unlink($uploadfile);
					}
					$status="success";
			}else{
			       if($ext=="doc" || $ext=="docx" || $ext=="xsl" || $ext=="xslx"|| $ext=="rar" || $ext=="zip"|| $ext=="mp4"|| $ext=="zp"|| $ext=="pdf"){
						CreateDir($g_cengci.$g_dir_other);
						$big_src=$g_dir_other.$newname.".".$ext;
						$big_fullpath=$g_cengci.$big_src;
						$small_src=$big_src;
						if($isyuanming==1){
						//rename($filename, iconv("UTF-8","GB2312",$big_fullpath));//保存
						     copy($uploadfile,iconv("UTF-8","GB2312",$big_fullpath));
					        @unlink($uploadfile);
						}else{
							copy($uploadfile,$big_fullpath);
					         @unlink($uploadfile);
						}

						$status="success";
					}else{
					  echo ("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}");
					  exit();
					}
			}
			//$big_path 大图路径
			//$mid_src 中图路径
			//$small_src 小图路径
			@rmdir($tmpdir);
			echo ("{\"status\":\"".$status."\",\"filepath\":\"".$small_src."\",\"small_src\":\"".$small_src."\",\"mid_src\":\"".$mid_src."\",\"big_src\":\"".$big_src."\",\"title\":\"".$title."\",\"ext\":\"".$ext."\",\"cengci\":\"{$g_cengci}\",\"date\":\"{$date}\",\"tmpid\":\"{$tmpid}\"}");
		}else{
		    echo ("{\"status\":\"dengdai\",\"beg\":\"".$beg."\",\"end\":\"".$end."\"}");
		}
		exit(0);
}
/*删除图片*/
if($act=="del"){
   $filepath=$_POST["path"];
  $pos=strpos($filepath,"file/");
   if($pos!==false&&$pos==0){
        $arr=explode(".",$filepath);
		$ext=".".end($arr);
		$filepath=iconv('UTF-8', 'GB2312',$filepath);
		if(strpos($filepath,"/s50/")!==false||strpos($filepath,"/s100/")!==false){
		  $path=str_replace("/s100/","/s50/",$filepath);
		   if(file_exists($g_cengci.$path)){
			      @unlink($g_cengci.$path);
				  $dellist[]=$path;
		   }
		   
		  $path=str_replace("/s80/","/s50/",$path);
		   if(file_exists($g_cengci.$path)){
			  @unlink($g_cengci.$path);
			  $dellist[]=$path;
		   }

		  $path=str_replace("/s50/","/s80/",$path);
		   if(file_exists($g_cengci.$path)){
			  @unlink($g_cengci.$path);
			   $dellist[]=$path;
		   }
	  
		  $path=str_replace("/s50/","/s100/",$path);
		   if(file_exists($g_cengci.$path)){
			  @unlink($g_cengci.$path);
		   }
		   
		}else{
		 $path=str_replace($ext.$ext.$ext,$ext,$filepath);
		  if(file_exists($g_cengci.$path)){
		    @unlink($g_cengci.$path);
		    $dellist[]=$path;
		  }
		  if(file_exists($g_cengci.$path.$ext)){
		    @unlink($g_cengci.$path.$ext);
		    $dellist[]=$path.$ext;
		  }
		  if(file_exists($g_cengci.$path.$ext.$ext)){
		    @unlink($g_cengci.$path.$ext.$ext);
		    $dellist[]=$path.$ext.$ext;
		  }
		}
		echo "del:";
		echo json_encode($dellist);
	}else{
	    echo "del:非法";
	}
	exit();
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

