<?php include("db_config.php");?>
<?php include("func.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style>
.parent_bt{position:absolute; top:0px; left:0px; line-height:100px;width:100px; height:100px; text-align:center; cursor:pointer; }
.parent_bt.on{ color:#666;}
*{ outline:none;-moz-outline-style: none;-webkit-outline-style: none;outline-style: none;blr:e-xpression(this.onFocus=this.close());} /* 针对IE */
form *{ cursor:pointer;}
body,html{ padding:0px; margin:0px; background-color:#FFF; background-color:#F9C}
</style>

</head>

<body>
<?php 
$imgsrc="";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	
	//http://zhidao.baidu.com/link?url=55VcmhPOlB0XGPt6s_8ATPwCOfH_hXUXYbGiz9tHps1H4ANr8bO6CESk1Zbg0M-cZD-ncD3ojNMkxXt9uqk6rK
	$yy=0;
	for ($i=0;$i<count($_FILES);$i++){
	          if(!empty($_FILES["upfile".$i]["name"])){
					$dir1=trim($_REQUEST["dir1"]);
					$dir2=trim($_REQUEST["dir2"]);
					$dir3=trim($_REQUEST["dir3"]);
					$w1=trim($_REQUEST["w1"]);//小图宽度
					$w2=trim($_REQUEST["w2"]);//中图宽度
					//echo $w1;
					//exit();
					$smallsrc=UpImg($_FILES["upfile".$i],$g_cengci,$dir1,$dir2,$dir3,$w1,$w2);
					$yy++;
	          }

    }
   $url=trim($_REQUEST["other"]);
    echo "<script>window.location='img_iframe.php?".$url."&type=add&smallsrc=".$smallsrc."';</script>"; 
}
?>
</body>
</html>
