<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($webtitle); ?></title>
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/jquery-1.7.2.min.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/jquery.cookie.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/json2.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/layer-v2.3/layer/layer.js"></script>
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
	action:"/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Index/index",
	app:"/phpsite/hc/kaoti/kaoti20170406/index.php",
	url:"/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Index",
	module:"<?php echo C('DEFAULT_MODULE');?>",
	controller:"<?php echo C(DEFAULT_CONTROLLER);?>",
	classid:"<?php echo ($data['classid']); ?>",
	kemu:"<?php echo ($data['kemu']); ?>",
	table:"<?php echo ($table); ?>",
	root:"/phpsite/hc/kaoti/kaoti20170406",
	laiyuan:"<?php echo ($laiyuan); ?>"
	
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
window.g_actionurl="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Index/index";

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
						  }
						  else {
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

$(function(){
	window.setTimeout(function(){
		
	var curnav_height=$(".curnav").height();
	$(".curnav .amenu,.curnav_a .amenu_a").click(function(){
				var h=$(window).height();
		var w=$(window).width();
		h="100%";
		w="100%";
		var body=document.getElementsByTagName("body")[0];
		var caidanabs=document.createElement("div");
		caidanabs.className="caidanabs";
		$(caidanabs).css({width:"100%",height:h,"overflow":"hidden","position":"fixed","left":"0px","top":"0px","z-index":"30000"});
		var caidan=document.createElement("div");
		
		body.appendChild(caidanabs);

		
		var caidanbg=document.createElement("div");
		caidanbg.className="caidanbg";
		
		caidanabs.appendChild(caidanbg);
		$(caidanbg).css({width:w,height:h});
		//caidan.id="caidan";
		caidan.className="caidan";
		var width=120;

		$(caidan).css({width:width+"px",height:h});
		
		var caidanleft=document.createElement("div");
		caidanleft.className="caidanleft";
		caidanabs.appendChild(caidanleft);
		
		$(caidanleft).css({width:$(window).width()-width+"px",height:h,"position":"absolute","left":"0px","top":"0px","z-index":"30002","44background-color":"#00CC99"});
		
		caidanabs.appendChild(caidan);
		caidanabs.appendChild(caidanleft);
		var caidan_rel=document.createElement("div");
		caidan_rel=document.createElement("div");
		caidan_rel.style.height=h;
		caidan_rel.className="rel";
		caidan.appendChild(caidan_rel);
		
		var caidan_rel_con=document.createElement("div");
		caidan_rel_con=document.createElement("div");
		caidan_rel_con.className="con";
		caidan_rel.appendChild(caidan_rel_con);
		
		var caidan_rel_con_inner=document.createElement("div");
		caidan_rel_con_inner=document.createElement("div");
		caidan_rel_con_inner.className="inner";
		caidan_rel_con.appendChild(caidan_rel_con_inner);
		//$(caidan_rel_con).css({height:$(window).height()+"px"});
		
		var metop=document.createElement("div");
		metop.className="metop";
		metop.style.height="120px";
		metop.innerHTML='<div class="metop_touxiang"><div><i><span></span></i></div></div>';
		if(usertx!=""){
		   metop.childNodes[0].innerHTML="<img src=\""+conf.root+"/"+usertx+"\"/>";
		}
		caidan_rel_con_inner.appendChild(metop);
		var str="";
		var username_str=username;
		if(username==""){
			username_str="未登录";
		}
		str+="<h1 class='username'>"+username_str+"</h1>";
		str+="<ul>";
		if(username!=""){
		  str+="<li class='liclose'><a  class='closelogin'>退出帐号</a></li>";
		}
		if(g_isapp){
		  str+="<li><a onclick='javascript:uexWidgetOne.exit();'>关闭APP</a></li>";
		}
		str+="<li><a href='"+conf.app+"'>首页</a></li>";
		str+="<li class='li_contact'><a>联系我们</a></li>";
		str+="<li class='li_favorites'><a href='"+conf.app+"/"+conf.module+"/favorites/lists"+"'>我的收藏</a></li>";
		str+="<li class='li_examerror'><a href='"+conf.app+"/"+conf.module+"/answer/lists"+"'>我的错题</a></li>";
	    str+="<li class='li_info'><a href='"+conf.app+"/"+conf.module+"/user/my"+"'>我的资料</a></li>";
		str+="<li class='li_pwd'><a href='"+conf.app+"/"+conf.module+"/user/pwd"+"'>修改密码</a></li>";
		str+="<li class='li_goumaiex'><a href='"+conf.app+"/"+conf.module+"/goumaiex/lists"+"'>购买记录</a></li>";
//		str+="<li class='limyfavorites'><a href='"+conf.app+"/"+conf.module+"/favorites/lists/type/1"+"'>科目1收藏</a></li>";
//		str+="<li class='limyexamerror'><a href='"+conf.app+"/"+conf.module+"/answer/lists/type/1"+"'>科目1错题</a></li>";
//		str+="<li class='limyfavorites'><a href='"+conf.app+"/"+conf.module+"/favorites/lists/type/4"+"'>科目4收藏</a></li>";
//		str+="<li class='limyexamerror'><a href='"+conf.app+"/"+conf.module+"/answer/lists/type/4"+"'>科目4错题</a></li>";
		
		
		str+="</ul>";
		//str+="<div style='position:absolute;bottom:0px;left:0px;width:100%;color:#1BBC9B;text-align:center;font-size:15px;'><div style='padding:10px; line-height:25px;'>联系电话<br>137000000<br/>联系扣扣<br/>632175205</div></div>";
		 $(caidan_rel_con_inner).append(str);
		 $(caidan_rel_con_inner).find(".li_contact").click(function(){

		    var ajaxurl=conf.app+"/"+conf.module+"/index/contact";

			 $.ajax({
				 type:"post",
				 url:ajaxurl,
				 dataType:"text",
				 success:function(data){
					  //alert(data);
					   data=eval("("+data+")");
					 $(caidanleft).html("<div style='padding:10px;'>"+tohtml(data.content)+"</div>");
					 $(caidanleft).css({"color":"#FFFFFF","font-size":"15px"}).find("*").css({"color":"#F5F5F5","font-size":"15px"});
					 var ps=$(caidanleft).find("p");
					 ps.css({"border-left":"solid 2px #F90","padding":"10px","background-color":"#666666"});
					 //ps.hide();
					 //ps.each(function(i){
						 //var p=$(this);
						 // window.setTimeout(function(){p.show();},100*i);
					 //})
					// $(selector).animate({params},speed,callback);
					 $(caidanleft).find("div").eq(0).click(function(event){
						 event.stopPropagation();
					 })
					 
				 }
			 })
		 })

		 $(caidan_rel_con).find(".closelogin").click(function(){
			 if(confirm("确定要退出帐号？")){
			$(caidan_rel_con).animate({"right":-width+"px"},function(){
				$(caidanabs).remove();
				 window.location=conf.app+"/home/user/login";
			});
				
			 }
		 });

        $(caidan_rel_con).css({"right":-width+"px","opacity":0.9,width:width+"px",height:h});
		$(caidan_rel_con).animate({"right":"0px"});
		$(caidanbg).click(function(){
			
			$(caidanleft).animate({"left":-($(window).width()-width)+"px"});
			$(caidan_rel_con).animate({"right":-width+"px"},function(){
				$(caidanabs).remove();
			});
			
		});
				$(caidanleft).click(function(){
				$(caidanleft).animate({"left":-($(window).width()-width)+"px"});
			   $(caidan_rel_con).animate({"right":-width+"px"},function(){
				$(caidanabs).remove();
			});
			
		});
		//uexWidgetOne.exit();
	})
	},1000);
})
</script>
<script language=javascript>
function tohtml(str){
	str=str.replace(new RegExp("&lt;","gm"),"<");
	str=str.replace(new RegExp("&gt;","gm"),">");
	str=str.replace(new RegExp("&quot;","gm"),"\"");
	return str;
}
//function click() {
//return false;}
//function click1(){if (event.button==2) {return false; }}
//function CtrlKeyDown(){
// if (event.keyCode==67&&event.ctrlKey)
// {
//  clipboardData.setData('text','');
//  return false; 
// }
//}
//document.onkeydown=CtrlKeyDown;
//document.onselectstart=click;
//document.onmousedown=click1;
</script>
<noscript><iframe src=*.html></iframe></noscript>
<script language=javascript> 
<!-- 
//if (window.Event) 
//document.captureEvents(Event.MOUSEUP); 
//function nocontextmenu(){ 
// event.cancelBubble = true 
// event.returnValue = false; 
// return false; 
//} 
//function norightclick(e){ 
//if (window.Event){
// if (e.which == 2 || e.which == 3)
// return false;
//} 
//else if (event.button == 2 || event.button == 3)
//{
// event.cancelBubble = true;
// event.returnValue = false;return false;} 
//} 
//document.oncontextmenu = nocontextmenu; // for IE5+ 
//document.onmousedown = norightclick; // for all others 
//--></script> 

<style>
.table_action{ max-width:400px; margin-left:auto; margin-right:auto;}
.table_action td{ height:100px; width:100px;}
.menu{ list-style:none; margin:0px; padding:10px; max-width:350px; margin-left:auto; margin-right:auto; background-color:transparent; }
.menu li{ list-style:none; margin:0px; padding:0px; text-align:center; width:50%; float:left;} 
.menu li afff{ background-color:#3CF; height:100%; padding-bottom:15px; width:100%; display:block; color:#FFF;}
.menu li div.inner{ padding:15px;}
.menu li div.rel{border:#099 solid 2px; position:relative; width:99%; height:90px; background-color:#FFF; overflow:hidden; cursor:pointer;}
.menu li div.rel a{ display:block; position:absolute; height:20px; line-height:20px; font-size:18px; color:#099; left:0px; width:100%; margin-top:-10px; top:50%;
-webkit-transition: all 0.3s;-moz-transition: all 0.3s;transition: all 0.3s;}
.menu li p{ padding:10px; margin:0px; list-style:none; height:auto; overflow:hidden; display:block;}
.menu li div.rel a.hover{color:#0E83CD; color:#F5F5F5; font-size:40px;}

.menu li div.rel .bg{ position:absolute; height:100%; width:100%; background-color:#099; left:0px;}

</style>
</head>
<body>
<div class="mybody_b chezi" style="background-color:#F5F5F5;display:none">
<div class="curnav"><center>汽车考题测试</center><a class="amenu">≡</a></div>
<ul class="menu">
<!--<?php if(is_array($classlist)): foreach($classlist as $key=>$value): ?><li><div class="inner"><div class="rel"><span class="bg" style="height:0px;"></span><a title="/phpsite/hc/kaoti/kaoti20170406" href="<?php echo U('Home/Exam/index',array('fatherid'=>$value[id]));?>"  class="a1"><?php echo ($value["title1"]); ?></a></div></div></li><?php endforeach; endif; ?>-->
<?php if(is_array($configex)): foreach($configex as $key=>$value): ?><li><div class="inner"><div class="rel"><span class="bg" style="height:0px;"></span><a title="<?php echo ($value["title"]); ?>" href="<?php echo U('Home/Exam1/class1',array('table'=>$value[objtable]));?>"  class="a1"><?php echo ($value["title"]); ?></a></div></div></li><?php endforeach; endif; ?>

<li style="display:none"><div class="inner"><div class="rel"><span class="bg" style="height:0px;"></span><a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Examh" class="a3">Kazakh</a></div></div></li>
<li style="display:none"><div class="inner"><div class="rel"><span class="bg" style="height:0px;"></span><a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Exame" class="a4">英文</a></div></div></li>
<li style="display:none"><div class="inner"><div class="rel"><span class="bg" style="height:0px;"></span><a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Exama2" class="a4">阿拉2</a></div></div></li>
</ul>
</div>
<script>
$(".mybody_a").css({height:$(window).height()+"px",width:$(window).width()+"px"});
$(".menu li").each(function(){
	var a=$(this).find("a");
	a.attr("myhref",a.attr("href"));
	a.removeAttr("href");
	$(this).click(function(){
		var a1=$(this).find("a");
		var myhref=a1.attr("myhref");
		a1.addClass("hover");
		$(this).find(".bg").animate({"height":"100%"},function(){
			//$(".mybody_a").addClass("addscale001");
			window.setTimeout(function(){
				window.location=myhref;
			},1000);
			//
			});
	});
	
})
//css3按钮动画特效大全鼠标滑过按钮动画特效 http://www.17sucai.com/demoshow/1435.html
//thinkphp教程 http://www.vso8.com/Play/id/bsIYcrWT33
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