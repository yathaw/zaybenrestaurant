<?php  
	require 'db_connect.php';

	$id=$_POST['id'];
	$name=$_POST['name'];

	$sql="UPDATE categories SET name=:name  WHERE id=:id ";
	
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':name',$name);
	$stmt->execute();

	if($stmt->rowCount())
	{
		header("location:category_list");
	}
	else
	{
		echo "Error!";
	}
 ?>