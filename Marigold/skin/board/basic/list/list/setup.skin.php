<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<div class="row gx-2 mb-2">
	<label class="col-md-2 col-form-label">목록 중단점</label>
	<div class="col-md-6 col-lg-4">
		<select name="boset[list_bp]" class="form-select">
			<option value="md"<?php echo get_selected('md', $boset['list_bp']) ?>>md(768px)</option>
			<option value="lg"<?php echo get_selected('lg', $boset['list_bp']) ?>>lg(992px)</option>
			<option value="xl"<?php echo get_selected('xl', $boset['list_bp']) ?>>xl(1200px)</option>
		</select>				
	</div>
	<div class="col-md-10 offset-md-2">
		<div class="form-text">
			PC/모바일 스타일 구분 중단점(breakpoint)
		</div>
	</div>
</div>

<div class="row gx-2 align-items-center">
	<label class="col-md-2 col-form-label">목록 미리보기</label>
	<div class="col-md-10">
		<div class="form-check form-switch">
			<?php $boset['list_pv'] = isset($boset['list_pv']) ? $boset['list_pv'] : ''; ?>
			<input type="checkbox" name="boset[list_pv]" id="list_pv" value="1"<?php echo get_checked('1', $boset['list_pv'])?> class="form-check-input" role="switch">
			<label class="form-check-label" for="list_pv">이미지 미리보기 사용안함</label>
		</div>
	</div>
</div>