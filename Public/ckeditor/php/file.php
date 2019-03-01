<?php
	function ImagePath($ImageFolder){
	$i=0;
	$str=$ImageFolder;
	while($i<10){
	 $str="../".$str;
	if(is_dir($str)){
	 break;
	}
	 $i++;
	}
	return $str;
	}


	function createDir($myDir){
	// $data =date("Ymd");
	//判断文件夹是否存在,否则创建
	  if(!is_dir($myDir)){
	 //date("YmdHis")
	   mkdir($myDir,0777);
	  }
	}
	function ClearHtml($document)
	{
	$document=trim($document);
	if (strlen($document) <=0)
	{
	  return $document;
	}
     $search= array ("'<script[^>]*?>.*?</script>'si",  // 去掉 javascript
                  "'<[\/\!]*?[^<>]*?>'si",          // 去掉 HTML 标记
                  "'([\r\n])[\s]+'",                // 去掉空白字符
                  "'&(quot|#34);'i",                // 替换 HTML 实体
                  "'&(amp|#38);'i",
                  "'&(lt|#60);'i",
                  "'&(gt|#62);'i",
                  "'&(nbsp|#160);'i"
                  );                    // 作为 PHP 代码运行

           $replace= array ("",
                   "",
                   "\\1",
                   "\"",
                   "&",
                   "<",
                   ">",
                   " "
                   );

          return @str_ireplace($search,$replace,$document);
     }
?>