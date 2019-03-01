<%
function UpImg(oldfile_path,cengci,dir1,dir2,dir3,w1,w2,newfilename)
		  
		  maxwidth=w1
		  maxheight=0
		  full_oldfile_path=cengci&oldfile_path
		  newfile_path=cengci&dir1&newfilename
		  str=SaveImg(full_oldfile_path,maxwidth,maxheight,0,0,0,0,newfile_path)
  
		  maxwidth=w2
		  maxheight=0
		  full_oldfile_path=cengci&oldfile_path
		  newfile_path=cengci&dir2&newfilename
		  str1=SaveImg(full_oldfile_path,maxwidth,maxheight,0,0,0,0,newfile_path)
		  UpImg=str
		  
  end function
  function SaveImg(full_oldfile_path,maxwidth,maxheight,width,height,x,y,newfile_path)
		  Set Jpeg = Server.CreateObject("Persits.Jpeg")
		  Path = Server.MapPath(full_oldfile_path)
		  Jpeg.Open Path
		  Pp=FormatNumber(Jpeg.Width/Jpeg.Height,10)
		  Jpeg.Width =maxwidth
		  Jpeg.Height =FormatNumber((Jpeg.Width)/Pp,10)
		  Jpeg.Save Server.MapPath(newfile_path)
		  Jpeg.Close
		  Set Jpeg = Nothing
		  SaveImg=newfile_path
  end function
  function MyNewId(tablename,fieldname)
         dim id
  		 id=GetFirstValue("select MAX("&fieldname&") as myid from "&tablename)
		 if(id<>"")then id=id+1 else id=1 end if
		 MyNewId=id
  end function 
  function GetFirstValue(sql)
	  dim value_:value_=mz
	   set rs=conn2015.execute(sql)
	   if(not rs.eof and not rs.bof ) then
		value_=rs(0)
	   end if
	   GetFirstValue=value_
end function 
function SaveBase64(fullpath,base64)
	  Dim xmlstr:xmlstr="<data>"&base64&"</data>"
	  '使用xml方法生成图片
	  Dim xml : Set xml=Server.CreateObject("MSXML2.DOMDocument")
	  Dim stm : Set stm=Server.CreateObject("ADODB.Stream")
	  xml.resolveExternals=False
	  xml.loadxml(xmlstr)
	  xml.documentElement.setAttribute "xmlns:dt","urn:schemas-microsoft-com:datatypes"
	  xml.documentElement.dataType = "bin.base64"
	  stm.Type=1  'adTypeBinary
	  stm.Open
	  stm.Write xml.documentElement.nodeTypedValue
	  stm.SaveToFile Server.MapPath(fullpath),2
	  stm.Close
	  Set xml=Nothing
	  Set stm=Nothing

end function
function SaveBase64file(fullpath,base64,dataType)
'response.AddHeader "Content-Type","application/vnd.ms-excel"
'Response.ContentType = "Application/msexcel" 
Response.AddHeader "content-type","application/vnd.ms-excel"
	  Dim xmlstr:xmlstr="<data>"&base64&"</data>"
	  '使用xml方法生成图片
	  Dim xml : Set xml=Server.CreateObject("MSXML2.DOMDocument")
	  Dim stm : Set stm=Server.CreateObject("ADODB.Stream")
	  xml.resolveExternals=False
	  xml.loadxml(xmlstr)
	  
	  xml.documentElement.setAttribute "xmlns:o","urn:schemas-microsoft-com:office:office"
	  xml.documentElement.dataType = "bin.base64"
	  stm.Type=1  'adTypeBinary
	  stm.Open
	  stm.Write xml.documentElement.nodeTypedValue
	  stm.SaveToFile Server.MapPath(fullpath),2
	  stm.Close
	  Set xml=Nothing
	  Set stm=Nothing
Set fso = Server.CreateObject("Scripting.FileSystemObject")
fso.movefile Server.MapPath(fullpath),Server.MapPath("111000.xls")
set fso=nothing
fso.close

end function
function SavePhoto(fullpath,new_fullpath,w)
	Set Jpeg = Server.CreateObject("Persits.Jpeg") 'iis要装上aspjpeg图片处理插件
	'Jpeg.Interpolation=0
	Jpeg.Quality=95 
	Path = Server.MapPath(fullpath)
	Jpeg.Open Path
	Pp=Jpeg.Width/Jpeg.Height '//宽高比 
	h=(w)/Pp
	Jpeg.Width =w
	Jpeg.Height =h
	Jpeg.Save Server.MapPath(new_fullpath) '生成中图
	Set Jpeg = Nothing
end function
function DelPhoto(fullpath1,fullpath2,fullpath3)
        values=split(fullpath1,"_")
        fullpath1=Server.MapPath(fullpath1)
		fullpath2=Server.MapPath(fullpath2)
		fullpath3=Server.MapPath(fullpath3)
		Set fs = Server.CreateObject("Scripting.FileSystemObject") 
		If   fs.FileExists(fullpath1)   Then 
			fs.deleteFile(fullpath1)
		end if
		If   fs.FileExists(fullpath2)   Then 
			fs.deleteFile(fullpath2)
		end if
		If   fs.FileExists(fullpath3)   Then 
			fs.deleteFile(fullpath3)
		end if
		set fs = nothing
		
		if(ubound(values)>1) then
		 id=values(1)
		 if isnumeric(values(1)) then
		  conn2015.execute("delete  from "&tableQianZhui&"images where id="&id)
		 end if
		end if
end function 
function DelFile(fullpath)
        values=split(fullpath,"_")
        fullpath=Server.MapPath(fullpath)
		Set fs = Server.CreateObject("Scripting.FileSystemObject") 
		If   fs.FileExists(fullpath)   Then 
			fs.deleteFile(fullpath)
		end if
		set fs = nothing
		if(ubound(values)>1) then
		 id=values(1)
		 if isnumeric(values(1)) then
		  conn2015.execute("delete  from "&tableQianZhui&"images where id="&id)
		 end if
		end if
end function
Function GetValue(sql,vv)
	dim  rs,str_
	str_=trim(vv)
		'If (not IsObject(conn)) or (not IsEmpty(conn))  Then ConnectionDatabase
		set rs = conn.execute(sql)
			if not rs.eof  and not rs.bof Then
				if isnull(rs(0)) or trim(rs(0))="" then
				
				else
				str_=trim(rs(0))
				end if
				
			end If
			rs.close
		set rs = nothing
	GetValue=str_	
End Function
Function GetCaption(g_str,vv)
 dim arr1,arr2
 arr1=split(g_str,"[]")
 for i=0 to ubound(arr1)
   arr2=split(arr1(i),"||")
    if(trim(arr2(1))=trim(vv)) then
	 GetCaption=arr2(0)
	end if
 next
End Function 
Function CheckStr(Str)
'Str=LCase(Str)
If Isnull(Str) Then
   CheckStr = ""
   Exit Function 
End If

'Str = Replace(Str,Chr(0),"", 1, -1, 1)
'Str = Replace(Str, """", "&quot;", 1, -1, 1)
'Str = Replace(Str,"<","&lt;", 1, -1, 1)
'Str = Replace(Str,">","&gt;", 1, -1, 1) 
Str = Replace(Str, "script", "&#115;cript", 1, -1, 0)
Str = Replace(Str, "SCRIPT", "&#083;CRIPT", 1, -1, 0)
Str = Replace(Str, "Script", "&#083;cript", 1, -1, 0)
Str = Replace(Str, "script", "&#083;cript", 1, -1, 1)
Str = Replace(Str, "object", "&#111;bject", 1, -1, 0)
Str = Replace(Str, "OBJECT", "&#079;BJECT", 1, -1, 0)
Str = Replace(Str, "Object", "&#079;bject", 1, -1, 0)
Str = Replace(Str, "object", "&#079;bject", 1, -1, 1)
Str = Replace(Str, "applet", "&#097;pplet", 1, -1, 0)
Str = Replace(Str, "APPLET", "&#065;PPLET", 1, -1, 0)
Str = Replace(Str, "Applet", "&#065;pplet", 1, -1, 0)
Str = Replace(Str, "applet", "&#065;pplet", 1, -1, 1)
'Str = Replace(Str, """", "", 1, -1, 1)
'Str = Replace(Str, "=", "&#061;", 1, -1, 1)
Str = Replace(Str, "'", "&#39;", 1, -1, 1)
Str = Replace(Str, "select", "sel&#101;ct", 1, -1, 1)
Str = Replace(Str, "execute", "&#101xecute", 1, -1, 1)
Str = Replace(Str, "exec", "&#101xec", 1, -1, 1)
Str = Replace(Str, "join", "jo&#105;n", 1, -1, 1)
Str = Replace(Str, "union", "un&#105;on", 1, -1, 1)
Str = Replace(Str, "where", "wh&#101;re", 1, -1, 1)
Str = Replace(Str, "insert", "ins&#101;rt", 1, -1, 1)
Str = Replace(Str, "delete", "del&#101;te", 1, -1, 1)
Str = Replace(Str, "update", "up&#100;ate", 1, -1, 1)
Str = Replace(Str, "like", "lik&#101;", 1, -1, 1)
Str = Replace(Str, "drop", "dro&#112;", 1, -1, 1)
Str = Replace(Str, "create", "cr&#101;ate", 1, -1, 1)
Str = Replace(Str, "rename", "ren&#097;me", 1, -1, 1)
Str = Replace(Str, "count", "co&#117;nt", 1, -1, 1)
Str = Replace(Str, "chr", "c&#104;r", 1, -1, 1)
'Str = Replace(Str, "mid", "m&#105;d", 1, -1, 1)
Str = Replace(Str, "truncate", "trunc&#097;te", 1, -1, 1)
Str = Replace(Str, "nchar", "nch&#097;r", 1, -1, 1)
Str = Replace(Str, "char", "ch&#097;r", 1, -1, 1)
Str = Replace(Str, "alter", "alt&#101;r", 1, -1, 1)
Str = Replace(Str, "cast", "ca&#115;t", 1, -1, 1)
Str = Replace(Str, "exists", "e&#120;ists", 1, -1, 1)
'Str = Replace(Str,Chr(13),"<br>", 1, -1, 1)
'Str = Replace(Str, "'", "&#39;", 1, -1, 1)
CheckStr = Replace(Str,"""","&#34;", 1, -1, 1)
End Function
Function UnCheckStr(Str)
'Str=LCase(Str)
If Isnull(Str) Then
   UnCheckStr = ""
   Exit Function 
End If

'Str = Replace(Str,Chr(0),"", 1, -1, 1)
'Str = Replace(Str, "&quot;", """", 1, -1, 1)
'Str = Replace(Str,"&lt;","<", 1, -1, 1)
'Str = Replace(Str,"&gt;",">", 1, -1, 1) 
Str = Replace(Str, "&#115;cript", "script", 1, -1, 0)
Str = Replace(Str, "&#083;CRIPT", "SCRIPT", 1, -1, 0)
Str = Replace(Str, "&#083;cript", "Script", 1, -1, 0)
Str = Replace(Str, "&#111;bject", "object", 1, -1, 0)
Str = Replace(Str, "&#079;BJECT", "OBJECT", 1, -1, 0)
Str = Replace(Str, "&#079;bject", "Object", 1, -1, 0)
Str = Replace(Str, "&#079;bject", "Object", 1, -1, 1)
Str = Replace(Str, "&#097;pplet", "applet", 1, -1, 0)
Str = Replace(Str, "&#065;PPLET", "APPLET", 1, -1, 0)
Str = Replace(Str, "&#065;pplet", "Applet", 1, -1, 0)
Str = Replace(Str, "&#065;pplet", "applet", 1, -1, 1)
'Str = Replace(Str, """", "", 1, -1, 1)
'Str = Replace(Str, "=", "&#061;", 1, -1, 1)
Str = Replace(Str, "'", "&#39;", 1, -1, 1)
Str = Replace(Str, "sel&#101;ct", "select", 1, -1, 1)
Str = Replace(Str, "&#101xecute", "execute", 1, -1, 1)
Str = Replace(Str, "&#101xec", "exec", 1, -1, 1)
Str = Replace(Str, "jo&#105;n", "join", 1, -1, 1)
Str = Replace(Str, "un&#105;on", "union", 1, -1, 1)
Str = Replace(Str, "wh&#101;re", "where", 1, -1, 1)
Str = Replace(Str, "ins&#101;rt", "insert", 1, -1, 1)
Str = Replace(Str, "del&#101;te", "delete", 1, -1, 1)
Str = Replace(Str, "up&#100;ate", "update", 1, -1, 1)
Str = Replace(Str, "lik&#101;", "like", 1, -1, 1)
Str = Replace(Str, "dro&#112;", "drop", 1, -1, 1)
Str = Replace(Str, "cr&#101;ate", "create", 1, -1, 1)
Str = Replace(Str, "ren&#097;me", "rename", 1, -1, 1)
Str = Replace(Str, "co&#117;nt", "count", 1, -1, 1)
Str = Replace(Str, "c&#104;r", "chr", 1, -1, 1)
'Str = Replace(Str, "m&#105;d", "mid", 1, -1, 1)
Str = Replace(Str, "trunc&#097;te", "truncate", 1, -1, 1)
Str = Replace(Str, "nch&#097;r", "nchar", 1, -1, 1)
Str = Replace(Str, "ch&#097;r", "char", 1, -1, 1)
Str = Replace(Str, "alt&#101;r", "alter", 1, -1, 1)
Str = Replace(Str, "ca&#115;t", "cast", 1, -1, 1)
Str = Replace(Str, "e&#120;ists", "exists", 1, -1, 1)
'Str = Replace(Str,Chr(13),"<br>", 1, -1, 1)
'Str = Replace(Str, "'", "&#39;", 1, -1, 1)
UnCheckStr = Replace(Str,"&#34;","""", 1, -1, 1)
End Function
function sendEmail(serverip,smtpserverport,server_email,server_email_pwd,to_email,title,content)
        Set objMail = Server.CreateObject("CDO.Message")
        Set objCDOSYSCon = Server.CreateObject ("CDO.Configuration")
        objCDOSYSCon.Fields("http://schemas.microsoft.com/cdo/configuration/sendusing") = 2
        objCDOSYSCon.Fields("http://schemas.microsoft.com/cdo/configuration/smtpserver") = serverip  '
        objCDOSYSCon.Fields("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = smtpserverport
        objCDOSYSCon.Fields("http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout") = 10
        objCDOSYSCon.Fields("http://schemas.microsoft.com/cdo/configuration/smtpauthenticate") = 1
        objCDOSYSCon.Fields("http://schemas.microsoft.com/cdo/configuration/sendusername") =server_email
        objCDOSYSCon.Fields("http://schemas.microsoft.com/cdo/configuration/sendpassword") =server_email_pwd
        objCDOSYSCon.Fields.Update
        Set objMail.Configuration = objCDOSYSCon
        ''
        objMail.BodyPart.Charset = "gb2312"
        objMail.From = server_email
        objMail.Subject = title ''
        objMail.To = to_email ''
        objMail.HtmlBody = content
        objMail.Send
        Set objMail = Nothing
        Set objCDOSYSCon = Nothing
end function 
function add(tablename,data)
		Dim i,j,Sql  
		Set rs=Server.CreateObject("ADODB.Recordset")  
		Sql="select top 1 * from ["&tablename&"] where 1=1"  
		rs.open sql,Conn,1,1  
		j=rs.Fields.count  
		
		set rs1=server.createobject("ADODB.Recordset")
		sql1="select top 1 * from "&tablename
		rs1.open sql1,conn,1,3
		rs1.addnew
		For each key In data
			For i=0 to (j-1)  
			  ' Response.Write("第" & i+1 & "个字段名：" & rs.Fields(i).Name & "<br /><br />")  
			   if(key=rs.Fields(i).Name) then
				  rs1(key)=CheckStr(data(key))
			   end if
			Next 
		Next 	
		rs1.update
		rs1.close
		set rs1=nothing
end function
function updata(tablename,data,where)
		Dim i,j,Sql  
		Set rs_=Server.CreateObject("ADODB.Recordset")  
		sql="select top 1 * from ["&tablename&"] where "&where  
		rs_.open sql,conn,1,1  
		j=rs_.Fields.count  
		
		set rs11=server.createobject("ADODB.Recordset")
		sql11="select top 1 * from ["&tablename&"] where "&where  
		rs11.open sql11,conn,1,3
		For each key In data
			For i=0 to (j-1)  
			  ' Response.Write("第" & i+1 & "个字段名：" & rs.Fields(i).Name & "<br /><br />")  
			   if(key=rs_.Fields(i).Name) then
			   'response.Write(key&"<br/>")
			      if(key<>"id") then
				    rs11(key)=CheckStr(data(key))
				  end if
			   end if
			Next 
		Next 	
	   rs11.update
	   rs11.close
	   set rs11=nothing
	   	   rs_.close
	   set rs_=nothing
end function
function GetCs(url1,key1) '获取url上的参数值
dim items,val
    arr=split(url1,"?")
    items=split(arr(1),"&")
	val=""
	for i=0 to ubound(items) 
	   values=split(items(i),"=")
	   if ubound(values)=1  then
		if values(0)=key1 then
		  val=values(1)
		end if
	   end if
	next
 getcs=val
end function 
function CreateDir(dir) '创建文件夹
	 'response.codepage=936  
	 'response.charset="GBK" 
	  set fso = Server.CreateObject("scripting.filesystemobject") 
	  dim p,arr
	  p=""
	  arr=split(dir,"/")
	  for i=0 to ubound(arr)
	  if(arr(i)<>"") then
		  if(p<>"") then
			p=p&"/"&arr(i)
		   else
			p=p&arr(i)
		   end if
		   if(arr(i)<>"..") then
		   If fso.folderexists(Server.MapPath(p)) Then
		   else 
			fso.CreateFolder(Server.MapPath(p))
		   End If 
		   end if
	  end if
		'response.Write(p&"<br/>")
	 next
	 Set fso=nothing 
End Function 
Function GetLocationURL() '获取当前url
	Dim Url
	Dim ServerPort,ServerName,ScriptName,QueryString
	ServerName = Request.ServerVariables("SERVER_NAME")
	ServerPort = Request.ServerVariables("SERVER_PORT")
	ScriptName = Request.ServerVariables("SCRIPT_NAME")
	QueryString = Request.ServerVariables("QUERY_STRING")
	Url="http://"&ServerName
	If ServerPort <> "80" Then Url = Url & ":" & ServerPort
	Url=Url&ScriptName
	If QueryString <>"" Then Url=Url&"?"& QueryString
	GetLocationURL=Url
End Function
'检测文件夹是否存在,不存在则创建FolderPath为文件夹上层目录，CheckFileName要创建的文件夹名称
Function CheckDir(FolderPath,CheckFileName)
	CheckFileName=replace(CheckFileName,".","")
	if instr(FolderPath,":")<1 then FolderPath=Server.MapPath(FolderPath)
	if right(FolderPath,1)<>"/" then FolderPath=FolderPath&"/"
	Set fso1 = CreateObject("Scripting.FileSystemObject")
	If fso1.FolderExists(FolderPath&CheckFileName)=false Then
		fso1.CreateFolder(FolderPath&CheckFileName)
	End If
	Set fso1 = nothing
End Function

Function Check_FoFolderName(filePathstr)
	filePathtop=RootUploadPath
	filePathstr=split(filePathstr,"/")
	for ifile=0 to ubound(filePathstr)
		CheckDir filePathtop,filePathstr(ifile)
		filePathtop=filePathtop&filePathstr(ifile)&"/"
	next
End Function

Function IsObjInstalled(strClassString) '检查iis是否安装有某组件
		On Error Resume Next
		IsObjInstalled = False
		Err = 0
		Dim xTestObj:Set xTestObj = Server.CreateObject(strClassString)
		If 0 = Err Then IsObjInstalled = True
		Set xTestObj = Nothing
		Err = 0
End Function
'由原图片生成指定宽度和高度的缩略图
Function CreateSmall(FileName, Width, Height,GoldenPoint, Rate, ThumbFileName)
	'On Error Resume Next
	Dim strSql, RsSetting, objImage, iWidth, iHeight, strFileExtName
	CreateSmall = False
	If IsNull(FileName) Then'如果原图片未指定直接退出
		Exit Function
	ElseIf FileName = "" Then
		Exit Function
	End If
	If InStr(FileName, ".") <> 0 Then
		'arr=split(lcase(FileName),".")
		 'ext=arr(ubound(arr))
		 'strFileExtName=ext
		strFileExtName = LCase(Trim(Mid(FileName, InStrRev(FileName, ".") + 1)))
	End If
	If strFileExtName <> "jpg" And strFileExtName <> "gif" And strFileExtName <> "bmp" And strFileExtName <> "png" And strFileExtName <> "jpeg" Then '文件不是可用图片则退出
		Exit Function
	End If
	If IsNull(ThumbFileName) Then                          
		Exit Function
	ElseIf ThumbFileName = "" Then
		Exit Function
	End If
	If IsNull(Width) Then                                
		Width = 0
	ElseIf Width = "" Then
		Width = 0
	End If
	If IsNull(Rate) Then                                   
		Rate = 0
	ElseIf Rate = "" Then
		Rate = 0
	End If
	If IsNull(Height) Then                               
		Height = 0
	ElseIf Height = "" Then
		Height = 0
	End If
	If InStr(FileName, ":") = 0 Then      
		FileName = Server.MapPath(FileName)
	End If
	If InStr(ThumbFileName, ":") = 0 Then
		ThumbFileName = Server.MapPath(ThumbFileName)
	End If
	Width = CInt(Width)
	Height = CInt(Height)
	Rate = CSng(Rate)
	
			If Not IsObjInstalled("Persits.Jpeg") Then
				Exit Function
			End If
			Set objImage = Server.CreateObject("Persits.Jpeg")
			objImage.Open FileName
			If Rate = 0 And (Width <> 0 Or Height <> 0) Then
				If Width < objImage.OriginalWidth And Height < objImage.OriginalHeight And Height<>0 Then
					dim qjazhro_h,qjazhro_w,qjazhro_t,qjazhro_hj,qjazhro,mznvhai 
					qjazhro=round((Width/Height),3)
					mznvhai=round((objImage.OriginalWidth/objImage.OriginalHeight),3)
					If qjazhro<mznvhai Then
					objImage.Height = Height
					objImage.Width = round((objImage.OriginalWidth / objImage.OriginalHeight * Height),3)
					qjazhro_w=round(((objImage.Width-Width)/2),3)
					qjazhro_t=Width+qjazhro_w
					objImage.crop qjazhro_w,0,qjazhro_t,Height
				   ElseIf qjazhro>mznvhai Then
					objImage.Width = Width
					objImage.Height = round((objImage.OriginalHeight / objImage.OriginalWidth * Width),3)
					qjazhro_h=objImage.Height-Height
					qjazhro_hj=qjazhro_h*GoldenPoint  'GoldenPoint为黄金分割点，你可以按自己的要求修改这个值
					qjazhro_t=Height+qjazhro_hj
					objImage.crop 0,qjazhro_hj,Width,qjazhro_t
				   ElseIf qjazhro=mznvhai Then
					objImage.Width = Width
					objImage.Height = Height
					End If
				End If
				
				If Height=0 Then      '当高度为0时,自适应高度
				 Height=Width * objImage.OriginalHeight / objImage.OriginalWidth
				 objImage.Height=Height
				 objImage.Width=Width
				End If
				
			ElseIf Rate <> 0 Then
				objImage.Width = objImage.OriginalWidth * Rate
				objImage.Height = objImage.OriginalHeight * Rate
			End If
			objImage.Save ThumbFileName
	CreateSmall = True
End Function
%>