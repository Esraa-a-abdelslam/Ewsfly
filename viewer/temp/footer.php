
<script async defer
     src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfnMjockzJAjxFh1kHZklWoyjF7Itu9As&callback=initMap">
</script>

<!--------------------Footer--------------------!>
<div class="links-wrapper">
	<div class="links">
       	<div class="floatleft">
   			<ul class="site">
       			<li class="first"><a href="#" title="Return to the home page">Home</a>•</li>
           		<li><a href="#" title="Any Answer For Any Question">Services</a>•</li>
           		<li><a href="#" title="Get in touch">Contact</a>•</li>
           		<li><a href="#" title="Learn more">About</a>•</li>
           	</ul>
       		<p>© 2019 EWSFLY. All Rights Reserved.</p>
        </div><!--end floatleft-->
        <div class="floatright">
      		<ul class="social">
       			<li><a class="linkedin" href="#" title="#" target="_blank">Linkedin</a></li>
       	   		<li><a class="twitter" href="#" title="#" target="_blank">Twitter</a></li>
       	    	<li><a class="facebook" href="#" title="#" target="_blank">Facebook</a></li>
       	   	</ul>
        </div><!--end floatright-->
        <div class="clear"></div><!--end clear-->
  	</div><!--end links-->
</div>
<!--------------------End - footer--------------------!>

</body>



</html>


<!----- validation ----->
    <script type="text/javascript" src="viewer/js/valid.js"></script>
    
    
<script src="viewer/js/jquery.tipTip.js"></script>
<script src="viewer/js/jquery.tipTip.minified.js"></script>
<link  rel="stylesheet" href="viewer/css/tipTip.css"/>

<script type="text/javascript">
    $(document).ready(function(){
        $(".tip_left").tipTip({maxWidth: "auto",defaultPosition:"left", fadeIn:300, delay:0});
    });
    
    //validation
    $(document).ready(function(){
        $("#control-panel").validate();
    });
    
    //upload logo img 
    $(document).ready(function() { 
    $('#photoimg').live('change', function()			{ 
    $("#preview").html('<img src="viewer/images/loader.gif" alt="Uploading...."/>');
    $("#logo_uploads").ajaxForm({
    target: '#preview'
    }).submit();
    		
    });
    }); 
    
    


</script>



