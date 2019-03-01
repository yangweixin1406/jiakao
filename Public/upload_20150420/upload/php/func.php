<?php
error_reporting(E_ALL & ~ E_NOTICE);
date_default_timezone_set('Asia/Shanghai');
function DelImg($cengci,$src,$no){
	  @unlink($cengci.$src);
	  return $cengci.$src;
}

function DelPhoto($fullpath1,$fullpath2,$fullpath3){
	  @unlink($fullpath1);
	  @unlink($fullpath2);
	  @unlink($fullpath3);
}
function SaveBase64($fullpath,$base64){
	  $img = base64_decode($base64);
	  file_put_contents($fullpath, $img);
}
function NewSort($table1,$field1)
    {
		  $mydb=$GLOBALS["mydb"];
		  $sql="select max(" . $field1 . ")+1 as maxSort from " .$table1;
		  $rs=$mydb->myQuery($sql);
		  while($row=mysql_fetch_array($rs)){
		  $str_ = $row["maxSort"];
		  }
		  if(trim($str_)==""){
		  $str_="1";
		  }
		  return $str_;
}
function InsertImage1($id,$name,$image,$adminname,$color){
         $mydb=$GLOBALS["mydb"];
		 $arr=explode(".",$image);
	    $fsThisTime=date("Y-m-d H:i:s");
		if($color!=""){
			$color="#".$color;
		}
		$fsNewId=NewSort($mydb->tabletou."images","fsId");
		 $sql_="insert into ".$mydb->tabletou."images(fsId,fsSort,fsThisTime,fsName,fsImage,fsState,fsAdminName,fsImageRGB) values(";
		 $sql_.="".$id.",";
		 $sql_.="".$id.",";
		 $sql_.="'".$fsThisTime."',";//$arr[sizeof($arr)-1]
		 $sql_.="'".$name."',";
		 $sql_.="'".$image."',";
		 $sql_.="0,";
		 $sql_.="'".$adminname."',";
		 $sql_.="'".$color."'";
		 $sql_.=")";
		 $mydb->myQuery($sql_);

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
function GetFirstValue($sql){
	  return intval("1");
}
function CheckSql($str){
	$str=trim($str);
	//$str = preg_replace("/[\r\n]+/", '<br/>', $str);
	//$str = str_ireplace("\n\r","[rn]",$str);
	$str = str_ireplace("[script]","script",$str);
	$str = str_ireplace("script","[script]",$str);
	$str = str_ireplace("and","&#97;nd",$str);
	$str = str_ireplace("execute","&#101;xecute",$str);
	$str = str_ireplace("update","&#117;pdate",$str);
	$str = str_ireplace("count","&#99;ount",$str);
	$str = str_ireplace("mid","&#109;id",$str);
	$str = str_ireplace("master","&#109;aster",$str);
	$str = str_ireplace("truncate","&#116;runcate",$str);
	$str = str_ireplace("char","&#99;har",$str);
	$str = str_ireplace("create","&#99;reate",$str);
	$str = str_ireplace("delete","&#100;elete",$str);
	$str = str_ireplace("insert","&#105;nsert",$str);
	$str = str_ireplace("or","&#111;r",$str);
	$str = str_ireplace("'","&#39;",$str);
	$str = str_ireplace("\"","&#34;",$str);
	//$str = str_ireplace("%20","",$str);
	//$str = str_ireplace(" ","",$str);
	$str = str_ireplace("(","&#40;",$str);
	$str = str_ireplace(")","&#41;",$str);
	$str = str_ireplace("*","&#42;",$str);
	//$str = str_ireplace("+","&#43;",$str);
	$str = str_ireplace(",","&#44;",$str);
	//$str = str_ireplace("-","&#45;",$str);
	//$str = str_ireplace("<","&#60;",$str);
	//$str = str_ireplace("=","&#61;",$str);
	//$str = str_ireplace(">","&#62;",$str);
	//$str = str_ireplace("&quot","",$str);
	$str = str_ireplace("#yu#","&",$str);
	$str = str_ireplace("#cxc#","&",$str);
	$str = str_ireplace("#jia#","+",$str);
	$str = str_ireplace("`","&#96;",$str);
	return $str;
}
function IsMyWeb(){
$youUrl=strtolower($_SERVER['HTTP_REFERER']);
$myUrl=strtolower("http://".$_SERVER['HTTP_HOST']."/");
 if(substr($youUrl,0,strlen($myUrl))==$myUrl){
	 return 1;
 }else{
	 return 0;
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
function UpImg($file,$cengci,$dir1,$dir2,$dir3,$w1,$w2){
		$size=$file['size'];
		$filename=$file["tmp_name"];//文件名
		$newfilesize = $file['size'];//文件大小
		$exts=explode("/",$file['type']); 
		$fileext=$exts[1];
		$pinfo=pathinfo($file["name"]);//文件信息数组
		$fileTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions	

		$ext=$fileext=strtolower($pinfo["extension"]);//转为小写
		$image_size= getimagesize($file['tmp_name']);
		$oldwidth=$image_size[0];
		$oldheight=$image_size[1];
		$bilv=($oldwidth/$oldheight);
        $bilv=round($bilv, 6);
		

		$w1=$w1; //小图宽度
		$h1=$w1/$bilv;
		$w2=$w2;  //中图宽度
		$h2=$w2/$bilv;
		$pathstr="";
		if (in_array($fileext,$fileTypes)){
			$bilv=round($bilv, 6);
			$newname=date("YmdHis").$rannum;
			//$newname=str_ireplace(".".$ext,"",$filename);
			//$newid=GetFirstValue("select MAX(id) as myid from images");
			if($newid!=""){$newid=$newid+1; }else{ $newid=1; }
			$newname=$newname."_".$newid."_".$bilv;        //名称格式：数字+images表id+图片宽高比率 例214111111_2_0.2.jpg
			$filename=$newname.".".$ext;
			//$filename=$file["name"];
			$bigfullpath=$cengci.$dir3.$filename;
			$pathstr=$dir1.$filename;
			if(move_uploaded_file($file['tmp_name'],$bigfullpath)){
                    $imginfo= getimagesize($bigfullpath); 
					//print_r($imginfo); 
					$arr=explode("/",end($imginfo));
					$shiji_ext=$arr[1];
				  if(trim($shiji_ext)=="png"){
					$thisim = imagecreatefrompng($bigfullpath);
				  }else if(trim($shiji_ext)=="gif"){
					$thisim = imagecreatefromgif($bigfullpath);
				  }else if(trim($shiji_ext)=="bmp"){
					$thisim =imagecreatefromwbmp($bigfullpath); 
				  }else if(trim($shiji_ext)=="jpg"){
					$thisim =imagecreatefromjpeg($bigfullpath); 
				  }else{
					$thisim = imagecreatefromjpeg($bigfullpath);	
				  }	
				  $oldwidth= imagesx($thisim);
				  $oldheight=imagesy($thisim);
				  
				  $maxwidth=$_width=$w1;
				  $maxheight=$h1;
				  $_height=$_width/$bilv;
				  SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,0,0,$cengci.$dir1.$filename);//小图
				  
				  $maxwidth=$_width=$w2;
				  $maxheight=$h2;
				  $_height=$_width/$bilv;
				  SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,0,0,$cengci.$dir2.$filename);//中图
				  //echo $pathstr;
			}
		}
		return $pathstr;
}
?>