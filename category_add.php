<?php 
	
	require 'db_connect.php';

	$name=$_POST['name'];

	$sql="INSERT into categories (name) VALUES(:name)";
	$stmt= $pdo->prepare($sql);
	$stmt->bindParam(':name',$name);
	$stmt->execute();

	if($stmt->rowCount()){
		header("location:category_list");
	}
	else{
		echo " Error !";
	}



?>