<?php
namespace Admin\Controller;
use Think\Controller;
class OrdersController extends CommController {
public $tablename="orders";
public $tablename1="orders_detail";
public $urldir="Admin/orders";
public $lang="订单";
public function index()
{
    $this->lists();
}
public function lists()
{
	$mod=D($this->tablename);
	

	$title=I("title");
	$orderno=I("orderno");
	$tradeno=I("tradeno");
	$status=I("status");
	$total=I("total");
    $contact=I("contact");
	
	if($title!=""){
	 $where["title"]=array('like',"%".$title."%");
	}
	if($orderno!=""){
	  $where["orderno"]=array('like',"".$orderno."%");
	}
	if($tradeno!=""){
	  $where["tradeno"]=array('like',"".$tradeno."%");
	}
	if($status!=""){
	 $where["status"]=array('eq',$status);
	}
	if($total!=""){
	  $where["total"]=array('eq',$total);
	}
	if($contact!=""){
	 $where["contact"]=array('eq',$contact);
	}
	$count = $mod->where($where)->count();
	$item=I('get.');
	$item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $pagesize=20; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  $orders_status=json_decode(C("orders_status"),true);
	  foreach($orders_status as $k=>$v){
			     $statuscaption[$v["value"]]=$v["title"];
	  }
	  foreach($list as $key=>$row){
          $list[$key]["status_caption"]=$statuscaption[$row["status"]];
	  }
	   $item["num"]=count($list);
	  $this->assign('statuslist',json_decode(C("orders_status"),true));
	  $this->assign('webtitle',$this->lang."列表");
	  $this->assign('mytitle',"<i class='i-n'>".$this->lang."</i>列表");
	  $this->assign('item',$item);
	  $this->assign('list',$list);
	  $this->assign('show',$show);
	  $this->assign("lang",$this->lang);
	  //$this->view('index');
	   $this->display("lists");
}

public function delete()
{
	$orders=D($this->tablename);
	$ordersdetail=D($this->tablename1);
	
	$id=I("id");
	$where["ordersid"]=array("eq",$id); //eq 等于 GT这个是大于 表达式查询:http://document.thinkphp.cn/manual_3_2.html#express_query 
	$info=$orders->where($where)->find();

	if($info)
	{
		 $ordersno=$info['ordersno'];
		 $where2["ordersno"]=array("eq",$ordersno);
	     $ordersdetail->where($where2)->delete();
		 $orders->where($where)->delete();
		 $this->success('已删除',U('Orders/index'),3);exit;
	}
	else{
           $this->error('删除失败',U('User/index'),3);exit;

    }   

}

public function info()
{
		$userone=$_SESSION["user"];
		if(!$userone){
			  $this->success('请先登录',U('User/login'),3);exit;
			 exit();
		}
		$orders=D($this->tablename);
		$ordersdetail=D($this->tablename1);
		$id=I("id");
		$where["orderid"]=array("eq",$id); //eq 等于 GT这个是大于 表达式查询:http://document.thinkphp.cn/manual_3_2.html#express_query 
		$info=$orders->where($where)->find();
		//echo $orders->getLastSql(); 打印sql
        //$this->show($orders->getLastSql());
		$this->assign('info',$info);
		$orderno=$info['orderno'];
		$where2["orderno"]=array("eq",$orderno);
		$detail=$ordersdetail->where($where2)->select();
		$total=0;
		$num=0;
		foreach($detail as $key=>$val){
			$detail[$key]["pricez"]=$detail[$key]["price"]*$detail[$key]["num"];
			$total+=$detail[$key]["pricez"];
			$num+=$detail[$key]["num"];
		}
		$item["total"]=$total;
		$item["num"]=$num;
		 $lablelist=json_decode(C("orders_lable"),true);
		$this->assign('webtitle',"更新".$this->lang);
		$this->assign('mytitle',"<i class='i-n'>".$this->lang."</i>信息");
		$this->assign('detail',$detail);
		$this->assign('lablelist',$lablelist);
		$this->assign('item',$item);
		$this->assign("lang",$this->lang);
		$this->display('info');
}
public function save()
{

    $id=I('id');
	$data=I('post.');
	$mod=D($this->tablename);

	if($_POST){
		    $where["id"]=$id;
		    $rs=$mod->where($where)->save($data);
			//exit();
			$this->showmessage('已更新',U($this->urldir.'/info/',array("id"=>$id)),3);exit;


	}

   
 }
}
