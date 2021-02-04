<?php
session_start();

include_once("connection.php");
//   if(isset($_SESSION['customer_id']))
//   {
////		$customer_id           = $_SESSION['customer_id'];
////		$select_header_info    = mysqli_query($conn,"SELECT * FROM customer WHERE c_ID = '$customer_id'");
////		if(mysqli_num_rows($select_header_info)<1)
////		{
////		 header("location:includes/logout.php");
//		}
//	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title><?php
    $page=$_SERVER['PHP_SELF'];
    $page= substr($page, strrpos($page, '/') + 1);
   echo $page= substr($page,0,strrpos($page, '.'));
    
     ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">      
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>
		
		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
		
		<link rel="icon"  sizes="16x16" href="../logo.jpg"> 
		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>			
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
		<style>
			#phoneIcon{
                animation:phone 5s infinite linear;
			}
			@keyframes phone {
				0%   {transform: rotate(0deg);}
				25%  {transform: rotate(-20deg);}
				50%  {transform: rotate(-80deg);}
				80% {transform: rotate(-20deg);}
				100% {transform: rotate(-80deg);}
			  }
			  #image{
				height: 200px;
			   border-radius:50%;
			  }
			.productimage
			{
				height:250px;
				width:230px;
			}
			
		</style>
	</head>
    <body>		
		<div id="top-bar" class="container">
			<div class="row" id="contact_info">
				<?php
				 $admin_info=mysqli_query($conn,"SELECT * FROM admin");
                 if(mysqli_num_rows($admin_info)>0)
                 {
				  $fetch_admin=mysqli_fetch_assoc($admin_info);
                 
				?> 
				 <div class="span2">
					 <i class="fas fa-phone text-info" id="phoneIcon"></i> <?php echo $fetch_admin['mobile'];?>
				</div>
				<div class="span2">
					<i class="fas fa-envelope-square text-info"></i> <?php echo $fetch_admin['Admin_Email'];?>
				</div>
				<?php }?>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">				
							<li><a href="cart.php" class=" text-info">Your Cart <span class="badge badge-warning">
								<?php 
								if(isset($_SESSION['item']))
								{
									echo count($_SESSION['item']);
								}
								else
								{
									echo "0";
								}
							?>
							</span></a></li>
							 <span id="logout"><li><a href="includes/logout.php"  class=" text-info" >Logout <i class="fas fa-sign-out-alt"></i></a></li></span>
							<span id="login"><li><a href="../vendor/includes/login/login.php" class=" text-info">Login <i class="fas fa-sign-in-alt"></i></a></li></span>
							<span id="orders"><li><a href="orders.php" class="text-info">Orders <i class="fas fa-table"></i></a></li></span>
						    <span id="profile"><li><a href="profile.php" class="text-info">Profile <i class="fas fa-user"></i></a></li></span>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="navbar-inner main-menu">				
					<a href="index.php" style="font-size:20px;">Multi Vendor E-Commerce</a>
					<nav id="menu" class="pull-right">
						<ul>
							<?php
							$category=mysqli_query($conn,"SELECT * FROM category");
							while($fetch_category=mysqli_fetch_assoc($category))
							{$catID=strtr(base64_encode($fetch_category['Cat_ID']), '+/=', '-_,');
								echo "<li><a href='products.php?i=".$catID."'>{$fetch_category['Cat_Name']}</a></li>";
							}
							?>
						  </ul>
					</nav>
				</div>
			</section>
			<script>
				<?php
				if(isset($_SESSION['customer_id']))
				{
					?>
					document.getElementById("login").style.display="none";
					<?php
				}
				else{
					?>
					document.getElementById("logout").style.display="none";
					document.getElementById("orders").style.display="none";
					document.getElementById("profile").style.display="none";
					<?php 
				}
				?>
			</script>