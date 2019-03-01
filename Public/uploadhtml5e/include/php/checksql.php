<?php

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
//$str = str_ireplace("\"","&#34;",$str);
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
//$str =get_str($str,"data-scayt_word=\"","\"");
return $str;
}
function UnCheckSql($str){
$str=trim($str);
$str = str_ireplace("&#97;nd","and",$str);
$str = str_ireplace("&#101;xecute","execute",$str);
$str = str_ireplace("&#117;pdate","update",$str);
$str = str_ireplace("&#99;ount","count",$str);
$str = str_ireplace("&#109;id","mid",$str);
$str = str_ireplace("&#109;aster","master",$str);
$str = str_ireplace("&#116;runcate","truncate",$str);
$str = str_ireplace("&#99;har","char",$str);
$str = str_ireplace("&#99;reate","create",$str);
$str = str_ireplace("&#100;elete","delete",$str);
$str = str_ireplace("&#105;nsert","insert",$str);

$str = str_ireplace("&#111;","o",$str);
$str = str_ireplace("&amp;#111;","o",$str);
$str = str_ireplace("&#39;","'",$str);
$str = str_ireplace("&#34;","\"",$str);
//$str = str_ireplace("%20","",$str);
//$str = str_ireplace(" ","",$str);
$str = str_ireplace("&#40;","(",$str);
$str = str_ireplace("&#41;",")",$str);
$str = str_ireplace("&#42;","*",$str);
$str = str_ireplace("&#43;","+",$str);
$str = str_ireplace("&#44;",",",$str);

$str = str_ireplace("&#60;","<",$str);
$str = str_ireplace("&#61;","=",$str);
$str = str_ireplace("&#62;",">",$str);
//$str = str_ireplace("","&quot",$str);
$str = str_ireplace("#yu#","&",$str);
$str = str_ireplace("#cxc#","&",$str);
$str = str_ireplace("&#96;","`",$str);
$str = str_ireplace("#jia#","+",$str);
$str = str_ireplace("&#96;","`",$str);
$str = str_ireplace("&#45;","-",$str);

//$str =$this->clearHtml($str);
return $str;
}
?>