<?php
/**
 * @name 放学别走科技OA-FMS-V-无权访问
 * @package wxwork
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-22
 * @version 2019-11-22
 */
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>无权访问 / 放学别走科技OA2.0</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="stylesheet" href="https://cdn.bootcss.com/weui/2.1.2/style/weui.min.css">
</head>

<body>
<div class="page">
	<div class="weui-msg">
		<div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
		<div class="weui-msg__text-area">
			<h2 class="weui-msg__title">无权访问此页面</h2>
			<p class="weui-msg__desc">
				如有<b><font color="#FF9100">行政</b></font>疑问<br>
				请联系<b>对口上级</b>
				
				<br><br>
				
				如有<b><font color="#40C4FF">IT类</b></font>问题<br>
				请联系<b>8000</b>或<b>@JerryCheung</b>
			</p>
		</div>
		<div class="weui-msg__opr-area">
			<p class="weui-btn-area">
				<a id="jumpBtn" onclick="history.go(-1)" class="weui-btn weui-btn_primary">返回上一页</a>
			</p>
		</div>
		<div class="weui-msg__tips-area">
		</div>
		<div class="weui-msg__extra-area">
			<div class="weui-footer">
				<p class="weui-footer__links">
					<a href="https://oa.itrclub.com" target="_blank" class="weui-footer__link">放学别走科技OA首页</a>
					<a href="https://www.itrclub.com?from=oa2" target="_blank" class="weui-footer__link">ITRClub官网</a>
				</p>
				<p class="weui-footer__text">Copyright &copy; 2017-<?=date("Y");?> ITRClub</p>
			</div>
		</div>
	</div>
</div>

</body>
</html>