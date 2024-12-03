<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 신고(wr_7)는 고정
if ($w == 'cu') {
    $cmt = sql_fetch(" select wr_7 from $write_table where wr_id = '$comment_id' ");
	if(isset($cmt['wr_7'])) {
		$wr_7 = $cmt['wr_7'];
	}
}