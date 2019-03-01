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
%>