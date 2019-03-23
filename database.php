<?php 

	$user = "root";
	$pass = "";
	$host = 'mysql:host=localhost;dbname=loginfazt';;

	try {

		$conex = new PDO($host,$user,$pass);			
	} catch (PDOException $e) {
		die('Connection failed: '. $e->getMessage());		
	}		
?>