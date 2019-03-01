<%@LANGUAGE="VBSCRIPT" CODEPAGE="936"%>
<!--#include file="include/func.asp"-->

<%

on Error Resume Next
'asp技术支持QQ 632175205 
conf_file_cengci="../" '文件夹层次
conf_file_dir="file/" '文件夹路径
%>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>无标题文档</title>
<%
    gourl=trim(request("gourl"))
	cururl=GetLocationURL()
	if(trim(Request.ServerVaiable("Quesy_String"))<>"") then
	'cururl = Request.ServerVariable("HTTP_HOST") & Request.ServerVariable("PATH_INFO") & "?" &Request.ServerVaiable("Quesy_String")
	else
	'cururl=Request.ServerVariable("HTTP_HOST") & Request.ServerVariable("PATH_INFO")
	end if
	if(gourl="") then
	  gourl=cururl
	end if
	'response.Write(cururl)
	'response.End()
	arrb=split(cururl,"?")
	arr=split(gourl,"?")
	addurl=arr(1)
    gourl=cururl
	'response.Write(upladurl)
    'arr=split(upladurl,"?")
	'canshu=arr(1)
	id=getcs(gourl,"id")
	bgsrc=getcs(gourl,"bgsrc")
	bgsrc1=getcs(gourl,"bgsrc1")
	func=getcs(gourl,"func")
	inputmoreid=getcs(gourl,"inputmoreid")
	bttext=getcs(gourl,"bttext")
	inputid=getcs(gourl,"inputid")
	qzimg=getcs(gourl,"qzimg")
	nameqz=getcs(gourl,"nameqz")
	folder=getcs(gourl,"folder")
	returntype=getcs(gourl,"returntype")
	inputtitleid=getcs(gourl,"inputtitleid")
	isduoxuan=getcs(gourl,"isduoxuan")
	imgw=getcs(gourl,"imgw")
	btfontsize=getcs(gourl,"btfontsize")
	btclassname=getcs(gourl,"btclassname")
	if(folder<>"") then
	      conf_file_dir=folder
	end if
%>
<script>

var folder="<%= trim(folder)%>";//上传文件夹
var inputid="<%= trim(inputid)%>";//文本框Id
var inputtitleid="<%= trim(inputtitleid)%>";//文本框Id
var bgsrc="<%= trim(bgsrc)%>";//默认时背景图
var bgsrc1="<%= trim(bgsrc1)%>";//鼠标移上时背景图
var func="<%= trim(func)%>";//上传后的js回调函数名
var inputmoreid="<%= trim(inputmoreid)%>";
var bttext="<%= trim(bttext)%>";
var input=null;
var isduoxuan="<%= trim(isduoxuan)%>";
var btclassname="<%= trim(btclassname)%>";
var btfontsize="<%= trim(btfontsize)%>";
var inputtitle=null;
var qzimg="<%=trim(qzimg)%>";
var inputmore=null;
if(inputid!=""){input=window.parent.document.getElementById(inputid);}
if(inputmoreid!=""){inputmore=window.parent.document.getElementById(inputmoreid);}
if(inputtitleid!=""){inputtitle=window.parent.document.getElementById(inputtitleid);}
function showImage(opt){ //返回值
//	if(input!=null){
//		if(return1=="id"){
//			input.value=id;
//		}else{
//	        input.value=path;
//		}
//		var arr=inputid.split("_");
//		  var div1=window.parent.document.getElementById(inputid+"_Div");
//		if(div1!=null){
//			div1.innerHTML="<img src='"+qzimg+path+"'/>";
//		}
//	}
	if(func!=""){
		window.parent[func](opt);
	}else{
	   if(input!=null){
	     input.value=opt.path;
	   }
	   showOne(opt);   
	}

}
function showOne(opt){
	if(input!=null){
		var arr=inputid.split("_");
		var div1=window.parent.document.getElementById(inputid+"_div");
		if(div1!=null&&opt.path!=""){
			div1.innerHTML="<a href='"+qzimg+opt.path+"' target='_blank'><img src='"+qzimg+opt.path+"' style='height:30px;'/></a>";
		}
	}
}
function init(){
	if(input!=null){
	    if(func!=""){
			if(input.value!=""){
				showImage({inputid:input.id,qzimg:qzimg});
			}
		}else{
		        showOne({path:input.value,qzimg:qzimg});
		}
     }
}
init();
function Upload(){
	 var mysubmit=document.getElementById("mysubmit");
	 if(mysubmit.click){
		 mysubmit.click(); 
	 }
	 if(mysubmit.submit){
		 mysubmit.submit(); 
	 }
	 document.getElementById("upform1").submit(); 
}
function UpfileClick(){
	 document.getElementById("upfile").click(); 
}
</script>
<%

id=request("id")
%>
</head>

<% db_qianzhui="" %>
<% 
g_max_size=40 '最大限制m为单位

if(Request.ServerVariables("REQUEST_METHOD")="POST") then
%>
<!--#include file="include/upload.inc"-->
<%
dim upload,file,formName,formPath,iCount,filename,fileExt
set upload=new upload_5xSoft ''建立上传对象

'	folder=upload.form("folder") 
'	quan=upload.form("quan")
'	nameqz=upload.form("nameqz") 
'	returntype=upload.form("return") 
'   id=upload.form("id")
	
isbool=1
tishi=""
iCount=0

for each formName in upload.file
 set file=upload.file(formName) 
 isbool=1
 tishi=""
 filesize=file.FileSize

 'response.Write(file.filename&iCount&" FileSize:"&file.FileSize&"<br/>")
 if file.FileSize>0 then  
  iCount=iCount+1
		' ext=lcase(right(file.filename,4))
		'response.Write((lcase(file.filename)))

		 arr=split(lcase(file.filename),".")
		 ext=trim(arr(ubound(arr)))

		 uploadsuc=false
		 Forum_upload="gif,jpg,png,bmp,jpeg"
		 Forumupload=split(Forum_upload,",")
		 for i=0 to ubound(Forumupload)
			if ext=trim(Forumupload(i)) then
			  uploadsuc=true
			exit for
			else
			uploadsuc=false
			end if
		 next
		 if uploadsuc=false then
			 tishi="文件格式不正,重新上传"&ext
			 isbool=0
		 end if
		  if file.filesize<0 then
			 tishi= "请选择你要上传的文件,重新上传"
			 isbool=0
		 end if
		 if file.filesize>g_max_size*1024*1024 then
			 tishi= "文件大小超过了限制"&g_max_size&"M,重新上传"
			 isbool=0
		 end if
           if(isbool=1) then

						  if file.FileSize>0 then         ''如果 FileSize > 0 说明有文件数据
						                 
										  randomize       '产生随机数 一定要记得加这句 不懂百度一下 asp randomize
										  ranNum=int(90000*rnd)+10000
										  nameqz=trim(nameqz)
										  if(nameqz="") then
										  newname=year(now)&month(now)&day(now)&hour(now)&minute(now)&second(now)&ranNum
										  elseif(nameqz="old") then
										  newname=file.filename
										  else
										  newname=nameqz
										  end if
										  title=file.filename
										  adddate=now()
										  
										  month1=Month(adddate)
										  year1=Month(adddate)
										  if(month1<10) then
										  month1="0"&month1
										  end if
                                          folder=conf_file_dir&year1&month1&"/"
										  CreateDir(conf_file_cengci&folder)
										  bigpath=folder&newname&"."&ext
										  bigpath_full=conf_file_cengci&bigpath
                                          smallpath=bigpath
										  tomappath=Server.mappath(bigpath_full)
										  file.SaveAs tomappath   ''保存文件
										  '以下是生成缩略图
										  'smallpath=folder&newname&"_s."&ext
										  'smallpath_full=quan&smallpath
										  
										  
										  if(isnumeric(imgw)) then
											Set Jpeg = Server.CreateObject("Persits.Jpeg") 'iis要装上aspjpeg图片处理插件
											Jpeg.Open Server.MapPath(bigpath_full)
											bilv=Jpeg.Width/Jpeg.Height '//宽高比 
											Set Jpeg = Nothing
											width=imgw
											height=CSng(width)/bilv
		                                    CreateSmall bigpath_full, width, height,0.7, 0, bigpath_full '生成小图
										  end if
		                                   '生成缩略图结束了啊
							response.Write("<script>showImage({""qzimg"":"""&qzimg&""",""path"":"""&bigpath&""",""big"":"""&bigpath&""",""small"":"""&smallpath&""",""title"":"""&title&""",""inputid"":"""&inputid&"""});</script>")

										
						  end if
			 else
			 
			 response.Write("<script>alert('"&tishi&"')</script>")
			 end if
 end if
 set file=nothing
next
set upload=nothing  ''删除此对象
end if

'将二进制转换成文本
Function BtoS (bstr) 
     If not IsNull(bstr) Then 
         for i = 0 to lenb(bstr) - 1 
            bchr = midb(bstr,i+1,1) 
            If ascb(bchr)>127 Then 
               temp = temp&chr(ascw(midb(bstr, i+2, 1)&bchr)) 
               i = i+1 
            Else 
               temp = temp&chr(ascb(bchr)) 
            End If 
         next 
      End If 
      BtoS = temp 
End Function

%>
<style>
*{font-size:12px; cursor:pointer;}
html,body{ padding:0px;margin:0px; background-color:transparent;}
.bt_lable{
		top:0px;height:23px; left:0px;
		position:absolute; z-index:5;
		background: #D0EEFF;
		border: 1px solid #99D3F5;
		border-radius: 4px;
		overflow: hidden;
		color: #1E88C7;
		text-decoration: none;
		line-height: 20px;
		height:100%;
		width:100%; 
		padding-top:4px;
		padding-bottom:4px;
		
	  
}
.bt_lable2{
		top:0px;height:23px; left:0px;
		position:absolute; z-index:5;
		background: #3399FF;
		border-radius: 0px;
		overflow: hidden;
		color: #ffffff;
		text-decoration: none;
		line-height: 20px;
		height:100%;
		width:100%; 
		padding-top:4px;
		padding-bottom:4px;
		 border:0px;
		 
}
.bt_lable2.hover{
	background:#33CCFF;
    color: #004974;
}
.bt_lable.hover{
	background: #AADFFD;
    color: #004974;
	border: 1px solid #99D3F5;
}
</style>
<body style="margin:0px; padding:0px; width:100%;overflow:hidden;" >
<div style=" position:relative;overflow:visible; width:100%;" id="mydiv">
<form  name="upform1" id="item1_upform1" enctype="multipart/form-data" method="post" action="<%=gourl%>"  accept-charset="gb2312" style="margin:0px; padding:0px; line-height:0px; border:0px;" >
<input type="file" name="file1"  id="file1" accept="image/*" style="filter:alpha(Opacity=1);-moz-opacity:0.01;opacity:0.01;left:0px; cursor:pointer; position:absolute; width:70px; height:60px; z-index:1000"/>
<input type="submit" name="btsend" id="btsend" value="&nbsp;" style=" left:0px; position:absolute; background-color:transparent; border:0px; z-index:20000; top:50px;"/>
<input type="hidden" name="gourl" value=""/>
</form>
<input  type="button" id="bt_lable" value="提交"   style=" top:0px; height:23px; left:0px; position:absolute; z-index:5;"/>
</div>
</body>
</html>
<script>

		var item1_upform1=document.getElementById("item1_upform1");
		
		var zindex=1000;
		var bt_lable=document.getElementById("bt_lable");
		if(bttext==""){
		bt_lable.value="\u300e\u70b9\u51fb\u4e0a\u4f20\u300f";//『点击上传』的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
		}
		if(bttext=="1"){
		
		 bt_lable.value="\u4e0a\u4f20\u65b0\u7167\u7247";//上传新照片的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
		}
	    window.cheight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
	    window.cwidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
		
		 var ua = navigator.userAgent;
		
		 var num=20;
		 var touch =("createTouch" in document);
		 var file1=document.getElementById("file1");
		 if(ua.indexOf("UCBrowser")!=-1&&touch){//手机uc浏览器
			 num=0;
			 file1.style.cssText="left:0px;cursor:pointer; position:absolute; width:"+(window.cwidth-4)+"px; height:"+(window.cheight-4)+"px; z-index:1000";
		 } 
		 
		 if(ua.indexOf("AppleWebKit")!=-1&&touch){//苹果
		   bt_lable.onclick=function(){
			 file1.click();
		   }
		   num=0;
		   file1.style.top="100px";  
		 }
 
		for(var i=0;i<num;i++){
						  var file=document.createElement("input");
						  zindex++;
						  file.type="file";
						  file.value="";
						  file.name="upfile_"+i;
						  file.id="upfile_"+i;
						  if(isduoxuan=="1"){
						   file.setAttribute("multiple","multiple");
						   }
						    file.setAttribute("accept","*");
						  var left=(-20)+(i%10)*30;
						  var top1=parseInt(i/10)*20;
						  file.style.cssText="filter:alpha(Opacity=1);-moz-opacity:0.01;opacity:0.01; left:"+left+"px; cursor:pointer; position:absolute;top:"+top1+"px;width:70px; height:70px; z-index:"+zindex+";";
						  file.onchange=function(){ 
						  bt_lable.value="\u6b63\u5728\u4e0a\u4f20";//正在上传的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
						   document.forms[0].enctype="multipart/form-data";
						   document.getElementById("btsend").click();
							   // document.getElementById("item1_upform1").submit();
							};
						 item1_upform1.appendChild(file);
						// window.setTimeout(function(){alert(44);document.getElementById("item1_upform1").submit();},6000);
						 
		}

		 var btsend=document.getElementById("btsend");
		 var file1=document.getElementById("file1");
		 file1.onchange=function(){
				// bt_lable.value="正在上传请稍后";
				 bt_lable.value="\u6b63\u5728\u4e0a\u4f20";//正在上传的Unicode编码 http://tool.chinaz.com/tools/unicode.aspx
			   //document.forms[0].enctype="multipart/form-data";
			   document.getElementById("btsend").click();
			   file1.style.display="none";
			   
		 }


        var body=document.getElementsByTagName("body")[0];
		
		

		body.style.height=window.cheight+"px";
		body.style.width=window.cwidth+"px";
		bt_lable.style.width=window.cwidth+"px";
		bt_lable.style.height=window.cheight+"px";
		bt_lable.style.lineHeight=window.cheight-8+"px";
		if(btfontsize!=""){
		    bt_lable.style.fontSize=btfontsize+"px";
		}
		bt_lable_class="bt_lable";
		if(btclassname!=""){
		  bt_lable_class=btclassname;
		  
		}
		
		if(bgsrc!=""){
			bt_lable.style.border="none";
			bt_lable.style.textIndent="-300px";
			bt_lable.style.overflow="hidden";
			bt_lable.style.background="url('"+bgsrc+"') center center no-repeat";
		}
		if(bgsrc!=""&&bgsrc1!=""){
			body.onmouseover=function(){
			   bt_lable.style.backgroundImage="url('"+bgsrc1+"')";	
			}
			body.onmouseout=function(){
				bt_lable.style.backgroundImage="url('"+bgsrc+"')";	
			}
		}else{
		  

             bt_lable.className=bt_lable_class;
			body.onmouseover=function(){
			    bt_lable.className=bt_lable_class+" hover";
			}
			body.onmouseout=function(){
				 bt_lable.className=bt_lable_class;
			}

		}
</script>

