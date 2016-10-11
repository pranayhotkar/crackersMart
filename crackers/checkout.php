<!DOCTYPE html>
<?php
session_start();
include 'functions/functions.php';

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
			height: 400px;
		}

	</style>
</head>
<body>
	<?php include'includes/navbar.php';?>
	<?php
	if (!isset($_SESSION['customer_email'])) {
		include'customer_login.php';
	}else
	{
		include'payment.php' ;
	}

	?>
	<div id="space"></div>
	<?php include'includes/footer.php'; ?>
</body>
</html>




