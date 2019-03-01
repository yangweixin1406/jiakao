<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title des="原创QQ632175205 网店https://shop73462995.taobao.com">调用例子</title>
<style>
.item{ width:100%; height:auto; float:none; clear:both;}
.user_logo{ height:100px; width:100px; position:relative; border:solid 1px #CCC;}
.user_logo iframe{ position:absolute; top:20px; left:20px;}
.user_logo img{ width:100%;}
.alert{border: solid 1px #CCC; position:absolute; top:50%;left:50%;}
.alert .alert_title{ background-color:#CCC; height:30px;  line-height:30px; text-align:center; color:#999;}
.alert .alert_con{ text-align:center;}
#photo_div img{ width:100%;}
</style>
</head>

<body>
 <div class="item">
 <h1>调用方式1</h1>

 <table><tr><td><iframe src="one.php?inputid=photo&bttext=1&qzimg=../../&textalign=left&classname=bt_lable1&btfontsize=" scrolling="no" style="height:40px;width:300px;border:0px;" frameborder="0px" allowtransparency="true"></iframe></td><td><input name="photo" id="photo" type="text"  value=""  ondblclick="OpenImage(this)"/><div id="photo_div"></div></td></tr></table>
  </div>

</body>
<script>
function onesuccess(){
	//alert("上传成功");
	    var body=document.getElementsByTagName("body")[0];
		var bt_lable=document.getElementById("bt_lable");
	    window.cheight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
	    window.cwidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
		var div=document.createElement("div");
		var h=160;
		var w=200;
		var mleft=(w/2);
		var mtop=(w/2);
		div.className="alert";
		div.style.marginLeft="-"+mtop+"px";
		div.style.marginTop="-"+mtop+"px";
		div.style.height=h+"px";
		div.style.width=w+"px";
		var conh=h-30;
		div.innerHTML="<div class='alert_title'>提示信息</div><div class='alert_con' style='height:"+(conh)+"px;'><table style='height:100%;width:100%;' border='0'><tr><td>上传成功</td></tr></table></div>";
		body.appendChild(div);
		var timer=window.setTimeout(function(){
			 body.removeChild(div);
		},2000);
		div.onclick=function(){
			 window.clearTimeout(timer);
			 body.removeChild(div);
		}
}
function update_photo(opt){

	var input=document.getElementById(opt.inputid);
	alert("上传成功！");
	if(input){
		  input.value=opt.small+"#"+opt.big;
		  var div=document.getElementById(opt.inputid+"_div");
		  if(div){
			  div.innerHTML=("<img src='"+opt.qzimg+opt.big+"'/>");
		  }
	}
//	$.ajax({
//		url:"xingxiang.asp",
//		data:{act:"touxiang",small:opt.small,big:opt.big},
//		type:"get",
//		success:function(data1){
//			//alert(data1); 
//			alert("恭喜：头像上传并保存成功！");
//		}
//	});
}
</script>
</html>
