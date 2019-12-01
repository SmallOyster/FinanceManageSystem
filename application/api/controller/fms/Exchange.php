<?php
/**
 * @name 放学别走科技OA-FMS-A-交易
 * @package api/fms
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-17
 * @version 2019-11-17
 */

namespace app\api\controller\fms;

use app\common\model\FmsCommonPlace;

class Exchange
{	
	public function getCommonPLace()
	{
		$place=new FmsCommonPlace();
		$list=$place->select();
		returnAjaxData(200,'success',['list'=>$list->hidden(['key_id'])]);
	} 
}
