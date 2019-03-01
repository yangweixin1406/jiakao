<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<?php 
    include("db_config.php");
	include("db.php");
	global $mydb;
	$mydb=new db();
	
	//1.添加数据
	$data["mjqq"]="632175205";
	$data["addtime"]=date("Y-m-d H:i:s");
	$newid=$mydb->add(DB_QZ."biaodan",$data);
	if($newid){
		echo "<script>alert('添加成功');</script>";
	}
	//2.更新则是这样子 
	//$mydb->update(DB_QZ."biaodan",$data," id=2");
	//3.读取数据
	$rs=$mydb->query("select * from ".DB_QZ."biaodan limit 0,10");
	while($row=mysql_fetch_array($rs)){
		echo $row["id"]."||".$row["mjqq"]."||".$row["addtime"]."<br>";
	}
?>
</body>
</html>