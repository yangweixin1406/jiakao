<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="target-densitydpi=medium-dpi,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>上传demo</title>
<style>
*{ font-family:"微软雅黑";}
.canyu{ padding:20px; margin-bottom:40px;}
body,html,form{ margin:0px; padding:0px;}
</style>
</head>

<body>
  <div style="padding:50px;">
   <table style=" margin-top:50px; width:100%;" cellpadding="10px;">
    <tr><td style="text-align:center">请上传图片</td></tr>
    <tr>
    <td style="text-align:center"><input type="text" style="width:100%;" value="" id="SmallImage"/><input type="text" style="width:100%;" id="ImageList" value="file/s50/2015051622120715269_1_0.6667.jpg#file/s50/2015051622121691446_1_1.jpg"/></td></tr>
    <tr><td style="text-align:center;"><iframe src="upload/asp/img_iframe.asp?panel_id=my_show&input_only_id=SmallImage&input_more_id=ImageList" scrolling="no" frameborder="0" height="80" width="80" style="margin:5px;"></iframe></td></tr>
    <tr><td><table style="margin-left:auto; margin-right:auto; width:auto;" align="center"><tr><td><div id="my_show" style="float:left;"></div></td></tr></table></td></tr>
   </table>
 </div>
</body>
</html>