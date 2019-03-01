<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	
    public function index(){
        $this->display();
    }
	public function login(){
	  $this->userinfo();
	  $data=I('post.');
	  $user=D("User");
	  $webtitle=$mytitle="Login";
	  $this->assign("webtitle",$webtitle);
	  $this->assign("mytitle",$mytitle);
	  $username=strtolower($data["username"]);
	  $userpwd=md5($data["userpwd"]);
	  $where["username"]=array("eq",$username);
	  $where["userpwd"]=array("eq",$userpwd);
	  //$where["root"]=array("eq",0);
	  
	  session("userq",null);
	  //$da["userpwd"]=md5("!@_cxc_kaoti");
	 // $w["username"]="admin";
	 //$user->where($w)->data($da)->save();
	  if(!empty($username))
	  {
		  $one=$user->where($where)->find();
		 // echo $user->getLastSql();
		  //exit();
		  if(!empty($one))
		  {
			  $timer_new=strtotime(date("Y-m-d H:i:s"));
			  
			  if(trim($one["youxiaoqi"])==""){
				  $usergroup_where["id"]=$one["usergroupid"];
		          $usergroup_one1=M("user_group")->where($usergroup_where)->find();
		         if(!empty($usergroup_one1)){
				     $one["youxiaoqi"]=date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s") . '+'.$usergroup_one1["day"].' day'));
					 $user_da["youxiaoqi"]= $one["youxiaoqi"];
					 $user_where["id"]=$one["id"];
					 $user_da["state"]=1;
					 $user_da["logintime"]=date('Y-m-d H:i:s');
					 $user->where($user_where)->data($user_da)->save();
			      }
		    }
			$timer_old=strtotime($one["youxiaoqi"]);
			if($one["root"]=="0"){
				 session("userq",$one);
				 $this->success('success',U('/Home/index'),3);exit;
			}else{
				  if($timer_old<$timer_new){
							 $this->error('你的帐号已过期',U('User/login'),3);exit;
				  }else{
						 if($one["youxiaocishu"]<=0){
							  $this->error('累计登录次数已用完',U('User/login'),3);exit;
						 }else{
							   session("userq",$one);
							   $data1["youxiaocishu"]=($one["youxiaocishu"]-1);
							   $data1["logintime"]=date('Y-m-d H:i:s');
							   $where1["id"]=array("eq",$one["id"]);
							   $user->where($where1)->data($data1)->save();
							   //$this->success('success',U('/Home/index'),1);exit;
							   echo "<script>window.location='".__APP__."/home/index';</script>";
							   exit;
						 }
				  }
			}
			  

		  }
		  else
		  {
			$this->error('failure',U('User/login'),3);exit;
		  }
	  }
	  $this->display("login");
    }
	
	public function reg(){
//		$this->userinfo();
//		$act=I("act");
//		$username=I("username");//会员名
//		$userpwd=I("userpwd");//密码
//		$quanxian=0;//权限
//		if($act==""){//显示网页出来
//          $this->display();
//		}
//		if($act!=""){
//			$user=D('user');
//			$map["username"]=$username;
//			$map["userpwd"]=md5($userpwd);
//			$map["quanxian"]=$quanxian;
//			$user_row=$user->add($map);
//			if($user_row){
//				 $usermap["username"]=array("eq",$username);
//		         $user_row=$user->where($usermap)->find();
//				 $_SESSION["userid"]=$user_row["id"];
//				 $this->success('注册成功',U('/Home/Product/'),3);//跳转提示的模板是 ThinkPHP\Top\dispatch_jump.tpl
//			}else{
//				$this->success('注册失功',U('/Home/User/reg'),3);//跳转提示的模板是 ThinkPHP\Top\dispatch_jump.tpl
//			}
//		}
    }
	public function userinfo(){
	$userone=session("userq");
      if(!$userone||$userone["root"]!=0){
		$userid=trim($userone["id"]);
		$user=D("user");
		$usermap["id"]=array("eq",$userid);
		$user_row=$user->where($usermap)->find();
		if($user_row){
			$this->assign('userinfo',$userone);
		}
	  }
	}
	public function close(){
		 session("userq",null);
         $this->display("login");
	}
}


