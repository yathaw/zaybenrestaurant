<?php 
  require 'db_connect.php';
  include 'frontend_header.php';

  $id=$_REQUEST['id'];

?>
  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <div class="col-lg-12">
        <h1 class="my-4 text-center"> Menu List </h1>
        
      </div>
    </div>

    <div class="row">

      <div class="col-lg-3">
      
      <?php require 'listgroup_category.php'; ?>
      

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div class="row">

          <?php 
            $limit = 6;
            $query = "SELECT * FROM items WHERE category_id=$id";

            $s = $pdo->prepare($query);
            $s->execute();
            $total_results = $s->rowCount();
            $total_pages = ceil($total_results/$limit);

            if (!isset($_GET['page'])) 
            {
              $page = 1;
            } 
            else
            {
              $page = $_GET['page'];
            }
            $starting_limit = ($page-1)*$limit;
            $show  = "SELECT * FROM items WHERE category_id=$id ORDER BY id DESC LIMIT $starting_limit, $limit";

            $r = $pdo->prepare($show);
            $r->execute();

            while($result = $r->fetch(PDO::FETCH_ASSOC)):
            ?>
              <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                  <img class="card-img-top img-fluid" src="<?= $result['photo'] ?>" alt="" style="height: 170px;  object-fit: cover;">
                  <div class="card-body">
                    <h5 class="card-title">
                      <?=$result['name']?>
                    </h5>
                  </div>
                  <div class="card-footer">
                    <small class="text-danger" style="font-size: 16px"> <i class="fas fa-tags"></i> <?=$result['price']?> </small>

                    <?php if(isset($_SESSION['loginuser'])): ?>

                    <a href="javascript:void(0)" class="float-right btn btn-secondary text-white btn-sm addtocart" data-id="<?= $result['id']?>" data-name="<?= $result['name'] ?>" data-price="<?= $result['price'] ?>" data-image="<?= $result['photo'] ?>" > <i class="fas fa-shopping-cart"></i>  Add To Cart </a>

                    <?php else: ?>

                      <span class="d-inline-block float-right" tabindex="0" data-toggle="tooltip" title="If you want to order,you must need to be our member">
                        <button class="btn btn-secondary  btn-sm" style="pointer-events: none;" type="button" disabled>
                          <i class="fas fa-shopping-cart"></i>  Add To Cart
                        </button>
                      </span>


                    <?php endif; ?>
              
                  </div>
                </div>
              </div>

            <?php
            endwhile;
          ?>

        </div>
        <!-- /.row -->
        
        <div class="row">  
          <div class="col-lg-12">

            <ul class="pagination justify-content-center">

              <?php 
                for ($page=1; $page <= $total_pages ; $page++):
              ?>
                <li class="page-item">
                  <a class="page-link" href="<?php echo "?id=".$id."&page=$page"; ?>">
                    <?php  echo $page; ?>
                  </a>
                </li>

              <?php endfor; ?>

            </ul>

          </div>
        </div>

      </div>
      <!-- /.col-lg-9 -->



    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php 
  include 'frontend_footer.php'; 
?>