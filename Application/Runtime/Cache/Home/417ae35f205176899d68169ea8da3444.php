<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="chezi">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo ($web["title"]); ?></title>
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
	action:"/index.php/Home/User/zhaohuimima",
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

window.g_lang="<?php echo ($lang); ?>";
window.g_act="<?php echo ($act); ?>";
window.userid="<?php echo ($_SESSION['userq']['id']); ?>";
window.app_url="/index.php";
window.g_actionurl="/index.php/Home/User/zhaohuimima";
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


</head>
<body>
<div class="mybody_b" style="display:none;">
<div class="curnav"><a  class="back" href="/index.php"><em>d</em></a><center><?php echo ($web["title"]); ?></center><a class="amenu">≡</a></div>
<div class="mymain" id="mymain">
<div class="padding10">
<div class="titleinfo1">邮箱找回密码</div>
<form method="post" id="form1" action="/index.php/Home/User/zhaohuimima" onsubmit="return check();">
          <table style="width:100%; margin-left:auto; margin-right:auto;" cellpadding="1" class="tableinfo2">
				  <tr>
					 <td class="td1">你的邮箱：</td>
					 <td class="td2"><input type="text"  value="" class="txt" name="email" placeholder="请输入邮箱"  data-type="email" /></td>
				  </tr>
				  <tr>
					<td colspan="2" align="center" class="tdop">
					<p style="color:#999999">新的密码将会发送到你邮箱里</p>
					<input type="hidden"  value="email" name="type" class="txt" />
					<input  type="button"  value="提交" name="act" class="bt1" onclick="check(this);"/>&nbsp;<input  type="reset"  value="重置" name="bt"  class="bt1"/></td>
				  </tr>
          </table>
</form>
</div>
</div>
</div>
</div>
<script>
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
						  	bt.val("重新发送");  
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
var weburl="";//右键查看网页源码，你会看出这个有值，有关 thinkphp 常量：http://document.thinkphp.cn/manual_3_2.html#const_reference

function check(obj){
	var username=$("input[name='username']");
	var code=$("input[name='code']");
	var inputs=$("input.txt");
	var bt=$(obj);
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
	   if(json.status=="error"){
	       myalert(json.msg);
	   }else if(json.status=="success"){
	       myalert(json.msg);
		  // window.setTimeout(function(){
		   // window.location=conf.app+"/"+conf.module+"/index";
		  //},2000);
	   }             var dj=0;
	                   bt.attr("disabled","disabled");
					  var timedj=window.setInterval(function(){
					        dj++;
					        if(dj<60){
					          bt.val("已发送("+dj+")"); 
							}else{
						  	bt.val("重新发送");  
							 bt.removeAttr("disabled");
							  window.clearInterval(timedj);
							}
					  },1000);
					  
				      window.setTimeout(function(){
					          bt.val("重新发送");  
					  },1000*60);
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
</script>