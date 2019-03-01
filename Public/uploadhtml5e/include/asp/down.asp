<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<%
path=trim(request("path"))
if(path<>"")then
   cengci=trim(request("cengci"))
   xiazai(cengci&path)
end if

function xiazai(url) '下载函数
    Response.Buffer=true
    dim trueurl
     trueurl=server.MapPath(url)
   set objFso=server.CreateObject("scripting.filesystemobject")
   set fn=objFso.GetFile(trueurl)
   flsize=fn.size
   flname=fn.name
   set fn=nothing
   set objFso=nothing
   
   set objStream=server.CreateObject("adodb.stream")
   objStream.Open 
   objStream.Type=1
   objStream.LoadFromFile trueurl
   exta=lcase(right(flname,4))
   if(exta<>".asp" and exta<>".asa" and exta<>".aspx" and exta<>".php" and exta<>".mdb") then 
	   Response.AddHeader "Content-Disposition", "attachment; filename="&flname
	   Response.AddHeader "Content-Length", flsize
	   Response.CharSet="UTF-8"
	   'Response.ContentType=ContentType
	   Response.BinaryWrite objStream.Read 
	   Response.Flush 
	   Response.Clear()
   end if
'   select case lcase(right(flname,4))
'      case ".asf"
'      ContentType="video/x-ms-asf"
'      case ".avi"
'      ContentType="video/avi"
'      case ".doc"
'      ContentType="application/msword"
'      case ".zip"
'      ContentType="application/zip"
'      case ".xls"
'      ContentType="application/vnd.ms-excel"
'      case ".gif"
'      ContentType="image/gif"
'      case ".jpg","jpeg"
'      ContentType="image/jpeg"
'      case ".wav"
'      ContentType="audio/wav"
'      case ".mp3"
'      ContentType="audio/mpeg3"
'      case ".mpg", "mpeg"
'      ContentType="video/mpeg"
'      case ".rtf"
'      ContentType="application/rtf"
'      case ".htm","html"
'      ContentType="text/html"
'      case ".txt"
'      ContentType="text/plain"
'  Case ".ASP", ".ASA", "ASPX", "ASAX", ".MDB"
'        Response.Write "受保护文件,不能下载."
'        Response.End
'      case else
'      ContentType="appliation/octet-stream"
'   end select


   objStream.Close
   set objStream=nothing
   
end function
%>