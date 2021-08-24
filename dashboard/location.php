<?php 
include_once("header.php");
include_once("menu.php");
?>	

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;key=AIzaSyCfnMjockzJAjxFh1kHZklWoyjF7Itu9As"></script>
<script src='jquery-1.9.0.min.js' type="text/javascript"></script>
        
<script>

var map, marker;
$(document).ready(function() {

    function myMap(lat,long) {
        var myCenter = new google.maps.LatLng(lat,long);
        var mapCanvas = document.getElementById("map");

        var mapOptions = {
            center: myCenter, 
            zoom: 9,
            treetViewControl: false,
            mapTypeControl: false
        };

        map = new google.maps.Map(mapCanvas, mapOptions);
        marker = new google.maps.Marker(
            {
                position:myCenter,
                draggable: true,
                title: "Your location"
            }
        );
        marker.setMap(map);

        // Zoom to 9 when clicking on marker
        google.maps.event.addListener(marker,'click',function() {
            map.setZoom(15);
            map.setCenter(marker.getPosition());
        });

        //sets variable for lat and long
        $('.lat').text(lat);
        $('.long').text(long);
        
        google.maps.event.addListener(marker, 'dragend', function (event) {
                  document.getElementById("lat").value = event.latLng.lat();
                  document.getElementById("lng").value = event.latLng.lng();
                  infoWindow.open(map, marker);
        });
    }
    

    function newLocation(newLat,newLng)
    {
        map.setCenter({
            lat : newLat,
            lng : newLng
        });
    }
    
    

    google.maps.event.addDomListener(window, 'load', myMap(<?php echo $userInfo['new_lat'] ?>,<?php echo $userInfo['new_lng']  ?>));


    $(document).ready(function ()
    {
        // click on map and set you marker to that position
        google.maps.event.addListener(map, 'click', function(event) {
            var lat = event.latLng.lat();
            var lng = event.latLng.lng();
            document.getElementById("lat").value = lat;
            document.getElementById("lng").value = lng;
            document.getElementById("q").value = lat+";"+lng;
            marker.setPosition(event.latLng);
        });
    });

});

</script>
<script type="text/javascript">//<![CDATA[
/*
        window.onload=function(){
          var map;
          function initialize() {
              var myLatlng = new google.maps.LatLng(<?php //echo $userInfo['new_lat'] ?>, <?php //echo $userInfo['new_lng']  ?>);

              var myOptions = {
                  zoom: 6,
                  center: myLatlng,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
              };
              map = new google.maps.Map(document.getElementById("map"), myOptions);

              var marker = new google.maps.Marker({
                  draggable: true,
                  position: myLatlng,
                  map: map,
                  title: "Your location"
              });
              
              google.maps.event.addListener(marker,'click',function() {
                map.setZoom(15);
                map.setCenter(marker.getPosition());
              });

              google.maps.event.addListener(marker, 'dragend', function (event) {
                  document.getElementById("lat").value = event.latLng.lat();
                  document.getElementById("lng").value = event.latLng.lng();
                  infoWindow.open(map, marker);
              });
          }
          google.maps.event.addDomListener(window, "load", initialize());
        }//]]> 
        
        */
    </script>
	<section id="main" class="column">
		
		
		<article class="module width_full">
			<header><h3>Edit Your Location</h3></header>
			<div class="module_content" >
			  	
                 
                 
               <form enctype="multipart/form-data" action="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&location&edit" method="post">
                 <input type="hidden" id="lat" name="lat" />
                 <input type="hidden" id="lng" name="lng" />
                 
                 <?php if(@ $status == 1){?>
                   <h4 class="alert_error"> <?php echo $error; ?></h4> 
                   <br />
                 <br />
                 <?php } else  if(@ $status == 0 && isset($_POST['submit_location_update'])){?>
                   <h4 class="alert_success"> <?php echo $error; ?></h4> 
                   <br />
                 <br />
                 <?php } ?>
                 
                 
                 
                 <div id="map" style=" width: 500px; height: 300px; margin-left:150px ;"></div>
                 
                 <fieldset>
                   <label>near by</label>
                   <input type="text" id="q"  />
                 </fieldset>
                 
                 <div>
                 <input type="submit" name="submit_location_update" style="color: red;" value="Update"/>
                 </div>
                 
                 
               </form>  
                
			</div>
		</article><!-- end of stats article -->
		
	
		
</body>

<script>
var myLatlng = new google.maps.LatLng(-25.363882,131.044922);
var mapOptions = {
  zoom: 4,
  center: myLatlng
}
var map = new google.maps.Map(document.getElementById("map"), mapOptions);

// Place a draggable marker on the map
var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    draggable:true,
    title:"Drag me!"
});
</script>
</html>