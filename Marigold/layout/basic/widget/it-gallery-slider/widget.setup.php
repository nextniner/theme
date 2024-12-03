<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// input의 name을 wset[배열키], mo[배열키] 형태로 등록
// 기본은 wset[배열키], 모바일 설정은 mo[배열키] 형식을 가짐

// 썸네일
$wset['thumb_w'] = (isset($wset['thumb_w']) && (int)$wset['thumb_w'] >= 0) ? (int)$wset['thumb_w'] : 400;
$wset['thumb_h'] = (isset($wset['thumb_h']) && (int)$wset['thumb_h'] >= 0) ? (int)$wset['thumb_h'] : 300;

// 가로수
$wset['xs'] = (isset($wset['xs']) && (int)$wset['xs'] > 0) ? (int)$wset['xs'] : 1;
$wset['sm'] = (isset($wset['sm']) && (int)$wset['sm'] > 0) ? (int)$wset['sm'] : 2;
$wset['md'] = (isset($wset['md']) && (int)$wset['md'] > 0) ? (int)$wset['md'] : 3;
$wset['lg'] = (isset($wset['lg']) && (int)$wset['lg'] > 0) ? (int)$wset['lg'] : 3;
$wset['xl'] = (isset($wset['xl']) && (int)$wset['xl'] > 0) ? (int)$wset['xl'] : 4;
$wset['xxl'] = (isset($wset['xxl']) && (int)$wset['xxl'] > 0) ? (int)$wset['xxl'] : 4;

// 위젯 설정 타입
$widget = 'item';

?>
<ul class="list-group list-group-flush">
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">
				출력 설정
			</label>
			<div class="col-md-10">

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">
						캐시 설정
					</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<?php $wset['cache'] = isset($wset['cache']) ? $wset['cache'] : '0'; ?>
							<input type="number" name="wset[cache]" value="<?php echo $wset['cache'] ?>" class="form-control">
							<span class="input-group-text">분</span>
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">
						NO 이미지
					</label>
					<div class="col-md-10">
						<?php $wset['no_img'] = isset($wset['no_img']) ? $wset['no_img'] : ''; ?>
						<div class="input-group">
							<span class="input-group-text">
								<a href="<?php echo G5_THEME_URL ?>/app/image.php?fid=no_img&amp;type=noimg" class="win_point">
									<i class="bi bi-image"></i>
								</a>
							</span>
							<input type="text" id="no_img" name="wset[no_img]" value="<?php echo $wset['no_img'] ?>" class="form-control" placeholder="https://...">
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">
						썸네일
					</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<input type="number" min="0" name="wset[thumb_w]" value="<?php echo $wset['thumb_w'] ?>" class="form-control">
							<span class="input-group-text">x</span>
							<input type="number" min="0" name="wset[thumb_h]" value="<?php echo $wset['thumb_h'] ?>" class="form-control">
							<span class="input-group-text">px</span>
						</div>
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							썸네일 너비(width) 0 설정시 원본 출력
						</div>
					</div>
				</div>

				<div class="row gx-2">
					<label class="col-md-2 col-form-label">
						가로수
					</label>
					<div class="col-md-6 col-lg-4">

						<div class="input-group mb-2">
							<span class="input-group-text col-6">xs(0px)</span>
							<input type="number" min="1" name="wset[xs]" value="<?php echo $wset['xs'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group mb-2">
							<span class="input-group-text col-6">sm(576px)</span>
							<input type="number" min="1" name="wset[sm]" value="<?php echo $wset['sm'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group mb-2">
							<span class="input-group-text col-6">md(768px)</span>
							<input type="number" min="1" name="wset[md]" value="<?php echo $wset['md'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group mb-2">
							<span class="input-group-text col-6">lg(992px)</span>
							<input type="number" min="1" type="text" name="wset[lg]" value="<?php echo $wset['lg'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group mb-2">
							<span class="input-group-text col-6">xl(1200px)</span>
							<input type="number" min="1" name="wset[xl]" value="<?php echo $wset['xl'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group">
							<span class="input-group-text col-6">xxl(1400px)</span>
							<input type="number" min="1" name="wset[xxl]" value="<?php echo $wset['xxl'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							목록 가로수 최소값 1
						</div>
					</div>
				</div>

			</div>
		</div>
	</li>
</ul>
