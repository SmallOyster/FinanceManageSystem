<?php
/**
 * @name 放学别走科技OA-FMS-V-新建交易订单
 * @package wxwork/Fms
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-17
 * @version 2019-12-01
 */
?>

<!DOCTYPE html>
<html>
<head>
	{include file="Fms/base/header" title="发起新交易" /}
</head>

<body class="wrapper">
{include file="Fms/base/navbar" /}

<div id="app" class="page-wrapper">

<div class="weui-form" style="padding-top: 0;margin-bottom: 25px;">
	<div class="weui-form__text-area">
		<h2 class="weui-form__title">新增交易订单</h2>
		<!--div class="weui-form__desc">展示表单页面的信息结构样式, 分别由头部区域/控件区域/提示区域/操作区域和底部信息区域组成。</div-->
	</div>

	<div class="weui-form__control-area" style="margin: 0;">
		<div class="weui-cells__group weui-cells__group_form">
			<div class="weui-cells weui-cells_form">
				<div class="weui-cell weui-cell_disabled">
					<div class="weui-cell__hd"><label class="weui-label">交易用户</label></div>
					<div class="weui-cell__bd">
						<input class="weui-input" value="{$name}({$staffId})" disabled/>
					</div>
				</div>
				<div class="weui-cell weui-cell_access weui-cell_select weui-cell_select-after">
					<div class="weui-cell__hd"><label class="weui-label">交易钱包</label></div>
					<div id="walletPicker" @click="showWalletPicker" class="weui-cell__bd">请选择</div>
				</div>
				<div class="weui-cell">
					<div class="weui-cell__hd"><label class="weui-label">交易金额</label></div>
					<div class="weui-cell__bd">
						<input v-model="num" id="input_num" class="weui-input" type="number" style="color: green">
					</div>
					<div class="weui-cell__ft">
						<button @click="changeNumType" class="weui-vcode-btn">
							<i id="icon_numPlus" class="fa fa-plus-square-o" aria-hidden="true"></i>
							<i id="icon_numMinus" class="fa fa-minus-square-o" aria-hidden="true" style="display: none;"></i>
						</button>
					</div>
				</div>

				<div class="weui-form__tips-area">
					<p class="weui-form__tips">
						绿色为“支出”，红色为“收入”<br>
						点击右侧按钮可反选，金额范围为[0,1kw]<br>
						若确实超过1kw，请联系行政ABG
					</p>
				</div>

				<div id="div_place" class="weui-cell weui-cell_access weui-cell_select weui-cell_select-after">
					<div class="weui-cell__hd"><label class="weui-label">交易地</label></div>
					<div id="placePicker" @click="showPlacePicker" class="weui-cell__bd">请选择</div>
					<div id="div_placeInput" class="weui-cell__bd" style="display: none;">
						<input v-model="placeName" class="weui-input">
					</div>
					<div class="weui-cell__ft">
						<button @click="changePlace" class="weui-vcode-btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
					</div>
				</div>

				<div class="weui-form__tips-area">
					<p class="weui-form__tips">
						如无想要的常用交易地<br>
						可点击右侧按钮并手动输入<br>
						或联系行政ABG添加为常用交易地
					</p>
				</div>
			</div>
		</div>

		<div class="weui-cells__group weui-cells__group_form">
			<div class="weui-cells__title">交易内容</div>
			<div class="weui-cells weui-cells_form">
				<div class="weui-cell">
					<div class="weui-cell__bd">
						<textarea v-model="content" @keyup="countContentLength" class="weui-textarea" placeholder="请描述交易内容" rows="5"></textarea>
						<div class="weui-textarea-counter"><span>{{contentLength}}</span>/200</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="weui-form__opr-area" style="margin-top:20px;margin-bottom:30px;">
		<button @click="add" class="weui-btn weui-btn_primary">提 交 订 单</button>
	</div>
</div>

</div>

{include file="Fms/base/footer" /}
<script>
var vm = new Vue({
	el:'#app',
	data:{
		walletList:{},
		commonPlaceList:{},
		walletId:'',
		placeType:0,
		placeName:'',
		content:'',
		contentLength:0,
		numType:0,
		num:0,
	},
	methods:{
		getWallet:()=>{
			lockScreen();
			$.ajax({
				url:headerVm.apiPath+"fms/wallet/get",
				dataType:"json",
				error:function(e){
					unlockScreen();
					showDialog("服务器错误！"+e.status);
					return false;
				},
				success:function(ret){
					unlockScreen();
					if(ret.code==200){
						list=ret.data['list'];

						let pickerData=[];
						for(i in list){
							let name=list[i]['name']+"("+list[i]['balance']+"元)";
							let info={label:name,value:list[i]['id'],balance:list[i]['balance']};
							pickerData.push(info);
						}

						vm.walletList=pickerData;
					}else{
						showDialog("系统错误！"+ret.code);
						console.log(ret);
						return false;
					}
				}
			});
		},
		getCommonPlace:()=>{
			lockScreen();
			$.ajax({
				url:headerVm.apiPath+"fms/exchange/getCommonPlace",
				dataType:"json",
				error:e=>{
					unlockScreen();
					showDialog("服务器错误！"+e.status);
					return false;
				},
				success:ret=>{
					unlockScreen();
					if(ret.code==200){
						list=ret.data['list'];

						let pickerData=[];
						for(i in list){
							let info={label:list[i]['name'],value:list[i]['name']};
							pickerData.push(info);
						}
						
						vm.commonPlaceList=pickerData;
					}else{
						showDialog("系统错误！"+ret.code);
						console.log(ret);
						return false;
					}
				}
			});
		},
		add:()=>{
			if(vm.walletId.length!=36){
				showDialog("请选择交易所属钱包！");
				return false;
			}

			// 先转为两位小数float，再判断大小
			vm.num=parseFloat(vm.num,2);
			if(vm.num>10000000){
				showDialog("请输入不大于[一千万]的交易金额！<hr>若确为一千万以上的大宗交易，请联系行政ABG");
				return false;	
			}
			if(vm.num<=0){
				showDialog("请输入大于[0]的交易金额！<br>若小于[0]请点击按钮反选！");
				return false;	
			}

			if(vm.placeType==0 && vm.placeName==''){
				showDialog("请选择交易发生地！");
				return false;
			}else if(vm.placeName.length<3){
				showDialog("请输入交易发生地（3~50字）！");
				return false;	
			}
			
			if(vm.content.length<5 || vm.content.length>200){
				showDialog("请输入交易详细内容（5~200字）！");
				return false;	
			}
			
			postData={};
			postData.walletId=vm.walletId;
			postData.num=(vm.numType==0)?vm.num*-1:vm.num;
			postData.content=vm.content;
			postData.place=vm.placeName;
			
			lockScreen();
			$.ajax({
				url:"{:URL('wxwork/Fms__Order/toNew')}",
				type:"post",
				dataType:"json",
				data:postData,
				error:e=>{
					unlockScreen();
					showDialog("服务器错误！"+e.status);
					return false;				
				},
				success:ret=>{
					unlockScreen();
					if(ret.code==200){
						alert("订单创建成功！\n\n当前账户余额："+ret.data['balance']);
						return true;
					}else if(ret.code==40001 || ret.code==50001 || ret.code==50002){
						showDialog(ret.tips);
						return false;
					}else{
						showModalTips(ret.tips+"<br>请联系8000并提交错误码["+ret.code+"]");
						return false;
					}
				}
			})
		},
		countContentLength:()=>{
			vm.contentLength=vm.content.length;
			
			if(vm.contentLength<5 || vm.contentLength>200){
				$(".weui-textarea-counter").attr("style","color:red");
			}else{
				$(".weui-textarea-counter").removeAttr("style");
			}
		},
		changeNumType:()=>{
			if(vm.numType==0){
				$("#input_num").attr('style','color:#fa5151');
				$("#icon_numPlus").show();
				$("#icon_numMinus").hide();
				vm.numType=1;
			}else if(vm.numType==1){
				$("#input_num").attr('style','color:#06AE56');
				$("#icon_numPlus").hide();
				$("#icon_numMinus").show();
				vm.numType=0;
			}
		},
		changePlace:()=>{
			vm.placeName='';

			if(vm.placeType==0){
				$("#div_place").attr('class','weui-cell');
				$("#placePicker").hide();
				$("#div_placeInput").show();
				vm.placeName='';
				vm.placeType=1;
			}else if(vm.placeType==1){
				$("#div_place").attr('class','weui-cell weui-cell_access weui-cell_select weui-cell_select-after');
				$("#placePicker").show();
				$("#div_placeInput").hide();
				vm.placeName='';
				vm.placeType=0;
			}
		},
		showWalletPicker:()=>{
			weui.picker(
				vm.walletList,
				{
					title: '请选择交易钱包',
					onConfirm: function (result) {
						$("#walletPicker").html(result[0]['label']);
						vm.walletId=result[0]['value'];
					}
				}
			);
		},
		showPlacePicker:()=>{
			weui.picker(
				vm.commonPlaceList,
				{
					title: '请选择交易发生地',
					onConfirm: function (result) {
						$("#placePicker").html(result[0]['value']);
						vm.placeName=result[0]['value'];
					}
				}
			);
		}
	}
});

vm.getWallet();
vm.getCommonPlace();
</script>
	
</body>
</html>