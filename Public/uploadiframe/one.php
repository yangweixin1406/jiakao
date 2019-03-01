<?php session_start();error_reporting(E_ALL & ~ E_NOTICE);
		$gourl=CurUrl("");
		$w1=200;//小图宽度
		$quan=$_GET['quan'];
		$folder=$_GET['folder'];
		$bttext=$_GET['bttext'];
		$inputid=$_GET['inputid'];
		$quan=$_GET['quan'];
		$bgsrc=$_GET['bgsrc'];
		$bgsrc1=$_GET['bgsrc1'];
		$func=$_GET['func'];
		$inputmoreid=$_GET['inputmoreid'];
		$qzimg=$_GET['qzimg'];
		$textalign=$_GET['textalign'];
		$classname=$_GET['classname'];
		$btwidth=$_GET['btwidth'];
	$btfontsize=$_GET['btfontsize'];
	$btclassname=$_GET['btclassname'];
	$isduoxuan=$_GET['isduoxuan'];
	$inputtitleid=$_GET['inputtitleid'];
	$issmall=trim($_GET['issmall']);
	$filename=trim($_GET['filename']);
	if($issmall==""){
	     $g_issmall=1;
	}else{
	      $g_issmall=0;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传</title>
<script>
//原创QQ632175205 网店https://shop73462995.taobao.com
var folder="<?php echo $folder;?>";
var inputid="<?php echo $inputid;?>";
var quan="<?php echo $quan;?>";
var bgsrc="<?php echo $bgsrc;?>";
var bgsrc1="<?php echo $bgsrc1;?>";
var func="<?php echo $func;?>";
var inputmoreid="<?php echo $inputmoreid;?>";
var return1="<?php echo $return;?>";
var input=window.parent.document.getElementById(inputid);
var qzimg="<?php echo trim($_GET["qzimg"]);?>";
var textalign="<?php echo $textalign;?>";
var classname="<?php echo $classname;?>";
var bttext="<?php echo $bttext;?>";
var btwidth="<?php echo $btwidth;?>";
var btfontsize="<?php echo $btfontsize;?>";
var btclassname="<?php echo $btclassname;?>";
var isduoxuan="<?php echo $isduoxuan;?>";
var inputtitleid="<?php echo $inputtitleid;?>";
var issmall="<?php echo $issmall;?>";
var inputtitle=null;
var inputmore=null;
if(inputid!=""){input=window.parent.document.getElementById(inputid);}
if(inputmoreid!=""){inputmore=window.parent.document.getElementById(inputmoreid);}
if(inputtitleid!=""){inputtitle=window.parent.document.getElementById(inputtitleid);}
function showImage(opt){ //返回值
//	if(input!=null){
//		if(return1=="id"){
//			input.value=id;
//		}else{
//	        input.value=path;
//		}
//		var arr=inputid.split("_");
//		  var div1=window.parent.document.getElementById(inputid+"_Div");
//		if(div1!=null){
//			div1.innerHTML="<img src='"+qzimg+path+"'/>";
//		}
//	}
	if(func!=""){
		window.parent[func](opt);
	}else{
	   if(input!=null){
	     input.value=opt.small;
	   }
	   showOne(opt);   
	}

}
function showOne(opt){
	if(input!=null){
		var arr=inputid.split("_");
		var div1=window.parent.document.getElementById(inputid+"_div");
		if(div1!=null&&opt.path!=""){
			div1.innerHTML="<a href='"+qzimg+opt.small+"' target='_blank'><img src='"+qzimg+opt.small+"' style='height:30px;'/></a>";
		}
	}
}
function init(){
	if(input!=null){
		 if(func==""){
		        showImage({small:input.value,inputid:input.id,qzimg:qzimg});
		 }
     }
}
function Upload(){
	 var mysubmit=document.getElementById("mysubmit");
	 if(mysubmit.click){
		 mysubmit.click(); 
	 }
	 if(mysubmit.submit){
		 mysubmit.submit(); 
	 }
	 document.getElementById("upform1").submit(); 
}
function UpfileClick(){
	 document.getElementById("upfile").click(); 
}
init();
</script>
<?php 
		
$isinsert=0;
if($isinsert){
 include("../../function/db_config.php");
 include("../../function/checksql.php");
 include("../../function/db.php");
}
$upladurl='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];



if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

   $quan="../../";
   if($folder==""){
      $folder="file/".date("Ym")."/";
   }else if($folder=="cert"){
      $folder="file/cert/";
   }else if($folder=="user"){
      $folder="file/user/";
   }else{
      $folder=$folder."/".date("Ym")."/";
   }
  
   if(!is_dir($quan.$folder)){
	   mkdir($quan.$folder,0777);
   }
   //$_SESSION[];
   
  if($_SERVER['REQUEST_METHOD']=="POST"){
	  
	  foreach($_FILES as $key=>$val){
		  $file=$_FILES[$key];
		  if($file['size']>0){
			$value=NewOneImage($file,$quan,$folder,$_SESSION["AdminName"],$_GET["type"]);
		  }
	  }
  }
}
function CurUrl($fen) 
{
     $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") 
    {
         $pageURL .= "s";
     }
     $pageURL .= "://";
    $this_page = $_SERVER["REQUEST_URI"];
	
    // 只取 ? 前面的内容
//     if (strpos($this_page, "?") !== false) 
//     $this_page = reset(explode("?", $this_page));
    if ($_SERVER["SERVER_PORT"] != "80") 
    {
         $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $this_page;
     } 
    else 
    {
         $pageURL .= $_SERVER["SERVER_NAME"] . $this_page;
     }
	 if($fen!=""){
		 $arr=explode($fen,$pageURL);
		 $pageURL=$arr[0];
	 }
     return $pageURL;
}


function NewOneImage($file,$quan,$folder,$adminname){
global $g_issmall;
global $filename;

$tempfile = $file['tmp_name'];
$size=$file['size'];//文件大小 
$tmp_name=$file["tmp_name"];//文件名

$pinfo=pathinfo($file["name"]);//文件信息数组
$imgTypes = array('jpg','jpeg','gif','png','bmp'); // File extensions	
$fileTypes = array('jpg','jpeg','gif','png','bmp','pem'); // File extensions	
//$fileext=strtolower($pinfo["extension"]);//这样获取图片后缀太垃圾，万不可，转为小写
$infos= getimagesize($file['tmp_name']);//获取文件相关信息,可以获取图片宽高等，var_dump($infos)输出数组看看


if(is_array($infos)){
$arr=explode("/",end($infos));
$ext=strtolower($arr[1]);//获取真实的文件后缀
}
$bl=0;
if($ext==""){
   $arr=explode(".",$file["name"]);
   $ext=end($arr);
}
$isupload=false;
if(in_array($ext,$fileTypes)){
  $isupload=true;
}
$isimg=0;
if(in_array($ext,$imgTypes)){
	$image_size= getimagesize($file['tmp_name']);
	$oldwidth=$image_size[0];
	$oldheight=$image_size[1];
	$bl=($oldwidth/$oldheight);
	$bl=round($bl, 2);//图片长宽比率
	 $isimg=1;
}
if(trim($filename)==""){
  $newname=time().NewRand(10);
}else{
$newname=$filename;
}
if($g_issmall==1&&$isimg==1){
  $dir1=$folder."s50/";
  $dir3=$folder."s100/";
   $smallpath=$dir1.$newname.".".$ext;
   $smallpath_full=$quan.$smallpath;
   $bigpath=$dir3.$newname.".".$ext;
   $bigpath_full=$quan.$bigpath;  
   if(!is_dir($quan.$dir1)){ mkdir($quan.$dir1,0777); }
   if(!is_dir($quan.$dir3)){ mkdir($quan.$dir3,0777); }

}else{
   $bigpath=$folder.$newname.".".$ext;
   $smallpath=$folder.$newname.".".$ext;
   $bigpath_full=$quan.$bigpath;  
   $g_issmall=0;
}
if($isupload==false){
  echo "<script>alert('{$ext}类型允许上传');window.location='".$gourl."';</script>";
  exit();
}


$maxsize=2;//m为单位
$type1=$file['type'];
$status="";

//InsertImage1($images_id,$file['name'],$pathfile_n,$adminname,$color1);
if (in_array($ext,$fileTypes)) {
	if($size){
		 if($size/1204/1204<2){

	      if(move_uploaded_file($tempfile,$bigpath_full)){
//              copy($pathfile,$pathfile_full);
          
		        if($g_issmall==1){
				   CreateSmall($bigpath_full,$smallpath_full,$GLOBALS["w1"],$GLOBALS["w1"]); 	  
				}else{
				   $smallpath=$bigpath;
				}
//
//				$color1 = imagecolorat($this->thisim,1,1);
//				$color1=dechex($color1);//转为16进制颜色值
           $status=$bigpath;
		}
	}else{
		 $status="maxsize";
	}
   }else{
	   $status="size";
   }
}else{
	   $status="type";
}
	 if($status=="type"){
		   echo "<script>alert('类型不正确');window.location='".$gourl."';</script>";
		   exit();
	 }else if($status=="maxsize"){
		  echo "<script>alert('图片不能超过2M');window.location='".$gourl."';</script>";
		  exit();
	 }else if($status=="size"){
		  echo "<script>alert('请上传图片');window.location='".$gourl."';</script>";
		  exit();
	 }else{
		  $title=$file["name"];
		  $data["name"]=$file["name"];
		  $data["image"]=$smallpath;
		  $data["src"]=$smallpath;
		  $data["addtime"]=date("Y-m-d H:i:s");
		  $data["idno"]=$_GET["idno"];
		  if($GLOBALS['isinsert']){
		     $mydb=new db();
		     $newid=$mydb->add(DB_QZ."images",$data);
		  }
		  echo ("<script>showImage({\"big\":\"".$bigpath."\",\"small\":\"".$smallpath."\",\"title\":\"".$title."\",\"inputid\":\"".$GLOBALS['inputid']."\",\"qzimg\":\"".$GLOBALS['qzimg']."\"});window.location='".$GLOBALS['gourl']."';</script>");
		  exit();
		 
	 }
    return $path;
}
function CreateSmall($pathfile_full,$newimagepath,$width,$height){
	      $arr=explode(".",$pathfile_full);
		  $ext=end($arr);
		  if(trim($ext)=="png"){
		  $thisim = imagecreatefrompng($pathfile_full);
		  }else if(trim($ext)=="gif"){
		  $thisim = imagecreatefromgif($pathfile_full);
		  }else if(trim($ext)=="bmp"){
		  $thisim =imagecreatefromwbmp($pathfile_full); 
		  }else if(trim($ext)=="jpg"){
		  $thisim =imagecreatefromjpeg($pathfile_full); 
		  }else{
		  $thisim = imagecreatefromjpeg($pathfile_full);	
		  }
		  $oldwidth= imagesx($thisim);
		  $oldheight=imagesy($thisim);
          $bilv=$oldwidth/$oldheight;
		  $x=0;
		  $y=0;
		  $maxwidth=$width;
		  $maxheight=$height;
		  $_width=$width;
		  $_height=$width/$bilv;
		  $maxheight= $_height;
		  //exit($bilv);
		 // $newim = imagecreatetruecolor($maxwidth, $maxheight);
		// exit($maxwidth."=".$maxheight);
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
	  $str_=""; $minno=""; $maxno="";
	  if(is_numeric($median_)){
			for($i_=0;$i_<$median_;$i_++){
			   $f=rand(0,9);
			   if($f==0){$f=1;}
			   $str_.=$f;
			}
	  }
	return $str_;
}
?>
<style>
*{font-size:12px; cursor:pointer;}
html,body{ padding:0px;margin:0px; background-color:transparent;}
.bt_lable{
		top:0px;height:23px; left:0px;
		position:absolute; z-index:5;
		background: #D0EEFF;
		border: 1px solid #99D3F5;
		border-radius: 4px;
		overflow: hidden;
		color: #1E88C7;
		text-decoration: none;
		line-height: 20px;
		height:100%;
		width:100%; 
		padding-top:4px;
		padding-bottom:4px;
		
	  
}
.bt_lable2{
		top:0px;height:23px; left:0px;
		position:absolute; z-index:5;
		background: #3399FF;
		border-radius: 0px;
		overflow: hidden;
		color: #ffffff;
		text-decoration: none;
		line-height: 20px;
		height:100%;
		width:100%; 
		padding-top:4px;
		padding-bottom:4px;
		 border:0px;
		 
}
.bt_lable2.hover{
	background:#33CCFF;
    color: #004974;
}
.bt_lable.hover{
	background: #AADFFD;
    color: #004974;
	border: 1px solid #99D3F5;
}
</style>
</head>
<body style="margin:0px; padding:0px; width:100%;overflow:hidden;" >
<div style=" position:relative;overflow:visible; width:100%;" id="mydiv">
<form  name="upform1" id="item1_upform1" enctype="multipart/form-data" method="post" action="<?php echo $gourl?>"  style="margin:0px; padding:0px; line-height:0px; border:0px;">
<input type="file" name="file1"  id="file1" accept="image/*" style="filter:alpha(Opacity=1);-moz-opacity:0.01;opacity:0.01;left:0px; cursor:pointer; position:absolute; width:70px; height:60px; z-index:1000"/>
<input type="submit" name="btsend" id="btsend" value="&nbsp;" style=" left:0px; position:absolute; background-color:transparent; border:0px; z-index:20000; top:50px;"/>
<input type="hidden" name="gourl" value="<?php echo $gourl?>"/>
</form>
<input  type="button" id="bt_lable" value="提交"   style=" top:0px; height:23px; left:0px; position:absolute; z-index:5;"/>
</div>
</body>
</html>
<script>

		var item1_upform1=document.getElementById("item1_upform1");
		
		var zindex=1000;
		var bt_lable=document.getElementById("bt_lable");
		if(bttext==""){
		bt_lable.value="\u300e\u70b9\u51fb\u4e0a\u4f20\u300f";//『点击上传』的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
		}
		if(bttext=="1"){
		
		 bt_lable.value="\u4e0a\u4f20\u65b0\u7167\u7247";//上传新照片的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
		}
	    window.cheight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
	    window.cwidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
		
		 var ua = navigator.userAgent;
		
		 var num=20;
		 var touch =("createTouch" in document);
		 var file1=document.getElementById("file1");
		 if(ua.indexOf("UCBrowser")!=-1&&touch){//手机uc浏览器
			 num=0;
			 file1.style.cssText="left:0px;cursor:pointer; position:absolute; width:"+(window.cwidth-4)+"px; height:"+(window.cheight-4)+"px; z-index:1000";
		 } 
		 
		 if(ua.indexOf("AppleWebKit")!=-1&&touch){//苹果
		   bt_lable.onclick=function(){
			 file1.click();
		   }
		   num=0;
		   file1.style.top="100px";  
		 }
 
		for(var i=0;i<num;i++){
						  var file=document.createElement("input");
						  zindex++;
						  file.type="file";
						  file.value="";
						  file.name="upfile_"+i;
						  file.id="upfile_"+i;
						  if(isduoxuan=="1"){
						   file.setAttribute("multiple","multiple");
						   }
						    file.setAttribute("accept","*");
						  var left=(-20)+(i%10)*30;
						  var top1=parseInt(i/10)*20;
						  file.style.cssText="filter:alpha(Opacity=1);-moz-opacity:0.01;opacity:0.01; left:"+left+"px; cursor:pointer; position:absolute;top:"+top1+"px;width:70px; height:70px; z-index:"+zindex+";";
						  file.onchange=function(){ 
						  bt_lable.value="\u6b63\u5728\u4e0a\u4f20";//正在上传的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
						   document.forms[0].enctype="multipart/form-data";
						   document.getElementById("btsend").click();
							   // document.getElementById("item1_upform1").submit();
							};
						 item1_upform1.appendChild(file);
						// window.setTimeout(function(){alert(44);document.getElementById("item1_upform1").submit();},6000);
						 
		}

		 var btsend=document.getElementById("btsend");
		 var file1=document.getElementById("file1");
		 file1.onchange=function(){
				// bt_lable.value="正在上传请稍后";
				 bt_lable.value="\u6b63\u5728\u4e0a\u4f20";//正在上传的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
			   //document.forms[0].enctype="multipart/form-data";
			   document.getElementById("btsend").click();
			   file1.style.display="none";
			   
		 }


        var body=document.getElementsByTagName("body")[0];
		
		

		body.style.height=window.cheight+"px";
		body.style.width=window.cwidth+"px";
		bt_lable.style.width=window.cwidth+"px";
		bt_lable.style.height=window.cheight+"px";
		bt_lable.style.lineHeight=window.cheight-8+"px";
		if(btfontsize!=""){
		    bt_lable.style.fontSize=btfontsize+"px";
		}
		bt_lable_class="bt_lable";
		if(btclassname!=""){
		  bt_lable_class=btclassname;
		  
		}
		
		if(bgsrc!=""){
			bt_lable.style.border="none";
			bt_lable.style.textIndent="-300px";
			bt_lable.style.overflow="hidden";
			bt_lable.style.background="url('"+bgsrc+"') center center no-repeat";
		}
		if(bgsrc!=""&&bgsrc1!=""){
			body.onmouseover=function(){
			   bt_lable.style.backgroundImage="url('"+bgsrc1+"')";	
			}
			body.onmouseout=function(){
				bt_lable.style.backgroundImage="url('"+bgsrc+"')";	
			}
		}else{
		  

             bt_lable.className=bt_lable_class;
			body.onmouseover=function(){
			    bt_lable.className=bt_lable_class+" hover";
			}
			body.onmouseout=function(){
				 bt_lable.className=bt_lable_class;
			}

		}
</script>

