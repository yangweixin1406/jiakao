<?php session_start();?>
<?php 
error_reporting(E_ALL & ~ E_NOTICE);	//屏蔽没有必要的错误提示，如变量未定义
date_default_timezone_set('PRC');//设成北京时间
$act=$_REQUEST["act"];
header("Access-Control-Allow-Origin: *");
if($act=="uploadtxt"){
        $dir1=$dir2=$dir3="photos/";//上传文件夹
		$cengci=trim($_REQUEST["cengci"]);
		if($cengci==""){
		  $cengci="../../";
		}
		$width1=200;//小图宽度
		$width2=300;//中图宽度
		$tmpid=trim($_REQUEST["tmpid"]);
		$value=trim($_REQUEST["value"]);
		$value=str_ireplace("[jh]","+",$value);
		$index=trim($_REQUEST["index"]);
		$ext=trim($_REQUEST["ext"]);
	    $num=intval($_REQUEST["num"]);
		$filename=trim($_REQUEST["filename"]);
		$tmp_path="tmp/".$tmpid."_".$index.".txt";
		$myfile =fopen($tmp_path,"w+");
		fwrite($myfile, $value);
		fclose($myfile);
		if($index!=$num){
		   echo "{\"status\":\"dengdai\",\"index\":\"$index\",\"msg\":\"$index分段上传成功\"}";
		   exit(); //停止向下运行
		}
		
		
		 $rannum=NewRand(5);
		 $bilv=round($bilv,6); //保留6位小数
		 $nameqz=trim($_REQUEST["nameqz"]);
		 if($nameqz==""){
		    $nameqz=date("YmdHis");
		 }
		 $dir1=$dir1.date("Ym")."/";
		 if (!file_exists($cengci.$dir1)){ 
		     mkdir ($cengci.$dir1);
		 }
		 $dir2=$dir2.date("Ym")."/";
		 if (!file_exists($cengci.$dir2)){ 
		     mkdir ($cengci.$dir2);
		 }
		 $dir3=$dir3.date("Ym")."/";
		 if (!file_exists($cengci.$dir3)){ 
		     mkdir ($cengci.$dir3);
		 }
		 $filename=$_REQUEST["filename"];
		 $newname=$nameqz."".$rannum;        //新文件名,不带后缀
		 $ext=strtolower($ext);
		 if($is_ym==1){
		   $newname=trim($_REQUEST["filename"]);
		 }
	    $numsuccess=0;
	    $status="";
		$msg="";
		for($i=1;$i<=$num;$i++){
			$fullpath="tmp/".$tmpid."_".$i.".txt";
			if(file_exists($fullpath)){
				$numsuccess=$numsuccess+1;
			}else{
				$msg=$msg.",".$i;
				$status="error";
			}
		}
	   $isbool=0;
	   if($numsuccess==$num){
			for($i=1;$i<=$num;$i++){
				$fullpath="tmp/".$tmpid."_".$i.".txt";
				$myfile1 = fopen($fullpath, "r") ;
				$base64=$base64.fread($myfile1,filesize($fullpath));
				fclose($myfile1);
				//@unlink($fullpath);
			}
			$isbool=1;
	   }
	  if($isbool==1){  //可以合并
		 $_SESSION["base64"]=
		  $tmp_path="tmp/".$tmpid.".txt";
		  $myfile =fopen($tmp_path,"w+");
		  fwrite($myfile, $base64);
		  fclose($myfile);
	  }else{
	           $status="error";
	  }
    echo ("{\"status\":\"".$status."\",\"msg\":\"$msg\",\"small_src\":\"".$$base64."\"}");//上传成功返回
}
if($act=="upload"){
        $is_small=1;
        $is_mid=1;
        $is_yuanming=0;
        $dir1=$dir2=$dir3="file/";//上传文件夹
		$cengci="../../../";

		$width1=200;//小图宽度
		$width2=300;//中图宽度
		$tmpid=trim($_REQUEST["tmpid"]);
		$value=trim($_REQUEST["value"]);
		$value=str_ireplace("[jh]","+",$value);
		$index=trim($_REQUEST["index"]);
		$ext=trim($_REQUEST["ext"]);
	    $num=intval($_REQUEST["num"]);
		$filename=trim($_REQUEST["filename"]);
		$tmp_path="tmp/".$tmpid."_".$index.".txt";
		$myfile =fopen($tmp_path,"w+");
		fwrite($myfile, $value);
		fclose($myfile);
		if($index!=$num){
		   echo "{\"status\":\"dengdai\",\"index\":\"$index\",\"msg\":\"$index分段上传成功\"}";
		   exit(); //停止向下运行
		}
		
		
		 $rannum=NewRand(5);
		 $bilv=round($bilv,6); //保留6位小数
		 $nameqz=trim($_REQUEST["nameqz"]);
		 if($nameqz==""){
		    $nameqz=date("YmdHis");
		 }
		 $dir1=$dir1.date("Ym")."/";
		 if (!file_exists($cengci.$dir1)){ 
		     mkdir ($cengci.$dir1);
		 }
		 $dir2=$dir2.date("Ym")."/";
		 if (!file_exists($cengci.$dir2)){ 
		     mkdir ($cengci.$dir2);
		 }
		 $dir3=$dir3.date("Ym")."/";
		 if (!file_exists($cengci.$dir3)){ 
		     mkdir ($cengci.$dir3);
		 }
		 $filename=$_REQUEST["filename"];
		 $newname=$nameqz."".$rannum;        //新文件名,不带后缀
		 $ext=strtolower($ext);
		 if($is_ym==1){
		   $newname=trim($_REQUEST["filename"]);
		 }
	    $numsuccess=0;
	    $status="";
		$msg="";
		for($i=1;$i<=$num;$i++){
			$fullpath="tmp/".$tmpid."_".$i.".txt";
			if(file_exists($fullpath)){
				$numsuccess=$numsuccess+1;
			}else{
				$msg=$msg.",".$i;
				$status="error";
			}
		}
	   $isbool=0;
	   if($numsuccess==$num){
			for($i=1;$i<=$num;$i++){
				$fullpath="tmp/".$tmpid."_".$i.".txt";
				$myfile1 = fopen($fullpath, "r") ;
				$base64=$base64.fread($myfile1,filesize($fullpath));
				fclose($myfile1);
				@unlink($fullpath);
			}
			$isbool=1;
	   }
	  if($isbool==1){  //可以合并
		if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
				if($dir1==$dir2&&$dir2==$dir3){
					$small_src=$dir1.$newname.".".$ext;
					$mid_src=$dir2.$newname.".".$ext.".".$ext;
					$big_src=$dir3.$newname.".".$ext.".".$ext.".".$ext;
				}else{
					$small_src=$dir1.$newname.".".$ext;
					$mid_src=$dir2.$newname.".".$ext;
					$big_src=$dir3.$newname.".".$ext;
				}
				$small_fullpath=$cengci.$small_src;
				$mid_fullpath=$cengci.$mid_src;
				$big_fullpath=$cengci.$big_src;// gd-jpeg, libjpeg: recoverable error: Corrupt JPEG data: premature end of data segment
				
				$pathstr=SaveBase64($big_fullpath,$base64);
				$imginfo= getimagesize($big_fullpath); 
				$arr=explode("/",end($imginfo));
				$shiji_ext=$arr[1];
				//exit($shiji_ext);
				if(trim($shiji_ext)=="png"){
				  $thisim = imagecreatefrompng($big_fullpath);
				}else if(trim($shiji_ext)=="gif"){
				  $thisim = imagecreatefromgif($big_fullpath);
				}else if(trim($shiji_ext)=="bmp"){
				  $thisim =imagecreatefromwbmp($big_fullpath); 
				}else if(trim($shiji_ext)=="jpg"){
				  $thisim =imagecreatefromjpeg($big_fullpath); 
				}else if(trim($shiji_ext)=="jpeg"){
				  $thisim =imagecreatefromjpeg($big_fullpath); 
				}else{
				  $thisim = imagecreatefromjpeg($big_fullpath);	
				}	
				$oldwidth= imagesx($thisim);
				$oldheight=imagesy($thisim);
				$bilv=$oldwidth/$oldheight;
				$color = imagecolorat($thisim,1,1);//获取左上角这个点的图片颜色
				$color=dechex($color);//转为16进制
				if($is_small==1){
					$maxwidth=$width1;
					$maxheight=$height1=($width1/$bilv);
					SavePhoto($thisim,$maxwidth,$maxheight,$width1,$height1,0,0,$small_fullpath);//小图
					
				}else{
			    	$small_src=$big_src;
				}
				if($is_mid==1){
					$maxwidth=$width2;
					$maxheight=$height2=($width2/$bilv);
					  SavePhoto($thisim,$maxwidth,$maxheight,$width2,$height2,0,0,$mid_fullpath);//中图
				}else{
			    	$mid_src=$big_src;
				}
			    $status="success";
		 }else if ($ext=="doc" || $ext=="docx" || $ext=="xls" || $ext=="xlsx"|| $ext=="txt"|| $ext=="rar"){
		        $big_src=$newname.".".$ext;
				$big_fullpath=$cengci.$dir1.$big_src;
				$small_src=$big_src;
				$mid_src=$big_src;
		        $pathstr=SaveBase64($big_fullpath,$base64);
				$status="success";
		 }else{
		    $status="not";
		 }
		      
	  }else{
	           $status="error";
	  }
    echo ("{\"status\":\"".$status."\",\"msg\":\"$msg\",\"small_src\":\"".$small_src."\",\"mid_src\":\"".$mid_src."\",\"big_src\":\"".$big_src."\",\"filename\":\"".$filename."\"}");//上传成功返回
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
function NewRand($median_){
	  $str_="";
	  $minno="";
	  $maxno="";
	  if(is_numeric($median_)){
			for($i_=0;$i_<$median_;$i_++){
			   $f=rand(0,9);
			   if($f==0){$f=1;}
			   $str_.=$f;
			}
	  }
	  return $str_;
}
//http://blog.chinaunix.net/uid-15223977-id-2774358.html
?>

