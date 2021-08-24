<?php 
include_once("header.php");
include_once("menu.php");
?>	
	<section id="main" class="column">
		
		
		<article class="module width_full">
			<header><h3>Control Items </h3></header>
			<div class="module_content" >
			  	
               <form action="index.php?profile&userid=<?php echo $_SESSION['user_id']?>&item&new" method="post">
                 
                 <?php if(@ $status == 1){?>
                   <h4 class="alert_error"> <?php echo $error; ?></h4> 
                 <?php } else  if(@ $status == 0 && isset($_POST['submit_item_info'])){?>
                   <h4 class="alert_success"> <?php echo $error; ?></h4> 
                 <?php } ?>
                 
                 
	
	<div class="limiter">
		<div class="container-table100">
			<div class="wrap-table100">
				<div class="table100 ver1 m-b-110">
					<div class="table100-head">
						<table>
							<thead>
								<tr class="row100 head">
									<th class="cell100 column1">Name</th>
									<th class="cell100 column2">Tags</th>
									<th class="cell100 column3">Price</th>
									<th class="cell100 column4">Edit</th>
									<th class="cell100 column5">Delete</th>
								</tr>
							</thead>
						</table>
					</div>

					<div class="table100-body js-pscroll">
						<table>
							<tbody>
                            <?php 
                             if(count($arrayOfItems)!=0){
                             for($i=0;$i<count($arrayOfItems);$i+=4){   
                            ?>
								<tr class="row100 body">
									<td class="cell100 column1"><?php echo $arrayOfItems[$i+1]  ?></td>
									<td class="cell100 column2"><?php echo $arrayOfItems[$i+2]  ?></td>
									<td class="cell100 column3"><?php echo $arrayOfItems[$i+3]  ?></td>
									<td class="cell100 column4"><?php echo "<a href='index.php?profile&userid=".$_SESSION['user_id']."&item&edit&item_id=".$arrayOfItems[$i]."'><img src='dashboard/images/edit-icon.png' width='20'/></a>" ?></td>
									<td class="cell100 column5"><?php echo "<a href='javascript:deleteItem(".$_SESSION['user_id'].",".$arrayOfItems[$i].")'><img src='dashboard/images/delete-icon.png' width='40'/></a>" ?></td>
								</tr>
                                
                            <?php 
                              }}
                            ?>
  
								
							</tbody>
						</table>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>


<!--===============================================================================================-->	
	<script src="dashboard/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="dashboard/vendor/bootstrap/js/popper.js"></script>
	<script src="dashboard/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="dashboard/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="dashboard/vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script>
		$('.js-pscroll').each(function(){
			var ps = new PerfectScrollbar(this);

			$(window).on('resize', function(){
				ps.update();
			})
		});
			
		
	</script>
<!--===============================================================================================-->
	<script src="dashboard/js/main.js"></script>

                 
               </form>  
                
			</div>
		</article><!-- end of stats article -->
		
	
		
</body>

</html>