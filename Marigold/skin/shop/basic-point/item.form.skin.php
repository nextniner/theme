<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);

?>

<section id="sit_ov_from">

	<h2 class="fs-3 px-3 mb-2">
		<?php echo stripslashes($it['it_name']); ?>
	</h2>

	<ol class="list-group list-group-flush line-top border-bottom list-group-numbered mb-0">
		<li class="list-group-item">
			결제 완료가 확인된 후 <b><?php echo ($it['it_point_type'] == 2) ? '구매금액(추가옵션 제외)의 '.$it['it_point'].'%' : number_format(get_item_point($it)).'점'; ?></b>가 포인트로 적립됩니다.
		</li>
		<?php if($config['cf_point_term']) { ?>
			<li class="list-group-item">
				구매 또는 적립하신 포인트의 유효기한은 적립일로 부터 <strong><?php echo number_format($config['cf_point_term']) ?></strong>일(<?php echo number_format(($config['cf_point_term'] / 365), 1) ?>년) 입니다.
			</li>
		<?php } ?>
		<li class="list-group-item">
			상품의 특성상 결제 완료 후 취소나 환불이 불가능합니다.
		</li>
		<li class="list-group-item">
			구매 또는 적립하신 포인트를 현금, 캐쉬백, 상품권, 쿠폰권 등으로 교환하실 수 없습니다.
		</li>
		<li class="list-group-item">
			회원탈퇴시 회원정보가 삭제되므로 구매 또는 적립하신 포인트는 모두 자동 소멸됩니다.
		</li>
	</ol>
	<div class="p-3">
		<?php if ($is_orderable) { ?>
			<button type="button" onclick="na_cart('<?php echo $it['it_id'] ?>');" class="btn btn-primary btn-lg w-100" title="구매하기">
					<i class="bi bi-check2-square"></i>
					안내 확인 및 결제진행 동의
			</button>
		<?php } ?>
	</div>

</section>
