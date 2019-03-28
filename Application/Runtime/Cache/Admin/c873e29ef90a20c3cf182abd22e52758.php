<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title><?php echo ($info["webtitle"]); ?></title>
<script language="javascript" src="/Public/js/jquery-1.7.2.min.js"></script>  
<script language="javascript" src="/Public/js/jquery.cookie.js"></script>  
<script type="text/javascript" charset="utf-8" src="/Public/ueditor1_4_3_2-utf8-php/ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/Public/ueditor1_4_3_2-utf8-php/ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="/Public/ueditor1_4_3_2-utf8-php/lang/zh-cn/zh-cn.js"></script>

<link rel="stylesheet" type="text/css" href="/Public/admin/style.css?<?php echo $g_shuiji?>"/>
<script src="/Public/admin/js/func.js"></script>
<script src="/Public/admin/js/public.js"></script>
<script src="/Public/admin/js/create_select_option.js"></script>
<script src="/Public/admin/js/classoption.js?<?php echo $g_shuiji?>"></script>
<script src="/Public/admin/js/xuanxiang.js?<?php echo $g_shuiji?>"></script>
<link rel="stylesheet" href="/Public/lightbox/css/lightbox.css" media="screen"/>
<script src="/Public/lightbox/js/lightbox-2.6.min.js"></script>
<script src="/Public/admin/js/ajax.js"></script>
<script  src="/Public/duihuakuang/duihuakuang.js?<?php echo $g_shuiji?>"></script>
<link type="text/css" href="/Public/duihuakuang/duihuakuang.css?<?php echo $g_shuiji?>"  rel="stylesheet"/>
<script src="/Public/layer-v2.3/layer/layer.js"></script>
<link rel="stylesheet" type="text/css" href="/Public/layer-v2.3/layer/skin/layer.css"/>
<link rel="stylesheet" href="/Public/font-awesome-4.7.0/css/font-awesome.min.css" media="screen"/>
</head>
<body>
<script language="javascript" src="/Public/js/loadico.js"></script>  
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
<?php if($kaoti_setting["biaomoshi"] == '1'): ?><li class="li_a">
   <div class="tit">考题<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('Exam/lists');?>"><i class='ifa fa-bus'></i>考题列表</a></li>
	    <li><a href="<?php echo U('Exam/info');?>"><i class='ifa ifa fa-tags'></i>添加考题</a></li>
		<li><a href="<?php echo U('Exam/daoru');?>"><i class='ifa ifa fa-tags'></i>导入考题</a></li>
	</ul>
  </li><?php endif; ?>
<?php if($kaoti_setting["biaomoshi"] == '2'): if(is_array($configex)): foreach($configex as $key=>$row): ?><li class="li_a">
   <div class="tit"><?php echo ($row["lang"]); ?><span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('Exam1/lists',array('table'=>$row[objtable]));?>"><i class='ifa fa-bus'></i>考题列表</a></li>
	    <li><a href="<?php echo U('Exam1/info',array('table'=>$row[objtable]));?>"><i class='ifa ifa fa-tags'></i>添加考题</a></li>
		<li><a href="<?php echo U('Exam1/daoru',array('table'=>$row[objtable]));?>"><i class='ifa ifa fa-tags'></i>导入考题</a></li>
	</ul>
  </li><?php endforeach; endif; endif; ?>
  <li class="li_a">
   <div class="tit">用户<span class="s">管理</span></div>
      <ul class="ul_b">
	    <li><a href="<?php echo U('user/lists');?>"><i class='ifa fa-user-circle-o'></i>用户列表</a></li>
	    <li><a href="<?php echo U('user/info');?>"><i class='ifa ifa fa-user-circle-o'></i>添加用户</a></li>
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
	    <li><a href="<?php echo U('config/index');?>"><i class='ifa fa-unlock-alt'></i>基础信息</a></li>
		<li><a href="<?php echo U('setting/kaoti');?>"><i class='ifa fa-unlock-alt'></i>考题系统</a></li>
	    <li><a href="<?php echo U('class/lists');?>"><i class='ifa ifa fa-tags'></i>分类列表</a></li>
		<li><a href="<?php echo U('setting/reg');?>"><i class='ifa fa-unlock-alt'></i>会员注册</a></li>
		<li><a href="<?php echo U('setting/pay');?>"><i class='ifa fa-unlock-alt'></i>支付接口</a></li>
		<li><a href="<?php echo U('setting/weixin_api');?>"><i class='ifa fa-unlock-alt'></i>微信公众号</a></li>
		<li><a href="<?php echo U('setting/email');?>"><i class='ifa fa-unlock-alt'></i>邮箱配置</a></li>
		<li><a href="<?php echo U('setting/sms');?>"><i class='ifa fa-unlock-alt'></i>短信配置</a></li>
		<li><a href="<?php echo U('setting/point');?>"><i class='ifa fa-unlock-alt'></i>积分兑换</a></li>
		<li><a href="<?php echo U('setting/kefu');?>"><i class='ifa fa-unlock-alt'></i>客服号码</a></li>
		<?php if($kaoti_setting["biaomoshi"] == '2'): ?><li><a href="<?php echo U('configex/index');?>"><i class='ifa fa-unlock-alt'></i>考题语言</a></li><?php endif; ?>
	</ul>
  </li>
 </ul>
 <h1 style="font-size:15px;margin-left:20px;" class="h1_close"><a href="<?php echo U('user/login');?>" style=" text-decoration:none;  color:#F60;">退出</a></h1>
 </div>
</div>
<div class="panel" id="panel">
<div class="mybody">

<!--标题开始-->
<div class="mytitle">
  <div class="con">
    <div class="left"><div class="t"><?php echo ($webtitle); ?></div><div class="b"><a href="<?php echo U('link/lists');?>">返回列表</a></div></div><div class="right"></div>
  </div>
</div>
<!--标题结束-->
<!--主体开始-->
<div class="mycontent paddingtop80" >
<form id="form1" name="form1" method="post" action="<?php echo U('save');?>" onsubmit="return check();">
<div class="info1">

       <div class="tab"><ol class="tab_ol"><li class="cur">基本信息</li><li>其它信息</li><li>全部展开</li></ol></div>
	   <div class="tab_page">
	   <ul class="ul_info"><li class="li1">分类：</li><li class="li2">
			<select name="classid" id="classid">
			 <option value="">请选择</option>
			<?php if(is_array($classlist)): foreach($classlist as $key=>$row): ?><option value="<?php echo ($row["id"]); ?>"><?php echo ($row["title"]); ?></option><?php endforeach; endif; ?>
			</select>
	   </li></ul>
       <ul class="ul_info"><li class="li1">标题：</li><li class="li2"><input type="text"   name="title" id="title"   class="txt1" value="<?php echo ($info["title"]); ?>"/></li></ul>
       <ul class="ul_info"><li class="li1">链接：</li><li class="li2"><input type="text"   name="href" id="href"   class="txt1" value="<?php echo ($info["href"]); ?>"/></li></ul>
	   <ul class="ul_info"><li class="li1">排序：</li><li class="li2"><input type="text"   name="sort" id="sort"   class="txt1" value="<?php echo ($info["sort"]); ?>"/></li></ul>

	   <ul class="ul_info"><li class="li1">图片：</li><li class="li2"><input type="hidden" name="photo_small" id="photo_small"  value="<?php echo ($info["photo_small"]); ?>"/><iframe src="/Public/upload_20150420/upload/php/img_iframe.php?panel_id=my_show&input_only_id=photo_small&input_more_id=ImageList&maxnum=10" scrolling="no" frameborder="0" height="80" width="80" style="margin:0px;"></iframe></li></ul>

		 <div class="clear"></div>
         </div>
		 <div class="tab_page" style="display:none;">
		    <ul class="ul_info"><li class="li1">打开方式：</li><li class="li2">
			<select name="target" id="target" class="txt1">
			 <option value="">请选择</option>
			<?php if(is_array($targetlist)): foreach($targetlist as $key=>$row): ?><option value="<?php echo ($row["value"]); ?>"><?php echo ($row["name"]); ?></option><?php endforeach; endif; ?>
			</select></li></ul>
            <ul class="ul_info"><li class="li1">简要：</li><li class="li2"><textarea name="about" id="about"  class="txt1"><?php echo ($info["about"]); ?></textarea></li></ul>
		    <ul class="ul_info"><li class="li1">内容：</li><li class="li2">
	   <script id="content" name="content" type="text/plain" style="width:100%;height:500px;"><?php echo ($info["content"]); ?></script>
	   <script> var ue = UE.getEditor('content');</script>
			</li></ul>


		 </div>
	  	     <ul class="ul_info" id="ul_qturl" style="display:none;">
		     <li class="li1">前台url：</li>
		     <li class="li2">
						<a href="<?php echo ($info["href"]); ?>" target="_blank"><?php echo ($info["href"]); ?></a>
			 </li>
		    </ul>
			<script> var id="<?php echo ($info["id"]); ?>";if(id!=""){$("#ul_qturl").show();}</script>
    </div>
	
  <div class="info_bts">
    <div class="con">
     <?php  if(is_numeric($info[id])){ ?>
	 <input type="button" onclick="javascript:window.location='<?php echo ($laiyuan); ?>';"value="返回列表" class="bt" /><input type="submit" name="btsend" class="btsend" value="更新" /><input id="id" type="hidden" name="id" value="<?php echo ($info["id"]); ?>"/><input id="act" type="hidden" name="act" value="update"/> <input type="reset" value="重置" onclick="clearinput()" />
	<?php }else{ ?>
	
	<input type="button" onclick="javascript:window.location='<?php echo ($laiyuan); ?>';"value="返回列表" class="bt" /> <input type="submit" name="btsend" value="确定" class="btsend" /><input id="act" type="hidden" name="act" value="add"/> <input type="reset" value="重置" onclick="clearinput()" />
      <?php }?>
    </div>
  </div>


</form>
</div>
<!--主体结束-->
</div>
<div class="pagenav"><?php echo ($show); ?></div>

</div>
<script>
$("#classid").val('<?php echo ($info["classid"]); ?>');
function check_banner(){
  var title=$("#title");
  var classid=$("#classid");
   var id=$("#id");
    if(classid.val()==""){
	 alert("请选择分类");
	 classid.focus();
	 return false;
  }
  if(title.val()==""){
	 alert("请输入标题");
	 title.focus();
	 return false;
  }

}
</script>
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