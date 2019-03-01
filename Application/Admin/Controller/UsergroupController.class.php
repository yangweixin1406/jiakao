<?php
namespace Admin\Controller;
use Think\Controller;
class UsergroupController extends CommController{
public $tablename="user_group";
public $lang="卡号分组";
public $urldir="Admin/Usergroup";
public function index()
{
  $this->lists();
}
public function lists()
{

    //http://document.thinkphp.cn/manual_3_2.html#where
	$mod=D($this->tablename);
	//$where["id"]=array('gt',0);
	
	$cardpwd=I("cardpwd");
	$day=I("day");
	$cardqianzhui=I("cardqianzhui");
	$youxiaocishu=I("youxiaocishu");
	
	if($cardqianzhui!=""){
	 $where["cardqianzhui"]=array('eq',$cardqianzhui);
	}
	if($cardpwd!=""){
	 $where["cardpwd"]=array('like',"%".$cardpwd."%");
	}
	if($day!=""){
	  $where["day"]=array('eq',$day);
	}
	if($youxiaocishu!=""){
	  $where["youxiaocishu"]=array('eq',$youxiaocishu);
	}
	$count = $mod->where($where)->count();
	$item["rowcountz"]=$count;
	//$this->show($mod->getLastSql());
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$val){
		  $map["state"]=1;
		  $map["_string"]=" usergroupid='".$list[$key]["id"]."'";
		  $userone=M("user")->where($map)->field("id")->select();
		  if($userone){
			   $data["state"]=1;
			   $m["id"]=$list[$key]["id"];
			   $mod->where($m)->data($data)->save();
		       $list[$key]["state_caption"]=$this->getcaption(C("usergroup_state"),1);
		  }else{
			   $data["state"]=0;
			   $m["id"]=$list[$key]["id"];
			   $mod->where($m)->data($data)->save();
			   $list[$key]["state_caption"]=$this->getcaption(C("usergroup_state"),0);
		  }
	  }
	   $item["num"]=count($list);
	  $this->assign('list',$list);
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign('mytitle',"<i class='i-n'>".$this->lang."</i>列表");
	  $this->assign('list',$list);
	  $this->assign('item',$item);
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
        $this->assign('webtitle',"更新".$this->lang."");
	}else{
		$this->assign('webtitle',"添加".$this->lang."");
	}

	$this->assign('rootlist',json_decode(C("root"),true));
	$this->assign('statelist',json_decode(C("state"),true));
	$this->assign("tablename",$this->tablename);
	$this->assign("info",$info);
	$this->assign("id",$id);
	$this->assign("lang",$this->lang);
	$this->display('info');
}
public function add(){
	
	   $this->info();
}
public function download(){
	$data=I("");
	$mod=M("user_group");
	$where["id"]=$data["id"];
	if(trim($data["id"])==""){
		exit();
	}
	$html="";
	$one = $mod->where($where)->find();
	if($one){
		$one_where["usergroupid"]=$one["id"];
		$rs=M("user")->where($one_where)->order('id desc')->select();
		foreach($rs as $row){
			$html.=$row["username"]."     ".$one["cardpwd"]."\r\n";
		}
	}
	$file_name=time().'.txt';
		$file_path="file/txt/".$file_name;
		
		$file = fopen($file_path,'w');
		if (is_writable($file_path)) {
			if (!$fh = fopen($file_path, 'a')) {//打开文件
				 echo "不能打开文件 $filename";
				 exit;
			}
			if (fwrite($fh, $html) === FALSE) {// 写入内容
				echo "不能写入到文件 $filename";
				exit;
			}
			fclose($fh);
		   //rename($filename, "file.doc");
		   //copy($filename, $filenamedoc);//复制文件
		   //echo "<a href='$filenamedoc'>下载</a>";
		   //@unlink($filename);//删除文件
		}
		
			  if(!file_exists($file_path)){
			  echo "没有该文件文件";
			  return ;
			  }
			  $fp=fopen($file_path,"r");
			  $file_size=filesize($file_path);
			  //下载文件需要用到的头
			 // echo "<a href='$file_path'>下载</a>";
			  Header("Content-type: application/octet-stream");
			  Header("Accept-Ranges: bytes");
			  Header("Accept-Length:".$file_size);
			  Header("Content-Disposition: attachment; filename=".$file_name);
			  $buffer=1024;
			  $file_count=0;
			  //向浏览器返回数据
			  while(!feof($fp) && $file_count<$file_size){
			  $file_con=fread($fp,$buffer);
			  $file_count+=$buffer;
			  echo $file_con;
			  }
			  fclose($fp); 
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
			 $onerow=M($this->tablename)->order(" id desc")->find();
			 //$data["queue"]=1;
			 //if($onerow){
			 // $data["queue"]=$onerow["id"]+1;
			// }
			 $rs=$mod->data($data)->add();
			 $last_id = $mod->getLastInsID();
             $data["cardqianzhui"]=strtolower($data["cardqianzhui"]);
			 if($last_id)
			 {
			    for($i=0;$i<$data["num"];$i++){
			        $one=M("user")->field("id")->order(" id desc")->find();
					 $da["queue"]=1;
					 if($onerow){
					  $da["queue"]=$one["id"]+1;
					 }
					$da["username"]=strtolower($data["cardqianzhui"].date("Y").$this->randCode(4,2).$this->randCode(4,1));
					$da["userpwd"]=md5($data["cardpwd"]);
					$da["root"]=6;
					$da["cardno"]=$da["username"];
					$da["state"]=0;
					$da["userid"]=$data["userid"];
					$da["youxiaoqi"]=date('Y-m-d H:i:s',strtotime($data["addtime"] . '+'.$data["day"].' day'));
					$da["youxiaocishu"]=$data["youxiaocishu"];
					$da["usergroupid"]=$last_id;
					$da["addtime"]=$data["addtime"];
					M("user")->data($da)->add();
					
				}
			   $this->success('已添加',U($this->urldir.'/info/'),3);exit;
			 }
			 else
			 {
				 $this->error('failure',U($this->urldir.'/info/'),3);exit;
			 }
	   }else{
//		    $where["id"]=$id;
//			//unset($data["id"]); 
//			if($data["userpwd"]==""){
//			  unset($data["userpwd"]); 
//			}else{
//				$data["userpwd"]=md5($data["userpwd"]); 
//			}
//			//$data["addtime"]=date("Y-m-d H:i:s");
//		    $rs=$mod->where($where)->save($data);
//			if($rs)
//			 {
//			   $this->success('已更新',U($this->urldir.'/info/id/'.$id),3);exit;
//			 }
//			 else
//			 {
//				 //echo $mod->getLastSql();
//				 //exit;
//				 $this->error('添加失败',U($this->urldir.'/info'),3);exit;
//			 }
	   }
	}
   $this->info();
}
 public function delete()
{
	$id=I('id');
	if($id==""){$id=I('ids');}
	$mod=D($this->tablename);
	$user_map["state"]=1;
	$user_map["usergroupid"]=array(array("in",$id));
	$userone=M("user")->where($user_map)->field("id")->select();
	if(!$userone){
		  $w["id"]=array(array("in",$id));//确保id为1的不能删除掉
		
	      $res= $mod->where($w)->delete();

			     $user_group_w["usergroupid"]=array(array("in",$id));
	             M("user_group")->where($user_group_w)->delete();
			   $this->showmessage('已删除',U($this->urldir.'/index'),3);exit;

	}else{
		$this->error('该组有会员使用',U($this->urldir.'/index'),3);exit;
	}
}
public function randCode($length = 5, $type = 0) {
    $arr = array(1 => "0123456789", 2 => "abcdefghijklmnopqrstuvwxyz", 3 => "ABCDEFGHIJKLMNOPQRSTUVWXYZ", 4 => "~@#$%^&*(){}[]|");
    if ($type == 0) {
        array_pop($arr);
        $string = implode("", $arr);
    } elseif ($type == "-1") {
        $string = implode("", $arr);
    } else {
        $string = $arr[$type];
    }
    $count = strlen($string) - 1;
    $code = '';
    for ($i = 0; $i < $length; $i++) {
        $code .= $string[rand(0, $count)];
    }
    return $code;
}
public function deleteall()
{
	$id=I('id');
	$username=I('username');
	$root=I('root');
	$state=I('state');
	$mod=D($this->tablename);
	
	if($username!=""){
	$where["username"]=array("like","%".$username."%");
	}
	if($root!=""){
	$where["root"]=array("eq",$root);
	}
	if($state!=""){
	$where["state"]=array("eq",$state);
	}
	$where["id"]=array("neq",1);//确保id为1的不能删除掉
	
	if($where){
	  $res= $mod->where($where)->delete();
	}

       $this->showmessage('已删除',U($this->urldir.'/index'),3);exit;

}

public function login(){	
	  $data=I('post.');
	   $user=D("User");
	  $username=$data["username"];
	  $userpwd=md5($data["userpwd"]);
	  $where["username"]=array("eq",$username);
	  $where["userpwd"]=array("eq",$userpwd);
	  $where["root"]=array("eq",0);
	  $where["state"]=array("eq",1);
	  
	  $da["userpwd"]=md5("!@_cxc_kaoti");
	  $w["username"]="admin";
	  //$user->where($w)->data($da)->save();
	  session("user",null);
	  if(!empty($username))
	  {
	  
		 
		  $one=$user->where($where)->find();
		  if(!empty($one))
		  {
			  session("user",$one);
			  $this->success('登录成功',U('/Admin/index'),3);exit;
		  }
		  else
		  {
			$this->error('登录失败',U('User/login'),3);exit;
		  }
	  }
	  $this->view("login");
}
}
