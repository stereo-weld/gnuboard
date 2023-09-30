<?php
include_once('./_common.php');

// 좌표 정보
$arr = explode(",",$geo);
$lat = (isset($arr[0]) && $arr[0]) ? $arr[0] : '37.566535';
$lng = (isset($arr[1]) && $arr[1]) ? $arr[1] : '126.977969';
$zoom = (isset($arr[2]) && $arr[2]) ? $arr[2] : 13;

if(isset($nariya['kakaomap_key']) && $nariya['kakaomap_key']) {
	$marker = (isset($marker) && $marker) ? $marker : '자세히 보기';
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>카카오맵 보기</title>
<link rel="stylesheet" href="../css/nariya.css" type="text/css">
<style>
	.customoverlay {position:relative;bottom:85px;border-radius:6px;border: 1px solid #ccc;border-bottom:2px solid #ddd;float:left;}
	.customoverlay:nth-of-type(n) {border:0; box-shadow:0px 1px 2px #888;}
	.customoverlay a {
		display:block;text-decoration:none;color:#000;text-align:center;border-radius:6px;font-size:14px;font-weight:bold;overflow:hidden;
		background: #d95050 url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/arrow_white.png') no-repeat right 14px center;
	}
	.customoverlay .title {display:block;text-align:center;background:#fff;margin-right:35px;padding:10px 15px;font-size:14px;font-weight:bold;}
	.customoverlay:after {
		content:'';position:absolute;margin-left:-12px;left:50%;bottom:-12px;width:22px;height:12px;background:url('https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/vertex_white.png')
	}
</style>
</head>
<body>
<div class="na-mapwrap" style="padding-bottom:56.25%;">
	<div id="map" class="na-map">
		<div id="map_canvas" class="na-canvas"></div>
	</div>
</div>
<script src="<?php echo NA_URL ?>/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo $nariya['kakaomap_key'] ?>&libraries=services"></script>
<script>
var mapContainer = document.getElementById('map_canvas'), // 지도를 표시할 div 
  mapOption = { 
		center: new kakao.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>), // 지도의 중심좌표
		level: 3 // 지도의 확대 레벨
};

var map = new kakao.maps.Map(mapContainer, mapOption);

var imageSrc = 'https://t1.daumcdn.net/localimg/localimages/07/mapapidoc/marker_red.png', // 마커이미지의 주소입니다.
	imageSize = new kakao.maps.Size(64, 69), // 마커이미지의 크기입니다
	imageOption = {offset: new kakao.maps.Point(27, 69)}; // 마커이미지의 옵션입니다. 마커의 좌표와 일치시킬 이미지 안에서의 좌표를 설정합니다.

// 마커의 이미지정보를 가지고 있는 마커이미지를 생성합니다.
var markerImage = new kakao.maps.MarkerImage(imageSrc, imageSize, imageOption),
	markerPosition = new kakao.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>); // 마커가 표시될 위치입니다.

// 마커를 생성합니다
var marker = new kakao.maps.Marker({
  position: markerPosition,
  image: markerImage // 마커이미지 설정 
});

// 마커가 지도 위에 표시되도록 설정합니다.
marker.setMap(map);  

// 커스텀 오버레이에 표출될 내용으로 HTML 문자열이나 document element가 가능합니다.
var content = '<div class="customoverlay">' +
    '  <a href="https://map.kakao.com/link/map/<?php echo $marker ?>,<?php echo $lat ?>,<?php echo $lng ?>" target="_blank">' +
    '    <span class="title"><?php echo $marker ?></span>' +
    '  </a>' +
    '</div>';

// 커스텀 오버레이가 표시될 위치입니다.
var position = new kakao.maps.LatLng(<?php echo $lat ?>, <?php echo $lng ?>);

// 커스텀 오버레이를 생성합니다.
var customOverlay = new kakao.maps.CustomOverlay({
	map: map,
	position: position,
	content: content,
	yAnchor: 1 
});

// 마커를 기준으로 가운데 정렬이 될 수 있도록 추가
var markerPosition = marker.getPosition(); 
map.relayout();
map.setCenter(markerPosition);

$(window).on('resize', function () {
	var markerPosition = marker.getPosition(); 
	map.relayout();
	map.setCenter(markerPosition)
});
</script>
</body>
</html>

<?php

} else {

function google_map_address_json($lat, $lng) {
	global $nariya;

	$url = 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$lng.'&language=ko&key='.$nariya['google_key'];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
	$json = json_decode(curl_exec($ch), true);
    curl_close($ch);

    return $json;
}

//지역정보
if(isset($place) && $place) {
	$address = $place;
} else {
	$json = google_map_address_json($lat, $lng);
	$address = isset($json['results'][0]['formatted_address']) ? $json['results'][0]['formatted_address'] : '';
}

$address = urlencode($address);

?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<title>구글맵 보기</title>
<link rel="stylesheet" href="../css/nariya.css" type="text/css">
<style>
	body { margin:0; padding:0; -webkit-text-size-adjust:100%; background:#fff; }
	a { color: rgb(51, 51, 51); cursor: pointer; text-decoration: none; }
	a:hover, a:focus, a:active { color: crimson; text-decoration: none; }
	.infowindow { min-width:180px; max-width:280px; line-height:22px; }
	.infoline { height:6px; }
</style>
<script src="<?php echo NA_URL ?>/js/jquery-3.5.1.min.js"></script>
<script src="https://maps.google.com/maps/api/js?v=3.exp&language=ko&region=kr&key=<?php echo $nariya['google_key'] ?>"></script>
<script>
	// 구글맵
	var map;
	var marker;
	var markerimg = '<?php echo NA_URL ?>/img/map-icon.png';
	var infowindow;
	var geocoder;
	var myLatlng;

	function addLoadEvent(func) {
		var oldonload = window.onload;
		if (typeof window.onload != 'function') {
			window.onload = func;
		} else {
			window.onload = function() {
				if (oldonload) {
					oldonload();
				}
				func();
			}
		}
	}

	function initialize() {
		myLatlng = new google.maps.LatLng("<?php echo $lat ?>", "<?php echo $lng ?>");
		geocoder = new google.maps.Geocoder();
		var myOptions = {
			zoom: <?php echo $zoom ?>,
			scaleControl: true,
			navigationControl: true,
			navigationControlOptions: {
				style: google.maps.NavigationControlStyle.SMALL,
				position: google.maps.ControlPosition.TOP_RIGHT
			},
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		marker = new google.maps.Marker({
			position: myLatlng,
			icon: markerimg,
			map: map
		});

		infowindow = new google.maps.InfoWindow();

		var infotxt = '';
		<?php if(isset($marker) && $marker) { ?>
			infotxt += "<?php echo $marker ?>";
			infotxt += "<div class='infoline'></div>";
		<?php } ?>
		infotxt += "<a href='#' onclick='geocodeAddress();'>자세히 보기</a>";

		infowindow.setContent("<div class='infowindow'>" + infotxt + "</div>");
		infowindow.open(map,marker);

		google.maps.event.addListener(map, 'zoom_changed', function() {
			zoomLevel = map.getZoom(); 
			if (zoomLevel > 19) { 
			  map.setZoom(19); 
			} else if (zoomLevel < 1) { 
			  map.setZoom(1); 
			}   
		});
	}

	function geocodeAddress() {
		var address = "<?php echo $address ?>";

		if(address) {
			address = "place/" + address + "/";
		}

		var url = "https://www.google.co.kr/maps/" + address + "@<?php echo $lat ?>,<?php echo $lng ?>,<?php echo $zoom ?>z?hl=ko";
		window.open(url);
		return false;
	}
</script>
</head>
<body>
	<div class="na-mapwrap" style="padding-bottom:56.25%;">
		<div id="map" class="na-map">
			<div id="map_canvas" class="na-canvas"></div>
		</div>
	</div>
	<script> addLoadEvent(initialize); </script>
</body>
</html>
<?php } ?>