// JavaScript Document
/*
  2016-09-27
  原创:惠聪网络
  原创QQ:632175205
  淘店a:http://91huicong.taobao.com/
  淘店b:https://congweb.taobao.com/
  不懂可以加我qq632175205,下午在线
  电话：13799835338，小聪
  asp .net php各版都有
*/
var g_margin=4;
var g_exts=[];
var g_isshowbar=1;
var g_isfengmian=0;// 1:设为封面
var g_fenge="#";//多张用#分隔开
var g_siteurl="";//当前域名
var g_siteurl_file="";                    //重点，这个最好改一下 显示图片所在的网址 如http://www.hao123.com/file/1.jpg ,则是http://www.hao123.com/
var g_ico_path="";//默认图标所在文件夹 这个是处在上传时显示的默认图标 如jpg.png这个图标是uploadhtml5e/images里那么就要填写成  http://www.hao123.com/uploadhtml5e/images/
var g_moren_bgsrc="";
var g_isfull=0;//是否返回完整的路径
var g_moren_srcs={all:"class4.png",img:"class4.png",yinpin:"class4.png",shipin:"class4.png",file:"class4.png"};
var g_zifu_num=1024*150;//上传字符串长度 字节
var g_isshowsize=1;//显示文件大小
var g_isshowdata=0;//显示返回结果
var g_isdelfile=0; //默认不执行删除空间上的图片
var g_isnewsmall=0;//是否生成小图
var g_isyulan=1;//显示预览图片

var conf_yasuo_image={type:0,width:600,height:700,zhiliang:0.6,max_zijie:1024*200};//type 0为不压缩,1或w为按宽压缩，2或h为按高压缩,zijie 文件大小若超过max_zijie,zhiliang:压缩质量1为最大值 max_zijie:如大小超过这个则压缩
var url2017site="";

var jss=document.scripts;
jss=jss[jss.length-1].src.substring(0,jss[jss.length-1].src.lastIndexOf("/")+1);
var arr2017=jss.split("/"),url2017="";
for(var i=0;i<(arr2017.length-2);i++){ //获取默认图标所在路径
	  url2017+=arr2017[i]+"/";
}
for(var i=0;i<(arr2017.length-4);i++){ //获取当前域名
	  url2017site+=arr2017[i]+"/";
}

if(g_siteurl_file==""){g_siteurl_file=url2017site;}
if(g_siteurl==""){g_siteurl=url2017site; }
if(g_ico_path==""){g_ico_path=url2017+"images/"; }


//Content-Type 对照表
g_exts.push({type:"img",ext:"jpg",contenttype:"image/jpeg",src:"jpg.png"});
g_exts.push({type:"img",ext:"jpeg",contenttype:"image/jpeg",src:"jpg.png"});
g_exts.push({type:"img",ext:"png",contenttype:"image/png",src:"png.png"});
g_exts.push({type:"img",ext:"gif",contenttype:"image/gif",src:"jpg.png"});
g_exts.push({type:"img",ext:"png",contenttype:"image/webp",src:"png.png"});

g_exts.push({type:"yinpin",ext:"mp3",contenttype:"video/mpeg",src:"video.png"});
g_exts.push({type:"yinpin",ext:"mp3",contenttype:"audio/mp3",src:"video.png"});


g_exts.push({type:"shipin",ext:"mp4",contenttype:"video/mp4",src:"mp4.png"});
g_exts.push({type:"shipin",ext:"mov",contenttype:"video/quicktime",src:"video.png"});
g_exts.push({type:"shipin",ext:"wma",contenttype:"audio/x-ms-wma",src:"wma.png"});
g_exts.push({type:"shipin",ext:"wmv",contenttype:"video/x-ms-wmv",src:"wmv.png"});
g_exts.push({type:"shipin",ext:"avi",contenttype:"video/avi",src:"avi.png"});

g_exts.push({type:"file",ext:"xls",contenttype:"application/vnd.ms-excel",src:"xls.png"});
g_exts.push({type:"file",ext:"xlsx",contenttype:"application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",src:"xlsx.png"});
g_exts.push({type:"file",ext:"doc",contenttype:"application/msword",src:"doc.png"});
g_exts.push({type:"file",ext:"docx",contenttype:"application/vnd.openxmlformats-officedocument.wordprocessingml.document",src:"docx.png"});
g_exts.push({type:"file",ext:"zip",contenttype:"application/zip",src:"zip.png"});
g_exts.push({type:"file",ext:"zip",contenttype:"application/x-zip-compressed",src:"zip.png"});
g_exts.push({type:"file",ext:"rar",contenttype:"application/octet-stream",src:"rar.png"});
g_exts.push({type:"file",ext:"txt",contenttype:"text/plain",src:"txt.png"});
g_exts.push({type:"file",ext:"csv",contenttype:"text/plain",src:"csv.png"});
g_exts.push({type:"file",ext:"pdf",contenttype:"application/pdf",src:"pdf.png"});
g_exts.push({type:"file",ext:"cr2",contenttype:"",src:"txt.png"});
g_exts.push({type:"file",ext:"mov",contenttype:"",src:"mov.png"});


var conf={color:"#666666",rel:{bordercolor:"#CCCCCC",bordercolor1:"#FF0000"},bt:{bgcolor:"#f0f0f0",bgcolor1:"#FF0000"},fengmian:{bgcolor:"#f0f0f0",bgcolor1:"#FF0000",color:"#666666",color1:"#FFFFFF"},size:{bgcolor:"#000000",color:"#ffffff"}};