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
                            zoom: 11, // ������ ����� ���� �� ũ��
                            mapTypeId: google.maps.MapTypeId.ROADMAP

                        };


        var map = new google.maps.Map(document.getElementById("google_map"), // div�� id�� ���� ���ƾ� ��. "map-canvas"
                                    mapOptions);

        var size_x = 40; // ��Ŀ�� ����� �̹����� ���� ũ��
        var size_y = 40; // ��Ŀ�� ����� �̹����� ���� ũ��
        var myMarker = new google.maps.Marker({
                map: map,
          //icon: image, // ��Ŀ�� ����� �̹���(����)
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
                    text: '������ġ'
                    },
          //label: company[i][0], // ��Ŀ�� ���콺 ����Ʈ�� ���ٴ��� �� �ߴ� Ÿ��Ʋ
                position: myLatLng
              });
        // ��Ŀ�� ����� �̹��� �ּ�
		 var image = new google.maps.MarkerImage( 'http://www.bikeonline.co.kr/shop/data/skin/damoashop/img/map/marker.png',
                                                    '',
                                                    '',
                                                    '',
                                                    new google.maps.Size(size_x, size_y));
		 var company = [
	['����ũ�¶���','����Ư���� ���α� �����з�31�� 53','02-3143-5547' ], //DB���� ���������� �ٲܰ�, 1�� Ÿ��Ʋ, ��Ŀ ��ǥ��, ����
	['������ ����', '����Ư���� ������ ���ﵿ 785-15','010-9268-0467'] //DB���� ���������� �ٲܰ�, 2�� Ÿ��Ʋ, ��Ŀ ��ǥ��, ����
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
							//icon: image, // ��Ŀ�� ����� �̹���(����)
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
							//label: company[i][0], // ��Ŀ�� ���콺 ����Ʈ�� ���ٴ��� �� �ߴ� Ÿ��Ʋ
										position: results[0].geometry.location
									});


						//var content = "����ũ�¶���<br/><br/>Tel: 02-3143-5547"; // ��ǳ�� �ȿ� �� ����
						//content = contents;

						// ��Ŀ�� Ŭ������ ���� �̺�Ʈ. ��ǳ�� ��~
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