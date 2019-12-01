<?php
/**
 * @name 放学别走科技OA-FMS-M-订单
 * @package Common/Fms
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-29
 * @version 2019-12-01
 */

namespace app\common\model;

use think\Model;

class FmsOrder extends Model
{
	protected $pk='id';
	
	public function createOrder($walletId='',$num=0,$place='',$content='')
	{
		$orderId=makeUUID();
		
		self::data([
			'id'=>$orderId,
			'wallet_id'=>$walletId,
			'type'=>($num>0)?1:0,
			'num'=>abs($num),
			'place'=>$place,
			'content'=>$content,
			'extra_param'=>'{}',
			'create_ip'=>getIP(),
			'update_ip'=>getIP(),
			'create_user_id'=>makeUUID(),
			'update_user_id'=>makeUUID()
		]);
		$query=self::save();

		if($query==1) return [200,$orderId];
		else return [500,$query];
	}
}
