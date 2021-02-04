
<?php
include("includes/connection.php");
if(isset($_POST['submit']))
{
    $vID=$_GET['id'];
    $vID=base64_decode(strtr($vID, '-_,', '+/='));
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    if($password==$confirm_password)
    { $hashedPass=sha1($password);
       
        $query=mysqli_query($conn,"UPDATE vendor SET
                                  v_Pass = '$hashedPass'
                                  WHERE v_ID = '$vID'");
        header("location:vendor/includes/login/login.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            continue
        </title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body class="bg-light">
        <div class="container mt-5 p-5">
            <center>
            <h3>Multi-Vendor E-Commerce</h3>
            <p>To Continue</p>
            </center> 
        <div>
           
           <form method="post" class="m-5 ">
            <div class="form-group">
              <label for="pass">Password:</label>
              <input type="password" name="password" class="form-control" placeholder="Enter Password" id="pass" required >
            </div>
            <div class="form-group">
              <label for="pwd">Confirm Password:</label>
              <input type="password" name="confirm_password" class="form-control" placeholder="Confirm password" id="pwd" required >
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
        
        </div>
    </body>
</html>