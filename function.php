<?php 
function NewRand($median_){
	  $str_="";
	  $minno="";
	  $maxno="";
	  if(is_numeric($median_)){
			for($i_=0;$i_<$median_;$i_++){
			   $f=rand(0,9);
			   if($f==0){$f=1;}
			   $str_.=$f;
			}
	  }
	  return $str_;
}
?>