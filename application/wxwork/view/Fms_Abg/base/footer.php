<?php
/**
 * @name 放学别走科技OA-FMS-V-底部
 * @package wxwork/Fms_Abg
 * @author Jerry Cheung <master@xshgzs.com>
 * @since 2019-11-25
 * @version 2019-11-25
 */
?>

<center>
	<!-- 页脚版权 -->
	<p style="font-weight:bold;font-size:20px;line-height:26px;">
		&copy; <a href="https://www.itrclub.com?from=oa_fms" target="_blank" style="color:#3c8dbc;text-decoration: none;">放学别走科技</a> 2017-<?=date('Y');?>
		<a style="color:#07C160" onclick='alert("请直接在企业微信内联系8000或JerryCheung，谢谢！");'><i class="fa fa-weixin fa-lg" aria-hidden="true"></i></a>
		<a style="color:#29B6F6" href="mailto:jerrycheung@itrclub.com"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></a>

		<br>
		@JerryCheung & 行政IT 共建
		<br>

		All Rights Reserved.<br>
		<a href="http://miit.beian.gov.cn/" target="_blank" style="color:black;text-decoration: none;">粤ICP备19088421号-1</a><br><br>
	</p>
	<!-- ./页脚版权 -->
</center>

<div class="modal fade" id="tipsModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="ModalTitle">温馨提示</h3>
			</div>
			<div class="modal-body">
				<font style="font-weight:bold;font-size:21px;text-align:center;color:#FF3D00;">
					<p id="tips"></p>
				</font>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">确认 &gt;</button>
			</div>
		</div>
	</div>
</div>

{include file="public/dialog" /}