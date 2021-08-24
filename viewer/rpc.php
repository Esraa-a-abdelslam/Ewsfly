<p id="searchresults">
<?php
	// PHP5 Implementation - uses MySQLi.
	// mysqli('localhost', 'yourUsername', 'yourPassword', 'yourDatabase');
	$db = new mysqli('localhost', 'root', '', 'ewsfly_ewsflyDB');
	
	if(!$db) {
		// Show error if we cannot connect.
		echo 'ERROR: Could not connect to the database.';
	} else {
		// Is there a posted query string?
		if(isset($_POST['queryString'])) {
			$queryString = $db->real_escape_string($_POST['queryString']);
			
			// Is the string length greater than 0?
			if(strlen($queryString) >0) {
				$query = $db->query("SELECT * FROM control_panel WHERE c_name LIKE '%" . $queryString . "%'ORDER BY type");
				
				if($query) {
					// While there are results loop through them - fetching an Object.
					
					// Store the category id
					$catid = '';
					while ($result = $query ->fetch_object()) {
						if($result->type != $catid) { // check if the category changed
							echo '<span class="category">'.$result->type.'</span>';
							$catid = $result->type;
						}
	         			echo '<a href="index.php?userid='.$result->id.'">';
	         			echo '<img src="viewer/images/logos/'.$result->c_logo.'" alt="" />';
	         			
	         			$name = $result->c_name;
	         			if(strlen($name) > 35) { 
	         				$name = substr($name, 0, 35) . "...";
	         			}	         			
	         			echo '<span class="searchheading">'.$name.'</span>';
	         			
	         			$description = $result->desc_;
	         			if(strlen($description) > 80) { 
	         				$description = substr($description, 0, 80) . "...";
	         			}
	         			
	         			echo '<span>'.$description.'</span></a>';
	         		}
	         		echo '<span class="seperator"><a href="http://www.marcofolio.net/sitemap.html" title="Sitemap">Nothing interesting here? Try the sitemap.</a></span><br class="break" />';
				} else {
					echo 'ERROR: There was a problem with the query.';
				}
			} else {
				// Dont do anything.
			} // There is a queryString.
		} else {
			echo 'There should be no direct access to this script!';
		}
	}
?>
</p>