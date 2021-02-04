    <?php
    $action = isset($_GET['action']) ? $_GET['action'] : 'dash';
    //include("includes/connection.php");
    include("includes/header.php");
    ?>
    <?php if($action=='dash')
    {?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Vendor Requests</h4>
                        
                    </div>
                    
                </div>
            </div>
            <div class="container-fluid">
                
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">Vendor</th>
                                            <th class="border-top-0">Logo</th>
                                            <th class="border-top-0">Category</th>
                                            <th class="border-top-0">Email</th>
                                            <th class="border-top-0">Mobile</th>
                                            <th class="border-top-0">Approve</th>
                                            <th class="border-top-0">Reject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query=mysqli_query($conn,"SELECT vendor_requist.* , category.Cat_Name
                                                                   FROM vendor_requist
                                                                   INNER JOIN category
                                                                   ON category.Cat_ID = vendor_requist.category
                                                                   ");
                                        if(mysqli_num_rows($query)>0)
                                        {
                                            while($row = mysqli_fetch_assoc($query))
                                            {
                                                echo "<tr>";
                                                echo "<td>{$row['vendor_name']}</td>";
                                                echo "<td><img width='80' height='80' class='rounded' src='vendor/images/logo/{$row['logo']}'></td>";
                                                echo "<td>{$row['Cat_Name']}</td>";
                                                echo "<td>{$row['v_email']}</td>";
                                                echo "<td>{$row['mobile']}</td>";
                                                echo "<td><a href='vendor_request.php?action=approve&id=".$row['id']."' class='btn btn-success'>Approve</a></td>";
                                                echo "<td><a href='vendor_request.php?action=reject&id=".$row['id']."' class='btn btn-danger'>Reject</a></td>";
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
            <?php
            }
            elseif($action=='approve')
            {
            $id=$_GET['id'];
            $query=mysqli_query($conn,"SELECT * FROM vendor_requist WHERE id= '$id'");
            $result=mysqli_fetch_assoc($query);
            if(mysqli_num_rows($query)>0)
            {
                $name=$result['vendor_name'];
                $email =$result['v_email'];
                $mobile=$result['mobile'];
                $category = $result['category'];
                $logo =$result['logo'];
                $to = $email;
               
                    $insert=mysqli_query($conn,"INSERT INTO vendor(v_Name,v_Email,v_img,cat_id,mobile)
                                               VALUES('$name','$email','$logo','$category','$mobile')");
                     $select=mysqli_query($conn,"SELECT * FROM vendor order by v_ID desc limit 1");
                        $result = mysqli_fetch_assoc($select);
                        $vID=$result['v_ID'];
                        $encode_ID=strtr(base64_encode($vID), '+/=', '-_,');
                $delete = mysqli_query($conn,"DELETE FROM vendor_requist WHERE id= '$id'");
                $pageForm = "http://localhost/template/xtreme-html/pageForm.php?id=".$encode_ID."";
                $subject = "Approved";
                $text = "Hi ".$name."\n\n";
                $text .= "You are approved to publish your products on MVE website\n";
                $text .= "Please Click here to continue $pageForm";
                $header = array(
                'From' => 'aljayyousitima@yahoo.com',
                'X-Mailer' => 'PHP/' . phpversion()
                 );
                
                   mail($to, $subject, $text,$header);
                   ?>
                   <script type="text/javascript">
                   window.location.href ='vendor_request.php';
                   </script>
             <?php    
                
            }    
            }
            elseif($action=='reject')
            {
                 $id=$_GET['id'];
            $query=mysqli_query($conn,"SELECT * FROM vendor_requist WHERE id= '$id'");
            $result=mysqli_fetch_assoc($query);
            if(mysqli_num_rows($query)>0)
            {
                $name=$result['vendor_name'];
                $email =$result['v_email'];
                $mobile=$result['mobile'];
                $category = $result['category'];
                $logo =$result['logo'];
                $to = $email;
                //$pageForm = "http://localhost/template/xtreme-html/pageForm.php";
                $subject = "Rejected";
                $text = "Hi ".$name."\n\n";
                $text .= "Your join request rejected ,\n thank you \n \n MVE\n";
               // $text .= "Please Click here to continue $pageForm";
                $header = array(
                'From' => 'aljayyousitima@yahoo.com',
                'X-Mailer' => 'PHP/' . phpversion()
                 );
                if(mail($to, $subject, $text,$header)) {
                    //$insert=mysqli_query($conn,"INSERT INTO vendor(v_Name,v_Email,v_img,cat_id)
                                              // VALUES('$name','$email','$logo','$category')");
                   $delete = mysqli_query($conn,"DELETE FROM vendor_requist WHERE id= '$id'");?>
                   <script type="text/javascript">
                   window.location.href ='vendor_request.php';
                   </script>
             <?php    }
                
            }    
            }
            ?>
            <?php include("includes/footer.php");?>