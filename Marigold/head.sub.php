<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

// CDN
define('JS_VER', '20240708');

define('BOOTSTRAP_CSS', '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">');

define('BOOTSTRAP_JS', '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>');

define('BOOTSTRAP_ICON', '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">');

define('JQUERY_JS', '<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>');

define('CLIPBOARD_JS', '<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>');

define('SWEETALERT_JS', '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>');

// 쇼핑몰 체크
(IS_YC && defined('_SHOP_')) ? define('IS_SHOP', true) : define('IS_SHOP', false);

// 쇼핑몰 타이틀
if(IS_SHOP && isset($nariya['seo_shop_title']) && $nariya['seo_shop_title'])
	$config['cf_title'] = $nariya['seo_shop_title'];

// 인덱스
(defined('_INDEX_')) ? define('IS_INDEX', true) : define('IS_INDEX', false);

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    // 상태바에 표시될 제목
    $g5_head_title = implode(' | ', array_filter(array($g5['title'], $config['cf_title'])));
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/

// 레이아웃 상수
$layout_skin = '';
if(IS_YC) {
	if(IS_SHOP) {
		$layout_skin = G5_IS_MOBILE ? $nariya['layout_shop_mo'] : $nariya['layout_shop_pc'];
	} else {
		$layout_skin = G5_IS_MOBILE ? $nariya['layout_mo'] : $nariya['layout_pc'];
	}
} else {
	$layout_skin = G5_IS_MOBILE ? $nariya['layout_mo'] : $nariya['layout_pc'];
}

// 미리보기
if (IS_DEMO) {
	if (isset($_REQUEST['pv']) && $_REQUEST['pv'])
		set_session('pv', na_fid($_REQUEST['pv']));

	$pv_layout = na_fid(get_session('pv'));

	if ($pv_layout) {
		if ($pv_layout == '1' || !is_dir(G5_THEME_PATH.'/layout/'.$pv_layout)) {
			set_session('pv', '');
		} else {
			$layout_skin = $pv_layout;
		}
	}
}

if (!$layout_skin || !is_dir(G5_THEME_PATH.'/layout/'.$layout_skin)) 
	$layout_skin = 'basic';

define('LAYOUT_SKIN', $layout_skin);
define('LAYOUT_URL', G5_THEME_URL.'/layout/'.$layout_skin);
define('LAYOUT_PATH', G5_THEME_PATH.'/layout/'.$layout_skin);

// 레이아웃 설정값
$layout_config_file = $config['cf_theme'].'-'.$layout_skin;
if(IS_SHOP)
	$layout_config_file .= '-shop';
if(G5_IS_MOBILE)
	$layout_config_file .= '-mo';

define('LAYOUT_CONFIG', $layout_config_file);

$layout = array();
$layout = na_file_var_load(NA_DATA_PATH.'/theme/'.LAYOUT_CONFIG.'.php');

// 홈주소
(IS_SHOP) ? define('HOME_URL', G5_SHOP_URL) : define('HOME_URL', G5_URL);

// 페이지 타이틀
if(isset($board['bo_subject']) && $board['bo_subject']) {
	$page_title = $board['bo_subject'];
} else if(isset($group['gr_subject']) && $group['gr_subject']) {
	$page_title = $group['gr_subject'];
} else {
	$page_title = $g5['title'];
}

$page_title = get_text($page_title);

include_once(LAYOUT_PATH.'/head.sub.php');

na_script('plyr');