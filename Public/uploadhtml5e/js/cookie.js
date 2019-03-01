// JavaScript Document
var cookie={
	Newkey:function(key){
		  key=key.replace("=",""); key=key.replace("=",""); key=key.replace(".","");key=key.replace(".","");  
		  return key;
	},
	Get:function(key){//获取值
		var str=document.cookie;
        var value="";
		key=this.Newkey(key);
		var arr=str.split("; ");//在cookie它是把每项用"; "分开的
		for(var i=0;i<arr.length;i++){
			 var arr1=arr[i].split("=");
			if(arr[i]!=""&&arr1.length>1){
			  arr1[1]=decodeURIComponent(arr1[1]);
			  arr1[1]=arr1[1].replace(new RegExp("#dh#","gm"),"="); 
			   if(String(key)==String(arr1[0])){
				   value=arr1[1];
				 break;
			  } 
		  }
		}  
		return value;
	},
	Add:function(key,value){//添加
		var str=document.cookie;
        value=""+value;
		value=value.replace(new RegExp("=","gm"),"#dh#"); 
		//alert(value);
        key=this.Newkey(key);
		var exp = new Date(); 
       exp.setTime (exp.getTime()+3600000000); 
       document.cookie = key + "=" + encodeURIComponent(value) + ";path=/; expires=" + exp.toGMTString(); 

		
	},
	Del:function(key){//删除
		  var date = new Date();
		   date.setTime(date.getTime() - 10000);
		   key=this.Newkey(key);
			var cval=cookie.Get(key);
			if(cval!=null&&cval!=""){
			  document.cookie= key + "="+cval+";path=/;expires="+date.toGMTString();
			}
	},Clear:function(){//清空
		  var keys=document.cookie.match(/[^ =;]+(?=\=)/g);
		  if (keys) {
			    for (var i = keys.length; i--;){
			    document.cookie=keys[i]+'=0;path=/;expires=' + new Date( 0).toUTCString();
			  }
		  }
	}
}