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
	action:"/phpsite/hc/kaoti/kaoti20170406/index.php/User/Orders/lists",
	app:"/phpsite/hc/kaoti/kaoti20170406/index.php",
	url:"/phpsite/hc/kaoti/kaoti20170406/index.php/User/Orders",
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
window.g_actionurl="/phpsite/hc/kaoti/kaoti20170406/index.php/User/Orders/lists";
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
 .clear{ width:100%; clear:both;}
 .ul_olist{ list-style:none; margin:0px; padding:0px; width:100%;}
 .ul_olist .lia{ list-style:none; margin:0px; padding:0px; width:100%; margin-bottom:10px; background-color:#FFFFFF;}
 .ul_olist .lia .row1{padding:10px; overflow:hidden;}
 .ul_olist .lia  a{ color:#000;}
 .ul_olist .lia .row1 .l i{ font-size:15px; color:#FF3366; color:#1BBC9B; margin-right:5px;}
 .ul_olist .lia .row2{ padding:10px; padding-top:2px; padding-bottom:2px; background-color:#f4f4f4; border:solid 1px #FFFFFF;}
 .ul_olist .lia .row3{  padding:10px;border-bottom:solid #f4f4f4 1px; text-align:right; color:#000000;}
 .ul_olist .lia .row4{ padding:10px; text-align:right;}
 .ul_olist .lia .row4 .btdel{ border:solid 1px #666; border-radius:5px; overflow:hidden; padding:4px;color:#666;}
 .ul_olist .lia .row4 .btpingjia{ border:solid 1px #FF6633; border-radius:5px; overflow:hidden; padding:4px; color:#FF6633;}
 .ul_olist .lia .otable{ margin:0px; padding:0px; width:100%;}
 .ul_olist .lia .otable td{padding-top:2px;padding-bottom:2px;}
 .ul_olist .lia .otable .td1{ width:80px; text-align:center; overflow:hidden; height:auto; }
 .ul_olist .lia .otable .td1 img{ width:80px;}
 .ul_olist .lia .otable .td2{ width:auto; padding-left:10px; padding-right:10px;}
 .ul_olist .lia .otable .td2 .option{color:#999999}
 .ul_olist .lia .otable .td3{ width:60px; text-align:right; white-space:nowrap;}
 .ul_olist .lia .l{ float:left;}
 .ul_olist .lia .r{ float:right;}
 .ul_olist .lia .apro{ color:#051826;}
 .ul_olist .lia .status{ color:#FF6633}
 
 .divnull .yuan{ margin-left:auto; display:block;margin-right:auto; height:100px; width:100px; border-radius:50px;box-shadow:0px 0px 1px 1px #666 inset; line-height:100px;}
</style>
</head>
<body>
<div class="mybody">
<div class="curnav"><a  class="back" href="<?php echo U(MODULE_NAME.'/index/index') ?>"><em>d</em></a><center><?php echo ($web["title"]); ?></center><a class="amenu">≡</a></div>
<div class="mymain" >

			 <ul class="ul_olist" id="list">
			 <?php if(is_array($list)): foreach($list as $key=>$value): ?><li class="lia">
			       <div class="row1">
				    <span class="l">
					<?php if(($value["type"] == 1)): ?><i class="fa  fa-shopping-bag"></i><a href="<?php echo U('Wap/shop/home/',array('djid'=>$value[dianjiaid]));?>" class="btpingjia"><?php echo ($value["shopname"]); ?></a>
					<?php elseif($value["type"] == 2): ?>
					  在线充值
					<?php else: ?>
					  提现<?php endif; ?>
					
					</span>
				    <span class="r"><span class="status status_<?php echo ($value["status"]); ?>"><?php echo ($value["status_caption"]); ?></span></span><div class="clear"></div>
				   </div>
				    <?php if(!empty($value["details"])): ?><div class="row2"> 
				     <table class="otable" border="0" cellpadding="0" cellspacing="0">
				     <?php if(is_array($value["details"])): foreach($value["details"] as $key=>$row1): ?><tr>
						   <td class="td1" valign="top"><a href="<?php echo U('Wap/shop/pdetail/',array('id'=>$row1[productid]));?>"><img src="/phpsite/hc/kaoti/kaoti20170406/<?php echo ($row1["photo"]); ?>"/></a></td>
						   <td class="td2" valign="top"><a href="<?php echo U('Wap/shop/pdetail/',array('id'=>$row1[productid]));?>" class="apro"><?php echo ($row1["title"]); ?></a><div class="option">22</div></td>
						   <td class="td3" valign="top"><strong>￥<?php echo ($row1["price"]); ?></strong><br/><span>×<?php echo ($row1["num"]); ?></span></td>
						  </tr><?php endforeach; endif; ?>
					  </table>
				   </div><?php endif; ?>
				   <div class="row3">共<?php echo ($value["num"]); ?>件商品&nbsp;&nbsp;合计:<strong>￥<?php echo ($value["total"]); ?></strong>&nbsp;&nbsp;含运费<strong>(￥<?php echo ($value["fare"]); ?>)</strong></div>
				   <div class="row4">
				    <span class="l"></span><span class="r"><a href="<?php echo U('del',array('id'=>$value[id]));?>" class="btdel">删除订单</a>&nbsp;
					<?php if(($value["type"] == 1 and $value["status"] != -1)): ?><a href="#" class="btpingjia">评价</a>
					<?php else: endif; ?>
					</span>
				   <div class="clear"></div>
				   </div>
			   </li><?php endforeach; endif; ?>
			 </ul>
			 <?php if(empty($list)): ?><div class="divnull"><span class="yuan">&nbsp;</span><p>找不到订单</p></div><?php endif; ?>
			 <?php if(($pagenum > 1)): ?><div style="height:46px;width:100%;"><?php echo ($pagenum); ?></div>
             <div class="pagenav" style="position:fixed; bottom:0px; left:0px; width:100%; background-color:#FFFFFF; margin:0px; padding-top:5px; padding-bottom:5px;"><?php echo ($show); ?></div><?php endif; ?>


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
<style>
</style>
<script>
//网站技术支持QQ 632175205 
var mybody_b=$(".mybody_b");
var mymain=$("#mymain");
//mybody_b.css({height:$(window).height()+"px",width:$(window).width()+"px"});
var scale_maxvalue=1;
var scale_curvalue=0;
var touch =("createTouch" in document); 
if($.browser.msie) { 
//mybody_b.css({"height":"1px","display":"","overflow":"hidden","position":"relative"});
//mybody_b.animate({"height":$(window).height()+"px"},function(){mybody_b.css({"overflow":"auto"});});

mybody_b.css({"filter":"alpha(opacity=0)","opacity":"0","display":"","overflow":"hidden","position":"relative","width":"100%"});
window.timer_scale=window.setInterval(function(){
	if(scale_curvalue<1){
	   scale_curvalue+=0.1;
	   if(scale_curvalue>scale_maxvalue){
		   scale_curvalue=scale_maxvalue;
	   }
	   mybody_b.css({"filter":"alpha(opacity="+scale_curvalue*100+")","opacity":scale_curvalue});
	}else{
	   scale_curvalue=scale_maxvalue;
	    mybody_b.css({"filter":"alpha(opacity="+scale_curvalue*100+")","opacity":scale_curvalue});
  	    window.clearInterval(window.timer_scale);	
  }
  
},50);
}else{
  if($(".myleft").length<=0&&!touch){
			mybody_b.css({"transform":"scale(0)","-webkit-transform":"scale(0)","-moz-transform":"scale(0)","-ms-transform":"scale(0)","display":"","overflow":"hidden"});
			window.timer_scale=window.setInterval(function(){
				if(scale_curvalue<1){
				   scale_curvalue+=0.1;
				   if(scale_curvalue>scale_maxvalue){
					   scale_curvalue=scale_maxvalue;
				   }
				   mybody_b.css({"transform":"scale("+scale_curvalue+")","-webkit-transform":"scale("+scale_curvalue+")","-moz-transform":"scale("+scale_curvalue+")","-ms-transform":"scale("+scale_curvalue+")"});
				}else{
				   scale_curvalue=scale_maxvalue;
					$(".myleft_inner_con").css({"display":"","float":"left"});
					mybody_b.css({"transform":"scale(1)","-webkit-transform":"scale(1)","-moz-transform":"scale(1)","-ms-transform":"scale(1)"});
					window.clearInterval(window.timer_scale);
					// $(".myleft_inner_con").css({"float":"left"});	
					mybody_b.css({"width":"100%"});
			  }
			},80);
  }else{
	  mybody_b.css({"display":"","overflow":"hidden","position":"relative","width":"100%"});
  }
 
}
	if(window.attachEvent){
		  window.attachEvent('onscroll',function(){getwh();});
		  window.attachEvent('onresize',function(){getwh();});
	}else{
		  window.addEventListener("scroll",function(){getwh();}, false );
		  window.addEventListener("resize",function(){getwh();}, false );
	 }
	 getwh();
	function getwh(){
	  var t=this;
	  	var curnav_height=$(".curnav").height();
	  window.scrollHeight=document.documentElement.scrollHeight||document.body.scrollHeight;	
	  window.scrollWidth=document.documentElement.scrollWidth||document.body.scrollWidth;
	  window.clientHeight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
	  window.clientWidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
	  window.scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	  window.scrollLeft=document.documentElement.scrollLeft||document.body.scrollLeft; 
		if ( document.compatMode!="CSS1Compat" ){
		  //alert("本文档未添加W3C的声明")
		    if(document.body){
		        window.clientHeight=document.body.clientHeight;
				window.scrollHeight=document.body.scrollHeight;
			}else{
				window.clientHeight=document.documentElement.clientHeight;
				window.scrollHeight=document.documentElement.scrollHeight;
			}
		 
		}
		
		var exam_menu_h=window.clientHeight-curnav_height-20;
		$("#exam_menu").css({"height":exam_menu_h+"px","overflow":"auto"});
		mybody_b.css({"height":window.clientHeight+"px","overflow":"hidden"});
		mymain.css({"height":(window.clientHeight-curnav_height)+"px","overflow-x":"hidden","overflow-y":"auto"});
		$("#listscontent").css({"height":(window.clientHeight-curnav_height)+"px"});
	}
</script>
</body>
</html>