<?php
use think\Route;

Route::group('wxwork',function(){
	Route::group('fms',function(){
		Route::group('order',function(){
			Route::any('new','wxwork/fms.order/new',[],[]);
			Route::any('toNew','wxwork/fms.order/toNew',[],[]);
			Route::any('list','wxwork/fms.order/toList',[],[]);
		});

		Route::group('abg',function(){
			Route::any('index','wxwork/fms.abg.index/index',[],[]);
			Route::group('statistic',function(){
				Route::any('byMonth','wxwork/fms.abg.statistic/byMonth',[],[]);
				Route::any('byPlace','wxwork/fms.abg.statistic/byPlace',[],[]);
				Route::any('byUser','wxwork/fms.abg.statistic/byUser',[],[]);
			});
		});
	});
});

Route::group('api',function(){
	Route::group('fms',function(){
		Route::group('wallet',function(){
			Route::any('get','api/fms.wallet/getList',[],[]);
		});

		Route::group('exchange',function(){
			Route::any('getCommonPlace','api/fms.exchange/getCommonPlace',[],[]);
			Route::any('getOrderList','api/fms.exchange/getOrderList',[],[]);
		});
	});
});
