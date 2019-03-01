function resize_h_scroll(opt){//实现横向滚动
	  var wz=0,pclass=$("#"+opt.id+"");
	  var items=pclass.find(".item");
	  items.each(function(){
		  wz+=$(this).width();
	  }); 
	  pclass.find(".inner").css("width",wz+10+"px");
}
function searchcheck(obj){
 var key=$(obj).find("input[name='key']");
 if(key.val()==""){
   layer.msg(key.attr("placeholder"));
   return false;
 }
}
function show_hide_daohang(opt){//显示隐藏导航条
		var curnav=$("#curnav"),subnav=$("#pclass");
		if(typeof(opt)!="undefined"&&typeof(opt.id2)!="undefined"){
			  subnav=$("#"+opt.id2);
		}
		if(typeof(opt)!="undefined"&&typeof(opt.id1)!="undefined"){
			  curnav=$("#"+opt.id1);
		}
		var curnav_height=curnav.height(),subnav_height=subnav.height(),moshi=2;
		var cz=100/50;
		var us=String(navigator.userAgent);
		if(us.indexOf("MSIE 6.0")!=-1){
			moshi=1;
		}
		$(document).scroll(function(){
					 if(typeof(window.oldscrolltop)=="undefined"){window.oldscrolltop=0;}
					 var scrolltop=$(this).scrollTop();
					  if(moshi==1){
						   if(scrolltop>window.oldscrolltop){
							  if(scrolltop>curnav_height){
								  var curnav_top=-scrolltop;
								  if(curnav_top<-curnav_height){curnav_top=-curnav_height;}
								  curnav.css({top:curnav_top+"px"});
								  var t=curnav.height()-scrolltop;
								  t=$(this).scrollTop();
								  subnav.css({top:t+"px"});
							  }
						   }else{
							  //则导航条和分类条两个一同显示出来
							  curnav.css({top:scrolltop+"px"});
							  subnav.css({top:scrolltop+curnav_height+"px"})
						   }
					  }else{
							curnav.css({position:"fixed"});
							subnav.css({position:"fixed"});
						   if(scrolltop>window.oldscrolltop){ 
							  if(scrolltop>curnav_height){
								  subnav.css({position:"fixed",top:0+"px","box-shadow":"0px 0px 2px #888888"});
							  }else{
								 var ct=-scrolltop;
								 if(ct<-curnav_height){ct=-curnav_height;}//如果小于的话则重置为允许为的最小值
								 curnav.css({top:ct+"px"});
								 subnav.css({top:ct+curnav_height+"px"});
							  }
						   }else{
							   //则导航条和分类条两个一同显示出来
							  var cz=window.oldscrolltop-scrolltop;
							  var top2=parseInt(subnav.css("top"))+cz;
							  if(top2>curnav_height){top2=curnav_height;}//如果大于的话则重置为允许为的最大值
							   curnav.css({top:top2-curnav_height+"px"});
							   subnav.css({top:top2+"px","box-shadow":"none"});
						   }
					  }
				window.oldscrolltop=scrolltop;
		
		});
}

function show_hide_daohang_home(opt){//显示隐藏导航条
         window.sjidno=opt.sjidno;
		 var tabpane_slider=$("#"+sjidno+"tabpane_slider");
		 var tabpanes=tabpane_slider.find(".tabpane");
        reg_scroll($(document));


}
function reg_scroll(obj){
	    var sjidno=window.sjidno;
		var curnav=$("#"+sjidno+"curnav"),subnav=$("#"+sjidno+"pclass"),pheadinfo=$("#"+sjidno+"pheadinfo"),tabhead4=$("#"+sjidno+"tabhead4"),tabpane_slider=$("#"+sjidno+"tabpane_slider");
		var tabpanes=tabpane_slider.find(".tabpane");
		var curnav_height=curnav.height(),subnav_height=subnav.height(),pheadinfo_height=pheadinfo.height(),moshi=2;
		var cz=100/50;
		var us=String(navigator.userAgent);
		if(us.indexOf("MSIE 6.0")!=-1){
			moshi=1;
		}
	   var oldscrolltop=0;
	   var isbool=1;
	     obj.scroll(function(){
					if(isbool==1){
					 if(typeof(oldscrolltop)=="undefined"){oldscrolltop=0;}
					 var scrolltop=$(this).scrollTop();
 					  if(moshi==1){
						   if(scrolltop>oldscrolltop){
							  if(scrolltop>curnav_height){
								  var curnav_top=-scrolltop;
								  if(curnav_top<-curnav_height){curnav_top=-curnav_height;}
								  curnav.css({top:curnav_top+"px"});
								  var t=curnav.height()-scrolltop;
								  t=$(this).scrollTop();
								  subnav.css({top:t+"px"});
							  }
						   }else{
							  //则导航条和分类条两个一同显示出来
							  curnav.css({top:scrolltop+"px"});
							  subnav.css({top:scrolltop+curnav_height+"px"})
						   }
					  }else{
							curnav.css({position:"fixed"});
							//subnav.css({position:"fixed"});
						   if(scrolltop>oldscrolltop){ 
							  if(scrolltop>(pheadinfo_height-curnav_height)){
								 // subnav.css({position:"fixed",top:0+"px"});
								  curnav.css({"background-color":"#1BBC9B"});
								 
							  }else{
								 var ct=-scrolltop;
								 if(ct<-curnav_height){ct=-curnav_height;}//如果小于的话则重置为允许为的最小值
								// curnav.css({top:ct+"px"});
								// subnav.css({top:ct+curnav_height+"px"});
								
							  }

						   }else{
							   //则导航条和分类条两个一同显示出来
							  var cz=oldscrolltop-scrolltop;
							  var top2=parseInt(subnav.css("top"))+cz;
							  if(top2>curnav_height){top2=curnav_height;}//如果大于的话则重置为允许为的最大值
							 // curnav.css({top:top2-curnav_height+"px"});
							 // subnav.css({top:top2+"px"})
							  if(scrolltop>(pheadinfo_height-curnav_height)){
								 // subnav.css({position:"fixed",top:0+"px"});
								  curnav.css({"background-color":"#1BBC9B"});
							  }else{
								 var ct=-scrolltop;
								 if(ct<-curnav_height){ct=-curnav_height;}//如果小于的话则重置为允许为的最小值
								// curnav.css({top:ct+"px"});
								// subnav.css({top:ct+curnav_height+"px"});
								 if(scrolltop<15){
								   curnav.css({"background-color":"transparent"});
								 }
							  }
							  
						   }
							   if(scrolltop>=(pheadinfo_height)){
							       // tabhead4.css({position:"fixed",top:curnav_height+"px"});
							
								   //tabpane_slider.css({position:"fixed",top:curnav_height+tabhead4.height()+"px",left:"0px","padding-top":subnav_height+"px","overflow-y":"auto",height:$(window).height()+"px"});
								    tabhead4.css({position:"fixed",top:curnav_height+"px",left:"0px"});
									tabpane_slider.css({"padding-top":tabhead4.height()+"px"});
									var top2=curnav_height+tabhead4.height();
									//var height2=$(window).height()-top2;
									//tabpane_slider.css({position:"fixed",height:$(window).height()-top2,top:top2+"px",left:"0px","overflow-y":"auto"});
									//$(".tabpane").eq(itemIndex).css({position:"fixed","overflow-y":"auto",left:"0px",top:top2+"px"});
									//$(".mybody").height($(window).height()+20);
					          
									//tabpane_slider.css({position:"absolute",height:$(window).height()+"px",left:"0px",top:top2+"px"});
								   //$(".tabpane").css({width:$(window).width()+"px","height":$(window).height()+"px","padding-top":(top2)*2+"px","overflow-y":"auto"});
								  // isbool=0;

								   //$(".tabpane").eq(1).scrollTop(top2*2);
							        // $(".tabpane").find(".list").css({height:$(window).height()-top2+"px"});
									// var h=$(".tabpane").eq(itemIndex).find(".list").height();
								
									// $(".tabpane").eq(itemIndex).css({height:h+"px"});
								    // alert(top2);
									//$(".tabpanelist").css({width:($(window).width()*tabpanes.length)+"px"});
									//tslider.width=$(window).width();
							   }else{
								  tabhead4.css({position:"",top:"",left:""});
								  tabpane_slider.css({"padding-top":0+"px"});

							   }
					  }
				  curnav.css({position:"fixed"});
                  curnav.css({top:"0px"});
				}
				 isbool=1;
				 oldscrolltop=scrolltop;
				
		
	});
}
function init_show_img(opt){//显示图片
	    opt.objs.each(function(){
		    var data_src=$(this).attr("data-src");
			$(this)[0].onerror=function(){this.src=conf.public+'/images/error.gif';this.onerror=null;};
			if(data_src!=null&&typeof(data_src)!="undefined"){
			   $(this).attr("src",data_src);
			   $(this).removeAttr("data-src");
			}
		});
}
function showbig(obj){
alert(obj.src);
}
