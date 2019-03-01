<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="chezi" style="background:#ffffff;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($web["title"]); ?></title>
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/jquery-1.8.3.min.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/jquery.cookie.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/json2.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/layer-v2.3/layer/layer.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/func.js"></script>
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/home/css.css?1">
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/css/public.css?1">
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
.metop .metop_touxiang i span{ display:block; width:100%; height:70px;overflow:hidden;background-size:100% auto;background-position:center top; background-repeat:no-repeat;background-image:url("data:image/png;base64,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");}
.btback{margin:3px; width:100px; display:block; margin-left:auto; margin-right:auto;font-family: "微软雅黑"; list-style:none; cursor:pointer; padding:0px;vertical-align:middle; font-size:14px; text-align:center; line-height:13px;padding-top:10px; padding-bottom:10px; padding-left:10px; padding-right:10px; overflow:hidden;  border:solid 1px #099; color:#FFFFFF; overflow:hidden;  background-color:#1BBC9B;border-radius:4px;-ms-border-radius:4px;-wekit-border-radius:4px; }

</style>
<!--[if IE 6]>
<style>
.metop .metop_touxiang i span{background-image:url("/phpsite/hc/kaoti/kaoti20170406/Public/home/images/user.gif");}
</style>
<![endif]-->
<!--[if IE 7]>
<style>
.metop .metop_touxiang i span{background-image:url("/phpsite/hc/kaoti/kaoti20170406/Public/home/images/user.gif");}
</style>
<![endif]-->
<!--[if IE 8]>
<style>
.metop .metop_touxiang i span{background-image:url("/phpsite/hc/kaoti/kaoti20170406/Public/home/images/user.gif");}
</style>
<![endif]-->
<script>
var conf={
	yes_src:"/phpsite/hc/kaoti/kaoti20170406/Public/home/images/yes.png",
	error_src:"/phpsite/hc/kaoti/kaoti20170406/Public/home/images/error.png",
	action:"/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pclass",
	app:"/phpsite/hc/kaoti/kaoti20170406/index.php",
	url:"/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop",
	module:"<?php echo C('DEFAULT_MODULE');?>",
	controller:"<?php echo C(DEFAULT_CONTROLLER);?>",
	classid:"<?php echo ($data['classid']); ?>",
	kemu:"<?php echo ($data['kemu']); ?>",
	table:"<?php echo ($table); ?>",
	root:"/phpsite/hc/kaoti/kaoti20170406",
	laiyuan:"<?php echo ($laiyuan); ?>",
	public:"/phpsite/hc/kaoti/kaoti20170406/Public"
	
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
window.app_url="/phpsite/hc/kaoti/kaoti20170406/index.php";
window.g_actionurl="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pclass";
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
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/home/caidan.js"></script>


<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/home/shop.css?1">
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/home/func.js"></script>
</head>
<body>
<div class="mybody">

<div class="curnav" id="curnav" style="position:absolute; top:0px; left:0px; z-index:1000"><div><a  class="back" href="<?php echo ($backurl); ?>"><em>d</em></a><center><a class="aurl" href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/home/djid/<?php echo ($dianjia["id"]); ?>"><?php echo ($web["title"]); ?></a></center><a class="amenu">≡</a></div></div>

<div id="subnav" class="subnav"  style="position:absolute; top:45px; left:0px; z-index:1000;">
         <div  class="w800 rel">
			 <div class="inner">
			   <div class="con"><span class="tit">店家商品分类</span></div>
			 </div>
		 </div>
</div>

<div class="mymain" style="position:absolute; left:0px; top:96px; width:100%;">
 <div class="w800 inner">
  <div id="pclasslist" class="pclasslist">
   <?php if(is_array($list)): foreach($list as $key=>$row): ?><div class="item" data-id="<?php echo ($row["id"]); ?>">
	 <a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/plists/djid/<?php echo ($row["dianjiaid"]); ?>/djclassid/<?php echo ($row["id"]); ?>" class="aurl">
	 <div  class="rel">
	    <div class="left"> 
	     <div class="photo"><img data-src="/phpsite/hc/kaoti/kaoti20170406/<?php echo ($row["photo"]); ?>" src="/phpsite/hc/kaoti/kaoti20170406/Public/images/logo.gif"/></div>
		</div>
        <div class="right">  
		  	    <div class="title"><?php echo ($row["title"]); ?></div>
		        <div class="num"><span class="s1">共"<?php echo ($row["productnum"]); ?>"件商品</span><span class="s2">&gt;</span></div>
		</div>
	 </div>
	 </a>
	 </div><?php endforeach; endif; ?>
    <?php if(empty($list)): ?><div class="divnull">找不到店家商品分类</div><?php endif; ?>
	<div class="pagenav"><?php echo ($show); ?></div>
	<script>
     init_show_img({objs:$("#plist img")});
	</script>
  </div>
</div>
</div>
</div>
<script>
$(window).resize(function(){
    resize_h_scroll({id:"pclass"});
});
resize_h_scroll({id:"pclass"});
show_hide_daohang({id1:"curnav",id2:"subnav"});

//$.cookie("currentMenuID", "menuID", { path: "/"}); 
//var weburl="/phpsite/hc/kaoti/kaoti20170406";//右键查看网页源码，你会看出这个有值，有关 thinkphp 常量：http://document.thinkphp.cn/manual_3_2.html#const_reference
</script>
</body>
</html>