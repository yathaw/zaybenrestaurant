<?php 
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	require '../db_connect.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'POST':
			login();
			break;

		case 'GET':
			logout();
			break;

		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

	function login()
	{
		global $pdo;

		$useremail=$_POST['email'];
		$userpassword=sha1($_POST['password']);

		if(!empty($useremail) && !empty($userpassword))
		{

			$sql="SELECT * from users where email=:email and password=:password";	

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":email", $useremail);
			$stmt->bindParam(":password", $userpassword);
			$stmt->execute();

			session_start();

			if($stmt->rowCount() <=0 )
			{
				if(!isset($_COOKIE['logInCount']))
				{
					$logInCount = 1;	
				}
				else
				{
					$logInCount = $_COOKIE['logInCount'];
					$logInCount++;
				}

				setcookie('logInCount', $logInCount, time()+100);

				if($logInCount >= 3)

				{
					$login_arr["status"] = 0;
					$login_arr["status_message"] = 'Log IN Failed for three times.Try again after 1 minute.';

					setcookie('logInCount', $logInCount, time()-100);

				}
				else
				{
					// invalid email and password
					$login_arr["status"] = 0;
					$login_arr["status_message"] = 'Email and Password is not invalid.';
				}
				
			}
			else
			{
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				$_SESSION['data'] = $row;

				$login_arr["status"] = 1;
				$login_arr["status_message"] = '200 OK';

			}
		}
		else
		{
			$login_arr["status"] = 0;
			$login_arr["status_message"] = 'Email and Password field is required.';
		}

		echo json_encode($login_arr);	

	}

	function logout()
	{
		session_start();

		session_destroy();

		$response= array(
				'status' => 1,
				'status_message'	=>	'Logout Success.' 
			);

		echo json_encode($response);
		
	}
?>