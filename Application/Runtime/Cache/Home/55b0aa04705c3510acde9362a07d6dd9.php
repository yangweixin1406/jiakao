<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="chezi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	action:"/index.php/Home/Exam1/class1",
	app:"/index.php",
	url:"/index.php/Home/Exam1",
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
window.g_actionurl="/index.php/Home/Exam1/class1";
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
  .mymain{ width:1000px; margin-left:auto; margin-right:auto; margin-top:20px; height:auto; overflow:hidden;}
  .ul_menu_class1{ list-style:none; margin:0px; padding:0px;}
  .ul_menu_class1 li{ list-style:none; margin:0px; padding:0px;}
  .ul_menu_class1 li{ width:25%; float:left; padding-top:20px; padding-bottom:20px;}
  .ul_menu_class1 li .item{height:90px; margin-bottom:10px;/*background-color: #099; */ width:80%; margin-left:auto; margin-right:auto;}
  .ul_menu_class1 li .item .rel{ height:100%; width:100%; position:relative;}
  .ul_menu_class1 li .item .photo{_border:solid #666 1px;*border:solid #666; height:80px; width:80px; background-color:#FFFFFF; background-color:rgba(255,255,255,0.7); margin-left:auto; margin-right:auto; border-radius:40px; box-shadow:0px 0px 1px 1px #666 inset;}
  .ul_menu_class1 li .item a{font-size:20px;text-align:center; line-height:21px;display:block; color:#666;word-wrap:break-word; word-break:normal; word-break:break-all;}
  .ul_menu_class1 li .item .a2{font-size:20px;text-align:center; line-height:21px;display:block; color:#666;word-wrap:break-word; word-break:normal; word-break:break-all;}
  .ul_menu_class1 li .item .a1{font-size:20px;text-align:center; line-height:21px;display:block; color:#666;word-wrap:break-word; word-break:normal; word-break:break-all;}
  .ul_menu_class1 li .item table{ height:100%; width:100%;}
  .ul_menu_class1 li .item .title{ font-size:16px; margin:0px; padding:0px; text-align:center; border-radius:2px; margin-top:5px; padding:2px; color:#666;}
  .ul_menu_class1 li .item .title a{color:#666;}
  .ul_menu_class1 li .item table td{ height:100%; width:100%; overflow:hidden;word-wrap:break-word; word-break:normal; word-break:break-all;}
  .ul_menu_class1 li.marginleft{margin-left: 115px;}
  .ul_menu_class1 li.margintop{margin-top: -70px;} 
  .ul_menu_class1 li table{ height:100%; width:100%;}
  .ul_menu_class1 li p{ margin:0px; padding:0px;}
  .con-show01{width: 200px;height: 250px;float: left;margin-left:0px;overflow: hidden;transform:rotate(120deg);-webkit-transform:rotate(120deg);}
  .con-show02{width: 100%;height: 100%;overflow: hidden;transform:rotate(-60deg);-webkit-transform:rotate(-60deg);}
  .con-show03{width: 100%;height: 100%;overflow: hidden;transform:rotate(-60deg);-webkit-transform:rotate(-60deg);position: relative;background: pink;}
  .con-show03 > div{width: 100%;height: 100%;position: absolute;top: 0;left: 0;opacity: 0;line-height: 250px;text-align: center;color: #fff;cursor: pointer;background: url(../images/a.png);transition: opacity 0.3s;}
  .con-show03 a{ font-size:15px;}
  .con-show03:hover > div{opacity: 1;}

 @media screen and (max-width:1000px){
 
    .ul_menu_class1 li .item .photo{height:70px; width:70px;}
	.ul_menu_class1 li .item .a1{ font-size:17px;}
    .ul_menu_class1 li{ width:33%; float:left; padding-top:10px; padding-bottom:10px;}
    .mymain{ width:100%;margin-top:0px;}
	.ul_menu_class1 li{ width:33%; float:left; padding-top:10px; padding-bottom:10px;}
	.ul_menu_class1 li{}
  	.ul_menu_class1 li.marginleft{margin-left: 55px;}
	.ul_menu_class1 li.margintop{margin-top: -20px;} 
    .con-show01{width:120px;height:100px;}
	.ul_menu_class1 li .con-show03 .a1{font-size:15px; line-height:16px;}
 }
body{
/*background: #7acdd4;
background-image: -webkit-linear-gradient(-90deg,#7acdd4,#549ed2);*/
}
 
</style>
</head>
<body>
<div class="mybody_b" style="display:none;">
<div class="curnav"><a  class="back" href="/index.php"><em>d</em></a><center><?php echo ($webtitle); ?></center><a class="amenu">≡</a></div>
<div class="mymain" id="mymain">
<div class="padding10" style="height:auto; overflow:auto;">
<ul class="ul_menu_class1">
<?php if(is_array($classlist)): foreach($classlist as $key=>$row): ?><li>
  <div class="item">
  <div class="rel"> 
  <a href="/index.php/Home/Exam1/class2/table/<?php echo ($table); ?>/fatherid/<?php echo ($row["id"]); ?>/" class="a2">
   <div class="photo">
   <table><tr><td valign="middle" align="center">
 
  <?php  if(trim($row[title1])!=""){?>
  <?php echo $row[title1];?>
  <?php }else{ ?>
  <?php  echo $row[title]; }?>
  
  </td></tr>
  </table>
  </div>
  <div class="title"><?php echo ($row["title"]); ?></div>
  </a>
  </div>
  </div>
  </li><?php endforeach; endif; ?>

</ul>
</div>
</div>
</div>
<script>
var startindexl=3;
$(".item .rel22").each(function(i){
var index=i+1;
var html=$(this).html();
 var o=$('<div class="con-show01"><div class="con-show02"><div class="con-show03 bg02">'+html+'</div></div></div>');
 var p=$(this).parent().parent().html("");
 p.append(o);
 if((index+1)%5==0){
    p.addClass("marginleft");
 }

 if(index>3){
  p.addClass("margintop");
 }
});
</script>
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