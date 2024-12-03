<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 페이지 로더를 최초 페이지 접속시 1번만 호출함
if(!$is_loader)
	set_session('loader', true);

?>
<script>
// Page Loader
$(window).on("load", function () {
	$("#page-loader").delay(300).fadeOut("slow");
});
$(document).ready(function() {
	$("#page-loader").on("click", function () {
		$("#page-loader").addClass("d-none");
	});
});
</script>
<div id="page-loader" class="fixed-top w-100 h-100">
	<div class="d-flex justify-content-center align-items-center w-100 h-100 bg-body">
		<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
			<span class="visually-hidden">Loading...</span>
		</div>
	</div>
</div>