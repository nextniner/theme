<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

// 게시물 추출
$wset['rows_notice'] = false; // 추출수에 공지글 포함안함
$list = na_board_rows($wset);
$list_cnt = count($list);

// 랭킹
$rank = na_rank_start($wset['rows'], $wset['page']);
$is_rank = (isset($wset['rank']) && $wset['rank']) ? $wset['rank'] : '';
$wset['rank_color'] = (isset($wset['rank_color']) && $wset['rank_color']) ? $wset['rank_color'] : 'text-bg-primary';

// 아이콘
$icon = isset($wset['icon']) ? '<i class="'.str_replace('+', ' ', $wset['icon']).'"></i>' : '';

// 보드명, 분류명
$is_bo_name = (isset($wset['bo_name']) && $wset['bo_name']) ? true : false;
$bo_name = ($is_bo_name && (int)$wset['bo_name'] > 0) ? $wset['bo_name'] : 0;

// 공지글
$is_notice = (isset($list[0]['is_notice']) && $list[0]['is_notice']) ? true : false;

$notice_count = 0;
if($is_notice) {
	// 공지글 강조
	$wr_notice = (isset($wset['is_notice']) && $wset['is_notice']) ? ' bg-body-tertiary fw-bold' : '';
?>
	<ul class="list-group list-group-flush border-bottom">
	<?php 
	for ($i=0; $i < $list_cnt; $i++) { 
		
		// 공지글이 아니면 멈춤
		if(!$list[$i]['is_notice'])
			break;

		$notice_count++;

		$row = $list[$i];

		// 유뷰트 동영상(wr_9)
		$vinfo = na_check_youtube($row['wr_9']);

		// 이미지(wr_10)
		$img = na_check_img($row['wr_10']);

		$wr_head = $icon;

		$wr_icon = '';
		if($row['icon_new'])
			$wr_icon .= '<span class="na-icon na-new"></span>'.PHP_EOL;
		
		if ($row['icon_secret'])
			$wr_icon .= '<span class="na-icon na-secret"></span>'.PHP_EOL;

		if($vinfo['vid']) {
			$wr_icon .= '<span class="na-icon na-video"></span>'.PHP_EOL;
		} else if($img) {
			$wr_icon .= '<span class="na-icon na-image"></span>'.PHP_EOL;
		}

		// 이미지 미리보기
		$img_popover = (!G5_IS_MOBILE && $img) ? ' data-bs-toggle="popover-img" data-img="'.na_thumb($img, 400, 225).'"' : '';

		// 보드명, 분류명
		if($is_bo_name) {
			$ca_name = '';
			if(isset($row['bo_subject']) && $row['bo_subject']) {
				$ca_name = ($bo_name) ? cut_str($row['bo_subject'], $bo_name, '') : $row['bo_subject'];
			} else if($row['ca_name']) {
				$ca_name = ($bo_name) ? cut_str($row['ca_name'], $bo_name, '') : $row['ca_name'];
			}

			if($ca_name) {
				$row['subject'] = '['.$ca_name.'] '.$row['subject'];
			}
		}
	?>
		<li class="list-group-item<?php echo ($row['is_notice']) ? $wr_notice : ''; ?>">
			<div class="d-flex align-items-center gap-1">
				<div class="text-truncate">
					<a href="<?php echo $row['href'] ?>"<?php echo $img_popover ?>>
						<?php echo $wr_head ?>
						<?php echo $row['subject'] ?>
					</a>
				</div>
				<?php if($row['wr_comment']) { ?>
					<div class="count-plus orangered ms-1">
						<span class="visually-hidden">댓글</span>
						<?php echo $row['wr_comment'] ?>
					</div>
				<?php } ?>
				<?php if($wr_icon) { ?>
					<div class="text-nowrap">
						<?php echo $wr_icon ?>
					</div>
				<?php } ?>
				<div class="ms-auto ps-1 small text-body-tertiary">
					<?php echo na_date($row['wr_datetime'], 'orangered', 'H:i', 'm.d', 'm.d') ?>
				</div>
			</div>
		</li>
	<?php } ?>
	</ul>
<?php } ?>

<?php
// 썸네일 및 이미지 비율
$thumb_w = (isset($wset['thumb_w']) && (int)$wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
$thumb_h = (isset($wset['thumb_h']) && (int)$wset['thumb_h'] > 0) ? $wset['thumb_h'] : 300;

// 노이미지
$no_img = (isset($wset['no_img']) && $wset['no_img']) ? na_url($wset['no_img']) : G5_THEME_URL.'/img/no_image.gif';

// 목록 가로수
$cols = array();
$cols[] = (isset($wset['xs']) && (int)$wset['xs'] > 0) ? 'row-cols-'.$wset['xs'] : 'row-cols-1';
$cols[] = (isset($wset['sm']) && (int)$wset['sm'] > 0) ? 'sm-'.$wset['sm'] : 'sm-1';
$cols[] = (isset($wset['md']) && (int)$wset['md'] > 0) ? 'md-'.$wset['md'] : 'md-1';
$cols[] = (isset($wset['lg']) && (int)$wset['lg'] > 0) ? 'lg-'.$wset['lg'] : 'lg-2';
$cols[] = (isset($wset['xl']) && (int)$wset['xl'] > 0) ? 'xl-'.$wset['xl'] : 'xl-2';
$cols[] = (isset($wset['xxl']) && (int)$wset['xxl'] > 0) ? 'xxl-'.$wset['xxl'] : 'xxl-2';
$list_cols = implode(' row-cols-', $cols);

// 수직 중단점
$wset['sero_bp'] = isset($wset['sero_bp']) ? $wset['sero_bp'] : 'sm';
$img_cols = (isset($wset['img_cols']) && (int)$wset['img_cols'] > 1) ? (int)$wset['img_cols'] : 4;
$img_cols = ($img_cols > 8) ? 3 : $img_cols;
$txt_cols = 12 - $img_cols;

switch($wset['sero_bp']) {
	case 'xs'  : $sero_bp = 'row-cols-2'; $sero_css = 'sero-xs'; $cont_cols = 'col'; break;
	case 'sm'  : 
	case 'md'  : 
	case 'lg'  : 
	case 'xl'  : 
	case 'xxl' : $sero_bp = 'row-cols-1 row-cols-'.$wset['sero_bp'].'-2'; $sero_css = 'sero-'.$wset['sero_bp']; $cont_cols = 'col-'.$wset['sero_bp']; break;
	default    : $sero_bp = 'row-cols-1 row-cols-sm-2'; $sero_css = 'sero-sm'; $cont_cols = 'col-sm'; break;

}

// 영역 크기
$img_cols = $cont_cols.'-'.$img_cols;
$txt_cols = $cont_cols.'-'.$txt_cols;

// 글내용
$ellipsis = (isset($wset['cont']) && (int)$wset['cont'] > 0) ? (int)$wset['cont'] : 2;

// 랜덤 아이디
$id = 'webzine-'.na_rid();
?>
<style>
#<?php echo $id ?> .ratio { --bs-aspect-ratio: <?php echo na_img_ratio($thumb_w, $thumb_h, 75) ?>%; overflow:hidden; }
</style>
<div id="<?php echo $id ?>" class="wr-webzine p-3">
	<div class="row g-3 <?php echo $list_cols ?> <?php echo $sero_css ?>">
	<?php 
	for ($i=0; $i < $list_cnt; $i++) { 

		// 공지 통과	
		if ($list[$i]['is_notice'])
			continue;
		
		$row = $list[$i];

		// 유뷰트 동영상(wr_9)
		$vinfo = na_check_youtube($row['wr_9']);

		// 이미지(wr_10)
		$img = na_check_img($row['wr_10']);
		$img = $img ? na_thumb($img, $thumb_w, $thumb_h) : $no_img;

		//아이콘 체크
		$wr_icon = '';
		if (isset($row['icon_new']) && $row['icon_new'])
			$wr_icon .= '<span class="na-icon na-new"></span>'.PHP_EOL;

		if (isset($row['icon_secret']) && $row['icon_secret'])
			$wr_icon .= '<span class="na-icon na-secret"></span>'.PHP_EOL;

		if (isset($row['icon_hot']) && $row['icon_hot'])
			$wr_icon .= '<span class="na-icon na-hot"></span>'.PHP_EOL;

		if ($vinfo['vid']) {
			$wr_icon .= '<span class="na-icon na-video"></span>'.PHP_EOL;
		} else if ($img) {
			$wr_icon .= '<span class="na-icon na-image"></span>'.PHP_EOL;
		} else if (isset($row['icon_file']) && $row['icon_file']) {
			$wr_icon .= '<span class="na-icon na-file"></span>'.PHP_EOL;
		} else if (isset($row['icon_link']) && $row['icon_link']) {
			$wr_icon .= '<span class="na-icon na-link"></span>'.PHP_EOL;
		}

		// 보드명, 분류명
		if($is_bo_name) {
			$ca_name = '';
			if(isset($row['bo_subject']) && $row['bo_subject']) {
				$ca_name = ($bo_name) ? cut_str($row['bo_subject'], $bo_name, '') : $row['bo_subject'];
			} else if($row['ca_name']) {
				$ca_name = ($bo_name) ? cut_str($row['ca_name'], $bo_name, '') : $row['ca_name'];
			}

			if($ca_name) {
				$row['subject'] = '['.$ca_name.'] '.$row['subject'];
			}
		}

		// 잠긴글, 공지글, 현재글 스타일
		$label_band = '';
		if ($row['wr_7'] == 'lock') { // 잠금(wr_7)
			$label_band = 'LOCK';
			$row['subject'] = '<span class="text-decoration-line-through">'.$row['subject'].'</span>';
		} else if ($wr_id == $row['wr_id']) { // 열람
			$label_band = 'NOW';
			$row['subject'] = '<b class="text-primary fw-medium">'.$row['subject'].'</b>';
		}

	?>
		<div class="col">
			<div class="card w-100 h-100">
				<div class="row <?php echo $sero_bp ?> g-0 w-100 h-100">
					<div class="<?php echo $img_cols ?> rounded-start bg-cover" style="background-image: url('<?php echo $img ?>');">
						<div class="position-relative overflow-hidden">
							<a href="<?php echo $row['href'] ?>" class="position-relative overflow-hidden">
								<div class="ratio">
									<img src="<?php echo $img ?>" class="d-none object-fit-cover" alt="<?php echo str_replace('"', '', get_text($row['wr_subject'])) ?>">
								</div>
								<?php if($label_band) { ?>
									<div class="label-band text-bg-danger"><?php echo $label_band ?></div>
								<?php } ?>
							</a>

							<?php if ($is_rank) { // 랭킹 ?>
								<div class="position-absolute top-0 start-0 p-2 z-1">
									<span class="badge <?php echo $is_rank ?> <?php echo $wset['rank_color'] ?> fw-normal"><?php echo $rank ?></span>
								</div>
							<?php $rank++; } ?>
						</div>
					</div>
					<div class="<?php echo $txt_cols ?>">
						<div class="card-body d-flex flex-column h-100">
							<div class="card-title">
								<a href="<?php echo $row['href'] ?>" class="fw-bold">
									<?php echo $row['subject'] ?>
								</a>

								<?php echo $wr_icon ?>
								
								<?php if($row['wr_comment']) { ?>
										<span class="visually-hidden">댓글</span>
										<span class="count-plus orangered">
											<?php echo $row['wr_comment'] ?>
										</span>
								<?php } ?>

							</div>

							<div class="card-text small text-body-secondary ellipsis-<?php echo $ellipsis ?> mb-2">
								<?php echo na_get_text($row['wr_content']) ?>
							</div>

							<div class="mt-auto w-100">
								<div class="d-flex align-items-end small wr-num text-nowrap gap-2">
									<div>
										<i class="bi bi-eye"></i>
										<?php echo $row['wr_hit'] ?>
										<span class="visually-hidden">조회</span>
									</div>
									<?php if($row['wr_good']) { ?>
										<div>
											<i class="bi bi-hand-thumbs-up"></i>
											<?php echo $row['wr_good'] ?>
											<span class="visually-hidden">추천</span>
										</div>
									<?php } ?>
									<div class="ms-auto">
										<?php echo na_date($row['wr_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d') ?>
										<span class="visually-hidden">등록</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>

	<?php if ($list_cnt - $notice_count === 0) { ?>
		<div class="text-center py-5">
			게시물이 없습니다.
		</div>
	<?php } ?>
</div>

<?php if($setup_href) { ?>
	<div class="btn-wset py-2">
		<button onclick="naClipView('<?php echo $setup_href ?>');" class="btn btn-basic btn-sm">
			<i class="bi bi-gear"></i>
			위젯설정
		</button>
	</div>
<?php } ?>