<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<script src="<?php echo G5_JS_URL ?>/viewimageresize.js"></script>

<!-- 전체 상품 사용후기 목록 시작 { -->
<form method="get" action="<?php echo $_SERVER['SCRIPT_NAME'] ?>" class="px-3 mb-2 mx-auto" style="max-width:600px;">
<div id="sps_sch" class="row g-2">
	<div class="col-5 col-md-4">
		<label for="sfl" class="visually-hidden">검색항목 필수</label>
		<select name="sfl" id="sfl" required class="form-select">
			<option value="">선택</option>
			<option value="b.it_name"   <?php echo get_selected($sfl, "b.it_name"); ?>>상품명</option>
			<option value="a.it_id"     <?php echo get_selected($sfl, "a.it_id"); ?>>상품코드</option>
			<option value="a.is_subject"<?php echo get_selected($sfl, "a.is_subject"); ?>>후기제목</option>
			<option value="a.is_content"<?php echo get_selected($sfl, "a.is_content"); ?>>후기내용</option>
			<option value="a.is_name"   <?php echo get_selected($sfl, "a.is_name"); ?>>작성자명</option>
			<option value="a.mb_id"     <?php echo get_selected($sfl, "a.mb_id"); ?>>작성자아이디</option>
		</select>
	</div>
	<div class="col-7 col-md-8">
	    <label for="stx" class="visually-hidden">검색어<strong class="visually-hidden"> 필수</strong></label>
		<div class="input-group">
			<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="form-control">
			<button type="submit" class="btn btn-primary" title="검색하기">
				<i class="bi bi-search"></i>
				<span class="visually-hidden">검색하기</span>
			</button>
			<a href="<?php echo $_SERVER['SCRIPT_NAME'] ?>" class="btn btn-basic" title="전체보기">
				<i class="bi bi-list"></i>
				<span class="visually-hidden">전체보기</span>
			</a>
		</div>
    </div>
</div>
</form>

<div id="sps">
	<div class="p-3 pb-2 border-bottom">
		<i class="bi bi-chat-square-text"></i>
		사용후기 <b><?php echo number_format($total_count) ?></b> / <?php echo $page ?> 페이지
	</div>
	<?php
	// 썸네일 크기
	$thumb_w = 600;

	if ($total_count) { 
	?>
		<div class="accordion accordion-flush border-bottom mb-3" id="itemuse-list">
		<?php 
		$num = $total_count - ($page - 1) * $rows;
		for ($i=0; $row=sql_fetch_array($result); $i++) {
			$row = na_is_data($row, $thumb_w);
			$num = $num - $i;
			$img = $row['img'] ? na_thumb($row['img'], 100, 100) : '';

			$row2 = get_shop_item($row['it_id'], true);
			$it_href = shop_item_url($row['it_id']);

			// 신고 등 용도
			$uid = 'is-'.$row['is_id'];
		?>
			<div id="<?php echo $uid ?>" class="accordion-item">
				<div class="accordion-header">
					<a href="#item-<?php echo $uid ?>" class="accordion-button collapsed py-2" data-bs-toggle="collapse" data-bs-target="#item-<?php echo $uid ?>" aria-expanded="false" aria-controls="itemuse<?php echo $i ?>">
						<div class="d-flex align-items-center">
							<div>
								<?php echo str_replace('<img', '<img class="rounded-circle" style="max-width:70px; height:auto;"', get_it_image($row['it_id'], 100, 100)); ?>
							</div>
							<div class="px-2">
								<div class="small">
									<strong class="visually-hidden">후기 상품</strong>
									<?php echo $row2['it_name'] ?>
								</div>
								<div class="small text-secondary lh-lg">
									<span class="text-primary">
										<?php echo $row['star'] ?>
										<strong class="visually-hidden">별 <?php echo $row['star_score'] ?> 개</strong>
									</span>
									<i class="bi bi-chat-square-text ms-2"></i>
									<?php echo $row['name'] ?>
								</div>
								<div>
									<strong class="visually-hidden">후기 제목</strong>
									<?php echo $row['subject'] ?>
									<?php if($row['img']) { ?>
										<span class="na-icon na-image"></span>
									<?php } ?>
								</div>
							</div>
						</div>
					</a>
				</div>
				<div id="item-<?php echo $uid ?>" class="accordion-collapse collapse">
					<div class="accordion-body">
						<div class="d-flex justify-content-between align-items-center gap-2 mb-2">
							<div class="small">
								<?php echo na_date($row['is_time'], 'orangered', 'Y.m.d H:i', 'Y.m.d H:i', 'Y.m.d H:i') ?>
							</div>
							<div>
					            <button class="prd_detail btn btn-basic btn-sm" data-url="<?php echo G5_SHOP_URL.'/largeimage.php?it_id='.$row['it_id'] ?>">
									<i class="bi bi-camera"></i>
									상품 이미지
								</button>
								<a href="<?php echo $it_href ?>" class="btn btn-basic btn-sm">
									<i class="bi bi-box"></i>
									상품 보기
								</a>
							</div>
						</div>
						<div class="mb-3">
							<strong class="visually-hidden">후기 내용</strong>
							<?php echo $row['content'] ?> 
						</div>
						<div class="d-flex justify-content-end gap-2">
							<button type="button" onclick="na_singo('<?php echo $row['it_id'] ?>', '<?php echo $row['is_id'] ?>', '1', '<?php echo $uid ?>');" class="btn btn-basic btn-sm" title="신고">
								<i class="bi bi-eye-slash"></i>
								<span class="d-none d-sm-inline-block">신고</span>
							</button>
							<?php if($row['mb_id']) { // 회원만 가능 ?>
								<button type="button" onclick="na_chadan('<?php echo $row['mb_id'] ?>');" class="btn btn-basic btn-sm" title="차단">
									<i class="bi bi-person-slash"></i>
									<span class="d-none d-sm-inline-block">차단</span>
								</button>
							<?php } ?>
						</div>

						<?php if($row['re_subject']) { // 답변 ?>
							<div class="d-flex border-top mt-2 pt-2">
								<div class="pe-2">
									<i class="bi bi-arrow-return-right"></i>
								</div>
								<div class="flex-grow-1">
									<strong class="visually-hidden">후기 답변</strong>
									<?php
										// echo $row['re_subject'];
										// echo $row['re_name']

										// 답변 내용만 출력함
										echo $row['re_content']
									?>
								</div>	
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		<?php } // end for ?>
		</div>

		<ul class="pagination justify-content-center">
			<?php echo na_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, "{$_SERVER['SCRIPT_NAME']}?$qstr&amp;page="); ?>
		</ul>		

	<?php } else { ?>

		<div class="text-center px-3 py-5">
			사용후기가 없습니다.
		</div>

	<?php } ?>

</div>

<script>
jQuery(function($){
    // 상품이미지 크게보기
    $(".prd_detail").click(function() {
        var url = $(this).attr("data-url");
        var top = 10;
        var left = 10;
        var opt = 'scrollbars=yes,top='+top+',left='+left;
        popup_window(url, "largeimage", opt);

        return false;
    });
});
</script>