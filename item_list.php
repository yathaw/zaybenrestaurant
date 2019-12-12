<?php 
	require 'db_connect.php';
	include 'backend_header.php';
?>
<!-- Begin Page Content -->
	<div class="container-fluid">
	  <!-- Page Heading -->
	  <h1 class="h3 mb-4 text-gray-800">
	  	<i class="fas fa-utensils pr-3"></i> 
	  	Item 
	  </h1>

	  <div class="card shadow mb-4">
		<div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-danger"> 

            	Item List 

            	<button type="button" class="btn btn-secondary float-right" data-toggle="modal" data-target="#addModal">
            		<i class="fa fa-plus pr-2"></i>
					Add New
				</button>



            </h4>
		

        </div>
        <div class="card-body">
            <div class="table-responsive">
            	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th> No </th>
							<th> Name </th>
							<th> Category </th>
							<th> Price </th>
							<th> Action </th>
						</tr>
					</thead>

					<tbody class="itemtbody">

						<?php 
							$sql="SELECT items.*, categories.name as cname FROM items INNER JOIN categories ON categories.id = items.category_id ORDER BY items.id ASC";
				        	$stmt=$pdo->prepare($sql);
				        	$stmt->execute();
				        	$rows= $stmt->fetchAll();

				        	$i=1;
    						foreach ($rows as $item):

    						$id = $item['id'];
    						$name = $item['name'];
    						$price = $item['price'];
    						$photo = $item['photo'];
    						$desc = $item['description'];

    						$cid = $item['category_id'];
    						$cname = $item['cname'];

						?>

						<tr>
							<td> <?= $i; ?> </td>
							<td> <?= $name ?> </td>
							<td> <?= $cname ?> </td>
							<td> <?= $price ?> </td>
							<td>
								<a href="javascript:void(0)" class="btn btn-primary btndetail" data-id="<?= $id ?>" data-name="<?= $name ?>" data-price="<?= $price ?>" data-photo="<?= $photo ?>" data-desc="<?= $desc ?>" data-cname="<?= $cname ?>" >
									<i class="fas fa-eye"></i> Detail
								</a>

								<a href="javascript:void(0)" class="btn btn-warning btnedit" data-id="<?= $id ?>">
									<i class="fas fa-edit"></i> Edit
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
