<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title des="原创QQ632175205 网店https://shop73462995.taobao.com">调用例子</title>
<style>
.item{ width:100%; height:auto; float:none; clear:both;}
.user_logo{ height:100px; width:100px; position:relative; border:solid 1px #CCC;}
.user_logo iframe{ position:absolute; top:20px; left:20px;}
.user_logo img{ width:100%;}
.alert{border: solid 1px #CCC; position:absolute; top:50%;left:50%;}
.alert .alert_title{ background-color:#CCC; height:30px;  line-height:30px; text-align:center; color:#999;}
.alert .alert_con{ text-align:center;}

.
</style>

<link rel="stylesheet" type="text/css" href="hc_style.css">
<script src="hc_js.js"></script>
</head>

<body>
 <div class="item">
  <h1>调用方式1</h1>
 <table><tr><td><span id="photo_div"></span><iframe src="one.asp?inputid=photo&bttext=1&qzimg=../&isduoxuan=1" scrolling="no" style="height:30px;width:80px;border:0px;margin-left:2px;" frameborder="0px" allowtransparency="true"></iframe></td><td><input name="photo" id="photo" type="text"  value=""  ondblclick="OpenImage(this)"/></td></tr></table>
  </div>
  
 <h1>调用方式2</h1>
 <table><tr><td><iframe src="one.asp?func=update_photo&inputid=photoa&bttext=1&qzimg=../&textalign=left&btfontsize=20&isduoxuan=1" scrolling="no" style="height:60px;width:300px;border:0px;" frameborder="0px" allowtransparency="true"></iframe></td><td><input name="photoa" id="photoa" type="text"  value="file/20174/2017492172518630.jpg"  ondblclick="OpenImage(this)"/><div id="photoa_div"></div></td></tr></table>
  </div>
  
  <h1>调用方式3</h1>
 <table><tr><td ><iframe src="one.asp?inputid=photo1&bttext=1&qzimg=../&textalign=center&type=small" scrolling="no" style="height:40px;width:300px;border:0px;" frameborder="0px" allowtransparency="true"></iframe></td><td><input name="photo1" id="photo1" type="text"  value=""  ondblclick="OpenImage(this)"/><div id="photo1_div"></div></td></tr></table>
   <h1>调用方式4:回调显示图片</h1>
 <table><tr><td><iframe src="one.asp?func=update_photo&inputid=photo2&bttext=0&qzimg=../&textalign=center&bgsrc=images/1.jpg&bgsrc1=images/11.jpg" scrolling="no" style="height:27px;width:58px;border:0px;" frameborder="0px" allowtransparency="true"></iframe></td><td><input name="photo2" id="photo2" type="text"  value=""  ondblclick="OpenImage(this)"/><div id="photo2_div"></div></td></tr></table>
 <h1>调用方式5:上传后显示logo</h1>
  <table><tr><td><div class="user_logo"><div id="smallimage_div" class="img"></div><iframe src="one.asp?folder=file/photo/&inputid=smallimage&bgsrc=images/1.jpg&bgsrc1=images/11.jpg" scrolling="no" style="height:60px;width:60px;border:0px;" frameborder="0px" allowtransparency="true"></iframe></div></td><td><input name="smallimage" id="smallimage" type="text"  value=""  ondblclick="OpenImage(this)"/></td></tr></table>
 </div>
 </body>
<script>

</script>
</html>
