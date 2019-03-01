// JavaScript Document
var jss=document.scripts;
jss=jss[jss.length-1].src.substring(0,jss[jss.length-1].src.lastIndexOf("/")+1);
var arr2017jt=jss.split("/"),url2017jt_site="";
for(var i=0;i<(arr2017jt.length-4);i++){ //获取当前域名
	  url2017jt_site+=arr2017jt[i]+"/";
}
function hcfilejietu(){
     //调用方式 hcfilejietu().init({bt_id:"mybt",input_id:"photo",img_id:"touxiang",conf:{width:200,height:120}});
	var hcfile_jietu_={
	   init:function(opt){
	       var t=this;
		   t.opt=opt;
		   var bt=document.getElementById(opt.bt_id);
		   t.conf={width:200,height:200};
		    if(typeof(t.opt.conf)!="undefined"){
		      t.conf.width=t.opt.conf.width;
			  t.conf.height=t.opt.conf.height;
		    }
		    if(!bt){t.alert("按钮不存在");return false};
			if (typeof(FileReader) === 'undefined' ){ t.alert("你的浏览器不支持html5");return false;}
			 var myfile=document.createElement("input");
			 var isChrome = window.navigator.userAgent.indexOf("Chrome") !== -1;
			  if(isChrome){
					 myfile.setAttribute("accept","image/jpg,image/jpeg,image/png,image/gif,image/webp") ;
			  }else{
					 myfile.setAttribute("accept","image/*") ;
			  } 
			  var div=document.createElement("div");
			  div.style.cssText="overflow:hidden;width:1px;height:1px;position:relative;";
			  myfile.name=t.opt.bt_id+"_file",myfile.id=t.opt.bt_id+"_file",myfile.type="file";
			  myfile.style.cssText="top:-100px;position:absolute;filter:alpha(opacity=1); -moz-opacity:0.01; -khtml-opacity:0.01; opacity: 0.01;";
			  myfile.onchange=function(){
				var reader = new FileReader();//读取客户端上的文件 
				reader.readAsDataURL(this.files[0]); 
				t.file=this.files[0];
				reader.onload = function() { 
								var url = reader.result;//读取到的base64.这个属性只在读取操作完成之后才有效,并且数据的格式取决于读取操作是由哪个方法发起的.所以必须使用reader.onload，   
								t.show({src:url});
				}
			  }
			  t.myfile=myfile;
			  div.appendChild(myfile);
			  bt.parentNode.appendChild(div);
			  bt.onclick=function(){
			     myfile.click();
			  }
			  $("#"+t.opt.img_id).click(function(){
				if(t.opt.type==1){ 
					if(typeof(t.src)=="undefined"){
						t.myfile.value="";
						 myfile.click();
					}else{
						 t.show({src:t.src});  
					}
				}else{
					    t.myfile.value="";
					    myfile.click();
				}
			  });
              if(typeof(t.opt.input_id)!="undefined"){
				  var input=$("#"+t.opt.input_id);
				  if(input.length>0&&input.val()!=""){
						if(input.val().indexOf("http://")==-1&&input.val().indexOf("https://")==-1){
							  $("#"+t.opt.img_id).attr("src",url2017jt_site+input.val());
						}else{
							  $("#"+t.opt.img_id).attr("src",input.val());
						}
				  }
			  }
	   },show:function(opt){
	         var html="",t=this;
			 var body=$("body");
			 body.css({"overflow":"hidden"});
			    html+='<div id="'+t.opt.bt_id+'_showcropper" style="display: none;width:100%;height: 100%;position:fixed;----position:absolute;top:0;left: 0;z-index:1000;height:100%;">';
				html+='<div style="position:relative;width:100%;height:100%;overflow-y:auto;">';
				html+='<div style="width:100%;height:100%;position: absolute;top:10px;left:0px;">';
				html+='<button class="mui-btn mui-btn-cancleBtn" data-mui-style="fab" style="margin-left: 10px;">取消</button>';
				html+='<button class="mui-btn mui-btn-confirmBtn" data-mui-style="fab" data-mui-color="primary" style="float:right;margin-right: 10px;">确定</button>';
				html+='</div>';
				html+='<div class="report"  style="width:100%;height:100%;">';
				html+='<img  style="width: 100%;height:auto;"> ';
			    html+='</div>';
				html+='</div>';
				html+='</div>';
				t.src=opt.src;
			var showcropper=$('#'+t.opt.bt_id+"_showcropper");
			if (showcropper.length<1){
			   body.append(html);
			   showcropper=$('#'+t.opt.bt_id+"_showcropper");
			   showcropper.find("img").attr("src",opt.src);
			}
			showcropper.show();
			var cancleBtn=showcropper.find(".mui-btn-cancleBtn");
			cancleBtn.unbind("click");
			cancleBtn.click(function(){
			   showcropper.remove();
			   t.file.value="";
			   body.css({"overflow":"auto"});
			});
			
			var $image = $('#'+t.opt.bt_id+"_showcropper").find("img");
			var confirmBtn=showcropper.find(".mui-btn-confirmBtn");
			confirmBtn.unbind("click");
			confirmBtn.click(function(){
			    var dataURL = $image.cropper("getCroppedCanvas", { "width": t.conf.width, "height":t.conf.height});
                var imgurl = dataURL.toDataURL("image/jpeg",0.9);
				$("#"+t.opt.img_id).attr("src",imgurl);
				//alert(imgurl);
				t.send({file:t.file,dataURL:imgurl});
			    showcropper.remove();
				body.css({"overflow":"auto"});
				
			});

            $image.cropper({
                aspectRatio:  t.conf.width/ t.conf.height,
                autoCropArea: 0.7,
                strict: true,
                guides: false,
                center: true,
                highlight: false,
                dragCrop: false,
                //cropBoxMovable: false,
                cropBoxResizable: false,
                zoom: -0.2,
                checkImageOrigin: true,
                background: false,
                minContainerHeight: 400,
                minContainerWidth: 300
            });
	   },send:function(opt){//发送
	      var t=this;
	            var file=opt.file;
				var title=file.name;
				//window.console.log(file);
				var arr=title.split(".");

				var ext=arr[arr.length-1];
				if(ext==""){ext="jpg";}
				var arr1=opt.dataURL.split("base64,");
				var base64=arr1[1],ajaxurl="";
			    file.value="";
				base64=base64.replace(/\+/g,"[jh]");//加号发送到接收端可能引起错误
				if(t.opt.url.indexOf("?")!=-1){
					  ajaxurl=t.opt.url+"&act=save_base64";
				}else{
					 ajaxurl=t.opt.url+"?act=save_base64";
				}
				var imgsite="";
				if(typeof(t.opt.imgsite)!="undefined"){imgsite=t.opt.imgsite}
				$.ajax({
				  url:ajaxurl,
				  type:"post",
				  dataType:"text",
				  data:{ext:ext,title:title,base64:base64},
					success:function(res){
				  var json=eval("("+res+")");
				     if(json){
						 if(json.status=="success"){
						     $("#"+t.opt.input_id).val(imgsite+json.path);
							 if(typeof(t.opt.success)!="undefined"){t.opt.success(json);}
						 }else{
							 t.alert(json.msg);
						 }
					 }
				  }
				})
	   },alert:function(str){
	           alert(str);
	   }
	}
	return hcfile_jietu_;
}