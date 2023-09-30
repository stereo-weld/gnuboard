<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

global $config, $g5_head_title, $bo_table, $view, $it, $co, $pset, $tset;

// 변수체크
$tset['site_desc'] = isset($tset['site_desc']) ? $tset['site_desc'] : '';
$tset['site_keys'] = isset($tset['site_keys']) ? $tset['site_keys'] : '';
$tset['site_img'] = isset($tset['site_img']) ? $tset['site_img'] : '';
$pset['href'] = isset($pset['href']) ? $pset['href'] : '';

// SEO 설정
$author = na_get_text($config['cf_title']);
$image = isset($tset['seo_img']) ? na_url($tset['seo_img']) : '';
$desc = isset($tset['seo_desc']) ? $tset['seo_desc'] : '';
$keys = isset($tset['seo_keys']) ? $tset['seo_keys'] : '';

if(isset($view['wr_id']) && $view['wr_id']) {
	// 게시물
	$author = na_get_text($view['wr_name']);
	$desc = na_cut_text($view['wr_content'], 150);
	$wr_image = (isset($view['seo_img']) && $view['seo_img']) ? $view['seo_img'] : na_wr_img($bo_table, $view);
	$image = ($wr_image) ? $wr_image : $image;
	$keys = isset($view['as_tag']) ? na_get_text($view['as_tag']) : ''; //태그 적용
} else if(isset($co['co_id']) && $co['co_id']) {
	// 내용관리
	$co['content'] = isset($co['content']) ? $co['content'] : '';
	$content = (isset($co['co_content']) && $co['co_content']) ? $co['co_content'] : $co['content'];
	$desc = ($desc) ? $desc : na_cut_text($content, 150);
	if(!$image) {
	    $imgs = get_editor_image($content);
		$image = isset($imgs[1][0]) ? $imgs[1][0] : '';
	}
} else if(IS_YC && isset($it['it_id']) && $it['it_id']) {
	// 상품
	$desc = na_cut_text($it['it_basic'].' '.$it['it_explan'], 150);
	if($it['it_img1']) {
		$image = G5_DATA_URL.'/item/'.$it['it_img1'];
	}
} else {
	$desc = ($desc) ? $desc : $tset['site_desc'];
	$keys = ($keys) ? $keys : $tset['site_keys'];
}

// 대표 이미지 설정
$image = ($image) ? $image : na_url($tset['site_img']);

// 내용(description)이 없으면 SEO용 메타태그 생성안함
if($desc) {
	// 키워드가 없으면 내용 중 3~10글자 사이 한글을 잘라서 최대 20개 자동생성
	if(!$keys) {

		$arr = array();

		$stx = $desc.' '.$g5_head_title; //내용과 제목 합쳐서 생성

		preg_match_all("|(?<keys>[가-힣]{3,10}+)|u", $stx, $matchs1);
		preg_match_all("|(?<keys>[a-zA-Z]{4,10}+)|u", $stx, $matchs2);

		$matchs = array_merge($matchs1['keys'], $matchs2['keys']);

		// 중복제거
		$tmps = array_unique($matchs);

		for($i=0; $i < count($tmps); $i++) {

			if(!isset($tmps[$i]) || !trim($tmps[$i]))
				continue;

			$arr[] = $tmps[$i];

			if($i > 20)
				break;
		}

		$keys = implode(', ', $arr);
	}
} else {
	return;
}

?>
<meta http-equiv="content-language" content="kr">
<meta name="robots" content="<?php echo (isset($tset['seo']) && $tset['seo'] == '2') ? 'noindex,nofollow' : 'index,follow'; ?>">
<meta name="title" content="<?php echo $g5_head_title ?>">
<meta name="author" content="<?php echo $author ?>">
<meta name="description" content="<?php echo $desc ?>">
<meta name="keywords" content="<?php echo $keys ?>">
<meta property="og:locale" content="ko_KR">
<meta property="og:type" content="website">
<meta property="og:rich_attachment" content="true">
<meta property="og:site_name" content="<?php echo $config['cf_title'] ?>">
<meta property="og:title" content="<?php echo $g5_head_title ?>">
<meta property="og:description" content="<?php echo $desc ?>">
<meta property="og:keywords" content="<?php echo $keys ?>">
<meta property="og:image" content="<?php echo $image ?>">
<meta property="og:url" content="<?php echo $pset['href'] ?>">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="<?php echo $config['cf_title'] ?>">
<meta name="twitter:title" content="<?php echo $g5_head_title ?>">
<meta name="twitter:description" content="<?php echo $desc ?>">
<meta name="twitter:keywords" content="<?php echo $keys ?>">
<meta name="twitter:image" content="<?php echo $image ?>">
<meta name="twitter:creator" content="<?php echo $author ?>">
<meta itemprop="name" content="<?php echo $g5_head_title ?>">
<meta itemprop="description" content="<?php echo $desc ?>">
<meta itemprop="keywords" content="<?php echo $keys ?>">
<meta itemprop="image" content="<?php echo $image ?>">
<meta name="apple-mobile-web-app-title" content="<?php echo $config['cf_title'] ?>">
<link rel="canonical" href="<?php echo $pset['href'] ?>">