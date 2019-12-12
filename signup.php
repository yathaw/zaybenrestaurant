<?php

	require 'db_connect.php';
	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$password=sha1($_POST['password']);
	$profile = "image/user/user.png";
	$role = "member";
	

	$sql="INSERT INTO users (name,role,profile,email,password,phone,address) VALUES(:name,:role,:profile,:email,:password,:phone,:address)";
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":name", $name);
	$stmt->bindParam(":role", $role);
	$stmt->bindParam(":profile", $profile);
	$stmt->bindParam(":email", $email);
	$stmt->bindParam(":password", $password);
	$stmt->bindParam(":phone", $phone);
	$stmt->bindParam(":address", $address);
	$stmt->execute() or die(print_r($stmt->errorInfo(),true));
	
	session_start();

	$_SESSION['reg_success']="Thanks! your account has been successfully created and now <b> Signed In. </b>";

	header("location:login.php");
?>