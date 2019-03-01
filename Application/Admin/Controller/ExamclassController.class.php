<?php
namespace Admin\Controller;
use Think\Controller;
class ExamController extends CommController{
public $tablename="exam";
public $fatherid="00010004";//考题大类编码
public $urldir="Admin/exam";
public $lang="中文";
public $yes_caption="正确";
public $no_caption="错误";
public function index()
{
	 $this->lists();
}
public function encode_json($str){  
    $code = json_encode($str);  
    $code=preg_replace("#\\\u([0-9a-f]+)#ie", "iconv('UCS-2', 'UTF-8', pack('H4', '\\1'))", $code); 
	$code=str_replace("\\/","/",$code);
	return $code;
} 
public function update_items_abcd()
{
	$ABCD="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    header("Content-type: text/html; charset=utf-8");
    $mod=D($this->tablename);
	//$where1["id"]=array('eq',"442");
     $where1["type"]=array('eq',"1");
	 $list = $mod->where($where1)->order('id desc')->limit("0,1000")->select();
	  foreach($list as $key=>$row){
	            
		        $items=json_decode($row["items"],true); 
				$i=0;
				if($row["type"]!=0){
					 foreach($items as $key1=>$row1){
							$items[$key1]["value"]=$ABCD[$i];
							$i++;
					 }
					  $items=$this->encode_json($items);
					  $data["items"]=$items;
					  $where["id"]=$row["id"];
					  $rs=$mod->where($where)->save($data);
					  $ids.=$row["id"].",";
				 }
				//var_dump($items);
				//exit();
				
	  }
	  exit($ids);
}
public function lists()
{
    $table=I("get.table");
	if($table!=""){
	  $this->tablename=$table;
	}
	
    $mod=D($this->tablename);
	$where["id"]=array('gt',0);
	$name=I("title");
	$classno=I("classno");
	$type=I("type");
	
	if($name!=""){
	 $where["name"]=array('like',"%".$name."%");
	}
	if($classno!=""){
	 $where["classno"]=array('like',"".$classno."%");
	}
	if($type!=""){
	 $where["type"]=array('eq',"".$type);
	}
	$class=M("class");
	$wh["fatherno"]=array("eq",$this->fatherid);
	$classlist=$class->where($wh)->select();
	
	$count = $mod->where($where)->count();
	$item["rowcountz"]=$count;
	//$this->show($mod->getLastSql());
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$row){
		   $list[$key]["type_caption"]=$this->getcaption(C("exam_type"),$list[$key]["type"]);
		   $list[$key]["kemu_caption"]=$this->getcaption(C("exam_kemu"),$list[$key]["kemu"]);
		  if($list[$key]["classid"]!="0"){
			  $w["id"]=$list[$key]["classid"];
			  $class_one=M("class")->where($w)->find();
			  $list[$key]["class_caption"]=$class_one["title"];
			
		  }
	  }
//8232
	  $typelist="[{\"name\":\"单选题\",\"value\":\"1\"},{\"name\":\"判断题\",\"value\":\"0\"},{\"name\":\"多选题\",\"value\":\"2\"}]";
	  $item["num"]=count($list);
	  $item["classno"]=$classno;
	  $this->assign('item',$item);
	  $this->assign('webtitle',$this->lang."考题列表");
	  $this->assign('list',$list);
	  $this->assign('classlist',$classlist);
	  $this->assign('table',$this->tablename);
	  $this->assign('typelist',json_decode($typelist,true));
	  $this->assign('show',$show);
	  $this->assign('data',json_encode(I()));
	  $this->assign("lang",$this->lang);
	  //$this->view('index');
	  $this->display("lists");
}
public function view($view)
{
    	$this->display($view);
}
public function getcaption($str,$value){
	
	$caption="";

	$list=json_decode($str,true);
	foreach($list as $row){
		if(trim($row["value"])==trim($value)){
			$caption=$row["name"];
		}
	}

	return $caption;
}
public function info(){
    $table=I("get.table");
	if($table!=""){
	  $this->tablename=$table;
	}
    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);
	if($data){
	 $this->save();
	}
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
        $this->assign('mytitle',"更新考题");
	}else{
		$this->assign('mytitle',"添加考题");
	}
	$class=M("class");
	$wh["fatherno"]=array("eq",$this->fatherid);
	$classlist=$class->where($wh)->select();
	$this->assign("kemulist",json_decode(C("exam_kemu"),true));
	$this->assign("classlist",$classlist);
	$this->assign("tablename",$this->tablename);
	$captions=json_decode(C($this->tablename."_caption"),true);
	$info["yes_caption"]=$captions[yes_caption];
	$info["no_caption"]=$captions[no_caption];
	//var_dump($info);
	$this->assign("table",$table);
	$this->assign("info",$info);
	$this->assign("id",$id);
	$this->display('info');
}

public function add(){
	   $this->info();
}
public function save()
{
    $table=I("get.table");
	if($table!=""){
	  $this->tablename=$table;
	}
    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();

	}

	if($data){
			 $map_class["classno"]=array("eq",$data["classno"]);
			 $class_row=M("class")->where($map_class)->find();
			 $data["items"]=$this->encode_json($data["items"]);
			 $data["classid"]=$class_row["id"];
			 
	   if($id==""){
		     $userone=session("user");
			 $data["addtime"]=date("Y-m-d H:i:s");
			 $data["userid"]=$userone["id"];
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 $data["queue"]=1;
			 if($onerow){
			  $data["queue"]=$onerow["id"]+1;
			 }
			 $rs=$mod->data($data)->add();

			   $this->showmessage('已添加',U($this->urldir.'/info/',array("table"=>$this->tablename)),3);exit;

	   }else{
		    $where["id"]=$id;
//			$data1["name"]=$data["name"];
//			$data1["items"]=$data["items"];
//			$data1["photo"]=$data["photo"];
//			$data1["classno"]=$data["classno"];
//			$data1["classid"]=$data["classid"];
//			$data1["type"]=$data["type"];
//			//$data1["addtime"]=date("Y-m-d H:i:s");
//			$data1["value"]=$data["value"];
			//$data1["addtime"]=date("Y-m-d H:i:s");
            
		    $rs=$mod->where($where)->save($data);
            $this->showmessage('已更新',U($this->urldir.'/info/',array("table"=>$this->tablename,"id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
 public function delete()
{
    $table=I("get.table");
	if($table!=""){
	  $this->tablename=$table;
	}
	$id=I('id');
	if($id==""){$id=I('ids');}
	$mod=D($this->tablename);
	$w["id"]=array("in",$id);
	$res= $mod->where($w)->delete();

	$this->showmessage('已删除',U($this->urldir.'/index',array("table"=>$this->tablename)),3);exit;

}
public function deleteall()
{
    $table=I("table");
	if($table!=""){
	  $this->tablename=$table;
	}
	$id=I('id');
	$name=I('name');
	$classno=I('classno');
	$type=I('type');
	$mod=D($this->tablename);
	if($name!=""){
	$w["name"]=array("like","%".$name."%");
	}
	if($classno!=""){
	$w["classno"]=array("eq",$classno);
	}
	if($type!=""){
	$w["type"]=array("eq",$type);
	}
	$res= $mod->where($w)->delete();
	 $this->showmessage('已删除',U($this->urldir.'/index',array("table"=>$this->tablename)),3);exit;

}

public function daoru(){
       







     if($_POST){
	   $path=trim(I("filepath"));
       $classno=I("classno");
	    if($path==""){
		   $this->showmessage('请上传xls文件',U($this->urldir.'/daoru/',array("table"=>$this->tablename)),3);exit;
		}
		$arr=explode(".",$path);
		$ext=strtolower(end($arr));
	
	   if($ext!="xls"&&$ext!="xlsx"){
	       $this->showmessage('请上传xls文件',U($this->urldir.'/daoru/',array("table"=>$this->tablename)),3);exit;
	   }
       $path_full=dirname(dirname(dirname(dirname(__FILE__))))."/".$path;
	   if(!is_file($path_full)){
	     $this->showmessage('文件不存在',U($this->urldir.'/daoru/',array("table"=>$this->tablename)),3);exit;
	   }
	  header("Content-type: text/html; charset=utf-8"); 
	    Vendor('PHPExcel.IOFactory');
        //require_once dirname(dirname(dirname(dirname(__FILE__)))).'/Public/PHPExcel1.7.6/Classes/PHPExcel/IOFactory.php';
  // echo dirname(dirname(dirname(dirname(__FILE__)))).'/Public/PHPExcel1.7.6/Classes/PHPExcel/IOFactory.php';
     //exit();

        $objPHPExcel = \PHPExcel_IOFactory::load($path_full);
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
	   $success_count=0;
	   $str="A B C D E F G H I J K L M N O P Q R S T U V W X Y Z";
	   $arr_abc=explode(" ",$str);
	      for($i=0;$i<count($arr_abc);$i++){

		     $name=trim($currentSheet->getCell($arr_abc[$i]."1")->getValue());

			 if($name=="考题标题"){
			    $json["name"]["field_name"]="name";
			    $json["name"]["title"]=$name;
			    $json["name"]["cell"]=$arr_abc[$i];
			 }
			 if($name=="考题科目"){
			    $json["kemu"]["field_name"]="kemu";
			    $json["kemu"]["title"]=$name;
			    $json["kemu"]["cell"]=$arr_abc[$i];
			 }
			 if($name=="考题类型"){
			    $json["type"]["field_name"]="type";
			    $json["type"]["title"]=$name;
			    $json["type"]["cell"]=$arr_abc[$i];
			 }
			 if($name=="考题答案"){
			    $json["value"]["field_name"]="value";
			    $json["value"]["title"]=$name;
			    $json["value"]["cell"]=$arr_abc[$i];
			 }
			 if($name=="图片"){
			    $json["photo"]["field_name"]="photo";
			    $json["photo"]["title"]=$name;
			    $json["photo"]["cell"]=$arr_abc[$i];
			 }
			 if($name=="选项1"){
			    $json["items"]["options"][0]["cell"]=$arr_abc[$i];
			    $json["items"]["field_name"]="items";
			    $json["items"]["title"]=$name;
			 }
			 if($name=="选项2"){
			    $json["items"]["options"][1]["cell"]=$arr_abc[$i];
			    $json["items"]["field_name"]="items";
			    $json["items"]["title"]=$name;
			 }
			 if($name=="选项3"){
			    $json["items"]["options"][2]["cell"]=$arr_abc[$i];
			    $json["items"]["field_name"]="items";
			    $json["items"]["title"]=$name;
			 }
			 if($name=="选项4"){
			    $json["items"]["options"][3]["cell"]=$arr_abc[$i];
			    $json["items"]["field_name"]="items";
			    $json["items"]["title"]=$name;
			 }
			 if($name=="图片"){
			    $json["photo"]["title"]=$name;
				$json["photo"]["field_name"]="photo";
			    $json["photo"]["cell"]=$arr_abc[$i];
			 }
		 }

       for($currentRow =2;$currentRow<=$allRow;$currentRow++){//获取excel文件数据到数组
			 foreach($json as $key=>$val){
			       $field_name=$val["field_name"];
				   $cell=$val["cell"];
				   $type=0;
				   
				   if($json["type"]["cell"]){
				      $type1=trim($currentSheet->getCell($json["type"]["cell"].$currentRow)->getValue());
					  if($type1=="判断题"){ $type=0;}
					  if($type1=="单选题"){ $type=1;}
				   }
				   $data["type"]=$type;
				   if(isset($val["cell"])){
			          $data[$val["field_name"]]=trim($currentSheet->getCell($cell.$currentRow)->getValue());
				   }else{
				       if(isset($val["options"])){
					       $ite_str="";
						   $index=0;
					       foreach($val["options"] as $k=>$v){
						      $option=trim($currentSheet->getCell($v["cell"].$currentRow)->getValue());
							  $title="";
							  $lable="";
							  $num=0;
							  if($option!=""){
							  if($type==0){
									if($option=="Y"){ $title="正确"; $lable="√";$value = $option;}
									if($option=="N"){ $title="错误"; $lable="×";$value = $option;}
									if($option=="正确"){$title="正确";$lable="√"; $value="Y";}
									if($option=="错误"){$title="错误"; $lable="×"; $value="N";}
							   }
							  if($type==1){
									$title=$option;
									$value=$arr_abc[$index];
									$lable=$arr_abc[$index];
							   }
							   $ite='{"lable":"'.$lable.'","title":"'.$title.'","num":"'.$num.'","value":"'.$value.'"}';
							   if($ite_str!=""){
							     $ite_str.=",".$ite;
							   }else{
							     $ite_str=$ite;
							   }
							    $index++;
								}
						   }
						   if($ite!=""){
						      $ite_str="[".$ite_str."]";
						   }
						   $data[$val["field_name"]] = $ite_str;
					   }
				   }
				  
			 }

			  $isbool=0;
			  foreach($data as $key=>$val){
			     if(trim($val)!=""){
				   $isbool=1;
				 }
			   }
			   if($isbool==1){
					 $mod=D($this->tablename);
					 $data["classno"]=$classno;
					 $map_class["classno"]=array("eq",$classno);
					 $class_row=M("class")->where($map_class)->find();
					 if($class_row){
					    $data["classid"]=$class_row["id"];
					 }
					 $userone=session("user");
					 $data["addtime"]=date("Y-m-d H:i:s");
					 $data["userid"]=$userone["id"];
					$rs=$mod->data($data)->add();
			        // var_dump($data);
					  $success_count++;
			    }
		
			    unset($data);
			 	
	    }
        $this->showmessage('已导入'.$success_count."条",U($this->urldir.'/daoru/',array("table"=>$this->tablename)),4);exit;
	}

	$this->display();
}



}
?>