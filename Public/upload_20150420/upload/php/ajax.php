<?php session_start();?>
<?php include("db_config.php");?>
<?php include("func.php");?>
<?php 
$act=$_REQUEST["act"];
$num = $_REQUEST["num"];   
$ext=trim($_REQUEST["ext"]);
$title=trim($_REQUEST["title"]);
$filesize=trim($_REQUEST["size"]);
$filename=trim($_REQUEST["filename"]);
$bilv=trim($_REQUEST["bilv"]);
//$mydb=new db();

$dir1=trim($_REQUEST["dir1"]); //小图文件夹
$dir2=trim($_REQUEST["dir2"]); //中图文件夹
$dir3=trim($_REQUEST["dir3"]); //大图文件夹
$w1=trim($_REQUEST["w1"]); //小图宽
$h1=trim($_REQUEST["h1"]); //小图高
$w2=trim($_REQUEST["w2"]); //中图宽
$h2=trim($_REQUEST["h2"]); //中图高

if(IsMyWeb()==0){
	echo "非法提交"; //不是通过本网站提交
	exit();
}

if($act=="up"){
	if($filename=="" and $title!="" and is_numeric($filesize))
	{
		 $rannum=NewRand(5);
		 $bilv=round($bilv,6); //保留6位小数
		 $newname=date("YmdHis").$rannum;
		 //$newid=NewSort($mydb->tabletou."images","fsId");
		 //if($newid!=""){$newid=$newid+1; }else{ $newid=1; }
		 $newid=1;
		 $newname=$newname."_".$newid."_".$bilv;        //名称格式：数字+images表id+图片宽高比率 例214111111_2_0.2.jpg
		 $filename=$newname.".".$ext;
		 $ext=strtolower($ext) ;
		 
		 if($is_yuanming==1){
		   $newname=trim($_REQUEST["title"]);
		   $filename=$newname.".".$ext;
		 }

		 
//		 InsertImage1($newid,$_REQUEST["title"].".".$ext,$smallsrc,trim($_SESSION["AdminName"]),$color1);
//		 $adddate=trim(date("Y-m-d H:i:s"));
//		 $username=$_Session["username"];
//		 $title=CheckStr($title);
//		 $classno="00010001" ;//图片分类编码
//		 $state="0";//表示未被使用
//		 $sql="insert into images(id,[sort],title,ext,src,filesize,username,classno,adddate,state) values(";
//		 $sql=$sql."".$newid.",".$newid.",'".$title."','".$ext."','".$src."',".$filesize.",'".$username."','".$classno."','".$adddate."','".$state."'";
//		 $sql=$sql.")";//将图片相关信息记录下来
		
		 if($ext=="bmp" || $ext=="jpg" || $ext=="png" || $ext=="gif"|| $ext=="jpeg"){
				  for($i=1;$i<=$num;$i++){
					$value1=trim($_REQUEST["value".$i]);
					$value1 = str_ireplace("[jh]","+",$value1);
					$base64 = $base64 . ($value1);
				  }
				  
				  $pathstr=SaveBase64($g_cengci.$dir3.$filename,$base64);
				  $bigfullpath=$g_cengci.$dir3.$filename;
				  
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
				  }else if(trim($shiji_ext)=="jpeg"){
					$thisim =imagecreatefromjpeg($bigfullpath); 
				  }else{
					$thisim = imagecreatefromjpeg($bigfullpath);	
				  }	
				  $oldwidth= imagesx($thisim);
				  $oldheight=imagesy($thisim);
				  $maxwidth=$_width=$w1;
				  $maxheight=$h1;
				  $_height=$_width/$bilv;
				  SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,0,0,$g_cengci.$dir1.$filename);//小图
				  $maxwidth=$_width=$w2;
				  $maxheight=$h2;
				  $_height=$_width/$bilv;
				  SavePhoto($thisim,$maxwidth,$maxheight,$_width,$_height,0,0,$g_cengci.$dir2.$filename);//中图

				  $color1 = imagecolorat($thisim,1,1);
				  $color1=dechex($color1);//转为16进制
				 //$mydb->myQuery("update ".$mydb->tabletou."images set  	fsImage='".$smallsrc."',fsImageRGB='".$color1."' where fsId='".$newid."'");
				  echo $dir1.$filename;
		 }

   }
}
if($act=="del"){
	  $no=trim($_REQUEST["no"]);
	  $path1=trim($_POST["path1"]);
	  $path2=trim($_POST["path2"]);
	  $path3=trim($_POST["path3"]);
	  DelPhoto($g_cengci.$path1,$g_cengci.$path2,$g_cengci.$path3);
}

//http://blog.chinaunix.net/uid-15223977-id-2774358.html
?>

