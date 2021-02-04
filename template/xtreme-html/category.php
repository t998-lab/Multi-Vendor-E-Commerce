    <?php
    $action = isset($_GET['action']) ? $_GET['action'] : 'dash';
   // include("includes/connection.php");
    include("includes/header.php");  
                        if(isset($_POST['add']))
                        {
                          $imageHash= uniqid().md5($_FILES['cat_img']['name']);
                          $path  = 'images/';
                          $image = $_FILES['cat_img']['name'];
                          $tmp   = $_FILES['cat_img']['tmp_name'];
                          move_uploaded_file($tmp,$path.$imageHash);
                          $catName=$_POST['cat_name'];
                          $catDesc=$_POST['cat_desc'];
                          
                          $query=mysqli_query($conn,"INSERT INTO category (Cat_Name,Cat_desc,Cat_image)
                                       VALUES('$catName','$catDesc','$imageHash')");
                         if($query)
                         {
                            ?>
                            <script>
                              window.location.href='category.php';
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
                        <h4 class="page-title">Category</h4>
                        
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                       <!-- Column -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-md-12">Category Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="name"
                                                class="form-control form-control-line" name="cat_name" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Description</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="desc"
                                                class="form-control form-control-line"name="cat_desc" required
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Image</label>
                                       <div class="custom-file ml-2">
                                         <input type="file" class="custom-file-input" id="customFile"  name="cat_img" required>
                                         <span class="custom-file-label" for="customFile">Choose image</span>
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-success" name="add" value="Add Category">
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
                            <input class="form-control" id="myInput" type="text" placeholder="Search By Category Name . . ." >
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Category</th>
                                            <th class="border-top-0">Description</th>
                                            <th class="border-top-0">Image</th>
                                            <th class="border-top-0">Edit</th>
                                            <th class="border-top-0">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                      <?php  $query=mysqli_query($conn,"SELECT * FROM category");
                                            while($row=mysqli_fetch_assoc($query)){
                                            echo "<tr><td>{$row['Cat_Name']}</td>";
                                            echo "<td>{$row['Cat_desc']}</td>";
                                            echo "<td><img class='rounded-circle' src='images/{$row['Cat_image']}' width='50' height='50'></td>";
                                            echo "<td><a href='category.php?action=edit&id=".$row['Cat_ID']."' class='btn btn-info'>Edit</a></td>";
                                            echo "<td><a href='category.php?action=delete&id=".$row['Cat_ID']."' class='btn btn-danger'>Delete</a></td>";
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
                $query=mysqli_query($conn,"DELETE FROM category WHERE Cat_ID = '$id'");
                ?>
                <script type="text/javascript">
                   window.location.href ='category.php';
                </script>
                <?php
            }
            elseif($action=='edit')
            {
            $id    = $_GET['id'];
            $query = mysqli_query($conn,"SELECT * FROM category WHERE Cat_ID = '$id'");
            if(!isset($_GET['id'])||$_GET['id']==null)
              {
                echo '<script>window.location.href="category.php";</script>';
              }
            if(mysqli_num_rows($query)==1)
            {
                $result=mysqli_fetch_assoc($query);
            }
            else{
                echo '<script>window.location.href="category.php";</script>';
            }
            if(isset($_POST['edit']))
            {
                $name=$_POST['cat_name'];
                $description=$_POST['cat_desc'];
               // $image=$_POST['cat_img'];
               if(($_FILES['cat_img']['name']))
               {
                $image = $_FILES['cat_img']['name'];
                $tmp   = $_FILES['cat_img']['tmp_name'];
                $path  = 'images/';
                move_uploaded_file($tmp,$path.$image);
               }
               else{
                $image = $result['Cat_image'];
               }
               $query=mysqli_query($conn,"UPDATE category SET
                                          Cat_Name  = '$name',
                                          Cat_desc  =  '$description',
                                          Cat_image =  '$image'
                                          WHERE
                                          Cat_ID    =   '$id'");
               if($query)
               {
                ?>
                <script type="text/javascript">
                   window.location.href ='category.php';
                </script>
                <?php
               }
            }
            ?>
            <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Edit Category</h4>
                        
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                
                                <form class="form-horizontal form-material" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="col-md-12">Category Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="name"
                                                class="form-control form-control-line" name="cat_name" value="<?php echo $result['Cat_Name'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Description</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="desc"
                                                class="form-control form-control-line"name="cat_desc"
                                                id="example-email" value="<?php echo $result['Cat_desc'];?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div>
                                        <img name="st_image"class="ml-2" width="100" height="100"
                                       src="images/<?php echo $result['Cat_image'];?>" alt="">
                                       </div><br>
                                        <div class="custom-file ml-2">
                                         <input type="file" class="custom-file-input" id="customFile"  name="cat_img">
                                         <span class="custom-file-label" for="customFile">Choose image</span>
                                       </div>
                                    </div>
                                 
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-success" name="edit" value="Edit Category">
                                        </div>
                                    </div>
                                </form>
                            </div>
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
      $(this).toggle($(this).text().toLowerCase().indexOf(value) ==0 )
    });
  });

</script>