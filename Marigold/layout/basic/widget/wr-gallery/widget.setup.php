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
$widget = 'board';

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

				<div class="row align-items-center gx-2 mb-2">
					<label class="col-md-2 col-form-label">
						새글 체크
					</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<?php $wset['bo_new'] = isset($wset['bo_new']) ? $wset['bo_new'] : '24'; ?>
							<input type="number" name="wset[bo_new]" value="<?php echo $wset['bo_new'] ?>" class="form-control">
							<span class="input-group-text">시</span>
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">
						랭크 표시
					</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<?php $wset['rank'] = isset($wset['rank']) ? $wset['rank'] : ''; ?>
							<select name="wset[rank]" class="form-select">
								<?php echo na_rank_options($wset['rank']) ?>
							</select>
							<span class="input-group-text">컬러</span>
							<?php $wset['rank_color'] = isset($wset['rank_color']) ? $wset['rank_color'] : 'text-bg-primary'; ?>
							<select name="wset[rank_color]" class="form-select">
								<?php echo na_bgcolor_options($wset['rank_color']) ?>
							</select>
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">
						글아이콘
					</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<?php $wset['icon'] = isset($wset['icon']) ? $wset['icon'] : ''; ?>
							<span class="input-group-text" id="wr_icon_preview">
								<i class="<?php echo $wset['icon'] ?>"></i>
							</span>
							<input type="text" name="wset[icon]" value="<?php echo $wset['icon'] ?>" id="wr_icon" class="form-control">
							<span class="input-group-text">
								<a href="<?php echo G5_THEME_URL ?>/app/widget.icon.php?id=<?php echo urlencode('wr_icon'); ?>" class="win_point" title="아이콘 검색">
									<i class="bi bi-search"></i>
								</a>
							</span>
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">
						보드/분류명
					</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<?php $wset['bo_name'] = isset($wset['bo_name']) ? $wset['bo_name'] : ''; ?>
							<input type="text" name="wset[bo_name]" value="<?php echo $wset['bo_name'] ?>" class="form-control">
							<span class="input-group-text">자</span>
						</div>
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							복수 추출시 보드명, 단일 게시판 출력시 분류명 출력 (0 설정시 자르지 않음, 미설정시 출력안함)
						</div>
					</div>
				</div>

				<div class="row gx-2">
					<label class="col-md-2 col-form-label">
						공지글 표시
					</label>
					<div class="col-md-10">

						<div class="form-check">
							<?php $wset['is_notice'] = isset($wset['is_notice']) ? $wset['is_notice'] : ''; ?>
							<input class="form-check-input" type="checkbox" name="wset[is_notice]" id="is_notice" value="1"<?php echo get_checked('1', $wset['is_notice'])?>>
							<label class="form-check-label" for="is_notice">강조하기</label>
						</div>
						<div class="form-text">
							추출설정 > 추출옵션에서 공지글 추출을 설정해야 적용됨
						</div>
					</div>
				</div>

			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">
				아이템 설정
			</label>
			<div class="col-md-10">

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
							<input type="number" min="1" max="6" name="wset[xs]" value="<?php echo $wset['xs'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group mb-2">
							<span class="input-group-text col-6">sm(576px)</span>
							<input type="number" min="1" max="6" name="wset[sm]" value="<?php echo $wset['sm'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group mb-2">
							<span class="input-group-text col-6">md(768px)</span>
							<input type="number" min="1" max="6" name="wset[md]" value="<?php echo $wset['md'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group mb-2">
							<span class="input-group-text col-6">lg(992px)</span>
							<input type="number" min="1" max="6" name="wset[lg]" value="<?php echo $wset['lg'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group mb-2">
							<span class="input-group-text col-6">xl(1200px)</span>
							<input type="number" min="1" max="6" name="wset[xl]" value="<?php echo $wset['xl'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>

						<div class="input-group">
							<span class="input-group-text col-6">xxl(1400px)</span>
							<input type="number" min="1" max="6" name="wset[xxl]" value="<?php echo $wset['xxl'] ?>" class="form-control">
							<span class="input-group-text">개</span>
						</div>
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							목록 가로수 최대값 6, 최소값 1
						</div>
					</div>
				</div>

			</div>
		</div>
	</li>
</ul>
