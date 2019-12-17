<?php 
	
	header("Access-Control-Allow-Origin: *");
	header("Content-Type: application/json; charset=UTF-8");
	date_default_timezone_set('Asia/Rangoon');


	require '../db_connect.php';

	$request_method=$_SERVER["REQUEST_METHOD"];

	switch($request_method)
	{
		case 'POST':
			store();
			break;

		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

	function store()
	{
		global $pdo;

		session_start();

		if (isset($_SESSION['data']))
		// parse_str(file_get_contents("php://input"),$_PUT);
		{
			$cartarray = $_POST['cartarray'];
			$note = $_POST['note'];

			$cart = json_decode($cartarray);

			$voucher = strtotime(date("h:i:s"));
			$orderdate = date('Y-m-d');
			$userid = $_SESSION['data']['id'];
			$status = "Order";
			$total =0;

			foreach($cart as $key => $value)
			{
				$id = $value->id;
				$qty = $value->qty;
				$price = $value->price;
				$subtotal = $qty * $price;
				$total += $subtotal ++;

				$orderdetail_sql = "INSERT INTO orderdetails (voucherno, item_id, qty) VALUES (:voucherno, :id, :qty)";
				$orderdetail_stmt = $pdo->prepare($orderdetail_sql);
				$orderdetail_stmt->bindParam(':voucherno', $voucher);
				$orderdetail_stmt->bindParam(':id',$id);
				$orderdetail_stmt->bindParam(':qty', $qty);
				$orderdetail_stmt->execute();
			}

			$order_sql = "INSERT INTO orders (orderdate, voucherno, total, note, user_id, status) VALUES (:orderdate, :voucherno, :total, :note, :userid, :status)";
			$order_stmt= $pdo->prepare($order_sql);
			$order_stmt->bindParam(':orderdate',$orderdate);
			$order_stmt->bindParam(':voucherno',$voucher);
			$order_stmt->bindParam(':total',$total);
			$order_stmt->bindParam(':note',$note);
			$order_stmt->bindParam(':userid',$userid);
			$order_stmt->bindParam(':status',$status);
			$order_stmt->execute();

			$response["status"] = 1;
			$response["status_message"] = '200 OK';
			$response["message"] = 'Order has been stored.';

			$response["orderdetails"]=array();
			$response["orders"]=array();

			$orderdetail_sql_getdata = "SELECT * FROM orderdetails WHERE orderdetails.voucherno=:voucherno";

			$stmt = $pdo->prepare($orderdetail_sql_getdata);
			$stmt->bindParam(':voucherno', $voucher);
			$stmt->execute();
			$rows = $stmt->fetchAll();

			foreach ($rows as $row)
			{
				$orderdetails=array(
		        	"id" => $row['id'],
		        	"voucherno" => $row['voucherno'],
		        	"item_id"	=>	$row['item_id'],
		        	"qty"	=>	$row['qty'],
		    	);
		    	array_push($response['orderdetails'], $orderdetails);
			}

			$order_sql_getdata = "SELECT * FROM orders WHERE orders.voucherno=:voucherno";

			$stmt = $pdo->prepare($order_sql_getdata);
			$stmt->bindParam(':voucherno', $voucher);
			$stmt->execute();
			$order_row = $stmt->fetch(PDO::FETCH_ASSOC);

			$response["orders"]=array(
		        	"id" => $order_row['id'],
		        	"orderdate" => $order_row['orderdate'],
		        	"voucherno"	=>	$order_row['voucherno'],
		        	"total"	=>	$order_row['total'],
		        	"note"	=>	$order_row['note'],
		        	"user_id"	=>	$order_row['user_id'],
		        	"status"	=>	$order_row['status']
		    	);


		}
		else
		{
			$response= array(
				'status' => 0,
				'status_message'	=>	'You are not unauthorized.' 
			);
		}

		echo json_encode($response);


	}

?>