<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>
<script>
function change_skin(id, type, skin) {
	$.get("<?php echo NA_URL ?>/ajax.skin.php?bo_table=<?php echo $bo_table ?>&type="+type+"&skin="+skin, function (data) {
		if(data) {
			$("#"+id).html(data).removeClass('d-none');
		} else {
			$("#"+id).addClass('d-none');
		}
	});
}
</script>

<style>
	html, body {
		height: auto !important; }
</style>

<h2 class="fs-4 px-3 line-bottom pb-2 mb-0">
	<?php echo $board['bo_subject'] ?> 스킨 설정
</h2>

<?php 
if(is_file($board_skin_path.'/setup.skin.php'))
	@include_once ($board_skin_path.'/setup.skin.php');
?>
<ul class="list-group list-group-flush">
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">부가 기능</label>
			<div class="col-md-10">

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">추가 관리자</label>
					<div class="col-md-10">
						<textarea rows="2" class="form-control" name="boset[bo_admin]"><?php echo isset($boset['bo_admin']) ? $boset['bo_admin'] : ''; ?></textarea>
						<div class="form-text">
							회원 아이디를 콤마(,)로 구분하여 복수 회원 등록 가능
						</div>
					</div>
				</div>

				<?php if(IS_YC) { ?>
					<div class="row gx-2 mb-2">
						<label class="col-md-2 col-form-label">레이아웃</label>
						<div class="col-md-10">
							<div class="form-check form-switch">
								<?php $boset['bo_shop'] = isset($boset['bo_shop']) ? $boset['bo_shop'] : ''; ?>
								<input type="checkbox" name="boset[bo_shop]" id="bo_shop" value="1"<?php echo get_checked('1', $boset['bo_shop'])?> class="form-check-input" role="switch">
								<label class="form-check-label" for="bo_shop">쇼핑몰 레이아웃 사용</label>
								<div class="form-text">
									커뮤니티/쇼핑몰 분리해서 사이트 운영시 적용
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">보기 기능</label>
					<div class="col-md-10">

						<div class="form-check form-switch mb-2">
							<?php $boset['post_convert'] = isset($boset['post_convert']) ? $boset['post_convert'] : ''; ?>
							<input type="checkbox" name="boset[post_convert]" id="post_convert" value="1"<?php echo get_checked('1', $boset['post_convert'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="post_convert">글 내용의 플랫폼 주소 자동 변환 사용안함</label>
							<div class="form-text">
								유튜브, 비메오, 카카오TV, 트위터, 인스타그램 등 주소 자동 변환 적용
							</div>
						</div>

						<div class="form-check form-switch mb-2">
							<?php $boset['video_attach'] = isset($boset['video_attach']) ? $boset['video_attach'] : ''; ?>
							<input type="checkbox" name="boset[video_attach]" id="video_attach" value="1"<?php echo get_checked('1', $boset['video_attach'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="video_attach">첨부 동영상 자동 출력안함</label>
							<div class="form-text">
								동일 파일명의 이미지 첨부시 표지 이미지 자동 적용
							</div>
						</div>

						<div class="form-check form-switch mb-2">
							<?php $boset['video_link'] = isset($boset['video_link']) ? $boset['video_link'] : ''; ?>
							<input type="checkbox" name="boset[video_link]" id="video_link" value="1"<?php echo get_checked('1', $boset['video_link'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="video_link">링크 동영상 자동 출력안함</label>
							<div class="form-text">
								관련 링크에 등록된 유튜브, 비메오 등 공유 주소
							</div>
						</div>

						<div class="form-check form-switch mb-2">
							<?php $boset['video_auto'] = isset($boset['video_auto']) ? $boset['video_auto'] : ''; ?>
							<input type="checkbox" name="boset[video_auto]" id="video_auto" value="1"<?php echo get_checked('1', $boset['video_auto'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="video_auto">동영상 자동 실행</label>
							<div class="form-text">
								복수 출력시 문제될 수 있으며, 크롬 등 브라우저에 따라 안될 수 있음
							</div>
						</div>

						<div class="form-check form-switch">
							<?php $boset['code'] = isset($boset['code']) ? $boset['code'] : ''; ?>
							<input type="checkbox" name="boset[code]" id="bo_code" value="1"<?php echo get_checked('1', $boset['code'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="bo_code">코드 하이라이터 사용</label>
							<div class="form-text">
								[code]...[/code]를 이용한 HTML, PHP 등 코드 등록
							</div>
						</div>

					</div>
				</div>

				<div class="row gx-2">
					<label class="col-md-2 col-form-label">알림 기능</label>
					<div class="col-md-10">
						<div class="form-check form-switch">
							<?php $boset['noti_no'] = isset($boset['noti_no']) ? $boset['noti_no'] : ''; ?>
							<input type="checkbox" name="boset[noti_no]" id="noti_no" value="1"<?php echo get_checked('1', $boset['noti_no'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="noti_no">알림 사용안함</label>
							<div class="form-text">
								답글/댓글/추천 등 알림 기능 끄기
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</li>
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">쓰기 기능</label>
			<div class="col-md-10">

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">새글 알림</label>
					<div class="col-md-10">
						<textarea rows="2" type="text" class="form-control" name="boset[noti_mb]"><?php echo isset($boset['noti_mb']) ? $boset['noti_mb'] : ''; ?></textarea>
						<div class="form-text">
							새글 알림을 받을 회원 아이디를 콤마(,)로 구분하여 복수 회원 등록 가능
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">외부 이미지</label>
					<div class="col-md-10">
						<div class="form-check form-switch">
							<?php $boset['save_image'] = isset($boset['save_image']) ? $boset['save_image'] : ''; ?>
							<input type="checkbox" name="boset[save_image]" id="save_image" value="1"<?php echo get_checked('1', $boset['save_image'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="save_image">외부 이미지 서버 저장</label>
							<div class="form-text">
								게시물 본문에 있는 외부 이미지를 자동으로 서버에 저장
							</div>
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">모바일 에디터</label>
					<div class="col-md-6 col-lg-4">
						<select name="boset[editor_mo]" class="form-select">
						<option value="">기본 에디터 사용</option>
						<?php
							$boset['editor_mo'] = isset($boset['editor_mo']) ? $boset['editor_mo'] : '';
							$skinlist = na_dir_list(G5_EDITOR_PATH);
							for ($k=0; $k<count($skinlist); $k++) {
								echo '<option value="'.$skinlist[$k].'"'.get_selected($skinlist[$k], $boset['editor_mo']).'>'.$skinlist[$k].'</option>'.PHP_EOL;
							} 
						?>
						</select>
					</div>
				</div>

				<div class="row gx-2">
					<label class="col-md-2 col-form-label">태그 등록</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<span class="input-group-text col-4">회원 등급</span>
							<?php $boset['tag'] = isset($boset['tag']) ? $boset['tag'] : ''; ?>
							<select name="boset[tag]" class="form-select">
								<?php echo na_grade_options($boset['tag']); ?>
							</select>
						</div>
					</div>
				</div>

				<?php if(IS_EXP) { ?>
					<div class="row gx-2 mt-2">
						<label class="col-md-2 col-form-label">경험치 적립</label>
						<div class="col-md-6 col-lg-4">
							<div class="input-group mb-2">
								<span class="input-group-text col-4">글 쓰기</span>
								<input type="number" name="boset[xp_write]" value="<?php echo isset($boset['xp_write']) ? $boset['xp_write'] : ''; ?>"  class="form-control">
								<span class="input-group-text">점</span>
							</div>

							<div class="input-group">
								<span class="input-group-text col-4">댓글 쓰기</span>
								<input type="number" name="boset[xp_comment]" value="<?php echo isset($boset['xp_comment']) ? $boset['xp_comment'] : ''; ?>"  class="form-control">
								<span class="input-group-text">점</span>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</li>

	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">댓글 기능</label>
			<div class="col-md-10">

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">댓글 변환</label>
					<div class="col-md-10">
						<div class="form-check form-switch mb-0">
							<?php $boset['comment_convert'] = isset($boset['comment_convert']) ? $boset['comment_convert'] : ''; ?>
							<input type="checkbox" name="boset[comment_convert]" id="comment_convert" value="1"<?php echo get_checked('1', $boset['comment_convert'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="comment_convert">댓글 내용의 플랫폼 주소 자동 변환 사용안함</label>
							<div class="form-text">
								유튜브, 비메오, 카카오TV, 트위터, 인스타그램 등 주소 자동 변환 적용
							</div>
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">댓글 추천</label>
					<div class="col-md-10">
						<div class="form-check form-switch mb-2">
							<?php $boset['comment_good'] = isset($boset['comment_good']) ? $boset['comment_good'] : ''; ?>
							<input type="checkbox" name="boset[comment_good]" id="comment_good" value="1"<?php echo get_checked('1', $boset['comment_good'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="comment_good">댓글 추천 사용</label>
						</div>
						<div class="form-check form-switch mb-0">
							<?php $boset['comment_nogood'] = isset($boset['comment_nogood']) ? $boset['comment_nogood'] : ''; ?>
							<input type="checkbox" name="boset[comment_nogood]" id="comment_nogood" value="1"<?php echo get_checked('1', $boset['comment_nogood'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="comment_nogood">댓글 비추천 사용</label>
						</div>
					</div>
				</div>

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">댓글 페이징</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<span class="input-group-text col-4">댓글 목록</span>
							<?php $boset['comment_sort'] = isset($boset['comment_sort']) ? $boset['comment_sort'] : ''; ?>
							<select name="boset[comment_sort]" class="form-select">
								<option value="old"<?php echo get_selected('old', $boset['comment_sort']) ?>>과거순</option>
								<option value="new"<?php echo get_selected('new', $boset['comment_sort']) ?>>최신순</option>
								<option value="good"<?php echo get_selected('good', $boset['comment_sort']) ?>>추천순</option>
								<option value="nogood"<?php echo get_selected('nogood', $boset['comment_sort']) ?>>비추천순</option>
							</select>
							<input type="number" name="boset[comment_rows]" min="1" value="<?php echo isset($boset['comment_rows']) ? $boset['comment_rows'] : ''; ?>"  class="form-control">
							<span class="input-group-text">개</span>
						</div>
					</div>
				</div>

				<div class="row gx-2">
					<label class="col-md-2 col-form-label">럭키 포인트</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group mb-2">
							<span class="input-group-text col-4">당첨 점수</span>
							<input type="number" name="boset[lucky_point]" value="<?php echo isset($boset['lucky_point']) ? $boset['lucky_point'] : ''; ?>"  class="form-control">
							<span class="input-group-text">점</span>
						</div>
						<div class="input-group">
							<span class="input-group-text col-4">당첨 확률</span>
							<input type="number" name="boset[lucky_dice]" min="1" value="<?php echo isset($boset['lucky_dice']) ? $boset['lucky_dice'] : ''; ?>"  class="form-control">
							<span class="input-group-text">분의 1</span>
						</div>
					</div>
					<div class="col-md-10 offset-md-2">
						<div class="form-text">
							당첨 점수와 1/n의 당첨 확률을 모두 설정해야 작동됨
						</div>
					</div>
				</div>

			</div>
		</div>
	</li>
	<?php if(IS_EXTEND) { // 확장팩 ?>
	<li class="list-group-item">
		<div class="row gx-2">
			<label class="col-md-2 col-form-label">멤버십 기능</label>
			<div class="col-md-10">

				<div class="row gx-2 mb-2">
					<label class="col-md-2 col-form-label">DB 칼럼</label>
					<div class="col-md-6 col-lg-4">
						<div class="input-group">
							<span class="input-group-text">회원정보 DB 테이블의</span>
							<input type="text" name="boset[mb_db]" value="<?php echo isset($boset['mb_db']) ? $boset['mb_db'] : ''; ?>"  class="form-control">
							<span class="input-group-text">칼럼</span>
						</div>
					</div>
				</div>

				<div class="row align-items-center gx-2">
					<label class="col-md-2 col-form-label">권한 설정</label>
					<div class="col-md-10">
						<div class="form-check form-check-inline">
							<?php $boset['mbs_list'] = isset($boset['mbs_list']) ? $boset['mbs_list'] : ''; ?>
							<input type="checkbox" name="boset[mbs_list]" id="mbs_list" value="1"<?php echo get_checked('1', $boset['mbs_list'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="mbs_list">목록</label>
						</div>

						<div class="form-check form-check-inline">
							<?php $boset['mbs_view'] = isset($boset['mbs_view']) ? $boset['mbs_view'] : ''; ?>
							<input type="checkbox" name="boset[mbs_view]" id="mbs_view" value="1"<?php echo get_checked('1', $boset['mbs_view'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="mbs_view">읽기</label>
						</div>

						<div class="form-check form-check-inline">
							<?php $boset['mbs_write'] = isset($boset['mbs_write']) ? $boset['mbs_write'] : ''; ?>
							<input type="checkbox" name="boset[mbs_write]" id="mbs_write" value="1"<?php echo get_checked('1', $boset['mbs_write'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="mbs_write">쓰기</label>
						</div>

						<div class="form-check form-check-inline">
							<?php $boset['mbs_downlaod'] = isset($boset['mbs_downlaod']) ? $boset['mbs_downlaod'] : ''; ?>
							<input type="checkbox" name="boset[mbs_downlaod]" id="mbs_download" value="1"<?php echo get_checked('1', $boset['mbs_downlaod'])?> class="form-check-input" role="switch">
							<label class="form-check-label" for="mbs_download">다운로드</label>
						</div>
					</div>
				</div>

			</div>
		</div>

	</li>
	<?php } ?>
</ul>

<div class="sticky-bottom p-3 bg-body border-top">
	<div class="row justify-content-center g-3">
		<div class="col col-sm-4 col-md-3 col-lgx-2">
			<button type="submit" class="btn btn-basic w-100" onclick="document.pressed='reset'">초기화</button>
		</div>
		<div class="col col-sm-4 col-md-3 col-lgx-2">
			<button type="submit" class="btn btn-primary w-100" onclick="document.pressed='save'">저장하기</button>
		</div>
	</div>
</div>

<script>
function fsetup_submit(f) {

	if(document.pressed == "save") {
		na_confirm('PC/모바일 동일 설정값을 적용하시겠습니까?\n\n취소시 현재 모드의 설정값만 저장됩니다.', function() {
			f.both.value = 1;
			f.submit();
		}, function() {
			f.submit();
		});
	}

	if(document.pressed == "reset") {
		na_confirm('정말 초기화 하시겠습니까?\n\nPC/모바일 설정 모두 초기화 되며, 이전 설정값으로 복구할 수 없습니다.', function() {
			f.freset.value = 1;
			f.submit();
		});
	}

	return false;
}
</script>