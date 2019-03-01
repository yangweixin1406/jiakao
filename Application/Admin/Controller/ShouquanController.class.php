<?php
namespace Admin\Controller;
use Think\Controller;
class ShouquanController extends CommController {
	public $tablename="shouquan";
	public $fatherid="";
	public $urldir="Admin/shouquan";
	public $lang="授权资料";
	public function index(){
	   $this->lists();
	}
	public function lists()
	{
		$mod=D($this->tablename);
		$where["id"]=array('gt',0);
		$name=I("name");
		$classno=I("classno");
		$key=I("key");
	
		if($key!=""){
			 if(is_numeric($key)){
			   $where["id"]=$key;
			 }else {
			  $where['_string'] = " (weixin like '%{$key}%')  OR ( contact like '%{$key}%') OR ( phone like '%{$key}%')  OR ( address like '%{$key}%')   OR ( email like '%{$key}%') ";
			 }
		}
		$count = $mod->where($where)->count();
		$item["rowcountz"]=$count;
		  //import('ORG.Util.Page');
		  $pagesize=20; //分页分几条
		  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
		  $show = $page->show();
		  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
		  $item["num"]=count($list);
		  $this->assign('statelist',json_decode(C("state"),true));
		  $this->assign('webtitle',$this->lang."列表");
		  $this->assign('mytitle',"<i class='i-n'>授权</i>列表");
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
		$id=I('id');
		$data=I('post.');
		$mod=D($this->tablename);
		if(is_numeric($id))
		{
			$map["id"]=$id;
			$info=$mod->where($map)->find();
		   $this->assign('webtitle',"更新".$this->lang);
		   $this->assign('webtitle',"更新".$this->lang);
		}else{
			$this->assign('webtitle',"添加".$this->lang);
			$this->assign('mytitle',"添加".$this->lang);
			$starttime=strtotime(date("Y-m-d"));
			$info["startdate"]=date("Y-m-d",$starttime);
			$info["enddate"]=date('Y-m-d',strtotime('+1 year',$starttime));
			
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
			if($data["idno"]==""){
				   $data["idno"]="NO".newrand(12,1);
			}

		   if($id==""){
				 $userone=session("user");
				 $data["userid"]=$userone["id"];
				 $data["addtime"]=date("Y-m-d H:i:s");
				 $data["photo_zs"]="file/zs/".time().".png";
				 $id=$mod->data($data)->add();
		         $map["id"]=$id;
			     $info=$mod->where($map)->find();
				 if(is_file($info["photo_zs"])){
				    @unlink($info["photo_zs"]);
				 }
				 
				 $this->shengcheng_photo_zs($data);
				 
				 $this->showmessage('已添加'.$id,U($this->urldir.'/info/'),2);exit;
	
		   }else{
				$where["id"]=$id;
				
				$map["id"]=$id;
			     $info=$mod->where($map)->find();
				 if(is_file($info["photo_zs"])){
				    @unlink($info["photo_zs"]);
				 }
				$data["photo_zs"]="file/zs/".time().".png";
				$res=$mod->where($where)->save($data);
				$this->shengcheng_photo_zs($data);
				//exit();
				$this->showmessage('已更新'.$res.'条',U($this->urldir.'/info/',array("id"=>$id)),2);exit;
		  
		   }

		}
	   $this->info();
	}
	public function delete()
	{
		$id=I('get.id');
		if($id==""){$id=I('ids');}
		$user=D($this->tablename);
		$w["id"]=array("in",$id);
		$res= $user->where($w)->delete();
		$this->showmessage('已删除'.$res."条",U($this->urldir.'/index'),2);exit;
	
	
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
	
		$this->showmessage('已删除',U($this->urldir.'/index'),2);exit;
	
	}
	public function shengcheng_photo_zs($opt) {
							$path=APP_PATH;
							
							$fontpath=$path."lib/font/simsun.ttc";
							
							$imgbg=$path."lib/file/zs.gif";
							//$imgbg=iconv("UTF-8","GB2312",$imgbg);
							$obj=new \lib\Fileobject;
							$img_info = getimagesize($imgbg); 
							//var_dump($img_info);
							$newpath=$opt["photo_zs"];//保存的路径
							$contact=$opt["contact"];
							$weixin=$opt["weixin"];
							$startdate=$opt["startdate"];
							$enddate=$opt["enddate"];
							$idno=$opt["idno"];
							$dailidengji=$opt["dailidengji"];
							$index=0;
							$conf[$index]['pw']=$img_info[0];
							$conf[$index]['ph']=$img_info[1];	
							$conf[$index]['type']="img";
							$conf[$index]['info']=$imgbg;
							$conf[$index]['sx']=0;
							$conf[$index]['sy']=0;
							if($idno!=""){
								$index=$index+1;
								$conf[$index]['type']="txt";
								$conf[$index]['info']=$idno;
								$conf[$index]['sx']=436;
								$conf[$index]['sy']=516;
								$conf[$index]['fontsize']=15;
							}
							if($dailidengji!=""){
								$index=$index+1;
								$conf[$index]['type']="txt";
								$conf[$index]['info']=$dailidengji;
								$conf[$index]['sx']=338;
								$conf[$index]['sy']=839;
								$conf[$index]['fontsize']=30;
							}
							$index=$index+1;
							$conf[$index]['type']="txt";
							$conf[$index]['info']=$contact;
							$conf[$index]['sx']=495+20;
							$conf[$index]['sy']=611;
							$conf[$index]['fontsize']=30;
							$index=$index+1;
							$conf[$index]['type']="txt";
							$conf[$index]['info']=$weixin;
							$conf[$index]['sx']=545;
							$conf[$index]['sy']=672;
							$conf[$index]['fontsize']=30;
							$index=$index+1;
							$conf[$index]['type']="txt";
							$conf[$index]['info']=$startdate;
							$conf[$index]['sx']=568;
							$conf[$index]['sy']=940;
							$conf[$index]['fontsize']=30;
							$index=$index+1;
							$conf[$index]['type']="txt";
							$conf[$index]['info']=$enddate;
							$conf[$index]['sx']=568;
							$conf[$index]['sy']=1020;
							$conf[$index]['fontsize']=30;
                            //@unlink($newpath);
							$dir1=dirname($newpath);
							 if (!is_dir($dir1)){
									   @mkdir(iconv("UTF-8", "GBK", $dir1),0777,true); 
							 }
							$obj->get_haibao($conf,$newpath,$fontpath);
	}
}
?>
