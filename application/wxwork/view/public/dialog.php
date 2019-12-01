<script>
function showDialog(msg){
	$("#dialogMsg").html(msg);
	$("#tipsDialog").fadeIn(200);
}
</script>

<div class="js_dialog" id="tipsDialog" style="opacity: 1;display: none;">
	<div class="weui-mask"></div>
	<div class="weui-dialog weui-skin_android">
		<div class="weui-dialog__hd"><strong class="weui-dialog__title">温馨提示</strong></div>
		<div class="weui-dialog__bd" id="dialogMsg"></div>
		<div class="weui-dialog__ft">
			<a onclick="$('#tipsDialog').fadeOut(200);" class="weui-dialog__btn weui-dialog__btn_primary">关 闭 &gt;</a>
		</div>
	</div>
</div>