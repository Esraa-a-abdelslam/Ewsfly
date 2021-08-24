<?php if($userInfo['type']=="none"){?>
<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Control</h3>
		<ul class="toggle">
            <li class="icn_settings"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&edit">Home</a></li>
            <li class="icn_profile"><a href="index.php">Home MAP</a></li>
		</ul>
        
		<h3>Your Setting</h3>
		<ul class="toggle">
            <li class="icn_edit_article"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&edit&info">Edit Information</a></li>
	        <li class="icn_jump_back"><a href="index.php?logout">Logout</a></li>
		</ul>
		
		<footer>
		</footer>
	</aside><!-- end of sidebar -->
<?php }else {?>
<aside id="sidebar" class="column">
		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>
		<h3>Control</h3>
		<ul class="toggle">
            <li class="icn_settings"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&edit">Home</a></li>
			<li class="icn_new_article"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&location&edit">New Location</a></li>
			
    	</ul>
		
		<h3>Manage Items</h3>
		<ul class="toggle">
			<li class="icn_folder"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&item&new">New Item</a></li>
			<li class="icn_edit_article"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&item&control">Edit Item</a></li>
			
		</ul>
        
        <h3>View Profile</h3>
		<ul class="toggle">
			<li class="icn_profile"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>">Your Profile</a></li>
		</ul>
        
		<h3>Your Setting</h3>
		<ul class="toggle">
            <li class="icn_edit_article"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&edit&info">Edit Information</a></li>
	        <li class="icn_photo"><a href="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&edit&photo">Edit Photo</a></li>
			<li class="icn_jump_back"><a href="index.php?logout">Logout</a></li>
		</ul>
		
		<footer>
		</footer>
	</aside><!-- end of sidebar -->
<?php } ?>	