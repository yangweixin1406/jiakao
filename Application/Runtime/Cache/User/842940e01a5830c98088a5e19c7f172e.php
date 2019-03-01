<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($web["title"]); ?></title>
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/jquery-1.8.3.min.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/jquery.cookie.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/json2.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/layer-v2.3/layer/layer.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/func.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/mycheck.js"></script>
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/<?php echo MODULE_NAME ?>/css.css?1">
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/css/public.css?1">
<link rel="stylesheet" href="/phpsite/hc/kaoti/kaoti20170406/Public/font-awesome-4.7.0/css/font-awesome.min.css" media="screen"/>
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
.metop .metop_touxiang i span{ display:block; width:100%; height:70px;overflow:hidden;background-size:100% auto;background-position:center top; background-repeat:no-repeat;background-image:url("/phpsite/hc/kaoti/kaoti20170406/Public/images/user.png");}
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
	action:"/phpsite/hc/kaoti/kaoti20170406/index.php/User/Index/index",
	app:"/phpsite/hc/kaoti/kaoti20170406/index.php",
	url:"/phpsite/hc/kaoti/kaoti20170406/index.php/User/Index",
	module:"<?php echo MODULE_NAME;?>",
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
window.g_actionurl="/phpsite/hc/kaoti/kaoti20170406/index.php/User/Index/index";
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
function myalert(str){
  if(layer){
  layer.msg(str,{time:1000});
  }else{
   alert(str);
  }
}
</script>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/home/caidan.js"></script>



<style>
 html{ background-color:#f4f4f4;}
.ulmenu{ list-style:none; margin:0px; padding:0px; width:100%; height:auto;}
.ulmenu li{ list-style:none; margin:0px; padding:0px; width:25%; float:left; text-align:center; margin-bottom:15px;}
.ulmenu li i{ display:block; height:50px; width:50px;---box-shadow:0px 0px 0px 1px #666666 inset; border-radius:25px; clear:both; font-style:normal; margin-left:auto; margin-right:auto;  font-size:30px; line-height:50px; color:#666666;}
.ulmenu li a{ color:#666666;}

.ulmenu_orders{ list-style:none; margin:0px; padding:0px; width:100%; height:auto;}
.ulmenu_orders li{ list-style:none; margin:0px; padding:0px; width:20%; float:left; text-align:center; margin-bottom:15px;}
.ulmenu_orders li i{ display:block; height:50px; width:50px; border-radius:25px; clear:both; font-style:normal; margin-left:auto; margin-right:auto;  font-size:30px; line-height:50px; color:#666666;}
.ulmenu_orders li a{ color:#666666;}

.menuline{ background-color:#FFFFFF; margin-bottom:28px;}
.menutitle{border-radius:3px; padding:10px; color:#000; margin-bottom:10px; clear:both; border-bottom:solid 2px #f4f4f4; height:auto; overflow:hidden;}
.menutitle .l{ float:left;}
.menutitle .r{ float:right;}
.clear{ width:100%; clear:both;}
</style>
</head>
<body>
<div class="mybody">
<div class="curnav"><a  class="back" href="/phpsite/hc/kaoti/kaoti20170406/index.php"><em>d</em></a><center><?php echo ($web["title"]); ?></center><a class="amenu">≡</a></div>
<div class="mymain" >

<div class="menuline">
 <div class="menutitle"><span class="l">我的订单</span><span class="r">查看更多订单</span></div>
 <ul class="ulmenu_orders">
    <li><a href="<?php echo U('uorders/lists/',array('data'=>'now'));?>"><i class="fa fa-file-text-o"></i><span>今日订单</span></a></li>
	<li><a href="<?php echo U('uorders/lists/',array('data'=>'zuori'));?>"><i class="fa fa-file-text-o"></i><span>昨日订单</span></a></li>
	<li><a href="<?php echo U('uorders/lists/',array('status'=>'notpay'));?>"><i class="fa fa-file-text-o"></i><span>未付款</span></a></li>
	<li><a href="<?php echo U('uorders/lists/',array('status'=>'okpay'));?>"><i class="fa fa-file-text-o"></i><span>已付款</span></a></li>
	<li><a href="<?php echo U('uorders/lists/',array('status'=>'1'));?>"><i class="fa fa-file-text-o"></i><span>已完成</span></a></li>
 </ul>
 <div class="clear"></div>
</div>
<div class="menuline">
 <div style="border-radius:3px; padding:10px; color:#000; margin-bottom:10px; clear:both; border-bottom:solid 2px #f4f4f4">买家功能</div>
 <ul class="ulmenu">

	<li><a href="<?php echo U('user/my');?>"><i class="fa fa-drivers-license-o"></i><span>我的资料</span></a></li>
	<li><a href="<?php echo U('ufavorites/lists');?>"><i class="fa fa-star-o"></i><span>我的收藏</span></a></li>
	<li><a href="<?php echo U('uaddress/lists');?>"><i class="fa fa-map"></i><span>收货地址</span></a></li>
	<li><a href="<?php echo U('user/pwd');?>"><i class="fa fa-lock"></i><span>密码修改</span></a></li>
	<li><a href="<?php echo U('user/email');?>"><i class="fa fa-at"></i><span>邮箱绑定</span></a></li>
	<li><a href="<?php echo U('user/touxiang');?>"><i class="fa fa-user-circle-o"></i><span>我的头像</span></a></li>
	<li><a href="<?php echo U('user/money');?>"><i class="fa fa-rmb"></i><span>钱包</span></a></li>
	<li><a href="<?php echo U('user/chongzhi');?>"><i class="fa fa-plus"></i><span>在线充值</span></a></li>
	<li><a href="<?php echo U('user/photo');?>"><i class="fa fa-image"></i><span>我的相册</span></a></li>
	<li><a href="<?php echo U('user/chongzhi');?>"><i class="fa fa-ellipsis-h"></i><span>支付记录</span></a></li>
	<li><a href="<?php echo U('uzuji/lists');?>"><i class="fa fa-object-group"></i><span>我的足迹</span></a></li>
	<li><a href="<?php echo U('user/chongzhi');?>"><i class="fa fa-money"></i><span>我的金币</span></a></li>
	<li><a href="<?php echo U('user/chongzhi');?>"><i class="fa fa-credit-card-alt"></i><span>优惠卡</span></a></li>
	<li><a href="<?php echo U('user/chongzhi');?>"><i class="fa fa-heart"></i><span>商品评价</span></a></li>
	<li><a href="<?php echo U('user/close');?>"><i class="fa fa-sign-out"></i><span>退出</span></a></li>
	
 </ul>
 <div class="clear"></div>
</div>
<div class="menuline">
 <div style="border-radius:3px; padding:10px; color:#000; margin-bottom:10px; clear:both;border-bottom:solid 2px #f4f4f4">店家功能</div>
 <ul class="ulmenu">
    <li><a href="<?php echo U('user/orders');?>"><i class="fa fa-server"></i><span>订单列表</span></a></li>
	<li><a href="<?php echo U('user/my');?>"><i class="fa fa-delicious"></i><span>商品管理</span></a></li>
	<li><a href="<?php echo U('user/favo');?>"><i class="fa fa-facebook"></i><span>商品分类</span></a></li>
	<li><a href="<?php echo U('user/address');?>"><i class="fa fa-volume-up"></i><span>公告中心</span></a></li>
	<li><a href="<?php echo U('user/pwd');?>"><i class="fa fa-wheelchair"></i><span>联系我们</span></a></li>
	<li><a href="<?php echo U('user/email');?>"><i class="fa fa-camera-retro"></i><span>店家相册</span></a></li>
	<li><a href="<?php echo U('user/email');?>"><i class="fa fa-camera-retro"></i><span>广告管理</span></a></li>
	<li><a href="<?php echo U('user/touxiang');?>"><i class="fa fa-cloud"></i><span>预约管理</span></a></li>
	<li><a href="<?php echo U('user/money');?>"><i class="fa fa-envelope"></i><span>留言管理</span></a></li>
	<li><a href="<?php echo U('user/chongzhi');?>"><i class="fa fa-vcard-o"></i><span>关于我们</span></a></li>
	<li><a href="<?php echo U('user/chongzhi');?>"><i class="fa fa-envira"></i><span>品牌管理</span></a></li>
  </ul>
  <div class="clear"></div>
</div>

</div>
</div>
</div>
<script>
//网站技术支持QQ 632175205 
$(".ul_menusub2").css({"display":""});
$(".ul_menu").each(function(){
	$(this).find(".subtitle1").click(function(){
		var ul=$(this).siblings("ul");
		$(".ul_menusub1").each(function(){
			if($(this)[0]!=ul[0]){
				$(this).slideUp();
			}
		});
		//$(".ul_menusub").slideUp();
		//$(".ul_menusub").slideToggle();
		ul.slideToggle();
	});

//	$(this).find(".subtitle2").click(function(){
//		var parent=$(this).parent();
//		var ul=$(this).siblings("ul");
//		parent.parent().find("ul").not(ul).slideUp();
//		ul.slideToggle();
//	});
});

</script>
</body>
</html>


<script>

//$.cookie("currentMenuID", "menuID", { path: "/"}); 
var weburl="/phpsite/hc/kaoti/kaoti20170406";//右键查看网页源码，你会看出这个有值，有关 thinkphp 常量：http://document.thinkphp.cn/manual_3_2.html#const_reference

</script>