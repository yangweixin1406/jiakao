<%
'====================================================================
'=                     文件名称：Coon.asp                           =
'=                     摘    要：数据库连接文件                     =
'=                     最后日期：2014-11-18                        =
'====================================================================		
Dim Conn2015									
Dim FoundErr								
Dim ConnStr2015
'On Error Resume Next
Dim tableQianZhui:tableQianZhui="201504_"
Dim pathname1:pathname1="s80" '小图文件夹名
Dim pathname2:pathname2="s50" '中图
Dim pathname3:pathname3="s100" '原图
ConnStr2015="Provider = Microsoft.Jet.OLEDB.4.0;Data Source =" & Server.MapPath(db_qianzhui&"r#y#%$#2015.mdb")&";Jet OLEDB:Database Password="
Set Conn2015 = Server.CreateObject("ADODB.Connection")
Conn2015.Open ConnStr2015
If Err Then	
  ConnClose2015 

  Response.CodePage=65001
  Response.Charset="utf-8"
  Response.Write("对不起,数据连接错误")
   Err.Clear
  Response.End
End If
StarTime=Timer()
Function ConnClose2015
	Conn2015.Close
	Set Conn2015 = Nothing
End Function
%>

