<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

require_once(G5_SHOP_PATH.'/settle_'.$default['de_pg_service'].'.inc.php');

// 결제대행사별 코드 include (스크립트 등)
require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.1.php');
?>

<form name="forderform" id="forderform" method="post" action="<?php echo $order_action_url; ?>" autocomplete="off">
<input type="hidden" name="pp_id" value="<?php echo $pp['pp_id']; ?>">

    <?php
    // 결제대행사별 코드 include (결제대행사 정보 필드)
    require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.2.php');
    ?>

	<div class="row">
		<div class="col-md-7">
			<section id="sod_frm_pay" class="mb-4">
				<h2 class="fs-5 px-3 py-2 mb-0">
					개인결제정보
				</h2>
				<div class="table-responsive line-top">
					<table class="table">
					<tbody>
					<?php if(trim($pp['pp_content'])) { ?>
					<tr>
						<th class="py-3">상세내용</th>
						<td class="py-3"><?php echo conv_content($pp['pp_content'], 0); ?></td>
					</tr>
					<?php } ?>
					<tr>
						<th class="py-3">결제금액</th>
						<td class="py-3"><?php echo display_price($pp['pp_price']); ?></td>
					</tr>
					<tr>
						<th><label for="pp_name">이름<strong class="visually-hidden"> 필수</strong></label></th>
						<td>
							<input type="text" name="pp_name" value="<?php echo get_text($pp['pp_name']); ?>" id="pp_name" required class="required form-control">
						</td>
					</tr>
					<tr>
						<th><label for="pp_hp">휴대폰<strong class="visually-hidden"> 필수</strong></label></th>
						<td><input type="text" name="pp_hp" value="<?php echo get_text($member['mb_hp']); ?>" id="pp_hp" required class="required form-control"></td>
					</tr>
					<tr>
						<th><label for="pp_email">이메일<strong class="visually-hidden"> 필수</strong></label></th>
						<td><input type="text" name="pp_email" value="<?php echo $member['mb_email']; ?>" id="pp_email" required class="required form-control"></td>
					</tr>
					</tbody>
					</table>
				</div>
			</section>
		</div>
		<div class="col-md-5">
			<section id="od_pay_sl" class="mb-4">
				<h2 class="fs-5 px-3 py-2 mb-0">
					결제 수단
				</h2>
				<ul class="list-group list-group-flush line-top">
					<li class="list-group-item">

						<div id="od_pay_sl" class="od_pay_buttons_el clearfix">
						<?php
						$multi_settle = 0;
						$checked = '';

						$escrow_title = "";
						if ($default['de_escrow_use']) {
							$escrow_title = "에스크로<br>";
						}

						if ($default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use']) {
							//echo '<fieldset id="sod_frm_paysel">';
							//echo '<legend>결제방법 선택</legend>';
						}

						// 가상계좌 사용
						if ($default['de_vbank_use']) {
							$multi_settle++;
							echo '<input type="radio" id="od_settle_vbank" name="od_settle_case" value="가상계좌" '.$checked.'> <label for="od_settle_vbank" class="lb_icon vbank_icon">'.$escrow_title.'가상계좌</label>'.PHP_EOL;
							$checked = '';
						}

						// 계좌이체 사용
						if ($default['de_iche_use']) {
							$multi_settle++;
							echo '<input type="radio" id="pp_settle_iche" name="pp_settle_case" value="계좌이체" '.$checked.'> <label for="pp_settle_iche" class="lb_icon iche_icon">'.$escrow_title.'계좌이체</label>'.PHP_EOL;
							$checked = '';
						}

						// 휴대폰 사용
						if ($default['de_hp_use']) {
							$multi_settle++;
							echo '<input type="radio" id="pp_settle_hp" name="pp_settle_case" value="휴대폰" '.$checked.'> <label for="pp_settle_hp" class="lb_icon hp_icon">휴대폰</label>'.PHP_EOL;
							$checked = '';
						}

						// 신용카드 사용
						if ($default['de_card_use']) {
							$multi_settle++;
							echo '<input type="radio" id="pp_settle_card" name="pp_settle_case" value="신용카드" '.$checked.'> <label for="pp_settle_card" class="lb_icon card_icon">신용카드</label>'.PHP_EOL;
							$checked = '';
						}

						?>
						</div>

						<?php
						if ($default['de_vbank_use'] || $default['de_iche_use'] || $default['de_card_use'] || $default['de_hp_use']) {
							//echo '</fieldset>';

						}

						if ($multi_settle == 0)
							echo '<p class="alert alert-light text-center small py-2 mt-2 mb-0" role="alert">결제할 방법이 없습니다.<br>운영자에게 알려주시면 감사하겠습니다.</p>';
						?>
					</li>
					<li class="list-group-item">
						<?php
						ob_start();
							// 결제대행사별 코드 include (주문버튼)
							require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.3.php');

						$content = ob_get_contents();
						ob_end_clean();

						$content = str_replace('btn_confirm', 'd-flex gap-2', $content);
						$content = str_replace('btn_submit', 'btn btn-primary btn-lg flex-grow-1 order-2 py-3', $content);
						$content = str_replace('btn01', 'btn btn-basic btn-lg order-1 py-3', $content);

						echo $content;
						?>
					</li>
				</ul>
			</section>
		</div>
	</div>

	<?php
	if ($default['de_escrow_use']) {
		// 결제대행사별 코드 include (에스크로 안내)
		require_once(G5_SHOP_PATH.'/'.$default['de_pg_service'].'/orderform.4.php');
	}
	?>
</form>

<script>
function forderform_check(f)
{
    var settle_case = document.getElementsByName("pp_settle_case");
    var settle_check = false;
    var settle_method = "";
    for (i=0; i<settle_case.length; i++) {
        if (settle_case[i].checked) {
            settle_check = true;
            settle_method = settle_case[i].value;
            break;
        }
    }

    if (!settle_check) {
        na_alert("결제방식을 선택하십시오.");
        return false;
    }

    var tot_price = <?php echo (int)$pp['pp_price']; ?>;

    if (document.getElementById("pp_settle_iche")) {
        if (document.getElementById("pp_settle_iche").checked) {
            if (tot_price < 150) {
                na_alert("계좌이체는 150원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("pp_settle_card")) {
        if (document.getElementById("pp_settle_card").checked) {
            if (tot_price < 1000) {
                na_alert("신용카드는 1000원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    if (document.getElementById("pp_settle_hp")) {
        if (document.getElementById("pp_settle_hp").checked) {
            if (tot_price < 350) {
                na_alert("휴대폰은 350원 이상 결제가 가능합니다.");
                return false;
            }
        }
    }

    // pay_method 설정
    <?php if($default['de_pg_service'] == 'kcp') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.pay_method.value = "010000000000";
            break;
        case "가상계좌":
            f.pay_method.value = "001000000000";
            break;
        case "휴대폰":
            f.pay_method.value = "000010000000";
            break;
        case "신용카드":
            f.pay_method.value = "100000000000";
            break;
        default:
            f.pay_method.value = "무통장";
            break;
    }
    <?php } else if($default['de_pg_service'] == 'lg') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0030";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0030";
            break;
        case "가상계좌":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0040";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0040";
            break;
        case "휴대폰":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0060";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0060";
            break;
        case "신용카드":
            f.LGD_CUSTOM_FIRSTPAY.value = "SC0010";
            f.LGD_CUSTOM_USABLEPAY.value = "SC0010";
            break;
        default:
            f.LGD_CUSTOM_FIRSTPAY.value = "무통장";
            break;
    }
    <?php }  else if($default['de_pg_service'] == 'inicis') { ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.gopaymethod.value = "onlydbank";
            break;
        case "가상계좌":
            f.gopaymethod.value = "onlyvbank";
            break;
        case "휴대폰":
            f.gopaymethod.value = "onlyhpp";
            break;
        case "신용카드":
            f.gopaymethod.value = "onlycard";
            break;
        default:
            f.gopaymethod.value = "무통장";
            break;
    }
    <?php } else if($default['de_pg_service'] == 'nicepay') { ?>
    f.DirectShowOpt.value = "";     // 간편결제 요청 값 초기화
    f.DirectEasyPay.value = "";     // 간편결제 요청 값 초기화
    f.NicepayReserved.value = "";   // 간편결제 요청 값 초기화
    f.EasyPayMethod.value = "";   // 간편결제 요청 값 초기화

        <?php if ($default['de_escrow_use']) {  // 간편결제시 에스크로값이 0이 되므로 기본설정값을 지정 ?>
        f.TransType.value = "1";
        <?php } ?>
    switch(settle_method)
    {
        case "계좌이체":
            f.PayMethod.value = "BANK";
            break;
        case "가상계좌":
            f.PayMethod.value = "VBANK";
            break;
        case "휴대폰":
            f.PayMethod.value = "CELLPHONE";
            break;
        case "신용카드":
            f.PayMethod.value = "CARD";
            break;
        default:
            f.PayMethod.value = "무통장";
            break;
    }
    <?php } ?>
    // 결제정보설정
    <?php if($default['de_pg_service'] == 'kcp') { ?>
    f.buyr_name.value = f.pp_name.value;
    f.buyr_mail.value = f.pp_email.value;
    f.buyr_tel1.value = f.pp_hp.value;
    f.buyr_tel2.value = f.pp_hp.value;
    f.rcvr_name.value = f.pp_name.value;
    f.rcvr_tel1.value = f.pp_hp.value;
    f.rcvr_tel2.value = f.pp_hp.value;
    f.rcvr_mail.value = f.pp_email.value;

    if(f.pay_method.value != "무통장") {
        jsf__pay( f );
    } else {
        f.submit();
    }
    <?php } ?>
    <?php if($default['de_pg_service'] == 'lg') { ?>
    f.LGD_BUYER.value = f.pp_name.value;
    f.LGD_BUYEREMAIL.value = f.pp_email.value;
    f.LGD_BUYERPHONE.value = f.pp_hp.value;
    f.LGD_AMOUNT.value = f.good_mny.value;
    f.LGD_TAXFREEAMOUNT.value = 0;

    if(f.LGD_CUSTOM_FIRSTPAY.value != "무통장") {
          launchCrossPlatform(f);
    } else {
        f.submit();
    }
    <?php } ?>
    <?php if($default['de_pg_service'] == 'inicis') { ?>
    f.price.value       = f.good_mny.value;
    f.buyername.value   = f.pp_name.value;
    f.buyeremail.value  = f.pp_email.value;
    f.buyertel.value    = f.pp_hp.value;

    if(f.gopaymethod.value != "무통장") {
        // 주문정보 임시저장
        var order_data = $(f).serialize();
        var save_result = "";
        $.ajax({
            type: "POST",
            data: order_data,
            url: g5_url+"/shop/ajax.orderdatasave.php",
            cache: false,
            async: false,
            success: function(data) {
                save_result = data;
            }
        });

        if(save_result) {
            na_alert(save_result);
            return false;
        }

        if(!make_signature(f))
            return false;

        paybtn(f);
    } else {
        f.submit();
    }
    <?php } ?>
    <?php if($default['de_pg_service'] == 'nicepay') { ?>
    f.Amt.value       = f.good_mny.value;
    <?php if($default['de_tax_flag_use']) { ?>
    f.SupplyAmt.value         = f.comm_tax_mny.value;
    f.GoodsVat.value     = f.comm_vat_mny.value;
    f.TaxFreeAmt.value     = f.comm_free_mny.value;
    <?php } ?>
    f.BuyerName.value   = f.pp_name.value;
    f.BuyerEmail.value  = f.pp_email.value;
    f.BuyerTel.value    = f.pp_hp.value;

    if(f.PayMethod.value != "무통장") {
        // 주문정보 임시저장
        var order_data = $(f).serialize();
        var save_result = "";
        $.ajax({
            type: "POST",
            data: order_data,
            url: g5_url+"/shop/ajax.orderdatasave.php",
            cache: false,
            async: false,
            success: function(data) {
                save_result = data;
            }
        });

        if(save_result) {
            alert(save_result);
            return false;
        }

        if(!nicepay_create_signdata(f))
            return false;
        
        nicepayStart(f);
    } else {
        f.submit();
    }
    <?php } ?>
}
</script>