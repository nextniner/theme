<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 레이아웃 스크립트
add_javascript('<script src="'.LAYOUT_URL.'/js/layout.js"></script>', 0);

if(IS_SHOP) {
	$member['todayview_cnt'] = get_view_today_items_count();
	$member['cart_cnt'] = get_boxcart_datas_count();
	$member['wishlist_cnt'] = get_wishlist_datas_count();
}

// 메뉴 및 페이지 위치 생성
list($menu, $nav) = na_menu();

// 사이트 통계
$stats = na_stats(3); // 3분단위

// 레이아웃 초기값
$layout['tmv'] = !isset($layout['tmv']) ? 'ms' : na_fid($layout['tmv']);
$layout['sidebar'] = !isset($layout['sidebar']) ? 'right' : na_fid($layout['sidebar']);

$order_left = $order_right = '';
switch($layout['sidebar']) {
	case 'left' : $order_left = ' order-md-2'; $order_right = ' order-md-1'; break;
	case 'none' : $is_onecolumn = true; break;
	default		: $layout['sidebar'] = 'right'; break;
}

// 페이지 로더
$is_loader = get_session('loader');
if(IS_INDEX || !$is_loader)
	include_once LAYOUT_PATH.'/component/loader.php';

// 인덱스에서만 실행
if(IS_INDEX)
	include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
?>
<div class="site-wrap">
	<header id="header-navbar" class="site-navbar sticky-top">
		<div class="container px-3">
			<div class="d-flex gap-3 align-items-center">
				<div>
					<a href="<?php echo HOME_URL ?>" class="fs-2 fw-bold text-primary">
						<span class="d-none d-sm-inline">NARIYA</span>
						<span class="d-inline d-sm-none">N</span>
					</a>
				</div>
				<div class="<?php echo ($layout['tmv']) ? $layout['tmv'] : 'ms'; ?>-auto">
					<?php
						if($layout['tmv'])
							include_once LAYOUT_PATH.'/component/menu.php';
					?>
				</div>
				<div>
					<a href="#transOffcanvas" data-bs-toggle="offcanvas" data-bs-target="#transOffcanvas" aria-controls="transOffcanvas" class="site-icon">
						<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="번역">
							<i class="bi bi-translate"></i>
							<span class="visually-hidden">번역</span>
						</span>
					</a>
				</div>
				<div class="dropdown">
					<a href="#dark" id="bd-theme" data-bs-toggle="dropdown" aria-expanded="false" class="site-icon">
						<span class="theme-icon-active" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="다크모드">
							<i class="bi bi-sun"></i>
							<span class="visually-hidden">다크모드</span>
						</span>
					</a>
					<div class="dropdown-menu dropdown-menu-end py-0 shadow-none border navbar-dropdown-caret theme-dropdown-menu" aria-labelledby="bd-theme" data-bs-popper="static">
						<div class="card position-relative border-0">
							<div class="card-body p-1">
								<button type="button" class="dropdown-item rounded-1" data-bs-theme-value="light">
									<span class="me-2 theme-icon">
										<i class="bi bi-sun"></i>
									</span>
									Light
								</button>
								<button type="button" class="dropdown-item rounded-1 my-1" data-bs-theme-value="dark">
									<span class="me-2 theme-icon">
										<i class="bi bi-moon-stars"></i>
									</span>
									Dark
								</button>
								<button type="button" class="dropdown-item rounded-1" data-bs-theme-value="auto">
									<span class="me-2 theme-icon">
										<i class="bi bi-circle-half"></i>
									</span>
									Auto
								</button>
							</div>	
						</div>
					</div>
				</div>
				<?php if (IS_SHOP) { ?>
					<div>
						<a href="#todayviewOffcanvas" data-bs-toggle="offcanvas" data-bs-target="#todayviewOffcanvas" aria-controls="todayviewOffcanvas" class="site-icon">
							<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="오늘 본 상품">
								<i class="bi bi-bag-check"></i>
								<span class="visually-hidden">오늘 본 상품</span>
							</span>
						</a>
					</div>
					<div>
						<a href="#cartOffcanvas" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas" class="site-icon">
							<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="장바구니">
								<i class="bi bi-basket"></i>
								<span class="visually-hidden">장바구니</span>
							</span>
						</a>
					</div>
				<?php } else { ?>
					<div>
						<a href="#newOffcanvas" data-bs-toggle="offcanvas" data-bs-target="#newOffcanvas" aria-controls="newOffcanvas" class="site-icon">
							<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="새글/새댓글">
								<i class="bi bi-lightning"></i>
								<span class="visually-hidden">새글/새댓글</span>
							</span>
						</a>
					</div>
				<?php } ?>
				<div>
					<a href="#search" data-bs-toggle="offcanvas" data-bs-target="#searchOffcanvas" aria-controls="searchOffcanvas" class="site-icon">
						<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="검색">
							<i class="bi bi-search"></i>
							<span class="visually-hidden">검색</span>
						</span>
					</a>
				</div>
				<div>
					<a href="#memberOffcanvas" data-bs-toggle="offcanvas" data-bs-target="#memberOffcanvas" aria-controls="memberOffcanvas" class="site-icon">
						<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="<?php echo ($is_member) ? '마이메뉴' : '로그인'; ?>">
							<i class="bi bi-person-circle"></i>
							<span class="visually-hidden"><?php echo ($is_member) ? '마이메뉴' : '로그인'; ?></span>
						</span>
					</a>
				</div>
				<?php if($is_admin === 'super' || IS_DEMO) { ?>
					<div>
						<a href="#adminOffcanvas" data-bs-toggle="offcanvas" data-bs-target="#adminOffcanvas" aria-controls="adminOffcanvas" class="site-icon">
							<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="어드민">
								<i class="bi bi-gear"></i>
								<span class="visually-hidden">어드민</span>
							</span>
						</a>
					</div>
				<?php } ?>
				<div>
					<a href="#menuOffcanvas" data-bs-toggle="offcanvas" data-bs-target="#menuOffcanvas" aria-controls="menuOffcanvas">
						<span data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="메뉴">
							<i class="bi bi-list fs-4"></i>
							<span class="visually-hidden">메뉴</span>
						</span>
					</a>
				</div>
			</div>
		</div>
	</header>

<?php 
// 메인이 아닐 경우
if(!IS_INDEX) {
?>
	<div id="main-wrap" class="bg-body">
		<div class="container px-0 px-sm-3<?php echo ($is_onecolumn) ? ' py-3' : ''; ?>">
		<?php if($is_onecolumn) { // 1단 일 때 
			// 페이지 타이틀
			include_once LAYOUT_PATH.'/component/title.php';
		} else { // 2단 일 때 
		?>
			<div class="row row-cols-1 row-cols-md-2 gx-4">
				<div class="order-1<?php echo $order_left ?> col-md-8 col-lg-9">
					<div class="sticky-top pt-3 pb-0 pb-md-3">
						<?php
							// 페이지 타이틀
							include_once LAYOUT_PATH.'/component/title.php';
						?>
		<?php } ?>
<?php } // 메인이 아닐 경우 ?>