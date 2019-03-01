<?php session_start();ini_set('memory_limit', '-1');  ?>
<?php
ini_set('default_socket_timeout', 2000000);  
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2011 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2011 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.6, 2011-02-27
 */

/** Error reporting */
	if($_SESSION["JXAdminName"]==""){
//	echo "<script>window.location='../../login.php';</scrip't>";
//	exit;
      exit("login");
	}
include("../../db/global.php");
include("../../db/function.php");
include("../../db/fs_webconfig.php");
include("../../db/db.php");
    $mydb=new db();

error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('Europe/London');
require_once '../Classes/PHPExcel/IOFactory.php';

$path=$_POST["Path"];
$state=$_POST["state"];
$arr=explode(".",$path); 
//$path="../../file/data/201302/13601590225792416495.xls";
if (!file_exists($path)) {
	exit("close");
}
if($state=="PiLiangTiMu"){
$objPHPExcel = PHPExcel_IOFactory::load($path);

//echo date('H:i:s') . " Write to Excel2007 format\n";
//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '00.xls', __FILE__));
     // $objPHPExcel = $PHPReader->load($filePath);
      $currentSheet = $objPHPExcel->getSheet(0); //取得excel工作“分页”
     
      /**取得一共有多少列*/
    // $allColumn = $currentSheet->getHighestColumn(); 
      /**取得一共有多少行*/
    $allRow = $currentSheet->getHighestRow(); 
	 $countz=0;
	$fsClassId=CheckSql(trim($_POST["fsClassId"])); 
	$fsSubjectClassId=CheckSql(trim($_POST["fsSubjectClassId"]));
	$global_timu_difficult=$GLOBALS['global_timu_difficult'];
	$difficult_arr=explode("[]",trim($global_timu_difficult));
	$difficult_arr_len=sizeof($difficult_arr);

      for($currentRow =2;$currentRow<=$allRow;$currentRow++){//获取excel文件数据到数组

		$currentColumn="B";
		$fsItemA="";
		$fsItemB="";
		$fsItemC="";
		$fsItemD="";
		$fsAnswerError=0;
		$fsAnswerSuccess=0;
		$fsLable="";
		$fsFraction="";
		$fsDifficult=0;
		$fsKind="";
		$fsImage="";
		$fsType=-1;
		$fsValue="";
		$fsName=trim($currentSheet->getCell("B".$currentRow)->getValue());
		if($fsName!=""){
		$Items=CheckSql(trim($currentSheet->getCell("C".$currentRow)->getValue()));
		$fsImage=trim($currentSheet->getCell("D".$currentRow)->getValue());
		$fsValue=ClearHtml(trim($currentSheet->getCell("E".$currentRow)->getValue()));
		$fsContent=CheckSql(trim($currentSheet->getCell("F".$currentRow)->getValue()));
		$fsDifficult=CheckSql(trim($currentSheet->getCell("G".$currentRow)->getValue()));
		$fsKind=CheckSql(trim($currentSheet->getCell("H".$currentRow)->getValue()));
		if($fsImage!=""){
			if(strpos($fsImage,"src=\"")!=false){
			$start=stripos($fsImage,"src=\"",0)+5;
			$end=stripos($fsImage,"\"",$start);
			$fsImage=substr($fsImage,$start,$end-$start);
			}
		}
//		if($fsImageDaAn!=""){
//			$start=stripos($fsImageDaAn,"src=\"",0)+5;
//			$end=stripos($fsImageDaAn,"\"",$start);
//			$fsImageDaAn=substr($fsImageDaAn,$start,$end-$start);
//		}
		$fsFraction=1;
		if(trim($fsDifficult)==""){
			$fsDifficult=0;
		}else{
				  for($i=0;$i<$difficult_arr_len;$i++){
					 $arr=explode("||",trim($difficult_arr[$i])); 
					 if($arr[0]==$fsDifficult){
						 $fsDifficult=$arr[1];
					 }
				  }
		}  
	    $fsThisTime=date("Y-m-d H:i:s");
		$fsNewId=NewSort($mydb->tabletou."timu","fsId");
		
		$Items = str_ireplace("\r","",$Items);
		$Items = str_ireplace("\n","[br]",$Items);
		//$Items = preg_replace("/[\r\n]+/", '[br]', $Items);
		//$Items = preg_replace("/[\r\n]+/", '[br]', $Items);
		$arr=explode('[br]',$Items);
		$len=sizeof($arr);
        $option=$arr[0];
		 $fsValue=strtoupper($fsValue);
			  if($option=="正确"){
				  $fsType=0;

				  $fsItemA=$arr[0];
				  $fsItemB=trim($arr[1]);
			  }else if(strlen($fsValue)==1){
				  $fsType=1;
				  $fsItemA=GetItem($arr[0]);
				  $fsItemB=GetItem($arr[1]);
				  $fsItemC=GetItem($arr[2]);
				  $fsItemD=GetItem($arr[3]);
			  }else if(strlen($fsValue)>1){
				  $fsType=2;
				  $fsItemA=GetItem($arr[0]);
				  $fsItemB=GetItem($arr[1]);
				  $fsItemC=GetItem($arr[2]);
				  $fsItemD=GetItem($arr[3]);
			  }

			 if($fsValue=="O"||$fsValue=="0"||$fsValue=="对"||$fsValue=="√"||$fsValue=="正确"||$fsValue=="N"){
				  $fsValue="B";
			  }else  if($fsValue=="1"||$fsValue=="Y"||$fsValue=="错"||$fsValue=="×"||$fsValue=="错误"){
				  $fsValue="A";
			  } 
			  $countz++;
			  $fsPiPei=0;
			  $NewImage=$mydb->getFieldValue("select fsImage from ".$mydb->tabletou."images where fsName='".$fsImage."'","fsImage","");
			  if($NewImage!=""){
				  $mydb->myQuery("update ".$mydb->tabletou."images set fsState=1 where fsImage='".$NewImage."' ");
				  $fsImage=$NewImage;
				  $fsPiPei=0;
				  
			  }
					$sql="insert into ".$mydb->tabletou."timu"."(fsId,fsName,fsClassId,fsValue,fsThisTime,fsSort,fsImage,fsImageDaAn,fsLable,fsType,fsUserName,fsFraction,fsDifficult,fsItemA,fsItemB,fsItemC,fsItemD,fsAnswerError,fsAnswerSuccess,fsKind,fsSubjectClassId,fsContent,fsPiPei";
					$sql.=") values(";
					$sql.="".$fsNewId."";
					$sql.=",'".$fsName."'";
					$sql.=",'".$fsClassId."'";
					$sql.=",'".$fsValue."'";
					$sql.=",'".$fsThisTime."'";
					$sql.=",".$fsNewId."";
					$sql.=",'".$fsImage."'";
					$sql.=",'".$fsImageDaAn."'";
					$sql.=",'".$fsLable."'";
					$sql.=",'".$fsType."'";
					$sql.=",'".$_SESSION["JXAdminName"]."'";
					$sql.=",'".$fsFraction."'";
					$sql.=",'".$fsDifficult."'";
					$sql.=",'".$fsItemA."'";
					$sql.=",'".$fsItemB."'";
					$sql.=",'".$fsItemC."'";
					$sql.=",'".$fsItemD."'";
					$sql.=",".$fsAnswerError."";
					$sql.=",".$fsAnswerSuccess."";
					$sql.=",'".$fsKind."'";
					$sql.=",'".$fsSubjectClassId."'";
					$sql.=",'".$fsContent."'";
					$sql.=",'".$fsPiPei."'";
					$sql.=")";
					$mydb->myQuery($sql);
					
		}
	    }
		echo $state."[cxc]".$countz;
	 }

function GetItem($str_){
	$str_=trim($str_);
	// $str_=iconv("GB2312//IGNORE","utf-8",$str_);
	$str_=str_ireplace("A、", '', $str_);
	$str_=str_ireplace("B、", '', $str_);
	$str_=str_ireplace("C、", '', $str_);
	$str_=str_ireplace("D、", '', $str_);
	$str_=str_ireplace("A：", '', $str_);
	$str_=str_ireplace("B：", '', $str_);
	$str_=str_ireplace("C：", '', $str_);
	$str_=str_ireplace("D：", '', $str_);
	$str_=str_ireplace("A:", '', $str_);
	$str_=str_ireplace("B:", '', $str_);
	$str_=str_ireplace("C:", '', $str_);
	$str_=str_ireplace("D:", '', $str_);
	// $str_=iconv("utf-8","GB2312//IGNORE",$str_);
	return $str_;
}


?>
