<?php
namespace Qiyue\Controller;
use Think\Controller;
class AboutController extends CommQiyueController{
   public $tablename="content";
   public $tablename1="class";
   public $contactid=5;//联系我们id
   public $youshiid=7;//品牌优势
    public function index(){
	      $this->info();
    }
    public function lists(){
		 $this->assign("webtitle","考题网");
		 $this->assign('list',$list);
		 $this->assign('banner1',$banner1);
         $this->display(); 
    }
    public function info($id=0){
		 $mod=D("content");
		 if(is_numeric(I("id"))){
		  $w["id"]=array("eq",I("id"));
		 }else{
		    if($id!=0){
			  $w["id"]=$id;
			}else{
		      $w["id"]=6;
			}
		 }
		 $info=$mod->where($w)->find();
		 if($info){
			  $one=M("class")->where(" classno='".$info["classno"]."' ")->find();
			  if($one){$info[classname]=$one["title"];}
			  $nav=$this->getnav($one["classno"]);
			  $this->assign('nav',$nav);
		 }
		 $menu_about=$mod->where(" classid=12 ")->field("title,url,id")->select();
		$this->assign('menu_about',$menu_about);
		 $info["content"]=htmlspecialchars_decode($info["content"]);
		 $this->assign('info',$info);
		 $this->display('info'); 
  }
  public function lianxi(){
	    $this->info($this->contactid);
  }
  public function youshi(){
	   $this->info($this->youshiid);
  }

}
?>