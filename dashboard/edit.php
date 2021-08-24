<?php 
include_once("header.php");
include_once("menu.php");
?>	
	<section id="main" class="column">
		
		
		<article class="module width_full">
			<header><h3>Edit Your Information</h3></header>
			<div class="module_content" >
			  	
               <form action="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&edit&info" method="post">
                 
                 <?php if(@ $status == 1){?>
                   <h4 class="alert_error"> <?php echo $error; ?></h4> 
                 <?php } else  if(@ $status == 0 && isset($_POST['submit_edit_info'])){?>
                   <h4 class="alert_success"> <?php echo $error; ?></h4> 
                 <?php } ?>
                 <fieldset>
                   <label>Name <font color="red">*</font></label>
                   <input type="text" name="name" value="<?php echo $userInfo['name'] ?>"/>
                 </fieldset>
                 
                 <fieldset>
                   <label>Email <font color="red">*</font></label>
                   <input type="text" name="email" value="<?php echo $userInfo['email'] ?>"/>
                 </fieldset>
                 
                 <fieldset>
                   <label>Password <font color="red">*</font></label>
                   <input type="password" name="password" id="pass" value="<?php echo $userInfo['password'] ?>"/>
                 </fieldset>
                 
                 <fieldset>
                   <label>Phone <font color="red">*</font></label>
                   <input type="text" name="phone" value="<?php echo $userInfo['phone'] ?>"/>
                 </fieldset>
                 
                 <fieldset>
                   <label>address </label>
                   <input type="text" name="address" value="<?php echo $userInfo['address'] ?>"/>
                 </fieldset>
                 
                 
                 <fieldset>
                   <label>Description</label>
                   <input type="text" name="description" value="<?php echo $userInfo['description'] ?>"/>
                   
                 </fieldset>
                 
                 <input type="submit" name="submit_edit_info" value="Submit Info"/>
                 
                 
               </form>  
                
			</div>
		</article><!-- end of stats article -->
		
	
		
</body>

</html>