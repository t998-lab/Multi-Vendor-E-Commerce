<?php
//include("includes/connection.php");
include("includes/header.php");
//select vendor information
$query=mysqli_query($conn,"SELECT * FROM vendor WHERE v_ID='$vendor_id'");//v_id =1 test
if(mysqli_num_rows($query)>0)
{
$result=mysqli_fetch_assoc($query);
}
if(isset($_POST['update']))
{   //update 
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];
    $query    = mysqli_query($conn,"UPDATE vendor SET
                               v_Name ='$name',
                               v_Email='$email',
                               mobile ='$mobile'
                               WHERE v_ID='$vendor_id'");//v_id =1 test
    if($query)
    {
     ?>
     <script type="text/javascript">
      window.location.href='pages-profile.php';
     </script>
     <?php
    }
    
}
if(isset($_POST['changeImg']))
{
$imageHash= uniqid().md5($_FILES['cat_img']['name']);
$image    = $_FILES['cat_img']['name'];
$tmp      = $_FILES['cat_img']['tmp_name'];
$path     = 'images/logo/';
move_uploaded_file($tmp,$path.$imageHash);
$query    = mysqli_query($conn,"UPDATE vendor SET v_img='$imageHash' WHERE v_ID='$vendor_id'");//v_id =1 test
if($query)
    {
     ?>
     <script type="text/javascript">
      window.location.href='pages-profile.php';
     </script>
     <?php
    }
    
    
}
if(isset($_POST['changePass']))
{
    $oldPass           = $result['v_Pass'];
    $your_pass         = sha1($_POST['your_password']);
    $newPassword       = $_POST['new_password'];
    $confirmPassword   = $_POST['confirm_password'];
    if($oldPass==$your_pass)
    {
        if($newPassword==$confirmPassword)
        {
            $newPassHash    = sha1($newPassword);
            $query          = mysqli_query($conn,"UPDATE vendor SET
                                                 v_Pass = '$newPassHash'
                                                 WHERE v_ID = '$vendor_id'");//v_id =1 test
            if($query)
            {
                $successPass= 'Your password updated successfully';
            }
        }
        else
        {
            $NotMatchError = 'New passord and confirm password does not match';
        }
    }
    else
    {
           $ErrorPass      = 'Your password is not correct';
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
                     <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="images/logo/<?php echo $result['v_img'];?>"
                                        class="rounded" width="150" />
                                    <h4 class="card-title m-t-10 text-capitalize"><?php echo $result['v_Name'];?></h4>
                                    <br><br><hr>
                                </center>
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="custom-file ml-2">
                                              <input type="file" required class="custom-file-input" id="customFile"  name="cat_img">
                                              <span class="custom-file-label" for="customFile">Choose image</span>
                                            </div>
                                        </div>
                                          <div class="form-group">
                                            <div class="col-12"><br>
                                            <input type="submit" name="changeImg" value="Change" class="btn btn-success btn-block">
                                            </div>
                                          </div>     
                                    </form>
                            </div>
                            <div>
                                <hr>
                            </div>
                            <div class="card-body">
                                <h6>Change password here</h6>
                                 <form class="form-horizontal form-material" method="post" action="">
                                    <div class="form-group">
                                        <label class="col-md-12">Your Password</label>
                                        <div class="col-md-12">
                                            <input required type="password" 
                                                class="form-control form-control-line" name="your_password">
                                        </div>
                                    </div>
                                    <?php if(isset($ErrorPass))
                                    {
                                      echo "<div class='alert alert-warning alert-dismissible'>";
                                      echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                      echo "<strong>Warning! </strong>$ErrorPass</div>"  ;
                                    }?>
                                    <div class="form-group">
                                        <label class="col-md-12">New Password</label>
                                        <div class="col-md-12">
                                            <input required type="password" 
                                                class="form-control form-control-line" name="new_password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Confirm New Password</label>
                                        <div class="col-md-12">
                                            <input required type="password" 
                                                class="form-control form-control-line" name="confirm_password">
                                        </div>
                                    </div>
                                    <?php if(isset($NotMatchError))
                                    {
                                      echo "<div class='alert alert-warning alert-dismissible'>";
                                      echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                      echo "<strong>Warning! </strong>$NotMatchError</div>"  ;
                                    }
                                     ?>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" name="changePass" class="btn btn-success btn-block" value="Change Password">
                                        </div>
                                    </div>
                                 </form>
                                <br />
                                <?php
                                if(isset($successPass))
                                {
                                    echo "<div class='alert alert-success alert-dismissible'>";
                                    echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                                    echo "<strong>Success! </strong>$successPass</div>"  ;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method="post" action="">
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" value="<?php echo $result['v_Name'];?>"
                                                class="form-control form-control-line" name="name"> 
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="example-email" class="col-md-12">Email</label>
                                        <div class="col-md-12">
                                            <input type="email" value="<?php echo $result['v_Email'];?>"
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
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
            </div>
            <?php  include("includes/footer.php");?>
     <script>
        $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });        
    </script>