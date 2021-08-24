<?php 
include_once("header.php");
include_once("menu.php");
?>	
	<section id="main" class="column">
		
		
		<article class="module width_full">
			<header><h3>Edit Item Information</h3></header>
			<div class="module_content" >
			  	
               <form action="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&item&edit&item_id=<?php echo $_GET['item_id']?>" method="post">
                 
                 <?php if(@ $status == 1){?>
                   <h4 class="alert_error"> <?php echo $error; ?></h4> 
                 <?php } else  if(@ $status == 0 && isset($_POST['submit_item_info'])){?>
                   <h4 class="alert_success"> <?php echo $error; ?></h4> 
                 <?php } ?>
                 <fieldset>
                   <label>Name <font color="red">*</font></label>
                   <input type="text" name="item_name" value="<?php echo $itemInfo['name'] ?>" />
                 </fieldset>
                 
                 <fieldset>
                   <label>Price <font color="red">*</font></label>
                   <input type="text" name="item_price" value="<?php echo $itemInfo['price'] ?>" />
                 </fieldset>
                 
                 
                 <fieldset>
                   <label>Tag<font color="red">*</font> <font color="green" style=" margin-left: 20px; font-size: smaller; font-variant: normal; font-style: italic; font-weight: normal;">tag1;tag2</font></label> 
                   <input type="text" name="tag" value="<?php echo $itemInfo['tag'] ?>" />
                 </fieldset>
                 
                 <fieldset>
                   <label>description </label>
                   <input type="text" name="description" value="<?php echo $itemInfo['description'] ?>" />
                 </fieldset>
                 
      
                 <input type="submit" name="submit_item_info" value="Update Info"/>
                 
                 
               </form>  
                
			</div>
		</article><!-- end of stats article -->
		
	
		
</body>

</html>