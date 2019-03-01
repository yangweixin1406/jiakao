<?php
namespace Admin\Controller;
use Think\Controller;
class 	BookController extends Controller {
public function index()
{
	  $book=D("Book");
	  $where["bookid"]=array("gt",0);  //eq 等于 GT这个是大于 表达式查询:http://document.thinkphp.cn/manual_3_2.html#express_query
	  
	  $count = $book->where($where)->count();
	  //import('ORG.Util.Page');
	  $pagesize=2; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $book->where($where)->order('bookid desc')->limit($page->firstRow.",".$page->listRows)->select();
	  $this->assign('list',$list);
	  $this->assign('show',$show);
	  $this->view('index');
}


public function view($view)
{
    	$this->display($view);
}
public function add()
{
		$booktype=D('Type');
		$list=$booktype->select();
		$this->assign('list',$list);
		$data=I('post.');
		$book=D('Book');
		if(!empty($data["bookname"]))
		{
		$res=  $book->data($data)->add();
		if($res>0)
		{
		
		$this->success('添加成功!',U('Book/index'),5);exit;
		}
		else
		{
		$this->error('添加失败!',U('Book/add'),5);exit;
		
		}
		
		}
		$this->view("add");
		}
}