<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	require '../db_connect.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'POST':
			$id=intval($_GET["id"]);
			changepassword($id);
			break;

		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

	function changepassword($id)
	{
		global $pdo;

		$password = sha1($_POST['password']);

		

		$sql="SELECT * FROM users WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$name=$row['name'];
		$phone=$row['phone'];
		$address=$row['address'];
		$email=$row['email'];
		$profile = $row['profile'];
		$role = $row['role'];

		if (!empty($password)) 
		{
			$sql="UPDATE users SET name=:name, role=:role, profile=:profile, email=:email, password=:password, phone=:phone, address=:address  WHERE id=:id ";
	
			$stmt=$pdo->prepare($sql);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':role',$role);
			$stmt->bindParam(':profile',$profile);
			$stmt->bindParam(':email',$email);
			$stmt->bindParam(':password',$password);
			$stmt->bindParam(':phone',$phone);
			$stmt->bindParam(':address',$address);

			$stmt->execute();

			if($stmt->rowCount())
			{
				$response=array(
					'status' => 1,
					'status_message' =>'Password is Updated Successfully.'
				);
			}
			else
			{
				$response=array(
					'status' => 0,
					'status_message' =>'Password cannot updated in database.'
				);
			}
		}
		else
		{
			$response= array(
				'status' => 0,
				'status_message'	=>	'Password field is required.' 
			);	
		}
		echo json_encode($response);

	}
?>