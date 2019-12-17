<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");

	require '../db_connect.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				detail($id);
			}
			else
			{
				index();
			}
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
		$sql="SELECT items.*, categories.name as cname FROM items INNER JOIN categories ON categories.id = items.category_id ORDER BY items.id ASC";
		$stmt=$pdo->prepare($sql);
		$stmt->execute();
		$rows= $stmt->fetchAll();

		$items_arr=array();

		if ($stmt->rowCount() <= 0) 
		{
			$items_arr["status"] = 0;
			$items_arr["status_message"] = '404 NOT FOUND';
		}

		else
		{
			$items_arr["status"] = 1;
			$items_arr["status_message"] = '200 OK';


			$items_arr["data"]=array();

			foreach ($rows as $row)
			{
				$item=array(
		        	"id" => $row['id'],
		        	"name" => $row['name'],
		        	"price"	=>	$row['price'],
		        	"photo"	=>	$row['photo'],
		        	"description"	=>	$row['description'],
		        	"category_id"	=>	$row['category_id'],
		        	"category_name"	=>	$row['cname']
		    	);
		    	array_push($items_arr['data'], $item);
			}

			http_response_code(200);
		}
			echo json_encode($items_arr);	

		
	}

	function store()
	{
		global $pdo;

		$name=$_POST['name'];
		$price=$_POST['price'];
		$categoryid=$_POST['categoryid'];
		$description=$_POST['description'];
		$image=$_FILES['image'];


		$source_dir="../image/item/";
		$file_path=$source_dir.$image['name'];
		move_uploaded_file($image['tmp_name'],$file_path);
		
		$image_file = "image/item/".$image['name'];
		
		if(!empty($name) && !empty($categoryid))
		{
			$sql="SELECT * from items where name=:name";	

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
				$sql="INSERT into items (name, price, description, photo,category_id) VALUES(:name, :price, :description, :photo, :category_id)";
				$stmt= $pdo->prepare($sql);
				$stmt->bindParam(':name',$name);
				$stmt->bindParam(':price',$price);
				$stmt->bindParam(':description',$description);
				$stmt->bindParam(':photo',$image_file);
				$stmt->bindParam(':category_id',$categoryid);

				$stmt->execute();

				if($stmt->rowCount())
				{
					$response=array(
						'status' => 1,
						'status_message' =>'Item is Added Successfully.'
					);
				}
				else
				{
					$response=array(
						'status' => 0,
						'status_message' =>'Item cannot added in database.'
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

	function detail($id)
	{
		global $pdo;
		$sql = "SELECT items.*, categories.name as cname, categories.id as cid FROM items INNER JOIN categories ON categories.id = items.category_id 
		WHERE items.id=:id";

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$items_arr=array();

		if ($stmt->rowCount() <= 0) 
		{
			$items_arr["status"] = 0;
			$items_arr["status_message"] = '404 NOT FOUND';
		}

		else
		{
			$items_arr["status"] = 1;
			$items_arr["status_message"] = '200 OK';


			$items_arr["data"]=array(
		        	"id" => $row['id'],
		        	"name" => $row['name'],
		        	"price"	=>	$row['price'],
		        	"photo"	=>	$row['photo'],
		        	"description"	=>	$row['description'],
		        	"category_id"	=>	$row['category_id'],
		        	"category_name"	=>	$row['cname']
		    	);

			http_response_code(200);
		}
			echo json_encode($items_arr);	
	}

	function update($id)
	{
		global $pdo;
		
		// parse_str(file_get_contents("php://input"),$_PUT);

		$name=$_POST['name'];
		$price=$_POST['price'];
		$categoryid=$_POST['categoryid'];
		$description=$_POST['description'];

		$image_sql="SELECT * FROM items where id=:id" ;

		$image_stmt = $pdo->prepare($image_sql);
		$image_stmt->bindParam(':id', $id);
		$image_stmt->execute();
		$imagedb_row = $image_stmt->fetch(PDO::FETCH_ASSOC);

		$image_array = explode('/', $imagedb_row['photo']);

		$oldImage = '../image/item/'.$image_array[2];


		$newImage=$_FILES['newImage'];


		if($newImage['name'])
		{
	   		// create a file path for new photo
	   	  	$file_path='../image/item/'.$newImage['name'];
	   		
	   		// upload new photo
	 		move_uploaded_file($newImage['tmp_name'], $file_path);

			// delete old photo
	      	unlink($oldImage);

	      	$itemImage = 'image/item/'.$newImage['name'];
	   	}
	   	else
	   	{
	   		$itemImage = $oldImage;
	   	}

		if (!empty($name) && !empty($categoryid)) 
		{
			$sql="UPDATE items SET name=:name, price=:price, description=:description, photo=:photo, category_id=:category_id  WHERE id=:id ";
	
			$stmt=$pdo->prepare($sql);
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':name',$name);
			$stmt->bindParam(':price',$price);
			$stmt->bindParam(':description',$description);
			$stmt->bindParam(':photo',$itemImage);
			$stmt->bindParam(':category_id',$categoryid);
			$stmt->execute();

			if($stmt->rowCount())
			{
				$response=array(
					'status' => 1,
					'status_message' =>'Existing Item is Updated Successfully.'
				);
			}
			else
			{
				$response=array(
					'status' => 0,
					'status_message' =>'Item cannot updated in database.'
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

		$sql='DELETE FROM items where id=:id ';

		$stmt=$pdo->prepare($sql);
		$stmt->bindParam(':id',$id);
		$stmt->execute();

		if($stmt->rowCount())
		{
			$response=array(
				'status' => 1,
				'status_message' =>'Existing Item is Deleted Successfully.'
			);
		}
		else
		{
			$response=array(
				'status' => 0,
				'status_message' =>'Item cannot deleted in database.'
			);
		}

		echo json_encode($response);
		
	}

?>