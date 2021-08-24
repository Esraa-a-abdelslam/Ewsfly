<?php
class MainModel{

//*******************************
//Start-Database Connection Funnction
//*******************************
    
//-----------------Connection----------------------   
 private function connection(){
    $con = mysql_connect("localhost","root","");
    mysql_select_db("ewsflydb", $con);
    return $con; 
}

//*******************************
//End-Database Connection Funnction
//*******************************


//*******************************
//Start-Home Page Model Functions
//*******************************

 //-----------------Login-Check-Info----------------------
 public function selectInfoModel($email,$password){
    $connection = $this->connection();
    $result = mysql_query("SELECT id FROM user_info WHERE email='$email' and password='$password'");
    $fetch=mysql_fetch_array($result);
    
    if($fetch == ""){
        mysql_close($connection);
        return 'error';    
    }
    else{
        mysql_close($connection);
        return $fetch["id"];
    }
 }
 
 //-----------------Register-Insert-Info----------------------
 public function insertUserIntoDB($email,$pass,$regAs,$type,$name,$phone){
    $connection = $this->connection();
    $result = mysql_query("SELECT * FROM user_info WHERE name='$name' or email = '$email' ",$connection) or die(mysql_error());
    $fetch=mysql_fetch_array($result);
    if($fetch['name'] != '')
    {
        mysql_close($connection);
        return 'exist';
    }else
    {
        if($regAs=="user") $regAs=0; else $regAs=1;
        $ip = $this->getIPAddress();
        mysql_query("INSERT INTO user_info (email, password, phone, ip, location, type, name, reg_as, date) VALUES ('$email','$pass',$phone,'$ip','{$_SESSION['lat']};{$_SESSION['lng']}','$type','$name',$regAs,'".date("Y-m-d")."')",$connection) or die(mysql_error());
        
        $result2 = mysql_query("SELECT id FROM user_info WHERE name='$name' and email = '$email'",$connection);
        $fetch=mysql_fetch_array($result2);
        
        if($regAs==1)
        mysql_query("INSERT INTO location_info (company_id,new_lat,new_lng) VALUES ({$fetch['id']},'{$_SESSION['lat']}','{$_SESSION['lng']}')",$connection) or die(mysql_error());
        
        mysql_close($connection);
        return $fetch['id'];
    }
    
 }
 
 public function selectSpecifiedMarkersModel($filter){
    $connection = $this->connection();
    $result = mysql_query("SELECT id,name,phone FROM user_info WHERE type='$filter'",$connection) or die(mysql_error());
    $array = array();
    
    while($fetch=mysql_fetch_array($result)){
        $result2 = mysql_query("SELECT new_lat,new_lng,address,rating FROM location_info WHERE company_id={$fetch['id']}",$connection) or die(mysql_error());
        $fetchh=mysql_fetch_array($result2);
        
        $array[] = $fetch["name"];//0
        $array[] = $fetchh["address"];//1
        $array[] = $fetchh["new_lat"];//2
        $array[] = $fetchh["new_lng"];//3
        $array[] = $fetchh["rating"];//4
        $array[] = $fetch["id"];//5
    }
     mysql_close($connection);
    return $array;
    
 }
 
 
 public function getSearchableSpecifiedMarkersModel($arrayOfUserIds){
    $connection = $this->connection();
    foreach($arrayOfUserIds as $userId){
        $result = mysql_query("SELECT new_lat,new_lng,address,rating FROM location_info WHERE company_id=$userId",$connection) or die(mysql_error());
        $fetchh=mysql_fetch_array($result);
        
        $result2 = mysql_query("SELECT name,id FROM user_info WHERE id=$userId",$connection) or die(mysql_error());
        $fetch=mysql_fetch_array($result2);
        
        $array[] = $fetch["name"];//0
        $array[] = $fetchh["address"];//1
        $array[] = $fetchh["new_lat"];//2
        $array[] = $fetchh["new_lng"];//3
        $array[] = $fetchh["rating"];//4
        $array[] = $fetch["id"];//5
    }
    mysql_close($connection);
    return $array;
    
 }
 
 public function selectUserIdsFromSearchQueryModel($value){
    $connection = $this->connection();
    $result = mysql_query("SELECT company_id FROM tags WHERE tag='$value'",$connection) or die(mysql_error());
        
    while($fetch=mysql_fetch_array($result)){
        $array[] = $fetch["company_id"];//0
    }
    mysql_close($connection);
    return $array;
 }
 
 public function getIdByLocationInfoModel($Lat,$Lng){
    $connection = $this->connection();
    $result = mysql_query("select company_id from location_info where new_lat='$Lat' and new_lng='$Lng' limit 1",$connection) or die(mysql_error());
    $fetch=mysql_fetch_array($result);
    mysql_close($connection);
    return $fetch['company_id'];
 }
 
 private function getIPAddress(){
    $string = file_get_contents("https://api.ipify.org/?format=json");
    $json = json_decode($string, true);
    return $json['ip'];
  }
  
  
  public function getCheapestModel($arrayOfUserIds,$query){
    $connection = $this->connection();
    foreach($arrayOfUserIds as $userId){
        $result = mysql_query("select item_id from tags where tag='$query' and company_id=$userId limit 1",$connection) or die(mysql_error());
        $fetch=mysql_fetch_array($result);
        
        $result2 = mysql_query("select price from items where id={$fetch['item_id']} ",$connection) or die(mysql_error());
        $fetch2=mysql_fetch_array($result2);
        
        $array[$userId] = $fetch2['price'];
    }
    mysql_close($connection);
    $id = array_search(min($array),$array); 
    return $id;
    
  }
  
  public function updateItemViewModel($arrayOfUserIds,$query){
      $connection = $this->connection();
      foreach($arrayOfUserIds as $userId){
        $result = mysql_query("select item_id from tags where tag='$query' and company_id=$userId limit 1",$connection) or die(mysql_error());
        $fetch=mysql_fetch_array($result);
        
        $result2 = mysql_query("select hits from items where id={$fetch['item_id']} ",$connection) or die(mysql_error());
        $fetch2=mysql_fetch_array($result2);
        
        $hits = $fetch2['hits']+1;
        mysql_query("update items set hits = $hits  where id={$fetch['item_id']} ",$connection) or die(mysql_error());
        
      }
      mysql_close($connection);
       
  }
//***************************
//End-Home-Page
//****************************



//*******************************
//Start-MAP Model Functions
//*******************************

public function insertInitialWebServiceLocationsModel($filter,$name,$lat,$lng,$address,$rate){
    $connection = $this->connection();
    $result = mysql_query("SELECT id FROM service WHERE name='$name'",$connection) or die(mysql_error());
    $fetch=mysql_fetch_array($result);
    if($fetch['id']==null){
        $query = "insert into service (name,lat,lng,address,rating,type) values('$name',$lat,$lng,'$address',$rate,'$filter')";
        mysql_query("SET name 'utf8'",$connection);
        mysql_query('SET CHARACTER SET utf8',$connection);
        mysql_query($query,$connection)or die(mysql_error());
        
    } 
    mysql_close($connection);
}

public function getSuggestionModel($value){
   $connection = $this->connection();
   $result = mysql_query("SELECT distinct(tag) FROM tags WHERE tag like '%$value%'",$connection) or die(mysql_error());
   while($fetch=mysql_fetch_array($result)){
    echo "<a href=\"javascript:complete('{$fetch['tag']}')\">{$fetch['tag']}</a> <br>";
   }  
}


//*******************************
//End-MAP Model Functions
//*******************************


//*******************************
//Start-Profile Model Functions
//*******************************

public function getUserInfo($userId){
    $connection = $this->connection();
    $result = mysql_query("SELECT * FROM user_info WHERE id=$userId",$connection) or die(mysql_error());
    $fetch=mysql_fetch_array($result);
    $array["name"] = $fetch['name']; 
    $array["email"] = $fetch['email'];
    $array["password"] = $fetch['password'];
    $array["phone"] = $fetch['phone'];
    $array["ip"] = $fetch['ip'];
    $array["type"] = $fetch['type'];
    $array["reg_as"] = $fetch['reg_as'];
    $array["rate"] = $fetch['rate'];
    $array["rate_num"] = $fetch['num_rate'];
    
    if($fetch['reg_as']==1){
        $result = mysql_query("SELECT * FROM location_info WHERE company_id=$userId",$connection) or die(mysql_error());
        $fetch=mysql_fetch_array($result);
        $array["new_lat"] = $fetch['new_lat'];
        $array["new_lng"] = $fetch['new_lng'];
        $array["photo"] = $fetch['photo'];
        $array["address"] = $fetch['address'];
        $array["description"] = $fetch['description'];
    }
    mysql_close($connection);
    return $array;
}

public function editUserInfoModel($userId,$name,$email,$password,$phone,$address,$description){
    $connection = $this->connection();
    mysql_query("update user_info set name='$name' , email='$email' , password='$password' , phone=$phone   WHERE id=$userId",$connection) or die(mysql_error());
    mysql_query("update location_info set address='$address' , description='$description'   WHERE company_id=$userId",$connection) or die(mysql_error());

    mysql_close($connection);
    $status = 0;
    $error = "Information Updated - Successfuly";
    
    $array[] = $status;
    $array[] = $error;
    return $array; 
}


public function editUserPhotoModel($userId,$newPhoto){
    $connection = $this->connection();
    mysql_query("update location_info set photo='$newPhoto' WHERE company_id=$userId",$connection) or die(mysql_error());
    mysql_close($connection);
}


public function setNewItemInfoModel($userId,$itemName,$itemPrice,$tags,$description){
    $connection = $this->connection();
    mysql_query("insert into items (name,description,price,company_id,tag,date) values('$itemName','$description',$itemPrice,$userId,'$tags','".date("Y-m-d")."')",$connection) or die(mysql_error());
    
    if($tags!=""){
        $result = mysql_query("select id from items where name='$itemName' and company_id=$userId and price=$itemPrice",$connection) or die(mysql_error());
        $fetch = mysql_fetch_array($result);
        $arr = explode(";",$tags);
        foreach($arr as $tag)
        mysql_query("insert into tags (company_id,item_id,tag)values($userId,{$fetch['id']},'$tag')",$connection) or die(mysql_error());
    }
    mysql_close($connection);
    $status = 0;
    $error = "Item Inserted - Successfuly";
    
    $array[] = $status;
    $array[] = $error;
    return $array; 
}

public function getItemsInfoModel($userId){
    
    $connection = $this->connection();
    $result = mysql_query("select * from items where company_id=$userId",$connection) or die(mysql_error());
    while($fetch = mysql_fetch_array($result)){
        $array[] = $fetch['id'];//0
        $array[] = $fetch['name'];
        $array[] = $fetch['price'];
        $array[] = $fetch['tag'];//3
    }
    mysql_close($connection);
    return $array;
}

public function getItemInfoByIdModel($userId,$itemId){
    
    $connection = $this->connection();
    $result = mysql_query("select * from items where company_id=$userId and id=$itemId limit 1",$connection) or die(mysql_error());
    $fetch = mysql_fetch_array($result);
    $array['id'] = $fetch['id'];//0
    $array['name'] = $fetch['name'];
    $array['price'] = $fetch['price'];
    $array['description'] = $fetch['description'];
    $array['tag'] = $fetch['tag'];//4
    mysql_close($connection);
    return $array;
}

public function updateItemInfoModel($userId,$itemId,$itemName,$itemPrice,$tags,$description){
    $connection = $this->connection();
    mysql_query("update items set name='$itemName', price=$itemPrice , tag='$tags' , description = '$description'  where company_id=$userId  and id=$itemId  ",$connection) or die(mysql_error());
    
    if($tags!=""){
        mysql_query("delete from tags where company_id=$userId  and item_id=$itemId",$connection) or die(mysql_error());
        $arr = explode(";",$tags);
        foreach($arr as $tag)
        mysql_query("insert into tags (company_id,item_id,tag)values($userId,$itemId,'$tag')",$connection) or die(mysql_error());
    }
    mysql_close($connection);
    $status = 0;
    $error = "Item Updated - Successfuly";
    
    $array[] = $status;
    $array[] = $error;
    return $array;
}

public function deleteItemInfoByIdModel($userId,$itemId){
   $connection = $this->connection();
   mysql_query("delete from items where company_id=$userId  and id=$itemId  ",$connection) or die(mysql_error());
   mysql_query("delete from tags where company_id=$userId  and item_id=$itemId  ",$connection) or die(mysql_error());
   
   mysql_close($connection);  
}

public function updateLocationModel($userId,$lat,$lng){
    $connection = $this->connection();
    mysql_query("update location_info set new_lat='$lat' , new_lng='$lng' where company_id='$userId' ",$connection) or die(mysql_error());
    mysql_close($connection);
}

public function sendMessageModel($senderId,$msg,$receiverId){
    
    $connection = $this->connection();
    mysql_query("insert into messages (sender_id,receiver_id,message,date,time) values ($senderId,$receiverId,'$msg','".date('Y-m-d')."','".date("h:i")."')",$connection) or die(mysql_error());
    mysql_close($connection);
    return "message sent successfuly";
}

public function getMessagesModel($userId){
    $connection = $this->connection();
    $result = mysql_query("select distinct(sender_id) from messages where receiver_id='$userId'  ",$connection) or die(mysql_error());
    while($fetch = mysql_fetch_array($result)){
        $result2 = mysql_query("select * from messages where (sender_id= {$fetch['sender_id']} and receiver_id=$userId) or (receiver_id= {$fetch['sender_id']} and sender_id=$userId)    order by id ASC  ",$connection) or die(mysql_error());
        while($fetch2 = mysql_fetch_array($result2)){
            $array[$fetch['sender_id']][] =  $fetch2['message']; //0
            $array[$fetch['sender_id']][] =  $fetch2['sender_id']; //1
            $array[$fetch['sender_id']][] =  $fetch2['receiver_id']; //2
            $array[$fetch['sender_id']][] =  $fetch2['date'];//3
            $array[$fetch['sender_id']][] =  $fetch2['time'];  //4
        }
        
       /* $result3 = mysql_query("select * from messages where (receiver_id= {$fetch['sender_id']} and sender_id=$userId)  order by id ASC  ",$connection) or die(mysql_error());
        while($fetch3 = mysql_fetch_array($result3)){
            $array[$fetch['sender_id']][] =  $fetch3['message']; //0
            $array[$fetch['sender_id']][] =  $fetch3['sender_id']; //1
            $array[$fetch['sender_id']][] =  $fetch3['receiver_id']; //2
            $array[$fetch['sender_id']][] =  $fetch3['date'];//3
            $array[$fetch['sender_id']][] =  $fetch3['time'];  //4
        }*/
    }
    mysql_close($connection);
    return $array;
}


public function ajaxGetMsgModel($userId,$id){
    $connection = $this->connection();
    
    $result2 = mysql_query("select * from messages where (sender_id= $id and receiver_id=$userId) or (receiver_id= $id and sender_id=$userId)    order by id ASC  ",$connection) or die(mysql_error());
    while($fetch2 = mysql_fetch_array($result2)){
            $info = $this->getUserInfo($fetch2['sender_id']);
            if($_SESSION['user_id']==$fetch2['sender_id']){ 	
            echo "<div class=\"module_content\" style=\"background-color: #dfdfdf;\">";
            }else{
            echo "<div class=\"module_content\">";
            }
            echo "<div class=\"message\"><p>";
                    $fetch2['message'] = str_replace("-q-","?",$fetch2['message']);
                    $fetch2['message'] = str_replace("-k-","(",$fetch2['message']);
                    $fetch2['message'] = str_replace("-kk-",")",$fetch2['message']);
                    echo $fetch2['message']; 
            echo "</p><p><strong>".$info['name']."</strong> <font color=\"red\" style=\"font-size: x-small;\">".$fetch2['date']."</font></p> </div></div>";
    }
    mysql_close($connection);   
}

public function increaseViewModel($userId){
    $connection = $this->connection();
    $result= mysql_query("select view from user_info where id=$userId",$connection) or die(mysql_error());
    $fetch = mysql_fetch_array($result);
    if($userId!=$_SESSION['user_id'] || !isset($_SESSION['user_id'])){
       $view = $fetch['view']+1; 
       mysql_query("update user_info set view=$view where id=$userId",$connection) or die(mysql_error());
    }
    mysql_close($connection);
}

public function getProfileViewsModel($userId){
    $connection = $this->connection();
    $result= mysql_query("select view from user_info where id=$userId",$connection) or die(mysql_error());
    $fetch = mysql_fetch_array($result);
    mysql_close($connection);
    
    return $fetch['view'];
    
}

public function getMaxHitsOfItemModel($userId){
    $connection = $this->connection();
    $result= mysql_query("select max(hits) as max from items where company_id=$userId limit 1",$connection) or die(mysql_error());
    $fetch = mysql_fetch_array($result);
    if($fetch['max']!=0 || $fetch['max']!=null){
        $result= mysql_query("select name from items where company_id=$userId and hits={$fetch['max']} limit 1",$connection) or die(mysql_error());
        $fetch = mysql_fetch_array($result);
        mysql_close($connection);
        return $fetch['name'];
    }else
    return 0;
    
    
}

public function getNumberOfItemsModel($userId){
    $connection = $this->connection();
    $result= mysql_query("select count(id) as count from items where company_id=$userId",$connection) or die(mysql_error());
    $fetch = mysql_fetch_array($result);
    mysql_close($connection);
    
    return $fetch['count'];
    
}

//-----------------Rateing----------------------    
 public function updateRateModel($value,$id,$ip){
        $connection = $this->connection();
        //Verify IP address in Voting_IP table
        $ip_sql = mysql_query("select ip_add from voting_ip where ip_add='$ip' AND user_id=$id",$connection)or die("error1");
        $count = mysql_num_rows($ip_sql);
        if($count==0){
        // Update Vote.

            $sql = "update user_info set num_rate = (num_rate+1) , rate =('$value'+rate) where id=$id";
            mysql_query($sql,$connection)or die("error2");
            // Insert IP address and Message Id in Voting_IP table.
            $sql_in = "insert into voting_ip (user_id,ip_add) values ('$id','$ip') ";
            mysql_query($sql_in,$connection) or die("error3");
        }
}
//*******************************
//End-Profile Model Functions
//*******************************


}


?>