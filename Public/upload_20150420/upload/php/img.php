<?php include("function.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style>
.parent_bt{position:absolute; top:0px; left:0px; line-height:100px;width:100px; height:100px; text-align:center; cursor:pointer; }
.parent_bt.on{ color:#666;}
*{ outline:none;-moz-outline-style: none;-webkit-outline-style: none;outline-style: none;blr:e­xpression(this.onFocus=this.close());} /* 针对IE */
form *{ cursor:pointer;}
body,html{ padding:0px; margin:0px; background-color:#FFF; background-color:#F9C}
</style>
<script>
function Ajax(opt){
 opt.type=opt.type.toUpperCase(); //转为大写
 var xmlhttp=null;
 if(window.XMLHttpRequest){  
 xmlhttp=new XMLHttpRequest() ; }else if(window.ActiveXObject){xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");} 
 if(opt.type=="GET"){
     xmlhttp.open(opt.type,opt.url+"?"+opt.addstr,true);
 }else{
     xmlhttp.open(opt.type,opt.url,true);
 } 
 xmlhttp.onreadystatechange=function(){
		if(xmlhttp.readyState==4){
			var str1=xmlhttp.responseText.replace(/[\r\n]/g, "");
			if(opt.complete){
			 opt.complete(str1);//运行回调函数
			}
			xmlhttp=null;
		}
 };
  xmlhttp.setRequestHeader('Content-Type', opt.contenttype); 
 if(opt.type=="GET"){ 
   xmlhttp.send("");
 } else{
    xmlhttp.send(opt.addstr);//这个是POST方式的abort
 } 
 return xmlhttp;
}
</script>
<?php
//$imgsrc="";
//if ($_SERVER['REQUEST_METHOD'] == 'POST'){
//	
//	//http://zhidao.baidu.com/link?url=55VcmhPOlB0XGPt6s_8ATPwCOfH_hXUXYbGiz9tHps1H4ANr8bO6CESk1Zbg0M-cZD-ncD3ojNMkxXt9uqk6rK
//	$yy=0;
//	for ($i=0;$i<count($_FILES);$i++){
//	          if(!empty($_FILES["upfile".$i]["name"])){
//					$cengci="../";
//					$dir1="file/s50/";  //小图文件夹
//					$dir2="file/s80/";  //中图文件夹
//					$dir3="file/s100/"; //大图文件夹
//					$w1=100;  //小图宽度
//					$w2=300;  //中图宽度
//					$src1=UpImg($_FILES["upfile".$i],"../",$dir1,$dir2,$dir3,$w1,$w2);
//					$src2=str_ireplace($dir1,$dir2,$src1);
//					$src3=str_ireplace($dir1,$dir3,$src1);
//					$imgsrc=$src2;
//					
//					$yy++;
//	          }
//
//    }
//
//}
//    if($imgsrc!=""){
//	$img="";
//	}
?>
</head>

<body>


<div id="item2" >
  <div id="mydiv" style="background-color:#6595d6; color:#fff; font-size:13px; position:relative; height:100px; width:100px;overflow:hidden;-border-radius:5px;"></div>
  <canvas id="xiaotu_canvas" style=" background-color:#FFF;"></canvas>
</div>
<script>
var cur_src1="<?php echo $src1?>";
var cur_src2="<?php echo $src2?>";
var cur_src3="<?php echo $src3?>";
window.URL = window.URL || window.webkitURL;
var cururl=String(window.location);
var imgsrc="<?php echo $imgsrc?>";//初始图片
var g_imgcengci="";
var arr=cururl.split("/");
var curdir="";
for(var i=0;i<arr.length-1;i++){
	curdir+=arr[i]+"/";
}
var ajax_url="ajax.php";//设置后台处理程序接口
var arr=cururl.split("?");
var tablename="";//表名
var Yishoufangid=""; //楼盘id

var g_mid_width=200;  //设置中图宽度
var g_mid_height=200; //设置中图高度
var g_small_width=200; //设置小图宽度
var g_small_height=200; //设置小图高度

var g_small_dir1="file/photo/";
var g_mid_dir2="file/photo/";
var g_big_dir3="file/photo/";
var g_input_dir="file/photo/";//设置返回图片的路经,这里返回的是小图路径给父页中的input
var imgclass="";
var imgstr="";
var imgsrc_moren="";
if(arr.length>1){
	
	var items=arr[1].split("&");
	var item_id="";
	var height=100;
	var width=100;
	var panel_id="";
	var maxnum=0;
	var float="";
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
		
	}
	var cengci="../";
	if(imgclass=="1"){
		imgsrc_moren="images/class1.png";
	}
	if(imgclass=="2"){
		imgsrc_moren="images/class2.png";
	}
	if(imgclass=="3"){
		imgsrc_moren="images/class3.png";
	}
	
	if(imgsrc_moren==""){
		imgsrc_moren="images/null_img.gif";
		
	}
	if(String(imgsrc)==""){
		imgsrc=imgsrc_moren;
	}else{
		imgsrc=cengci+imgsrc;
	}
    window.clientHeight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
    window.clientWidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
	var objtable=window.parent.document.getElementById(item_id);
	var objpanel=window.parent.document.getElementById(panel_id);
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
	if(inputdan!=null){
		inputdan.value=cur_src3;
	}
	if(inputsmall!=null){
		inputsmall.value=cur_src1;
	}
	if(inputmid!=null){
		inputmid.value=cur_src2;
	}
	if(inputbig!=null){
		inputbig.value=cur_src3;
	}

	   if(us.indexOf("MSIE 8.0")!=-1||us.indexOf("MSIE 6.0")!=-1||us.indexOf("MSIE 7.0")!=-1||us.indexOf("MSIE 9.0")!=-1){
            alert("ie10以下的不支持");

	  }else{
		  	if(item_id!=""&&objtable!=null){
					var Ul=Upload();//显示初始图片
					Ul.Init({id:"mydiv",dir1:g_small_dir1,dir2:g_mid_dir2,dir3:g_big_dir3,objtable:objtable,width:window.clientWidth,height:window.clientHeight,objpanel:objpanel,maxnum:maxnum,float:float,imgstr:imgstr});
			}else{
					alert("上传图片初始化失败");
			}
	  }
}

function Upload(){
	var Upload_={
		Init:function(opt){

			var t=this;
			t.opt=opt;
			if(!t.opt.dir1){
			t.opt.dir1="file/s50/"; //小图
			}
			if(!t.opt.dir2){
			t.opt.dir2="file/s80/";//中图
			}
			if(!t.opt.dir3){
			t.opt.dir3="file/s100/";//原图
			}
			t.curdir=curdir;
             
			t.countz=0;
			t.timer=null;
			t.maxsize=5;//M为单位 限制大小
			var parent=document.getElementById(opt.id);
			parent.innerHTML="";
			parent.style.position="relative";
			parent.style.height=opt.height+"px";
			parent.style.width=opt.width+"px";
			parent.style.overflow="hidden";
			var parent_bt=document.createElement("div");
			parent_bt.className="parent_bt";
			parent_bt.id=parent.id+"_bt";
	   
			parent_bt.style.height=opt.height+"px";
			parent_bt.style.width=opt.width+"px";
			parent_bt.setAttribute("caption","点击上传");
			parent_bt.innerHTML=parent_bt.getAttribute("caption");
			parent_bt.style.textAlign="center";
			parent_bt.style.lineHeight=opt.height+"px";
			parent.appendChild(parent_bt);
			t.bt=parent_bt;
			
			var parent_file=document.createElement("input");
			parent_file.id=parent.id+"_file";
			parent_file.type="file";
			parent_file.style.cssText="position:absolute; bottom:-"+opt.height+"px;left:0px;";
			parent_file.setAttribute("multiple","multiple");
			parent_file.setAttribute("accept","image/*");
			parent_file.style.height=opt.height+"px";
			parent_file.style.width=opt.width+"px";
			parent_file.onchange=function(){
				
				t.LoadFile({obj:this});
			}

			parent_bt.onclick=function(){
				if((t.countz+1)>t.opt.maxnum&&t.opt.maxnum>0){
							alert("最多只能上传"+t.opt.maxnum+"张");
							return false;
				}
				if(parent_bt.innerHTML.indexOf(this.getAttribute("caption"))!=-1){
				   parent_file.click();
				}
			}
			parent.appendChild(parent_file);
			var childs=objtable.getElementsByTagName("*");
			for(var i=0;i<childs.length;i++){
				var myname=childs[i].getAttribute("myname");
				if(myname){
					myname=String(myname);
					if(myname=="t_small"){
						
					    t.txt1=childs[i]; //小图文本框
						t.txt1.value="";
					}
					if(myname=="t_mid"){
						
						t.txt2=childs[i]; //中图文本框
						t.txt2.value="";
					}
					if(myname=="t_big"){
						t.txt3=childs[i];//大图文本框
						t.txt3.value="";
					}
					if(myname=="t_small_lable"){
						t.txt1_lable=childs[i];//大图提示
					}
					if(myname=="t_mid_lable"){
						t.txt2_lable=childs[i];//大图提示
					}
					if(myname=="t_big_lable"){
						t.txt3_lable=childs[i];//大图提示
					}
					if(myname=="t_input"){
						t.input=childs[i];//大图提示
						t.input.value="";
					}
					if(myname=="t_inputmore"){
						t.inputmore=childs[i];//大图提示
						t.inputmore.value="";
					}
					
				}
			}
			
			if(t.txt1_lable){
				t.txt1_lable.innerHTML="";
				t.txt1_lable.setAttribute("title","双击查看图片");
				t.txt1_lable.ondblclick=function(){
					if(this.innerHTML!=""){
						window.open("../"+this.innerHTML);
					}
				}
			}
			if(t.txt2_lable){
				t.txt2_lable.innerHTML="";
				t.txt2_lable.setAttribute("title","双击查看图片");
				t.txt2_lable.ondblclick=function(){
					if(this.innerHTML!=""){
						window.open("../"+this.innerHTML);
					}
				}
			}
			if(t.txt3_lable){
				t.txt3_lable.innerHTML="";
				t.txt3_lable.setAttribute("title","双击查看图片");
				t.txt3_lable.ondblclick=function(){
					if(this.innerHTML!=""){
						window.open("../"+this.innerHTML);
					}
				}
			}
		   var imgs=opt.imgstr.split("#");
		   for(var i=0;i<imgs.length;i++){
				if(imgs[i]!=""){
					 var values=imgs[i].split("|");
					 var src=values[0];
					 var addstr="&no="+values[1];
					  var myitem=t.ShowImgA({filename:"images/loading1.gif"});
					  if(myitem!=null){myitem.childNodes[1].style.display="";myitem.childNodes[2].style.display="none";
						 myitem.setAttribute("myvalue",src);
						 myitem.setAttribute("myaddstr",addstr);
						 myitem.getElementsByTagName("img")[0].src="../"+src;
						 myitem.getElementsByTagName("img")[0].onclick=function(){
						 window.open(this.src.replace(t.opt.dir1,t.opt.dir3));
					  }
				   }
				}
		   }
		},LoadFile:function(opt){
			var t=this;
		    var files = opt.obj.files,
			img = new Image();	
			var us=String(navigator.userAgent);
			if(us.indexOf("MSIE 7.0")!=-1||us.indexOf("MSIE 6.0")!=-1||us.indexOf("MSIE 8.0")!=-1||us.indexOf("MSIE 9.0")!=-1){
                alert("你的浏览器不支持html5");
			}else { //ie10以上才可以  if(window.FileReader
					//我们用FileReader对象来处理
				t.filecount+files.length;
				var count_0=t.countz;
				for(var ii=0;ii<files.length;ii++){
					count_0++;
					if((count_0)>t.opt.maxnum&&t.opt.maxnum>0){
						alert("最多只能上传"+t.opt.maxnum+"张");
						 break;
					}else{
                       t.New(files[ii],files.length);
					}
				}
			}
		},New:function(file,filecountz){
			var t=this;
					var reader = new FileReader();
					reader.readAsDataURL(file);
					var img = new Image();	
					reader.onload = function(e){
						img.src = this.result; //this就是指reader
						//alert(this.result);
						var myext="";
						var old_data="";//去前前面的22或23个字符,ie10是13,后面的字符串才是我们想要获取的图片的base64编码
//						if(!(this.result.indexOf("data:image/jpeg;base64,")!=-1||this.result.indexOf("data:image/png;base64,")!=-1||this.result.indexOf("data:image/gif;base64,")!=-1||this.result.indexOf("data:;base64,")!=-1)){
//							alert("请选择图片文件");
//							return false;/
//						}
						if(this.result.indexOf("data:image/jpeg;base64,")!=-1){ //data:image/gif;base64,和data:image/png;base64,才是22个字符
							old_data=this.result.substr(23);
						}else if(this.result.indexOf("data:;base64,")!=-1){ //data:image/gif;base64,和data:image/png;base64,才是22个字符
							old_data=this.result.substr(13);
							myext="png";
						}else{
							old_data=this.result.substr(22);
						}
						if((t.countz+1)>t.opt.maxnum&&t.opt.maxnum>0){
							alert("最多只能上传"+t.opt.maxnum+"张");
							return false;
						}

						var bytes=e.total;
						img.onload = function(e) {
							var bilv=this.width/this.height;
							var old_width=this.width;
							var old_height=this.height;
							
							var small_width=g_small_width; //小图大小
							var small_height=g_small_width/bilv;
							var mid_width=g_mid_width;  //中图大小
							var mid_height=g_mid_width/bilv;

							
								this.width = small_width;
								this.height=small_width/bilv;
								
								var size=parseInt(bytes/1024);
								if(size/1024>t.maxsize){
									alert("图片大小不能超过5M");
									return false;
								}
								var canvas=document.getElementById("xiaotu_canvas");
								canvas.width=old_width;
								canvas.height= old_height;
								var ctx=canvas.getContext('2d');
								ctx.drawImage(this,0,0,old_width,old_height);
								
								var items=file.name.split(".");
								var ext=items[items.length-1];
								if(myext!=""){
									ext=myext;
								}
								ext=ext.toLowerCase();
								var imgData =canvas.toDataURL("image/png");
								var data = old_data;
								var title=file.name.substr(0,file.name.length-ext.length-1);
								var start=0;
								var num=0;
								var base64str="";
								  while(start<data.length){
									num++;
									var value=data.substr(start,9000);
									value=value.replace(/\+/g,"[jh]"); 
									base64str+="&value"+num+"="+(value);
									start+=9000;
								  }
								  if(t.txt1_lable!=null){t.txt1_lable.innerHTML="<span>正在生成…</span>";}
								  if(t.txt2_lable!=null){t.txt2_lable.innerHTML="<span>正在生成…</span>";}
								  if(t.txt3_lable!=null){t.txt3_lable.innerHTML="<span>正在生成…</span>";}
								  if(t.opt.float==""){
								    t.bt.innerHTML="<span style='font-size:13px;'>正在上传</span>";
								  }
//								  t.time=window.setTimeout(function(){
//									   t.bt.innerHTML="<span style='font-size:13px;'>正在上传("+t.filecount+"/"+filecountz+")</span>";
//									   if(t.filecount==filecountz){
//										   t.bt.innerHTML=t.bt.getAttribute("caption");
//										   window.clearTimeout(t.time);
//									   }
//								  },1000);
									t.bt.className="parent_bt on";
									
									var myitem=t.ShowImgA({filename:"upload_html5_php_20150414/images/loading1.gif"});
									var addstr1="";
									addstr1+="&title="+title;
									addstr1+="&w1="+small_width+"&h1="+small_height;

									addstr1+="&w2="+mid_width+"&h2="+mid_height;
									addstr1+="&dir1="+t.opt.dir1+"&dir2="+t.opt.dir2+"&dir3="+t.opt.dir3;
									addstr1+="&num="+num+"&ext="+ext+"&title="+title+"&size="+size+"&bilv="+fomatFloat(bilv,4);
									//alert(addstr1);
									Ajax({url:ajax_url,type:"POST",addstr:"act=up"+base64str+addstr1,func:function(filename){ //生成小图后
                                         var smallsrc=filename;
										 
										  filename=filename.replace(g_mid_dir2,g_input_dir);
										  filename=filename.replace(g_big_dir3,g_input_dir);
										  
										  smallsrc=smallsrc.replace(g_mid_dir2,g_input_dir);
										  smallsrc=smallsrc.replace(g_big_dir3,g_input_dir);
										 
										  if(filename!=""){
												  if(t.input){t.input.value=filename}
												  if(t.inputmore){ if(t.inputmore.value!=""){t.inputmore.value+="#"+filename}else{t.inputmore.value=filename}}
												   if(myitem!=null){
													   
													  myitem.setAttribute("myvalue",smallsrc);
													  myitem.getElementsByTagName("img")[0].src=g_imgcengci+smallsrc;
												   }
												   
												   t.countz++;
												   t.filecount++;
												   
											  	   if(t.txt1!=null){t.txt1.value=filename; }
												   if(t.txt1_lable!=null){t.txt1_lable.innerHTML=filename;}
											       var arr=filename.split("/");
												   var dir="";
												   for(var i=0;i<arr.length-1;i++){
														   dir+=arr[i]+"/";
												   }
												   var name=arr[arr.length-1];

												   var fullpath_big=t.opt.dir3+name;
												   var fullpath_mid=t.opt.dir2+name;

												  if(t.txt2!=null){t.txt2.value=fullpath_mid;}
												  if(t.txt2_lable!=null){t.txt2_lable.innerHTML=fullpath_mid;}
												  
												  if(t.txt3!=null){t.txt3.value=fullpath_big;}
												  if(t.txt3_lable!=null){t.txt3_lable.innerHTML=fullpath_big;}
												  
												  t.bt.innerHTML=t.bt.getAttribute("caption");
												  
												  if(myitem!=null){
													   myitem.childNodes[1].style.display="";myitem.childNodes[2].style.display="none"; 
													   myitem.getElementsByTagName("img")[0].onclick=function(){
														 window.open(this.src.replace(t.opt.dir1,t.opt.dir3));
														}
												   }
												  
												   t.bt.className="parent_bt";
												   
										  }
									}});
						}
						 //fileList.appendChild(img);
					}
	   },ShowImgA:function(opt){
		   var t=this;
		   var obj=null;
				 if(t.opt.objpanel!=null){
					var rel=document.createElement("div");
					rel.setAttribute("myvalue","");
					rel.setAttribute("myaddstr","");
					var h=t.opt.height;
					var w=t.opt.width;
					
					rel.style.cssText="height:"+h+"px;width:"+w+"px;float:left;overflow:hidden;border:#CCC solid 1px;margin:5px;position:relative;";
					var span_abs=document.createElement("span");
					span_abs.style.cssText="display:black;position:absolute; top:1px;left:1px;overflow:hidden;";
					span_abs.style.height=(h-2)+"px";
					span_abs.style.width=(w-2)+"px";
					span_abs.innerHTML="<img src='"+opt.filename+"' style='height:auto;width:100%;'/><style>.bt_abs{background-color:#666;}.bt_abs:hover{color:#fff; background-color:#ff0000;}</style>";
					rel.appendChild(span_abs);

					var bt_abs=document.createElement("input");
					bt_abs.type="button";
					bt_abs.value="×";
					
					bt_abs.onclick=function(){
						if(confirm("确定要删除？")){
						var parent=this.parentNode;
						var value=parent.getAttribute("myvalue");
						var myaddstr=parent.getAttribute("myaddstr");
						
						parent.parentNode.removeChild(parent);
						if(t.inputmore!=null){
							var values=t.inputmore.value.split("#");
							var newstr="";
							for(var i=0;i<values.length;i++){
								if(values[i]!=value){
									if(newstr!=""){
										newstr+="#"+values[i];
									}else{
										newstr=values[i];
									}
								}else{
									if(t.input){
										if(t.input.value==value){
											t.input.value="";
											if(t.txt1!=null){t.txt1.value="";}
											if(t.txt2!=null){t.txt2.value="";}
											if(t.txt3!=null){t.txt3.value="";}
											if(t.txt1_lable!=null){t.txt1_lable.innerHTML="";}
											if(t.txt2_lable!=null){t.txt2_lable.innerHTML="";}
											if(t.txt3_lable!=null){t.txt3_lable.innerHTML="";}
										}
									}
									t.countz--;
								}
							}
						     t.inputmore.value=newstr;
						}
						}
						 var arr=value.split("/");
						 var name=arr[arr.length-1];
						 var addstr="&path1="+t.opt.dir1+name+"&path2="+t.opt.dir2+name+"&path3="+t.opt.dir3+name+myaddstr;
						 Ajax({url:ajax_url,type:"POST",addstr:"act=del"+addstr,func:function(html){if(opt.func){opt.func();}}});
					}
					bt_abs.style.cssText="border:0px;position:absolute; margin:0px; top:1px;right:1px;overflow:hidden;";
					bt_abs.style.display="none";
				    bt_abs.className="bt_abs";
					rel.appendChild(bt_abs);
					var p_abs=document.createElement("p");
					p_abs.style.cssText="dislpay:black;position:absolute;font-weight:bold; color:#ffffff; top:0px;left:0px;line-height:"+h+"px;overflow:hidden;text-align:center;margin:0px;background-color:#000000;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;";
					p_abs.style.height=h+"px";
					p_abs.style.width=w+"px";
					p_abs.innerHTML="正在上传";
					rel.appendChild(p_abs);
					var iframes=t.opt.objpanel.getElementsByTagName("iframe");
					if(iframes.length>0){
					  t.opt.objpanel.insertBefore(rel,iframes[0]);
					}else{
					   t.opt.objpanel.appendChild(rel);
					}
					obj=rel;
				 }
		  return obj;
	   }
	}
	return Upload_;
}
function fomatFloat(src,pos){     
             return Math.round(src*Math.pow(10, pos))/Math.pow(10, pos);     
}
function Ajax(option){
		 var xmlHttp=null;
		 //创建ajax对象
		 if(window.XMLHttpRequest){  
		 xmlHttp=new XMLHttpRequest() ; 
		 }else if(window.ActiveXObject){  
		 /*不能写成axtivexobject否则会出错*/
		 xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		 } 
		 option.type=option.type.toUpperCase(); //转为大写
		 if(option.type=="GET"){
			 xmlHttp.open(option.type,option.url+"?"+option.addstr,true);
		 }else{
			 xmlHttp.open(option.type,option.url,true);
		 } 
		 xmlHttp.onreadystatechange=function(){
			  if(xmlHttp.readyState==4){
					var str1=xmlHttp.responseText.replace(/[\r\n]/g, "");
					if(option.func){
					   option.func(str1);//运行回调函数
					}
			  }
		 };
		 xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
		 if(option.type=="GET"){ 
		   xmlHttp.send("");
		 } else{
		   xmlHttp.send(option.addstr);//这个是POST方式的
		 } 
}
//http://www.html5china.com/news/
//http://www.educity.cn/wenda/s612.html
//http://hongru.github.io/share/3D.html
</script>
</body>
</html>
