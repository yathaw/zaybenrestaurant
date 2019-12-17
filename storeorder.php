<?php 
	date_default_timezone_set('Asia/Rangoon');

	session_start();
	
	require 'db_connect.php';

	$today = date("Y-m-d");
	$month = date('M');
	$day = date('d');
	$year = date('Y');

	$emaildate = $month.' '.$day.', '.$year;

	$cartarr = $_POST['cartarr'];
	$invoiceno = $_POST['invoiceno'];
	$note = $_POST['note'];
	$total = $_POST['total'];

	$userid = $_SESSION['loginuser']['id'];
	$username = $_SESSION['loginuser']['name'];
	$useremail = $_SESSION['loginuser']['email'];

	$status = "Order";



	foreach ($cartarr as $key => $value) 
	{
		
		$id = $value ['id'];
		$qty = $value['qty'];
		

		$orderdetail_sql= "INSERT INTO orderdetails (voucherno, item_id, qty) VALUES (:invoiceno, :id, :qty)";

		$orderdetail_stmt= $pdo->prepare($orderdetail_sql);
		$orderdetail_stmt->bindParam(':invoiceno',$invoiceno);
		$orderdetail_stmt->bindParam(':id',$id);
		$orderdetail_stmt->bindParam(':qty',$qty);
		$orderdetail_stmt->execute();
		
	}

	$order_sql = "INSERT INTO orders (orderdate, voucherno, total, note, user_id, status) VALUES(:today, :invoiceno, :total, :note, :userid, :status)";

    $order_stmt= $pdo->prepare($order_sql);
	$order_stmt->bindParam(':today',$today);
	$order_stmt->bindParam(':invoiceno',$invoiceno);
	$order_stmt->bindParam(':total',$total);
	$order_stmt->bindParam(':note',$note);
	$order_stmt->bindParam(':userid',$userid);
	$order_stmt->bindParam(':status',$status);
	$order_stmt->execute();

	$to  = $useremail;
	$subject = 'King of Taste`s Order Confirm';
	$message = '<!DOCTYPE html>
				<html>
				<head>
					<title></title>
					<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
					
					<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
					
					<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
					
					<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
				</head>
				<body>

					<div class="row bg-success mt-5">
						<div class="col-lg-12">
							<h3 class="text-white text-center"> Inovie </h3>
						</div>
					</div>
					
					<div class="row mt-3">

						<div class="col-lg-5">
							<p> King of Taste </p>
							<p> No.330, Ahlone Road, Dagon Township, Yangon International Hotel Compound </p>
							<p> Phone : (+95) 252 221 114 </p>
						</div>

						<div class="col-lg-7 pl-5">
							
							<h1 class="mt-3"> 
								<img src="image/icon.png" class="img-fluid mr-3" width="100px" height="100px">
								King of Taste
							</h1>

						</div>
						
					</div>

					<div class="row mt-5">

						<div class="col-lg-5">
							<h2> '.$username.' </h2>
						</div>

						<div class="col-lg-7">
							<table class="table table-bordered">
								<tr>
									<td> Invoice </td>
									<td> <span> '.$invoiceno.' </span> </td>
								</tr>
								<tr>
									<td> Date </td>
									<td> <span>'.$emaildate.'</span> </td>
								</tr>
							</table>
						</div>
						
					</div>

					<div class="row mt-5">
						<table class="table table-bordered">
							<thead>
								<tr>
									<td> <b> No </b> </td>
									<td width="537px"> <b> Menu </b> </td>
									<td> <b> Unit Price </b> </td>
									<td> <b> Quantity </b> </td>
									<td> <b> Price </b> </td>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
							<tfoot></tfoot>
						</table>
					</div>

					<div class="row text-center mt-5">
						<div class="col-lg-12">
							<h5>Terms</h5> <hr>
							<p> Waiting Time - 2 / 3 weeks </p>
						</div>
					</div>

				</body>
				</html>';
	mail($to, $subject, $message);



?>