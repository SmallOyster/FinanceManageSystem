<?php
/**
 * @name 放学别走科技OA-FMS-V-导航栏
 * @package wxwork/Fms_Abg
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-25
 * @version 2019-11-25
 */
?>

<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">放学别走科技FMS <span class="label label-success">ABG端</span></a>
		</div>

		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li>
					<a href="{:URL('wxwork/fms.abg.index/index')}">
						<font color="green" style="font-weight: bold;"><i class="fa fa-dashboard"></i> 实况大屏</font>
					</a>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-exchange"></i> 交易管理<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{:URL('wxwork/fms.order/new')}"><i class="fa fa-plus-square-o"></i> 新建交易订单</a></li>
						<li class="divider"></li>
						<li><a href="{:URL('wxwork/fms.order/toList')}"><i class="fa fa-list-alt"></i> 查看交易记录</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-area-chart"></i> 账目统计<span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="{:URL('wxwork/fms.abg.statistic/byMonth')}"><i class="fa fa-line-chart"></i> 按月份统计</a></li>
						<li><a href="{:URL('wxwork/fms.abg.statistic/byPlace')}"><i class="fa fa-bar-chart"></i> 按交易地统计</a></li>
						<li><a href="{:URL('wxwork/fms.abg.statistic/byUser')}"><i class="fa fa-pie-chart"></i> 按操作者统计</a></li>
					</ul>
				</li>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-gears"></i> 系统管理<span class="caret"></span></a>
					<ul class="dropdown-menu">
					</ul>
				</li>
			</ul>
		</div><!-- /.navbar-collapse -->
	</div><!-- /.container-fluid -->
</nav>