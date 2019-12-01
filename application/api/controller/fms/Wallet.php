<?php
/**
 * @name 放学别走科技OA-FMS-A-钱包
 * @package api/fms
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-17
 * @version 2019-12-01
 */

namespace app\api\controller\fms;

use app\common\model\FmsWallet;

class Wallet
{	
	public function getList()
	{
		$wallet=new FmsWallet;

		$list=$wallet->order('balance','desc')
			->select();
		
		returnAjaxData(200,'success',['list'=>$list->hidden(['key_id'])]);
	}
}
