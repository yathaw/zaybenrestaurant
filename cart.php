<?php 
  require 'db_connect.php';
  include 'frontend_header.php';
?>
	<!-- Page Content -->
  <div class="container mt-5">

    <div class="row">
     	<div class="col-lg-12">
        	<h1 class="my-4 text-center"> Your Shopping Cart </h1>
        	<hr class="text-center">
        
			<marquee behavior="alternate">
				Thank you for your Shopping with us.
			</marquee>

      	</div>
    </div>

    <div class="row mt-5">
    	<div class="col-lg-12">
    		<a href="menu" class="btn btn-outline-success float-right"> 
    			<i class="fas fa-shopping-cart"></i> Continue Shopping
    		</a>
    	</div>
    </div>

    <div class="row mt-5" id="shoppingcart_div">
    	<div class="table-responsive">
    		<table class="table">
    			<thead>
    				<tr>
    					<th colspan="2"> No </th>
    					<th> Menu </th>
    					<th> Qty </th>
    					<th> Price </th>
    					<th colspan="2"> Total </th>
    				</tr>
    			</thead>
    			<tbody id="shoppingcart_table"></tbody>
    		</table>
    	</div>
	</div>

	<div class="mt-5" id="order_div">
		<div class="row text-center">
			<div class="col-lg-12">
				<button id="order" class="btn btn-outline-secondary btn-lg"> 
					Order Confirm 
				</button>
			</div>
		</div>

		<div class="row bg-secondary mt-5">
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
					<img src="image/logo.png" class="img-fluid mr-3" width="100px" height="130px">
					Zay Ben Restaurant
				</h1>

			</div>
			
		</div>

		<div class="row mt-5">

			<div class="col-lg-5">
				<h2> 
					<?php echo $_SESSION['loginuser']['name'];?> 
				</h2>
			</div>

			<div class="col-lg-7">
				<table class="table table-bordered">
					<tr>
						<td> Invoice </td>
						<td> <span id="invoice_number"></span> </td>
					</tr>
					<tr>
						<td> Date </td>
						<td> <span id="invoice_date"></span> </td>
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
				<tbody id="voucher_tbody"> </tbody>
				<tfoot></tfoot>
			</table>
		</div>

		<div class="row text-center mt-5">
			<div class="col-lg-12">
				<h5>Terms</h5> <hr>
				<p> Waiting Time - 2 / 3 weeks </p>
			</div>
		</div>
		


	</div>

    
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php 
  include 'frontend_footer.php'; 
?>