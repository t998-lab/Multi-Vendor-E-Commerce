<?php
include("includes/header.php");
//include("includes/connection.php");
$admin=$_SESSION['admin_id'];
$query=mysqli_query($conn,"SELECT * FROM Admin WHERE Admin_ID='$admin'");
if(mysqli_num_rows($query)>0)
{
$result=mysqli_fetch_assoc($query);
$password=$result['Admin_password'];
}
if(isset($_POST['update']))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $mobile=$_POST['mobile'];
    $query=mysqli_query($conn,"UPDATE Admin SET
                               Admin_Name='$name',
                               Admin_Email='$email',
                               mobile='$mobile'
                               WHERE Admin_ID='$admin'");
    if($query)
    {
        $msg="Your Info Updated Successfully";
    }
    
}
if(isset($_POST['edit_pass']))
{
    $current_pass=$_POST['current_pass'];
    $new_pass=$_POST['new_pass'];
    $re_pass=$_POST['re_pass'];
    $hashedPass =sha1($current_pass);
    if($password==$hashedPass)
    { 
        if($new_pass==$re_pass)
        {   $hashanew = sha1($new_pass);
            $query = mysqli_query($conn,"UPDATE admin SET
                                          Admin_password = '$hashanew'
                                          WHERE Admin_ID = 1");
            
            $success= "Your password edited successfully";
            
        }
        else
        {
            $NotMatch="New password and Re-password are not matching";
        }
    }
    else
    {
        $passError = "Your password incorrect";
    }
}

?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Profile Page</h4>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post" action="">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $result['Admin_Name'];?>"
                                                class="form-control form-control-line" name="name"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" value="<?php echo $result['Admin_Email'];?>"
                                                class="form-control form-control-line" name="email"
                                                id="example-email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Phone No</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $result['mobile'];?>"
                                                class="form-control form-control-line" name="mobile">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" name="update" class="btn btn-success" value="Update Profile">
                                        </div>
                                    </div>
                                </form>
                                <?php if(isset($msg))
                                {?>
                                <div class="alert alert-success" role="alert">
                                <?php echo $msg?> 
                                </div>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                  <div class="col-lg-4 col-sm-12">	
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Password</h4>
                                <form action="" method="post">
                                    <div class="form-group">
                                      <label>Current Password : </label>
                                      <input type="password" name="current_pass" required class="form-control">
                                    </div>
                                     <?php
                                        if(isset($passError))
                                           {
                                             echo "<div class='alert alert-warning'>Warning ! $passError</div>";
                                           }
                                    ?>
                                    <div class="form-group">
                                      <label>New Password :</label>
                                      <input type="password" name="new_pass" required class="form-control">
                                    </div>
                                     <div class="form-group">
                                      <label>Re-Password :</label>
                                      <input type="password" name="re_pass" required class="form-control">
                                    </div>
                                     <?php
                                        if(isset($NotMatch))
                                           {
                                             echo "<div class='alert alert-warning'>Warning ! $NotMatch</div>";
                                           }
                                    ?>
                                      <?php
                                 if(isset($success))
                                    {
                                      echo "<div class='alert alert-success'>Success ! $success</div>";
                                    }
                                ?>
                                    <button type="submit" name="edit_pass" class="btn btn-success">Edit Password</button>
                                </form>
                             </div>
                         </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
                    <?php  include("includes/footer.php");?>