<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
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
<style>
*{font-size:12px;}
html,body{ padding:0px;margin:0px;}
</style>
<script>
var ObjId="<?php echo ($ObjId); ?>";
var pathfile="<?php echo ($pathfile); ?>";
function showImage(opt){
	var fsName=window.parent.document.getElementById(ObjId);
	//alert(imgsrc_);
	if(fsName!=null){
	    fsName.value=opt.value;
	}
}
function Upload(){
	 document.getElementById("upform1").submit(); 
}
function UpfileClick(){
	 document.getElementById("upfile").click(); 
}
</script>
</head>
<body style="margin:0px; padding:0px; height:50px;overflow:hidden; ">
<form name="upform1" id="upform1" enctype="multipart/form-data" method="post" action="<?php echo U('save');?>"  style="margin:0px; padding:0px; line-height:0px; border:0px;">
<input type="hidden" name="folder" value="<?php echo ($folder); ?>"/>
<input type="hidden" name="quan" value="<?php echo ($quan); ?>"/>
<input type="hidden" name="ObjId" value="<?php echo ($ObjId); ?>"/>

<div style=" position:relative;overflow:visible;"><input type="file" name="upfile" id="upfile"  onchange="Upload()" style="filter:alpha(Opacity=1);-moz-opacity:0.01;opacity:0.01; cursor:pointer; position:absolute; width:50px; height:60px; z-index:1000;"/><input  type="button" name="Submit1" value="选择"   style=" top:0px; height:23px; left:0px; position:absolute; z-index:5;"/><input  type="button" name="Submit" value="提交"   style=" display:none;" onclick="UpfileClick()"/></div>
</form>
</body>
<script>
if(pathfile!=""){
  showImage({value:pathfile});
}
</script>
</html>