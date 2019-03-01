<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<% 
'On Error Resume Next 
%>
<!--#include file="func.asp"-->
<!--#include file="config.asp"-->
<%
response.Charset="utf-8"
act=request.QueryString("act")
if(act="save_base64") then
    base64=request("base64")
	title=request("title")
    base64 = Replace(base64, "[jh]", "+", 1, -1, 0) 
	ext=request("ext")
	response.Clear()
	if(ext="") then ext="jpg"
	ext=LCase(ext)
	Forum_upload="gif,jpg,png,bmp,jpeg" '允许文件格式
	Forumupload=split(Forum_upload,",")
	for i=0 to ubound(Forumupload)
	if ext=trim(Forumupload(i)) then
	is_upload=true '允许上传
	exit for
	else
	is_upload=false '不允许上传
	end if
	next
	
	 if(is_upload=false) then
	    response.Write("{status:""error"",msg:""后端不允许上传."&ext&"文件""}")
		response.End()
	 end if
	    now1=now
	    year1=year(now1)
	    month1=month(now1)
	    day1=day(now1)
	   if(month1<10) then
	    month1="0"&month1 
	   end if
	   if(day1<10) then
	    day1="0"&day1 
	   end if
	   newdir=year1&""&month1&"/"
	   g_dir4=g_dir4&newdir
	if(base64<>"") then
	    call CreateDir(g_cengci&g_dir4)
	    bigsrc=g_dir4&NewFileName("","",0)&"."&ext	
	    big_fullpath=g_cengci&bigsrc 
		
        call SaveBase64(big_fullpath,base64)
		response.Write("{status:""success"",path:"""&bigsrc&"""}")
	end if
	response.End()
end if


%>

