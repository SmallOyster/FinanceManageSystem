<?php
/**
 * @name 放学别走科技OA-FMS-C-首页
 * @package wxwork/fms
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-17
 * @version 2019-11-17
 */

namespace app\wxwork\controller\fms;

use think\Session;

class Index
{
	public function index()
	{
		return view('Fms/dashboard');
	}
}
