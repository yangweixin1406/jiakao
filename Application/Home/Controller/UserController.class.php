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
				 //$this->success('success',U('/Home/index'),3);exit;
				 echo "<script>window.location='".U('/Home/index')."';</script>";exit;
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
      $mod=M("setting");
     $user=M("user");
	$map["setting_key"]="reg";
	$reg_one=$mod->where($map)->find();
	$reg_setting=unserialize(base64_decode($reg_one['setting_value']));

     if($_POST){
	             if($reg_setting["status"]==0){
				    exit("{\"status\":\"error\",\"msg\":\"已关闭注册\"}"); 
				 }
				 $data=I("post.");
				 
				
				 $codetype=$reg_setting["codetype"];
				 
				  if(trim($data["phone"])!=""){
				    $map["phone"]=$data["phone"];
				    $one=M("user")->where($map)->find();
					if(is_array($one)){
					   exit("{\"status\":\"error\",\"msg\":\"手机号已被注册\"}");  
					}
				 }
				 
				if(trim($data["email"])!=""){
				    $map["email"]=$data["email"];
				    $one=M("user")->where($map)->find();
					if(is_array($one)){
					   exit("{\"status\":\"error\",\"msg\":\"邮箱已被注册\"}");  
					}
				 }
				 if($codetype=="smscode"&&$data["phone"]."|".$data["code"]!=session("smscode")){
					   exit("{\"status\":\"error\",\"msg\":\"短信验证码错误\"}"); 
				 }
				 if($codetype=="emailcode"&&$data["email"]."|".$data["code"]!=session("emailcode")){
					   exit("{\"status\":\"error\",\"msg\":\"邮箱验证码错误\"}"); 
				 }
				 if($codetype=="code"&&$data["code"]!=session("code")){
				       $verify = new \Think\Verify();
					  if(!$verify->check($data["code"])){
						 exit("{\"status\":\"error\",\"msg\":\"验证码错误\"}"); 
					  }
				 }
				 if($data["phone"]==""){
				 $data["phone"]=$data["username"];
				 }
				 if($data["username"]==""){
				  exit("{\"status\":\"error\",\"msg\":\"用户名不能为空\"}"); 
				 }
				 $w["username"]=$data["username"];
				 $one=$user->where($w)->find();
				 if(is_array($one)){
					 exit("{\"status\":\"error\",\"msg\":\"已被注册\"}"); 
				 }

				 $data["addtime"]=date("Y-m-d H:i:s");
				 $data["youxiaoqi"]=date('Y-m-d H:i:s',strtotime($data["addtime"] . '+'.$reg_setting["day"].' day'));
				 $data["userpwd"]=md5($data["userpwd"]);
				 $data["quanxian"]=6;
				 $data["state"]=$reg_setting["state"];
				 $data["nicheng"]=$data["username"];
				 $user_row=$user->add($data);
				 if($user_row){
				    $one=$user->where($w)->find();
				    session("userq",$one);
				    exit("{\"status\":\"success\",\"msg\":\"注册成功\"}"); 
				 }else{
				    exit("{\"status\":\"error\",\"msg\":\"注册失功\"}"); 
				 }
		
     }
      $web["title"]="会员注册";
	  $this->assign('reg_setting',$reg_setting);
       $this->assign('web',$web);
       $this->display("reg");
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
	public function zhaohuimima(){

           if($_POST){
		             $mod=M("setting");
				    $data=I("post.");
					if($data["type"]=="sms"){
						  $map["setting_key"]="sms";
						  $sms_one=$mod->where($map)->find();
						  $sms_setting=unserialize(base64_decode($sms_one['setting_value']));
						  if($sms_setting["status"]=="0"){
							  exit("{\"status\":\"error\",\"msg\":\"短信找回密码已关闭\"}"); 
						  }
					  	$userpwd=newrand(6);
						$type=strtolower($sms_setting["type"]);
						$url=$sms_setting["url"];
						$urlcs=$sms_setting["urlcs"];
						$charset=$sms_setting["charset"];
						$content=$sms_setting["content1"];
						$content=str_ireplace("{pwd}",$userpwd,$content);
						
						$post_data['id'] = $sms_account;//配置短信接口帐号
						$post_data['pwd'] = $sms_pswd;//短信接口帐号密码
						$post_data['to'] =$phone;
						$charset=strtolower($charset);
						if($charset=="gb2312"){
						     $content=iconv("UTF-8","GB2312",$content);
							 $urlcs=str_ireplace("{content}",$content,$urlcs);
						}else{
						     $urlcs=str_ireplace("{content}",$content,$urlcs);
						}
						
						//$url='http://service.winic.org:8009/sys_port/gateway/index.asp'; 
						if($type=="get"){
						    $url=$url.$urlcs;
						    $result=httprequest($url,$post_data);
						}else{
						    $result=httprequest($url,$urlcs);
						}
						
						$co=substr($result,15,1);
						$arr=explode("/",$result);
						if($arr[0] == '000'){
						   //echo "0";
						}else{
						   ///echo $result;
						}
						
					   exit("{\"status\":\"success\",\"msg\":\"短信已发送\",\"code\":\"".$result."\"}"); 
                       //sms    
					}else{
						  $map["setting_key"]="email";
						  $email_one=$mod->where($map)->find();
						  $email_setting=unserialize(base64_decode($email_one['setting_value']));
						  if($email_setting["status"]=="0"){
							  exit("{\"status\":\"error\",\"msg\":\"邮箱找回密码已关闭\"}"); 
						  }
					   //email
					    $title="找回会员密码";
						$userpwd=newrand(6);
						$content=$email_setting["content1"];
						$content=str_ireplace("{pwd}",$userpwd,$content);

					    $data["to"]=$data["email"];
						$data["smtpserver"]=$email_setting["smtpserver"];
						$data["smtpserverport"]=$email_setting["smtpserverport"];
					    $data["smtpuser"]=$email_setting["smtpuser"];
	
						$where["email"]=$data["email"];
						$u_data["userpwd"]=md5($userpwd);
						session("emailjhpwd",$userpwd);
						$cururl=$_SESSION["cururl"];
						$arr=explode("index.php",$cururl);
						$site=$arr[0];
						$url=$site."index.php/".C('DEFAULT_MODULE')."/user/emailjhpwd/email/".$data["email"]."/userpwd/".md5($userpwd);
						//$rs=M("user")->where($where)->save($u_data);
						$data["smtppass"]=$email_setting["smtppass"];
					    $data["title"]=$title;
					    $data["smtpsecure"]=$email_setting["smtpsecure"];
						$data["content"]=$content."<br/><a href='{$url}' target='_blank'>点击生效重置新密码</a>";
					    sendemail_a($data);
					    exit("{\"status\":\"success\",\"msg\":\"邮箱已发送\"}"); 
					}
	       }
		   $web["title"]="找回密码";
		   $this->assign('web',$web);
		   if(I("get.type")=="email"){
		      $this->display("zhaohuimima_email");
		   }else{
	          $this->display("zhaohuimima");
		   }
	}
	public function emailjhpwd(){
	       $user=D("user");
		   $emailjhpwd=trim(session("emailjhpwd"));
		   header("Content-type: text/html; charset=utf-8");
           if($_GET&&$emailjhpwd!=""){
				    $data=I("get.");
					$email=$data["email"];
					$userpwd=$data["userpwd"];
					 if($email==""){
					    echo "没有填写邮箱";
					 }
					 if($userpwd==""){
					    echo "没有填写新密码";
					 }
					 $data1["userpwd"]=$userpwd;
					 $where1["email"]=$email;
					 $rs=$user->where($where1)->data($data1)->save();

					session("emailjhpwd","");
					echo "<script>alert('新密码重置成功');window.location='".__APP__."/".C('DEFAULT_MODULE')."/user/login';</script'>";
					exit();
					
	       }else{
		            echo "邮箱密码重置已过期";
		   }

	}
	public function pwd(){
	       $user=D("user");
		  $userone=session("userq");

           if($_POST){
				    $data=I("post.");
					 if(!$userone){
					  exit("{\"status\":\"error\",\"msg\":\"请先登录\"}"); 
					 }
					if(md5($data["userpwdold"])!=$userone["userpwd"]){
					   exit("{\"status\":\"error\",\"msg\":\"旧密码错误\"}");   
					}
					if($data["userpwd"]!=$data["userpwd1"]){
					   exit("{\"status\":\"error\",\"msg\":\"两次密码不一致\"}");  
					}
					 $data1["userpwd"]=md5($data["userpwd"]);
					 $where1["id"]=$userone["id"];
					 $userone=$user->where(" id=".$userone["id"])->find();
					  session("userq",$userone);
					 $user->where($where1)->data($data1)->save();
					 exit("{\"status\":\"success\",\"msg\":\"新密码修改成功\"}"); 
	       }
		  if(!$userone){
			  echo "<script>window.location='".__APP__."/".C('DEFAULT_MODULE')."/user/login';</script>";
			  exit();
		  }
		   $web["title"]="修改密码";
		   $web["title1"]="重置密码";
		   $this->assign('web',$web);
		   $this->display();
	}
	public function my(){
	       $user=D("user");
		   $userone=session("userq");
           if($_POST){
				    $data=I("post.");
					 if(!$userone){
					  exit("{\"status\":\"error\",\"msg\":\"请先登录\"}"); 
					 }
					 $data1=$data;
					 unset($data1["userpwd"]);
					 unset($data1["quanxian"]);
					 $where1["id"]=$userone["id"];
					 $userone=$user->where(" id='".$userone["id"]."'")->find();
					 session("userq",$userone);
					 $r=$user->where($where1)->save($data1);
					 exit("{\"status\":\"success\",\"msg\":\"资料修改成功\"}"); 
	       }
		  if(!$userone){
			  echo "<script>window.location='".__APP__."/".C('DEFAULT_MODULE')."/user/login';</script>";
			  exit();
		  }
		   $web["title"]="我的资料";
		   $web["title1"]="修改资料";
		   $this->assign('info',$userone);
		   $this->assign('web',$web);
		   $this->display();
	}
	public function close(){
		   session("userq",null);
           $this->display("login");
	}
}
?>

