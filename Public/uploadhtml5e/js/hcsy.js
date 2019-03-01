function hcsy(){
var hcsy_={
  init:function(opt){
	var t=this;
	t.opt=opt;
    t.opt.isfugai=0;
	if(typeof(opt.isfugai)!="undefined"&&String(opt.isfugai)==""){
				  t.opt.isfugai=opt.isfugai;
	}
	if(typeof(opt.shuiyintxt)=="undefined"){
				  t.opt.shuiyintxt="";
	}
	if(typeof(opt.x)=="undefined"||String(opt.x)==""){
				  t.opt.x=10;
	}
	if(typeof(opt.y)=="undefined"||String(opt.y)==""){
				  t.opt.y=50;
	}
	if(typeof(opt.fontsize)=="undefined"||String(opt.fontsize)==""){
				  t.opt.fontsize=40;
	}
	//img.crossOrigin = "*";
	var input=null;
	if(typeof(opt.inputid)!="undefined"){
	 input=document.getElementById(opt.inputid);
	}
	var srcs="";

	   if(typeof(opt.src)!="undefined"){
	    srcs=opt.src;
	   }else{
		   	if(input){
  	           srcs=input.value;
			}
	  }
	  if(srcs==""){
	    t.Alert("没有图片");
	    return false;
	  }
	if(typeof(opt.zifu_num)=="undefined"||String(opt.zifu_num)==""){
				  t.opt.zifu_num=1024*1024;
	}
	$("#"+t.opt.inputid_new+"_div").html("");
    
	var arr=srcs.split(opt.ge);
	t.num=0;
	t.success_num=0;
	$("#"+t.opt.inputid_new).val("");

	for(var i=0;i<arr.length;i++){
	   var src=arr[i];
	   if(src!=""){
	     t.num++;
	       t.start({src:src,shuiyintxt:t.opt.shuiyintxt,isfugai:t.opt.isfugai,x:t.opt.x,y:t.opt.y,weizhi:"xy"});
	   }
	}
	if(t.opt.bt){
		t.btcaption_old=t.opt.bt.val();
		t.opt.bt.val("正在处理");
	}
 },start:function(opt){
	 var t=this;
	var img=new Image();
	img.src=t.opt.rootqz+opt.src;
	var arr=img.src.split("/");
	var t=this;

	var filename=arr[arr.length-1];
    var  arr=img.src.split(".");
    var  ext=arr[arr.length-1];
	img.onload=function(){
				var w=img.width;
				var h=img.height;
				var bilv=w/h;
				//alert(bilv)
				var  canvas = document.createElement("canvas");   
				var ctx = canvas.getContext('2d');  
				canvas.width=this.width;
				canvas.height=this.height;
	

				ctx.drawImage(this,0,0,canvas.width,canvas.height);
				//var imgData =canvas.toDataURL("image/png");
				//this_base64=canvas.toDataURL("image/jpeg");
                //var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
	            ctx.font=t.opt.fontsize+"px 微软雅黑";
	            ctx.fillText(opt.shuiyintxt,opt.x,opt.y+t.opt.fontsize);//坐标点
				this_base64=canvas.toDataURL("image/png",0.8);
				//alert(this_base64);

				var oMyForm = new FormData();
				var oBlob=t.convertBase64UrlToBlob(this_base64);
				//console.log(oBlob);
				//oMyForm.append("webmasterfile", oBlob);
				 file=oBlob;
				 file.name=filename;
				 if(t.opt.url.indexOf(".asp")!=-1){
				      t.saveshuiyin({file:file,ext:ext,path:opt.src,isfugai:opt.isfugai}); 
				 }else{
					  t.saveshuiyin_base64({file:file,ext:ext,path:opt.src,isfugai:opt.isfugai}); 
				 }
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
//    var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
//        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
//    while(n--){
//        u8arr[n] = bstr.charCodeAt(n);
//    }
//    return new Blob([u8arr], {type:mime});

  },saveshuiyin:function(opt){
			            var t=this;
			            var file=opt.file;
						var reader=new FileReader();
						var stop_old = 0;
						var start = 0;
						var stop = 0;
					    var cur_size=0;
						var ext=opt.ext;
						var tmpid=t.RndNum(6);//id标识
						var ajax_url=t.opt.url;
						var title=file.name;//文件名
						var cur_size=0;
						var name = file.name;       //文件名
						size = file.size;       //总大小
						shardSize = t.opt.zifu_num;//分片长度
						var arr=title.split(".");
						title=arr[0];
						shardCount = Math.ceil(size / shardSize);  //总片数
						var sendPost=function(op){
									if(op.i >= shardCount){
										//alert(shardCount);
										return;
									}

									//计算每一片的起始与结束位置
									var start = op.i * shardSize,
									end = Math.min(size, start + shardSize);
									//构造一个表单，FormData是HTML5新增的
									var form = new FormData();
									form.append("data", file.slice(start,end));  //slice方法用于切出文件的一部分
									form.append("lastModified", file.lastModified);  //slice方法用于切出文件的一部分
									form.append("title", title);
									form.append("ext", ext);
									form.append("tmpid", tmpid);
									form.append("total", shardCount);  //总片数
									form.append("index", op.i + 1);        //当前是第几片
									form.append("path", opt.path);
									form.append("isfugai",opt.isfugai);
									if(typeof(t.opt.formdata)!="undefined"&&String(t.opt.formdata)!=""&&typeof(t.opt.formdata)=="object"){
										 for(var key in t.opt.formdata){
											   form.append(key,t.opt.formdata[key]);  
										 }
									}
									cur_size+=shardSize;
									 //Ajax提交
									$.ajax({
										url: ajax_url,
										type: "POST",
										data: form,
										async: true,        //异步
										processData: false,  //很重要，告诉jquery不要对form进行处理
										contentType: false,  //很重要，指定为false才能形成正确的Content-Type
										success: function(result){
												 var i=op.i+1;
												 //console.log(result);
												if (result.indexOf("dengdai") != -1) {
																	
													 sendPost({i:i});
												}else if (result.indexOf("success")!=-1) {
		                                             t.success_num++;
													if(t.opt.bt){t.opt.bt.val("正在处理("+t.success_num+"/"+t.num+")");}
                                                  var json1=eval("("+result+")");
													var src=t.opt.rootqz+json1.filepath+"?"+Math.random();
													
													var aimg=$("<a href='"+src+"' target='_blank'><img src='"+src+"'/></a>");
													$("#"+t.opt.inputid_new+"_div").append(aimg);
			
													 if(typeof(t.opt.inputid_new)!="undefined"){
													   var inputid_new=document.getElementById(t.opt.inputid_new);
													   if(inputid_new){
													    if(inputid_new.value!=""){
														   inputid_new.value+=t.opt.ge+json1.filepath;
														}else{
														   inputid_new.value=json1.filepath;
														}
													   }
													 }
													 if(t.success_num==t.num){
													    t.Alert("已全部处理");
													  
													  
													    if(t.opt.success){t.opt.success();}
													    if(t.opt.bt){t.opt.bt.val(t.btcaption_old);}
													 }

												}else if (result.indexOf("error")!=-1) {
													var json1=eval("("+result+")");
													
												} else {
													console.log("Error:\n" + result);
													alert("文件块上传失败，请重新上传文件!");
												}
										}
									});
						}
						sendPost({i:0});
		},saveshuiyin_base64:function(opt){
			            var t=this;
			            var file=opt.file;
						var reader=new FileReader();
						var shardSize = t.opt.zifu_num ; //每次上传几个字符串
						var stop_old = 0;
						var start = 0;
						var stop = 0;
					    var cur_size=0;
						var myitem=opt.myitem;
						var ext=opt.ext;
						var tmpid=t.RndNum(6);//id标识
						var ajax_url=t.opt.url;
						var title=file.name;//文件名
						var arr=title.split(".");
						title=arr[0];
						var uploadData = function (data, size, beg, end) {
							data=data.replace(/\+/g,"[jh]"); 
							//alert(data);
							var data1={};
							data1["act"]="up";
							data1["size"]=size;
							data1["data"]=data;
							data1["beg"]=beg;
							data1["end"]=end;
							data1["title"]=title;
							data1["ext"]=ext;
							data1["tmpid"]=tmpid;
							data1["isfugai"]=opt.isfugai;
							data1["path"]=opt.path;
						
							if(typeof(t.opt.formdata)!="undefined"&&String(t.opt.formdata)!=""&&typeof(t.opt.formdata)=="object"){
								 for(var key in t.opt.formdata){
									   data1[key]=t.opt.formdata[key];  
								 }
							}
					
							//console.log("json:\n" + data1);
							$.ajax({
								 url:ajax_url,
								 type:"POST",
								 data:data1,
								 async:true,
								 success:function(result){
									       // alert(result);
										   // console.log("json:\n" + result);
											 cur_size=stop_old;
											if (result.indexOf("dengdai") != -1) {
															stop_old = stop;
															var num_z=Math.round(file.size / shardSize * 100);
															var num_success=Math.round(stop_old / file.size * 100);
															
															if(stop_old>= file.size) {
																return;
															}
															stop = (stop_old + shardSize) > file.size ? (file.size) : (stop_old + shardSize);
															start = stop_old;
															readBob(start, stop);
											}else if (result.indexOf("success")!=-1) {
											     	var json1=eval("("+result+")");
		                                             t.success_num++;
													var src=t.opt.rootqz+json1.filepath+"?"+Math.random();
													if(t.opt.bt){t.opt.bt.val("正在处理("+t.success_num+"/"+t.num+")");}
													var aimg=$("<a href='"+src+"' target='_blank'><img src='"+src+"'/></a>");
													$("#"+t.opt.inputid_new+"_div").append(aimg);
													 
													 if(typeof(t.opt.inputid_new)!="undefined"){
													   var inputid_new=document.getElementById(t.opt.inputid_new);
													   if(inputid_new){
													    if(inputid_new.value!=""){
														   inputid_new.value+=t.opt.ge+json1.filepath;
														}else{
														   inputid_new.value=json1.filepath;
														}
													   }
													 }
													 if(t.success_num==t.num){
														if(t.opt.bt){t.opt.bt.val(t.btcaption_old);}
													    if(t.opt.success){t.opt.success();}
													   t.Alert("已全部处理");
													   
													 }
													
											}else if (result.indexOf("error")!=-1) {
												var json1=eval("("+result+")");
												
											} else {
												//console.log("Error:\n" + data);
												alert("文件块上传失败，请重新上传文件!");
												if(t.opt.bt){
													t.opt.bt.removeAttr("disabled");
												}
											}

										  
								 }
							   });
						};
						var readBob = function (start, stop) {
							//console.log("Read:[" + start + ':' + stop + ']');
							if (file.webkitSlice) {
								var blob = file.webkitSlice(start, stop);
							} else if (file.mozSlice) {
								var blob = file.mozSlice(start, stop);
							} else {
								var blob = file.slice(start, stop);
							}
							reader.readAsDataURL(blob);
						}
						reader.onerror = function (evt) {
							console.debug(evt.target.error.message);
				
							switch (evt.target.error.code){
								case evt.target.error.NOT_FOUND_ERR:
									//alert('File Not Found!');
									break;
								case evt.target.error.NOT_READABLE_ERR:
									//alert('File is not readable');
									break;
								case evt.target.error.ABORT_ERR:
									console.debug("errorHandler ABORT_ERROR");
									break; // noop
								default:
									alert('An error occurred reading this file.');
							};
						};
						reader.onabort = function (e) {
							console.debug(e.target.error.message);
							//alert('File read cancelled');
						};
						reader.onloadstart = function (e) {
							if(typeof(progress_bar)!="undefined"&&progress_bar){
							   progress_bar.className = 'loading';
							}
						};
						reader.onload = function (e) {

								if (reader.readyState == FileReader.DONE) { // DONE == 2
									uploadData(reader.result, file.size, start, stop);
									//setTimeout(callback, 1000);
								}

						}
						stop = (stop_old + shardSize) > file.size ? (file.size) : (stop_old + shardSize);
						readBob(start, stop);	
  		 },RndNum:function(n){
					var rnd="";
					for(var i=0;i<n;i++){
					   rnd+=Math.floor(Math.random()*10);
					}
					return rnd;

		 },IsImg:function(ext){
		  ext=ext.toLowerCase();
		  if(ext=="jpg"||ext=="jpeg"||ext=="gif"||ext=="png"||ext=="bmp"){
			   return true;
		  }else{
			   return false; 
		  }
		},Alert:function(str){
			 if(typeof(layer)!="undefined"){
			  layer.msg("<span style='color:#ffff00;font-size:15px;'>"+str+"<span>",{time:2000});
			 }else{
				 alert(str);
			 }
		}
}
return hcsy_;
}
function myfun(){
   var shuiyin=document.getElementById("shuiyin");
   //参数说明 url：处理网址 inputid:存原图片路径的input id,inputid_new:存返回过来的新图片路径的input id,ge:每张图片按某字符隔开,shuiyintxt:水印文字 ,isfugai:是否覆盖，
    hcsy().init({url:"include/asp/ajax_file_shuiyin.asp",inputid:"photo",inputid_new:"photo_new",ge:"#","shuiyintxt":shuiyin.value,isfugai:0,x:20,y:100});
}