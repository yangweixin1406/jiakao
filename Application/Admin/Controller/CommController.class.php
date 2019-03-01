<?php
namespace Admin\Controller;
use Think\Controller;
class CommController extends Controller {
    public function islogin(){
       echo "login";
	   exit();
    }
	public function _initialize(){
//   初始化的时候检查用户权限
//   echo session("user");
//   var_dump(session("user"));
//   
      $userone=session("user");
      if(!$userone||$userone["root"]!=0){
		 echo "<script>if(window.top){window.top.location='".__APP__."/admin/user/login';}else{window.location='".__APP__."/admin/user/login';}</script>";
		 exit();
	  }
	if($_SERVER['HTTP_REFERER']==""){
	   $laiyuan=U("content/lists");
	}else{
	   $laiyuan="javascript:window.history.go(-1)";
	}
	  $configex=M("configex")->where("1=1")->order("sort asc")->select();
	  $this->assign("configex", $configex);
	  $this->assign("laiyuan", $laiyuan);
	  $mod=M("setting");
	  $map["setting_key"]="kaoti";
	  $one=$mod->where($map)->find();
	  $kaoti_setting=unserialize(base64_decode($one['setting_value']));
	  $this->assign("kaoti_setting", $kaoti_setting);
//    var_dump(session("user"));
//	  exit();
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