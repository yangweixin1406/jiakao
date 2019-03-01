<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<!--#include file="upload.inc"-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传</title>
</head>
<body>
<%
dim upload,file,formName,formPath,iCount,filename,fileExt
set upload=new upload_5xSoft ''建立上传对象
 formPath="../../file/photos/"
 ''在目录后加(/)
 file_size=1024*1024*2 '2000为2M
 fn=request.QueryString("CKEditorFuncNum")
 if right(formPath,1)<>"/" then formPath=formPath&"/" 

iCount=0
for each formName in upload.file ''列出所有上传了的文件
 set file=upload.file(formName)  ''生成一个文件对象
 if file.filesize<10 then
    response.Clear()
    response.write "<div style=""font-size:12px;""><span style=""font-size:12px;color:red;"">"&file.filesize&"请选择你要上传的文件 </span><a onclick=""history.go(-1)"">重新上传</a></div>"
    response.end
 end if
 if file.filesize>file_size then
    response.Clear()
    response.write "<font style='font-height:12px;'>文件大小超过了限制2M</font>[<a href=# onclick=history.go(-1)>重新上传</a>]"
    response.end()
 end if
 fileExt=lcase(right(file.filename,4))
 uploadsuc=false
 Forum_upload="gif,jpg,png,rar,doc,txt,swf"
 Forumupload=split(Forum_upload,",")
 for i=0 to ubound(Forumupload)
    if fileEXT="."&trim(Forumupload(i)) then
    uploadsuc=true
    exit for
    else
    uploadsuc=false
    end if
 next
 if uploadsuc=false then
     response.write "文件格式不正确　[ <a href=# onclick=history.go(-1)>重新上传</a> ]"
    response.end
 end if
 randomize
 ranNum=int(90000*rnd)+10000
 name1=year(now)&month(now)&day(now)&hour(now)&minute(now)&second(now)&ranNum&fileExt
 filename=formPath&name1
 if file.FileSize>0 then         ''如果 FileSize > 0 说明有文件数据
  file.SaveAs Server.mappath(filename)   ''保存文件
  iCount=iCount+1
  mkhtml fn,filename,"上传成功"
 end if
 
next

set upload=nothing  ''删除此对象
'Htmend iCount&" 个文件上传结束!"
sub HtmEnd(Msg)
 set upload=nothing
 response.write "<font style='font-szie:12px;'>上传成功[ <a href=# onclick=history.go(-1)>继续上传</a>]</font>"
 response.end
end sub

sub mkhtml(fn,fileurl,message)
  dim url,arr
  url=geturl()
  arr=split(url,"/")
  weburl=""
  for i=0 to ubound(arr)-3
    weburl=weburl&arr(i)&"/"
  next

  fileurl=Replace(fileurl, "../", "", 1, -1, 1)
  fileurl=weburl&fileurl
  str="<script>window.parent.CKEDITOR.tools.callFunction('"&fn&"','"&fileurl&"','');</script>"
  response.Write(str)
  response.End()
end sub
Function getCurrentUrl()
On Error Resume Next
Dim strTemp
If LCase(Request.ServerVariables("HTTPS")) = "off" Then
strTemp = "http://"
Else
strTemp = "https://"
End If
strTemp = strTemp & Request.ServerVariables("SERVER_NAME")
If Request.ServerVariables("SERVER_PORT") <> 80 Then
strTemp = strTemp & ":" & Request.ServerVariables("SERVER_PORT")
end if
strTemp = strTemp & Request.ServerVariables("URL")
getCurrentUrl = strTemp
End Function

Function geturl()
Dim ScriptAddress,Servername,qs
ScriptAddress = CStr(Request.ServerVariables("SCRIPT_NAME"))
Servername = CStr(Request.ServerVariables("Server_Name"))
qs=Request.QueryString
If Request.ServerVariables("SERVER_PORT") <> 80 Then
Servername = Servername & ":" & Request.ServerVariables("SERVER_PORT")
end if
if qs<>"" then
geturl ="http://"& Servername & ScriptAddress &"?"&qs
else
geturl ="http://"& Servername & ScriptAddress
end if
End Function

%>
<script>
//window.parent.document.getElementById("cke_158_uiElement").click();
window.history.go(-1);
</script>