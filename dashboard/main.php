<?php 
include_once("dashboard/header.php");
include_once("dashboard/menu.php");
?>
	
	<section id="main" class="column">
		
		<?php if($userInfo["reg_as"]==1){?>
		<article class="module width_full">
			<header><h3>Stats</h3></header>
			<div class="module_content" >
            <?php if(isset($error) && $error!=""){?>
            <h4 class="alert_error"> <?php echo $error; ?></h4> 
			<?php }?>	
				<article class="stats_overview" style="margin-right: 100px;">
                
					<div class="overview_today" >
                   
						<p class="overview_day" >Total</p>
						<p class="overview_count" ><?php echo $views ?></p>
						<p class="overview_type" >Views</p>
                    
					</div>
                
					
				</article>
                
                <article class="stats_overview" style="margin-right: 100px;">
					<div class="overview_today">
						<p class="overview_day">Item</p>
						<p class="overview_count"><?php echo $hits ?></p>
						<p class="overview_type">Max Views</p>
					</div>
				
				</article>
                
                <article class="stats_overview" style="margin-right: 100px;">
					<div class="overview_today">
						<p class="overview_day">Total</p>
						<p class="overview_count"><?php echo $num ?></p>
						<p class="overview_type">Items</p>
					</div>
				
				</article>
				<div class="clear"></div>
                
                
			</div>
		</article><!-- end of stats article -->
        <?php } ?>
		
		<?php 
        if(count($arrayOfMessages)!=0 ){ 
        foreach ($arrayOfMessages as $key => $value){
        ?>
		<article class="module width_quarter" style="display: block;">
		<header><h3>Messages</h3></header>
        <div class="message_list" id="user_<?php echo $key?>">		
        <?php for($i=0;$i<count($value);$i+=5){ ?>
		<?php if($_SESSION['user_id']==$value[$i+1]){ ?>	
            <div class="module_content" style="background-color: #dfdfdf;">
        <?php }else{ ?>
            <div class="module_content">
        <?php } ?>
					<div class="message"><p>
                    <?php 
                    $value[$i] = str_replace("-q-","?",$value[$i]);
                    $value[$i] = str_replace("-k-","(",$value[$i]);
                    $value[$i] = str_replace("-kk-",")",$value[$i]);
                    echo $value[$i]; 
                    ?></p>
					<p><strong><?php echo $this->getUserName($value[$i+1]); ?></strong> <font color="red" style="font-size: x-small;"><?php echo "(".$value[$i+3].")"; ?></font></p> </div>
			</div>
        <?php } ?>
       
        </div>
			<footer>
				<form class="post_message" name="form_<?php echo $key?>" id="form_<?php echo $key?>">
                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $key?>" /> 
					<input type="text" name="msg" id="msg" value="Message" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
					<input type="button" onclick="ajax_chat('form_<?php echo $key?>')" id="btn_post_messageee" name="btn_post_message" value=""/>
				</form>
			</footer>
		</article><!-- end of messages article -->
        <?php }} else if(isset($_GET['msg']) && isset($_GET['id'])){?>
        <article class="module width_quarter" style="display: block;">
		<header><h3>Messages</h3></header>
			<div class="message_list">
				
			</div>
			<footer>
				<form class="post_message" action="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&msg&id=<?php echo $_GET['id']?>" method="post">
                    <input type="hidden" name="user_id" value="<?php echo $_GET['id']?>" /> 
					<input type="text" name="msg" value="Message" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
					<input type="submit" class="btn_post_message" name="btn_post_message" value=""/>
				</form>
			</footer>
		</article><!-- end of messages article -->
        <?php }?>
        
        
        	
		
		
</body>

</html>