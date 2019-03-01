// JavaScript Document
var fuhao=",";
function update_photo(opt){
 //alert(opt.inputid);
	var input=document.getElementById(opt.inputid);
	//alert("update_photo->上传成功！");

	if(input&&typeof(opt.small)!="undefined"){
		  if(input.value!=""){
		     input.value+=fuhao+opt.small;
		  }else{
		     input.value=opt.small;
		  }
		  	//alert(opt.small);
	}
	var siteurl="../";
	var arr=input.value.split(""+fuhao);
	 var divlist=document.getElementById(opt.inputid+"_div");
	 if(divlist){
	        var newstr="";
             divlist.innerHTML="";
	 	          for(var i=0;i<arr.length;i++){
			        var src=arr[i];
						 if(src!=""){
							 if(newstr!=""){
								 newstr+=fuhao+src;
							 }else{
								newstr=src;
							 }
						  }
				   }

				   input.value=newstr;
				   if(input.value!=""){
					  var items=input.value.split(fuhao);
					  for(var i=0;i<items.length;i++){
							   var src=items[i];
							 
							   var uploadiframe_item=document.createElement("div");
							   uploadiframe_item.className="uploadiframe_item";
							   divlist.appendChild(uploadiframe_item);
							   var item_photo=document.createElement("div");
							   item_photo.className="item_photo";
							   uploadiframe_item.setAttribute("data-index",i);
							   item_photo.innerHTML="<table cellspacing='0' cellpadding='0'><tr><td valign='middle' align='center' ><a href='"+opt.qzimg+src+"' target='_blank'><img src='"+opt.qzimg+src+"'/></a></td></tr></table>";
							   uploadiframe_item.appendChild(item_photo);
							   var item_del=document.createElement("a");
							   item_del.className="item_del";
							   item_del.innerHTML="\u0026\u0023\u0032\u0031\u0035\u003b";//×的Unicode编码
							    uploadiframe_item.appendChild(item_del);
								item_del.onclick=function(){
								                      var index=this.parentNode.getAttribute("data-index");
								   					   var items=input.value.split(fuhao);
													   this.parentNode.parentNode.removeChild(this.parentNode);
													   var newstr="";
					                                   for(var i=0;i<items.length;i++){
															 var src=items[i];
															 if(src!=""&&i!=parseInt(index)){
																 if(newstr!=""){
																	 newstr+=fuhao+src;
																 }else{
																	 newstr=src;
																 }
															  }
													   }
													   input.value=newstr;
								}
						}
					}
	 }
//	$.ajax({
//		url:"xingxiang.asp",
//		data:{act:"touxiang",small:opt.small,big:opt.big},
//		type:"get",
//		success:function(data1){
//			//alert(data1); 
//			alert("恭喜：头像上传并保存成功！");
//		}
//	});
}