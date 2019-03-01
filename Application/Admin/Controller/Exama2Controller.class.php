<?php
namespace Admin\Controller;
use Think\Controller;
class Exama2Controller extends CommController {
public $tablename="exama2";
public $fatherid="00010005";//考题大类编码
public $urldir="Admin/exama2";
public $lang="阿拉";
public $yes_caption="سەمىمىي；ھەققانىي";
public $no_caption="خاتا، خاتالىق، سەۋەنلىك";
public function index()
{
	$mod=D($this->tablename);
	$where["id"]=array('gt',0);
	$name=I("name");
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
			  $list[$key]["class_caption"]=$class_one["name"];
		  }
	  }
	  $typelist="[{\"name\":\"单选题\",\"value\":\"1\"},{\"name\":\"判断题\",\"value\":\"0\"},{\"name\":\"多选题\",\"value\":\"2\"}]";
	  $this->assign('webtitle',$this->lang."考题列表");
	  $this->assign('list',$list);
	  $this->assign('classlist',$classlist);
	  $this->assign('typelist',json_decode($typelist,true));
	  $this->assign('show',$show);
	  $this->assign('data',json_encode(I()));
	  $this->assign("lang",$this->lang);
	  //$this->view('index');
	   $this->display("index");
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
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
        $this->assign('webtitle',"更新".$this->lang."考题");
	}else{
		$this->assign('webtitle',"添加".$this->lang."考题");
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
	if(!empty($data["act"])){
			 $map_class["classno"]=array("eq",$data["classno"]);
			 $class_row=M("class")->where($map_class)->find();
			 $data["items"]=json_encode($data["items"]);
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

			 $this->success('已添加',U($this->urldir.'/info/'),3);exit;

	   }else{
		    $where["id"]=$id;
		    $rs=$mod->where($where)->save($data);
			$this->success('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
 public function delete()
{
	$id=I('id');
	$mod=D($this->tablename);
	$w["id"]=array("in",$id);
	$res= $mod->where($w)->delete();
	$this->success('已添加',U($this->urldir.'/index'),3);exit;

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
	$this->success('已删除',U($this->urldir.'/index'),3);exit;

}
}
