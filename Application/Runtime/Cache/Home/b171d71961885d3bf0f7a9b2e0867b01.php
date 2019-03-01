<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title><?php echo ($webtitle); ?></title>
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<script language="javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
<script language="javascript" src="/Public/js/jquery.cookie.js"></script>
<script language="javascript" src="/Public/js/json2.js"></script>
<script language="javascript" src="/Public/layer-v2.3/layer/layer.js"></script>
<script language="javascript" src="/Public/js/func.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/home/css.css?1">
<link rel="stylesheet" type="text/css" href="/Public/css/public.css?1">
<style>
.curnav .amenu{font-size:30px; font-weight:bold; position:absolute; top:0px; right:0px; color:#ffffff; height:45px; line-height:50px; width:60px;display:block; text-align:center; cursor:pointer;}
.curnav .amenu:hover{ background-color:#0C9;}
.curnav .amenu:active{ background-color:#F90;}
.caidanbg{position:absolute; background-color:#000;top:0px;left:0px;opacity:0.8;filter:alpha(opacity=80);z-index:30000;}
.caidanleft{/* background-color:#FFF;filter:alpha(opacity=80);*background-color:#FFF;*/ background-color:transparent;}
.caidan{position:absolute;top:0px;right:0px;width:120px;overflow:hidden; z-index:30001;}
.caidan .rel{ position:relative; width:100%; height:auto;}
.caidan .rel .con{ height:auto;width:100%; height:auto; position:absolute;background-color:#000;}
.caidan .rel .con a{ color:#fff; font-size:15px; cursor:pointer;}
.caidan .rel .con ul{ list-style:none; margin:0px; padding:0px; width:100%;}
.caidan .rel .con ul li{ list-style:none; margin:0px; padding:10px;border-bottom:solid #000 1px; height:20px; line-height:20px; background-color:#0C9; /*margin:5px; border-left:solid #1BBC9B 2px;border-bottom:solid #000 2px;*/ padding-left:20px; }
.caidan .rel .con ul li.liclose{background-color:#F90;}
.caidan .rel .con ul li.litran{background-color:transparent; height:20px;}

.caidan .rel .con h1.username{ color:#FFFFFF; font-weight:bold; margin:0px; font-size:15px; text-align:center; border-bottom:solid #000 0px; margin-bottom:0px; padding-bottom:10px;}
.caidan .rel .con .inner{ position:relative; width:100%; height:100%;}
.metop .metop_touxiang{  overflow:hidden; height:80px; width:80px; position:absolute;  top:20px; z-index:2000; left:50%; margin-left:-40px;}
.metop .metop_touxiang div{overflow:hidden;height:80px; width:80px;background-color:#8bf98b; background-color:#1BBC9B; border-radius:41px; -webkit-border-radius:41px;}
.metop .metop_touxiang i{ display:block; height:70px; width:70px; overflow:hidden; margin-top:20px; margin-left:auto; margin-right:auto; }
.metop .metop_touxiang i span{ display:block; width:100%; height:70px;overflow:hidden;background-size:100% auto;background-position:center top; background-repeat:no-repeat;background-image:url("/Public/images/user.png");}
.btback{margin:3px; width:100px; display:block; margin-left:auto; margin-right:auto;font-family: "微软雅黑"; list-style:none; cursor:pointer; padding:0px;vertical-align:middle; font-size:14px; text-align:center; line-height:13px;padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px; overflow:hidden;  border:solid 1px #099; color:#FFFFFF; overflow:hidden;  background-color:#1BBC9B;border-radius:4px;-ms-border-radius:4px;-wekit-border-radius:4px; }

</style>
<!--[if IE 6]>
<style>
.metop .metop_touxiang i span{background-image:url("/Public/home/images/user.gif");}
</style>
<![endif]-->
<!--[if IE 7]>
<style>
.metop .metop_touxiang i span{background-image:url("/Public/home/images/user.gif");}
</style>
<![endif]-->
<!--[if IE 8]>
<style>
.metop .metop_touxiang i span{background-image:url("/Public/home/images/user.gif");}
</style>
<![endif]-->
<script>
var conf={
	yes_src:"/Public/home/images/yes.png",
	error_src:"/Public/home/images/error.png",
	action:"/index.php/Home/User/login",
	app:"/index.php",
	url:"/index.php/Home/User",
	module:"<?php echo C('DEFAULT_MODULE');?>",
	controller:"<?php echo C(DEFAULT_CONTROLLER);?>",
	classid:"<?php echo ($data['classid']); ?>",
	kemu:"<?php echo ($data['kemu']); ?>",
	table:"<?php echo ($table); ?>",
	root:"",
	laiyuan:"<?php echo ($laiyuan); ?>",
	public:"/Public"
	
}
loadimg(conf.error_src);
loadimg(conf.yes_src);
function loadimg(src){
	var img=document.createElement("img");
	img.src=src;
}

//网站技术支持QQ 632175205 
window.g_lang="<?php echo ($lang); ?>";
window.g_act="<?php echo ($act); ?>";
window.userid="<?php echo ($_SESSION['userq']['id']); ?>";
window.app_url="/index.php";
window.g_actionurl="/index.php/Home/User/login";
var g_isapp=0;
var c1c = 0;
var username="<?php echo ($_SESSION['userq']['username']); ?>";
var usertx="<?php echo ($_SESSION['userq']['photo']); ?>";
var cururl=String(window.location);
	  try{
		   window.uexOnload = function(type){
			  g_isapp=1; 
			  var arr=cururl.split("index.php");
			  if(cururl.indexOf(conf.app+"/"+conf.module+"/login")!=-1){
					  uexWindow.setReportKey(0,1);
					  uexWindow.setReportKey(1,1);
					  uexWindow.onKeyPressed = function(keyCode){ 
						if(keyCode==0){ //返回键
						  if (c1c > 0) {
							  uexWidgetOne.exit();
						  }else{
							  uexWindow.toast(0, 5, '再按一次退出应用', 1000); 
							  c1c=1; setTimeout(function(){ c1c=0; }, 1000);
						  }
						}
					  }
			  }
		   }
	   }catch(err){
		   // alert(err.message);
      }
</script>
<script src="/Public/home/caidan.js"></script>


<style>
*{ font-family:"微软雅黑"}
.table_login{ mmbackground-color:#CCC; width:300px;}
.table_login th{ mmmbackground-color:#CCC}
.table_login td{ mmbackground-color:#FFF}
.table_login .td1{ color:#fff;}
.txt{ padding:15px; width:260px; border:solid #099 1px;}
.mytitle{font-size:30px; text-align:center; height:auto; overflow:hidden; color:#fff; margin:10px; border-bottom:#77f4d5 solid 2px; padding-top:30px; padding-bottom:30px; margin-bottom:30px; }
.mytitle h1{ margin:0px;}
.btsend{ height:50px; width:120px; cursor:pointer; background-color:#099; color:#FFFFFF; border:0px;}
html{background-color:#0C9; background-attachment:fixed; background-color:#1BBC9B; height:100%; background-image:url(/Public/home/images/che.png);_background-image:url(/Public/home/images/che.gif); background-repeat:no-repeat; background-position:right bottom;}
.pline a{ padding:5px; color:#666; background-color:#FFFFFF}
</style>
</head>
<body>
<div class="mytitle">驾校会员登录</div>
  <form id="form1" name="form1" method="post" onsubmit="return check();">
  <table width="100%" border="0" cellspacing="1" cellpadding="10" class="table_login" align="center">
    <tr>
      <td colspan="2"><input type="text" name="username" id="username"  class="txt" title="请输入帐号ID" placeholder="请输入帐号ID"/></td>
    </tr>
    <tr>
      <td colspan="2"> <input type="password" name="userpwd" id="userpwd" class="txt" title="请输入帐号ID"  placeholder="请输入帐号密码" /></td>
    </tr>
    <tr>
      <td align="left"><input type="reset" name="button2" id="button2" value="重置"  class="btsend" />
        </td>
      <td align="right"><input type="submit" name="button" id="button" class="btsend" value="登陆" /></td>
      </tr>
  </table>
  </form>
  <p style="padding:10px; text-align:center;" class="pline"><a href="<?php echo U('user/zhaohuimima',array('type'=>'email'));?>">邮箱找回密码</a><a href="<?php echo U('user/zhaohuimima');?>">短信找回密码</a><a href="<?php echo U('user/reg');?>">新用户注册</a></p>
<script>
function check(){
	if($("#username").val()==""){
		alert("请输入帐号");
		$("#username").focus();
		return false;
	}
	if($("#userpwd").val()==""){
		alert("请输入帐号密码");
		$("#userpwd").focus();
		return false;
	}
	return true;
}
</script>
</body>
</html>