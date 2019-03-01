<?php
namespace Home\Controller;
use Think\Controller;
class OrdersController extends \Home\Controller\CommExamController{
    public $tablename="orders";
	public $tablename1="orders_detail";
    public function index(){
		//相关D,I,M 教程:http://www.thinkphp.cn/document/309.html
		//ThinkPHP3.2完全开发手册:http://document.thinkphp.cn/manual_3_2.html#upgrade_guide
        $this->userinfo();
		$orders=D($this->tablename);
		$ordersdetail=D($this->tablename1);
		$where["userid"]=array("eq",$userid);  //GT这个是大于 表达式查询:http://document.thinkphp.cn/manual_3_2.html#express_query
		
		
		$count = $orders->where($where)->count();
		//import('ORG.Util.Page');
		$pagesize=4; //分页分几条
		$page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
		$show = $page->show();
		$list = $orders->where($where)->order('addtime desc')->limit($page->firstRow.",".$page->listRows)->select();
		
		foreach($list as $key=>$val){
			$detail_map=array();
			$detail_map["ordersno"]=array("eq",$val["ordersno"]); 
			
			$detail=$ordersdetail->where($detail_map)->select();
			//$user->getLastSql();
			$list[$key]['detail']=$detail;
		}
		$this->assign('list',$list);
		$this->assign('show',$show);
		$this->display(); 
    }


	public function del(){
		$userq=session("userq");
		//echo $userid;
		//exit();
		$id=I("id");
		$orders=D($this->tablename);
		$ordersdetail=D($this->tablename1);
		$map["id"]=array("eq",$id);
		$map["userid"]=array("eq",$userq["id"]);
		$row=$orders->where($map)->find();
		if($row){
			$orders->where($map)->delete();
			$map1["orderno"]=array("eq",$row["orderno"]);
			$ordersdetail->where($map1)->delete();
			echo "{\"status\":\"success\",\"msg\":\"已删除订单\"}";
		}
		//echo $user->getLastSql();
	}
	public function lists(){
	
	$userq=session("userq");
	$mod=D($this->tablename);
	$where["id"]=array('gt',0);
	$name=I("name");
	$orderno=I("orderno");
	$state=I("state");
	$state=I("state");
	if($orderno!=""){
	  $where["orderno"]=array('like',"%".$orderno."%");
	}
	if($status!=""){
	  $where["status"]=array('eq',$status);
	}
	$where["userid"]=array('eq',$userq["id"]);
	//$class=M("class");
	//$wh['_string'] = " fatherno='".$this->fatherno."' ";
	//$classlist=$class->where($wh)->select();
	  $orders_lable=json_decode(C("orders_lable"),true);
	  foreach($orders_lable as $k=>$v){
			     $lables[$v["value"]]=$v["title"];
	  }
	$count = $mod->where($where)->count();
	$item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $pagesize=10; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$row){
	        $w["id"]=$row["userid"];
	        $userone=M("user")->where($w)->find();
			if($userone){
			   $list[$key]["logo"]=$userone["photo"];
			}
			$list[$key]["lablecaption"]=$lables[$row["lable"]];
		 // if($list[$key]["classid"]!="0"){
			 // $w["id"]=$list[$key]["classid"];
			  //$class_one=M("class")->where($w)->find();
			 // $list[$key]["class_caption"]=$class_one["title"];
			 // $list[$key]["state_caption"]=$this->getcaption(C("state"),$list[$key]["state"]);
		  //}
	  }
	   $web["title"]="订单记录";
	   $web["num"]=count($list);
	   $this->assign('web',$web);
	   $this->assign('list',$list);
	   $this->assign('show',$show);
	   $this->display("lists");
	}
	public function info(){
			 $userq=session("userq");
			 $data=I("");
			 $mod=D($this->tablename);
			 $w["userid"]=array('eq',$userq["id"]);
			 $w["id"]=array('eq',$data["id"]);
			 $info=$mod->where($w)->find();
			 if(!$info){
				   $url=U('home/index/index');
				   $this->error('已被删除',$url,3);exit;
			  }
			 
			  
			$w["id"]=$info["userid"];
			$userone=M("user")->where($w)->find();
			if($userone){
			  $info["logo"]=$userone["photo"];
			}
			$orders_lable=json_decode(C("orders_lable"),true);
			foreach($orders_lable as $k=>$v){
			  $lables[$v["value"]]=$v["title"];
			}
			$info["lablecaption"]=$lables[$info["lable"]];
			if($info["dianjiaid"]!=0){
			   $info["shopurl"]=U("shop/index",array("id"=>$info["dianjiaid"]));
			}else{
			   $info["myurl"]=U("user/my",array("id"=>$info["userid"]));
			}
			$w2["orderno"]=$info["orderno"];
			$list=M($this->tablename1)->where($w2)->select();
			$numz=0;
			foreach($list as $key=>$row){
			   $numz+=$row["num"];
			}
			$this->assign('list',$list);
			$web["numz"]=$numz;
			$web["root"]=(__ROOT__);
			$web["title"]="订单明细";	

			$this->assign('user',$userone);
			$this->assign('web',$web);
			$this->assign('info',$info);
			$this->assign('show',$show);
			$this->display("info");
	}
	public function detail(){
			 $userq=session("userq");
			 $data=I("");
			 $mod=D($this->tablename);
			 $w["userid"]=array('eq',$userq["id"]);
			 $w["id"]=array('eq',$data["id"]);
			 $info=$mod->where($w)->find();
			 if(!$info){
				   $url=U('home/index/index');
				   $this->error('已被删除',$url,3);exit;
			  }
			 
			  
			$w["id"]=$info["userid"];
			$userone=M("user")->where($w)->find();
			if($userone){
			  $info["logo"]=$userone["photo"];
			}
			$orders_lable=json_decode(C("orders_lable"),true);
			foreach($orders_lable as $k=>$v){
			  $lables[$v["value"]]=$v["title"];
			}
			$info["lablecaption"]=$lables[$info["lable"]];
			if($info["dianjiaid"]!=0){
			   $info["shopurl"]=U("shop/index",array("id"=>$info["dianjiaid"]));
			}else{
			   $info["myurl"]=U("user/my",array("id"=>$info["userid"]));
			}
			$w2["orderno"]=$info["orderno"];
			$list=M($this->tablename1)->where($w2)->select();
			$numz=0;
			foreach($list as $key=>$row){
			   $numz+=$row["num"];
			}
			$this->assign('list',$list);

			$web["numz"]=$numz;
			$web["root"]=(__ROOT__);
			$web["title"]="商品明细";	
			$this->assign('user',$userone);
			$this->assign('web',$web);
			$this->assign('info',$info);
			$this->assign('show',$show);
			$this->display();
	}
}


