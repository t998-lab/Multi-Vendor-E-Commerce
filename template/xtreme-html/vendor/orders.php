    <?php
    include("includes/header.php");
    ?>
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
                        <h4 class="page-title">Orders</h4>
                        
                    </div>
                    
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                              <input class="form-control" id="myInput" type="text" placeholder="Search ... " >
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Order Number</th>
                                            <th class="border-top-0">Product</th>
                                            <th class="border-top-0">Customer</th>
                                            <th class="border-top-0">Quantity</th>
                                            <th class="border-top-0">Total</th>
                                            <th class="border-top-0">Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                      <?php
                                      $selectOrders=mysqli_query($conn,"SELECT order_details.*,product.p_name,
                                                                        product.p_image,product.price,
                                                                        orders.*,customer.*
                                                                        FROM order_details
                                                                        INNER JOIN product
                                                                        on order_details.p_id=product.p_id
                                                                        INNER JOIN orders
                                                                        on order_details.o_id=orders.o_ID
                                                                        INNER JOIN customer
                                                                        on customer.c_ID=orders.customer_id
                                                                        WHERE product.v_id='$vendor_id'
                                                                        ORDER BY order_details.o_ID
                                                                        ");
                                      if(mysqli_num_rows($selectOrders))
                                      {
                                        while($fetchOrders=mysqli_fetch_assoc($selectOrders))
                                        {
                                          $price=$fetchOrders['price'];
                                          $qty=$fetchOrders['qty'];
                                          $totalPrice=$price*$qty;
                                          ?>
                                           <tr>
                                            <td><?php echo $fetchOrders['o_id']; ?></td>
                                            <td><a href="#" class="productPopover" data-toggle="popover"
                                            data-img="images/products/<?php echo $fetchOrders['p_image'];?>"
                                            data-span="<?php echo $fetchOrders['price'];?>" title="Product Details">
                                            <?php echo $fetchOrders['p_name']; ?></a></td> 
                                            <td><a href="#" class="vendorPopover" data-toggle="popover"
                                             title="Customer Details" data-p="<?php echo $fetchOrders['c_Email'];?>"
                                             data-span="<?php echo $fetchOrders['mobile']; ?>" >
                                            <?php echo $fetchOrders['c_Name'];?></a></td> 
                                            <td><?php echo $fetchOrders['qty'];?></td>
                                            <td><?php echo $totalPrice;?></td>
                                            <td><?php echo $fetchOrders['o_Date'];?></td>
                                            
                                        </tr>
                                          <?php
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
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

            <script>
                // popover product
    $(document).ready(function(){
         $('.productPopover').popover({
          container: 'body',
          offset: 0,
		  trigger: 'hover',
          html: true,
          content: function () {
				return '<img width="100" height="100" class="img-fluid" src="'+$(this).data('img') + '" /><br><div>Price = '+$(this).data('span') + '</div>';
          },
          title: 'Toolbox'
    });
         
          $('.vendorPopover').popover({
          container: 'body',
          offset: 0,
		      trigger: 'hover',
          html: true,
          content: function () {
				return '<div>Email = '+$(this).data('p') + '<br>Mobile= '+$(this).data('span') +'</div>';
          },
          title: 'Toolbox'
    }) ;
         
     $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
     $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value)>-1);
    });
  });
});
    </script>
            <?php include("includes/footer.php");?>