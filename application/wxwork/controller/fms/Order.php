<?php
/**
 * @name 放学别走科技OA-FMS-C-交易
 * @package wxwork/fms
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-16
 * @version 2019-12-01
 */

namespace app\wxwork\controller\fms;

use think\Session;
use app\common\controller\Safe;
use app\common\model\FmsWallet;
use app\common\model\FmsOrder;

class Order
{
	public function __construct()
	{
		$obj_Safe=new Safe();
		$obj_Safe->checkLogin('wxwork');
	}
	
	
	public function new()
	{
		return view('Fms/order/new',['name'=>Session::get('WXWORK.name'),'staffId'=>Session::get('WXWORK.staffId')]);
	}


	public function toList()
	{
		return view('Fms/order/toList');
	}
	
	
	public function toNew()
	{
		$obj_Wallet=new FmsWallet();

		$walletId=inputPost('walletId',0,1);
		$num=round(inputPost('num',0,1),2);
		$place=inputPost('place',0,1);
		$content=inputPost('content',0,1);
		
		// 修改余额
		$balanceQuery=$obj_Wallet->updateBalance($walletId,$num);
		
		if($balanceQuery[0]==200) $balance=$balanceQuery[1];
		elseif($balanceQuery[0]==40001) returnAjaxData(40001,'Wallet have no enough balance',['balance'=>$balanceQuery[1]],'此钱包余额不足');
		else returnAjaxData($balanceQuery[0],'Server error',[],'服务器未知错误');
		
		// 成功修改余额后，创建订单
		$obj_Order=new FmsOrder();
		$createOrderQuery=$obj_Order->createOrder($walletId,$num,$place,$content);
		
		if($createOrderQuery[0]==200){
			returnAjaxData(200,'success',['orderId'=>$createOrderQuery[1],'balance'=>$balance]);
		}else{
			// 创建订单失败，原数退回金额
			$walletRecallQuery=$obj_Wallet->updateBalance($walletId,$num*-1);
			
			if($walletRecallQuery==1) returnAjaxData(50001,'Failed to create order and balance had recovered',['orderQuery'=>$createOrderQuery[1]],'创建订单失败，钱包余额已退回');
			else returnAjaxData(50002,'Failed to create order but wallet had been updated balance',[],'创建订单失败但钱包余额已改变，请及时联系FNC对账！');
		}
	}
}
