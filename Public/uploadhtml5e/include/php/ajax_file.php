<?php session_start();?>
<?php
 include("config.php");
 $g_fenge="#";
 $g_extstr="jpg,jpeg,gif,png,bmp,doc,docx,xsl,xslx,rar,zip,mp4,mp3,txt,zp,pdf";//允许上传的上传的
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
if($act=="del"){
  $path=$_POST["path"];
  if(substr($path,0,strlen($g_dir_other))==$g_dir_other){
    @unlink($g_cengci.$path);
  }
  exit();
}
if($act=="up"||$_REQUEST["tmpid"]!=""){
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
		$tmpid=md5($title);
		$tmpdir=$g_cengci."tmp/".$tmpid."/";
        $cengci=$g_cengci;
        CreateDir($tmpdir); 
		
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
		
		$exts=explode(",",$g_extstr);
	   if(!in_array($ext,$exts)){
		  echo ("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}");
		  exit();
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
	   $isbool=1;
	   for($i=1;$i<=$total;$i++){
		  $tmp_path = $tmpdir.$i.".tmp";
		  if (!file_exists($tmp_path)) {
		    //echo $tmp_path;
			$isbool=0;
		  }
	   }
		if($isbool==1){
		
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
			//unset($_SESSION["filename"]);
			//chmod($filename, 0755);
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
			
			
		   if (in_array($ext,$exts)){
		        $g_dir_other.=date("Ymd")."/";
				CreateDir($g_cengci.$g_dir_other);
				
				$big_path=$g_dir_other.$newname.".".$ext;
				$big_fullpath=$g_cengci.$big_path;
				$small_src=$big_path;
				$mid_src=$big_path;
				$big_src=$big_path;
				if($isyuanming==1){
				// rename($filename, iconv("UTF-8","GB2312",$big_fullpath));//保存
				 			 copy($uploadfile,iconv("UTF-8","GB2312",$big_fullpath));
					         @unlink($uploadfile);
				}else{
				// rename($filename,$big_fullpath);//保存 
				 			 copy($uploadfile,$big_fullpath);
					         @unlink($uploadfile);
				}
				$status="success";
			}else{
			  echo ("{\"status\":\"error\",\"msg\":\"后端程序不允许上传.".$ext."文件\"}");
			  exit();
			}
            // delgouqi($g_cengci.$g_dir_other,$maxday);//删除过期文件
			//$big_path 大图路径
			//$mid_src 中图路径
			//$small_src 小图路径
			echo ("{\"status\":\"".$status."\",\"filepath\":\"".$big_path."\",\"small_src\":\"".$small_src."\",\"mid_src\":\"".$mid_src."\",\"big_src\":\"".$big_src."\",\"title\":\"".$title."\",\"ext\":\"".$ext."\",\"cengci\":\"{$g_cengci}\",\"date\":\"{$date}\"}");
			
			DeleteDir($tmpdir);
		}else{
		    echo ("{\"status\":\"dengdai\",\"tmpid\":\"".$tmpid."\",\"beg\":\"".$beg."\",\"index\":\"".$index."\",\"total\":\"".$total."\",\"end\":\"".$end."\",\"ext\":\"".$ext."\"}");
		}
		exit(0);
}

	
//$g_cengci.$g_dir_other
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

