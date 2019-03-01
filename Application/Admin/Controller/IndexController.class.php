<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
		$path=__APP__."/admin";
		$arr=explode("index.php",$path);
		$menu="";
		$menu.='[';
		//uploader/index.php
		$menu.='{\"title\":\"网站配置\",\"url\":\"'.$path.'/config\",\"items\":[{\"name\":\"基本信息\",\"url\":\"'.$path.'/config\"},{\"name\":\"图片上传\",\"url\":\"'.$arr[0]."uploader/index.php".'\"}]}';
		$menu.=',{\"title\":\"分类管理\",\"url\":\"'.$path.'/class\",\"items\":[{\"name\":\"分类列表\",\"url\":\"'.$path.'/class\"},{\"name\":\"添加分类\",\"url\":\"'.$path.'/class/add\"}]}';
		
		//$menu.=',{\"title\":\"商品管理\",\"url\":\"'.$path.'/product\",\"items\":[{\"name\":\"商品列表\",\"url\":\"'.$path.'/product\"},{\"name\":\"添加商品\",\"url\":\"'.$path.'/product/add\"}]}';
		
		 $menu.=',{\"title\":\"中文考题\",\"url\":\"'.$path.'/exam\",\"items\":[{\"name\":\"考题列表\",\"url\":\"'.$path.'/exam\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/exam/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/中文\"}]}';
		//$menu.=',{\"title\":\"阿拉考题\",\"url\":\"'.$path.'/exama\",\"items\":[{\"name\":\"考题列表\",\"url\":\"'.$path.'/exama\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/exama/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/阿拉\"}]}';
		//$menu.=',{\"title\":\"哈文考题\",\"url\":\"'.$path.'/examh\",\"items\":[{\"name\":\"考题列表\",\"url\":\"'.$path.'/examh\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/examh/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/哈文\"}]}';
		//$menu.=',{\"title\":\"英文考题\",\"url\":\"'.$path.'/exame\",\"items\":[{\"name\":\"考题列表\",\"url\":\"'.$path.'/exame\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/exame/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/英文\"}]}';
		//$menu.=',{\"title\":\"英文考题\",\"url\":\"'.$path.'/exame\",\"items\":[{\"name\":\"考题列表\",\"url\":\"'.$path.'/exame\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/exame/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/英文\"}]}';

		//$menu.=',{\"title\":\"阿拉考题2\",\"url\":\"'.$path.'/exama2\",\"items\":[{\"name\":\"考题列表2\",\"url\":\"'.$path.'/exama2\"},{\"name\":\"添加考题\",\"url\":\"'.$path.'/exama2/add\"},{\"name\":\"导入考题\",\"url\":\"'.$path.'/daoru/index/lang/阿拉2\"}]}';
		$menu.=',{\"title\":\"授权管理\",\"url\":\"'.$path.'/shouquan\",\"items\":[{\"name\":\"授权列表\",\"url\":\"'.$path.'/shouquan\"},{\"name\":\"添加授权\",\"url\":\"'.$path.'/shouquan/add\"}]}';
		$menu.=',{\"title\":\"用户管理\",\"url\":\"'.$path.'/user\",\"items\":[{\"name\":\"用户列表\",\"url\":\"'.$path.'/user\"},{\"name\":\"添加用户\",\"url\":\"'.$path.'/user/add\"}]}';
		$menu.=',{\"title\":\"卡号分组\",\"url\":\"'.$path.'/usergroup\",\"items\":[{\"name\":\"分组列表\",\"url\":\"'.$path.'/usergroup\"},{\"name\":\"添加分组\",\"url\":\"'.$path.'/usergroup/add\"}]}';
		$menu.=',{\"title\":\"文章管理\",\"url\":\"'.$path.'/content\",\"items\":[{\"name\":\"文章列表\",\"url\":\"'.$path.'/content\"},{\"name\":\"添加文章\",\"url\":\"'.$path.'/content/add\"}]}';
		$menu.=',{\"title\":\"接口配置\",\"url\":\"'.$path.'/setting/pay\",\"items\":[{\"name\":\"支付接口\",\"url\":\"'.$path.'/setting/pay\"},{\"name\":\"微信公众号\",\"url\":\"'.$path.'/setting/weixin_api\"},{\"name\":\"邮箱配置\",\"url\":\"'.$path.'/setting/email\"},{\"name\":\"积分兑换\",\"url\":\"'.$path.'/setting/point\"},{\"name\":\"客服号码\",\"url\":\"'.$path.'/setting/kefu\"}]}';
		$menu.=',{\"title\":\"商品管理\",\"url\":\"'.$path.'/product/lists\",\"items\":[{\"name\":\"商品列表\",\"url\":\"'.$path.'/product/lists\"},{\"name\":\"添加商品\",\"url\":\"'.$path.'/product/add\"}]}';
		$menu.=',{\"title\":\"订单管理\",\"url\":\"'.$path.'/orders/lists\",\"items\":[{\"name\":\"未付款\",\"url\":\"'.$path.'/orders/lists/state/0\"},{\"name\":\"等待发货\",\"url\":\"'.$path.'/orders/lists/1\"},{\"name\":\"已发货\",\"url\":\"'.$path.'/orders/lists/2\"},{\"name\":\"已完成\",\"url\":\"'.$path.'/orders/lists/3\"}]}';
		$menu.=',{\"title\":\"综合管理\",\"url\":\"\",\"items\":[{\"name\":\"信息列表\",\"url\":\"'.$path.'/link/lists/\"},{\"name\":\"添加信息\",\"url\":\"'.$path.'/link/add\"},{\"name\":\"信息分类\",\"url\":\"'.$path.'/linkclass/lists\"}]}';
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
//$var =session("user");
//var_dump($var);
  //M()->execute("ALTER TABLE  `tb_shouquan` ADD  `photo_zs` VARCHAR( 200 ) NOT NULL COMMENT  '证书图片' ");
      //M()->execute("ALTER TABLE  `tb_shouquan` ADD  `dailidengji` VARCHAR( 200 ) NULL COMMENT  '代理等级'");
	    echo "<script>window.location='".U("content/lists")."';</script>";
		exit();
		$this->display();
    }
    public function test ()
    {
    	$user=D("User");
    	var_dump($user->select());
    }
	

}
?>