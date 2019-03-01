<?php
namespace Qiyue\Controller;
use Think\Controller;
class IndexController extends CommQiyueController{
    public function index(){
		//$this->assign("webtitle","考题网");
		
		 $new_xwdt5=M("content")->where(" classno='000100020001' ")->limit('0,5')->select();
		 $new_mtgz5=M("content")->where(" classno='000100020004' ")->limit('0,5')->select();
	 $navs=M("link")->where(" classid=2 ")->order("sort asc ")->select();

	$aboutinfo=M("link")->where(" id='4' ")->find();
	if(is_array($aboutinfo)){
     	$aboutinfo["content"]=htmlspecialchars_decode($aboutinfo["content"]);
	}
		 $this->assign('new_xwdt5',$new_xwdt5);
		 $this->assign('new_mtgz5',$new_mtgz5);
		 $this->assign('aboutinfo',$aboutinfo);
         $this->display(); 
    }
    public function contact (){
	 $mod=D("content");
	 $w["id"]=array("eq",1);
	 $one=$mod->where($w)->find();
	 //var_dump($one);
	 echo json_encode($one);
	 
	 exit();
  }
}
?>