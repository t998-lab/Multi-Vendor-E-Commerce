    <?php
    //include("includes/connection.php");
    include("includes/header.php");
    date_default_timezone_set("Asia/Amman");
    $date=date("Y/m/d");
    $qu=mysqli_query($conn,"SELECT * FROM product WHERE date ='$date'" );
    $numberOfProducts = mysqli_num_rows($qu);
    $query=mysqli_query($conn,"SELECT COUNT(*) AS ordersToday FROM orders WHERE o_Date ='$date'" );
    $ordersToday=mysqli_fetch_assoc($query);
    $orders_Today=$ordersToday['ordersToday'];
    $query=mysqli_query($conn,"SELECT COUNT(*) AS num_of_categories FROM category");
    $num_of_categories=mysqli_fetch_assoc($query);
    $query=mysqli_query($conn,"SELECT COUNT(*) AS num_of_products FROM product");
    $num_of_products=mysqli_fetch_assoc($query);
    $query=mysqli_query($conn,"SELECT COUNT(*) AS num_of_vendors FROM vendor");
    $num_of_vendors=mysqli_fetch_assoc($query);
    $query=mysqli_query($conn,"SELECT COUNT(*) AS num_of_customer FROM customer");
    $num_of_customer=mysqli_fetch_assoc($query);
    
    
    ?>
    <style>
        .staCol{
            padding:10px;
            font-size:18px;
            
        }
    </style>
     <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Dashboard</h4>
                        
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-8">             
                 <div class="row">
                    <div class="col-12 staCol text-center text-light mb-4 bg-success p-3">
                    <?php echo $num_of_categories['num_of_categories'];?> | Category</div>
                    <div class="col-12 staCol text-center text-light mb-4 bg-info p-3">
                    <?php echo $num_of_products['num_of_products'];?> | Products</div>
                    <div class="col-12 staCol text-center  text-light mb-4 bg-danger p-3">
                        <?php echo $num_of_vendors['num_of_vendors'];?> | Vendors</div>
                    <div class="col-12 staCol text-center text-light mb-4 bg-warning p-3">
                        <?php echo $num_of_customer['num_of_customer'];?> | Customers</div>
                 </div>
                </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Notifications</h4>
                                <div class="feed-widget">
                                    <ul class="list-style-none feed-body m-0 p-b-20">
                                        <?php
                                        $query = mysqli_query($conn,"SELECT * FROM vendor_requist");
                                        $num   = mysqli_num_rows($query);
                                        if($num>0)
                                        {
                                            ?>
                                            <li class="feed-item">
                                            
                                            <div class="feed-icon bg-info"><i class="mdi mdi-account-alert"></i>
                                            </div><a href="vendor_request.php"> You have
                                            <?php echo $num ;?>
                                            vendor requests</a>
                                            
                                            </li>
                                            <?php
                                        }
                                        
                                        ?>
                                        <?php if($numberOfProducts>0)
                                        {?>
                                        <li class="feed-item">
                                            <div class="feed-icon bg-warning"><i class="mdi mdi-basket"></i></div>
                                            products added today &nbsp
                                           <span class='badge badge-warning badge-lg'><?php echo "<strong style='font-size:16px'>".$numberOfProducts."</strong>" ;?></span> 
                                            <span class="ml-auto font-12 text-muted"><?php echo $date ;?></span>
                                        </li>
                                        <?php }?>
                                        <?php if($orders_Today>0)
                                        {?>
                                        <li class="feed-item">
                                            <div class="feed-icon bg-danger"><i class="ti-shopping-cart"></i></div>
                                            Number of orders today &nbsp
                                           <span class='badge badge-danger badge-lg'><?php echo "<strong style='font-size:16px'>".$orders_Today."</strong>" ;?></span> 
                                            <span class="ml-auto font-12 text-muted"><?php echo $date ;?></span>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Orders</h4>
                                    </div>
                                </div>
                                <?php
                                    $query=mysqli_query($conn,"SELECT orders.*,order_details.*,
                                                        product.p_name,product.p_image,product.price,
                                                        vendor.v_Name,
                                                        vendor.v_img,customer.c_Name
                                                        FROM orders
                                                        INNER JOIN order_details
                                                        on order_details.o_id=orders.o_ID
                                                        INNER JOIN product
                                                        ON product.p_id=order_details.p_id
                                                        INNER JOIN vendor
                                                        ON vendor.v_ID = product.v_id
                                                        INNER JOIN customer
                                                        ON customer.c_ID=orders.customer_id
                                                        ORDER BY orders.o_ID
                                                        ");
                                ?>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <input class="form-control" id="myInput" type="text" placeholder="Search By Order Number . . ." >
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Order Number</th>
                                            <th class="border-top-0">Product</th>
                                            <th class="border-top-0">Image</th>
                                            <th class="border-top-0">Vendor</th>
                                            <th class="border-top-0">Vendor Image</th>
                                            <th class="border-top-0">Quantity</th>
                                            <th class="border-top-0">Cost</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                       <?php
                                         if(mysqli_num_rows($query)>0)
                                        {
                                            while ($row=mysqli_fetch_assoc($query))
                                            {  $price=$row['price'];
                                               $qty=$row['qty'];
                                               $price=$price*$qty;
                                                echo "<tr><td>{$row['o_ID']}</td>";
                                                echo "<td>{$row['p_name']}</td>";
                                                echo "<td><img width='80' height='80' src='vendor/images/products/{$row['p_image']}'></td>";
                                                echo "<td>{$row['v_Name']}</td>";
                                                echo "<td><img width='80' height='80' src='vendor/images/logo/{$row['v_img']}'></td>";
                                                echo "<td>{$row['qty']}</td>";
                                                echo "<td>{$price}</td></tr>";
                                                
                                            }
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("includes/footer.php");?>
            <script>
                 $("#myInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                      $(this).toggle($(this).text().toLowerCase().indexOf(value) ==0 );
                    });
                  });
            </script>