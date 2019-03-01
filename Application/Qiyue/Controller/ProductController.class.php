<?php
namespace Home\Controller;
use Think\Controller;
class ProductController extends Controller {
    public function index(){
		//相关D,I,M 教程:http://www.thinkphp.cn/document/309.html
		//ThinkPHP3.2完全开发手册:http://document.thinkphp.cn/manual_3_2.html#upgrade_guide
		$book=D('book');
		$where["id"]=array("GT",0);  //GT这个是大于 表达式查询:http://document.thinkphp.cn/manual_3_2.html#express_query
        $this->userinfo();
		$count = $book->where($where)->count();
		//import('ORG.Util.Page');
		$pagesize=4; //分页分几条
		$page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
		$show = $page->show();
		$list = $book->where($where)->order('bookid desc')->limit($page->firstRow.",".$page->listRows)->select();
		$this->assign('list',$list);
		$this->assign('show',$show);
		$this->display(); 
    }
    public function info(){
		//相关D,I,M 教程:http://www.thinkphp.cn/document/309.html
		//ThinkPHP3.2完全开发手册:http://document.thinkphp.cn/manual_3_2.html#upgrade_guide
		$bookid=I("bookid");
		$book=D('book');
		$where["bookid"]=array("eq",$bookid);  //eq是等于 et这个是大于 表达式查询:http://document.thinkphp.cn/manual_3_2.html#express_query
		$info=$book->where($where)->find();
		$this->assign('info',$info);

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
}


