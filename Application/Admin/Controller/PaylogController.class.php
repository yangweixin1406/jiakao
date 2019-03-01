<?php
namespace Admin\Controller;
use Think\Controller;
class PaylogController extends CommController {
public $tablename="paylog";
public $fatherno="";
public $urldir="Admin/paylog";
public $lang="交易";
public function index()
{
    $this->lists();
}
public function lists(){
	$mod=D($this->tablename);
	

	$title=I("title");
	$orderno=I("orderno");
	$tradeno=I("tradeno");
	$status=I("status");
	$total=I("total");
    
	if($title!=""){
	 $where["title"]=array('like',"%".$title."%");
	}
	if($orderno!=""){
	  $where["orderno"]=array('like',"".$orderno."%");
	}
	if($tradeno!=""){
	  $where["tradeno"]=array('like',"".$tradeno."%");
	}
	if($status!=""){
	 $where["status"]=array('eq',$status);
	}
	if($total!=""){
	  $where["total"]=array('eq',$total);
	}
	$class=M("class");

	$count = $mod->where($where)->count();
	$item=I('get.');
	$item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  $paylog_status=json_decode(C("paylog_status"),true);
	  foreach($paylog_status as $k=>$v){
			     $statuscaption[$v["value"]]=$v["title"];
	  }
	  foreach($list as $key=>$row){
          $list[$key]["status_caption"]=$statuscaption[$row["status"]];
	  }
	   $item["num"]=count($list);
	  $this->assign('statuslist',json_decode(C("paylog_status"),true));
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign('mytitle',"<i class='i-n'>".$this->lang."</i>列表");
	  $this->assign('item',$item);
	  $this->assign('list',$list);
	  $this->assign('show',$show);
	  $this->assign("lang",$this->lang);
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
    public function view($view)
    {
    	$this->display($view);
}
public function info(){
    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);

	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
	}
	$paylog_status=json_decode(C("paylog_status"),true);
	  foreach($paylog_status as $k=>$v){
			     $statuscaption[$v["value"]]=$v["title"];
	  }
   $this->assign('webtitle',$this->lang."信息");
   $this->assign('mytitle',"<i class='i-n'>".$this->lang."</i>信息");
   $info["status_caption"]=$statuscaption[$info["status"]];
	$this->assign("info",$info);
	$this->assign("lang",$this->lang);
	$this->assign("id",$id);
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
			 $map_class["classno"]=array("eq",$data["classno"]);
			 $class_row=M("class")->where($map_class)->find();
			 $data["classid"]=$class_row["id"];
			 if($data["state"]==""){
				 $data["state"]=0;
			 }
	   if($id==""){
		     $userone=session("user");
			 $data["userid"]=$userone["id"];
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 $data["sort"]=1;
			 if($onerow){
			  $data["sort"]=$onerow["id"]+1;
			 }
             $data["addtime"]=date("Y-m-d H:i:s");
			 $rs=$mod->data($data)->add();

			   $this->showmessage('已添加',U($this->urldir.'/info'),3);exit;

	   }else{
		    $where["id"]=$id;
		    $rs=$mod->where($where)->save($data);
			//exit();

			   $this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}
public function delete()
{
	$id=I('get.id');
	$user=D($this->tablename);
	$w["id"]=array("eq",$id);
	$res= $user->where($w)->delete();
	$this->showmessage('已删除',U($this->urldir.'/index'),3);exit;
}
public function deleteall()
{
	$id=I('id');
	$name=I('name');
	$classno=I('classno');
	$state=I('state');
	$mod=D($this->tablename);
	
	if($classno!=""){
	$where["classno"]=array("like","".$classno."%");
	}
	if($name!=""){
	$where["name"]=array("like","%".$name."%");
	}
	if($state!=""){
	$where["state"]=array("eq",$state);
	}
	if($where){
	  $res= $mod->where($where)->delete();
	}
    $this->showmessage('已删除',U($this->urldir.'/index'),3);exit;

}	 
}
?>
