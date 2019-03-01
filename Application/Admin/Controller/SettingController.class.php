<?php
namespace Admin\Controller;
use Think\Controller;
class SettingController extends CommController {
public $tablename="setting";

public $urldir="Admin/setting";
public $lang="文章";
public function index()
{
   $this->info();
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
public function pay(){
	$data=I('post.');
	$mod=D($this->tablename);
	$group="pay";
	$map["setting_group"]=$group;
	$list=$mod->where($map)->select();
    foreach($list as $row){
	     $setting[$row["setting_key"]]=unserialize(base64_decode($row['setting_value']));

	}
	if($_POST){
		  $set=$data["setting"];
		  foreach($set as $key=>$val){
				 if($key!=""){
					$setting_key=$key;
					$wh["setting_key"]=$setting_key;
					$row=$mod->where($wh)->find();
					if(!$row){

								 $data1["setting_key"]=$setting_key;
								 $data1["setting_value"]="";
								 $rs=$mod->data($data1)->add();
					}
				   $setting_value=base64_encode(serialize($val));
				   $updata["setting_value"]=$setting_value;
				   $updata["setting_group"]=$group;
				   $wh2["setting_key"]=$setting_key;
				   $rs=$mod->where($wh2)->save($updata);
				 }
		  }
		  $this->showmessage('已更新',U($this->urldir.'/pay/'),2);exit;
	}
    $this->assign('webtitle',"更新支付配置");
    $this->assign("setting",$setting);
	$this->display('pay');
}
public function weixin_api(){

	$data=I('post.');
	$mod=D($this->tablename);
	$group="api";
	$map["setting_group"]=$group;
	$map["setting_key"]="weixin_api";
	$list=$mod->where($map)->select();
    foreach($list as $row){
	     $setting[$row["setting_key"]]=unserialize(base64_decode($row['setting_value']));
	}
	if($_POST){
		  $set=$data["setting"];
		  foreach($set as $key=>$val){
				 if($key!=""){
					$setting_key=$key;
					$wh["setting_key"]=$setting_key;
					$row=$mod->where($wh)->find();
					if(!$row){
								 $data1["setting_key"]=$setting_key;
								 $data1["setting_value"]="";
								 $rs=$mod->data($data1)->add();
					}
				   $setting_value=base64_encode(serialize($val));
				   $updata["setting_value"]=$setting_value;
				   $updata["setting_group"]=$group;
				   $wh2["setting_key"]=$setting_key;
				   $rs=$mod->where($wh2)->save($updata);
				 }
		  }
		  $this->showmessage('已更新',U($this->urldir.'/weixin_api/'),2);exit;
	}
    $this->assign('webtitle',"微信公众号配置");
    $this->assign("setting",$setting);
	$this->display('weixin_api');
}
public function kefu(){

	$data=I('post.');
	$mod=D($this->tablename);
	$group="kf";
	$map["setting_group"]=$group;
	$map["setting_key"]="kefu";
	$list=$mod->where($map)->select();
    foreach($list as $row){
	     $setting[$row["setting_key"]]=unserialize(base64_decode($row['setting_value']));
	}
	if($_POST){
		  $set=$data["setting"];
		  foreach($set as $key=>$val){
				 if($key!=""){
					$setting_key=$key;
					$wh["setting_key"]=$setting_key;
					$row=$mod->where($wh)->find();
					if(!$row){
								 $data1["setting_key"]=$setting_key;
								 $data1["setting_value"]="";
								 $rs=$mod->data($data1)->add();
					}
				   $setting_value=base64_encode(serialize($val));
				   $updata["setting_value"]=$setting_value;
				   $updata["setting_group"]=$group;
				   $wh2["setting_key"]=$setting_key;
				   $rs=$mod->where($wh2)->save($updata);
				 }
		  }
		  $this->showmessage('已更新',U($this->urldir.'/weixin_api/'),2);exit;
	}
    $this->assign('webtitle',"网络客服配置");
    $this->assign("setting",$setting);
	$this->display('kefu');
}
public function email(){
    $id=1;
	$data=I('post.');
	$mod=D($this->tablename);
	$map["setting_group"]="api";
	$map["setting_key"]="email";
	$list=$mod->where($map)->select();
    foreach($list as $row){
	     $setting[$row["setting_key"]]=unserialize(base64_decode($row['setting_value']));
	}
	if($_POST){
		  $set=$data["setting"];
		  foreach($set as $key=>$val){
				 if($key!=""){
					$setting_key=$key;
					$wh["setting_key"]=$setting_key;
					$row=$mod->where($wh)->find();
					if(!$row){
								 $data1["setting_key"]=$setting_key;
								 $data1["setting_value"]="";
								 $rs=$mod->data($data1)->add();
					}
				   $setting_value=base64_encode(serialize($val));
				   $updata["setting_value"]=$setting_value;
				   $updata["setting_group"]="api";
				   $wh2["setting_key"]=$setting_key;
				   $rs=$mod->where($wh2)->save($updata);
				 }
		  }
		  $this->showmessage('已更新',U($this->urldir.'/email/'),2);exit;
	}
    $this->assign('webtitle',"邮箱配置");
    $this->assign("setting",$setting);
	$this->display('email');
}
public function point(){
    $id=1;
	$data=I('post.');
	$mod=D($this->tablename);
	$map["setting_group"]="convert";
	$list=$mod->where($map)->select();
    foreach($list as $row){
	     $setting[$row["setting_key"]]=unserialize(base64_decode($row['setting_value']));

	}
	if($_POST){
		  $set=$data["setting"];
		  foreach($set as $key=>$val){
				 if($key!=""){
					$setting_key=$key;
					$wh["setting_key"]=$setting_key;
					$row=$mod->where($wh)->find();
					if(!$row){

								 $data1["setting_key"]=$setting_key;
								 $data1["setting_value"]="";
								 $rs=$mod->data($data1)->add();
					}
				   $setting_value=base64_encode(serialize($val));
				   $updata["setting_value"]=$setting_value;
				   $updata["setting_group"]="convert";
				   $wh2["setting_key"]=$setting_key;
				   $rs=$mod->where($wh2)->save($updata);
				 }
		  }
		  $this->showmessage('已更新',U($this->urldir.'/point/'),2);exit;
	}
    $this->assign('webtitle',"更新积分兑换配置");
    $this->assign("setting",$setting);
	$this->display('point');
}
public function info(){
    $id=1;
	$data=I('post.');
	$mod=D($this->tablename);
	if(is_numeric($id))
	{
		$map["id"]=$id;
		$info=$mod->where($map)->find();
       $this->assign('webtitle',"更新".$this->lang);
	}else{
		$this->assign('webtitle',"添加".$this->lang);
	}
	$class=M("class");
	$wh['_string'] = " fatherno='".$this->fatherid."' or classno='".$this->fatherid."' ";
	$classlist=$class->where($wh)->select();
	$this->assign("classlist",$classlist);
	$this->assign('statelist',json_decode(C("state"),true));
	$this->assign("info",$info);
	$this->assign("lang",$this->lang);
	$this->assign("id",$id);
	$this->display('info');
}
public function reg(){
    $id=1;
	$data=I('post.');
	$mod=D($this->tablename);
	$map["setting_key"]="reg";
	$list=$mod->where($map)->select();
    foreach($list as $row){
	     $setting[$row["setting_key"]]=unserialize(base64_decode($row['setting_value']));
	}
	if($_POST){
		  $set=$data["setting"];
		  foreach($set as $key=>$val){
				 if($key!=""){
					$setting_key=$key;
					$wh["setting_key"]=$setting_key;
					$row=$mod->where($wh)->find();
					if(!$row){
								 $data1["setting_key"]=$setting_key;
								 $data1["setting_value"]="";
								 $rs=$mod->data($data1)->add();
					}
				   $setting_value=base64_encode(serialize($val));
				   $updata["setting_value"]=$setting_value;
				   $wh2["setting_key"]=$setting_key;
				   $updata["setting_group"]="api";
				   $rs=$mod->where($wh2)->save($updata);
				 }
		  }
		  $this->showmessage('已更新',U($this->urldir.'/'.$map["setting_key"].'/'),2);exit;
	}
    $this->assign('webtitle',"会员注册配置");
    $this->assign("setting",$setting);
	$this->display('reg');
}
public function sms(){
    $id=1;
	$data=I('post.');
	$mod=D($this->tablename);
	$map["setting_key"]="sms";
	$list=$mod->where($map)->select();
    foreach($list as $row){
	     $setting[$row["setting_key"]]=unserialize(base64_decode($row['setting_value']));
	}
	if($_POST){
		  $set=$data["setting"];
		  foreach($set as $key=>$val){
				 if($key!=""){
					$setting_key=$key;
					$wh["setting_key"]=$setting_key;
					$row=$mod->where($wh)->find();
					if(!$row){
								 $data1["setting_key"]=$setting_key;
								 $data1["setting_value"]="";
								 $rs=$mod->data($data1)->add();
					}
				   $setting_value=base64_encode(serialize($val));
				   $updata["setting_value"]=$setting_value;
				   $wh2["setting_key"]=$setting_key;
				   $updata["setting_group"]="api";
				   $rs=$mod->where($wh2)->save($updata);
				 }
		  }
		  $this->showmessage('已更新',U($this->urldir.'/'.$map["setting_key"].'/'),2);exit;
	}
    $this->assign('webtitle',"短信配置");
    $this->assign("setting",$setting);
	$this->display('sms');
}
public function kaoti(){
    $id=1;
	$data=I('post.');
	$mod=D($this->tablename);
	$map["setting_key"]="kaoti";
	$list=$mod->where($map)->select();
    foreach($list as $row){
	     $setting[$row["setting_key"]]=unserialize(base64_decode($row['setting_value']));
	}
	if($_POST){
		  $set=$data["setting"];
		  foreach($set as $key=>$val){
				 if($key!=""){
					$setting_key=$key;
					$wh["setting_key"]=$setting_key;
					$row=$mod->where($wh)->find();
					if(!$row){
								 $data1["setting_key"]=$setting_key;
								 $data1["setting_value"]="";
								 $rs=$mod->data($data1)->add();
					}
				   $setting_value=base64_encode(serialize($val));
				   $updata["setting_value"]=$setting_value;
				   $wh2["setting_key"]=$setting_key;
				   $updata["setting_group"]="api";
				   $rs=$mod->where($wh2)->save($updata);
				 }
		  }
		  $this->showmessage('已更新',U($this->urldir.'/'.$map["setting_key"].'/'),2);exit;
	}
    $this->assign('webtitle',"考题系统模式配置");
    $this->assign("setting",$setting);
	$this->display('kaoti');
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
			 $data["userid"]=$userone["id"];
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 $data["queue"]=1;
			 if($onerow){
			  $data["queue"]=$onerow["id"]+1;
			 }
             $data["addtime"]=date("Y-m-d H:i:s");
			 $rs=$mod->data($data)->add();
			 $this->showmessage('已添加',U($this->urldir.'/info/'),3);exit;

	   }else{
		    $where["id"]=$id;
		    $rs=$mod->where($where)->save($data);
			$this->showmessage('已更新',U($this->urldir.'/info/id/',array("id"=>$id)),3);exit;

	   }
	}
   $this->info();
}

 
}
?>