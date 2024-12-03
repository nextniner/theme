<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 가로수
$boset['cate_de'] = (isset($boset['cate_de']) && (int)$boset['cate_de'] > 0) ? (int)$boset['cate_de'] : 3;
$boset['cate_sm'] = (isset($boset['cate_sm']) && (int)$boset['cate_sm'] > 0) ? (int)$boset['cate_sm'] : 3;
$boset['cate_md'] = (isset($boset['cate_md']) && (int)$boset['cate_md'] > 0) ? (int)$boset['cate_md'] : 4;
$boset['cate_lg'] = (isset($boset['cate_lg']) && (int)$boset['cate_lg'] > 0) ? (int)$boset['cate_lg'] : 4;
$boset['cate_xl'] = (isset($boset['cate_xl']) && (int)$boset['cate_xl'] > 0) ? (int)$boset['cate_xl'] : 5;
$boset['cate_xxl'] = (isset($boset['cate_xxl']) && (int)$boset['cate_xxl'] > 0) ? (int)$boset['cate_xxl'] : 6;

?>
<div class="row gx-2">
	<label class="col-md-2 col-form-label">분류 가로수</label>
	<div class="col-md-6 col-lg-4">

		<div class="input-group mb-2">
			<span class="input-group-text col-6">xs(0px)</span>
			<input type="number" min="1" max="6" name="boset[cate_de]" value="<?php echo $boset['cate_de'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group mb-2">
			<span class="input-group-text col-6">sm(576px)</span>
			<input type="number" min="1" max="6" name="boset[cate_sm]" value="<?php echo $boset['cate_sm'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group mb-2">
			<span class="input-group-text col-6">md(768px)</span>
			<input type="number" min="1" max="6" name="boset[cate_md]" value="<?php echo $boset['cate_md'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group mb-2">
			<span class="input-group-text col-6">lg(992px)</span>
			<input type="number" min="1" max="6" name="boset[cate_lg]" value="<?php echo $boset['cate_lg'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group mb-2">
			<span class="input-group-text col-6">xl(1200px)</span>
			<input type="number" min="1" max="6" name="boset[cate_xl]" value="<?php echo $boset['cate_xl'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>

		<div class="input-group">
			<span class="input-group-text col-6">xxl(1400px)</span>
			<input type="number" min="1" max="6" name="boset[cate_xxl]" value="<?php echo $boset['cate_xxl'] ?>" class="form-control">
			<span class="input-group-text">개</span>
		</div>
		<div class="form-text">
			분류 가로수 최대값 6, 최소값 1
		</div>
	</div>
</div>
