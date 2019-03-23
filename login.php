<?php 

	session_start();
	if (isset($_SESSION['name']) && isset($_SESSION['sn'])) {
		header('location:index.php');
	}


?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>LOGIN</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
</head>
<body>
	<?php require "partials/header.php";?>
	<main style=" margin-bottom:15%; " class="container mt-5">

		<div class="border border-grey w-50 m-auto p-4 rounded">
			<form action="login.php" method="POST">
				<h1 class="text-center">Login</h1>
				<?php 
					if (isset($_GET['m'])) {
				?>
						<p class="text-muted"><?php echo $_GET['m']; ?></p>
				<?php
					}
				?>
				<input class="form-control" type="text" name="usuario" value="" placeholder="Usuario o email">
				
				<input class="form-control mt-3" type="password" name="pass" value="" placeholder="Password">
				
				<button type="submit" class="btn btn-success mt-3 btn-block">Ingresar</button>
			</form>
			<div class="d-flex justify-content-between">
				<a class="text-left mt-2 d-inline-block" href="index.php" title="">Volver</a>
				<a class="text-right mt-2 d-inline-block" href="signup.php" title="">Registrarse</a>
			</div>
		</div>
		
	</main>
</body>
</html>

<?php 
	
	require 'database.php';

	if ($_POST) {
		$usu = $_POST['usuario'];
		$pass = $_POST['pass'];

		if (!empty($usu) && !empty($pass)) {
		
			$sql = 'SELECT * FROM usuarios WHERE usuario = ?';
			$query = $conex ->prepare($sql);
			$query ->execute(array($usu));
			$queryFetch = $query->fetch();

			if (!$queryFetch) {
				$message = "The credentials doesnt match.";
				header("location:login.php?m=$message");
			}elseif(!password_verify($pass,$queryFetch[2])){
				$message = "The credentials doesnt match.";
				header("location:login.php?m=$message");
			}else{

				session_start();

				$_SESSION['id'] = $queryFetch[0];
				$_SESSION['sn'] = 7778899;
				$_SESSION['name'] = $usu;

				header('location:index.php');
			}
		
		}else{
			$message = "Pleas fill all the fields";
			header("location:login.php?m=$message");
		}

	}

?>