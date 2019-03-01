<?php
namespace Admin\Controller;
use Think\Controller;
class ProductController extends CommController {
public $tablename="product";
public $fatherno="";
public $urldir="Admin/product";
public $lang="产品";
public function lists()
{
    $this->fatherno=$GLOBALS["g_product"]["classno"];

	$mod=M("product");
	$where["A.id"]=array('gt',0);
	$name=I("title");
	$classno=I("classno");
	$state=I("state");
	$dianjiaid=I("dianjiaid");
	if($name!=""){
	 $where["A.title"]=array('like',"%".$title."%");
	}
	if($classno!=""){
	 $where["A.classno"]=array('like',"".$classno."%");
	}
	if($state!=""){
	   $where["A.state"]=array('eq',$state);
	}
	if($dianjiaid!=""){
	   $where["A.dianjiaid"]=array('eq',$dianjiaid);
	}
	$class=M("class");
	$wh['_string'] = " fatherno='".$this->fatherno."' ";
	$classlist=$class->where($wh)->select();

	$count = $mod->table(C("DB_PREFIX").'product as A')->where($where)->count();
	$item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->table(C("DB_PREFIX").'product as A')->where($where)->join(C("DB_PREFIX")."user as B on A.dianjiaid=B.id ","left")->field("A.*,B.username,B.shopname")->order('A.id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$row){
		  if($list[$key]["classid"]!="0"){
			  $w["id"]=$list[$key]["classid"];
			  $class_one=M("class")->where($w)->find();
			  $list[$key]["class_caption"]=$class_one["title"];
			  $list[$key]["state_caption"]=$this->getcaption(C("state"),$list[$key]["state"]);
		  }
	  }
	   $item["num"]=count($list);
	  $this->assign('statelist',json_decode(C("state"),true));
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign('mytitle',"<i class='i-n'>产品</i>列表");
	  $this->assign('classlist',$classlist);
	  $this->assign('list',$list);
	   $this->assign('item',$item);
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
     $this->faterno=$GLOBALS["g_product"]["classno"];
    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
		$info["content"]=htmlspecialchars_decode($info["content"]);
       $this->assign('webtitle',"更新".$this->lang);
	   $this->assign('mytitle',"更新<i class='i-n'>产品</i>");
	}else{
		$this->assign('webtitle',"添加".$this->lang);
		$this->assign('mytitle',"添加<i class='i-n'>产品</i>");
	}
	$class=M("class");
	$wh['_string'] = " fatherno='".$this->fatherno."' or classno='".$this->fatherno."' ";
	$classlist=$class->where($wh)->select();
	$info["priceoption"]=json_encode(unserialize($info["priceoption"]));
	$info["canshuoption"]=json_encode(unserialize($info["canshuoption"]));
	$this->assign("classlist",$classlist);
	$this->assign('statelist',json_decode(C("state"),true));
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
	$data["priceoption"]=serialize($data["priceoption"]);
	$data["canshuoption"]=serialize($data["canshuoption"]);
	if(!empty($data["act"])){
			 $map_class["classno"]=array("eq",$data["classno"]);
			 $class_row=M("class")->where($map_class)->find();
			 $data["classid"]=$class_row["id"];
			 if($data["state"]==""){
				 $data["state"]=0;
			 }
			 if($data["added"]==""){
				 $data["added"]=1;
			 }
			 if($data["price"]==""){
				 $data["price"]=0;
			 }
			 if($data["prices"]==""){
				 $data["prices"]=0;
			 }
	   if($id==""){
		     
             $data["addtime"]=date("Y-m-d H:i:s");
			 $data["idno"]=md5(uniqid("",true));
			 $rs=$mod->data($data)->add();

			 $this->showmessage('已添加',U($this->urldir.'/info/'),3);exit;

	   }else{
		    $where["id"]=$id;
		    $rs=$mod->where($where)->save($data);
			$this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;
	   }
	}
   $this->info();
}
public function delete()
{
	$id=I('get.id');
	if($id==""){$id=I('ids');}
	$mod=D($this->tablename);
	if($id!=""){
	 $w["id"]=array("in",$id);
	 $res= $mod->where($w)->delete();
	}

	$this->showmessage('已删除',U($this->urldir.'/index'),3);exit;   

}
public function deleteall()
{
	$id=I('id');
	$name=I('name');
	$classno=I('classno');
	$added=I('added');
	$state=I('state');
	$mod=D($this->tablename);
	if($name!=""){
	$where["name"]=array("like","%".$name."%");
	}
	if($classno!=""){
	$where["classno"]=array("like","".$classno."%");
	}
	if($added!=""){
	$where["added"]=array("eq",$added);
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
