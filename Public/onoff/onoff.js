function onoff(id,w){
			     var txt1=$("#"+id).attr("txt1");
			     var txt2=$("#"+id).attr("txt2");
				 var input=$("#"+id);
			     var onoff=$("<div id='"+id+"_onoff' class='onoff' style='width:"+(w)+"px'><span style='width:"+(w/2)+"px'></span></div>");
				 input.parent().append(onoff);
				 var span=onoff.find("span");
				 
				 if(input.val()=="0"){
				      input.val(0);
				      span.css({"left":"","right":"0px"}).html(txt2);
					  if(input.attr("same")=="1"){
					  span.attr("class","on");
					  }else{
					  span.attr("class","off");
					  }
				 }else{
				      input.val(1);
				      span.css({"left":"0px","right":""}).html(txt1);
					  span.attr("class","on");
				 }
				 
			     onoff.click(function(){
				      if(input.val()==1){
					      span.css({"left":"","right":"0px"}).html(txt2);
					      input.val(0);
						  if(input.attr("same")=="1"){
						  span.attr("class","on");
						  }else{
						  span.attr("class","off");
						  }
					  }else{
					     span.css({"left":"0px","right":""}).html(txt1);
						 input.val(1);
						 span.attr("class","on");
					  }

				 });
}
			onoff('status',100);