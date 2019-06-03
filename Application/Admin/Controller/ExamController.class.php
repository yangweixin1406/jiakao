<?php
namespace Admin\Controller;
use Think\Controller;
class ExamController extends CommController{
public $tablename="exam";
public $fatherid="00010004";//考题大类编码
public $urldir="Admin/";
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

    $mod=D($this->tablename);
	$where["id"]=array('gt',0);
	$name=I("title");
	$classno=I("classno");
	$type=I("type");
	$table=I("table");
	if($table!=""){
	  $this->tablename=$table;
	}
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
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');
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
	$this->assign("info",$info);
	$this->assign("id",$id);
	$this->display('info');
}

public function add(){
	   $this->info();
}
public function save()
{

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
			  $data["idno"]=md5(uniqid("",true));
			 $data["addtime"]=date("Y-m-d H:i:s");
			 $data["userid"]=$userone["id"];
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 $data["queue"]=1;
			 if($onerow){
			  $data["queue"]=$onerow["id"]+1;
			 }
			 $rs=$mod->data($data)->add();

			   $this->showmessage('已添加',U($this->urldir.$this->tablename.'/info/'),3);exit;

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
            $this->showmessage('已更新',U($this->urldir.$this->tablename.'/info/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
 public function delete()
{
	$id=I('id');
	if($id==""){$id=I('ids');}
	$mod=D($this->tablename);
	$w["id"]=array("in",$id);
	$res= $mod->where($w)->delete();

		 $this->showmessage('已删除',U($this->urldir.$this->tablename.'/index'),3);exit;

}
public function deleteall()
{
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
	 $this->showmessage('已删除',U($this->urldir.$this->tablename.'/index'),3);exit;

}
}
?>