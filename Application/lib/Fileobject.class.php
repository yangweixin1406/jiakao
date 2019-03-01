<?php 
namespace lib;
class  Fileobject{
    public function check_dir_create($cengci,$dir){  //检查文件夹是否在存如不存在则创建
		       $arr=explode("/",$dir);
			   $dir1="";
			   for($j=0;$j<count($arr);$j++){
			      $dir1.=$arr[$j]."/";
				  $folder=$cengci.$dir1;
				  if(!is_dir($folder)){
						   mkdir($folder,0777);
				   }
			   }       
   }
	function get_haibao($imgs,$myhbimgpath,$font="include/font/msyh.ttf"){ //生成海报
	
		global $pe;
	
		/**
	
		* 图片合并
	
		**/
		//$pic_list	 = array_slice($pic_list, 0, 6); // 只操作前6个图片
	
		$bg_w	 = $imgs[0]['pw'];	// 背景图片宽度
	
		$bg_h	 = $imgs[0]['ph'];	// 背景图片高度
		$background	= imagecreatetruecolor($bg_w,$bg_h); // 背景图片	
	
		foreach( $imgs as $k=>$val ) {
			$info=$imgs[$k]['info'];
			$start_x=$imgs[$k]['sx'];
			$start_y=$imgs[$k]['sy'];
			$type=$imgs[$k]['type'];
			
			$pic_path=$info;
			$cl = imagecolorallocate($background,0,0,0);
			if($type=="txt"){
			    $fontsize=intval($imgs[$k]['fontsize']);
				if(isset($imgs[$k]['align'])){
				$left=$imgs[$k]['left'];
				$text1=$pic_path;
				$fontColor=$cl;
				if(isset($imgs[$k]['font'])){
				   $font=$imgs[$k]['font'];
				}
				$fontBox = imagettfbbox($fontsize, 0, $font, $text1);//文字水平居中实质
				  imagettftext ( $background, $fontsize, 0, ceil(($bg_w-$fontBox[2])/2)+$left, $start_y, $fontColor, $font, $text1 );
				}else{
				  imagettftext($background,$fontsize,0,$start_x,$start_y,$cl,$font,$pic_path);
				}
			}else{
				$pic_w=$imgs[$k]['pw'];
				$pic_h=$imgs[$k]['ph'];
				$img_info = getimagesize($pic_path); 
				$w=$img_info[0];
				$h=$img_info[1];
				$bilv=$w/$h;
				if($imgs[$k]['ph']=="auto"){
				   $pic_h=$pic_w/$bilv;
				}
				if($imgs[$k]['pw']=="auto"){
				   $pic_w=$pic_h*$bilv;
				}
			   
			$pathInfo	 = pathinfo($pic_path);
		
			switch( strtolower($pathInfo['extension']) ) {
	
				case 'jpg':
				  $imagecreatefromjpeg	= 'imagecreatefromjpeg';
				  break;
	
				case 'jpeg':
	
					$imagecreatefromjpeg	= 'imagecreatefromjpeg';
	
				break;
	
				case 'png':
	
					$imagecreatefromjpeg	= 'imagecreatefrompng';
	
				break;
	
				case 'gif':
	
				default:
	
					$imagecreatefromjpeg	= 'imagecreatefromstring';
	
					$pic_path    = file_get_contents($pic_path);
	
				break;
	
			}
	
			$resource	= $imagecreatefromjpeg($pic_path);
	
			// $start_x,$start_y copy图片在背景中的位置
	
			// 0,0 被copy图片的位置
	
			// $pic_w,$pic_h copy后的高度和宽度
	
			imagecopyresized($background,$resource,$start_x,$start_y,0,0,$pic_w,$pic_h,imagesx($resource),imagesy($resource)); // 最后两个参数为原始图片宽度和高度，倒数两个参数为copy时的图片宽度和高度
		   }
			
	
		}
	
		
	
		//$cl = imagecolorallocate($background,0,0,255);
	
		//$nickname = iconv('gbk','utf-8',$nickname);//解决乱码问题
	
		//$nickname = mb_convert_encoding($nickname, "GBK", "UTF-8");
	
		//p($nickname);
	
		//imagettftext($background,22,0,215,69,$cl,'include/data/msyh.ttf',$nickname);
	
	
	
		//imagestring($background, 5, 0, 0,$nickname, $cl);
	
		//header("Content-type: image/jpg");
	
		return imagejpeg($background,$myhbimgpath,100);
	
	}
	
	function code_img($str,$fontsize){//验证码函数
	
		$str=$str?$str:random(6,'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789');
	
		$fontsize=$fontsize?$fontsize:20;
	
		$font='font/elephant.ttf';
	
		$image_info = imagettfbbox($fontsize,0,$font,$str);
	
		$img_w = $image_info[2]-$image_info[0]+16;
	
		$img_h = $image_info[1]-$image_info[7]+16;
	
		//p($image_info);
	
		$im = imagecreatetruecolor($img_w,$img_h);	
	
		$color = imagecolorallocate($im,mt_rand(157,255),mt_rand(157,255),mt_rand(157,255));
	
		imagefilledrectangle($im,0,$img_h,$img_w,0,$color);
	
		$fontcolor = imagecolorallocate($im,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
	
		imagettftext($im,$fontsize,0,8,$img_h-8,$fontcolor,$font,$str);
	
		//p();
	
		header('Content-type:image/png');
	
		imagepng($im);
	
		imagedestroy($im);
	
	}
	function get_photo($url,$cengci,$filename='',$savefile='data/myimg/'){ //获取远程图片并保存
	
		global $pe;
	
		if(!$url or !$filename) return false;	
	
		$ext=strtolower(end(explode('.',$url)));
	
		$imgArr = array('gif','bmp','png','ico','jpg','jepg');  
	
		if(!in_array($ext,$imgArr))$ext='jpg';
	
	   
	
		$img = file_get_contents($url); 
	
		if($img){
	
			$filename=$filename.'.'.$ext;  
	
			if(!is_dir($savefile)) mkdir($savefile, 0777);
	
			if(!is_readable($savefile)) chmod($savefile, 0777);
	
			$filepath = $cengci.$savefile.$filename;
	
			file_put_contents($filepath,$img); 
	
			return $savefile.$filename; 
	
		}
	
		else return false;
	
	}
}
?>