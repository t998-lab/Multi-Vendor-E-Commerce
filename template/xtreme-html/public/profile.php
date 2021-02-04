<?php
include("includes/header.php");
$name="";
$email="";
$mobile="";
    $customer = $_SESSION['customer_id'];
	$query    = mysqli_query($conn,"SELECT * FROM customer WHERE c_ID='$customer'");
    if(mysqli_num_rows($query)>0)
    {
        $customer_info=mysqli_fetch_assoc($query);
        $name=$customer_info['c_Name'];
        $email=$customer_info['c_Email'];
        $mobile=$customer_info['mobile'];
        $password=$customer_info['c_Pass'];
    }


if(isset($_POST['edit_info']))
{
    $new_name=$_POST['name'];
    $new_email=$_POST['email'];
    $new_mobile=$_POST['mobile'];
    $query=mysqli_query($conn,"UPDATE customer SET
                               c_Name  = '$new_name',
                               c_Email = '$new_email',
                               mobile  = '$new_mobile'
                               WHERE c_ID = '$customer'");
    header('location:profile.php');
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
            $query = mysqli_query($conn,"UPDATE customer SET
                                          c_Pass = '$hashanew'
                                          WHERE c_ID = '$customer'");
            
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
<section class="main-content">
				<div class="row">						
					<div class="span6">	
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Your Information</h4>
                                  <form action="" method="post">
                                    <div class="form-group">
                                      <label for="email">Name :</label>
                                      <input type="text" name="name" class="form-control" value="<?php echo $name ;?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="pwd">Email :</label>
                                      <input type="text"  name="email" class="form-control" value="<?php echo $email ;?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="pwd">Mobile :</label>
                                      <input type="text" name="mobile" class="form-control" value="<?php echo $mobile ;?>">
                                    </div>
                                    <button type="submit" name="edit_info" class="btn btn-info">Edit Data</button>
                                </form>
                             </div>
                         </div>
                    </div>
                    <div class="span6">	
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
                                    <button type="submit" name="edit_pass" class="btn btn-info">Edit Password</button>
                                </form>
                             </div>
                         </div>
                    </div>
                </div>
</section>
          
           
                  
                  


<?php
include("includes/footer.php");
?>