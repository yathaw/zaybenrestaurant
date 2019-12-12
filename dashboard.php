<?php 
	require 'db_connect.php';
	include 'backend_header.php';

	$date = new DateTime();
	$today = $date->format('Y-m-d');

	// ORDER ------
	$order_sql="SELECT COUNT(id) as order_total FROM orders  WHERE orderdate = '$today'";
	$order_stmt=$pdo->prepare($order_sql);
	$order_stmt->execute();
	$orderrows= $order_stmt->fetchAll();
	// --------------------

	// CUSTOMER -------
	$customer_sql="SELECT COUNT(id) as customer_total FROM users  WHERE role = 'member'";
	$customer_stmt=$pdo->prepare($customer_sql);
	$customer_stmt->execute();
	$customerrows= $customer_stmt->fetchAll();
	// --------------------

	// ITEM -------
	$item_sql="SELECT COUNT(id) as item_total FROM items";
	$item_stmt=$pdo->prepare($item_sql);
	$item_stmt->execute();
	$itemrows= $item_stmt->fetchAll();
	// --------------------	

	// CATEGORY -------
	$category_sql="SELECT COUNT(id) as category_total FROM categories";
	$category_stmt=$pdo->prepare($category_sql);
	$category_stmt->execute();
	$categoryrows= $category_stmt->fetchAll();
	// --------------------	

	$ordertotal = $orderrows[0]['order_total'];
	$customertotal = $customerrows[0]['customer_total'];
	$itemtotal = $itemrows[0]['item_total'];
	$categorytotal = $categoryrows[0]['category_total'];



?>
<!-- Begin Page Content -->
	<div class="container-fluid">
	  <!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">
		  	<i class="fas fa-fw fa-tachometer-alt pr-3"></i> 
		  	Dashboard 
		</h1>

		<div class="row">
			<!-- Today Order List -->
            <div class="col-xl-3 col-md-6 mb-4">
	            <div class="card border-left-primary shadow h-100 py-2">
	                <div class="card-body">
	                  <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today Order </div>
	                      <div class="h5 mb-0 font-weight-bold text-gray-800">
	                      	<?= $ordertotal ?>
	                      </div>
	                    </div>
	                    <div class="col-auto">
	                      <i class="fas fa-concierge-bell fa-2x text-gray-300"></i>
	                    </div>
	                  </div>
	                </div>
	            </div>
            </div>

            <!-- Customer List -->
            <div class="col-xl-3 col-md-6 mb-4">
	            <div class="card border-left-warning shadow h-100 py-2">
	                <div class="card-body">
	                  <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Customer List </div>
	                      <div class="h5 mb-0 font-weight-bold text-gray-800">
	                      	<?= $customertotal ?>
	                      </div>
	                    </div>
	                    <div class="col-auto">
	                      <i class="fas fa-users fa-2x text-gray-300"></i>
	                    </div>
	                  </div>
	                </div>
	            </div>
            </div>

            <!-- Item List -->
            <div class="col-xl-3 col-md-6 mb-4">
	            <div class="card border-left-danger shadow h-100 py-2">
	                <div class="card-body">
	                  <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Item List </div>
	                      <div class="h5 mb-0 font-weight-bold text-gray-800">
	                      	<?= $itemtotal ?>
	                      </div>
	                    </div>
	                    <div class="col-auto">
	                      <i class="fas fa-utensils fa-2x text-gray-300"></i>
	                    </div>
	                  </div>
	                </div>
	            </div>
            </div>

            <!-- Category List -->
            <div class="col-xl-3 col-md-6 mb-4">
	            <div class="card border-left-success shadow h-100 py-2">
	                <div class="card-body">
	                  <div class="row no-gutters align-items-center">
	                    <div class="col mr-2">
	                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Category List </div>
	                      <div class="h5 mb-0 font-weight-bold text-gray-800">
	                      	<?= $categorytotal ?>
	                      </div>
	                    </div>
	                    <div class="col-auto">
	                      <i class="fas fa-hamburger fa-2x text-gray-300"></i>
	                    </div>
	                  </div>
	                </div>
	            </div>
            </div>


		</div>
		
	<div class="card shadow mb-4">
		<div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-danger"> 

            	Today Order List 
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
							$sql="SELECT * FROM orders  WHERE orderdate = '$today'";
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

<!-- Add Modal -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalCenterTitle"> Add New Item </h5>
	        		
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		
	      	<form action="item_add" method="POST" enctype="multipart/form-data">
	      		<div class="modal-body">

	      			<div class="form-group row">
					    <label for="inputName" class="col-sm-2 col-form-label">Item Photo</label>
					    <div class="col-sm-10">
							<input type="file" name="image" class="newImage">
							<img src="" class="previewImage" width="200px"/>
					    </div>
					</div>

					<div class="form-group row">
					    <label for="inputName" class="col-sm-2 col-form-label">Item Name</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="inputName" placeholder="Enter Item Name" name="name">
					    </div>
					</div>

					<div class="form-group row">
					    <label for="inputPrice" class="col-sm-2 col-form-label"> Price </label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="inputPrice" placeholder="Enter Item Price" name="price">
					    </div>
					</div>

					<div class="form-group row">
					    <label for="inputCategory" class="col-sm-2 col-form-label"> Category </label>
					    <div class="col-sm-10">
					    	<select class="form-control" id="inputCategory" name="categoryid">

					    		<?php 
									$sql="SELECT * from categories ORDER BY name ASC";
						        	$stmt=$pdo->prepare($sql);
						        	$stmt->execute();
						        	$rows= $stmt->fetchAll();

						        	$i=1;
	        						foreach ($rows as $category):

	        						$id = $category['id'];
	        						$name = $category['name'];

								?>

					    		<option value="<?= $id ?>"> <?= $name ?> </option>

					    		<?php endforeach; ?>

					    	</select>
					    </div>
					</div>

					<div class="form-group row">
					    <label for="summernotes" class="col-sm-2 col-form-label"> Description </label>
					    <div class="col-sm-10">
					    	<textarea class="form-control summernote" name="description" id="summernotes"></textarea>
					    </div>
					</div>

	      		</div>



		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal"> 
		        		<i class="fas fa-times"></i> Close
		        	</button>
		        	<button type="submit" class="btn btn-primary">
		        		<i class="fas fa-save"></i> Save changes
		        	</button>
		      	</div>
		    </form>

	    </div>
	  </div>
	</div>
<!-- Add Modal -->

<!-- Detail Modal -->
	<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailName" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="detailName"> </h5>
	        		
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		
	      		<div class="modal-body">

	      			<div class="row">
	      				<div class="col-lg-6">
	      					<img src="" id="detailPhoto" class="img-fluid">
	      				</div>
	      				<div class="col-lg-6">
	      					<p id="detailCname"> </p>
							
							<p id="detailPrice" class="text-danger"></p>

							<p id="detailDesc" class="mt-3"></p>

	      				</div>
	      			</div>

	      		</div>


		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal"> 
		        		<i class="fas fa-times"></i> Close
		        	</button>
		      	</div>

	    </div>
	  </div>
	</div>
<!-- Detail Modal -->

<!-- Edit Modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
	    	<div class="modal-content">
	      		<div class="modal-header">
	        		<h5 class="modal-title" id="exampleModalCenterTitle"> Edit Existing Item </h5>
	        		
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          			<span aria-hidden="true">&times;</span>
	        		</button>
	      		</div>
	      		
	      	<form action="item_update" method="POST" enctype="multipart/form-data">
	      		<input type="hidden" name="id" id="editId">
	      		<input type="hidden" name="oldImage" id="editPhotoLink">
	      		<div class="modal-body">

	      			<div class="form-group row">
					    <label for="inputName" class="col-sm-2 col-form-label">Item Photo</label>
					    <div class="col-sm-10">

							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
    								<a class="nav-link active" id="oldphoto-tab" data-toggle="tab" href="#oldphoto" role="tab" aria-controls="oldphoto" aria-selected="true">Old Photo </a>
  								</li>
  
  								<li class="nav-item">
    								<a class="nav-link" id="newphoto-tab" data-toggle="tab" href="#newphoto" role="tab" aria-controls="newphoto" aria-selected="false"> New Photo </a>
  								</li>
							</ul>

							<div class="tab-content mt-3" id="myTabContent">
								<div class="tab-pane fade show active" id="oldphoto" role="tabpanel" aria-labelledby="oldphoto-tab">

									<img src="" id="editPhoto" width="200px"/>
								</div>
  								
  								<div class="tab-pane fade" id="newphoto" role="tabpanel" aria-labelledby="newphoto-tab">
  									<input type="file" name="newImage" class="newImage">
									<img src="" class="previewImage" width="200px"/>
  								</div>
							</div>
							
					    </div>
					</div>

					<div class="form-group row">
					    <label for="editName" class="col-sm-2 col-form-label">Item Name</label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="editName" placeholder="Enter Item Name" name="name">
					    </div>
					</div>

					<div class="form-group row">
					    <label for="editPrice" class="col-sm-2 col-form-label"> Price </label>
					    <div class="col-sm-10">
					      <input type="text" class="form-control" id="editPrice" placeholder="Enter Item Price" name="price">
					    </div>
					</div>

					<div class="form-group row">
					    <label for="editCategory" class="col-sm-2 col-form-label"> Category </label>
					    <div class="col-sm-10">
					    	<select class="form-control" id="editCategory" name="categoryid">

					    		<?php 
									$sql="SELECT * from categories ORDER BY name ASC";
						        	$stmt=$pdo->prepare($sql);
						        	$stmt->execute();
						        	$rows= $stmt->fetchAll();

						        	$i=1;
	        						foreach ($rows as $category):

	        						$id = $category['id'];
	        						$name = $category['name'];

								?>

					    		<option value="<?= $id ?>"> <?= $name ?> </option>

					    		<?php endforeach; ?>

					    	</select>
					    </div>
					</div>

					<div class="form-group row">
					    <label for="summernotes" class="col-sm-2 col-form-label"> Description </label>
					    <div class="col-sm-10">
					    	<textarea class="form-control editDesc" name="description" id="summernotes"></textarea>
					    </div>
					</div>

	      		</div>



		      	<div class="modal-footer">
		        	<button type="button" class="btn btn-secondary" data-dismiss="modal"> 
		        		<i class="fas fa-times"></i> Close
		        	</button>
		        	<button type="submit" class="btn btn-primary">
		        		<i class="fas fa-upload"></i> Update changes
		        	</button>
		      	</div>
		    </form>

	    </div>
	  </div>
	</div>
<!-- Edit Modal -->



<?php 
	include 'backend_footer.php'; 
?>

<script type="text/javascript">
	
	$(document).ready(function(){

    	$(".itemtbody").on("click",".btndetail",function(event)
    	{
    		var id=$(this).data('id');
    		var name=$(this).data('name');
    		var price=$(this).data('price');
    		var photo=$(this).data('photo');
    		var desc=$(this).data('desc');
    		var cname=$(this).data('cname');

			$("#detailName").text(name);
			$("#detailPrice").text(price);
			$("#detailDesc").html(desc);
			$("#detailCname").text(cname);
			$("#detailPhoto").attr('src',photo);

   			$("#detailModal").modal('show');



    	});

    	$(".itemtbody").on("click",".btnedit",function(event)
    	{
    		var id=$(this).data('id');

    		$.post('item_edit.php',{id:id} ,
    		function(data)
    		{
       			// console.log(data);
         		if(data)
         		{
   					var items=JSON.parse(data);
  					//  console.log(item_type);
					var id= items[0].id;
					var name=items[0].name;
					var price = items[0].price;
					var description = items[0].description;
					var photo = items[0].photo;
					var categoryid = items[0].category_id;

					console.log(description);

				
					$("#editId").val(id);
					$("#editName").val(name);
					$("#editPrice").val(price);
					$(".editDesc").summernote('code',description);
					$("#editPhoto").attr('src',photo);
					$("#editPhotoLink").val(photo);
					$("#editCategroy").val(categoryid);

   					$("#editModal").modal('show');

         		}
      		})
    	});



	});
</script>
