<?php include("includes/header.php");
?>
<style>
  
</style>
    <section class="main-content">
        <div class="row">
            <div class="span12">
                <div class="row">
                    <div class="span12">
                        <h4 class="title"><span class="pull-left"><span class="text">
                        <span class="line">Latest <strong>Products</strong></span></span></span>
                        <span class="pull-right"><a class="left button" href="#myCarousel" data-slide="prev">
                            
                        </a><a class="right button" href="#myCarousel" data-slide="next"></a></span></h4>

                        <div id="myCarousel" class="myCarousel carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails">
                                      <?php   $latestProducts=mysqli_query($conn,"SELECT product.* , category.Cat_Name,category.Cat_ID , vendor.*
                                                                   FROM product
                                                                   INNER JOIN category
                                                                   ON category.Cat_ID = product.c_id
                                                                   INNER JOIN vendor
                                                                   ON vendor.v_ID = product.v_id
                                                                   ORDER BY p_id DESC LIMIT 8");
                                      if(mysqli_num_rows($latestProducts)>0){
                                             $i=0;
                                             while($result= mysqli_fetch_assoc($latestProducts))
                                             {
                                                $product_id= strtr(base64_encode($result['p_id']), '+/=', '-_,');
                                                $catID=strtr(base64_encode($result['Cat_ID']), '+/=', '-_,');
                                             ?>
                                                <li class="span3">
                                                 <div class="product-box">
                                                     <p><?php
											            echo  "<a href='product_detail.php?i=".$product_id."'>";?>
                                                     <img class="productimage" src="../vendor/images/products/<?php echo $result['p_image']?>" alt=""></a></p>
                                                      <?php
											            echo  "<a href='product_detail.php?i=".$product_id."' class=title'>{$result['p_name']}</a>"?>
                                                     <br>
                                                     <?php echo "<a href='products.php?i=".$catID."'>{$result['Cat_Name']}</a>";?><br>
                                                     <a href="vendor.html" class="">BY : <?php echo $result['v_Name']?></a>
                                                     <p class="price">$<?php echo $result['price']?></p>
                                                 </div>
                                                </li>
                                          <?php $i++;if($i==4)break;}}
                                           ?>
    
                                    </ul>
                                </div>

                                <div class="item">
                                    <ul class="thumbnails">
                                        <?php
                                           if(mysqli_num_rows($latestProducts)>0){
                                           while($result= mysqli_fetch_assoc($latestProducts))
                                             { $product_id= strtr(base64_encode($result['p_id']), '+/=', '-_,');
                                                $catID=strtr(base64_encode($result['Cat_ID']), '+/=', '-_,');
                                             ?>
                                                <li class="span3">
                                                 <div class="product-box">
                                                     <p><?php
											            echo  "<a href='product_detail.php?i=".$product_id."'>";?>
                                                     <img class="productimage" src="../vendor/images/products/<?php echo $result['p_image']?>" alt=""></a></p>
                                                      <?php
											            echo  "<a href='product_detail.php?i=".$product_id."' class=title'>{$result['p_name']}</a>"?>
                                                     <br>
                                                     <?php echo "<a href='products.php?i=".$catID."'>{$result['Cat_Name']}</a>";?><br>
                                                     <a href="vendor.html" class="">BY : <?php echo $result['v_Name']?></a>
                                                     <p class="price">$<?php echo $result['price']?></p>
                                                 </div>
                                                </li>
                                          <?php }}
                                           ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="span12">
                        <h4 class="title"><span class="pull-left"><span class="text"><span class="line">All <strong>Products</strong></span></span></span> <span class="pull-right"><a class="left button" href="#myCarousel-2" data-slide="prev"></a><a class="right button" href="#myCarousel-2" data-slide="next"></a></span></h4>

                        <div id="myCarousel-2" class="myCarousel carousel slide">
                            <div class="carousel-inner">
                                <div class="active item">
                                    <ul class="thumbnails">
                                       <?php $all_products=mysqli_query($conn,"SELECT product.* , category.Cat_Name ,category.Cat_ID, vendor.*
                                                                   FROM product
                                                                   INNER JOIN category
                                                                   ON category.Cat_ID = product.c_id
                                                                   INNER JOIN vendor
                                                                   ON vendor.v_ID = product.v_id
                                                                   ORDER BY p_id");
                                       $i=0 ;
                                       if(mysqli_num_rows($all_products)>0){
                                       while($fetch_all=mysqli_fetch_assoc($all_products)){
                                        $product_id= strtr(base64_encode($fetch_all['p_id']), '+/=', '-_,');
                                                $catID=strtr(base64_encode($fetch_all['Cat_ID']), '+/=', '-_,');
                                             ?>
                                                <li class="span3">
                                                 <div class="product-box">
                                                     <p><?php
											            echo  "<a href='product_detail.php?i=".$product_id."'>";?>
                                                     <img class="productimage" src="../vendor/images/products/<?php echo $fetch_all['p_image']?>" alt=""></a></p>
                                                      <?php
											            echo  "<a href='product_detail.php?i=".$product_id."' class=title'>{$fetch_all['p_name']}</a>"?>
                                                     <br>
                                                     <?php echo "<a href='products.php?i=".$catID."'>{$fetch_all['Cat_Name']}</a>";?><br>
                                                     <a href="vendor.html" class="">BY : <?php echo $fetch_all['v_Name']?></a>
                                                     <p class="price">$<?php echo $fetch_all['price']?></p>
                                                 </div>
                                                </li>
                                        <?php $i++;if($i==4)break; }}?>
                                       
                                       
                                    </ul>
                                </div>
                                <?php
                                //echo mysqli_num_rows($all_products); 
                               for($n=0;$n<mysqli_num_rows($all_products)-4;$n+=4)
                               {?>
                                 <div class="item">
                                    <ul class="thumbnails">
                                       <?php $i=0 ; while($fetch_all=mysqli_fetch_assoc($all_products)){
                                        $product_id= strtr(base64_encode($fetch_all['p_id']), '+/=', '-_,');
                                                $catID=strtr(base64_encode($fetch_all['Cat_ID']), '+/=', '-_,');
                                        ?>
                                        <li class="span3">
                                            <div class="product-box">
                                                <p>
                                                   <?php
											            echo  "<a href='product_detail.php?i=".$product_id."'>";?>
                                                     <img class="productimage" src="../vendor/images/products/<?php echo $fetch_all['p_image']?>" alt=""></a></p>
                                                      <?php
											            echo  "<a href='product_detail.php?i=".$product_id."' class=title'>{$fetch_all['p_name']}</a>"?>
                                                     <br>
                                                     <?php echo "<a href='products.php?i=".$catID."'>{$fetch_all['Cat_Name']}</a>";?><br>
                                                     <a href="vendor.html" class="">BY : <?php echo $fetch_all['v_Name']?></a>
                                                     <p class="price">$<?php echo $fetch_all['price']?></p>
                                            </div>
                                           </li>
                                        <?php $i++;if($i==4)break; }?>
                                    </ul>
                                </div>
                              <?php }
                                ?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="our_client">
        <h4 class="title"><span class="text">Vendors</span></h4>
        <div class="row">
        <?php $vendors=mysqli_query($conn,"SELECT * FROM vendor");
        While($fetch_vendors=mysqli_fetch_assoc($vendors))
        {
            ?>
            <div class="span2">
                <a href="#"><img alt="<?php echo $fetch_vendors['v_Name']." logo";?>" width="100" src="../vendor/images/logo/<?php echo $fetch_vendors['v_img'];?>"></a>
            </div>
            <?php
        }
        ?>
        </div>
    </section>

			<?php include("includes/footer.php"); ?>
