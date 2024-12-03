<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<div id="main-wrap" class="bg-body">
	<div class="container px-0 px-sm-3<?php echo ($is_onecolumn) ? ' py-3' : ''; ?>">
	<?php if(!$is_onecolumn) { // 2단 일 때 ?>
		<div class="row row-cols-1 row-cols-md-2 gx-4">
			<div class="order-1<?php echo $order_left ?> col-md-8 col-lg-9">
				<div class="sticky-top pt-3">
	<?php } ?>
	<!-- 메인 시작 -->	


	<div class="alert alert-light mb-4 mx-3 mx-sm-0" role="alert">
		본 사이트는 현재 여러 테스트 목적으로 인해 기존 <a href="https://amina.co.kr"><b>아미나</b></a> 또는 <a href="https://amina.co.kr/nariya"><b>나리야</b></a> 사이트와는 호환이 되지 않기 때문에 이용하실 분은 <a href="<?php echo G5_BBS_URL ?>/register.php"><b>신규 회원가입</b></a>을 하셔야 합니다.
	</div>

	<div class="row row-cols-1 row-cols-lg-2">
		<div class="col">
			<!-- 위젯 시작 { -->
			<h3 class="fs-5 px-3 py-2 mb-0">
				<a href="<?php echo get_pretty_url('gallery') ?>">
					<i class="bi bi-bell"></i>
					공지사항
					<i class="bi bi-plus small float-end mt-1 text-body-tertiary"></i>
				</a>
			</h3>
			<div class="line-top mb-4">
				<?php echo na_widget('wr-list', 'idx-notice', 'bo_list=gallery wr_notice=1 is_notice=1'); ?>
			</div>
			<!-- } 위젯 끝 -->
		</div>

		<div class="col">
			<!-- 위젯 시작 { -->
			<h3 class="fs-5 px-3 py-2 mb-0">
				<a href="<?php echo get_pretty_url('gallery') ?>">
					<i class="bi bi-cloud-download"></i>
					다운로드
					<i class="bi bi-plus small float-end mt-1 text-body-tertiary"></i>
				</a>
			</h3>
			<div class="line-top mb-4">
				<?php echo na_widget('wr-list', 'idx-download', 'bo_list=gallery wr_notice=1 is_notice=1'); ?>
			</div>
			<!-- } 위젯 끝 -->
		</div>

	</div>

	<!-- 위젯 시작 { -->
	<h3 class="fs-5 px-3 py-2 mb-0">
		<a href="<?php echo get_pretty_url('gallery') ?>">
			<i class="bi bi-images"></i>
			갤러리
			<i class="bi bi-plus small float-end mt-1 text-body-tertiary"></i>
		</a>
	</h3>
	<div class="line-top mb-4">
		<?php echo na_widget('wr-gallery', 'idx-gallery', 'bo_list=gallery wr_notice=1 is_notice=1 rows=8'); ?>
	</div>
	<!-- } 위젯 끝 -->

	<!-- 위젯 시작 { -->
	<h3 class="fs-5 px-3 py-2 mb-0">
		<a href="<?php echo get_pretty_url('gallery') ?>">
			<i class="bi bi-postcard-heart"></i>
			웹진
			<i class="bi bi-plus small float-end mt-1 text-body-tertiary"></i>
		</a>
	</h3>
	<div class="line-top mb-4">
		<?php echo na_widget('wr-webzine', 'idx-webzine', 'bo_list=gallery wr_notice=1 is_notice=1 rows=4'); ?>
	</div>
	<!-- } 위젯 끝 -->

	<div class="row row-cols-1 row-cols-lg-2">
		<div class="col">
			<!-- 위젯 시작 { -->
			<h3 class="fs-5 px-3 py-2 mb-0">
				<a href="<?php echo get_pretty_url('qa') ?>">
					<i class="bi bi-question-circle"></i>
					질답게시판
					<i class="bi bi-plus small float-end mt-1 text-body-tertiary"></i>
				</a>
			</h3>
			<div class="line-top mb-4">
				<?php echo na_widget('wr-list', 'idx-qa', 'bo_list=gallery wr_notice=1 is_notice=1'); ?>
			</div>
			<!-- } 위젯 끝 -->

		</div>

		<div class="col">
			<!-- 위젯 시작 { -->
			<h3 class="fs-5 px-3 py-2 mb-0">
				<a href="<?php echo get_pretty_url('free') ?>">
					<i class="bi bi-chat-dots"></i>
					자유게시판
					<i class="bi bi-plus small float-end mt-1 text-body-tertiary"></i>
				</a>
			</h3>
			<div class="line-top mb-4">
				<?php echo na_widget('wr-list', 'idx-free', 'bo_list=gallery wr_notice=1 is_notice=1'); ?>
			</div>
			<!-- } 위젯 끝 -->
		</div>

	</div>


	<!-- 메인 끝 -->
	<?php if(!$is_onecolumn) { // 2단 일 때 ?>
				</div>
			</div>
			<div class="order-2<?php echo $order_right ?> col-md-4 col-lg-3">
				<div class="sticky-top pt-3">
					<?php include_once LAYOUT_PATH.'/component/sidebar.php'; // 사이드바 ?>
				</div>
			</div>
		</div>
	<?php } ?>
	</div>
</div>