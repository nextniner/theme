<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 타이틀
echo na_widget('shop-banner-carousel', 'shop-banner-title');

// 메인에서 타이틀 풀페이지를 위해 헤더 카피 영역 숨김처리
?>
<style>
#header-copy { 
	display:none; }
</style>
<div id="main-wrap" class="site-main-wrap bg-body">
	<div class="container px-0 px-sm-3 py-3 py-sm-4">

		<section>
			<header>
				<h2 class="text-center fs-1 px-3 py-4 mb-0">
					<a href="<?php echo shop_type_url('1') ?>">
						히트상품
					</a>
				</h2>
			</header>
			<div class="mb-4">
				<?php echo na_widget('it-gallery-stage', 'item-hit', 'rows=12 type1=1'); ?>
			</div>
		</section>

		<section>
			<header>
				<h2 class="text-center fs-1 px-3 py-4 mb-0">
					<a href="<?php echo shop_type_url('2') ?>">
						추천상품
					</a>
				</h2>
			</header>
			<div class="px-3 px-sm-0 mb-4">
				<?php echo na_widget('it-gallery-slider', 'item-good', 'rows=12 type2=1'); ?>
			</div>
		</section>

		<section>
			<header>
				<h2 class="text-center fs-1 px-3 py-4 mb-0">
					<a href="<?php echo shop_type_url('4') ?>">
						인기상품
					</a>
				</h2>
			</header>
			<div class="mb-4">
				<?php echo na_widget('it-gallery-stage', 'item-hot', 'rows=12 type4=1'); ?>
			</div>
		</section>

		<section>
			<header>
				<h2 class="text-center fs-1 px-3 py-4 mb-0">
					<a href="<?php echo shop_type_url('5') ?>">
						할인상품
					</a>
				</h2>
			</header>
			<div class="px-3 px-sm-0 mb-4">
				<?php echo na_widget('it-gallery-slider', 'item-dc', 'rows=12 type5=1'); ?>
			</div>
		</section>

		<section>
			<header>
				<h2 class="text-center fs-1 px-3 py-4 mb-0">
					<a href="<?php echo shop_type_url('3') ?>">
						최신상품
					</a>
				</h2>
			</header>
			<div class="px-3 px-sm-0 mb-4">
				<?php echo na_widget('it-gallery', 'item-new', 'rows=12 type3=1'); ?>
			</div>
		</section>

	</div>
</div>