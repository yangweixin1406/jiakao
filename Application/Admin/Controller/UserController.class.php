<?php
namespace Admin\Controller;
use Think\Controller;
class UserController extends Controller{
public $tablename="user";
public $lang="会员";
public $urldir="user";
public function islogin(){
	 $userone=session("user");
      if(!$userone||$userone["root"]!=0){
	    echo "<script>if(window.top){window.top.location='".__APP__."/admin/user/login';}else{window.location='".__APP__."/admin/user/login';}</script>";
		 exit();
	  }
} 
public function index()
{
$this->lists();
}
public function lists()
{

    //http://document.thinkphp.cn/manual_3_2.html#where
	$this->islogin();
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
	$item["rowcountz"]=$count;
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
	   $item["num"]=count($list);
	  $this->assign('rootlist',json_decode(C("root"),true));
	  $this->assign('statelist',json_decode(C("state"),true));
	  $this->assign('list',$list);
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign('mytitle',"<i class='i-n'>用户</i>列表");
	  $this->assign('list',$list);
	  $this->assign('item',$item);
	  $this->assign('show',$show);
	  $this->assign('data',json_encode(I()));
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
  	$this->islogin();
	   $this->info();
}
public function save()
{
   $this->islogin();
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
			 $data["userpwd"]=md5($data["userpwd"]);
			 $data["username"]=strtolower($data["username"]);
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 $data["queue"]=1;
			 if($onerow){
			  $data["queue"]=$onerow["id"]+1;
			 }
			 $data["youxiaoqi"]=date("Y-m-d H:i:s",strtotime($data["youxiaoqi"]));
			 $rs=$mod->data($data)->add();

			   $this->showmessage('已添加',U($this->urldir.'/info/'),3);exit;

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

			   $this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
public function only(){

    $my=session("user");

	$data=I('post.');
	
	$mod=D($this->tablename);
	
	if($_POST){
		if($data["userpwd"]==""){
		  unset($data["userpwd"]); 
		}else{
		  $data["userpwd"]=md5($data["userpwd"]); 
		}
		$where['id']=$my['id'];
	    $rs=$mod->where($where)->save($data);
	    unset($data["username"]); 
	    unset($data["root"]); 
	}
	
	$map["id"]=$my['id'];
	$info=$mod->where($map)->find();
    $this->assign('webtitle',"更新个人资料");
    $this->assign('mytitle',"更新<i class='n-i'>个人资料</i>");
	$this->assign('rootlist',json_decode(C("root"),true));
	$this->assign('statelist',json_decode(C("state"),true));
	$this->assign("tablename",$this->tablename);
	$this->assign("info",$info);
	$this->assign("id",$id);
	$this->assign("lang",$this->lang);
	$this->display('only');

}
public function pwd(){

    $my=session("user");

	$data=I('post.');
	
	$mod=D($this->tablename);
	
	if($_POST){

        if($data["userpwd"]!=""){

		   $data1["userpwd"]=md5($data["userpwd"]); 
		   $where['id']=$my['id'];
	       $rs=$mod->where($where)->save($data1);
		}

	}
	
	$map["id"]=$my['id'];
	$info=$mod->where($map)->find();
    $this->assign('webtitle',"更新我的密码");
    $this->assign('mytitle',"更新<i class='n-i'>我的密码</i>");
	$this->assign('rootlist',json_decode(C("root"),true));
	$this->assign('statelist',json_decode(C("state"),true));
	$this->assign("tablename",$this->tablename);
	$this->assign("info",$info);
	$this->assign("id",$id);
	$this->display('pwd');

}
 public function delete()
{
	$this->islogin();
	$id=I('id');
	if($id==""){$id=I('ids');}
	$mod=D($this->tablename);
	if($id!=""){
	$w["id"]=array(array("in",$id),array("neq",1));//确保id为1的不能删除掉
	$res= $mod->where($w)->delete();
	}
	$this->showmessage('已删除',U($this->urldir.'/index'),3);exit;


}
public function deleteall()
{
//	$this->islogin();
//	$id=I('id');
//	$username=I('username');
//	$root=I('root');
//	$state=I('state');
//	$mod=D($this->tablename);
//	
//	if($username!=""){
//	$where["username"]=array("like","%".$username."%");
//	}
//	if($root!=""){
//	$where["root"]=array("eq",$root);
//	}
//	if($state!=""){
//	$where["state"]=array("eq",$state);
//	}
//	$where["id"]=array("neq",1);//确保id为1的不能删除掉
//	
//	if($where){
//	  $res= $mod->where($where)->delete();
//	}
//
//     $this->showmessage('已删除',U($this->urldir.'/index'),3);exit;

}

public function login(){	
	  $data=I('post.');
	   $user=D("User");
	  $username=$data["username"];
	  $userpwd=md5($data["userpwd"]);
	  $where["username"]=array("eq",$username);
	  $where["userpwd"]=array("eq",$userpwd);
	  $where["root"]=array("eq",0);
	  $where["state"]=array("eq",1);

	 //  $da["userpwd"]=md5("kaoti");
	 // $w["username"]="admin";
	// $user->where($w)->data($da)->save();
	  session("user",null);
	  if(!empty($username))
	  {
	  
		 
		  $one=$user->where($where)->find();
		  if(!empty($one))
		  {
			  session("user",$one);
			  echo "<script>window.location='".U("Index/index")."';</script>";
			  exit();
			 // $this->success('登录成功',U("Index/index"),0);exit;
		  }
		  else
		  {
			$this->error('登录失败',U('User/login'),3);exit;
		  }
	  }
	  $this->view("login");
}
   public function showmessage($str,$url="",$time=3){
     if($str!=""){
       $_SESSION["msg"]="<span>{$str}</span>";
	 }
     if($url!=""){
	   //echo "<script>alert('{$str}'); </script >";
	   echo "<script>window.location='$url';</script>";
	   exit();
	 }
	 
   }
}
?>