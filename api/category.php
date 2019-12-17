<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	require '../db_connect.php';


	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			index();
			break;

		case 'POST':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				update($id);
			}
			else
			{
				store();
			}
			break;

		case 'DELETE':
			$id=intval($_GET["id"]);
			destroy($id);
			break;


		default:
			// Invalid Request Method
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

	function index()
	{
		global $pdo;
		$sql="SELECT * FROM categories";
		$stmt=$pdo->prepare($sql);
		$stmt->execute();
		$rows= $stmt->fetchAll();

		$categories_arr=array();

		if ($stmt->rowCount() <= 0) 
		{
			$categories_arr["status"] = 0;
			$categories_arr["status_message"] = '404 NOT FOUND';
		}

		else
		{
			$categories_arr["status"] = 1;
			$categories_arr["status_message"] = '200 OK';


			$categories_arr["data"]=array();

			foreach ($rows as $row)
			{
				$category=array(
		        	"id" => $row['id'],
		        	"name" => $row['name'],
		    	);
		    	array_push($categories_arr['data'], $category);
			}

			http_response_code(200);
		}
			echo json_encode($categories_arr);	

		
	}

	function store()
	{
		global $pdo;

		$name=$_POST['name'];
		
		if(!empty($name))
		{
			$sql="SELECT * from categories where name=:name";	

			$stmt = $pdo->prepare($sql);
			$stmt->bindParam(":name", $name);
			$stmt->execute();

			if ($stmt->rowCount()) 
			{
				$response=array(
					'status' => 0,
					'status_message' =>'That name is already added in database.'
				);
			}
			else
			{
				$sql="INSERT into categories (name) VALUES(:name)";
				$stmt= $pdo->prepare($sql);
				$stmt->bindParam(':name',$name);
				$stmt->execute();

				if($stmt->rowCount())
				{
					$response=array(
						'status' => 1,
						'status_message' =>'Category is Added Successfully.'
					);
				}
				else
				{
					$response=array(
						'status' => 0,
						'status_message' =>'Category cannot added in database.'
					);
				}
			}

			
		}
		else
		{
			$response= array(
				'status' => 0,
				'status_message'	=>	'Name field is required.' 
			);
		}

		echo json_encode($response);
	}

	function update($id)
	{
		global $pdo;
		
		parse_str(file_get_contents("php://input"),$_PUT);

		$name=$_POST['name'];


		if (!empty($name)) 
		{
			$sql="UPDATE categories SET name=:name  WHERE id=:id ";
		
			$stmt=$pdo->prepare($sql);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':name',$name);
			$stmt->execute();

			if($stmt->rowCount())
			{
				$response=array(
					'status' => 1,
					'status_message' =>'Existing Category is Updated Successfully.'
				);
			}
			else
			{
				$response=array(
					'status' => 0,
					'status_message' =>'Category cannot updated in database.'
				);
			}
		}
		else
		{
			$response= array(
				'status' => 0,
				'status_message'	=>	'Name field is required.' 
			);	
		}
		echo json_encode($response);

	}

	function destroy($id)
	{
		global $pdo;

		$sql='DELETE FROM categories where id=:id ';

		$stmt=$pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
		$stmt->execute();

		if($stmt->rowCount())
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Existing Category is Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Category cannot deleted in database.'
			);
		}

		echo json_encode($response);
		
	}

?>