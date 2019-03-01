<?php
namespace Home\Controller;
use Think\Controller;
class BuycarController extends Controller { //文件名称是BuycarController.class.php那这里的类名也要一样是Buycar
     public $car_name="mycar";
    public function index(){
		//相关D,I,M 教程:http://www.thinkphp.cn/document/309.html
		//ThinkPHP3.2完全开发手册:http://document.thinkphp.cn/manual_3_2.html#upgrade_guide
		$book=D('book');
		$this->userinfo();
		$str=trim($_SESSION[$this->car_name]);
		$items=explode("[row]",$str);//分割成数组
		 for($i=0;$i<count($items);$i++){ //count这个函数是计算数组长度sizeof也可以
			$v=explode("=",$items[$i]);
			$where["bookid"]=array("eq",$v[0]);
			$row=$book->where($where)->find();//find取出来是一维数组
			if($row){ 
			   //mypricez，mycountz这两个是我们自定义的
			   $row["mycountz"]=$v[1];
			   $row["mypricez"]=$row["mycountz"]*$row["bookprice"];
			   $list[]=$row;//添加数组进入$list这个变量
			}
		 }
		 $act=I("act");
		 if($act=="add"){
			// 
		 }
		$this->assign('list',$list);
		$this->display('index'); //叫它调用这个index.html模板
    }
	
    public function add(){
	  $bookid=I("bookid");
	  $str=trim($_SESSION[$this->car_name]);
	  $num=trim(I("num"));
	  if(!is_numeric($num)||$num==""){
		  $num=1;
	  }
	  $row_str=$bookid."=".$num; 
	  if($str==""){
		   $_SESSION[$this->car_name]=$row_str;
	  }else{
		 $items=explode("[row]",$mycar);//分割成数组
		 if(!$this->ishave($bookid)){ //不存在则添加到session里
			$_SESSION[$this->car_name]=$_SESSION[$this->car_name]."[row]".$row_str;
		 }
	  }
	   header("location:".U('/Home/Buycar/index/',"act=add"));
	  // $this->success('操作完成',U('/Home/Buycar/'),3);
	  //$this->index();
    }
	public function ishave($id){
		$isbool=false;
		$str=trim($_SESSION[$this->car_name]);
		$items=explode("[row]",$str);//分割成数组
		 for($i=0;$i<count($items);$i++){ //count这个函数是计算数组长度sizeof也可以
			$row=explode("=",$items[$i]);
			if($row[0]==$id){
				$isbool=true;
			}
		 }
		 return $isbool;
	}
	public function update(){
		$bookid=I("bookid");
		$num=trim(I("num"));
		$str=trim($_SESSION[$this->car_name]);
		$items=explode("[row]",$str);//分割成数组
		 for($i=0;$i<count($items);$i++){ //count这个函数是计算数组长度sizeof也可以
			$row=explode("=",$items[$i]);
			if($row[0]==$bookid){//找到并重置
				$items[$i]=$bookid."=".$num; 
			}
		 }
		 $new_str="";//新值
		 for($i=0;$i<count($items);$i++){
			if($new_str!=""){
				$new_str.="[row]".$items[$i];
			}else{
				$new_str=$items[$i];
			}
		 }
		$_SESSION[$this->car_name]=$new_str;
		echo "已更新->BuycarController.class.php中的update函数";
	}
	public function del(){
		$new_str="";//新值
		$bookid=I("bookid");
		$index=I("index");
		if($index==""){
			$this->del_bookid();
		}else{
			$this->del_index();
		}
	}
	public function del_bookid(){//按bookid删除
		$new_str="";//新值
		$bookid=I("bookid");
		$str=trim($_SESSION[$this->car_name]);
		$items=explode("[row]",$str);//分割成数组
		 for($i=0;$i<count($items);$i++){ //count这个函数是计算数组长度sizeof也可以
			$row=explode("=",$items[$i]);
			if($row[0]!=$bookid){//不是要删除的则
				  if($str!=""){
					  $new_str.="[row]".$items[$i];
				  }else{
					  $new_str=$items[$i];
				  }
			}
		 }
		$_SESSION[$this->car_name]=$new_str;
		echo "已删除->BuycarController.class.php中的del函数";
	}
		public function del_index(){//按索引删除
		$new_str="";//新值
		$index=I("index");
		$str=trim($_SESSION[$this->car_name]);
		$items=explode("[row]",$str);//分割成数组
		 for($i=0;$i<count($items);$i++){ //count这个函数是计算数组长度sizeof也可以
			if($i!=$index){//不是要删除的则
				  if($new_str!=""){
					  $new_str.="[row]".$items[$i];
				  }else{
					  $new_str=$items[$i];
				  }
			}
		 }
		$_SESSION[$this->car_name]=$new_str;
		echo "已删除->BuycarController.class.php中的del函数";
	}
	public function buy(){
		$userid=trim($_SESSION["userid"]);
		if($userid==""){
			 header("location:".U('/Home/User/login'));
			 exit();
		}
		$bookid=I("bookid");
		if($bookid!=""){
			 $this->buy_only();
		}else{
			 $this->buy_more();
		}

	}
	public function buy_only(){//单个
		$userid=trim($_SESSION["userid"]);
		if($userid==""){
			$this->success('请先登',U('/Home/User/login'),3);//跳转提示的模板是 ThinkPHP\Top\dispatch_jump.tpl
			exit();
		}
		
		//获取会员名
		$user=D('user');
		$usermap["id"]=array("eq",$userid);
		$user_row=$user->where($usermap)->find();
		$username=$user_row["username"];
		
		
		$book=D('book');
		$bookid=I("bookid");
		$addtime=date("Y-m-d H:i:s");
		$str=trim($_SESSION[$this->car_name]);
		$new_str="";//新值
		$nums=0;
		$addtime=date("Y-m-d H:i:s");
		$ordersno="NO".date("YmdHis");
		$items=explode("[row]",$str);                  //分割成数组
		 for($i=0;$i<count($items);$i++){              //count这个函数是计算数组长度sizeof也可以
			$v=explode("=",$items[$i]);
			$num=$v[1];
			if($v[0]==$bookid){                         //找到并重置
				  $where["bookid"]=array("eq",$v[0]);
				  $row=$book->where($where)->find();    //find取出来是一维数组
				  if($row){ 
                    $total+=$row["bookprice"]*$num;//总金额
					$nums+=$num;//总数量
					$map2["userid"]=$userid;
					$map2["username"]=$username;
					$map2["bookid"]=$bookid;
					$map2["bookname"]=$row["bookname"];
					$map2["bookprice"]=$row["bookprice"];
					$map2["nums"]=$num;
					$map2["ordersno"]=$ordersno;
					$map2["addtime"]=$addtime;
                    $maps[]=$map2;//添$map2数组添加到$maps数组里
				  }
			}
			if($v[0]!=$bookid){                         //不是要删除的则
				  if($new_str!=""){
					  $new_str.="[row]".$items[$i];
				  }else{
					  $new_str=$items[$i];
				  }
			}
		 }
		 
		$map1["userid"]=$userid;
		$map1["username"]=$username;
		$map1["total"]=$total;
		$map1["nums"]=$nums;
		$map1["ordersno"]=$ordersno;
		$map1["addtime"]=$addtime;
		$orders=D('orders');
		$orders->add($map1);//添加到mysql里
		
		$orders_detail=D('orders_detail');
		for($j=0;$j<count($maps);$j++){
		  $orders_detail->add($maps[$j]);  //添加明细
		}
		$_SESSION[$this->car_name]=$new_str;            //重新赋值
		$this->success('下单成功',U('/Home/Product/'),3);//跳转提示的模板是 ThinkPHP\Top\dispatch_jump.tpl
	}
	public function buy_more(){ //多个
		$userid=trim($_SESSION["userid"]);
		if($userid==""){
			$this->success('请先登',U('/Home/User/login'),3);//跳转提示的模板是 ThinkPHP\Top\dispatch_jump.tpl
			exit();
		}
		
		//获取会员名
		$user=D('user');
		$usermap["id"]=array("eq",$userid);
		$user_row=$user->where($usermap)->find();
		$username=$user_row["username"];
		
		$book=D('book');
		$bookid=I("bookid");
		$str=trim($_SESSION[$this->car_name]);
		$new_str="";//新值
		$nums=0;
		$addtime=date("Y-m-d H:i:s");
		$ordersno="NO".date("YmdHis");
		$items=explode("[row]",$str);                  //分割成数组
		 for($i=0;$i<count($items);$i++){              //count这个函数是计算数组长度sizeof也可以
			$v=explode("=",$items[$i]);
			$num=$v[1];
			$where["bookid"]=array("eq",$v[0]);
			$row=$book->where($where)->find();    //find取出来是一维数组
			if($row){ 
				  $total+=$row["bookprice"]*$num;//总金额
				  $nums+=$num;//总数量
				  $map2["userid"]=$userid;
				  $map2["username"]=$username;
				  $map2["bookid"]=$bookid;
				  $map2["bookname"]=$row["bookname"];
				  $map2["bookprice"]=$row["bookprice"];
				  $map2["nums"]=$num;
				  $map2["ordersno"]=$ordersno;
				  $map2["addtime"]=$addtime;
				  $maps[]=$map2;//添$map2数组添加到$maps数组里
			}
		 }
		$map1["userid"]=$userid;
		$map1["username"]=$username;
		$map1["total"]=$total;
		$map1["nums"]=$nums;
		$map1["ordersno"]=$ordersno;
		$map1["addtime"]=$addtime;
		$orders=D('orders');
		$orders->add($map1);//添加到mysql里
		
		$orders_detail=D('orders_detail');
		for($j=0;$j<count($maps);$j++){
		  $orders_detail->add($maps[$j]);  //添加明细
		}
		 $this->success('下单成功',U('/Home/Product/'),3);//跳转提示的模板是 ThinkPHP\Top\dispatch_jump.tpl
		$_SESSION[$this->car_name]=$new_str; 
	}
	public function userinfo(){
		$userid=trim($_SESSION["userid"]);
		$user=D("user");
		$usermap["id"]=array("eq",$userid);
		$user_row=$user->where($usermap)->find();
		if($user_row){
			$this->assign('userinfo',$user_row);
		}
	}
}


