<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Welcome Login App</title>
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<?php require "partials/header.php"; ?>
	<div class="container">
		<h1 class="text-center mt-4">Welcome to your app</h1><hr>
	<?php 
		if (isset($_SESSION['name']) && $_SESSION['sn'] == 7778899) {
	?>
			<h1 class="mt-3 h4 text-muted text-center">Welcom to your account <?= $_SESSION['name'] ?>.<a href="logout.php" class="h5 text-primary"  title=""> Logout</a></h1><br>
			
	<?php
		}else{
	?>
		<h3 class="mt-3 h4 text-muted text-center">Please if you have an account <a href="login.php" title="">Login</a>, if not, <a href="signup.php" title="">Register</a> to enter in the app.</h3>
	<?php } ?>
	</div>
</body>
</html>