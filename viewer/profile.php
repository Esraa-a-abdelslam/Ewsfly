<?php 
include_once('viewer/temp/header.php');
?>
<html>
<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<title>Ewsfly - Profile</title>
        <!------------------------------------ Map ---------------------------------->
        
        <script type="text/javascript">
          function profile_map() {
            var mapOptions = {
              center: new google.maps.LatLng(<?php echo $userInfo['new_lat'] ?>, <?php echo $userInfo['new_lng']  ?>),
              zoom: 20,
              mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("profile_map"),
                mapOptions);
                
            var image = "<?php echo 'viewer/images/icon/'.$userInfo['type'].'.png' ?>"; 
            var marker = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $userInfo['new_lat'] ?>,<?php echo $userInfo['new_lng'] ?>),
            map: map,
            icon: image,
            draggable:false,
            animation: google.maps.Animation.DROP,
            title:'<?php echo $userInfo['name'] ?>'
          });
    
          google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map,marker);
           });
    
        }
        </script>
    <!------------------------------------ End Map ---------------------------------->
   
    
</head>
<body onload="profile_map()">
<div class="left"></div>

<div class="contents" style="min-height: 500px;">

    <div class="img-class">
        <img src="upload/<?php echo $userInfo['photo'] ?>" width="200px" height="180px" class="img" style=""/>                     
     </div>
              
     <div class="info_new">
         <div class="name" style="font-family: 'Ubuntu', sans-serif;"><span class="title" ><?php echo $userInfo['name'] ?></span></div>
         <div class="nameHR"></div>
         <div class="rate"> 
            <div class="star-icon">
                    <img src="viewer/images/star.png" style="width: 80px; height: 80px;" />
                    <label class="rate-number"><?php echo round($userInfo['rate']/$userInfo['rate_num']) ?></label>
            </div>
            <div class="stars-rate">
                       <label class="label">Your Rating :</label><span class="font2">
                        <!--------------------------------- Rate -----------------------------> 
                  <?php if(!$_SESSION['user_id']){ ?>
                        <form method="post" style="margin-bottom: 0px;">
                         <?php if( $rate == 1 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star" checked="checked"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id']?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else if( $rate == 2 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" checked="checked" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id']?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php } 
                        else if( $rate == 3 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" checked="checked" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php } 
                        else if( $rate == 4 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star" checked="checked"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else if( $rate >= 5  ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star" checked="checked"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else{ ?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
                        
                        <?php }?>
                      <?php } else if($_SESSION['user_id']!=$_GET['userid'] ){ ?>
                        <form method="post" style="margin-bottom: 0px;">
                         <?php if( $rate == 1 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star" checked="checked"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id']?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else if( $rate == 2 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" checked="checked" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id']?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php } 
                        else if( $rate == 3 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" checked="checked" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php } 
                        else if( $rate == 4 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star" checked="checked"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else if( $rate >= 5  ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star" checked="checked"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else{ ?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
                        
                        <?php }?>
                      <?php } else if($_SESSION['user_id']!= $_GET['id'] && isset($_GET['aprofile']) ){ ?>
                        <form method="post" style="margin-bottom: 0px;">
                         <?php if( $rate == 1 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star" checked="checked"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id']?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else if( $rate == 2 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" checked="checked" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id']?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php } 
                        else if( $rate == 3 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" checked="checked" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php } 
                        else if( $rate == 4 ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star" checked="checked"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else if( $rate >= 5  ){?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star" checked="checked"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
        
                        <?php }
                        else{ ?>
                            <input name="star1" type="radio" class="star" value="1" id="star"/>
                            <input name="star1" type="radio" class="star" value="2" id="star" />
                            <input name="star1" type="radio" class="star" value="3" id="star" />
                            <input name="star1" type="radio" class="star" value="4" id="star"/>
                            <input name="star1" type="radio" class="star" value="5" id="star"/>
                            <input name="id" type="hidden" value="<?php echo $_GET['id'] ?>"/>
                            <input type="submit" class="submit" value="rate"/>
                        
                        <?php }?>
                      <?php } ?>    
                        </form>
                        <label class="font_rate">Rating : <?php echo round($userInfo['rate']/$userInfo['rate_num']) ?>/5</label><br />
                        <label class="font_rate">Voters : <?php echo $userInfo['rate_num'] ?> votes</label>
                        </span>
                        
                </div>
                    <div class="nameHR"></div> 
                </div>
                
                <!-------------------------- End Rate ------------------------------->
                </span>  
              <div class="info_bottom" >
              <table class="info-table">
                <tr>
                    <td><label class="label" style="font-family: 'Ubuntu', sans-serif;">Email</label></span></td>
                    <td><span class="font" style="font-family: 'Ubuntu', sans-serif;">: <?php echo $userInfo['email'] ?> </td>
                </tr>
                <tr>
                    <td><label class="label" style="font-family: 'Ubuntu', sans-serif;">Address</label></td>
                    <td><span class="font" style="font-family: 'Ubuntu', sans-serif;">: <?php if($userInfo['address']==""){ echo $address;  } else echo $userInfo['address'] ?> </span></td>
                </tr>
                <tr>
                    <td><label class="label" style="font-family: 'Ubuntu', sans-serif;">Phone Number</label></td>
                    <td><span class="font" style="font-family: 'Ubuntu', sans-serif;">: <?php echo $userInfo['phone'] ?> </span></td>
                </tr>
                <tr>
                    <td><label class="label" style="font-family: 'Ubuntu', sans-serif;">Description</label></td>
                    <td><span class="font" style="font-family: 'Ubuntu', sans-serif;">: <?php echo $userInfo['description'] ?> </span> </td>
                </tr>
                <?php if( !isset($_GET['profile'])){ ?>
                <tr>
                    <td><label class="label" style="font-family: 'Ubuntu', sans-serif;">Distance</label></td>
                    <td><span class="font" style="font-family: 'Ubuntu', sans-serif;">: <?php echo $distance ?> </span> </td>
                </tr>
                <tr>
                    <td><label class="label" style="font-family: 'Ubuntu', sans-serif;">Req. Time</label></td>
                    <td><span class="font" style="font-family: 'Ubuntu', sans-serif;">: <?php echo $duration ?> </span> </td>
                </tr>
                <?php } ?>
                <?php if(isset($_SESSION['user_id']) && !isset($_GET['profile']) && $_SESSION['user_id']!=$_GET['id']){ ?>
                <tr>
                    <td></td>
                    <td><br/><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&msg&id=<?php echo $_GET['id']?>"><img src="viewer/images/msg.png" width="50" /></a> </td>
                </tr>
                <?php } ?>
              </table>
              
              </div>
       </div>
                
<div class="adress-map">
    <label class="name" style="font-family: 'Ubuntu', sans-serif;">Location</label>
    <div class="nameHR" style="width: 350px;"></div> 
    <div id="profile_map" ></div>

</div>                    

<?php if(isset($_SESSION['user_id']) && !isset($_GET['aprofile'])){ ?>
<div class="edit">
  <!------------ Edit Button ------------>
  <input id="button-edit" type="button" value="" style="cursor: pointer; background-image: url('viewer/images/settings_32.png');" title="setting" onclick="window.location ='<?php echo $_SESSION['current_url']."&edit" ; ?>'"/>
  <!------------ End Edit Button ------------>
</div>
<?php } ?>  

</div>

<div class="right"></div>
</body>


</html>
<?Php include_once('viewer/temp/footer.php'); ?>
