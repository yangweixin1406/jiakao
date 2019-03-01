<?php
namespace Admin\Controller;
use Think\Controller;
class LinkController extends CommController{
public $tablename="link";
public $tablename1="link_class";
public $lang="信息";
public $urldir="Admin/link";
public function index()
{
    $this->lists();
}
public function lists()
{

    //http://document.thinkphp.cn/manual_3_2.html#where
	$mod=D($this->tablename);
	//$where["id"]=array('gt',0);
	
	$title=I("title");
	$href=I("href");
	if($title!=""){
	  $where["title"]=array('like',"%".$title."%");
	}
	if($href!=""){
	  $where["href"]=array('like',"%".$href."%");
	}
	$classid=I("classid");
	if($classid!=""){
	    if(is_numeric($classid)){
	    $where["classid"]=array('eq',$classid);
		}
	}
	$count = $mod->where($where)->count();
	$item["rowcountz"]=$count;
	//$this->show($mod->getLastSql());
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('sort asc,id desc')->limit($page->firstRow.",".$page->listRows)->select();
      $this->assign('webtitle',"".$this->lang."列表");
	  $classlist=D($this->tablename1)->where(" id>0 ")->select();
	   foreach($list as $key=>$row){
	         $w["id"]=$list[$key]["classid"];
	  		 $class_one=M($this->tablename1)->where($w)->find();
			 if($class_one){
			    $list[$key]["class_caption"]=$class_one["title"];
			  }
	}
	$item["num"]=count($list);
	  $this->assign('mytitle',"<i class='i-n'>综合</i>列表");
	  $this->assign('classid',$classid);
	  $this->assign('classlist',$classlist);
	  $this->assign('list',$list);
	   $this->assign('item',$item);
	  $this->assign('show',$show);
	  //$this->view('index');
	  $this->display("lists");
}
public function getcaption($str,$value){
	
	$caption="";

	$list=json_decode($str,true);
	foreach($list as $row){
		if(trim($row["value"])==trim($value)){
			$caption=$row["name"];
		}
	}

	return $caption;
}

public function info(){
    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);
	
	if($_POST){
	   $this->save();
	}
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
        $this->assign('webtitle',"更新".$this->lang."");
	}else{
		$this->assign('webtitle',"添加".$this->lang."");
	}
	if(is_array($info)){
     	$info["content"]=htmlspecialchars_decode($info["content"]);
	}
	$classlist=D($this->tablename1)->where(" id>0 ")->select();
	$this->assign('classlist',$classlist);
	$this->assign('targetlist',json_decode(C("target"),true));
	$this->assign("tablename",$this->tablename);
	$this->assign("info",$info);
	$this->assign("id",$id);
	$this->assign("lang",$this->lang);
	$this->display('info');
	
}
public function add(){
	
	   $this->info();
}
public function save()
{

    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();

	}
	
	if(!empty($data["act"])){
	   if($id==""){
		     $userone=session("user");
			 $data["addtime"]=date("Y-m-d H:i:s");
			 $data["userid"]=$userone["id"];
			 if(!is_numeric($data["sort"])){
			   $data["sort"]=10;
			 }
			 $data["photo_big"]=str_replace("/s50/","/s100/",$data["photo_small"]);
			 $rs=$mod->add($data);

			   $this->showmessage('已添加',U($this->urldir.'/info/'),3);exit;

	   }else{
		       $where["id"]=$id;

			   $data["photo_big"]=str_replace("/s50/","/s100/",$data["photo_small"]);

		       $rs=$mod->where($where)->save($data);
			   $this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
 public function delete()
{
	$id=I('id');
	if($id==""){$id=I('ids');}
	$mod=D($this->tablename);
	$w["id"]=array(array("in",$id));//确保id为1的不能删除掉
	$res= $mod->where($w)->delete();
	$this->showmessage('删除成功',U($this->urldir.'/index'),2);exit;

}

}
?>