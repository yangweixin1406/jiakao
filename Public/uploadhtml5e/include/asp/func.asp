<script runat="server" language="jscript">
        function base64_encode(str){
                var c1, c2, c3;
                var base64EncodeChars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";                
                var i = 0, len= str.length, string = '';

                while (i < len){
                        c1 = str.charCodeAt(i++) & 0xff;
                        if (i == len){
                                string += base64EncodeChars.charAt(c1 >> 2);
                                string += base64EncodeChars.charAt((c1 & 0x3) << 4);
                                string += "==";
                                break;
                        }
                        c2 = str.charCodeAt(i++);
                        if (i == len){
                                string += base64EncodeChars.charAt(c1 >> 2);
                                string += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
                                string += base64EncodeChars.charAt((c2 & 0xF) << 2);
                                string += "=";
                                break;
                        }
                        c3 = str.charCodeAt(i++);
                        string += base64EncodeChars.charAt(c1 >> 2);
                        string += base64EncodeChars.charAt(((c1 & 0x3) << 4) | ((c2 & 0xF0) >> 4));
                        string += base64EncodeChars.charAt(((c2 & 0xF) << 2) | ((c3 & 0xC0) >> 6));
                        string += base64EncodeChars.charAt(c3 & 0x3F)
                }
                        return string
        }
        function base64_decode(str){
		var c1, c2, c3, c4;
				var base64DecodeChars = new Array(
				-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
				-1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1, -1,
				-1, -1, -1, -1, -1, -1, -1, 62, -1, -1, -1, 63, 52, 53, 54, 55, 56, 57,
				58, 59, 60, 61, -1, -1, -1, -1, -1, -1, -1, 0,  1,  2,  3,  4,  5,  6,
				7,  8,  9,  10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24,
				25, -1, -1, -1, -1, -1, -1, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36,
				37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, -1, -1, -1,
				-1, -1
				);
                var i=0, len = str.length, string = '';
                while (i < len){
                        do{
                                c1 = base64DecodeChars[str.charCodeAt(i++) & 0xff]
                        } while (
                                i < len && c1 == -1
                        );

                        if (c1 == -1) break;

                        do{
                                c2 = base64DecodeChars[str.charCodeAt(i++) & 0xff]
                        } while (
                                i < len && c2 == -1
                        );

                        if (c2 == -1) break;

                        string += String.fromCharCode((c1 << 2) | ((c2 & 0x30) >> 4));

                        do{
                                c3 = str.charCodeAt(i++) & 0xff;
                                if (c3 == 61)
                                        return string;

                                c3 = base64DecodeChars[c3]
                        } while (
                                i < len && c3 == -1
                        );

                        if (c3 == -1) break;

                        string += String.fromCharCode(((c2 & 0XF) << 4) | ((c3 & 0x3C) >> 2));

                        do{
                                c4 = str.charCodeAt(i++) & 0xff;
                                if (c4 == 61) return string;
                                c4 = base64DecodeChars[c4]
                        } while (
                                i < len && c4 == -1
                        );

                        if (c4 == -1) break;

                        string += String.fromCharCode(((c3 & 0x03) << 6) | c4)
                }
                return "555"+string;
        }
</script>
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
function DeBase64(base64)
	  Dim xmlstr:xmlstr="<data>"&base64&"</data>"
	  Dim str
	  '使用xml方法生成图片
	  Dim xml : Set xml=Server.CreateObject("MSXML2.DOMDocument")
	  xml.resolveExternals=False
	  xml.loadxml(xmlstr)
	  xml.documentElement.setAttribute "xmlns:dt","urn:schemas-microsoft-com:datatypes"
	  xml.documentElement.dataType = "bin.base64"
	  str=xml.documentElement.nodeTypedValue
	  Set xml=Nothing
	  DeBase64=str


end function
function SaveBase641(fullpath,base64)
Dim objXmlFile,objXmle
Set objXmlFile = Server.CreateObject("Microsoft.XMLDOM")
objXmlFile.loadXML("<r xmlns:dt=""urn:schemas-microsoft-com:datatypes""><e dt:dt=""bin.hex"">"&base64&"</e></r>")
'http://www.dc9.cn 'sipo 2007-4-11制作
Set objXmle=objXmlFile.documentElement.selectSingleNode("e")

	  Dim stm : Set stm=Server.CreateObject("ADODB.Stream")

	  stm.Type=1  'adTypeBinary
	  stm.Open
	  stm.Write objXmle.nodeTypedvalue
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
const BASE_64_MAP_INIT = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/" 
dim newline 
dim Base64EncMap(63)
dim Base64DecMap(127)
dim inp,hu,encode
'call initCodecs '初始化 
'inp = "<WORD处理后的asp代码>" '将要保护的asp代码用WORD处理，然后填在此处 
'hu= base64Encode(inp) '调用函数base64Encode进行加密，得到密文hu 
'Response.Write(hu) '显示密文 
'PUBLIC SUB initCodecs() '初始化函数initCodecs 
'newline = "<P>" & chr(13) & chr(10)
'dim max, idx 
'max = len(BASE_64_MAP_INIT) 
'for idx = 0 to max - 1 
'Base64EncMap(idx) = mid(BASE_64_MAP_INIT, idx + 1, 1) 
'next 
'for idx = 0 to max - 1 
'Base64DecMap(ASC(Base64EncMap(idx))) = idx 
'next 
'END SUB 
PUBLIC FUNCTION base64Encode(plain) '加密函数base64Encode 
if len(plain) = 0 then
base64Encode = ""
exit function
end if
dim ret, ndx, by3, first, second, third
by3 = (len(plain) \ 3) * 3
ndx = 1
do while ndx <= by3
first = asc(mid(plain, ndx+0, 1))
second = asc(mid(plain, ndx+1, 1))
third = asc(mid(plain, ndx+2, 1))
ret = ret & Base64EncMap( (first \ 4) AND 63 )
ret = ret & Base64EncMap( ((first * 16) AND 48) + ((second \ 16) AND 15 ) )
ret = ret & Base64EncMap( ((second * 4) AND 60) + ((third \ 64) AND 3 ) )
ret = ret & Base64EncMap( third AND 63)
ndx = ndx + 3
loop
if by3 < len(plain) then
first = asc(mid(plain, ndx+0, 1))
ret = ret & Base64EncMap( (first \ 4) AND 63 )
if (len(plain) MOD 3 ) = 2 then
second = asc(mid(plain, ndx+1, 1))
ret = ret & Base64EncMap( ((first * 16) AND 48) + ((second \ 16) AND 15 ) )
ret = ret & Base64EncMap( ((second * 4) AND 60) )
else
ret = ret & Base64EncMap( (first * 16) AND 48)
ret = ret '& "="
end if 
ret = ret '& "="
end if
base64Encode = ret
END FUNCTION
    '解密函数base64Decode 
FUNCTION base64Decode(scrambled)
if len(scrambled) = 0 then
base64Decode = ""
exit function
end if
dim realLen
realLen = len(scrambled)
do while mid(scrambled, realLen, 1) = "="
realLen = realLen - 1
loop
dim ret, ndx, by4, first, second, third, fourth
ret = ""
by4 = (realLen \ 4) * 4
ndx = 1
do while ndx <= by4
first = Base64DecMap(asc(mid(scrambled, ndx+0, 1)))
second = Base64DecMap(asc(mid(scrambled, ndx+1, 1)))
third = Base64DecMap(asc(mid(scrambled, ndx+2, 1)))
fourth = Base64DecMap(asc(mid(scrambled, ndx+3, 1)))
ret = ret & chr( ((first * 4) AND 255) + ((second \ 16) AND 3))
ret = ret & chr( ((second * 16) AND 255) + ((third \ 4) AND 15))
ret = ret & chr( ((third * 64) AND 255) + (fourth AND 63))
ndx = ndx + 4
loop
if ndx < realLen then
first = Base64DecMap(asc(mid(scrambled, ndx+0, 1)))
second = Base64DecMap(asc(mid(scrambled, ndx+1, 1)))
ret = ret & chr( ((first * 4) AND 255) + ((second \ 16) AND 3))
if realLen MOD 4 = 3 then
third = Base64DecMap(asc(mid(scrambled,ndx+2,1)))
ret = ret & chr( ((second * 16) AND 255) + ((third \ 4) AND 15))
end if
end if
base64Decode = ret
END FUNCTION
'还原单引号、回车换行函数UnEncode 
function UnEncode(cc)
for i = 1 to len(cc)
if mid(cc,i,1)<> "水" then
if mid(cc,i,1)="加" then
temp = """" & temp
else
temp = Mid(cc, i, 1) + temp
end if
else
temp=newline&temp
end if
next
UnEncode=temp
end function
Function JpgAddShuiYin(src1,logo1,newsrc)

	Set Photo = Server.CreateObject("Persits.Jpeg") 
	PhotoPath = Server.MapPath(src1) 
	Photo.Open PhotoPath 
	Set Logo = Server.CreateObject("Persits.Jpeg") 
'	response.Write(logo1)
	LogoPath = Server.MapPath(logo1)
	Logo.Open LogoPath
'	Logo.Width = 70 
'	Logo.Height = Logo.Width * Logo.OriginalHeight / Logo.OriginalWidth
'	Photo.DrawImage 0, 0, Logo
	
	Photo.Canvas.DrawPNG (Photo.Width-Logo.Width)/2, (Photo.Height-Logo.Height)/2, LogoPath
	Photo.Save Server.MapPath(newsrc)
	Photo.Close
	Set Photo = Nothing
	Logo.Close
	Set Logo = Nothing
	
end function
Function JpgAddText(src1,text,newsrc1)
		Set Jpeg = Server.CreateObject("Persits.Jpeg") 
		PhotoPath = Server.MapPath(src1) 
		Jpeg.Open PhotoPath 
		Jpeg.Quality=97
		'Jpeg.Canvas.Font.Color = &H006699 
		Jpeg.Canvas.Font.Color = &H000000 
		Jpeg.Canvas.Font.Family = "宋体" 
		Jpeg.Canvas.Font.Bold = false 
		Jpeg.Canvas.Font.Size = 20
		Jpeg.Canvas.PrintText 5, 5,text
		Jpeg.Save Server.MapPath(newsrc1)
		Jpeg.Close
		Set Jpeg = Nothing
End function
%>