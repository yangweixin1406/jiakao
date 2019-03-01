<?php
namespace Home\Controller;
use Think\Controller;
class AjaxController extends Controller {

	public function getcode(){
		$Verify =     new \Think\Verify();
		// 开启验证码背景图片功能 随机使用 ThinkPHP/Library/Think/Verify/bgs 目录下面的图片
		$Verify->codeSet = '0123456789'; 
		$Verify->fontSize = 100;
		$Verify->length   = 4;
		$Verify->useImgBg = true; 
		$Verify->entry();
	}

	public function userinfo(){
		$userone=session("userq");
		  if(!$userone||$userone["root"]!=0){
			$userid=trim($userone["id"]);
			$user=D("user");
			$usermap["id"]=array("eq",$userid);
			$user_row=$user->where($usermap)->find();
			if($user_row){
				$this->assign('userinfo',$userone);
			}
		  }
	}
	public function close(){
		 session("userq",null);
         $this->display("login");
	}
	public function getsmscode(){
	
	      $smscode=newrand(6);
		  $phone=I("phone");
		  session("smscode",$phone."|".$smscode);
		  $mod=M("setting");
		  $map["setting_key"]="sms";
		  $one=$mod->where($map)->find();
		  $setting_value=unserialize(base64_decode($one['setting_value']));
		  $url=$setting_value["url"];
		  $data=$setting_value["urlcs"];
		  $content2=$setting_value["content2"];
		  $content2=str_replace("{code}",$smscode,$data);
		  $data=str_replace("{content}",$content2,$data);
		  $data=str_replace("{phone}",$phone,$data);
		  $charset=$setting_value["charset"];
		  if(strtolower($charset)=="gb2312"){
		    $data=iconv("UTF-8", "gb2312" , $data); 
		  }
		  if($setting_value["type"]=="get"){
		      if(strpos($url,"?")===false){
		        httprequest($url."?".$data,"");
			  }else{
			    httprequest($url.$data,"");
			  }
		  }else{
		      httprequest($url,$data);
		  }
		  //exit($smscode);
	}
	public function getemailcode(){
	      $emailcode=newrand(6);
		  $email=I("post.email");
		  session("emailcode",$email."|".$emailcode);
		  $mod=M("setting");
		  $map["setting_key"]="email";
		  $one=$mod->where($map)->find();
		  $setting_value=unserialize(base64_decode($one['setting_value']));
		  $title2=$setting_value["title2"];
		  $title2=str_replace("{code}",$emailcode,$title2);
		  $content2=$setting_value["content2"];
		  $content2=str_replace("{code}",$emailcode,$content2);
		  $title="你的注册验证码是：".$emailcode;
		  $data["smtpserver"]=$setting_value["smtpserver"];
		  $data["smtpserverport"]=$setting_value["smtpserverport"];
		  $data["smtpuser"]=$setting_value["smtpuser"];
		  $data["smtppass"]=$setting_value["smtppass"];
		  $data["smtpsecure"]=$setting_value["smtpsecure"];
		  $data["title"]=$title2;
		  $data["content"]=$content2;
		  $data["to"]=$email;
		  sendemail_a($data);
	}
	
}
?>

