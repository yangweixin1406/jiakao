<?php
namespace Home\Controller;
use Think\Controller;
class CartController extends \Home\Controller\CommController{
    public $tablename="cart";
	public $tablename1="product";
    public function index(){
        $this->lists();
    }
    public  function add(){
	  $userone=session("userq");
      if($_POST){
	     $prodid=I("prodid");
		 $num=I("num");
		 if(!is_numeric($num)){
		    $num=1;
		 }
		 $userid=0;
		 if(is_array($userone)){
		   $userid=$userone["id"];
		 }
		 $mod=M($this->tablename);
		 $mod1=M($this->tablename1);
		 $wh["id"]=$prodid;
		 $wh["status"]=1;
		 ob_clean();
		 $one=$mod1->where($wh)->find();
		// echo $mod1->getLastsql();
		 if(is_array($one)){
		     $data["prodid"]=$prodid;
			 $data["title"]=$one["title"];
			 $data["price"]=$one["price"];
			 $data["photo"]=$one["photo"];
			 $data["num"]=$num;
			 $data["userid"]=$userid;
			 $data["dianjiaid"]=$one["dianjiaid"];
			 $data["userid"]=$userid;
			 $data["cookieid"]=cookie('cookieid');
			 
			 $where["userid"]=$userid;
			 $where["dianjiaid"]=$one["dianjiaid"];
			 $where["prodid"]=$prodid;
			 $info=$mod->where($where)->find();
			 if(is_array($info)){
				 $w1["id"]=$info["id"];
				 $data_1["num"]=$info["num"]+$num;
				 $data_1["price"]=$one["price"];
				 $rs=$mod->where($w1)->save($data_1);
			 }else{
			      $rs=$mod->data($data)->add();
			 }
			  exit("{\"status\":\"1\",\"info\":\"已加入购物车\"}"); 
		 }else{
		      exit("{\"status\":\"0\",\"info\":\"已下架\"}"); 
		 }
	  }
	}

	public function pdetail(){
	       $user=D("user");
		   $mod=M("product");
		   $userone=session("userq");
           $data=I("get.");
		   $info=M("product")->where(" id='".$data["id"]."'")->find();
	
		  if(!$info){
			  $url=U('home/index/index');
			  $this->error('已被删除',$url,3);exit;
		  }
		   $dianjia=M("user")->where(" id='".$info["dianjiaid"]."'")->find();
		    


//echo dirname(__APP__);
		   $dianjia['nullimg']=dirname(__APP__)."/public/images/null.gif"; 
		   $web["title"]=$info["title"];
		   $w2["lable"]="rec";
		   $protj=$mod->where($w2)->order('id desc')->limit("0,20")->select();
		   $this->assign('dianjia',$dianjia);
		   $this->assign('protj',$protj);
		   $this->assign('info',$info);
		   $this->assign('web',$web);
		   $this->display();
	}
}
?>

