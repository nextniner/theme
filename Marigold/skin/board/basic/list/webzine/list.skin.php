<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css">', 0);

// NO 이미지
$no_img = (isset($boset['no_img']) && $boset['no_img']) ? na_url($boset['no_img']) : G5_THEME_URL.'/img/no_image.gif';

// 썸네일 및 이미지 비율
$thumb_w = (isset($boset['thumb_w']) && (int)$boset['thumb_w'] >= 0) ? (int)$boset['thumb_w'] : 400;
$thumb_h = (isset($boset['thumb_h']) && (int)$boset['thumb_h'] >= 0) ? (int)$boset['thumb_h'] : 300;

// 목록 가로수
$cols = array();
$cols[] = (isset($boset['list_xs']) && (int)$boset['list_xs'] > 0) ? 'row-cols-'.$boset['list_xs'] : 'row-cols-1';
$cols[] = (isset($boset['list_sm']) && (int)$boset['list_sm'] > 0) ? 'sm-'.$boset['list_sm'] : 'sm-1';
$cols[] = (isset($boset['list_md']) && (int)$boset['list_md'] > 0) ? 'md-'.$boset['list_md'] : 'md-1';
$cols[] = (isset($boset['list_lg']) && (int)$boset['list_lg'] > 0) ? 'lg-'.$boset['list_lg'] : 'lg-1';
$cols[] = (isset($boset['list_xl']) && (int)$boset['list_xl'] > 0) ? 'xl-'.$boset['list_xl'] : 'xl-1';
$cols[] = (isset($boset['list_xxl']) && (int)$boset['list_xxl'] > 0) ? 'xxl-'.$boset['list_xxl'] : 'xxl-1';
$list_cols = implode(' row-cols-', $cols);

// 수직 중단점
$boset['sero_bp'] = isset($boset['sero_bp']) ? $boset['sero_bp'] : 'sm';
$img_cols = (isset($boset['img_cols']) && (int)$boset['img_cols'] > 1) ? (int)$boset['img_cols'] : 3;
$img_cols = ($img_cols > 8) ? 3 : $img_cols;
$txt_cols = 12 - $img_cols;

switch($boset['sero_bp']) {
	case 'xs'  : $sero_bp = 'row-cols-2'; $sero_css = 'sero-xs'; $cont_cols = 'col'; break;
	case 'sm'  : 
	case 'md'  : 
	case 'lg'  : 
	case 'xl'  : 
	case 'xxl' : $sero_bp = 'row-cols-1 row-cols-'.$boset['sero_bp'].'-2'; $sero_css = 'sero-'.$boset['sero_bp']; $cont_cols = 'col-'.$boset['sero_bp']; break;
	default    : $sero_bp = 'row-cols-1 row-cols-sm-2'; $sero_css = 'sero-sm'; $cont_cols = 'col-sm'; break;

}

// 영역 크기
$img_cols = $cont_cols.'-'.$img_cols;
$txt_cols = $cont_cols.'-'.$txt_cols;

// 글내용
$ellipsis = (isset($boset['list_c']) && (int)$boset['list_c'] > 0) ? (int)$boset['list_c'] : 2;

// 목록수
$list_cnt = count($list);
?>
<style>
#bo_list .ratio { --bs-aspect-ratio: <?php echo na_img_ratio($thumb_w, $thumb_h, 75) ?>%; overflow:hidden; }
</style>
<section id="bo_list" class="line-top">
	<?php if($notice_count) { // 공지 ?>
		<ul class="list-group list-group-flush border-bottom">
		<?php 
		for ($i=0; $i < $list_cnt; $i++) { 
			
			if (!$list[$i]['is_notice'])
				break;
			
			$row = $list[$i];

			// 유뷰트 동영상(wr_9)
			$vinfo = na_check_youtube($row['wr_9']);

			// 이미지(wr_10)
			$img = na_check_img($row['wr_10']);

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

			// 잠긴글, 공지글, 현재글 스타일
			$li_css = '';
			if ($row['wr_7'] == 'lock') { // 잠금(wr_7)
				$li_css = '';
				$row['subject'] = '<span class="text-decoration-line-through">'.$row['subject'].'</span>';
				$row['num'] = '<span class="orangered">잠금</span>';
			} else if ($wr_id == $row['wr_id']) { // 열람
				$li_css = ' bg-body-tertiary';
				$row['subject'] = '<b class="text-primary fw-medium">'.$row['subject'].'</b>';
				$row['num'] = '<span class="orangered">열람</span>';
			} else if ($row['is_notice']) { // 공지
				$li_css = ' bg-body-tertiary';
				$row['subject'] = '<strong class="fw-medium">'.$row['subject'].'</strong>';
				$row['num'] = '<span class="orangered">공지</span>';
			}

			// 이미지 미리보기
			// $img_popover = (!G5_IS_MOBILE && $img) ? ' data-bs-toggle="popover-img" data-img="'.na_thumb($img, 400, 225).'"' : '';
			$img_popover = '';
		?>
			<li class="list-group-item<?php echo $li_css ?>">

				<div class="d-flex align-items-center gap-1">
					<div class="wr-num text-nowrap pe-2">
						<?php echo $row['num'] ?>
					</div>
					<?php if ($is_checkbox) { ?>
						<div>
							<input class="form-check-input me-1" type="checkbox" name="chk_wr_id[]" value="<?php echo $row['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
							<label for="chk_wr_id_<?php echo $i ?>" class="visually-hidden">
								<?php echo $row['subject'] ?>
							</label>
						</div>
					<?php } ?>
					<div class="flex-grow-1">
						<a href="<?php echo $row['href'] ?>"<?php echo $img_popover ?>>
							<?php if($row['icon_reply']) { ?>
								<i class="bi bi-arrow-return-right"></i>
								<span class="visually-hidden">답변</span>
							<?php } ?>
							<?php echo $row['subject']; // 제목 ?>
						</a>
						
						<?php if (!$sca && $is_category && $row['ca_name']) { ?>
							<a href="<?php echo $row['ca_name_href'] ?>" class="badge text-body-tertiary px-1">
								<?php echo $row['ca_name'] ?>
								<span class="visually-hidden">분류</span>
							</a>
						<?php } ?>

						<?php echo $wr_icon; ?>
						
						<?php if($row['wr_comment']) { ?>
								<span class="visually-hidden">댓글</span>
								<span class="count-plus orangered">
									<?php echo $row['wr_comment'] ?>
								</span>
						<?php } ?>
					</div>
					<div class="wr-num text-nowrap ps-2 d-none d-sm-block">
						<?php echo na_date($row['wr_datetime'], 'orangered', 'H:i', 'm.d', 'Y.m.d') ?>
						<span class="visually-hidden">등록</span>
					</div>
				</div>

			</li>
		<?php } ?>
	</ul>
	<?php } // Notice ?>

	<div class="p-3">
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

								<?php if ($is_checkbox) { ?>
									<div class="position-absolute top-0 start-0 p-2 z-1">
										<input class="form-check-input" type="checkbox" name="chk_wr_id[]" value="<?php echo $row['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>">
										<label for="chk_wr_id_<?php echo $i ?>" class="visually-hidden">
										<?php echo $row['subject'] ?>
										</label>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="<?php echo $txt_cols ?>">
							<div class="card-body d-flex flex-column h-100">
								<div class="card-title">
									<a href="<?php echo $row['href'] ?>" class="fw-bold">
										<?php echo $row['subject'] ?>
									</a>

									<?php if (!$sca && $is_category && $row['ca_name']) { ?>
										<a href="<?php echo $row['ca_name_href'] ?>" class="badge text-body-tertiary px-1">
											<?php echo $row['ca_name'] ?>
											<span class="visually-hidden">분류</span>
										</a>
									<?php } ?>

									<?php echo $wr_icon; ?>
									
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
										<?php if($is_good) { ?>
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

</section>
