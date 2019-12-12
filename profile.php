<?php
	require 'frontend_header.php';
?>

	<div class="container mt-5">
		<div class="row mx-5 px-5">
			<div class="col-4">
				<img src="<?php echo $_SESSION['loginuser']['profile'];?>" class="img-fluid">
			</div>

			<div class="col-8">
				<h4> <?php echo $_SESSION['loginuser']['name'];?> </h4>

				<p class="mt-5">
					<i class="fas fa-home mr-3"></i>

					<?php echo $_SESSION['loginuser']['address'];?>
				</p>

				<p>
					<i class="fas fa-mobile-alt mr-4"></i>

					<?php echo $_SESSION['loginuser']['phone'];?>
				</p>

				<p>
					<i class="fas fa-inbox mr-3"></i>

					<?php echo $_SESSION['loginuser']['email'];?>
				</p>

				<div class="row">
					<div class="col-6">
						<a href="" class="btn btn-primary"> Profile Update </a>
					</div>

					<div class="col-6">
						<a href="" class="btn btn-info"> Change Password </a>
					</div>

				</div>

			</div>
		</div>
	</div>


<?php
	require 'frontend_footer.php';
?>