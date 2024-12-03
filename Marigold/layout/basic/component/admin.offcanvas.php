<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if ($is_admin === 'super' || IS_DEMO) {
	;
} else {
	return;
}

// 관리자 주소
if($is_admin === 'super') {
	$admin_url = correct_goto_url(G5_ADMIN_URL);
	$change_theme_url = correct_goto_url(G5_ADMIN_URL).'theme.php';
	$change_layout_url = str_replace(G5_URL, NA_URL, $admin_url).'admin.php';
} else {
	$admin_url = $change_theme_url = $change_layout_url = "javascript:na_alert('접근권한이 없습니다.');";
}

?>

<div class="offcanvas offcanvas-end" tabindex="-1" id="adminOffcanvas" aria-labelledby="adminOffcanvasLabel">
	<div class="offcanvas-header">
		<h5 class="offcanvas-title" id="adminOffcanvasLabel">
			<?php echo $offcanvas_buttons ?>
		</h5>
		<button type="button" class="btn-close nofocus" data-bs-dismiss="offcanvas" aria-label="Close"></button>
	</div>
	<div class="offcanvas-body pt-0">
		<div class="row g-3 row-cols-2 mb-4">
			<div class="col">
				<button type="button" class="widget-setup btn btn-basic w-100" data-bs-dismiss="offcanvas">
					<i class="bi bi-magic fs-3"></i>
					<span class="d-block text-truncate small">
						위젯 설정
					</span>
				</button>
			</div>
			<div class="col">
				<a href="<?php echo $admin_url ?>" class="btn btn-basic w-100">
					<i class="bi bi-gear-wide-connected fs-3"></i>
					<span class="d-block text-truncate small">
						관리자
					</span>
				</a>
			</div>
		</div>

		<h4 class="fs-5 px-3 line-bottom pb-2 mb-0">
			<i class="bi bi-layout-text-window"></i>
			레이아웃 설정
		</h4>

		<form id="formLayoutSetup" name="formLayoutSetup" method="post" onsubmit="return false">
		<input type="hidden" name="name" value="<?php echo LAYOUT_CONFIG ?>">

			<ul class="list-group list-group-flush border-bottom mb-3">
				<li class="list-group-item">
					<div class="row gx-2 align-items-center">
						<label class="col-md-4 col-form-label">초기화</label>
						<div class="col-md-8">
							<div class="form-check form-switch">
								<input type="checkbox" name="freset" id="checkLayoutReset" value="1" class="form-check-input" role="switch">
								<label class="form-check-label" for="checkLayoutReset">리셋하기</label>
							</div>
						</div>
					</div>
				</li>
				<li class="list-group-item">
					<div class="row align-items-center gx-2">
						<label class="col-md-4 col-form-label">테마</label>
						<div class="col-md-8">
							<a href="<?php echo $change_theme_url ?>" title="테마변경">
								<?php echo $config['cf_theme'] ?>
							</a>
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row align-items-center gx-2">
						<label class="col-md-4 col-form-label">레이아웃</label>
						<div class="col-md-8">
							<a href="<?php echo $change_layout_url ?>" title="레이아웃 변경">
								<?php echo $layout_skin ?>
							</a>
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row align-items-center gx-2">
						<label class="col-md-4 col-form-label">현재모드</label>
						<div class="col-md-8">
							<?php echo (IS_SHOP) ? '쇼핑몰' : '커뮤니티'; ?>
							<?php echo (G5_IS_MOBILE) ? '모바일 모드' : 'PC 모드'; ?>
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row gx-2 align-items-center">
						<label class="col-md-4 col-form-label">상단메뉴</label>
						<div class="col-md-8">
							<select name="layout[tmv]" class="form-select">
								<option value=""<?php echo get_selected('', $layout['tmv']) ?>>출력 안함</option>
								<option value="me"<?php echo get_selected('me', $layout['tmv']) ?>>좌측 정렬</option>
								<option value="mx"<?php echo get_selected('mx', $layout['tmv']) ?>>중앙 정렬</option>
								<option value="ms"<?php echo get_selected('ms', $layout['tmv']) ?>>우측 정렬</option>
							</select>				
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row align-items-center gx-2">
						<label class="col-md-4 col-form-label">사이드바</label>
						<div class="col-md-8">
							<select name="layout[sidebar]" class="form-select">
								<option value="right"<?php echo get_selected('right', $layout['sidebar']) ?>>우측 사이드바(2단)</option>
								<option value="left"<?php echo get_selected('left', $layout['sidebar']) ?>>좌측 사이드바(2단)</option>
								<option value="none"<?php echo get_selected('none', $layout['sidebar']) ?>>사이드바 없음(1단)</option>
							</select>				
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row gx-2 align-items-center">
						<label class="col-md-4 col-form-label" for="layoutColor">컬러셋</label>
						<div class="col-md-8">
							<div class="d-flex justify-content-start align-items-center gap-3">
								<div>
									<input type="hidden" name="layout[rgb]" id="inputLayoutRGBColor" value="">
									<input type="hidden" name="layout[darken]" id="inputLayoutDarkenColor" value="">
									<input type="color" name="layout[hex]" class="form-control form-control-color" id="inputLayoutHEXColor" value="<?php echo $layout['hex'] ?>">
								</div>
								<div>
									<div class="form-check form-switch">
										<input type="checkbox" name="layout[color]" id="ckechLayoutColor" value="1"<?php echo get_checked('1', $layout['color'])?> class="form-check-input" role="switch">
										<label class="form-check-label" for="ckechLayoutColor">적용하기</label>
									</div>
								</div>
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row gx-2 align-items-center">
						<label class="col-md-4 col-form-label">테두리</label>
						<div class="col-md-8">
							<div class="form-check form-switch">
								<input type="checkbox" name="layout[boxed]" id="checkLayoutBoxed" value="1"<?php echo get_checked('1', $layout['boxed'])?> class="form-check-input" role="switch">
								<label class="form-check-label" for="checkLayoutBoxed">박스(box) 스타일</label>
							</div>
						</div>
					</div>
				</li>

			</ul>

			<button id="formLayoutSubmit" type="button" class="btn btn-primary w-100">
				SAVE
			</button>
		</form>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/1.4.1/tinycolor.min.js"></script>
		<script>
			$(function(){
				$('#formLayoutSubmit').on("click",function () {

					var originalColor = tinycolor($('#inputLayoutHEXColor').val());
					var rgbColor = originalColor.toRgbString().replace('rgb(', '').replace(')', '');

					$('#inputLayoutRGBColor').val(rgbColor);
					$('#inputLayoutDarkenColor').val(originalColor.darken(5).toHexString());

					$.ajax({
						type: "post",
						url: "<?php echo NA_URL ?>/layout.save.php",
						data: $("#formLayoutSetup").serialize(),
						success: function (data) {
							if(data) {
								na_alert(data);
							} else {
								window.location.reload();
							}
						},
						error: function (request, status, error) {
							alert("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
						}
					});
				});
			});
		</script>
	</div>
</div>