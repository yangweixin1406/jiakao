<?php
namespace Home\Controller;
use Think\Controller;
class ExamtuerqiController extends \Home\Controller\CommExamController {
	public $tablename="examtuerqi";
	public $fatherno="00010006";
	public $lang="土耳其";
    public function index(){
		//http://document.thinkphp.cn/manual_3_2.html#where
		$conf=json_decode(C($this->tablename),true);
		$webtitle=$mytitle=$conf["caption"]." 测试中心";
		$this->assign("webtitle",$webtitle);
		$this->assign("mytitle",$mytitle);
		$mod=D($this->tablename);
		$class=M("class");
		$map_class["fatherno"]=$this->fatherno;
		$classlist=$class->where($map_class)->select();
		$this->assign("classlist",$classlist);
		//echo C("exam_mode");
		//exit();
		$this->assign("modelist",json_decode(C("exam_mode"),true));
		$this->assign("kemulist",json_decode(C("exam_kemu"),true));
		$this->assign("data",$data);
        $this->display(); 
    }
    public function lists(){
		 $conf=json_decode(C($this->tablename),true);
	   header("Content-Type: text/html; charset=UTF-8");
	   $modelist=json_decode(C($this->tablename."_mode"),true);
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
		  $examstr=$mod->where($w)->limit('0,100')->order("RAND()")->select();
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
			$examstr = $mod->where($w)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
		    //$examstr=$mod->where($w)->limit('0,100')->order("id desc")->select();
	  }
	  
	  if($act=="moni"){
		  $w1=$w;
		  $w1["type"]=0;
		  $rs1=$mod->where($w1)->limit('0,40')->order("RAND()")->field("*")->select();
		  $examstr=$rs1;
		  
		  $w2=$w;
		  $w2["type"]=1;
		  $rs2=$mod->where($w2)->limit('0,40')->order("RAND()")->field("*")->select();
		  foreach($rs2 as $row){
		  $examstr[] =$row;
		  }
		  
		  $w3=$w;
		  $w3["type"]=2;
		  $rs3=$mod->where($w3)->limit('0,20')->order("RAND()")->field("*")->select();
		  foreach($rs3 as $row){
		  $examstr[] =$row;
		  }
	  }
	   
	    if($examstr){
			 $examstr=trim(json_encode($examstr));
			 $examstr=str_replace("\"[","[",$examstr);
			 $examstr=str_replace("]\"","]",$examstr);
		}
		if(trim($data["ajax"])=="1"){
			ob_clean();
			$examstr=str_replace('\"',"\"",$examstr);
			echo $examstr;
			exit();
		}

	   $webtitle=$conf["caption"]."-".$mytitle;
	   $this->assign("examstr",$examstr);
	   $this->assign("act",$act);
	   $this->assign("lang",$conf["lang"]);
	   $this->assign("webtitle",$webtitle);
	   $this->assign("mytitle",$mytitle);
	   $this->assign("caption",$conf["caption"]);
	   $this->assign("modelist",$modelist);
	   $this->assign("data",$data);
	   $this->display("lists");
    }
}


