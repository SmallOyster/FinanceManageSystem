<?php
/**
 * @name 放学别走科技OA-C-主
 * @package wxwork
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-14
 * @version 2.0 2019-12-01
 */

namespace app\wxwork\controller;

use think\Session;
use app\common\model\User;

class Index
{
	public function index(){
		$platform=isset($_GET['platform'])?$_GET['platform']:'index';
		
		die(header('location:'.'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.config('wxwork.corp_id').'&redirect_uri=https%3A%2F%2Foa.itrclub.com%2Fwxwork%2Findex%2FoauthLogin&response_type=code&scope=snsapi_base&state=oauthLogin_'.$platform.'#wechat_redirect'));
	}


	public function oauthLogin()
	{
		$code=inputGet('code',0);
		$state=inputGet('state',0);

		// 获取Access_token
		if(Session::has('WXWORK.accessToken')){
			$accessToken=Session::get('WXWORK.accessToken');
		}else{
			$at=curl('https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid='.config('wxwork.corp_id').'&corpsecret='.config('wxwork.oa_secret'));
			$at=json_decode($at,true);
			$accessToken=$at['access_token'];
			Session::set('WXWORK.accessToken',$accessToken);
		}


		// 获取用户ID
		$result=curl('https://qyapi.weixin.qq.com/cgi-bin/user/getuserinfo?access_token='.$accessToken.'&code='.$code);
		$result=json_decode($result,true);
		$userId=isset($result['UserId'])?$result['UserId']:returnAjaxData(40001,'Invalid request: cannot get userid',[],'非法请求：获取员工ID失败！');


		// 获取用户详细资料
		$userInfoResult=curl('https://qyapi.weixin.qq.com/cgi-bin/user/get?access_token='.$accessToken.'&userid='.$userId);
		$userInfo=json_decode($userInfoResult,true);
		
		// 开发者模式下只允许WXD/ABG员工访问
		if(config('app_debug')!==false){
			if(count(array_intersect($userInfo['department'],[3,26]))<1 && $userId!='DingDing'){
				gotourl('wxwork/index/error?ctx=debugDenied');
			}
		}
		
		// 获取OA系统内用户资料
		$obj_User=new User;
		$oaUserInfo=$obj_User->where('wxwork_staff_id',$userInfo['userid'])
			->find();

		// 保存用户登录态
		Session::set('userId',$oaUserInfo['id']);
		Session::set('WXWORK.staffId',$userInfo['userid']);
		Session::set('WXWORK.name',$userInfo['name']);

		// 根据state跳转到对应平台
		if(substr($state,11)=='FMS_ABG') die(header('location:'.url('wxwork/fms.abg.index/index')));
		elseif(substr($state,11)=='FMS') die(header('location:'.url('wxwork/fms.index/index')));
		else die('<meta name="viewport" content="width=device-width, initial-scale=1">'.dump($userInfo));
	}


	public function error()
	{
		$ctx=inputGet('ctx',1);

		if($ctx!=null) return view('/'.$ctx);
		else return view('/debugDenied');
	}
}
?>
