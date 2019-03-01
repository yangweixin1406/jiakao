<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<% db_qianzhui="" %>
<%


dim index,num,title,total,act,ext
filesize = Request.TotalBytes             'filesize是上传文件的大小
filedata = Request.BinaryRead(filesize)   'filedata是上传文件的二进制数据
PostData = BinaryToString(filedata,filesize) '将二进制流转化成文本
items=split(PostData,chr(13)&chr(10))
title=RequestValue(items,"title")
num=RequestValue(items,"num")
total=RequestValue(items,"total")
ext=RequestValue(items,"ext")
index=RequestValue(items,"index")
tmpid=RequestValue(items,"tmpid")
nameqz=RequestValue(items,"nameqz")
path=RequestValue(items,"path")
isfugai=RequestValue(items,"isfugai")
TmpPath = "tmp/"&tmpid&"_"&index&".tmp"          '保存路径

'--------开始判断文件是否允许上传
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
imgs="gif,jpg,png,bmp,jpeg" '允许文件格式
imgexts=split(imgs,",")
for i=0 to ubound(imgexts)
	if ext=trim(imgexts(i)) then
	is_img=true '是图片
	exit for
	else
	is_img=false '不是图片
	end if
next

if(is_upload=false) then
 response.Write("{""status"":""dengdai"",""index"":"""&index&""",""tmpid"":"""&tmpid&""",""num"":"""&num&""",""ext"":"""&ext&"""}")
 response.End()
end if
'--------结束判断文件是否允许上传

'--------开始保存临时文件
   newline=chrB(13)&chrB(10)                 'newline表示二进制的回车符
   delimiter=leftB(filedata,clng(instrb(filedata,newline))-1)         'delimiter是分隔符
   n1=clng(instrb(filedata,newline))+2         '获取第二部分的开始位置n1
   n2=clng(instrb(n1,filedata,newline))        '获取第二部分中上传文件名行的结束位置n2，即第二个回车符的第一个字符
   filenames=BtoS(midB(filedata,n1,n2-n1))     '获取第二部分中上传文件名行的文本内容
   n3=instrrev(filenames,"\")                  '获取上传文件名的开始位置
   filename=mid(filenames,n3+1,len(filenames)-n3-1)  '获取上传文件名（不含路径）
   '下面开始取得文件内容开始的位置,第四个回车符后的第一个字符 
   beginpos=clng(instrb(n2+1,filedata,newline))  '获取第三个回车符的第一个字符位置
   beginpos=clng(instrb(beginpos+1,filedata,newline))+1   '获取文件内容第一个字符之前的位置
   
   '取得文件内容结束的位置,第二个分隔符"delimiter"开始的前一个二进制字符  
   endpos=clng(instrb(lenb(delimiter),filedata,delimiter))-3  '获取文件内容中最后一个字符的位置
   set str_c=server.CreateObject("ADODB.Stream")   '创建一个ADODB.Stream对象，str_c为源数据流  
   str_c.Mode=3   '设置打开模式，3为可读可写  
   str_c.Type=1   '设置数据类型，1为二进制数据  
   str_c.Open     '打开对像
   set  desc=server.CreateObject("ADODB.Stream")   '创建一个ADODB.Stream对象，desc为目标数据流  
   desc.Mode=3    
   Desc.Type=1    
   desc.Open  

   str_c.Write filedata                '将指定的二进制数据流装入对像str_c中  
   str_c.position=beginpos             'position指出文件的开始位置  
   str_c.copyto  desc,endpos-beginpos  'endpos-beginpos是文件的长度
   desc.SaveToFile Server.MapPath(TmpPath),2          '以SaveFile指定的路径及名称保存文件  
 
   '完成后，应关闭并释放STEAM对象
   Desc.Close    
   Set desc=nothing  
   str_c.Close    
   Set str_c=nothing  
'--------结束保存临时文件  


if(index<>total)then
	 response.Write("{""status"":""dengdai"",""index"":"""&index&""",""tmpid"":"""&tmpid&""",""num"":"""&num&"""}")
	 response.End()
end if


'--------开始合并生成文件
 if(index=total)then
   redim fname(cint(total)),fstr(cint(total))
    Set fs = Server.CreateObject("Scripting.FileSystemObject") 
	for i=1 to total
	fullpath1=server.MapPath("tmp/"&tmpid&"_"&i&".tmp") 
		   If   fs.FileExists(fullpath1)   Then 
				  set stm2 =server.createobject("ADODB.Stream") 
				  stm2.Mode = 3 '可读写 
				  stm2.type=1    '按二进制来
				  stm2.Open 
				  stm2.LoadFromFile fullpath1
				  s=stm2.size
				  'tmpstr=tmpstr&stm2.read '二进制的话就不能用这样方式的,应先放到数组里 二进制跟字符串是不同概
				  'stm2.copyto Desc
				  fstr((i-1))=stm2.read
				  stm2.close
				  set stm2=nothing
				  fs.deleteFile(fullpath1)
		   end if
	next
	set fs=nothing
	
	file_path=""
    
   if is_upload=true then 
   'response.Write(path)
     'response.End()
        if(isfugai=1) then  '覆盖原来的
				g_cengci="../../"
				big_src=path
				small_src=big_src
				mid_src=big_src
				big_fullpath=g_cengci&big_src
				if(FileIsExist(big_fullpath)) then
				  call  SaveBytesToFile(fstr,big_fullpath)
				else
				 response.Write("{""status"":""not file""}")
				 response.End()
				end if
	    else           '生成新路径
				g_cengci="../../"   
				g_dir_other="new/" '文件夹

                 newname=ShengNewName()&NewRnd(4)
				big_src=g_dir_other&newname&"."&ext
				small_src=big_src
				mid_src=big_src
				big_fullpath=g_cengci&big_src
				call  SaveBytesToFile(fstr,big_fullpath)
		
		end if
		
		status="success"
		msg="后端程序文件上传成功"
		file_path=big_src
   else 
	msg="后端程序不允许上传."&ext&"文件"
	status="error"
   end if
   

   status="success"
   response.Write("{""status"":"""&status&""",""error"":"""&error_str&""",""filepath"":"""&file_path&""",""small_src"":"""&small_src&""",""mid_src"":"""&mid_src&""",""big_src"":"""&big_src&""",""ext"":"""&ext&""",""cengci"":"""&g_cengci&""",""date"":"""&now()&""",""path"":"""&path&"""}")
   response.End()
end if
'--------结束合并生成文件

Function ShengNewName()
	  now1=now
	  year1=year(now1)
	  month1=month(now1)
	  day1=day(now1)
	  hour1=hour(now1)
	  minute1=minute(now1)
	  second1=second(now1)  
	  if(month1<10) then month1="0"&month1  end if
	  if(day1<10) then   day1="0"&day1end end if 
	  if(hour1<10) then  hour1="0"&hour1end end if 
	  if(minute1<10) then  minute1="0"&minute1  end if
	  if(second1<10) then second1="0"&second1end end if 
	  v=year1&month1&day1&hour1&minute1&second1
	 ShengNewName=v
End function
Function  NewRnd(n)
 RANDOMIZE
 dim v
 for i=1 to n 
v=v&CStr(cint(9*Rnd))
next
NewRnd=v
End function 
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
	  newname=year1&month1&day1&hour1&minute1&second1
	  if(is_yuanming=1 and title<>"") then
		 newname=title '文件名称
	  end if
	 if(nameqz<>"") then
	   newname=nameqz&"_"&newname
	 end if
	 NewFileName=newname
End Function 
Function SaveBytesToFile(arr,path)
   set  desc=server.CreateObject("ADODB.Stream")   '创建一个ADODB.Stream对象，desc为目标数据流  
   desc.Mode=3    
   Desc.Type=1    
   desc.Open 
   for n=0 to cint(total)-1
     desc.write arr(n)
   next
   desc.SaveToFile server.MapPath(path),2  
   Desc.Close    
   Set desc=nothing 
End Function
   	 
Function RequestValue(arr,filed)
   dim val
   val=""
   for i=0 to ubound(arr) 
      ii=i+2
     if  instr(arr(i),"Content-Disposition: form-data; name="""&filed&"""")>0 then
	     if(ii<=ubound(arr)) then
	       val=arr(ii)
		 end if
	 end if
   next 
   RequestValue=val
End function 
Function BinaryToString(biData,Size)
	Const adLongVarChar = 201
	Set RS = createObject("ADODB.Recordset")
	RS.Fields.Append "mBinary", adLongVarChar,Size
	RS.Open
	RS.AddNew
	RS("mBinary").AppendChunk(biData)
	RS.update
	BinaryToString = RS("mBinary").Value
	RS.Close
End Function
Function FileIsExist(fullpath)
    Set fs=Server.CreateObject("Scripting.FileSystemObject")
    If fs.FileExists(server.MapPath(fullpath)) Then   '判断文件是否存在
	set fs=nothing
     FileIsExist=true
   else 
   set fs=nothing
     FileIsExist=false
   end if
  
End Function 
'http://zhidao.baidu.com/link?url=ejyfA7_BqMINqC1Qt1rPpWsRt9HYv3Dz_Vlj_Fh-qeK8Sc4I1egN26iFZd_TrjL04VArfdBIJ0luR000gWZtpSNoMXgPFLApXvh2Pzbmx1W
'http://blog.sina.com.cn/s/blog_62c1dc5f01014uqd.html
%>

