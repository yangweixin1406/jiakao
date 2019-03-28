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
		$this->display();
    }
    public function test ()
    {
    	$user=D("User");
    	var_dump($user->select());
    }
	

}
