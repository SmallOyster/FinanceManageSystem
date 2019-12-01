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
	{include file="Fms/base/header" title="我的交易记录" /}
</head>

<body class="wrapper">
{include file="Fms/base/navbar" /}

<div id="app">

<center>
	<h2 class="weui-form__title">新增交易订单</h2>
</center>

<table id="table" class="table table-striped table-bordered table-hover" style="border-radius: 5px; border-collapse: separate;overflow-x:scroll;">
	<thead>
		<tr>
			<th>任务名</th>
			<th>发布者</th>
			<th>余/总数</th>
			<th>悬赏额</th>
			<th>逾期日</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

</div>

{include file="Fms/base/footer" /}

<script>
let table;

var vm = new Vue({
	el:'#app',
	data:{
	},
	methods:{
		getList:()=>{
			lockScreen();

			$.ajax({
				url:"./getAllList",
				dataType:'json',
				error:function(e){
					unlockScreen();
					showModalTips("服务器错误！"+e.status);
					console.log(e);
					return false;
				},
				success:ret=>{
					if(ret.code==200){
						let list=ret.data['list'];

						// 先清空表格
						$.fn.dataTable.tables({api: true}).clear().draw();

						for(i in list){
							let operateHtml=''
							               +"<a onclick='vm.info("+'"'+list[i]['id']+'"'+")' class='btn btn-info'>详细</a> "
							               +"<a onclick='vm.receive_ready("+'"'+list[i]['id']+'","'+list[i]['name']+'","'+list[i]['expire_time']+'"'+")' class='btn btn-success'>领取</a>";

							let name=list[i]['name'].length>10?list[i]['name'].substr(0,10)+'...':list[i]['name'];
							
							$.fn.dataTable.tables({api: true}).row.add({
								0: name,
								1: list[i]['publisher'],
								2: list[i]['surplus']+"/"+list[i]['total'],
								3: list[i]['points'],
								4: list[i]['expire_time'],
								5: operateHtml
							}).draw();
						}

						unlockScreen();
					}
				}
			})
		}
	},
	mounted:function(){
		$('#table').DataTable({
			responsive: true,
			"pageLength": 25,
			"order":[[4,'asc']],
			"columnDefs":[{
				"targets":[5],
				"orderable": false
			}]
		});
		this.getList();
	}
});
</script>
	
</body>
</html>