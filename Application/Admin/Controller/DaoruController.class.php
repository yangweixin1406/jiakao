<?php
namespace Admin\Controller;
use Think\Controller;
class DaoruController extends CommController {
public $tablename="exam";
public $fatherid="00010001";
public $urldir="Admin/daoru";
public $lang="";
public $fathernos=array("中文"=>"00010001","哈文"=>"00010002","阿拉"=>"00010003","英文"=>"00010004","阿拉2"=>"00010005");
public function index()
{
	$mod=D($this->tablename);
	$where["id"]=array('gt',0);
	$name=I("name");
	$classno=I("classno");
	$state=I("state");
	$lang=I("lang");
	$this->lang=$lang;
	
	$class=M("class");


	  $map_c["fatherno"]=array("eq",$this->fathernos["$this->lang"]);

    $classlist=$class->where($map_c)->select();
	//echo $this->fathernos["".$this->lang];
	//echo $class->getLastSql();
	//exit();
	
	$this->assign('kemu',json_decode(C("exam_kemu"),true));
	$this->assign('webtitle',$this->lang."导入");
	$this->assign('classlist',$classlist);
	$this->assign('list',$list);
	$this->assign('show',$show);
	$this->assign("classno",$this->fathernos[$lang]);
	$this->assign("lang",$lang);
	//$this->view('index');
	 $this->display("index");
}

public function save()
{

	$data=I('post.');
	$mod=D($this->tablename);
    if($data["lang"]=="中文"){
		$mod=D($this->tablename);
	}
    if($data["lang"]=="阿拉"){
		$mod=D($this->tablename."a");
	}
    if($data["lang"]=="哈文"){
		$mod=D($this->tablename."h");
	}
    if($data["lang"]=="阿拉2"){
		$mod=D($this->tablename."a2");
	}
    if($data["lang"]=="英文"){
		$mod=D($this->tablename."e");
	}
	$userone=session("user");
	$data["addtime"]=date("Y-m-d H:i:s");
	$userid=$userone["id"];
    $map_class["classno"]=array("eq",$data["classno"]);
    $class_row=M("class")->where($map_class)->find();
    $classid=$class_row["id"];
    $classno=$data["classno"];
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{

			header("Content-Type: text/html; charset=UTF-8");
			$file = $data["filepath"]; 
			$content =file_get_contents($file);
           $arr = explode('answerCount',$content); 

			for($i=0; $i<count($arr); $i++) 
			{ 
		       $arr[$i]=trim($arr[$i]);
			   if(strlen($arr[$i])>10){
				  
					  $options =explode("[", $arr[$i]); 
					  if(count($options)>3){
						  $arr2=explode("\r", $options[0]); 
						  $name=$arr2[0];
						  $items="";
						  //[{"lable":"A","title":"\u7f8e\u56fd\u4eba","num":"0"},{"lable":"B","title":"\u4e2d\u56fd\u4eba","num":"0"},{"lable":"C","title":"\u975e\u6d32\u4eba","num":"0"},{"lable":"D","title":"\u5730\u7403\u4eba","num":"1"}]
						  
						  $value=trim($options[1]); 
						  $photo=trim($options[2]); 
						  $type=trim($options[3]);
						  $fenshu=1;
						  if(isset($options[4])){
						   $fenshu=trim($options[4]);
						   }
						  if(strpos($type,"判断")!==false){
							  $type=0;
						  }else{
							  if(strlen($value)==1){
								  $type=1;//单选题
							  }else{
								  $type=2;//多选题
							  }
							  
						  }

						 // echo $type;
						  //exit();

						  $index=0;
                          $isleft=0;
						   for($j=1;$j<count($arr2);$j++){
							   if($arr2[$j]==""){
							   unset($arr2[$j]);
							   }
						   }
						  $index=stripos($arr2[0],"A");	  
						  if($index!==false){
							 if($index==0){
								 $isleft=0;
							 }else{
								 $isleft=1;
							 }
						  }
						  for($j=1;$j<count($arr2);$j++){
							  
							  if(trim($arr2[$j])!=""){
								  
									  $values=explode(":", $arr2[$j]); 
                                      $title=trim($values[0]);
									  $lable=trim($values[1]);
						              
									  if($data["lang"]=="阿拉"){
											if($type==0){
												
												 if($lable=="√"){
													  $value_x="Y";
												 }else{
													  $value_x="N";
												 }
											}else{
                                                 if($isleft==1){
													$title=trim($values[0]);
													$lable=trim($values[1]); 
									             }else{
													 $title=trim($values[1]);
													 $lable=trim($values[0]);
												 }
												 $value_x=chr(65+$index);
											}
									  }else{
									  
											if($type==0){
												 if($lable=="√"){
													  $value_x="Y";
												 }else{
													  $value_x="N";
												 }
											}else{
                                                 if($isleft==1){
													$title=trim($values[0]);
													$lable=trim($values[1]); 
									             }else{
													 $title=trim($values[1]);
													 $lable=trim($values[0]);
												 }
												 $value_x=chr(65+$index);
											}
									  }
									  
									  $x="{\"lable\":\"$lable\",\"title\":\"$title\",\"num\":\"0\",\"value\":\"$value_x\"}";
									  if($items!=""){
										$items.=",".$x;
									  }else{
										$items=$x;  
									  }
									 $index++;
							  }
						  }
                             $items="[".$items."]";
		
                              $valuestr="";
							  $va=$value; 
							  $ite=json_decode($items,true);
							 // var_dump($ite);
							 
							  for($u=0;$u<strlen($va);$u++){
								for($y=0;$y<count($ite);$y++){
										$row=$ite[$y];
										if($row["value"]==$va[$u]){
											if($valuestr!=""){
												 $valuestr.="##".$row["title"];
											}else{
												 $valuestr=$row["title"];
											}
										}
									}
								}
						
						 
						  if($photo!=""){
							  $photo="file/photo/".$photo;
						  }
						  $data["idno"]=md5(uniqid("",true));
						  $data1["photo"]= $photo;
						  $data1["value"]= $value;
						  $data1["valuestr"]= $valuestr;
						  $data1["name"]= $name;
						  $data1["type"]= $type;
						  $data1["items"]=$items;
						  $data1["userid"]=$userid;
						  $data1["classno"]=$classno;
						  $data1["classid"]=$classid;
						  $data1["fenshu"]=$fenshu;
						  $data1["kemu"]=$data["kemu"];
						  $data1["addtime"]=date("Y-m-d H:i:s");
						 // $res=$mod->save($data1);
						   $rs=$mod->data($data1)->add();
						 // echo $mod->getLastSql();
						 //exit();

					     
					  }
			   }
			   
			} 
						 //if($rs){
						    $this->showmessage('已批量上传',U($this->urldir.'/index/',array("lang"=>$data["lang"])),3);exit;
						  //}else{
							// $this->success('已批量失败',$this->index(),3);exit;
						  //}
			//$this->success('已更新',U($this->urldir.'/index/'),3);exit;$data["lang"]
	}
}

public function unescape1($str) {
    $str = rawurldecode($str);
    preg_match_all("/(?:%u.{4})|&#x.{4};|&#\d+;|.+/U",$str,$r);
    $ar = $r[0];
    //print_r($ar);
    foreach($ar as $k=>$v) {
        if(substr($v,0,2) == "%u"){
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,-4)));
  }
        elseif(substr($v,0,3) == "&#x"){
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,3,-1)));
  }
        elseif(substr($v,0,2) == "&#") {
             
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("n",substr($v,2,-1)));
        }
    }
    return join("",$ar);
}
public  function unescape($str) {
    $str = rawurldecode($str);
    preg_match_all("/(?:%u.{4})|&#x.{4};|&#\d+;|.+/U",$str,$r);
    $ar = $r[0];
    //print_r($ar);
    foreach($ar as $k=>$v) {
        if(substr($v,0,2) == "%u"){
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,-4)));
  }
        elseif(substr($v,0,3) == "&#x"){
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("H4",substr($v,3,-1)));
  }
        elseif(substr($v,0,2) == "&#") {
            $ar[$k] = iconv("UCS-2BE","UTF-8",pack("n",substr($v,2,-1)));
        }
    }
    return join("",$ar);
}
public  function  unicode_decode($name)  
    {  
        $name = strtolower($name);  
        // 转换编码，将Unicode编码转换成可以浏览的utf-8编码  
        $pattern = '/([\w]+)|(\\\u([\w]{4}))/i';  
        preg_match_all($pattern, $name, $matches);  
        if (!empty($matches))  
        {  
            $name = '';  
            for ($j = 0; $j < count($matches[0]); $j++)  
            {  
                $str = $matches[0][$j];  
                if (strpos($str, '\\u') === 0)  
                {  
                    $code = base_convert(substr($str, 2, 2), 16, 10);  
                    $code2 = base_convert(substr($str, 4), 16, 10);  
                    $c = chr($code).chr($code2);  
                    $c = iconv('UCS-2', 'UTF-8', $c);  
                    $name .= $c;  
                }  
                else  
                {  
                    $name .= $str;  
                }  
            }  
        }  
        return $name;  
    }  
public function delete()
{
	$id=I('get.id');
	$user=D($this->tablename);
	$w["id"]=array("eq",$id);
	$res= $user->where($w)->delete();
	$this->showmessage('已删除',U($this->urldir.'/index'),3);exit;

       

}
}
?>