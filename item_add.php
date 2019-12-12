<?php 
	require 'db_connect.php';

	$image=$_FILES['image'];
	$name=$_POST['name'];
	$price=$_POST['price'];
	$categoryid=$_POST['categoryid'];
	$description=$_POST['description'];

	$source_dir="image/item/";
	$file_path=$source_dir.$image['name'];
	move_uploaded_file($image['tmp_name'],$file_path);


	$sql="INSERT into items (name, price, description, photo,category_id) VALUES(:name, :price, :description, :photo, :category_id)";
	$stmt= $pdo->prepare($sql);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':price',$price);
	$stmt->bindParam(':description',$description);
	$stmt->bindParam(':photo',$file_path);
	$stmt->bindParam(':category_id',$categoryid);

	$stmt->execute();

	if($stmt->rowCount()){
		header("location:item_list");
	}
	else{
		echo " Error !";
	}

?>