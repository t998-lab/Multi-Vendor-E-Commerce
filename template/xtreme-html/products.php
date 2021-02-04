    <?php
    $action = isset($_GET['action']) ? $_GET['action'] : 'dash';
    //include("includes/connection.php");
    include("includes/header.php")
    ?>
    <?php if($action=='dash'){?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">All Products</h4>
                        
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <input class="form-control" id="myInput" type="text" placeholder="Search . . ." >
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Product</th>
                                            <th class="border-top-0">Product image</th>
                                            <th class="border-top-0">Category</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Vendor</th>
                                            <th class="border-top-0">Price</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                       <?php
                                        $query=mysqli_query($conn,"SELECT product.* , category.Cat_Name , vendor.*
                                                                   FROM product
                                                                   INNER JOIN category
                                                                   ON category.Cat_ID = product.c_id
                                                                   INNER JOIN vendor
                                                                   ON vendor.v_ID = product.v_id
                                                                   ");
                                        if(mysqli_num_rows($query)>0)
                                        {
                                            while($row = mysqli_fetch_assoc($query))
                                            {
                                                echo "<tr>";
                                                echo "<td>{$row['p_name']}</td>";
                                                echo "<td><img width='80' height='80' class='rounded' src='vendor/images/products/{$row['p_image']}'></td>";
                                                echo "<td>{$row['Cat_Name']}</td>";
                                                echo "<td>{$row['p_desc']}</td>";
                                                echo '<td><a href="#" class="productPopover"
                                                data-toggle="popover" data-img="vendor/images/logo/'.$row['v_img'].'"
                                                data-p="'.$row['v_Email'].'" data-span="'.$row['mobile'].'"
                                                title="'.$row['v_Name'].'">
                                                      '.$row['v_Name'].'</a></td> ';
                                               echo "<td>{$row['price']}</td>";
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
            <?php }
            ?>
            <?php include("includes/footer.php");?>
            <script>
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) >-1 );
                });
            });
          $('.productPopover').popover({
          container: 'body',
          offset: 0,
		  trigger: 'hover',
          html: true,
          content: function () {
				return '<img width="100" height="100" class="img-fluid" src="'+$(this).data('img') + '" /><br><div>Email : '+$(this).data('p') + '</div><div>Mobile : '+$(this).data('span') + ' </div>';
          },
          title: 'Toolbox'
    }) ;
            </script>