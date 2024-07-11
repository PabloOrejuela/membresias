<link rel="stylesheet" href="<?= site_url(); ?>public/css/login.css">
<div class="col-md-12 mt-5" id="wrap">
  <div class="login-box">
    <div class="login-logo">
      <a href="#">
        <img src="<?= base_url(); ?>public/img/logo-tribu.jpg" alt="User Avatar" class="img-size-20 mr-3 img-circle" width="200">
      </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Ingreso al sistema</p>
        <?php 
          //session()->getFlashdata('error'); 
        ?>
        <form action="<?= base_url(); ?>validate" method="post" class="form">
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="user" placeholder="usuario">
          </div>
          <p id="error-message"><?= session('errors.user');?> </p>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <p id="error-message"><?= session('errors.password');?> </p>
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-12">
              <?php
                
                if (session('mensaje')) {
                  echo'<div class="alert alert-danger mt-2" role="alert">'.session('mensaje').'</div>';
                }
              ?>
              
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
</div>
