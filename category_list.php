<?php 
	require 'db_connect.php';
	include 'backend_header.php';
?>
<!-- Begin Page Content -->
	<div class="container-fluid">
	  <!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">
	  		<i class="fas fa-hamburger pr-3"></i> 
	  		Category 
	  	</h1>

	  	<div class="card shadow mb-4" id="Newdiv">
	  		<div class="card-header">
	            <h4 class="m-0 font-weight-bold text-primary"> 
	            	Add New Category 
	            </h4>

	  		</div>
	  		<div class="card-body">
	  			<div class="row">
					<div class="col-lg-12">
						<form class="user" action="category_add" method="POST">
							<div class="row">
								<div class="col-lg-10">
									<label class="sr-only" for="inputName">Name</label>
									<input type="text" class="form-control form-control-user" id="inputName" name="name" placeholder="Enter Category Name">
								</div>
								<div class="col-lg-2">
									<button type="submit" class="btn btn-secondary mb-2 btn-user btn-block">

										<i class="fas fa-save"></i> Save Changes

									</button>
								</div>
							</div>

						</form>
					</div>
				</div>
	  		</div>
	  	</div>

	  	<div class="card shadow mb-4" id="Editdiv">
	  		<div class="card-header">
	            <h4 class="m-0 font-weight-bold text-primary"> 
	            	Edit Existing Category 
	            </h4>

	  		</div>
	  		<div class="card-body">
	  			<div class="row">
					<div class="col-lg-12">
						<form class="user" action="category_update" method="POST">
							<input type="hidden" name="id" id="editId">
							<div class="row">
								<div class="col-lg-10">
									<label class="sr-only" for="editName">Name</label>
									<input type="text" class="form-control form-control-user" id="editName" name="name" placeholder="Enter Category Name">
								</div>
								<div class="col-lg-2">
									<button type="submit" class="btn btn-secondary mb-2 btn-user btn-block">

										<i class="fas fa-upload"></i> Update Changes

									</button>
								</div>
							</div>

						</form>
					</div>
				</div>
	  		</div>
	  	</div>



		<div class="card shadow mb-4">
			<div class="card-header py-3">
	            <h4 class="m-0 font-weight-bold text-primary"> 
	            	Category List 
	            </h4>
	        </div>
	        <div class="card-body">
				
				

	            <div class="table-responsive">
	            	<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th> No </th>
								<th> Name </th>
								<th> Action </th>
							</tr>
						</thead>

						<tbody>

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

							<tr>
								<td> <?= $i; ?> </td>
								<td> <?= $name ?> </td>
								<td>
									<a href="javascript:void(0)" class="btn btn-warning btnedit" data-id="<?= $id ?>" data-name="<?= $name ?>" >
										<i class="fas fa-edit"></i> Edit
									</a>

									<a href="category_delete?id=<?= $id ?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete?')" >
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

<?php 
	include 'backend_footer.php'; 
?>

<script type="text/javascript">
	
	$(document).ready(function(){
		$("#Newdiv").show();
    	$("#Editdiv").hide();

    	$(".btnedit").click(function()
    	{
    		var id=$(this).data('id');

    		$.post('category_edit.php',{id:id} ,
    		function(data)
    		{
       			console.log(typeof(data));
         		if(data)
         		{
   					var categories=JSON.parse(data);
  					//  console.log(item_type);
					var id= categories[0].id;
					var name=categories[0].name;
				
					$("#editId").val(id);
					$("#editName").val(name);

					$("#Newdiv").hide();
    				$("#Editdiv").show();

         		}
      		})
    	});

	});
</script>

