<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title><?php echo ($webtitle); ?></title>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/jquery-1.7.2.min.js"></script>  
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/jquery.cookie.js"></script>  
<script type="text/javascript" charset="utf-8" src="/phpsite/hc/kaoti/kaoti20170406/Public/ueditor1_4_3_2-utf8-php/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/phpsite/hc/kaoti/kaoti20170406/Public/ueditor1_4_3_2-utf8-php/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/phpsite/hc/kaoti/kaoti20170406/Public/ueditor1_4_3_2-utf8-php/lang/zh-cn/zh-cn.js"></script>

<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/admin/style.css?<?php echo $g_shuiji?>"/>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/admin/js/func.js"></script>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/admin/js/public.js"></script>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/admin/js/create_select_option.js"></script>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/admin/js/classoption.js?<?php echo $g_shuiji?>"></script>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/admin/js/xuanxiang.js?<?php echo $g_shuiji?>"></script>
<link rel="stylesheet" href="/phpsite/hc/kaoti/kaoti20170406/Public/lightbox/css/lightbox.css" media="screen"/>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/lightbox/js/lightbox-2.6.min.js"></script>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/admin/js/ajax.js"></script>
<script  src="/phpsite/hc/kaoti/kaoti20170406/Public/duihuakuang/duihuakuang.js?<?php echo $g_shuiji?>"></script>
<link type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/duihuakuang/duihuakuang.css?<?php echo $g_shuiji?>"  rel="stylesheet"/>
<script src="/phpsite/hc/kaoti/kaoti20170406/Public/layer-v2.3/layer/layer.js"></script>
<link rel="stylesheet" type="text/css" href="/phpsite/hc/kaoti/kaoti20170406/Public/layer-v2.3/layer/skin/layer.css"/>
<link rel="stylesheet" href="/phpsite/hc/kaoti/kaoti20170406/Public/font-awesome-4.7.0/css/font-awesome.min.css" media="screen"/>
</head>
<body>
<script language="javascript" src="/phpsite/hc/kaoti/kaoti20170406/Public/js/loadico.js"></script>  
<script>
loadico.show({txt:"<?php echo $_SESSION["msg"];?>"});
</script>
<div class="menu" id="menu" style="left:-300px;">
 <div id="menucon" class="menu_con">
 <ul class="ul_menu">
  <li class="li_a">
   <div class="tit">商品<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('product/lists');?>"><i class='ifa fa-bus'></i>商品列表</a></li>
	    <li><a href="<?php echo U('product/info');?>"><i class='ifa ifa fa-tags'></i>添加商品</a></li>
		<li><a href="<?php echo U('product/piliang');?>"><i class='ifa fa-random'></i>批量上传</a></li>
	</ul>
  </li>
  
  <li class="li_a">
   <div class="tit">考题<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('Exam/lists');?>"><i class='ifa fa-bus'></i>考题列表</a></li>
	    <li><a href="<?php echo U('Exam/info');?>"><i class='ifa ifa fa-tags'></i>添加考题</a></li>
		<li><a href="<?php echo U('Exam/daoru');?>"><i class='ifa ifa fa-tags'></i>导入考题</a></li>
	</ul>
  </li>
<?php if(is_array($configex)): foreach($configex as $key=>$row): ?><li class="li_a">
   <div class="tit"><?php echo ($row["lang"]); ?><span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('Exam1/lists',array('table'=>$row[objtable]));?>"><i class='ifa fa-bus'></i>考题列表</a></li>
	    <li><a href="<?php echo U('Exam1/info',array('table'=>$row[objtable]));?>"><i class='ifa ifa fa-tags'></i>添加考题</a></li>
		<li><a href="<?php echo U('Exam1/daoru',array('table'=>$row[objtable]));?>"><i class='ifa ifa fa-tags'></i>导入考题</a></li>
	</ul>
  </li><?php endforeach; endif; ?>
  <li class="li_a">
   <div class="tit">用户<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('user/lists');?>"><i class='ifa fa-bus'></i>用户列表</a></li>
	    <li><a href="<?php echo U('user/info');?>"><i class='ifa ifa fa-tags'></i>添加用户</a></li>
		<li><a href="<?php echo U('usergroup/lists');?>"><i class='ifa fa-random'></i>用户组</a></li>
	</ul>
  </li>
  
  <li class="li_a">
   <div class="tit">文章<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('content/lists');?>"><i class='ifa fa-file-text-o'></i>文章列表</a></li>
	    <li><a href="<?php echo U('content/info');?>"><i class='ifa ifa fa-tags'></i>添加文章</a></li>
		<li><a href="<?php echo U('class/lists');?>"><i class='ifa fa-tags'></i>文章分类</a></li>
	</ul>
  </li>
  
  <li class="li_a">
   <div class="tit">授权<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('shouquan/lists');?>"><i class='ifa fa-file-text-o'></i>授权列表</a></li>
	    <li><a href="<?php echo U('shouquan/info');?>"><i class='ifa ifa fa-tags'></i>添加授权</a></li>
	</ul>
  </li>
  <li class="li_a">
   <div class="tit">交易<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('paylog/lists');?>"><i class='ifa fa-bus'></i>交易记录</a></li>
	    <li><a href="<?php echo U('orders/lists');?>"><i class='ifa fa-bus'></i>订单记录</a></li>
	</ul>
  </li>
  <li class="li_a">
   <div class="tit">综合<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('link/lists');?>"><i class='ifa fa-bus'></i>综合列表</a></li>
		<li><a href="<?php echo U('link/info');?>"><i class='ifa ifa fa-tags'></i>添加综合</a></li>
	</ul>
  </li>
  <li class="li_a">
   <div class="tit">我的<span class="s">资料</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('user/only');?>"><i class='ifa fa-user-circle-o'></i>基本信息</a></li>
		<li><a href="<?php echo U('user/pwd');?>"><i class='ifa fa-unlock-alt'></i>修改密码</a></li>
		<li><a href="<?php echo U('user/login');?>"><i class='ifa fa-sign-in'></i>退出系统</a></li>
	</ul>
  </li>
  <li class="li_a">
   <div class="tit">留言<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('message/lists');?>"><i class='ifa fa-user-circle-o'></i>留言列表</a></li>
		<li><a href="<?php echo U('message/pwd');?>"><i class='ifa fa-unlock-alt'></i>修改密码</a></li>
	</ul>
  </li>
  <li class="li_a">
   <div class="tit">系统<span class="s">配置</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('class/lists');?>"><i class='ifa ifa fa-tags'></i>分类列表</a></li>
		<li><a href="<?php echo U('setting/pay');?>"><i class='ifa fa-unlock-alt'></i>支付接口</a></li>
		<li><a href="<?php echo U('setting/weixin_api');?>"><i class='ifa fa-unlock-alt'></i>微信公众号</a></li>
		<li><a href="<?php echo U('setting/email');?>"><i class='ifa fa-unlock-alt'></i>邮箱配置</a></li>
		<li><a href="<?php echo U('setting/point');?>"><i class='ifa fa-unlock-alt'></i>积分兑换</a></li>
		<li><a href="<?php echo U('setting/kefu');?>"><i class='ifa fa-unlock-alt'></i>客服号码</a></li>
		<li><a href="<?php echo U('configex/index');?>"><i class='ifa fa-unlock-alt'></i>考题语言</a></li>
	</ul>
  </li>
 </ul>
 <h1 style="font-size:15px;margin-left:20px;" class="h1_close"><a href="<?php echo U('user/login');?>" style=" text-decoration:none;  color:#F60;">退出</a></h1>
 </div>
</div>
<div class="panel" id="panel">
<div class="mybody">

<!--标题开始-->
<div class="mytitle" style="z-index:100;">
	<div class="con">
		<div class="left"><div class="tt"><?php echo ($mytitle); ?>&nbsp;(<?php echo ($item["num"]); ?>/<?php echo ($item["rowcountz"]); ?>)</div><div class="bb"><a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Admin/Configex/info/">添加语言</a></div><span class="btchazhao">查找</span></div>
		<div class="right">
			<form id="form1" name="form1" method="get" action="/phpsite/hc/kaoti/kaoti20170406/index.php/Admin/Configex/lists/" ><div class="l"></div>
			<div  class="r">
				<div class="row">
				   <span class="t">语言<em>：</em></span><span class="f"><input type="text" name="title" id="title" value="<?php echo $_GET[title]?>" class="txt1s"/></span>
				</div>
				<div class="row">
				   <span class="t">ID<em>：</em></span><span class="f"><input type="text" name="id" id="id" value="<?php echo $_GET[id]?>"  class="txt1s"/></span>
				</div>
				<div class="row">
					<span class="t ts">&nbsp;</span><span class="f"><input type="hidden" name="table" id="table" value="<?php echo $_GET[table]?>" /><input type="submit" name="search" id="button" value="查找" class="btsearch" /></span>
				</div>
			</div>
			</form>
		</div>
	</div>
</div>
<!--标题结束-->
<!--主体开始-->
<div class="mycontent paddingtop80" >
               <table class="tablelist tableloglat" cellspacing="0">
				<thead>
					<tr>
						<th class='tdck'><input type="checkbox" name="ckall"/></th>
						<th class='td1'>编号</th>
						<th class='td2'>语言名称</th>
						<th class='td3'>所用表名</th>
						<th class='td4'>所用大类</th>
						<th class='td5'>开启状态</th>
						<th class='td6'>录入日期</th>
						<th class='tdop' style="width:auto">操作</th>
					</tr>
				</thead>
				<tbody style="text-align:center;">
					<?php if(is_array($list)): foreach($list as $key=>$value): ?><tr>
                            <td class="tdck"><input type="checkbox" name="ck" value="<?php echo ($value["id"]); ?>" /></td>
							<td class="td1"><?php echo ($value["id"]); ?></td>
							<td class="td2"><?php echo ($value["title"]); ?></td>
							<td class="td3"><?php echo ($value["objtable"]); ?></td>
                            <td class="td4"><?php echo ($value["class_caption"]); ?></td>
                            <td class="td5">
								<?php if($value[status]==1){ ?>
								 <span style="color:#009900">已开启</span>
								<?php } else {?>
								已关闭
								<?php }?>
							</td>
							<td class="td6"><?php echo ($value["addtime"]); ?></td>
							<td class="tdop" style="width:auto"><a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Admin/Configex/info/id/<?php echo ($value["id"]); ?>">编辑</a>|<a href="/phpsite/hc/kaoti/kaoti20170406/index.php/Admin/Configex/delete/id/<?php echo ($value["id"]); ?>">删除</a></td>
						</tr><?php endforeach; endif; ?>
				</tbody>
</table>
</div>
<!--主体结束-->

</div>
<div class="pagenav"><?php echo ($show); ?></div>
<div style=" text-align:center; display:none;"><a data-url="<?php echo U('delete');?>" onclick="Del(this);">删除选中</a></div>
</div>
<script>
  if(window.attachEvent){
		window.attachEvent('onscroll',function(){BodySize()});
		window.attachEvent('onresize',function(){BodySize()});
  }else{
		window.addEventListener("scroll",function(){BodySize()}, false );
		window.addEventListener("resize",function(){BodySize()}, false );
   }
  var myleft=document.getElementById("menu");
  var myright=document.getElementById("panel");
  var myleftcon=document.getElementById("menucon");
  var myleftconul=null;
  var uls=myleftcon.childNodes;
  for(var i=0;i<uls.length;i++){
	  if(uls[i].nodeName.toLowerCase()=="ul"){
		  myleftconul=uls[i];
	  }
  }
  BodySize();
  function BodySize(){
		  var zh=$(window).height();
		  var cururl=String(window.location);
		  var zw=$(window).width();
		   var menu=$("#menu");
		   var mytitle=$(".mytitle");
		   var panel=$("#panel");
		   var menucon=$("#menucon");
		   var ul_menu=menucon.find(".ul_menu");
		   var li_as=menu.find(".li_a");
		  if(zw>700){
		      var h=zh;
		      var lw=150;
			  var rw=zw-lw-2;
			  menu.css({"height":h+"px","width":lw+"px","top":"0px","left":"0px","right":""});
			  panel.css({"height":h+"px","width":rw+"px","top":"0px","right":"0px","left":""});
			  menucon.css({"height":h+"px","width":lw+"px"});
			  mytitle.css({"left":(lw+2)+"px","width":(zw-lw-2)+"px"});
			  ul_menu.removeClass("ul_menu1");
			  ul_menu.find(".ul_b").css({"height":"auto"});
			  menu.removeClass("menu1");
			  li_as.each(function(){
				  var li_a=$(this);
				  //li_a.find(".ul_b").css({"height":"auto","display":"none"});
				  li_a.find("a").each(function(){
						var a=$(this);
						//a.attr("myhref", a.attr("href"));
						//a.removeAttr("href");
						a.unbind();
						if(cururl.indexOf(a.attr("href"))!=-1){
						 a.parents(".ul_b").show();
						}
						a.click(function(e){
						    loadico.show();

						})
				  });
				  li_a.children().eq(0).unbind();
				  li_a.children().eq(0).click(function(){
					  $(this).parent().children().eq(1).slideToggle("slow");
				  });
				}
			  );
		  }else{
		      
		    	
			  mytitle.css({"left":"",width:"100%"});
			  menu.addClass("menu1");
			  var h1=45;
			  var h2=zh-h1;
		      menu.css({"height":h1+"px","width":"100%","top":"0px","left":"0px"});
			  ul_menu.addClass("ul_menu1");
			  var li_w_z=0;
			  ul_menu.find(".li_a").each(function(){
			       li_w_z+=$(this).width();
			  });
			  if(li_w_z<zw){
			     ul_menu.css({"width":"100%"});
				 menucon.css({"height":h1+"px","width":"100%"});
			  }else{
			     ul_menu.css({"width":"100%"});
				 menucon.css({"height":h1+"px","width":li_w_z+5+"px"});
			  }
			  panel.css({"height":h2+"px","width":"100%","top":h1+"px","left":"0px","right":""});
			  li_as.each(function(){
				  var li_a=$(this);
				    li_a.find(".ul_b").css({"display":"none"});
					li_a.find("a").each(function(){
						var a=$(this);
						a.unbind();
						a.click(function(e){
						loadico.show();
						a.parents(".ul_b").hide();

						})
					});
				  li_a.children().eq(0).unbind();
				  li_a.children().eq(0).click(function(){
				       var heightz=$(window).height();
					   var h2=heightz-h1;
				       var cur=$(this).parent().children().eq(1);
					   ul_menu.find(".ul_b").not(cur).hide();
					   //cur.slideToggle("slow");
					   cur.toggle();
					   cur.css({"height":(h2-20)+"px","top":(h1)+"px"});
				  });
				} );
		  }
  }
</script>
<script>
function show_table(opt){
			var titlestr=opt.title;
			var h=400;
			var w=600;
			var htmlstr="<div style='text-align:left; color:#999; overflow-y:auto; height:"+(h-80)+"px;'><div style='height:1px;overflow:hidden;'></div><div style='margin:10px;'>"+opt.html+"</div></div>";
			duihuakuang.init({height:h,width:w,title:titlestr,html:htmlstr,bts:[{text:"关闭",classname:"btline",click:function(opt){opt.t.close();}}]});
}
</script>
<div class="clear" style="height:1px;"></div>
<script>
var btchazhao_val_old="";
$(".btchazhao").click(function(){

      if(btchazhao_val_old==""){
	     btchazhao_val_old=$(this).html();
	  }
	  if($(this).html()==btchazhao_val_old){
	  $(this).html("隐藏");
	  }else{
	    $(this).html(btchazhao_val_old);
	  }
     $(".mytitle .right").toggle();
})
var isshowload=1;

loadico.hide();
//window.parent 注:如果窗口本身是顶层窗口,parent属性返回的是对自身的引用
$("input[type='submit']").each(function(){
    var classname=$(this).attr("class");
   var isbool=1;

	if(typeof(classname)!="undefined"&&classname.indexOf("notalert")!=-1){
		 isbool=0;
	}
	if(isbool==1){
  $(this).click(function(){
      window.parent.loadico.show({txt:"正在提交"}); //window.parent 注:如果窗口本身是顶层窗口,parent属性返回的是对自身的引
	  window.setTimeout(function(){
	     window.parent.loadico.hide();
	  },3000);
  });
  }
});
$("a").each(function(){
    var data_lightbox=$(this).attr("data-lightbox");
    var classname=$(this).attr("class");
    var isbool=1;
	if(typeof(classname)!="undefined"&&classname.indexOf("notalert")!=-1){
		 isbool=0;
	}
   var href=$(this).attr("href");
    if(href){
	//alert(href);
	var href1=href.split("?");
   var arr=href1[0].split(".");
   var ext=arr[arr.length-1];
     if(ext=="php" || ext=="asp" || ext=="aspx"){

			 if(isbool==1){
	         $(this).click(function(){
			   if(typeof(window.parent.loadico)!="undefined"){
			     window.parent.loadico.show(); //window.parent 注:如果窗口本身是顶层窗口,parent属性返回的是对自身的
			   }
			  });
			  }
	  }
	  }
});
$(".bt").click(function(){
			   if(typeof(window.parent.loadico)!="undefined"){
			     window.parent.loadico.show(); //window.parent 注:如果窗口本身是顶层窗口,parent属性返回的是对自身的
			   }
});
$("#select_to_url").each(function(){
    var num=$(this).attr("data-max");
	var page=parseInt($(this).attr("data-page"));
	if(typeof(num)=="undefined"){
	    alert("下拉框没有最大页data-max属性,且没有值");
	   return false;
	}
	num=parseInt(num);
	 for(var i=1;i<=num;i++){
	     if(i<50){
		    var selected="";
			if(i==page){
			 selected="selected";
			}
	       $(this).append("<option value='"+i+"' "+selected+">"+i+"</option>");
		 }
	   }
	$(this).bind("change",function(){
	      var cururl=String(window.location);
		  var arr=cururl.split("?");
		  window.location=urlcanshu(page,$(this).val());;
		  
	})
});

</script>
<?php
 $_SESSION["msg"]=""; ?>
<script>
var tab_lis=$(".tab ol li");
tab_lis.each(function(){
  $(this).click(function(){
    
	$(this).addClass("cur");
	tab_lis.not($(this)).removeClass("cur");
	var pages=$(".tab_page");
    if($(this).html().indexOf("全部展开")!=-1){
           pages.show();
	}else{
		  var page_cur=pages.eq($(this).index());
		  page_cur.show();
		  pages.not(page_cur).hide();
  }
  });
})
</script>
<script>
$("input[name='ckall']").click(function(){

	if($(this)[0].checked){
	   $("input[name='ck']").attr("checked","checked");
	}else{
	    $("input[name='ck']").removeAttr("checked");
	}
});
</script>
</body>
</html>