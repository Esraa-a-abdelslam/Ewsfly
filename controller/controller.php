<?php
include_once("model/model.php");
class MainController{   

//*******************************
//Start-Home-Page
//*******************************
  
  //-----------------Getting Filter----------------------  
  public function getHomePage($specifiedMarkers,$markers){
        $setMarker=0;
        $setSpecifiedMarker=0;
        if($markers!=null){
            $setMarker = 1;
            
        }
        if($specifiedMarkers!=null){
            $setSpecifiedMarker=1;
        }
        if(isset($_SESSION['user_id'])){
            $username = $this->getUserName($_SESSION['user_id']);
        }
        include_once('viewer/main.php');
  } 
  
  //-----------------Getting Filter----------------------
  public function getMarker($filter,$locationLat,$locationLng){
    $string = file_get_contents("https://maps.googleapis.com/maps/api/place/textsearch/json?query=$filter&location=$locationLat,$locationLng&radius=10000&key=AIzaSyCfnMjockzJAjxFh1kHZklWoyjF7Itu9As");
    $json = json_decode($string, true);
    
    $array = array();
    for($i=0;$i<count($json['results']);$i++){
        $array[] = $json['results'][$i]["name"];//0
        $array[] = $json['results'][$i]["formatted_address"];//1
        $array[] = $json['results'][$i]["geometry"]["location"]["lat"];//2
        $array[] = $json['results'][$i]["geometry"]["location"]["lng"];//3
        $array[] = $json['results'][$i]["rating"];//4
    }
    return $array;
  }  
  
   public function getSearchableSpecifiedMarkers($arrayOfUserIds,$locationLat,$locationLng){
    $model = new MainModel(); 
    $array = $model->getSearchableSpecifiedMarkersModel($arrayOfUserIds);
    return $array;
  }
  
   public function getSpecifiedMarker($filter,$locationLat,$locationLng){
    $model = new MainModel(); 
    $array = $model->selectSpecifiedMarkersModel($filter);
    return $array;
  }
  
  public function assignMarker($filter,$arrayOfMarkers){
    $model = new MainModel(); 
    $txt = "";
    for($i=0;$i<count($arrayOfMarkers);$i+=5){
        
        $model->insertInitialWebServiceLocationsModel($filter,$arrayOfMarkers[$i],$arrayOfMarkers[$i+2],$arrayOfMarkers[$i+3],$arrayOfMarkers[$i+1],$arrayOfMarkers[$i+4]);
        $txt .="var marker$i = new google.maps.Marker({
                    position: {lat:".$arrayOfMarkers[$i+2].", lng: ".$arrayOfMarkers[$i+3]."},
                    map: map,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    title: '".$arrayOfMarkers[$i]."'
                 }); 
                 marker$i.addListener('click', toggleBouncemarker$i);
                 function toggleBouncemarker$i() {
                      if (marker$i.getAnimation() !== null) {
                        marker$i.setAnimation(null);
                      } else {
                        marker$i.setAnimation(google.maps.Animation.BOUNCE);
                      }
                 }
                 ";
    }
    return $txt;
  } 
  
  
  
  
  public function assignSpecifiedMarker($filter,$arrayOfMarkers){
    $model = new MainModel(); 
    $txt = "";
    for($i=0;$i<count($arrayOfMarkers);$i+=6){
        $txt .="
                var image = 'viewer/images/icon/$filter.png';
                var marker$i = new google.maps.Marker({
                    position: {lat:".$arrayOfMarkers[$i+2].", lng: ".$arrayOfMarkers[$i+3]."},
                    map: map,
                    icon: image,
                    draggable:false,
                    title: '".$arrayOfMarkers[$i]."'
                 }); 
                 marker$i.addListener('click', toggleBouncemarker$i);
                 google.maps.event.addListener(marker$i,'click',function() {
                    map.setZoom(20);
                    map.setCenter(marker$i.getPosition());
                    setTimeout('openLink(".$arrayOfMarkers[$i+5].")',5000);
                });
                
                 function toggleBouncemarker$i() {
                      if (marker$i.getAnimation() !== null) {
                        marker$i.setAnimation(null);
                      } else {
                        marker$i.setAnimation(google.maps.Animation.BOUNCE);
                      }
                 }
                 
                 
                 

                 ";
    }
    return $txt;
  } 
  
  
  public function assignSpecifiedSearchableMarker($arrayOfMarkers){
    $model = new MainModel(); 
    $txt = "";
    for($i=0;$i<count($arrayOfMarkers);$i+=6){
        $txt .="
                var image = 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'; 
                var marker$i = new google.maps.Marker({
                    position: {lat:".$arrayOfMarkers[$i+2].", lng: ".$arrayOfMarkers[$i+3]."},
                    map: map,
                    icon: image,
                    draggable:false,
                    title: '".$arrayOfMarkers[$i]."'
                 }); 
                 marker$i.addListener('click', toggleBouncemarker$i);
                 google.maps.event.addListener(marker$i,'click',function() {
                    map.setZoom(20);
                    map.setCenter(marker$i.getPosition());
                    setTimeout('openLink(".$arrayOfMarkers[$i+5].")',5000);
                });
                
                 function toggleBouncemarker$i() {
                      if (marker$i.getAnimation() !== null) {
                        marker$i.setAnimation(null);
                      } else {
                        marker$i.setAnimation(google.maps.Animation.BOUNCE);
                      }
                 }
                 
                 
                 

                 ";
    }
    return $txt;
  } 
  
  
  public function getNearest($Lat,$Lng,$nLat,$nLng){
    $string = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$Lat,$Lng&destinations=$nLat,$nLng&key=AIzaSyCfnMjockzJAjxFh1kHZklWoyjF7Itu9As");
    $json = json_decode($string, true);
    $distance = $json["rows"][0]["elements"][0]["distance"]["value"];
    
    return $distance;
  } 
  
  
  
  public function getCheapest($arrayOfUserIds,$query){
    $model = new MainModel();
    $id = $model->getCheapestModel($arrayOfUserIds,$query);
    return $id;
  }  
  
  public function getWebServiceLocationInfo($Lat,$Lng,$nLat,$nLng){
    $string = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$Lat,$Lng&destinations=$nLat,$nLng&key=AIzaSyCfnMjockzJAjxFh1kHZklWoyjF7Itu9As");
    $json = json_decode($string, true);
    $array[] = $json["destination_addresses"][0];
    $array[] = $json["rows"][0]["elements"][0]["distance"]["text"];
    $array[] = $json["rows"][0]["elements"][0]["duration"]["text"];
    
    return $array;
  }
  
  public function getIdByLocationInfo($Lat,$Lng){
    $model = new MainModel(); 
    $id = $model->getIdByLocationInfoModel($Lat,$Lng);
    return $id;
  }
  
  public function getSuggestion($value){
    $model = new MainModel();
    if($value!=null) 
    $model->getSuggestionModel($value);
  
  }
  
  public function selectUserIdsFromSearchQuery($value){
    $model = new MainModel();
    if($value!=null) 
    $array = $model->selectUserIdsFromSearchQueryModel($value);
    
    return $array;
  }
  
  public function updateItemView($arrayOfUserIds,$query){
    $model = new MainModel();
    $model->updateItemViewModel($arrayOfUserIds,$query);
  }
  
  //-----------------Get Login Info----------------------
  public function login($email,$password){      
        if($email=='' || $password==''){
            return 'error';
        }
        else{
            $model = new MainModel();
            return $model->selectInfoModel($email,$password);
        }
  }
  //-----------------Loge-Out----------------------
  public function logOut(){
    session_unset();
    session_destroy();
    header('location:index.php');
  }
  
  //-----------------Register-Insert----------------------
  public function register($email,$pass,$regAs,$type,$name,$phone){
    $model = new MainModel(); 
    $id = $model->insertUserIntoDB($email,$pass,$regAs,$type,$name,$phone);
    return  $id;
  }
//*******************************
//End-Home-Page
//*******************************

 
 
 



//*******************************
//Start-Profile-Page
//*******************************

public function getProfilePage($userId,$userInfo,$address,$distance,$duration){
    if(isset($_SESSION['user_id']))
    $username = $this->getUserName($_SESSION['user_id']);
    if($userInfo['type']=="none")
    header("location:index.php?profile&userid={$_SESSION['user_id']}&edit");
    include_once('viewer/profile.php');
}

public function getDashboardPage($userId,$name,$userInfo,$error,$arrayOfMessages,$views,$hits,$num){
    $model = new MainModel();
    include_once('dashboard/main.php');
}

public function getEditInfoPage($userId,$name,$userInfo,$status,$error){
    include_once('dashboard/edit.php');
}

public function getUploadPhotoPage($userId,$name,$userInfo){
    include_once('dashboard/uploading.php');
}

public function getNewItemPage($userId,$name,$userInfo,$status,$error){
    include_once('dashboard/add_item.php');
}

public function getControlItemPage ($userId,$name,$userInfo,$arrayOfItems){
    include_once('dashboard/item_control.php');
}

public function getEditItemPage ($userId,$name,$userInfo,$itemInfo,$status,$error){
    include_once('dashboard/edit_item.php');
}

public function getNewLocationPage($userId,$name,$userInfo,$status,$error){
        include_once('dashboard/location.php');
}
public function getUserName($userId){
    $model = new MainModel(); 
    $array = $model->getUserInfo($userId);
    return $array['name'];
}

public function getUserInfo($userId){
    $model = new MainModel(); 
    $array = $model->getUserInfo($userId);
    return $array;
}

public function editUserInfo($userId,$name,$email,$password,$phone,$address,$description){
    $model = new MainModel();
    $status =0; 
    $error ="";
    if($name=='' || $phone=='' || $email=='' || $password=='' ) {
        $error = "Error - Please Complete The Required Form";
        $status =1; 
    }
    else
    list($status,$error) = $model->editUserInfoModel($userId,$name,$email,$password,$phone,$address,$description);
    
    $array[] = $status;
    $array[] = $error;
    return $array;
}

public function editUserPhoto($userId,$newPhoto,$oldPhoto){
    $model = new MainModel();
    if($newPhoto!='' && $newPhoto!=$oldPhoto) {
       $model->editUserPhotoModel($userId,$newPhoto);
    }
}

public function updateLocation ($userId,$lat,$lng){
   $model = new MainModel();
   $status =0; 
   $error ="";
   
    if($lat==null || $lng==null) {
       $status =1; 
       $error = "Error, Please Choose Location First ";
    } 
    else{
    $model->updateLocationModel($userId,$lat,$lng);
    }
    
    $status =0; 
    $error = "Location Updated";
    
    
    $array[] = $status;
    $array[] = $error;
    return $array;
}

public function setNewItemInfo ($userId,$itemName,$itemPrice,$tags,$description){
    $model = new MainModel();
    $status =0; 
    $error ="";
    if($itemName=='' || $itemPrice=='' || $tags=='') {
        $error = "Error - Please Complete The Required Form";
        $status =1; 
    }
    else
    list($status,$error) = $model->setNewItemInfoModel($userId,$itemName,$itemPrice,$tags,$description);
    
    $array[] = $status;
    $array[] = $error;
    return $array;
}

public function getItemsInfo($userId){
    $model = new MainModel();
    $array = $model->getItemsInfoModel($userId);
    return $array;
}

public function getItemInfoById($userId,$itemId){
    $model = new MainModel();
    $array = $model->getItemInfoByIdModel($userId,$itemId);
    return $array;
}

public function updateItemInfo ($userId,$itemId,$itemName,$itemPrice,$tags,$description){
    $model = new MainModel();
    $status =0; 
    $error ="";
    if($itemName=='' || $itemPrice=='' || $tags=='') {
        $error = "Error - Please Complete The Required Form";
        $status =1; 
    }
    else
    list($status,$error) = $model->updateItemInfoModel($userId,$itemId,$itemName,$itemPrice,$tags,$description);
    
    $array[] = $status;
    $array[] = $error;
    return $array;
}

public function deleteItemInfoById($userId,$itemId){
    $model = new MainModel();
    $model->deleteItemInfoByIdModel($userId,$itemId);
}

public function sendMessage($senderId,$msg,$receiverId){
    $model = new MainModel();
    if($msg=='') {
        $error = "Error - Please write Message First";
    }
    else{
    $msg = str_replace("?","-q-",$msg);
    $msg = str_replace("(","-k-",$msg);
    $msg = str_replace(")","-kk-",$msg);
    $error = $model->sendMessageModel($senderId,$msg,$receiverId);
    }
    return $error;
}

public function getMessages($userId){
    $model = new MainModel();
    $array = $model->getMessagesModel($userId);
    return $array;
}


public function ajaxGetMsg($userId,$id){
    $model = new MainModel();
    $model->ajaxGetMsgModel($userId,$id);
}


public function increaseView($userId){   
    $model = new MainModel();
    $model->increaseViewModel($userId);
}


public function getProfileViews($userId){   
    $model = new MainModel();
    $view = $model->getProfileViewsModel($userId);
    return $view;
}


public function getMaxHitsOfItem($userId){   
    $model = new MainModel();
    $hits = $model->getMaxHitsOfItemModel($userId);
    return $hits;
}

public function getNumberOfItems($userId){   
    $model = new MainModel();
    $num = $model->getNumberOfItemsModel($userId);
    return $num;
}

//-----------------Rateing----------------------    
    public function updateRate($value,$id){
        $model = new MainModel();
        $ip = $this->getIPAddress();
        $mes = $model->updateRateModel($value,$id,$ip);
    }
    
private function getIPAddress(){
    $string = file_get_contents("https://api.ipify.org/?format=json");
    $json = json_decode($string, true);
    return $json['ip'];
  }
//*******************************
//End-Profile-Page
//*******************************
  

}

?>