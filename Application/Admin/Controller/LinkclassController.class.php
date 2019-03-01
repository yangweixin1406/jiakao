<?php
namespace Admin\Controller;
use Think\Controller;
class LinkClassController extends CommController{
public $tablename="link_class";
public $lang="分类";
public $urldir="Admin/linkclass";
public function index()
{
    $this->lists();
}
public function lists()
{

    //http://document.thinkphp.cn/manual_3_2.html#where
	$mod=D($this->tablename);
	//$where["id"]=array('gt',0);
	
	$title=I("title");
	$about=I("about");
	if($title!=""){
	  $where["title"]=array('like',"%".$title."%");
	}

	$count = $mod->where($where)->count();
	//$this->show($mod->getLastSql());
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
          $this->assign('webtitle',"".$this->lang."列表");
	  $this->assign('list',$list);
	  $this->assign('show',$show);
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


public function info(){
    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);
	if($_POST){
	   $this->save();
	}
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
        $this->assign('webtitle',"更新".$this->lang."");
	}else{
		$this->assign('webtitle',"添加".$this->lang."");
	}
	$this->assign("tablename",$this->tablename);
	$this->assign("info",$info);
	$this->assign("id",$id);
	$this->assign("lang",$this->lang);
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
		     $userone=session("user");
			 $data["addtime"]=date("Y-m-d H:i:s");
			 $data["userid"]=$userone["id"];
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 $data["queue"]=1;
			  
			 $rs=$mod->data($data)->add();

			 $this->showmessage('已添加',U($this->urldir.'/info/'),3);exit;


	   }else{
		    $where["id"]=$id;
			//unset($data["id"]); 
			//$data["addtime"]=date("Y-m-d H:i:s");
		     $rs=$mod->where($where)->save($data);

			$this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
 public function delete()
{
	$id=I('id');
	if($id==""){$id=I('ids');}
	$mod=D($this->tablename);
	$w["id"]=array(array("in",$id),array("neq",1),array("neq",4),array("neq",6),array("neq",10),array("neq",8));//确保id为1的不能删除掉
	$res= $mod->where($w)->delete();
	$this->showmessage('已删除',U($this->urldir.'/index'),3);exit;

}
public function deleteall()
{
	$id=I('id');
	$username=I('username');
	$root=I('root');
	$state=I('state');
	$mod=D($this->tablename);
	
	if($username!=""){
	$where["username"]=array("like","%".$username."%");
	}
	if($root!=""){
	$where["root"]=array("eq",$root);
	}
	if($state!=""){
	$where["state"]=array("eq",$state);
	}
	$where["id"]=array("neq",1);//确保id为1的不能删除掉
	
	if($where){
	  $res= $mod->where($where)->delete();
	}
   $this->showmessage('已删除',U($this->urldir.'/index'),3);exit;

}

}
?>