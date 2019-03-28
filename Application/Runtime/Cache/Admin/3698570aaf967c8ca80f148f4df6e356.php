<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="target-densitydpi=medium-dpi,  initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<title><?php echo ($webtitle); ?></title>
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
    <div class="left"><div class="t"><?php echo ($mytitle); ?></div><div class="b"><a href="<?php echo ($laiyuan); ?>">返回列表</a></div></div><div class="right"></div>
  </div>
</div>
<!--标题结束-->
<!--主体开始-->
<div class="mycontent paddingtop80" >
<form id="form1" name="form1" method="post" action="<?php echo U('product/save');?>" onsubmit="return check();">
<div class="info1">

       <div class="tab"><ol class="tab_ol"><li class="cur">基本信息</li><li>其它信息</li><li>全部展开</li></ol></div>
	   <div class="tab_page">
	   <ul class="ul_info"><li class="li1">产品分类：</li><li class="li2"><input type="hidden"   name="classno" id="classno"   class="txt1" value="<?php echo ($info["classno"]); ?>"/></li></ul>
       <ul class="ul_info"><li class="li1">产品名称：</li><li class="li2"><input type="text"   name="title" id="title"   class="txt1" value="<?php echo ($info["title"]); ?>"/></li></ul>
	   <ul class="ul_info"><li class="li1">产品价格：</li><li class="li2"><input type="text"   name="price" id="price"   class="txt1" value="<?php echo ($info["price"]); ?>"/></li></ul>
	   <ul class="ul_info"><li class="li1">市场价格：</li><li class="li2"><input type="text"   name="prices" id="prices"   class="txt1" value="<?php echo ($info["prices"]); ?>"/></li></ul>
	   <ul class="ul_info"><li class="li1">标记：</li><li class="li2">
	   <script>CreateRadio("lable","<?php echo ($info["lable"]); ?>","<?php echo $GLOBALS['g_product']['lable']?>")</script></li></ul>
	   <ul class="ul_info">
	   <li class="li1">状态：</li>
	   <li class="li2">
		<select name="state" id="state">
		<?php if(is_array($statelist)): foreach($statelist as $key=>$row): ?><option value="<?php echo ($row["value"]); ?>"><?php echo ($row["name"]); ?></option><?php endforeach; endif; ?>
		</select>
		</li>
       </ul>
	   
	   <ul class="ul_info"><li class="li1">描述：</li><li class="li2">
	   <script id="content" name="content" type="text/plain" style="width:100%;height:500px;"><?php echo ($info["content"]); ?></script>
	   <script> var ue = UE.getEditor('content');</script> </li></ul>
	   <ul class="ul_info" style=" overflow:hidden;"><li class="li1">文章图片：</li><li class="li2" style=" overflow:hidden;">
				<p><textarea  id="photos" name="photos" class="txt1" style="display:none;"><?php echo ($info["photos"]); ?></textarea></p>
				<div id="photos_weizhi" style=" text-align:center; background-color:#3399FF; height:50px; width:100px; color:#fff; line-height:50px; text-align:center; float:left; margin-right:10px; cursor:pointer;">上传图片</div>
				<div id="photos_panel" style="height:auto; width:auto; float:left; overflow:hidden;"></div>
				<span  id="num_maxnum" style="line-height:50px; font-size:20px;"></span>
	   </li>
      </ul>

	     <ul class="ul_info" id="ul_qturl" style="display:none;">
		     <li class="li1">前台url：</li>
		     <li class="li2">
						<a href="/index.php?m=Qiyue&c=News&a=info&id=<?php echo ($info["id"]); ?>" target="_blank">/index.php?m=Qiyue&c=News&a=info&id=<?php echo ($info["id"]); ?></a>
						<br/>
						<a href="/index.php?m=Qiyue&c=about&a=info&id=<?php echo ($info["id"]); ?>" target="_blank">/index.php?m=Qiyue&c=about&a=info&id=<?php echo ($info["id"]); ?></a>
			 </li>
		 </ul>
		 <script> var id="<?php echo ($info["id"]); ?>";if(id!=""){$("#ul_qturl").show();}</script>
		 <div class="clear"></div>
         </div>
		 <div class="tab_page" style="display:none;">
		    <ul class="ul_info"><li class="li1">店家：</li><li class="li2"><?php echo ($info["shopname"]); ?><input type="text"  name="dianjiaid" id="dianjiaid"   class="txt1" value="<?php echo ($info["dianjiaid"]); ?>"/></li></ul>
		    <ul class="ul_info"><li class="li1">排序：</li><li class="li2"><input type="text"  name="sort" id="sort"   class="txt1" value="<?php echo ($info["sort"]); ?>"/></li></ul>
		    <ul class="ul_info"><li class="li1">关键词：</li><li class="li2"><textarea type="text"  name="key" id="key"   class="txt1" ><?php echo ($info["key"]); ?></textarea></li></ul>
		    <ul class="ul_info"><li class="li1">简要：</li><li class="li2"><textarea type="text"  name="des" id="des"   class="txt1" ><?php echo ($info["des"]); ?></textarea></li></ul>
			<ul class="ul_info"><li class="li1">浏览量：</li><li class="li2"><input type="text"  name="see_num" id="see_num"   class="txt1" value="<?php echo ($info["see_num"]); ?>"/></li></ul>
			<ul class="ul_info"><li class="li1">参数选项：</li><li class="li2">
                 <div id="canshuoption1" class="xuanxiang" style="overflow:hidden; overflow:hidden;"></div>
			</li>
			</ul>
			<ul class="ul_info"><li class="li1">价格选项：</li><li class="li2">
                 <div id="priceoption1" class="xuanxiang"></div>
			</li>
			</ul>
<div class="clear"></div>
		 </div>
	  
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
<script>
ClassOption().init({url:"<?php echo U('class/classoption');?>","id":"classno","fatherno":"<?php echo $GLOBALS['g_product']['classno']?>","classno":"<?php echo $info['classno']?>"});
</script>

<script src="/Public/uploadhtml5e/js/hcsy.js?3"></script>
<script src="/Public/uploadhtml5e/js/hcfile.config-0.3.js?2"></script>
<script src="/Public/uploadhtml5e/js/hcfile-0.3.js?3"></script>
<link href="/Public/uploadhtml5e/js/hcfile03.css" rel="stylesheet" type="text/css">
<script>

var priceoption_json='<?php echo ($info["priceoption"]); ?>';
var canshuoption_json='<?php echo ($info["canshuoption"]); ?>';

xuanxiang().init({parentid:"priceoption1",name:"priceoption",fields:[{"title":"规格","field":"title"},{"title":"价格","field":"price",type:"int"}],values:priceoption_json});
xuanxiang().init({parentid:"canshuoption1",name:"canshuoption",fields:[{"title":"参数名","field":"title"},{"title":"参数值","field":"value",type:"text"}],values:canshuoption_json});
</script>
<script>

  hcfile().Init({
		  url:"/Public/uploadhtml5e/include/php/ajax.php",
		  maxnum:10,//只能上传N张
		  type:"img",//yinpin:仅上传音频文件,shipin:仅上传视频文件,img:仅上传图片,不填或all表示全部
		  input_id:"photos",//存多张图片路径的input的id
		  weizhi_id:"photos_weizhi",//选择按钮位置对像id
		  panel_id:"photos_panel",//图片文件显示对象id
		  input_fengmian_id:'',//存封面的图片路径input对象id
		  bgsrc:"",//按钮图片
		  img_fdsize:1024*10,//每段图片的大小，最好不要超过1M
		  ischongxuan:0,//1显示重选按钮
		  drop_to_id:"drop_div",//托入有效区域对象id,如填写成document则将整个网页做为有效区域
		  send_id:"send",//确定上传按钮位置对像id,不填写或填写auto则自动上传
		  item_class:"myitem_small", //样式 可以不填写，不填写为显示图片
		  select_num_id:"select_num", //可以不填写，显示当前要上传的文件个数的对象id
		  success_num_id:"success_num", //可以不填写，显示当前要已上传的文件总个数的对象id
		  max_num_id:"max_num", //可以不填写，显示允许上传的个数
		  siteurl_file:"/",
		  ico_path:"/Public/uploadhtml5e/images/",
		  down_url:"/Public/uploadhtml5e/include/php/down.php",//可以不填写，下载的
		  bt_del_text:"删除",
		  upload_show:{date:0,size:0,name:0,bar:1,baifenbi:1,del:0,bg:1},//上传过程中要显示的元素,1:显示,0不显示 date(日期) size(大小) name(标题) bar(进度条) baifenbi(进度条) del(删除按钮)
		  success_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:1,bg:0},//上传完后要显示的元素,1:显示,0不显
		  success:function(op){
			  var obj=document.getElementById("num_maxnum");
			  if(op.num>0){
			   obj.innerHTML=" "+op.num+"/"+op.maxnum;
			  }else{
			  obj.innerHTML="";
			  }
		  }
 });

</script>
</div>
<script>
$("#state").val('<?php echo ($info["state"]); ?>');

function check(){
  var name=$("#name");
  var price=$("#price");
  var prices=$("#prices");
   var id=$("#id");
  if(name.val()==""){
	 alert("请输入名称");
	 name.focus();
	 return false;
  }
  if(price.val()==""){
     if(price.val()==""){
	  alert("请输入价格");
	  price.focus();
	  return false;
	 }
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