<?php 
	require 'db_connect.php';
		 
	$id=$_GET['id'];
	$sql='DELETE FROM items where id=:id ';

	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->execute();

	if($stmt->rowCount()){
 		header("location:item_list");
 	}
 	else{
 		echo "Error!";
 	}
	
?>