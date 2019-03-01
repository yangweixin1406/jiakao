<?php
//echo "<script>alert('".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."')</scri'pt>";

class image{
public  $uptypes=array('image/jpg','image/jpeg','image/png','image/pjpeg','image/jpege','image/gif','image/bmp','image/x-png'); 
public  $maxfilesize=5000000;   //上传文件大小限制, 单位BYTE
public  $watermark=0;   //是否附加水印(1为加水印,其他为不加水印);
public  $watertype=2;   //水印类型(1为文字,2为图片)
public  $waterposition=1;   //水印位置(1为左下角,2为右下角,3为左上角,4为右上角,5为居中);
public  $waterstring="newphp.site.cz"; //水印字符串
public  $waterimgPath="db/image.png";  //水印图片
public  $imgpreview=1;   //是否生成预览图(1为生成,其他为不生成);
public  $imgpreviewsize=1;  //缩略图比例
public  $oldx=0;
public  $oldy=0;
public  $position="TL";
public  $state="W";
public  $thisim="";
function NewPicture($folder,$quan,$width,$height,$state,$postion,$isold){
		if($_SERVER['REQUEST_METHOD']=="POST"){
				$folder=$folder."data/".(date("Ym"))."/";
				if(!is_dir($quan.$folder)){mkdir($quan.$folder,0777);}
				$mydb=$GLOBALS['mydb'];
				$file=$_FILES['upfile'];
				$tempFile = $file['tmp_name'];
				$newpath_n=$folder;
				$newpath=$quan.$newpath_n;
				$qianName=time().NewRand(10);
				$size=$file['size'];
				$filename=$file["tmp_name"];//文件名
				$newfilesize = $file['size'];//文件大小 
				$pinfo=pathinfo($file["name"]);//文件信息数组
				$fileTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions	
				$fileext=strtolower($pinfo["extension"]);//转为小写
				$bl=0;
				if(in_array($fileext,$fileTypes)){
				  $image_size= getimagesize($file['tmp_name']);
				  $oldwidth=$image_size[0];
				  $oldheight=$image_size[1];
				  $bl=($oldwidth/$oldheight);
				  $bl=round($bl, 2);
				}
				$images_id=NewSort($mydb->tabletou."images","id");
				$qianName.="_".$images_id."_".$bl;
				$newpathfile_small=$newpath."".$qianName.".".$fileext;
				$newpathfile_mid=$newpath."".$qianName.".".$fileext.".".$fileext;
				$newpathfile_big=$newpath."".$qianName.".".$fileext.".".$fileext.".".$fileext;
				$pathfile_n=$newpath_n."".$qianName.".".$fileext;
				
				$type1=$file['type'];
				InsertImage1($images_id,$pinfo["basename"],$pathfile_n,$_SESSION["JXAdminName"],$color1);
				if (in_array($fileext,$fileTypes)) {
					if(move_uploaded_file($tempFile,$newpathfile_big)){
						// move_uploaded_file($tempFile,$pathfile_big);
						 //copy($pathfile,$pathfile_big);
						if($size){
								if(trim($fileext)=="png"){
								$this->thisim = imagecreatefrompng($newpathfile_big);
								}else if(trim($fileext)=="gif"){
								$this->thisim = imagecreatefromgif($newpathfile_big);
								}else if(trim($fileext)=="bmp"){
								$this->thisim =imagecreatefromwbmp($newpathfile_big); 
								}else if(trim($fileext)=="jpg"){
								$this->thisim =imagecreatefromjpeg($newpathfile_big); 
								}else{
								$this->thisim = imagecreatefromjpeg($newpathfile_big);	
								}
								
								//$arr=explode(".",$file['name']);		 	  
								$_SESSION["smallimage"]=$pathfile_n;
								$color1 = imagecolorat($this->thisim,1,1);
								$color1=dechex($color1);//转为16进制
								if($color1!=""){
								 $mydb->myQuery("update ".$mydb->tabletou."images set imagergb='#".$color1."' where id=".$images_id);
								}
				//						if($isold!=1){//是否保持原图
				//						$this->NewImg($this->thisim,$newpathfile_small,$oldwidth,$oldheight,$width,$height,$state,$postion);
				//						}
						  
						  $productimagewh=$mydb->GetValue("select productimagewh from ".$mydb->tabletou."config where id=1","");
						  $arrWH=explode("||",$productimagewh);
						  $arrWH1=explode(",",$arrWH[0]);
						  $arrWH2=explode(",",$arrWH[1]);
						  $this->NewImg($this->thisim,$newpathfile_small,$oldwidth,$oldheight,$arrWH1[0],$arrWH1[1],"WH",0);
						  $this->NewImg($this->thisim,$newpathfile_mid,$oldwidth,$oldheight,$arrWH2[0],$arrWH2[1],"W",0);
								
						}
				   }
				}
		}
} 

/*生成带水印图片开始*/
function uploadImage($im1,$XYWidthHeight){
$im=$im1;
//	echo "<script>alert('".imagesy($im)."');</script'>";
$_x=$XYWidthHeight[0];
$_y=$XYWidthHeight[1];
$newwidth=$XYWidthHeight[2];
$newheight=$XYWidthHeight[3];
$_oldx=$XYWidthHeight[4];
$_oldy=$XYWidthHeight[5];
$smallwidth=$XYWidthHeight[6];
$smallheight=$XYWidthHeight[7];
$medium_W=$XYWidthHeight[8];
$medium_H=$XYWidthHeight[9];


if(function_exists("imagecopyresampled")){
$newim = imagecreatetruecolor($smallwidth, $smallheight);
$red = imagecolorallocate($newim, 255, 255, 255);
imagefill($newim, 0, 0, $red);
imagecopyresampled($newim, $im, $_x, $_y, 0, 0, $newwidth,
$newheight, imagesx($im), imagesy($im));
}else{
$newim = imagecreate($smallwidth, $smallheight);
imagecopyresized($newim, $im, $_x, $_y, 0, 0, $newwidth,
$newheight, imagesx($im), imagesy($im));
}
//echo $this->smallimage;
ImageJpeg($newim,$this->smallimage,85);
//ImageJpeg($newim,$this->smallImageFolder.$this->_smallImageName,100);
//ImageJpeg($im,$this->bigImageFolder.$this->_smallImageName,100);
ImageDestroy($newim);


}
function NewImage20140623($file,$quan,$folder,$postion,$ziduan,$adminname){
$mydb=$GLOBALS['mydb'];
$tempFile = $file['tmp_name'];
$newpath_n=$folder;
$newpath=$quan.$newpath_n;
$qianName=time().NewRand(10);
$size=$file['size'];
$filename=$file["tmp_name"];//文件名
$newfilesize = $file['size'];//文件大小 
$pinfo=pathinfo($file["name"]);//文件信息数组
$fileTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions	
//$fileext=strtolower($pinfo["extension"]);//这样获取图片后缀太垃圾，万不可，转为小写
$infos= getimagesize($file['tmp_name']);//获取文件相关信息,可以获取图片宽高等，var_dump($infos)输出数组看看
$arr=explode("/",end($infos));
$fileext=strtolower($arr[1]);//获取真实的文件后缀

$bl=0;
if(in_array($fileext,$fileTypes)){
$image_size= getimagesize($file['tmp_name']);
$oldwidth=$image_size[0];
$oldheight=$image_size[1];
$bl=($oldwidth/$oldheight);
$bl=round($bl, 2);
}
$images_id=NewSort($mydb->tabletou."images","id");
$qianName.="_".$images_id."_".$bl;
$newpathfile_small=$newpath."".$qianName.".".$fileext;
$newpathfile_mid=$newpath."".$qianName.".".$fileext.".".$fileext;
$newpathfile_big=$newpath."".$qianName.".".$fileext.".".$fileext.".".$fileext;
$pathfile_n=$newpath_n."".$qianName.".".$fileext;
$type1=$file['type'];
InsertImage1($images_id,$file['name'],$pathfile_n,$adminname,$color1);
if (in_array($fileext,$fileTypes)) {
	if(move_uploaded_file($tempFile,$newpathfile_big)){
		// move_uploaded_file($tempFile,$pathfile_big);
		 //copy($pathfile,$pathfile_big);
		if($size){
				if(trim($fileext)=="png"){
				$this->thisim = imagecreatefrompng($newpathfile_big);
				}else if(trim($fileext)=="gif"){
				$this->thisim = imagecreatefromgif($newpathfile_big);
				}else if(trim($fileext)=="bmp"){
				$this->thisim =imagecreatefromwbmp($newpathfile_big); 
				}else if(trim($fileext)=="jpg"){
				$this->thisim =imagecreatefromjpeg($newpathfile_big); 
				}else{
				$this->thisim = imagecreatefromjpeg($newpathfile_big);	
				} 	  
				$_SESSION["smallimage"]=$pathfile_n;
				$color1 = imagecolorat($this->thisim,1,1);
				$color1=dechex($color1);//转为16进制

				if($color1!=""){
				 $mydb->myQuery("update ".$mydb->tabletou."images set imagergb='#".$color1."' where id=".$images_id);
				}
				$productimagewh=$mydb->GetValue("select ".$ziduan." from ".$mydb->tabletou."config where id=1","");
				$arrWH=explode("||",$productimagewh);
				$arrWH1=explode(",",$arrWH[0]);
				$arrWH2=explode(",",$arrWH[1]);
				$this->NewImg($this->thisim,$newpathfile_small,$oldwidth,$oldheight,$arrWH1[0],$arrWH1[1],"WH",0);
				$this->NewImg($this->thisim,$newpathfile_mid,$oldwidth,$oldheight,$arrWH2[0],$arrWH2[1],"W",0);
		}
   }
  
}
return $pathfile_n;

}
function PiLiangImg($newpath_n,$path_quan,$hou_name){
	if($_SERVER['REQUEST_METHOD']=="POST"){
			$tempFile = $file['tmp_name'];
			$path_quan="../../";
			$newpath_n=$_SESSION["PathP"];
			$newpath=$path_quan.$newpath_n;
			$qianName=time().NewRand(10);
			if(!is_dir($newpath)){mkdir($newpath,0777);}
			$ImageListP=trim($_SESSION["ImageListP"]);
			$arr=explode(".",$file['name']);	 
			if($ImageListP==""){
				$_SESSION["ImageListP"]=$newfilename_n;
				$_SESSION["ImageNameP"]=$pinfo["basename"]; 
			}else{
				$_SESSION["ImageListP"].="##".$newfilename_n; 
				$_SESSION["ImageNameP"].="##".$pinfo["basename"]; 
			} 
			$mydb=$GLOBALS['mydb'];
			$productimagewh=$mydb->GetValue("select productimagewh from ".$mydb->tabletou."config where id=1","");
			$arrWH=explode("||",$productimagewh);
			$arrWH1=explode(",",$arrWH[0]);
			$arrWH2=explode(",",$arrWH[1]);
			InsertImage($pinfo["basename"],$newfilename_n,$_SESSION["JXAdminName"],$color1);
			$this->NewImg($this->thisim,$newpathfile_small,$oldwidth,$oldheight,$arrWH1[0],$arrWH1[1],"WH",0);
			$this->NewImg($this->thisim,$newpathfile_mid,$oldwidth,$oldheight,$arrWH2[0],$arrWH2[1],"W",0);
	}
}  
function NewImg($thisim,$newimagepath,$oldwidth,$oldheight,$maxwidth,$maxheight,$state,$position){
		$y=0;//y坐标
		$x=0;//y坐标;
		$wh=$oldwidth/$oldheight;
		$_wh=$maxwidth/$maxheight;
	  //生成实际高度
		if($state=="H"){ 
		  $_height=$maxheight;
		  $_width=$_height*$wh;
		}
		if($state=="W"){ 
		  $_width=$maxwidth;
		  $_height=$_width/$wh;
		}
		if($state=="WH"){ 
		  if($wh<$_wh){
			$_height=$maxheight;
			$_width=$_height*$wh;
		  }else{
			$_width=$maxwidth;
			$_height=$maxwidth/$wh;
		  }
		}
	   //坐标
		if($position=="TL"){
		  $y=0;//y坐标
		  $x=0;//y坐标;
		}
		if($postion=="TR"){
		  $y=0;//y坐标
		  $x=$_width;//y坐标;
		}
		if($position=="BL"){
		  $y=$maxheight-$_height;//y坐标
		  $x=0;//y坐标;
		}
		if($position=="BR"){
		  $y=$maxheight-$_height;//y坐标
		  $x=$maxwidth-$_width;//x坐标
		}
		if($position=="TC"){
		  $y=0;//y坐标
		  $x=$maxwidth/2-$_width/2;//x坐标;
		}
		if($position=="BC"){
		  $y=$maxheight-$_height;//y坐标
		  $x=$maxwidth/2-$_width/2;//x坐标;
		}
		if($position=="CL"){
		  $y=$maxheight/2-$_height/2;//y坐标
		  $x=0;//x坐标;
		}
		if($position=="CR"){
		  $x=0;//x坐标;
		  $y=$maxheight/2-$_height/2;//x坐标;
		}
		if($position=="CC"){
		  $y=$maxheight/2-$_height/2;//y坐标
		  $x=$maxwidth/2-$_width/2;//x坐标;
		}
		if($position=="WC"){  //按宽度并集中
			if($wh>$_wh){
			  $y=$maxheight/2-$_height/2;//y坐标
			  $x=0;
			}else{
			  $x=$maxwidth/2-$_width/2;//y坐标
			  $y=0;
			}
		}
		if($position=="HC"){   //按高度并集中
			if($wh>$_wh){
			  $y=$maxheight/2-$_height/2;//y坐标
			  $x=0;
			}else{
			  $x=$maxwidth/2-$_width/2;//y坐标
			  $y=0;
			}
		}
		if($position==0){
			$x=0;
			$y=0;
			$maxheight=$_height;
			$maxwidth=$_width;
		}
		$this->Save($thisim,$maxwidth,$maxheight,$_width,$_height,$x,$y,$newimagepath);
}
function Save($thisim,$maxwidth,$maxheight,$_width,$_height,$x,$y,$newimagepath){
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
/////类结束
}




?>