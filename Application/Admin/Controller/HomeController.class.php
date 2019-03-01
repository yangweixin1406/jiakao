<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends CommController {
    public function index(){
		$path=__APP__."/admin";
		$arr=explode("index.php",$path);
		$menu="";
		$menu.='[';
		//uploader/index.php
		$menu.='{\"title\":\"网站配置\",\"url\":\"'.$path.'/config\",\"items\":[{\"name\":\"基本信息\",\"url\":\"'.$path.'/config\"},{\"name\":\"图片上传\",\"url\":\"'.$arr[0]."uploader/index.php".'\"}]}';
		$menu.=',{\"title\":\"分类管理\",\"url\":\"'.$path.'/class\",\"items\":[{\"name\":\"分类列表\",\"url\":\"'.$path.'/class\"},{\"name\":\"添加分类\",\"url\":\"'.$path.'/class/add\"}]}';
		
		$menu.=',{\"title\":\"商品管理\",\"url\":\"'.$path.'/product\",\"items\":[{\"name\":\"商品列表\",\"url\":\"'.$path.'/product\"},{\"name\":\"添加商品\",\"url\":\"'.$path.'/product/add\"}]}';
		$menu.=',{\"title\":\"中文考题\",\"url\":\"'.$path.'/exam\",\"items\":[{\"name\":\"考题列表\",\"url\":\"'.$path.'/exam\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/exam/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/中文\"}]}';
		$menu.=',{\"title\":\"阿拉考题\",\"url\":\"'.$path.'/exama\",\"items\":[{\"name\":\"考题列表\",\"url\":\"'.$path.'/exama\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/exama/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/阿拉\"}]}';
		$menu.=',{\"title\":\"哈文考题\",\"url\":\"'.$path.'/examh\",\"items\":[{\"name\":\"考题列表\",\"url\":\"'.$path.'/examh\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/examh/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/哈文\"}]}';
		$menu.=',{\"title\":\"用户管理\",\"url\":\"'.$path.'/user\",\"items\":[{\"name\":\"用户列表\",\"url\":\"'.$path.'/user\"},{\"name\":\"添加用户\",\"url\":\"'.$path.'/user/add\"}]}';
		$menu.=',{\"title\":\"卡号分组\",\"url\":\"'.$path.'/usergroup\",\"items\":[{\"name\":\"分组列表\",\"url\":\"'.$path.'/usergroup\"},{\"name\":\"添加分组\",\"url\":\"'.$path.'/usergroup/add\"}]}';
		$menu.=',{\"title\":\"文章管理\",\"url\":\"'.$path.'/content\",\"items\":[{\"name\":\"文章列表\",\"url\":\"'.$path.'/content\"},{\"name\":\"添加文章\",\"url\":\"'.$path.'/content/add\"}]}';
		$menu.=']';
		$this->assign('menu',$menu);

		//$this->islogin();

//		$g_quanxian.="商品管理[=]添加商品#product/info.php,商品列表#product/list.php,商品分类#productclass/list.php,批量上传#product/piliang.php[|]";
//		$g_quanxian.="用户管理[=]添加用户#user/info.php,管理员#user/list.php?state=0,所有帐号#user/list.php,店家管理#user/dianjia.php,会员管理#user/huiyuan.php[|]";
//		$g_quanxian.="文章管理[=]添加文章#content/info.php,所有文章#content/list.php".$contentstr."[|]";
//		$g_quanxian.="订单管理[=]订单列表#orders/list.php,未付款#orders/list.php?state=0,等待发货#orders/list.php?state=1,已作废#orders/list.php?state=2,已发货#orders/list.php?state=3,已完成#orders/list.php?state=4[|]";
//      $g_quanxian.="销量情况[=]销量列表#ordersdetail/list.php,未付款#ordersdetail/list.php?state=0,等待发货#ordersdetail/list.php?state=1,已作废#ordersdetail/list.php?state=2,已发货#ordersdetail/list.php?state=3,已完成#orders/list.php?state=4[|]";
//		$g_quanxian.="链接管理[=]添加链接#link/info.php,链接列表#link/list.php[|]";
//		$g_quanxian.="反馈管理[=]反馈列表#message/list.php,未处理#message/list.php?ischuli=0,已处理#message/list.php?ischuli=1[|]";
//		$g_quanxian.="系统管理[=]基本信息#system/info.php,垃圾图片#system/delimg.php[|]";
//		$g_quanxian.="我的资料[=]基本信息#user/only.php,修改密码#user/pwd.php";
		$this->display();
    }
    public function test ()
    {
    	$user=D("User");
    	var_dump($user->select());
    }
	

}
