<?php
/**
 * @name 放学别走科技OA-FMS-V-钱包
 * @package Common/Fms
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-16
 * @version 2019-11-30
 */

namespace app\common\model;

use think\Model;

class FmsWallet extends Model
{
	protected $pk='id';
	
	public function updateBalance($walletId='',$num=0)
	{
		$info=self::where('id',$walletId)
			->find();

		// 防止钱包透支
		if($num<0 && ($info->balance)+$num<0) return [40001,$info->balance];
		
		$query=self::where('id',$walletId)
			->update([
				'balance'=>($info->balance)+$num,
				'update_ip'=>getIP()
				//'update_user_id'=>Session::get('userId')
				]);
			
		if($query==1) return [200,($info->balance)+$num];
		else return [500,$query];
	}
}
