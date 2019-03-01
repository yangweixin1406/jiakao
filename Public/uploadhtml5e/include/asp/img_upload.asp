<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<% db_qianzhui="" %>
<!--#include file="conn2015.asp"-->
<!--#include file="func.asp"-->
<!--#include file="upload.inc"-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<style>
.parent_bt{position:absolute; top:0px; left:0px; line-height:100px;width:100px; height:100px; text-align:center; cursor:pointer; }
.parent_bt.on{ color:#666;}
*{ outline:none;-moz-outline-style: none;-webkit-outline-style: none;outline-style: none;blr:e-xpression(this.onFocus=this.close());} /* 针对IE */
form *{ cursor:pointer;}
body,html{ padding:0px; margin:0px; background-color:#FFF; background-color:#F9C}
</style>

</head>

<body>
<%
imgsrc=""

	'http://zhidao.baidu.com/link?url=55VcmhPOlB0XGPt6s_8ATPwCOfH_hXUXYbGiz9tHps1H4ANr8bO6CESk1Zbg0M-cZD-ncD3ojNMkxXt9uqk6rK
	yy=0

dim upload,file,formName,formPath,iCount,filename,fileExt
set upload=new upload_5xSoft ''建立上传对象
'formPath=upload.form("upfile0")
 'set file=upload.file("file1") 
 isbool=1
 tishi=""
url=upload.form("other")

dir1=upload.form("dir1") '小图路径
dir2=upload.form("dir2") '中图路径
dir3=upload.form("dir3") '大图路径
cengci=upload.form("cengci") '层次
 nameqz=upload.form("nameqz") 
if(cengci="") then
 cengci="../../"
end if
w1=upload.form("w1")
w2=upload.form("w2")
input_type=upload.form("input_type")

items=split(url,"&")
duozhang="0"
for i=0 to ubound(items) 
   values=split(items(i),"=")
   if ubound(values)=1  then
    if values(0)="imgclass" then
	imgclass=values(1)
	end if
    if values(0)="duozhang" then
	duozhang=values(1)
	end if
   end if
next

iCount=0
for each formName in upload.file
 set file=upload.file(formName) 
 isbool=1
 tishi=""
 filesize=file.FileSize
 if file.FileSize>0 then  
		'ext=lcase(right(file.filename,4))
		 uploadsuc=false
		 Forum_upload="gif,jpg,png,bmp,jpeg,doc,docx,xslx,xsl"
		 Forumupload=split(Forum_upload,",")
		 arr=split(lcase(file.filename),".")
		 ext=ubound(arr)
		 for i=0 to ubound(Forumupload)
			if ext=trim(Forumupload(i)) then
			uploadsuc=true
			exit for
			else
			uploadsuc=false
			end if
		 next
		 if uploadsuc=false then
			 tishi="文件格式不正,重新上传"
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
						                  'ext=Replace(ext, ".", "", 1, -1, 1)
										  randomize       '产生随机数 一定要记得加这句 不懂百度一下 asp randomize
										  ranNum=int(90000*rnd)+10000
										  nameqz=trim(nameqz)
										  if(nameqz="") then
										  nameqz=year(now)&month(now)&day(now)&hour(now)&minute(now)&second(now)&ranNum
										  end if
                                          newid=1

										  
										  'fulltmp_path=cengci&dir3&newName&ext
										  '保存记录到access数据库中
										  title=""
										  arr=split(file.filename,".")
										  for i=0 to ubound(arr)-1 
										     if(title<>"") then
											   title=title&"."&arr(i)
											 else
											   title=arr(i)
											 end if
										  next

										  'conn2015.execute(sql)
										  if(ext="gif" or ext="jpg" or ext="png" or ext="bmp" or ext="jpeg") then
													temp_path=dir3&"77777."&ext
													mappath1=Server.mappath(cengci&temp_path)
													file.SaveAs mappath1   ''保存文件
													dim fs,f
													set fs=Server.CreateObject("Scripting.FileSystemObject")
													set f=fs.GetFile(mappath1)
													Set Jpeg = Server.CreateObject("Persits.Jpeg")
													Jpeg.Open mappath1
													bilv=FormatNumber(Jpeg.Width/Jpeg.Height,6)
													Jpeg.Close
													Set Jpeg = Nothing
													'bilv=FormatNumber(bilv,4,-1)
													
													newname=nameqz&"_"&newid&"_"&bilv   
													if (dir1=dir2) and (dir2=dir3) then
															small_src=dir1&newname&"."&ext
															mid_src=dir2&newname&"."&ext&"."&ext
															big_src=dir3&newname&"."&ext&"."&ext&"."&ext
															filename=newname&"."&ext&"."&ext&"."&ext
													else
															small_src=dir1&newname&"."&ext
															mid_src=dir2&newname&"."&ext
															big_src=dir3&newname&"."&ext
															filename=newname&"."&ext
													end if
													
													big_fullpath=cengci&big_src '大图路径
													mid_fullpath=cengci&mid_src '中图路径
													small_fullpath=cengci&small_src '小图路径

													f.Name=filename  '重命名
													'conn2015.execute("update "&tableQianZhui&"images set src='"&smallsrc&"' where id="&newid)
													if(is_small) then
													call SavePhoto(big_fullpath,small_fullpath,w1)'生成小图
													end if
													if(is_mid)then
													 call SavePhoto(big_fullpath,mid_fullpath,w2)'生成中图
													end if
												   pathstr=big_src '返回路径
												   if(input_type="小图") then
													pathstr=small_src
												   end if
												   if(input_type="中图") then
													pathstr=mid_src
												   end if
												   if(input_type="大图") then
													pathstr=big_src
												   end if
										end if
										if(ext="doc" or ext="docx" or ext="xsl" or ext="xslx") then
										            newname=title&"_"&year(now)&month(now)&day(now) '文件名称
										            file_path=g_dir&newname&"."&ext
										 			file_fullpath=cengci&file_path
													mappath1=Server.mappath(file_fullpath)
													file.SaveAs mappath1   ''保存文件
													pathstr=file_path
										end if
										
										  adddate=trim(now())
										 ' newid=MyNewId(tableQianZhui&"images","id")
										  classno="00010001"
										  src=""
										  state=0 '表示未被使用
										  sql="insert into "&tableQianZhui&"images(id,[sort],title,ext,src,filesize,username,classno,adddate,[state]) values("
										  sql=sql&""&newid&","&newid&",'"&title&"','"&ext&"','"&pathstr&"',"&filesize&",'"&username&"','"&classno&"','"&adddate&"',"&state&""
										  sql=sql&")"
										
						  end if
			 else
			 
			 response.Write("<script>alert('"&tishi&"')</script>")
			 end if
 end if
 set file=nothing
next
set upload=nothing  ''删除此对象
'next
response.Redirect("img_iframe.asp?"&url&"&type=add&smallsrc="&pathstr)

%>
</body>
</html>
