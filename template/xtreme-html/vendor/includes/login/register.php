<?php
include("../connection.php");
if(isset($_POST['submit']))
{
 $name         = $_POST['name'];
 $email        = $_POST['email'];
 $type         = $_POST['type'];
 $password     = $_POST['pass'];
 $c_password   = $_POST['c_pass'];
 $mobile       = $_POST['mobile'];
 $query    = mysqli_query($conn,"SELECT v_ID FROM vendor WHERE v_Email = '$email'");
 $query2   = mysqli_query($conn,"SELECT c_ID FROM customer WHERE c_Email = '$email'");
  if(mysqli_num_rows($query)>0 || mysqli_num_rows($query2)>0)
  {
    $emailExist = 'This email is already exist';
  }
  elseif($password!=$c_password)
  {
    $Not_Match  = 'Password and confirm_password does not match';
  }
  else{
   $passwordHash = sha1($password);
   if($type == "vendor")
   {
    $logoHash= md5($_FILES['logo']['name']);
    $logo    = $_FILES['logo']['name'];
    $tmp     = $_FILES['logo']['tmp_name'];
    $path    = "../../images/logo/";
    move_uploaded_file($tmp,$path.$logoHash);
    $category= $_POST['category'];
    $requsetQuery = mysqli_query($conn,"INSERT into vendor_requist(vendor_name,v_email,category,logo,mobile)
                                        VALUES('$name','$email','$category','$logoHash','$mobile')");
    $wait_msg = "Please wait for an email to inform you if you are approved to join our vendors team ";
   }
   elseif($type == "customer")
   {
    $Add_Customer_Query=mysqli_query($conn,"INSERT INTO customer(c_Name,c_Email,c_Pass,mobile)
                                            VALUES('$name','$email','$passwordHash','$mobile')");
    if($query)
    {
      $Msg_Customer='you have been added successfully';
    }
   }
  }
}
?>
<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8">
    <title>Register</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="icon"  sizes="16x16" href="../../../logo.jpg">
<style>
 body{
     margin: 0px;
    font-family:'FontAwesome';
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #3e5569;
    text-align: left;
    background-color: #eef5f9;}
    #vendor{display:none;}
    #pass{display:none;}
</style>



</head>

<body class="login" style="background:#eef5f9;">


    <div class="d-flex align-items-center" >
        <div class="col-sm-8 col-md-6 col-lg-4 mx-auto" >
            <div class="text-center mt-5 mb-1">
             
            </div>
           
            <div class="card ">
                <div class="card-header text-center bg-dark text-light">
                    <h4 class="card-title text-light">Multi Vendor E-Commerce</h4>
                    <p>Register</p>
                </div>
                <div class="card-body">

                 
                 
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                           
                            <div class="input-group input-group-merge">
                                <input id="name" name="name" type="text" required="" class="form-control " placeholder="Your Name">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fa fa-user"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            
                            <div class="input-group input-group-merge">
                                <input id="email" name="email" type="email" required="" class="form-control" placeholder="Your Email">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    
                                </div>
                            </div>
                                <?php
                    if(isset($emailExist))
                    {
                     echo "<div class='alert alert-warning alert-dismissible'>";
                     echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                     echo "<strong>Warning! </strong>$emailExist</div>" ;
                    }
                    ?>                          
                        </div>
                       <div class="form-group">
                       <div class="custom-control custom-radio" id="imVendor">
                         <input type="radio" class="custom-control-input sr-only" value="vendor" id="customRadio1" name="type" required>
                         <label class="custom-control-label" for="customRadio1">Vendor</label>
                       </div>
                       
                       
                       <div class="custom-control custom-radio" id="imCustomer">
                         <input type="radio" class="custom-control-input sr-only" value="customer" id="customRadio2" name="type" required >
                         <label class="custom-control-label" for="customRadio2">Customer</label>
                       </div></div>
                        <div id="vendor" class="bg-light p-3 m-2">
                        <div class="form-group ">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input logo" id="customFile" name="logo">
                          <label class="custom-file-label" for="customFile">Choose Your Logo</label>
                        </div>
                        </div>
                        
                        <div class="form-group">
                          <select name="category" class="custom-select">
                           <option disabled>Select Category</option>
                            <?php
                                  $query=mysqli_query($conn,"SELECT * FROM category");
                                  while($row = mysqli_fetch_assoc($query))
                                  {
                                    echo "<option value='{$row['Cat_ID']}'>{$row['Cat_Name']}</option>";
                                  }?>
                         </select>
                        </div>
                        </div>
                        <div id="pass" class="bg-light p-3 m-2">
                        <div class="form-group">
                            <div class="input-group input-group-merge">
                                <input name="pass" id="password" type="password"  class="form-control" placeholder="Choose a password">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fa fa-key"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                          
                            <div class="input-group input-group-merge">
                                <input name="c_pass" id="password2" type="password" class="form-control " placeholder="Confirm password">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fa fa-key"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                       <?php  if(isset($Not_Match))
                        {
                         echo "<div class='alert alert-warning alert-dismissible'>";
                         echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                         echo "<strong>Warning! </strong>$Not_Match</div>" ;
                        }
                       ?>  
                        <div class="form-group">
                           
                            <div class="input-group input-group-merge">
                                <input id="mobile" name="mobile" type="text" required="" class="form-control"  placeholder="Your Mobile Number">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="media align-items-center mb-3 text-center">
                                                  
                                                  
                      <button type="submit" name="submit" class="btn btn-dark  col-12 mb-3">Sign Up</button>
                        <div class="form-group text-center mb-0">
                            <div class="custom-control custom-checkbox">
                            </div>
                        </div>
                    </form>
                   
                </div>
                    <?php
                    if(isset($Msg_Customer))
                    {
                     echo "<div class='alert alert-success alert-dismissible'>";
                     echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                     echo "<strong>Success! </strong>$Msg_Customer</div>" ;
                    }
                    ?>
                    <?php
                    if(isset($wait_msg))
                    {
                     echo "<div class='alert alert-success alert-dismissible'>";
                     echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                     echo "<strong>info! </strong>$wait_msg</div>" ;
                    }
                    ?>
                <div class="card-footer text-center text-black-50">Already signed up? <a href="login.php">Login</a></div>
            </div>
        </div>
    </div>


    <!-- jQuery -->
    <script src="assets/vendor/jquery.min.js"></script>

    <!-- Bootstrap -->
    <script src="assets/vendor/popper.min.js"></script>
    <script src="assets/vendor/bootstrap.min.js"></script>

    <!-- Perfect Scrollbar -->
    <script src="assets/vendor/perfect-scrollbar.min.js"></script>

    <!-- MDK -->
    <script src="assets/vendor/dom-factory.js"></script>
    <script src="assets/vendor/material-design-kit.js"></script>

    <!-- App JS -->
    <script src="assets/js/app.js"></script>

    <!-- Highlight.js -->
    <script src="assets/js/hljs.js"></script>

    <!-- App Settings (safe to remove) -->
    <script src="assets/js/app-settings.js"></script>
<script>
 $(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
$(document).ready(function(){
  $("#imVendor").click(function(){
    $("#vendor").fadeIn("slow");
    $(".logo").prop('required',true);
    $("#pass").fadeOut("3000");
     $("#password").prop('required',false);
    $("#password2").prop('required',false);
  });
});
$(document).ready(function(){
  $("#imCustomer").click(function(){
    $("#pass").fadeIn("slow");
    $("#password").prop('required',true);
    $("#password2").prop('required',true);
    $("#vendor").fadeOut("3000");
    $(".logo").prop('required',false);
  });
});

</script>




</body>

</html>