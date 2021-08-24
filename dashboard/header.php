<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Dashboard- CPanel</title>
	
	<link rel="stylesheet" href="dashboard/css/layout.css" type="text/css" media="screen" />
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen" />
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="dashboard/js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="dashboard/js/hideshow.js" type="text/javascript"></script>
	<script src="dashboard/js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="dashboard/js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});

function ajax_chat(form_id){
        var msg = document.forms[form_id]["msg"].value;
        var id = document.forms[form_id]["user_id"].value;
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
                ajaxGetMsg(id);
            }
          }
        xmlhttp1.open("GET","index.php?ajaxSendMsg&id="+id+"&msg="+msg,true);
        xmlhttp1.send(); 

        
}
function ajaxGetMsg(id){
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
                document.getElementById("user_"+id).innerHTML = xmlhttp1.responseText;
            }
          }
        xmlhttp1.open("GET","index.php?ajaxGetMsg&id="+id,true);
        xmlhttp1.send(); 

        
}
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>

<?php
    
       if(isset($_GET['control'])){
    ?>
               <!--===============================================================================================-->
                	<link rel="stylesheet" type="text/css" href="dashboard/vendor/bootstrap/css/bootstrap.min.css">
                <!--===============================================================================================-->
                	<link rel="stylesheet" type="text/css" href="dashboard/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
                <!--===============================================================================================-->
                	<link rel="stylesheet" type="text/css" href="dashboard/vendor/animate/animate.css">
                <!--===============================================================================================-->
                	<link rel="stylesheet" type="text/css" href="dashboard/vendor/select2/select2.min.css">
                <!--===============================================================================================-->
                	<link rel="stylesheet" type="text/css" href="dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css">
                <!--===============================================================================================-->
                	<link rel="stylesheet" type="text/css" href="dashboard/css/util.css">
                	<link rel="stylesheet" type="text/css" href="dashboard/css/main.css">
                <!--===============================================================================================-->
 
          <script>
            function deleteItem(userId,itemId){
                var result = confirm("Are you sure you want to delete this item?");
                if (result) {
                    window.location =  "index.php?profile&userid="+userId+"&item&delete&item_id="+itemId;
                }
            }
          </script>
    <?php
       }
    ?>
</head>


<body>


	
	<section id="secondary_bar">
		<div class="user">
			<p><?php echo $name ?></p>
			<!-- <a class="logout_user" href="#" title="Logout">Logout</a> -->
		</div>
		<div class="breadcrumbs_container">
			<article class="breadcrumbs"> <a class="current">Control Panel</a></article>
		</div>
	</section><!-- end of secondary bar -->
