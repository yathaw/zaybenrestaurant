<?php 
	require 'db_connect.php';
	include 'backend_header.php';
?>
<!-- Begin Page Content -->
	<div class="container-fluid">
	  <!-- Page Heading -->
	  <h1 class="h3 mb-4 text-gray-800">
	  	<i class="fas fa-concierge-bell pr-3"></i> 
	  	Order 
	  </h1>

	  <div class="card shadow mb-4">
		<div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-danger"> 

            	Order List 



            </h4>
		

        </div>
        <div class="card-body">
            <div class="table-responsive">
            	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th> No </th>
							<th> Voucher No </th>
							<th> Date </th>
							<th> Total </th>
							<th> Status </th>
							<th> Action </th>
						</tr>
					</thead>

					<tbody class="itemtbody">

						<?php 
							$sql="SELECT * FROM orders  ORDER BY orderdate DESC";
				        	$stmt=$pdo->prepare($sql);
				        	$stmt->execute();
				        	$rows= $stmt->fetchAll();

				        	$i=1;
    						foreach ($rows as $item):

    						$id = $item['id'];
    						$orderdate = new DateTime($item['orderdate']);
    						$voucherno = $item['voucherno'];
    						$total = $item['total'];
    						$note = $item['note'];
    						$status = $item['status'];

    						$date = date_format($orderdate, 'd - M - Y');

						?>

						<tr>
							<td> <?= $i; ?> </td>
							<td> 
								<a href="order_detail?voucherno=<?= $voucherno ?>"> 
									<?= $voucherno ?> 
								</a> 
							</td>
							<td> <?= $date ?> </td>
							<td> <?= $total ?> </td>
							<td class="text-danger"> <?= $status ?> </td>
							<td>
								<a href="javascript:void(0)" class="btn btn-success btnedit" data-id="<?= $id ?>">
									<i class="fas fa-check-double"></i>  Confirm
								</a>

								<a href="" class="btn btn-info" onclick="return confirm('Are you sure to delete?')" >
									<i class="fas fa-truck"></i> Delivery
								</a>
							</td>
						</tr>

						<?php 
							$i++;
							endforeach; 
						?>

					</tbody>

					

            	</table>
            </div>
        </div>
	  </div>

	</div>
<!-- /.container-fluid -->


<?php 
	include 'backend_footer.php'; 
?>
