	<?php include("includes/header.php");
	$id=base64_decode(strtr($_GET['i'], '-_,', '+/='));
	$query=mysqli_query($conn,"SELECT * FROM category WHERE Cat_ID='$id'");
	$fetch=mysqli_fetch_assoc($query);
	if(!isset($_GET['i'])||$_GET['i']==null)
	{
		header("location:index.php");
	}
	elseif(mysqli_num_rows($query)<1){
		header("location:index.php");
	}
	?>
			<section class="header_text sub"><?php if(mysqli_num_rows($query)==1) {?>
			<img id="image" width="200px" src="../images/<?php echo $fetch['Cat_image']?>" alt="" >
			<br><br><br>
			<h4><span>all products  <span class="text-info"><?php echo $fetch['Cat_Name'];?></span></span></h4><?php }?>
			</section>
			<section class="main-content">
				<div class="row">						
					<div class="span12">								
						<ul class="thumbnails listing-products">
							<?php   $latestProducts=mysqli_query($conn,"SELECT product.* , category.Cat_Name
																 ,category.Cat_ID , vendor.*
                                                                   FROM product
                                                                   INNER JOIN category
                                                                   ON category.Cat_ID = product.c_id
                                                                   INNER JOIN vendor
                                                                   ON vendor.v_ID = product.v_id
                                                                   WHERE category.Cat_ID=$id");
											 while($fetch_all= mysqli_fetch_assoc($latestProducts))
                                             {$product_id= strtr(base64_encode($fetch_all['p_id']), '+/=', '-_,');
												?>
												<li class="span3">
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
											<?php }?>
						</ul>								
						<hr>
					</div>
				
				</div>
			</section>
			<?php include("includes/footer.php"); ?>