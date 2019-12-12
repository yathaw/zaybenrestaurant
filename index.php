<?php 
  require 'db_connect.php';
  include 'frontend_header.php';
?>
  <!-- Page Content -->
  <div class="container mt-3">

    <div class="row">

      <div class="col-lg-3">

        <h1 class="my-4"> Today Special </h1>
        
        <?php require 'listgroup_category.php'; ?>

      </div>
      <!-- /.col-lg-3 -->

      <div class="col-lg-9">

        <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
              <img class="d-block img-fluid" src="frontend/img/bg1.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="frontend/img/bg2.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block img-fluid" src="frontend/img/bg3.jpg" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>

        <div class="row">

          <?php 
            $sql="SELECT items.*, categories.name as cname FROM items INNER JOIN categories ON categories.id = items.category_id ORDER BY rand() LIMIT 6";

            $stmt=$pdo->prepare($sql);
            $stmt->execute();
            $rows= $stmt->fetchAll();

            $i=1;
            foreach ($rows as $item):
          ?>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
              <img class="card-img-top img-fluid" src="<?= $item['photo'] ?>" alt="" style="height: 170px;  object-fit: cover;">
              <div class="card-body">
                <h5 class="card-title">
                  <?=$item['name']?>
                </h5>
              </div>
              <div class="card-footer">
                <small class="text-danger" style="font-size: 16px"> <i class="fas fa-tags"></i> <?=$item['price']?> </small>
                <?php if(isset($_SESSION['loginuser'])): ?>

                <a href="javascript:void(0)" class="float-right btn btn-secondary text-white btn-sm addtocart" data-id="<?= $item['id']?>" data-name="<?= $item['name'] ?>" data-price="<?= $item['price'] ?>" data-image="<?= $item['photo'] ?>" > <i class="fas fa-shopping-cart"></i>  Add To Cart </a>
                
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
              endforeach;
          ?>


        </div>
        <!-- /.row -->

      </div>
      <!-- /.col-lg-9 -->

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

<?php 
  include 'frontend_footer.php'; 
?>