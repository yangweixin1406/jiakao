<?php
namespace Home\Controller;
use Think\Controller;
class GoumaiexController extends \Home\Controller\CommExamController{
	public $tablename="goumaiex";
	public $fatherno="";
    public $fatherid="0";
	public $tablename1="class";
    public function index(){
		//http://document.thinkphp.cn/manual_3_2.html#where

//		$mod=D($this->tablename);
//		$class=M("class");
//		
//			  $w["objtable"]=I("table");
//			  $one_ex=M("configex")->where($w)->find();
//			  if($one_ex){
//				        $map_class["fatherno"]=$one_ex["classno"];
//						this->fatherno=$one_ex["fatherno"];
//						this->fatherid=$one_ex["fatherid"];
//				  		$classlist=$class->where($map_class)->select();
//	                 	$this->assign("classlist",$classlist);
//			  }else{
//					$this->error('考题表不存在',U('home/index/index'),3);exit;
//			  }
//			  
//
//		//echo C("exam_mode");
//		//exit();
//			  $w_["id"]=I("fatherid");
//			  $fatherclass=M("class")->where($w_)->find();
//			  if($fatherclass){
//				 $conf=json_decode(C("lang_".$fatherclass['lang']),true);
//
//				 $this->assign("modelist",$conf["items"]);
//			  }else{
//			      $this->error('Error:分类不存在',U('home/index/index'),3);exit;
//			  }
//		$webtitle=$mytitle=$conf["index_title"];
//		$this->assign("webtitle",$webtitle);
//		$this->assign("mytitle",$mytitle);
//		$this->assign("kemulist",$conf["kemu"]);
//		$this->assign("table",$this->tablename);
        
		
		
		
       $data=I("");
       $userq=session("userq");
        $w["id"]=$data["classid"];
        $info=M($this->tablename1)->where($w)->find();
		if(!$info){
		   $url=U('home/index/index');
		   if($_SESSION["class1_url"]!=""){
		     $url=$_SESSION["class1_url"];
		   }
		   $this->error('不存在或已下架',$url,3);exit;
		}

	   if($_POST){
			if($info["price"]==0){
			    $time=time();
				$mod=M($this->tablename);
	            $add_data["addtime"]=date("Y-m-d H:i:s",$time);
			    $add_data["classid"]=$data["classid"];
			    $add_data["total"]=$info["price"];
			    $add_data["classno"]=$info["classno"];
				$add_data["userid"]=$userq["id"];
				$add_data["title"]=$info["title"];
			    $add_data["time"]=$time;
			    $add_data["orderno"]="NO".date("YmdHis",$time).newrand(4);
				
				$rs=$mod->data($add_data)->add();
				
				
	            $data2["addtime"]=date("Y-m-d H:i:s",$time);
				if($userq["contact"]!=""){
			       $data2["contact"]=$userq["contact"];
				}
				if($userq["address"]!=""){
			       $data2["address"]=$userq["address"];
				}
			    $data2["total"]=$info["price"];
				$data2["price"]=$info["price"];
				$data2["userid"]=$userq["id"];
				$data2["username"]=$userq["username"];
				$data2["title"]=$info["title"];
				$data2["type"]="3";
				$data2["lable"]="1";
				$data2["status"]="1";
			    $data2["json"]="{\"classid\":\"".$data["classid"]."\",\"classno\":\"".$data["classno"]."\"}";
			    $data2["orderno"]=$add_data["orderno"];
				$rs=M("orders")->data($data2)->add();
				
	            $data1["addtime"]=date("Y-m-d H:i:s",$time);
			    $data1["classid"]=$data["classid"];
			    $data1["total"]=$info["price"];
			    $data1["classno"]=$info["classno"];
				$data1["userid"]=$userq["id"];
				$data1["title"]=$info["title"];
				$data1["type"]="goumaiex";
			    $data1["json"]="{\"classid\":\"".$data["classid"]."\",\"classno\":\"".$data["classno"]."\"}";
			    $data1["logno"]=$add_data["orderno"];
				$rs=M("paylog")->data($data1)->add();
		       
				   $this->success('购买成功',$_SESSION["tourl"],3);exit;
			}
	   }

		$web["title"]="在线购买";
		$this->assign("web",$web);
        $this->assign("info",$info);
		$this->assign("data",$data);
		$this->display(); 
    }
	public function lists(){
	
	$userq=session("userq");
	$mod=D($this->tablename);
	$where["id"]=array('gt',0);
	$name=I("name");
	$classno=I("classno");
	$state=I("state");
	$state=I("state");
	if($name!=""){
	  $where["name"]=array('like',"%".$name."%");
	}
	if($classno!=""){
	 $where["classno"]=array('like',"".$classno."%");
	}
	if($state!=""){
	  $where["state"]=array('eq',$state);
	}
	$where["userid"]=array('eq',$userq["id"]);
	//$class=M("class");
	//$wh['_string'] = " fatherno='".$this->fatherno."' ";
	//$classlist=$class->where($wh)->select();
	$count = $mod->where($where)->count();
	$item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $pagesize=10; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$row){
		 // if($list[$key]["classid"]!="0"){
			 // $w["id"]=$list[$key]["classid"];
			  //$class_one=M("class")->where($w)->find();
			 // $list[$key]["class_caption"]=$class_one["title"];
			 // $list[$key]["state_caption"]=$this->getcaption(C("state"),$list[$key]["state"]);
		  //}
	  }
	   $web["title"]="购买记录";
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
	  $web["title"]="购买明细";
	  $this->assign('web',$web);
	  $this->assign('info',$info);
	  $this->assign('show',$show);
	   $this->display("info");
	}
}

?>

