var kaoti20170414={
		init:function(opt){
		     var t=this;
			 t.opt=opt;
			 t.examlist=$(".exam_item");
			
			   $(".bt_show_all_daan").click(function(j){//显示全部答案
				     t.show_all_daan({bt:$(this)});
				});
				t.examlist.each(function(i){
                   t.add_exam_click($(this));
				})
		},add_exam_click:function(objitem){
			 var t=this;
				   var inputs=objitem.find(".ul1 li input");
				    objitem.find(".bt_add_favorites").click(function(j){
					   var isbool=1;
					   var id_bj=objitem.attr("data-id")+"#";
					   if(typeof(t.add_favorites_ids)!="undefined"&&t.add_favorites_ids.indexOf(id_bj)!=-1){isbool=0;}
					   if(isbool==1){
						    if(typeof(t.add_favorites_ids)!="undefined"){t.add_favorites_ids+=id_bj;}else{t.add_favorites_ids=id_bj;}
				            t.add_favorites({data:{objid:objitem.attr("data-id"),objidno:objitem.attr("data-idno"),objtable:t.opt.table,title:objitem.attr("data-title")}});
					   }
					  t.alert({msg:"<span class='span_tisi_color'>已加入收藏</span>",time:1000});
					});
					
					objitem.find(".photo img").click(function(){
								t.showimg($(this));
					});
					 objitem.find(".bt_remove_error").click(function(j){
																	 
								layer.confirm('确定要移除？', {
								   btn: ['取消','确认'] //按钮
								}, function(index){
                                       layer.close(index);
								}, function(){
									  t.sendpost({url:t.opt.app+"/"+t.opt.module+"/answer/remove.html",data:{type:objitem.attr("data-kemu"),objtable:t.opt.table,objid:objitem.attr("data-id"),isok:0,objidno:objitem.attr("data-idno")}});
									  objitem.remove();
									  layer.msg('已移除', {icon: 1});
										t.examlist=$(".exam_item");
										if(t.examlist.length==0){
											  $(".divnull_a").show();
										}
								});


					 });
					 objitem.find(".bt_remove_favorites").click(function(j){				 
								layer.confirm('确定要移除？', {
								   btn: ['取消','确认'] //按钮
								}, function(index){
                                       layer.close(index);
								}, function(){
									  t.sendpost({url:t.opt.app+"/"+t.opt.module+"/favorites/remove.html",data:{type:objitem.attr("data-kemu"),objtable:t.opt.table,objid:objitem.attr("data-id"),objidno:objitem.attr("data-idno")}});
									  objitem.remove();
									  layer.msg('已移除收藏', {icon: 1});
										t.examlist=$(".exam_item");
										if(t.examlist.length==0){
											  $(".divnull_a").show();
										}
								});
					 });
					 
					if(objitem.attr("data-type")=="2"){ //多选情况下
						   objitem.find(".bt_ok").click(function(j){
						      var daan="";
							   inputs.each(function(j){
								 if($(this)[0].checked){
									daan+=$(this).val();
								 }
							    });
							      objitem.attr("my-value",daan);
								 if(daan!=""){
									  t.showdaan({objitem:objitem,isshowdaan:1});
								  }else{
									  t.alert("请做答!");
								  }
						   });
						   inputs.each(function(j){
							   var input=$(this); 
							   input.click(function(){
							    var daan="";
								  //objitem.attr("my-value",daan);
									inputs.each(function(j){
									 if($(this)[0].checked){
										daan+=$(this).val();
									 }
									});

									  objitem.attr("my-value",daan);
									 t.showdaan({objitem:objitem,isshowdaan:0});
							   });
						   })
					}else{
					   inputs.each(function(j){
						   var input=$(this); 
						   input.click(function(){
						   var daan=$(this).val();
							   objitem.attr("my-value",daan);
                               t.showdaan({objitem:objitem,isshowdaan:1});
						   });
					   })
					}
		},showimg:function(img){//显示大图片
		var t=this;

//			newimg.src=this.src;
//			newimg.onload=function(){
//				
//			}
			var body=document.getElementsByTagName("body")[0];
			var div=document.createElement("div");
			div.style.cssText="position:fixed;_position:fixed;width:"+$(window).width()+"px;height:"+$(window).height()+"px;top:0px;left:0px;z-index:40000;background-color:#000000;";
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

		},showdaan:function(opt){
		                   	  var t=this;
		                      var objitem=opt.objitem;
							  var op=objitem.find(".op");
							  var data_daan=op.find(".data_daan");
							  var my_daan=op.find(".my_daan");
							  op.removeClass("op_ok");
							  op.removeClass("op_error");
							  if(opt.isshowdaan=="undefined"||opt.isshowdaan==1){
							      data_daan.html("正确的答案：<i>"+objitem.attr("data-value")+"</i>");
							      my_daan.html("你的答案：<i>"+objitem.attr("my-value")+"</i>");
								  var isok=1;
								  if(objitem.attr("my-value")==objitem.attr("data-value")){
									   op.addClass("op_ok");
									   if(layer){layer.msg('你答对的', {icon: 1});}
									   t.sendpost({url:t.opt.app+"/"+t.opt.module+"/exam/update_success_count.html",data:{objtable:t.opt.table,objid:objitem.attr("data-id"),objidno:objitem.attr("data-idno")}});
								  }else{
									   op.addClass("op_error");
									   isok=0;
									   if(layer){layer.msg('你答错的,答案为:'+objitem.attr("data-value"), {icon: 2});}
									  // t.alert({msg:"<span class='span_tisi_color'>已加入错题</span>",time:1000});
								  }
									   var isbool=1;
									   var id_bj=objitem.attr("data-id")+"#";
									   if(typeof(t.add_answer_ids)!="undefined"&&t.add_answer_ids.indexOf(id_bj)!=-1){
										   isbool=0;   
									   }
									   if(isbool==1){
										                    if(typeof(t.add_answer_ids)!="undefined"){t.add_answer_ids+=id_bj;}else{t.add_answer_ids=id_bj;}
										   				    if(typeof(t.opt.isadderror)=="undefined"||t.opt.isadderror==1){
					                                            t.add_answer({data:{type:objitem.attr("data-kemu"),objid:objitem.attr("data-id"),isok:isok,objtable:t.opt.table,value:objitem.attr("my-value"),title:objitem.attr("data-title"),objidno:objitem.attr("data-idno")}});
				                                             }
									   
									   }
							  }else{
							       data_daan.html("");
							       my_daan.html("你的答案：<i>"+objitem.attr("my-value")+"</i>");
							  }
							  t.show_tishi_title();
		},show_tishi_title:function(opt){
			var t=this;
			var count_success=0,count_yd=0,count_error=0;
			t.examlist.each(function(){
				var objitem=$(this);
				if(objitem.attr("my-value")!=null&&objitem.attr("my-value")!=""){
					count_yd++;
					if(objitem.attr("my-value")==objitem.attr("data-value")){
						 count_success++;
					}else{
					 	 count_error++;
					}
				}
			});
			 $(".tishi_title").html("已答"+count_yd+"题/答对"+count_success+"题/答错"+count_error+"题/共"+t.examlist.length+"题");
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
		},sendpost:function(opt){
		           var t=this;
				   $.ajax({
						  type:"post",
						  dataType:"text",
						   url:opt.url,
						   data:opt.data,
						   success:function(data1){
							   if(typeof(opt.showdata)!="undefined"){
								alert(data1);
							   }
						   }
					});
		},show_all_daan:function(opt){
			 var t=this;
			 var obj= t.examlist.find(".show_daan");
			if(obj.css("display")=="none"){
				 obj.show();  
				 opt.bt.val("隐藏答案");
			}else{
				 obj.hide(); 
				 opt.bt.val("显示答案");
			}
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
		}
}