//联系QQ 原创 632175205
//网店：http://91huicong.taobao.com
function Upload(){
	var Upload_={
		Init:function(opt){

			var t=this;
			t.opt=opt;
			t.input=t.opt.input;
			t.inputmore=t.opt.inputmore;
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
            t.isload=0;
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
            t.fengmian_html="<table cellpadding='0' cellspacing='0' border='0' style='height:"+opt.eight+"px;width:100%;'><tr style='height:100%;'><td valign='middle' style='height:100%;'><img src='"+g_fengmian_src+"' style='width:"+opt.width+"px; height:"+opt.height+";'/></td></tr></table>";
            parent_bt.innerHTML=t.fengmian_html;
	        t.parent_bt=parent_bt;
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
            t.parent_file=parent_file;
			t.parent_bt.onclick=function(){
				if((t.countz+1)>t.opt.maxnum&&t.opt.maxnum>0){
							alert("最多只能上传"+t.opt.maxnum+"张");
							return false;
				}
				if(objpanel==null){
				   parent_file.click();
				}else{
				  //if(t.bt.innerHTML.indexOf(this.getAttribute("caption"))!=-1){
				    parent_file.click();
				  //}
				}
			}
			parent.appendChild(parent_file);
			
			if(objtable){
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
						t.input=childs[i];//小图提示
						
					}
					if(myname=="t_inputmore"){
						t.inputmore=childs[i];//多图提示
					
					}
					
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
					 t.Show({src:imgs[i],isdel_file:0});
				}
		   }
		   if(objpanel==null&&imgs[0]!=""){
			    t.parent_bt.getElementsByTagName("img")[0].src=g_siteurl+imgs[0];
		   }
		},
		Init1:function(opt){

			var t=this;
			t.opt=opt;
			t.input=t.opt.input;
			t.inputmore=t.opt.inputmore;
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
            t.isload=0;
			t.countz=0;
			t.timer=null;
			t.maxsize=6;//M为单位 限制大小
			if(objtable){
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
						t.input=childs[i];//小图提示
						//t.input.value="";
					}
					if(myname=="t_inputmore"){
						t.inputmore=childs[i];//多图提示
						//t.inputmore.value="";
					}
					
				}
			}
			}
		   var imgs=opt.imgstr.split("#");
		   for(var i=0;i<imgs.length;i++){
				if(imgs[i]!=""){
					 t.Show({src:imgs[i],isdel_file:0});
				}
		   }
		   if(objpanel==null&&imgs[0]!=""){
			    item1_divbg.getElementsByTagName("img")[0].src=g_siteurl+imgs[0];
		   }
		},Show:function(opt){
			var t=this;
			if(opt.isdel_file!=0){ //注意要加这句 0等于false 返就是为真
					 opt.isdel_file=1;//后台删除文件
			}
                 	 var values=opt.src.split("|");
					 var mysrc=values[0];
					 var addstr="&no="+values[1];
					  var myitem=t.ShowImgA({filename:g_loading_src,isdel_file:opt.isdel_file});
					  if(opt.isdel_file!=0){if(t.input){t.input.value=mysrc;}}
					 
						if(t.inputmore){ 
						      if(t.inputmore.value.indexOf(mysrc)==-1){
						      if(t.inputmore.value!=""){
							    t.inputmore.value+="#"+mysrc;
							   }else{
								 t.inputmore.value=mysrc;
								}
							  }
						}
					  if(myitem!=null){
						  myitem.childNodes[1].style.display="";
						  myitem.childNodes[2].style.display="none";
						  myitem.setAttribute("myvalue",mysrc);
						  myitem.setAttribute("myaddstr",addstr);
						 
						  
						  myitem.getElementsByTagName("img")[0].src=g_siteurl+mysrc;
						  myitem.getElementsByTagName("img")[0].onclick=function(){
						  window.open(this.src.replace(t.opt.dir1,t.opt.dir3));
					     }
				      }
		},LoadFile:function(opt){
			var t=this;
		    var files = opt.obj.files,
			img = new Image();	
			var us=String(navigator.userAgent);
			//if(us.indexOf("MSIE 7.0")!=-1||us.indexOf("MSIE 6.0")!=-1||us.indexOf("MSIE 8.0")!=-1||us.indexOf("MSIE 9.0")!=-1){
			if ( typeof(FileReader) === 'undefined' ){ 
                alert("你的浏览器不支持html5");
			}else { //ie10以上才可以  if(window.FileReader)
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
				 t.parent_file.value="";
			}
		},New:function(file,filecountz){
			var t=this;
					var reader = new FileReader();
				    var myext="";
					reader.readAsDataURL(file);
					var img = new Image();	
					reader.onload = function(e){
						t.input.parentNode.innnerHTML=this.result;
						
						var img_base64=this.result;
					   //item1_divbg.innerHTML="<img src=\""+this.result+"\"/>";
						
						var old_data="";//去前前面的22或23个字符,ie10是13,后面的字符串才是我们想要获取的图片的base64编码
                        if(this.result.indexOf("data:image/jpeg;base64,")!=-1){ //data:image/gif;base64,和data:image/png;base64,才是22个字符
							old_data=this.result.substr(23);
							myext="jpg";
						}else if(this.result.indexOf("data:;base64,")!=-1){ //data:image/gif;base64,和data:image/png;base64,才是22个字符
							old_data=this.result.substr(13);
							myext="png";
						}else if(this.result.indexOf("data:image/png;base64,")!=-1){
							old_data=this.result.substr(22);
							myext="png";
						}else if(this.result.indexOf("data:image/gif;base64,")!=-1){
							old_data=this.result.substr(22);
							myext="gif";
						}else if(this.result.indexOf("data:base64,")!=-1){ //这种情况也是无法知道什么格式的图片,所以这里就把它当成png来处理
							old_data=this.result.substr(12);
							img_base64=this.result.replace("data:base64,","data:image/png;base64,"); //要加这句不然没有image/png扩展名 有些浏览器下img.src=img_base64是无效的 360极速浏览器就是这样子 20150516
							myext="png";
						}else {
							//file.select();  
                           //var  pathValue = document.selection.createRange().text;
	                      old_data=this.result;
						  myext="png";
						  alert("不是图片无法上传");
						  return false;
                         }
						
						if((t.countz+1)>t.opt.maxnum&&t.opt.maxnum>0){
							alert("最多只能上传"+t.opt.maxnum+"张");
							return false;
						}
						t.bt.getElementsByTagName("img")[0].src=this.result;
					    img.src = img_base64; 
						var bytes=e.total;
						//var myitem=t.ShowImgA({filename:img_base64});
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
								
								var size=parseInt(bytes/1024/1024);
								if(size>t.maxsize){
									alert("图片大小不能超过"+t.maxsize+"M");
									return false;
								}
								
								var myitem=t.ShowImgA({filename:cur_path+"images/loading1.gif"});
								var this_base64=old_data;
								var canvas=document.getElementById("xiaotu_canvas");
								canvas.width=old_width;
								canvas.height= old_height;
                                
//								if(inputw3&&inputw3.value!=""){//微信可能会卡死
//									canvas.width=inputw3.value;
//									canvas.height= canvas.width/bilv;
//									var ctx=canvas.getContext('2d');
//								    ctx.drawImage(this,0,0,canvas.width,canvas.height);
//								     //var imgData =canvas.toDataURL("image/png");
//									//this_base64=canvas.toDataURL("image/jpeg");
//									   this_base64=canvas.toDataURL("image/jpeg",0.9);
//									   this_base64=this_base64.substr(23);
//								
//									
//						        }
                              
								var items=file.name.split(".");
								var ext=items[items.length-1];
								if(myext!=""){
									ext=myext;
								}
								ext=ext.toLowerCase();
								
								var data = this_base64;
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
								  if(objpanel==null){
								   // t.bt.innerHTML="<span style='font-size:13px;'>正在上传</span>";
									var span=document.createElement("div")
									span.innerHTML="正在上传";
									span.style.cssText="position:absolute;top:0px;left:0px; z-index:3000;height:100%;width:100%;color:#ffffff;font-size:15px;font-weight:bold;background-color:#000000;filter:alpha(opacity=60);opacity:0.6;-webkit-opacity:0.6; -moz-opacity:0.6;";
									t.bt.getElementsByTagName("img")[0].parentNode.appendChild(span);
								  }
								 
//								  t.time=window.setTimeout(function(){
//									   t.bt.innerHTML="<span style='font-size:13px;'>正在上传("+t.filecount+"/"+filecountz+")</span>";
//									   if(t.filecount==filecountz){
//										   t.bt.innerHTML=t.bt.getAttribute("caption");
//										   window.clearTimeout(t.time);
//									   }
//								  },1000);
									t.bt.className="parent_bt on";
									
									
								
									var addstr1="";
									addstr1+="&title="+title;
									addstr1+="&w1="+small_width+"&h1="+small_height;

									addstr1+="&w2="+mid_width+"&h2="+mid_height;
									addstr1+="&dir1="+t.opt.dir1+"&dir2="+t.opt.dir2+"&dir3="+t.opt.dir3;
									addstr1+="&num="+num+"&ext="+ext+"&title="+title+"&size="+size+"&bilv="+fomatFloat(bilv,4);
									//alert(addstr1);
								   var timer=window.setInterval(function(){
										  if(t.isload==0){
											 t.isload=1;
											 t.Save({myitem:myitem,addstr:addstr1,base64str:base64str});
											 window.clearInterval(timer);
										  }
								   },1000);

						}
						 //fileList.appendChild(img);
					}
		},Save:function(opt){
         var t=this;
									Ajax({url:ajax_url,type:"POST",addstr:"act=up"+opt.base64str+opt.addstr,func:function(filename){ //生成小图后
									    t.isload=0;
                                         var smallsrc=filename;
										//alert(smallsrc);
										 if(objpanel==null){
	                                      t.bt.innerHTML="<table cellpadding='0' cellspacing='0' border='0' style='height:"+window.clientHeight+"px;width:100%;'><tr style='height:100%;'><td valign='middle' style='height:100%;'><img src='"+g_siteurl+smallsrc+"' style='width:"+window.clientWidth+"px; height:"+window.clientHeight+";'/></td></tr></table>";
										 }else{
										  t.bt.innerHTML=t.fengmian_html;
										 }
										  
										  filename=filename.replace(g_mid_dir2,g_input_dir);
										  filename=filename.replace(g_big_dir3,g_input_dir);
										  
										  smallsrc=smallsrc.replace(g_mid_dir2,g_input_dir);
										  smallsrc=smallsrc.replace(g_big_dir3,g_input_dir);
										 
												  if(t.input){t.input.value=filename}
												  if(t.inputmore){ if(t.inputmore.value!=""){t.inputmore.value+="#"+filename}else{t.inputmore.value=filename}}
												   if(opt.myitem!=null){
													  opt.myitem=window.parent.document.getElementById(opt.myitem.id); //要重新获取不然会只有一个有图片，这个很奇怪
													  opt.myitem.setAttribute("myvalue",smallsrc);
													  opt.myitem.getElementsByTagName("img")[0].src=g_siteurl+smallsrc;
													  //alert(opt.myitem.getElementsByTagName("img")[0].src);
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
												  
												  if(opt.myitem!=null){
													   opt.myitem.childNodes[1].style.display="";
													   opt.myitem.childNodes[2].style.display="none"; 
													   opt.myitem.getElementsByTagName("img")[0].onclick=function(){
														 window.open(this.src.replace(t.opt.dir1,t.opt.dir3));
														}
												   }
												  
										
									}});
	   },ShowImgA:function(opt){
				   var t=this;
				   var obj=null;
				   if(typeof(opt.isdel_file)=="undefined"){
					   opt.isdel_file=1;
				   }
				 if(t.opt.objpanel!=null){
					//var rel=document.createElement("div");
					var rel_id="rel_"+MathRand();
					t.opt.objpanel.innerHTML+="<div class='rel' id='"+rel_id+"'><span></span><input type='button' value='×' style='height:20px;width:20px;'/><p></p></div>";
					var rel=window.parent.document.getElementById(rel_id);
					rel.setAttribute("myvalue","");
					rel.setAttribute("myaddstr","");
					rel.setAttribute("isdel_file",opt.isdel_file);
					var h=t.opt.height;
					var w=t.opt.width;
					rel.style.cssText="height:"+h+"px;width:"+w+"px;float:left;overflow:hidden;border:#CCC solid 1px;margin:5px;position:relative;";
					var childs=rel.childNodes;
					var span_abs=childs[0];
					span_abs.style.cssText="display:black;position:absolute; top:1px;left:1px;overflow:hidden;height:"+(h-2)+"px;width:"+(w-2)+"px;";
					span_abs.innerHTML="<table style='height:100%;width:"+(w-2)+"px;' cellpadding='0' cellspacing='0'><tr><td valign='middle'><img src='"+opt.filename+"' style='height:auto;width:100%;'/><td></tr></table><style>.bt_abs{background-color:#666;}.bt_abs:hover{color:#fff; background-color:#ff0000;}</style>";
					//rel.appendChild(span_abs);

					var bt_abs=childs[1];
					bt_abs.type="button";
					bt_abs.value="×";
					bt_abs.style.cssText="border:0px;position:absolute; margin:0px; top:1px;right:1px;overflow:hidden;";
					bt_abs.style.display="none";
				    bt_abs.className="bt_abs";
					//rel.appendChild(bt_abs);
					var p_abs=childs[2];
					p_abs.style.cssText="dislpay:black;position:absolute;font-weight:bold; color:#ffffff; top:0px;left:0px;line-height:"+h+"px;overflow:hidden;text-align:center;margin:0px;background-color:#000000;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;";
					p_abs.style.height=h+"px";
					p_abs.style.width=w+"px";
					p_abs.innerHTML="正在上传";
					//rel.appendChild(p_abs);
//					var iframes=t.opt.objpanel.getElementsByTagName("iframe");
//					if(iframes.length>0){
//					  t.opt.objpanel.insertBefore(rel,iframes[0]);
//					}else{
//					   t.opt.objpanel.appendChild(rel);
//					}
					var bts=t.opt.objpanel.getElementsByTagName("input");
					for(var i=0;i<bts.length;i++){
					bts[i].onclick=function(){
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
							
								 if(String(this.parentNode.getAttribute("isdel_file"))!="0"){
									
								   var arr=value.split("/");
								   var name=arr[arr.length-1];
								   var addstr="&path1="+t.opt.dir1+name+"&path2="+t.opt.dir2+name+"&path3="+t.opt.dir3+name+myaddstr;
								   Ajax({url:ajax_url,type:"POST",addstr:"act=del"+addstr,func:function(html){if(opt.func){opt.func();}}});
								 }
							}
					}
					
					obj=rel;
				 }
		  return rel;
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
function MathRand() 
{ 
var Num=""; 
	for(var i=0;i<6;i++) 
	{ 
	Num+=Math.floor(Math.random()*10); 
	} 
return Num;
} 
// PHP has encountered an Access Violation at 094AB74E