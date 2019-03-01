// JavaScript Document
function showupload1(opt){
		//g_siteurl_file="../"; //只要不改变这个上传插件的结构，这个参数可以不用填写配置图片所在的站点网址，重点，这个最好改一下 显示图片所在的网址 如http://www.hao123.com/file/1.jpg ,则是http://www.hao123.com/
		//g_ico_path="images/";   //只要不改变这个上传插件的结构，这行就可以去掉，填写重点配置默认显示图标所在的文件夹  如http://www.hao123.com/uploadhtml5e/images/doc.jpg ,则是http://www.hao123.com/uploadhtml5e/images/
		var conf={
				  url:"include/asp/ajax_file.asp",
				  width:80,//按钮宽度
				  height:80,//按钮高度
				  maxnum:9,//只能上传N张
				  isnewsmall:1,//是否生成小图
				  isdelfile:1,//从空间上把图片删除
				  type:"img",//yinpin:仅上传音频文件,shipin:仅上传视频文件,img:仅上传图片,不填或all表示全部
				  bgsrc:"images/class4.png",
				  item_class:"myitem_small_a",
				  wenzi:{see:"查",del:"删"},
				  //btstyle:{date:{"color":"#ffff00"},name:{"color":"#ff0000","bottom":"0px"},see:{"color":"#ff0000","top":"0px","left":"0px","height":"30px","width":"40px","z-index":"2000","position":"absolute","background-color":"#CCCCCC"}},
				  border:0,//边框
				  success_show:{date:0,size:0,name:0,bar:0,baifenbi:0,del:1,bg:0,see:1},//上传完后要显示的元素,1:显示,0不显 date:日期，size大小,name标题,bar进度条,baifenbi百分比,del删除,bg背景,see查看
				  nullstr:""
		   }
		   conf.weizhi_id=opt.input_id+"_weizhi";//按钮位置对像id
		   conf.panel_id=opt.input_id+"_panel";//图片显示对象id
		   for(var k in opt){
			   conf[k]=opt[k];
		   }
		   
           var input= document.getElementById(opt.input_id);
		  // input.style.display="none";
		   var div=document.createElement("div");
div.className="hcfile_kuai";
		   div.innerHTML="<div id=\""+conf.panel_id+"\" style=\"width:auto; float:left;\"></div><div id=\""+conf.weizhi_id+"\" style=\" float:left; width:80px; margin-top:0px;height:80px;\"></div>";
   
		   input.parentNode.appendChild(div);
		   hcfile().Init(conf);
}
function showupload2(opt){
		//g_siteurl_file="../"; //只要不改变这个上传插件的结构，这个参数可以不用填写配置图片所在的站点网址，重点，这个最好改一下 显示图片所在的网址 如http://www.hao123.com/file/1.jpg ,则是http://www.hao123.com/
		//g_ico_path="images/";   //只要不改变这个上传插件的结构，这行就可以去掉，填写重点配置默认显示图标所在的文件夹  如http://www.hao123.com/uploadhtml5e/images/doc.jpg ,则是http://www.hao123.com/uploadhtml5e/images/
		var conf={
				  url:"include/asp/ajax_file.asp",
				  maxnum:10,//只能上传N张
				  isyuanming:1,//1为原名
				  isdelfile:1,//从空间上把图片删除
				  type:"img",//yinpin:仅上传音频文件,shipin:仅上传视频文件,img:仅上传图片,不填或all表示全部
				  input_id:"photos",//存多张图片路径的input的id
				  weizhi_id:"photos_weizhi",//选择按钮位置对像id
				  panel_id:"photos_panel",//图片文件显示对象id
				  input_fengmian_id:'',//存封面的图片路径input对象id
				  bgsrc:"",//按钮图片
				  img_fdsize:1024*150,//每段图片的大小,不能超过空间所允许的大小
				  ischongxuan:0,//1显示重选按钮
				  drop_to_id:"drop_div",//托入有效区域对象id,如填写成document则将整个网页做为有效区域
				  send_id:"send",//确定上传按钮位置对像id,不填写或填写auto则自动上传
				  item_class:"myitem_small", //样式 可以不填写，不填写为显示图片
				  select_num_id:"select_num", //可以不填写，显示当前要上传的文件个数的对象id
				  success_num_id:"success_num", //可以不填写，显示当前要已上传的文件总个数的对象id
				  max_num_id:"max_num", //可以不填写，显示允许上传的个数
				  down_url:"include/php/down.php",//可以不填写，下载的
				  bt_del_text:"删除",
				  upload_show:{date:0,size:0,name:0,bar:1,baifenbi:1,del:0,bg:1},//上传过程中要显示的元素,1:显示,0不显示 date(日期) size(大小) name(标题) bar(进度条) baifenbi(进度条) del(删除按钮)
				  success_show:{date:0,size:0,name:1,bar:0,baifenbi:0,del:1,bg:0,see:1},//上传完后要显示的元素,1:显示,0不显
				  success:function(op){
				      var obj=document.getElementById("num_maxnum");
					  if(obj){
					  if(op.num>0){
					   obj.innerHTML=" "+op.num+"/"+op.maxnum;
					  }else{
					   obj.innerHTML="";
					  }
					  }
				  }
		   }
		   conf.weizhi_id=opt.input_id+"_weizhi";//按钮位置对像id
		   conf.panel_id=opt.input_id+"_panel";//图片显示对象id
		   for(var k in opt){
			   conf[k]=opt[k];
		   }
           var input= document.getElementById(opt.input_id);
		   //input.style.display="none";
		   var div=document.createElement("div");
		   div.className="hcfile_kuai";
	      div.innerHTML="<style></style><div id=\""+conf.weizhi_id+"\"class=\"hcfile_weizhi\">上传图片</div><div id=\""+conf.panel_id+"\" style=\"height:auto; width:auto; float:left; overflow:hidden;\"></div><span  id=\""+opt.input_id+"num_maxnum\" style=\"line-height:50px; font-size:20px;\"></span>";   
		   input.parentNode.appendChild(div);
		   hcfile().Init(conf);
}