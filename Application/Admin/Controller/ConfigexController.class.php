<?php
namespace Admin\Controller;
use Think\Controller;
class ConfigexController extends CommController{
public $tablename="configex";
public $lang="分类";
public $urldir="Admin/Configex";
public $fatherno="00010004";
public function index()
{
 $this->lists();
}
public function lists()
{

    //http://document.thinkphp.cn/manual_3_2.html#where
	$mod=D($this->tablename);
	//$where["id"]=array('gt',0);
	
	$name=I("name");
	$fatherno=I("fatherno");
	$root=I("root");
	$state=I("state");
	

    
	
	$count = $mod->where($where)->count();
	$item["rowcountz"]=$count;
	//$this->show($mod->getLastSql());
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('sort asc, id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$row){
			  $w["classno"]=$list[$key]["fatherno"];
			  $class_one=M("class")->where($w)->find();
			  if($class_one){
			     $list[$key]["class_caption"]=$class_one["title"];
				 $w2["fatherno"]=$list[$key]["fatherno"];
				 $data2["fatherid"]=$class_one["id"];
			     $mod->where($w2)->save($data2);
			  }
	  }
	 
	  $item["num"]=count($list);
	  $this->assign('classlist',M("class")->where(" fatherno='".$this->fatherno."' ")->select());
	  $this->assign('list',$list);
	   $this->assign('fatherno',$fatherno);
	  $this->assign('item',$item);
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign('mytitle',"<i class='i-n'>分类</i>列表");
	  $this->assign('list',$list);
	  $this->assign('show',$show);
	  $this->assign('data',json_encode(I()));
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


public function info(){
    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
        $this->assign('webtitle',"更新".$this->lang."");
	}else{
		$this->assign('webtitle',"添加".$this->lang."");
	}

	$this->assign('classlist',M("class")->where(" fatherno='".$this->fatherno."' ")->select());
	$this->assign("tablename",$this->tablename);
	 $this->assign('fatherno',$this->fatherno);
	$this->assign("info",$info);
	$this->assign("id",$id);
	$this->assign("lang",$this->lang);
	$this->display('info');
	
}
public function add(){
	
	   $this->info();
}
public function classoption(){

	$fatherno=$_POST["fatherno"];
	$tablename=$_POST["tablename"];
	if($tablename==""){
	   $tablename="class";
	}
	$w["fatherno"]=$fatherno;
	$w["fatherno"]=$fatherno;
	$mod=M($tablename);
	$list=$mod->where($w)->order("sort asc")->select();

	foreach($list as $row){
		$name=$row["title"];
		$classno=$row["classno"];
		$w2["fatherno"]=$classno;
		$list2=$mod->where($w2)->order("sort asc")->select();
		$childcount=count($list2);
		$item["title"]=$row["title"];
		$item["classno"]=$row["classno"];
		$item["fatherno"]=$row["fatherno"];
		$item["childcount"]=$childcount;
		$json[]=$item;
	}
	echo "{\"options\":".json_encode($json)."}";
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
	  if(!is_numeric($data["sort"])||trim($data["sort"])==""){
	   $data["sort"]=1000;
	  }
	if(!empty($data["act"])){
	   if($id==""){
		     $userone=session("user");
			 $data["addtime"]=date("Y-m-d H:i:s");
			 $data["userid"]=$userone["id"];

			  $one1=M("class")->where($where)->order(" id desc")->find();
			  if($one1){
				  $data["fatherid"]=$one1["id"];
			  }
			   $rs=$mod->data($data)->add();
			   $this->showmessage('已添加',U($this->urldir.'/info/'),3);exit;

	   }else{
		    $where["id"]=$id;
			//$data["addtime"]=date("Y-m-d H:i:s");
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
	$arr=explode(",",$id);
	for($i=0;$i<count($arr);$i++){
	    $arr[$i]=trim($arr[$i]);
	    if($arr[$i]>10&&is_numeric($arr[$i])&&$arr[$i]!=""){
		   $w["id"]=$arr[$i];
	       $res= $mod->where($w)->delete();
		}
	}
	//$res= $mod->where($w)->delete();

	$this->showmessage('删除成功',U($this->urldir.'/index'),3);exit;

}
public function deleteall()
{
//	$id=I('id');
//	$username=I('username');
//	$root=I('root');
//	$state=I('state');
//	$mod=D($this->tablename);
//	
//	if($username!=""){
//	$where["username"]=array("like","%".$username."%");
//	}
//	if($root!=""){
//	$where["root"]=array("eq",$root);
//	}
//	if($state!=""){
//	$where["state"]=array("eq",$state);
//	}
//	$where["id"]=array("neq",1);//确保id为1的不能删除掉
//	
//	if($where){
//	  //$res= $mod->where($where)->delete();
//	}
//	if($res>0)
//	{
//       $this->success('success',U($this->urldir.'/index'),3);exit;
//	}
//	else
//    {
//          $this->error('failure',$this->urldir.'/index',3);exit;
//
//    }
}

}
