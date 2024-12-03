<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 멤버십
na_membership('write', '멤버십 회원만 등록할 수 있습니다.');

// 여분필드 사용 내역
// wr_7 : 신고(lock) - 고정(수정 불가)
// wr_8 : 태그 - 입력
// wr_9 : 유튜브 동영상 - 자동 계산
// wr_10 : 대표 이미지 - 자동 계산

// 신고(wr_7)는 고정
if ($w == 'u') {
    $wr = get_write($write_table, $wr_id);
	if(isset($wr['wr_7'])) {
		$wr_7 = $wr['wr_7'];
	}
}