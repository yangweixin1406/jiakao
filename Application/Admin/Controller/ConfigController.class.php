<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigController extends CommController {
public $tablename="config";

public $urldir="config";
public $lang="文章";
public function index()
{
   $this->info();
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
    $id=1;
	$data=I('post.');
	$mod=D($this->tablename);
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
       $this->assign('webtitle',"更新".$this->lang);
	}else{
		$this->assign('webtitle',"添加".$this->lang);
	}
	$class=M("class");
	$wh['_string'] = " fatherno='".$this->fatherid."' or classno='".$this->fatherid."' ";
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
	   if($id==""){
//		     $userone=session("user");
//			 $data["userid"]=$userone["id"];
//			 $onerow=M($this->tablename)->order(" id desc")->find();
//			 $data["queue"]=1;
//			 if($onerow){
//			  $data["queue"]=$onerow["id"]+1;
//			 }
//             $data["addtime"]=date("Y-m-d H:i:s");
//			 $rs=$mod->data($data)->add();

//			   $this->showmessage('已添加',U($this->urldir.'/info/'),3);exit;

	   }else{
		    $where["id"]=$id;
		    $rs=$mod->where($where)->save($data);

			$this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
public function delete()
{
	$id=I('get.id');
	if($id==""){$id=I('ids');}
	$user=D($this->tablename);
	$w["id"]=array("in",$id);
	$res= $user->where($w)->delete();
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
