// JavaScript Document
$(function(){
	window.setTimeout(function(){
	var curnav_height=$(".curnav").height();
	$(".curnav .amenu,.curnav_a .amenu_a").click(function(){
				var h=$(window).height();
		var w=$(window).width();
		h="100%";
		w="100%";
		var body=document.getElementsByTagName("body")[0];
		var caidanabs=document.createElement("div");
		caidanabs.className="caidanabs";
		$(caidanabs).css({width:"100%",height:h,"overflow":"hidden","position":"fixed","left":"0px","top":"0px","z-index":"30000"});
		var caidan=document.createElement("div");
		
		body.appendChild(caidanabs);

		
		var caidanbg=document.createElement("div");
		caidanbg.className="caidanbg";
		
		caidanabs.appendChild(caidanbg);
		$(caidanbg).css({width:w,height:h});
		//caidan.id="caidan";
		caidan.className="caidan";
		var width=120;

		$(caidan).css({width:width+"px",height:h});
		
		var caidanleft=document.createElement("div");
		caidanleft.className="caidanleft";
		caidanabs.appendChild(caidanleft);
		
		$(caidanleft).css({width:$(window).width()-width+"px",height:h,"position":"absolute","left":"0px","top":"0px","z-index":"30002","44background-color":"#00CC99"});
		
		caidanabs.appendChild(caidan);
		caidanabs.appendChild(caidanleft);
		var caidan_rel=document.createElement("div");
		caidan_rel=document.createElement("div");
		caidan_rel.style.height=h;
		caidan_rel.className="rel";
		caidan.appendChild(caidan_rel);
		
		var caidan_rel_con=document.createElement("div");
		caidan_rel_con=document.createElement("div");
		caidan_rel_con.className="con";
		caidan_rel.appendChild(caidan_rel_con);
		
		var caidan_rel_con_inner=document.createElement("div");
		caidan_rel_con_inner=document.createElement("div");
		caidan_rel_con_inner.className="inner";
		caidan_rel_con.appendChild(caidan_rel_con_inner);
		//$(caidan_rel_con).css({height:$(window).height()+"px"});
		
		var metop=document.createElement("div");
		metop.className="metop";
		metop.style.height="120px";
		metop.innerHTML='<div class="metop_touxiang"><div><i><span></span></i></div></div>';
		if(usertx!=""){
		   metop.childNodes[0].innerHTML="<img src=\""+conf.root+"/"+usertx+"\"/>";
		}
		caidan_rel_con_inner.appendChild(metop);
		var str="";
		var username_str=username;
		if(username==""){
			username_str="未登录";
		}
		str+="<h1 class='username'>"+username_str+"</h1>";
		str+="<ul>";
		if(username!=""){
		  str+="<li class='liclose'><a  class='closelogin'>退出帐号</a></li>";
		}
		if(g_isapp){
		  str+="<li><a onclick='javascript:uexWidgetOne.exit();'>关闭APP</a></li>";
		}
		str+="<li><a href='"+conf.app+"'>首页</a></li>";
		str+="<li class='li_favorites'><a href='"+conf.app+"/"+conf.module+"/favorites/lists"+"'>我的收藏</a></li>";
		str+="<li class='li_examerror'><a href='"+conf.app+"/"+conf.module+"/answer/lists"+"'>我的错题</a></li>";
	    str+="<li class='li_info'><a href='"+conf.app+"/"+conf.module+"/user/my"+"'>我的资料</a></li>";
		str+="<li class='li_pwd'><a href='"+conf.app+"/"+conf.module+"/user/pwd"+"'>修改密码</a></li>";

		str+="</ul>";
		//str+="<div style='position:absolute;bottom:0px;left:0px;width:100%;color:#1BBC9B;text-align:center;font-size:15px;'><div style='padding:10px; line-height:25px;'>联系电话<br>137000000<br/>联系扣扣<br/>632175205</div></div>";
		 $(caidan_rel_con_inner).append(str);
		 $(caidan_rel_con_inner).find(".li_contact").click(function(){

		    var ajaxurl=conf.app+"/"+conf.module+"/index/contact";

			 $.ajax({
				 type:"post",
				 url:ajaxurl,
				 dataType:"text",
				 success:function(data){
					  //alert(data);
					   data=eval("("+data+")");
					 $(caidanleft).html("<div style='padding:10px;'>"+tohtml(data.content)+"</div>");
					 $(caidanleft).css({"color":"#FFFFFF","font-size":"15px"}).find("*").css({"color":"#F5F5F5","font-size":"15px"});
					 var ps=$(caidanleft).find("p");
					 ps.css({"border-left":"solid 2px #F90","padding":"10px","background-color":"#666666"});
					 //ps.hide();
					 //ps.each(function(i){
						 //var p=$(this);
						 // window.setTimeout(function(){p.show();},100*i);
					 //})
					// $(selector).animate({params},speed,callback);
					 $(caidanleft).find("div").eq(0).click(function(event){
						 event.stopPropagation();
					 })
					 
				 }
			 })
		 })

		 $(caidan_rel_con).find(".closelogin").click(function(){
			 if(confirm("确定要退出帐号？")){
			$(caidan_rel_con).animate({"right":-width+"px"},function(){
				$(caidanabs).remove();
				 window.location=conf.app+"/home/user/login";
			});
				
			 }
		 });

        $(caidan_rel_con).css({"right":-width+"px","opacity":0.9,width:width+"px",height:h});
		$(caidan_rel_con).animate({"right":"0px"});
		$(caidanbg).click(function(){
			
			$(caidanleft).animate({"left":-($(window).width()-width)+"px"});
			$(caidan_rel_con).animate({"right":-width+"px"},function(){
				$(caidanabs).remove();
			});
			
		});
				$(caidanleft).click(function(){
				$(caidanleft).animate({"left":-($(window).width()-width)+"px"});
			   $(caidan_rel_con).animate({"right":-width+"px"},function(){
				$(caidanabs).remove();
			});
			
		});
		//uexWidgetOne.exit();
	})
	},1000);
})