<?php
session_start();
include("../connection.php");
if(isset($_POST['submit']))
{
 $email=$_POST['email'];
 $password=$_POST['pass'];
 $hashedPass=sha1($password);
 $type= $_POST['type'];
 if($type=="vendor")
 {
 $query=mysqli_query($conn,"SELECT * FROM vendor WHERE v_Email = '$email'");
 if(mysqli_num_rows($query)>0)
 {
  $result=mysqli_fetch_assoc($query);
  if($result['v_Pass']==$hashedPass)
  {
   $_SESSION['vendor_id']=$result['v_ID'];
   header("location:../../dashboard.php");
  }
  else{
   $passError="Your password is not correct , try again";
  }
 }
 else {
  $error = "You are not a member , please register ";
 }
}
elseif($type=="customer") {
 $query=mysqli_query($conn,"SELECT * FROM customer WHERE c_Email = '$email'");
 if(mysqli_num_rows($query)>0)
 {
  $result=mysqli_fetch_assoc($query);
  if($result['c_Pass']==$hashedPass)
  {
   $_SESSION['customer_id']=$result['c_ID'];
   header("location:../../../public/index.php");
   
  }
  else{
   $passError="Your password is not correct , try again";
  }
 }
 else {
  $error = "You are not a member , please register ";
 }
}
}
?>

<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8">
    <title>Login</title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="icon"  sizes="16x16" href="../../../logo.jpg">
<style>
 body{
    margin: 20px;
    padding:30px;
    font-family:'FontAwesome';
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #3e5569;
    text-align: left;
    background-color: #eef5f9;}
    #vendor{display:none;}
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
                    <p>Sign In</p>
                </div>
                <div class="card-body">

                 
                 
                    <form action="" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            
                            <div class="input-group input-group-merge">
                                <input id="email" name="email" type="email" required="" class="form-control" placeholder="Your Email">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                    </div>
                                    
                                </div>
                            </div>
                                                         
                        </div>
                        <div class="form-group">
                            <div class="input-group input-group-merge">
                                <input name="pass" id="password" type="password" required="" class="form-control" placeholder="Choose a password">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <span class="fa fa-key"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if(isset($passError)) {
                     echo "<div class='alert alert-danger alert-dismissible'>";
                     echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                     echo "<strong>Warning! </strong>$passError</div>" ;
                    }
                    ?>
                        <div class="form-group">
                       <div class="custom-control custom-radio" id="imVendor">
                         <input type="radio" class="custom-control-input sr-only" value="vendor" id="customRadio1" name="type" required>
                         <label class="custom-control-label" for="customRadio1">Vendor</label>
                       </div>
                       
                       
                       <div class="custom-control custom-radio" id="imCustomer">
                         <input type="radio" class="custom-control-input sr-only" value="customer" id="customRadio2" name="type" required >
                         <label class="custom-control-label" for="customRadio2">Customer</label>
                       </div>
                        </div>
                      <button type="submit" name="submit" class="btn btn-dark  col-12 mb-3">Login</button>
                        <div class="form-group text-center mb-0">
                            <div class="custom-control custom-checkbox">
                                                            </div>
                        </div>
                    </form>
                   
                </div>
                 <?php if(isset($error)) {
                     echo "<div class='alert alert-warning alert-dismissible'>";
                     echo "<button type='button' class='close' data-dismiss='alert'>&times;</button>";
                     echo "<strong>Warning! </strong>$error</div>" ;
                    }
                    ?>
                <div class="card-footer text-center text-black-50">Not yet a member? <a href="register.php">Sign Up</a></div>
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
  });
});
$(document).ready(function(){
  $("#imCustomer").click(function(){
    $("#vendor").fadeOut("3000");
  });
});

</script>




</body>

</html>