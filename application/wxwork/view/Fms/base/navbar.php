<div id="headerApp">
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="index.php">放学别走科技FMS</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-exchange"></i> 交易管理<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="{:URL('wxwork/fms.order/new')}"><i class="fa fa-plus-square-o"></i> 新建交易订单</a></li>
							<li class="divider"></li>
							<li><a href="{:URL('wxwork/fms.order/toList')}"><i class="fa fa-list-alt"></i> 查看交易记录</a></li>
						</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>
</div>

<script>
var headerVm = new Vue({
	el:'#headerApp',
	data:{
		apiPath:"/api/"
	}
})
</script>
