<?php 
include_once("header.php");
include_once("menu.php");
?>	
	<section id="main" class="column">
		
		
		<article class="module width_full">
			<header><h3>Edit Your Photo</h3></header>
			<div class="module_content" >
			  	
               <form enctype="multipart/form-data" action="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&edit&photo" method="post">
                 
                 <center><img src="upload/<?php echo $userInfo['photo']; ?>" width="200px" /></center>
                 
                 <fieldset>
                   <label>Upload Photo <font color="red">*</font></label>
                   <input type="file" name="image" />
                   <input type="hidden" name="image_db" value=" <?php  echo $userInfo['photo']; ?>" />
                 </fieldset>
                 
                 <input type="submit" name="submit_upload" value="Upload"/>
                 
                 
               </form>  
                
			</div>
		</article><!-- end of stats article -->
		
	
		
</body>

</html>