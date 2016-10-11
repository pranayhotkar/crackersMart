<!DOCTYPE html>
<?php
include 'functions/functions.php';
session_start();


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
	</style>
</head>
<body>
	<?php include'includes/navbar.php' ?>

	<nav class="light-blue lighten-4" id="header-text">
		<div class="nav-wrapper container center-align"><a id="logo-container" href="index.php" id="a" class="brand-logo">Your Shopping Cart<i class="medium material-icons right">shopping_cart</i></a>
		</nav>
		<div class="container"> 

			<table class="centered">
				<form>
					<thead>
						<tr>
							<th class="col s2"><h5>Remove Items</h5></th>
							<th class="col s4"><h5>Product(s)</h5></th>
							<th class="col s2"><h5>Quantity</h5></th>
							<th class="col s2"><h5>Price</h5></th>
						</tr>
					</thead>
					<?php
					$total = 0;

					global $con; 

					$ip = getIp(); 

					$sel_price = "select * from cart where ip_add='$ip'";

					$run_price = mysqli_query($con, $sel_price); 

					while($p_price=mysqli_fetch_array($run_price)){

						$pro_id = $p_price['p_id']; 

						$pro_price = "select * from products where product_id='$pro_id'";

						$run_pro_price = mysqli_query($con,$pro_price); 

						while ($pp_price = mysqli_fetch_array($run_pro_price)){

							$product_price = array($pp_price['product_price']);
							$product_title = $pp_price['product_title'];
							$product_image = $pp_price['product_image'];
							$single_price = $pp_price['product_price'];
							$values = array_sum($product_price);
							$total += $values ;

							?>
							<tbody>
								<tr>
									<td class="col s2"><p>
										<!-- <button class="btn waves-effect waves-light blue" name="delete" value="">Delete Item</button> -->
										<a href="cart.php?delete=<?=$pro_id?>" class="btn waves-effect waves-light blue">Delete Item</a>
									</p></td>
									<td class="col s4"><?=$product_title; ?><br><img width="100px" height="200px" src="<?=$product_image;?>"></td>
									<td class="col s2">
										
										<div class="input-field col s2">
											<input placeholder="enter quantity(number of boxes)" name="qty" id="first_name" type="text" class="validate" value="">
											<label for="first_name">Quantity</label>
										</div>
										<p class="blue-text"></p>
										
									</td>
									<?php 
									global $con;
									if (isset($_POST['update_cart'])) {
										$qty = (int) $_POST['qty'];
										$updateQuery = "UPDATE `cart` SET `quantity`='$qty'";
										$run_qty = mysqli_query($con,$updateQuery);
										$_SESSION['qty'] =$qty; 

										$total = $total * $qty ;
										if($run_qty){
											header('Location: cart.php');
										}
									}
									?>
									<td class="orange-text header col s2"><h5><?= $single_price;?></h5></td>
								</tr>

								<?php }}?>
								<br>
								<tr align="right">
									<td colspan="-2"><h4 class="blue-text">Total Amount: </h4></td>
									<td><h4 class="blue-text"><?php echo"Rs".$total ?></h4></td>
									<td><button class="btn waves-effect waves-light blue btn-large" type="submit" name="update_cart">Update Cart

									</button>
								</button></td>
								<td><button class="btn waves-effect waves-light blue btn-large" type="" name="continue">Continue Shopping

								</button>
							</td>
							<td>
								<a href="checkout.php"  class="btn waves-effect waves-light blue btn-large">Checkout<i class="material-icons right">shopping_cart</i></a>
							</td>
						</tr>
					</tbody>
				</form>
				<?php
				$ip = getIp();
				if (isset($_GET['delete']) && !empty($_GET['delete'])) {

					$delete_id = (int)$_GET['delete'];
					$delete_product = "delete from cart where p_id='$delete_id'";
					$run_delete = mysqli_query($con, $delete_product);

					if ($run_delete) {
						echo "<script>window.open('cart.php','_self')</script>";
					}

				}
				if (isset($_POST['continue'])) {
					header('Location: index.php');
				}

				?>
			</table>
		</div>
		<!--   Icon Section   -->


		<?php include'includes/footer.php' ?>

	</body>
	</html>
