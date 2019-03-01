var duihuakuang={
	init:function(opt){
		      var t=this;//当前的this取个别名t
			  $(window).width();
			
			  t.parent=document.createElement("div");
			  var html="<div class='ybg'></div><div class='ycon'><p>"+opt.title+"</p>"+opt.html+"<div class='divbt'></div></div>";
			  t.parent.innerHTML=html;
			  t.parent.className="tanceng";
			  t.parent.style.top="0px";
			  t.parent.style.height=$(window).height()+"px";
			  $("body").append(t.parent);
			  $(t.parent).find(".ybg").css({"height":$(document).height()+"px","width":"100%"});
			  var ybg=$(t.parent).find(".ybg");
			  ybg.click(function(){
				   $(t.parent).remove();
			  })
			  var ycon=$(t.parent).find(".ycon");
			  var ycon_h=250;//高度
			  if(opt.height){
				  ycon_h=opt.height;
			  }
			  var ycon_w=($(window).width()<500?$(window).width()-60:300);//宽度
			  if(opt.width){
				  ycon_w=opt.width;
			  }
			  var left=($(window).width()-ycon_w)/2;
			  var top=($(window).height()-ycon_h)/2;
			  ycon.css({"height":ycon_h+"px","width":ycon_w+"px","left":left+"px","top":top+"px"});

			  var createbt=function(opt){ //创建按钮函数
					   var bt=document.createElement("div");
						bt.className=opt.classname;
						bt.innerHTML=opt.text;
						if(opt.close){
							 bt.onclick=function(){
							   
							   t.close(opt);
							 }
						}
						 if(opt.click){
							 bt.onclick=function(){
							   opt.t=t;
							   opt.bt=this;
							   opt.click(opt);
							 }
						 }
						 divbt[0].appendChild(bt);
			 }
			  //创建按钮
			  var divbt=$(t.parent).find(".divbt");
			  if(opt.bts){
					for(var i=0;i<opt.bts.length;i++){
						createbt(opt.bts[i]);
					}
			  }
	},close:function(){
		var t=this;
		 $(t.parent).remove();//关闭移除
	}
}