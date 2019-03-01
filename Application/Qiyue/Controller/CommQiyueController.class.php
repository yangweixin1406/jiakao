<?php
namespace Qiyue\Controller;
use Think\Controller;
class CommQiyueController extends Controller {

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
     $banner1=M("link")->where(" classid=1 ")->select();
	 $navs=M("link")->where(" classid=2 ")->order("sort asc ")->select();

     $web=M("config")->find();
	 $web["logo"]=str_replace("/s50/","/s100/",$web["logo"]);
	 $web["copyright"]=htmlspecialchars_decode($web["copyright"]);
	  $this->assign('banner1',$banner1);
      $this->assign('web',$web);
	  $this->assign('navs',$navs);
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
     public function getnav($classno){
       	  $one=M("class")->where(" classno='".$classno."' ")->find();
		   header("Content-type: text/html; charset=utf-8");   
		 while(($one)){
		     
			if(strlen($one["fatherno"])==4){
			 $one=0;
			}else{
		 	$info[]=$one;
			 $one=M("class")->where(" classno='{$one['fatherno']}'")->find();
			}
			 //echo $one["name"].strlen($one["fatherno"]);

		  }
         sort($info);
			  //for($i=(count($info)-1);$i>-1;$i--){
//				$val=$info[$i];
//				 $str.="<a href='".U("news/lists",array("id"=>$val["id"]))."'>{$val[name]}</a><span>&gt;</span>";
//			  }
		  //exit();
		  return $info;
		
  }

}
?>
