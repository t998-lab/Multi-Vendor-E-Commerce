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
                        <h4 class="page-title">Customers</h4>
                        
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <input class="form-control" id="myInput" type="text" placeholder="Search By Customer Name . . ." >
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Customer</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Mobile</th>
                                            <th class="border-top-0">Block</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTable">
                                        <?php
                                        $query=mysqli_query($conn,"SELECT * FROM customer");
                                        if(mysqli_num_rows($query)>0)
                                        {
                                            while($row = mysqli_fetch_assoc($query))
                                            {
                                                echo "<tr>";
                                                echo "<td>{$row['c_Name']}</td>";
                                                echo "<td>{$row['c_Email']}</td>";
                                                echo "<td>{$row['mobile']}</td>";
                                                echo "<td><a href='customers.php?action=block&id=".$row['c_ID']."' class='btn btn-danger'>Block</a></td>";
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
             elseif($action='block')
            {
                $id    = $_GET['id'];
                echo $id;
                $query = mysqli_query($conn,"DELETE FROM customer WHERE c_ID ='$id'");
                ?>
                <script type="text/javascript">
                window.location.href='customers.php';
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