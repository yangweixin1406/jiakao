<?php
namespace Admin\Controller;
use Think\Controller;
class UploadController extends CommController {
public $tablename="content";
public $fatherid="00010005";
public $urldir="Admin/content";
public $lang="文章";
public function index()
{
	  $mod=D($this->tablename);
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign("lang",$this->lang);
	  //$this->view('index');
	  $this->assign("folder",I("folder"));
	  $this->assign("ObjId",I("ObjId"));
	  $this->assign("quan",I("quan"));
	   $this->display("index");
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
	$this->assign("folder",I("folder"));
	$this->assign("quan",I("quan"));
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
	if ($_SERVER['REQUEST_METHOD'] == 'POST')
	{
			$quan=$_REQUEST['quan'];
			$folder=$_REQUEST['folder'].date("Ym")."/";
			if(!is_dir($quan.$folder)){
			   mkdir($quan.$folder,0777);
			 }

			$file = $_FILES["upfile"];
			$filename=$file["tmp_name"];
			$image_size = getimagesize($filename); 
			$pinfo=pathinfo($file["name"]);
			$ftype=strtolower($pinfo["extension"]);
			$path=$quan.$folder;
			$pathN=$folder."/";
			$qianName=time().rand(5, 15);
			 
			$pathfile=$quan.$folder.$qianName.".".$ftype;
			 
			$pathfile_n=$folder.$qianName.".".$ftype;
			 if(move_uploaded_file($filename, $pathfile)){
			     $this->assign("pathfile",$pathfile);
				 $this->index();
			 }

	}
   
}


}
