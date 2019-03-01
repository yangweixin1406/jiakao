<?php
namespace Qiyue\Controller;
use Think\Controller;
class NewsController extends CommQiyueController{
    public $tablename="content";
	public $tablename1="class";
	public $mtgz_classid='37';//媒体关注
    public function lists(){
	        $menu_about=M($this->tablename)->where(" classid=12 ")->field("title,url,id")->select();
		     $this->assign('menu_about',$menu_about);
			$mod=D($this->tablename);
			//$where["id"]=array('gt',0);
			$title=I("title");
			if($title!=""){
			$where["title"]=array('like',"%".$title."%");
			}
			$classid=I("classid");
			if(is_numeric($classid)&&$classid!=""){
			      $where["classid"]=array('eq',$classid);
			   	 $info=M($this->tablename1)->where("id=".$classid)->find();
				 if($info){
					$info["classname"]=$class_one["title"];
				  }
			}
		  $count = $mod->where($where)->count();
		  //$this->show($mod->getLastSql());
		  //import('ORG.Util.Page');
		  $pagesize=20; //分页分几条
		  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
		  $show = $page->show();
		  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
		  $classlist=D($this->tablename1)->where(" id>0 ")->select();
		   foreach($list as $key=>$row){
				 $w["id"]=$list[$key]["classid"];
				 $class_one=M($this->tablename1)->where($w)->find();
				 if($class_one){
					$list[$key]["class_caption"]=$class_one["title"];
				  }
		   }
		  $this->assign('classid',$classid);
		  $this->assign('classlist',$classlist);
		  $this->assign('info',$info);
		  $this->assign('list',$list);
		  $this->assign('show',$show);
		  //$this->view('index');
		  $this->display("lists"); 
    }
	public function mtgz(){
	$_GET["classid"]=$this->mtgz_classid;
	$this->lists();
	}
    public function info(){
	 $mod=D("content");
	 $w["id"]=array("eq",I("id"));
	 $info=$mod->where($w)->find();
	 if($info){
	      $one=M("class")->where(" classno='".$info["classno"]."' ")->find();
		  if($one){$info[classname]=$one["title"];}
		  $nav=$this->getnav($one["classno"]);
		  $this->assign('nav',$nav);
	 }
	 $info["content"]=htmlspecialchars_decode($info["content"]);
	 
	 $this->assign('info',$info);
	 $this->display(); 
  }
}
?>