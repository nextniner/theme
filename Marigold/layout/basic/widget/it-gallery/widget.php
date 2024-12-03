<?php
if (!defined('_GNUBOARD_')) exit; //개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// add_stylesheet('<link rel="stylesheet" href="'.$widget_url.'/widget.css">', 0);

// 썸네일 및 이미지 비율
$thumb_w = (isset($wset['thumb_w']) && (int)$wset['thumb_w'] >= 0) ? (int)$boset['thumb_w'] : 400;
$thumb_h = (isset($wset['thumb_h']) && (int)$wset['thumb_h'] >= 0) ? (int)$boset['thumb_h'] : 300;

// 노이미지
$no_img = (isset($wset['no_img']) && $wset['no_img']) ? na_url($wset['no_img']) : G5_THEME_URL.'/img/no_image.gif';

// 목록 가로수
$cols = array();
$cols[] = (isset($wset['xs']) && (int)$wset['xs'] > 0) ? 'row-cols-'.$wset['xs'] : 'row-cols-1';
$cols[] = (isset($wset['sm']) && (int)$wset['sm'] > 0) ? 'sm-'.$wset['sm'] : 'sm-2';
$cols[] = (isset($wset['md']) && (int)$wset['md'] > 0) ? 'md-'.$wset['md'] : 'md-3';
$cols[] = (isset($wset['lg']) && (int)$wset['lg'] > 0) ? 'lg-'.$wset['lg'] : 'lg-3';
$cols[] = (isset($wset['xl']) && (int)$wset['xl'] > 0) ? 'xl-'.$wset['xl'] : 'xl-4';
$cols[] = (isset($wset['xxl']) && (int)$wset['xxl'] > 0) ? 'xxl-'.$wset['xxl'] : 'xxl-4';
$list_cols = implode(' row-cols-', $cols);

// 상품 추출
$list = na_item_rows($wset);
$list_cnt = count($list);

// 랜덤 아이디
$id = 'item-'.na_rid();
?>
<?php if($list_cnt) { ?>
	<style>
	#<?php echo $id ?> .ratio { --bs-aspect-ratio: <?php echo na_img_ratio($thumb_w, $thumb_h, 75) ?>%; overflow:hidden; }
	</style>
	<div id="<?php echo $id ?>" class="row g-3 <?php echo $list_cols ?>">
	<?php 
	for ($i=0; $i < $list_cnt; $i++) { 

		$row = $list[$i];

		$row['img'] = ($row['img']) ? $row['img'] : $no_img;
	?>
		<div class="col">

			<div class="card h-100">
				<a href="<?php echo $row['href'] ?>" class="position-relative overflow-hidden">
					<div class="ratio card-img-top">
						<img src="<?php echo na_thumb($row['img'], $thumb_w, $thumb_h) ?>" class="object-fit-cover" alt="<?php echo $row['name'] ?>">
					</div>
					<?php if($row['icon']) { ?>
						<div class="position-absolute start-0 bottom-0 p-3">
							<?php echo $row['icon'] ?>
						</div>
					<?php } ?>
					<?php if($row['soldout']) { ?>
						<div class="label-band text-bg-danger">SOLD OUT</div>
					<?php } ?>
				</a>
				<div class="card-body d-flex flex-column">
					<div class="card-title">
						<h5 class="fs-6 ellipsis-2 lh-base m-0">
							<a href="<?php echo $row['href'] ?>">
								<?php echo $row['name'] ?>
							</a>
						</h5>
					</div>
					<?php if($row['content']) { ?>
						<div class="card-text small text-secondary ellipsis-2">
							<?php echo $row['content'] ?>
						</div>
					<?php } ?>
					<div class="mt-auto w-100 pt-4">
						<div class="d-flex align-items-end">
							<div>
								<?php if($row['star_score']) { ?>
									<div class="text-primary mb-1">
										<?php echo $row['star'] ?>
									</div>
								<?php } ?>
								<?php if($row['cur_price']) { ?>
									<div class="form-text text-decoration-line-through">
										<?php echo $row['cur_price'] ?>
									</div>
								<?php } ?>
							</div>
							<div class="ms-auto text-end">
								<strong class="fw-bold">
									<?php echo $row['price'] ?>
								</strong>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer d-flex justify-content-center gap-1">
					<button type="button" onclick="na_cart('<?php echo $row['it_id'] ?>');" class="btn btn-basic btn-sm" title="주문/장바구니">
						<i class="bi bi-cart"></i>
						<span class="visually-hidden">주문/장바구니</span>
					</button>
					<button type="button" onclick="na_wishlist('<?php echo $row['it_id'] ?>');" class="btn btn-basic btn-sm" title="위시리스트">
						<i class="bi bi-heart"></i>
						<span class="visually-hidden">위시리스트</span>
					</button>
					<button type="button" onclick="na_itemuse('<?php echo $row['it_id'] ?>');" class="btn btn-basic btn-sm" title="사용후기">
						<i class="bi bi-chat-square-text"></i>
						<span class="visually-hidden">사용후기</span>
					</button>
					<button type="button" onclick="na_itemqa('<?php echo $row['it_id'] ?>');" class="btn btn-basic btn-sm" title="상품문의">
						<i class="bi bi-question-circle"></i>
						<span class="visually-hidden">상품문의</span>
					</button>
					<button type="button" onclick="na_sns_share('<?php echo na_seo_text($row['name']) ?>', '<?php echo $row['href'] ?>', '<?php echo $row['img'] ?>');" class="btn btn-basic btn-sm" title="SNS 공유">
						<i class="bi bi-share-fill"></i>
						<span class="visually-hidden">SNS 공유</span>
					</button>
				</div>
			</div>

		</div>
	<?php } ?>
	</div>
<?php } else { ?>
	<div class="text-center py-5">
		상품이 없습니다.
	</div>
<?php } ?>

<?php if($setup_href) { ?>
	<div class="btn-wset py-2">
		<button onclick="naClipView('<?php echo $setup_href ?>');" class="btn btn-basic btn-sm">
			<i class="bi bi-gear"></i>
			위젯설정
		</button>
	</div>
<?php } ?>