<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<h1 class="text-light">Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-light">
<div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box" style="background-image: linear-gradient(to right, #830000 , #fbfb00);">
              <span class="info-box-icon bg-light elevation-1"><i class="fa-sharp fa-solid fa-virus"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Vaccine Listed</span>
                <span class="info-box-number">
                  <?php 
                    $vaccine = $conn->query("SELECT * FROM vaccine_list where `status` = 1 ")->num_rows;
                    echo number_format($vaccine);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3" style="background-image: linear-gradient(to right, #005474 , #00ff43);">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-map-marked-alt"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Vaccination Center</span>
                <span class="info-box-number">
                <?php 
                    $location = $conn->query("SELECT * FROM vaccination_location_list where `status` = 1 ")->num_rows;
                    echo number_format($location);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3" style="background-image: linear-gradient(to right, #270072 , #d600d9);">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-syringe"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Vaccination</span>
                <span class="info-box-number">
                <?php 
                    $individual = $conn->query("SELECT Vaccine_type FROM individual_list where `status` > 0 ")->num_rows;
                    echo number_format($individual);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>


        <div class="row">
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box" style="background-image: linear-gradient(to right, #a37100 , #00f9c0);">
              <span class="info-box-icon bg-light elevation-1"><i class="fa-sharp fa-solid fa-shield-virus"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Vaccination History</span>
                <span class="info-box-number">
                  <?php 
                    $vaccine = $conn->query("SELECT * FROM vaccine_history_list")->num_rows;
                    echo number_format($vaccine);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3" style="background-image: linear-gradient(to right, #627400 , #0066ff);">
              <span class="info-box-icon bg-info elevation-1"><i class="fa-sharp fa-solid fa-vial-circle-check"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Vaccine Type</span>
                <span class="info-box-number">
                <?php 
                    $location = $conn->query("SELECT Vaccine_type FROM individual_list ")->num_rows;
                    echo number_format($location);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-4">
            <div class="info-box mb-3" style="background-image: linear-gradient(to right, #282300 , #f7f265);">
              <span class="info-box-icon bg-success elevation-1"><i class="fa-solid fa-user-tie"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Users</span>
                <span class="info-box-number">
                <?php 
                    $individual = $conn->query("SELECT * FROM users ")->num_rows;
                    echo number_format($individual);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
<div class="container">
  
</div>
