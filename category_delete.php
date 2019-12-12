<?php 
	require 'db_connect.php';
		 
	$id=$_REQUEST['id'];
	$sql='DELETE FROM categories where id=:id ';

	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->execute();

	if($stmt->rowCount()){
 		header("location:category_list");
 	}
 	else{
 		echo "Error!";
 	}
	
?>