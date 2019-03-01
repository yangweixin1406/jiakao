<%
'====================================================================
'=                     文件名称：Coon.asp                           =
'=                     摘    要：数据库连接文件                     =
'=                     最后日期：2014-11-18                        =
'====================================================================		
Dim Conn									
Dim FoundErr								
Dim ConnStr
Dim issmallmed
'On Error Resume Next
Dim tableqz:tableqz="tb_" '表前缀
ConnStr="Provider = Microsoft.Jet.OLEDB.4.0;Data Source =" & Server.MapPath(db_qianzhui&"r#y#%$#2016.mdb")&";Jet OLEDB:Database Password="
Set Conn = Server.CreateObject("ADODB.Connection")
Conn.Open ConnStr
If Err Then	
  ConnClose
  Response.CodePage=65001
  Response.Charset="utf-8"
  Response.Write("对不起,数据连接错误")
   Err.Clear
  Response.End
End If
g_max_size=8 '4000为4M
StarTime=Timer()
Function ConnClose
	Conn.Close
	Set Conn = Nothing
End Function
%>

