<%
    g_is_insert=0
 	g_is_small=1 '是否生成小图  注意生成小图空间或服务器要安装aspjpeg组件,才能生成
	g_is_mid=1 '是否生成中图  注意生成小图空间或服务器要安装aspjpeg组件,才能生成
	g_is_yuanming=0
	g_is_jiequ=0
	g_dir1="file/photo/"'小图文件夹
	g_dir2="file/photo/"'中图文件夹
	g_dir3="file/photo/"'大图文件夹
	g_dir_mp4="file/"'mpw4视频文件夹
	g_dir_swf="file/"'flash视频文件夹
	g_dir_mov="file/"'mov视频文件夹
	g_dir_other="file/data/" '文件夹
	g_cengci="../../../"
	g_w1=200 '小图宽
	g_w2=400 '中图宽
	g_h1=200 '小图高
	g_h2=400 '中图高
	g_fenge="#"
	g_max_size=8
%>