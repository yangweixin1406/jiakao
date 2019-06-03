<?php
namespace Home\Controller;
use Think\Controller;
class AnswerController extends \Home\Controller\CommExamController {
	public $tablename="answer";
    public function add(){
		//http://document.thinkphp.cn/manual_3_2.html#where
        $userq=session("userq");
		$mod=D($this->tablename);
		$class=M("class");
		$data=I("");
		$data["userid"]=$userq["id"];
		$data["time"]=time();
		if(trim($data["isok"])==""){$data["isok"]=0;}
		if($_POST){
		    ob_clean();
				 $map_class["objidno"]=$data["objidno"];
				  $map_class["userid"]=$userq["id"];
				  $map_class["isok"]=$data["isok"];
				// $map_class["objtable"]=$data["objtable"];
				
					  $map["id"]=$userq["id"];
					  $userinfo=D("user")->where($map)->find();
					  if(is_array($userinfo)){
						   $where["id"]=$userq["id"];
						   $update_data["exam_error_count"]=$userinfo["exam_error_count"]+1;
						   $update_data["jifen"]=$userinfo["jifen"]-1;
						   if($update_data["jifen"]<0){
							 $update_data["jifen"]=0;
						   }
						   $rs=D("user")->where(" id=".$userq["id"])->save($update_data);
					   }
					   
				if($map_class["objidno"]!=""){ 
					$one=$mod->where($map_class)->find();
					if(!is_array($one)){
					   $rs=$mod->data($data)->add();
					   $this->success('已加入我的错题',U('home/index/index'),3);
					}else{
					   $where["id"]=$one["id"];
					   $update_data["time"]=time();
					   $rs=$mod->where($where)->save($update_data);
					  $this->success('已经加过我的错题',U('home/index/index'),3);
					}
				}
			  exit;
		}
    }
	public function remove(){
	   $userq=session("userq");
		if($_POST){
		     	$mod=D($this->tablename);
			   if(I("objtable")!=""){
			     $where["objtable"]=I("objtable");
			   }
			   if(I("objid")!=""){
			      $where["objid"]=I("objid");
			   }
			  
			   $where["userid"]=$userq["id"];
			   ob_clean();
			  if($where){
	            $res= $mod->where($where)->delete();
			    $this->success('已移除错题',U("home/".$this->tablename."/lists"),3);
			  }
			 exit;
		}
	}
    public function lists(){

	   header("Content-Type: text/html; charset=UTF-8");
       $userq=session("userq");
	   $mod=M($this->tablename);
	   $data=I("");
	   $act=$data["act"];
	   $objtable=$data["objtable"];
	   if($objtable==""){
	     $objtable="exam";
	   }
	   if($data['lang']==""){
	      $data['lang']="cn";
	   }
	   if(trim($data["isok"])==""){$data["isok"]=0;}
	   
		$conf_l=C("lang_".$data['lang']);
		$conf_lang=json_decode($conf_l,true);
		
	  
	       $where["userid"]=$userq["id"];
		   if($objtable!=""){
		   $where["objtable"]=$objtable;
		   }
		   $where["isok"]=$data["isok"];
		   if(trim($data['type'])!=""){
		     $where["type"]=$data['type'];
		   }
		   $count = $mod->where($where)->count();
			//import('ORG.Util.Page');
			 if(!isset($_GET["p"])){
				$_GET["p"]=$data["p"];
			 }
			$pagesize=20; //分页分几条
			$pagenum=(int)($count/$pagesize);
			 if($count%$pagesize>0){
			  $pagenum++;
			 }
			 if($_GET["p"]>$pagenum){
			 $_GET["p"]=$pagenum;
			 }
			 if(trim($_GET["p"])==""){
			   $_GET["p"]=1;
			 }
			$page = new \Think\Page($count,$pagesize);//thinkphp 3.2 //这个分页只能get??
			$show = $page->show();
			$rs = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
			//echo $mod->getLastSql();
		    //$examstr=$mod->where($w)->limit('0,100')->order("id desc")->select();
			$index=($_GET["p"]-1)*$pagesize;
		    foreach($rs as $row){
			             $index++;
						 $w["id"]=$row["objid"];
				  		 $one=M($row["objtable"])->where($w)->find();
	                     if($one){
						   $row1=$one;
						   $row1["items"]=json_decode($row1["items"],true);
						   $row1["photo_big"]=str_replace("/s50/","/s100/",$row1["photo"]);
						 }
						 $row1["errortitle"]=$row["title"];
						 $row1["errorid"]=$row["id"];
						 $row1["errortime"]=$row["time"];
						 $row1["myvalue"]=$row["value"];
						 
						 $row1["index"]=$index;
						 $list[] =$row1;
		        
		   }


       $mytitle=$conf_lang["error"]["title"];
      if($data["type"]!=""){ $mytitle.="(科目".$data["type"].")";}
	   $webtitle=$mytitle;
	   $this->assign("act",$act);
	   $this->assign("lang",$conf_lang["lang"]);
	   $this->assign("conf_lang",$conf_lang);
	   $this->assign("webtitle",$webtitle);
	   $this->assign("mytitle",$mytitle);
	   $this->assign("caption",$conf["caption"]);
	   $this->assign("modelist",$modelist);
	   $this->assign("data",$data);
	   
	   $this->assign("objtable",$objtable);
	   $this->assign("list",$list);
	   $this->assign("show",$show);
	   $this->assign("table",$this->tablename);
	   $this->display();
	   
    }
}
?>


