// JavaScript Document
/*
  2016-09-27
  原创:惠聪网络
  原创QQ:632175205
  淘店a:http://91huicong.taobao.com/
  淘店b:https://congweb.taobao.com/
  不懂可以加我qq632175205,下午在线
  电话：13799835338，小聪
  asp .net php各版都有
*/


function hcfile(){
var hcfile_={
               Init:function(opt){
			         var t=this;
                     t.opt=opt;
                     t.files=[];
					 t.isfengmian=g_isfengmian;
					 t.input_id="hcfile"+t.RndNum(7);
					  if(typeof(opt.input_id)!="undefined"){
						   t.input_id=opt.input_id;
					  }
					 t.input=document.getElementById(t.input_id);//获取输入框
					 if( t.input==null){
						 if(typeof(t.opt.item_html)=="undefined"){
						 t.Alert("参数input_id配置出错");
						 }
					 }
					 var bodys=document.getElementsByTagName("body");
					 t.isdelfile=g_isdelfile;
					 t.isnewsmall=g_isnewsmall;
					 t.isyulan=g_isyulan;
					  t.isfull=g_isfull;
					  t.fenge_child="[g]";//每项里的项隔符
					  t.fenge=g_fenge;
					  if(typeof(t.opt.fenge)!="undefined"){t.fenge=t.opt.fenge;} 
					  if(typeof(t.opt.fenge_child)!="undefined"){t.fenge_child=t.opt.fenge_child;} 
					 if(bodys.length>0){t.body=bodys[0];}
					 if(typeof(t.opt.width)=="undefined"){t.opt.width=100;}
					 if(typeof(t.opt.height)=="undefined"){ t.opt.height=100;}
					 if(typeof(t.opt.isdelfile)!="undefined"){t.isdelfile=t.opt.isdelfile;}
					 if(typeof(t.opt.isnewsmall)!="undefined"){t.isnewsmall=t.opt.isnewsmall;}
					 if(typeof(t.opt.maxnum)=="undefined"||t.opt.maxnum==""){t.opt.maxnum=10000000;
					 }else{t.opt.maxnum=parseInt(t.opt.maxnum);}
					 if(typeof(t.opt.type)=="undefined"||t.opt.type==""){t.opt.type="all";} 
					 t.zifu_num=g_zifu_num;//发送给服务器的每段图片的大小
					 t.img_fdsize=1024*15; 
					 if(typeof(t.opt.img_fdsize)!="undefined"&&String(t.opt.img_fdsize)!=""){ t.zifu_num= t.opt.img_fdsize;}
					 if(typeof(t.opt.zifu_num)!="undefined"&&String(t.opt.zifu_num)!=""){t.zifu_num= t.opt.zifu_num;}
					 if(typeof(t.opt.mytxt)=="undefined"){t.opt.mytxt="";}
					 if(typeof(t.opt.siteurl_file)=="undefined"){t.siteurl_file=g_siteurl_file;
					 }else{
						 t.siteurl_file=t.opt.siteurl_file;
					 }
					 if(typeof(t.opt.ico_path)=="undefined"){t.ico_path=g_ico_path;}else{ t.ico_path=t.opt.ico_path;}
					 if(typeof(t.opt.isfull)!="undefined"){ t.isfull=t.opt.isfull;}
					 //alert(t.opt.type);
					 
                     t.moren_bgsrc=t.ico_path+g_moren_srcs[t.opt.type];
	
					 if(typeof(t.opt.bgsrc)!="undefined"&&t.opt.bgsrc!=""){
						t.moren_bgsrc=t.opt.bgsrc; 
					 }
					 if(typeof(t.opt.isfengmian)!="undefined"&&t.opt.isfengmian!=""){//封面
						 t.isfengmian=t.opt.isfengmian;
					 }
					 if(typeof(t.opt.input_fengmian_id)!="undefined"&&t.opt.input_fengmian_id!=""){
						var obj=document.getElementById(t.opt.input_fengmian_id); 
						if(obj){
							t.isfengmian=1;
							}
					 }
					 t.mr_class="myitem_mr";
					 t.obj_select_num=null;
					 if(typeof(t.opt.select_num_id)!="undefined"&&t.opt.select_num_id!=""){
						 t.obj_select_num=document.getElementById(t.opt.select_num_id); 
						 if(t.obj_select_num){
						    t.obj_select_num.innerHTML=0;
						 }
					 }
					 t.obj_success_num=null;
					 if(typeof(t.opt.success_num_id)!="undefined"&&t.opt.success_num_id!=""){
						 t.obj_success_num=document.getElementById(t.opt.success_num_id);
						 if(t.obj_select_num){
						 t.obj_success_num.innerHTML=0;
						 }
					 }
					 t.obj_max_num=null;
					 if(typeof(t.opt.max_num_id)!="undefined"&&t.opt.max_num_id!=""){
						 t.obj_max_num=document.getElementById(t.opt.max_num_id);
						 if(t.obj_max_num){
						   t.obj_max_num.innerHTML=t.opt.maxnum;
						 }
					 }
	
					t.isautosend=1;
					if(typeof(t.opt.drop_to_id)!="undefined"&&t.opt.drop_to_id!=""){
						  var obj_drop=null;
						   if(t.opt.drop_to_id=="document"){
							   obj_drop=document;
							}else{
								obj_drop=document.getElementById(t.opt.drop_to_id); 
							}
							if(obj_drop){
									obj_drop.addEventListener("dragover", function(e) {
									e.stopPropagation();
									e.preventDefault();            // 必须调用。否则浏览器会进行默认处理，比如文本类型的文件直接打开，非文本的可能弹出一个下载文件框。
									}, false);
									obj_drop.addEventListener("drop", function(e) {
									e.stopPropagation();
									e.preventDefault();            // 必须调用。否则浏览器会进行默认处理，比如文本类型的文件直接打开，非文本的可能弹出一个下载文件框。
									 //sendFile(e.dataTransfer.files);
									 t.start(e.dataTransfer.files);
									}, false); 
							}
						   
					}
					
					if(typeof(t.opt.send_id)!="undefined"&&t.opt.send_id!=""&&t.opt.send_id!="auto"){
						 var send_bt=document.getElementById(t.opt.send_id);//获取输入框
						 if(send_bt){
							 send_bt.onclick=function(){
								 	var n=0;
									if(!t.check_bitian()){return false;}
									 for(var key in t.files){
									var fileinfo=t.files[key];
									if(fileinfo.status=="dengdai"){ n++;}
									}
									if(n==0){t.Alert("请选择文件"); return false;}
								    t.send();
							 }
							 t.isautosend=0;
						 }
					}
			

					 t.num=0;
					 t.panel=null;
					 if(typeof(t.opt.panel_id)!="undefined"&&t.opt.panel_id!=""){
						  t.panel=document.getElementById(opt.panel_id);
						 
					 }
					 t.input_fengmian=null;
					 if(typeof(t.opt.input_fengmian_id)!="undefined"&&t.opt.input_fengmian_id!==""){
						  t.input_fengmian=document.getElementById(opt.input_fengmian_id);
					 }
				

					t.isshowbar=0;
					t.isshowsize=0;
					t.isshowname=0;
					t.isshowbaifenbi=0;
					t.isshowdel=0;
					t.itemstyle="";
					t.isfengmian=0;
					if(t.input_fengmian){t.isfengmian=1;}
                    t.init_show={date:0,size:0,img:1,name:0,bar:1,baifenbi:1,del:0,bg:1,chongchuan:0,chongxuan:0}
					t.upload_show={date:0,size:0,img:1,name:0,bar:1,baifenbi:1,del:0,bg:1,chongchuan:0,chongxuan:0};
					t.success_show={date:0,size:0,img:1,name:0,bar:0,baifenbi:0,del:1,bg:0,chongchuan:0,chongxuan:0};
					t.error_show={date:0,size:0,img:1,name:0,bar:0,baifenbi:1,del:1,bg:0,chongchuan:0,chongxuan:0};
					
	
					t.itemhoverclass="hcitem_hover";
					if(typeof(t.opt.hcitem_hover)!="undefined"){ t.itemhoverclass=t.opt.hcitem_hover;}
					 if(typeof(t.opt.success_show)!="undefined"&&typeof(t.opt.success_show.isfengmian)!="undefined"&&t.opt.success_show.isfengmian!=""){
						 t.isfengmian=t.opt.success_show.isfengmian; 
						  
					 }
					 if(typeof(t.opt.isfengmian)!="undefined"&&t.opt.isfengmian!=""){//封面
						 t.isfengmian=t.opt.isfengmian;
					 }
					 if(typeof(t.opt.init_show)!="undefined"){
						 for(var k in t.opt.init_show){t.init_show[k]=t.opt.init_show[k];}
					 }
					 if(typeof(t.opt.error_show)!="undefined"){
						 for(var k in t.opt.error_show){t.error_show[k]=t.opt.error_show[k];}
					 }
						 for(var k in t.init_show){
							 if(k=="bar"){t.isshowbar=t.init_show[k];}
							 if(k=="baifenbi"){t.isshowbaifenbi=t.init_show[k];}
							 if(k=="size"){t.isshowsize=t.init_show[k];}
							 if(k=="name"){t.isshowname=t.init_show[k];}
							 if(k=="del"){t.isshowdel=t.init_show[k];}
						 }
					  if(typeof(t.opt.upload_show)!="undefined"){
						 if(typeof(t.opt.upload_show.itemstyle)!="undefined"&&t.opt.upload_show.itemstyle!==""){
							 t.itemstyle=t.opt.upload_show.itemstyle;
						 }
						 for(var k in t.opt.upload_show){t.upload_show[k]=t.opt.upload_show[k];}
					  }
					  if(typeof(t.opt.success_show)!="undefined"){
						 for(var k in t.opt.success_show){t.success_show[k]=t.opt.success_show[k]; }
					  }
					  
                     if(typeof(t.opt.border)=="undefined"){ t.opt.border=1;}
					 if(typeof(t.opt.width)=="undefined"){t.opt.width="";}
					 if(typeof(t.opt.maxsize)=="undefined"){t.opt.maxsize="";}
					 if(typeof(t.opt.width_ys)=="undefined"){t.opt.width_ys="";}
					 var parent=null;
					 if(t.input){parent=t.input.parentNode;
					 }else{ parent=t.body; }
					 var file=document.createElement("input");
					 if(typeof(t.opt.type)!="undefined"&&t.opt.type=="img"){
                         var isChrome = window.navigator.userAgent.indexOf("Chrome") !== -1;
                       if(isChrome){
						     file.setAttribute("accept","image/jpg,image/jpeg,image/png,image/gif,image/webp") ;
					   }else{
						     file.setAttribute("accept","image/*") ;
					   }
					 }else{
						 file.setAttribute("accept","*") ;
					 }
					 
					file.name=t.input_id+"_file",file.id=t.input_id+"_file",file.type="file",
					file.style.cssText="top:-100px;position:absolute;";
					 //file.style.cssText="filter:alpha(opacity=1); -moz-opacity:0.01; -khtml-opacity:0.01; opacity: 0.01;" 
					  if(typeof(t.opt.maxnum)!="undefined"&&t.opt.maxnum>1){
						 file.setAttribute("multiple","true") ;
					  }
					  
				      file.onchange=function(){
								t.start(this.files);
								this.value="";//要重置一下,不然会造成重复上传
					  }
					  
					  var bt_select=null;
                     if(typeof(t.opt.bt_select_id)!="undefined"){
						 var arr=t.opt.bt_select_id.split(",");
						 for(var i=0;i<arr.length;i++){
						      t.bt_select=document.getElementById(arr[i]);
							  t.bt_select.onclick=function(event){
								    if(!t.check_bitian()){return false;}
							        file.click();
									event.stopPropagation();
						      }
						 }
					 }
					 
                       var div=document.createElement("div");
					   div.style.cssText="position:relative;height:0.1px;overflow:hidden;";
					   div.className="div_file";
					   parent.appendChild(div);
					   div.appendChild(file);
					   t.opt.file=file;
                       t.create_submit();

				   if(typeof(t.opt.item_html)!="undefined"&&typeof(t.opt.item_values)!="undefined"){
					      t.item_values=t.opt.item_values;
                           if(typeof(item_values)=="string"){
							     var arr=t.item_values.split(""+t.fenge);
								 t.item_values=[];
								 for(var i=0;i<arr.length;i++){
									var itema={};
									if(arr[i]!=""){
										var arr1=arr[i].split(""+t.fenge_child);
										if(typeof(t.item_values_fields)=="array"){
											for(var j=0;j<t.item_values_fields;j++){
												  var k=t.item_values_fields[j];
												   itema[k]="";
												   if(typeof(arr1[j])!="undefined"){
													   itema[k]=arr1[j];  
												   }
											}
										}else{
											itema["src"]=arr1[0];itema["title"]=arr1[0];
											if(arr1.length>1){itema["title"]=arr1[1];}
										}
										t.item_values.push(itema);   
									}
								 }
								 
						   }
							   
							    for(var i=0;i<t.item_values.length;i++){
							       var row=t.item_values[i];
								   t.num++;
								    var small_src=row['src'],big_src=small_src,arr2=small_src.split("."),ext=arr2[arr2.length-1];
									   if(t.IsImg(ext)){
										   if(t.isnewsmall==0){
												 big_src=small_src;
											}else{
												 big_src=t.GetBigImg(small_src);
											}
									   }
								    var opt={src:t.siteurl_file+small_src,small_src:small_src,big_src:big_src,row:row};
					                var myitem= t.NewItem(opt);
							        t.NewFileBar({myitem:myitem,success_size:100,file_size:100});

								}
						 
					  
				   }else{
						if(t.input&&t.input.value!=""){
								  var arr=t.input.value.split(t.fenge);
								  for(var i=0;i<arr.length;i++){
									   if(arr[i]!=""&&arr[i].indexOf("/")!=-1){
										   t.num++;
										   var small_src=arr[i],big_src=arr[i],arr2=small_src.split("."),ext=arr2[arr2.length-1];
										   if(t.IsImg(ext)){
											   if(t.isnewsmall==0){
											         big_src=small_src;
											    }else{
													 big_src=t.GetBigImg(small_src);
												}
										   }
										  if(typeof(t.opt.show_start_item)=="undefined"||t.opt.show_start_item==1){
										    	var myitem=t.NewItem({src:t.siteurl_file+small_src,small_src:small_src,big_src:big_src});
							                     t.NewFileBar({myitem:myitem,success_size:100,file_size:100});
										  }
									   }
								  }
								   if(t.num>0){
													if(typeof(t.opt.success)!="undefined"){
														  t.opt.success({maxnum:t.opt.maxnum,num:t.num});
													}
								   }
						}else{
								  t.ShowNull();
						}
				   }
		},GetBigImg:function(src){
			var big_src=src,t=this,arr2=src.split("."),ext=arr2[arr2.length-1];
					if(t.IsImg(ext)){
					   if(src.indexOf("/s50/")!=-1||src.indexOf("/s80/")!=-1||src.indexOf("/s100/")!=-1){
							 big_src=src.replace("/s50/","/s100/");
							 big_src=src.replace("/s80/","/s100/");
						}else if(src.indexOf("/s/")!=-1||src.indexOf("/m/")!=-1){
							 big_src=src.replace("/s/","/b/");
							 big_src=src.replace("/s/","/b/");
						}else{
								   if(big_src.indexOf("."+ext+"."+ext+"."+ext)==-1){
									   big_src=src+"."+ext+"."+ext;
								   }
						}
					}
			return big_src;
		},check_bitian:function(){
			var t=this,isbool=true;
            if(typeof(t.opt.bitian)!="undefined"){
				for(var key in t.opt.bitian){
					 var ite=t.opt.bitian[key],obj=t.getobj({id:ite.id});
					 if(obj&&obj.tagName=="SELECT"&&obj.selectedIndex==0){
						if(typeof(ite.msg)=="undefined"){t.Alert(obj.options[0].text); }else{t.Alert(ite.msg); }
						isbool=false;break;
					 }
					 if(obj&&obj.tagName=="INPUT"&&obj.value==""){
						if(typeof(ite.msg)=="undefined"){t.Alert("请先填写"+obj.id); }else{t.Alert(ite.msg); }
						isbool=false;break;
					 }
				}
			}
			return isbool;
		},getobj:function(o){
			var obj=document.getElementById(o.id);
			return obj;
		},create_submit:function(){
			         var t=this;
					  var parent=null;
					 if(t.input){parent=t.input.parentNode;
					 }else{ parent=t.body; }
					 t.weizhi=null;
					 var regclick=function(){
								t.weizhi.onclick=function(event){
                                    if(!t.check_bitian()){return false;}
									if(t.opt.maxnum==t.num&&t.opt.maxnum!=1){
										 t.Alert("只能上传"+t.opt.maxnum+"个文件"); 
									}else{
										 t.opt.file.click();
									}
									event.stopPropagation();
								} 
					 }
					
                     if(typeof(t.opt.weizhi_id)!="undefined"){
						 t.weizhi=document.getElementById(t.opt.weizhi_id);
					 }
					 if(typeof(t.opt.item_class)!="undefined"){//如果是样式列表上传方式
						      if(t.weizhi){ regclick();}
						      t.item=t.weizhi;	 
					 }
					 if(typeof(t.opt.item_class)=="undefined"||t.opt.item_class==""){
							   t.bt_old_html="";
							   if(t.weizhi){
								   if(t.weizhi.innerHTML==""){
										var parent=t.weizhi; 
										 var smallsrc=t.moren_bgsrc;
										 var bt_html="";
										 if(t.input&&t.input.value!=""&&t.opt.maxnum==1){
											 smallsrc=t.siteurl_file+t.input.value;
											 bt_html="<img src='"+smallsrc+"' style='height:100%;'/>";
										 }else{
											 bt_html="<img src='"+smallsrc+"' style='width:100%;height:100%;'/>";
										 }
										 var btitem=t.NewItem({parent:parent,small_src:smallsrc,type:"bt",bt_html:bt_html});
										 t.item=btitem;
								   }
							   }
							    if(t.weizhi==null){
										 var smallsrc=t.moren_bgsrc;
										 var bt_html="";
										 if(t.input&&t.input.value!=""&&t.opt.maxnum==1){
											 smallsrc=t.siteurl_file+t.input.value;
											 bt_html="<img src='"+smallsrc+"' style='height:100%;'/>";
										 }else{
											 bt_html="<img src='"+smallsrc+"' style='width:100%;height:100%;'/>";
										 }
										 var btitem=t.NewItem({parent:parent,small_src:smallsrc,type:"bt",bt_html:bt_html});
										 t.item=btitem;
										 t.weizhi=t.item;
								}
							
							
					 }else{

						 if(t.weizhi&&t.weizhi.innerHTML==""){
							  var smallsrc=t.moren_bgsrc;
							  var bt_html="<img src='"+smallsrc+"' style='width:100%;height:100%;'/>";
							 t.weizhi.innerHTML= bt_html;
						 }
					 }
					 if(t.weizhi){ regclick();}
					return false;
			 

		},start:function(files){
	
			var str="";
//			var file=files[0];
//			for(var key in file){
//				str+=key+"="+file[key]+"#"
//			}
//			if(file.type==""&&file.name.indexOf(".")!=-1){
//				   var arr=file.name.split(".");
//				   
//			}
			//alert(str);
				var t=this;
				var us=String(navigator.userAgent);
				if (typeof(FileReader) === 'undefined' ){ 
					t.Alert("你的浏览器不支持html5");
					return false;
				}

					if(t.panel){
						if(t.panel.childNodes.length>0){
							if(typeof(t.panel.childNodes[0].id)!="undefined"&&t.panel.childNodes[0].id.indexOf("_item")==-1){
								t.panel.removeChild(t.panel.childNodes[0]);
							}
						}
						if(t.opt.maxnum>1){
							if(t.panel.childNodes.length>=t.opt.maxnum){
								t.Alert("最多只能上传"+t.opt.maxnum+"个文件"); 
								return false;
							}
						}else{
							t.panel.innerHTML="";
						}
					}
					var myfiles=[];
					for(var i=0;i<files.length;i++){
						var file=files[i];
						var filetype=file.type;
						var filename=file.name;

						var ext=t.FileExt({file:file});
						
						var isbool=0;
						for(var j=0;j<g_exts.length;j++){
							if(g_exts[j].ext==ext&&t.opt.type=="all"){
							  isbool=1;
							}else if(g_exts[j].ext==ext&&g_exts[j].type==t.opt.type){
							  isbool=1;
							}
						}
						
						if(typeof(t.opt.exts)!="undefined"){
							 isbool=0;
							 var arr=t.opt.exts.split(",");
							 for(var j=0;j<arr;j++){
							  if(arr[j]==ext){isbool=1; break;}
							 }
						}
						if(isbool==1){
							myfiles.push(file);
						}
					}
					if(myfiles.length==0){
						return false;
					}
				var kycount=0;
	            if(t.opt.maxnum!=1){
					if(t.num<t.opt.maxnum){
						cz=t.opt.maxnum-t.num;
						kycount=myfiles.length;//还能上传几条
						if(cz<myfiles.length){
							kycount=cz;
						}
					}
					if(t.num>=t.opt.maxnum){
						t.Alert("最多只能上传"+t.opt.maxnu+"个文件"); 
						return false;
					}
				}else{
					kycount=1; //只能一个
				}
				var n=myfiles.length;
				if(t.num==0&&t.panel&&n==0){
					 t.panel.innerHTML="";
				}
				var myitem=null;
				var filearr=[];

				for(var i=0;i<kycount;i++){
					myitem=t.item;
					if(t.panel){
					 myitem=t.NewItem({file:myfiles[i]});
					}
					
					ext=t.FileExt({file:myfiles[i]});
					if(t.IsImg(ext)){
					    t.files[myitem.id]={itemid:myitem.id,status:"dengdai",file:myfiles[i],isupload:0};
						myitem.setAttribute("mysizeyy",myfiles[i].size);
						t.YaSuo({myitem:myitem,file:myfiles[i],title:myfiles[i].name,ext:ext,size:myfiles[i].size,autoupload:false});
					}else{
						myitem.setAttribute("mysize",myfiles[i].size);
						t.files[myitem.id]={itemid:myitem.id,status:"dengdai",file:myfiles[i],isupload:1};
					}
					//t.files[myitem.id]=myfiles[i];
					// t.files.push({itemid:myitem.id,file:files[i]});
				}
				t.ShowSelectFileCount();
				if(t.isautosend==1){t.send();}
				
				
		},selectonefile:function(opt){
	       var t=this;
		   var file=document.getElementById(opt.itemid+"_file");
		   file.click();
		   file.value="";
		   file.onchange=function(){
			   if(this.files.length>0){
				            t.files[opt.itemid]={itemid:opt.itemid,status:"dengdai",file:this.files[0],isupload:1};
				            var myitem=document.getElementById(opt.itemid);
				            myitem.setAttribute("iscx",1);
							var name1=t.GetObjByClass(myitem,"rel_name");
							if(name1){name1.innerHTML=t.files[opt.itemid].file.name;}
                            myitem.setAttribute("mysize",t.files[opt.itemid].file.size);
                            t.uploada({myitem:myitem,file:t.files[opt.itemid].file});				   
		        }
		   }
		},chongchuanfile:function(opt){
	       var t=this;
		   
		   if(typeof(t.files[opt.itemid])!="undefined"){
								t.files[opt.itemid].isupload=1;
								var myitem=document.getElementById(opt.itemid);
								var o=t.GetObjByClass(myitem,"rel_chongchuan");o.style.display="none";
								var bfb=t.GetObjByClass(myitem,"rel_baifenbi");bfb.innerHTML="等待";
								
								myitem.setAttribute("iscx",1);
								var name1=t.GetObjByClass(myitem,"rel_name");
								if(name1){name1.innerHTML=t.files[opt.itemid].file.name;}
								myitem.setAttribute("mysize",t.files[opt.itemid].file.size);
								t.uploada({myitem:myitem,file:t.files[opt.itemid].file});
		   }
		},send:function(){
			 var t=this;
			 var limit=4;//同时上传个数
			 if(t.itemstyle=="1"){
				 t.item.style.display="none";
				 if(t.panel){t.panel.style.display="";}
			 }
			 if(typeof(t.opt.limit)!="undefined"){
				 limit=t.opt.limit;
			 }
		    var time=window.setInterval(function(){
				 var uploadnum=0,numz=0,isbool=1;
				 for(var key in t.files){
					if(t.files[key].status=="shangchuan"){ uploadnum++;}
					if(t.files[key].isupload==0){isbool=0;}
					numz++;
				 }
				 //alert(numz);
				 if(isbool==1){
					 for(var key in t.files){
						var fileinfo=t.files[key];
						if(fileinfo.status=="dengdai"&&(uploadnum<limit||limit==0)){
							t.files[key].status="shangchuan";
							var myitem=document.getElementById(key);
							 
							t.uploada({myitem:myitem,file:fileinfo.file});
							uploadnum++;
						}
					 } 
				 }
				 if(numz==0){window.clearInterval(time);}
				 
			},1000)
		},upload:function(opt){
//			        var t=this;
//					var file=opt.file;
//
//
//				    var ext="";
//				    var title=file.name;
//					var myitem=opt.myitem;
//					var tmpid=t.RndNum(20);
//					var filetype=file.type;
//					var filename=file.name;
//                    
//					var arr=filename.split(".");
//					var file_ext=arr[arr.length-1];
//					file_ext=file_ext.toLowerCase();
//					title=title.replace(new RegExp("."+file_ext,"gm"),"");
//					ext=t.FileExt({filename:filename,contenttype:filetype});
//					if(myitem){
//                     var imgs=myitem.getElementsByTagName("img");
//					 if(imgs.length>0){
//						  var  v=t.GetShowImg(ext);
//						  if(v!=""){
//							imgs[0].src=v;  
//							imgs[0].style.width="100%";
//						  }
//						  
//					 }
//					}
//	
//					if(t.opt.url.indexOf("asp")!=-1){
//						if(t.IsImg(ext)){
//				           var newfile=null;
//							t.YaSuo({
//									   myitem:myitem,
//									   file:file,
//									   title:title,
//									   ext:ext,
//									   size:file.size
//							});
//						}else{
//							t.SaveFileBytes({
//									   myitem:myitem,
//									   file:file,
//									   title:title,
//									   ext:ext,
//									   size:file.size
//							});
//						}
//					}else{
//						if(t.IsImg(ext)){
//							t.YaSuo({
//									   myitem:myitem,
//									   file:file,
//									   title:title,
//									   ext:ext,
//									   size:file.size
//							});
//						}else{
//							t.SaveFileBytes({
//									   myitem:myitem,
//									   file:file,
//									   title:title,
//									   ext:ext,
//									   size:file.size
//							});
//						}
//					}
		},uploada:function(opt){
			        var t=this;
					var file=opt.file;
				    var ext="";
				    var title=file.name;
					var myitem=opt.myitem;
					var tmpid=t.RndNum(20);
					var filetype=file.type;
					var filename=file.name;
					//console.log(file);
					var arr=filename.split(".");
					var file_ext=arr[arr.length-1];
					file_ext=file_ext.toLowerCase();
					title=title.replace(new RegExp("."+file_ext,"gm"),"");
					ext=t.FileExt({filename:filename,contenttype:filetype});
					t.SaveFileBytes({
							   myitem:myitem,
							   file:file,
							   title:title,
							   ext:ext,
							   size:file.size
					});
	
	 },YaSuo:function(opt){
		//try{
			var t=this;
			var img=new Image();
			var filename=opt.file.name,file=opt.file;
			var ys_type=conf_yasuo_image.type;
			var ys_max_zijie=conf_yasuo_image.max_zijie;
			if(typeof(t.opt.yasuo)!=="undefined"&&typeof(t.opt.yasuo.type)!="undefined"){ys_type=t.opt.yasuo.type;}
			if(typeof(t.opt.yasuo)!=="undefined"&&typeof(t.opt.yasuo.max_zijie)!="undefined"){ys_max_zijie=t.opt.yasuo.max_zijie;}
			if(typeof(t.opt.yasuo)!=="undefined"&&typeof(t.opt.yasuo.zijie)!="undefined"){ys_max_zijie=t.opt.yasuo.zijie;}
			
			//alert(opt.file.size/1024);
			if(ys_type=="zijie"){
				 if(opt.file.size<ys_max_zijie){
					ys_type="0";   
				 }
			}
			if(String(ys_type)!="0"){
				var reader = new FileReader();//读取客户端上的文件 
				reader.readAsDataURL(opt.file); 
				reader.onload = function() { 
								var url = reader.result;//读取到的文件内容.这个属性只在读取操作完成之后才有效,并且数据的格式取决于读取操作是由哪个方法发起的.所以必须使用reader.onload，   
								img.src=url;//reader读取的文件内容是base64,利用这个url就能实现上传前预览图片
								if(t.isyulan==1){
									var relimg=t.GetObjByClass(opt.myitem,"rel_img");
									var imgs=relimg.getElementsByTagName("img");
									if(imgs.length>0){imgs[0].src=url;}
								}
								img.onload=function(){
											var w=img.width;
											var h=img.height;
											var bilv=w/h;
											var ys_width=conf_yasuo_image.width,ys_height=conf_yasuo_image.height,ys_zhiliang=conf_yasuo_image.zhiliang,ys_family="微软雅黑";
											var sy_color="#000000",sy_x=10,sy_y=10,sy_fontsize=12,isys=0,ys_tongyi=0;
											if(typeof(t.opt.yasuo)!=="undefined"&&typeof(t.opt.yasuo.width)!=="undefined"){ys_width=t.opt.yasuo.width;}
											if(typeof(t.opt.yasuo)!=="undefined"&&typeof(t.opt.yasuo.height)!=="undefined"){ys_height=t.opt.yasuo.height;}
											if(typeof(t.opt.yasuo)!=="undefined"&&typeof(t.opt.yasuo.zhiliang)!=="undefined"){ys_zhiliang=t.opt.yasuo.zhiliang;}
											
											if(String(ys_type)=="1"||ys_type=="width"||ys_type=="w"){isys=1;}
											if(String(ys_type)=="2"||ys_type=="height"||ys_type=="h"){isys=2;}
											if(String(ys_type)=="3"||ys_type=="zijie"||ys_type=="zj"){isys=3;}
											if(typeof(t.opt.yasuo)!=="undefined"&&typeof(t.opt.yasuo.tongyi)!=="undefined"&&t.opt.yasuo.tongyi==1){ys_tongyi=1;}
											if(ys_tongyi==0){
											       if(w<ys_width){ys_width=w;}
											       if(h<ys_height){ys_height=h;}
											}
											if(isys>0){
																var  canvas = document.createElement("canvas"),   
																ctx = canvas.getContext('2d');
																canvas.width=w;
																canvas.height=h;
																ctx.drawImage(img,0,0,canvas.width,canvas.height);
																

																if (isys==1){
																     canvas.width=ys_width;
																     canvas.height= canvas.width/bilv;
																     var ctx=canvas.getContext('2d');
																     ctx.drawImage(img,0,0,canvas.width,canvas.height);
																}
																if (isys==2){
																	 canvas.height=ys_height; 
																	 canvas.width=ys_height*bilv;
																     var ctx=canvas.getContext('2d');
																     ctx.drawImage(img,0,0,canvas.width,canvas.height);
																}
																this_base64=canvas.toDataURL("image/jpeg",ys_zhiliang);
																if (isys==3){
																	for(var w1=w;w1>20;){
																          canvas.width=w1;
																          canvas.height= canvas.width/bilv;
																          ctx.drawImage(img,0,0,canvas.width,canvas.height);
																		  this_base64=canvas.toDataURL("image/jpeg",ys_zhiliang);
																		  if(this_base64.length<=ys_max_zijie){ break;}
																		  w1=w1-70;
																	}
																}
																if(typeof(t.opt.shuiyin)!="undefined"){
																	var shuiyin=t.opt.shuiyin;
																   if(typeof(t.opt.shuiyin.length)=="undefined"){
																		 shuiyin=[];
																		 shuiyin.push(t.opt.shuiyin);
																   }
																	for(var i=0;i<shuiyin.length;i++){
																		  var itea=shuiyin[i];
																		  if(typeof(itea.fontsize)!="undefined"){
																			  var obj=t.getobj({id:itea.id}),sytext1="",x1=10,y1=10,fontsize1=12,ys_family1="微软雅黑";
																			  if(obj&&obj.value!=""){sytext1=obj.value;}
																			  if(typeof(itea.x)!="undefined"){x1=itea.x;}
																			  if(typeof(itea.fontsize)!="undefined"){fontsize1=itea.fontsize;}
																			  if(typeof(itea.y)!="undefined"){y1=itea.y;}
																			  if(typeof(itea.text)!="undefined"){sytext1=itea.text;}
																			  if(typeof(itea.color)!="undefined"){ctx.fillStyle=itea.color;}
																			  if(typeof(itea.family)!="undefined"){ys_family1=itea.family;}
																			  var n=sytext1.length,textwidth=0;
																			  ctx.font=fontsize1+"px "+ys_family1;
																			   if(sytext1!=""){
																				  for(var j=0;j<sytext1.length;j++){
																					if(sytext1[j]=="　"||t.CheckChinese(sytext1[j])){
																						  textwidth+=fontsize1;
																						 
																					}else{
																						  textwidth+=Math.ceil(fontsize1/2);
																					}
																				   }
																				if(typeof(itea.align)!="undefined"){
																				  if(itea.align=="left"){
																					  x1=10;
																					  y1=7+fontsize1;
																				  }
																				  if(itea.align=="right"){
																					  x1=canvas.width-textwidth-20;
																					  y1=7+fontsize1;
																				  }
																				  if(itea.align=="leftbottom"){
																					  x1=10;
																					  y1=canvas.height-10;
																				  }
																				  if(itea.align=="rightbottom"){
																					  x1=canvas.width-textwidth-20;
																					  y1=canvas.height-10;
																				   }
																				  }
																				  ctx.fillText(sytext1,x1,y1);//坐标点
																			   }
																		  }
																	}
																	
																}
																//var imgData =canvas.toDataURL("image/png");
																//this_base64=canvas.toDataURL("image/jpeg");
																
																//alert(this_base64);
																var oMyForm = new FormData();
																var oBlob=t.convertBase64UrlToBlob(this_base64);
																//console.log(oBlob);
																//oMyForm.append("webmasterfile", oBlob);
																file=oBlob;
																 for(var key in opt.file){
																   if(key!="size"){
																	 file[key]=opt.file[key];
																   }
																 }
																  t.files[opt.myitem.id].file=file;
																  t.files[opt.myitem.id].isupload=1;
															  
																  opt.myitem.setAttribute("mysize",file.size);
																  opt.file=file;
												                  //console.log(t.files);
																   if(typeof(opt.success)!="undefined"){opt.success(file);}
																   if(typeof(opt.autoupload)!="undefined"&&opt.autoupload||typeof(opt.autoupload)=="undefined"){t.SaveFileBytes(opt); }
																
											}else{
																  t.files[opt.myitem.id].file=file;
																  t.files[opt.myitem.id].isupload=1;
																  opt.myitem.setAttribute("mysize",file.size);
																  opt.file=file;
																   if(typeof(opt.success)!="undefined"){opt.success(file);}
																   if(typeof(opt.autoupload)!="undefined"&&opt.autoupload||typeof(opt.autoupload)=="undefined"){t.SaveFileBytes(opt); }
											}
								}

				}
			}else{
				
				var myitem=opt.myitem;
				if(t.isyulan==1){
					var reader = new FileReader();//读取客户端上的文件 
					reader.readAsDataURL(opt.file); 
					reader.onload = function() { 
									var url = reader.result;//读取到的文件内容.这个属性只在读取操作完成之后才有效,并且数据的格式取决于读取操作是由哪个方法发起的.所以必须使用reader.onload，   片
									var relimg=t.GetObjByClass(myitem,"rel_img");
									var imgs=relimg.getElementsByTagName("img");
									if(imgs.length>0){imgs[0].src=url;}
					}
				}
			    t.files[opt.myitem.id].file=file;
			    t.files[opt.myitem.id].isupload=1;
				opt.myitem.setAttribute("mysize",file.size);
				if(typeof(opt.autoupload)!="undefined"&&opt.autoupload||typeof(opt.autoupload)=="undefined"){t.SaveFileBytes(opt); }
				if(typeof(opt.success)!="undefined"){opt.success(opt.file);}
			}
		//}catch(err){
		//	 alert(err.message);
		//}
	    },CheckChinese:function(val){
			var reg = new RegExp("[\\u4E00-\\u9FFF]+","g");
			if(!reg.test(val)){
				return false;
				}else{
					return true;
					}
        },convertBase64UrlToBlob:function(urlData){
				var bytes=window.atob(urlData.split(',')[1]);        //去掉url的头，并转换为byte

				 var arr = urlData.split(','), mime = arr[0].match(/:(.*?);/)[1];
				//处理异常,将ascii码小于0的转换为大于0
				var ab = new ArrayBuffer(bytes.length);
				var ia = new Uint8Array(ab);
				for (var i = 0; i < bytes.length; i++) {
					ia[i] = bytes.charCodeAt(i);
				}
				return new Blob( [ab] , {type : mime});		

		},SaveFileBytes:function(opt){
			            var t=this;
			            var file=opt.file;
						var reader=new FileReader();
						var stop_old = 0;
						var start = 0;
						var stop = 0;
					    var cur_size=0;
						var myitem=opt.myitem;
						var ext=opt.ext;
						var tmpid=t.RndNum(6);//id标识
						var ajax_url=t.opt.url;
						var title=file.name;//文件名
						var type=file.type;

						var cur_size=0;
						var name = file.name,        //文件名
						size = file.size,        //总大小
						shardSize = t.zifu_num,//分片长度
						itemid=myitem.id,
						shardCount = Math.ceil(size / shardSize);  //总片数
						var iscx=opt.myitem.getAttribute("iscx");
						var rel_img=t.GetObjByClass(myitem,"rel_img");
						var imga=myitem.getElementsByTagName("img");
						if(imga.length<1){
							  rel_img.innerHTML="<img src='"+t.GetExtSrc(g_exts,opt.ext)+"'  style='height:100%'/>"; 
						}
						myitem.setAttribute("mysize",file.size);
						var sendPost=function(op){
									if(op.i >= shardCount){
										//alert(shardCount);
										return;
									}
									var obj=document.getElementById(itemid);
						             if(!obj){
										 return false;
									}
									//计算每一片的起始与结束位置
									var start = op.i * shardSize,
									end = Math.min(size, start + shardSize);
									myitem.setAttribute("myuploadsize",end);
									//构造一个表单，FormData是HTML5新增的
									
									var index=op.i + 1;
									var url1=ajax_url+"?act=up";
									var form = new FormData();
									var contentType=false;
									var processData=false;
									var blob;
									if(file.webkitSlice) {
										blob = file.webkitSlice(start, end);
									} else if(file.mozSlice) {
										blob = file.mozSlice(start,end);
									} else if(file.slice) {
										blob = file.slice(start,end);
									} else {
										alert('不支持分段读取！');
										return false;
									}
									form.append("file", blob,file.name);  //slice方法用于切出文件的一部分
									form.append("lastModified", file.lastModified);  //slice方法用于切出文件的一部分
									form.append("title", encodeURI(file.name));
									form.append("ext", ext);
									form.append("tmpid", tmpid);
									form.append("total", shardCount);  //总片数
									form.append("index", index);        //当前是第几片
									form.append("mytxt", t.opt.mytxt);
									form.append("isnewsmall", t.isnewsmall);
									if(typeof(t.opt.post)!="undefined"){
										 for(var k in t.opt.post){
											  form.append(k, t.opt.post[k]); 
										 }
									}
									if(typeof(t.opt.ftp)!="undefined"){
										var objfolder=document.getElementById(t.opt.ftp.folder_id);
										form.append("ftp_folder",objfolder.value);
									}
									if(typeof(t.opt.isyuanming)!="undefined"){form.append("isyuanming", t.opt.isyuanming);}
									
									if(typeof(t.opt.bitian)!="undefined"){
										for(var key in t.opt.bitian){
											 var ite=t.opt.bitian[key],obj=t.getobj({id:ite.id}),val="";
											 if(obj&&obj.tagName=="SELECT"){val=encodeURI(obj.options[obj.selectedIndex].value);}
											 if(obj&&obj.tagName=="INPUT"){val=encodeURI(obj.value); }
											 form.append(ite.id,val);
										}
									}
						
									
									cur_size=(op.i+1)*shardSize;
									if(cur_size>file.size){cur_size =file.size;}
									 //ajax提交
									

									 
									t.ajax({
										url: url1,
										type: "POST",
										data: form,
										async: true,        //异步
										dataType: "html",
										processData: processData,  //很重要，告诉jquery不要对form进行处理
										contentType: contentType,  //很重要，指定为false才能形成正确的Content-Type
										success: function(result){
												 var i=op.i+1;
												 //console.log(result);
												try
												{
														 var json1=eval("("+result+")");
														if (result.indexOf("dengdai") != -1) {
															   if(json1.index==json1.total){
																   if(typeof(cookie)!="undefined"){cookie.Del((file.name));}
																    sendPost({i:0}); 
																    t.NewFileBar({myitem:myitem,success_size:0,file_size:file.size});
															   }else{
																 if(typeof(cookie)!="undefined"){cookie.Add((file.name),index); }
																  t.NewFileBar({myitem:myitem,success_size:cur_size,file_size:file.size});
																  sendPost({i:i});
															   }
														}else if (result.indexOf("success")!=-1) {
															cur_size=file.size;
															if(typeof(iscx)!="undefined"&&iscx==1){
															   
															}else{
																 t.num++;
															}
															if(typeof(cookie)!="undefined"){cookie.Del(file.name);}
															t.Success({myitem:myitem,ext:ext,data:result,size:file.size});
															t.NewFileBar({myitem:myitem,success_size:file.size,file_size:file.size});
		
														}else if (result.indexOf("error")!=-1) {
															
															 t.NewFileBar({myitem:myitem,success_size:100,file_size:100});
															var rel_bt=t.GetObjByClass(myitem,"rel_bt");
															 if(rel_bt){
																 rel_bt.style.display="";
																 rel_bt.setAttribute("isalert",0);
																 rel_bt.click();
															 }
															  var rel_see=t.GetObjByClass(myitem,"rel_see");
															 if(rel_see){
															  rel_see.style.display="none";
															 }
															 t.error_tishi(myitem);
															 t.show_rel(myitem,t.error_show);
															 alert(json1.msg);
														} else {
															if(typeof(cookie)!="undefined"){cookie.Del((file.name));}
															console.log("Error:\n" + result);
															myitem.setAttribute("mystatus","error");
															//alert("文件块上传失败，请重新上传文件!");
															t.error_tishi(myitem);
															t.show_rel(myitem,t.error_show);
														}
												}
												catch(err)
												{
															//if(typeof(cookie)!="undefined"){cookie.Del(escape(file.name));}
															console.log("Error:\n" + result);
															myitem.setAttribute("mystatus","error");
															//alert("文件块上传失败，请重新上传文件!");
															t.error_tishi(myitem);
															t.show_rel(myitem,t.error_show); 
												}

												
										},error:function(){
                                             if(typeof(cookie)!="undefined"){cookie.Del(escape(file.name));}
											 t.error_tishi(myitem);
											 t.show_rel(myitem,t.error_show);
											 if(typeof(t.opt.error)!="undefined"){t.opt.error(myitem);}//失败的回调
										},beforeSend: function (xhr) {
// //发送ajax请求之前向http的head里面加入验证信息
                                               xhr.setRequestHeader("token", "555555555555"); // 请求发起前在头部附加token
                                             }
									});
						}
						var myi=0;
						//cookie.Add(escape("中中"),55);
						//cookie.Clear();
		
		
						
						//if(typeof(cookie)!="undefined"){cookie.Del(escape(file.name));}
						if(typeof(cookie)!="undefined"&&typeof(t.opt.isbigfile)!="undefined"&&t.opt.isbigfile==1){
						           var u=cookie.Get((file.name));
								   if(u!=""){
									     myi=parseInt(u)-1;
										 cur_size= parseInt(u) * shardSize;
								   }   
						 }
						sendPost({i:myi});
		},error_tishi:function(myitem){
			var t=this;
			var o=t.GetObjByClass(myitem,"rel_chongchuan");o.style.display="";
			var chongchuan=t.GetObjByClass(myitem,"rel_chongchuan");var baifenbi=t.GetObjByClass(myitem,"rel_baifenbi");
			var chongchuan_text="网络不好",baifenbi_text="失败";
			if(typeof(t.opt.wenzi)!="undefined"&&typeof(t.opt.wenzi.chongchuan_e)!="undefined"){
				 chongchuan_text=t.opt.wenzi.chongchuan_e;
			}
			if(typeof(t.opt.wenzi)!="undefined"&&typeof(t.opt.wenzi.baifenbi_e)!="undefined"){
				  baifenbi_text=t.opt.wenzi.baifenbi_e;
			}
			 if(chongchuan){chongchuan.innerHTML=chongchuan_text;}
			 if(baifenbi){baifenbi.innerHTML=baifenbi_text;}
		},show_rel:function(myitem,conf){
			var t=this;
			var del=t.GetObjByClass(myitem,"rel_del");
			var chongchuan=t.GetObjByClass(myitem,"rel_chongchuan");
			var baifenbi=t.GetObjByClass(myitem,"baifenbi");
			var bg=t.GetObjByClass(myitem,"rel_bg");
			var name=t.GetObjByClass(myitem,"rel_name");
			var bar=t.GetObjByClass(myitem,"rel_bar");
			var see=t.GetObjByClass(myitem,"rel_see");
			var chongxuan=t.GetObjByClass(myitem,"chongxuan");
			var size=t.GetObjByClass(myitem,"rel_size");
			var img=t.GetObjByClass(myitem,"rel_img");
			var date=t.GetObjByClass(myitem,"rel_date");
           if(typeof(conf)!="undefined"){
			  if(typeof(conf.del)!="undefined"&&conf.del==1&&del){del.style.display="";}else{if(del){del.style.display="none";}}
			  if(typeof(conf.chongchuan)!="undefined"&&conf.chongchuan==1&&chongchuan){chongchuan.style.display="";}else{if(chongchuan){chongchuan.style.display="none";}}
			  if(typeof(conf.baifenbi)!="undefined"&&conf.baifenbi==1&&baifenbi){baifenbi.style.display="";}else{if(baifenbi){baifenbi.style.display="none";}}
			  if(typeof(conf.bar)!="undefined"&&conf.bar==1&&bar){bar.style.display="";}else{if(bar){bar.style.display="none";}}
			  if(typeof(conf.bg)!="undefined"&&conf.bg==1&&bg){bg.style.display="";}else{if(bg){bg.style.display="none";}}
			  if(typeof(conf.name)!="undefined"&&conf.name==1&&name){name.style.display="";}else{if(name){name.style.display="none";}}
			  if(typeof(conf.see)!="undefined"&&conf.see==1&&see){see.style.display="";}else{if(see){see.style.display="none";}}
			  if(typeof(conf.chongxuan)!="undefined"&&conf.chongxuan==1&&chongxuan){chongxuan.style.display="";}else{if(chongxuan){chongxuan.style.display="none";}}
			  if(typeof(conf.size)!="undefined"&&conf.size==1&&size){size.style.display="";}else{if(size){size.style.display="none";}}
			  if(typeof(conf.img)!="undefined"&&conf.img==1&&img){img.style.display="";}else{if(img){img.style.display="none";}}
			  if(typeof(conf.date)!="undefined"&&conf.date==1&&date){date.style.display="";}else{if(date){date.style.display="none";}}
		    }
		},Success:function(opt){
			var t=this;
		//try{

		          var myitem=opt.myitem;
				     if(g_isshowdata==1){
					    alert(opt.data);
				     }
					 var json=eval("("+opt.data+")");
					 if(json.status=="error"){
						 var rel_bt=t.GetObjByClass(myitem,"rel_bt");
						 if(rel_bt){
							 rel_bt.style.display="";
						 }
						 alert(json.msg);
						 return false;
					 };
					 var filepath=json.filepath;
					 t.isload=0;
					 var btstr="";
					 if(t.panel==null){
					  btstr+="<table cellpadding='0' cellspacing='0' border='0' style='height:"+t.opt.height+"px;width:100%;'>";
					  btstr+="<tr style='height:100%;'><td valign='middle' style='height:100%;'>";
					  btstr+="<img src='"+t.siteurl_file+json.small_src+"' style='width:"+t.opt.width+"px;'/>";
					  btstr+="</td></tr></table>";
					  if(t.bt){
					     t.bt.innerHTML=btstr;
					  }else{
						 //t.item.innerHTML=btstr;
					  }
					 }else{
					   //t.bt.innerHTML=t.fengmian_html;
					 }

       
					var images=myitem.getElementsByTagName("img");
					if(t.opt.maxnum>1&&t.panel){
						if(images.length>0){
							 images[0].onclick=function(){
								 t.ShowBig(this);
							 }
						}
					}
					  var iscx=0;
					  var oldsmallsrc="";
					  if(myitem!=null){
						   if(typeof(myitem.getAttribute("iscx"))!="undefined"&&myitem.getAttribute("iscx")!=null){
							  iscx=parseInt(myitem.getAttribute("iscx")); 
							  oldsmallsrc=myitem.getAttribute("small_src");
						   }
					  }
					if(t.input){ 
					         if(typeof(t.opt.item_values_fields)!="undefined"&&t.opt.item_values_fields!=""){
								   var newval="";
								   for(var i=0;i<t.opt.item_values_fields.length;i++){
										  var val="";
										     if(t.opt.item_values_fields[i]=="src"){
												  val=json.small_src;
											 }else{
										     if(typeof(json[t.opt.item_values_fields[i]])!="undefined"){
											     val=json[t.opt.item_values_fields[i]];
											  }
											 }
									      if(newval!=""){newval+=t.fenge_child+val;}else{newval=val;}
								   }
								   if(iscx==1){
									   var arr=t.input.value.split(t.fenge);
									   var str="";
									   for(var j=0;j<arr.length;j++){
										   var val=arr[j];
										   if(val!=""){
											   if(val.indexOf(oldsmallsrc)!=-1){
												  val=newval;
											   }
										   }
										   if(str!=""){str+=t.fenge+val;}else{str=val;}
									   }
									   t.input.value=str;
								   }else{
								       if(t.input.value!=""){t.input.value+=t.fenge+newval;}else{ t.input.value=newval;}
								   }
							 }else{
								   var newval=t.ReturnSrc(json.small_src);
								   if(iscx==1){
									   var arr=t.input.value.split(t.fenge);
									   var str="";
									   for(var j=0;j<arr.length;j++){
										   var val=arr[j];
										   if(val!=""&&val.indexOf(oldsmallsrc)!=-1){
												  val=newval;
										   }
										   if(str!=""){str+=t.fenge+val;}else{str=val;}
									   }
									   t.input.value=str;
								   }else{
								      if(t.input.value!=""){t.input.value+=t.fenge+newval;}else{ t.input.value=newval;}
								   }
							 }
					}
					if(t.input_fengmian){
						      if(t.opt.maxnum==1){
							     t.input_fengmian.value=t.ReturnSrc(json.small_src);
							  }else if(t.input_fengmian.value==""){
								 t.input_fengmian.value=t.ReturnSrc(json.small_src);  
							  }
					}
					  //要重新获取不然会只有一个有图片，这个很奇怪
					  if(myitem!=null){
                                myitem.setAttribute("big_src",json.big_src);
			                    var input_src=t.GetObjByAttr(myitem,"myname","src");
							   if(input_src){input_src.value=json.big_src;};
							   var input_date=t.GetObjByAttr(myitem,"myname","date");
							   if(input_date){input_src.value=json.date;};
								myitem.setAttribute("small_src",json.small_src);
								myitem.setAttribute("big_src",json.big_src);
								
							  if(t.IsImg(opt.ext)){
							     myitem.getElementsByTagName("img")[0].src=t.siteurl_file+json.small_src;
								 myitem.setAttribute("big_src",json.big_src);
							  }else{
								 myitem.getElementsByTagName("img")[0].src=t.GetExtSrc(g_exts,opt.ext);
								 myitem.setAttribute("big_src",json.big_src);
							  }
							  var rel_name=t.GetObjByClass(myitem,"rel_name");
							  var rel_date=t.GetObjByClass(myitem,"rel_date");
							  var  a_style="";
					
							  if(typeof(t.opt.item_class)=="undefined"||t.opt.item_class==""){
								  //a_style=" style='color:#fff;'"
							  }
							  if(rel_name){
								  if(typeof(t.opt.down_url)!="undefined"&&t.opt.down_url!=""){
									  rel_name.innerHTML="<a href='"+t.opt.down_url+"?path="+json.big_src+"&cengci="+json.cengci+"' target='_blank'  "+a_style+">"+rel_name.innerHTML+"</a>";
								  }else{
								      rel_name.innerHTML="<a href='"+t.siteurl_file+json.big_src+"' target='_blank' "+a_style+">"+rel_name.innerHTML+"</a>";
								  }
								  var as=document.getElementsByTagName("a");
								  if(as.length>0){as[0].onclick=function(event){event.stopPropagation();}}
							  }
							   if(rel_date){
								   rel_date.innerHTML=json.date;
							   }
							  //alert(typeof(myitem.childNodes[4]));
							    if(typeof(myitem.childNodes[4])!="undefined"&&myitem.childNodes[4].className=="rel_fengmian"){
								    myitem.childNodes[4].style.display="block";
								}
							  //
								myitem.setAttribute("mystatus","success");
							if(t.input&&t.input.value==""&&t.inputmore){
									  t.input.value=t.ReturnSrc(json.small_src);
									  var items=t.panel.childNodes;
									  if(t.isfengmian==1){
														for(var j=0;j<items.length;j++){
															if(items[j].id!=myitem.id){
																 items[j].style.borderColor=conf.rel.bordercolor;
																 items[j].childNodes[4].style.color=conf.fengmian.color;
																 items[j].childNodes[4].style.backgroundColor=conf.fengmian.bgcolor;
																 
															}else{
																 items[j].style.borderColor=conf.rel.bordercolor1;
																 items[j].childNodes[4].style.color=conf.fengmian.color1;
																 items[j].childNodes[4].style.backgroundColor=conf.fengmian.bgcolor1;
															}
														}
									  }
							 }
							 myitem.removeAttribute("iscx");
					  }else{
						  var imgs=document.getElementsByTagName("img");
						  for(var i=0;i<imgs.length;i++){
							  if(t.IsImg(opt.ext)){
								 imgs[i].src=t.siteurl_file+json.small_src;//显示缩略图
							  }else{
								 imgs[i].src= t.GetExtSrc(g_exts,opt.ext); //显示缩略图
							  }
						  }
					  }
					  if(t.opt.maxnum==1){
						  if(t.input)t.input.value=t.ReturnSrc(json.small_src);
					  }


		//}catch(err){
		//						 alert(err.message);
		//}		
		},ShowBig:function(obj){
		    	var t=this;
			    var myitem=t.GetParentItem(obj);          
				 var path=myitem.getAttribute("big_src");

				 var small_src=myitem.getAttribute("small_src");
				 if(typeof(path)!="undefined"){
					  if(t.isnewsmall==0){
						   window.open(t.siteurl_file+small_src);
					  }else{
					      window.open(t.siteurl_file+path);
					  }
				 }
		},NewFileBar:function(opt){//进度条
			var t=this;
			var myitem=opt.myitem;
			if(myitem){
				      var rel_baifenbi=t.GetObjByClass(myitem,"rel_baifenbi");
					  var rel_bar=t.GetObjByClass(myitem,"rel_bar");
					  var rel_img=t.GetObjByClass(myitem,"rel_img");
					  var rel_del=t.GetObjByClass(myitem,"rel_del");
					  var rel_fengmian=t.GetObjByClass(myitem,"rel_fengmian");
					  var rel_size=t.GetObjByClass(myitem,"rel_size");
					  var rel_name=t.GetObjByClass(myitem,"rel_name");
					  var rel_date=t.GetObjByClass(myitem,"rel_date");
					  var rel_chongxuan=t.GetObjByClass(myitem,"rel_chongxuan");
					  var rel_bg=t.GetObjByClass(myitem,"rel_bg");
					  var rel_see=t.GetObjByClass(myitem,"rel_see");
					  var rel_canvas=t.GetObjByClass(myitem,"rel_canvas");
					  var rel_chongchuan=t.GetObjByClass(myitem,"rel_chongchuan");
				      var h=t.opt.height;
					  var obj;
					  if(rel_chongchuan){rel_chongchuan.style.display="none";}
							    if(t.opt.upload_show&&typeof(t.opt.upload_show.bg)!="undefined"&&rel_bg){
									 if(t.opt.upload_show.bg==1){rel_bg.style.display="";}else{rel_bg.style.display="none";}
								}else{
									if(rel_bg){rel_bg.style.display="none";} 
								}

							    if(t.opt.upload_show&&typeof(t.opt.upload_show.size)!="undefined"&&rel_size){
									 if(t.opt.upload_show.size==1){rel_size.style.display="";}else{rel_size.style.display="none";}
								}else{
									if(rel_size){rel_size.style.display="none";} 
								}
								
							    if(t.opt.upload_show&&typeof(t.opt.upload_show.bar)!="undefined"&&rel_bar){
									 if(t.opt.upload_show.bar==1){rel_bar.style.display="";}else{rel_bar.style.display="none";}
								}else{
									if(rel_bar){rel_bar.style.display="none";} 
								}
								
							    if(t.opt.upload_show&&typeof(t.opt.upload_show.del)!="undefined"&&rel_del){
									 if(t.opt.upload_show.del==1){rel_del.style.display="";}else{rel_del.style.display="none";}
								}else{
									if(rel_del){rel_del.style.display="none";} 
								}
								
							    if(t.opt.upload_show&&typeof(t.opt.upload_show.chongxuan)!="undefined"&&rel_chongxuan){
									 if(t.opt.upload_show.chongxuan==1){rel_chongxuan.style.display="";}else{rel_chongxuan.style.display="none";}
								}else{
									if(rel_chongxuan){rel_chongxuan.style.display="none";} 
								}
								
							    if(t.opt.upload_show&&typeof(t.opt.upload_show.see)!="undefined"&&rel_see){
									 if(t.opt.upload_show.see==1){rel_see.style.display="";}else{rel_see.style.display="none";}
								}else{
									if(rel_see){rel_see.style.display="none";} 
								}
							    if(t.opt.upload_show&&typeof(t.opt.upload_show.name)!="undefined"&&rel_name){
									 if(t.opt.upload_show.name==1){rel_name.style.display="";}else{rel_name.style.display="none";}
								}else{
									if(rel_name){rel_name.style.display="none";} 
								}



					 var result=[];
					 result['success_size']=opt.success_size;
					 result['file_size']=opt.file_size;
					 if(typeof(t.opt.totalbar)!="undefined"){
						      t.opt.totalbar({t:t});
					 }
                   // console.log("json:\n" + "success_size:"+opt.success_size + ",file_size:"+opt.file_size);
						if(opt.success_size!=opt.file_size){
							var n=Math.round(opt.success_size / opt.file_size * 100);
							//console.log("json:\n" + "success_size:"+opt.success_size + ",file_size:"+opt.file_size+" n:"+n);
							if(rel_baifenbi){ rel_baifenbi.innerHTML=n+"%";}
							if(rel_bar){ if(typeof($)!="undefined" && typeof(t.opt.bar_animate)!="undefined"){$(rel_bar).animate({width:n+"%"});}else{ rel_bar.style.width=n+"%"; }}
						    
							if(rel_canvas){t.CanvasBar({canvas:rel_canvas,n:n});}
						}else{
							//完成开始
							var n=100;
							if(rel_baifenbi){rel_baifenbi.innerHTML="100%";}
							if(rel_bar){ if(typeof($)!="undefined" && typeof(t.opt.bar_animate)!="undefined"){$(rel_bar).animate({width:n+"%"});}else{ rel_bar.style.width=n+"%"; }}
							if(rel_canvas){t.CanvasBar({canvas:rel_canvas,n:100});}
							if(rel_fengmian){rel_fengmian.style.display="";}
							
							var  files=[];
							for(key in t.files){
								 if(key!=myitem.id){
									files[key] =t.files[key];
								 }
							}
							 if(rel_img){
								  var imgs=rel_img.getElementsByTagName("img");
								  if(imgs.length>0){
									  //imgs[0].style.width="auto";
								  }
							 }
							if(typeof(t.opt.success_show)!="undefined"){
								if(t.opt.success_show&&typeof(t.opt.success_show.bg)!="undefined"&&rel_bg){
									 if(t.opt.success_show.bg==1){rel_bg.style.display="";}else{rel_bg.style.display="none";}
								}else{
									if(rel_bg){rel_bg.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.size)!="undefined"&&rel_size){
									 if(t.opt.success_show.size==1){rel_size.style.display="";}else{rel_size.style.display="none";}
								}else{
									if(rel_size){rel_size.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.bar)!="undefined"&&rel_bar){
									 if(t.opt.success_show.bar==1){rel_bar.style.display="";}else{rel_bar.style.display="none";}
								}else{
									if(rel_bar){rel_bar.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.del)!="undefined"&&rel_del){
									 if(t.opt.success_show.del==1){rel_del.style.display="";}else{rel_del.style.display="none";}
								}else{
									if(rel_del){rel_del.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.chongxuan)!="undefined"&&rel_chongxuan){
									 if(t.opt.success_show.chongxuan==1){rel_chongxuan.style.display="";}else{rel_chongxuan.style.display="none";}
								}else{
									if(rel_chongxuan){rel_chongxuan.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.baifenbi)!="undefined"&&rel_baifenbi){
									 if(t.opt.success_show.baifenbi==1){rel_baifenbi.style.display="";}else{rel_baifenbi.style.display="none";}
								}else{
									if(rel_baifenbi){rel_baifenbi.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.see)!="undefined"&&rel_see){
									 if(t.opt.success_show.see==1){rel_see.style.display="";}else{rel_see.style.display="none";}
								}else{
									if(rel_see){rel_see.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.name)!="undefined"&&rel_name){
									 if(t.opt.success_show.name==1){rel_name.style.display="";}else{rel_name.style.display="none";}
								}else{
									if(rel_name){rel_name.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.canvas)!="undefined"&&rel_canvas){
									 if(t.opt.success_show.canvas==1){rel_canvas.style.display="";}else{rel_canvas.style.display="none";}
								}else{
									if(rel_canvas){rel_canvas.style.display="none";} 
								}
								if(t.opt.success_show&&typeof(t.opt.success_show.date)!="undefined"&&rel_date){
									 if(t.opt.success_show.date==1){rel_date.style.display="";}else{rel_date.style.display="none";}
								}else{
									if(rel_date){rel_date.style.display="none";} 
								}
							}else{
								 if(rel_bar){rel_bar.style.display="none";}
								 if(rel_name){rel_name.style.display="none";}
								 if(rel_baifenbi){rel_baifenbi.style.display="none";}
								 if(rel_chongxuan){rel_chongxuan.style.display="none";}
								 if(rel_size){rel_size.style.display="none";}
								 if(rel_see){rel_see.style.display="none";}
								 if(rel_canvas){rel_canvas.style.display="none";}
								 if(t.panel){
								      if(rel_del){rel_del.style.display="";}
								 }else{
									  if(rel_del&&t.opt.maxnum>1){rel_del.style.display="";}else{rel_del.style.display="none";}
								 }
							}
							 if(typeof(t.opt.ischongxuan)!="undefined"&&t.opt.ischongxuan==1){
								 if(rel_chongxuan){rel_chongxuan.style.display="";}
							 }
							 myitem.className=myitem.className+" hcsuccess";
							t.files=files;
							t.ShowSuccessFileCount();
							t.ShowSelectFileCount();
							if(typeof(t.opt.success)!="undefined"){
								t.opt.success({t:t,maxnum:t.opt.maxnum,num:t.num});
							}
							
					    }
														
				}
				if(t.isshowsize==1){
				   if(rel_size){
					  rel_size.innerHTML=t.FormatSize(opt.success_size);
				   }
				}
		},CanvasBar:function(opt){
									 var canvas = opt.canvas,width = canvas.width,height = canvas.height,ctx = canvas.getContext('2d');  
									 var step,startAngle=0,endAngle,add=Math.PI*2/100;
									 ctx.shadowOffsetX = 0; // 设置水平位移
									 ctx.shadowOffsetY = 0; // 设置垂直位移
									 ctx.shadowBlur = 10; // 设置模糊度
									 var lineWidth = 30,counterClockwise = false,x,y,radius,animation_interval = 20,n = opt.n,timer;
									 step=1;
									 startAngle=0;
									 //ctx.strokeStyle ='#'+('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6);//圆圈颜色  
									 // ctx.strokeStyle ='#'+('000000');//圆圈颜色   
									// ctx.shadowColor = '#'+('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6); // 设置阴影颜色
									 if(opt.canvas.getAttribute("data-strokeStyle")==null){
										opt.canvas.setAttribute("data-strokeStyle",'#'+('00000'+(Math.random()*0x1000000<<0).toString(16)).slice(-6))  ; 
									 }
									 ctx.strokeStyle=opt.canvas.getAttribute("data-strokeStyle");
									 ctx.shadowColor=ctx.strokeStyle;
									 //圆心位置
									 

									 x=parseInt(width/2);
									 y=parseInt(width/2);
									 radius = parseInt((width-lineWidth)/2)-10;                
							
							         var animation = function () {  
										 if (step <= n) {  
											 endAngle = startAngle + add ;  
											 drawArc(startAngle, endAngle); 
											 startAngle = endAngle;
										
											 step++;  
										 } else {  
											 clearInterval(timer);  
										 }  
									 
							           };
									
							         var drawArc=function(s, e) {  
										  ctx.beginPath();   
										  ctx.arc(x, y, radius, s, e, counterClockwise);  
										  ctx.lineWidth = lineWidth;        
										  ctx.stroke();  
							          }
									 if(opt.canvas.getAttribute("data-n")!=null&&typeof(opt.canvas.getAttribute("data-n"))!="undefined"){
										   step=parseInt(opt.canvas.getAttribute("data-n"));
										   startAngle=step*add;
									 }else{
										   startAngle=0;
										   step=1;
										  
									 }
									  //  alert(step+"="+opt.n);
							         opt.canvas.setAttribute("data-n",opt.n);
									 drawArc(startAngle, opt.n*add); 
									  //  var timer= setInterval(animation, animation_interval);
							 

		},FormatSize:function(size){
					  if(size/(1024*1024*1024)>1){
						   return (size/(1024*1024*1024)).toFixed(2)+"G";  
					   } else if(size/(1024*1024)>1){
						   return (size/(1024*1024)).toFixed(2)+"M";  
					   } else if(size/(1024)>1){
						   return (size/1024).toFixed(2)+"K";
					   }else{
						   return (size)+"B";
					   }
		},ShowSelectFileCount:function(){
			            var t=this;
						var num1=0;
						for(var key in t.files){
							num1++;
						}

						if(t.obj_select_num){
							t.obj_select_num.innerHTML=num1;
						}
						
		},ShowSuccessFileCount:function(){
			            var t=this;
						if(t.obj_success_num){
							t.obj_success_num.innerHTML=t.num;
						}
		},GetObjByClass:function(parent,classname){
		  var childs=parent.getElementsByTagName("*");	
		  var obj=null;
		  for(var i=0;i<childs.length;i++){
			  var child=childs[i];
			  if(typeof(child.className)!="undefined"){
				  if(child.className.indexOf(classname)!=-1){
					  obj=child;
					  break;
				  }
			  }
		  }
		 return obj;
		},GetObjByAttr:function(parent,attrname,val){
		  var childs=parent.getElementsByTagName("*");	
		  var obj=null;
		  for(var i=0;i<childs.length;i++){
			  var child=childs[i];
			  if(typeof(child.getAttribute(attrname))!="undefined"){
				  var thisval=String(child.getAttribute(attrname));
				  if(thisval.indexOf(val)!=-1){
					  obj=child;
					  break;
				  }
			  }
		  }
		 return obj;
	    },ReturnSrc:function(src){
			var t=this;
		   if(t.isfull==1){
			    return t.siteurl_file+src;
		   }else{
			    return src;
	       }
		},FileExt:function(opt){
			        var t=this;
			        var ext="";
					var arr=[];
					var file_ext="";
					var contenttype="";
					var filename="";
					if(typeof(opt.file)!="undefined"){
						contenttype=opt.file.type;
						filename=opt.file.name;
					}else{
						contenttype =opt.contenttype;
						filename =opt.filename;
					}
					var arr=filename.toLowerCase().split(".");
					
					if(contenttype==""&&filename.indexOf("image")!=-1){
						file_ext="jpg";
					}else if(contenttype==""&&arr.length>1){
						file_ext=arr[arr.length-1];
					}else if(contenttype!=""){
						arr=contenttype.toLowerCase().split('/');
						file_ext=arr[arr.length-1];
					}
					
		  			if(t.opt.type!=""&&t.opt.type!="all"){
								var isbool=0;
								if(contenttype!=""){
									for(var i=0;i<g_exts.length;i++){
										 if(contenttype==g_exts[i].contenttype&&g_exts[i].type==t.opt.type){
											 ext=g_exts[i].ext;
											 isbool=1;
											 //break;
										 }
									} 
								}else{
									for(var i=0;i<g_exts.length;i++){
										 if(file_ext==g_exts[i].ext&&g_exts[i].type==t.opt.type){
											 ext=g_exts[i].ext;
											 isbool=1;
											 break;
										 }
									} 
								}
								if(isbool==0){
									if(t.opt.type=="yinpin"){
									  alert("请上传音频文件!"); 
									}else if(t.opt.type=="shipin"){
									  alert("请上传视频文件!"); 
									}else if(t.opt.type=="img"){
									  alert("请上传图片!"); 
									}else if(t.opt.type=="file"){
									  alert("请上传文件!"); 
									}else{
									  alert("url中的type配置错误!允许的参数为:yinpin,shipin,img,file"); 
									}
								}
					}else{
								var isbool=0;
								if(contenttype!=""){
									for(var i=0;i<g_exts.length;i++){
										 if(contenttype==g_exts[i].contenttype){
											 ext=g_exts[i].ext;
											 isbool=1;
											 break;
										 }
									} 
								}else{
									for(var i=0;i<g_exts.length;i++){
										 if(file_ext==g_exts[i].ext){
											 ext=g_exts[i].ext;
											 isbool=1;
											 break;
										 }
									} 
								}
					}
					return ext;
		 },NewItem:function(opt){
			
			     var t=this;
				 if(t.opt.item_html){
					return t.NewItem20170116(opt);
				 }
				 var src="";
				 if(typeof(opt.src)=="undefined"){
					 //src=g_moren_bgsrc;
				 }else{
					 src=opt.src;
				 }
	
				 opt.tmpid=t.RndNum(7);
				 var zindex1=1009;
				 
				 var filename,filesize,filesize_caption="";
				 var ext="";
				 if(opt.file){
						var file=opt.file;
						var title=file.name;
						var filetype=file.type;
						 filename=file.name;
						 filesize=file.size;
						var arr=filename.split(".");
						var file_ext=arr[arr.length-1];
						file_ext=file_ext.toLowerCase();
						ext=t.FileExt({filename:filename,contenttype:filetype});
						src=(t.GetShowImg(ext));
						filesize_caption=t.FormatSize(filesize);
				 }else{
					 filename=opt.small_src;
				 }
				 var parent=t.panel;
				 if(opt.parent){
					parent=opt.parent;
				 }
			     if(parent){
					       parent.style.display="";
								myitem=document.createElement("div");
								if(t.opt.item_class){
								    myitem.className=t.opt.item_class;
								}else{
									myitem.className=t.mr_class;
								}
								var w=t.opt.width+"px",h=t.opt.height+"px";
								if(String(t.opt.width).indexOf("%")!=-1){w=t.opt.width;}
								if(String(t.opt.height).indexOf("%")!=-1){h=t.opt.height;}
						
								
								if(!t.opt.item_class){
									myitem.style.cssText="margin:"+g_margin+"px;margin-left:0px;overflow:hidden;";
									myitem.style.width=w;
									myitem.style.height=h;
									myitem.style.border="solid "+t.opt.border+"px #CCCCCC";
									myitem.style.position="relative";
									myitem.style.float="left";
								}
								
								myitem.id=t.input_id+"_item_"+opt.tmpid;
								myitem.setAttribute("tmpid",opt.tmpid);
								myitem.setAttribute("myparent","hcitem");
								if(typeof(t.opt.inserttype)=="undefined"){
									parent.appendChild(myitem);
								}else{
								  if(parent.childNodes.length==0){
									  parent.appendChild(myitem);
								  }else if(t.opt.inserttype=="defore"){
								      parent.insertBefore(myitem,parent.childNodes[0]);
								  }
								}


								
								var rel_img=document.createElement("div");
								rel_img.className="rel_img";
								zindex1++;
								if(typeof(opt.bt_html)!="undefined"){
									   rel_img.innerHTML=opt.bt_html;
									   rel_img.style.cssText="width:"+w+";height:"+h+";position:absolute;left:0px;top:0px;text-align:center;z-index:"+zindex1;
									 
								}else{
									if(typeof(t.opt.item_class)=="undefined"||String(t.opt.item_class)==""){
									   rel_img.style.cssText="width:"+w+";height:"+h+";position:absolute;left:0px;top:0px;text-align:center;z-index:"+zindex1;
									   
									   rel_img.innerHTML="<img src='"+src+"' style='width:"+w+";height:"+h+";border:0px;'/>";
									}else{
										rel_img.innerHTML="<img src='"+src+"'/>";
									}
								}
							
								 if(!opt.file&&opt.type!="bt"){
									 var imgs= rel_img.getElementsByTagName("img") ;
									 if(imgs.length>0){
										 imgs[0].onclick=function(){
											 t.ShowBig(this);
										 }
									 }
								 }
								var rel_bar=document.createElement("div");
								rel_bar.className="rel_bar";
								zindex1++;
								if(!t.opt.item_class){
								   rel_bar.style.cssText="position:absolute;top:0px;left:0px;height:100%;width:100%;z-index:"+zindex1+";background-color:#000;filter:alpha(opacity=50); -moz-opacity:0.5;opacity:0.5;color:#ffffff; text-align:center;";
								}

								myitem.appendChild(rel_bar);
								if(t.IsImg(ext)){
//								  var reader1 = new FileReader();
//								  reader1.readAsDataURL(file);
//								  reader1.onload = function(e){
//								   //src=this.result;
//								   rel_img.childNodes[0].src=this.result;
//								  }
								}
								
								
								var rel_baifenbi=document.createElement("div");
								rel_baifenbi.className="rel_baifenbi";
								rel_baifenbi.style.display="none";
                                 if(typeof(t.opt.wenzi)!="undefined"&&typeof(t.opt.wenzi.baifenbi)!="undefined"){rel_baifenbi.innerHTML=t.opt.wenzi.baifenbi;}
								if(!t.opt.item_class){
									var bt_fontsize=12;
									if(typeof(t.opt.baifenbi_style)!="undefined"){
										  var fs=t.opt.baifenbi_style["font-size"];
										 if(typeof(fs)!="undefined"&&String(fs).indexOf("%")==-1){
											   bt_fontsize=parseInt(fs);
										}
									}
								   bf_margintop=-(bt_fontsize/2+1);
								   rel_baifenbi.style.cssText="position:absolute;top:50%;left:0px;height:100%;width:100%;z-index:"+zindex1+";color:#ffffff; text-align:center;margin-top:"+bf_margintop+"px;font-size:"+bt_fontsize+"px;";
								   if(typeof(t.opt.baifenbi_style)!="undefined"){
								    for(key in t.opt.baifenbi_style){
										rel_baifenbi.style[key]=t.opt.baifenbi_style[key];
								    }
								   }
								}
								var baifenbi_text="等待";
								if(typeof(opt.wenzi)!="undefined"&&typeof(opt.wenzi.baifenbi)!="undefined"){baifenbi_text=opt.wenzi.baifenbi;}
                                rel_baifenbi.innerHTML=baifenbi_text;
								
								var rel_size=document.createElement("div");
								if(!t.opt.item_class){
								rel_size.style.cssText="display:none;position:absolute;cursor:pointer;padding:0px;border:0px;left:0px;bottom:0px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:"+20+"px;height:"+20+"px;color:"+conf.size.color+";background-color:"+conf.size.bgcolor+";z-index:"+zindex1;
								}
								rel_size.className="rel_size";
						
								rel_size.innerHTML=filesize_caption;
								
								var rel_name=document.createElement("div");
								if(!t.opt.item_class){
								rel_name.style.cssText="display:none;position:absolute;cursor:pointer;padding:0px;border:0px;right:0px;bottom:0px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:"+20+"px;height:"+20+"px;color:"+conf.size.color+";background-color:"+conf.size.bgcolor+";zIndex:"+zindex1;
								}
								rel_name.className="rel_name";

								if(typeof(opt.row)!="undefined"&&typeof(opt.row.title)!="undefined"){
									   rel_name.innerHTML=opt.row.title;
								}else{
								       rel_name.innerHTML=filename;
								}
								
								var rel_date=document.createElement("div");
								if(!t.opt.item_class){
								rel_date.style.cssText="display:none;position:absolute;cursor:pointer;padding:0px;border:0px;right:0px;bottom:20px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:"+20+"px;height:"+20+"px;color:"+conf.size.color+";zIndex:"+zindex1;
								}
								rel_date.className="rel_date";rel_date.innerHTML="";rel_date.style.display="none";
								var rel_chongchuan=document.createElement("div");
								if(!t.opt.item_class){
								rel_chongchuan.style.cssText="display:none;position:absolute;cursor:pointer;padding:0px;border:0px;right:0px;bottom:20px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:2px; padding-left:5px;padding-right:5px;font-size:12px;display:block;line-height:"+20+"px;height:"+20+"px;color:"+conf.size.color+";zIndex:"+zindex1;
								}
								rel_chongchuan.className="rel_chongchuan";rel_chongchuan.innerHTML="重传";rel_chongchuan.style.display="none";
								rel_chongchuan.setAttribute("itemid",myitem.id);
								rel_chongchuan.onclick=function(event){
									t.chongchuanfile({itemid:this.getAttribute("itemid")}); 
									event.stopPropagation();
								}

								var rel_del=document.createElement("div");
								rel_del.className="rel_del";
								//rel_del.type="button";
								var del_text="×";
								if(typeof(t.opt.bt_del_text)!="undefined"){del_text=t.opt.bt_del_text;}
								if(typeof(t.opt.wenzi)!="undefined"&&typeof(t.opt.wenzi.shanchu)!="undefined"){del_text=t.opt.wenzi.shanchu;}
								if(typeof(t.opt.wenzi)!="undefined"&&typeof(t.opt.wenzi.del)!="undefined"){del_text=t.opt.wenzi.del;}
								rel_del.innerHTML=del_text;
								var rel_chongxuan=null;
								var rel_bg=document.createElement("div");
								if(!t.opt.item_class){
								rel_bg.style.cssText="display:none;position:absolute;cursor:pointer;padding:0px;border:0px;right:0px;bottom:20px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;padding:0px; padding-left:5px;padding-right:5px;font-size:12px;display:block;height:"+h+"px;color:"+conf.size.color+";zIndex:"+zindex1;

								}
	
								rel_bg.className="rel_bg";
								rel_bg.innerHTML="";
								rel_bg.style.display="none";
								
								var rel_see=document.createElement("div");
								rel_see.className="rel_see";
								var see_text="查看";
								if(typeof(t.opt.bt_see_text)!="undefined"){
								  see_text=t.opt.bt_see_text;	
								}
								if(typeof(t.opt.wenzi)!="undefined" && typeof(t.opt.wenzi.see)!="undefined"){
									see_text=t.opt.wenzi.see;
								}
								rel_see.innerHTML=see_text;
								
								rel_see.style.display="none";
							    rel_see.onclick=function(event){
//								     var parent=this.parentNode;
//									 if(parent.id.indexOf(t.input_id+"_item")==-1){
//									  parent=parent.parentNode;
//									 }
//									 var small_src=parent.getAttribute("small_src");
//									 var big_src1=parent.getAttribute("big_src");
						             t.ShowBig(this);
									 event.stopPropagation();
							    }
								
								if(t.opt.ueditor_id){
									var rel_insert=document.createElement("div");
									rel_insert.className="rel_insert";
									if(!t.opt.item_class){
								 rel_insert.style.cssText="position:absolute;bottom:0px; cursor:pointer;display:none; text-align:center; left:0px; width:100%; white-space:nowrap;filter: alpha(opacity=80);background-color: #000000; color:#FFFFFF;opacity: 0.8; line-height:18px;z-index:"+(zindex1+100);
									}
								 rel_insert.innerHTML="插入";
								 rel_insert.onclick=function(e){
									     var parent=this.parentNode,big_src1=parent.getAttribute("big_src"),value=t.siteurl_file+big_src1;
										 if(typeof(UE)!="undefined"&&UE&&UE.getEditor(t.opt.ueditor_id)){
                                           UE.getEditor(t.opt.ueditor_id).focus();  
									       UE.getEditor(t.opt.ueditor_id).execCommand('insertHtml', '<img src="'+value+'"/>');
										 }else{
											 var obj=document.getElementById(t.opt.ueditor_id); 
											 if(obj){
											    InputInsertHtml(obj,'<img src="'+value+'"/>');
											 }
										 }
								 }
								 if(typeof(t.opt.weizhi_id)!="undefined" && myitem.parentNode.id!=t.opt.weizhi_id){
									   myitem.appendChild(rel_insert);
								 }
								}
								


								var success_opt=t.opt.success_show;
								//rel_del.type="button";
								if((typeof(t.opt.ischongxuan)!="undefined")||(typeof(success_opt)!="undefined"&&String(success_opt.chongxuan)!="undefined")&&success_opt.chongxuan==1){
									  rel_chongxuan=document.createElement("div");
									  rel_chongxuan.className="rel_chongxuan";
									  rel_chongxuan.innerHTML='重新选择<span style="display:block;height:1px;width:1px;overflow:hidden;"><input type="file" id="'+myitem.id+'_file" /></span>';
									  rel_chongxuan.style.display="none";
									  rel_chongxuan.setAttribute("itemid",myitem.id);
									  rel_chongxuan.onclick=function(event){
										   t.selectonefile({itemid:this.getAttribute("itemid")});
										   event.stopPropagation();
									  }
									  
								}

								if(!t.opt.item_class){
									rel_see.style.cssText="border:0px;position:absolute;width:auto;min-width:20px;font-size:12px;cursor:pointer; margin:0px; top:1px; text-align:center;left:1px;overflow:hidden;background-color:"+conf.bt.bgcolor+";color:"+conf.color+";z-index:"+zindex1;
									rel_see.style.display="none";
									rel_see.style.lineHeight=18+"px";
									rel_see.style.height=20+"px";
			
								}
								if(!t.opt.item_class){
									rel_del.style.cssText="border:0px;position:absolute;width:auto;min-width:20px;cursor:pointer; margin:0px; top:1px; text-align:center;right:1px;overflow:hidden;background-color:"+conf.bt.bgcolor+";color:"+conf.color+";z-index:"+zindex1;
									rel_del.style.display="none";
									rel_del.style.lineHeight=18+"px";
									rel_del.style.height=20+"px";
			
								}
                				var rel_fengmian=null;
								if(t.isfengmian==1){
									rel_fengmian=document.createElement("a");
									rel_fengmian.className="rel_fengmian";
									if(!t.opt.item_class){
									rel_fengmian.style.cssText="display:none;position:absolute;cursor:pointer;font-weight:bold; top:1px;padding:0px;border:0px;left:1px;overflow:hidden;text-align:center;margin:0px;filter:alpha(opacity=70);opacity:0.7;-webkit-opacity:0.7; -moz-opacity:0.7;";
									rel_fengmian.style.lineHeight=20+"px";
									rel_fengmian.style.height=20+"px";
									rel_fengmian.style.width=20+"px";
									rel_fengmian.style.display="none";
									rel_fengmian.className="rel_fengmian";
									
									rel_fengmian.style.color=conf.fengmian.color;
									rel_fengmian.style.backgroundColor=conf.fengmian.bgcolor;
									zindex1++;
									rel_fengmian.style.zIndex=(zindex1+100);
									}
									if(typeof(t.opt.wenzi)!="undefined" && typeof(t.opt.wenzi.fengmian)!="undefined"){
									    rel_fengmian.innerHTML=t.opt.wenzi.fengmian;
									}else{
										rel_fengmian.innerHTML="√";
									}

									rel_fengmian.onclick=function(){
										    var myitem=t.GetParentItem(this);
										    var items=myitem.parentNode.childNodes;
											var obj=this;
											var small_src=obj.parentNode.getAttribute("small_src");
											if(t.input_fengmian){
												t.input_fengmian.value=small_src;
											}
											for(var j=0;j<items.length;j++){
												var fengmian=t.GetObjByClass(items[j],"rel_fengmian");
												if(items[j].id!=obj.parentNode.id){
													 if(!t.opt.item_class){
														 items[j].style.borderColor=conf.rel.bordercolor;
														 fengmian.style.color=conf.fengmian.color;
														 fengmian.style.backgroundColor=conf.fengmian.bgcolor;
													 }else{
														t.removeClass(items[j],t.itemhoverclass);
														fengmian.className="rel_fengmian";
													 }
													 
												}else{
													
													 if(!t.opt.item_class){
													   items[j].style.borderColor=conf.rel.bordercolor1;
													   fengmian.style.color=conf.fengmian.color1;
													   fengmian.style.backgroundColor=conf.fengmian.bgcolor1;
													 }else{
														fengmian.className="rel_fengmian fengmian_hover"; 
														t.addClass(myitem,t.itemhoverclass);
													 }
		
												}
											}

										
											//SPAN INPUT undefined P DIV SPAN
									};
	
								}
								if(typeof(opt.type)!="undefined"&&opt.type=="bt"){//如果是上传按钮
								    myitem.appendChild(rel_bg);
									myitem.appendChild(rel_img);
									myitem.appendChild(rel_name)
									myitem.appendChild(rel_size);
									myitem.appendChild(rel_date);
									myitem.appendChild(rel_baifenbi);
									myitem.appendChild(rel_see);
									
									if(rel_chongxuan){myitem.appendChild(rel_chongxuan);}
									myitem.appendChild(rel_del); 
									rel_size.style.display="none";
									rel_name.style.display="none";
									rel_date.style.display="none";
									rel_del.style.display="none";
									rel_bar.style.display="none";
									rel_baifenbi.style.display="none";
								
								}else{
									if(t.itemstyle=="1"){
										var lineinfo=document.createElement("div");
										lineinfo.className="lineinfo";
										lineinfo.appendChild(rel_bg);
										lineinfo.appendChild(rel_img);
										lineinfo.appendChild(rel_name)
										lineinfo.appendChild(rel_size);
										lineinfo.appendChild(rel_date);
										lineinfo.appendChild(rel_baifenbi);
										lineinfo.appendChild(rel_del);
										lineinfo.appendChild(rel_see);
										lineinfo.appendChild(rel_chongchuan);
										if(rel_chongxuan){lineinfo.appendChild(rel_chongxuan);}
										myitem.appendChild(lineinfo);
										if(rel_fengmian){myitem.appendChild(rel_fengmian)};
									}else{	
										myitem.appendChild(rel_bg);
										myitem.appendChild(rel_img);
										myitem.appendChild(rel_name)
										myitem.appendChild(rel_size);
										myitem.appendChild(rel_date);
										myitem.appendChild(rel_baifenbi);
										myitem.appendChild(rel_see);
										myitem.appendChild(rel_chongchuan);
										if(rel_chongxuan){myitem.appendChild(rel_chongxuan);}
										myitem.appendChild(rel_del); 
										if(rel_fengmian){myitem.appendChild(rel_fengmian)};
									}

								}
								if(!t.opt.item_class){
									  var line_height=myitem.offsetHeight;
									  //alert(line_height);
                                      rel_bar.style.lineHeight=line_height+"px";
								      //rel_baifenbi.style.lineHeight=line_height+"px";
								}


	
								if(typeof(opt.type)!="undefined"&&opt.type=="bt"){
									 //

								}else{

									if(typeof(t.isshowdate)!="undefined"&&String(t.isshowdate)!=""){
										 if(t.isshowdate==0){rel_date.style.display="none";}
										 if(t.isshowdate==1){rel_date.style.display=""; }
									}
									if(typeof(t.isshowsize)!="undefined"&&String(t.isshowsize)!=""){
										 if(t.isshowsize==0){rel_size.style.display="none";}
										 if(t.isshowsize==1){rel_size.style.display=""; }
										 if(t.isshowsize==-1){rel_size.innerHTML="("+rel_size.innerHTML+")";rel_size.style.display=""; }
									}
	
									if(typeof(t.isshowname)!="undefined"&&String(t.isshowname)!=""){
										 if(t.isshowname==0){rel_name.style.display="none";}
										 if(t.isshowname==1){rel_name.style.display=""; }
									}
									if(typeof(t.isshowbar)!="undefined"&&String(t.isshowbar)!=""){
										 if(t.isshowbar==0){rel_bar.style.display="none";}
										 if(t.isshowbar==1){rel_bar.style.display=""; }
									}
									if(typeof(t.isshowbaifenbi)!="undefined"&&String(t.isshowbaifenbi)!=""){
										 if(t.isshowbaifenbi==0){rel_baifenbi.style.display="none";}
										 if(t.isshowbaifenbi==1){rel_baifenbi.style.display=""; }
									}
									if(typeof(t.isshowdel)!="undefined"&&String(t.isshowdel)!=""){
										 if(t.isshowdel==0){rel_del.style.display="none";}
										 if(t.isshowdel==1){rel_del.style.display=""; }
									}

									if(!opt.file){
										rel_bar.style.display="none";
										 if(t.opt.success_show){
											if(typeof(t.opt.success_show.del)!="undefined"&&String(t.opt.success_show.del)!=""){
												 if(t.opt.success_show.del==0){rel_del.style.display="none";}
												 if(t.opt.success_show.del==1){rel_del.style.display=""; }
											}
										 }
									}else{
										
									}
									if(t.isfengmian==1&&rel_fengmian&&!opt.file){
										rel_fengmian.style.display="";
									}
								}

								if(rel_del){
									 rel_del.setAttribute("itemid",myitem.id);
								 	 rel_del.onclick=function(event){//删除
									         event.stopPropagation();
											 t.Del(this);
									 }
								}
							  if(typeof(opt.src)!="undefined"){
								 myitem.setAttribute("small_src",opt.small_src);
								 myitem.setAttribute("big_src",opt.big_src);
								if(t.opt.success_show&&typeof(t.opt.success_show.see)!="undefined"&&String(t.opt.success_show.see)!=""){
									 if(rel_see){
									    if(t.opt.success_show.see==0){rel_see.style.display="none";}
									    if(t.opt.success_show.see==1){rel_see.style.display=""; }
									 }
								}
								 if(rel_fengmian){
									 rel_fengmian.style.display="";
									 if(t.input_fengmian&&t.input_fengmian.value!=""&&t.input_fengmian.value==opt.small_src){
													 if(!t.opt.item_class){
													   myitem.style.borderColor=conf.rel.bordercolor1;
													   rel_fengmian.style.color=conf.fengmian.color1;
													   rel_fengmian.style.backgroundColor=conf.fengmian.bgcolor1;
													 }else{
													    t.addClass(myitem,t.itemhoverclass);
														rel_fengmian.className="rel_fengmian fengmian_hover";  
													 }
									 }
								 }
								 
							 }
                             for(var i=0;i<myitem.childNodes.length;i++){
							     t.ObjStyle(myitem.childNodes[i]);
							 }
							 return myitem;
				 }
		 },ObjStyle:function(obj){
		  var classname=obj.className,t=this;
		  var arr=classname.split("_");
		  if(arr.length>1){
			  var key= arr[1];

			  if(typeof(t.opt.btstyle)!="undefined"){
				 if(typeof(t.opt.btstyle[key])!="undefined"){
					   var json=t.opt.btstyle[key];obj.style.top="auto";obj.style.left="auto";obj.style.bottom="auto"; obj.style.bottom="auto";
					   for(var k in json){
						   if(k=="class"){
							  t.addClass(obj,json[k]);
						   }else{
						      obj.style[k]=json[k];
						   }
					   }
				 }
			  }
		  }
		 },NewItem20170116:function(opt){
          var t=this;
			     var t=this;
				 var src="";
				 if(typeof(opt.src)=="undefined"){
					 //src=g_moren_bgsrc;
				 }else{
					 src=opt.src;
				 }
				 opt.tmpid=t.RndNum(7);
				 var zindex1=1009;
				 var filename,filesize,filesize_caption="",oldfilename;
				 var ext="";
				 if(opt.file){
						var file=opt.file;
						var title=file.name;
						var filetype=file.type;
						 filename=file.name;
						 filesize=file.size;
						var arr=filename.split(".");
						var file_ext=arr[arr.length-1];
						file_ext=file_ext.toLowerCase();
						oldfilename=file.name.substring(0,file.name.length-file_ext.length-1);
						ext=t.FileExt({filename:filename,contenttype:filetype});
						src=(t.GetShowImg(ext));
						filesize_caption=t.FormatSize(filesize);
				 }else{
					 if(typeof(opt.small_src)!="undefined"){
					 var arr=opt.small_src.split("/"),name1=arr[arr.length-1];
					 filename=name1;
					 }
				 }
				 var parent=t.panel;
				 if(opt.parent){
					parent=opt.parent;
				 }

			     if(parent){
					            var arr1=t.opt.item_html.split(" "),shuxing={};
								for(var i=0;i<arr1.length;i++){
									  var arr2=arr1[i].split("=");
									  if(arr2.length==2){
										  shuxing[arr2[0]]=arr2[1];
									  }
								}

								 var myitem=null;

                                if(t.opt.item_html.indexOf("<td")==0){
						
									 var table = document.createElement("table");//创建table 
									 var row = table.insertRow();//创建一行 
									 row.innerHTML=t.opt.item_html;
									 myitem=row.cells[0].cloneNode(true);
								}else{
									t.tmpitem=document.createElement("div");
									t.tmpitem.style.display="none";
									t.tmpitem.id="tmpitem";
									t.tmpitem.innerHTML=t.opt.item_html;
									parent.appendChild(t.tmpitem);
									myitem=t.tmpitem.childNodes[0].cloneNode(true);
					
								//alert(myitem.innerHTML);
									t.tmpitem.parentNode.removeChild(t.tmpitem);
								}

								myitem.id=t.input_id+"_item_"+opt.tmpid;
								myitem.setAttribute("tmpid",opt.tmpid);
								myitem.setAttribute("myparent","hcitem");
								if(typeof(t.opt.inserttype)=="undefined"){
									parent.appendChild(myitem);
								}else{
								  if(parent.childNodes.length==0){
									  parent.appendChild(myitem);
								  }else if(t.opt.inserttype=="defore"){
								      parent.insertBefore(myitem,parent.childNodes[0]);
								  }
								}
								
                                t.EditInputName();

							  var rel_baifenbi=t.GetObjByClass(myitem,"rel_baifenbi");
							  var rel_bar=t.GetObjByClass(myitem,"rel_bar");
							  var rel_img=t.GetObjByClass(myitem,"rel_img");
							  var rel_del=t.GetObjByClass(myitem,"rel_del");
							  var rel_fengmian=t.GetObjByClass(myitem,"rel_fengmian");
							  var rel_size=t.GetObjByClass(myitem,"rel_size");
							  var rel_date=t.GetObjByClass(myitem,"rel_date");
							  var rel_chongxuan=t.GetObjByClass(myitem,"rel_chongxuan");
							  var rel_bg=t.GetObjByClass(myitem,"rel_bg");
							  var rel_see=t.GetObjByClass(myitem,"rel_see");
							  var rel_name=t.GetObjByClass(myitem,"rel_name");
							  var rel_chongchuan=t.GetObjByClass(myitem,"rel_chongchuan");
                              var input_title=t.GetObjByAttr(myitem,"myname","title");
							  var isinit=false;
							   if(typeof(opt.row)!="undefined"&&opt.row){
								     isinit=true;
									  for (key in opt.row){
										    var obj=t.GetObjByAttr(myitem,"myname",key); 
											if(obj){
												if(obj.tagName=="SELECT"){
													for(var i=0;i<obj.options.length;i++){
														 if(obj.options[i].value==opt.row[key]){
															  obj.selectedIndex=i;
															 break;
														 }
													}
												}
												if(obj.tagName=="INPUT"){obj.value=opt.row[key];}
											}
									  }
	
								}else{
							          if(input_title){input_title.value=oldfilename};
								}
							   
								if(rel_img){rel_img.innerHTML="<img src='"+src+"'/>";}
								if(rel_size){rel_size.innerHTML=filesize_caption;}
								if(rel_name){
								if(typeof(opt.row)!="undefined"&&typeof(opt.row.title)!="undefined"){
									   rel_name.innerHTML=opt.row.title;
								}else{
								       rel_name.innerHTML=filename;
								}
								}
			
								
								if(rel_see){
									rel_see.onclick=function(event){
										 var parent=this.parentNode;
										 if(parent.id.indexOf(t.input_id+"_item")==-1){
										  parent=parent.parentNode;
										 }
										 var small_src=parent.getAttribute("small_src");
										 var big_src1=parent.getAttribute("big_src");
										 if(typeof(big_src1)!="undefined"){
											window.open(t.siteurl_file+big_src1);
										 }
										 event.stopPropagation();
									}
								}
								var success_opt=t.opt.success_show;
								//rel_del.type="button";
								if(rel_chongxuan){
									  rel_chongxuan.innerHTML+='<span style="display:block;height:1px;width:1px;overflow:hidden;"><input type="file" id="'+myitem.id+'_file" /></span>';
									  if(!isinit){
									     rel_chongxuan.style.display="none";
										 if(rel_baifenbi){rel_baifenbi.style.display="none";}
									  }
									  rel_chongxuan.setAttribute("itemid",myitem.id);
									  rel_chongxuan.onclick=function(event){
										   t.selectonefile({itemid:this.getAttribute("itemid")});
										   event.stopPropagation();
									  }
								}
									
								if(rel_chongchuan){
								  rel_chongchuan.className="rel_chongchuan";
								  rel_chongchuan.setAttribute("itemid",myitem.id);
								  rel_chongchuan.style.display="none";
								  rel_chongchuan.onclick=function(event){
									  event.stopPropagation();
									t.chongchuanfile({itemid:this.getAttribute("itemid")}); 
								  }
								}
								if(rel_fengmian){
									rel_fengmian.onclick=function(){
										    var myitem=t.GetParentItem(this);
										    var items=myitem.parentNode.childNodes;
											var obj=this;
											var small_src=obj.parentNode.getAttribute("small_src");
											if(t.input_fengmian){
												t.input_fengmian.value=small_src;
											}
											for(var j=0;j<items.length;j++){
												var fengmian=t.GetObjByClass(items[j],"rel_fengmian");
												if(items[j].id!=obj.parentNode.id){
													 if(!t.opt.item_class){
														 items[j].style.borderColor=conf.rel.bordercolor;
														 fengmian.style.color=conf.fengmian.color;
														 fengmian.style.backgroundColor=conf.fengmian.bgcolor;
													 }else{
														t.removeClass(items[j],t.itemhoverclass);
														fengmian.className="rel_fengmian";
													 }
													 
												}else{
													
													 if(!t.opt.item_class){
													   items[j].style.borderColor=conf.rel.bordercolor1;
													   fengmian.style.color=conf.fengmian.color1;
													   fengmian.style.backgroundColor=conf.fengmian.bgcolor1;
													 }else{
														fengmian.className="rel_fengmian fengmian_hover"; 
														t.addClass(myitem,t.itemhoverclass);
													 }
		
												}
											}
											
									};
									
								}
								var show_c=t.opt.init_show;
								if(opt.file){
									show_c=t.opt.upload_show;
								}
								if(typeof(show_c)!="undefined"){
									 var c=show_c;
									if(typeof(c.date)!="undefined"&&String(c.date)!=""&&rel_date){
										if(c.date==1){rel_date.style.display=""; }else{rel_date.style.display="none";}
									}else{
										if(rel_date)rel_date.style.display="none";
									}
									if(typeof(c.size)!="undefined"&&String(t.size)!=""&&rel_size){
										 if(c.size==0){rel_size.style.display="none";}
										 if(c.size==1){rel_size.style.display=""; }
										 if(c.size==-1){rel_size.innerHTML="("+rel_size.innerHTML+")";rel_size.style.display=""; }
									}else{
										if(rel_size)rel_size.style.display="none";
									}
									if(typeof(c.name)!="undefined"&&String(c.name)!=""&&rel_name){
										if(c.name==1){rel_name.style.display=""; }else{rel_name.style.display="none";}
									}else{
										if(rel_name)rel_name.style.display="none";
									}
									if(typeof(c.bar)!="undefined"&&String(c.bar)!=""&&rel_bar){
										if(c.bar==1){rel_bar.style.display=""; }else{rel_bar.style.display="none";}
									}else{
										if(rel_bar){rel_bar.style.display="none";}
									}
									
									if(typeof(c.chongxuan)!="undefined"&&String(c.chongxuan)!=""&&rel_chongxuan){
										if(c.chongxuan==1){rel_chongxuan.style.display=""; }else{rel_chongxuan.style.display="none";}
									}else{
										if(rel_chongxuan){rel_chongxuan.style.display="none";}
									}

									if(typeof(c.baifenbi)!="undefined"&&String(c.baifenbi)!=""&&rel_baifenbi){
										if(c.baifenbi==1){rel_baifenbi.style.display=""; }else{rel_baifenbi.style.display="none";}
									}else{
										if(rel_baifenbi){rel_baifenbi.style.display="none";}
									}
									if(typeof(c.del)!="undefined"&&String(c.del)!=""&&rel_del){
										if(c.del==1){rel_del.style.display=""; }else{rel_del.style.display="none";}
									}else{
										if(rel_del){rel_del.style.display="none";}
									}
									if(typeof(c.see)!="undefined"&&String(c.see)!=""&&rel_see){
										if(c.see==1){rel_see.style.display=""; }else{rel_see.style.display="none";}
									}else{
										if(rel_see){rel_see.style.display="none";}
									}
									if(typeof(c.bg)!="undefined"&&String(c.bg)!=""&&rel_bg){
										if(c.bg==1){rel_bg.style.display=""; }else{rel_bg.style.display="none";}
									}else{
										if(rel_bg){rel_bg.style.display="none";}
									}
									if(t.isfengmian==1&&rel_fengmian&&!opt.file&&rel_fengmian){
										rel_fengmian.style.display="";
									}
								}
								if(opt.file&&rel_date){
									 rel_date.innerHTML="待上传";
								}
								if(rel_del){
									 rel_del.setAttribute("itemid",myitem.id);
								 	 rel_del.onclick=function(event){//删除
											 t.Del(this);
											 event.stopPropagation();
									 }
								}
							  if(typeof(opt.src)!="undefined"){
								 myitem.setAttribute("small_src",opt.small_src);
								 myitem.setAttribute("big_src",opt.big_src);
								if(t.opt.success_show&&typeof(t.opt.success_show.see)!="undefined"&&String(t.opt.success_show.see)!=""){
									 if(rel_see){
									    if(t.opt.success_show.see==0){rel_see.style.display="none";}
									    if(t.opt.success_show.see==1){rel_see.style.display=""; }
									 }
								}							 
							 }
							 
							 
							 return myitem;
				 }
		 },EditInputName:function(){
			 var t=this;
			 var items=t.panel.childNodes;
			 var index=0;
			 for(var j=0;j<items.length;j++){
				 if(typeof(items[j].id)!="undefined"&&items[j].id.indexOf("_item_")!=-1){
					 index++;
					  var inputs=items[j].getElementsByTagName("*");
					 for(var i=0;i<inputs.length;i++){
						  if(typeof(inputs[i].getAttribute("myname"))!="undefined"){
							   inputs[i].name=inputs[i].getAttribute("myname")+"_"+index;
						  }
					 }
				 }
			 }
			t.ShowItemNum(index);
		 },GetParentItem:function(obj){ //获得当前项
			var parent=obj;
			while(parent){
				var myparent=parent.getAttribute("myparent");
				if(typeof(myparent)!="undefined"&&myparent=="hcitem"){
					return parent;
				}
				parent=parent.parentNode;
			}
			return null;
		 },addClass:function(obj,cla){ //添加类
            if(obj.className!=null&&typeof(obj.className)!="undefined"){
				var oldclass=obj.className,arr=oldclass.split(" "),newcla='';
				for(var i=0;i<arr.length;i++){
					 if(arr[i]!=cla){if(newcla!=""){ newcla+=" "+arr[i]; }else{newcla=arr[i];}}
				}
				newcla+=" "+cla;obj.className=newcla;
			}else{
				obj.className=cla;
			}
		 },removeClass:function(obj,cla){ //移除类
            if(obj.className!=null&&typeof(obj.className)!="undefined"){
				var oldclass=obj.className,arr=oldclass.split(" "),newcla='';
				for(var i=0;i<arr.length;i++){
					 if(arr[i]!=cla){ if(newcla!=""){newcla+=" "+arr[i];}else{newcla=arr[i];}}
				}
				obj.className=newcla;
			}
		 },ShowItemNum:function(n){
			 var t=this;
			if(typeof(t.opt.item_num_id)!="undefined"){
				var item_num=document.getElementById(t.opt.item_num_id);
				if(item_num&&typeof(item_num.value)!="undefined"){item_num.value=n;}
				if(item_num&&typeof(item_num.innerHTML)!="undefined"){item_num.innerHTML=n;}
			}
		 },Del:function(obj){
			 var t=this;
			 var itemid=obj.getAttribute("itemid"),parent=document.getElementById(itemid),small_src=parent.getAttribute("small_src"),big_src=parent.getAttribute("big_src");
			  parent.parentNode.removeChild(parent);
			 var arr=itemid.split("_"),tmpid=arr[arr.length-1],n=0;
			 if(t.input){
					  var arr=t.input.value.split(t.fenge);
					  var newvalue="";
					  for(var i=0;i<arr.length;i++){
						   if(arr[i].indexOf(small_src)==-1){
								 if(newvalue!=""){newvalue+=t.fenge+arr[i];}else{ newvalue=arr[i];}
								 n++;
						   }
					  }
					  if( t.input){
					     t.input.value=newvalue;
					  }
					  if(t.input_fengmian&&t.input_fengmian.value==small_src){
						  t.input_fengmian.value="";
					  }
			 }
            t.ShowItemNum(n);
			 if(t.itemstyle=="1"){
				 t.item.style.display="";
				 if(t.panel){t.panel.style.display="none";}
			 }
			 if(t.opt.maxnum==1){
				  t.item.style.display="";
				  if( t.input)t.input.value="";
			 }
		   var  files=[];
		   var ishave=0;
			for(key in t.files){
				 if(key!=parent.id){
					files[key] =t.files[key];
				 }else{
					  ishave=1;
				 }
			}
			  if(t.num>0&&ishave==0){
			  t.num--;
			  }
		
			t.files=files;
			t.ShowSelectFileCount();
			t.ShowSuccessFileCount();

				if(typeof(small_src)!="undefined"&&small_src){
					t.ajax({
					url: t.opt.url+"?act=del",
					type: "POST",
					data: {path:small_src,tmpid:tmpid,isdelfile:t.isdelfile},
					async: true,        //异步
					success: function(result){
						 
					}});
				}

				if(typeof(t.opt.success)!="undefined"){
					  t.opt.success({maxnum:t.opt.maxnum,num:t.num});
				}
				t.ShowNull();
				if(typeof(t.opt.ueditor_id)!="undefined"&&UE&&UE.getEditor(t.opt.ueditor_id)){
						var div=document.createElement("div");
						
                        div.innerHTML=UE.getEditor(t.opt.ueditor_id).getContent();
						//alert( div.innerHTML);
						//alert(t.siteurl_file+big_src);
						var imgs=div.getElementsByTagName("img");
						for(var i=0;i<imgs.length;i++){
							 var img=imgs[i];
							if(img.src==(t.siteurl_file+big_src)){
							var child=img;
							  child.parentNode.removeChild(child);
							}
						}
						UE.getEditor(t.opt.ueditor_id).setContent(div.innerHTML);
						

				}
				
		 },Alert:function(str){
			 alert(str);
		},ShowNull:function(){
			var t=this,n=0;
			for(key in t.files){
				n++;
			}
		    if(typeof(t.opt.nullstr)!="undefined"){
				if(t.num==0&&t.panel&&n==0) {
					 //var items=t.panel.childNodes;
					 if(t.panel.tagName=="TR"){
							var cell = t.panel.insertCell();//创建一个单元 
							cell.style.width=t.panel.parentNode.parentNode.parentNode.offsetWidth+"px";
							cell.innerHTML=t.opt.nullstr;
					 }else{
						   t.panel.innerHTML=t.opt.nullstr;
					 }
					
				}
			}
		},GetShowImg:function(ext){
						var v="",t=this;
						for(var i=0;i<g_exts.length;i++){
							if(g_exts[i].ext==ext){
								v=t.ico_path+g_exts[i].src;
								break;
							}
		                }
						return v;
		},ProgressBar:function(myitem,numz,num_success){//进度条
			var t=this;
			if(myitem){
					  var rel_bar=t.GetObjByClass(myitem,"rel_bar");
					  var rel_img=t.GetObjByClass(myitem,"rel_img");
					  var rel_del=t.GetObjByClass(myitem,"rel_del");
					  var rel_fengmian=t.GetObjByClass(myitem,"rel_fengmian");
				if(g_isshowbar==1){
					  if(rel_img){
						 // rel_img.style.display="none";
					  }
					var h=t.opt.height;
					if(typeof(rel_bar)!="undefined"){
						 //console.log("numz:"+numz+",num_success:"+num_success);
						if(numz!=num_success){
							var bf=num_success/numz*100;
							rel_bar.innerHTML=bf.toFixed(2)+"%";
						}else{
					        if(rel_del){rel_del.style.display="";}
							 if(rel_fengmian){rel_fengmian.style.display="";}
							rel_bar.innerHTML="100%";
							window.setTimeout(function(){rel_bar.style.display="none";},300);
						}
					}
				}else{
					 
						if(numz==num_success){
							 if(rel_fengmian){rel_fengmian.style.display="";}
					        if(rel_del){rel_del.style.display="";}
							if(rel_bar){rel_bar.style.display="none";}
						} 
				}
		   }
		},GetItemObj:function(id){
				if(id!="item2"){
				    return window.parent.document.getElementById(id);
				}else{
					return window.document.getElementById(id);
				}
 
         },IsImg:function(ext){
		          ext=ext.toLowerCase();
				  if(ext=="jpg"||ext=="jpeg"||ext=="gif"||ext=="png"||ext=="bmp"){
					   return true;
				  }else{
					   return false; 
				  }
		 },RndNum:function(n){
					var rnd="";
					for(var i=0;i<n;i++){
					   rnd+=Math.floor(Math.random()*10);
					}
					return rnd;
		 },ajax:function(opt){
			 
			            var t=this,addstr="";
						var convertData=function(data){ 
							  if( typeof(data) === 'object' ){ 
								var convertResult = "" ;  
								for(var c in data){  
								  convertResult+= c + "=" + data[c] + "&";  
								}  
								convertResult=convertResult.substring(0,convertResult.length-1) 
								return convertResult; 
							  }else{ 
								return data; 
							  } 
					    }
						
						var typ=String(typeof(opt.data)).toLowerCase();
						 if(typeof(opt.async)=="undefined"){opt.async=true;}
						 if(typ!="undefined"){
							 if(typ=="string"){addstr=opt.data;}
							 if(typ=="array"||typ=="object"){
								 if(typeof(opt.processData)!="undefined"&&opt.processData==false){
									    addstr=opt.data;
								 }else{
								  for(var key in opt.data){
									    if(key!="undefined"&&typeof(key)!="undefined"){
									   if(addstr!=""){ addstr+="&"+key+"="+opt.data[key];}else{addstr+=key+"="+opt.data[key];}
										}
								  }
								 }
								  
							}
						 }
						 
						 var xhr=null;
						 //创建ajax对象
						 if(window.XMLHttpRequest){  
						 xhr=new XMLHttpRequest() ; 
						 }else if(window.ActiveXObject){  
						 /*不能写成axtivexobject否则会出错*/
						 xhr=new ActiveXObject("Microsoft.XMLHTTP");
						 } 
						 opt.type=opt.type.toUpperCase(); //转为大写
						 if(opt.type=="GET"){
							 xhr.open(opt.type,opt.url+"?"+addstr,opt.async);
						 }else{
							 xhr.open(opt.type,opt.url,opt.async);
						 } 
						 xhr.onreadystatechange=function(){
							  if(xhr.readyState==4){
								  var str1=xhr.responseText.replace(/[\r\n]/g, "");
								 // alert(str1);
								   if (xhr.status == 200) {//200代表执行成功
									  if(opt.func){
										 opt.func(str1);//运行回调函数
									  }
									  //运行回调函数
									  if(opt.success){opt.success(str1);}
								   }else{
								
									  if(opt.error){
										 opt.error(str1);//运行回调函数
									   }
									  if(typeof(opt.isxunhuan)!="undefined"&&opt.isxunhuan==1){
										 t.ajax(opt); 
									  }
								   }
				
							  }

						 };
	
						 if(typeof(opt.contentType)!="undefined"){
							 if(opt.contentType==true){
								    xhr.setRequestHeader('Content-Type', opt.contentType);  
							 }
						 }else{
						            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded'); 
						 }
						 if(opt.type=="GET"){ 
						    xhr.send("");
						 } else{//这个是POST方式的
							 if(typ=="array"||typ=="object"){
						         xhr.send(addstr);
							 }
						 } 
       },GetExtSrc:function(exts,ext){
					var v="",t=this;
					for(var i=0;i<exts.length;i++){
						if(exts[i].ext==ext){
						 v=t.ico_path+exts[i].src;
						}
					}
					return v;
	   },css:function(obj,opt){
		   if(obj){ for(var k in opt){obj.style[k]=opt[k]; }}
       },create:function(opt){
			 var obj=document.createElement(opt.tagName); 
			 if(typeof(opt.className)!="undefined"){obj.className=opt.className;}
			 if(typeof(opt.type)!="undefined"){obj.type=opt.type; }
			 if(typeof(opt.cssText)!="undefined"){obj.style.cssText=opt.cssText;}
			 if(typeof(opt.id)!="undefined"){ obj.id=opt.id;}
			 if(typeof(opt.html)!="undefined"){obj.innerHTML=opt.html;}
			 if(typeof(opt.value)!="undefined"){ obj.value=opt.value;}
			 if(typeof(opt.style)!="undefined"){
			   for(var key in opt.style){obj.style[key]=opt.style[key];}
			 }
			 return obj;
	   }
	   
   }
  return hcfile_;
}