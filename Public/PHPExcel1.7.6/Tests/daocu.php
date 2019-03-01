<?php session_start(); ?>
<?php
if($_SESSION["AdminName"]==""){
exit();
echo "<script>../../../fs_login.php</script>";
}
//error_reporting(E_ALL);
date_default_timezone_set('Europe/London');
//error_reporting(E_ALL);
include('../Classes/PHPExcel.php');
include("../../db/db.php");
include("../../db/function.php");
//echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();
//echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
//echo date('H:i:s') . " Add some data\n";
if($_POST["state"]=="myDaoCuTel"){
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('B1', '手机号');
	$title=array("B");
	for($i=0;$i<count($title);$i++){
		//echo $title[$i]"<br/>";
		$objPHPExcel->getActiveSheet()->getColumnDimension($title[$i])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension($title[$i])->setWidth(12);
		//$objPHPExcel->getActiveSheet()->getColumnDimension($title[$i])->setWidthAndHeight(12,30);
		//Set fonts 设置字体
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->setName('Candara');
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->getColor()->setARGB("000000");
		//Set fills 设置填充
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFill()->getStartColor()->setARGB('FF808080');			
	}
   //条件开始
   $mydb=new db();
    $fsSource=$_POST["fsSource"];
	$fsName=$_POST["fsName"];
    $fsLevel=$_POST["fsLevel"];
	$fsAuthor=$_POST["fsQQ"];
	$fsAddress=$_POST["fsAddress"];
    $fsEmail=$_POST["fsEmail"];
	$fsIntegral=$_POST["fsIntegral"];
	$fsThisTimeStart=$_POST["fsThisTimeStart"];
	$fsThisTime=$_POST["fsThisTime"];
	$fsThisTimeEnd=$_POST["fsThisTimeEnd"];
	$fsLevelHot=$_POST["fsLevelHot"];
	$fsPhone=$_POST["fsPhone"];
	$fsLevelRecommend=$_POST["fsLevelRecommend"];
	$fsLevelIndex=$_POST["fsLevelIndex"];
	$fsIntegralS=$_POST["fsIntegralS"];
	$fsIntegralStart=$_POST["fsIntegralStart"];
	$fsIntegralEnd=$_POST["fsIntegralEnd"];
	$fsSex=$_POST["fsSex"];
	$dateAll=$_POST["dateAll"];
	$fsIsSee=$_POST["fsIsSee"];
	$str="";
	if(trim($fsName)!=""){
	 $str.=" and fsUserName like '%".$fsName."%'";
	 $ifStr.="&fsName=".$fsName;
	}
	
	if(trim($fsPhone)!=""){
	 $str.=" and fsPhone like '%".$fsPhone."%'";
	 $ifStr.="&fsPhone=".$fsPhone;
	}
	if(trim($fsLevel)!="All" && trim($fsLevel)!=""){
	 $str.=" and fsLevel=".$fsLevel."";
	 $ifStr.="&fsLevel=".$fsLevel;
	}
	if(trim($fsQQ)!=""){
	 $str.=" and fsQQ=".$fsQQ;
	  $ifStr.="&fsQQ=".$fsQQ;
	}
		if(trim($fsSex)!="All" && trim($fsSex)!=""){
	 $str.=" and fsSex=".$fsSex;
	  $ifStr.="&fsSex=".$fsSex;
	}
	if(trim($fsEmail)!=""){
	 $str.=" and fsEmail like '%".$fsEmail."%'";
	  $ifStr.="&fsEmail=".$fsEmail;
	}
		if(trim($fsAddress)!=""){
	 $str.=" and fsAddress like '%".$fsAddress."%'";
	  $ifStr.="&fsAddress=".$fsAddress;
	}
		if(trim($fsIsSee)!="All" && trim($fsIsSee)!=""){
	 $str.=" and fsIsSee=".$fsIsSee."";
	 $ifStr.="&fsIsSee=".$fsIsSee;
	}
 //条件结束
   $mydb=new db();
	$rs=$mydb->myQuery("select fsPhone from fs_user where fsId>0  ".$str." order by fsId desc ");
	$i=-1;
	//while开始
 while($row=mysql_fetch_array($rs)){
	$i=$i+1;	
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($i+2), $row["fsPhone"]);
	for($j=0;$j<count($title);$j++){
	$g=$title[$j].($i+2);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	//$objPHPExcel->getActiveSheet()->getStyle($b)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getLeft()->getColor()->setARGB('FF993300');
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getTop()->getColor()->setARGB('FF993300');
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getRight()->getColor()->setARGB('FF993300');
		if($j==(count($title)-1)){
		$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getBottom()->getColor()->setARGB('FF993300');
		}
	}
  }
  //while结束
}
if($_POST["state"]=="myDaoCu"){
	$objPHPExcel->setActiveSheetIndex(0);
	$objPHPExcel->getActiveSheet()->setCellValue('B1', '会员名');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', '领钱卡号');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', '支付方式');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', '支付号');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', '支付金额');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', '状态');
	$title=array("B","C","D","E","F","G");
	for($i=0;$i<count($title);$i++){
		//echo $title[$i]"<br/>";
		$objPHPExcel->getActiveSheet()->getColumnDimension($title[$i])->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension($title[$i])->setWidth(12);
		//$objPHPExcel->getActiveSheet()->getColumnDimension($title[$i])->setWidthAndHeight(12,30);
		//Set fonts 设置字体
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->setName('Candara');
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->setSize(12);
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->setBold(true);
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->setUnderline(PHPExcel_Style_Font::UNDERLINE_SINGLE);
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFont()->getColor()->setARGB("000000");
		//Set fills 设置填充
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$objPHPExcel->getActiveSheet()->getStyle($title[$i]."1")->getFill()->getStartColor()->setARGB('FF808080');			
	}
   //条件开始


   $mydb=new db();
    $strWhere="";
	if(is_numeric($_POST["fsState"])){
	$strWhere=" and fsState=".$_POST["fsState"];
	}
	$rs=$mydb->myQuery("select * from fs_ling where fsId>0  ".$strWhere." order by fsId desc ");
	$i=-1;
	//while开始
 while($row=mysql_fetch_array($rs)){
	$i=$i+1;	
	$objPHPExcel->getActiveSheet()->setCellValue('B'.($i+2), $row["fsUserName"]);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.($i+2), " ".$row["fsIdNo"]." ");
	$objPHPExcel->getActiveSheet()->setCellValue('D'.($i+2), $row["fsBrank"]);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.($i+2), $row["fsBrankCard"]);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.($i+2), $row["fsFaceValue"]);
	if($row["fsState"]=="0"){
	$fsState="排队中";
	}else if($row["fsState"]=="1"){
	$fsState="等待领钱";
	}else if($row["fsState"]=="2"){
	$fsState="已领";
	}
	$objPHPExcel->getActiveSheet()->setCellValue('G'.($i+2), $fsState);
	for($j=0;$j<count($title);$j++){
	$g=$title[$j].($i+2);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	//$objPHPExcel->getActiveSheet()->getStyle($b)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THICK);
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getLeft()->getColor()->setARGB('FF993300');
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getTop()->getColor()->setARGB('FF993300');
	$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getRight()->getColor()->setARGB('FF993300');
		if($j==(count($title)-1)){
		$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$objPHPExcel->getActiveSheet()->getStyle($g)->getBorders()->getBottom()->getColor()->setARGB('FF993300');
		}
	}
  }
  //while结束
}
$objPHPExcel->getActiveSheet()->setTitle('Simple');
include('../Classes/PHPExcel/IOFactory.php');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$qian=$_GET["qian"];
$path=$_GET["path"];
$hou=$_GET["hou"];
if($qian==""){
$qian=$_POST["qian"];
}
if($path==""){
$path=$_POST["path"];
}
if($hou==""){
$hou=$_POST["hou"];
}
$ftype="xls";
$newfile=getFilePath($qian,$path,$hou,$ftype);
$objWriter->save(str_replace('daocu.php', $newfile, __FILE__));
echo $_SESSION["FilePathN"];

function getFilePath($qian,$path,$hou,$ftype){
 $mydb=new db();
	$dir=date("Ym");
	createDir($qian.$path.$dir."/");
	$_SESSION["Path"]=$qian.$path.$dir."/";
	$_SESSION["PathN"]=$path.$dir."/";
	$qianName=time();
    $_SESSION["FilePath"]=$_SESSION["Path"].$qianName.$hou.".".$ftype;
	$_SESSION["FilePathN"]=$_SESSION["PathN"].$qianName.$hou.".".$ftype;
	return $_SESSION["FilePath"];
}
?>