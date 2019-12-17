<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	require '../db_connect.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'POST':
			store();
			break;

		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}


	function store()
	{
		global $pdo;

		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$address=$_POST['address'];
		$email=$_POST['email'];
		$password=sha1($_POST['password']);
		$image = $_FILES['profile'];
		$role = "member";


		$source_dir="../image/user/";
		$file_path=$source_dir.$image['name'];
		move_uploaded_file($image['tmp_name'],$file_path);
		
		$image_file = "image/user/".$image['name'];
		
		if(!empty($name) && !empty($email) && !empty($password))
		{
			$sql="SELECT * from users where email=:email";	

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":email", $email);
			$stmt->execute();

			if ($stmt->rowCount()) 
			{
				$response=array(
					'status' => 0,
					'status_message' =>'That Email is already added in database.'
				);
			}
			else
			{
				$sql="INSERT INTO users (name,role,profile,email,password,phone,address) VALUES(:name,:role,:profile,:email,:password,:phone,:address)";

				$stmt = $pdo->prepare($sql);
				$stmt->bindParam(":name", $name);
				$stmt->bindParam(":role", $role);
				$stmt->bindParam(":profile", $image_file);
				$stmt->bindParam(":email", $email);
				$stmt->bindParam(":password", $password);
				$stmt->bindParam(":phone", $phone);
				$stmt->bindParam(":address", $address);
				$stmt->execute();

				if($stmt->rowCount())
				{
					$response=array(
						'status' => 1,
						'status_message' =>'Thanks! your account has been successfully created and now'
					);
				}
				else
				{
					$response=array(
						'status' => 0,
						'status_message' =>'User cannot added in database.'
					);
				}
			}

			
		}
		else
		{
			$response= array(
				'status' => 0,
				'status_message'	=>	'Name, Email and Password field is required.' 
			);
		}

		echo json_encode($response);
	}
?>