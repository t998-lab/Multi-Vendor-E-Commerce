<?php include("includes/header.php");
$query=mysqli_query($conn,"SELECT COUNT(*) AS num_of_products FROM product WHERE v_id='$vendor_id'");
$num_of_products=mysqli_fetch_assoc($query);
$query=mysqli_query($conn,"SELECT COUNT(*) AS num_of_orders FROM order_details
INNER JOIN product
on product.p_id=order_details.p_id
WHERE product.v_id='$vendor_id'
");
$num_of_orders=mysqli_fetch_assoc($query);
?>
        <div class="page-wrapper">
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
                        <div class="card ">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Categories</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <!-- column -->
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                <table class="table table-striped">
                                    
                                    <tbody>
                                        <?php
                                                $query=mysqli_query($conn,"SELECT * FROM category");
                                                if(mysqli_num_rows($query)>0)
                                                {
                                                        while($row=mysqli_fetch_assoc($query))
                                                        {
                                                                echo "<tr>";
                                                                echo "<th class='border-0'>{$row['Cat_Name']}</th>";
                                                                echo "<th class='float-right border-0'><img width='50' height='50' src='../images/{$row['Cat_image']}'></th>";
                                                                echo "</tr>";
                                                        }
                                                }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                                    </div>
                                    <!-- column -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                                <div class="feed-widget">
                                    <ul class="list-style-none feed-body p-b-20 ">
                                        <li class="feed-item bg-danger m-2">
                                            <div class="feed-icon text-light  h3"><i class="mdi mdi-basket"></i></div>
                                            <span class='h5 text-light center'>
                                             <?php
                                            echo $num_of_products['num_of_products'];?>
                                           | Products</span>
                                        </li>
                                        <li class="feed-item bg-info m-2 ">
                                            <div class="feed-icon text-white h3"><i class="mdi mdi-cart"></i></div>
                                            <span class='h5 text-light center'>
                                                <?php echo $num_of_orders['num_of_orders']; ?>
                                                |  Orders</span>
                                        </li>
                                    </ul>
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
                                        <h4 class="card-title">Top Five Selling Products</h4>
                                        <h5 class="card-subtitle">Overview of Top Selling Items</h5>
                                    </div>
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Product</th>
                                            <th class="border-top-0">Image</th>
                                            <th class="border-top-0">Sales</th>
                                            <th class="border-top-0">Earnings</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                                $query=mysqli_query($conn,"SELECT * FROM product
                                                                           WHERE v_id = '$vendor_id'
                                                                           ORDER BY sales DESC lIMIT 5
                                                                        ");
                                                if(mysqli_num_rows($query)>0)
                                                {
                                                        while($row = mysqli_fetch_assoc($query))
                                                        {
                                                                echo "<tr>";
                                                                echo "<td>{$row['p_name']}</td>";
                                                                echo "<td><img width='80' height='80' src='images/products/{$row['p_image']}'></td>";
                                                                echo "<td>{$row['sales']}</td>";
                                                                echo "<td>{$row['Earning']}</td>";
                                                                echo "</tr>";
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