<?php
namespace Admin\Controller;
use Think\Controller;
class ContentController extends CommController {
public $tablename="content";
public $fatherno="";
public $urldir="Admin/content";
public $lang="文章";
public function index()
{
    $this->lists();
}
public function lists(){
	$mod=D($this->tablename);
	$this->fatherno=$GLOBALS["g_content"]["classno"];
	$where["id"]=array('gt',0);
	$name=I("name");
	$classno=I("classno");
	$state=I("state");
	$state=I("state");
	if($name!=""){
	 $where["name"]=array('like',"%".$name."%");
	}
	if($classno!=""){
	 $where["classno"]=array('like',"".$classno."%");
	}
	if($state!=""){
	 $where["state"]=array('eq',$state);
	}
	$class=M("class");
	$wh['_string'] = " fatherno='".$this->fatherno."' ";
	$classlist=$class->where($wh)->select();
	$count = $mod->where($where)->count();
	$item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$row){
		  if($list[$key]["classid"]!="0"){
			  $w["id"]=$list[$key]["classid"];
			  $class_one=M("class")->where($w)->find();
			  $list[$key]["class_caption"]=$class_one["title"];
			  $list[$key]["state_caption"]=$this->getcaption(C("state"),$list[$key]["state"]);
		  }
	  }
	  $item["num"]=count($list);
	  $this->assign('statelist',json_decode(C("state"),true));
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign('mytitle',"<i class='i-n'>文章</i>列表");
	  $this->assign('classlist',$classlist);
	  $this->assign('item',$item);
	  $this->assign('list',$list);
	  $this->assign('show',$show);
	  $this->assign("lang",$this->lang);
	  //$this->view('index');
	   $this->display("lists");
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
    public function view($view)
    {
    	$this->display($view);
}
public function info(){
    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);
	$this->fatherno=$GLOBALS["g_content"]["classno"];
	if($_POST){
		 $map_class["classno"]=array("eq",$data["classno"]);
		 $class_row=M("class")->where($map_class)->find();
		 $data["classid"]=$class_row["id"];
		 if($data["state"]==""){
			 $data["state"]=0;
		 }
	   if($id==""){
		     $userone=session("user");
			 $data["userid"]=$userone["id"];
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 $data["sort"]=1;
			 if($onerow){
			  $data["sort"]=$onerow["id"]+1;
			 }
             $data["addtime"]=date("Y-m-d H:i:s");
			 $rs=$mod->data($data)->add();

			   $this->showmessage('已添加',U($this->urldir.'/info'),3);exit;
 
	   }else{
		    $where["id"]=$id;
		    $rs=$mod->where($where)->save($data);
			//$this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;
			$this->showmessage("已更新",U($this->urldir.'/info/',array("id"=>$id)),3);
			

	   }
	}
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
		$info["content"]=htmlspecialchars_decode($info["content"]);

       $this->assign('webtitle',"更新".$this->lang);
	   $this->assign('mytitle',"更新<i class='i-n'>".$this->lang."</i>");
	}else{
		$this->assign('webtitle',"添加".$this->lang);
		$this->assign('mytitle',"添加<i class='i-n'>".$this->lang."</i>");
	}
	$class=M("class");
	$wh['_string'] = " fatherno='".$this->fatherid."' or classno='".$this->fatherno."' ";
	$classlist=$class->where($wh)->select();
	$this->assign("classlist",$classlist);
	$this->assign('statelist',json_decode(C("state"),true));
	$this->assign("info",$info);
	$this->assign("lang",$this->lang);
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
			 $data["classid"]=$class_row["id"];
			 if($data["state"]==""){
				 $data["state"]=0;
			 }
	   if($id==""){
		     $userone=session("user");
			 $data["userid"]=$userone["id"];
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 $data["sort"]=1;
			 if($onerow){
			  $data["sort"]=$onerow["id"]+1;
			 }
             $data["addtime"]=date("Y-m-d H:i:s");
			 $rs=$mod->data($data)->add();
			 $this->showmessage('已添加',U($this->urldir.'/info'),3);exit;

	   }else{
		    $where["id"]=$id;
		    $rs=$mod->where($where)->save($data);
			//exit();

			   $this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
public function delete()
{
	$id=I('get.id');
	$jz_ids="";
	if($id==""){$id=I('ids');}
	$mod=D($this->tablename);
	if($id!=""){
	  $arr=explode(",",$id);
	  for($i=0;$i<count($arr);$i++){
	    $id1=trim($arr[$i]);
		 if($id1!=""){
			 if($id1!="1"){
			   $w["id"]=array("eq",$id1);
				$res= $mod->where($w)->delete();
			 }else{
				$jz_ids.=$id1.",";
			 }
		 }
	   }
	}

	$this->showmessage('已删除',U($this->urldir.'/index'),3);exit;
	
}
public function deleteall()
{
	$id=I('id');
	$name=I('name');
	$classno=I('classno');
	$state=I('state');
	$mod=D($this->tablename);
	
	if($classno!=""){
	$where["classno"]=array("like","".$classno."%");
	}
	if($name!=""){
	$where["name"]=array("like","%".$name."%");
	}
	if($state!=""){
	$where["state"]=array("eq",$state);
	}
	if($where){
	  $res= $mod->where($where)->delete();
	}
    $this->showmessage('已删除',U($this->urldir.'/index'),3);exit;

}	 
}
?>
