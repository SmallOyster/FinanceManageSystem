<?php
/**
 * @name 放学别走科技OA-FMS(ABG端)-C-首页
 * @package wxwork/fms/abg
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-15
 * @version 2019-11-16
 */

namespace app\wxwork\controller\fms\abg;

use think\Session;

class Index
{
	public function index()
	{
		return view('Fms_Abg/dashboard');
	}
}
