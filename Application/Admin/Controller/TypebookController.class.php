<?php
namespace Admin\Controller;
use Think\Controller;
class TypebookController extends CommController {
public function index()
{
	$type=D("Type");
	$list=$type->select();
	$this->assign("list",$list);
	$this->view("index");
}


    public function view($view)
    {
    	$this->display($view);
}
public function typeadd()
{

	$data=I('post.');
	$data['quanxian']='0';
	if(!empty($data["typename"]))
	{
       $user=D("Type");
       $res=$type->data($data)->add();
       if($res>0)
       {
         $this->success('success',U('Typebook/index'),3);exit;

       }
       else
       {
$this->error('failure',U('Typebook/typeadd'),3);exit;

       }
	}
	$this->view("typeadd");
}
public function delete()
{
	$typeid=I('get.id');
	$type=D("Type");
	$res= $type->where("id='$typeid'")->delete();
	if($res>0)
	{

		 $this->success('success',U('Typebook/index'),3);exit;
	}
	else
       {
$this->error('failure',U('Typebook/index'),3);exit;

       }
       

}

public function edit()
{
$id=I('get.id');
$type=D("Type");
$one=$type->where("typeid='$id'")->find();
$this->assign("one",$one);
$data=I('post.');
if(!empty($data["typename"]))
{
$res= $type->where("typeid='$id'")->save($data);
if($res>0)
	{

		 $this->success('success',U('Typebook/index'),3);exit;
	}
	else
       {
$this->error('failure',U('Typebook/typeedit'),3);exit;

       }
      
}
$this->view("edit");
}
public function login(){
$data=I('post.');
$typename=$data["typename"];
$where="typename='$typename'";
if(!empty($typename))
{

	$user=D("User");
	$one=$user->where($where)->find();
	if(!empty($one))
	{
		//echo"success";
		session("user",$one);
		$this->success('success',U('User/index'),3);exit;


	}
	else
	{

		//echo"failure";
	

$this->error('failure',U('User/login'),3);exit;
}
}
$this->view("login");
}
}