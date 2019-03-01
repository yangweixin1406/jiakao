<%@LANGUAGE="VBSCRIPT" CODEPAGE="65001"%>
<% db_qianzhui="" %>
<!--#include file="conn2015.asp"-->
<!--#include file="func.asp"-->
<!--#include file="checksql.asp"-->
<%
g_cengci="../../"
'picture=(request("data")) '将图片base64编码的字符串
act=trim(request("act"))
if(act="up") then
      w1=trim(request("w1"))
	  w2=trim(request("w2"))
	   dir1=trim(request("dir1"))
	  dir2=trim(request("dir2"))
	  dir3=trim(request("dir3"))
	  base64=""
	  num = cint(Request("num") )    
	  ext=trim(request("ext"))
	  title=trim(request("title"))
	  filesize=trim(request("size"))
	  fileName=trim(request("fileName"))
	  bilv=trim(request("bilv"))
	  dir=trim(request("dir"))
	  tablename=trim(request("tablename"))
	  Yishoufangid=trim(request("Yishoufangid"))
	  aspjpeg=trim(request("aspjpeg"))
	  if(fileName="" and title<>"" and isnumeric(filesize) and isnumeric(bilv)) then  '头一次的
		 ranNum=int(90000*rnd)+10000
		 bilv=FormatNumber(bilv,4,-1)
		 newName=year(now)&month(now)&day(now)&hour(now)&minute(now)&second(now)&ranNum
         newId=MyNewId(tableQianZhui&"images","id")
		 newName=newName&"_"&newid&"_"&bilv        '名称格式：数字+images表id+图片宽高比率 例214111111_2_0.2.jpg
		 fileName=newName&"."&ext
		 src=dir&fileName
		 adddate=trim(now())
		 username=session("username")
		 title=CheckStr(title)
		 classno="00010001" '图片分类编码
		 sql="insert into "&tableQianZhui&"images(id,[sort],title,ext,src,filesize,username,classno,adddate) values("
		 sql=sql&""&newid&","&newid&",'"&title&"','"&ext&"','"&src&"',"&filesize&",'"&username&"','"&classno&"','"&adddate&"'"
		 sql=sql&")"
		 'conn2015.execute(sql)
		 'response.Write(sql)
	  end if
	  For i=1 To num   
	  value1=trim(Request("value"&i))
	  value1 = Replace(value1, "[jh]", "+", 1, -1, 0) 
	  base64 = base64 & (value1)   
	  Next 
	  arr_=split(fileName,".")
	  ext_=arr_(ubound(arr_))
	  pathstr=""
	  
	  if(ext_="bmp" or ext_="jpg" or ext_="png" or ext_="gif") then
	  if(base64<>"") then
	     
				 fullpath3=g_cengci&dir3&fileName '大图路径
				 fullpath2=g_cengci&dir2&fileName '中图路径
				 fullpath1=g_cengci&dir1&fileName '小图路径
				 'response.Write(Server.MapPath(fullpath3))
				' response.End()
				 call SaveBase64(fullpath3,base64) '这些是旧ie浏览器用的
				 call SavePhoto(fullpath3,fullpath1,w1)
				 call SavePhoto(fullpath3,fullpath2,w2)
				 pathstr=dir1&fileName
	 end if
	 end if
		response.Write(pathstr)

end if
if(act="del") then
        path1=trim(request("path1"))
		path2=trim(request("path2"))
		path3=trim(request("path3"))
	    call DelPhoto(g_cengci&path1,g_cengci&path2,g_cengci&path3)
		
end if


ConnClose2015()
%>

