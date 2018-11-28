<?php /* Template_ 2.2.7 2018/11/03 03:50:15 /www/jbsinttr8192_godo_co_kr/shop/data/skin/damoashop/proc/dealer_map.htm 000004998 */ ?>
<?php $this->print_("header",$TPL_SCP,1);?>

<?php

//phpinfo();
include "/shop/lib/library.php";
//include_once dirname(__FILE__)."/../conf/config.php";
include_once "/shop/conf/config.php";
$query = "SELECT  count(*) as cnt FROM ".GD_MEMBER." WHERE level = 2 or level = 3 ";
$rs = $db->query($query);
//$row = $db->fetch($rs,1);
$row = mysqli_fetch_array($rs);
echo $row['cnt'];
?>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDbIoOQH1zDmI32bxqlvyMv35fZofWpugs&callback=initialize" async defer></script>
<script>
     function initialize() {
       var mylat = "";
       var mylong = "";
        navigator.geolocation.getCurrentPosition(function(pos) {
          mylat = pos.coords.latitude;
          mylong = pos.coords.longitude;

        });
        //37.486720, 126.892103
        //var myLatLng = new google.maps.LatLng(mylat, mylong);
        var myLatLng = new google.maps.LatLng('37.486720', '126.892103');

        var mapOptions = {
                            zoom: 11, // 지도를 띄웠을 때의 줌 크기
                            mapTypeId: google.maps.MapTypeId.ROADMAP

                        };


        var map = new google.maps.Map(document.getElementById("google_map"), // div의 id과 값이 같아야 함. "map-canvas"
                                    mapOptions);

        var size_x = 40; // 마커로 사용할 이미지의 가로 크기
        var size_y = 40; // 마커로 사용할 이미지의 세로 크기
        var myMarker = new google.maps.Marker({
                map: map,
          //icon: image, // 마커로 사용할 이미지(변수)
                icon: {
                    labelOrigin: new google.maps.Point(11, 22),
                    url: '//maps.gstatic.com/mapfiles/mobile/mobileimgs2.png',
                    size: new google.maps.Size(22, 22),
                    origin: new google.maps.Point(0, 18),
                    anchor: new google.maps.Point(11, 11),
                    },
                label: {
                    color: 'blue',
                    fontWeight: 'bold',
                    text: '현재위치'
                    },
          //label: company[i][0], // 마커에 마우스 포인트를 갖다댔을 때 뜨는 타이틀
                position: myLatLng
              });
        // 마커로 사용할 이미지 주소
		 var image = new google.maps.MarkerImage( 'http://www.bikeonline.co.kr/shop/data/skin/damoashop/img/map/marker.png',
                                                    '',
                                                    '',
                                                    '',
                                                    new google.maps.Size(size_x, size_y));
		 var company = [
	['바이크온라인','서울특별시 구로구 디지털로31길 53','02-3143-5547' ], //DB에서 가져오도록 바꿀것, 1번 타이틀, 마커 좌표값, 전번
	['모토라드 강남', '서울특별시 강남구 역삼동 785-15','010-9268-0467'] //DB에서 가져오도록 바꿀것, 2번 타이틀, 마커 좌표값, 전번
	];
        // Geocoding *****************************************************
		 var geocoder = new google.maps.Geocoder();

		for(var i=0; i < company.length; i++){
			geocoder.geocode( { 'address': company[i][1]},(function(i) {
				return function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						//map.setCenter(results[0].geometry.location);
            map.setCenter(myLatLng);
						var marker = new google.maps.Marker({
										map: map,
							//icon: image, // 마커로 사용할 이미지(변수)
										icon: {
												labelOrigin: new google.maps.Point(11, 40),
												url: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
												size: new google.maps.Size(32, 32),
												origin: new google.maps.Point(0, 0),
												anchor: new google.maps.Point(11, 40),
											  },
										label: {
												color: 'red',
												fontWeight: 'bold',
												text: company[i][0]
											  },
							//label: company[i][0], // 마커에 마우스 포인트를 갖다댔을 때 뜨는 타이틀
										position: results[0].geometry.location
									});


						//var content = "바이크온라인<br/><br/>Tel: 02-3143-5547"; // 말풍선 안에 들어갈 내용
						//content = contents;

						// 마커를 클릭했을 때의 이벤트. 말풍선 뿅~
						var infowindow = new google.maps.InfoWindow({ content: company[i][0]+'<br/>Tel:'+company[i][2]});
						google.maps.event.addListener(marker, "click", function() {infowindow.open(map,marker);});
						//infowindow.open(map,marker);
					} else {
						alert("Geocode was not successful for the following reason: " + status);
					}
				}
		 	})(i) );
        // Geocoding // *****************************************************
		}
    }
    </script>
<div id="google_map" style="width:790px; height:790px;"></div>
<?php $this->print_("footer",$TPL_SCP,1);?>