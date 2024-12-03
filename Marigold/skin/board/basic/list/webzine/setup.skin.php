<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 썸네일
$boset['thumb_w'] = (isset($boset['thumb_w']) && (int)$boset['thumb_w'] >= 0) ? (int)$boset['thumb_w'] : 400;
$boset['thumb_h'] = (isset($boset['thumb_h']) && (int)$boset['thumb_h'] >= 0) ? (int)$boset['thumb_h'] : 300;

// 수직 중단점
$boset['sero_bp'] = isset($boset['sero_bp']) ? $boset['sero_bp'] : 'sm';

// 가로수
$boset['list_xs'] = (isset($boset['list_xs']) && (int)$boset['list_xs'] > 0) ? (int)$boset['list_xs'] : 1;
$boset['list_sm'] = (isset($boset['list_sm']) && (int)$boset['list_sm'] > 0) ? (int)$boset['list_sm'] : 1;
$boset['list_md'] = (isset($boset['list_md']) && (int)$boset['list_md'] > 0) ? (int)$boset['list_md'] : 1;
$boset['list_lg'] = (isset($boset['list_lg']) && (int)$boset['list_lg'] > 0) ? (int)$boset['list_lg'] : 1;
$boset['list_xl'] = (isset($boset['list_xl']) && (int)$boset['list_xl'] > 0) ? (int)$boset['list_xl'] : 1;
$boset['list_xxl'] = (isset($boset['list_xxl']) && (int)$boset['list_xxl'] > 0) ? (int)$boset['list_xxl'] : 1;

// 이미지
$boset['img_cols'] = (isset($boset['img_cols']) && (int)$boset['img_cols'] > 0) ? (int)$boset['img_cols'] : 3;

// 글내용
$boset['list_c'] = (isset($boset['list_c']) && (int)$boset['list_c'] > 0) ? (int)$boset['list_c'] : 2;

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
	<label class="col-md-2 col-form-label">수직 중단점</label>
	<div class="col-md-6 col-lg-4">
		<select name="boset[sero_bp]" class="form-select">
			<option value="xs"<?php echo get_selected('xs', $boset['sero_bp']) ?>>없음</option>
			<option value="sm"<?php echo get_selected('sm', $boset['sero_bp']) ?>>sm(576px)</option>
			<option value="md"<?php echo get_selected('md', $boset['sero_bp']) ?>>md(768px)</option>
			<option value="lg"<?php echo get_selected('lg', $boset['sero_bp']) ?>>lg(992px)</option>
			<option value="xl"<?php echo get_selected('xl', $boset['sero_bp']) ?>>xl(1200px)</option>
			<option value="xxl"<?php echo get_selected('xxl', $boset['sero_bp']) ?>>xxl(1400px)</option>
		</select>				
	</div>
	<div class="col-md-10 offset-md-2">
		<div class="form-text">
			수평/수직 스타일 구분 중단점(breakpoint)
		</div>
	</div>
</div>

<div class="row gx-2 mb-2">
	<label class="col-md-2 col-form-label">이미지 영역</label>
	<div class="col-md-6 col-lg-4">
		<div class="input-group">
			<input type="number" min="2" max="8" name="boset[img_cols]" value="<?php echo $boset['img_cols'] ?>" class="form-control">
			<span class="input-group-text">칼럼</span>
		</div>
	</div>
	<div class="col-md-10 offset-md-2">
		<div class="form-text">
			이미지 영역 칼럼 최대값 8, 최소값 2
		</div>
	</div>
</div>

<div class="row gx-2 mb-2">
	<label class="col-md-2 col-form-label">목록 글내용</label>
	<div class="col-md-6 col-lg-4">
		<div class="input-group">
			<input type="number" min="1" max="4" name="boset[list_c]" value="<?php echo $boset['list_c'] ?>" class="form-control">
			<span class="input-group-text">줄</span>
		</div>
	</div>
	<div class="col-md-10 offset-md-2">
		<div class="form-text">
			글내용 길이 최대값 4, 최소값 1
		</div>
	</div>
</div>

<div class="row gx-2">
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
