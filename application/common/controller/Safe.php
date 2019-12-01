<?php
/**
 * @name 放学别走科技OA-C-安全
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-21
 * @version 2019-12-01
 */

namespace app\common\controller;

use think\Session;
use think\Request;
use think\View;
use think\Controller;

class Safe extends Controller
{
	public function checkPermission($isAjax=0)
	{
	}
	
	
	public	 function checkLogin($platform='')
	{
		return;// debug
		
		switch($platform){
			case 'wxwork':
				if(!Session::has('WXWORK.staffId')){
					if(!Request::instance()->isAjax()){
						gotourl('wxwork/index/error?ctx=permissionDenied');
					}else{
						returnAjaxData(403001,'User not login',[],'用户尚未登录');
					}
				}
				
				break;
			default:
				break;
		}
		
		return;
		
		if(!Session::has('userId')){
			if($isAjax==1) returnAjaxData(403001,'User not login',[],'您尚未登录！');
		}
	}
}
