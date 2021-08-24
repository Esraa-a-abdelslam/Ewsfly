<title>Ewsfly - Home</title>
<?php include_once('viewer/temp/header.php');?>

<!------------Show/Hide--------------------!>
<script type="text/javascript">
 
$(document).ready(function(){
 
        $(".register").hide();
        $(".search").hide();
        $(".reg").show();
 
    $('.reg').click(function(){
        $(".search").hide();
    $(".register").slideToggle();
    });
    
    $('.search-btn').click(function(){
        $(".register").hide();
    $(".search").slideToggle();
    });
 
 
});

 
</script>

<script type="text/javascript">
function registerAs(reg_as){
    if(reg_as=="comp"){
        document.getElementById("TypeTr").style.visibility = "visible";
    }
    else{
        document.getElementById("TypeTr").style.visibility = "hidden";
    }
}

function complete(text){
    document.forms['searchForm'].query.value = text;
}

function ajaxGetSugestion(value){
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
                if(xmlhttp1.responseText!=null){
                    document.getElementById("suggestions").style.display="block";
                    document.getElementById("suggestions").innerHTML = xmlhttp1.responseText;
                }
                
            }
          }
        xmlhttp1.open("GET","index.php?ajaxGetSuggestion&value="+value,true);
        xmlhttp1.send(); 

        
}
</script> 
<!------------End - Show/Hide--------------------!>
<body>
<div class="content">
   <!--------Left-Menu---------!>
    <div class="left-menu">
        <div onclick="showFilter('pharmacy')"class="tool hospital tip_left" title="Pharmacy"></div>
        <div onclick="showFilter('hospital')"class="tool hotel tip_left" title="Hospital"></div>
        <div onclick="showFilter('coffee')" class="tool cofe tip_left" title="Coffee"></div>
        <div onclick="showFilter('super Market')" class="tool shop tip_left" title="Super Market"></div>
        
     </div>
    <!--------End - Left-Menu---------!>
    
    <!--------Middle---------!>
    <div class="map">
    <?php if(@$_SESSION['user_id']==''){?>
        <div class="register">
                <form class="reg-form" id="reg-form" method="post" action="<?php  echo $_SESSION['current_url']?>">
                    <label><h3>Register :</h3></label>
                    <table class="reg-table">
                        <tr>
                        <td>Name</td><td><input autocomplete="off"  id="name" name="name" type="text" class="textbox required"/></td>
                        </tr>
                        
                        <tr>
                        <td>Email</td><td><input autocomplete="off" id="email" name="email" type="email" class="textbox required"/></td>
                        </tr>
                        <tr>
                        <td>Password</td><td><input autocomplete="off" id="pass" name="pass"  type="password" class="textbox required" minlength="6"/></td>
                        </tr>
                        <tr>
                        <td>Phone Number</td><td><input autocomplete="off" id="phone-num" name="phone-num" type="text" class="textbox required digits"/></td>
                        </tr>
                        <tr>
                        <td>Register as</td><td>
                        <select id="reg_as" name="reg_as" class="textbox required" onchange="registerAs(this.value)">
                            <option value="user">User</option>
                            <option value="comp">Company</option>
                        </select>
                        </td>
                        </tr>
                        <tr id="TypeTr" style="visibility: hidden;">
                        <td>Type</td><td>
                        <select id="type" name="type" class="textbox required">
                            <option>none</option>
                            <option value="pharmacy">Pharmacy</option>
                            <option value="hospital">Hospital</option>
                            <option value="clothes">Clothes Shop</option>
                            <option value="coffee">Coffee</option>
                            <option value="market">Super Market</option>
                        </select>
                        </td>
                        </tr>
                        <label style="color: red; font-size: 13px;"><?php echo @$_GET['error'];?></label>
                        
                        
                    </table>
                    <input type="submit" name="reg-btn" value="Register" class="reg-button"/>
                </form>
         </div>
         <?php }?>
         <div class="search">
                <form class="search-form" id="searchForm" name="searchForm">
                    <label style="font-family: arial; font-size: 15px; font-weight: 700;">Search :</label>
                    <input type="text" size="30" value="" id="query" name="query" autocomplete="off"  onkeypress="ajaxGetSugestion(this.value)" class="search-input" />
                    <div id="suggestions" style="display: none; margin-left: 63px; padding-left: 10px; width: 155px; height: auto; ">
                      
                    </div>
                </form>
         </div>
         
        <div id="map_canvas"></div> 
    </div>
    <!--------End - Middle---------!>
    
    <!--------End - Right-Menu---------!>
    <div class="right-menu">
    <?php if(@$_SESSION['user_id']==''){?>
        <a href="#" class="reg"><div class="r-tool" style="font-family: 'Ubuntu', sans-serif;">Register</div></a>
    <?php } ?>
        <a href="#" class="search-btn"><div class="r-tool" style="font-family: 'Ubuntu', sans-serif;">Search</div></a>
     
     <?php if(isset($_GET['query'])){?>
        <a href="index.php?query=<?php echo $_GET['query'] ?>&cheapest" ><div class="r-tool" style="font-family: 'Ubuntu', sans-serif;">cheapest</div></a>
     <?php } if(isset($_GET['filter'])){?>
        <a href="index.php?filter=<?php echo $_GET['filter'] ?>&nearest" ><div class="r-tool" style="font-family: 'Ubuntu', sans-serif;">Nearest</div></a>
     <?php } else if(isset($_GET['query'])){?>
        <a href="index.php?query=<?php echo $_GET['query'] ?>&nearest" ><div class="r-tool" style="font-family: 'Ubuntu', sans-serif;">Nearest</div></a>
     <?php } ?>
    </div>
    <!--------End - Right-Menu---------!>

</div>
<!--------------------End - Content--------------------!>
<?php include_once('viewer/temp/footer.php');?>