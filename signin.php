<?php

	require 'db_connect.php';
	$email=$_POST['email'];
	$password=sha1($_POST['password']);
	
	$sql="SELECT * from users where email=:email and password=:password";	

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":password", $password);
	$stmt->execute() or die(print_r($stmt->errorInfo(),true));

	session_start();


	if ($stmt->rowCount()) 
	{
		$rows=$stmt->fetchAll();

		$row = $rows[0];

		$_SESSION['loginuser']=$row;


		if($row['role']=="admin")
		{
			header("location:dashboard");
		}
		else
		{
			header("location:index");
		}

	}
	else
	{
		//invalid email and password
		$_SESSION['login_reject']="Email and Password is not invalid";

		header("location:login");
	}
	
?>