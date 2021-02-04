    <?php
    $action = isset($_GET['action']) ? $_GET['action'] : 'dash';
    //include("includes/connection.php");
    include("includes/header.php");  
                        if(isset($_POST['add']))
                        {
                          $imageHash= uniqid().md5($_FILES['pro_img']['name']);
                          $image = $_FILES['pro_img']['name'];
                          $tmp   = $_FILES['pro_img']['tmp_name'];
                          $path  = 'images/products/';
                          move_uploaded_file($tmp,$path.$imageHash);
                          $proName = $_POST['name'];
                          $proDesc = $_POST['desc'];
                          $proPrice= $_POST['price'];
                          $proQTY  = $_POST['qty'];
                          $category=$_POST['categories'];
                          date_default_timezone_set("Asia/Amman");
                          $date=date("Y/m/d");
                          $query=mysqli_query($conn,"INSERT INTO product (p_name,p_desc,p_image,c_id,v_id,price,qty,date)
                                       VALUES('$proName','$proDesc','$imageHash','$category','$vendor_id','$proPrice','$proQTY','$date')");
                          //test v_id
                         if($query)
                          {
                           ?>
                           <script type="text/javascript">
                            window.location.href='product.php';
                           </script>
                           <?php
                          }
                        }
      
    ?>
  <?php  if ($action == 'dash'){?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Products</h4>
                        
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                       <!-- Column -->
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-dark">
                          <div class="card-header bg-dark text-light">Add new product</div>
                            <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                              <div class="row">
                                
                                <div class="col-6 mb-4">
                                  <input type="text" class="form-control" id="" placeholder="product name" name="name" required >
                                </div>
                                <div class="col-6 mb-4">
                                  <input type="text" class="form-control" placeholder="description" name="desc" required>
                                </div>
                                <div class="col-5 mb-4 ml-2">
                                  <input type="file" class="custom-file-input form-control " name="pro_img" id="customFile" required>
                                  <label class="custom-file-label" for="customFile ">Choose image</label>
                                </div>
                                <div class="col-3 mb-4 ml-3">
                                  <input type="number" step="0.01" min="0" class="form-control" id="" placeholder="price" name="price" required>
                                </div>
                                <div class="col-3 mb-4">
                                  <input type="number"  min="0" class="form-control" id="" placeholder="quantity" name="qty" required>
                                </div>
                                <div class="col-12 mb-4">
                                <select name="categories" class="custom-select" required>
                                <option disabled class="text-danger">Select Category .. </option>
                                  <?php
                                  $query=mysqli_query($conn,"SELECT * FROM category");
                                  while($row = mysqli_fetch_assoc($query))
                                  {
                                    echo "<option value='{$row['Cat_ID']}'>{$row['Cat_Name']}</option>";
                                  }
                                  ?>
                              </select>
                                </div>
                                <div class="form-group">
                                 <div class="col-12"><br>
                                   <input type="submit" name="add" value="Add" class="btn btn-success btn-block">
                                 </div>
                                 </div>
                              </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Image</th>
                                            <th class="border-top-0">Category</th>
                                            <th class="border-top-0">Price</th>
                                            <th class="border-top-0">Quentity</th>
                                            <th class="border-top-0">Edit</th>
                                            <th class="border-top-0">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                    <?php  $query=mysqli_query($conn,"SELECT product.* ,category.Cat_Name
                                                                      FROM product
                                                                      INNER JOIN category
                                                                      ON category.Cat_ID = product.c_id
                                                                      WHERE v_id = '$vendor_id'"
                                                                      );
                                            while($row=mysqli_fetch_assoc($query)){
                                            echo "<tr><td>{$row['p_name']}</td>";
                                            echo "<td>{$row['p_desc']}</td>";
                                            echo "<td><img class='rounded-circle' src='images/products/{$row['p_image']}' width='50' height='50'></td>";
                                            echo "<td>{$row['Cat_Name']}</td><td>{$row['price']}</td><td>{$row['qty']}</td>";
                                            echo "<td><a href='product.php?action=edit&id=".$row['p_id']."' class='btn btn-info'>Edit</a></td>";
                                            echo "<td><a href='product.php?action=delete&id=".$row['p_id']."' class='btn btn-danger'>Delete</a></td>";
                                            echo "</tr>";
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><?php }
            elseif($action=='delete')
            {
                $id=$_GET['id'];
                $query=mysqli_query($conn,"DELETE FROM product WHERE p_id = '$id'");
                ?>
                <script type="text/javascript">
                   window.location.href ='product.php';
                </script>
                <?php
            }
            elseif($action=='edit')
            {
            $id    = $_GET['id'];
            $query = mysqli_query($conn,"SELECT product.* , category.Cat_Name FROM product
                                         INNER JOIN category
                                         ON category.Cat_ID = product.c_id
                                         WHERE p_id = '$id'");
             if(!isset($_GET['id'])||$_GET['id']==null)
              {
                echo '<script>window.location.href="product.php";</script>';
              }
            if(mysqli_num_rows($query)==1)
            {
                $result=mysqli_fetch_assoc($query);
            }
            else{
              echo '<script>window.location.href="product.php";</script>';
            }
            if(isset($_POST['edit']))
            {   
                 $name            =  $_POST['name'];
                 $description     =  $_POST['desc'];
                 $category        =  $_POST['categories'];
                 $proPrice        =  $_POST['price'];
                 $proQTY          =  $_POST['qty'];
               if(($_FILES['pro_img']['name']))
               {
                $imageHash  = uniqid().md5($_FILES['pro_img']['name']);
                $image      = $_FILES['pro_img']['name'];
                $tmp        = $_FILES['pro_img']['tmp_name'];
                $path       = 'images/products/';
                move_uploaded_file($tmp,$path.$imageHash);
               }
               else{
                $imageHash  = $result['p_image'];
               }
               $query       = mysqli_query($conn,"UPDATE product SET
                                                p_name  =  '$name',
                                                p_desc  =  '$description',
                                                p_image =  '$imageHash',
                                                c_id    =  '$category',
                                                v_id    =  '$vendor_id', 
                                                price   =  '$proPrice',
                                                qty     =  '$proQTY'
                                                WHERE
                                                p_id  =   '$id'");/*test v_id*/
               if($query)
               {
                ?>
                <script type="text/javascript">
                   window.location.href ='product.php';
                </script>
                <?php
               }
            }
            ?>
                <div class="page-wrapper">
                    <div class="page-breadcrumb">
                        <div class="row align-items-center">
                            <div class="col-5">
                                <h4 class="page-title">Products</h4>
                                
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                       <!-- Column -->
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-dark">
                          <center><div class="card-header bg-dark text-light">Edit Product</div></center> 
                            <div class="card-body">
                            <form method="post" enctype="multipart/form-data">
                              <div class="row">
                                
                                <div class="col-12">
                                  <center>
                                  <img class="rounded-circle"src="images/products/<?php echo $result['p_image'];?>" width="100" height="100">
                                  <hr>
                                  </center>
                                </div>
                                
                                <div class="col-6 mb-4">
                                  <label class="text-light">Name:</label>
                                  <input type="text" class="form-control" id="" placeholder="product name" name="name" value="<?php echo $result['p_name']?>">
                                </div>
                                <div class="col-6 mb-4">
                                  <label class="text-light">Description:</label>
                                  <input type="text" class="form-control" placeholder="description" name="desc" value="<?php echo $result['p_desc']?>">
                                </div>
                                 <div class="form-group">
                                        <label for="example-email" class="col-md-12 text-light">Image</label>
                                       <div class="custom-file ml-2">
                                         <input type="file" class="custom-file-input" id="customFile"  name="pro_img">
                                         <span class="custom-file-label" for="customFile">Choose image</span>
                                       </div>
                                    </div>
                                <div class="col-3 mb-4 ml-3">
                                  <label class="text-light">Price:</label>
                                  <input type="number" step="0.01" min="0" class="form-control" id="" placeholder="price" name="price" value="<?php echo $result['price']?>">
                                </div>
                                <div class="col-3 mb-4">
                                  <label class="text-light">Quantity:</label>
                                  <input  type="number" min="0" class="form-control" id="" placeholder="quantity" name="qty"  value="<?php echo $result['qty']?>">
                                </div>
                                <div class="col-12 mb-4">
                                  <label class="text-light">Category:</label>
                                <select name="categories" class="custom-select">
                                
                                <option disabled class="text-danger">Change Category .. </option>
                                <option value='<?php echo $result['c_id']?>'>
                                <?php echo $result['Cat_Name'];?>
                                </option>
                                  <?php
                                  $query=mysqli_query($conn,"SELECT * FROM category");
                                  while($row = mysqli_fetch_assoc($query))
                                  {
                                    if($row['Cat_ID']==$result['c_id']) continue;
                                    echo "<option value='{$row['Cat_ID']}'>{$row['Cat_Name']}</option>";
                                  }
                                  ?>
                              </select>
                                </div>
                                <div class="form-group">
                                 <div class="col-12"><br>
                                   <input type="submit" name="edit" value="Edit" class="btn btn-success btn-block">
                                 </div>
                                 </div>
                              </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php include("includes/footer.php");?>
<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});

  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) >-1 )
    });
  });

</script>