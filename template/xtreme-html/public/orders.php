<?php
include("includes/header.php");
?>
			<p>&nbsp;</p>
			<section class="main-content">				
				<div class="row"> 
					<div class="span12">					
						<h4 class="title"><span class="text"><strong>Your </strong>Orders</span></h4>
                        <?php
                        $i=1;
                        $customer=$_SESSION['customer_id'];
                        $selectOrders=mysqli_query($conn,"SELECT * FROM orders WHERE customer_id='$customer'");
                        if(mysqli_num_rows($selectOrders)>0)
                        {
                            while($fetchOrders=mysqli_fetch_assoc($selectOrders))
                            { $o_id=$fetchOrders['o_ID'];
                            echo '<a href="#demo'.$i.'" class="btn btn-primary" data-toggle="collapse"><i class="fas fa-plus"></i> Order '.$i.'</a>';
                                ?>
                                       <div id="demo<?php echo $i++;?>" class="collapse" >
                                    <table   class="table table-hover ">
                                    <thead>
                                      <tr>
                                        <th>Product</th>
                                         <th>Image</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Vendor</th>
                                      </tr>
                                    </thead>
                                        <tfoot>
                                           <tr>
                                            <th colspan='5'>Total : <?php echo $fetchOrders['Total'] ;?>
                                           <br>Order Number : <?php echo $fetchOrders['o_ID'] ;?>
                                           <br>Date : <?php echo $fetchOrders['o_Date'] ;?></th>
                                           </tr>
                                        </tfoot>
                                    
                                    <tbody>
                                        <?php
                                        $selectDetails = mysqli_query($conn,"SELECT order_details.*,
                                                                             product.p_id,product.price,
                                                                             product.p_name,product.p_image,
                                                                             vendor.*
                                                                             FROM order_details
                                                                             INNER JOIN product
                                                                             ON order_details.p_id = product.p_id
                                                                             INNER JOIN vendor
                                                                             ON product.v_id = vendor.v_ID
                                                                             WHERE o_id ='$o_id'");
                                        if(mysqli_num_rows($selectDetails)>0)
                                        {
                                            while($fetchDetails=mysqli_fetch_assoc($selectDetails))
                                            { $qty=$fetchDetails['qty'];
                                              $price=$fetchDetails['price'];
                                              $t=$qty*$price;
                                                echo "<tr>";
                                                echo "<td>{$fetchDetails['p_name']}</td>";
                                                echo "<td><img width='100' height='100' src='../vendor/images/products/{$fetchDetails['p_image']}'></td>";
                                                echo "<td>{$fetchDetails['qty']}</td>";
                                                echo "<td>{$t}</td>";
                                                echo "<td>{$fetchDetails['v_Name']}</td>";
                                                echo "</tr>";
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                    </div>
                                   <br><hr><br>
                                <?php
                            }
                        }
                        
                        ?>
   
				</div>
                    <p class="buttons center">				
							<a href="index.php" class="btn btn-info" >Shopping <i class="fas fa-cart-plus"></i></a>
						</p>
			</section>			
	<?php 
			
			include("includes/footer.php"); ?>