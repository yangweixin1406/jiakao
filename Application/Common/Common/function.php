<?php 
function newrand($length,$type="1"){
	  $str_="";
	  $minno="";
	  $maxno="";
	  if($type=="1"){
		  if(is_numeric($length)){
			  for($i_=0;$i_<$length;$i_++){
				$f=rand(0,9);
				if($f==0){ $f=1; }
				$str_.=$f;
			  }
		  }
	  }
	  if($type==2){
			$str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//62个字符 
			$strlen = 62; 
			while($length > $strlen){ 
			$str .= $str; 
			$strlen += 62; 
			} 
			$str = str_shuffle($str); 
			$str_=substr($str,0,$length); 
	  }
	  if($type==3){
	     $str_=to_guid_string($length);
	  }
	  return $str_;
}
	function httprequest($curl,$data=null){
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$curl); 
			curl_setopt($ch,CURLOPT_HEADER,0); 
			if(!empty($data)){
			  if(is_array($data)){
			   $data = http_build_query($data);
			  }
			  curl_setopt($ch,CURLOPT_POST,1);
			  curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
			}
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 1);    //这句要加上
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);//这句要加上
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 ); 
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
			$res = curl_exec($ch); 
			curl_close($ch); 
			return $res;
	}
	function sendemail($title,$content,$to,$smtpserver,$smtpserverport,$smtpuser,$smtppwd,$smtpsecure=""){
		  //header("content-type:text/html;charset=utf-8");
		  ini_set("magic_quotes_runtime",0);
		 
		  try {
		      vendor('phpmailer.class#phpmailer');
			  $mail = new PHPMailer(true); 
			  $mail->IsSMTP();
			  $mail->CharSet='UTF-8'; //设置邮件的字符编码，这很重要，不然中文乱码
			  $mail->SMTPAuth   = true;                  //开启认证
			  $mail->Port       = $smtpserverport;                    
			  $mail->Host       = $smtpserver; 
			  $mail->Username   = $smtpuser;
			  $mail->SMTPSecure   = $smtpsecure;      
			  $mail->Password   = $smtppwd;            
			  //$mail->IsSendmail(); //如果没有sendmail组件就注释掉，否则出现"Could  not execute: /var/qmail/bin/sendmail "的错误提示
			  $mail->AddReplyTo($smtpuser,"mckee");//回复地址
			  $mail->From       = $smtpuser;
			  $mail->FromName   = "";
			  $mail->AddAddress($to);//发送给谁
			  $mail->Subject  = $title;

			  $mail->Body =$content;
			 // $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; //当邮件不支持html时备用显示，可以省略
			  $mail->WordWrap   = 200; // 设置每行字符串的长度
			  //$mail->AddAttachment("f:/test.png");  //可以添加附件
			  $mail->IsHTML(true); 
			  $mail->Send();
			  return "发送成功";
		  
		  } catch (phpmailerException $e) {
			  return "邮件发送失败1：".$e->errorMessage();
		  }
	}
	function sendemail_a($data){
	   //var_dump($data);
	   return sendemail($data["title"],$data["content"],$data["to"],$data["smtpserver"],$data["smtpserverport"],$data["smtpuser"],$data["smtppass"],$data["smtpsecure"]);
	}
?>