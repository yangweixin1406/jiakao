<?php 
function xiazai($file_dir,$file_name)
{
    header('Content-Type:text/html;charset=utf-8;');
     $file_dir = chop($file_dir);//去掉路径中多余的空格
     //得出要下载的文件的路径
     if($file_dir != '')
     {
         $file_path = $file_dir;
         if(substr($file_dir,strlen($file_dir)-1,strlen($file_dir)) != '/')
             $file_path .= '/';
         $file_path .= $file_name;
     }            
     else
      $file_path = $file_name;  
     //判断要下载的文件是否存在
    $file_path=iconv("UTF-8","GB2312",$file_path);//20160813 要加上这句不然中文不能下载
     if(!file_exists($file_path))
     {
    echo $file_path;
         echo('对不起,你要下载的文件不存在');
         return false;
     }
 
     $file_size = filesize($file_path);
	 $arr=explode("/",$file_name);
     $name=end($arr);
     header("Content-type: application/octet-stream;charset=gbk");
     header("Accept-Ranges: bytes");
     header("Accept-Length: $file_size");
     header("Content-Disposition: attachment; filename=".$name);
     
     $fp = fopen($file_path,"r");
     $buffer_size = 1024;
     $cur_pos = 0;
     
     while(!feof($fp)&&$file_size-$cur_pos>$buffer_size)
     {
         $buffer = fread($fp,$buffer_size);
         echo $buffer;
         $cur_pos += $buffer_size;
     }
     
     $buffer = fread($fp,$file_size-$cur_pos);
     echo $buffer;
     fclose($fp);
     return true;
} 
if(isset($_GET["path"])){
        $path=$_GET["path"];
		$cengci=$_GET["cengci"];
        if(strstr($path,".php")===false){//限制php不能下载
           xiazai("",$cengci.$path);
        }
}

?>