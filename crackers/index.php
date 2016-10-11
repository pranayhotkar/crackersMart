<!DOCTYPE html>
<?php
include 'functions/functions.php';



		//$pro_id = $row_pro['product_id'];

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
		
	</style>
</head>
<body>
<?php include'includes/navbar.php'?>


	<div class="container">


		<div class="section">
			
			<!--   Icon Section   -->
			<div class="row">
				<?php  
				if (!(isset($_GET['cat']))) {
					if (!(isset($_GET['brand']))) {
						

						$get_pro = "SELECT * FROM products ORDER BY RAND() LIMIT 0,6";
						$product = mysqli_query($con,$get_pro);
						while ($row_pro = mysqli_fetch_assoc($product)) :?>
						<div class="col s12 m4">
							<div class="icon-block">


								<div class="card hoverable">
									<div class="card-image waves-effect waves-block waves-light ">
										<img class="activator" src="<?=$row_pro['product_image'];?>" id="front_page_img">
									</div>
									<div class="card-content">
									<span class="card-title activator grey-text text-darken-4"><?=$row_pro['product_title'];?><i class="material-icons right">more_vert</i></span><!-- 
									href="index.php?pro_id=<?=$row_pro['product_id']?>"  -->
									<p><a href="index.php?add_cart=<?=$row_pro['product_id'];?>"><i class="large material-icons left">shopping_cart</i>Add to cart</a></p>
								</div>
								<div class="card-reveal">
									<span class="card-title grey-text text-darken-4"><?=$row_pro['product_title'];?><i class="material-icons right">close</i></span>
									<p class="flow-text"><?=$row_pro['product_desc'];?></p>
									<p class="flow-text"><b>Manufactured By: </b><?=$row_pro['product_brand'];?></p>
									<p class="flow-text"><b>Category: </b><?=$row_pro['product_cat'];?></p>
									<p class="flow-text"><b>Our Price: </b><?=$row_pro['product_price'];?></p>
									<a href="index.php?add_cart=<?=$row_pro['product_id'];?>" class="btn waves-effect waves-light"><i class="small material-icons left">shopping_basket</i>Add to cart</a>
								</div>
								<div id="modal1" class="modal">
									<div class="modal-content">
										<h4 class="header center">PRODUCT ADDED TO CART</h4>
										
									</div>
									<div class="modal-footer">
										<a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Okay</a>
									</div>
								</div>
							</div>


						</div>
					</div>	
				<?php endwhile;
			}
		}
		getBrandPro();
		getCatPro();
		cart();
		?>
	</div>

</div>
<br><br>

<div class="section">

</div>
</div>

<?php include'includes/footer.php' ?>


<!--  Scripts-->
<script>
	$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});
</script>  

</body>
</html>
