<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>理论学习中心</title>
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<script language="javascript" src="/Public/js/jquery-1.8.3.min.js"></script>
<script language="javascript" src="/Public/js/jquery.cookie.js"></script>
<script language="javascript" src="/Public/js/json2.js"></script>
<script language="javascript" src="/Public/layer-v2.3/layer/layer.js"></script>
<script language="javascript" src="/Public/js/func.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/home/css.css?1">
<link rel="stylesheet" type="text/css" href="/Public/css/public.css?1">
<style>
    .curnav .amenu {
        font-size: 30px;
        font-weight: bold;
        position: absolute;
        top: 0px;
        right: 0px;
        color: #ffffff;
        height: 45px;
        line-height: 50px;
        width: 60px;
        display: block;
        text-align: center;
        cursor: pointer;
    }

    .curnav .amenu:hover {
        background-color: #0C9;
    }

    .curnav .amenu:active {
        background-color: #F90;
    }

    .caidanbg {
        position: absolute;
        background-color: #000;
        top: 0px;
        left: 0px;
        opacity: 0.8;
        filter: alpha(opacity=80);
        z-index: 30000;
    }

    .caidanleft { /* background-color:#FFF;filter:alpha(opacity=80);*background-color:#FFF;*/
        background-color: transparent;
    }

    .caidan {
        position: absolute;
        top: 0px;
        right: 0px;
        width: 120px;
        overflow: hidden;
        z-index: 30001;
    }

    .caidan .rel {
        position: relative;
        width: 100%;
        height: auto;
    }

    .caidan .rel .con {
        height: auto;
        width: 100%;
        height: auto;
        position: absolute;
        background-color: #000;
    }

    .caidan .rel .con a {
        color: #fff;
        font-size: 15px;
        cursor: pointer;
    }

    .caidan .rel .con ul {
        list-style: none;
        margin: 0px;
        padding: 0px;
        width: 100%;
    }

    .caidan .rel .con ul li {
        list-style: none;
        margin: 0px;
        padding: 10px;
        border-bottom: solid #000 1px;
        height: 20px;
        line-height: 20px;
        background-color: #0C9; /*margin:5px; border-left:solid #1BBC9B 2px;border-bottom:solid #000 2px;*/
        padding-left: 20px;
    }

    .caidan .rel .con ul li.liclose {
        background-color: #F90;
    }

    .caidan .rel .con ul li.litran {
        background-color: transparent;
        height: 20px;
    }

    .caidan .rel .con h1.username {
        color: #FFFFFF;
        font-weight: bold;
        margin: 0px;
        font-size: 15px;
        text-align: center;
        border-bottom: solid #000 0px;
        margin-bottom: 0px;
        padding-bottom: 10px;
    }

    .caidan .rel .con .inner {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .metop .metop_touxiang {
        overflow: hidden;
        height: 80px;
        width: 80px;
        position: absolute;
        top: 20px;
        z-index: 2000;
        left: 50%;
        margin-left: -40px;
    }

    .metop .metop_touxiang div {
        overflow: hidden;
        height: 80px;
        width: 80px;
        background-color: #8bf98b;
        background-color: #1BBC9B;
        border-radius: 41px;
        -webkit-border-radius: 41px;
    }

    .metop .metop_touxiang i {
        display: block;
        height: 70px;
        width: 70px;
        overflow: hidden;
        margin-top: 20px;
        margin-left: auto;
        margin-right: auto;
    }

    .metop .metop_touxiang i span {
        display: block;
        width: 100%;
        height: 70px;
        overflow: hidden;
        background-size: 100% auto;
        background-position: center top;
        background-repeat: no-repeat;
        background-image: url("/Public/images/user.png");
    }

    .btback {
        margin: 3px;
        width: 100px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        font-family: "微软雅黑";
        list-style: none;
        cursor: pointer;
        padding: 0px;
        vertical-align: middle;
        font-size: 14px;
        text-align: center;
        line-height: 13px;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
        overflow: hidden;
        border: solid 1px #099;
        color: #FFFFFF;
        overflow: hidden;
        background-color: #1BBC9B;
        border-radius: 4px;
        -ms-border-radius: 4px;
        -wekit-border-radius: 4px;
    }

</style>
<script>
var conf={
	yes_src:"/Public/home/images/yes.png",
	error_src:"/Public/home/images/error.png",
	action:"/index.php/Home/Exam/index",
	app:"/index.php",
	url:"/index.php/Home/Exam",
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
window.g_actionurl="/index.php/Home/Exam/index";
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
<div class="curnav"><a  class="back" href="/index.php"><em>d</em></a><center>理论学习中心</center><a class="amenu">≡</a></div>
<div class="padding10">
<div id="exam_menu">
<ul class="ul_menu">
<?php if(is_array($classlist)): foreach($classlist as $key=>$row): ?><li class="ul_menu_li">
   <div class="subtitle1"><a href1="/index.php/Home/Exam/list" classno="<?php echo ($row["classno"]); ?>" class="li_a1"><?php echo ($row["title"]); ?></a></div>
   <ul class="ul_menusub1" style="display:<?php if($key != 0): ?>none<?php endif; ?>;">
   <?php if(is_array($kemulist)): foreach($kemulist as $key1=>$row1): if($key1 != 0): ?><li classno="<?php echo ($row1["kemu"]); ?>" class="ul_menusub1_li">
          <div class="subtitle2"><?php echo ($row1["name"]); ?></div>
          <ul class="ul_menusub2" style="display:none;">
           <?php if(is_array($modelist)): foreach($modelist as $key=>$row2): if($row2["value"] == 'moni'): ?><li><a href="/index.php/Home/Exam/lists/act/<?php echo ($row2["value"]); ?>/classid/<?php echo ($row["id"]); ?>/kemu/<?php echo ($row1["value"]); ?>"><?php echo ($row2["name"]); ?></a></li>
             <?php else: ?>
            <li><a href="/index.php/Home/Exam/lists/act/<?php echo ($row2["value"]); ?>/classid/<?php echo ($row["id"]); ?>/kemu/<?php echo ($row1["value"]); ?>/tpl/lists_a"><?php echo ($row2["name"]); ?></a></li><?php endif; endforeach; endif; ?>
         </ul>
        </li><?php endif; endforeach; endif; ?>
  </ul>
 </li><?php endforeach; endif; ?>
</ul>
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
  
},0);
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
			},0);
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