<?php
namespace Home\Controller;
use Think\Controller;
class ExamController extends \Home\Controller\CommExamController {
	public $tablename="exam";
	public $fatherno="00010004";
	public $lang="汉语";
    public function index(){
		$mod=D($this->tablename);
		$class=M("class");
		
			  $w["id"]=I("fatherid");
			  $class_one=M("class")->where($w)->find(); //select * from tb_class where id = farherid;
			  if($class_one){
				        $map_class["fatherno"]=$class_one["classno"];
				  		$classlist=$class->where($map_class)->select();  //select * from tb_class where classno = 00010004;
	                 	$this->assign("classlist",$classlist);
			  }
			  

		//echo C("exam_mode");
		//exit();
			  $w_["id"]=I("fatherid");
			  $fatherclass=M("class")->where($w_)->find(); //find from tb_class where id = fatherid;
			  if($fatherclass){
				 $conf=json_decode(C("lang_".$fatherclass['lang']),true);

				 $this->assign("modelist",$conf["items"]);
			  }else{
			      $this->error('Error:分类不存在',U('home/index/index'),3);exit;
			  }


		$webtitle=$mytitle=$conf["index_title"];
		$this->assign("webtitle",$webtitle);
		$this->assign("mytitle",$mytitle);
		$this->assign("classlist",$classlist);
		$this->assign("kemulist",$conf["kemu"]);
		$this->assign("table",$this->tablename);
		$this->assign("data",$data);
		$this->display(); 
    }
    public function lists(){
			  $w_["id"]=I("classid");
			  $class_one=M("class")->where($w_)->find();  //find * from tb_class where id = classid;
			  if($class_one){
				        $map_class["classno"]=$class_one["fatherno"];
				  		$fatherclass=M("class")->where($map_class)->find();
	                     if($fatherclass){
						                $conf_l=C("lang_".$fatherclass['lang']);
						                $conf_lang=json_decode($conf_l,true);
						 }else{
						    $this->error('Error:分类不存在',U('home/index/index'),3);exit;
						 }
			  }else{
			             $this->error('Error:分类不存在',U('home/index/index'),3);exit;
			  }
		
	   header("Content-Type: text/html; charset=UTF-8");

	   $modelist=$conf_lang["items"];
	   $mod=M($this->tablename);
	   $data=I("");
	   $act=$data["act"];
	   $classid=$data["classid"];
	   
	   foreach($modelist as $row){

		   if($act==$row["value"]){
			   $mytitle=$row["name"];
		   }
	   }
	  
	   $w["classid"]=$classid;
	   $w["kemu"]=$data["kemu"];
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
	    if($list){
		      foreach($list as $key=>$row){
				  $list[$key]["photo_big"]=str_replace("/s50/","/s100/",$row["photo"]);
				  $list[$key]["items"]=json_decode($list[$key]["items"],true);
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
	   $this->assign("caption",$conf["caption"]);
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
			       $this->success('已累加答对计数',U('home/index/index'),3);
			       exit;
			   }

		}
    }
}

?>

