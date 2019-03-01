<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
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
<div class="mynav"><span class="name"><?php echo ($webtitle); ?></span></div>
<form id="form1" name="form1" method="post" action="<?php echo U('save');?>"  onsubmit="return check();">
<table cellpadding="10" class="tableinfo table_<?php echo ($tablename); ?>_info">
<tr>
<td align="right" class="td1">题目：</td><td class="td2"> <input type="text" name="name" id="name" value="<?php echo ($info["name"]); ?>" class="txt1"/></td>
</tr>
<tr class="">
<td align="right" class="td1">类型：</td><td class="td2"><select name="type" id="type"><option value="0" >判断题 </option><option value="1" >单选题</option><option value="2" >多选题</option></select></td>
</tr>
<tr><td valign="top" class="td1">选项：</td><td class="td_items">
        <table class="table_items"></table>
</td></tr>
<tr><td align="right" class="td1">答案：</td><td><input type="text" id="value" name="value" value="<?php echo ($info["value"]); ?>" readonly="readonly" style="border:0px; color:#666666;"/></td></tr>
<tr><td align="right" class="td1">图片：</td><td><table><td><input type="hidden" name="photo" id="photo"  value="<?php echo ($info["photo"]); ?>"/><iframe src="/phpsite/hc/kaoti/kaoti20170406/Public/upload_20150420/upload/php/img_iframe.php?panel_id=my_show&input_only_id=photo&input_more_id=ImageList&maxnum=10" scrolling="no" frameborder="0" height="80" width="80" style="margin:5px;"></iframe></td></tr></table></td></tr>
<tr><td align="right" class="td1">分类：</td><td>

<select name="classno" id="classno">
<option value="">请选择分类</option>
<?php if(is_array($classlist)): foreach($classlist as $key=>$row): ?><option value="<?php echo ($row["classno"]); ?>"><?php echo ($row["name"]); ?></option><?php endforeach; endif; ?></select></td></tr>
<tr>
<td align="right" class="td1">科目：</td><td>
<select name="kemu" id="kemu">
<?php if(is_array($kemulist)): foreach($kemulist as $key=>$row): ?><option value="<?php echo ($row["value"]); ?>"><?php echo ($row["name"]); ?></option><?php endforeach; endif; ?></select>
</td>
</tr>
</table>
<div class="btnav">
<input type="submit" name="act" id="act" value="提交" />
<input type="reset" name="button" id="button" value="重置" />
<input type="hidden" id="id" name="id" value="<?php echo ($id); ?>"/>
</div>
</form>

</body>
<script>

var items_str='<?php echo ($info["items"]); ?>';
var items_type="<?php echo ($info["type"]); ?>";
$("#classno").val('<?php echo ($info["classno"]); ?>');
$("#type").val('<?php echo ($info["type"]); ?>');
$("#kemu").val('<?php echo ($info["kemu"]); ?>');
var yes_caption="<?php echo ($info["yes_caption"]); ?>";
var no_caption="<?php echo ($info["no_caption"]); ?>";

function check(){
	var name=$("#name");
	var value=$("#value");
  if(name.val()==""){
	 alert("请输入考题题目");
	 name.focus();
	 return false;
  }
  if(value.val()==""){
	 alert("请选择答案");
	 value.focus();
	 return false;
  }
}

$("#type").change(function(){
	var str="";
	$(".table_items").children().remove();
	$("#value").val("");

	if($("#type").val()=="0"){
          xuanxiang.add({lable:"√","title":yes_caption,num:"0"});
          xuanxiang.add({lable:"×","title":no_caption,num:"0"});
	}else{
		
		if(items_str==""||items_type=="0"){
			 for(var i=0;i<4;i++){
				var zimucaption=zimu((i+1));
				xuanxiang.add({title:"",lable:zimucaption,value:zimucaption,num:"0"});
			 }
		}else{
			  xuanxiang.init({str:items_str});
		}
	}
	
	//$(".td_items").html(str);
});

var xuanxiang={
	add:function(opt){
		 var len=$(".table_items").find("tr").length;
		 var zimucaption=zimu(len+1);
		 var zimuvalue=zimu(len+1);
		 var index=len;
		 var tr="";
		 tr+='<tr>';
		 var lable="";
		 if(typeof(opt.title)=="undefined"){
			 opt.title="";
		 }
		 var myradio_checked="";
		 var v=$("#value").val().split("");
		 
		 if(opt.value&&$("#value").val()!=""){
			   for(var i=0;i<v.length;i++){
				  if(opt.value==v[i]){
					 myradio_checked="checked";
				 }
			   }
		 }
		 var input_type="";
		 
		 if($("#type").val()=="0"){
			 //zimuvalue=opt.title;
		 }
		
		 if($("#type").val()!="2"){
			 input_type="radio";
		 }else{
			 input_type="checkbox";
		 }

		//
		//<td align="right"><span class="caption">'+lable+'</span>、</td>
         tr+=' <td>副标题：<input class="xuanxiang" type="text" name="items['+index+'][lable]" class="title" value="'+opt.lable+'" style="width:60px;" />&nbsp;选项标题：<input type="text" name="items['+index+'][title]" class="title"   value="'+opt.title+'" /><input type="'+input_type+'" class="myradio" name="myradio" '+myradio_checked+' value="'+opt.value+'"/><input type="hidden" name="items['+index+'][value]" value="'+opt.value+'"  class="value"/></td>';
         tr+='</tr>';
		 $(".table_items").append(tr);
		 $(".myradio").click(function(){
	       // var xuanxiang=$(this).parent().find(".xuanxiang");
	       // alert(xuanxiang.val());
		   
		   if($("#type").val()!="2"){
			$("#value").val($(this).val());
		   }else{
			    var v="";
			   $(".myradio").each(function(){
				  
				    if($(this)[0].checked){
						v+=$(this).val();
					}

				});
				
				$("#value").val(v);
		   }
          });
	},init:function(opt){
		$(".table_items").children().remove();
		if(opt.str!=""){
			var items=eval(opt.str);
			for(var i=0;i<items.length;i++){
				var row=items[i];
				 xuanxiang.add(row);
			}
		}else{
			if($("#type").val()=="0"){
				
              xuanxiang.add({lable:"√","title":yes_caption,num:"0",value:"Y"});
              xuanxiang.add({lable:"×","title":no_caption,num:"0",value:"N"});
			}else{
				for(var i=0;i<4;i++){
					var zimucaption=zimu(i+1);
					var lable=zimucaption;
				    xuanxiang.add({title:"",lable:zimucaption,num:"0",value:zimucaption});
			    }
			}
		}
	}
}
xuanxiang.init({str:items_str});
function zimu(n)
{
  return String.fromCharCode(64 + parseInt(n));
}
</script>
</html>