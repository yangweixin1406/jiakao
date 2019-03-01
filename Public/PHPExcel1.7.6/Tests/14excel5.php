<?php
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
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');
error_reporting(E_ALL);

require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';

echo date('H:i:s') . " Create new PHPExcel object\n";
$objPHPExcel = new PHPExcel();

echo date('H:i:s') . " Set properties\n";
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");
							 
echo date('H:i:s') . " Add some data\n";
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B1', '顺序');
$objPHPExcel->getActiveSheet()->setCellValue('C1', '卡号');
$objPHPExcel->getActiveSheet()->setCellValue('D1', '密码');
$objPHPExcel->getActiveSheet()->setCellValue('E1', '面值');
$title=array("B","C","D","E");
for($i=0;$i<count($title);$i++){
	//Set column widths 设置列宽度
	//echo $title[$i]"<br/>";
	$objPHPExcel->getActiveSheet()->getColumnDimension($title[$i])->setAutoSize(true);
	$objPHPExcel->getActiveSheet()->getColumnDimension($title[$i])->setWidth(12);
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
$arr[0]=array("11111","012222","pwd","2010-02-05");
$arr[1]=array("2222","2222222","pwd","2010-02-05");
echo "<br/>".count($arr)."<br/>";
for($i=0;$i<count($arr);$i++){
$objPHPExcel->getActiveSheet()->setCellValue('B'.($i+2), $arr[$i][0]);
$objPHPExcel->getActiveSheet()->setCellValue('C'.($i+2), $arr[$i][1]);
$objPHPExcel->getActiveSheet()->setCellValue('D'.($i+2), $arr[$i][2]);
$objPHPExcel->getActiveSheet()->setCellValue('E'.($i+2), $arr[$i][3]);
                //Set border colors 设置边框颜色

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
//$objPHPExcel->getActiveSheet()->getStyle($b)->getBorders()->getBottom()->getColor()->setARGB('FF993300');

}

//$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Product Id');
//$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Description');
//$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Price');
//$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Amount');
//$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Total');
//
//$objPHPExcel->getActiveSheet()->setCellValue('A4', '1001');
//$objPHPExcel->getActiveSheet()->setCellValue('B4', 'PHP for dummies');
//$objPHPExcel->getActiveSheet()->setCellValue('C4', '20');
//$objPHPExcel->getActiveSheet()->setCellValue('D4', '1');
//$objPHPExcel->getActiveSheet()->setCellValue('E4', '=C4*D4');
//
//$objPHPExcel->getActiveSheet()->setCellValue('A5', '1012');
//$objPHPExcel->getActiveSheet()->setCellValue('B5', 'OpenXML for dummies');
//$objPHPExcel->getActiveSheet()->setCellValue('C5', '22');
//$objPHPExcel->getActiveSheet()->setCellValue('D5', '2');
//$objPHPExcel->getActiveSheet()->setCellValue('E5', '=C5*D5');

$objPHPExcel->getActiveSheet()->setTitle('Simple');
//$objPHPExcel->createSheet();
//$objPHPExcel->setActiveSheetIndex(1);
//$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Invoice');
//$objPHPExcel->getActiveSheet()->setCellValue('D1', PHPExcel_Shared_Date::PHPToExcel( gmmktime(0,0,0,date('m'),date('d'),date('Y')) ));
//$objPHPExcel->getActiveSheet()->getStyle('D1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_XLSX15);
//$objPHPExcel->getActiveSheet()->setCellValue('E1', '#12566');
//
//$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Product Id');
//$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Description');
//$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Price');
//$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Amount');
//$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Total');
//
//$objPHPExcel->getActiveSheet()->setCellValue('A4', '1001');
//$objPHPExcel->getActiveSheet()->setCellValue('B4', 'PHP for dummies');
//$objPHPExcel->getActiveSheet()->setCellValue('C4', '20');
//$objPHPExcel->getActiveSheet()->setCellValue('D4', '1');
//$objPHPExcel->getActiveSheet()->setCellValue('E4', '=C4*D4');
//
//$objPHPExcel->getActiveSheet()->setCellValue('A5', '1012');
//$objPHPExcel->getActiveSheet()->setCellValue('B5', 'OpenXML for dummies');
//$objPHPExcel->getActiveSheet()->setCellValue('C5', '22');
//$objPHPExcel->getActiveSheet()->setCellValue('D5', '2');
//$objPHPExcel->getActiveSheet()->setCellValue('E5', '=C5*D5');
//$objPHPExcel->getActiveSheet()->setTitle('Simple1');
require_once '../Classes/PHPExcel/IOFactory.php';
echo date('H:i:s') . " Write to Excel5 format\n";
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));

?>