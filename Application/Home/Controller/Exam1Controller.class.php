<?php
namespace Home\Controller;
use Think\Controller;
class Exam1Controller extends \Home\Controller\CommExamController {
	public $tablename="exam";
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
//		$this->assign("data",$data);
//		$this->display(); 
    }
	public function get_url($opt=""){
	  if($opt==""||$opt=="home"||$opt.lable=="home"){
	       return U('home/index/index');
	  }
	}
	
    public function lists(){
	
	 header("Content-Type: text/html; charset=UTF-8");
	    $homeurl=$this->get_url("home");
        $data=I("");
   
		$this->is_goumaiex($data["fatherid"]);
	    if($data["table"]!=""){
	      $this->tablename=$data["table"];
	    }else{
		  $this->error('请选择语言',$homeurl,3);exit;
		}
		  $w_["id"]=I("classid");
		  
		  $class_one=M("class")->where($w_)->find();
		  if($class_one){
					$map_class["classno"]=$class_one["fatherno"];
					$fatherclass=M("class")->where($map_class)->find();
					 if($fatherclass){
									$conf_l=C("lang_".$fatherclass['lang']);
									$conf_lang=json_decode($conf_l,true);
					 }else{
						$this->error('Error:分类不存在',$homeurl,3);exit;
					 }
		  }else{
					 $this->error('Error:分类不存在',$homeurl,3);exit;
		  }
		


	   $modelist=$conf_lang["items"];
	   $mod=D($this->tablename);
	  
	   $act=$data["act"];
	   $classid=$data["classid"];


	   foreach($modelist as $row){

		   if($act==$row["value"]){
			   $mytitle=$row["name"];
		   }
	   }
	   
		 if($classid!=""&&is_numeric($classid)){
			  $w["classid"]=$classid;
		 }
	  
	   if($data["kemu"]!=""){
	     $w["kemu"]=$data["kemu"];
	   }
	   

	  // $w["type"]=1;
	  
	  if($act=="suiji"){
		  $list=$mod->where($w)->limit('0,100')->order("RAND()")->select();
		
		  foreach($list as $key=>$row){
		    $list[$key] =$row;
		  }
	  }
	 	

	  if($act=="shunxi"){
		   $count = $mod->where($w)->count();

			//import('ORG.Util.Page');
			 if(!isset($_GET["p"])){
				$_GET["p"]=$data["p"];
			 }
			$pagesize=100; //分页分几条
			$page = new \Think\Page($count,$pagesize);//thinkphp 3.2 //这个分页只能get??
			$show = $page->show();
			$list = $mod->where($w)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
			//echo $mod->getLastSql();
		    //$examstr=$mod->where($w)->limit('0,100')->order("id desc")->select();
		  foreach($list as $key=>$row){
		    $list[$key] =$row;
		  }
	  }

	  if($act=="moni"){
		  $w1=$w;
		  $w1["type"]=0;
		  $rs1=$mod->where($w1)->limit('0,40')->order("RAND()")->field("*")->select();
		  $list=$rs1;
		  $w2=$w;
		  $w2["type"]=1;
		  $rs2=$mod->where($w2)->limit('0,40')->order("RAND()")->field("*")->select();
		  foreach($rs2 as $row){
		  $list[] =$row;
		  }
		  $w3=$w;
		  $w3["type"]=2;
		  $rs3=$mod->where($w3)->limit('0,20')->order("RAND()")->field("*")->select();
		  foreach($rs3 as $row){
		  $list[] =$row;
		  }
	  }

		//	exit(); 
		$numz=0;
	    if($list){
		      foreach($list as $key=>$row){
				  $list[$key]["photo_big"]=str_replace("/s50/","/s100/",$row["photo"]);
				  $list[$key]["items"]=json_decode($list[$key]["items"],true);
				  $numz++;
			  }
			 $examstr=trim(json_encode($list));
			 $examstr=str_replace("\"[","[",$examstr);
			 $examstr=str_replace("]\"","]",$examstr);
			 $examstr=str_replace("\\\"","\"",$examstr);
		}
		if(trim($data["ajax"])=="1"){
			ob_clean();
			$examstr=str_replace('\"',"\"",$list);
			echo $examstr;
			exit();
		}

	   $webtitle=$conf_lang["caption"]."-".$mytitle;

	   $this->assign("examstr",$examstr);
	   $this->assign("act",$act);
	   $this->assign("lang",$conf_lang["lang"]);
	   $this->assign("conf_lang",$conf_lang);
	   $this->assign("webtitle",$webtitle);
	   $this->assign("mytitle",$mytitle);
	   $this->assign("caption",$numz);
	   $this->assign("modelist",$modelist);
	   $this->assign("data",$data);
	   $this->assign("list",$list);
	   $this->assign("table",$this->tablename);
	   if($_GET["tpl"]!=""){
	     $this->display($_GET["tpl"]);
	   }else{
	     $this->display("lists");
	   }

	   
    }
    public function update_success_count(){
		//http://document.thinkphp.cn/manual_3_2.html#where
		$homeurl=$this->get_url("home");
        $userq=session("userq");
		if($_POST&&$userq){
			  ob_clean();
			  $map["id"]=$userq["id"];
			  $userinfo=D("user")->where($map)->find();
			  if(is_array($userinfo)){
				   $where["id"]=$userq["id"];
				   $update_data["exam_success_count"]=$userinfo["exam_success_count"]+1;
				   $update_data["jifen"]=$userinfo["jifen"]+1;
				   $rs=D("user")->where(" id=".$userq["id"])->save($update_data);
			       $this->success('已累加答对计数',$homeurl,3);
			       exit;
			   }

		}
    }
    public function class1(){
		//http://document.thinkphp.cn/manual_3_2.html#where
		      $homeurl=$this->get_url("home");
			  $w["objtable"]=I("table");
			  $this->tablename=I("table");
			   $data=I("");
			    $w["status"]=1;
			  $one_ex=M("configex")->where($w)->find();
			  if($one_ex){
			            $_SESSION["class1_url"]=$this->cururl;
						$this->fatherno=$one_ex["fatherno"];
						$this->fatherid=$one_ex["fatherid"];
						$map_class["fatherno"]=$one_ex["fatherno"];
				  		$classlist=M($this->tablename1)->where($map_class)->select();
	                 	$this->assign("classlist",$classlist);
						$webtitle=$mytitle=$one_ex["title"];
						$this->assign("webtitle",$webtitle);
						$this->assign("mytitle",$mytitle);
						$this->assign("table",$this->tablename);
						$this->assign("data",$data);
						$this->display("class1"); 
			  }else{
					$this->error('考题不存在',$this->get_url("home"),3);exit;
			  }
    }
    public function class2(){
		//http://document.thinkphp.cn/manual_3_2.html#where

		$userq=session("userq");
			  $w["objtable"]=I("table");
			  $this->tablename=I("table");
			  $data=I("");
			  $homeurl=$this->get_url("home");
			  $one_ex=M("configex")->where($w)->find();
			  if($one_ex){
						$this->fatherno=$one_ex["fatherno"];
						$this->fatherid=$one_ex["fatherid"];
						
						if(is_numeric($data["fatherid"])){
						     $one=M($this->tablename1)->where(array("id"=>$data["fatherid"]))->find();
							if($one){
							    $this->is_goumaiex($data["fatherid"]);
							    $map_class["fatherno"]=$one["classno"];
								$classlist=M($this->tablename1)->where($map_class)->select();
								
								 foreach($classlist as $key=>$row){
								   $map_class1["fatherno"]=$row["classno"];
								   $classlist[$key]["class1"]= M($this->tablename1)->where($map_class1)->select();
								 }
								$conf=htmlspecialchars_decode($one_ex["conf"]);
								if(is_array($conf)){
		                          $conf1=json_decode($conf,true);
								}else{
								  $conf1=json_decode(C("conf"),true);
								}
								$webtitle=$mytitle=$one_ex["title"];
								$this->assign("classlist",$classlist);
								$this->assign("webtitle",$webtitle);
								$this->assign("mytitle",$mytitle);
								$this->assign("conf1",$conf1);
								$this->assign("table",$this->tablename);
								$this->assign("data",$data);
								$this->display("class2"); 
							}else{
							   $this->error('',$homeurl,0);exit;
							}
						}else{
						  $this->error('',$homeurl,0);exit;
						}
			  }else{
					$this->error('考题不存在',$homeurl,3);exit;
			  }
    }
	function is_goumaiex($classid){
			$userq=session("userq");
			$data=I("");
			$goumaiex=M("goumaiex")->where(array("classid"=>$classid,"userid"=>$userq["id"]))->find();
			if(!is_array($goumaiex)){
			   $tourl='http://'.$_SERVER['SERVER_NAME'].''.($_SERVER["SERVER_PORT"]!=80?":".$_SERVER["SERVER_PORT"]:"").$_SERVER["REQUEST_URI"];
			   $_SESSION["tourl"]=$tourl;
			   $this->error('请先购买',U('home/goumaiex/index',array("classid"=>$data["fatherid"])));exit;
			}
	}
}

?>

