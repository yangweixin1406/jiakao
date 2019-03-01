<?php
namespace Home\Controller;
use Think\Controller;
class ShopController extends \Home\Controller\CommController{
    public $tablename="product";
	public $tablename1="product_class";
	public $product_fatherno="00010001";
    public function index(){
	 $userq=session("userq");
	 $mod=D($this->tablename);
	 $where["id"]=array('gt',0);
	  $dianjiaid=I("djid");
	  $dianjiaid=(isset($_GET["djid"])?$_GET["djid"]:1);//店家id
	  if(!is_numeric($dianjiaid)){$dianjiaid=1; }
	  $where["dianjiaid"]=array('eq',$dianjiaid);
	  if(I("get.djclassid")!=""){$where["djclassid"]=array('eq',I("get.djclassid"));}
	  $orders_lable=json_decode(C("orders_lable"),true);
	  foreach($orders_lable as $k=>$v){
			     $lables[$v["value"]]=$v["title"];
	  }
	 $where["lable"]=array('eq',"rec");
	 $count = $mod->where($where)->count();
	 $item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $pagesize=9; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$row){
	        $w["id"]=$row["userid"];
	        $userone=M("user")->where($w)->find();
			if($userone){
			   $list[$key]["logo"]=$userone["photo"];
			}
			$list[$key]["lablecaption"]=$lables[$row["lable"]];
	  }

	   $w2["dianjiaid"]=$dianjiaid;
	   $dianjia=M("user")->where("id='".$dianjiaid."'")->find();
	   
	   $pclass = M("product_class")->where($w2)->order('id desc')->limit("0,20")->select();
	   $web["title"]=$dianjia["shopname"];
	   
	   $web["num"]=count($list);
       $web["djclassid"]=I("get.djclassid");
       $jiaodantu=explode("#","123.jpg#456.jpg");
       $info["jiaodantu"]=$jiaodantu;
		   $wh['shopname']=array('neq','');
		   $wh['root']=array('eq','6');
		   $shop = M("user")->where($wh)->order($orderby)->field('id,shopname,photo')->select();
		  
	   $dianjia['nullimg']=__PUBLIC__."/images/null.gif"; 

	   $this->assign('web',$web);
	   $this->assign('info',$info);
	   $this->assign('dianjia',$dianjia);
	   $this->assign('list',$list);
	   $this->assign('pclass',$pclass);
	   $this->assign('shop',$shop);
	   $this->assign('show',$show);
	   $this->display();
    }
    public function home(){
	 $userq=session("userq");
	 $mod=D($this->tablename);
	 $where["id"]=array('gt',0);
	  $dianjiaid=I("djid");
	  $dianjiaid=(isset($_GET["djid"])?$_GET["djid"]:1);//店家id
	  if(!is_numeric($dianjiaid)){$dianjiaid=1; }
	  $where["dianjiaid"]=array('eq',$dianjiaid);
	  if(I("get.djclassid")!=""){$where["djclassid"]=array('eq',I("get.djclassid"));}
	  $orders_lable=json_decode(C("orders_lable"),true);
	  foreach($orders_lable as $k=>$v){
			     $lables[$v["value"]]=$v["title"];
	  }
	   $where["lable"]=array('eq',"rec");
	 $count = $mod->where($where)->count();
	 $item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $pagesize=9; //分页分几条
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order('id desc')->limit($page->firstRow.",".$page->listRows)->select();
	  foreach($list as $key=>$row){
	        $w["id"]=$row["userid"];
	        $userone=M("user")->where($w)->find();
			if($userone){
			   $list[$key]["logo"]=$userone["photo"];
			}
			$list[$key]["lablecaption"]=$lables[$row["lable"]];
	  }

	   $w2["dianjiaid"]=$dianjiaid;
	   $dianjia=M("user")->where("id='".$dianjiaid."'")->find();
	   
	   $pclass = M("product_class")->where($w2)->order('id desc')->limit("0,20")->select();
	   $web["title"]=$dianjia["shopname"];
	   
	   $web["num"]=count($list);
       $web["djclassid"]=I("get.djclassid");
       $jiaodantu=explode("#","123.jpg#456.jpg");
       $info["jiaodantu"]=$jiaodantu;
		
	   $dianjia['nullimg']=__PUBLIC__."/images/null.gif"; 
	   $this->assign('web',$web);
	   $this->assign('info',$info);
	   $this->assign('dianjia',$dianjia);
	   $this->assign('list',$list);

	   $this->assign('pclass',$pclass);
	   $this->assign('show',$show);
	   $this->display();
    }
	public function info(){
	       $user=D("user");
		   $userone=session("userq");
           if($_POST){
				    $data=I("post.");
					 if(!$userone){
					  exit("{\"status\":\"error\",\"msg\":\"请先登录\"}"); 
					 }
					 $data1=$data;
					 unset($data1["userpwd"]);
					 unset($data1["quanxian"]);
					 $where1["id"]=$userone["id"];
					 $userone=$user->where(" id='".$userone["id"]."'")->find();
					 session("userq",$userone);
					 $r=$user->where($where1)->save($data1);
					 exit("{\"status\":\"success\",\"msg\":\"资料修改成功{$r}\"}"); 
	       }
		  if(!$userone){
			  echo "<script>window.location='".__APP__."/".C('DEFAULT_MODULE')."/user/login';</script>";
			  exit();
		  }
		   $web["title"]="我的资料";
		   $web["title1"]="修改资料";
		   $this->assign('info',$userone);
		   $this->assign('web',$web);
		   $this->display();
	}
	public function plists(){//店家产品列表
	
	 $userq=session("userq");
	 $mod=D($this->tablename);
	 $where["id"]=array('gt',0);
	  $pagesize=15; //分页分几条
	  $dianjiaid=I("djid");
	   $skey=I("key");
	  $dianjiaid=(isset($_GET["djid"])?$_GET["djid"]:1);//店家id
	  if(!is_numeric($dianjiaid)){$dianjiaid=1; }
	  $where["dianjiaid"]=array('eq',$dianjiaid);
	 if(I("get.djclassid")!=""){$where["djclassid"]=array('eq',I("get.djclassid"));}
	  $orders_lable=json_decode(C("orders_lable"),true);
	  foreach($orders_lable as $k=>$v){
			     $lables[$v["value"]]=$v["title"];
	  }
	  $orderby="id asc";
	  if(I("xinpin")==1){
		  $pagesize=9;
		  $orderby="id desc";
	  }
	  if($skey!=""){
		 $where['title']=array('like','%'.$skey.'%');
	   }
	 $count = $mod->where($where)->count();
	 $item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order($orderby)->limit($page->firstRow.",".$page->listRows)->field('title,id,price,prices,photo,photos,dianjiaid,classid')->select();
	  foreach($list as $key=>$row){
	        $w["id"]=$row["userid"];
	        $userone=M("user")->where($w)->find();
			if($userone){
			   $list[$key]["logo"]=$userone["photo"];
			}
			$list[$key]["lablecaption"]=$lables[$row["lable"]];
			//$list[$key]["sql"]=$mod->getLastSql();
	  }
	 
       if(I("isajax")==1){
	     ob_clean();
	     echo json_encode($list,true);
	     exit();
	   }
	   $w2["dianjiaid"]=$dianjiaid;
	   $dianjia=M("user")->where("id='".$dianjiaid."'")->find();
	   
	       
	   $pclass = M("product_class")->where($w2)->order('id desc')->limit("0,20")->select();
	   $web["title"]=$dianjia["shopname"];
	   
	   $web["num"]=count($list);
       $web["djclassid"]=I("get.djclassid");
	   $dianjia['nullimg']=__PUBLIC__."/images/null.gif"; 
	   $this->assign('web',$web);
	   $this->assign('dianjia',$dianjia);
	   $this->assign('list',$list);
	   $this->assign('pclass',$pclass);
	   $this->assign('show',$show);
	   $this->display();
	}
	public function pdetail(){//店家产品信息
	       $user=D("user");
		   $mod=M("product");
		   $userone=session("userq");
           $data=I("get.");
		   $info=M("product")->where(" id='".$data["id"]."'")->find();
		  if(!$info){
			  $url=U('home/index/index');
			  $this->error('已被删除',$url,3);exit;
		  }
		   $dianjia=M("user")->where(" id='".$info["dianjiaid"]."'")->find();
		$info["photos"]= str_ireplace("s50/","s100/",$info["photos"]);
        $jiaodantu=explode("#",$info["photos"]);
        $info["jiaodantu"]=$jiaodantu;
//echo dirname(__APP__);
		   $dianjia['nullimg']=dirname(__APP__)."/public/images/null.gif"; 
		   $web["title"]=$info["title"];
		   $w2["lable"]="rec";
		   $protj=$mod->where($w2)->order('id desc')->limit("0,20")->select();
		   $this->assign('dianjia',$dianjia);
		   $this->assign('protj',$protj);
		   $this->assign('info',$info);
		   $this->assign('web',$web);
		   $this->display();
	}
	public function pclass(){//店家产品分类
	
	 $userq=session("userq");
	 $mod=D($this->tablename1);
	 $modp=M("product");
	 $where["id"]=array('gt',0);
	 $pagesize=6; //分页分几条
	 $dianjiaid=I("djid");
	 $dianjiaid=(isset($_GET["djid"])?$_GET["djid"]:1);//店家id
	 if(!is_numeric($dianjiaid)){$dianjiaid=1; }
	 $where["dianjiaid"]=array('eq',$dianjiaid);
	 $orderby="id asc";
	 $count = $mod->where($where)->count();
	 $item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order($orderby)->limit($page->firstRow.",".$page->listRows)->field('title,id,dianjiaid')->select();

	  foreach($list as $key=>$row){
	        $w["djclassid"]=$row["id"];
			$w["dianjiaid"]=$row["dianjiaid"];
	        $productnum=$modp->where($w)->count('id');
			$list[$key]["productnum"]=$productnum;
	  }
       if(I("isajax")==1){
	     ob_clean();
	     echo json_encode($list,true);
	     exit();
	   }
	   $w2["dianjiaid"]=$dianjiaid;
	   $dianjia=M("user")->where("id='".$dianjiaid."'")->find();
	   $web["title"]=$dianjia["shopname"];
	   $web["num"]=count($list);
       $web["djclassid"]=I("get.djclassid");
	   $dianjia['nullimg']=__PUBLIC__."/images/null.gif"; 
	   $this->assign('web',$web);
	   $this->assign('dianjia',$dianjia);
	   $this->assign('list',$list);
	   $this->assign('show',$show);
	   $this->display();
	}
	public function classlist(){//不限制商家的产品类别
	 $userq=session("userq");
	 $mod=D("class");
	 $modp=M("product");
	 $where["id"]=array('gt',0);
	 $pagesize=6; //分页分几条
	 $fatherno=I("fatherno");
	 if(!is_numeric($dianjiaid)){$dianjiaid=1; }
	 if($fatherno==""){$where["fatherno"]=array('eq',$this->product_fatherno);}
	 $orderby="id asc";
	 $count = $mod->where($where)->count();
	 $item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order($orderby)->limit($page->firstRow.",".$page->listRows)->field('title,id,photo')->select();

	  foreach($list as $key=>$row){
			$w['classno']  = array('like',''.$row["classno"].'%');
	        $productnum=$modp->where($w)->count('id');
			$list[$key]["productnum"]=$productnum;
	  }
       if(I("isajax")==1){
	     ob_clean();
	     echo json_encode($list,true);
	     exit();
	   }
	   $web["title"]="服务类别";
	   $web["num"]=count($list);
       $web["djclassid"]=I("get.djclassid");
	   $dianjia['nullimg']=__PUBLIC__."/images/null.gif"; 
	   $this->assign('web',$web);
	   $this->assign('dianjia',$dianjia);
	   $this->assign('list',$list);
	   $this->assign('show',$show);
	   $this->display();
	}
	public function productlist(){//不限制商家的产品列表
	 $userq=session("userq");
	 $mod=D("product");
	 $modc=M("class");
	 $where["id"]=array('gt',0);
	 $pagesize=12; //分页分几条
	 $classid=I("classid");
	 if($classid!=""&&is_numeric($classid)){
        $w2["id"]=$classid;
	    $one=$modc->where($w2)->find();
		if(is_array($one)){
		   $where['classno']=array('like',''.$one["classno"].'%');
		   $keytitle=$one["title"];
		}
	 }
		 
	 $skey=I("key");
	 if($skey!=""){
		$where['title']=array('like','%'.$skey.'%');
	 }
	 if($keytitle==""){$keytitle="商品列表";}
	 $orderby="id asc";
	 $count = $mod->where($where)->count();
	 $item["rowcountz"]=$count;
	  //import('ORG.Util.Page');
	  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
	  $show = $page->show();
	  $list = $mod->where($where)->order($orderby)->limit($page->firstRow.",".$page->listRows)->field('id')->select();
     $ids="0";
	  foreach($list as $key=>$row){
			$ids.=",".$row["id"];
	  }
	  $wh['_string'] = "id in(".$ids.")";
	  $list = $mod->where($wh)->order($orderby)->select();
       if(I("isajax")==1){
	     ob_clean();
	     echo json_encode($list,true);
	     exit();
	   }
       $pclass = M("class")->where(array("fatherno"=>$this->product_fatherno))->limit("0,20")->select();
       $web=I("");
	   $web["title"]=$keytitle;
	   $web["num"]=count($list);
       $web["djclassid"]=I("get.djclassid");
	   $dianjia['nullimg']=__PUBLIC__."/images/null.gif"; 
	   $this->assign('web',$web);
	   $this->assign('dianjia',$dianjia);
	   $this->assign('list',$list);
	   $this->assign('pclass',$pclass);
	   $this->assign('show',$show);
	   $this->display();
	}
	public function djlist(){//店家列表
		 $userq=session("userq");
		 $mod=D("user");
		 $modc=M("class");
		 $where["id"]=array('gt',0);
		 $pagesize=12; //分页分几条
		 $classid=I("classid");
		 if(I("p")==""){$_GET["p"]=1;}
		 if($classid!=""&&is_numeric($classid)){
			$w2["id"]=$classid;
			$one=$modc->where($w2)->find();
			if(is_array($one)){
			   $where['classno']=array('like',''.$one["classno"].'%');
			   $keytitle=$one["title"];
			}
		 }
		 $skey=I("key");
		 if($skey!=""){
			$where['shopname']=array('like','%'.$skey.'%');
		 }
		 if($keytitle==""){$keytitle="商家列表";}
		 $where['shopname']=array('neq','');
		 $where['root']=array('eq','6');
		 $orderby="id asc";
		 $count = $mod->where($where)->count();
		 $item["rowcountz"]=$count;
		  //import('ORG.Util.Page');
		  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
		  $show = $page->show();
		  $list = $mod->where($where)->order($orderby)->limit($page->firstRow.",".$page->listRows)->field('id')->select();
		 $ids="0";
		  foreach($list as $key=>$row){
				$ids.=",".$row["id"];
		  }
		  $wh['_string'] = "id in(".$ids.")";
		  $list = $mod->where($wh)->order($orderby)->field('id,shopname,photo')->select();
		   if(I("isajax")==1){
			 ob_clean();
			 echo json_encode($list,true);
			 exit();
		   }
		   $web=I("");
		   $web["title"]=$keytitle;
		   $web["num"]=count($list);
		   $web["totalPages"]=$page->totalPages;
		   $dianjia['nullimg']=__PUBLIC__."/images/null.gif"; 
		   $this->assign('web',$web);
		   $this->assign('list',$list);
		   $this->assign('show',$show);
		   $this->display();
	}
	public function search(){//搜索
		 $userq=session("userq");
		 $mod=D("user");
		 $modp=M("product");
		 $where["id"]=array('gt',0);
		 
		 $skey=I("key");
		 //查找店家
		 $pagesize=12; //分页分几条
		 if(I("p")==""){$_GET["p"]=1;}
		 if($skey!=""){
		  $where['shopname']=array('like','%'.$skey.'%');
		 }
		 $where['root']=array('eq','6');
		 $orderby="id asc";
		 $count = $mod->where($where)->count();
		 $item["rowcountz"]=$count;
		  //import('ORG.Util.Page');
		  $page = new \Think\Page($count,$pagesize,'','page');//thinkphp 3.2
		  $show = $page->show();
		  $list = $mod->where($where)->order($orderby)->limit($page->firstRow.",".$page->listRows)->field('id')->select();
		  $ids="0";
		  foreach($list as $key=>$row){
				$ids.=",".$row["id"];
		  }
		  $wh['_string'] = "id in(".$ids.")";
		  $list = $mod->where($wh)->order($orderby)->field('id,shopname,photo')->select();
		   if(I("isajax")==1){
			 ob_clean();
			 $data["shop"]=$list;
			 echo json_encode($list,true);
			 exit();
		   }
		   //查找产品
		  if($skey!=""){
		     $where1['title']=array('like','%'.$skey.'%');
		   }
		   $product = $modp->where($where1)->order($orderby)->field('id,title,photo')->limit("0,".$pagesize)->select();

		   $web=I("");
		   $web["title"]=$keytitle;
		   $web["num"]=count($list);
		   $web["totalPages"]=$page->totalPages;
		   $dianjia['nullimg']=__PUBLIC__."/images/null.gif"; 
		   $this->assign('web',$web);
		   $this->assign('shop',$list);
		   $this->assign('product',$product);
		   $this->assign('show',$show);
		   $this->display();
	}
}

?>