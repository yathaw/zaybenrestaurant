<?php 
	require 'db_connect.php';
	include 'backend_header.php';
?>
<!-- Begin Page Content -->
	<div class="container-fluid">
	  <!-- Page Heading -->
	  <h1 class="h3 mb-4 text-gray-800">
	  	<i class="fas fa-users pr-3"></i> 
	  	Customer 
	  </h1>

	  <div class="card shadow mb-4">
		<div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-danger"> 

            	Customer List 

            </h4>
		

        </div>
        <div class="card-body">
            <div class="table-responsive">
            	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th> No </th>
							<th> Name </th>
							<th> Phone </th>
							<th> Action </th>
						</tr>
					</thead>

					<tbody class="itemtbody">

						<?php 
							$sql="SELECT * FROM users WHERE role='member' ORDER BY id DESC";
				        	$stmt=$pdo->prepare($sql);
				        	$stmt->execute();
				        	$rows= $stmt->fetchAll();

				        	$i=1;
    						foreach ($rows as $user):

    						$id = $user['id'];
    						$name = $user['name'];
    						$phone = $user['phone'];
    						$profile = $user['profile'];
    						$email = $user['email'];
    						$address = $user['address'];

						?>

						<tr>
							<td> <?= $i; ?> </td>
							<td> <?= $name ?> </td>
							<td> <?= $phone ?> </td>
							<td>
								<a href="javascript:void(0)" class="btn btn-primary btndetail" data-id="<?= $id ?>" data-name="<?= $name ?>" data-phone="<?= $phone ?>" data-profile="<?= $profile ?>" data-email="<?= $email ?>" data-address="<?= $address ?>" >
									<i class="fas fa-eye"></i> Detail
								</a>

								<a href="item_delete?id=<?= $id ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" >
									<i class="fas fa-trash"></i> Delete
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
	      				<div class="col-lg-4">
	      					<img src="" id="detailPhoto" class="img-fluid" style="width: 100px; height: 100px">
	      				</div>
	      				<div class="col-lg-8">
	      					<p id="detailPhone"> </p>
							
							<p id="detailPrice"></p>

							<p id="detailEmail"></p>

							<p id="detailAddress" class="mt-3"></p>

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




<?php 
	include 'backend_footer.php'; 
?>

<script type="text/javascript">
	
	$(document).ready(function(){

    	$(".itemtbody").on("click",".btndetail",function(event)
    	{
    		var id=$(this).data('id');
    		var name=$(this).data('name');
    		var phone=$(this).data('phone');
    		var profile=$(this).data('profile');
    		var email=$(this).data('email');
    		var address=$(this).data('address');

			$("#detailName").text(name);
			$("#detailPhone").text(phone);
			$("#detailEmail").text(email);
			$("#detailAddress").text(address);
			$("#detailPhoto").attr('src',profile);

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
