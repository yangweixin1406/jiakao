<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class="chezi" style="background:#f5f5f5;">
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
	action:"/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/home",
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
window.g_actionurl="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/home";
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
<div class="top" id="top" style="width:100%;">

<div class="curnav pcurnav" id="curnav" style="position:absolute; top:0px; left:0px; z-index:1001"><div class="w800 rel"><a  class="back" href="<?php echo ($backurl); ?>"><em>d</em></a><center><form action="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/plists/djid/<?php echo ($dianjia["id"]); ?>"  method="get" onsubmit="return checkform(this);"><input type="text" name="key"  placeholder="请输入商品名"/><input type="submit" value="查询" name="btsubmit"/></form></center><a class="amenu">≡</a></div></div>
<div class="pheadinfo" id="pheadinfo" style="height:100px; background-color:#00CCFF; width:100%;">
    <div class="w800" style="height:100%;">
	  <div class="rel">
		<div class="logo">
		  <div class="inner"><img src="/phpsite/hc/kaoti/kaoti20170406/Public/images/logo.gif"  data-src="/phpsite/hc/kaoti/kaoti20170406/<?php echo ($dianjia["photo"]); ?>" onclick="showbig(this)"/></div>
		</div>
		<div class="shopname"><?php echo ($dianjia["shopname"]); ?></div>
		<div class="xingxing">★★★★★</div>
		<div class="shoucang">收藏店铺</div>
	 </div>
	</div>
</div>

</div>
<div class="pclass"  id="pclass">
         <div  class="w800 rel">
			 <div class="inner">
			   <div class="item" data-id="<?php echo ($row["id"]); ?>"><a class="aurl" style="color:#009900" href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/plists/djid/<?php echo ($dianjia["id"]); ?>/">全部</a></div>
			   <?php if(is_array($pclass)): foreach($pclass as $key=>$row): ?><div class="item<?php if($web['djclassid']==$row[id]){echo ' focus';}?>" title="<?php echo ($web['djclassid']); ?>" data-id="<?php echo ($row["id"]); ?>"><a class="aurl" href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/plists/djid/<?php echo ($dianjia["id"]); ?>/djclassid/<?php echo ($row["id"]); ?>"><?php echo ($row["title"]); ?></a></div><?php endforeach; endif; ?>
			 </div>
		 </div>
</div>
<script>
  $("#top").height($("#pheadinfo").height()+4);
</script>

<div style="clear:both; width:100%;"></div>
<link type="text/css" media="all" rel="stylesheet" href="/phpsite/hc/kaoti/kaoti20170406/Public/slick-1.6.0/tabhead.css" />
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/slick-1.6.0/slick/slick.min.js"></script>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/touchslider.js" title="201705240301改过后的" qq="632175205"></script>
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/slick-1.6.0/slick/slick.css">
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/slick-1.6.0/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/home/huandengslider.css">
<style>
.tabpane{ width:800px; float:left; min-height:200px;}
</style>
<div class="mymain">
<div class="w800">
   <div class="tabhead tabhead4" id="tabhead4" style="z-index:1000">
	  <span class="active"><center>店铺首页</center></span>
	  <span><center>全部宝贝</center></span>
	  <span><center>新品上架</center></span>
	  <span><center>店铺动态</center></span>
	  <b class="border"></b>
  </div>
</div>
<div class="w800">
  <div class="khfxWarp tabpane_slider" id="tabpane_slider">
  <div class="tabpanelist">
	<div class="tabpane" style="display:block">
	   <div class="rel">
	      <div class="list">
<!--	  焦点图开孡-->
			<div class="huandeng-photolist" id="huandenglist"> 
			 <div  class="rel">
				<div  id="huandeng_slider" class="huandeng-slider"> 
				<?php if(is_array($info["jiaodantu"])): foreach($info["jiaodantu"] as $key=>$row): ?><div class="item"  style="background-color:#FFFFFF;">
					<img src="/phpsite/hc/kaoti/kaoti20170406/Public/images/logo.gif"  data-src="/phpsite/hc/kaoti/kaoti20170406/<?php echo ($row); ?>" onclick="showbig(this)">
				 </div><?php endforeach; endif; ?>
				</div>
			</div>
			</div>
<!--			焦点图结束-->
			<div class="pkuang">
					 <div class="inner">
						  <div class="shoptitle"><span class="tit">推荐商品</span><span class="more"><a class="aurl" href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pclass/djid/<?php echo ($dianjia["id"]); ?>/">&gt;&gt;更多</a></span></div>
						  <div class="plist" style="margin-top:0px;">
						   <?php if(is_array($list)): foreach($list as $key=>$row): ?><div class="item" data-id="<?php echo ($row["id"]); ?>" >
							 <a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pdetail/djid/<?php echo ($row["dianjiaid"]); ?>/id/<?php echo ($row["id"]); ?>" class="aurl">
							 <div  class="rel" style="border:0px;">
								<div class="left"> 
								<div class="photo"><img data-src="/phpsite/hc/kaoti/kaoti20170406/<?php echo ($row["photo"]); ?>" src="/phpsite/hc/kaoti/kaoti20170406/Public/images/logo.gif"/></div>
								</div>
								<div class="right">  
										<div class="title"><?php echo ($row["title"]); ?></div>
										<div class="price"><i>¥</i><span class="s1"><?php echo ($row["price"]); ?></span><span class="s2">¥<?php echo ($row["prices"]); ?></span></div>
								</div>
							 </div>
							 </a>
							 </div><?php endforeach; endif; ?>
							<?php if(empty($list)): ?><div class="divnull">暂时没有推荐商品</div><?php endif; ?>
						  </div>
						  <div class="clear"></div>
					</div>
			</div>
			<div class="pkuang">
					 <div class="inner">
						  <div class="shoptitle"><span class="tit">热卖商品</span><span class="more"><a class="aurl" href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/plists/djid/<?php echo ($dianjia["id"]); ?>/">&gt;&gt;更多</a></span></div>
						  <div class="plist" style="margin-top:0px;">
						   <?php if(is_array($list)): foreach($list as $key=>$row): ?><div class="item" data-id="<?php echo ($row["id"]); ?>" >
							 <a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pdetail/djid/<?php echo ($row["dianjiaid"]); ?>/id/<?php echo ($row["id"]); ?>" class="aurl">
							 <div  class="rel" style="border:0px;">
								<div class="left"> 
								<div class="photo"><img data-src="/phpsite/hc/kaoti/kaoti20170406/<?php echo ($row["photo"]); ?>" src="/phpsite/hc/kaoti/kaoti20170406/Public/images/logo.gif"/></div>
								</div>
								<div class="right">  
										<div class="title"><?php echo ($row["title"]); ?></div>
										<div class="price"><i>¥</i><span class="s1"><?php echo ($row["price"]); ?></span><span class="s2">¥<?php echo ($row["prices"]); ?></span></div>
								</div>
							 </div>
							 </a>
							 </div><?php endforeach; endif; ?>
							<?php if(empty($list)): ?><div class="divnull">暂时没有热卖商品</div><?php endif; ?>
						  </div>
						  <div class="clear"></div>
					</div>
			</div>
		</div>
	 </div>
  </div>
    <div class="tabpane" id="productlist">
	    <div class="rel">
		   <div class="list">
	       <div class="loading"><div class="con1">正在加载...</div></div>
		  </div>
		</div>
    </div>
    <div class="tabpane">
	    <div class="rel">
		   <div class="list">
	       <div class="loading"><div class="con1">正在加载...</div></div>
		  </div>
		</div>
    </div>
    <div class="tabpane">
	    <div class="rel">
		   <div class="list">
	       <div class="loading"><div class="con1">正在加载...</div></div>
		  </div>
		</div>
    </div>
  </div>
  </div>
</div>
</div>
</div>
<div id="pro_tmp" style="display:none;">
		<div class="item" data-id="{id}" >
		 <a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Home/Shop/pdetail/djid/{dianjiaid}/id/{id}" class="aurl">
			<div  class="rel" style="border:0px;">
			<div class="left"> 
			<div class="photo"><img data-src="/phpsite/hc/kaoti/kaoti20170406/{photo}" src="/phpsite/hc/kaoti/kaoti20170406/Public/images/logo.gif"/></div>
			</div>
			<div class="right">  
			<div class="title">{title}</div>
			<div class="price"><i>¥</i><span class="s1">{price}</span><span class="s2">¥{prices}</span></div>
			</div>
			</div>
		 </a>
		</div>
</div>
			<script>
			function showslider(){
				if($(window).width()<800){
					  $("#huandeng_slider").slick({
						dots: true,
						infinite: true,
						autoplay:true,
						easing:"linear",
						variableWidth: false
					  });
				}else{
					 $("#huandenglist").css({"height":"300px"});
					  $("#huandeng_slider .item").css({"height":"300px"});
					  $("#huandeng_slider").slick({
						dots: true,
						infinite: true,
						autoplay:true,
						easing:"linear",
						variableWidth: false
					  });
				}
			}
			
			</script>
<script>
  init_show_img({objs:$("img")});
</script>
<script>
var djid="<?php echo ($dianjia["id"]); ?>";
$(window).resize(function(){
    resize_h_scroll({id:"pclass"});
});

resize_h_scroll({id:"pclass"});
show_hide_daohang_home({sjidno:""});

//$.cookie("currentMenuID", "menuID", { path: "/"}); 
//var weburl="/phpsite/hc/kaoti/kaoti20170406";//右键查看网页源码，你会看出这个有值，有关 thinkphp 常量：http://document.thinkphp.cn/manual_3_2.html#const_reference
</script>
<script>
 var itemIndex = 0;
function tabpaneslider(){
   
//	var  tabpane_slider=$("#tabpane_slider");
//	tabpane_slider.slick({
//	dots: false,
//	infinite: true,
//	autoplay:false,
//	easing:"linear",
//	variableWidth: false
//  });
  
    var tabLoadEndArray = [false, false, false];
    var tabLenghtArray = [28, 15, 47, 47];
    var tabScroolTopArray = [0, 0, 0,0];
	var tabs=$('.tabhead span');
	var tabhead=$('.tabhead');
	var showpanenav=function(index){
	     itemIndex = index;
        tabScroolTopArray[itemIndex] = $(window).scrollTop();
        var $this = tabs.eq(index);
       // $(window).scrollTop(tabScroolTopArray[itemIndex]);
        $this.addClass('active').siblings('.tabhead span').removeClass('active');
        $('.tabhead .border').css('left', $this.offset().left-tabhead.offset().left + 'px');
		var tabpanes=$(".tabpane");
		tabpanes.height(300);
		var h=tabpanes.eq(itemIndex).find(".list").height();
		tabpanes.eq(itemIndex).height(h);
		$(".tabpane").parent().parent().height(h);
		//var loading=$(".tabpane").eq(itemIndex).find(".loading");
		//if(loading.length>0&&loading.css("display")!="none"){
	      // $(".tabpane").scrollTop(170);
	  // }
		var tabpane=$(".tabpane").eq(index);
		panedata(index);
	}
    tabs.on('click', function () {
		 showpanenav($(this).index());
		// tabpane_slider.slick("slickGoTo",itemIndex);
    });
	window.tslider=new TouchSlider({id:"tabpane_slider",'auto':'-1',fx:'ease-out',direction:'left',speed:600,timeout:5000,'before':function(index){
		showpanenav(index);
	}});
	

	var as=$('.tabhead span');
	var index=0;
	as.each(function(i){
			$(this).attr("index",i);
			$(this).click(function(){
				tslider.slide($(this).attr("index"));
				//$(document).scrollTop($("#pheadinfo").height());
				$(document).scrollTop($("#pheadinfo").height());
				return false;
			});
	})



    
//	tabpane_slider.on('beforeChange', function(event, slick, currentSlide, nextSlide){
//          //console.log(slick);
//		  if(slick.$list.context.outerHTML.indexOf("tabpane_slider")!=-1){
//		    showpanenav(nextSlide);
//		  }
//    });
}
$(document).scroll(function(){
  var parent=$(this);
  if(itemIndex==1){
	   var zh=parent.height(); //注 jq版本1.7.2获取失败
		if($(window).height()+parent.scrollTop()+10>zh){
              //panedata(itemIndex);
		}
    }

});
function panedata(index){
   if(index==1){
            var  tabpane=$(".tabpane").eq(index);
			if(tabpane.attr("data-page")==null){tabpane.attr("data-page",0);}
			if(tabpane.attr("data-bool")==null){tabpane.attr("data-bool",1);}
			var oldpage=parseInt(tabpane.attr("data-page")),newpage=oldpage+1;
			 if(oldpage!=-1&&tabpane.attr("data-bool")!=0){
			    tabpane.parent().parent().height(tabpane.height());
				tabpane.attr("data-page",newpage);
			
				load_product({parent:tabpane,itemhtml:$("#pro_tmp").html(),listclass:"plist",data:{p:newpage,isajax:1,djid:djid},success:function(o){
				//alert($(window).height()+"="+$(document).height());
				  if($(window).height()==$(document).height()){
				      panedata(index);
				  }
				}});
				
			 }
			 
   }
   if(index==2){
            var  tabpane=$(".tabpane").eq(index);
			if(tabpane.attr("data-page")==null){tabpane.attr("data-page",0);}
			if(tabpane.attr("data-bool")==null){tabpane.attr("data-bool",1);}
			var oldpage=parseInt(tabpane.attr("data-page")),newpage=oldpage+1;
			 if(oldpage!=-1&&tabpane.attr("data-bool")!=0){
			    tabpane.parent().parent().height(tabpane.height());
		
				load_product({parent:tabpane,itemhtml:$("#pro_tmp").html(),listclass:"plist",data:{p:newpage,isajax:1,djid:djid,xinpin:1}});
				tabpane.attr("data-page",-1);
			 }
			 
			 
   }
}
function load_product(opt){
	var tabpane= opt.parent;
	
     opt.parent.attr("data-bool",0);
    opt.parent.find(".loadingxiao").show();
   $.ajax({
   url:conf.url+"/plists/",
   dataType:"text",
   type:"get",
   data:opt.data,
   success:function(res){

     opt.parent.attr("data-bool",1);
     opt.parent.find(".loading").hide();
     var json=eval("("+res+")"),num=0,plist=opt.parent.find("."+opt.listclass),loadingxiao=opt.parent.find(".loadingxiao");
	  if(res=="null"){
	     if(opt.data.p==1){
		    if(typeof(opt.data.xinpin)!="undefined"){
		      opt.parent.find(".loading").show().find(".con1").html("找不到商家新品");
			}else{
			  opt.parent.find(".loading").show().find(".con1").html("找不到商家产品");
			}
		 }
	     json=[];
	  }
	 if(plist.length<1){
	    opt.parent.find(".list").append("<div class=\""+opt.listclass+"\" style=\"margin-top:0px;\"></div");
	    plist=opt.parent.find("."+opt.listclass);
	 }
	 if(loadingxiao.length<1){
	   opt.parent.find(".list").append("<div class=\"loadingxiao\" style=\"display:none\">正在加载更多...</div");
	   loadingxiao=opt.parent.find(".loadingxiao");
	 }else{
	   loadingxiao.hide();
	 }
	  for(var k in json){
			  var row=json[k];
			  if(typeof(row.id)!="undefined"){
			  var line=opt.itemhtml;
			  line=line.replace(new RegExp("{id}","gm"),row.id); 
			  line=line.replace(new RegExp("{price}","gm"),row.price); 
			  line=line.replace(new RegExp("{prices}","gm"),row.prices); 
			  line=line.replace(new RegExp("{title}","gm"),row.title); 
			  line=line.replace(new RegExp("{dianjiaid}","gm"),row.dianjiaid); 
			  line=line.replace(new RegExp("{photo}","gm"),row.photo); 
			  var newite=$(line)
			   plist.append(newite);
			   init_show_img({objs:newite.find("img")});
			  num++;
			  }
	  }
      if(num==0){
	     opt.parent.attr("data-page",-1);
	  }else{
	     if(typeof(opt.success)!="undefined"){
	       opt.success({parent:opt.parent,res:res});
		 }
	  }
   }
   }) 
}
tabpaneslider();
showslider();
</script>

</body>
</html>