<%
response.AddHeader "Access-Control-Allow-Origin","http://www.dcmcbook.com/"
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style>
.parent_bt{position:absolute; top:0px; left:0px; line-height:100px;width:100px; height:100px; text-align:center; cursor:pointer; }
.parent_bt.on{ color:#666;}
*{ outline:none;-moz-outline-style: none;-webkit-outline-style: none;outline-style: none;blr:e-xpression(this.onFocus=this.close());} /* 针对IE */
form *{ cursor:pointer;}
body,html{ padding:0px; margin:0px; background-color:#FFF;}
</style>
<script src="js/config.js?14"></script>
<script src="js/20150401.js?14"></script>
</head>
<body>
<div id="item1" style=" width:100%; background-color:#eeeeee;position:relative;overflow:visible;display:none;">
<form  name="upform1" id="item1_upform1" enctype="multipart/form-data" method="post" action="img_upload.asp"  style="margin:0px; padding:0px; line-height:0px; border:0px;">
<input name="upfile0"  id="item1_upfile"  type="file" multiple="multiple" accept="image/*"  style=" cursor:pointer; position:absolute; width:50px; height:60px; z-index:1000;"/>
<input name="other" id="other" type="hidden" />
<input name="w1" id="w1" type="hidden" />
<input name="w2" id="w2" type="hidden" />
<input name="dir1" id="dir1" type="hidden" /> 
<input name="dir2" id="dir2" type="hidden" />
<input name="dir3" id="dir3" type="hidden" />
<div id="item1_divbg" style=" top:0px; height:100%;width:100%; left:0px; position:absolute; z-index:5; text-align:center;"></div>
<input name="btsend" id="item1_btsend" type="submit" value="提交" style=" position:absolute; top:-100px; left:0px;"/>
</form>
</div>
<div id="item2" style="display:none;">
  <div id="mydiv" style="background-color:#6595d6; color:#fff; font-size:13px; position:relative; height:100px; width:100px;overflow:hidden;-border-radius:5px;"></div>
  <canvas id="xiaotu_canvas" style=" background-color:#FFF;"></canvas>
</div>
<script>
window.URL = window.URL || window.webkitURL;
var cururl=String(window.location);
var imgsrc="";//初始图片
var arr=cururl.split("/");
var curdir="";
for(var i=0;i<arr.length-1;i++){
	curdir+=arr[i]+"/";
}
var arr=cururl.split("img_iframe.asp");
var cur_path=arr[0];
var ajax_url="ajax.asp";//设置后台处理程序接口
var arr=cururl.split("?");
var otherinput=document.getElementById("other");
if(otherinput){
	otherinput.value=arr[1]+"&session=1";
}



var imgclass="";
var imgstr="";
var imgsrc_moren="";
var smallsrc="";
var input_only_id=""; //存单张图的input id
var input_more_id=""; //存多张图的input id
var w1_txt=document.getElementById("w1");
w1_txt.value=g_small_width;

var w2_txt=document.getElementById("w2");
w2_txt.value=g_mid_width;

var dir1_txt=document.getElementById("dir1");
dir1_txt.value=g_small_dir1;

var dir2_txt=document.getElementById("dir2");
dir2_txt.value=g_mid_dir2;

var dir3_txt=document.getElementById("dir3");
dir3_txt.value=g_big_dir3;

if(arr.length>1){
	
	var items=arr[1].split("&");
	var item_id="";
	var height=100;
	var width=100;
	var panel_id="";
	var maxnum=0;
	var float="";
	var type="";
	for(var i=0;i<items.length;i++){
		var values=items[i].split("=");
		if(values[0]=="item_id"){
			item_id=values[1];
		}
		if(values[0]=="height"){
			height=values[1];
		}
		if(values[0]=="width"){
			width=values[1];
		}
		if(values[0]=="panel_id"){
			panel_id=values[1];
		}

		if(values[0]=="maxnum"){
			maxnum=parseInt(values[1]);
		}
		if(values[0]=="float"){
			
			float=String(values[1]);
		}
		if(values[0]=="tablename"){
			tablename=values[1];
		}
		if(values[0]=="imgclass"){
			imgclass=values[1];
		}
		if(values[0]=="imgstr"){
			imgstr=values[1];
		}
		if(values[0]=="smallsrc"){
			smallsrc=values[1];
		}
		if(values[0]=="input_only_id"){
			input_only_id=values[1];
		}
		if(values[0]=="input_more_id"){
			input_more_id=values[1];
		}
	}

    window.clientHeight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
    window.clientWidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
	var objtable=window.parent.document.getElementById(item_id); 
	var objpanel=window.parent.document.getElementById(panel_id); //图片显示区
	var item1=document.getElementById("item1");
	var item2=document.getElementById("item2");
	var item1_divbg=document.getElementById("item1_divbg");
	var item1_upfile=document.getElementById("item1_upfile");
	var us=String(navigator.userAgent);
	var inputdan=null;
	var inputmore=null;
	var inputsmall=null;
	var inputmid=null;
	var inputbig=null;
	item1_divbg.style.height=window.clientHeight+"px";
	item1_divbg.style.width=window.clientWidth+"px";
	item1_divbg.innerHTML="<table cellpadding='0' cellspacing='0' border='0' style='height:"+window.clientHeight+"px;width:100%;'><tr style='height:100%;'><td valign='middle' style='height:100%;'><img src='"+g_fengmian_src+"' style='width:"+window.clientWidth+"px; height:"+window.clientHeight+";'/></td></tr></table>";


	if(objtable){
			var childs=objtable.getElementsByTagName("*");
			for(var i=0;i<childs.length;i++){
				var myname=childs[i].getAttribute("myname");
				if(myname){
					myname=String(myname);
					if(myname=="t_input"){
						inputdan=childs[i];//小图
					}
					if(myname=="t_inputmore"){
						inputmore=childs[i];//大图
					}
					if(myname=="t_input_small"){
						inputsmall=childs[i];//小图
					}
					if(myname=="t_input_mid"){
						inputmid=childs[i];//小图
					}
					if(myname=="t_input_big"){
						inputbig=childs[i];//小图
					}
				}
				
			}
	}
	  var input_only=window.parent.document.getElementById(input_only_id);
	  var input_more=window.parent.document.getElementById(input_more_id);
	  if(input_only){
		  inputdan=input_only;
	  }
	  if(input_more){
		  inputmore=input_more;

	  }
	  
	  if(smallsrc==""){
		  if(inputdan){
			  smallsrc=inputdan.value;
		  }
		  if(inputmore){
			  smallsrc=inputmore.value;
		  }
	  }

	  if(us.indexOf("MSIE ")!=-1&&us.indexOf("MSIE 10.0")==-1){
		  // if(us.indexOf("MSIE 8.0")!=-1||us.indexOf("MSIE 6.0")!=-1||us.indexOf("MSIE 7.0")!=-1||us.indexOf("MSIE 9.0")!=-1){
	        item1.style.display="";
			item1.style.height=window.clientHeight+"px";
			var zindex=1000;
			var w=70;
			var h=window.clientHeight;
			var l=0;
			var parent1=item1_upfile.parentNode;
			item1_upfile.value="";
			parent1.removeChild(item1_upfile);
			var obj=null;
			for(var i=0;i<16;i++){
				  var file=document.createElement("input");
				  file.type="file";
				  zindex=zindex-i-1;
				  l=i*w-w;
				  file.value="";
				  file.name="upfile"+(i+1);
				  file.setAttribute("multiple","multiple");
			      file.setAttribute("accept","image/*");
				  file.style.cssText=" position:absolute;width:"+w+"px; height:"+h+"px;filter:alpha(Opacity=0.1);-moz-opacity:0.001;opacity:0.001; top:0px; left:"+l+"px;z-index:"+zindex+";";
				  file.onchange=function(){document.getElementById("item1_upform1").submit(); };
				  parent1.appendChild(file);

			}
	  			var Ul=Upload();//显示初始图片
				Ul.Init1({id:"mydiv",dir1:g_small_dir1,dir2:g_mid_dir2,dir3:g_big_dir3,objtable:objtable,input:inputdan,inputmore:inputmore,width:window.clientWidth,height:window.clientHeight,objpanel:objpanel,maxnum:maxnum,float:float,imgstr:smallsrc});
	  }else{ 

//       item1.style.display="";
//		 item1.style.height=window.clientHeight+"px";
//		 item1_upfile.style.top="2000px";
//       item1_divbg.onclick=function(){item1_upfile.click();};
//		 item1_upfile.onchange=function(){
//		 document.getElementById("item1_btsend").click();
         item2.style.display="";
		 item2.style.height=window.clientHeight+"px";
		 var Ul=Upload();//显示初始图片
		 Ul.Init({id:"mydiv",dir1:g_small_dir1,dir2:g_mid_dir2,dir3:g_big_dir3,objtable:objtable,input:inputdan,inputmore:inputmore,width:window.clientWidth,height:window.clientHeight,objpanel:objpanel,maxnum:maxnum,float:float,imgstr:smallsrc});
	}

}
//http://www.html5china.com/news/
//http://www.educity.cn/wenda/s612.html
//http://hongru.github.io/share/3D.html
</script>
</body>
</html>
