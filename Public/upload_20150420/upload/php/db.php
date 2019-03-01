<?php
$conn=@mysql_connect(DB_IP,DB_ROOT,DB_PASSWORD);
class db
{

	public $tabletou="fs_weixindd_";
    public $webUrl="";
	public $webName="";
	public $connStr="";
	public $selectDatabase="";
	public $updateStr="";
	public $tableName="";
	public $noteUrl="";
	public $noteName="";
	public $config=array ();

	function __construct($id=0){
	$this->tabletou=DB_QZ;


		//mysql_query("set names utf8");
		//mysql_query("SET GLOBAL group_concat_max_len=102400;");
		
		if(!$GLOBALS["conn"]){
       //echo phpinfo();
		echo $GLOBALS["conn"]."<br/>";
		echo DB_CONNECT_ERROR;
		}else{
		//echo iconv("utf-8","GB2312//UnCheckSqlORE","success");
		}
	 	$_selectDatabase=@mysql_select_db(DB_NAME,$GLOBALS["conn"]);
	    if(!$_selectDatabase)
	    {
	   
	   echo DB_DATABASE_ERROR;
	     //exit();
	    }
		$selectDatabase=$_selectDatabase;
	}

	function GetValue($sql_,$nulltext_){
			if($nulltext_!="notlimit"){
			$rs=$this->myQuery($sql_." limit 0,1");
			}else{
			$rs=$this->myQuery($sql_."");
			}
			$str0_="";
			while($row=mysql_fetch_array($rs)){
			$str0_="".$row[0]."";
			}
			if($str0_==""){
			$str0_=$nulltext_;
			}
			return $str0_;
	}
	function myconnStr()
	{
		mysql_query("set names utf8");
		if(!$GLOBALS["conn"]){
		echo DB_CONNECT_ERROR;
		exit();
		}
		$myDB=@mysql_select_db(DB_NAME,$GLOBALS["conn"]);
	    if(!$myDB)
	    {
	     echo DB_DATABASE_ERROR;
	     exit();
	    }
		return $GLOBALS["conn"];
	}

	function getRowCount($sql){
		$rs=mysql_query($sql);

		return mysql_num_rows($rs);

	}
	function myQuery($sql)
	{
	$arr=explode(");",$sql);
	$len=sizeof($arr);
	for($i=0;$i<$len;$i++){
	$arr[$i]=trim($arr[$i]);
	// echo $arr[$i];
	if($arr[$i]!=""){
		 $rs=mysql_query($arr[$i],$this->myconnStr());
		 if(!$rs)
		 {
			// echo $sql;
		 die("执行失败!"	.$arr[$i]);
		  //exit();
		}	
	}
	}
	//echo "执行成功!"	.$sql;
    return $rs;
	}
	function getMaxClassId($table,$fsFatherId){
			$sql="select right(max(fsClassId)+1,4) as maxClassId from ".$table." where fsFatherId='".$fsFatherId."'";
			//echo $sql;
			$y=1;
			$rs1=$this->myQuery($sql);
			$newFatherId=$fsFatherId;
            $newClassId=$fsFatherId."0001";
		while($row=mysql_fetch_array($rs1)){
			if($row["maxClassId"]!=""){
				$newClassId=$newFatherId.(string)$row["maxClassId"];
			}
		}
		return $newClassId;
	}
	function showCount($pageCount,$thisPage,$pageSize,$countZ,$currentCount,$fristIndex,$endIndex){
 return "&nbsp;总条数共".$countZ."条 目前是第".$fristIndex."条至第".$endIndex."条 第".$thisPage."/".$pageCount."页(".$pageSize.")";
}

	////////////////////////
	function editsql($myarr,$table){
	$rs_table_desc=mysql_query("DESCRIBE fs_product_class",$this->myconnStr());
	while($rs_table_desc_row=mysql_fetch_array($rs_table_desc)){
		$myField[]=$rs_table_desc_row['Field'];
		$myType[]=$rs_table_desc_row['Type'];
		$myNull[]=$rs_table_desc_row['Null'];
		$myKey[]=$rs_table_desc_row['Key'];
		$myDefault[]=$rs_table_desc_row['Default'];
		$myExtra[]=$rs_table_desc_row['Extra'];	  
	}
	$_updateStr="";
	$myi=1;
	foreach($myarr as $key1 => $val1){
	    $isBool=0;
		for($i=0;$i<count($myField);$i++){
		if($myField[$i]==$key1){
			  $isBool=1;
			  $p='';
		      $typeName=explode("(",$myType[$i]);
			 if($typeName[0]=="int"||$typeName[0]=="smallint"||$typeName[0]=="mediumint"){
			 $p="";
			 }else if($typeName[0]=="bigint"||$typeName[0]=="float"||$typeName[0]=="double"||$typeName[0]

=="decimal"){
			 $p="";
			 }else if($typeName[0]=="varchar"||$typeName[0]=="tinytext"||$typeName[0]=="tinyblob"||$typeName[0]

=="blob"){
			 $p="'";
			 }else if($typeName[0]=="mediumtext"||$typeName[0]=="longtext"||$typeName[0]=="longblob"){
			 $p="'";
			 }else{
			 $p="";
			 }
			 if(count($myarr)==$myi){
			  $_updateStr=$_updateStr.' '.$key1.'='.$p.$val1.$p.' ';
			  }else{
			   $_updateStr=$_updateStr.' '.$key1.'='.$p.$val1.$p.', ';
			  }
	          $this->updateStr="updata fs_product_class set ".$_updateStr; 
			  break;
	      }
	    }
		$myi=$myi+1;	
		if($isBool==0)
		{
		 echo "'".$table."'表不存在'".$key1."'字段!";
		 exit();
		}
		
    }	
}
 
   function myQueryPage($querySql,$thisPage,$pageSize)
	{
	//if()
	 $querySql=$querySql." limit ".(($pageSize*$thisPage-($pageSize-1))-1).",".$pageSize;
	 $rs=$this->myQuery($querySql);
	 	 // echo "||". $querySql;
	// echo iconv("utf-8","GB2312",$querySql);
     return $rs;
	 }

}
?>