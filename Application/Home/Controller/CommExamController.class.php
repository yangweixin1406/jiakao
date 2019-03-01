<?php
namespace Home\Controller;
use Think\Controller;
class CommExamController extends Controller {
	public function islogin(){
	   $userone=session("userq");
      if(!$userone){
		 echo "<script>window.location='".__APP__."/".C('DEFAULT_MODULE')."/user/login';</script>";
		 exit();
	  }
	}
	public function _initialize(){
//   初始化的时候检查用户权限
//   echo session("user");
//   var_dump(session("user"));
//   
      $cururl='http://'.$_SERVER['SERVER_NAME'].''.($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"];
      $_SESSION["cururl"]=$cururl;
      $this->cururl=$cururl;
      $this->userinfo();
	  if(isset($_SERVER['HTTP_REFERER'])){
	     $_SESSION['backurl']="javascript:window.history.go(-1);";
	  }else{
	     $_SESSION['backurl']="javascript:window.location='".__APP__."/".C('DEFAULT_MODULE')."/index';";
	  }
      $userone=session("userq");
      if(!$userone){
		 echo "<script>window.location='".__APP__."/".C('DEFAULT_MODULE')."/user/login';</script>";
		 exit();
	  }
	  $this->usertitle="888888888";
	  $this->assign('backurl',$_SESSION['backurl']);
	  
//    var_dump(session("user"));
//	  exit();
    }
	public function userinfo(){

	$userone=session("userq");
      if($userone){
		$userid=trim($userone["id"]);
		$user=D("user");
		$usermap["id"]=array("eq",$userid);
		$user_row=$user->where($usermap)->find();
		if($user_row){
			$this->assign('userinfo',$user_row);
		}
	  }
	}
    public function test ()
    {
    	$user=D("User");
    	var_dump($user->select());
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

}
