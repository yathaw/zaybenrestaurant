<?php  
	require 'db_connect.php';

	$id=$_POST['id'];
	$newImage=$_FILES['newImage'];
	$name=$_POST['name'];
	$price=$_POST['price'];
	$categoryid=$_POST['categoryid'];
	$description=$_POST['description'];
	$oldImage = $_POST['oldImage'];

	// if we have new photo 
	if($newImage['name'])
	{
   		// create a file path for new photo
   	  	$file_path='image/item/'.$newImage['name'];
   		
   		// upload new photo
 		move_uploaded_file($newImage['tmp_name'], $file_path);

		// delete old photo
      	unlink($oldImage);
   	}
   	else
   	{
   		$file_path = $oldImage;
   	}

	$sql="UPDATE items SET name=:name, price=:price, description=:description, photo=:photo, category_id=:category_id  WHERE id=:id ";
	
	$stmt=$pdo->prepare($sql);
	$stmt->bindParam(':id',$id);
	$stmt->bindParam(':name',$name);
	$stmt->bindParam(':price',$price);
	$stmt->bindParam(':description',$description);
	$stmt->bindParam(':photo',$file_path);
	$stmt->bindParam(':category_id',$categoryid);

	$stmt->execute();

	if($stmt->rowCount())
	{
		header("location:item_list");
	}
	else
	{
		echo "Error!";
	}
 ?>