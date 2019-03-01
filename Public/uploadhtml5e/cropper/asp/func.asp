<%
function SaveBase64(fullpath,base64)
	  Dim xmlstr:xmlstr="<data>"&base64&"</data>"
	  '使用xml方法生成图片
	  Dim xml : Set xml=Server.CreateObject("MSXML2.DOMDocument")
	  Dim stm : Set stm=Server.CreateObject("ADODB.Stream")
	  xml.resolveExternals=False
	  xml.loadxml(xmlstr)
      'response.Write(base64)
	  'response.End()
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
function CreateDir(dir)
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
Function NewRand(n)
   Randomize '纯随机,不重复 
   dim v1,v2
   for i=1 to n 
       v1=v1&"1"
	   v2=v2&"9"
   next
   NewRand=Int((int(v2) * Rnd) + int(v1)) 
End function 
Function NewFileName(nameqz,title,is_yuanming)
   	  now1=now
	  year1=year(now1)
	  month1=month(now1)
	  day1=day(now1)
	  hour1=hour(now1)
	  minute1=minute(now1)
	  second1=second(now1)
	  if(month1<10) then
	   month1="0"&month1 
	  end if
	  if(day1<10) then
	   day1="0"&day1 
	  end if
	  if(hour1<10) then
	    hour1="0"&hour1 
	  end if
	  if(minute1<10) then
	    minute1="0"&minute1 
	  end if
	  if(second1<10) then
	    second1="0"&second1 
	  end if
	  newname=year1&month1&day1&hour1&minute1&second1&NewRand(4)
	  if(is_yuanming=1 and title<>"") then
	    dim arr
	     arr=split(title,".")
		 newn=""
		 if(ubound(arr)>0) then
		    for i=0 to  (ubound(arr)-1)
			  if(newn<>"") then
			    newn=newn&"."&arr(i)
			  else
			    newn=arr(i)
			  end if
			next
		 else
		 newn=title
		 end if
		 newname=newn '文件名称
	  end if
	 if(nameqz<>"") then
	   newname=nameqz&"_"&newname
	 end if
	 NewFileName=newname
End Function 
%>