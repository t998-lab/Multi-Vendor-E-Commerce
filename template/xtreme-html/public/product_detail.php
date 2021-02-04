<?php
include("includes/header.php");

	$id=base64_decode(strtr($_GET['i'], '-_,', '+/='));
	$product_id= strtr(base64_encode($id), '+/=', '-_,');
	$query=mysqli_query($conn,"SELECT product.* ,vendor.v_Name ,category.Cat_ID
						FROM product
						INNER JOIN vendor
						ON vendor.v_ID=product.v_id
						INNER JOIN category
						ON category.Cat_ID=product.c_id
						WHERE p_id='$id'");
	$fetch=mysqli_fetch_assoc($query);
	if(!isset($_GET['i'])||$_GET['i']==null)
	{
		header("location:index.php");
	}
	elseif(mysqli_num_rows($query)<1){
		header("location:index.php");
	}
	if(isset($_POST['cart']))
	{
		$qty=$_POST['qty'];
		if($qty==null)
		{
			$qty=1;
		}
		if (is_numeric($qty))
		{
				if(isset($_SESSION['item'][$id]))
				{
					$_SESSION['item'][$id]+=$qty;
				}
				else
				{
					$_SESSION['item'][$id]=$qty;
					?>
					<script>
						window.location.href='<?php echo "product_detail.php?i=".$product_id."";?>';
					</script>
					<?php
				}
		}
	
	}
	?>
			<section><br><br></section>
			<section class="main-content">				
				<div class="row">						
					<div class="span9">
						<div class="row">
							<div class="span4">
									<img  alt="" src='<?php echo "../vendor/images/products/{$fetch['p_image']}"?>'>											
							</div>
							<div class="span5">
								<address>
									<strong>Vendor:</strong> <span><?php echo $fetch['v_Name'] ;?></span><br>
									<strong>Availability:</strong> <span><?php echo $fetch['qty'];?></span><br>								
								</address>									
								<h4><strong>Price: $<?php echo $fetch['price'];?></strong></h4>
							</div>
							<div class="span5"><br>
								<form class="form-inline" method="post">
									<label>Qty:</label>
									<input name="qty" type="text" class="span1" placeholder="1">
									<button name="cart" class="btn btn-inverse" type="submit">Add to cart</button>
								</form>
							</div>							
						</div><br>
						<div class="row">
							<div class="span12">
								<ul class="nav nav-tabs" id="myTab">
									<li id="desc" class="active"><a href="#desc">Description</a></li>
								</ul>							 
								<div class="tab-content">
									<div class="tab-pane active" ><?php echo $fetch['p_desc']; ?>
								</div>							
							</div>
							</div>
							<div class="span12">	
								<br>
								<h4 class="title">
									<span class="pull-left"><span class="text"><strong>Related</strong> Products</span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
									</span>
								</h4>
								<div id="myCarousel-1" class="carousel slide">
									<div class="carousel-inner">
										<div class="active item">
											<ul class="thumbnails listing-products">
													<?php
													$cat=$fetch['c_id'];
													$relatedProducts=mysqli_query($conn,"SELECT product.*,category.Cat_ID , vendor.*
                                                                   FROM product
                                                                   INNER JOIN category
                                                                   ON category.Cat_ID = product.c_id
                                                                   INNER JOIN vendor
                                                                   ON vendor.v_ID = product.v_id
																   WHERE c_id='$cat' AND p_id<>'$id'
                                                                   ORDER BY RAND()
																   LIMIT 6
																   ");
												if(mysqli_num_rows($relatedProducts)>0)
												{
												 $i=0;
												 while($fetch_all= mysqli_fetch_assoc($relatedProducts))
												 { 
													$product_id= strtr(base64_encode($fetch_all['p_id']), '+/=', '-_,');
													?>
											 <li class="span4">
												<div class="product-box">
													<p> <?php
												  echo  "<a href='product_detail.php?i=".$product_id."'>";?>
													<img class="productimage" src="../vendor/images/products/<?php echo $fetch_all['p_image']?>" alt=""></a></p>
												   <?php
												  echo  "<a href='product_detail.php?i=".$product_id."' class=title'>{$fetch_all['p_name']}</a>"?><br>
													<a href="vendor.html" class="">BY : <?php echo $fetch_all['v_Name']?></a>
													<p class="price">$<?php echo $fetch_all['price']?></p>
												</div>
											 </li>
											  <?php $i++;if($i==3)break;}}
											   ?>		
											</ul>
										</div>
										<div class="item">
											<ul class="thumbnails listing-products">
												<?php
												if(mysqli_num_rows($relatedProducts)>0)
												{
												 $i=0;
												 while($fetch_all= mysqli_fetch_assoc($relatedProducts))
												 { 
													$product_id= strtr(base64_encode($fetch_all['p_id']), '+/=', '-_,');
													?>
													<li class="span4">
												<div class="product-box">
													<p> <?php
												  echo  "<a href='product_detail.php?i=".$product_id."'>";?>
													<img class="productimage" src="../vendor/images/products/<?php echo $fetch_all['p_image']?>" alt=""></a></p>
												   <?php
												  echo  "<a href='product_detail.php?i=".$product_id."' class=title'>{$fetch_all['p_name']}</a>"?><br>
													<a href="vendor.html" class="">BY : <?php echo $fetch_all['v_Name']?></a>
													<p class="price">$<?php echo $fetch_all['price']?></p>
												</div>
											   </li>
											  <?php $i++;if($i==3)break;}}
											   ?>		
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</section>			
			<?php include("includes/footer.php"); ?>