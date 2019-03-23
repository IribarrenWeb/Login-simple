<?php 
		
		require "database.php";

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
	<?php 

		require "partials/header.php"; 

	?>
	<main style=" margin-bottom:15%; " class="container mt-5">

		<div class="border border-grey w-50 m-auto p-4 rounded">
			<h1 class="text-center">Signup</h1>

			<?php 

				if (@$_GET) {
			?>
					<h4 class="text-muted text-center"><?php echo $_GET['m']; ?></h4>
			<?php
				}

			 ?>
				
			<form action="signup.php" method="POST">
				<input class="form-control" type="text" name="usuario" value="" placeholder="Usuario o email">
				
				<input class="form-control mt-3" type="password" name="pass" value="" placeholder="Password">
				<input class="form-control mt-3" type="password" name="pass2" value="" placeholder="Re-Password">
				
				<input type="submit" class="btn btn-success mt-3 btn-block" value="Registrar">
			</form>
			<div class="d-flex justify-content-between">
				<a class="text-left mt-2 d-inline-block" href="index.php" title="">Return</a>
				<a class="text-right mt-2 d-inline-block" href="login.php" title="">Login</a>
			</div>
		</div>
		
	</main>
</body>
</html>

<?php 
	

	if ($_POST) {
		if (!empty($_POST['usuario']) AND !empty($_POST['pass']) AND !empty($_POST['pass2'])) {
			$usu = $_POST['usuario'];
			$pass = $_POST['pass'];
			$pass2 = $_POST['pass2'];

			$sql="SELECT * FROM usuarios WHERE usuario=?";
			$query = $conex ->prepare($sql);
			$query->execute(array($usu));

			if (!$query->fetch()) {

				if ($pass == $pass2) {
					
					$passh = password_hash($pass, PASSWORD_DEFAULT);

					$sql = "INSERT INTO usuarios (usuario,password) VALUES (\"$usu\",\"$passh\")";

					$result = $conex ->prepare($sql);

					if ($result ->execute()) {
						$message = "Your user was registered successfully";

						header("location: signup.php?m=$message");
					}else{
						$message = "!Oops! An error ocurred with the procces of your user registration.";
						print_r($result->errorInfo()); 

						header("location: signup.php?m=$message");
					}

				}else{
					$message = "The passwords doesnt the same. Please verify.";
					header("location: signup.php?m=$message");
				}
			}else{
				$message = "The user already exist, please choice a diferent username";
				header("location: signup.php?m=$message");
			}
		}else{
			$message = "Sorry you must to complete all the fields.";
			header("location: signup.php?m=$message");
		}
	}	

?>