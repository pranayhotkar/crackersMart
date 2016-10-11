<!DOCTYPE html>
<?php
session_start();
include 'functions/functions.php';
include 'includes/db.php' ;

?>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>CrackersMart</title>

	<!-- CSS  -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
	<link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
	<style type="text/css">
		#front_page_img{
			width: 200px;
			height: 400px ;
		}
		#header-text{
			padding-top: 0;
			margin-top: -10px;
		}
		#space{
			height: 100px;
		}
		
	</style>
</head>
<body>
	<?php include'includes/navbar.php';?>
	<nav class="light-blue lighten-4" id="header-text">
		<div class="nav-wrapper container center-align"><a id="logo-container" href="index.php" id="a" class="brand-logo">Create a new Account<i class="medium material-icons right">perm_identity</i></a>
		</nav>

		<div class="container">
			<div class="row">
				<div class="col s6">
					<form method="post" action="register.php" enctype="multipart/form-data">
						<table class="">
							<tr>
								<td>
									<div class="input-field col s6">
										<input type="text" name="name" id="name" required>
										<label for="name">Name</label>
									</div>
								</td>
								
							</tr>	
							<tr>
								<td>
									<div class="input-field col s6">
										<input type="text" name="email" id="email" required>
										<label for="email">Email</label>
									</div>
								</td>
								
							</tr>
							<tr>
								<td>
									<div class="input-field col s6">
										<input type="password" name="password" id="password" required>
										<label for="password">Password</label>
									</div>
								</td>
								
							</tr>
							<tr>
								<td>
									<div class="input-field col s6">
										<input type="text" name="phone" id="phone" required>
										<label for="phone">Phone No.</label>
									</div>
								</td>
								
							</tr>
							
							<tr>
								<td>
									<div class="input-field col s6">
										<textarea id="address"  name="address" class="materialize-textarea"></textarea>
										<label for="address">Address</label>
									</div>
								</td>
								
							</tr>
							<tr>
							<td>
								<div class="file-field input-field">
									<div class="btn  light-blue accent-2">
									<span>Image</span>
										<input type="file">
									</div>
									<div class="file-path-wrapper">
										<input class="file-path validate" type="file" name="image">
									</div>
								</div>
								</td>
							</tr>
							<tr>
								<td>
								<button class="btn waves-effect waves-light  light-blue" type="submit" name="register">Create a New Account
									<i class="material-icons right">send</i>
								</button>

							</td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
	</div>

	<div id="space"></div>
	<?php include'includes/footer.php'; ?>

</body>
</html>
<?php
if (isset($_POST['register'])) {
	global $con ;
	$ip = getIp();

	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	

	$image = $_FILES['image']['name'];
	$image_tmp = $_FILES['image']['tmp_name'];

	move_uploaded_file($image_tmp,"customer/customer_images/$image");

	$insert = "INSERT INTO `customers`(`customer_ip`,`customer_name`,`customer_email`,`customer_pass`,`customer_contact`,`customer_address`,`customer_image`) 
		VALUES('$ip','$name','$email','$password','$phone','$address','$image')";

	$run = mysqli_query($con,$insert);
	$sel_cart = "SELECT * FROM cart WHERE ip_add='$ip'";
	$run_cart = mysqli_query($con,$sel_cart);

	$check_cart = mysqli_num_rows($run_cart);

	if ($check_cart == 0) {

		$_SESSION['customer_email'] = $customerEmail ;
		echo "<script>alert('Account has been created successfully.Thanks for registering with us.')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
	}else{
		$_SESSION['customer_email'] = $customerEmail ;
		echo "<script>alert('Account has been created successfully.Thanks for registering with us.')</script>";
		echo "<script>window.open('payment.php','_self')</script>";
	}


}
?>

