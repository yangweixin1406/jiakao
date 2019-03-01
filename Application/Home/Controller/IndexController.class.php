<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends \Home\Controller\CommExamController{
    public $fatherno="00010004";
    public function index(){
		$this->assign("webtitle","考题网");
		$tpl="index";
		
	  $mod=M("setting");
	  $map["setting_key"]="kaoti";
	  $one=$mod->where($map)->find();
	  $kaoti_setting=unserialize(base64_decode($one['setting_value']));
	  if($kaoti_setting["biaomoshi"]==2){
	      $tpl="index1";
	  }
	     if(I("tpl")!=""){
	       $tpl=I("tpl");
	     }
		 $configex=M("configex")->where("1=1")->order("sort asc")->select();
		$this->assign("configex",$configex);
	
		$map1["fatherno"]=$this->fatherno;
		$class=M("class");
		$classlist=$class->where($map1)->select();
		$this->assign("classlist",$classlist);
       $this->display("$tpl"); 
    }
    public function contact (){
	 $mod=D("content");
	 $w["id"]=array("eq",1);
	 
	 $one=$mod->where($w)->find();
	 //var_dump($one);
	 echo json_encode($one);
	 exit();
  }
  public function check(){
        $user=M("user");
       $one =$user->where(array("UE_account"=>$_SESSION['uname']))->find();
	   if(is_array($one)){
				$tgbz= M('tgbz');
				$where=array();
				$where['user'] = $_SESSION['uname'];
				$where['zt'] =0;
				$where['qr_zt'] =0;
				$onearr=$tgbz->where($where)->find();
				if(!is_array($onearr))
				{
                     die("<script>alert('数据不存在');history.back(-1);</script>");
				}else{
				    
					 var_dump($onearr);
				     die("<script>alert('数据存在')</script>");
				}
	   }else{
	         echo "用户不存在";
	   }
  }
}

?>
