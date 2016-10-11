<?php  
$con = mysqli_connect("localhost","root","","crackers");
if (mysqli_connect_errno()) {
	echo "Failed to connect to database".mysqli_connect_error();
}
//ip address
function getIp(){
	if (getenv('HTTP_CLIENT_IP'))
		$ip = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ip = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ip = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ip = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ip = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ip = getenv('REMOTE_ADDR');
	else
		$ip = 'UNKNOWN';
	return $ip;
}
//shopping cart
function cart(){
	if (isset($_GET['add_cart'])) {
		global $con ;
		$ip = getIp();
		$pro_id = $_GET['add_cart'];

		
		$check_pro = "SELECT * FROM cart WHERE ip_add='$ip' AND p_id ='$pro_id'";
		
		$run_check = mysqli_query($con,$check_pro);

		if (mysqli_num_rows($run_check) > 0) {
			echo "" ;
		}else{
			$insert_pro = "INSERT INTO cart(p_id,ip_add) VALUES('$pro_id','$ip')" ;
			$run_pro = mysqli_query($con,$insert_pro);

			echo "<script>window.open('index.php','_self')</script>";
		}
		
	}
}
//getting total added items
 function total_items(){
 
	if(isset($_GET['add_cart'])){
	
		global $con; 
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_add='$ip'";
		
		$run_items = mysqli_query($con, $get_items); 
		
		$count_items = mysqli_num_rows($run_items);
		
		}
		
		else {
		
		global $con; 
		
		$ip = getIp(); 
		
		$get_items = "select * from cart where ip_add='$ip'";
		
		$run_items = mysqli_query($con, $get_items); 
		
		$count_items = mysqli_num_rows($run_items);
		
		}
	
	echo $count_items;
	}


// Getting the total price of the items in the cart 

function total_price(){
	
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
			
			$values = array_sum($product_price);
			
			$total +=$values;
			
		}
		
		
	}

	echo "$" . $total;

	
}


//getting categories
function getCats(){
	global $con ;
	$get_cats = "SELECT * FROM categories";
	$run_cats = mysqli_query($con,$get_cats);

	while($row_cats = mysqli_fetch_array($run_cats)){
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}

function getBrands(){
	global $con ;
	$get_brands = "SELECT * FROM brands";
	$run_brands = mysqli_query($con,$get_brands);

	while($row_brands = mysqli_fetch_array($run_brands)){
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];

		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}
function getCatPro(){

	if(isset($_GET['cat'])){
		
		$cat_id = $_GET['cat'];

		global $con; 

		$get_cat_pro = "select * from products where product_cat='$cat_id'";

		$run_cat_pro = mysqli_query($con, $get_cat_pro); 

		$count_cats = mysqli_num_rows($run_cat_pro);

		if($count_cats==0){

			echo "<h2 class='header center'>No products where found in this category!</h2>";

		}

		while($row_cat_pro=mysqli_fetch_array($run_cat_pro)){

			$pro_id = $row_cat_pro['product_id'];
			$pro_cat = $row_cat_pro['product_cat'];
			$pro_brand = $row_cat_pro['product_brand'];
			$pro_title = $row_cat_pro['product_title'];
			$pro_price = $row_cat_pro['product_price'];
			$pro_image = $row_cat_pro['product_image'];
			$pro_desc = $row_cat_pro['product_desc'];

			echo "


			<div class='icon-block'>

				<div class='col s12 m4'>
					<div class='icon-block'>
						<div class='card hoverable'>
							<div class='card-image waves-effect waves-block waves-light ''>
								<img class='activator' src='$pro_image' id='front_page_img'>
							</div>
							<div class='card-content'>
								<span class='card-title activator grey-text text-darken-4'>$pro_title<i class='material-icons right'>more_vert</i></span>
								<p><a href='index.php?add_cart=<?='$product_id'><i class='large material-icons left'>shopping_cart</i>Add to cart</a></p>
							</div>
							<div class='card-reveal'>
								<span class='card-title grey-text text-darken-4'>$pro_title<i class='material-icons right'>close</i></span>
								<p class='flow-text'>$pro_desc</p>
								<p class='flow-text'><b>Manufactured By: </b>$pro_brand</p>
								<p class='flow-text'><b>Category: </b>$pro_cat</p>
								<p class='flow-text'><b>Our Price: </b>$pro_price</p>
								<a href='index.php?add_cart=<?='$product_id' class='btn waves-effect waves-light'><i class='small material-icons left'>shopping_basket</i>Add to cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>

			";


		}

	}

}


function getBrandPro(){

	if(isset($_GET['brand'])){

		$brand_id = $_GET['brand'];

		global $con; 

		$get_brand_pro = "select * from products where product_brand='$brand_id'";

		$run_brand_pro = mysqli_query($con, $get_brand_pro); 

		$count_brands = mysqli_num_rows($run_brand_pro);

		if($count_brands==0){

			echo "
			<div class='icon-block' style='margin-top:auto'>

				<div class='col s12 m4'>
					<div class='icon-block'>
						<div class='valign-wrapper'>
							<h2 class='header center valign'>No products where found associated with this brand!!</h2>
						</div>
					</div>
				</div>
				"
				;

			}

			while($row_brand_pro=mysqli_fetch_array($run_brand_pro)){

				$pro_id = $row_brand_pro['product_id'];
				$pro_cat = $row_brand_pro['product_cat'];
				$pro_brand = $row_brand_pro['product_brand'];
				$pro_title = $row_brand_pro['product_title'];
				$pro_price = $row_brand_pro['product_price'];
				$pro_image = $row_brand_pro['product_image'];
				$pro_desc = $row_brand_pro['product_desc'];

				echo "


				<div class='icon-block'>

					<div class='col s12 m4'>
						<div class='icon-block'>
							<div class='card hoverable'>
								<div class='card-image waves-effect waves-block waves-light ''>
									<img class='activator' src='$pro_image' id='front_page_img'>
								</div>
								<div class='card-content'>
									<span class='card-title activator grey-text text-darken-4'>$pro_title<i class='material-icons right'>more_vert</i></span>
									<p><a 'index.php?add_cart=<?='$product_id'><i class='large material-icons left'>shopping_cart</i>Add to cart</a></p>
								</div>
								<div class='card-reveal'>
									<span class='card-title grey-text text-darken-4'>$pro_title<i class='material-icons right'>close</i></span>
									<p class='flow-text'>$pro_desc</p>
									<p class='flow-text'><b>Manufactured By: </b>$pro_brand</p>
									<p class='flow-text'><b>Category: </b>$pro_cat</p>
									<p class='flow-text'><b>Our Price: </b>$pro_price</p>
									<a 'index.php?add_cart=<?='$product_id' class='btn waves-effect waves-light'><i class='small material-icons left'>shopping_basket</i>Add to cart</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				";
			}

		}
	}

	?>
