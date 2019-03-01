<?php
namespace Home\Controller;
use Think\Controller;
class OrdersController extends Controller {
    public $tablename="orders";
	public $tablename1="orders_detail";
    public function index(){
		//相关D,I,M 教程:http://www.thinkphp.cn/document/309.html
		//ThinkPHP3.2完全开发手册:http://document.thinkphp.cn/manual_3_2.html#upgrade_guide
		$userid=trim($_SESSION["userid"]);
		if($userid==""){
			 header("location:".U('/Home/User/login'));
			 exit();
		}
        $this->userinfo();
		$orders=D($this->tablename);
		$ordersdetail=D($this->tablename1);
		$where["userid"]=array("eq",$userid);  //GT这个是大于 表达式查询:http://document.thinkphp.cn/manual_3_2.html#express_query
		
		
		$count = $orders->where($where)->count();
		//import('ORG.Util.Page');
		$pagesize=4; //分页分几条
		$page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
		$show = $page->show();
		$list = $orders->where($where)->order('addtime desc')->limit($page->firstRow.",".$page->listRows)->select();
		
		foreach($list as $key=>$val){
			$detail_map=array();
			$detail_map["ordersno"]=array("eq",$val["ordersno"]); 
			
			$detail=$ordersdetail->where($detail_map)->select();
			//$user->getLastSql();
			$list[$key]['detail']=$detail;
		}
		$this->assign('list',$list);
		$this->assign('show',$show);
		$this->display(); 
    }
    public function say (){

    }
	public function userinfo(){
		$userid=trim($_SESSION["userid"]);
		//echo $userid;
		//exit();
		$user=D("user");
		$usermap["id"]=array("eq",$userid);
		$user_row=$user->where($usermap)->find();
		//echo $user->getLastSql();
		if($user_row){
			$this->assign('userinfo',$user_row);
		}
	}
	public function del(){
		$ordersid=trim($_SESSION["ordersid"]);
		//echo $userid;
		//exit();
		$ordersid=I("ordersid");
		$orders=D($this->tablename);
		$ordersdetail=D($this->tablename1);
		$map["ordersid"]=array("eq",$ordersid);
		
		$row=$orders->where($map)->find();
		echo $orders->getLastSql();
		if($row){
			$orders->where($map)->delete();
			$map1["ordersno"]=array("eq",$row["ordersno"]);
			$ordersdetail->where($map1)->delete();
		}
		//echo $user->getLastSql();
		echo "已删除";
	}
}


