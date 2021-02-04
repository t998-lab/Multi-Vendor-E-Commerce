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
                        <h4 class="page-title">Vendors</h4>
                        
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <input class="form-control" id="myInput" type="text" placeholder="Search By Vendor Name . . ." >
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Vendor</th>
                                            <th class="border-top-0">Logo</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Mobile</th>
                                            <th class="border-top-0">Category</th>
                                            <th class="border-top-0">Block</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                       <?php
                                        $query=mysqli_query($conn,"SELECT vendor.* , category.Cat_Name
                                                                   FROM vendor
                                                                   INNER JOIN category
                                                                   ON category.Cat_ID = vendor.cat_id
                                                                   ");
                                        if(mysqli_num_rows($query)>0)
                                        {
                                            while($row = mysqli_fetch_assoc($query))
                                            {
                                                echo "<tr>";
                                                echo "<td>{$row['v_Name']}</td>";
                                                echo "<td><img width='80' height='80' class='rounded' src='vendor/images/logo/{$row['v_img']}'></td>";
                                                echo "<td>{$row['v_Email']}</td>";
                                                echo "<td>{$row['mobile']}</td>";
                                                echo "<td>{$row['Cat_Name']}</td>";
                                                echo "<td><a href='vendors.php?action=block&id=".$row['v_ID']."' class='btn btn-danger'>Block</a></td>";
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
            elseif($action=='block')
            {   
                $id    = $_GET['id'];
                echo $id;
                $query = mysqli_query($conn,"DELETE FROM vendor WHERE v_ID ='$id'");
                ?>
                <script type="text/javascript">
                window.location.href='vendors.php';
                </script>
                <?php
            }
            ?>
            <?php include("includes/footer.php");?>
            <script>
            $("#myInput").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) ==0 );
                });
            });
            </script>