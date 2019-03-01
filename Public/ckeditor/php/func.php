<?php
  function GetValue($sql_,$nulltext_){
			if($nulltext_!="notlimit"){
			$rs=$GLOBALS["mydb"]->myQuery($sql_." limit 0,1");
			}else{
			$rs=$GLOBALS["mydb"]->myQuery($sql_."");
			}
			$str0_="";
			while($row=mysql_fetch_array($rs)){
			$str0_="".$row[0]."";
			}
			if($str0_==""){
			$str0_=$nulltext_;
			}

//					$rs=$this->myQuery("SHOW COLUMNS FROM 表名");//表中所有字段名来
//                    $row["id"]==11;
//					while($r=mysql_fetch_array($rs)){
//					   $zd=$r['Field'];
//	                   if($row[$zd]=="11") //$r['Field'] 字段名
//					   {
//					   }
//					}
			return $str0_;
	}
  function GetRow($sql_){
			$str0_="";
			$rs=$GLOBALS["mydb"]->myQuery($sql_);
			$row=mysql_fetch_array($rs);
			return $row;
	}
  function GetCaption($str,$value){
			$items=explode("[]",$str);
			$caption="";
			for($i=0;$i<sizeof($items);$i++){
				$values=explode("||",$items[$i]);
				if($values[1]==$value){
					$caption=$values[0];
					break;
				}
			}
			if($caption=="");
			for($i=0;$i<sizeof($items);$i++){
				$values=explode("||",$items[$i]);
				if($values[0]==$value){
					$caption=$values[1];
					break;
				}
			}
			return $caption;
	}
function Alert($str,$url){
		  if(trim($url)<>""){
			 echo "<script>alert('".$str."');window.location='".$url."';</script>";
		  }else{
			echo "<script>alert('".$str."');</script>";
		  }
}
function ToUrl($url){
		 echo "<script>window.location='".$url."';</script>";
		 exit();
}
function NewRand($median_){
	  $str_="";
	  $minno="";
	  $maxno="";
	  if(is_numeric($median_)){
	  for($i_=0;$i_<$median_;$i_++){
	   $f=rand(0,9);
	   if($f==0){
	   $f=1;
	   }
		$str_.=$f;
	  }
	  }
	  return $str_;
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
function GetInt($value,$m){
	$m=trim($m);
	if(!is_numeric($value)||trim($value)==""){
			$value=0;
	 }
	 if($value==0&&$m!=""){
		 $value=$m;
	 }
	 return $value;
}
function GetIntStr($value,$fuhao){
	  $arr=explode($fuhao,$value);
	  $ids="";
	  for($i=0;$i<sizeof($arr);$i++){
		  $v=$arr[$i];
		  if(is_numeric($v)&&trim($v)!=""){
		   if($ids!=""){
			   $ids.=",".$v;
		   }else{
			   $ids.=$v;
		   }
	   }
	  }
	  return $ids;
}

function KeyValue($ifWhere_,$name_,$value_){
	  $str="";
	  $mydb=$GLOBALS["mydb"];
	  if(is_numeric($ifWhere_)){
		$addWhere_=" where id=".$ifWhere_;
	  }
	  $mydb=$GLOBALS["mydb"];
	  $sql="select ".$name_.",".$value_." from ".$this->tabletou.$this->tablename.$addWhere_;
	  $rs=$mydb->myQuery($sql);
	  while($row=mysql_fetch_array($rs)){
		  $item=$row[$name_]."[]".$row[$value_];
		  if($str==""){
		  $str=$item;
		  }else{
		  $str.="||".$item;
		  }
	  }
	  return $str;
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
     if (strpos($this_page, "?") !== false) 
        $this_page = reset(explode("?", $this_page));
 
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
	function GetIP(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
	  $cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
	  $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif(!empty($_SERVER["REMOTE_ADDR"])){
	  $cip = $_SERVER["REMOTE_ADDR"];
	}
	else{
	  $cip = "127.0.0.1";
	}
	return $cip;
}
function GetImageExt($smallimg){
		  $ext="";$arr=explode(".",$smallimg);
		 if(sizeof($arr)>1){$ext=".".$arr[sizeof($arr)-1];}
		 return $ext;
}
function cnsubstr($str,$strlen=10,$str0) { 

	if(empty($str)||!is_numeric($strlen)){ 
	return false; 
	} 
	if(strlen($str)<=$strlen){ 
	return $str; 
	} 

//得到第$length个字符 并判断是否为非中文 若为非中文 
//直接返回$length长的字符串 
    $last_word_needed=substr($str,$strlen-1,1); 
	if(!ord($last_word_needed)>128){ 
	$needed_sub_sentence=substr($str,0,$strlen); 
	return $needed_sub_sentence; 
	}else{ 
		for($i=0;$i<$strlen;$i++){ 
			if(ord($str[$i])>128){ 
			$i++; 
			$i++;
			} 
		}//end of for 
		$needed_sub_sentence=substr($str,0,$i); 
		return $needed_sub_sentence.$str0; 
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
function GetClassNameNav($fsfatherid_){
	//fsClassNameNav
	$mydb=new db();
					$sql="select id,name,classno,fatherno from ".$mydb->tabletou."otherclass where classno='".$fsfatherid_."'";
					$rs=$mydb->myQuery($sql);
					$fsFatherId="";
					$str="";
					while($row=mysql_fetch_array($rs)){
	                 $fsFatherId=$row["fatherno"];
					 $fsName=$row["name"];
					 if(strlen($fsFatherId)!=8){
					 $str=">>".$fsName;
					 }else{
						  $str="".$fsName;
					 }
					}
					if(strlen($fsFatherId)>8){
					  $str=GetClassNameNav($fsFatherId).$str;
					}
				return $str;
}
 /**
*求两个已知经纬度之间的距离,单位为米
*@param lng1,lng2 经度
*@param lat1,lat2 纬度
*@return float 距离，单位米
*@author www.Alixixi.com
**/
function getDisance($lng1,$lat1,$lng2,$lat2){
	//将角度转为狐度
	$radLat1=deg2rad($lat1);//deg2rad()函数将角度转换为弧度
	$radLat2=deg2rad($lat2);
	$radLng1=deg2rad($lng1);
	$radLng2=deg2rad($lng2);
	$a=$radLat1-$radLat2;
	$b=$radLng1-$radLng2;
	$s=2*asin(sqrt(pow(sin($a/2),2)+cos($radLat1)*cos($radLat2)*pow(sin($b/2),2)))*6378.137*1000;
	return $s;
}
function ChangeImageState($content,$state_,$type_){
$str=str_ireplace("\\","",$content);
$mydb=$GLOBALS["mydb"];
$list="";
if($type_==1){
$str=UnCheckSql($str);
//$url=$mydb->getFieldValue("select fsUrl from ".$mydb->tabletou."config where id=1","fsUrl","");
//$url=$GLOBALS['cur_url'];
$str=str_ireplace($url,"",$str);
$thisindex=0;
$src_startlen= strlen($url)+5;
$startindex=0;
$endindex=0;
while($thisindex>-1){
  $thisindex = stripos($str, "src=\"".$url,$thisindex);
  if($thisindex==""||$thisindex==false){
	 $thisindex=-1; 
  }else{
	$startindex=$thisindex;
	if($thisindex>1){
		$endindex= stripos($str, "\"",$thisindex+$src_startlen);
		if($endindex>$startindex){
		 $img= substr($str,($startindex+$src_startlen),$endindex-($startindex+$src_startlen))."";
		 $sql_="update ".$mydb->tabletou."images set state=".$state_." where image='". $img."'";
		 $list.=$sql_;
		 $mydb->myQuery($sql_);
		}
	}
		$thisindex=$endindex;
  }
  $list.=stripos($str, "src=\"".$url,0);
}
}else{

	$ImageListP=trim($str);
	$ImgArr=explode("##",$ImageListP);
	$ImgArrLen=sizeof($ImgArr);
	$NewImgList="";
	for($i=0;$i<$ImgArrLen;$i++){
		if(trim($ImgArr[$i])!=""){
		 $sql_="update ".$mydb->tabletou."images set state=".$state_." where image='".trim($ImgArr[$i])."'";
		// echo  $sql_="update ".$mydb->tabletou."images set fsState=".$state_." where fsImage='".trim($ImgArr[$i])."'";
		 $mydb->myQuery($sql_);
		}
	}

}
return $sql_;
}
function IsJinDel($idlist_,$id_){//是否是禁删除的编号
	$arr=explode(",",trim($idlist_));
	$isbool=1;
	$len=sizeof($arr);
	for($i=0;$i<$len;$i++){
	   if(($arr[$i])==trim($id_)){
		   $isbool=0;
	   }
	}
	return $isbool;
}
function TimeAddTime($str,$value,$type){
 $str=str_ireplace(" ","-",$str); 
 $str=str_ireplace(":","-",$str);
 $items=explode("-", $str);
 $year=$items[0];
 $month=$items[1];
 $day=$items[2];
 $hour=$items[3];
 $minute=$items[4];
 $second=$items[5];
 switch($type){
	 case "y":
	 $year+=$value;
	 break;
	 case "m":
	 $month+=$value;
	 break;
	 case "d":
	 $day+=$value;
	 break;
	 case "h":
	 $hour+=$value;
	 break;
	 case "mi":
	 $minute+=$value;
	 break;
	 case "s":
	 $second+=$value;
	 break;
	 default:
	 echo "";
 }
 $newstr=date("Y-m-d H:i:s",mktime($hour,$minute,$second,$month,$day,$year));
 return $newstr;
}
//urlencode(iconv("gb2312", "UTF-8", "电影")); 
//ob_start(); 
?>
<?php
//ob_end_clean();
////ob_clean(); 
////ob_end_flush(); 
?>