<!--#include file="upload.inc"-->
<!--#include file="../admin1/fs_conn.asp"-->
<html>
<head>
<title>�ļ��ϴ�</title>
</head>
<body>
<script type="text/javascript" src="regain_image_list1.js"></script>
<%
dim upload,file,formName,formPath,iCount,filename,fileExt
set upload=new upload_5xSoft ''�����ϴ�����
 formPath=upload.form("filepath")
 ''��Ŀ¼���(/)
 file_size=2000 '2000Ϊ2M
 if right(formPath,1)<>"/" then formPath=formPath&"/" 
response.write "<body>"
iCount=0
for each formName in upload.file ''�г������ϴ��˵��ļ�
 set file=upload.file(formName)  ''����һ���ļ�����
 if file.filesize<file_size then
     response.write "<font style='font-height:12px;' ><font style='font-height:12px;color:red;' >��ѡ����Ҫ�ϴ����ļ�</font>��[ <a href=# onclick=history.go(-1)>�����ϴ�</a> ]</font>"
	 
    response.end
 end if
     
 if file.filesize>file_size*1000 then
     response.write "<font style='font-height:12px;' >�ļ���С����������"&file_size/1000&"M</font>��[ <a href=# onclick=history.go(-1)>�����ϴ�</a> ]</font>"
    response.end
 end if
 fileExt=lcase(right(file.filename,4))
 uploadsuc=false
Forum_upload="gif,jpg,png"
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
     response.write "�ļ���ʽ����ȷ��[ <a href=# onclick=history.go(-1)>�����ϴ�</a> ]"
    response.end
 end if
 randomize
 ranNum=int(90000*rnd)+10000
 name1=year(now)&month(now)&day(now)&hour(now)&minute(now)&second(now)&ranNum&fileExt
 filename=formPath&name1
 if file.FileSize>0 then         ''��� FileSize > 0 ˵�����ļ�����
  file.SaveAs Server.mappath(filename)   ''�����ļ�
  session("pic")=name1
    '����ͼ��ʼ���ɣ���������������ͼ
	small_image="../product/smallimages/"&name1
	mediumimages="../product/mediumimages/"&name1
	session("pic")=""
	if(is_small_image=1) then
		Set Jpeg = Server.CreateObject("Persits.Jpeg")
		Path = Server.MapPath(filename)
		Jpeg.Open Path
			Pp=FormatNumber(Jpeg.Height/Jpeg.Width,10) '//����� 
			Pp1=FormatNumber(Jpeg.Width/Jpeg.Height,0) '//����� 
			Jpeg.Height =208
			Jpeg.Width =FormatNumber((Jpeg.Height)/Pp,0)
			'small_image="/pro_images/small_"&str
			Jpeg.Save Server.MapPath(small_image)
			Jpeg.Width =400
			Jpeg.Height =FormatNumber((Jpeg.Width)/Pp1,0)
			'small_image="/pro_images/small_"&str
			Jpeg.Save Server.MapPath(mediumimages)
	else
		file.SaveAs Server.mappath(small_image)
		file.SaveAs Server.mappath(mediumimages)
	end if
    '����ͼ���ɽ���
	piccontent=""
    for i=0 to ubound(Forumupload)

 if fileEXT="."&trim(Forumupload(i)) then
   piccontent=piccontent&name1&"#"
id1=session("id")
response.write "<script>parent.myform.small_image1.value+='"&piccontent&"'</script>"
set rs=conn.execute("select small_image from products where id="&id1)

conn.execute("update products set small_image='"&rs("small_image")&name1&"#' where id="&id1)

response.write "<script>regain_image_list1("&id1&",1)</script>"

        exit for
  end if
    next
 iCount=iCount+1
 end if
 set file=nothing
next
set upload=nothing  ''ɾ���˶���
Htmend iCount&" ���ļ��ϴ�����!"
sub HtmEnd(Msg)
 set upload=nothing
 response.write "<font style='font-szie:12px;'>�ϴ��ɹ�[ <a href=# onclick=history.go(-1)>�����ϴ�</a>]</font>"
 response.end
end sub
%>

</body>
</html>