<?php
namespace Admin;
use Think\Controller;
class CommController extends Controller {
    public function _initialize(){
      $userone=session("user");
      if(!$userone||$userone["root"]!=0){
		 echo "<script>window.location='".__APP__."/admin/user/login';</script>";
		 exit();
	  }
    }
    public function test ()
    {
    	$user=D("User");
    	var_dump($user->select());
    }
	

}
