<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>欢迎体验ThinkPHP登陆演示</title>
<style>
*{ font-family:"微软雅黑"}
.table_login{ background-color:#CCC}
.table_login th{ background-color:#CCC}
.table_login td{ background-color:#FFF}
</style>
</head>

<body>
<center>
<form id="form1" name="form1" method="post" action="">
  <table width="100%" border="0" cellspacing="1" cellpadding="10" style="margin-left:auto; margin-right:auto; width:400px; height:200px; position:absolute; left:50%; margin-left:-200px; top:50%; margin-top:-100px;" class="table_login">
    <tr>
      <th colspan="2">后台系统</th>
    </tr>
    <tr>
      <td>用户名：</td>
      <td><input type="text" name="username" id="textfield" /></td>
    </tr>
    <tr>
      <td>密码：</td>
      <td> <input type="text" name="userpwd" id="textfield2" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
	  <input type="reset" name="button2" id="button2" value="重置" />
	  <input type="submit" name="button" id="button" value="登陆" />
        </td>
      </tr>
  </table>
</form>
</center>
</body>

</html>