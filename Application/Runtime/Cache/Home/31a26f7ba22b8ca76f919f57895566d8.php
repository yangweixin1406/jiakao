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
	action:"/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pdetail",
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
window.g_actionurl="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pdetail";
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


<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/slick-1.6.0/slick/slick.min.js"></script>
  <link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/slick-1.6.0/slick/slick.css">
  <link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/slick-1.6.0/slick/slick-theme.css">
<style>
.protj{ border-bottom:solid #CCCCCC 0px; height:50px; overflow:hidden; width:100%; margin-top:10px; margin-bottom:10px;}
.protj .rel{ height:auto; overflow:hidden; height:55px; width:100%; padding-bottom:20px; overflow-x:auto;}
.protj .rel .inner{ height:auto; overflow:hidden; height:60px;}
.protj .rel .item{ width:100px; float:left; height:60px; line-height:60px;}
.protj .rel .item .inner{ margin-left:2px; margin-right:2px; background-color:#f5f5f5;}
.protj .rel .item .photo{ height:100%; width:100%;}
.protj .rel .item .photo img{ width:100%;}
.protj .slick-dots{ display:none;}
.protj .slick-prev{ margin-top:-3px;}
.protj .slick-next{  margin-top:-3px;}
.plist{ margin-left:auto; margin-right:auto; height:auto; overflow:hidden; margin-top:10px; overflow:visible;}
.plist .item{ width:33.3%; float:left; height:auto; overflow:hidden;position:relative; overflow:hidden; margin-bottom:10px; }
.plist .item .rel{ padding:5px;}
.plist .item .rel .price i{color: #c81623; font-size: 12px;font-weight: 300;font-style: normal;}
.plist .item .rel .price .s1{color: #c81623; font-size:18px; font-weight:bold;}
.plist .item .rel .price .s2{text-decoration: line-through;font-size: 12px;color: #999;}
.plist .item .rel .price .s2{}
.plist .item .photo{ height:100px; text-align:center; overflow:hidden;}
.plist .item .photo img{ background-color:#CCCCCC; height:100%;}
.plist .item .title{height: 32px;text-align: left;padding: 0 11px;line-height: 16px;overflow: hidden;word-wrap: break-word;word-break: break-all;}
.plist .item .price{ text-align:center;}
.plist .item .rel{display: block;padding: 12px 5px;border-bottom: 1px solid #e7e7e7;cursor: pointer;}
a{color: #666;}
a:hover{color: #c81623;}

.hc-tab{ margin-top:10px;}
.hc-tab-title{position: relative;left: 0;height: 40px;white-space: nowrap;font-size: 0;border-bottom: 1px solid #e2e2e2;transition: all .2s;-webkit-transition: all .2s;}
.hc-tab-title li{color: #000;display: inline-block;border: 1px solid #FFFFF; border-bottom:0px;vertical-align: middle;font-size: 14px;transition: all .2s;-webkit-transition: all .2s;position: relative;line-height: 40px;min-width: 65px;padding: 0 10px;cursor: pointer;text-align: center;}
.hc-tab-title li.cur:after{position: absolute;
    left: 0;
    top: 0;
    content: '';
    width: 100%;
    height: 41px;
    border: 1px solid #e2e2e2;
    border-bottom-color: #fff;
    border-radius: 2px 2px 0 0;
    -webkit-box-sizing: border-box!important;
    -moz-box-sizing: border-box!important;
    box-sizing: border-box!important;
    pointer-events: none;}
.hc-tab-content{}
.bottomheight{height:40px;}
.pdetail-bottom{ position:fixed; left:0px; bottom:0px; height:40px;left:50%; width:800px; margin-left:-400px; z-index:400;}
.b-bt1{ width:30%; float:left; height:100%; overflow:hidden; background-color:#0099FF;}
.b-bt2{ width:30%;float:left;height:100%;overflow:hidden; background-color:#FF6600;}
.b-bt3{ width:40%;float:left;height:100%;overflow:hidden; background-color:#00CC00}
.pdetail-bottom .in{ line-height:40px; text-align:center; display:block; width:100%; color:#FFFFFF; font-size:15px; cursor:pointer;}
.pdetail-bottom{ }
@media screen and (max-width:800px){
.plist .item .photo{ height:70px;}
.pdetail-bottom{width:100%; left:0px; margin-left:0px;}
}
</style>
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/home/huandengslider.css">
</head>
<body>
<div class="mybody">
<div class="curnav"><a  class="back" href="<?php echo ($backurl); ?>"><em>d</em></a><center><?php echo ($web["title"]); ?></center><a class="amenu">≡</a></div>
<div class="mymain">
<div class="huandeng-photolist" id="huandenglist"> 
    <div  id="huandeng_slider" class="huandeng-slider"> 
    <?php if(is_array($info["jiaodantu"])): foreach($info["jiaodantu"] as $key=>$row): ?><div class="item">
        <img  src="/phpsite/hc/kaoti/kaoti20170406/Public/images/logo.gif"  data-src="/phpsite/hc/kaoti/kaoti20170406/<?php echo ($row); ?>"  onclick="showbig(this)">
     </div><?php endforeach; endif; ?>
	</div>
</div>
<script>
	if($(window).width()<600){
		  $("#huandeng_slider").slick({
			dots: true,
			infinite: true,
			autoplay:true,
					easing:"linear",
			variableWidth: false
		  });
	}else{
//		  $("#huandeng_slider .item").css({"width":"auto"});
//		  $("#huandeng_slider").slick({
//			dots: true,
//			infinite: true,
//			arrows:true,//左右箭头
//			autoplay:true,
//			slidesToShow: 3,
//			cssEase: 'linear',
//			slidesToScroll: 3,
//			variableWidth: true
//		  });
		 $("#huandeng_slider").slick({
			dots: true,
			infinite: true,
			autoplay:false,
					easing:"linear",
			variableWidth: false
		  });
//	    $("#huandeng_slider").slick("slickGoTo",1);
//	$('#huandeng_slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
//      console.log(nextSlide);
//    });
	}

</script>
<div class="hc-tab">
   <ul class="hc-tab-title"><li class="cur">商品描述</li><li>商品评论</li></ul>
   <div class="hc-tab-content">
       <div class="hc-tab-item"><div class="padding10"><?php echo ($info["content"]); ?></div></div>
	   <div class="hc-tab-item" style="display:none;"><div class="padding10">暂无评论</div></div>
   </div>
</div>
<div class="bottomheight">&nbsp;</div>
<div class="pdetail-bottom">
   <div class="b-bt1"><span class="in btaddfavorites">收藏商品</span></div>
   <div class="b-bt2"><span class="in"><a href='/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/home/djid/<?php echo ($info["dianjiaid"]); ?>'>店铺</a></span></div>
   <div class="b-bt3"><span class="in btaddcart">放入购物车</span></div>
</div>
<input type="hidden" value="<?php echo ($info["id"]); ?>" id="prodid"/>
<input type="hidden" value="<?php echo ($info["title"]); ?>" id="prodtitle"/>
<input type="hidden" value="<?php echo ($info["idno"]); ?>" id="prodidno"/>
<script>

$(".hc-tab").each(function(){
   var tab=$(this);
   var tabtitles=tab.find(".hc-tab-title").children("li");
   var tabcontents=tab.find(".hc-tab-content").children(".hc-tab-item");
    tabtitles.each(function(i){
     var tabtitle=$(this);
	 tabtitle.click(function(){
	     tabtitles.removeClass("cur");
		 $(this).addClass("cur");
		 tabcontents.hide();
		 tabcontents.eq($(this).index()).show();
	 });
   });
});

</script>
  <div id="protj" class="protj">
         <div  class="rel">
			 <div id="protj_inner" class="inner">
			 <?php if(is_array($protj)): foreach($protj as $key=>$row): ?><div class="item" data-id="<?php echo ($row["id"]); ?>"><div class="inner"><div class="photo"><a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pdetail/djid/<?php echo ($row["dianjiaid"]); ?>/id/<?php echo ($row["id"]); ?>" class="aurl"><img data-src="<?php echo ($row["photo"]); ?>" src="<?php echo ($dianjia["nullimg"]); ?>"></a></div></div></div><?php endforeach; endif; ?>
			 </div>
		 </div>
  </div>

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

<script>


function myresizepro(){
  var wz=0;
  if($(window).width()<600){
	  $("#protj .item").each(function(){
		 wz+=$(this)[0].offsetWidth;
	  }); 
	  $("#protj_inner").css("width",wz+10+"px"); 
  }else{
      $("#protj_inner").slick({
        infinite: true,
		arrows:true,//左右箭头
		autoplay:false,
        slidesToShow: 8,
		cssEase: 'linear',
        slidesToScroll:3,
      });
  }
 
}

$(window).resize(function(){
  // myresizepro();
});
myresizepro();
$(".imgcode").attr("src",conf.app+"/"+conf.module+"/Ajax/getcode?"+(new Date()).getTime());
$(".imgcode").click(function(){
   $(".imgcode").attr("src",conf.app+"/"+conf.module+"/Ajax/getcode?"+(new Date()).getTime());
});
$(".smscode").click(function(){
    var url=conf.app+"/"+conf.module+"/Ajax/getsmscode?"+(new Date()).getTime();
	var bt=$(this);
    $.ajax({
	url:url,
	type:"get",
	dataType:"text",
	success:function(data){
	   				 var dj=1;
					  bt.attr("disabled","disabled");
					  var timedj=window.setInterval(function(){
					        dj++;
					        if(dj<60){
					          bt.val("已发送("+dj+")"); 
							}else{
							  bt.removeAttr("disabled");
							  window.clearInterval(timedj);
							}
					  },1000);
					  
				      window.setTimeout(function(){
					          bt.val("重新发送");  
					  },1000*60);
				      bt.val("已发送"); 

	}
	})
});
//$.cookie("currentMenuID", "menuID", { path: "/"}); 
var weburl="/phpsite/hc/kaoti/kaoti20170406";//右键查看网页源码，你会看出这个有值，有关 thinkphp 常量：http://document.thinkphp.cn/manual_3_2.html#const_reference

function check(){
	var username=$("input[name='username']");
	var code=$("input[name='code']");
	var inputs=$("input.txt");
	var data={};
	for(i=0;i<inputs.length;i++){
	   var input=inputs.eq(i);
	   var placeholder=input.attr("placeholder");
	   var datatype=input.attr("data-type");
	   var databijiao=input.attr("data-bijiao");
	   var databijiaotishi=input.attr("data-bijiao-tishi");
	   if(placeholder!=null){

	       if(datatype!=null){
		      if(datatype=="phone"){
			     if(input.val()==""||input.val().length!=11){
						myalert(input.attr("placeholder"));
						input[0].focus();
						return false;
				 }
			  }
		   }else{
		        if(input.val()==""){
					 myalert(input.attr("placeholder"));
					 input[0].focus();
					 return false;
				 }
		   }
		   
	       if(databijiao!=null){
		     var input1=$("input[name='"+databijiao+"']");
		      if(input.val()!=input1.val()){
			     myalert(databijiaotishi);
			     input[0].focus();
			     return false;
			  }
		   }
	   }
	   data[input.attr("name")]=input.val();
	}
	var action=$("#form1").attr("action");
	$.ajax({
	url:action,
	type:"post",
	data:data,
	dataType:"text",
	success:function(data){
	   var json=eval("("+data+")");
	   if(!json){
	       myalert("修改失败");
	   }else if(json.status=="error"){
	       myalert(json.msg);
	   }else if(json.status=="success"){
	       myalert(json.msg);
		   window.setTimeout(function(){
		    //window.location=conf.app+"/"+conf.module+"/index";
		  },2000);
	   }
	}
	})
	return false;
}
function myalert(str){
  if(layer){
  layer.msg(str,{time:1000});
  }else{
   alert(str);
  }
}
var cart={
  add:function(opt){
    $.ajax({
		  url:"<?php echo U('cart/add');?>",
		  type:"post",
		  data:opt,
		  dataType:"text",
		  success:function(str){
		    var json=eval("("+str+")");
			 if(json.status=="success"){
			     myalert(json.info);
			 }else{
			     myalert(json.info);
			   }
		  }
	});
  }
}
$(".btaddcart").click(function(){
 var prodid=$("#prodid").val();
  cart.add({prodid:prodid,num:1});
});
$(".btaddfavorites").click(function(){
 var prodid=$("#prodid").val();
 var prodtitle=$("#prodtitle").val();
  var prodidno=$("#prodidno").val();
  var url=String(window.location);
  var arr=url.split(".php/");
  url="/"+arr[1];
 var opt={objid:prodid,objtable:"product",objidno:prodidno,title:prodtitle,url:url,isajax:1};
    $.ajax({
		  url:"<?php echo U('favorites/add');?>",
		  type:"post",
		  data:opt,
		  dataType:"text",
		  success:function(str){
		    var json=eval("("+str+")");
			 if(json.status=="1"){
			     myalert(json.info);
			 }else{
			     myalert(json.info);
			   }
		  }
	});
});
</script>