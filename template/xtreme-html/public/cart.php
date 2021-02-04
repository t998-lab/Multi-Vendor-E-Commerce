<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'dash';
include("includes/header.php");
if($action=='dash'){
	if(isset($_POST['change']))
	{  
	   $ch=$_POST['change'];
	   $value=$_POST['newqty'.$ch];
	   if (is_numeric($value)) {
		$_SESSION['item'][$ch]=$value;
	    header('location:cart.php');
	   }
	   
	}
	if(isset($_POST['remove']))
	{
		$ch=$_POST['remove'];
	   unset($_SESSION['item'][$ch]);
	   header('location:cart.php');
	}
?>
			<p>&nbsp;</p>
			<section class="main-content">				
				<div class="row">
					<div class="span12">					
						<h4 class="title"><span class="text"><strong>Your</strong> Cart</span></h4>
						<table class="table table-hover">
						<thead>
						  <tr>
							<th>Remove</th>
							<th>Image</th>
							<th>Ordered Quantity</th>
							<th>In Store</th>
							<th>Total</th>
						  </tr>
						</thead>
						<tbody>
						<form method="post">
							    <?php
								$total=0;
								if(isset($_SESSION['item'])){
								foreach($_SESSION['item'] as $k=>$v)
								{
								$querySelect=mysqli_query($conn,"SELECT * FROM product WHERE p_id='$k'");
								$fetch=mysqli_fetch_assoc($querySelect);
								?>
								<tr>
								  <td>
									<button type="submit" name="remove" class="btn btn-danger" value="<?php echo $k;?>">
										<i class="fas fa-trash-alt"></i>
									</button>
								  </td>
								  <td><img width="100px" src="../vendor/images/products/<?php echo $fetch['p_image'];?>"</td>
								  <td><input type="text" class="span1" name="<?php echo"newqty".$k;?>" value="<?php echo $v ;?>">
								  <br><button type="submit" name="change" class="btn btn-info" value="<?php echo $k;?>"><i class="fas fa-edit"></i></button>
								  </td>
								  <td>
									<?php echo $fetch['qty']; ?>
								  </td>
								  <td>
									<?php echo $price= $fetch['price']*$v; ?>
								  </td>
								</tr>
						  <?php
						  $total+=$price;
						  }} ?>
						</form>
						</tbody>
					</table>
						<hr>
						<h5 class="">Total : <?php echo $total; ?> </h5>
						<p class="buttons center">				
							<a href="cart.php?action=ifSession&total=<?php echo $total;?>" class="btn btn-inverse" id="checkout">Checkout <i class="fas fa-shopping-basket"></i></a>
							<a href="index.php" class="btn btn-info" >Shopping <i class="fas fa-cart-plus"></i></a>
						</p>
					</div>
				</div>
			</section>			
			<?php }
			if($action=='ifSession')
			{
				if(!isset($_SESSION['customer_id']))
				{
					header('location:../vendor/includes/login/login.php');
				}
				else
				{   
					$total=$_GET['total'];
					$customer=$_SESSION['customer_id'];
					date_default_timezone_set("Asia/Amman");
					$date=date("Y/m/d");
					if(isset($_SESSION['item'])){
					$add_order=mysqli_query($conn,"INSERT INTO orders(o_Date,total,customer_id)
											       VALUES('$date','$total','$customer')");
					$selectLast=mysqli_query($conn,"SELECT o_ID FROM orders ORDER BY o_ID DESC LIMIT 1");
					$fetchLast=mysqli_fetch_assoc($selectLast);
					$last=$fetchLast['o_ID'];
					$er="";
					foreach($_SESSION['item'] as $k=>$v)
					{
						$query=mysqli_query($conn,"SELECT * FROM product WHERE p_id = '$k'");
						$fetchq=mysqli_fetch_assoc($query);
						if($fetchq['qty']<=0 || $v>$fetchq['qty'])
						{
							$p_name=$fetchq['p_name'];
							$er.="the product $p_name ";
							$er.=" <img  width='100' src='../vendor/images/products/{$fetchq['p_image']}'> ";
                            $er.="you orderd is not available or the required quantity is not available <br><br>";
						}
					}
					
					if($er=="")
					{
						foreach($_SESSION['item'] as $k=>$v)
					    {
							$add_detail=mysqli_query($conn,"INSERT INTO order_details(o_id,p_id,qty)
											       VALUES('$last','$k','$v')");
							
						    $decreaseProduct=mysqli_query($conn,"UPDATE product SET
													         qty=qty-'$v',
															 sales=sales+'$v',
															 Earning=Earning+(price*'$v')
															 WHERE p_id = '$k'");
							
						}
						echo "<br><div class='alert alert-success'>Thank you , your order has been successfully registered</div>";
					    unset($_SESSION['item']);
					}
					else{
						echo "<br><div class='alert alert-warning'>$er</div>";
						$delete=mysqli_query($conn,"DELETE FROM orders WHERE o_ID = '$last'");
                        
					}
					}}
					
					//unset($_SESSION['item']);
					echo "<br><div class='center'><a href='orders.php' class='btn btn-info'> Orders </a></div>";
					//header('location:cart.php');
				}
			?>
	
		<?php 	
			include("includes/footer.php"); ?>
		