<?php
session_start();
error_reporting(0);
include_once("controller/controller.php");
$obj = new MainController();

$FURL = explode("/",$_SERVER['REQUEST_URI']);
$_SESSION['current_url'] = $FURL[2];
//***************************Home-Page*******************************
//-----------------Ajax Get Position----------------------
if(isset($_GET['getPosition'])){
    $_SESSION['lat'] = $_GET['lat'];  
    $_SESSION['lng'] = $_GET['lng'];   
}
//-----------------Get Searchable Suggestion----------------------
else if(isset($_GET['ajaxGetSuggestion'])){
    $obj->getSuggestion($_GET['value']); 
}
else if(isset($_GET['query'])){
    
    $arrayOfUserIds = $obj->selectUserIdsFromSearchQuery($_GET['query']);
    $obj->updateItemView($arrayOfUserIds,$_GET['query']);
    $arrayOfSpecifiedMarkers = $obj->getSearchableSpecifiedMarkers($arrayOfUserIds,$_SESSION['lat'],$_SESSION['lng']);
    $specifiedMarkers =  $obj->assignSpecifiedSearchableMarker($arrayOfSpecifiedMarkers);
    if(isset($_GET['nearest'])){
        for($i=0;$i<count($arrayOfSpecifiedMarkers);$i+=6){        
           $arrayOfDistance[] =  $obj->getNearest($_SESSION['lat'],$_SESSION['lng'],$arrayOfSpecifiedMarkers[$i+2],$arrayOfSpecifiedMarkers[$i+3]);
           $arrayOfLocations[] = $arrayOfSpecifiedMarkers[$i+2].";".$arrayOfSpecifiedMarkers[$i+3];
        }        
        $key =  array_search(min($arrayOfDistance),$arrayOfDistance);
        list($lat,$lng) = explode(";", $arrayOfLocations[$key]);
        $id = $obj->getIdByLocationInfo($lat,$lng);
        header("location:index.php?aprofile&id=$id");
    }
    if(isset($_GET['cheapest'])){
        $id = $obj->getCheapest($arrayOfUserIds,$_GET['query']);
        header("location:index.php?aprofile&id=$id");
    }
    else if (isset($_POST['reg-btn'])){
    $return =$obj->register($_POST['email'],$_POST['pass'],$_POST['reg_as'], $_POST['type'], $_POST['name'], $_POST['phone-num']);
        if($return=='exist'){
            if(strstr($_SESSION['current_url'],"?")==false)
            header("location:index.php?info=Already registered or have Spaces");
            else
            header("location:{$_SESSION['current_url']}&info=Already registered or have Spaces");  
        }
        else{
            $_SESSION['user_id']=$return['id'];
            header('location:index.php?id='.$_SESSION['user_id']);
        }
    } 
    $obj->getHomePage($specifiedMarkers,$markers);
}
//-----------------sending and Receving  Messages----------------------
else if(isset($_GET['ajaxSendMsg'])){
    $error = $obj->sendMessage($_SESSION['user_id'],$_GET['msg'],$_GET['id']); 
}
else if(isset($_GET['ajaxGetMsg'])){
    $obj->ajaxGetMsg($_SESSION['user_id'],$_GET['id']); 
}
//-----------------Getting Filter----------------------
elseif(isset($_GET['filter'])){
    $arrayOfMarkers = $obj->getMarker($_GET['filter'],$_SESSION['lat'],$_SESSION['lng']); 
    $arrayOfSpecifiedMarkers = $obj->getSpecifiedMarker($_GET['filter'],$_SESSION['lat'],$_SESSION['lng']);
    $markers =  $obj->assignMarker($_GET['filter'],$arrayOfMarkers);
    $specifiedMarkers =  $obj->assignSpecifiedMarker($_GET['filter'],$arrayOfSpecifiedMarkers);
       
    if(isset($_GET['nearest'])){
        for($i=0;$i<count($arrayOfSpecifiedMarkers);$i+=6){        
           $arrayOfDistance[] =  $obj->getNearest($_SESSION['lat'],$_SESSION['lng'],$arrayOfSpecifiedMarkers[$i+2],$arrayOfSpecifiedMarkers[$i+3]);
           $arrayOfLocations[] = $arrayOfSpecifiedMarkers[$i+2].";".$arrayOfSpecifiedMarkers[$i+3];
        }        
        $key =  array_search(min($arrayOfDistance),$arrayOfDistance);
        list($lat,$lng) = explode(";", $arrayOfLocations[$key]);
        $id = $obj->getIdByLocationInfo($lat,$lng);
        header("location:index.php?aprofile&id=$id");
    }
    else if (isset($_POST['reg-btn'])){
    $return =$obj->register($_POST['email'],$_POST['pass'],$_POST['reg_as'], $_POST['type'], $_POST['name'], $_POST['phone-num']);
        if($return=='exist'){
            if(strstr($_SESSION['current_url'],"?")==false)
            header("location:index.php?info=Already registered or have Spaces");
            else
            header("location:{$_SESSION['current_url']}&info=Already registered or have Spaces");  
        }
        else{
            $_SESSION['user_id']=$return['id'];
            header('location:index.php?id='.$_SESSION['user_id']);
        }
   }
   
   $obj->getHomePage($specifiedMarkers,$markers);
}

//-----------------Login-Button----------------------
elseif(isset($_POST['login-form'])){
    $return = $obj->login($_POST['email'],$_POST['password']);
    if($return !='error'){
         $_SESSION['user_id']=$return;       
        if(isset($_POST['remember'])){
            setCookie('user_cookie',$username,time()+3600);
        }
        header("location:index.php?id={$_SESSION['user_id']}");    
    }
    else
    header('location:index.php?info=faild');
}

//-----------------Rateing---------------------- 
else if(isset($_POST['star1'])){
        $obj->updateRate($_POST['star1'],$_POST['id']);
        header("location:{$_SESSION['current_url']}");
            
}

//-----------------profile-Button----------------------
else if(isset($_SESSION['user_id']) && isset($_GET['profile'])){
    $name = $obj->getUserName($_SESSION['user_id']);
    $userInfo = $obj->getUserInfo($_SESSION['user_id']);
    if($userInfo["reg_as"]==1){
        $views = $obj->getProfileViews($_SESSION['user_id']);
        $hits = $obj->getMaxHitsOfItem($_SESSION['user_id']);
        $num = $obj->getNumberOfItems($_SESSION['user_id']);
    }
    
    list($address,$distance,$duration) = $obj->getWebServiceLocationInfo($_SESSION['lat'],$_SESSION['lng'],$userInfo['new_lat'],$userInfo['new_lng']);
    
    //edit location
    if(isset($_GET['location'])){
        if(isset($_POST['submit_location_update'])){
          list($status,$error) = $obj->updateLocation($_SESSION['user_id'],$_POST['lat'],$_POST['lng']); 
          echo '<script>setTimeout("window.location= \"index.php?profile&userid='.$_SESSION['user_id'].'&location&edit\"",1000)</script>';
        }
        $obj->getNewLocationPage($_SESSION['user_id'],$name,$userInfo,$status,$error);
    }
    //dashboard
    elseif(isset($_GET['edit']) && ! isset($_GET['info']) && !isset($_GET['photo']) && !isset($_GET['item']) ){
        $arrayOfMessages= $obj->getMessages($_SESSION['user_id']);
        $error="";
        if($userInfo["reg_as"]==1)
        $obj->getDashboardPage($_SESSION['user_id'],$name,$userInfo,$error,$arrayOfMessages,$views,$hits,$num);
        else
        $obj->getDashboardPage($_SESSION['user_id'],$name,$userInfo,$error,$arrayOfMessages,0,0,0);
        
    }
    // edit info
    elseif(isset($_GET['edit']) && isset($_GET['info'])){
        if(isset($_POST['submit_edit_info'])){
           list($status,$error) = $obj->editUserInfo($_SESSION['user_id'],$_POST['name'],$_POST['email'],$_POST['password'],$_POST['phone'],$_POST['address'],$_POST['description']); 
           echo '<script>setTimeout("window.location= \"index.php?profile&userid='.$_SESSION['user_id'].'&edit&info\"",1000)</script>';
        }
        $obj->getEditInfoPage($_SESSION['user_id'],$name,$userInfo,$status,$error);
    }
    //edit photo
    elseif(isset($_GET['edit']) && isset($_GET['photo'])){
        if(isset($_POST['submit_upload'])){
           $target_file = "upload/" . basename($_FILES["image"]["name"]);
           move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
           $obj->editUserPhoto($_SESSION['user_id'],basename($_FILES["image"]["name"]),$_POST['image_db']); 
           header("location:index.php?profile&userid={$_SESSION['user_id']}&edit&photo");
        }
        $obj->getUploadPhotoPage($_SESSION['user_id'],$name,$userInfo);
    }
    //new item
    elseif(isset($_GET['item']) && isset($_GET['new'])){
        if(isset($_POST['submit_item_info'])){
           list($status,$error) = $obj->setNewItemInfo($_SESSION['user_id'],$_POST['item_name'],$_POST['item_price'],$_POST['tag'],$_POST['description']); 
           echo '<script>setTimeout("window.location= \"index.php?profile&userid='.$_SESSION['user_id'].'&item&new\"",1000)</script>';
        }
        $obj->getNewItemPage($_SESSION['user_id'],$name,$userInfo,$status,$error);
    }
    //control Item
    elseif(isset($_GET['item']) && isset($_GET['control'])){
        $arrayOfItems = $obj->getItemsInfo($_SESSION['user_id']);
        $obj->getControlItemPage($_SESSION['user_id'],$name,$userInfo,$arrayOfItems);
    }
    //edit Item
    elseif(isset($_GET['item']) && isset($_GET['edit'])){
        $itemInfo = $obj->getItemInfoById($_SESSION['user_id'],$_GET['item_id']);
        if(isset($_POST['submit_item_info'])){
           list($status,$error) = $obj->updateItemInfo($_SESSION['user_id'],$_GET['item_id'],$_POST['item_name'],$_POST['item_price'],$_POST['tag'],$_POST['description']); 
           echo '<script>setTimeout("window.location= \"index.php?profile&userid='.$_SESSION['user_id'].'&item&edit&item_id='.$_GET['item_id'].'\"",500)</script>';
        }
        $obj->getEditItemPage($_SESSION['user_id'],$name,$userInfo,$itemInfo,$status,$error);
    }
    //delete Item
    elseif(isset($_GET['item']) && isset($_GET['delete'])){
        $obj->deleteItemInfoById($_SESSION['user_id'],$_GET['item_id']);
        header("location:index.php?profile&userid={$_SESSION['user_id']}&item&control");
    }
    
    //messages
    elseif(isset($_GET['msg']) && isset($_GET['id'])){
        if(isset($_POST['btn_post_message'])){
           $error = $obj->sendMessage($_SESSION['user_id'],$_POST['msg'],$_POST['user_id']); 
           if($error=="message sent successfuly")
           header("location:index.php?profile&userid={$_SESSION['user_id']}&edit");
        }
        $arrayOfMessages= $obj->getMessages($_SESSION['user_id']);
        if($userInfo["reg_as"]==1)
        $obj->getDashboardPage($_SESSION['user_id'],$name,$userInfo,$error,$arrayOfMessages,$views,$hits,$num);
        else
        $obj->getDashboardPage($_SESSION['user_id'],$name,$userInfo,$error,$arrayOfMessages,0,0,0);
    }
    
    else{
        
        $obj->getProfilePage($_SESSION['user_id'],$userInfo,$address,$distance,$duration);
    }
}

//-----------------View profile Page for another user----------------------

else if (isset($_GET['aprofile']) && isset($_GET['id'])){
    $userInfo = $obj->getUserInfo($_GET['id']);
    $obj->increaseView($_GET['id']);
    list($address,$distance,$duration) = $obj->getWebServiceLocationInfo($_SESSION['lat'],$_SESSION['lng'],$userInfo['new_lat'],$userInfo['new_lng']);
    
    $obj->getProfilePage($_GET['id'],$userInfo,$address,$distance,$duration);
}

//-----------------LogOut-Button----------------------
else if(isset($_GET['logout'])){
    $obj->logOut();
}

//-----------------Register-Button----------------------
else if (isset($_POST['reg-btn'])){
    $return =$obj->register($_POST['email'],$_POST['pass'],$_POST['reg_as'], $_POST['type'], $_POST['name'], $_POST['phone-num']);
    if($return=='exist'){
    header("location:index.php?info=Already registered or have Spaces"); 
    }
    else{
        $_SESSION['user_id']=$return;
        header('location:index.php?id='.$_SESSION['user_id']);
    }
}
                       

//-----------------View Home Page----------------------
else {
    $obj->getHomePage(0);
}

?>














