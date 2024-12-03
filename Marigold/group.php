<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$is_admin) {
	if(G5_IS_MOBILE) {
		if($group['gr_device'] == 'pc')
		    alert($group['gr_subject'].' 그룹은 PC에서만 접근할 수 있습니다.');
	} else {
		if($group['gr_device'] == 'mobile')
			alert($group['gr_subject'].' 그룹은 모바일에서만 접근할 수 있습니다.');
	}
}

$g5['title'] = $group['gr_subject'];
include_once(G5_THEME_PATH.'/head.php');

// layout 내 경로지정
$group_skin_path = LAYOUT_PATH.'/group';
$group_skin_url = LAYOUT_URL.'/group';
if(is_file($group_skin_path.'/'.$gr_id.'.php')) {
	include_once($group_skin_path.'/'.$gr_id.'.php');
} else {
	include_once(LAYOUT_PATH.'/group.php');
}

include_once(G5_THEME_PATH.'/tail.php');