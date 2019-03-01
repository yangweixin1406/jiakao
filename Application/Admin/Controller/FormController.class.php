<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends \Admin\CommController{
public $tablename="user";
public $lang="会员";
public $urldir="Admin/user";
public function index()
{

    //http://document.thinkphp.cn/manual_3_2.html#where
	$mod=D($this->tablename);
	//$where["id"]=array('gt',0);
	
	$username=I("username");
	$classno=I("classno");
	$root=I("root");
	$state=I("state");
	
	if($root!=""){
	 $where["root"]=array('eq',$root);
	}
	if($username!=""){
	 $where["username"]=array('like',"%".$username."%");
	}
	if($state!=""){
	  $where["state"]=array('eq',$state);
	}

	$count = $mod->where($where)->count();
	//$this->show($mod->getLastSql());
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$val){
		  $list[$key]["root_caption"]=$this->getcaption(C("root"),$list[$key]["root"]);
		  $list[$key]["state_caption"]=$this->getcaption(C("state"),$list[$key]["state"]);
	  }
	  $this->assign('rootlist',json_decode(C("root"),true));
	  $this->assign('statelist',json_decode(C("state"),true));
	  $this->assign('list',$list);
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign('list',$list);
	  $this->assign('show',$show);
	  $this->assign('data',json_encode(I()));
	  $this->assign("lang",$this->lang);
	  //$this->view('index');
	  $this->display("index");
}
public function add(){
	
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
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
        $this->assign('webtitle',"更新".$this->lang."");
	}else{
		$this->assign('webtitle',"添加".$this->lang."");
	}

	$this->assign('rootlist',json_decode(C("root"),true));
	$this->assign('statelist',json_decode(C("state"),true));
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
			 if($onerow){
			  $data["queue"]=$onerow["id"]+1;
			 }
			 $rs=$mod->data($data)->add();

			   $this->success('已添加',U($this->urldir.'/info/'),3);exit;

	   }else{
		    $where["id"]=$id;
			//unset($data["id"]); 
			if($data["userpwd"]==""){
			  unset($data["userpwd"]); 
			}else{
				$data["userpwd"]=md5($data["userpwd"]); 
			}
			//$data["addtime"]=date("Y-m-d H:i:s");
		    $rs=$mod->where($where)->save($data);
			if($rs)
			 {
			   $this->success('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;
			 }
			 else
			 {

				 $this->error('添加失败',U($this->urldir.'/info'),3);exit;
			 }
	   }
	}
   $this->info();
}
 public function delete()
{
	$id=I('id');
	$mod=D($this->tablename);
	$w["id"]=array(array("in",$id),array("neq",1));//确保id为1的不能删除掉
	$res= $mod->where($w)->delete();

		 $this->success('已删除',U($this->urldir.'/index'),3);exit;

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

       $this->success('已删除',U($this->urldir.'/index'),3);exit;

}

public function login(){	
	  $data=I('post.');
	  $username=$data["username"];
	  $userpwd=md5($data["userpwd"]);
	  $where["username"]=array("eq",$username);
	  $where["userpwd"]=array("eq",$userpwd);
	  $where["root"]=array("eq",0);
	  $where["state"]=array("eq",1);
	  if(!empty($username))
	  {
	  
		  $user=D("User");
		  $one=$user->where($where)->find();
		  if(!empty($one))
		  {
			  session("user",$one);
			  $this->success('登录成功',U('/Admin/index'),3);exit;
		  }
		  else
		  {
			$this->error('登录失败',U('User/login'),3);exit;
		  }
	  }
	  $this->view("login");
}
}

?>