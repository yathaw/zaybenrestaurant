<?php 
	require 'db_connect.php';
	include 'backend_header.php';

	$voucherno=$_REQUEST['voucherno'];

	$sql="SELECT orderdetails.*, orders.*, 
	users.name as uname, users.phone as phone, users.address as address
	FROM orderdetails 
	INNER JOIN orders ON orders.voucherno = orderdetails.voucherno 
	INNER JOIN users ON users.id = orders.user_id 
	where orderdetails.voucherno=:voucherno" ;


	$stmt=$pdo->prepare($sql);
  	$stmt->bindParam(':voucherno',$voucherno);
  	$stmt->execute();
  	$row=$stmt->fetchAll();

  	$order = $row[0];

  	$orderdate = new DateTime($order['orderdate']);
  	$date = date_format($orderdate, 'F d, Y');

?>
<!-- Begin Page Content -->
	<div class="container-fluid">
	  <!-- Page Heading -->
	  <h1 class="h3 mb-4 text-gray-800">
	  	<i class="fas fa-clipboard-list pr-3"></i>
	  	Order Detail 
	  </h1>

	  <div class="card shadow mb-4">
		<div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-danger"> 
            	<?= $voucherno ?>
            </h4>
		

        </div>
        <div class="card-body">
            <div class="container">
            	<div class="row bg-secondary">
					<div class="col-lg-12">
						<h3 class="text-white text-center"> Inovie </h3>
					</div>
				</div>

				<div class="row mt-3">

					<div class="col-lg-5">
						<p> Zay Ben Restaurant </p>
						<p> No.330, Ahlone Road, Dagon Township, Yangon International Hotel Compound </p>
						<p> Phone : (+95) 252 221 114 </p>
					</div>

					<div class="col-lg-7 pl-5">
						
						<h1 class="mt-3"> 
							<img src="image/logo.png" class="img-fluid mr-3" width="115px" height="130px">
							Zay Ben Restaurant
						</h1>

					</div>
					
				</div>

				<div class="row mt-5">

					<div class="col-lg-5">
						<div class="row">
							<h6> Name : </h6>
							<p class="ml-5"> <?= $order['uname'] ?> </p>
						</div>

						<div class="row">
							<h6> Phone : </h6>
							<p class="ml-5"> <?= $order['phone'] ?> </p>
						</div>

						<div class="row">
							<h6> Address : </h6>
							<p class="ml-5"> <?= $order['address'] ?> </p>
						</div>
					</div>

					<div class="col-lg-7">
						<table class="table table-bordered">
							<tr>
								<td> Invoice </td>
								<td> <span> <?= $voucherno ?> </span> </td>
							</tr>
							<tr>
								<td> Date </td>
								<td> <span> <?= $date ?> </span> </td>
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

							<?php 
								$sql="SELECT orderdetails.*, orders.*, items.*
								FROM orderdetails 
								INNER JOIN orders ON orders.voucherno = orderdetails.voucherno 
								INNER JOIN items ON items.id = orderdetails.item_id  
								where orderdetails.voucherno=:voucherno" ;


								$stmt=$pdo->prepare($sql);
							  	$stmt->bindParam(':voucherno',$voucherno);
							  	$stmt->execute();
							  	$orderitems=$stmt->fetchAll();

							  	$i=1; $subtotal = 0;

							  	foreach($orderitems as $orderitem ):

	    						$name = $orderitem['name'];
    							$price = $orderitem['price'];

    							$qty = $orderitem['qty'];

    							$unitprice = $price * $qty;

    							$subtotal += $unitprice;

    							$total = $orderitem['total'];
    							$note = $orderitem['note'];


							?>

							<tr>
								<td> <?= $i; ?> </td>
								<td> <?= $name; ?> </td>
								<td> <?= $price; ?> </td>
								<td> <?= $qty; ?> </td>

								<td> <?= $unitprice; ?> </td>
							</tr>

							<?php 
								$i++;
								endforeach;
							?>
							
						</tbody>

						<tfoot>
							<tr>
								<td colspan="2" rowspan="4">
								<p> NOTES : </p> 
								<p> <?= $note; ?> </p>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<p> Subtotal </p> 
								</td>
								<td colspan="2">
									<p> <?= $subtotal; ?> </p> 
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<p> Tax </p> 
								</td>
								<td colspan="2">
									<p> 5% </p> 
								</td>
							</tr>

							<tr>
								<td colspan="2">
									<p class="text-danger"> Total Amount </p> 
								</td>
								<td colspan="2">
									<p class="text-danger"> <?= $total; ?> </p> 
								</td>
							</tr>

						</tfoot>
					</table>
				</div>

            </div>

        </div>
	  </div>

	</div>
<!-- /.container-fluid -->


<?php 
	include 'backend_footer.php'; 
?>
