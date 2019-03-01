var kaoti={
	init:function(opt){
	 var t=this;
	 t.opt=opt;
	 	  try{
	 t.curnav_color=$(".curnav").css("background-color");
	 t.bt_daticolor="#099";
	 t.maxbodywidth=800;
	 t.typecaption={"0":"判断题","1":"单选题","2":"多选题"};
	 t.parentid=opt.parentid;
	 t.mycontent=document.getElementById(this.parentid);
	 t.myleft=document.createElement("div");
	 t.myleft.className="myleft";
	 t.myright=document.createElement("div");
     t.myright.className="myright";
	 
	 t.myleft_inner=document.createElement("div");
	 t.myleft_inner.className="myleft_inner";
	 //t.myleft_inner.style.position="relative";
	 t.myleft.appendChild(t.myleft_inner);
	 
	 t.myleft_inner_con=document.createElement("div");
	 t.myleft_inner_con.className="myleft_inner_con";
	 t.myleft_inner_con.style.position="relative";
	 t.myleft_inner.appendChild(t.myleft_inner_con);
	 
	 t.myleft_inner_con_list=document.createElement("div");
	 t.myleft_inner_con_list.className="myleft_inner_con_list";
	 t.myleft_inner_con.appendChild(t.myleft_inner_con_list);
	 //t.myleft_inner_con_list.style.position="relative";

     t.body=document.getElementsByTagName("body")[0];
	 
	 
	 
	 t.myright_inner=document.createElement("div");
	 t.myright_inner.className="myright_inner";
	 t.myright.appendChild(t.myright_inner);
	 
	 t.myright_inner_con=document.createElement("div");
	 t.myright_inner_con.className="myright_inner_con";
	 t.myright_inner.appendChild(t.myright_inner_con);
	 
	 t.myright_inner_con_list=document.createElement("div");
	 t.myright_inner_con_list.className="myright_inner_con_list";
	 t.myright_inner_con.appendChild(t.myright_inner_con_list);
	 t.p=1;
	 var is_scroll=1;
	 if(g_act=="shunxi"){
     t.myleft_inner_con.onscroll = function(){
			  var pageTop =this.clientHeight + this.scrollTop;
			  //alert((pageTop+20)+"=="+this.scrollHeight);
			  if ( pageTop+10>this.scrollHeight&&is_scroll==1)
			  {
				  
				  is_scroll=0;
				  t.p++;
				  var leftloadmore=$(t.myleft_inner_con).find(".leftloadmore");
				  if(leftloadmore.length<=0){
					  $(t.myleft_inner_con).append("<div class='leftloadmore'>加载中</div>");
					  leftloadmore=$(t.myleft_inner_con).find(".leftloadmore");
				  }
			      $.ajax({
					  type:"post",
					  url:conf.action,
					  dataType:"json",
					  data:{"act":"shunxi","p":t.p,"ajax":"1","classid":conf.classid,"kemu":conf.kemu},
					  success:function(data){
						 if(data!=null&&data.length>0){
							var start=exam.length;
							for(var i=0;i<data.length;i++){
								exam.push(data[i]);
							}
							//exam = exam.concat(data); 
							//alert(exam.length);
							 t.leftbt(start,exam.length);
							 t.getwh();
							 leftloadmore.remove();
						 }else{
							 leftloadmore.remove();
						 }
						 is_scroll=1;
					  }
				  })
			  }
		 }
	 }
	 t.leftbt(0,exam.length);

	 t.mycontent.appendChild(t.myleft);
	 t.mycontent.appendChild(t.myright);
	 
	    t.mybottom=document.createElement("div");
		t.mybottom.className="mybottom";
        t.mycontent.appendChild(t.mybottom);
	    t.mytypetishi=document.createElement("div");
		t.mytypetishi.className="mytypetishi";
        t.mycontent.appendChild(t.mytypetishi);
		if(window.attachEvent){
			  window.attachEvent('onscroll',function(){t.getwh();});
			  window.attachEvent('onresize',function(){t.getwh();});
		}else{
			  window.addEventListener("scroll",function(){t.getwh();}, false );
			  window.addEventListener("resize",function(){t.getwh();}, false );
		 }

		  t.getwh();
		  		 var bt_0=document.getElementById("bt_0");
		 if(bt_0){bt_0.click();}
	   }catch(err){
		    alert(err.message);
      }
	},wh:function(){
	  window.scrollHeight=document.documentElement.scrollHeight||document.body.scrollHeight;	
	  window.scrollWidth=document.documentElement.scrollWidth||document.body.scrollWidth;
	  window.clientHeight=document.documentElement.clientHeight||document.body.clientHeight;//网页可见高度区
	  window.clientWidth=document.documentElement.clientWidth||document.body.clientWidth;//网页可见宽度区
	  window.scrollTop=document.documentElement.scrollTop||document.body.scrollTop;
	  window.scrollLeft=document.documentElement.scrollLeft||document.body.scrollLeft; 
	  window.body=document.getElementsByTagName("body")[0];
		if ( document.compatMode!="CSS1Compat" ){
		  //alert("本文档未添加W3C的声明")
		    if(document.body){
		        window.clientHeight=document.body.clientHeight;
				window.scrollHeight=document.body.scrollHeight;
			}else{
				window.clientHeight=document.documentElement.clientHeight;
				window.scrollHeight=document.documentElement.scrollHeight;
			}
		 
		}

	},
	leftbt:function(start,end){
		var t=this;
	 for(var i=start;i<end;i++){
		 if(exam[i].photo!=""){
			 var img=document.createElement("img");
			 img.src=siteurl+exam[i].photo;
			 
		 };
		 var bt=document.createElement("input");
		 bt.value=(i+1);
		 bt.type="button";
         bt.id="bt_"+i;
		// bt.innerHTML="<a style='display:block;'>"+(i+1)+"</a>";
		 bt.className="bt";
		 bt.title=exam[i].id;
		 bt.setAttribute("data-index",i);
		 bt.setAttribute("data-id",exam[i].id);
		 bt.setAttribute("data-idno",exam[i].idno);
		 bt.setAttribute("myvalue","");
		 bt.setAttribute("data-title",exam[i].name);
		 bt.setAttribute("yida","");
		 bt.setAttribute("data-value",exam[i].value);
		 bt.setAttribute("data-kemu",exam[i].kemu);
		 $(bt).click(function(){
			 t.show({bt:this});
		 });
		// bt.onclick=function(){
			 //alert(4444);
			// t.show({bt:this});
	    // }
		var span=document.createElement("span");
		span.style.cssText="position:relative;float:left;width:auto;";
		t.myleft_inner_con_list.appendChild(span);
		span.appendChild(bt);
	 }
	},
	showimg:function(img){
		var t=this;

//			newimg.src=this.src;
//			newimg.onload=function(){
//				
//			}
			var body=document.getElementsByTagName("body")[0];
			var div=document.createElement("div");
			div.style.cssText="_position:absolute;position:fixed;width:"+$(window).width()+"px;height:"+$(window).height()+"px;top:0px;left:0px;z-index:40000;background-color:#000000;";
			div.className="showimg";
			//cellpadding="0" cellspacing="0"><tr><td valign="middle">
			var newsrc=img.attr("data-big");

			if ($.browser.msie){
				//newsrc=this.src+"?"+Math.random();
			}
		 	div.innerHTML="<table style='width:100%;height:100%;' cellpadding='0' cellspacing='0'><tr><td align='center' valign='middle' class='showimg_1'></td></table>";
			body.appendChild(div);
			var str1="";
			var div1=$(div).find(".showimg_1");
			var bigimg=$("<img src='"+newsrc+"' />");
			div1.append(bigimg);
			if($(window).width()>600){
				bigimg.css({"width":600+"px"});
			}else{
				bigimg.css({"width":"100%"});
			}
			bigimg.click(function(e){
				e.stopPropagation();				  
			});
			bigimg.dblclick(function(e){
			   $(div).remove();
			});
			$(div).click(function(){
				$(this).remove();
			})
	},
	show:function(opt){
	  var t=this;
        window.clearTimeout(window.timer_okvalue);
		window.clearTimeout(window.timer_auto);
		t.wh();
		t.showleft(opt);
		t.getwh();
	},
	showleft:function(opt){
		
		var t=this;
		var right=t.myright_inner_con_list;
		var index=parseInt(opt.bt.getAttribute("data-index"));
		window.curindex=index;//当前索引
		t.curindex=index;
		var ulstr="<ul>";
		var option=exam[index];
		option.type=parseInt(option.type);
		var items=option.items;
	    var line1=document.createElement("div");
		line1.className="line1";
		right.innerHTML="";
        right.appendChild(line1);
        if(!t.rightmenu){
	    t.rightmenu=document.createElement("div");
		t.rightmenu.className="rightmenu";
        t.mycontent.appendChild(t.rightmenu);
		}
		t.rightmenu.innerHTML="";

		t.mybottom.innerHTML="";
		
	    var mybottom_con=document.createElement("div");
		mybottom_con.className="mybottom_con";
		mybottom_con.style.cssText="width:100%;height:100%; position:relative;";
        t.mybottom.appendChild(mybottom_con);

		var bt=document.getElementById("bt_"+index);
		t.bt=bt;
		
		$(".bt").removeClass("hover");
		
		if($(bt).attr("class").indexOf("hover_yida")!=-1){
			$(bt).removeClass("hover_yida");
			$(bt).addClass("hover_yida");
			$(bt).addClass("hover");
		}else{
			$(bt).addClass("hover");
		}
		var height=$(right).height();
		var h2=50;
		var h1=height-h2;
		$(line1).css({"position":"absolute","width":"100%","height":h1+"px","top":"0px","left":"0px","overflow":"auto"});
		$(t.mybottom).css({"position":"absolute","width":"100%","height":h2+"px","bottom":"0px","left":"0px","border-top":"solid #CCCCCC 1px","background-color":"#F5F5F5"});
		
		var bt_dati_str="";
		var bt_menu_str="";
		var input_disabled="";
		var myvalue=$(bt).attr("myvalue");
		if(g_act=="moni"){
		if(bt.getAttribute("yida")!=""){
			input_disabled=' disabled="disabled" ';
		}
		}

		for(var i=0;i<items.length;i++){
			var title=items[i].title;
			var value=items[i].value;
			
			if(items[i].title=="Y"){
				title="√";
				value="√";
			}
			if(items[i].title=="N"){
				title="×";
				value="×";
			}
			

            var dataval=items[i].value;
			if(g_lang=="ar"){
			
			   if("ABCD".indexOf(items[i].lable)==-1){
				  //alert(items[i].lable);
				    ulstr+="<li class='li_dati'  data-value='"+dataval+"' data-index='"+index+"' ><table cellpadding=\"5\" cellspacing=\"0\" border=\"0\"><tr><td><span></span></td><td>"+title+"</td><td>："+items[i].lable+"</td></tr></table></li>";
				}else{
					ulstr+="<li class='li_dati' data-value='"+dataval+"' data-index='"+index+"' ><table cellpadding=\"5\" cellspacing=\"0\" border=\"0\"><tr><td><span></span></td><td>"+items[i].lable+"</td><td>："+title+"</td></tr></table></li>";
				}
			}else{
				
		        ulstr+="<li  class='li_dati'  data-value='"+dataval+"' data-index='"+index+"' ><table cellpadding=\"5\" cellspacing=\"0\" border=\"0\"><tr><td><span></span></td><td>"+dataval+"："+title+"</td></tr></table></li>";
			}
			var hover="";
			if(myvalue.indexOf(items[i].value)!=-1){
				hover=" hover";
			}
			bt_dati_str+="<td><input type='button' data-value='"+dataval+"' "+input_disabled+" data-index='"+index+"' value='"+dataval+"' class=\"bt_dati"+hover+"\" name='bt_dati_"+index+"'/></td>";
            bt_menu_str+="<li><input  type='button' data-value='"+dataval+"' "+input_disabled+" class='a_dati"+hover+"' value='"+dataval+"' /></li>";
		}
		
		ulstr+="</ul>";
		if(option.type==0){
			bt_menu_str="<li><input type='button' class='a_prevnext' data-value='-1' value='∧' /></li><li><input type='button' value='&nbsp;' /></li>"+bt_menu_str+"<li><input type='button' value='&nbsp;' /></li><li><input type='button' class='a_prevnext' data-value='+1' value='∨'  /></li>";
		}else{
			bt_menu_str="<li><input type='button' class='a_prevnext' data-value='-1' value='∧' /></li>"+bt_menu_str+"<li><input type='button' class='a_prevnext' data-value='+1'  value='∨' /></li>";
		}
		
		t.rightmenu.innerHTML="<ul title=\"右侧按钮组\">"+bt_menu_str+"</ul>";

		
		var imgstr="";
       if(option.photo!=""){
		   var imgwidth="auto";
		   if(window.clientWidth<=t.maxbodywidth){
			   
			   imgwidth=($(right).width()-70)+"px";
		   }
		  imgstr="<div class='line1_con_img' style='margin-top:10px;'><img src='"+siteurl+option.photo+"' data-big='"+siteurl+option.photo_big+"' class='photo' style='max-width:600px;width:"+imgwidth+";'/></div>" ;
	    }
		var fontsize13="13";
		line1.innerHTML="<div class='line1_con'><h1>"+(index+1)+"、"+exam[index].name+"<a class='add_favorites'>加入我的收藏</a></h1>"+ulstr+imgstr+"</div>";
		
		$(line1).find(".add_favorites").click(function(){
			 t.add_favorites({data:{type:t.bt.getAttribute("data-kemu"),objid:t.bt.getAttribute("data-id"),objidno:t.bt.getAttribute("data-idno"),objtable:conf.table,title:exam[index].name}});	
			t.alert({msg:"<span class='span_tisi_color'>已加入收藏</span>",time:1000});
		});
		


		var photo=$(line1).find(".photo");
		photo.click(function(){
		       t.showimg($(this));//显示大图片
		});
		if(g_lang=="ar"){
		  $(line1).find(".line1_con").css({"direction":"rtl","unicode-bidi":"bidi-override"});
		 // $(line1).find(".line1_con").find("*").css({"direction":"rtl","unicode-bidi":"bidi-override"});
		}
		t.line1=line1;
		var bt_tishi_width=110;
		 if(window.clientWidth>t.maxbodywidth){
			 bt_tishi_width=140;
		 }else{

			 fontsize13="12";
		 }
		var bt_tishi_html="<div class='bt_tishi_div'  style='position:absolute;top:0px;left:0px;width:"+bt_tishi_width+"px;'></div>";
		var bt_dati_width=140;
		var bt_prevnext_width=110;

		 if(window.clientWidth>t.maxbodywidth){
			 bt_dati_width=180;
			 bt_prevnext_width=120;
		 }
		var bt_dati_left=bt_tishi_width;
		var bt_dati_html="<div  class='bt_dati_div' style='position:absolute;top:4px;left:"+bt_dati_left+"px;width:"+bt_dati_width+"px;z-index:1000;'><table cellpadding='0' cellspacing='0' border='0'><tr>"+bt_dati_str+"</tr></table></div>";
		
		var bt_prevnext_left=bt_dati_left+bt_dati_width;
		var bt_prevnext_html="<div  class='bt_prevnext_div' style='position:absolute;top:4px;width:"+bt_prevnext_width+"px;text-align:right;'></div>";
		
		

		var type_tishi_html="<div style='position:absolute;top:-30px;left:10px;color:#666;' class='typetishi'>"+t.typecaption[option.type]+"</div>";
		type_tishi_html="";
		t.mytypetishi.style.cssText="position:absolute;top:-30px;left:10px;color:#666;";
		t.mytypetishi.innerHTML=t.typecaption[option.type];
		mybottom_con.innerHTML=type_tishi_html+bt_tishi_html+bt_dati_html+bt_prevnext_html;
		//t.typetishi=$(".typetishi");
		if(g_act=="moni"){
			var bt_tijiao_html="";
			bt_tijiao_html="<div style='position:absolute;top:-50px;right:0px;color:#666;z-index:30000;'><input type='button' value='交卷' class='bt_tijiao'/></div>";
			
			
			$(mybottom_con).append(bt_tijiao_html);
			$(mybottom_con).find(".bt_tijiao").click(function(){
				if(confirm("确定要提交？")){
				  t.tijiao();
				}
			})
		}
		var bt_tishi_div=$(mybottom_con).find(".bt_tishi_div");

        var bt_prevnext_div=$(mybottom_con).find(".bt_prevnext_div");
		if(window.clientWidth<t.maxbodywidth){
		    bt_prevnext_div.css({"right":"2px"});
		}else{
			bt_prevnext_div.css({"left":bt_prevnext_left+"px"});
		}
		if($("#bt_"+(index-1)).length>0){
			var bt_prev=document.createElement("input");
			bt_prev.type="button";
			bt_prev.value="<";
			bt_prev.className="bt_prevnext";

			$(bt_prev).click(function(){
				t.setyida(bt);
				$("#bt_"+(index-1)).click();
			})
			bt_prevnext_div.append(bt_prev);
		}
		if($("#bt_"+(index+1)).length>0){
			var bt_next=document.createElement("input");
			bt_next.type="button";
			bt_next.className="bt_prevnext";
			bt_next.value=">";
			if(index==0){
			//bt_next.style.marginTop="12px";	
			}
			$(bt_next).click(function(){
				t.setyida(bt);
				$("#bt_"+(index+1)).click();
			})
			bt_prevnext_div.append(bt_next);
		}
		$(t.rightmenu).find(".a_dati").each(function(){
			$(this).click(function(){
				var value=$(this).attr("data-value");
				$(t.mybottom).find(".bt_dati").each(function(){
					if(value==$(this).attr("data-value")){
						$(this).click();
					}
				});
			})
		});

		$(t.rightmenu).find(".a_prevnext").each(function(){
			$(this).click(function(){
			  var value=$(this).attr("data-value");
			  t.setyida(document.getElementById("bt_"+(window.curindex)));
			  var bt=document.getElementById("bt_"+(window.curindex+parseInt(value)));
			  if(bt){bt.click();}
			});
		});
		$(t.myright).find(".li_dati").each(function(){
			$(this).click(function(){
				var span=$(this).find("span");
				if($(this).attr("class").indexOf("hover")!=-1){
					$(this).removeClass("hover");
					span.removeClass("error");
					span.removeClass("ok");
				}else{
					span.removeClass("error");
					$(this).addClass("hover");
					span.addClass("ok");
				}
				var value=$(this).attr("data-value");
				$(t.mybottom).find(".bt_dati").each(function(){
					if(value==$(this).attr("data-value")){
						$(this).click();
					}
				});
			})
		});
		var showtishi=function(opt){
				var myvalue=$(bt).attr("myvalue");
				var datavalue=$(bt).attr("data-value");
				window.clearTimeout(window.timer_okvalue);
				if(myvalue!=""){
					var tishi="";
						tishi+="<div style='padding:5px;padding-top:10px;'>";
						tishi+="<span style='color:"+t.bt_daticolor+";font-size:"+fontsize13+"px;font-weight:bold;padding-left:5px;'>你的回答："+myvalue+"</span>";
						tishi+="<br/><span style='color:"+t.bt_daticolor+";font-size:"+fontsize13+"px; display:none;padding-left:5px;' id='okvalue'>正确答案："+datavalue+"</span>";
						tishi+="</div>";
//					if(g_act!="moni"){
//						tishi+="<div style='padding:5px;padding-top:10px;'>";
//						tishi+="<span style='color:"+t.bt_daticolor+";font-size:"+fontsize13+"px;font-weight:bold;padding-left:5px;'>你的回答："+myvalue+"</span>";
//						tishi+="<br/><span style='color:"+t.bt_daticolor+";font-size:"+fontsize13+"px; display:none;padding-left:5px;' id='okvalue'>正确答案："+datavalue+"</span>";
//						tishi+="</div>";
//					}else{
//						tishi+="<div>";
//						tishi+="<span style='color:"+t.bt_daticolor+";padding-top:15px;display:block;padding-left:5px;'>你的回答："+myvalue+"</span>";
//						tishi+="</div>";
//					}
					bt_tishi_div.html(tishi);
					if(opt){
						if(opt.bt){
							 //alert(option.type);
							  if(option.type==2){

										window.timer_okvalue=window.setTimeout(function(){
											t.showyeserror();//显示提示
									     $("#okvalue").css({"display":""});
											window.clearTimeout(window.timer_auto);
											window.timer_auto=window.setTimeout(function(){
												t.setyida(bt);
												var bt_next=document.getElementById("bt_"+(index+1));
												if(bt_next){ bt_next.click();}
											},1000);
									   },6000);
							  }else{
								  t.showyeserror();//显示提示
								  $("#okvalue").css({"display":""});
							  }
						}
					}else{
						$("#okvalue").css({"display":""});
					}
					if($(bt).attr("yida")=="1"){
						$("#okvalue").css({"display":""});
					}
					$(bt).addClass("hover_yida");
				}else{
		
		           $(bt).removeClass("hover_yida");
					bt_tishi_div.html("<span style='color:#a80000;padding:15px;display:block;'>请作答</span>");
				}
				
				
		};
		showtishi();
		$(mybottom_con).find(".bt_dati").each(function(){
			$(this).click(function(){
				var bt=document.getElementById("bt_"+index);
              

//				if(g_act=="moni"){
//				  if(bt.getAttribute("yida")!=""){
//				     return false;
//				  }
//			  }
				if(option.type==2){
					  if($(this).attr("class").indexOf("hover")!=-1){
						  $(this).removeClass("hover");
					  }else{
						  $(this).addClass("hover");
					  }

				}else{
					  $(mybottom_con).find(".bt_dati").removeClass("hover");
					  $(this).addClass("hover");
					  window.clearTimeout(window.timer_auto);
					  window.clearTimeout(window.timer_okvalue);
					  window.timer_auto=window.setTimeout(function(){
						  t.setyida(bt);
						  var bt_next=document.getElementById("bt_"+(index+1));
						  if(bt_next){ bt_next.click();}
					  },1000);
				}
				var curvalue="";
				$(mybottom_con).find(".bt_dati.hover").each(function(){
					curvalue+=$(this).attr("data-value");
				});
				$(t.rightmenu).find(".a_dati").each(function(){
					if(curvalue.indexOf($(this).attr("data-value"))!=-1){
						$(this).addClass("hover");
					}else{
						$(this).removeClass("hover");
					}
				});

				bt.setAttribute("myvalue",curvalue);//多选

				showtishi({bt:this});
				
			});
		})
		t.showyeserror();
		if(window.clientWidth>t.maxbodywidth){
			$(line1).find(".line1_con").css({"padding":"10px"});
		}else{
			$(line1).find(".line1_con").css({"padding":"10px"});
		}
		$(line1).find("h1").css({"margin":"0","padding":"0px","font-size":"18px","margin-bottom":"10px"});

	},
	tijiao:function(){
		var num=$(".myleft").find("input").length;
		var num_success=0;
		var num_error=0;
		var curnav_h=$(".curnav").height();
		$(".myleft").find("input").each(function(){
			if($(this).attr("myvalue")==$(this).attr("data-value")){
				num_success++;
			}else{
				num_error++;
			}
		});
		var h=window.clientHeight-curnav_h;
		var str="";
		if(num_success<=50){
			str="<span style='color:#ff0000;font-size:30px;'>"+num_success+"分</span>";
		}else{
			str="<span style='color:#00CC00; font-weight:bold;font-size:30px;'>"+num_success+"分</span>";
		}
		
		str+="<div style='height:auto;overflow:hidden;'><span style='display:block;width:100%;text-align:center;color:#333;font-size:15px;'>"+num_success+"/"+num+"</span></div>";
		str+="<div style='text-align:center;height:auto;overflow:hidden; height:50px;'><div style='width:100%;heigth:1px;oveflow;hidden;'></div><a href='"+conf.url+""+"' class='btback'>返回</a></div>"
		var html="<div style='position:absolute;text-align:center;top:50%;width:100%; height:90px;margin-top:-30px;'>"+str+"</div>";
		var listscontent=$("#listscontent");
		listscontent.css({"height":h+"px"});
		listscontent.html(html);
	},
	setyida:function(bt){
		var t=this;
		window.clearTimeout(window.timer_okvalue);window.clearTimeout(window.timer_auto);
		if(bt.getAttribute("myvalue")!=""){
			 bt.setAttribute("yida","1");
		}
	},
	showyeserror:function(){
		var t=this;
		var curvalue=t.bt.getAttribute("myvalue");
		var datavalue=t.bt.getAttribute("data-value");
		
		if(curvalue!=""){
			var div=document.createElement("div");
			 div.className="tishi_yeserror";
			 $(t.bt).parent().find("i").remove();
			 if(window.clientWidth>t.maxbodywidth){
				   div.style.left=$(t.myleft).width()+400+"px";
				  
			 }
			 if(curvalue!=t.bt.getAttribute("data-value")){
			   div.innerHTML="<span class='error'><img src='"+conf.error_src+"'/></span>";
			   $(t.bt).parent().append("<i class='error'>×</i>");
			   t.alert({msg:"<span class='span_tisi_color'>已加入错题</span>",time:1000});
			 }else{
			   div.innerHTML="<span class='yes'><img src='"+conf.yes_src+"'/></span>";
			   $(t.bt).parent().append("<i class='yes'>√</i>");
			 }
			 var isok=1;
			  if(curvalue!=t.bt.getAttribute("data-value")){ //判断是否答错的
                isok=0;
			  }
			   var isbool=1;
			   var id_bj=t.bt.getAttribute("data-id")+"#";
			   if(typeof(t.add_answer_ids)!="undefined"&&t.add_answer_ids.indexOf(id_bj)!=-1){
				   isbool=0;   
			   }
			   if(isbool==1){
				   if(typeof(t.add_answer_ids)!="undefined"){t.add_answer_ids+=id_bj;}else{t.add_answer_ids=id_bj;}
			       t.add_answer({data:{type:t.bt.getAttribute("data-kemu"),objid:t.bt.getAttribute("data-id"),objidno:t.bt.getAttribute("data-idno"),isok:isok,objtable:conf.table,value:curvalue,title:t.bt.getAttribute("data-title")}});
			   }
			 t.mycontent.appendChild(div);
			 window.setTimeout(function(){
				$(div).animate({'opacity':"0"},"slow",function(){$(div).remove();});
			 },1000);
        
			$(t.myright).find(".li_dati").each(function(){
				var span=$(this).find("span");
				  span.removeClass("ok");
				  span.removeClass("error");
					if(curvalue.indexOf($(this).attr("data-value"))!=-1){
						$(this).addClass("hover");
						if(datavalue.indexOf($(this).attr("data-value"))!=-1){
							span.addClass("ok");
						}else{
							span.addClass("error");
						}
					}else{
						$(this).removeClass("hover");
						
					}
			});	
			 
		}
	},add_answer:function(opt){ //加入我的答案
			   var t=this;
			   $.ajax({
					  type:"post",
					  dataType:"text",
					   url:t.opt.app+"/"+t.opt.module+"/answer/add.html",
					   data:opt.data,
					   success:function(data1){
							// alert(data1);
					   }
				});
	},add_favorites:function(opt){ //加入收藏
			   var t=this;
			   $.ajax({
					  type:"post",
					  dataType:"text",
					   url:t.opt.app+"/"+t.opt.module+"/favorites/add.html",
					   data:opt.data,
					   success:function(data1){
							 //alert(data1);
					   }
				});
	},alert:function(opt){
		if(layer){
			if(typeof(opt)=="string"){
				 layer.msg(opt);
			}else{
				if(typeof(opt.time)!="undefined"){
				  layer.msg(opt.msg,{time:opt.time});
				}else{
				  layer.msg(opt.msg);	
				}
			}
		}else{
			if(typeof(opt)=="string"){
				  alert(opt);
			}else{
				 alert(opt.msg);
			}
		}
	},getwh:function(){

	  var t=this;
	 t.wh();
	 var curnav_h=$(".curnav").height();
   var w_jian=0;
   
      $(t.mycontent).css({"height":($(window).height()-curnav_h)+"px","width":window.clientWidth+"px"});
	  				var right_width=$(t.myright_inner_con_list).width();

				var right_height=$(t.myright_inner_con_list).find(".line1").height();
	  if(window.clientWidth>t.maxbodywidth){
		        
			    var left_w=240,rightmenu_w,line0={w:58,a_w:5,a_h:48,a_mar:5};
				//alert(window.clientWidth);
				$(t.rightmenu).css({"width":line0.w+"px","padding-bottom":0+"px"});
				line0.a_w=line0.a_h=(line0.w-line0.a_mar*2);
				$(t.rightmenu).find("ul").css({"width":line0.w+"px"});
				$(t.rightmenu).find("a").css({"margin":line0.a_mar+"px","margin-bottom":"0px","width":line0.a_w+"px","height":line0.a_h+"px","line-height":line0.a_h+"px"});
				$(t.rightmenu).find("input").css({"margin":line0.a_mar+"px","margin-bottom":"0px","width":line0.a_w+"px","height":line0.a_h+"px","line-height":line0.a_h+"px"});
				$(t.rightmenu).find("ul").css({"width":$(t.rightmenu).width()-2+"px"});
			    var height=window.clientHeight-curnav_h;
			    var left_h=window.clientHeight-curnav_h;
				var right_w=window.clientWidth-left_w;
				var padding=10;
				var padding_r=0;
				
				
				var myleft_conf={h:height-0,w:left_w-1};
				var myright_conf={h:height,w:right_w};
				var mybottom_conf={h:50,l:myleft_conf.w+1,w:right_w};
				var inner_height=(myleft_conf.h-padding*2);
				var inner_width=myleft_conf.w-padding*2;
				var inner_height_r=(height-padding_r*2);
				var inner_width_r=right_w-padding_r*2;

				$(t.myleft).css({"width":myleft_conf.w+"px","height":myleft_conf.h+"px","position":"absolute","left":"0px","top":"0px","overflow":"hidden","border-right":"solid #CCCCCC 1px","z-index":"2000"});
				$(t.myright).css({"width":myright_conf.w+"px","height":myright_conf.h+"px","position":"absolute","right":"0px","top":"0px"});
				
				$(t.mybottom).css({"width":mybottom_conf.w+"px","height":mybottom_conf.h+"px","position":"absolute","left":mybottom_conf.l+"px"});
				$(t.mytypetishi).css({"width":mybottom_conf.w+"px","bottom":mybottom_conf.h+"px","position":"absolute","top":"","left":myleft_conf.w+"px"});
				
				$(t.myleft_inner).css({"margin":padding+"px","overflow":"hidden","height":inner_height+"px","width":inner_width+"px","overflow":"hidden"});
				$(t.myleft_inner_con).css({"overflow":"hidden","height":inner_height+"px","width":inner_width+"px","overflow-y":"auto","overflow-x":"hidden"});
				$(t.myleft_inner_con_list).css({"overflow":"hidden","height":"auto","width":inner_width+"px"});
				
				$(t.myright_inner).css({"padding":padding_r+"px","overflow":"hidden","height":inner_height_r+"px","width":inner_width_r+"px","overflow":"hidden"});
				$(t.myright_inner_con).css({"height":inner_height_r+"px","width":inner_width_r+"px","overflow-y":"auto","overflow-x":"hidden"});
				$(t.myright_inner_con_list).css({"height":inner_height_r+"px","width":inner_width_r+"px","overflow":"hidden","position":"relative"});
				
				//$(t.myleft_inner_con_list).find(".bt").css({"width":"50px","height":"50px"}).children().css({"margin":"5px","line-height":"40px"});
				var bt_h=50;
				var bt_w=50;
				bt_div_margin=5;
			    
				$(t.myleft_inner_con_list).find(".bt").css({"width":bt_w-(bt_div_margin*2)-1+"px","height":bt_h-(bt_div_margin*2)+"px","overflow":"hidden","line-height":(bt_h-bt_div_margin*2)-2+"px","margin":bt_div_margin+"px"}).parent().css({"height":bt_h+"px","width":bt_w+"px"});
				$(t.myright_inner_con_list).find(".line1").css({"height":inner_height_r-50+"px"});
				$(t.mybottom).css({"height":mybottom_conf.h+"px"});
				w_jian=10;
	
				 var bt_dati_div=$(t.mybottom).find(".bt_dati_div");
				 if(bt_dati_div.length>0){
				 $(t.mybottom).find(".bt_prevnext_div").css({"width":120+"px","left":bt_dati_div.width()+parseInt(bt_dati_div.css("left")),right:""});
				 }
				 if(g_lang=="ar"){
				    $(t.rightmenu).css({display:""});
				    $(t.line1).css({"width":right_width-$(t.rightmenu).width()-w_jian+"px"});
				 }
		
	  }else{
			    var left_w=50,rightmenu_w,line0={w:0,a_w:0,a_h:0,a_mar:0};
				//alert(window.clientWidth);
				
				if(window.clientWidth>600){
					left_w=60;
					line0.a_mar=5;
					line0.w=left_w;
				}else{
					left_w=50;
					line0.a_mar=2;
					line0.w=left_w;

				}
				$(t.rightmenu).css({"width":line0.w+"px","padding-bottom":line0.a_mar+"px"});
				line0.a_w=line0.a_h=(line0.w-line0.a_mar*2);
				$(t.rightmenu).find("ul").css({"width":line0.w+"px"});
				$(t.rightmenu).find("a").css({"margin":line0.a_mar+"px","margin-bottom":"0px","width":line0.a_w+"px","height":line0.a_h+"px","line-height":line0.a_h+"px"});
				$(t.rightmenu).find("input").css({"margin":line0.a_mar+"px","margin-bottom":"0px","width":line0.a_w+"px","height":line0.a_h+"px","line-height":line0.a_h+"px"});
			    var height=window.clientHeight-curnav_h;
			    var left_h=window.clientHeight-curnav_h;
				var right_w=window.clientWidth-left_w;
				var padding=4;
				var padding_r=0;

				

				
				
				var myright_conf={h:height,w:right_w};
				var mybottom_conf={h:50,l:0,w:$(window).width()};
				var myleft_conf={h:height-mybottom_conf.h,w:left_w-1};
				var inner_height=(myleft_conf.h-padding*2);
				var inner_width=myleft_conf.w-padding*2;
				var inner_height_r=(height-padding_r*2);
				var inner_width_r=right_w-padding_r*2;
				
				$(t.myleft).css({"width":myleft_conf.w+"px","height":myleft_conf.h+"px","position":"absolute","left":"0px","top":"0px","overflow":"hidden","border-right":"solid #CCCCCC 1px","z-index":"2000"});
				$(t.myright).css({"width":myright_conf.w+"px","height":myright_conf.h+"px","position":"absolute","right":"0px","top":"0px"});
				$(t.mybottom).css({"width":"100%","height":mybottom_conf.h+"px","position":"absolute","left":mybottom_conf.l+"px"});
				
				$(t.myleft_inner).css({"margin":padding+"px","overflow":"hidden","height":inner_height+"px","width":inner_width+"px","overflow":"hidden","1111background-color":"#FFFF00"});
				$(t.myleft_inner_con).css({"overflow":"hidden","height":inner_height+"px","width":inner_width+"px","overflow-y":"auto","overflow-x":"hidden"});
				$(t.myleft_inner_con_list).css({"overflow":"hidden","height":"auto","width":inner_width+"px"});
				var bt_h=inner_width;
				var bt_w=inner_width;
				var bt_div_margin=2;
				
				//$(t.myleft_inner_con_list).find(".bt").css({"width":bt_w+"px","height":bt_h+"px","overflow":"hidden"}).children().css({"margin":bt_div_margin+"px","line-height":(bt_h-bt_div_margin*2)-2+"px"});
				$(t.myleft_inner_con_list).find(".bt").css({"width":bt_w-(bt_div_margin*2)+"px","height":bt_h-(bt_div_margin*2)+"px","overflow":"hidden","line-height":(bt_h-bt_div_margin*2)-2+"px","margin":bt_div_margin+"px"}).parent().css({"height":bt_h+"px","width":bt_w+"px"});
				
				$(t.myright_inner).css({"margin":padding_r+"px","overflow":"hidden","height":inner_height_r+"px","width":inner_width_r+"px","overflow":"hidden"});
				$(t.myright_inner_con).css({"height":inner_height_r+"px","width":inner_width_r+"px","overflow-y":"auto","overflow-x":"hidden"});
				$(t.myright_inner_con_list).css({"height":inner_height_r+"px","width":inner_width_r+"px","overflow":"hidden","position":"relative"});
				$(t.myright_inner_con_list).find(".line1").css({"height":inner_height_r-50+"px"});
				//$(t.mybottom).css({"height":mybottom_conf.h+"px"});	
				w_jian=5;
				var bt_dati_div=$(t.mybottom).find(".bt_dati_div");
				 if(bt_dati_div.length>0){
				 $(t.mybottom).find(".bt_prevnext_div").css({"width":110+"px","left":"",right:"2px"});
				 }
				

				    $(t.rightmenu).css({display:"none"});
				    $(t.line1).css({"width":"100%"});
					$(t.mytypetishi).css({"width":myright_conf.w+"px","bottom":mybottom_conf.h+"px","position":"absolute","top":"","left":myleft_conf.w+"px"});
				
	  }

                $(t.mytypetishi).css({"line-height":"20px","color":"#1BBC9B","padding":"10px"});
				var rightmenu_width=$(t.rightmenu).width();
				var rightmenu_height=$(t.rightmenu).height();
				var z_left=$(window).width()-rightmenu_width-5;
				var z_top=(right_height-rightmenu_height)/2;
				var rightmenu_left=z_left;
				var rightmenu_top=z_top;
				var min_left=700;
			
				if(z_left<min_left){
					rightmenu_left=z_left;
				}else{
					rightmenu_left=min_left;
				}
				if(z_top<0){
					rightmenu_top=10;
				}

				if(g_lang=="ar"){
					rightmenu_left=z_left;
				
			  }	
			  
			  $(t.rightmenu).css({"left":rightmenu_left+"px","top":rightmenu_top+"px"});
	}
}

