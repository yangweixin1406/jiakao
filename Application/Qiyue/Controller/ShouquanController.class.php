<?php
namespace Qiyue\Controller;
use Think\Controller;
class ShouquanController extends CommQiyueController{
   public $tablename="shouquan";
    public function index(){
	      $this->find();
    }
    public function info(){
	      $f=I("get.f");
		  $info["webtitle"]="授权查询";
		  if($f!=""){
		      $filepath="file_tmp/".$f.".png";
			  if(is_file($filepath)){
			       $info["src"]=$filepath;
		           $this->assign('info',$info);
	               $this->display('find_success'); 
			  }else{
			     $this->find();
			  }
	          
		  }else{
		     $this->find();
		  }
    }
  public function find(){
           $info["webtitle"]="授权查询";
           $path=dirname(dirname(dirname(__FILE__)));
		   header("Content-Type: text/html; charset=UTF-8") ;
		if($_POST){
			     $mod=D("shouquan");
				 $key=trim(I("key"));
                if($key!=""){
						$wh['_string'] = " (contact = '{$key}')  OR ( weixin = '{$key}') OR ( phone = '{$key}') ";
						
						$one=$mod->where($wh)->field("*")->find();
		
						if(is_array($one)){
									//$path="Application/";
		
									$info["src"]=$one["photo_zs"];
									$this->assign('info',$info);
									$this->display('find_success'); 
						}else{
						   
							$this->assign('info',$info);
							$this->display('find'); 
							echo "<script>alert('抱歉，经查询，谷禾灵并没有此代理商，请注意！');</script>";
						}
				}else{
				  
				   $this->display('find'); 
				   echo "<script>alert('请输入关键词');</script>";
				}
		}else{
		    $this->assign('info',$info);
	        $this->display('find'); 
	   }
  }
}
?>