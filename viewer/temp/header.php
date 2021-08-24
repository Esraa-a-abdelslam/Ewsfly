<html>

<head>
<link  rel="stylesheet" href="viewer/css/home.css"/>
<link  rel="stylesheet" href="viewer/css/footer.css"/>
<link rel="stylesheet" type="text/css" href="viewer/css/profileStyle.css" />
<link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

   <!-------------------- control panel -------------------------->
    <link rel="stylesheet"type="text/css" href="viewer/css/style.css" />

<!------------------------ Map Code-------------------------------------->
<script type="text/javascript" src="viewer/js/filter.js"></script>
    <script>
    var latt ;
    var lngg ;  
    var region;
    
    function showFilter(q){
      window.location= "index.php?filter="+q;
    } 
    
    function ajax_post_position(lat,lng){
        if (window.XMLHttpRequest)
          {// code for IE7+, Firefox, Chrome, Opera, Safari
          xmlhttp1=new XMLHttpRequest();
          }
        else
          {// code for IE6, IE5
          xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
          }
        xmlhttp1.onreadystatechange=function()
          {
          if (xmlhttp1.readyState==4 && xmlhttp1.status==200)  
            {
            }
          }
        xmlhttp1.open("GET","index.php?getPosition&lat="+lat+"&lng="+lng,true);
        xmlhttp1.send();   
    }
    
    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
         
      } 
      else{
         latt = 31.035;
         lngg =31.374; 
         region = {lat: latt, lng: lngg};
         var map = new google.maps.Map(
          document.getElementById('map_canvas'), {zoom: 13, center: region});
          var image = "http://maps.google.com/mapfiles/ms/icons/green-dot.png"; 
            
      var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latt,lngg),
            map: map,
            icon: image,
            draggable:false,
            animation: google.maps.Animation.DROP,
            title:'your location'
          });
      
      google.maps.event.addListener(marker,'click',function() {
                 map.setZoom(15);
                 map.setCenter(marker.getPosition());
      });
         ajax_post_position(latt,lngg); 
      }
    }

    function showPosition(position) {
      latt = parseFloat(position.coords.latitude);
      lngg = parseFloat(position.coords.longitude);
      region = {lat: latt, lng: lngg};
      var map = new google.maps.Map(document.getElementById('map_canvas'), {zoom: 13, center: region}); 
      var image = "http://maps.google.com/mapfiles/ms/icons/green-dot.png"; 
            
      var marker = new google.maps.Marker({
            position: new google.maps.LatLng(latt,lngg),
            map: map,
            icon: image,
            draggable:false,
            animation: google.maps.Animation.DROP,
            title:'your location'
          });
      
      google.maps.event.addListener(marker,'click',function() {
                 map.setZoom(15);
                 map.setCenter(marker.getPosition());
      });
      <?php 
        if(isset($_GET['filter'])&& $setMarker==1){
            echo $markers;
        }
        if(isset($_GET['filter'])&& $setSpecifiedMarker==1){
            echo $specifiedMarkers;
        }
        if(isset($_GET['query'])&& $setSpecifiedMarker==1){
            echo $specifiedMarkers;
        }
      ?>
      ajax_post_position(latt,lngg);    
      
    }
    
   
    // Initialize and add the map
    
   function initMap() {
     getLocation();
     
    }
    
    function openLink(id) {
       window.location = 'index.php?aprofile&id='+id;
    }
                 
    
    
    </script>
    
    <script type="text/javascript" src="viewer/js/javascript.js"></script>
<!------------------------ End Map Code-------------------------------------->



<!------------------------ start Search-------------------------------------->
		<link rel="stylesheet" type="text/css" href="viewer/css/style.css" />
		<script type="text/javascript" src="http://www.google.com/jsapi"></script>
		<script type="text/javascript" src="viewer/js/script.js"></script>
<!------------------------ End Search-------------------------------------->

 <!----------------------------- rating ------------------------------->   
       	<script src='viewer/js/jquery.js' type="text/javascript"></script>
        <script src='viewer/js/jquery.rating.js' type="text/javascript" language="javascript"></script>
        <link href='viewer/css/jquery.rating.css' type="text/css" rel="stylesheet"/>
 <!----------------------------- rating ------------------------------->
  


</head>

<!--------------------Header--------------------!>
<div class="header">
    <div class="inner-header">
    <div class="logo Ewsfly"><a href="index.php"><img src="viewer/images/logo6.png" style="width: 300px; height: 80px; margin-top: 5px; margin-left: 5px;" /></a></div>
    <?php if(isset($_SESSION['user_id']))
    {
    ?>
        <div class="login logOut" style="height: 20px;">
            <form class="logOut-form" name="logOut-form" action="index.php" method="POST">
                <div style="float: left; width: 200px;"><label class="welcome"  style="font-family: 'Ubuntu', sans-serif;">Welcome, <font color="#F25D4E"> <?php if(isset($username))echo @$username; elseif(isset($userInfo)) echo @$userInfo['name']; else echo"user"; ?></font></label></div>
                <div style=" margin:0px 0px 0px 50px; width: 20px; float: left;"><a class="" href="index.php?profile&userid=<?php echo $_SESSION['user_id']; ?>"><img src="viewer/images/profile.png" width="20"/></a></div>
                <div style=" margin:0px 0px 0px 20px; width: 20px; float: left;"><a class="" href="index.php?logout"  style="text-decoration: none;"><img src="viewer/images/logout.png" width="20" /></a></div>
            </form>
        </div>
       <?php 
    }
    else {
        ?>
        <div class="login">
            <form class="login-form" name="login-form" action="index.php" method="POST" onsubmit="if(document.getElementById('email').value == '' && document.getElementById('password').value == ''){
                                                                                                    alert('Enter Email And Password');
                                                                                                    return false;}
                                                                                                else if(document.getElementById('email').value == ''){
                                                                                                    alert('Enter Email');
                                                                                                    return false;}
                                                                                                else if(document.getElementById('password').value == ''){
                                                                                                    alert('Enter Password');
                                                                                                    return false;
                                                                                                }">
                <div class="email"><label class="a" style="font-family: 'Ubuntu', sans-serif;">Email</label><input  type="text" autocomplete="off" class="textbox-login" name="email" id="email"/>
                <input  type="checkbox" class="checkbox" name="remember"/><label class="Remember"  style="font-family: 'Ubuntu', sans-serif;">Remember Me</label>
                </div>
                <div class="password" ><label class="a" style="font-family: 'Ubuntu', sans-serif;">Password</label><input  type="password" autocomplete="off" class="textbox-login" name="password" id="password"/>
               
                </div>
                <div class="login-button"><input type="submit" name="login-form" value="Login" class="button" style="margin-top: 20px; font-family: 'Ubuntu', sans-serif;"/></div>
                <div class="Rem"></div>
                
            </form>
</div>
  <?php   } ?>

    </div>
</div>
<!--------------------End - Header--------------------!>

<!--- Used To upload img ---->
    <script src="http://code.jquery.com/jquery-1.8.2.min.js" type="text/javascript"></script>
    <!------------Fancy Box--------------------!>
	<script type="text/javascript" src="viewer/js/jquery.fancybox.js?v=2.1.3"></script>
	<link rel="stylesheet" type="text/css" href="viewer/css/jquery.fancybox.css?v=2.1.2" media="screen" />
<script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
<!------------Ens - Fancy Box--------------------!>
    
<!-- validation Code -->
<script type="text/javascript" src="viewer/js/valid.js"></script>
<script>
  $(document).ready(function(){
    $("#reg-form").validate();
  });
  </script>
  

