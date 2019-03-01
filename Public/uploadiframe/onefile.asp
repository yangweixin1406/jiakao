<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<!--#include file="include/upload.inc"-->
<%
conf_file_cengci="../" '文件夹层次
conf_file_dir="file/" '文件夹路径

isinsert=0
g_max_size=2
'btsend=request.Form("btsend") 
'response.Write("444="&btsend)
'response.End()
dim upload,file,formName,formPath,iCount,filename,fileExt
set upload=new upload_5xSoft 
'formPath=upload.form("upfile0")
 'set file=upload.file("file1") 
 isbool=1
 tishi=""
return=upload.form("return") 


folder=upload.form("folder")
nameqz=upload.form("nameqz") 
gourl=upload.form("gourl") 

if(folder<>"") then
  conf_file_dir=folder
end if
function getcs(url1,key1)
dim items,val
    items=split(url1,"&")
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

iCount=0
for each formName in upload.file
 set file=upload.file(formName) 
 isbool=1
 tishi=""
 filesize=file.FileSize
 if file.FileSize>0 then  
		 ext=lcase(right(file.filename,4))
		 uploadsuc=false
		 Forum_upload="gif,jpg,png,bmp,jpeg,doc,docx,xslx,xsl"
		 Forumupload=split(Forum_upload,",")
		 for i=0 to ubound(Forumupload)
			if ext="."&trim(Forumupload(i)) then
			uploadsuc=true
			exit for
			else
			uploadsuc=false
			end if
		 next
		 if uploadsuc=false then
			 tishi=","
			 isbool=0
		 end if
		  if file.filesize<0 then
			 tishi= ","
			 isbool=0
		 end if
		 if file.filesize>g_max_size*1024*1024 then
			 tishi= "5"
			 isbool=0
		 end if
           if(isbool=1) then

						  if file.FileSize>0 then         ''如果 FileSize > 0 说明有文件数据
						                  ext=Replace(ext, ".", "", 1, -1, 1)
										  randomize       '产生随机数 一定要记得加这句 不懂百度一下 asp randomize
										  ranNum=int(90000*rnd)+10000
										  nameqz=trim(nameqz)
										  if(nameqz="") then
										  nameqz=year(now)&month(now)&day(now)&hour(now)&minute(now)&second(now)&ranNum
										  end if

										  title=file.filename
										  adddate=trim(now())
										 ' newid=MyNewId(tableQianZhui&"images","id")
										  newid=1 
										  classno="00010001"
										  src=""
										  state=0 '
										  sql="insert into "&tableQianZhui&"images(id,[sort],title,ext,src,filesize,username,classno,adddate,[state]) values("
										  sql=sql&""&newid&","&newid&",'"&title&"','"&ext&"','"&src&"',"&filesize&",'"&username&"','"&classno&"','"&adddate&"',"&state&""
										  sql=sql&")"
										  newname=nameqz&"_"&newid
										  'conn2015.execute(sql)
										  path=conf_file_dir&newname&"."&ext
										  fullpath=conf_file_cengci&path
										  mappath1=Server.mappath(fullpath)
										  response.Write(mappath1)
										   file.SaveAs mappath1   ''
	  
										  if(isinsert) then
											  include("../include/conn2015.asp")
											  include("../include/db.php")
											  conn2015.execute(sql)
										   end if  
										   if(returntype="id") then
											 response.Write("<script>showId('"&path&"','"&newid&"');//window.location='"&gourl&"';</script>")
											
										   else
											 response.Write("<script>showImage('"&path&"','"&newid&"');//window.location='"&gourl&"';</script>")
										   end if
										
						  end if
			 else
			 
			 response.Write("<script>alert('"&tishi&"')</script>")
			 end if
 end if
 set file=nothing
next
set upload=nothing  ''
'next
'response.Redirect("img_iframe.asp?"&url&"&type=add&smallsrc="&pathstr)
response.Write(icount)
%>
