<?php
namespace Qiyue\Controller;
use Think\Controller;
class CommExamController extends Controller {
    public function islogin(){
       echo "login";
	   exit();
    }
	public function _initialize(){
//   初始化的时候检查用户权限
//   echo session("user");
//   var_dump(session("user"));
//   
//      $this->userinfo();
//      $userone=session("userq");
//      if(!$userone){
//		 echo "<script>window.location='".__APP__."/home/user/login';</script'>";
//		 exit();
//	  }
//	  $this->usertitle="888888888";
	  //$this->assign('siteurl',"http://112.74.73.74/kaoti/");
	  
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
