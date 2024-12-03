<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 썸네일
$boset['thumb_w'] = (isset($boset['thumb_w']) && (int)$boset['thumb_w'] >= 0) ? (int)$boset['thumb_w'] : 400;
$boset['thumb_h'] = (isset($boset['thumb_h']) && (int)$boset['thumb_h'] >= 0) ? (int)$boset['thumb_h'] : 300;

// 가로수
$boset['list_xs'] = (isset($boset['list_xs']) && (int)$boset['list_xs'] > 0) ? (int)$boset['list_xs'] : 1;
$boset['list_sm'] = (isset($boset['list_sm']) && (int)$boset['list_sm'] > 0) ? (int)$boset['list_sm'] : 2;
$boset['list_md'] = (isset($boset['list_md']) && (int)$boset['list_md'] > 0) ? (int)$boset['list_md'] : 3;
$boset['list_lg'] = (isset($boset['list_lg']) && (int)$boset['list_lg'] > 0) ? (int)$boset['list_lg'] : 3;
$boset['list_xl'] = (isset($boset['list_xl']) && (int)$boset['list_xl'] > 0) ? (int)$boset['list_xl'] : 4;
$boset['list_xxl'] = (isset($boset['list_xxl']) && (int)$boset['list_xxl'] > 0) ? (int)$boset['list_xxl'] : 4;

?>

<div class="row gx-2 mb-2">
	<label class="col-md-2 col-form-label">목록 썸네일</label>
	<div class="col-md-6 col-lg-4">
		<div class="input-group">
			<input type="number" min="0" name="boset[thumb_w]" value="<?php echo $boset['thumb_w'] ?>" class="form-control">
			<span class="input-group-text">x</span>
			<input type="number" min="0" name="boset[thumb_h]" value="<?php echo $boset['thumb_h'] ?>" class="form-control">
			<span class="input-group-text">px</span>
		</div>
	</div>
	<div class="col-md-10 offset-md-2">
		<div class="form-text">
			썸네일 너비(width) 0 설정시 원본 출력
		</div>
	</div>
</div>

<div class="row gx-2 mb-2">
	<label class="col-md-2 col-form-label" for="idCheck<?php echo $idn; ?>">목록 가로수</label>
	<div class="col-md-6 col-lg-4">
		<div class="input-group mb-2">
			<span class="input-group-text col-6">xs(0px)</span>
			<input type="number" min="1" max="6" name="boset[list_xs]" value="<?php echo $boset['list_xs'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group mb-2">
			<span class="input-group-text col-6">sm(576px)</span>
			<input type="number" min="1" max="6" name="boset[list_sm]" value="<?php echo $boset['list_sm'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group mb-2">
			<span class="input-group-text col-6">md(768px)</span>
			<input type="number" min="1" max="6" name="boset[list_md]" value="<?php echo $boset['list_md'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group mb-2">
			<span class="input-group-text col-6">lg(992px)</span>
			<input type="number" min="1" max="6" name="boset[list_lg]" value="<?php echo $boset['list_lg'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group mb-2">
			<span class="input-group-text col-6">xl(1200px)</span>
			<input type="number" min="1" max="6" name="boset[list_xl]" value="<?php echo $boset['list_xl'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group">
			<span class="input-group-text col-6">xxl(1400px)</span>
			<input type="number" min="1" max="6" name="boset[list_xxl]" value="<?php echo $boset['list_xxl'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

	</div>
	<div class="col-md-10 offset-md-2">
		<div class="form-text">
			목록 가로수 최대값 6, 최소값 1
		</div>
	</div>
</div>
