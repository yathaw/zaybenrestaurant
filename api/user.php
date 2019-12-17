<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	require '../db_connect.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			$id=intval($_GET["id"]);
			detail($id);
			break;


		case 'POST':
			$id=intval($_GET["id"]);
			update($id);
			break;

		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

	function detail($id)
	{
		global $pdo;
		$sql="SELECT * FROM users WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$users_arr=array();

		if ($stmt->rowCount() <= 0) 
		{
			$users_arr["status"] = 0;
			$users_arr["status_message"] = '404 NOT FOUND';
		}

		else
		{
			$users_arr["status"] = 1;
			$users_arr["status_message"] = '200 OK';


			$users_arr["data"]=array(
	        	"id" => $row['id'],
	        	"name" => $row['name'],
	        	"role"	=>	$row['role'],
	        	"profile"	=>	$row['profile'],
	        	"phone"	=>	$row['phone'],
	        	"address"	=>	$row['address'],
	        	"email"	=>	$row['email'],
	        	"password"	=>	$row['password']
		        	);

			http_response_code(200);
		}
			echo json_encode($users_arr);	

		
	}

	function update($id)
	{
		global $pdo;

		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];
		$email=$_POST['email'];

		$sql="SELECT * FROM users WHERE id=:id";
		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$password = $row['password'];
		$profile = $row['profile'];
		$role = $row['role'];

		if (!empty($name) && !empty($email)) 
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
					'status_message' =>'Existing User is Updated Successfully.'
				);
			}
			else
			{
				$response=array(
					'status' => 0,
					'status_message' =>'User cannot updated in database.'
				);
			}
		}
		else
		{
			$response= array(
				'status' => 0,
				'status_message'	=>	'Name and Email field is required.' 
			);	
		}
		echo json_encode($response);

	}
?>