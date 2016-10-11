<!DOCTYPE html>
<?php 
include 'includes/db.php';
define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/crackers/');
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
	<title>CrackersMart</title>

	<!-- CSS  -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
	<link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
	<h2 class=" header center orange-text">Add products to database</h2>
	<div class="container">
		<div class="row">
			<form class="col s12" action="insert_product.php" method="POST" enctype="multipart/form-data">
				<div class="row">
					<div class="input-field col s4">
						<input id="product_title" type="text" name="product_title" class="validate" required>
						<label for="product_title">Product Title</label>
					</div>
					<div class="input-field col s4">
						<select name="product_brand" required>
							<option value="" disabled selected>Choose your option</option>
							<?php 
							
							$get_brands = "SELECT * FROM brands";
							$run_brands = mysqli_query($con,$get_brands);

							while($row_brands = mysqli_fetch_array($run_brands)){
								$brand_id = $row_brands['brand_id'];
								$brand_title = $row_brands['brand_title'];

								echo "<option value='$brand_id'>$brand_title</option>";
							}

							?>
						</select>
						<label>Select your Brand</label>
					</div>
					<div class="input-field col s4">
						<select name="product_cat" required>
							<option value="" disabled selected>Choose your option</option>
							<?php 

							$get_cats = "SELECT * FROM categories";
							$run_cats = mysqli_query($con,$get_cats);

							while($row_cats = mysqli_fetch_array($run_cats)){
								$cat_id = $row_cats['cat_id'];
								$cat_title = $row_cats['cat_title'];

								echo "<option value='$cat_id'>$cat_title</option>";
							}
							?>
						</select>
						<label>Select Category</label>
					</div>

					<div class="input-field col s4">
						<input id="product_price" type="text" name="product_price" class="validate" required>
						<label for="product_price">Product Price</label>
					</div>

					<div class="input-field col s4">
						<input id="product_keywords" type="text" name="product_keywords" class="validate" required>
						<label for="product_keywords">Product Keyword</label>
					</div>
				</div>



				<div class="input-field col s4">
					<textarea id="product_description" name="product_description" class="validate materialize-textarea"></textarea>
					<label for="product_description">Product Description</label>
				</div>
				<br>
					<p>Product Photo Upload:</p>
					<input type="file" name="photo" id="photo" >
				<br>
				<div class="input-field col s6">
					<label for="submit"></label>
					<button class="btn waves-effect waves-light" type="submit" name="submit" id="submit">Submit
						<i class="material-icons right">send</i>
					</button>

				</div>
			</form>
		</div>
	</div>

	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>           
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
	<script>
		$(document).ready(function() {
			$('select').material_select();
		});
	</script>
	</html>

	<?php

	if (isset($_POST['submit'])) {
		
		$product_title = $_POST['product_title'];
		$product_cat = $_POST['product_cat'];
		$product_brand = $_POST['product_brand'];
		$product_price = $_POST['product_price'];		
		$product_description = $_POST['product_description'];
		$product_keywords = $_POST['product_keywords'];

		
		// $product_image = $_FILES['photo']['name'];
		// $product_image_tmp = $_FILES['photo']['tmp_name'];

		$dbpath='';
		$photo = $_FILES['photo'];
		$name = $photo['name'];
		$nameArray = explode('.', $name);
		$fileName = $nameArray[0];
		$fileExt = $nameArray[1];
		$mime = explode('/', $photo['type']);
		$mimeType = $mime['0'];
		$mimeExt = $mime['1'];
		$tmpLoc = $photo['tmp_name'];
		$fileSize = $photo['size'];
		$allowed = array('png','jpeg','jpg');
		
		$uploadName = md5(microtime()).'.'.$fileExt;
		$dbpath = '/crackers/images/products/'.$uploadName;
		$uploadPath = BASEURL.'images/products/'.$uploadName;
		move_uploaded_file($tmpLoc,$uploadPath );
		//move_uploaded_file($product_image_tmp, "../images/products$product_image");

		$sql = "INSERT INTO `products`(`product_cat`,`product_brand`,`product_title`,`product_price`,`product_desc`,`product_image`,`product_keywords`) 
		VALUES('$product_cat','$product_brand','$product_title','$product_price','$product_description','$dbpath','$product_keywords')";

		$insert_pro = mysqli_query($con,$sql);

		if ($insert_pro) {
			echo "<script>alert('product has been added to database')</script>";
			echo "<script>window.open('insert_product.php','_self')</script>";
		}

	}

	?>