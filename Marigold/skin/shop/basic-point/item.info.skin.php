<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<section id="sit_info" class="mt-4">
	<div id="sit_inf">
		<div class="px-3 my-5">
			<?php if ($it['it_explan']) { // 상품 상세설명 ?>
				<div id="sit_inf_explan" class="mb-4">
					<?php echo conv_content($it['it_explan'], 1); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</section>

<script>
$(function() {
    // 이미지 리사이즈
    $("#sit_info").viewimageresize();
});
</script>